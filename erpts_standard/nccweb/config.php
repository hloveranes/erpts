<?
class Config{
	var $statements;
	
	function Config(){
		$this->statements=array();
		
		$this->statements["connectionstring"]="host=localhost user=root password=palitanmoto database=erpts_standard";
		
		$this->statements["personowners"]="select t1.odID, t2.ownerID, t3.personID, t4.personType,
									t4.firstName,t4.middleName,t4.lastName 
										from OD t1, Owner t2, OwnerPerson t3, Person t4
											where t1.odID=t2.odID and t3.ownerID=t2.ownerID and
											t4.personID=t3.personID and t1.odID=%s";

		$this->statements["companyowners"]="select t1.odID, t1.ownerID, t2.landArea, t3.companyID, 
											t4.companyName, t4.tin 
												from Owner t1, OD t2, OwnerCompany t3, Company t4
													where t1.odID=t2.odID and t3.ownerID=t1.ownerID 
													and t4.companyID=t3.companyID and t2.odID=%s";
													
		$this->statements["rpus"]="SELECT t1.odID,t2.afsID,  t1.lotNumber, 
				LPAD(FORMAT(t2.totalMarketValue,2),15,' ') totalMarketValue, 
				LPAD(FORMAT(t2.totalAssessedValue,2),15,' ') totalAssessedValue, 
				t3.taxDeclarationNumber, t2.propertyIndexNumber,
				t2.arpNumber, t2.propertyIndexNumber
				FROM OD t1, AFS t2, TD t3
				WHERE t1.odID = t2.odID and t3.afsID=t2.afsID and t1.lotNumber like '%s' limit %s,%s";
	
		$this->statements["personrptops"]="select RPTOP.taxableYear, RPTOP.rptopID,  
				 LPAD(FORMAT(RPTOP.totalMarketValue,2),15,' ') totalMarketValue, totalMarketValue marketValue,
				 LPAD(FORMAT(RPTOP.totalAssessedValue,2),15,' ') totalAssessedValue, totalAssessedValue assdValue,
				 concat(Person.lastName, ', ', Person.firstName, ' ', Person.middleName) as ownerName
				 from RPTOP, Owner, OwnerPerson, Person
				 where RPTOP.rptopID = Owner.rptopID and Owner.ownerID = OwnerPerson.ownerID and
				 Person.personID = OwnerPerson.personID and 
				 %s order by Person.lastName, Person.firstName, Person.middleName
				 limit %s,%s ";
	
		$this->statements["personrptopscount"]="select count(RPTOP.rptopID) as numRecs
				from RPTOP, Owner, OwnerPerson, Person
				where RPTOP.rptopID = Owner.rptopID and Owner.ownerID = OwnerPerson.ownerID
				and Person.personID = OwnerPerson.personID and %s";
	
		$this->statements["companyrptops"]="select RPTOP.taxableYear, RPTOP.rptopID,  
				 LPAD(FORMAT(RPTOP.totalMarketValue,2),15,' ') totalMarketValue, totalMarketValue marketValue,
				 LPAD(FORMAT(RPTOP.totalAssessedValue,2),15,' ') totalAssessedValue,totalAssessedValue assdValue,
				 Company.companyName as ownerName
				 from RPTOP, Owner, OwnerCompany, Company
				 where RPTOP.rptopID = Owner.rptopID and Owner.ownerID = OwnerCompany.ownerID and
				 Company.companyID = OwnerCompany.companyID and 
				 %s order by Company.companyName
				 limit %s,%s ";
	
		$this->statements["companyrptopscount"]="select count(RPTOP.rptopID) as numRecs
				from RPTOP, Owner, OwnerCompany, Company
				where RPTOP.rptopID = Owner.rptopID and Owner.ownerID = OwnerCompany.ownerID
				and Company.companyID = OwnerCompany.companyID and %s";

		$this->statements["tdrptops"]="select RPTOP.taxableYear, RPTOP.rptopID,  
				 LPAD(FORMAT(RPTOP.totalMarketValue,2),15,' ') totalMarketValue, totalMarketValue marketValue,
				 LPAD(FORMAT(RPTOP.totalAssessedValue,2),15,' ') totalAssessedValue, totalAssessedValue assdValue,
				 TD.taxDeclarationNumber
				 from RPTOP, RPTOPTD, TD
				 where RPTOP.rptopID = RPTOPTD.rptopID and RPTOPTD.tdID = TD.tdID and
				 %s order by TD.taxDeclarationNumber
				 limit %s,%s ";
/*	
		$this->statements["tdrptops"]="select RPTOP.taxableYear, RPTOP.rptopID,  
				 LPAD(FORMAT(RPTOP.totalMarketValue,2),15,' ') totalMarketValue, totalMarketValue marketValue,
				 LPAD(FORMAT(RPTOP.totalAssessedValue,2),15,' ') totalAssessedValue, totalAssessedValue assdValue,
				 TD.taxDeclarationNumber
				 from RPTOP
				 left join RPTOPTD on RPTOP.rptopID = RPTOPTD.rptopID
				 left join TD on RPTOPTD.tdID = TD.tdID
				 where %s order by TD.taxDeclarationNumber
				 limit %s,%s ";
*/
		$this->statements["tdrptopscount"]="select count(RPTOP.rptopID) as numRecs
				from RPTOP, RPTOPTD, TD
				where RPTOP.rptopID = RPTOPTD.rptopID and RPTOPTD.tdID = TD.tdID
				and %s";

	
		$this->statements["companydues"]="select RPTOP.rptopID,  
				 LPAD(FORMAT(RPTOP.totalMarketValue,2),15,' ') totalMarketValue,
				 LPAD(FORMAT(RPTOP.totalAssessedValue,2),15,' ') totalAssessedValue,
				 Company.companyName as ownerName,
				 Dues.basicTax, Dues.sefTax, Dues.idleTax
				 from RPTOP, RPTOPTD, Owner, OwnerCompany, Company
				 left join Due on RPTOPTD.tdID = Due.tdID and Due.dueDate and Due.dueType = 'Annual'
				 where RPTOP.rptopID = RPTOPTD.rptopID and RPTOP.rptopID = Owner.rptopID and
				 Owner.ownerID = OwnerCompany.ownerID and
				 Company.companyID = OwnerCompany.companyID and 
				 %s order by Company.companyName
				 limit %s,%s ";
	
	}
	

	function getConfig($index){
		return $this->statements[$index];
	}	
}


class TreasSettingsFactory extends DBFactory{
	  var $rsowners;
	  

      function TreasSettingsFactory($connectionstring,$sql){
	           //print $sql;
	           //$this->rsowners=new Recordset();
	           
               $this->rs=new Recordset($connectionstring);
               $success= $this->rs->open($sql);              
      }

      function fetchTreasSetting(){
               $record=parent::fetchCurrent();           
               $objRPTOP=new TreasSetting($record);
               return $objRPTOP;
      }
      

}


class TreasSettings {
	var $rptop;
	var $db;
	var $config;
	var $filter="";
	
	function TreasSettings() {
	    $start--;
		$this->config=new Config;
		$sql="select * from TreasurySettings";
		$connectionstring=$this->config->getConfig("connectionstring");
		$this->db=new TreasSettingsFactory($connectionstring,$sql);		
	}

	function fetch(){
		$record=$this->db->fetchObject();
		return $record;
	}
	
	function fetchNext(){
		$this->db->fetchNext();
	}
	
	function fetchTreasSetting(){
		$this->rptop=$this->db->fetchTreasSetting();
        return $this->rptop;
	}
	
	function EOL(){
		return $this->db->EOL();
	}

}

class TreasSetting{

	function TreasSetting($arrayRPTOP){
        foreach($arrayRPTOP as $k=>$field){
        	$this->{$k}=$field;
        }
	}
	
	function toArray(){		
		return get_object_vars($this);
	}
	
	function setTD($objTD){
		$this->td=$objTD;	
	}
	
	
}

?>
