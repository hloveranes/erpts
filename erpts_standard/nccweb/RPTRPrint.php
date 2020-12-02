<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";
include_once "../includes/assessor/AFS.php";
require_once('collection/Receipt.php');
require_once('collection/Payment.php');
require_once('collection/dues.php');
require_once('web/clibPDFWriter.php');
?>
<?php
class RPTRPrint {
    var $errorMessages = array();
    /** these are the objects concerned
     **
     **/
    var $tpl;
    
    function RPTRPrint(){
        $this->tpl = new Template(getcwd());
    }
    function main(){
       $this->showReceipt(false);
    }

    function setDetails(){
        global $sess;
        $this->tpl->set_var($_GET);
        $this->tpl->set_var($_POST);

        # set the RPTOP to get the owner's object and information
        # get it from POST if possible, otherwise from GET
        $rptopID = (isset($_POST['rptopID']))? $_POST['rptopID']:$_GET['rptopID'];
        $rptop = new RPTOP;
        $rptop->selectRecord($rptopID);
        $dateDue = $rptop->getTaxableYear()."-01-01"; # must be a usable format
        $formValues['taxableYear'] = $rptop->getTaxableYear();
        $formValues['rptopNum'] = $rptop->getRptopNumber();
				
        # set the specific TD (although this is in the RPTOP), hard to search for it.
        # get the tdID from POST or GET to initialize the TD
        $tdID = (isset($_POST['tdID']))? $_POST['tdID']:$_GET['tdID'];
        $td = new TD();
        $td->selectRecord($tdID);
        $tdNum = $td->getTaxDeclarationNumber();
        $formValues['tdNum'] = $tdNum;
        # we define the property from the TD
        $propertyType = $td->getPropertyType();
        $propertyID = $td->getPropertyID();
        switch ($propertyType){
			case "Land":
				$property = new Land;
				break;
			case "PlantsTrees":
				$property = new PlantsTrees;
				break;
			case "ImprovementsBuildings":
				$property = new ImprovementsBuildings;
				break;
			case "Machineries":
				$property = new Machineries;
		        break;
			default:
			    echo "cannot be! $propertyType";
			    break;
		}
		if(is_object($property)) {
            $property->selectRecord($propertyID);
            $assessedValue = number_format($property->getAssessedValue(),2,".","");
		    $formValues['assessedValue'] = number_format($property->getAssessedValue(),2);
		}
		$formValues['propertyType'] = $propertyType;
		
		# set the owner's List
		# we define the owner from the RPTOP
		$this->tpl->set_block('step3','Owner','Owners');
		$owner = $rptop->getOwner();
        $personArray = $owner->getPersonArray();
        if(is_array($personArray))
        foreach ($personArray as $person){
                $ownerValues['ownerName'] = $person->getLastName().", ".
                                            $person->getFirstName(). " ".
                                            $person->getMiddleName();
                $addressArray = $person->getAddressArray();
                $address = $addressArray[0];
                $ownerValues['ownerAddress'] = $address->getNumber()." ".
                                               $address->getStreet()."<br>".
                                               $address->getBarangay().", ".
                                               $address->getMunicipalityCity()."<br>".
                                               $address->getProvince();
                $this->tpl->set_var($ownerValues);
                $this->tpl->parse('Owners','Owner','true');
        }

        $companyArray = $owner->getCompanyArray();

        if(is_array($companyArray))
        foreach ($companyArray as $company){
                $ownerValues['ownerName'] = $company->getCompanyName();
                $addressArray = $company->getAddressArray();
                $address = $addressArray[0];
                $ownerValues['ownerAddress'] = $address->getNumber()." ".
                                               $address->getStreet()."<br>".
                                               $address->getBarangay().", ".
                                               $address->getMunicipalityCity()."<br> ".
                                               $address->getProvince();
                $this->tpl->set_var($ownerValues);
                $this->tpl->parse('Owners','Owner','true');
        }
        # tax dues are defined from TDNumber and taxableYear
        # compute for taxes
        $taxDue = new Dues();
        if($taxDue->create($tdNum,$dateDue) == false){
            $taxDue->setBasic($assessedValue);
            $taxDue->setSEF($assessedValue);
            $taxDue->setDueDate($dateDue);
            $taxDue->setUpdateDate();
        }
        $paymentPeriod= "Annual";
        if(isset($_POST['paymentPeriod'])){
            $paymentPeriod = $_POST['paymentPeriod'];
        }
        switch($paymentPeriod){
                case 'Annual':
                     $this->tpl->set_var("checkedAnnual","checked");
                     break;
                case 'Q1':
                     $this->tpl->set_var("checkedQ1","checked");
                     break;
                case 'Q2':
                     $this->tpl->set_var("checkedQ2","checked");
                     break;
                case 'Q3':
                     $this->tpl->set_var("checkedQ3","checked");
                     break;
                case 'Q4':
                     $this->tpl->set_var("checkedQ4","checked");
                     break;
                default:
                     break;
        }
        $this->tpl->set_var($formValues);
        ## Compute taxes and set the page values
        $basic = $taxDue->getBalanceBasic($paymentPeriod);
        $sef = $taxDue->getBalanceSEF($paymentPeriod);
        $interest = $taxDue->computePenalty($paymentPeriod);
        $taxValues['basic'] = number_format($basic,2);
        $taxValues['sef']   = number_format($sef,2);
        $taxValues['pd1185']= number_format(0.00,2);
        $taxValues['subTotal'] = number_format($basic+$sef,2);
        $taxValues['periodTotal'] = number_format($basic+$sef,2);
        $taxValues['discount'] = "0.0%";
        $taxValues['interest'] = number_format($interest * 100.00,1)."%";
        $taxValues['totBasic'] = number_format($basic*(1+$interest),2);
        $taxValues['totSEF']  = number_format($sef*(1+$interest),2);
        $taxValues['totPD1185'] = number_format(0,2);
        $taxValues['totSubTotal'] = number_format(($basic + $sef)*(1+$interest),2);
        $taxValues['grandTotal'] = number_format(($basic + $sef)*(1+$interest),2);
        # further breakdown of basic tax for RPT Receipt
        $taxValues['gf'] = number_format($basic * 0.7,2); // 70% of basic
        $taxValues['ib'] = number_format($basic * 0.15,2); // 15% of basic
        $taxValues['cb'] = number_format($basic * 0.15,2); // 15% of basic for a total if 100%
        $taxValues['totGF'] = number_format($basic * 0.7 * (1+$interest),2);
        $taxValues['totIB'] = number_format($basic * 0.15 * (1+$interest),2);
        $taxValues['totCB'] = number_format($basic * 0.15 * (1+$interest),2);
        
        $this->tpl->set_var($taxValues);
        if(!isset($_POST['printReceipt_x']))
            $this->tpl->set_var("Session", $sess->url(""));

    }
   function showReceipt($preprinted){
        if($preprinted){
            $this->tpl->set_file(array('step3' => 'PayRPTOP3.htm',
                                 'receipt' =>'pprptreceipt.xml'));
        }
        else {
            $this->tpl->set_file(array('step3' => 'PayRPTOP3.htm',
                                 'receipt' =>'rptreceipt.xml'));
        }
        # get all the details from the page
        if(isset($_POST['tdID']))
            $this->setDetails();
        $this->tpl->set_var('ownerAddress',strip_tags($this->tpl->get("ownerAddress")));
        $this->tpl->parse('OUT','receipt');
        $this->tpl->finish('OUT');
        $rptrpdf = new PDFWriter;
        $rptrpdf->setOutputXML($this->tpl->get("OUT"),"string");
        $rptrpdf->writePDF("rptr.pdf");
        // echo to browser
        // $tpl->p('OUT');
    }
}
# using session, reinstantiate the object otherwise create a new object

$RPTRReceipt = new RPTRPrint();
$RPTRReceipt->main();
?>