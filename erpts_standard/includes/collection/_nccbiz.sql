# MySQL dump 8.14
#
# Host: localhost    Database: nccbiz
#--------------------------------------------------------
# Server version	3.23.41-log

#
# Table structure for table 'AFS'
#

DROP TABLE IF EXISTS AFS;
CREATE TABLE AFS (
  afsID int(11) NOT NULL auto_increment,
  odID int(11) default NULL,
  propertyIndexNumber varchar(50) default NULL,
  certificateOfTitleNumber varchar(50) default NULL,
  cadastralLotNumber varchar(50) default NULL,
  north varchar(50) default NULL,
  south varchar(50) default NULL,
  east varchar(50) default NULL,
  west varchar(50) default NULL,
  administrator int(4) default NULL,
  landTotalMarketValue varchar(32) default NULL,
  landTotalAssessedValue varchar(32) default NULL,
  plantTotalMarketValue varchar(32) default NULL,
  plantTotalAssessedValue varchar(32) default NULL,
  bldgTotalMarketValue varchar(32) default NULL,
  bldgTotalAssessedValue varchar(32) default NULL,
  machTotalMarketValue varchar(32) default NULL,
  machTotalAssessedValue varchar(32) default NULL,
  totalMarketValue varchar(32) default NULL,
  totalAssessedValue varchar(50) default NULL,
  previousOwner varchar(50) default NULL,
  dateEntered varchar(50) default NULL,
  assessorClerk varchar(50) default NULL,
  dateCreated varchar(32) NOT NULL default '',
  createdBy varchar(32) NOT NULL default '',
  dateModified varchar(32) NOT NULL default '',
  modifiedBy varchar(32) NOT NULL default '',
  PRIMARY KEY  (afsID),
  KEY odID (odID),
  KEY afsID (afsID)
) TYPE=MyISAM;

#
# Dumping data for table 'AFS'
#

LOCK TABLES AFS WRITE;
INSERT INTO AFS VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1124686.18','112996.79','242922.78','81784.52','3117.62','-1317.3','5050858.29','1993.66','6421584.87','195457.67',NULL,NULL,NULL,'1057807539','Randomizer','1057822406',''),(2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','0','0',NULL,NULL,NULL,'1057807558','Randomizer','1057807631',''),(3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'98765.47','4159.78','147593.43','27860.49','11115.54','-2324.28','5513146.16','4708.67','5770620.6','34404.66',NULL,NULL,NULL,'1057807882','Randomizer','1057812857',''),(4,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1057816249','Randomizer','1057816249','Randomizer'),(5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','0','0',NULL,NULL,NULL,'1057816640','','1057819821',''),(6,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'465','65.1','','','','','','','465','65.1',NULL,NULL,NULL,'1057820101','45','1057824507',''),(7,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1057826702','Randomizer','1057826702','Randomizer'),(8,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'15244','1676.84','','','','','','','15244','1676.84',NULL,NULL,NULL,'1057827533','45','1058771497','');
UNLOCK TABLES;

#
# Table structure for table 'Address'
#

DROP TABLE IF EXISTS Address;
CREATE TABLE Address (
  addressID int(11) NOT NULL auto_increment,
  number varchar(50) default NULL,
  street varchar(50) default NULL,
  barangay varchar(50) default NULL,
  district varchar(50) default NULL,
  municipalityCity varchar(50) default NULL,
  province varchar(50) default NULL,
  PRIMARY KEY  (addressID)
) TYPE=MyISAM;

#
# Dumping data for table 'Address'
#

LOCK TABLES Address WRITE;
INSERT INTO Address VALUES (1,'34','F.Makabulos St.','','','',''),(2,'101','T.Tecson Ave.','','','',''),(3,'176','Lapu-Lapu Blvd.','','','',''),(4,'152','L.Florentino Blvd.','','','',''),(5,'195','A.Mabini St.','','','',''),(6,'188','A.Mabini Ave.','','','',''),(7,'19','L.Rivera Blvd.','','','',''),(8,'119','A.Luna Ave.','','','',''),(9,'193','M.Ponce St.','','','',''),(10,'2','L.Rivera Ave.','','','',''),(11,'129','A.Luna Blvd.','','','',''),(12,'104','T.Tecson St.','','','',''),(13,'100','I.delos Reyes Rd.','','','',''),(14,'113','A.Mabini Rd.','','','',''),(15,'198','A.Esteban Rd.','','','',''),(16,'68','J.Rizal Blvd.','','','',''),(17,'103','A.Bonifacio Ave.','','','',''),(18,'139','G.Lopez-Jaena St.','','','',''),(19,'83','P.Pira Ave.','','','',''),(20,'136','F.Agoncillo Rd.','','','',''),(21,'49','F.Ma Guerrero Ave.','','','',''),(22,'9','F.Dagohoy Rd.','','','',''),(23,'20','M.Aquino Rd.','','','',''),(24,'29','M.Aquino Rd.','','','',''),(25,'11','J.Felipe St.','','','',''),(26,'79','F.Baltazar Rd.','','','',''),(27,'29','D.Silang St.','','','',''),(28,'156','M.Ponce Rd.','','','',''),(29,'178','T.Magbanua St.','','','',''),(30,'130','F.Agoncillo Rd.','','','',''),(31,'39','F.Makabulos Blvd.','','','',''),(32,'150','M.Aquino Blvd.','','','',''),(33,'102','R.Palma Ave.','','','',''),(34,'122','G.de Jesus Ave.','','','',''),(35,'43','A.Mabini St.','','','',''),(36,'11','11th Street','Onze','District II','Manila','Metro Manila'),(37,'3','A.Luna Ave.','Ubod','District I','Pasig City','Metro Manila'),(38,'138','I.delos Reyes Blvd.','Ubod','District I','Pasig City','Metro Manila'),(39,'195','M.Silang St.','Ubod','District I','Pasig City','Metro Manila'),(40,'19','M.Dizon Rd.','Ubod','District I','Pasig City','Metro Manila'),(41,'59','A.Bonifacio Ave.','Ubod','District I','Pasig City','Metro Manila'),(42,'51','E.Jacinto St.','Ubod','District I','Pasig City','Metro Manila'),(43,'23','Rajah Soliman Rd.','Ubod','District I','Pasig City','Metro Manila'),(44,'42','F.Dagohoy Rd.','Ubod','District I','Pasig City','Metro Manila'),(45,'48','M.Ponce St.','Ubod','District I','Pasig City','Metro Manila'),(46,'14','14th Street','Ubod','District I','Pasig City','Metro Manila'),(47,'17','Grass Trail','Swamp','District 9','Jumanji','Amazon'),(48,'155','E.Jacinto Ave.','Ubod','District I','Pasig City','Metro Manila'),(49,'2','F.Ma Guerrero Ave.','Ubod','District I','Pasig City','Metro Manila'),(50,'196','A.Bonifacio Rd.','Ubod','District I','Pasig City','Metro Manila'),(51,'68','I.delos Reyes Ave.','Ubod','District I','Pasig City','Metro Manila'),(52,'105','L.Rivera Ave.','Ubod','District I','Pasig City','Metro Manila'),(53,'26','J.Felipe Rd.','Ubod','District I','Pasig City','Metro Manila'),(54,'60','Rajah Soliman Ave.','Ubod','District I','Pasig City','Metro Manila'),(55,'44','G.Apacible Blvd.','Ubod','District I','Pasig City','Metro Manila'),(56,'4','J.Rizal St.','Ubod','District I','Pasig City','Metro Manila'),(57,'170','J.Rizal Blvd.','Ubod','District I','Pasig City','Metro Manila'),(58,'59','Rajah Soliman Rd.','Ubod','District I','Pasig City','Metro Manila'),(59,'186','M.Dizon Rd.','Ubod','District I','Pasig City','Metro Manila'),(60,'189','J.Felipe Ave.','Ubod','District I','Pasig City','Metro Manila'),(61,'166','A.Esteban Blvd.','Ubod','District I','Pasig City','Metro Manila'),(62,'62','G.de Jesus St.','Ubod','District I','Pasig City','Metro Manila'),(63,'89','R.Palma St.','Ubod','District I','Pasig City','Metro Manila'),(64,'11','El Gawel','Brgy. Saravia','District XI','Koronadal','South Cotabato');
UNLOCK TABLES;

#
# Table structure for table 'Assessor'
#

DROP TABLE IF EXISTS Assessor;
CREATE TABLE Assessor (
  assessorID int(11) NOT NULL auto_increment,
  personID int(11) default NULL,
  position varchar(32) default NULL,
  PRIMARY KEY  (assessorID)
) TYPE=MyISAM;

#
# Dumping data for table 'Assessor'
#

LOCK TABLES Assessor WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Barangay'
#

DROP TABLE IF EXISTS Barangay;
CREATE TABLE Barangay (
  barangayID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  districtID int(4) NOT NULL default '1',
  description text,
  status varchar(255) default NULL,
  PRIMARY KEY  (barangayID)
) TYPE=MyISAM;

#
# Dumping data for table 'Barangay'
#

LOCK TABLES Barangay WRITE;
INSERT INTO Barangay VALUES (1,'UB',1,'Ubod','active');
UNLOCK TABLES;

#
# Table structure for table 'Company'
#

DROP TABLE IF EXISTS Company;
CREATE TABLE Company (
  companyID int(11) NOT NULL auto_increment,
  companyName varchar(50) default NULL,
  tin varchar(32) NOT NULL default '',
  telephone varchar(50) default NULL,
  fax varchar(50) default NULL,
  website varchar(128) NOT NULL default '',
  email varchar(128) default NULL,
  PRIMARY KEY  (companyID)
) TYPE=MyISAM;

#
# Dumping data for table 'Company'
#

LOCK TABLES Company WRITE;
INSERT INTO Company VALUES (1,'Eros Co.','0599018867','747 5366','474 6643','http://www.eros.ph','porta@eros.com.ph'),(2,'Crocodile Farm','','','','',''),(3,'El Gawel Mountain Resort','','','','','');
UNLOCK TABLES;

#
# Table structure for table 'CompanyAddress'
#

DROP TABLE IF EXISTS CompanyAddress;
CREATE TABLE CompanyAddress (
  companyAddressID int(11) NOT NULL auto_increment,
  companyID int(11) NOT NULL default '0',
  addressID int(11) NOT NULL default '0',
  PRIMARY KEY  (companyAddressID),
  KEY companyID (companyID)
) TYPE=MyISAM;

#
# Dumping data for table 'CompanyAddress'
#

LOCK TABLES CompanyAddress WRITE;
INSERT INTO CompanyAddress VALUES (1,1,1),(2,1,37),(3,2,47),(4,3,64);
UNLOCK TABLES;

#
# Table structure for table 'District'
#

DROP TABLE IF EXISTS District;
CREATE TABLE District (
  districtID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  municipalityCityID int(4) NOT NULL default '1',
  description text,
  status varchar(255) default NULL,
  PRIMARY KEY  (districtID)
) TYPE=MyISAM;

#
# Dumping data for table 'District'
#

LOCK TABLES District WRITE;
INSERT INTO District VALUES (1,'D1',1,'District I','active');
UNLOCK TABLES;

#
# Table structure for table 'ImprovementsBuildings'
#

DROP TABLE IF EXISTS ImprovementsBuildings;
CREATE TABLE ImprovementsBuildings (
  propertyID int(11) NOT NULL auto_increment,
  afsID int(11) default NULL,
  arpNumber varchar(32) default '',
  propertyIndexNumber varchar(32) default '',
  propertyAdministrator varchar(32) default '',
  verifiedBy varchar(32) default '',
  plottingsBy varchar(32) default '',
  notedBy varchar(32) default '',
  marketValue varchar(32) default '',
  kind varchar(32) default '',
  actualUse varchar(32) default '',
  adjustedMarketValue varchar(32) default '',
  assessmentLevel varchar(32) default '',
  assessedValue varchar(32) default '',
  previousOwner varchar(32) default '',
  previousAssessedValue varchar(32) default '',
  taxability varchar(32) default '',
  effectivity varchar(32) default '',
  appraisedBy varchar(32) default '',
  appraisedByDate varchar(32) default '',
  recommendingApproval varchar(32) default '',
  recommendingApprovalDate varchar(32) default '',
  approvedBy varchar(32) default '',
  approvedByDate varchar(32) default '',
  memoranda varchar(32) default '',
  postingDate varchar(32) default '',
  landPin varchar(32) default NULL,
  foundation varchar(32) default '',
  columnsBldg varchar(32) default '',
  beams varchar(32) default '',
  trussFraming varchar(32) default '',
  roof varchar(32) default '',
  exteriorWalls varchar(32) default '',
  flooring varchar(32) default '',
  doors varchar(32) default '',
  ceiling varchar(32) default '',
  structuralTypes varchar(32) default '',
  buildingClassification varchar(32) default '',
  buildingPermit varchar(32) default '',
  buildingAge varchar(32) default '',
  cctNumber varchar(32) default '',
  numberOfStoreys varchar(32) default '',
  windows varchar(32) default '',
  stairs varchar(32) default '',
  partition varchar(32) default '',
  wallFinish varchar(32) default '',
  electrical varchar(32) default '',
  toiletAndBath varchar(32) default '',
  plumbingSewer varchar(32) default '',
  fixtures varchar(32) default '',
  dateConstructed varchar(32) default '',
  dateOccupied varchar(32) default '',
  dateCompleted varchar(32) default '',
  areaOfGroundFloor varchar(32) default '',
  totalBuildingArea varchar(32) default '',
  buildingCoreAndAdditionalItems varchar(32) default '',
  depreciationRate varchar(32) default '',
  accumulatedDepreciation varchar(32) default '',
  depreciatedMarketValue varchar(32) default '',
  dateCreated varchar(32) NOT NULL default '',
  createdBy varchar(32) NOT NULL default '',
  dateModified varchar(32) NOT NULL default '',
  modifiedBy varchar(32) NOT NULL default '',
  PRIMARY KEY  (propertyID)
) TYPE=MyISAM;

#
# Dumping data for table 'ImprovementsBuildings'
#

LOCK TABLES ImprovementsBuildings WRITE;
INSERT INTO ImprovementsBuildings VALUES (1,1,'9972','6619','9','','','','233.14','Industrial','','-1,682.25','30','-504.67','1','1121110','No','10','','2002-12-14','','2002-09-9','','2003-02-25','risus\r\n Sed\r\n nec\r\n dui\r\n Phasel','2002-09-16','351923','446.06','117','129','eget','in','2','in','87','neque','netus\r\n et','','7818362','18','274','84','795','37','83','penatibus\r\n et','adipiscing\r\n elit','73','amet\r\n augue','nec\r\n ligula','2002-11-25','2003-02-8','2003-03-3','256.66','97.70','sit\r\n amet\r\n nisl\r\n Nulla\r\n quis','95','1,915.39','-1,682.25','1057807540','Randomizer','1057807540','Randomizer'),(2,1,'6203','6854','10','','','','2,884.48','Industrial','','-1,113.19','73','-812.63','1','3201011','Yes','3','','2003-05-16','','2003-05-2','','2003-01-7','erat\r\n Vivamus\r\n convallis\r\n vel','2003-01-22','738424','422.82','395','259','amet','vitae','3','Ut','32','tincidunt','dolor\r\n Nunc','','7887395','92','388','3','664','24','78','in\r\n vehicula','interdum\r\n scelerisque','14','mus\r\n In','quam\r\n vel','2002-07-17','2002-07-26','2002-10-28','231.49','115.59','Suspendisse\r\n vestibulum\r\n Ut\r\n','13','3,997.67','-1,113.19','1057807540','Randomizer','1057807540','Randomizer'),(3,2,'7186','5573','20','','','','2,511.30','Industrial','','216.67','98','212.34','1','2111010','No','11','','2003-05-1','','2002-11-11','','2003-01-25','neque\r\n iaculis\r\n vitae\r\n euismo','2002-12-21','652219','263.46','412','131','risus','neque','8','amet','96','condimentum','In\r\n sit','','5545766','84','193','14','22','94','74','vel\r\n pulvinar','viverra\r\n risus','89','metus\r\n In','molestie\r\n volutpat','2003-02-12','2002-07-14','2002-09-14','69.23','225.53','consequat\r\n eget\r\n pellentesque\r','23','2,294.63','216.67','1057807559','Randomizer','1057807559','Randomizer'),(4,2,'6789','7915','21','','','','1,197.19','Industrial','','161.47','46','74.28','1','1110111','Yes','76','','2002-11-8','','2002-10-2','','2003-01-17','euismod\r\n fermentum\r\n Donec\r\n eu','2003-06-12','361962','237.68','466','228','et','volutpat','21','urna','79','montes','magna\r\n id','','7485156','158','4','20','579','9','37','sit\r\n amet','volutpat\r\n varius','33','sit\r\n amet','scelerisque\r\n non','2002-09-22','2003-01-6','2003-04-28','218.97','5.74','interdum\r\n lobortis\r\n nibh\r\n Nul','51','1,035.72','161.47','1057807559','Randomizer','1057807559','Randomizer'),(5,3,'5959','6674','29','','','','1,466.05','Commercial','','-2,962.62','51','-1,510.94','2','1310101','Yes','37','','2003-01-7','','2003-02-27','','2002-11-10','ac\r\n pretium\r\n ac\r\n pellentesque','2002-11-1','696254','312.32','364','328','adipiscing','Suspendisse','5','ipsum','74','amet','velit\r\n posuere','','8212751','12','347','111','449','39','31','Aliquam\r\n eget','faucibus\r\n orci','50','et\r\n mi','consequat\r\n non','2003-05-30','2003-04-21','2002-10-31','252.85','195.08','lectus\r\n urna\r\n faucibus\r\n ac\r\n','24','4,428.67','-2,962.62','1057807883','Randomizer','1057807883','Randomizer'),(6,3,'8855','6899','30','','','','4,427.06','Industrial','','2,287.88','11','251.67','1','1333010','No','75','','2003-06-17','','2003-03-6','','2002-10-12','et\r\n molestie\r\n vel\r\n risus\r\n Se','2003-06-8','636316','113.88','354','405','tellus','Maecenas','3','parturient','100','Mauris','In\r\n hac','','7415324','121','158','15','310','41','70','varius\r\n malesuada','in\r\n faucibus','97','fames\r\n ac','Praesent\r\n quis','2003-05-5','2003-01-2','2002-12-30','267.33','291.44','potenti\r\n Nulla\r\n nec\r\n nulla\r\n','9','2,139.18','2,287.88','1057807883','Randomizer','1057807883','Randomizer'),(7,3,'4667','9406','31','','','','2,170.37','Commercial','','-1,919.38','96','-1,842.60','1','1223001','No','65','','2002-08-30','','2003-05-25','','2003-05-25','lorem\r\n Nam\r\n pretium\r\n magna\r\n','2003-06-8','858899','245.28','417','12','sagittis','ipsum','8','fames','83','velit','purus\r\n et','','3259436','111','483','104','393','6','51','lacinia\r\n lorem','enim\r\n Ut','30','quis\r\n quam','magna\r\n id','2002-09-29','2003-06-11','2002-11-18','183.19','248.35','metus\r\n nec\r\n neque\r\n luctus\r\n c','34','4,089.75','-1,919.38','1057807883','Randomizer','1057807883','Randomizer'),(8,3,'3281','4653','32','','','','3,052.06','Industrial','','2,777.09','28','777.59','1','2231001','Yes','25','','2003-06-12','','2002-11-28','','2003-04-15','Aenean\r\n interdum\r\n lobortis\r\n n','2003-03-1','565932','135.61','410','192','sit','ipsum','16','pellentesque','63','Maecenas','dolor\r\n quis','','7829435','1','134','107','802','63','17','sit\r\n amet','fringilla\r\n Donec','7','habitant\r\n morbi','tellus\r\n eu','2003-03-11','2003-02-8','2003-02-13','45.73','53.38','lobortis\r\n nibh\r\n Nulla\r\n quis\r\n','1','274.97','2,777.09','1057807883','Randomizer','1057807883','Randomizer'),(9,4,'4332','2362','40','','','','3,850.20','Residential','','-631.47','1','-6.31','5','1133100','No','28','','2003-05-8','','2003-02-19','','2002-07-15','metus\r\n In\r\n commodo\r\n Nulla\r\n t','2003-03-18','385532','386.48','110','1','pede','ac','24','pede','11','Suspendisse','vulputate\r\n nisl','','8452864','45','264','59','786','84','71','luctus\r\n congue','lacinia\r\n quis','24','Pellentesque\r\n posuere','elementum\r\n Integer','2002-07-10','2003-03-9','2003-02-1','66.35','265.26','et\r\n dui\r\n Donec\r\n enim\r\n Curabi','60','4,481.67','-631.47','1057816249','Randomizer','1057816249','Randomizer'),(10,4,'3051','1275','41','','','','3,742.47','Commercial','','-892.80','72','-642.82','4','3101011','Yes','29','','2003-02-3','','2003-03-10','','2002-10-17','mi\r\n lorem\r\n viverra\r\n id\r\n orna','2003-06-24','872918','296.93','234','184','nibh','orci','2','dolor','53','ligula','rutrum\r\n massa','','1813353','117','56','3','763','16','82','non\r\n placerat','imperdiet\r\n neque','82','et\r\n erat','gravida\r\n pede','2003-02-13','2003-01-8','2002-12-18','261.85','270.93','lorem\r\n et\r\n lectus\r\n consectetu','32','4,635.27','-892.80','1057816250','Randomizer','1057816250','Randomizer'),(11,4,'5030','4103','42','','','','3,493.78','Commercial','','-1,020.90','14','-142.93','1','3202011','No','33','','2002-09-12','','2002-10-12','','2003-03-15','hac\r\n habitasse\r\n platea\r\n dictu','2002-07-11','441851','105.94','270','251','in','vel','14','Suspendisse','18','Etiam','metus\r\n velit','','2245121','157','331','49','796','66','74','tristique\r\n Quisque','amet\r\n dapibus','58','nulla\r\n sollicitudin','justo\r\n in','2002-09-30','2002-11-13','2003-05-18','95.19','243.65','Donec\r\n enim\r\n Curabitur\r\n aliqu','89','4,514.68','-1,020.90','1057816250','Randomizer','1057816250','Randomizer'),(12,7,'9222','9223','52','','','','180.82','Industrial','','-709.47','6','-42.57','1','2302001','Yes','30','','2002-10-25','','2003-02-21','','2003-03-2','nunc\r\n cursus\r\n dictum\r\n Pellent','2002-08-28','622554','438.07','30','305','mus','blandit','16','Quisque','50','Aliquam','Duis\r\n sit','','3855129','98','40','39','434','95','83','neque\r\n Nam','eget\r\n velit','32','risus\r\n vitae','id\r\n orci','2003-04-30','2003-04-16','2003-05-1','76.87','296.49','pede\r\n tempor\r\n nec\r\n auctor\r\n e','22','890.29','-709.47','1057826702','Randomizer','1057826702','Randomizer'),(13,7,'1511','2186','53','','','','836.21','Industrial','','-1,096.74','32','-350.96','9','3213011','No','81','','2002-08-15','','2003-03-27','','2002-10-24','natoque\r\n penatibus\r\n et\r\n magni','2003-06-8','243552','64.46','359','207','et','habitant','6','nisl','42','ut','tristique\r\n metus','','1749631','191','74','111','214','24','96','pharetra\r\n tellus','turpis\r\n ut','45','ut\r\n lectus','ac\r\n turpis','2002-12-16','2002-12-12','2003-03-10','84.97','7.29','vulputate\r\n eu\r\n interdum\r\n ac\r\n','36','1,932.95','-1,096.74','1057826702','Randomizer','1057826702','Randomizer'),(14,7,'2566','5699','54','','','','1,313.24','Residential','','-833.48','39','-325.06','10','3112111','Yes','1','','2002-12-25','','2003-02-8','','2002-11-9','pellentesque\r\n et\r\n molestie\r\n v','2002-12-27','232792','352.43','276','474','quis','vitae','22','Donec','90','montes','orci\r\n Integer','','1581544','188','338','16','643','21','31','commodo\r\n nec','consequat\r\n non','3','cursus\r\n dictum','et\r\n felis','2002-10-19','2003-02-13','2002-08-12','82.34','265.27','malesuada\r\n Proin\r\n faucibus\r\n e','42','2,146.72','-833.48','1057826702','Randomizer','1057826702','Randomizer'),(15,7,'1831','5512','55','','','','170.46','Commercial','','-4,129.42','57','-2,353.77','8','2032110','No','39','','2003-02-4','','2002-10-8','','2002-09-19','eget\r\n tellus\r\n eu\r\n velit\r\n pos','2003-02-24','665226','207.10','118','349','id','ultricies','11','justo','25','Donec','magna\r\n Maecenas','','3867716','94','128','65','743','63','9','viverra\r\n Nulla','volutpat\r\n massa','26','sit\r\n amet','nec\r\n mi','2002-11-10','2002-12-9','2002-09-11','270.22','40.62','augue\r\n non\r\n erat\r\n nonummy\r\n s','75','4,299.88','-4,129.42','1057826702','Randomizer','1057826702','Randomizer');
UNLOCK TABLES;

#
# Table structure for table 'ImprovementsBuildingsActualUses'
#

DROP TABLE IF EXISTS ImprovementsBuildingsActualUses;
CREATE TABLE ImprovementsBuildingsActualUses (
  improvementsBuildingsActualUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (improvementsBuildingsActualUsesID)
) TYPE=MyISAM;

#
# Dumping data for table 'ImprovementsBuildingsActualUses'
#

LOCK TABLES ImprovementsBuildingsActualUses WRITE;
UNLOCK TABLES;

#
# Table structure for table 'ImprovementsBuildingsClasses'
#

DROP TABLE IF EXISTS ImprovementsBuildingsClasses;
CREATE TABLE ImprovementsBuildingsClasses (
  improvementsBuildingsClassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (improvementsBuildingsClassesID)
) TYPE=MyISAM;

#
# Dumping data for table 'ImprovementsBuildingsClasses'
#

LOCK TABLES ImprovementsBuildingsClasses WRITE;
UNLOCK TABLES;

#
# Table structure for table 'LUT'
#

DROP TABLE IF EXISTS LUT;
CREATE TABLE LUT (
  forYear int(11) NOT NULL default '0',
  monthCount int(11) NOT NULL default '0',
  rate double(14,2) NOT NULL default '0.00',
  PRIMARY KEY  (forYear,monthCount),
  KEY byYear (forYear)
) TYPE=MyISAM;

#
# Dumping data for table 'LUT'
#

LOCK TABLES LUT WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Land'
#

DROP TABLE IF EXISTS Land;
CREATE TABLE Land (
  propertyID int(11) NOT NULL auto_increment,
  afsID int(11) default NULL,
  arpNumber varchar(32) default NULL,
  propertyIndexNumber varchar(32) default '',
  propertyAdministrator varchar(32) default '',
  verifiedBy varchar(32) default '',
  plottingsBy varchar(32) default '',
  notedBy varchar(32) default '',
  marketValue varchar(32) default '',
  kind varchar(32) default '',
  actualUse varchar(32) default '',
  adjustedMarketValue varchar(32) default '',
  assessmentLevel varchar(32) default '',
  assessedValue varchar(32) default '',
  previousOwner varchar(32) default '',
  previousAssessedValue varchar(32) default '',
  taxability varchar(32) default '',
  effectivity varchar(32) default '',
  appraisedBy varchar(32) default '',
  appraisedByDate varchar(32) default '',
  recommendingApproval varchar(32) default '',
  recommendingApprovalDate varchar(32) default '',
  approvedBy varchar(32) default '',
  approvedByDate varchar(32) default NULL,
  memoranda text,
  postingDate varchar(32) default '',
  octTctNumber varchar(32) default '',
  surveyNumber varchar(32) default '',
  north varchar(32) default '',
  east varchar(32) default '',
  south varchar(32) default '',
  west varchar(32) default '',
  classification varchar(32) default '',
  subClass varchar(32) default '',
  area varchar(32) default '',
  unit varchar(32) default NULL,
  unitValue varchar(32) default '',
  fairMarketValue float default '0',
  adjustmentFactor varchar(32) default '',
  percentAdjustment varchar(32) default NULL,
  valueAdjustment varchar(32) default '',
  dateCreated varchar(32) NOT NULL default '',
  createdBy varchar(32) NOT NULL default '',
  dateModified varchar(32) NOT NULL default '',
  modifiedBy varchar(32) NOT NULL default '',
  PRIMARY KEY  (propertyID)
) TYPE=MyISAM;

#
# Dumping data for table 'Land'
#

LOCK TABLES Land WRITE;
INSERT INTO Land VALUES (1,1,'1405','3706','1','','','','548,941.55','Agricultural','1','98,809.48','26','25,690.46','1','41,893.00','No','63','','2003-05-23','','2002-07-14','','2002-08-18','tempus\r\n quam\r\n vel\r\n dictum\r\n dictum\r\n sapien\r\n purus\r\n consectetuer\r\n tellus\r\n at\r\n volutpat','2002-11-29','4386','8918','5455.11','8375.69','9567.65','7445.17','','','719.98','square meters','762.44',0,'ac turpis','18','-82','1057807539','Randomizer','1057807539','Randomizer'),(2,1,'8063','3106','2','','','','69,953.94','Commercial','2','39,873.74','100','39,873.74','1','9,408.00','No','7','','2003-05-26','','2002-09-8','','2002-10-8','nulla\r\n posuere\r\n vitae\r\n egestas\r\n id\r\n auctor\r\n pharetra\r\n tellus\r\n Phasellus\r\n adipiscing\r\n Pellentesque','2003-07-2','7766','9476','7178.71','7222.98','3886.94','5821.88','','','814.27','square meters','85.91',0,'et magna','57','-43','1057807539','Randomizer','1057807539','Randomizer'),(3,1,'3848','5875','3','','','','74,265.56','Industrial','2','32,676.84','44','14,377.81','1','81,076.00','No','22','','2002-12-4','','2003-02-4','','2003-01-26','malesuada\r\n fames\r\n ac\r\n turpis\r\n egestas\r\n Nunc\r\n non\r\n risus\r\n nec\r\n enim\r\n ultrices','2003-03-26','8373','4218','9677.27','2331.74','8465.18','9236.51','','','561.13','square meters','132.35',0,'purus felis','44','-56','1057807539','Randomizer','1057807539','Randomizer'),(4,1,'9021','9559','4','','','','66,378.65','Commercial','','31,197.97','17','5,303.65','1','67,650.00','No','31','','2003-02-24','','2002-11-7','','2002-10-12','in\r\n justo\r\n dignissim\r\n tempor\r\n Ut\r\n non\r\n erat\r\n nec\r\n mi\r\n euismod\r\n fermentum','2003-07-1','7159','2595','6991.88','3237.79','5332.63','8116.28','','','125.71','hectares','528.03',0,'sit\r\n amet','47','-53','1057807540','Randomizer','1057807540','Randomizer'),(5,1,'1271','5846','5','','','','365,146.48','Industrial','','146,058.59','19','27,751.13','1','91,948.00','No','89','','2002-12-12','','2003-06-9','','2002-08-8','mi\r\n lorem\r\n viverra\r\n id\r\n ornare\r\n vitae\r\n sollicitudin\r\n sit\r\n amet\r\n nisl\r\n Nulla','2002-09-22','1823','4453','6111.74','7377.17','7169.66','1763.56','','','514.90','hectares','709.16',0,'ante\r\n pede','40','-60','1057807540','Randomizer','1057807540','Randomizer'),(6,2,'6202','0584','14','','','','10,435.31','Residential','','3,130.59','9','281.75','1','57,273.00','No','29','','2002-09-9','','2003-04-8','','2002-10-11','magna\r\n id\r\n augue\r\n Quisque\r\n ante\r\n ligula\r\n ornare\r\n ut\r\n dapibus\r\n in\r\n fermentum','2003-01-12','9681','2523','7375.83','6698.84','4779.62','2189.68','','','645.35','hectares','16.17',0,'in\r\n justo','30','-70','1057807558','Randomizer','1057807558','Randomizer'),(7,2,'7032','0949','15','','','','40,505.67','Residential','','4,860.68','22','1,069.35','1','88,524.00','No','47','','2003-03-29','','2003-03-16','','2002-10-2','hac\r\n habitasse\r\n platea\r\n dictumst\r\n Quisque\r\n diam\r\n Aliquam\r\n non\r\n erat\r\n Suspendisse\r\n tempus','2002-09-16','4996','3676','9763.66','7268.99','7855.21','8586.42','','','92.14','hectares','439.61',0,'ante\r\n ligula','12','-88','1057807558','Randomizer','1057807558','Randomizer'),(8,2,'9654','8778','16','','','','499,097.47','Agricultural','','444,196.75','5','22,209.84','2','85,700.00','Yes','15','','2002-11-3','','2002-09-8','','2003-03-17','semper\r\n ac\r\n laoreet\r\n non\r\n metus\r\n Sed\r\n nec\r\n pede\r\n vel\r\n nulla\r\n cursus','2003-05-29','5115','5921','4182.96','4571.84','8268.88','7227.37','','','599.02','square meters','833.19',0,'Nam\r\n quam','89','-11','1057807558','Randomizer','1057807558','Randomizer'),(9,2,'9115','3027','17','','','','269,518.62','Industrial','','80,855.59','68','54,981.80','2','64,756.00','Yes','92','','2002-08-27','','2002-08-11','','2002-08-14','Nullam\r\n magna\r\n Maecenas\r\n bibendum\r\n sapien\r\n Nulla\r\n felis\r\n lorem\r\n sollicitudin\r\n et\r\n euismod','2002-08-11','5722','2243','6739.52','3323.12','9418.37','7763.62','','','590.26','square meters','456.61',0,'tincidunt\r\n Quisque','30','-70','1057807558','Randomizer','1057807558','Randomizer'),(10,3,'9334','8241','24','','','','71,993.56','Agricultural','','719.94','20','143.99','3','10,475.00','No','77','','2003-02-5','','2002-08-9','','2002-11-23','augue\r\n dolor\r\n eu\r\n elit\r\n Nunc\r\n bibendum\r\n turpis\r\n non\r\n sodales\r\n rutrum\r\n massa','2002-07-23','8791','6959','4328.42','9636.92','7695.15','4826.71','','','306.03','square meters','235.25',0,'potenti\r\n Nulla','1','-99','1057807883','Randomizer','1057807883','Randomizer'),(11,3,'3163','4441','25','','','','26,771.91','Commercial','','13,385.96','30','4,015.79','3','12,425.00','No','65','','2002-10-6','','2002-10-12','','2002-11-5','Ut\r\n elementum\r\n dignissim\r\n mi\r\n Morbi\r\n mi\r\n lorem\r\n viverra\r\n id\r\n ornare\r\n vitae','2003-06-8','4867','4882','3367.59','9114.29','5967.73','5616.74','','','184.94','square meters','144.76',0,'vulputate\r\n nisl','50','-50','1057807883','Randomizer','1057807883','Randomizer'),(12,4,'3045','7090','36','','','','34,302.34','Industrial','','22,639.54','82','18,564.43','4','97,626.00','Yes','11','','2003-06-12','','2002-11-16','','2002-08-5','vel\r\n semper\r\n ac\r\n laoreet\r\n non\r\n metus\r\n Sed\r\n nec\r\n pede\r\n vel\r\n nulla','2002-12-13','4332','1535','1151.12','1141.92','9439.59','5986.53','','','416.24','square meters','82.41',0,'enim\r\n Ut','66','-34','1057816249','Randomizer','1057816249','Randomizer'),(13,4,'7192','9994','37','','','','184,504.53','Commercial','','147,603.62','7','10,332.25','1','76,259.00','No','79','','2002-10-10','','2002-09-14','','2003-05-7','sodales\r\n Etiam\r\n lectus\r\n urna\r\n faucibus\r\n ac\r\n pretium\r\n ac\r\n pellentesque\r\n et\r\n ortor','2002-11-28','8349','7226','4164.68','1974.18','2863.66','1785.37','','','372.15','hectares','495.78',0,'erat\r\n nonummy','80','-20','1057816249','Randomizer','1057816249','Randomizer'),(14,6,NULL,'','','','','','465.00','Land','Agricultural','','14','65.10','','','','','','','','','',NULL,NULL,'','','','','','','','Agricultural','','155.00','square meters','3.00',0,'',NULL,'','1057821213','45','1057821213','45'),(15,7,'7632','2909','46','','','','126,335.67','Agricultural','Agricultural','50,534.27','63','31,836.59','5','73,119.00','No','94','','2003-05-31','','2003-05-18','','2003-05-19','dolor\r\n sit\r\n amet\r\n consectetuer\r\n adipiscing\r\n elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n quam','2002-08-14','4331','1174','3933.85','1587.23','4932.12','4732.67','Agricultural','','576.27','hectares','219.23',0,'risus\r\n risus','40','-60','1057826702','Randomizer','1057826702','Randomizer'),(16,7,'4466','7213','47','','','','539,774.96','Residential','Agricultural','356,251.48','70','249,376.03','7','57,147.00','No','1','','2003-02-21','','2002-07-29','','2003-03-27','Duis\r\n est\r\n Cum\r\n sociis\r\n natoque\r\n penatibus\r\n et\r\n magnis\r\n dis\r\n parturient\r\n montes','2002-09-3','5352','8965','6477.74','4894.36','9166.41','6532.38','Agricultural','','711.86','square meters','758.26',0,'sit\r\n amet','66','-34','1057826702','Randomizer','1057826702','Randomizer'),(17,7,'6495','3455','48','','','','208,471.95','Industrial','Agricultural','104,235.98','95','99,024.18','10','13,971.00','No','44','','2002-09-11','','2003-02-27','','2003-06-6','ipsum\r\n dolor\r\n sit\r\n amet\r\n consectetuer\r\n adipiscing\r\n elit\r\n Cras\r\n porttitor\r\n pulvinar\r\n mi','2002-10-10','6636','1919','5441.11','4152.45','3298.97','2286.95','Agricultural','','395.20','square meters','527.51',0,'nascetur\r\n ridiculus','50','-50','1057826702','Randomizer','1057826702','Randomizer'),(18,8,NULL,'','','','','','15,244.00','Land','Agricultural','','11','1,676.84','','','','','','','','','',NULL,NULL,'','','','','','','','Agricultural','','37.00','square meters','412.00',0,'',NULL,'','1057828442','45','1057828442','45');
UNLOCK TABLES;

#
# Table structure for table 'LandActualUses'
#

DROP TABLE IF EXISTS LandActualUses;
CREATE TABLE LandActualUses (
  landActualUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (landActualUsesID)
) TYPE=MyISAM;

#
# Dumping data for table 'LandActualUses'
#

LOCK TABLES LandActualUses WRITE;
INSERT INTO LandActualUses VALUES (1,'AG','Agricultural',1400,'active'),(2,'RE','Residential',20,'active');
UNLOCK TABLES;

#
# Table structure for table 'LandClasses'
#

DROP TABLE IF EXISTS LandClasses;
CREATE TABLE LandClasses (
  landClassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (landClassesID)
) TYPE=MyISAM;

#
# Dumping data for table 'LandClasses'
#

LOCK TABLES LandClasses WRITE;
INSERT INTO LandClasses VALUES (1,'AGRI','Agricultural',1400,'active');
UNLOCK TABLES;

#
# Table structure for table 'LandSubclasses'
#

DROP TABLE IF EXISTS LandSubclasses;
CREATE TABLE LandSubclasses (
  landSubclassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (landSubclassesID)
) TYPE=MyISAM;

#
# Dumping data for table 'LandSubclasses'
#

LOCK TABLES LandSubclasses WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Location'
#

DROP TABLE IF EXISTS Location;
CREATE TABLE Location (
  locationID int(11) NOT NULL auto_increment,
  odID int(11) default NULL,
  locationAddressID int(11) NOT NULL default '0',
  PRIMARY KEY  (locationID),
  KEY odID (odID)
) TYPE=MyISAM;

#
# Dumping data for table 'Location'
#

LOCK TABLES Location WRITE;
INSERT INTO Location VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4),(5,5,5),(6,6,6),(7,7,7),(8,8,8);
UNLOCK TABLES;

#
# Table structure for table 'LocationAddress'
#

DROP TABLE IF EXISTS LocationAddress;
CREATE TABLE LocationAddress (
  locationAddressID int(11) NOT NULL auto_increment,
  number varchar(50) default NULL,
  street varchar(50) default NULL,
  barangayID varchar(50) default NULL,
  district varchar(50) default NULL,
  municipalityCity varchar(50) default NULL,
  province varchar(50) default NULL,
  PRIMARY KEY  (locationAddressID)
) TYPE=MyISAM;

#
# Dumping data for table 'LocationAddress'
#

LOCK TABLES LocationAddress WRITE;
INSERT INTO LocationAddress VALUES (1,'51','M.Ponce Rd.','','','',''),(2,'77','E.Aguinaldo St.','','','',''),(3,'58','J.Palma Rd.','','','',''),(4,'347','M.Dizon Blvd.','1','District I','Pasig City','Metro Manila'),(5,'14','14th Street','1','District I','Pasig City','Metro Manila'),(6,'18','Aquinas Street','1','District I','Pasig City','Metro Manila'),(7,'24','E.delos Santos Blvd.','1','District I','Pasig City','Metro Manila'),(8,'11','Septembre','1','District I','Pasig City','Metro Manila');
UNLOCK TABLES;

#
# Table structure for table 'Machineries'
#

DROP TABLE IF EXISTS Machineries;
CREATE TABLE Machineries (
  propertyID int(11) NOT NULL auto_increment,
  afsID int(11) default NULL,
  arpNumber varchar(32) default NULL,
  propertyIndexNumber varchar(32) default '',
  propertyAdministrator varchar(32) default '',
  verifiedBy varchar(32) default '',
  plottingsBy varchar(32) default '',
  notedBy varchar(32) default '',
  marketValue varchar(32) default '',
  kind varchar(32) default '',
  actualUse varchar(32) default '',
  adjustedMarketValue varchar(32) default '',
  assessmentLevel varchar(32) default '',
  assessedValue varchar(32) default '',
  previousOwner varchar(32) default '',
  previousAssessedValue varchar(32) default '',
  taxability varchar(32) default '',
  effectivity varchar(32) default '',
  appraisedBy varchar(32) default '',
  appraisedByDate varchar(32) default '',
  recommendingApproval varchar(32) default '',
  recommendingApprovalDate varchar(32) default '',
  approvedBy varchar(32) default '',
  approvedByDate varchar(32) default NULL,
  memoranda varchar(32) default NULL,
  postingDate varchar(32) default '',
  buildingPin varchar(32) default '',
  landPin varchar(32) default '',
  machineryDescription varchar(32) default '',
  brand varchar(32) default '',
  modelNumber varchar(32) default '',
  capacity varchar(32) default '',
  dateAcquired varchar(32) default '',
  conditionWhenAcquired varchar(32) default '',
  estimatedEconomicLife varchar(32) default '',
  remainingEconomicLife varchar(32) default '',
  dateOfInstallation varchar(32) default '',
  dateOfOperation varchar(32) default '',
  remarks varchar(32) default '',
  numberOfUnits varchar(32) default '',
  acquisitionCost varchar(32) default '',
  freightCost varchar(32) default '',
  insuranceCost varchar(32) default '',
  installationCost varchar(32) default '',
  othersCost varchar(32) default '',
  depreciation varchar(32) default '',
  depreciatedMarketValue varchar(32) default '',
  dateCreated varchar(32) NOT NULL default '',
  createdBy varchar(32) NOT NULL default '',
  dateModified varchar(32) NOT NULL default '',
  modifiedBy varchar(32) NOT NULL default '',
  PRIMARY KEY  (propertyID)
) TYPE=MyISAM;

#
# Dumping data for table 'Machineries'
#

LOCK TABLES Machineries WRITE;
INSERT INTO Machineries VALUES (1,1,'5270','2355','11','','','','3,246,753.65','','','2,533.06','39','987.89','1','63,456.00','Yes','44','','2002-08-12','','2003-05-12','','2003-07-1','nec\r\n sem\r\n Aliquam\r\n molestie\r\n','2003-02-11','551956','226362','lacus\r\n Duis\r\n sit\r\n amet\r\n enim','et\r\n risus','117069','689','2003-05-18','Mauris\r\n dictum','29','2','2003-03-16','2002-10-18','Proin\r\n sollicitudin\r\n consectet','35','76,109.82','76.00','3,050.24','5,096.22','1,479.32','34','2,533.06','1057807540','Randomizer','1057807540','Randomizer'),(2,1,'3206','6656','12','','','','1,804,104.64','','','2,394.70','42','1,005.77','1','46,490.00','Yes','0','','2003-03-12','','2003-02-1','','2003-04-15','volutpat\r\n velit\r\n leo\r\n at\r\n lo','2002-09-22','768292','418974','egestas\r\n Praesent\r\n quis\r\n enim','non\r\n risus','682782','244','2003-03-30','sit\r\n amet','38','23','2002-11-27','2003-05-5','parturient\r\n montes\r\n nascetur\r\n','26','41,041.88','41.00','9,905.09','4,070.93','8,616.41','85','2,394.70','1057807540','Randomizer','1057807540','Randomizer'),(3,2,'2892','8405','22','','','','630,490.26','','','4,381.02','67','2,935.28','2','62,071.00','Yes','10','','2002-07-15','','2002-08-31','','2003-05-2','amet\r\n consectetuer\r\n adipiscing','2003-03-15','195757','649581','Curae\r\n Donec\r\n vulputate\r\n Null','Nam\r\n justo','304332','1000','2002-10-24','ipsum\r\n Aliquam','17','12','2002-12-14','2003-05-5','vulputate\r\n et\r\n enim\r\n In\r\n ris','23','3,045.72','3.00','3,842.76','1,681.58','9,628.05','76','4,381.02','1057807559','Randomizer','1057807559','Randomizer'),(4,3,'2003','9705','33','','','','4,319,458.48','','','1,564.05','54','844.59','2','99,401.00','Yes','16','','2003-05-13','','2002-11-7','','2003-06-11','vitae\r\n erat\r\n sit\r\n amet\r\n est\r','2003-05-3','437939','133114','metus\r\n In\r\n commodo\r\n Nulla\r\n t','ac\r\n nulla','483828','798','2003-02-10','orci\r\n luctus','39','23','2002-12-10','2003-01-29','nec\r\n convallis\r\n in\r\n vehicula\r','38','93,338.20','93.00','7,113.90','4,121.62','5,522.57','66','1,564.05','1057807883','Randomizer','1057807883','Randomizer'),(5,3,'5859','3681','34','','','','1,193,687.68','','','4,067.45','95','3,864.08','3','99,792.00','Yes','45','','2002-12-5','','2002-07-15','','2003-06-1','metus\r\n velit\r\n ac\r\n nulla\r\n Sed','2003-02-4','969856','715173','turpis\r\n non\r\n sodales\r\n rutrum\r','pellentesque\r\n et','072231','254','2002-09-15','eget\r\n est','26','11','2003-02-2','2003-01-11','eu\r\n wisi\r\n Lorem\r\n ipsum\r\n dolo','16','57,835.41','57.00','5,634.21','4,075.79','3,141.29','54','4,067.45','1057807883','Randomizer','1057807883','Randomizer'),(6,4,'3999','7382','43','','','','1,361,857.14','','','547.19','4','21.89','5','30,325.00','Yes','100','','2002-11-9','','2003-03-13','','2002-08-26','Pellentesque\r\n egestas\r\n diam\r\n','2003-04-29','962125','925754','Ut\r\n sit\r\n amet\r\n libero\r\n Lorem','Nam\r\n id','304172','443','2002-09-20','et\r\n velit','26','13','2003-02-27','2002-09-8','pulvinar\r\n Nulla\r\n vitae\r\n nisl\r','46','10,115.86','10.00','2,267.76','1,298.28','7,997.17','24','547.19','1057816250','Randomizer','1057816250','Randomizer'),(7,7,'3936','8153','56','','','','391,759.04','','','4,623.92','57','2,635.63','2','43,259.00','Yes','54','','2003-06-15','','2003-03-23','','2002-09-12','placerat\r\n vel\r\n pharetra\r\n nec\r','2002-12-2','758312','348254','Pellentesque\r\n egestas\r\n diam\r\n','eu\r\n leo','193805','325','2003-05-24','pede\r\n vel','16','4','2003-04-28','2002-12-1','dolor\r\n sit\r\n amet\r\n consectetue','8','30,220.05','30.00','3,722.50','5,896.35','7,335.29','3','4,623.92','1057826702','Randomizer','1057826702','Randomizer'),(8,7,'8582','0279','57','','','','1,886,835.41','','','601.60','5','30.08','4','32,035.00','Yes','75','','2003-06-14','','2002-08-15','','2002-08-11','sed\r\n dolor\r\n Vivamus\r\n feugiat\r','2002-11-2','167186','678796','et\r\n netus\r\n et\r\n malesuada\r\n fa','Pellentesque\r\n libero','113356','670','2002-08-5','faucibus\r\n ac','49','49','2002-07-24','2002-08-23','vel\r\n rhoncus\r\n wisi\r\n augue\r\n i','29','38,916.59','38.00','4,449.96','8,402.53','3,680.02','88','601.60','1057826702','Randomizer','1057826702','Randomizer'),(9,7,'9957','9713','58','','','','5,419,775.50','','','4,576.24','88','4,027.09','1','53,697.00','No','87','','2003-02-5','','2002-12-27','','2003-02-2','felis\r\n Suspendisse\r\n vestibulum','2002-11-10','491241','298171','wisi\r\n augue\r\n id\r\n orci\r\n Ut\r\n','scelerisque\r\n ipsum','075645','187','2003-05-16','dictum\r\n ipsum','22','13','2002-08-27','2002-07-26','neque\r\n luctus\r\n congue\r\n Nullam','50','76,527.44','76.00','8,464.67','6,234.26','9,648.15','31','4,576.24','1057826702','Randomizer','1057826702','Randomizer'),(10,7,'5907','2879','59','','','','1,249,282.32','','','1,417.32','38','538.58','8','45,736.00','No','98','','2002-07-27','','2003-03-14','','2003-06-1','mollis\r\n sodales\r\n elit\r\n sem\r\n','2002-08-30','461776','784972','at\r\n lorem\r\n Nam\r\n pretium\r\n mag','elit\r\n Mauris','597035','483','2003-04-8','quis\r\n vestibulum','15','4','2003-03-11','2002-11-27','libero\r\n Lorem\r\n ipsum\r\n dolor\r\n','13','77,904.91','77.00','2,528.30','8,237.57','3,480.81','44','1,417.32','1057826702','Randomizer','1057826702','Randomizer'),(11,7,'6910','9568','60','','','','1,509,882.08','','','4,296.54','15','644.48','9','35,052.00','Yes','21','','2003-02-23','','2003-05-5','','2003-07-4','Ut\r\n elementum\r\n dignissim\r\n mi\r','2002-11-24','871178','988935','Nam\r\n est\r\n nulla\r\n sollicitudin','ac\r\n dolor','281060','387','2003-05-31','augue\r\n dolor','34','17','2002-07-28','2002-09-6','Curabitur\r\n eleifend\r\n gravida\r\n','16','76,055.17','76.00','3,923.99','5,445.93','3,209.99','97','4,296.54','1057826702','Randomizer','1057826702','Randomizer');
UNLOCK TABLES;

#
# Table structure for table 'MachineriesActualUses'
#

DROP TABLE IF EXISTS MachineriesActualUses;
CREATE TABLE MachineriesActualUses (
  machineriesActualUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (machineriesActualUsesID)
) TYPE=MyISAM;

#
# Dumping data for table 'MachineriesActualUses'
#

LOCK TABLES MachineriesActualUses WRITE;
UNLOCK TABLES;

#
# Table structure for table 'MachineriesClasses'
#

DROP TABLE IF EXISTS MachineriesClasses;
CREATE TABLE MachineriesClasses (
  machineriesClassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (machineriesClassesID)
) TYPE=MyISAM;

#
# Dumping data for table 'MachineriesClasses'
#

LOCK TABLES MachineriesClasses WRITE;
UNLOCK TABLES;

#
# Table structure for table 'MunicipalityCity'
#

DROP TABLE IF EXISTS MunicipalityCity;
CREATE TABLE MunicipalityCity (
  municipalityCityID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  provinceID int(4) NOT NULL default '1',
  description text,
  status varchar(255) default NULL,
  PRIMARY KEY  (municipalityCityID)
) TYPE=MyISAM;

#
# Dumping data for table 'MunicipalityCity'
#

LOCK TABLES MunicipalityCity WRITE;
INSERT INTO MunicipalityCity VALUES (1,'PSG',1,'Pasig City','active');
UNLOCK TABLES;

#
# Table structure for table 'OD'
#

DROP TABLE IF EXISTS OD;
CREATE TABLE OD (
  odID int(11) NOT NULL auto_increment,
  houseTagNumber varchar(32) default NULL,
  landArea varchar(32) default NULL,
  lotNumber varchar(32) default NULL,
  zoneNumber varchar(32) default NULL,
  blockNumber varchar(32) default NULL,
  psd13 varchar(32) default NULL,
  ownerID int(11) default NULL,
  affidavitOfOwnership int(1) default '0',
  barangayCertificate int(1) default '0',
  landTagging int(1) default '0',
  dateCreated varchar(32) NOT NULL default '',
  createdBy varchar(32) NOT NULL default '',
  dateModified varchar(32) NOT NULL default '',
  modifiedBy varchar(32) NOT NULL default '',
  PRIMARY KEY  (odID),
  KEY odID (odID)
) TYPE=MyISAM;

#
# Dumping data for table 'OD'
#

LOCK TABLES OD WRITE;
INSERT INTO OD VALUES (1,'26876','742.03','36','36','53','39',1,1,1,1,'1057807539','Randomizer','1057807539','Randomizer'),(2,'51331','288.13','91','14','67','65',2,0,1,0,'1057807558','Randomizer','1057807558','Randomizer'),(3,'90539','695.33','37','59','30','97',3,0,1,1,'1057807882','Randomizer','1057807882','Randomizer'),(4,'87588','524.99','16','96','7','90',5,1,1,0,'1057816249','Randomizer','1057816249','Randomizer'),(5,'1414','1415','44','44','44','44',NULL,1,1,1,'1057816640','45','1057816640','45'),(6,'45','55','11','13','12','14',NULL,1,1,0,'1057820071','','1057828867','45'),(7,'21369','111.30','81','11','42','78',10,0,1,0,'1057826702','Randomizer','1057826702','Randomizer'),(8,NULL,NULL,'11',NULL,'11',NULL,NULL,0,0,0,'1057827533','45','1057827533','45');
UNLOCK TABLES;

#
# Table structure for table 'Owner'
#

DROP TABLE IF EXISTS Owner;
CREATE TABLE Owner (
  ownerID int(11) NOT NULL auto_increment,
  odID int(11) default NULL,
  rptopID varchar(11) default NULL,
  PRIMARY KEY  (ownerID),
  UNIQUE KEY ownerID (ownerID),
  KEY odID (odID)
) TYPE=MyISAM;

#
# Dumping data for table 'Owner'
#

LOCK TABLES Owner WRITE;
INSERT INTO Owner VALUES (1,1,NULL),(2,2,NULL),(3,3,NULL),(4,NULL,'1'),(5,4,NULL),(6,5,NULL),(7,NULL,'2'),(8,6,NULL),(9,NULL,'3'),(10,7,NULL),(11,8,NULL),(12,NULL,'5'),(13,NULL,'6');
UNLOCK TABLES;

#
# Table structure for table 'OwnerCompany'
#

DROP TABLE IF EXISTS OwnerCompany;
CREATE TABLE OwnerCompany (
  ownerCompanyID int(11) NOT NULL auto_increment,
  ownerID int(11) default NULL,
  companyID int(11) default NULL,
  PRIMARY KEY  (ownerCompanyID),
  KEY ownerID (ownerID)
) TYPE=MyISAM;

#
# Dumping data for table 'OwnerCompany'
#

LOCK TABLES OwnerCompany WRITE;
INSERT INTO OwnerCompany VALUES (5,8,2),(6,9,2),(3,5,1),(7,11,3),(9,13,2);
UNLOCK TABLES;

#
# Table structure for table 'OwnerPerson'
#

DROP TABLE IF EXISTS OwnerPerson;
CREATE TABLE OwnerPerson (
  ownerPersonID int(11) NOT NULL auto_increment,
  ownerID int(11) default NULL,
  personID int(11) default NULL,
  PRIMARY KEY  (ownerPersonID),
  UNIQUE KEY ownerPersonID (ownerPersonID),
  KEY ownerID (ownerID)
) TYPE=MyISAM;

#
# Dumping data for table 'OwnerPerson'
#

LOCK TABLES OwnerPerson WRITE;
INSERT INTO OwnerPerson VALUES (1,2,13),(2,3,23),(3,0,35),(6,7,39),(5,6,44),(7,1,39),(9,4,44),(10,10,45),(12,13,18),(13,9,2),(15,3,13),(16,5,13);
UNLOCK TABLES;

#
# Table structure for table 'Person'
#

DROP TABLE IF EXISTS Person;
CREATE TABLE Person (
  personID int(11) NOT NULL auto_increment,
  firstName varchar(50) default NULL,
  middleName varchar(50) default NULL,
  lastName varchar(50) default NULL,
  gender varchar(10) default NULL,
  birthday date default NULL,
  maritalStatus varchar(32) default NULL,
  tin varchar(32) default NULL,
  telephone varchar(32) default NULL,
  mobileNumber varchar(32) default NULL,
  email varchar(128) default NULL,
  PRIMARY KEY  (personID)
) TYPE=MyISAM;

#
# Dumping data for table 'Person'
#

LOCK TABLES Person WRITE;
INSERT INTO Person VALUES (1,'Alex','Arroyo','Santillan','male','1985-09-07','single','6805180780','458 7942','0917 92070347','magna@elit.org.ph'),(2,'Clavio','Rosario','Garcia','male','1972-07-01','married','4801924907','895 6285','0917 93178647','ac@Donec.org'),(3,'Manuel','Arroyo','Chua','male','1989-06-08','married','9161391120','696 5747','0916 31103436','nunc@Pellentesque.org.ph'),(4,'Clavio','Paterno','Dimalanta','male','1981-10-30','single','7410548242','685 0021','0916 83959640','Etiam@Proin.com.ph'),(5,'Ofelia','Pereya','Reyes','female','1980-01-22','married','6214582559','749 2899','0918 45022963','interdum@urna.org.ph'),(6,'Helen','Rosario','Sumulong','female','1970-04-24','married','5134776919','967 7879','0920 65750950','porta@Mauris.org'),(7,'Jeremy','Dimalanta','Santillan','male','1970-03-12','married','9277746822','874 6252','0919 62716493','et@et.ph'),(8,'Maria','Ayala','Cuneta','female','1986-05-05','married','9072273403','466 5223','0919 80563390','massa@est.net'),(9,'Evelyn','Montinola','Pereya','female','1982-02-09','married','9831996735','384 3487','0920 74501526','felis@Morbi.com.ph'),(10,'Kendrick','Uy','Paterno','male','1972-07-20','single','2317897515','647 5665','0917 8990331','ut@cursus.com.ph'),(11,'Amy','Roces','Uy','female','1982-07-11','married','2195721914','354 1918','0916 73181323','sit@hac.com'),(12,'Nina','Suarez','Santos','female','1987-11-27','married','5006803270','865 6358','0919 86237528','laoreet@tempus.org'),(13,'Ellen','Sy','Tan','female','1973-07-17','married','0621053277','495 8129','0919 51558453','enim@leo.org'),(14,'Walter','Sumulong','Montilla','male','1976-03-07','married','9005603546','537 9279','0916 85938616','ipsum@ridiculus.com'),(15,'Soledad','Ku','Gonzalvez','male','1974-07-06','single','1868026923','878 9754','0918 48870659','et@Etiam.com.ph'),(16,'Willy','Perez','Dela Rosa','male','1980-07-05','single','6589050808','978 8449','0919 41393535','elementum@malesuada.com'),(17,'Clavio','Montilla','Sumulong','male','1979-11-25','married','5998210329','858 9057','0919 93982302','Quisque@diam.org.ph'),(18,'Amy','Miguel','Sy','female','1989-10-16','single','6496656675','345 5044','0918 42878523','odio@vitae.com'),(19,'Strong','Pereya','Roces','male','1979-06-06','married','4297211925','478 0744','0919 67250706','Vivamus@Phasellus.com.ph'),(20,'Mark','Jose','Choa','male','1976-01-22','married','2009449547','967 5605','0918 47793166','Pellentesque@quam.net'),(21,'Nina','Luna','Garces','female','1985-01-07','single','0797598102','546 2537','0919 36504984','platea@dictum.com'),(22,'Rizza','Montinola','Reyes','female','1976-12-15','married','5019057164','689 8018','0919 61403984','et@non.ph'),(23,'Nona','Montilla','Dimaano','female','1977-09-15','married','2682112856','439 2279','0917 91454993','est@Nam.org.ph'),(24,'Ruth','Revilla','Ballesteros','female','1987-02-10','single','9239865782','588 4212','0918 80407603','tristique@sit.org'),(25,'Warren','Sumulong','Pe','male','1975-04-01','married','1750754859','847 5511','0918 89932124','velit@ultricies.org.ph'),(26,'Amy','Dimalanta','Villa','female','1984-01-07','single','8905256992','454 5352','0917 90958386','id@Pellentesque.org'),(27,'Evelyn','Uy','Dimalanta','female','1983-02-17','married','6108023009','993 0376','0916 49211882','nascetur@ipsum.org'),(28,'Claro','Arroyo','Santos','male','1974-03-20','married','6139095575','768 7383','0919 76311381','leo@nunc.org.ph'),(29,'John','Dimalanta','Tan','male','1976-01-14','single','5966033576','883 6129','0920 37478213','quam@wisi.com.ph'),(30,'Jeremy','Cho','Cho','male','1986-02-12','single','7020651998','698 1506','0916 90484988','ac@elit.com'),(31,'Tanya','del Rosario','Romualdez','female','1975-10-29','single','6732239634','648 4054','0919 35699253','adipiscing@elementum.com'),(32,'Nina','Jose','Garces','female','1981-04-12','single','5920957719','459 9533','0920 61365144','amet@aliquet.com'),(33,'Alvin','Dela Rosa','Ziga','male','1987-02-19','married','2794095357','854 6604','0916 32666623','malesuada@ac.net'),(34,'Frank','Remulla','Santillan','male','1976-10-26','single','8909406723','837 0372','0916 57672530','rhoncus@fermentum.org'),(35,'Danny','-','van Ommen','male','1982-11-11','single','111-1111-11','845-11-11','0919-81111','danny@k2ia.com'),(36,'Francis','Paterno','Chua','male','1984-02-26','married','3804844754','485 6786','0919 61839222','justo@Quisque.ph'),(37,'Efren','Jose','Miguel','male','1986-05-02','married','7347221302','476 7354','0916 37774313','Quisque@massa.ph'),(38,'Janette','Perez','Cuneta','female','1977-09-18','single','0712102303','475 2248','0918 66531297','Nullam@nec.com'),(39,'Marianne','Garcia','Paterno','female','1986-04-23','single','4737708646','549 4698','0916 49617514','Fusce@Aenean.com'),(40,'Velda','Tan','Dimalanta','female','1987-02-12','single','0604958745','588 2375','0919 39281882','elit@erat.net'),(41,'Archimedes','Cuneta','Rosario','male','1979-05-10','single','4777297005','655 1576','0916 74654095','congue@dis.ph'),(42,'Bobby','Ayala','Remulla','male','1970-09-27','married','0090864621','898 5642','0920 83760364','sollicitudin@Ut.org.ph'),(43,'Avelino','Dela Rosa','Luna','male','1975-11-18','single','1822387772','387 2696','0918 41860883','pede Suspendisse@interdum.net'),(44,'Andre','Shwartz','Berlusconni','male','1970-01-01','married','141414141414','9271414','09161414','andre@berlusconni.edu'),(45,'Eden','Jose','Santos','female','1983-08-29','single','1032391422','457 0613','0918 59546686','in@non.com.ph'),(46,'Lizette','Cho','Garces','female','1978-04-27','single','4265852986','839 8225','0918 61380139','ridiculus@non.com'),(47,'Helen','Ballesteros','Santillan','female','1970-09-18','single','0794588847','835 2197','0918 40258286','Pellentesque@quis.org.ph'),(48,'Koby','Reyes','Reyes','male','1980-09-05','married','6560511964','365 0342','0916 31623754','Quisque@tempus.com'),(49,'Allen','Tan','Tan','female','1989-10-25','married','3813531794','886 8805','0918 60502038','sollicitudin@sed.net'),(50,'Alvin','Paterno','Ayala','male','1989-06-30','single','2502684061','753 5604','0920 42831469','nulla@in.org.ph'),(51,'Paul','Dela Rosa','Gonzalez','male','1989-07-09','married','0004964685','388 4722','0918 62673135','tincidunt@pellentesque.ph'),(52,'Brian','Miguel','Choa','male','1985-02-09','married','0809312710','645 5657','0920 86681523','Phasellus@et.org.ph'),(53,'Soledad','Garces','Santillan','male','1983-08-04','married','7387204524','389 2348','0919 88470417','sem@felis.ph'),(54,'Lisa','Santillan','Ku','female','1975-04-07','single','5789750373','545 2716','0919 50022807','magnis@laoreet.net'),(55,'Efren','Jose','Santos','male','1981-04-13','married','9295710471','895 2608','0918 91708948','tincidunt@posuere.com'),(56,'Marianne','Cho','Rosario','female','1976-06-13','single','6439245698','894 6979','0916 92208109','lorem@aliquam.ph'),(57,'Carol','Reyes','Miguel','female','1986-11-05','married','3460239899','334 3680','0918 40529007','In@mattis.net'),(58,'Mary','Luna','Pangilinan','female','1977-10-01','married','9408315357','545 0782','0920 46406132','fermentum@cubilia.org.ph'),(59,'Allen','Villa','Ayala','female','1986-07-08','married','1420718802','633 5359','0919 32848787','pede@molestie.com'),(60,'Tammy','Montilla','Santos','female','1987-06-25','married','4681475043','456 2056','0916 83671761','pellentesque@molestie.org.ph');
UNLOCK TABLES;

#
# Table structure for table 'PersonAddress'
#

DROP TABLE IF EXISTS PersonAddress;
CREATE TABLE PersonAddress (
  personAddressID int(11) NOT NULL auto_increment,
  personID int(11) NOT NULL default '0',
  addressID int(11) NOT NULL default '0',
  PRIMARY KEY  (personAddressID),
  KEY personID (personID)
) TYPE=MyISAM;

#
# Dumping data for table 'PersonAddress'
#

LOCK TABLES PersonAddress WRITE;
INSERT INTO PersonAddress VALUES (1,1,2),(2,2,3),(3,3,4),(4,4,5),(5,5,6),(6,6,7),(7,7,8),(8,8,9),(9,9,10),(10,10,11),(11,11,12),(12,12,13),(13,13,14),(14,14,15),(15,15,16),(16,16,17),(17,17,18),(18,18,19),(19,19,20),(20,20,21),(21,21,22),(22,22,23),(23,23,24),(24,24,25),(25,25,26),(26,26,27),(27,27,28),(28,28,29),(29,29,30),(30,30,31),(31,31,32),(32,32,33),(33,33,34),(34,34,35),(35,35,36),(36,36,38),(37,37,39),(38,38,40),(39,39,41),(40,40,42),(41,41,43),(42,42,44),(43,43,45),(44,44,46),(45,45,48),(46,46,49),(47,47,50),(48,48,51),(49,49,52),(50,50,53),(51,51,54),(52,52,55),(53,53,56),(54,54,57),(55,55,58),(56,56,59),(57,57,60),(58,58,61),(59,59,62),(60,60,63);
UNLOCK TABLES;

#
# Table structure for table 'PlantsTrees'
#

DROP TABLE IF EXISTS PlantsTrees;
CREATE TABLE PlantsTrees (
  propertyID int(11) NOT NULL auto_increment,
  afsID int(11) default NULL,
  arpNumber varchar(32) default NULL,
  propertyIndexNumber varchar(32) default '',
  propertyAdministrator varchar(32) default '',
  verifiedBy varchar(32) default '',
  plottingsBy varchar(32) default '',
  notedBy varchar(32) default '',
  marketValue varchar(32) default '',
  kind varchar(32) default '',
  actualUse varchar(32) default '',
  adjustedMarketValue varchar(32) default '',
  assessmentLevel varchar(32) default '',
  assessedValue varchar(32) default '',
  previousOwner varchar(32) default '',
  previousAssessedValue varchar(32) default '',
  taxability varchar(32) default '',
  effectivity varchar(32) default '',
  appraisedBy varchar(32) default '',
  appraisedByDate varchar(32) default '',
  recommendingApproval varchar(32) default '',
  recommendingApprovalDate varchar(32) default '',
  approvedBy varchar(32) default '',
  approvedByDate varchar(32) default NULL,
  memoranda varchar(32) default NULL,
  postingDate varchar(32) default '',
  landPin varchar(32) default '',
  surveyNumber varchar(32) default NULL,
  productClass varchar(32) default '',
  areaPlanted varchar(32) default '',
  totalNumber varchar(32) default '',
  nonFruitBearing varchar(32) default '',
  fruitBearing varchar(32) default '',
  age varchar(32) default '',
  unitPrice varchar(32) default '',
  adjustmentFactor varchar(32) default '',
  percentAdjustment varchar(32) default '',
  valueAdjustment varchar(32) default '',
  dateCreated varchar(32) NOT NULL default '',
  createdBy varchar(32) NOT NULL default '',
  dateModified varchar(32) NOT NULL default '',
  modifiedBy varchar(32) NOT NULL default '',
  PRIMARY KEY  (propertyID)
) TYPE=MyISAM;

#
# Dumping data for table 'PlantsTrees'
#

LOCK TABLES PlantsTrees WRITE;
INSERT INTO PlantsTrees VALUES (1,1,'8161','2984','6','','','','141,154.56','Special','','95,985.10','42','40,313.74','1','1323101','Yes','25','','2002-10-1','','2002-11-28','','2003-04-17','amet\r\n posuere\r\n metus\r\n velit\r\n','2003-03-9','494683','2218','','987.04','64','51','13','31','2205.54','sed\r\n nunc','68','-32','1057807540','Randomizer','1057807540','Randomizer'),(2,1,'2785','3834','7','','','','57,711.36','Government','','36,935.27','6','2,216.12','1','3011111','Yes','68','','2003-07-7','','2003-01-14','','2002-08-20','platea\r\n dictumst\r\n Cum\r\n sociis','2002-09-5','694986','4549','','77.64','28','9','19','153','2061.12','et\r\n mi','64','-36','1057807540','Randomizer','1057807540','Randomizer'),(3,1,'2850','1636','8','','','','44,056.86','Commercial','','43,616.29','90','39,254.66','1','1110011','Yes','69','','2003-06-25','','2003-05-15','','2003-05-24','in\r\n pharetra\r\n augue\r\n dolor\r\n','2003-03-24','174247','7855','','757.83','17','1','16','159','2591.58','metus\r\n convallis','99','-1','1057807540','Randomizer','1057807540','Randomizer'),(4,2,'6942','7034','18','','','','123,021.48','Residential','','87,345.25','2','1,746.91','2','2330100','Yes','85','','2002-08-28','','2003-05-10','','2002-07-11','dictum\r\n Pellentesque\r\n libero\r\n','2003-04-24','945758','2947','','401.55','53','33','20','149','2321.16','orci\r\n posuere','71','-29','1057807558','Randomizer','1057807558','Randomizer'),(5,2,'9842','9573','19','','','','153,547.17','Agricultural','','18,425.66','17','3,132.36','2','1213110','Yes','33','','2003-06-10','','2002-07-22','','2003-01-23','enim\r\n ultrices\r\n malesuada\r\n Pr','2003-05-23','334381','6411','','460.02','87','44','43','103','1764.91','pede\r\n et','12','-88','1057807559','Randomizer','1057807559','Randomizer'),(6,3,'8571','4942','26','','','','14,814.36','Special','','10,666.34','33','3,519.89','1','3232001','No','10','','2002-09-21','','2003-03-10','','2003-07-2','luctus\r\n congue\r\n Nullam\r\n non\r\n','2003-03-4','645139','3784','','725.68','36','4','32','90','411.51','sagittis\r\n sit','72','-28','1057807883','Randomizer','1057807883','Randomizer'),(7,3,'6200','4246','27','','','','90,939.09','Commercial','','59,110.41','20','11,822.08','3','2232000','No','53','','2002-12-20','','2002-08-16','','2003-02-5','consectetuer\r\n adipiscing\r\n elit','2002-09-19','699124','7585','','68.91','33','26','7','129','2755.73','felis\r\n Suspendisse','65','-35','1057807883','Randomizer','1057807883','Randomizer'),(8,3,'0460','1918','28','','','','41,839.98','Agricultural','','36,819.18','34','12,518.52','1','1011111','Yes','95','','2002-09-28','','2002-08-29','','2002-11-26','Phasellus\r\n est\r\n Vestibulum\r\n s','2002-10-12','127218','1537','','706.55','21','14','7','197','1992.38','morbi\r\n tristique','88','-12','1057807883','Randomizer','1057807883','Randomizer'),(9,4,'1256','7291','38','','','','66,664.75','Government','','8,666.42','72','6,239.82','4','2202111','No','71','','2002-10-16','','2003-03-13','','2002-07-29','montes\r\n nascetur\r\n ridiculus\r\n','2002-07-10','286916','1631','','98.85','25','1','24','140','2666.59','posuere\r\n vitae','13','-87','1057816249','Randomizer','1057816249','Randomizer'),(10,4,'7784','4357','39','','','','91,482.05','Commercial','','46,655.85','91','42,456.82','4','1030111','No','88','','2003-05-17','','2003-06-29','','2003-05-20','Duis\r\n lacus\r\n Duis\r\n sit\r\n amet','2003-02-9','878314','1443','','684.98','55','55','0','178','1663.31','massa\r\n metus','51','-49','1057816249','Randomizer','1057816249','Randomizer'),(11,7,'3671','7024','49','','','','21,046.84','Agricultural','','17,047.94','70','11,933.56','8','2300010','Yes','94','','2003-01-31','','2002-11-2','','2002-10-15','wisi\r\n sit\r\n amet\r\n posuere\r\n me','2002-11-28','498111','5764','','87.52','23','2','21','95','915.08','Nulla\r\n laoreet','81','-19','1057826702','Randomizer','1057826702','Randomizer'),(12,7,'9419','2340','50','','','','36,863.02','Government','','36,863.02','22','8,109.86','2','2030100','Yes','23','','2002-09-21','','2003-06-18','','2003-04-17','non\r\n vulputate\r\n eu\r\n interdum\r','2002-09-30','767982','9922','','1.18','23','5','18','127','1602.74','lobortis\r\n magna','100','0','1057826702','Randomizer','1057826702','Randomizer'),(13,7,'5056','0003','51','','','','27,961.28','Commercial','','14,819.48','55','8,150.71','1','2102111','No','97','','2003-05-23','','2002-08-21','','2003-07-9','enim\r\n ultrices\r\n malesuada\r\n Pr','2003-04-24','149249','5882','','88.20','16','5','11','107','1747.58','nascetur\r\n ridiculus','53','-47','1057826702','Randomizer','1057826702','Randomizer');
UNLOCK TABLES;

#
# Table structure for table 'PlantsTreesActualUses'
#

DROP TABLE IF EXISTS PlantsTreesActualUses;
CREATE TABLE PlantsTreesActualUses (
  plantsTreesActualUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (plantsTreesActualUsesID)
) TYPE=MyISAM;

#
# Dumping data for table 'PlantsTreesActualUses'
#

LOCK TABLES PlantsTreesActualUses WRITE;
UNLOCK TABLES;

#
# Table structure for table 'PlantsTreesClasses'
#

DROP TABLE IF EXISTS PlantsTreesClasses;
CREATE TABLE PlantsTreesClasses (
  plantsTreesClassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (plantsTreesClassesID)
) TYPE=MyISAM;

#
# Dumping data for table 'PlantsTreesClasses'
#

LOCK TABLES PlantsTreesClasses WRITE;
UNLOCK TABLES;

#
# Table structure for table 'PropAssessKinds'
#

DROP TABLE IF EXISTS PropAssessKinds;
CREATE TABLE PropAssessKinds (
  propAssessKindsID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (propAssessKindsID)
) TYPE=MyISAM;

#
# Dumping data for table 'PropAssessKinds'
#

LOCK TABLES PropAssessKinds WRITE;
UNLOCK TABLES;

#
# Table structure for table 'PropAssessUses'
#

DROP TABLE IF EXISTS PropAssessUses;
CREATE TABLE PropAssessUses (
  propAssessUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (propAssessUsesID)
) TYPE=MyISAM;

#
# Dumping data for table 'PropAssessUses'
#

LOCK TABLES PropAssessUses WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Province'
#

DROP TABLE IF EXISTS Province;
CREATE TABLE Province (
  provinceID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  status varchar(255) default NULL,
  PRIMARY KEY  (provinceID)
) TYPE=MyISAM;

#
# Dumping data for table 'Province'
#

LOCK TABLES Province WRITE;
INSERT INTO Province VALUES (1,'MM','Metro Manila','active');
UNLOCK TABLES;

#
# Table structure for table 'RPTOP'
#

DROP TABLE IF EXISTS RPTOP;
CREATE TABLE RPTOP (
  rptopID int(11) NOT NULL auto_increment,
  ownerID varchar(11) default NULL,
  rptopNumber varchar(32) default NULL,
  rptopDate varchar(32) default NULL,
  taxableYear varchar(32) default NULL,
  cityTreasurer varchar(32) default NULL,
  cityAssessor varchar(32) default NULL,
  landTotalMarketValue varchar(32) default NULL,
  landTotalAssessedValue varchar(32) default NULL,
  plantTotalMarketValue varchar(32) default NULL,
  plantTotalAssessedValue varchar(32) default NULL,
  bldgTotalMarketValue varchar(32) default NULL,
  bldgTotalAssessedValue varchar(32) default NULL,
  machTotalMarketValue varchar(32) default NULL,
  machTotalAssessedValue varchar(32) default NULL,
  totalMarketValue varchar(32) default NULL,
  totalAssessedValue varchar(32) default NULL,
  dateCreated varchar(32) NOT NULL default '',
  createdBy varchar(32) NOT NULL default '',
  dateModified varchar(32) NOT NULL default '',
  modifiedBy varchar(32) NOT NULL default '',
  PRIMARY KEY  (rptopID)
) TYPE=MyISAM;

#
# Dumping data for table 'RPTOP'
#

LOCK TABLES RPTOP WRITE;
INSERT INTO RPTOP VALUES (1,'4','37093857646','2003-03-10','2003','','','1124686.18','112996.79','242922.78','81784.52','3117.62','-1317.3','5050858.29','1993.66','6421584.87','195457.67','1057813165','Randomizer','1057829279','1'),(2,'7','01461520195','2002-12-11','2003','','','','','','','','','','','0','0','1057817303','Randomizer','1057825026','1'),(3,'9','445445445','','2003','','','465','65.1','','','','','','','465','65.1','1057822826','45','1059724649','nobody'),(6,'13','445445446','','2002','','','465','65.1','','','4427.06','251.67','','','4892.06','316.77','1059722987','nobody','1059724598','nobody');
UNLOCK TABLES;

#
# Table structure for table 'RPTOPTD'
#

DROP TABLE IF EXISTS RPTOPTD;
CREATE TABLE RPTOPTD (
  rptoptdID int(11) NOT NULL auto_increment,
  rptopID int(11) default NULL,
  tdID int(11) default NULL,
  PRIMARY KEY  (rptoptdID)
) TYPE=MyISAM;

#
# Dumping data for table 'RPTOPTD'
#

LOCK TABLES RPTOPTD WRITE;
INSERT INTO RPTOPTD VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,10),(11,1,11),(12,1,12),(13,3,41),(14,2,29),(15,2,30),(16,6,41),(17,6,28);
UNLOCK TABLES;

#
# Table structure for table 'TD'
#

DROP TABLE IF EXISTS TD;
CREATE TABLE TD (
  tdID int(11) NOT NULL auto_increment,
  propertyID int(11) default NULL,
  propertyType varchar(32) default NULL,
  taxDeclarationNumber varchar(32) default NULL,
  provincialAssessor int(11) default NULL,
  provincialAssessorDate date default NULL,
  cityMunicipalAssessor int(11) default NULL,
  cityMunicipalAssessorDate date default NULL,
  cancelsTDNumber varchar(32) default NULL,
  canceledByTDNumber varchar(32) default NULL,
  taxBeginsWithTheYear varchar(32) default NULL,
  ceasesWithTheYear varchar(32) default NULL,
  enteredInRPARForYear varchar(32) default NULL,
  enteredInRPARForBy varchar(32) default NULL,
  previousOwner varchar(32) default NULL,
  previousAssessedValue varchar(32) default NULL,
  basicTax varchar(32) default NULL,
  sefTax varchar(32) default NULL,
  total varchar(32) default NULL,
  dateCreated varchar(32) NOT NULL default '',
  createdBy varchar(32) NOT NULL default '',
  dateModified varchar(32) NOT NULL default '',
  modifiedBy varchar(32) NOT NULL default '',
  PRIMARY KEY  (tdID),
  KEY tdID (tdID),
  KEY taxDeclarationNumber (taxDeclarationNumber)
) TYPE=MyISAM;

#
# Dumping data for table 'TD'
#

LOCK TABLES TD WRITE;
INSERT INTO TD VALUES (1,1,'Land','26340',0,'2003-04-01',0,'2003-01-07','43473','28766','2003','2005','2005','','1','27054','3145','4297','7442','1057807539','Randomizer','1057807539','Randomizer'),(2,2,'Land','51130',0,'2002-07-25',0,'2003-02-12','47389','17564','2003','2004','2008','','1','76960','9189','632','9821','1057807539','Randomizer','1057807539','Randomizer'),(3,3,'Land','42291',0,'2003-01-13',0,'2003-05-02','18239','26463','2003','2001','2001','','2','3218','8508','7157','15665','1057807539','Randomizer','1057807539','Randomizer'),(4,4,'Land','12560',0,'2002-09-25',0,'2003-05-01','92031','52892','2003','2007','2009','','4','35612','5875','1362','7237','1057807540','Randomizer','1057807540','Randomizer'),(5,5,'Land','26298',0,'2003-04-22',0,'2003-06-16','21272','49102','2004','2004','2001','','3','81530','7403','8430','15833','1057807540','Randomizer','1057807540','Randomizer'),(6,1,'PlantsTrees','98994',0,'2002-11-08',0,'2003-03-22','60818','41791','2004','2000','2004','','4','40811','1980','6062','8042','1057807540','Randomizer','1057807540','Randomizer'),(7,2,'PlantsTrees','55131',0,'2003-07-07',0,'2002-09-16','21248','41345','2004','2008','2001','','1','70694','4010','9449','13459','1057807540','Randomizer','1057807540','Randomizer'),(8,3,'PlantsTrees','79193',0,'2003-01-06',0,'2002-08-02','83788','32132','2003','2008','2005','','2','85220','3694','2067','5761','1057807540','Randomizer','1057807540','Randomizer'),(9,1,'ImprovementsBuildings','52950',0,'2002-08-02',0,'2003-06-13','73718','83400','2004','2008','2008','','5','50878','7535','5101','12636','1057807540','Randomizer','1057807540','Randomizer'),(10,2,'ImprovementsBuildings','45987',0,'2003-01-12',0,'2003-04-22','07600','46389','2004','2008','2007','','1','67553','5576','3752','9328','1057807540','Randomizer','1057807540','Randomizer'),(11,1,'Machineries','31444',0,'2002-12-07',0,'2002-08-18','44476','39962','2004','2007','2003','','7','82735','635','3926','4561','1057807540','Randomizer','1057807540','Randomizer'),(12,2,'Machineries','53048',0,'2003-06-17',0,'2002-08-11','99651','03731','2003','2001','2005','','8','58972','3584','2365','5949','1057807540','Randomizer','1057807540','Randomizer'),(13,6,'Land','34665',0,'2002-12-05',0,'2002-07-27','59618','00516','2003','2002','2008','','3','90161','3187','1485','4672','1057807558','Randomizer','1057807558','Randomizer'),(14,7,'Land','21708',0,'2003-06-30',0,'2003-06-13','52230','94644','2004','2004','2002','','8','12175','3237','1352','4589','1057807558','Randomizer','1057807558','Randomizer'),(15,8,'Land','84580',0,'2002-11-15',0,'2002-10-31','51874','81016','2003','2009','2006','','16','31444','5456','7851','13307','1057807558','Randomizer','1057807558','Randomizer'),(16,9,'Land','25398',0,'2002-08-04',0,'2002-10-29','67507','42144','2003','2009','2003','','3','76767','6675','3222','9897','1057807558','Randomizer','1057807558','Randomizer'),(17,4,'PlantsTrees','14516',0,'2002-10-27',0,'2003-03-23','11439','21544','2004','2006','2005','','17','32351','2526','864','3390','1057807559','Randomizer','1057807559','Randomizer'),(18,5,'PlantsTrees','17543',0,'2003-01-09',0,'2002-09-14','99371','87994','2003','2003','2002','','14','39754','7189','478','7667','1057807559','Randomizer','1057807559','Randomizer'),(19,3,'ImprovementsBuildings','22228',0,'2002-09-09',0,'2002-09-04','39017','04970','2004','2005','2004','','18','99034','4470','3068','7538','1057807559','Randomizer','1057807559','Randomizer'),(20,4,'ImprovementsBuildings','57889',0,'2003-06-02',0,'2002-10-01','82857','90674','2004','2001','2004','','21','53770','8479','7447','15926','1057807559','Randomizer','1057807559','Randomizer'),(21,3,'Machineries','35182',0,'2002-10-21',0,'2003-04-16','50775','71455','2003','2002','2000','','10','16784','4939','7844','12783','1057807559','Randomizer','1057807559','Randomizer'),(22,10,'Land','97235',0,'2002-09-17',0,'2003-06-12','02707','88381','2004','2007','2006','','18','13096','9775','484','10259','1057807883','Randomizer','1057807883','Randomizer'),(23,11,'Land','75557',0,'2003-05-25',0,'2003-02-21','38228','55979','2003','2009','2008','','20','89528','5724','1540','7264','1057807883','Randomizer','1057807883','Randomizer'),(24,6,'PlantsTrees','22746',0,'2003-07-03',0,'2003-01-17','22321','91587','2004','2003','2001','','1','51591','1659','8030','9689','1057807883','Randomizer','1057807883','Randomizer'),(25,7,'PlantsTrees','07207',0,'2003-06-02',0,'2002-08-04','72164','28300','2003','2008','2004','','3','48540','2168','4792','6960','1057807883','Randomizer','1057807883','Randomizer'),(26,8,'PlantsTrees','69434',0,'2003-05-17',0,'2003-05-26','44717','82164','2004','2009','2002','','24','72611','7506','739','8245','1057807883','Randomizer','1057807883','Randomizer'),(27,5,'ImprovementsBuildings','20807',0,'2002-10-10',0,'2003-05-02','68242','92516','2004','2003','2003','','21','59996','1895','7174','9069','1057807883','Randomizer','1057807883','Randomizer'),(28,6,'ImprovementsBuildings','96045',0,'2002-11-20',0,'2002-08-03','32837','77656','2003','2004','2007','','14','64517','4944','6220','11164','1057807883','Randomizer','1057807883','Randomizer'),(29,7,'ImprovementsBuildings','41494',0,'2003-02-28',0,'2002-11-08','82749','74137','2004','2005','2008','','22','64174','8636','2515','11151','1057807883','Randomizer','1057807883','Randomizer'),(30,8,'ImprovementsBuildings','13336',0,'2003-03-06',0,'2002-11-01','72185','74729','2004','2005','2000','','30','73690','6535','5652','12187','1057807883','Randomizer','1057807883','Randomizer'),(31,4,'Machineries','87361',0,'2003-03-12',0,'2003-01-16','79595','16140','2004','2007','2003','','2','88789','8688','3343','12031','1057807883','Randomizer','1057807883','Randomizer'),(32,5,'Machineries','24204',0,'2003-06-02',0,'2002-12-01','30916','74104','2003','2008','2008','','34','17454','3835','1021','4856','1057807883','Randomizer','1057807883','Randomizer'),(33,12,'Land','15223',0,'2002-07-29',0,'2003-01-12','57965','35858','2004','2002','2003','','26','33906','373','2258','2631','1057816249','Randomizer','1057816249','Randomizer'),(34,13,'Land','05421',0,'2003-07-02',0,'2002-11-28','45623','37751','2004','2006','2007','','14','14347','2459','5838','8297','1057816249','Randomizer','1057816249','Randomizer'),(35,9,'PlantsTrees','31957',0,'2002-09-21',0,'2002-11-08','64130','45333','2003','2008','2004','','31','57424','236','9028','9264','1057816249','Randomizer','1057816249','Randomizer'),(36,10,'PlantsTrees','48781',0,'2003-03-29',0,'2002-11-21','17804','08023','2004','2009','2003','','39','92973','8268','3781','12049','1057816249','Randomizer','1057816249','Randomizer'),(37,9,'ImprovementsBuildings','52190',0,'2003-05-15',0,'2002-10-21','71764','68240','2004','2002','2002','','18','52310','8802','6753','15555','1057816249','Randomizer','1057816249','Randomizer'),(38,10,'ImprovementsBuildings','13077',0,'2002-08-22',0,'2003-05-26','43799','23919','2004','2004','2005','','3','64485','5667','4693','10360','1057816250','Randomizer','1057816250','Randomizer'),(39,11,'ImprovementsBuildings','86666',0,'2003-04-09',0,'2002-08-16','41789','39294','2003','2009','2003','','31','43493','9026','5128','14154','1057816250','Randomizer','1057816250','Randomizer'),(40,6,'Machineries','11620',0,'2003-01-06',0,'2003-03-30','10538','14697','2004','2000','2000','','13','44134','9379','7747','17126','1057816250','Randomizer','1057816250','Randomizer'),(41,14,'Land','444-4444',NULL,NULL,NULL,NULL,'444-4444',NULL,'2004','2007',NULL,NULL,NULL,'44',NULL,NULL,NULL,'1057821264','45','1057821264','45'),(42,15,'Land','03084',0,'2002-10-09',0,'2003-05-28','23546','44784','2003','2000','2005','','19','12687','6193','3879','10072','1057826702','Randomizer','1057826702','Randomizer'),(43,16,'Land','13094',0,'2003-04-30',0,'2003-02-16','99591','18494','2003','2004','2003','','23','39639','951','4193','5144','1057826702','Randomizer','1057826702','Randomizer'),(44,17,'Land','30446',0,'2002-12-14',0,'2003-04-27','80307','53418','2003','2009','2009','','23','66302','4766','6625','11391','1057826702','Randomizer','1057826702','Randomizer'),(45,11,'PlantsTrees','61449',0,'2003-04-07',0,'2003-07-05','72477','50788','2003','2008','2000','','22','62557','2001','2058','4059','1057826702','Randomizer','1057826702','Randomizer'),(46,12,'PlantsTrees','46900',0,'2002-12-22',0,'2003-05-21','05323','73743','2004','2001','2002','','8','43671','7516','2464','9980','1057826702','Randomizer','1057826702','Randomizer'),(47,13,'PlantsTrees','91199',0,'2003-02-11',0,'2003-04-21','73799','43188','2003','2004','2005','','5','15449','905','7137','8042','1057826702','Randomizer','1057826702','Randomizer'),(48,12,'ImprovementsBuildings','20262',0,'2003-04-26',0,'2003-05-10','07963','77901','2003','2008','2000','','26','3510','7275','2838','10113','1057826702','Randomizer','1057826702','Randomizer'),(49,13,'ImprovementsBuildings','11928',0,'2002-12-15',0,'2003-03-13','49024','82800','2003','2004','2005','','26','86889','5921','3701','9622','1057826702','Randomizer','1057826702','Randomizer'),(50,14,'ImprovementsBuildings','71202',0,'2003-03-12',0,'2002-09-21','96207','42559','2003','2001','2001','','10','97854','6546','608','7154','1057826702','Randomizer','1057826702','Randomizer'),(51,15,'ImprovementsBuildings','84863',0,'2002-08-14',0,'2003-04-17','75193','27366','2003','2003','2007','','54','86996','9056','4800','13856','1057826702','Randomizer','1057826702','Randomizer'),(52,7,'Machineries','35604',0,'2002-10-26',0,'2002-12-01','65497','57967','2004','2005','2003','','27','58992','8779','7172','15951','1057826702','Randomizer','1057826702','Randomizer'),(53,8,'Machineries','49440',0,'2002-09-02',0,'2002-12-03','83899','08915','2003','2001','2007','','9','35618','3886','7824','11710','1057826702','Randomizer','1057826702','Randomizer'),(54,9,'Machineries','95038',0,'2003-01-24',0,'2003-05-13','74349','40083','2004','2008','2002','','47','2677','6428','7303','13731','1057826702','Randomizer','1057826702','Randomizer'),(55,10,'Machineries','37388',0,'2003-02-24',0,'2002-07-18','37065','55242','2004','2001','2003','','26','64617','8102','102','8204','1057826702','Randomizer','1057826702','Randomizer'),(56,11,'Machineries','64387',0,'2003-05-11',0,'2003-01-23','89215','93365','2004','2001','2004','','30','76597','4288','6864','11152','1057826702','Randomizer','1057826702','Randomizer'),(57,18,'Land','1213121312',NULL,NULL,NULL,NULL,'1214121412',NULL,'2004','2007',NULL,NULL,NULL,'30000',NULL,NULL,NULL,'1057828478','45','1057828478','45');
UNLOCK TABLES;

#
# Table structure for table 'active_sessions'
#

DROP TABLE IF EXISTS active_sessions;
CREATE TABLE active_sessions (
  sid varchar(32) NOT NULL default '',
  name varchar(32) NOT NULL default '',
  val text,
  changed varchar(14) NOT NULL default '',
  PRIMARY KEY  (name,sid),
  KEY changed (changed)
) TYPE=MyISAM;

#
# Dumping data for table 'active_sessions'
#

LOCK TABLES active_sessions WRITE;
UNLOCK TABLES;

#
# Table structure for table 'active_sessions_split'
#

DROP TABLE IF EXISTS active_sessions_split;
CREATE TABLE active_sessions_split (
  ct_sid varchar(32) NOT NULL default '',
  ct_name varchar(32) NOT NULL default '',
  ct_pos varchar(6) NOT NULL default '',
  ct_val text,
  ct_changed varchar(14) NOT NULL default '',
  PRIMARY KEY  (ct_name,ct_sid,ct_pos),
  KEY ct_changed (ct_changed)
) TYPE=MyISAM;

#
# Dumping data for table 'active_sessions_split'
#

LOCK TABLES active_sessions_split WRITE;
INSERT INTO active_sessions_split VALUES ('71620c81fd7da390bb7be75b08ce30c7','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905175943'),('ee28468b418185cfa79394c41689a122','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905180427'),('15be23982335bcd56668718dd96159c1','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905180444'),('99defb046310d6333bbe09c4ce90aff0','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905180501'),('1a4a085bcec5ecf089474e5218fab573','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905182516'),('00c0e28fa2b487e57a63e8ecc1c2ebd1','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905183147'),('4ca9a53f1e2224321a46d1177ca919f6','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905183317'),('0d2a1c38833f46a969dd0d2d7035d4ae','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905183610'),('cc3e83da0332b7666738b9b6c8996fc8','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906141707'),('7e9fad822e2bad35b67367101806f4ca','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ3Rlc3QnXSA9ICcxJzsgJEdMT0JBTFNbJ2F1dGgnXSA9IG5ldyBycHRzX0NoYWxsZW5nZV9BdXRoOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoID0gYXJyYXkoKTsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsndWlkJ10gPSAnbm9ib2R5JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWyd0ZXN0J10gPSAnJzsg','20030906142235'),('91cc6fb51d86f848c893e65e763d0530','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906144616'),('0cf428f61ba7a38dce86295f39e67ed1','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906145031'),('efcfb3e4b752d33f1814eee26d36e65a','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906145051'),('cccf2eb5057be6fb7a3254430f11a673','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906145247'),('f5357e4a3eb75cb55fa61573152d5f2c','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906151143'),('f3046fb7112146018262132f782419e4','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906151355'),('a366fa040c8466d9f37c5073ecfea1f4','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906151433'),('cc1d879896f631de7dec3519b2944461','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906151445'),('d8398c07ee070881ebc2941fd51d071f','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905163839'),('df9e6271e6f7987877cf306614b99129','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905162634'),('be8b51e91a7a9bd5f1788f7700341221','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905163425'),('7afdff8bf09808ba64458fa9b0493946','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905162541'),('b61af003236fc3935f27797b02862ba1','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905161437'),('972f12f3b15bbcc42d4758fb72892b2c','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905161858'),('bb4e5ae862180e88556e19bcca41a046','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905161306'),('c0b27ec4e67c03ed509647cdae9c903a','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905160740'),('6289889085a14633cd14fbb543137677','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905155835'),('2cbad595d39df842422741ec8274b455','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905155729'),('f5ade56ede71b68de4ad63519d7af646','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905154637'),('c2546f69d0f113be3fa2ca02b91868f8','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905154439'),('c34c79bfee63925c0d0c4ee015809c11','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905154534'),('0cbc1a0e7e4298fa2d12f399eabeb062','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905152932'),('7e032ff8cedf1e013688698fea8d848a','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905163030'),('8ef281dfa48549b9ea6432a0e532c026','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905152849'),('1557d9623d4a75ba1222f2dd3e599390','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905152756'),('289f838dbbcdd020db13c6264ccd7eeb','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ3Rlc3QnXSA9ICcxJzsgJEdMT0JBTFNbJ2F1dGgnXSA9IG5ldyBycHRzX0NoYWxsZW5nZV9BdXRoOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoID0gYXJyYXkoKTsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsndWlkJ10gPSAnbm9ib2R5JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWyd0ZXN0J10gPSAnJzsg','20030906142349'),('efe5f895376160cc8049fc544f945569','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030905152436'),('d59f07d66eb3edd7d020649642eab03c','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906142333'),('f55b779c2b0770e008ece8b79bb6b734','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906142558'),('84e0cf688ed332690eccc0f723548f7f','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ3Rlc3QnXSA9ICcxJzsgJEdMT0JBTFNbJ2F1dGgnXSA9IG5ldyBycHRzX0NoYWxsZW5nZV9BdXRoOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoID0gYXJyYXkoKTsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsndWlkJ10gPSAnbm9ib2R5JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWyd0ZXN0J10gPSAnJzsg','20030905164852'),('36f5f7d64602c3c9c2a6e2c2ff59aadf','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906143937'),('a2faef6f2593b54e9b611718014b501b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906142758'),('6929a139bf0cf972beb502649e8914d8','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906143420'),('7dd31e80a4937b8ae661802238dfe695','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdub2JvZHknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydwZXJtJ10gPSAnJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsnZXhwJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3JlZnJlc2gnXSA9ICcyMTQ3NDgzNjQ3Jzsg','20030906143640');
UNLOCK TABLES;

#
# Table structure for table 'auth_user_md5'
#

DROP TABLE IF EXISTS auth_user_md5;
CREATE TABLE auth_user_md5 (
  userID int(11) NOT NULL auto_increment,
  userType varchar(32) NOT NULL default '',
  username varchar(32) NOT NULL default '',
  password varchar(32) NOT NULL default '',
  personID int(11) NOT NULL default '0',
  dateCreated datetime NOT NULL default '0000-00-00 00:00:00',
  dateModified timestamp(14) NOT NULL,
  status varchar(11) default NULL,
  perms varchar(32) default NULL,
  PRIMARY KEY  (userID),
  KEY username (username)
) TYPE=MyISAM;

#
# Dumping data for table 'auth_user_md5'
#

LOCK TABLES auth_user_md5 WRITE;
INSERT INTO auth_user_md5 VALUES (43,'Super User','nelson','541f98322eaea41f2b2e3d023972f098',17,'2003-05-13 00:00:00',20030709000000,'enabled',NULL),(1,'Super User','Admin','5f4dcc3b5aa765d61d8327deb882cf99',1,'2003-05-13 00:00:00',20030716230747,'disabled',NULL),(44,'Super User','jiji','a601fbdf8a8fb6bbebf9e68e7100aff5',73,'2003-07-09 00:00:00',20030709000000,'enabled',NULL),(45,'Super User','danny','b7bee6b36bd35b773132d4e3a74c2bb5',35,'2003-07-10 00:00:00',20030710000000,'enabled',NULL);
UNLOCK TABLES;

#
# Table structure for table 'collectionPayments'
#

DROP TABLE IF EXISTS collectionPayments;
CREATE TABLE collectionPayments (
  collectionID bigint(20) NOT NULL default '0',
  paymentID bigint(20) NOT NULL default '0',
  PRIMARY KEY  (paymentID),
  KEY byCollection (collectionID)
) TYPE=MyISAM;

#
# Dumping data for table 'collectionPayments'
#

LOCK TABLES collectionPayments WRITE;
INSERT INTO collectionPayments VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,15),(2,16),(2,17),(2,18),(2,19),(2,20),(2,21),(2,22),(2,23),(2,24),(2,25),(2,26),(2,27),(2,28),(2,29),(2,30),(2,31),(2,32),(2,33),(2,34),(2,35);
UNLOCK TABLES;

#
# Table structure for table 'collections'
#

DROP TABLE IF EXISTS collections;
CREATE TABLE collections (
  collectionID bigint(20) unsigned NOT NULL auto_increment,
  collectionDate date NOT NULL default '0000-00-00',
  collectionSum double(14,2) NOT NULL default '0.00',
  receiptNum varchar(10) default NULL,
  receivedFrom varchar(50) default NULL,
  kindOfPayment set('cash','check','treasury note') default NULL,
  checkNum varchar(15) default NULL,
  checkDate date default NULL,
  oldReceiptNum varchar(10) default NULL,
  oldReceiptDate date default NULL,
  municipality varchar(10) NOT NULL default '',
  PRIMARY KEY  (collectionID,municipality),
  KEY byCollection (collectionID)
) TYPE=MyISAM;

#
# Dumping data for table 'collections'
#

LOCK TABLES collections WRITE;
INSERT INTO collections VALUES (1,'2003-08-29',1.14,'654789798','Andre Shwartz Berlusconni','check','123456465','2003-08-28','','0000-00-00',''),(2,'2003-08-29',4.85,'12345678','Andre Shwartz Berlusconni','check','112345','2003-03-03','','0000-00-00',''),(3,'2003-09-06',1.72,'123456','Andre Shwartz Berlusconni','cash','','0000-00-00','','0000-00-00','');
UNLOCK TABLES;

#
# Table structure for table 'dues'
#

DROP TABLE IF EXISTS dues;
CREATE TABLE dues (
  dueID bigint(20) unsigned NOT NULL auto_increment,
  basic double(14,2) NOT NULL default '0.00',
  penalty double(14,2) NOT NULL default '0.00',
  sef double(14,2) NOT NULL default '0.00',
  idle double(14,2) NOT NULL default '0.00',
  tdID bigint(20) default NULL,
  dueDate date default NULL,
  currentDate datetime default NULL,
  paidBasic double(14,2) NOT NULL default '0.00',
  paidSEF double(14,2) NOT NULL default '0.00',
  paidPenalty double(14,2) NOT NULL default '0.00',
  paidIdle double(14,2) NOT NULL default '0.00',
  paymentMode varchar(15) default NULL,
  paidQuarters int(11) default NULL,
  amnesty varchar(10) NOT NULL default 'No',
  PRIMARY KEY  (dueID),
  KEY byTDnum (tdID),
  KEY byDate (dueDate),
  KEY byDueID (dueID)
) TYPE=MyISAM;

#
# Dumping data for table 'dues'
#

LOCK TABLES dues WRITE;
INSERT INTO dues VALUES (1,0.50,0.00,0.25,0.25,1,'2003-01-01','2003-09-06 14:22:30',0.00,0.00,0.00,0.00,'Annual',0,'No'),(2,0.50,0.00,0.25,0.00,1,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(3,0.50,0.00,0.25,0.00,1,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(4,0.78,0.00,0.39,0.00,2,'2003-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(5,0.78,0.00,0.39,0.00,2,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(6,0.10,0.00,0.05,0.00,4,'2003-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(7,0.10,0.00,0.05,0.00,4,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(8,0.10,0.00,0.05,0.00,4,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(9,0.10,0.00,0.05,0.00,4,'2006-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(10,0.10,0.00,0.05,0.00,4,'2007-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(11,0.54,0.00,0.27,0.00,5,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(12,0.22,0.00,0.11,0.00,7,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(13,0.22,0.00,0.11,0.00,7,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(14,0.22,0.00,0.11,0.00,7,'2006-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(15,0.22,0.00,0.11,0.00,7,'2007-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(16,0.22,0.00,0.11,0.00,7,'2008-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(17,0.24,0.00,0.12,0.00,8,'2003-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(18,0.24,0.00,0.12,0.00,8,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(19,0.24,0.00,0.12,0.00,8,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(20,0.24,0.00,0.12,0.00,8,'2006-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(21,0.24,0.00,0.12,0.00,8,'2007-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(22,0.24,0.00,0.12,0.00,8,'2008-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(23,0.00,0.00,0.00,0.00,9,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(24,0.00,0.00,0.00,0.00,9,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(25,0.00,0.00,0.00,0.00,9,'2006-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(26,0.00,0.00,0.00,0.00,9,'2007-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(27,0.00,0.00,0.00,0.00,9,'2008-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(28,0.00,0.00,0.00,0.00,10,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(29,0.00,0.00,0.00,0.00,10,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(30,0.00,0.00,0.00,0.00,10,'2006-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(31,0.00,0.00,0.00,0.00,10,'2007-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(32,0.00,0.00,0.00,0.00,10,'2008-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(33,12.89,0.00,6.44,0.00,11,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(34,12.89,0.00,6.44,0.00,11,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(35,12.89,0.00,6.44,0.00,11,'2006-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(36,12.89,0.00,6.44,0.00,11,'2007-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(37,1.30,0.00,0.65,0.00,14,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(38,0.62,0.00,0.31,0.00,15,'2003-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(39,0.62,0.00,0.31,0.00,15,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(40,0.62,0.00,0.31,0.00,15,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(41,0.62,0.00,0.31,0.00,15,'2006-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(42,0.62,0.00,0.31,0.00,15,'2007-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(43,0.62,0.00,0.31,0.00,15,'2008-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(44,0.62,0.00,0.31,0.00,15,'2009-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(45,4.98,0.00,2.49,0.00,16,'2003-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(46,4.98,0.00,2.49,0.00,16,'2004-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(47,4.98,0.00,2.49,0.00,16,'2005-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(48,4.98,0.00,2.49,0.00,16,'2006-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(49,4.98,0.00,2.49,0.00,16,'2007-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(50,4.98,0.00,2.49,0.00,16,'2008-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(51,4.98,0.00,2.49,0.00,16,'2009-01-01','2003-09-05 17:59:43',0.00,0.00,0.00,0.00,'Annual',0,'No'),(52,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(53,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(54,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(55,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(56,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(57,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(58,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(59,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(60,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(61,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(62,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(63,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:21:10',0.00,0.00,0.00,0.00,'Annual',0,'No'),(64,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:22:25',0.00,0.00,0.00,0.00,'Annual',0,'No'),(65,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:22:30',0.00,0.00,0.00,0.00,'Annual',0,'No'),(66,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:22:35',0.00,0.00,0.00,0.00,'Annual',0,'No'),(67,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:48',0.00,0.00,0.00,0.00,'Annual',0,'No'),(68,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:48',0.00,0.00,0.00,0.00,'Annual',0,'No'),(69,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:48',0.00,0.00,0.00,0.00,'Annual',0,'No'),(70,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:48',0.00,0.00,0.00,0.00,'Annual',0,'No'),(71,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:48',0.00,0.00,0.00,0.00,'Annual',0,'No'),(72,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:49',0.00,0.00,0.00,0.00,'Annual',0,'No'),(73,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:49',0.00,0.00,0.00,0.00,'Annual',0,'No'),(74,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:49',0.00,0.00,0.00,0.00,'Annual',0,'No'),(75,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:49',0.00,0.00,0.00,0.00,'Annual',0,'No'),(76,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:49',0.00,0.00,0.00,0.00,'Annual',0,'No'),(77,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:49',0.00,0.00,0.00,0.00,'Annual',0,'No'),(78,0.00,0.00,0.00,0.00,0,'1970-01-01','2003-09-06 14:23:49',0.00,0.00,0.00,0.00,'Annual',0,'No'),(79,0.00,0.00,0.00,0.00,3,'2003-01-01','2003-09-06 14:25:58',0.00,0.00,0.00,0.00,'Annual',0,'No'),(80,0.00,0.00,0.00,0.00,12,'2003-01-01','2003-09-06 14:36:40',0.00,0.00,0.00,0.00,'Annual',0,'No');
UNLOCK TABLES;

#
# Table structure for table 'payments'
#

DROP TABLE IF EXISTS payments;
CREATE TABLE payments (
  paymentID bigint(20) unsigned NOT NULL auto_increment,
  amount double(14,2) default '0.00',
  application set('full','Q1','Q2','Q3','Q4') default NULL,
  dueID bigint(20) NOT NULL default '0',
  dueType varchar(10) NOT NULL default '',
  receiptNum varchar(15) NOT NULL default '',
  PRIMARY KEY  (paymentID,dueID),
  KEY dueID (dueID)
) TYPE=MyISAM;

#
# Dumping data for table 'payments'
#

LOCK TABLES payments WRITE;
INSERT INTO payments VALUES (1,0.25,'full',1,'sef','654789798'),(2,0.50,'full',1,'basic','654789798'),(3,0.25,'full',1,'idle','654789798'),(4,0.14,'full',1,'penalty','654789798'),(5,0.00,'full',1,'pd1185','654789798'),(6,0.39,'full',2,'sef','12345678'),(7,0.78,'full',2,'basic','12345678'),(8,0.39,'full',2,'idle','12345678'),(9,0.22,'full',2,'penalty','12345678'),(10,0.00,'full',2,'pd1185','12345678'),(11,0.14,'full',3,'sef','12345678'),(12,0.28,'full',3,'basic','12345678'),(13,0.00,'full',3,'idle','12345678'),(14,0.06,'full',3,'penalty','12345678'),(15,0.00,'full',3,'pd1185','12345678'),(16,0.05,'full',4,'sef','12345678'),(17,0.10,'full',4,'basic','12345678'),(18,0.05,'full',4,'idle','12345678'),(19,0.03,'full',4,'penalty','12345678'),(20,0.00,'full',4,'pd1185','12345678'),(21,0.27,'full',5,'sef','12345678'),(22,0.54,'full',5,'basic','12345678'),(23,0.00,'full',5,'idle','12345678'),(24,0.11,'full',5,'penalty','12345678'),(25,0.00,'full',5,'pd1185','12345678'),(26,0.40,'full',6,'sef','12345678'),(27,0.80,'full',6,'basic','12345678'),(28,0.00,'full',6,'idle','12345678'),(29,0.17,'full',6,'penalty','12345678'),(30,0.00,'full',6,'pd1185','12345678'),(31,0.02,'full',7,'sef','12345678'),(32,0.04,'full',7,'basic','12345678'),(33,0.00,'full',7,'idle','12345678'),(34,0.01,'full',7,'penalty','12345678'),(35,0.00,'full',7,'pd1185','12345678');
UNLOCK TABLES;

