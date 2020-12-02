<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";
include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";
include_once "../includes/collection/dues.php";


#####################################
# Define Interface Class
#####################################
class RPTOPList{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function RPTOPList($sess,$http_post_vars){
		$this->tpl = new rpts_Template(getcwd());
		$this->tpl->set_file("rptsTemplate", "ViewSOA1.htm") ;
				
		$this->sess = $sess;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		#echo("munID=".$this->formArray[municipalityCityID]."<br>");
	}
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
		
	function Main(){

		$this->formArray['currentDate'] = date("F d, Y");
		$MunicipalityCityDetails = new SoapObject(NCCBIZ."MunicipalityCityDetails.php", "urn:Object");		
		#test values
		//$this->formArray['municipalityCityID']=1;
		
		if (!$xmlStr = $MunicipalityCityDetails->getMunicipalityCityDetails($this->formArray['municipalityCityID'])){
			#echo($xmlStr);
			//exit("xml failed for municipality");
			header("Location: ".$this->sess->url("ViewSOA.php")."&status=2");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				echo("error xmlDoc");
			}
			else {
				$MunicipalityCity = new MunicipalityCity;
				$MunicipalityCity->parseDomDocument($domDoc);
				$this->formArray['municipality'] = $MunicipalityCity->getDescription();
			}
		}

		#test values
		//$this->formArray['ownerID']=5;
		#echo("ownerID=".$this->formArray['ownerID']."<br>");
//			$this->displayOwnerList($this->formArray['ownerID']);

		#test values
		//$this->formArray["rptopID"]=15;
		if($this->formArray['personID'] != ""){
			$person = new Person();
			$person->selectRecord($this->formArray['personID']);
			$this->tpl->set_var(ownerName,$person->getFullName());
			$this->tpl->set_var(ownerNo,$person->getTin());
			$address = $person->addressArray[0];
			$this->tpl->set_var(ownerAddress,$address->getNumber() ." ".$address->getStreet()." ".$address->getBarangay()." ".$address->getDistrict()." ".$address->getMunicipalitycity()." ".$address->getProvince());
			$db = new DB_RPTS();
			$sql = "SELECT rptopID FROM Owner inner join OwnerPerson on Owner.ownerID=OwnerPerson.ownerID WHERE Owner.rptopID <> '' AND OwnerPerson.personID=".$this->formArray['personID'];
			$db->query($sql);
		}else{
			$company = new Company();
			$company->selectRecord($this->formArray['companyID']);
			$this->tpl->set_var(ownerName,$company->getCompanyName());
			$this->tpl->set_var(ownerNo,$company->getCompanyID());
			$address = $company->addressArray[0];
			$this->tpl->set_var(ownerAddress,$address->getNumber() ." ".$address->getStreet()." ".$address->getBarangay()." ".$address->getDistrict()." ".$address->getMunicipalitycity()." ".$address->getProvince());
			$db = new DB_RPTS();
			$sql = "SELECT rptopID FROM Owner inner join OwnerPerson on Owner.ownerID=OwnerPerson.ownerID WHERE Owner.rptopID <> '' AND OwnerPerson.personID=".$this->formArray['companyID'];
			$db->query($sql);
		}

		/*$person = new Person();
		$person->selectRecord($this->formArray['personID']);
		$this->tpl->set_var(ownerName,$person->getFullName());
		$this->tpl->set_var(ownerNo,$person->getTin());
		$address = $person->addressArray[0];
		$this->tpl->set_var(ownerAddress,$address->getNumber() ." ".$address->getStreet()." ".$address->getBarangay()." ".$address->getDistrict()." ".$address->getMunicipalitycity()." ".$address->getProvince());
		$db = new DB_RPTS();

		$sql = "SELECT rptopID FROM Owner inner join OwnerPerson on Owner.ownerID=OwnerPerson.ownerID WHERE Owner.rptopID <> '' AND OwnerPerson.personID=".$this->formArray['personID'];
		$db->query($sql);*/
		$this->tpl->set_block("rptsTemplate","ROW","RowBlk");	
		for($i=0;$db->next_record();$i++){
			$rptopID = $db->f("rptopID");
				$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
				if (!$xmlStr = $RPTOPDetails->getRPTOP($rptopID)){
				//	exit("xml failed for RPTOP");
					header("Location: ".$this->sess->url("ViewSOA.php")."&status=1");
				}else{
			//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
					$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
					$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
					}else {
						$rptop = new RPTOP;
						$td = new TD();
						$rptop->parseDomDocument($domDoc);

						foreach($rptop as $key => $value){
							$this->formArray['payableYear'] = $rptop->getTaxableYear();
							$rptopID = $rptop->getRptopID();
							
							if($key=="tdArray"){
								$tdCtr = 0;
								if (count($value)){										
									foreach($value as $tkey => $tvalue){			
										$td->selectRecord($tvalue->getTdID());
										$assessedValue = number_format($td->getAssessedValue(),2,".","");
										$propertyType = $td->getPropertyType();
										$TaxDeclarationNumber = $td->getTaxDeclarationNumber();
//										$this->tpl->set_var(kind,$propertyType);
//										$this->tpl->set_var(currentTDNo,$TaxDeclarationNumber);

/*									$dues = new Dues();
									$dues->create($td->getTdID(), "","","","2003");
									$this->tpl->set_var(basic,$dues->getBasic());
									$totBasic += $dues->getBasic();
									$this->tpl->set_var(sef,$dues->getSEF());
									$totSEF += $dues->getSEF();
									$this->tpl->set_var(total,$dues->getSEF()+$dues->getBasic());
									$totTaxDue += $dues->getSEF()+$dues->getBasic();*/
										$afsID = $td->getAfsID();
										$afs = new AFS();
										$afs->selectRecord($afsID);
										$od = new OD();
										$od->selectRecord($afs->getOdID());
										$addr = $od->getLocationAddress();
										
		  				 					if(count($addr)){
											$location = $addr->getFullAddress();
//												$this->tpl->set_var(location,$addr->getFullAddress());
												$munCityID = $addr->getMunicipalityCityID();											
//											if($munCityID == $this->formArray['municipalityCityID'])
//												$this->tpl->set_var(municipality,$addr->getMunicipalityCity());
											}
											if(count($afs->landArray)){
												foreach($afs->landArray as $afsKey => $afsValue){
													$actualUse = $afsValue->getActualUse();
													$landActualUses = new LandActualUses();
													$landActualUses->selectRecord($actualUse);
													//$this->tpl->set_var("class",$landActualUses->getCode());
													$Code = $landActualUses->getCode();
												}
											}
											if(count($afs->improvementsBuildingsArray)){
												foreach($afs->improvementsBuildingsArray as $afsKey => $afsValue){
													$actualUse = $afsValue->getActualUse();
													$improvementsBuildingsActualUses = new improvementsBuildingsActualUses();
													$improvementsBuildingsActualUses->selectRecord($actualUse);
													//$this->tpl->set_var("class",$improvementsBuildingsActualUses->getCode());
													$Code = $improvementsBuildingsActualUses->getCode();
												}
											}
									//echo $afs->get
//											echo $munCityID ."==". $this->formArray['municipalityCityID']."<br>";
											if($munCityID == $this->formArray['municipalityCityID']){
												$this->tpl->set_var(location,$location);
												$this->tpl->set_var("class",$Code);
												$this->tpl->set_var(kind,$propertyType);
												$this->tpl->set_var(currentTDNo,$TaxDeclarationNumber);
												$this->tpl->set_var(municipality,$addr->getMunicipalityCity());
												$dues = new Dues();
												$dues->create($td->getTdID(), "","","","2003");
												$totTaxDue += $dues->getSEF()+$dues->getBasic();
												$basic = number_format($dues->getBasic(),"2",".","");
												$this->tpl->set_var(basic,$basic);												
												$totBasic += $basic;
												$sef = number_format($dues->getSEF(),"2",".","");
												$this->tpl->set_var(sef,$sef);
												$totSEF += number_format($sef,"2",".","");
												$this->tpl->set_var(total,number_format($sef+$basic,"2",".",""));
												$this->tpl->set_var(marketValue,number_format($afs->getTotalMarketValue(),2));
												$totMarketValue += $afs->getTotalMarketValue();
												$this->tpl->set_var(assessedValue,number_format($afs->getTotalAssessedValue(),2));
												$totAssessedValue += $afs->getTotalAssessedValue();																
												$pIndexNo = $afs->getPropertyIndexNumber();
													if($pIndexNo==""){
														$pIndexNo = "No value specified";	
													}
												$this->tpl->set_var(pin,$pIndexNo);			
									//echo $afs->getTotalMarketValue();
/*									if(count($afs->landArray)){
										foreach($afs->landArray as $afsKey => $afsValue){
											$this->tpl->set_var(pin,$afsValue->getPropertyIndexNumber());
										}
								}							
*/												$this->tpl->parse("RowBlk","ROW",true);
											}//else{
	//											$this->tpl->set_var("RowBlk","");
		//								}
								}#end foreach($value)						
							}#end if coun value
				
							$this->tpl->set_var(totalMarketValue,number_format($totMarketValue,2));
							$this->tpl->set_var(totalAssessedValue,number_format($totAssessedValue,2));
							$this->tpl->set_var(totalBasic,number_format($totBasic,2));
							$this->tpl->set_var(totalSEF,number_format($totSEF,2));
							$this->tpl->set_var(totalTaxDue,number_format($totTaxDue,2));
						}
					}
				}
//				$this->tpl->parse("RowBlk","ROW",true);
			}		
							
		}
//		$owner
/*		$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
		if (!$xmlStr = $RPTOPDetails->getRPTOP($this->formArray["rptopID"])){
			//exit("xml failed for RPTOP");
			header("Location: ".$this->sess->url("ViewSOA.php")."&status=1");
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$rptop = new RPTOP;
				$td = new TD();
				$rptop->parseDomDocument($domDoc);
				$status_report = "";
				foreach($rptop as $key => $value){
					$this->formArray['payableYear'] = $rptop->getTaxableYear();
					$rptopID = $rptop->getRptopID();
					if($key=="tdArray"){
						$tdCtr = 0;
							if (count($value)){	
							$this->tpl->set_block("rptsTemplate","ROW","RowBlk");	
								foreach($value as $tkey => $tvalue){			
									$td->selectRecord($tvalue->getTdID());

									$assessedValue = number_format($td->getAssessedValue(),2,".","");
									$propertyType = $td->getPropertyType();
									$TaxDeclarationNumber = $td->getTaxDeclarationNumber();
									//$tdCtr++;
									$this->tpl->set_var(kind,$propertyType);
									$this->tpl->set_var(currentTDNo,$TaxDeclarationNumber);

/*									$dues = new Dues();
									$dues->create($td->getTdID(), "","","","2003");
									$this->tpl->set_var(basic,$dues->getBasic());
									$totBasic += $dues->getBasic();
									$this->tpl->set_var(sef,$dues->getSEF());
									$totSEF += $dues->getSEF();
									$this->tpl->set_var(total,$dues->getSEF()+$dues->getBasic());
									$totTaxDue += $dues->getSEF()+$dues->getBasic();*/
	/*								$afsID = $td->getAfsID();
									$afs = new AFS();
									$afs->selectRecord($afsID);
									$od = new OD();
									$od->selectRecord($afs->getOdID());
									$addr = $od->getLocationAddress();
									if(count($addr)){
									$this->tpl->set_var(location,$addr->getFullAddress());
									$munCityID = $addr->getMunicipalityCityID();
										if($munCityID == $this->formArray['municipalityCityID'])
										$this->tpl->set_var(municipality,$addr->getMunicipalityCity());
									}
									if(count($afs->landArray)){
										foreach($afs->landArray as $afsKey => $afsValue){
											$actualUse = $afsValue->getActualUse();
											$landActualUses = new LandActualUses();
											$landActualUses->selectRecord($actualUse);
											$this->tpl->set_var("class",$landActualUses->getCode());
										}
									}
									if(count($afs->improvementsBuildingsArray)){
										foreach($afs->improvementsBuildingsArray as $afsKey => $afsValue){
											$actualUse = $afsValue->getActualUse();
											$improvementsBuildingsActualUses = new improvementsBuildingsActualUses();
											$improvementsBuildingsActualUses->selectRecord($actualUse);
											$this->tpl->set_var("class",$improvementsBuildingsActualUses->getCode());
										}
									}
									//echo $afs->get

									if($munCityID == $this->formArray['municipalityCityID']){
									$dues = new Dues();
									$dues->create($td->getTdID(), "","","","2003");
									$this->tpl->set_var(basic,number_format($dues->getBasic(),"2",".",""));
									$totBasic += $dues->getBasic();
									$this->tpl->set_var(sef,number_format($dues->getSEF(),"2",".",""));
									$totSEF += $dues->getSEF();
									$this->tpl->set_var(total,number_format($dues->getSEF()+$dues->getBasic(),"2",".",""));
									$pIndexNo = $afs->getPropertyIndexNumber();
									if($pIndexNo==""){
										$pIndexNo = "No value specified";	
									}
									$this->tpl->set_var(pin,$pIndexNo);
									
									$this->tpl->set_var(marketValue,$afs->getTotalMarketValue());
									$totMarketValue += $afs->getTotalMarketValue();
									$this->tpl->set_var(assessedValue,$afs->getTotalAssessedValue());
									$totAssessedValue += $afs->getTotalAssessedValue();																
									//echo $afs->getTotalMarketValue();
/*									if(count($afs->landArray)){
										foreach($afs->landArray as $afsKey => $afsValue){
											$this->tpl->set_var(pin,$afsValue->getPropertyIndexNumber());
										}
									}							
*/	/*								$this->tpl->parse("RowBlk","ROW",true);
								}else{
								$this->tpl->set_var("RowBlk","");
								}
								}#end foreach($value)						
							}#end if coun value

//				$this->tpl->set_block("rptsTemplate","STAT",sBlk);
//				$this->tpl->set_var(status_report,$status_report);
//				$this->tpl->parse(sBlk,"STAT",true);
							
							$this->tpl->set_var(totalMarketValue,$totMarketValue);
							$this->tpl->set_var(totalAssessedValue,$totAssessedValue);
							$this->tpl->set_var(totalBasic,$totBasic);
							$this->tpl->set_var(totalSEF,$totSEF);
							$this->tpl->set_var(totalTaxDue,$totTaxDue);
					}
				}
				
			}
		}*/		
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url(""));
		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		$this->tpl->p("templatePage");
	}

}

#####################################
# Define Procedures and Functions
#####################################

##########################################################
# Begin Program Script
##########################################################
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
if(!$page) $page = 1;
$rptopList = new RPTOPList($sess,$HTTP_POST_VARS);
$rptopList->main();
?>
<?php page_close(); ?>
