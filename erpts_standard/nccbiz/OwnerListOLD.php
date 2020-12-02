<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/TDRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";
include_once "../includes/assessor/AFS.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('OwnerList');
$server->handle();
//*/
class OwnerList
{
    function OwnerList(){
		
    }
    
    function getOwnerList($ownerID) {
		$ownerRecords = new OwnerRecords;
		$ownerRecords->selectRecord($ownerID);
		if(!$domDoc = $ownerRecords->getDomDocument()){
			$ret  = false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			$ret = $xmlStr;
		}
		return $ret;
	}
	
	function deleteOwner($ownerIDArray){
		$ownerRecords = new OwnerRecords;
		$rows = $ownerRecords->deleteRecords($personIDArray);
		return $rows;
	}
	
	function addOwnerPerson($ownerID,$personIDArray){
		$owner = new Owner;
		$owner->selectRecord($ownerID);
		$ctr = 0;
		foreach($personIDArray as $key => $value){
			$owner->deleteOwnerPerson($value);
			$owner->insertOwnerPerson($ownerID,$value);
		}
		$ret = $ctr;
		return $ret;
	}
    function removeOwnerPerson($ownerID, $personIDArray){
		$ownerRecords = new OwnerRecords;
		$rows = $ownerRecords->removeOwnerPersonRecords($ownerID, $personIDArray);
		return $rows;
	}
	function addOwnerCompany($ownerID,$companyIDArray){
		$owner = new Owner;
		$owner->selectRecord($ownerID);
		$ctr = 0;
		foreach($companyIDArray as $key => $value){
			$owner->deleteOwnerCompany($value);
			$owner->insertOwnerCompany($ownerID,$value);
		}
		$ret = $ctr;
		return $ret;
	}
	function removeOwnerCompany($ownerID, $personIDArray){
		$ownerRecords = new OwnerRecords;
		$rows = $ownerRecords->removeOwnerCompanyRecords($ownerID, $personIDArray);
		return $rows;
	}
	
	function removeOwnerRPTOP($rptopID, $ownerID, $personIDArray=false, $companyIDArray=false){
		$owner = new Owner;
		$owner->selectRecord($ownerID);
		$ctr = 0;
		$refreshArr = "";
		$ownerPersonIDArray = $owner->getPersonIDArray();
		$ownerCompanyIDArray = $owner->getCompanyIDArray();

		//*
		if ($personIDArray){
			foreach($personIDArray as $key => $value){
				$owner->deleteOwnerPerson($value);
				//$rptop = new RPTOP;
				//$rptop->selectRecordForList($rptopID);
				//$year = $rptop->getTaxableYear();
				//$tdIDArray = $this->getTDListOf($value,"Person",$year);
				//foreach ($tdIDArray as $tdKey => $tdValue){
				//	$rptop->deleteRptopTd($rptopID,$tdValue);
				//$ctr++;
				//}
				//unset($rptop);
			}
			$ownerPersonIDArray = array_diff($ownerPersonIDArray,$personIDArray);
		}
		
		if ($companyIDArray){
			foreach($companyIDArray as $key => $value){
				$owner->deleteOwnerCompany($value);
				//$rptop = new RPTOP;
				//$rptop->selectRecordForList($rptopID);
				//$year = $rptop->getTaxableYear();
				//$tdIDArray = $this->getTDListOf($value,"Company",$year);
				//foreach ($tdIDArray as $tdKey => $tdValue){
				//	$rptop->deleteRptopTd($rptopID,$tdValue);
				//$ctr++;
				//}
				//unset($rptop);
			}
			$ownerCompanyIDArray = array_diff($ownerCompanyIDArray,$companyIDArray);
		}//*/
		//echo "personArray<br>";
		//print_r($ownerPersonIDArray);
		//echo "<br>companyArray<br>";
		//print_r($ownerCompanyIDArray);
		//echo "<br><br>";
		$rptopRecords = new RPTOPRecords;
		$ret = $rptopRecords->deleteRPTOPTD($rptopID);
		//if ($personIDArray) $ownerPersonIDArray = array_diff($ownerPersonIDArray,$personIDArray);
		//if ($companyIDArray) $ownerCompanyIDArray = array_diff($ownerCompanyIDArray,$companyIDArray);
		if (is_array($ownerPersonIDArray)) $this->addOwnerPersonRPTOP($rptopID,$ownerID,$ownerPersonIDArray);
		if (is_array($ownerCompanyIDArray)) $this->addOwnerCompanyRPTOP($rptopID,$ownerID,$ownerCompanyIDArray);
		unset($owner);
		$ret = $ctr;
		return $ret;
	}
		
	function addOwnerPersonRPTOP($rptopID,$ownerID,$personIDArray){
		$owner = new Owner;
		$owner->selectRecord($ownerID);
		$ctr = 0;
		//if ()
		foreach($personIDArray as $key => $value){
			//echo $value."<br>";
			$owner->deleteOwnerPerson($value);
			$owner->insertOwnerPerson($ownerID,$value);
			$rptop = new RPTOP;
			$rptop->selectRecordForList($rptopID);
			$year = $rptop->getTaxableYear();
			$tdIDArray = $this->getTDListOf($value,"Person",$year);
			foreach ($tdIDArray as $tdKey => $tdValue){
				//echo $tdValue."<br>";
				$rptop->insertRptopTd($rptopID,$tdValue);
				$ctr++;
			}
			unset($rptop);
		}
		unset($owner);
		$ret = $ctr;
		return $ret;
	}
	function addOwnerCompanyRPTOP($rptopID,$ownerID,$companyIDArray){
		$owner = new Owner;
		$owner->selectRecord($ownerID);
		$ctr = 0;
		foreach($companyIDArray as $key => $value){
			$owner->deleteOwnerCompany($value);
			$owner->insertOwnerCompany($ownerID,$value);
			$rptop = new RPTOP;
			$rptop->selectRecordForList($rptopID);
			$year = $rptop->getTaxableYear();
			$tdIDArray = $this->getTDListOf($value,"Company",$year);
			foreach ($tdIDArray as $tdKey => $tdValue){
				//echo $tdValue."<br>";
				$rptop->insertRptopTd($rptopID,$tdValue);
				$ctr++;
			}
			unset($rptop);
		}
		unset($owner);
		$ret = $ctr;
		return $ret;
	}
	function getTDListOf($id,$type,$year){
		$owner = new Owner;
		//echo("\$ownerIDArray = \$owner->selectOwner".$type."(".$id.");");
		eval("\$ownerIDArray = \$owner->selectOwner".$type."(".$id.");");
		if ($ownerIDArray){
			$odArray = "";
			foreach ($ownerIDArray as $key => $value){
				eval("\$odID = \$owner->selectOD".$type."($value);");
				if ($odID) $odArray[] = $odID;
			}
			unset($owner);
			if ($odArray){
				$afsArray = "";
				foreach($odArray as $key => $value){
					$afs = new AFS;
					$afsIDArray[] = $afs->checkAfsID($value);
				}
				unset($afs);
				if ($afsIDArray){
					$tdRecords = new TDRecords;
					$tdIDArray = "";
					foreach ($afsIDArray as $tkey => $tvalue){
						$td = new TD;
						if ($td->selectRecord("",$tvalue,"","",$year)){
							$tdIDArray[] = $td->getTdID();
						}
						unset($td);
						/*
						$afs = new AFS;
						$afs->selectRecord($tvalue);
						//print_r($afs);
						//echo "<br>";
						$landArray = $afs->getLandArray();
						$plantsTreesArray = $afs->getPlantsTreesArray();
						$improvementsBuildingsArray = $afs->getImprovementsBuildingsArray();
						$machineriesArray = $afs->getMachineriesArray();
						unset($afs);
						if ($landArray){
							foreach($landArray as $lkey => $lvalue){
								//echo($lvalue->getPropertyID()."<br>");
								$td = new TD;
								if ($td->selectRecord("",$lvalue->getPropertyID(),"Land",$year)){
									$tdRecords->setArrayList($td);
									$tdIDArray[] = $td->getTdID();
								}
								unset($td);
							}
						}
						if ($plantsTreesArray){
							foreach($plantsTreesArray as $lkey => $lvalue){
								//echo($lvalue->getPropertyID()."<br>");
								$td = new TD;
								if ($td->selectRecord("",$lvalue->getPropertyID(),"PlantsTrees",$year)){
									$tdRecords->setArrayList($td);
									$tdIDArray[] = $td->getTdID();
								}
								unset($td);
							}
						}
						if ($improvementsBuildingsArray){
							foreach($improvementsBuildingsArray as $lkey => $lvalue){
								//echo($lvalue->getPropertyID()."<br>");
								$td = new TD;
								if ($td->selectRecord("",$lvalue->getPropertyID(),"ImprovementsBuildings",$year)){
									$tdRecords->setArrayList($td);
									$tdIDArray[] = $td->getTdID();
								}
								unset($td);
							}
						}
						if ($machineriesArray){
							foreach($machineriesArray as $lkey => $lvalue){
								//echo($lvalue->getPropertyID()."<br>");
								$td = new TD;
								if ($td->selectRecord("",$lvalue->getPropertyID(),"Machineries",$year)){
									$tdRecords->setArrayList($td);
									$tdIDArray[] = $td->getTdID();
								}
								unset($td);
							}
						}*/
					}
					$ret = $tdIDArray;
					//print_r($tdRecords->getArrayList());
					/*if ($tdRecords->getArrayList()){
						$tdRecords->setDomDocument();
						if(!$domDoc = $tdRecords->getDomDocument()){
							return $ret = false;
						}
						else {
							$xmlStr = $domDoc->dump_mem(true);
							return $ret = $xmlStr;
						}
					}
					else $ret = false;*/
				}
				else $ret = false;
			}
			else $ret = false;
		}
		else $ret = false;
		return  $ret;
	}
}
/*
$obj = new OwnerList;
//echo "<br>hello->".$obj->removeOwnerPerson(1,array("1"=>38,"2"=>39));
//echo $obj->addOwnerPersonRPTOP(55,122,Array(17));
$pArr  = Array(10722);
$cArr = "";
echo $obj->removeOwnerRPTOP(4,10545,$pArr,$cArr);
//echo $obj->removeOwnerRPTOP(55,122,Array(17),Array(39));
//echo "mukha mo!";
//*/
?>