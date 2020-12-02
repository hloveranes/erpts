<?php
# To get the SOA you need the Person
  $sqlSelectPerson = "SELECT personID from Person";
# For each person, find all his current TD's
  $sqlSelectPersonProperty = "SELECT propertyID from PersonProperty where PersonID = 'PersonID'";
# For each TD,
#     get the years of TD's Validity
      $startYear, $endYear
#     for each year
#         compute the balance  (Basic, SEF) and penalty
          $due = new Due (TD, Year);
          $due->getBalance();
#     if first year has outstanding balance
#     recursively check all the past TD's
      check($cancelsTD);
#     stop when TD has been fully paid for all years
# make a list of TD,Year,Balance (Basic, SEF, Penalty, Cancels)
?>

get all the current TD's
	owned by a personID
	by land
		TD property afs od owner ownerPerson
		select tdID
		from TD
		where cancelled by = '' and propertyType = 'Land' and propertyID
			in (select propertyID
				from property
				SELECT AFSID
				FROM AFS, OD, Owner, OwnerPerson, Person
				WHERE AFS.ODID = OD.ODID AND OD.odID = Owner.odID AND Owner.OwnerID = OwnerPerson.OwnerID AND OwnerPerson.PersonID = Person.PersonID AND Person.PersonID =  '1';
				
SELECT  *
FROM TD left join Land  using (propertyid) LEFT JOIN AFS using (AFSID) LEFT JOIN OD using (ODID) LEFT JOIN Owner using (ODID) LEFT JOIN OwnerPerson using (OwnerID)
LEFT  JOIN Person
USING ( PersonID)

SELECT  tdID, TD.PropertyID, Land.PropertyID, Land.AFSID,AFS.AFSID, AFS.ODID, OD.ODID,Owner.odID, Owner.OwnerID, OwnerPerson.OwnerID, OwnerPerson.PersonID,Person.PersonID
FROM TD left join Land  using (propertyid) LEFT JOIN AFS using (AFSID) LEFT JOIN OD using (ODID) LEFT JOIN Owner using (ODID) LEFT JOIN OwnerPerson using (OwnerID)
LEFT  JOIN Person
USING ( PersonID)

SELECT  tdID, TD.PropertyID, Land.PropertyID, Land.AFSID,AFS.AFSID, AFS.ODID, OD.ODID,Owner.odID, Owner.OwnerID, OwnerPerson.OwnerID, OwnerPerson.PersonID,Person.PersonID
FROM TD left join Land  using (propertyid) LEFT JOIN AFS using (AFSID) LEFT JOIN OD using (ODID) LEFT JOIN Owner using (ODID) LEFT JOIN OwnerPerson using (OwnerID)
LEFT  JOIN Person
USING ( PersonID)
WHERE Person.PersonID = '13' and propertyType='Land'
order by tdID
