-- MySQL dump 8.22
--
-- Host: localhost    Database: nccbiz
---------------------------------------------------------
-- Server version	3.23.53-log

--
-- Table structure for table 'AFS'
--

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
  PRIMARY KEY  (afsID)
) TYPE=InnoDB;

--
-- Dumping data for table 'AFS'
--


INSERT INTO AFS VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (4,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (6,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (7,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (8,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (9,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (10,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (11,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (12,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (13,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (14,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (15,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (16,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (17,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (18,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (19,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (20,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (21,21,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (22,22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (23,23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (24,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (25,25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (26,26,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (27,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (28,28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (29,29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (30,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (31,31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (32,32,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (33,33,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (34,34,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (35,35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (36,36,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (37,37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (38,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (39,39,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (40,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (41,41,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (42,42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (43,43,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (44,44,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (45,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (46,46,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (47,47,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (48,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (49,49,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (50,50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (51,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (52,52,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (53,53,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (54,54,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (55,55,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (56,56,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (57,57,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (58,58,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (59,59,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (60,60,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (61,61,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (62,62,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (63,63,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO AFS VALUES (64,64,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (65,65,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'9758132','11617122','6735122','7665223','','','10612322','9497011','29557688','32134577',NULL,NULL,NULL);
INSERT INTO AFS VALUES (66,66,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (67,67,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (68,68,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1160000','279680','500','125','0','0','5000','4654654654','3488500','13964800177',NULL,NULL,NULL);
INSERT INTO AFS VALUES (69,69,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (70,70,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (71,71,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO AFS VALUES (72,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (73,73,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1015000','607500','800','280','','','','','2031601','1216168',NULL,NULL,NULL);
INSERT INTO AFS VALUES (74,74,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (75,75,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'500000','405000','75000','37500','','','','','1150575','885442',NULL,NULL,NULL);
INSERT INTO AFS VALUES (76,76,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11066.2','3660.96','879862','183011.2','','','270000','216000','9223612.2','2586886.8',NULL,NULL,NULL);
INSERT INTO AFS VALUES (77,77,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11066.2','3602.08','0','0','','','','','292302.13','94662.05',NULL,NULL,NULL);
INSERT INTO AFS VALUES (78,78,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (79,79,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0','0','0','','','0','0','152399054','2.3225462821E+12',NULL,NULL,NULL);
INSERT INTO AFS VALUES (80,98,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','242','2.93','','','','','242','2.93',NULL,NULL,NULL);
INSERT INTO AFS VALUES (81,101,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (82,102,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12345','0','','','','','','','24690','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (83,103,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3108','0','777','0','','','777','0','34953','16650',NULL,NULL,NULL);
INSERT INTO AFS VALUES (84,104,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'888','0','888','0','','','888','0','22200','6216',NULL,NULL,NULL);
INSERT INTO AFS VALUES (85,105,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (86,106,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0','','','','','','','0','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (87,107,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'444','0','0','0','','','','','7548','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (88,108,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (89,109,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0','','','','','','','0','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (90,110,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'148135799605','2.22','0','0','','','','','592627109911','82.14',NULL,NULL,NULL);
INSERT INTO AFS VALUES (91,111,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (92,112,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0','','','','','','','0','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (93,113,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (94,114,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (95,115,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1443','0','','','','','','','2886','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (96,116,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'999','0','','','','','','','2997','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (97,117,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'13579','0','1234','0','','','1234','0','32094','2468',NULL,NULL,NULL);
INSERT INTO AFS VALUES (98,118,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','0','789','','','','','0','1578',NULL,NULL,NULL);
INSERT INTO AFS VALUES (101,121,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'78910','0','','','','','','','78910','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (102,122,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','0','78911','','','','','0','157822',NULL,NULL,NULL);
INSERT INTO AFS VALUES (103,120,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (104,123,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2500','550','30','3','2000','900','1300','500','27464304460','1.17507479117E+14',NULL,NULL,NULL);
INSERT INTO AFS VALUES (105,124,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'88','0','','','','','','','88','0',NULL,NULL,NULL);
INSERT INTO AFS VALUES (106,125,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','0','454','','','','','0','1816',NULL,NULL,NULL);
INSERT INTO AFS VALUES (107,126,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);
INSERT INTO AFS VALUES (108,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','',NULL,NULL,NULL);

--
-- Table structure for table 'Address'
--

CREATE TABLE Address (
  addressID int(11) NOT NULL auto_increment,
  number varchar(50) default NULL,
  street varchar(50) default NULL,
  barangay varchar(50) default NULL,
  district varchar(50) default NULL,
  municipalityCity varchar(50) default NULL,
  province varchar(50) default NULL,
  PRIMARY KEY  (addressID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Address'
--


INSERT INTO Address VALUES (1,'39','G.Apacible Ave.','Post Proper N','District IV','Malabon','Metro Manila');
INSERT INTO Address VALUES (2,'79','Lakandola Rd.','Bangkol','District II','Malabon','Metro Manila');
INSERT INTO Address VALUES (3,'198','F.Ma Guerrero St.','Poblacion','District VII','Mandaluyong','Metro Manila');
INSERT INTO Address VALUES (4,'44','P.Paterno St.','South Cembo','District V','Makati','Metro Manila');
INSERT INTO Address VALUES (5,'60','A.Luna Rd.','San Isidro','District III','Navotas','Metro Manila');
INSERT INTO Address VALUES (6,'164','G.del Pilar Rd.','Cembo','District V','Taguig','Metro Manila');
INSERT INTO Address VALUES (7,'144','R.Palma St.','Comembo','District VII','Muntinlupa','Metro Manila');
INSERT INTO Address VALUES (8,'192','A.Luna Ave.','Magallanes','District II','Taguig','Metro Manila');
INSERT INTO Address VALUES (9,'132','A.Mabini Rd.','Palanan','District III','Quezon City','Metro Manila');
INSERT INTO Address VALUES (10,'193','A.Mabini St.','Palanan','District III','Las Pinas','Metro Manila');
INSERT INTO Address VALUES (11,'42','A.Esteban Ave.','Post Proper S','District VI','Mandaluyong','Metro Manila');
INSERT INTO Address VALUES (12,'171','L.Rivera St.','La Paz','District V','Marikina','Metro Manila');
INSERT INTO Address VALUES (13,'65','M.Silang Blvd.','Post Proper N','District I','Mandaluyong','Metro Manila');
INSERT INTO Address VALUES (14,'161','T.Martirez St.','Olympia','District II','Marikina','Metro Manila');
INSERT INTO Address VALUES (15,'8','J.Luna Blvd.','Sta. Cruz','District III','Pateros','Metro Manila');
INSERT INTO Address VALUES (16,'49','D.Silang St.','San Isidro','District VI','Las Pinas','Metro Manila');
INSERT INTO Address VALUES (17,'189','M.Ponce Blvd.','Bel-Air','District III','Pateros','Metro Manila');
INSERT INTO Address VALUES (18,'98','F.Makabulos Blvd.','Forbes Park','District VI','Quezon City','Metro Manila');
INSERT INTO Address VALUES (19,'134','J.Panganiban Ave.','Forbes Park','District VII','Malabon','Metro Manila');
INSERT INTO Address VALUES (20,'193','A.Bonifacio Ave.','Palanan','District VII','Marikina','Metro Manila');
INSERT INTO Address VALUES (21,'134','F.Agoncillo St.','Cembo','District VI','Manila','Metro Manila');
INSERT INTO Address VALUES (22,'145','G.Lopez-Jaena St.','Dasmarinas','District IV','Mandaluyong','Metro Manila');
INSERT INTO Address VALUES (23,'33','D.Silang St.','Palanan','District I','Quezon City','Metro Manila');
INSERT INTO Address VALUES (24,'126','G.Lopez-Jaena Rd.','Guad. Viejo','District VI','San Juan','Metro Manila');
INSERT INTO Address VALUES (25,'63','P.Pira St.','Pingkaisahan','District IV','Las Pinas','Metro Manila');
INSERT INTO Address VALUES (26,'138','G.Lopez-Jaena St.','La Paz','District I','Makati','Metro Manila');
INSERT INTO Address VALUES (27,'183','J.Felipe Blvd.','Guad. Viejo','District V','Muntinlupa','Metro Manila');
INSERT INTO Address VALUES (28,'184','L.Rivera Ave.','West Rembo','District IV','Pasig','Metro Manila');
INSERT INTO Address VALUES (29,'148','J.Luna Rd.','Bel-Air','District VII','Pasay','Metro Manila');
INSERT INTO Address VALUES (30,'31','M.Aquino St.','Guad. Viejo','District II','Malabon','Metro Manila');
INSERT INTO Address VALUES (31,'23','P.Pira Ave.','Pingkaisahan','District III','Valenzuela','Metro Manila');
INSERT INTO Address VALUES (32,'53','I.delos Reyes Rd.','Palanan','District III','Makati','Metro Manila');
INSERT INTO Address VALUES (33,'160','M.Dizon Ave.','Dasmarinas','District II','Pasig','Metro Manila');
INSERT INTO Address VALUES (34,'155','J.Rizal St.','San Antonio','District VI','Muntinlupa','Metro Manila');
INSERT INTO Address VALUES (35,'190','A.Ricarte Rd.','Bel-Air','District II','Makati','Metro Manila');
INSERT INTO Address VALUES (36,'200','E.Aguinaldo St.','Bangkol','District I','Paranaque','Metro Manila');
INSERT INTO Address VALUES (37,'26','F.Dagohoy St.','Guad. Nuevo','District II','Muntinlupa','Metro Manila');
INSERT INTO Address VALUES (38,'45','A.Bonifacio St.','Magallanes','District IV','Paranaque','Metro Manila');
INSERT INTO Address VALUES (39,'40','E.delos Santos Ave.','Carmona','District V','Quezon City','Metro Manila');
INSERT INTO Address VALUES (40,'68','M.M. Agoncillo Rd.','South Cembo','District VI','Taguig','Metro Manila');
INSERT INTO Address VALUES (41,'182','J.Luna Rd.','Pitogo','District VI','Pateros','Metro Manila');
INSERT INTO Address VALUES (42,'33','Rajah Soliman St.','Pitogo','District III','Marikina','Metro Manila');
INSERT INTO Address VALUES (43,'184','Lakandola Ave.','Comembo','District IV','Malabon','Metro Manila');
INSERT INTO Address VALUES (44,'96','F.Makabulos Ave.','Pitogo','District VI','Manila','Metro Manila');
INSERT INTO Address VALUES (45,'35','J.Palma Rd.','Pingkaisahan','District VI','San Juan','Metro Manila');
INSERT INTO Address VALUES (46,'60','L.Rivera Blvd.','Post Proper N','District V','Makati','Metro Manila');
INSERT INTO Address VALUES (47,'99','R.Palma Ave.','Post Proper S','District V','Muntinlupa','Metro Manila');
INSERT INTO Address VALUES (48,'111','P.Pira Rd.','Comembo','District IV','Paranaque','Metro Manila');
INSERT INTO Address VALUES (49,'156','G.Lopez-Jaena Blvd.','Carmona','District I','Marikina','Metro Manila');
INSERT INTO Address VALUES (50,'58','E.Jacinto Blvd.','Bangkol','District VII','Makati','Metro Manila');
INSERT INTO Address VALUES (51,'','','','','','');
INSERT INTO Address VALUES (52,'','','','','','');
INSERT INTO Address VALUES (53,'','','','','','');
INSERT INTO Address VALUES (54,'','','','','','');
INSERT INTO Address VALUES (55,'#4','1st Ave.','Beverly Hills','1','Antipolo City','Rizal');
INSERT INTO Address VALUES (57,'','','','','','');
INSERT INTO Address VALUES (58,'67','67th Ave','Tevi Lsepe','Yruo','Tsanrutla','Santatrlu');
INSERT INTO Address VALUES (59,'10938934','5656445th street','Einifevimlloifv','Milfeilvionive','Viefillmionfie','Milvemfilion');
INSERT INTO Address VALUES (60,'q','q','q','q','q','q');
INSERT INTO Address VALUES (61,'asdf','asdf','asdf','asdf','asdf','asdf');
INSERT INTO Address VALUES (62,'45','FortyFive','FortySix','FortySeven','FortyEight','FortyNine');
INSERT INTO Address VALUES (63,'asdf','asdf','asdf','asdf','asdf','asdf');
INSERT INTO Address VALUES (64,'df','df','df','df','df','df');
INSERT INTO Address VALUES (65,'asdf','asdf','asdf','asdf','asdf','asdf');
INSERT INTO Address VALUES (66,'11','11th Street','Zone Eleven','Eleventh District','Eleveneleven','Levenel');
INSERT INTO Address VALUES (67,'151','D.Silang Rd.','Carmona','District VI','Paranaque','Metro Manila');
INSERT INTO Address VALUES (68,'64','P.Paterno Rd.','Post Proper S','District VII','Malabon','Metro Manila');
INSERT INTO Address VALUES (69,'15','F.Makabulos St.','Bel-Air','District III','San Juan','Metro Manila');
INSERT INTO Address VALUES (70,'186','F.Baltazar Ave.','Pembo','District VI','Pasay','Metro Manila');
INSERT INTO Address VALUES (71,'117','A.Esteban Rd.','San Isidro','District I','Muntinlupa','Metro Manila');
INSERT INTO Address VALUES (72,'185','M.Dizon St.','Pio del Pilar','District VII','Navotas','Metro Manila');
INSERT INTO Address VALUES (73,'199','P.Pira Blvd.','Pingkaisahan','District V','Pasay','Metro Manila');
INSERT INTO Address VALUES (74,'127','A.Luna St.','South Cembo','District VI','Las Pinas','Metro Manila');
INSERT INTO Address VALUES (75,'27','F.Ma Guerrero Ave.','Pio del Pilar','District V','Makati','Metro Manila');
INSERT INTO Address VALUES (76,'116','J.Panganiban Ave.','Pingkaisahan','District IV','Makati','Metro Manila');
INSERT INTO Address VALUES (77,'646','Lee St.','Warburton','V','Taguig','Something');
INSERT INTO Address VALUES (78,'56','F.Dagohoy St.','Olympia','District VII','Navotas','Metro Manila');
INSERT INTO Address VALUES (79,'unit 2415 Megaplaza Bldg.','ADB Avenue cor. Garnett St.','Ortigas Center','1','Pasig City','Metro Manila');
INSERT INTO Address VALUES (80,'none','none','none','none','none','none');
INSERT INTO Address VALUES (81,'798','789','789','789','798','789');
INSERT INTO Address VALUES (82,'790','679','86','986','9876','986');
INSERT INTO Address VALUES (83,'#4','1st Avenue','Beverly Hills','1','Antipolo City','Rizal');
INSERT INTO Address VALUES (84,'#4','1st Avenue','Busay','District IV','municipalityCityI','ddfdsadf');
INSERT INTO Address VALUES (85,'q','q','Arena Blanco','District I','municipalityCityA','GHKGHK');
INSERT INTO Address VALUES (86,'q','q','Arena Blanco','District I','municipalityCityA','GHKGHK');
INSERT INTO Address VALUES (87,'q','q','Arena Blanco','District I','municipalityCityA','GHKGHK');
INSERT INTO Address VALUES (88,'q','q','Arena Blanco','District I','municipalityCityA','GHKGHK');
INSERT INTO Address VALUES (89,'wqerqwerqwr','qwerwqerwr','werqwerqw','qwerqwerqwr','qwerqwerqwer','qwerqwerwqer');
INSERT INTO Address VALUES (90,'w','w','w','w','w','w');
INSERT INTO Address VALUES (91,'yiuy','iy','iuy','iy','iuyi','uyiuy');
INSERT INTO Address VALUES (92,'234','lkjhlhjl','0u09','lkjlkjlk','jj','lkj');
INSERT INTO Address VALUES (93,'','','','','','');
INSERT INTO Address VALUES (94,'','','','','','');
INSERT INTO Address VALUES (95,'','','','','','');
INSERT INTO Address VALUES (96,'1234567','Kangleon St','asdfasdfasdf','District II','municipalityCityB','asdfasf');
INSERT INTO Address VALUES (97,'','','','','','');
INSERT INTO Address VALUES (98,'234243','234234','423423423','243234','23423423423','4234234');
INSERT INTO Address VALUES (99,'','','','','','');
INSERT INTO Address VALUES (100,'','','','','','');
INSERT INTO Address VALUES (101,'223','Rizal St.','Arena Blanco','District I','municipalityCityA','GHKGHK');
INSERT INTO Address VALUES (102,'','','','','','');
INSERT INTO Address VALUES (103,'','','','','','');
INSERT INTO Address VALUES (104,'','','','','','');
INSERT INTO Address VALUES (105,'','','','','','');
INSERT INTO Address VALUES (106,'','','','','','');
INSERT INTO Address VALUES (107,'','','','','','');
INSERT INTO Address VALUES (108,'','','','','','');
INSERT INTO Address VALUES (109,'','','','','','');
INSERT INTO Address VALUES (110,'','','','','','');
INSERT INTO Address VALUES (111,'','','','','','');
INSERT INTO Address VALUES (112,'q','q','q','q','q','q');
INSERT INTO Address VALUES (113,'10th floor Orient square','emerald avenue','Busay','District I','municipalityCityE','asfasdf');
INSERT INTO Address VALUES (114,'','','','','','');
INSERT INTO Address VALUES (115,'10th floor Orient square','emerald avenue','Busay','District I','municipalityCityE','asfasdf');
INSERT INTO Address VALUES (116,'10th floor Orient square','emerald avenue','Busay','District I','municipalityCityE','asfasdf');
INSERT INTO Address VALUES (117,'789','789','798','7897','9868','56768');
INSERT INTO Address VALUES (118,'','','','','','');
INSERT INTO Address VALUES (119,'q','q','q','q','q','q');
INSERT INTO Address VALUES (120,'1','1','1','1','1','1');
INSERT INTO Address VALUES (121,'2','2','2','2','2','2');
INSERT INTO Address VALUES (122,'NA','NA','Tunga-tunga','Tunga-Tunga','Maasin City','Southern Leyte');
INSERT INTO Address VALUES (123,'NA','NA','NA','NA','NA','NA');
INSERT INTO Address VALUES (124,'','','','','','');
INSERT INTO Address VALUES (125,'','','','','','');
INSERT INTO Address VALUES (126,'','','','','','');
INSERT INTO Address VALUES (127,'','','','','','');
INSERT INTO Address VALUES (128,'','','','','','');
INSERT INTO Address VALUES (129,'','','','','','');
INSERT INTO Address VALUES (130,'NA','T. Oppus St.','Tunga-tunga','No District','Maasin City','Southern Leyte');
INSERT INTO Address VALUES (131,'','','','','','');
INSERT INTO Address VALUES (132,'','','','','','');
INSERT INTO Address VALUES (133,'12','12','12','12','12','12');
INSERT INTO Address VALUES (134,'','','','','','');
INSERT INTO Address VALUES (135,'1','Evidente','Ayala','District II','City B','Metro Manila');
INSERT INTO Address VALUES (136,'12345','12345','12345','12345','12345','12345');
INSERT INTO Address VALUES (137,'','','','','','');
INSERT INTO Address VALUES (138,'','','','','','');
INSERT INTO Address VALUES (139,'','','','','','');
INSERT INTO Address VALUES (140,'','','','','','');
INSERT INTO Address VALUES (141,'','','','','','');
INSERT INTO Address VALUES (142,'','','','','','');
INSERT INTO Address VALUES (143,'1','1','1','111','1','1');
INSERT INTO Address VALUES (144,'1','1','1','1','1','1');
INSERT INTO Address VALUES (145,'2','','','','','');
INSERT INTO Address VALUES (146,'','','','','','');
INSERT INTO Address VALUES (147,'2','','','','','');
INSERT INTO Address VALUES (148,'','','','','','');
INSERT INTO Address VALUES (149,'2','2','2','2','2','2');
INSERT INTO Address VALUES (150,'3','3','3','','','');
INSERT INTO Address VALUES (151,'','','','','','');
INSERT INTO Address VALUES (152,'555','Rodriguez St','Rodriguez','Rodriguez','Rodriguez','Rodriguez');
INSERT INTO Address VALUES (153,'555','Rodriguez St','Rodriguez','Rodriguez','Rodriguez','Rodriguez');
INSERT INTO Address VALUES (154,'11','11','11','11','11','11');
INSERT INTO Address VALUES (155,'777','777','777','777','777','777');
INSERT INTO Address VALUES (156,'','','','','','');
INSERT INTO Address VALUES (157,'888','888','888','888','888','888');
INSERT INTO Address VALUES (158,'fghfh','hfghfgh','fghgfhfgh','fghfgh','fghfghfg','hfghfh');
INSERT INTO Address VALUES (159,'999','999','999','999','999','999');
INSERT INTO Address VALUES (160,'2914','Rodriguez St','test','test','test','test');
INSERT INTO Address VALUES (161,'77777','Main','Baluno','District IV','Kalibo','Aklan');
INSERT INTO Address VALUES (162,'1','1','s','1','1','d');
INSERT INTO Address VALUES (163,'9','j','9','j','9','j');
INSERT INTO Address VALUES (164,'1','1','1','1','1','1');
INSERT INTO Address VALUES (165,'','','','','','');
INSERT INTO Address VALUES (166,'123456','2914','Bunguiao','District I','Butuan City','Agusan del Norte');
INSERT INTO Address VALUES (167,'10th floor Orient square','emerald avenue','Busay','District I','municipalityCityE','asfasdf');
INSERT INTO Address VALUES (168,'1','2','3','4','4','4');
INSERT INTO Address VALUES (169,'dfsdfsdf','gdfgdg','sdfsdfdsf','dgfdgf','dfssdfsdfsdf','gdfgdfgdfg');
INSERT INTO Address VALUES (170,'444','444','444','444','4444','444');
INSERT INTO Address VALUES (171,'888','888','888','888','8888','888');
INSERT INTO Address VALUES (172,'999','999','999','999','999','999');
INSERT INTO Address VALUES (173,'123','1234 ave','1234','1234','1234','1234');
INSERT INTO Address VALUES (174,'789','789','789','789','789','789');
INSERT INTO Address VALUES (175,'3333','333f','fff','fff','ff','fff');
INSERT INTO Address VALUES (176,'testNumber','testStreet','testBarangay','testDistrict','testMunicipalityCity','testProvince');
INSERT INTO Address VALUES (177,'444','444','444','444','444','444');
INSERT INTO Address VALUES (178,'78910','78910','78910','78910','78910','78910');
INSERT INTO Address VALUES (179,'78911','78911','78911','78911','78911','78911');
INSERT INTO Address VALUES (180,'dfgbdfd','dfgdgfdfgdfg','Arena Blancoo','District I desc','Bangued','Abra');
INSERT INTO Address VALUES (181,'gi','gfig','iog','uf','fuy','gfuig');
INSERT INTO Address VALUES (182,'tyrtyrty','rtyrty','tryrty','rtyrtyrttry','rtyrty','rtytryrtytr');
INSERT INTO Address VALUES (183,'rtertert','erterter','rtertert','terte','rterte','rtertetr');
INSERT INTO Address VALUES (184,'ertet','rterte','erterterte','rtert','erterterter','ertert');
INSERT INTO Address VALUES (185,'789','789','789','789','789','789');
INSERT INTO Address VALUES (186,'4545','4545','5454','545','454','545');
INSERT INTO Address VALUES (187,'','','','','','');
INSERT INTO Address VALUES (188,'g','gio','','iyi','uyi','yiy');

--
-- Table structure for table 'Assessor'
--

CREATE TABLE Assessor (
  assessorID int(11) NOT NULL auto_increment,
  personID int(11) default NULL,
  position varchar(32) default NULL,
  PRIMARY KEY  (assessorID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Assessor'
--


INSERT INTO Assessor VALUES (1,2,'web dev');
INSERT INTO Assessor VALUES (2,3,'web developer');
INSERT INTO Assessor VALUES (3,4,'web developer');
INSERT INTO Assessor VALUES (4,5,'web developer');
INSERT INTO Assessor VALUES (5,6,'web developer');

--
-- Table structure for table 'Barangay'
--

CREATE TABLE Barangay (
  barangayID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  districtID int(4) NOT NULL default '1',
  description text,
  status varchar(255) default NULL,
  PRIMARY KEY  (barangayID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Barangay'
--


INSERT INTO Barangay VALUES (1,'ab',3,'Arena Blanco','inactive');
INSERT INTO Barangay VALUES (2,'Ayala',2,'Ayala','inactive');
INSERT INTO Barangay VALUES (3,'Baliwasa',3,'Baliwasans','inactive');
INSERT INTO Barangay VALUES (4,'Baluno',7,'Baluno Description','active');
INSERT INTO Barangay VALUES (5,'Boalan',8,'Boalan','inactive');
INSERT INTO Barangay VALUES (6,'Buenavista',9,'Buenavista','active');
INSERT INTO Barangay VALUES (7,'Bunguiao',1,'Bunguiao','active');
INSERT INTO Barangay VALUES (8,'Busay',1,'Busay','active');
INSERT INTO Barangay VALUES (11,'San Antonio',1,'San Antonio','active');
INSERT INTO Barangay VALUES (13,'sdsd',2,'sdsds','active');
INSERT INTO Barangay VALUES (14,'adfsdfs',8,'fasdf','active');
INSERT INTO Barangay VALUES (16,'sdfsdf',3,'sdfsdf','inactive');

--
-- Table structure for table 'Company'
--

CREATE TABLE Company (
  companyID int(11) NOT NULL auto_increment,
  companyName varchar(50) default NULL,
  tin varchar(32) NOT NULL default '',
  telephone varchar(50) default NULL,
  fax varchar(50) default NULL,
  website varchar(128) NOT NULL default '',
  email varchar(128) default NULL,
  PRIMARY KEY  (companyID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Company'
--


INSERT INTO Company VALUES (1,'Cum Ltd.','9626377556','938 0459','344 9180','Not Applicable','admin@cum.net');
INSERT INTO Company VALUES (2,'Donec Ltd.','4943391336','354 0087','863 6582','http://www.donec.com.ph','purus@donec.com');
INSERT INTO Company VALUES (3,'Ut Co.','8165886751','738 6258','795 8667','http://www.ut.com.ph','Integer@ut.ph');
INSERT INTO Company VALUES (4,'Et Inc.','7187553638','534 2447','335 8947','http://www.et.com','sem@et.net');
INSERT INTO Company VALUES (5,'Ut Co.','6318421144','957 9788','795 4505','http://www.ut.ph','tristique@ut.com.ph');
INSERT INTO Company VALUES (6,'Lacus Inc.','7148382035','478 1786','755 9455','http://www.lacus.com','justo@lacus.com');
INSERT INTO Company VALUES (7,'Est Inc.','1500570106','399 7206','867 4933','http://www.est.org','Vestibulum@est.org.ph');
INSERT INTO Company VALUES (8,'Porta Ltd.','6066822119','396 8314','988 7814','http://www.porta.org','dui@porta.org');
INSERT INTO Company VALUES (9,'Dictum Ltd.','8226805768','788 2493','698 2927','http://www.dictum.ph','risus@dictum.net');
INSERT INTO Company VALUES (10,'Justo Co.','1756213852','576 8382','834 0967','http://www.justo.ph','hac@justo.org.ph');
INSERT INTO Company VALUES (11,'Lorem Ltd.','7621784068','695 2297','463 4287','http://www.lorem.com','platea@lorem.ph');
INSERT INTO Company VALUES (12,'Et Ltd.','0904759869','397 3691','343 9704','http://www.et.org','Aliquam@et.com');
INSERT INTO Company VALUES (13,'Senectus Inc.','9399222654','767 0318','994 8981','http://www.senectus.com.ph','risus@senectus.com');
INSERT INTO Company VALUES (14,'Velit Ltd.','3751578826','344 8702','379 3907','http://www.velit.com','erat@velit.org.ph');
INSERT INTO Company VALUES (15,'Vitae Inc.','6871026807','895 5045','558 7746','http://www.vitae.com','dolor@vitae.com.ph');
INSERT INTO Company VALUES (16,'Dolor Ltd.','3588015591','364 1349','369 6448','http://www.dolor.com.ph','lorem@dolor.ph');
INSERT INTO Company VALUES (17,'Amet Inc.','1564538354','747 6750','664 5618','http://www.amet.com','elit@amet.org.ph');
INSERT INTO Company VALUES (18,'Scelerisque Co.','5203135103','335 2127','394 4096','http://www.scelerisque.net','ipsum@scelerisque.com');
INSERT INTO Company VALUES (19,'Quam Inc.','3049494951','945 9017','987 0559','http://www.quam.org.ph','laoreet@quam.ph');
INSERT INTO Company VALUES (20,'In Inc.','5470667705','655 2647','849 9533','http://www.in.net','nec@in.org');
INSERT INTO Company VALUES (21,'Rhoncus Ltd.','7920941799','467 5705','798 5989','http://www.rhoncus.org.ph','magna@rhoncus.com');
INSERT INTO Company VALUES (22,'Hac Ltd.','4238321060','543 2873','777 0735','http://www.hac.ph','sociis@hac.ph');
INSERT INTO Company VALUES (23,'Adipiscing Inc.','1114342785','943 3702','673 0055','http://www.adipiscing.com','urna@adipiscing.org.ph');
INSERT INTO Company VALUES (24,'Tristique Ltd.','2923799635','487 9307','764 8066','http://www.tristique.com','nulla@tristique.org.ph');
INSERT INTO Company VALUES (25,'Amet Inc.','9042164530','493 8973','374 3043','http://www.amet.org.ph','velit@amet.org');
INSERT INTO Company VALUES (26,'Nec Co.','3019110279','663 1026','643 0783','http://www.nec.org','Nunc@nec.org');
INSERT INTO Company VALUES (27,'Duis Ltd.','5597866270','354 3783','483 4129','http://www.duis.com','est@duis.org.ph');
INSERT INTO Company VALUES (28,'Lorem Inc.','4793611078','834 2394','398 4039','http://www.lorem.org','nulla@lorem.org.ph');
INSERT INTO Company VALUES (29,'Platea Ltd.','2705531969','697 8674','953 7376','http://www.platea.net','eget@platea.org.ph');
INSERT INTO Company VALUES (30,'Vel Ltd.','8303360370','638 7959','857 2082','http://www.vel.ph','velit@vel.com.ph');
INSERT INTO Company VALUES (31,'Amet Ltd.','4793165276','545 2533','878 4029','http://www.amet.com','Ut sem@amet.org.ph');
INSERT INTO Company VALUES (32,'Vestibulum Co.','7402447644','937 6618','354 9880','http://www.vestibulum.org','iaculis@vestibulum.org');
INSERT INTO Company VALUES (33,'Platea Ltd.','3074902898','374 5865','735 6711','http://www.platea.ph','Nam@platea.com.ph');
INSERT INTO Company VALUES (34,'Duis Inc.','2248416532','364 8748','599 7158','http://www.duis.com.ph','consectetuer@duis.com.ph');
INSERT INTO Company VALUES (35,'Aliquam Inc.','2336467370','485 5658','853 5220','http://www.aliquam.org','non@aliquam.com');
INSERT INTO Company VALUES (36,'Commodo Co.','0584890100','759 0889','455 6567','http://www.commodo.com.ph','Sed@commodo.ph');
INSERT INTO Company VALUES (37,'Nam Co.','4347410046','779 5422','377 9705','http://www.nam.org','convallis@nam.org.ph');
INSERT INTO Company VALUES (38,'Posuere Ltd.','7645175294','794 3431','359 9139','http://www.posuere.com','quis@posuere.com');
INSERT INTO Company VALUES (39,'Sharp Prints','1234567890','6584746','6584746','none','nelson@k2ia.com');
INSERT INTO Company VALUES (40,'Massa Co.','9363256406','993 6304','538 0658','http://www.massa.com','pede@massa.org.ph');
INSERT INTO Company VALUES (41,'Eu Ltd.','4159629640','358 4142','997 3015','http://www.eu.org','pede Suspendisse@eu.com.ph');
INSERT INTO Company VALUES (42,'Pulvinar Inc.','1680662181','653 5038','373 2994','http://www.pulvinar.com','tellus@pulvinar.net');
INSERT INTO Company VALUES (43,'Euismod Inc.','0495423552','468 8460','778 1100','http://www.euismod.net','orci@euismod.com.ph');
INSERT INTO Company VALUES (44,'Nisl Co.','1285654110','653 2865','746 3359','http://www.nisl.org.ph','Nulla@nisl.com');
INSERT INTO Company VALUES (45,'Felis Ltd.','3970215989','947 0617','798 0242','http://www.felis.org.ph','egestas@felis.com.ph');
INSERT INTO Company VALUES (46,'Kwik Kopy service and Supply','43234827','4523452','235423455','kwik.com.ph','ostym@k2ia.com');
INSERT INTO Company VALUES (47,'erwr','werwrqwr','2342134','1234124312','','nelson@k2ia.com');
INSERT INTO Company VALUES (48,'erwr','werwrqwr','2342134','1234124312','','nelson@k2ia.com');
INSERT INTO Company VALUES (49,'1234234','1232143','2324324','234243','','nelson@k2ia.com');
INSERT INTO Company VALUES (50,'twqetqt','ertert345243rt','qwerwqerqwer','qwreqwerwqre','','nelson@k2ia.com');
INSERT INTO Company VALUES (51,'k2ia','23232','44583094','08209583450','545','nelson@k2ia.com');
INSERT INTO Company VALUES (52,'k2 interactive','1234567','6875183','6319297','www.k2ia.com','info@k2ia.com');
INSERT INTO Company VALUES (53,'Rodriguez Ltd','','','','','');
INSERT INTO Company VALUES (54,'Rodriguez Ltd','','','','','');
INSERT INTO Company VALUES (55,'777','','','','','');
INSERT INTO Company VALUES (56,'888 Incorporated','','','','','');
INSERT INTO Company VALUES (57,'3','2','333','222','','m@k.com');
INSERT INTO Company VALUES (58,'3333','wwww','eee','eee','','ee@t.com');
INSERT INTO Company VALUES (59,'1234 Inc','','','','','');

--
-- Table structure for table 'CompanyAddress'
--

CREATE TABLE CompanyAddress (
  companyAddressID int(11) NOT NULL auto_increment,
  companyID int(11) NOT NULL default '0',
  addressID int(11) NOT NULL default '0',
  PRIMARY KEY  (companyAddressID)
) TYPE=InnoDB;

--
-- Dumping data for table 'CompanyAddress'
--


INSERT INTO CompanyAddress VALUES (1,1,1);
INSERT INTO CompanyAddress VALUES (2,2,2);
INSERT INTO CompanyAddress VALUES (3,3,3);
INSERT INTO CompanyAddress VALUES (4,4,4);
INSERT INTO CompanyAddress VALUES (5,5,5);
INSERT INTO CompanyAddress VALUES (6,6,6);
INSERT INTO CompanyAddress VALUES (7,7,7);
INSERT INTO CompanyAddress VALUES (8,8,8);
INSERT INTO CompanyAddress VALUES (9,9,9);
INSERT INTO CompanyAddress VALUES (10,10,10);
INSERT INTO CompanyAddress VALUES (11,11,11);
INSERT INTO CompanyAddress VALUES (12,12,12);
INSERT INTO CompanyAddress VALUES (13,13,13);
INSERT INTO CompanyAddress VALUES (14,14,14);
INSERT INTO CompanyAddress VALUES (15,15,15);
INSERT INTO CompanyAddress VALUES (16,16,16);
INSERT INTO CompanyAddress VALUES (17,17,17);
INSERT INTO CompanyAddress VALUES (18,18,18);
INSERT INTO CompanyAddress VALUES (19,19,19);
INSERT INTO CompanyAddress VALUES (20,20,20);
INSERT INTO CompanyAddress VALUES (21,21,21);
INSERT INTO CompanyAddress VALUES (22,22,22);
INSERT INTO CompanyAddress VALUES (23,23,23);
INSERT INTO CompanyAddress VALUES (24,24,24);
INSERT INTO CompanyAddress VALUES (25,25,25);
INSERT INTO CompanyAddress VALUES (26,26,26);
INSERT INTO CompanyAddress VALUES (27,27,27);
INSERT INTO CompanyAddress VALUES (28,28,28);
INSERT INTO CompanyAddress VALUES (29,29,29);
INSERT INTO CompanyAddress VALUES (30,30,30);
INSERT INTO CompanyAddress VALUES (31,31,31);
INSERT INTO CompanyAddress VALUES (32,32,32);
INSERT INTO CompanyAddress VALUES (33,33,33);
INSERT INTO CompanyAddress VALUES (34,34,34);
INSERT INTO CompanyAddress VALUES (35,35,35);
INSERT INTO CompanyAddress VALUES (36,36,38);
INSERT INTO CompanyAddress VALUES (37,37,45);
INSERT INTO CompanyAddress VALUES (38,38,46);
INSERT INTO CompanyAddress VALUES (39,39,55);
INSERT INTO CompanyAddress VALUES (40,40,67);
INSERT INTO CompanyAddress VALUES (41,41,68);
INSERT INTO CompanyAddress VALUES (42,42,70);
INSERT INTO CompanyAddress VALUES (43,43,72);
INSERT INTO CompanyAddress VALUES (44,44,73);
INSERT INTO CompanyAddress VALUES (45,45,76);
INSERT INTO CompanyAddress VALUES (46,46,84);
INSERT INTO CompanyAddress VALUES (47,47,86);
INSERT INTO CompanyAddress VALUES (48,48,87);
INSERT INTO CompanyAddress VALUES (49,49,88);
INSERT INTO CompanyAddress VALUES (50,50,89);
INSERT INTO CompanyAddress VALUES (51,51,113);
INSERT INTO CompanyAddress VALUES (52,52,116);
INSERT INTO CompanyAddress VALUES (53,53,152);
INSERT INTO CompanyAddress VALUES (54,54,153);
INSERT INTO CompanyAddress VALUES (55,55,155);
INSERT INTO CompanyAddress VALUES (56,56,157);
INSERT INTO CompanyAddress VALUES (57,57,166);
INSERT INTO CompanyAddress VALUES (58,58,167);
INSERT INTO CompanyAddress VALUES (59,59,173);

--
-- Table structure for table 'District'
--

CREATE TABLE District (
  districtID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  municipalityCityID int(4) NOT NULL default '1',
  description text,
  status varchar(255) default NULL,
  PRIMARY KEY  (districtID)
) TYPE=InnoDB;

--
-- Dumping data for table 'District'
--


INSERT INTO District VALUES (1,'bc',6,'Butuan City','active');
INSERT INTO District VALUES (2,'District II',6,'District II','active');
INSERT INTO District VALUES (3,'District III',7,'District III','active');
INSERT INTO District VALUES (7,'District IV',8,'District IV','active');
INSERT INTO District VALUES (8,'District V',9,'District V','active');
INSERT INTO District VALUES (9,'sdfsdf',10,'asdfasfasdfsdaf','active');
INSERT INTO District VALUES (10,'asdfasdf',1,'asdfsadf','active');
INSERT INTO District VALUES (11,'dfdfsfdf',1,'sdfsdfsdfa','active');
INSERT INTO District VALUES (12,'sdfdfsd',1,'sdfdf','active');

--
-- Table structure for table 'ImprovementsBuildings'
--

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
  PRIMARY KEY  (propertyID)
) TYPE=InnoDB;

--
-- Dumping data for table 'ImprovementsBuildings'
--


INSERT INTO ImprovementsBuildings VALUES (1,1,'6591','0322','51','2','1','1','300311','Residential','quam','300,241.00','40','120,096.40','','','59','87','3','2002-06-16','4','2002-05-14','3','2002-08-21','felis\n aliquam\n ac\n aliquet\n','','228625','42.40','444','155','magna','nec','15','augue','79','sit','Vivamus feugiat','nec laoreet','9943829','166','189','21','215','31','68','ac sagittis','id eros','97','turpis ut','aliquam ac','2002-05-20','2003-04-29','2002-12-20','83.91','163.16','turpis\n Aliquam\n nulla\n erat\n','70','70.00','300,241.00');
INSERT INTO ImprovementsBuildings VALUES (2,1,'8013','6926','52','4','2','1','211101','Commercial','sociis','111,101.00','4','4,444.04','','','26','87','5','2002-11-02','1','2002-12-22','5','2003-04-07','vitae\n egestas\n id\n auctor\n','','871448','390.20','137','254','interdum','laoreet','4','habitant','36','quis','Suspendisse vestibulum','Pellentesque nec','5895924','20','138','52','973','96','57','velit viverra','Donec fringilla','71','vel pulvinar','Ut euismod','2003-04-05','2002-06-04','2003-02-19','171.90','38.95','felis\n Suspendisse\n vestibulum','100000','100,000.00','111,101.00');
INSERT INTO ImprovementsBuildings VALUES (3,1,'8944','3890','53','2','1','3','3122100','Residential','lectus','3,072,100.00','30','921,630.00','','','23','10','3','2002-08-01','5','2003-02-03','4','2002-07-03','in\n sapien\n ullamcorper\n vive','','743833','240.12','257','448','pede','est','14','nec','38','sapien','et enim','scelerisque enim','1244232','193','29','113','327','36','9','ligula Nam','sed pulvinar','29','ultricies wisi','Suspendisse vestibulum','2002-07-10','2002-08-31','2002-10-30','250.60','207.82','Nunc\n non\n risus\n nec\n enim\n','50000','50,000.00','3,072,100.00');
INSERT INTO ImprovementsBuildings VALUES (4,1,'9659','1422','54','3','2','4','2312000','Commercial','quam','2,307,000.00','30','692,100.00','','','54','15','4','2002-07-24','2','2003-05-03','1','2002-08-16','dolor\n Vivamus\n feugiat\n pede','','157583','21.19','455','113','magna','velit','2','amet','68','montes','pretium magna','Nullam fermentum','5248587','74','84','22','816','69','62','convallis ac','volutpat varius','45','consectetuer adipiscing','blandit ut','2002-05-30','2002-09-04','2002-06-22','170.06','106.81','Phasellus\n est\n Vestibulum\n s','5000','5,000.00','2,307,000.00');
INSERT INTO ImprovementsBuildings VALUES (5,1,'0870','1554','55','1','2','4','3331101','Industrial','pellentesque','2,330,601.00','40','932,240.40','','','55','85','4','2002-12-30','5','2002-07-07','3','2002-12-29','tellus\n at\n volutpat\n velit\n','','131976','374.13','109','387','justo','ut','25','pretium','92','sodales','et magnis','et magnis','8694417','72','452','139','909','3','33','In commodo','nulla Ut sem','97','in vehicula','Nunc vulputate','2003-03-12','2002-11-02','2003-02-15','138.93','62.79','vestibulum\n nibh\n non\n pellen','1000500','1,000,500.00','2,330,601.00');
INSERT INTO ImprovementsBuildings VALUES (6,2,'5779','3068','','5','5','5','2320001','Residential','Morbi','2310110','6','3331100','2','3123101','94','43','3','2003-01-4','3','2003-02-4','3','2003-03-19','habitasse\r\n platea\r\n dictumst\r\n','2003-04-20','973173','233.00','65','451','nibh','ipsum','8','augue','81','et','tempor\r\n Ut','mi\r\n euismod','7414963','177','438','108','332','75','57','elit\r\n Nam','elementum\r\n Integer','52','nulla\r\n Donec','magnis\r\n dis','2003-02-19','2003-01-6','2002-09-9','4.64','64.11','lobortis\r\n nibh\r\n Nulla\r\n quis\r\n','39','589','2479.82');
INSERT INTO ImprovementsBuildings VALUES (7,2,'2343','9236','','2','4','3','1133111','Commercial','quam','2200001','3','3110110','2','3333001','17','54','2','2002-06-29','3','2003-05-8','5','2002-09-3','fringilla\r\n tempor\r\n Cum\r\n socii','2002-10-9','862161','162.91','57','429','adipiscing','vehicula','22','vitae','75','porta','luctus\r\n et','pulvinar\r\n ullamcorper','5732272','89','364','61','316','8','65','sodales\r\n elit','et\r\n ultrices','29','semper\r\n lacinia','turpis\r\n non','2002-08-13','2002-09-15','2002-11-12','266.38','116.30','risus\r\n mattis\r\n vel\r\n pulvinar\r','59','2971','2442.76');
INSERT INTO ImprovementsBuildings VALUES (8,2,'6326','5916','','1','2','3','1103110','Residential','velit','3032111','3','1213100','1','1132011','45','89','2','2002-06-13','3','2002-11-1','3','2002-10-18','felis\r\n Duis\r\n est\r\n Cum\r\n socii','2002-11-26','223144','80.70','36','167','Morbi','malesuada','13','pellentesque','28','Etiam','dictum\r\n Pellentesque','in\r\n urna','7786434','35','125','145','466','98','43','euismod\r\n enim','Vestibulum\r\n sed','99','eros\r\n gravida','non\r\n sodales','2002-06-6','2002-06-30','2002-09-30','205.24','71.95','Aliquam\r\n molestie\r\n turpis\r\n ut','59','4547','4855.39');
INSERT INTO ImprovementsBuildings VALUES (9,2,'3675','1018','','4','5','5','3101000','Commercial','quam','3320001','2','1002111','1','2031111','80','17','5','2002-12-8','1','2003-01-19','3','2003-03-29','nunc\r\n consectetuer\r\n leo\r\n sit\r','2003-03-20','341573','313.32','229','144','non','viverra','5','In','40','Sed','est\r\n fringilla','id\r\n urna','7184338','26','162','131','760','11','55','pulvinar\r\n ac','posuere\r\n fermentum','85','vehicula\r\n pede','leo\r\n at','2002-10-3','2002-12-1','2002-11-2','297.68','115.35','nec\r\n laoreet\r\n eget\r\n est\r\n Qui','12','4627','1963.76');
INSERT INTO ImprovementsBuildings VALUES (10,2,'0098','2231','','2','1','3','3201010','Residential','fringilla','3111011','1','1002000','1','1023111','61','69','5','2002-11-23','4','2002-05-14','3','2002-05-25','arcu\r\n adipiscing\r\n tincidunt\r\n','2002-09-30','355454','332.53','29','103','morbi','vitae','24','dis','58','adipiscing','vel\r\n pulvinar','est\r\n Cum','6533611','54','36','49','600','70','88','In\r\n hac','netus\r\n et','82','et\r\n malesuada','sit\r\n amet','2003-02-18','2002-06-22','2002-06-12','53.77','296.88','mi\r\n lorem\r\n viverra\r\n id\r\n orna','20','3339','196.66');
INSERT INTO ImprovementsBuildings VALUES (11,3,'3491','3754','','3','1','4','1112101','Commercial','dignissim','2122110','4','2120110','2','3203010','48','45','5','2002-08-25','1','2002-05-26','4','2002-08-14','quam\r\n vel\r\n rhoncus\r\n wisi\r\n au','2002-07-5','488417','119.65','484','450','faucibus','arcu','19','Donec','78','primis','varius\r\n malesuada','auctor\r\n pharetra','1358256','46','277','118','348','27','35','at\r\n lorem','non\r\n sodales','30','non\r\n mollis','mattis\r\n a','2003-03-31','2002-12-1','2002-08-8','37.19','240.76','magna\r\n Donec\r\n interdum\r\n scele','61','2478','3022.27');
INSERT INTO ImprovementsBuildings VALUES (12,3,'1115','7084','','1','3','2','1202001','Commercial','amet','2103011','3','2132000','1','2330101','64','19','1','2003-01-19','5','2002-09-8','2','2003-03-27','metus\r\n elementum\r\n nibh\r\n Etiam','2002-11-6','217288','54.10','125','489','neque','felis','18','ligula','34','egestas','eros\r\n Curabitur','neque\r\n in','8742753','131','142','106','954','76','6','consectetuer\r\n mauris','non\r\n erat','16','laoreet\r\n non','enim\r\n Ut','2002-10-20','2002-10-15','2003-02-6','263.66','298.06','quam\r\n vel\r\n dictum\r\n dictum\r\n s','96','2080','77.12');
INSERT INTO ImprovementsBuildings VALUES (13,4,'6956','2525','','3','4','3','2213110','Commercial','tempor','2131000','1','1230010','3','2321110','6','11','5','2002-10-18','3','2002-11-27','3','2002-09-9','libero\r\n Etiam\r\n sit\r\n amet\r\n pe','2003-03-28','976888','24.39','90','92','imperdiet','bibendum','7','nec','18','vulputate','purus\r\n felis','dictum\r\n dictum','8856233','160','4','104','474','59','73','felis\r\n lorem','libero\r\n Etiam','36','Nullam\r\n molestie','Aenean\r\n velit','2002-08-22','2002-09-15','2003-04-26','169.67','29.47','volutpat\r\n velit\r\n leo\r\n at\r\n lo','97','4992','959.00');
INSERT INTO ImprovementsBuildings VALUES (14,4,'4100','5466','','4','4','3','1111110','Residential','tempor','3103010','5','2320011','4','2220000','9','53','4','2002-09-11','4','2002-10-3','4','2002-12-6','lacinia\r\n quis\r\n tincidunt\r\n in\r','2003-03-1','384669','394.44','321','151','penatibus','pede','11','Quisque','14','nec','et\r\n enim','Pellentesque\r\n sed','9996957','8','416','16','242','69','66','ultrices\r\n posuere','iaculis\r\n vitae','80','elit\r\n Cras','purus\r\n felis','2002-05-12','2002-09-22','2002-10-6','37.50','252.35','et\r\n dui\r\n Donec\r\n enim\r\n Curabi','52','1443','4314.72');
INSERT INTO ImprovementsBuildings VALUES (15,4,'6672','2264','','1','4','1','3312110','Commercial','wisi','3222111','4','3021010','1','1210111','46','84','2','2002-10-9','4','2002-09-4','1','2002-07-1','nunc\r\n eu\r\n leo\r\n rhoncus\r\n mole','2003-01-25','662212','261.22','399','432','nulla','justo','12','eros','88','ac','ante\r\n ipsum','orci\r\n Integer','8568284','30','424','77','583','81','12','ac\r\n turpis','Nam\r\n justo','74','montes\r\n nascetur','dapibus\r\n ipsum','2003-02-22','2002-05-30','2003-03-27','142.73','264.99','enim\r\n Etiam\r\n non\r\n metus\r\n nec','39','142','4558.51');
INSERT INTO ImprovementsBuildings VALUES (16,5,'3534','5178','','2','1','5','3032101','Commercial','lectus','2231010','6','2301110','2','1200011','86','73','1','2002-09-27','5','2002-07-19','1','2002-09-5','porttitor\r\n sagittis\r\n Fusce\r\n s','2003-02-14','356369','80.07','455','78','ipsum','urna','16','iaculis','5','sed','eget\r\n tellus','mi\r\n eleifend','5323537','102','58','87','866','68','85','vitae\r\n lacus','elit\r\n Pellentesque','85','orci\r\n Integer','eleifend\r\n quam','2002-05-16','2002-10-2','2002-11-19','216.31','275.13','Phasellus\r\n adipiscing\r\n Pellent','48','49','1997.47');
INSERT INTO ImprovementsBuildings VALUES (17,5,'2079','9304','','4','1','4','1020111','Commercial','arcu','2111110','7','3222000','2','3001010','8','66','2','2002-12-23','2','2003-01-29','4','2003-02-21','Sed\r\n nec\r\n pede\r\n vel\r\n nulla\r\n','2003-01-8','469142','13.08','220','447','vitae','dictum','23','convallis','23','mi','magna\r\n purus','Sed\r\n eget','8399841','40','306','81','285','66','29','id\r\n augue','orci\r\n luctus','64','posuere\r\n Aliquam','tempor\r\n Cum','2002-11-2','2002-12-13','2002-10-8','143.39','229.39','Donec\r\n vulputate\r\n Nullam\r\n fer','24','821','334.71');
INSERT INTO ImprovementsBuildings VALUES (18,5,'5444','3025','','5','4','4','1233011','Industrial','eu','2121000','4','2301011','4','2012110','93','13','1','2002-09-10','1','2003-02-1','5','2002-10-17','eget\r\n vulputate\r\n et\r\n enim\r\n I','2002-12-28','283112','106.64','311','152','Curabitur','vestibulum','13','Vestibulum','34','Pellentesque','ac\r\n aliquet','sodales\r\n elementum','7819157','18','343','24','738','100','80','Cras\r\n porttitor','non\r\n placerat','35','odio\r\n neque','habitasse\r\n platea','2002-11-30','2002-11-5','2002-08-12','43.76','297.71','erat\r\n Vivamus\r\n convallis\r\n vel','95','3991','4241.74');
INSERT INTO ImprovementsBuildings VALUES (19,5,'4948','0933','','1','3','5','2112001','Commercial','leo','3003001','1','3332011','3','3002011','6','82','3','2002-07-16','1','2003-04-15','4','2002-11-24','consectetuer\r\n adipiscing\r\n elit','2002-12-6','133281','89.96','238','475','interdum','ut','22','vitae','88','pellentesque','fermentum\r\n Lorem','lorem\r\n Pellentesque','8756164','112','326','30','128','91','86','Ut\r\n turpis','auctor\r\n pharetra','69','velit\r\n non','erat\r\n sit','2002-06-19','2003-01-18','2003-04-27','203.60','130.23','purus\r\n consectetuer\r\n tellus\r\n','3','2203','337.21');
INSERT INTO ImprovementsBuildings VALUES (20,5,'5495','1450','','3','4','1','3323010','Commercial','non','3110001','2','2023010','4','1000101','72','93','5','2002-11-1','3','2003-04-7','1','2003-04-9','fringilla\r\n tempor\r\n Cum\r\n socii','2003-01-26','634444','173.90','46','328','felis','mus','4','ac','50','justo','in\r\n faucibus','velit\r\n leo','5385945','40','87','141','74','81','72','ipsum\r\n Pellentesque','varius\r\n nunc','85','magna\r\n id','habitasse\r\n platea','2002-05-26','2002-11-16','2003-03-1','273.16','206.52','metus\r\n Sed\r\n nec\r\n pede\r\n vel\r\n','92','4744','4074.59');
INSERT INTO ImprovementsBuildings VALUES (21,6,'2436','3270','','3','4','1','1210000','Industrial','sit','1000110','2','2330001','6','1102000','78','83','1','2002-06-9','5','2003-04-12','1','2003-02-16','habitasse\r\n platea\r\n dictumst\r\n','2002-10-4','694951','381.59','481','214','adipiscing','eros','8','tellus','94','eu','erat\r\n nec','sit\r\n amet','7752659','157','261','145','561','12','45','purus\r\n consectetuer','vitae\r\n orci','50','ac\r\n turpis','posuere\r\n commodo','2002-12-12','2002-07-12','2003-02-17','21.41','83.86','Ut\r\n posuere\r\n commodo\r\n justo\r\n','89','54','775.99');
INSERT INTO ImprovementsBuildings VALUES (22,6,'7879','5899','','2','2','2','2121101','Industrial','pede Suspendisse','1000010','2','3130110','6','3033100','65','27','5','2002-08-9','3','2003-04-10','4','2002-05-19','auctor\r\n pharetra\r\n tellus\r\n Pha','2002-07-26','871813','427.37','363','406','nonummy','tempor','21','In','61','scelerisque','nec\r\n laoreet','sociis\r\n natoque','9689527','59','289','17','425','10','55','elementum\r\n nibh','adipiscing\r\n tincidunt','52','Phasellus\r\n sollicitudin','sem\r\n blandit','2002-08-10','2003-01-2','2003-02-24','156.38','68.44','et\r\n risus\r\n nec\r\n arcu\r\n adipis','100','3635','1920.98');
INSERT INTO ImprovementsBuildings VALUES (23,6,'4531','7233','','3','2','2','1113010','Residential','et','2131010','5','1322011','4','3132110','64','10','1','2002-08-27','3','2002-06-4','3','2002-10-11','nec\r\n arcu\r\n adipiscing\r\n tincid','2003-04-13','784967','458.43','72','237','ligula','Donec','19','in','1','Nulla','aliquam\r\n Morbi','lacinia\r\n quis','4584539','93','383','73','702','55','75','ut\r\n dapibus','penatibus\r\n et','4','non\r\n placerat','scelerisque\r\n enim','2002-07-13','2003-04-28','2002-06-30','67.99','82.10','tempor\r\n Ut\r\n non\r\n erat\r\n nec\r\n','10','2622','2330.47');
INSERT INTO ImprovementsBuildings VALUES (24,6,'8841','6996','','4','5','5','2232001','Commercial','ac','1300011','1','2002101','1','3211000','94','25','5','2002-08-16','1','2002-07-15','1','2002-09-23','Aliquam\r\n molestie\r\n turpis\r\n ut','2003-02-21','499322','325.96','305','269','id','nibh','18','mi','34','interdum','porttitor\r\n pulvinar','elementum\r\n dignissim','4231659','38','420','148','801','51','4','blandit\r\n ipsum','sollicitudin\r\n consectetuer','81','amet\r\n pede Suspendisse','Suspendisse\r\n tempus','2002-05-26','2002-07-25','2002-08-12','12.62','42.30','magnis\r\n dis\r\n parturient\r\n mont','75','2528','14.91');
INSERT INTO ImprovementsBuildings VALUES (25,7,'0747','3341','','4','4','4','3323110','Industrial','malesuada','1111111','4','1222010','7','1303111','78','13','5','2002-07-29','5','2003-01-13','4','2002-05-18','natoque\r\n penatibus\r\n et\r\n magni','2003-04-7','254575','307.83','189','267','risus','turpis','1','consectetuer','69','amet','pulvinar\r\n mi','Etiam\r\n non','3659429','15','294','95','990','71','17','neque\r\n Nam','neque\r\n in','31','leo\r\n sit','Morbi\r\n feugiat','2002-05-13','2003-02-7','2002-06-23','83.26','258.10','quis\r\n sem\r\n In\r\n hac\r\n habitass','100','1651','4078.23');
INSERT INTO ImprovementsBuildings VALUES (26,7,'5480','4508','','2','5','2','2102101','Industrial','eleifend','3122010','3','1211011','5','1311000','27','8','3','2003-01-10','2','2002-06-2','2','2002-06-23','volutpat\r\n velit\r\n leo\r\n at\r\n lo','2002-06-12','384898','120.50','395','322','amet','tincidunt','24','dictum','99','in','Cras\r\n volutpat','diam\r\n Nam','1964192','109','32','75','516','51','14','dolor\r\n Vivamus','ac\r\n dolor','100','posuere\r\n fermentum','wisi\r\n sit','2003-02-3','2003-04-13','2003-04-15','257.05','210.76','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','7','3880','343.36');
INSERT INTO ImprovementsBuildings VALUES (27,8,'4825','8968','','2','4','5','3023001','Industrial','in','3123111','4','3223100','7','3201011','33','94','5','2002-12-27','1','2003-04-4','1','2002-08-26','in\r\n iaculis\r\n quis\r\n velit\r\n In','2002-06-16','369953','170.37','251','312','tristique','neque','13','wisi','3','dis','justo\r\n Phasellus','metus\r\n elementum','7681465','151','300','118','997','74','59','in\r\n urna','sed\r\n purus','5','consectetuer\r\n adipiscing','est\r\n fringilla','2003-02-20','2003-04-1','2003-03-26','250.59','85.88','justo\r\n Phasellus\r\n sollicitudin','79','4651','4877.00');
INSERT INTO ImprovementsBuildings VALUES (28,8,'5563','1553','','3','3','5','3221010','Commercial','sit','2233001','1','3223001','6','2112100','53','34','3','2002-09-21','3','2003-03-28','4','2003-04-24','Nam\r\n justo\r\n nulla\r\n consequat\r','2003-03-30','128426','474.54','249','404','ut','porttitor','20','nascetur','22','et','adipiscing\r\n tincidunt','euismod\r\n nec','6235616','30','230','98','156','86','10','Nulla\r\n laoreet','lectus\r\n Cras','96','sit\r\n amet','rhoncus\r\n arcu','2002-10-4','2003-03-14','2002-12-25','157.59','126.32','non\r\n vulputate\r\n eu\r\n interdum\r','11','1351','1072.23');
INSERT INTO ImprovementsBuildings VALUES (29,9,'5694','9208','','5','2','1','2122111','Industrial','iaculis','3032010','5','2313110','8','2000101','9','98','4','2003-03-11','1','2003-03-15','1','2003-01-12','elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n','2002-11-11','435814','76.79','313','218','porttitor','tristique','16','Quisque','12','consequat','Aliquam\r\n eget','mauris\r\n Ut','3526236','39','362','149','184','49','81','dictum\r\n sapien','parturient\r\n montes','62','et\r\n magnis','Nam\r\n et','2002-10-5','2003-03-21','2002-06-11','88.41','29.91','urna\r\n erat\r\n vestibulum\r\n nibh\r','35','2243','804.28');
INSERT INTO ImprovementsBuildings VALUES (30,9,'9063','6048','','5','4','3','3100101','Industrial','scelerisque','3220001','7','2021100','5','2222110','85','70','4','2002-11-22','4','2002-09-2','5','2002-10-23','mus\r\n Aenean\r\n velit\r\n neque\r\n i','2002-06-3','321839','50.09','245','36','ridiculus','urna','22','velit','100','luctus','vel\r\n pharetra','non\r\n eros','3577149','161','219','1','522','69','76','Lorem\r\n ipsum','nunc\r\n justo','64','posuere\r\n Aliquam','commodo\r\n Etiam','2002-12-4','2002-12-13','2003-04-12','110.17','108.74','ligula\r\n vel\r\n turpis\r\n consecte','29','4788','3153.12');
INSERT INTO ImprovementsBuildings VALUES (31,9,'6854','7773','','3','5','5','3313000','Commercial','malesuada','3003000','7','3203010','1','3020011','79','22','1','2002-12-15','2','2002-07-19','2','2003-03-14','vestibulum\r\n ac\r\n est\r\n Pellente','2002-06-19','263518','264.28','156','204','et','eget','19','Lorem','71','elit','nec\r\n sem','vitae\r\n orci','3261993','172','422','149','387','87','21','Duis\r\n lacus','posuere\r\n metus','11','orci\r\n Etiam','morbi\r\n tristique','2003-03-21','2003-01-15','2002-07-16','213.74','210.68','faucibus\r\n eros\r\n in\r\n justo\r\n d','14','2959','2207.90');
INSERT INTO ImprovementsBuildings VALUES (32,9,'5616','0837','','2','4','1','3301110','Commercial','ligula','2200101','5','2120111','6','3101010','40','54','1','2002-07-15','3','2002-10-30','2','2003-03-15','fames\r\n ac\r\n turpis\r\n egestas\r\n','2002-11-18','464592','111.36','283','272','In','auctor','15','habitasse','78','nec','vestibulum\r\n nibh','feugiat\r\n arcu','5519855','36','448','68','520','15','63','Cras\r\n volutpat','Nulla\r\n quis','79','Lorem\r\n ipsum','dignissim\r\n tempor','2002-09-16','2003-05-3','2002-07-5','55.43','254.43','dolor\r\n sit\r\n amet\r\n consectetue','20','370','886.62');
INSERT INTO ImprovementsBuildings VALUES (33,9,'6696','7663','','5','2','4','1222101','Industrial','dignissim','1000111','7','3312111','7','3022101','63','76','1','2002-11-8','4','2002-09-6','3','2003-02-28','pede\r\n vitae\r\n orci\r\n Integer\r\n','2002-12-4','525247','467.91','74','91','pede','lorem','20','imperdiet','89','turpis','eros\r\n gravida','vitae\r\n molestie','4226557','130','3','32','697','35','41','non\r\n erat','Cum\r\n sociis','19','rhoncus\r\n arcu','Mauris\r\n dictum','2002-06-17','2002-09-13','2002-12-22','252.73','64.89','Nulla\r\n quis\r\n sem\r\n In\r\n hac\r\n','15','4049','2015.99');
INSERT INTO ImprovementsBuildings VALUES (34,10,'3257','5813','','3','3','1','1333111','Industrial','et','3303000','6','1121000','5','1030101','39','69','5','2002-06-22','1','2002-11-26','4','2002-08-6','sociis\r\n natoque\r\n penatibus\r\n e','2002-07-4','948192','121.36','384','197','nec','condimentum','21','quam','48','et','quis\r\n sem','vestibulum\r\n nibh','9372186','113','471','63','290','21','76','Nam\r\n ac','Duis\r\n sit','12','et\r\n ortor','mus\r\n In','2002-06-25','2002-10-10','2002-08-21','64.88','20.06','vel\r\n blandit\r\n ut\r\n nonummy\r\n a','17','4578','1793.42');
INSERT INTO ImprovementsBuildings VALUES (35,10,'2324','7641','','2','1','5','2223010','Residential','cursus','2121111','7','3222011','7','2331001','60','3','1','2002-08-25','5','2003-02-6','2','2002-12-27','malesuada\r\n fames\r\n ac\r\n turpis\r','2002-10-31','699461','434.70','389','406','nec','porttitor','21','a','80','non','pede Suspendisse\r\n potenti','et\r\n varius','3392516','156','474','76','89','91','74','et\r\n magna','Nam\r\n semper','6','amet\r\n consectetuer','fringilla\r\n Donec','2002-11-15','2002-08-15','2002-10-19','168.95','68.36','sit\r\n amet\r\n consectetuer\r\n adip','63','3576','3301.54');
INSERT INTO ImprovementsBuildings VALUES (36,10,'7148','5082','','2','4','4','3311011','Commercial','quis','3323101','6','3123100','7','1110010','3','99','4','2002-06-14','2','2003-03-23','3','2003-04-13','semper\r\n ac\r\n laoreet\r\n non\r\n me','2002-11-14','397661','39.90','233','427','nisl','semper','12','massa','24','mi','vitae\r\n orci','in\r\n justo','5623718','114','480','66','194','76','57','purus\r\n et','nunc\r\n justo','2','molestie\r\n neque','Cras\r\n vitae','2002-06-2','2002-10-22','2002-12-15','152.93','13.21','felis\r\n Duis\r\n est\r\n Cum\r\n socii','78','4625','1312.32');
INSERT INTO ImprovementsBuildings VALUES (37,11,'9155','4943','','1','3','2','1031111','Industrial','sit','2210100','3','2331011','8','1121111','92','62','5','2002-05-16','4','2003-03-22','5','2002-11-3','Donec\r\n vitae\r\n nulla\r\n Nulla\r\n','2002-10-11','733526','369.21','345','335','volutpat','vulputate','1','Proin','65','metus','senectus\r\n et','orci\r\n posuere','2139278','140','218','13','642','19','28','lorem\r\n Pellentesque','tellus\r\n Phasellus','96','egestas\r\n diam','rhoncus\r\n tincidunt','2003-03-27','2002-08-1','2002-07-25','93.99','82.43','sed\r\n diam\r\n Nam\r\n semper\r\n laci','87','3144','1084.59');
INSERT INTO ImprovementsBuildings VALUES (38,11,'1011','0831','','5','3','2','1210101','Commercial','Etiam','2133110','1','2121100','6','3222000','91','81','2','2003-01-26','4','2002-10-15','4','2002-10-18','sed\r\n ligula\r\n in\r\n sapien\r\n ull','2002-06-6','782367','209.47','452','363','eget','rhoncus','23','habitasse','1','dis','sit\r\n amet','justo\r\n in','6292994','132','166','130','441','47','45','erat\r\n nonummy','neque\r\n iaculis','15','elit\r\n Mauris','dolor\r\n sit','2003-02-9','2003-02-5','2003-03-23','13.48','131.64','elit\r\n sem\r\n scelerisque\r\n ipsum','14','3677','3622.61');
INSERT INTO ImprovementsBuildings VALUES (39,12,'5173','7245','','4','1','4','2332010','Residential','Pellentesque','3203001','5','3220000','8','3201110','23','73','1','2002-07-15','4','2003-04-17','5','2002-12-27','tellus\r\n eu\r\n velit\r\n posuere\r\n','2003-05-6','652589','148.03','1','221','urna','sit','22','sed','64','felis','velit\r\n non','euismod\r\n quis','1776922','190','39','76','508','54','65','posuere\r\n commodo','amet\r\n consectetuer','44','Pellentesque\r\n sed','sodales\r\n Etiam','2003-03-30','2002-11-3','2002-07-11','96.78','282.39','natoque\r\n penatibus\r\n et\r\n magni','23','2963','1080.92');
INSERT INTO ImprovementsBuildings VALUES (40,13,'2460','1958','','4','2','2','1033110','Commercial','quis','1021001','1','1222111','4','2020111','75','88','2','2002-08-13','5','2003-03-21','3','2002-05-21','tellus\r\n Phasellus\r\n adipiscing\r','2002-11-16','368841','399.87','143','271','Nulla','blandit','5','purus','99','scelerisque','malesuada\r\n fames','sit\r\n amet','8813744','173','229','70','524','55','29','Nunc\r\n vulputate','tempor\r\n nec','98','scelerisque\r\n enim','nulla\r\n cursus','2003-01-5','2002-12-14','2002-07-10','232.68','79.61','sit\r\n amet\r\n orci\r\n Etiam\r\n vive','78','3478','1358.73');
INSERT INTO ImprovementsBuildings VALUES (41,13,'0743','3606','','2','5','4','3220011','Residential','neque','1010110','4','1032111','8','2112010','84','87','5','2003-03-24','1','2002-06-11','1','2003-02-22','mi\r\n Phasellus\r\n est\r\n Vestibulu','2002-11-4','899187','178.65','43','2','justo','Donec','21','pulvinar','96','scelerisque','Ut\r\n sit','nunc\r\n justo','8921322','68','52','130','528','76','92','pharetra\r\n tellus','Vestibulum\r\n ante','42','sit\r\n amet','mi\r\n Lorem','2003-03-5','2003-04-8','2002-08-1','230.98','45.37','Etiam\r\n sit\r\n amet\r\n pede Suspen','19','1769','4647.69');
INSERT INTO ImprovementsBuildings VALUES (42,13,'6271','3993','','3','2','2','2100100','Commercial','consectetuer','2132001','4','3023010','5','2113001','56','1','3','2003-01-13','2','2002-06-17','2','2003-05-9','sociis\r\n natoque\r\n penatibus\r\n e','2002-12-1','364347','35.31','211','297','Nulla','nibh','7','platea','77','sed','In\r\n hac','fermentum\r\n vestibulum','2158258','176','381','76','19','57','100','consectetuer\r\n mauris','wisi\r\n sit','52','laoreet\r\n purus','odio\r\n neque','2002-10-10','2002-10-30','2002-05-24','241.27','83.03','non\r\n erat\r\n Suspendisse\r\n tempu','26','2018','1068.51');
INSERT INTO ImprovementsBuildings VALUES (43,14,'9724','3318','','5','4','1','1023000','Commercial','orci','2322000','3','1001100','10','3232010','99','83','4','2002-05-12','5','2002-05-18','3','2002-07-23','pede\r\n Proin\r\n sollicitudin\r\n co','2002-09-5','247472','400.27','189','359','netus','cursus','1','pellentesque','84','Pellentesque','tellus\r\n at','metus\r\n nec','7478482','193','469','30','814','43','67','arcu\r\n sed','porta\r\n sodales','45','mi\r\n euismod','in\r\n justo','2002-12-24','2002-09-5','2002-09-19','11.77','85.61','non\r\n pellentesque\r\n magna\r\n pur','91','4960','2154.88');
INSERT INTO ImprovementsBuildings VALUES (44,14,'1177','2764','','1','4','3','2233100','Commercial','sagittis','3333100','7','3102010','2','3030011','64','36','2','2002-11-10','1','2002-12-26','4','2002-08-11','nec\r\n pede\r\n vel\r\n nulla\r\n cursu','2002-11-3','179498','337.01','312','348','quam','vestibulum','11','elit','66','Proin','viverra\r\n In','vitae\r\n varius','6493143','179','76','130','631','53','13','Nulla\r\n quis','Vestibulum\r\n ante','20','turpis\r\n Vestibulum','In\r\n lobortis','2002-12-19','2002-06-6','2003-04-19','211.87','222.98','lectus\r\n consectetuer\r\n commodo\r','28','2927','654.38');
INSERT INTO ImprovementsBuildings VALUES (45,14,'6301','2635','','5','2','1','3333100','Residential','rutrum','1301011','1','2110101','2','2110000','27','82','1','2003-05-9','5','2002-07-15','4','2002-08-14','in\r\n pharetra\r\n augue\r\n dolor\r\n','2002-06-15','722219','345.26','437','498','ut','In','7','turpis','28','sit','parturient\r\n montes','morbi\r\n tristique','5227783','33','35','130','506','53','15','porta\r\n porta','arcu\r\n adipiscing','73','placerat\r\n vel','Donec\r\n enim','2003-04-14','2002-11-24','2002-07-18','255.25','292.68','urna\r\n faucibus\r\n ac\r\n pretium\r\n','45','1947','1382.82');
INSERT INTO ImprovementsBuildings VALUES (46,15,'7300','9573','','5','1','4','3232101','Commercial','platea','2332110','2','2002000','11','3313011','22','17','4','2002-12-16','5','2002-11-22','5','2003-02-12','ut\r\n lectus\r\n Cras\r\n volutpat\r\n','2002-08-21','119783','77.14','365','278','Suspendisse','auctor','16','ipsum','20','sollicitudin','penatibus\r\n et','nascetur\r\n ridiculus','9723953','16','255','118','342','63','30','libero\r\n Lorem','In\r\n malesuada','5','natoque\r\n penatibus','nibh\r\n Nam','2002-05-14','2002-11-22','2002-08-22','212.58','70.13','metus\r\n nec\r\n neque\r\n luctus\r\n c','32','3136','422.36');
INSERT INTO ImprovementsBuildings VALUES (47,15,'9894','6641','','3','2','5','3131000','Industrial','eros','1120100','6','3010010','2','2303100','29','14','3','2002-10-8','4','2003-03-5','3','2003-04-15','Sed\r\n nec\r\n dui\r\n Phasellus\r\n cu','2003-02-13','273933','489.96','240','295','nascetur','justo','21','nec','35','convallis','porttitor\r\n sagittis','consectetuer\r\n adipiscing','9657299','12','304','58','875','99','34','nulla\r\n consequat','dis\r\n parturient','51','mi\r\n Phasellus','est\r\n nulla','2002-10-1','2002-11-26','2002-11-27','90.76','157.10','in\r\n pharetra\r\n augue\r\n dolor\r\n','35','4875','4485.06');
INSERT INTO ImprovementsBuildings VALUES (48,15,'6887','0546','','5','1','2','3000011','Commercial','eros','2331101','3','3203101','3','2100010','36','88','2','2002-11-8','1','2003-05-9','2','2002-09-6','sodales\r\n elit\r\n sem\r\n scelerisq','2002-09-7','842248','403.84','214','276','Sed','ac','4','Maecenas','32','Curabitur','ac\r\n sapien','justo\r\n et','2869886','197','470','25','833','12','88','et\r\n lectus','In\r\n malesuada','42','nulla\r\n consequat','Integer\r\n metus','2002-10-31','2002-10-17','2003-01-5','43.72','128.57','posuere\r\n metus\r\n velit\r\n ac\r\n n','35','2677','4656.88');
INSERT INTO ImprovementsBuildings VALUES (49,15,'5817','6172','','4','5','3','1212000','Commercial','fermentum','2210010','3','2020100','4','2203011','53','47','4','2002-11-10','5','2003-02-16','2','2003-03-10','nunc\r\n eu\r\n leo\r\n rhoncus\r\n mole','2002-12-12','586797','173.33','411','267','sit','luctus','17','ac','12','commodo','nec\r\n convallis','dolor\r\n eu','6781534','32','199','98','263','4','7','mollis\r\n sodales','id\r\n ornare','95','pharetra\r\n nec','lorem\r\n sollicitudin','2002-05-24','2002-12-5','2002-07-9','128.16','22.91','morbi\r\n tristique\r\n senectus\r\n e','59','1124','954.96');
INSERT INTO ImprovementsBuildings VALUES (50,15,'5427','9385','','3','2','1','2112010','Commercial','nibh','1033010','4','2113110','12','2232110','26','25','5','2002-06-23','3','2003-01-14','3','2003-01-13','id\r\n orci\r\n posuere\r\n fermentum\r','2003-01-27','686288','176.66','413','29','Nunc','scelerisque','3','lorem','41','ipsum','sed\r\n nunc','ipsum\r\n dolor','8739762','26','124','46','289','85','54','est\r\n Quisque','vel\r\n semper','91','ipsum\r\n dolor','platea\r\n dictumst','2002-11-24','2003-04-15','2003-01-17','80.85','276.67','mi\r\n Morbi\r\n mi\r\n lorem\r\n viverr','2','4920','4346.40');
INSERT INTO ImprovementsBuildings VALUES (51,16,'4784','5439','','1','1','3','1033111','Residential','volutpat','3211100','4','1313010','7','1031010','75','30','3','2002-10-22','4','2003-02-27','4','2002-06-2','pede\r\n vel\r\n nulla\r\n cursus\r\n vi','2002-05-18','495688','182.52','62','312','ac','augue','21','penatibus','47','Etiam','nec\r\n auctor','netus\r\n et','9999129','200','95','103','581','76','68','Aliquam\r\n molestie','orci\r\n Integer','40','non\r\n lorem','congue\r\n Nullam','2002-10-8','2003-04-17','2002-10-27','80.50','194.30','aliquam\r\n ac\r\n aliquet\r\n ac\r\n sa','17','496','2665.92');
INSERT INTO ImprovementsBuildings VALUES (52,16,'1396','2600','','3','5','5','3023101','Industrial','enim','1100110','1','3233001','10','1213111','23','3','1','2002-07-10','1','2003-03-8','3','2002-05-22','blandit\r\n ipsum\r\n Aliquam\r\n eget','2002-09-3','382883','150.66','30','346','pede','tellus','17','nunc','43','In','leo\r\n at','justo\r\n Donec','8862388','129','275','133','200','33','30','rutrum\r\n massa','sollicitudin\r\n consectetuer','6','rhoncus\r\n arcu','ridiculus\r\n mus','2003-02-28','2003-04-14','2002-08-6','106.99','193.78','enim\r\n Etiam\r\n non\r\n metus\r\n nec','40','3664','1126.05');
INSERT INTO ImprovementsBuildings VALUES (53,17,'0464','6919','','1','3','4','3002101','Commercial','nec','2222110','4','3020000','3','2010101','67','68','2','2002-07-5','1','2002-10-13','4','2003-04-2','euismod\r\n nec\r\n laoreet\r\n eget\r\n','2002-10-14','114412','373.27','250','77','in','cursus','13','ipsum','51','Quisque','lorem\r\n viverra','et\r\n netus','3357324','116','190','46','415','70','4','orci\r\n Ut','justo\r\n nulla','56','sodales\r\n elit','justo\r\n Phasellus','2003-05-6','2002-12-27','2003-04-25','252.36','205.74','egestas\r\n diam\r\n Fusce\r\n ante\r\n','58','2737','3072.57');
INSERT INTO ImprovementsBuildings VALUES (54,18,'8452','7193','','4','3','2','1021110','Commercial','quis','2101011','5','1130010','15','1012100','6','20','2','2002-06-26','4','2002-12-8','5','2003-05-8','pellentesque\r\n magna\r\n purus\r\n e','2002-07-31','459823','295.56','31','66','sit','nulla','3','Nunc','26','massa','justo\r\n ut','fermentum\r\n Donec','1333442','160','87','3','900','27','53','varius\r\n massa','vulputate\r\n et','21','quis\r\n ligula','viverra\r\n risus','2002-11-7','2002-08-31','2003-02-3','157.50','216.31','id\r\n urna\r\n id\r\n orci\r\n posuere\r','30','3104','3711.12');
INSERT INTO ImprovementsBuildings VALUES (55,18,'1736','7636','','5','1','4','2100010','Industrial','penatibus','3301100','7','3203101','18','3313000','40','23','2','2002-11-11','2','2002-07-1','3','2002-12-27','molestie\r\n volutpat\r\n massa\r\n ve','2002-11-25','774723','469.24','383','16','urna','commodo','11','risus','60','posuere','nunc\r\n consectetuer','feugiat\r\n pede','2694847','117','83','85','114','47','13','Pellentesque\r\n libero','varius\r\n massa','11','ut\r\n neque','in\r\n justo','2002-10-11','2003-01-4','2002-11-6','226.96','262.87','Curae\r\n Donec\r\n vulputate\r\n Null','50','2648','4405.25');
INSERT INTO ImprovementsBuildings VALUES (56,18,'4818','6967','','4','4','1','2321110','Industrial','risus','2200101','2','3030100','7','3330100','24','52','2','2002-05-25','2','2003-03-22','1','2002-06-8','posuere\r\n Aliquam\r\n rhoncus\r\n ti','2002-09-16','386973','384.11','355','464','nibh','et','24','dapibus','10','orci','justo\r\n et','condimentum\r\n posuere','5865552','138','154','129','264','43','71','lacus\r\n Nam','augue\r\n non','92','non\r\n placerat','mi\r\n euismod','2002-07-1','2002-08-5','2002-09-5','261.62','290.56','non\r\n neque\r\n Nam\r\n justo\r\n null','100','1213','3929.55');
INSERT INTO ImprovementsBuildings VALUES (57,18,'2514','1226','','1','2','2','2333100','Residential','eros','2103110','3','2222010','13','1310001','99','64','4','2003-02-6','3','2003-01-12','1','2003-04-9','et\r\n felis\r\n Duis\r\n est\r\n Cum\r\n','2002-10-13','652438','17.63','30','257','varius','faucibus','1','mus','48','In','pede\r\n auctor','pede\r\n vitae','5368672','171','242','30','15','30','6','amet\r\n consectetuer','ut\r\n neque','88','Sed\r\n nec','auctor\r\n vel','2003-01-16','2002-08-11','2002-12-31','14.67','134.65','In\r\n hac\r\n habitasse\r\n platea\r\n','26','2358','818.53');
INSERT INTO ImprovementsBuildings VALUES (58,19,'4385','5194','','3','3','4','2231010','Industrial','at','3101001','6','3220101','14','3033101','87','29','3','2002-06-17','1','2003-03-20','4','2003-03-26','posuere\r\n Aliquam\r\n rhoncus\r\n ti','2002-05-28','424164','129.34','451','24','turpis','mus','17','dolor','4','semper','consequat\r\n eget','aliquet\r\n ac','4911731','36','212','60','164','82','71','elit\r\n Duis','libero\r\n Lorem','80','dignissim\r\n mi','egestas\r\n diam','2003-05-5','2002-10-31','2003-02-26','117.31','153.56','viverra\r\n risus\r\n vitae\r\n varius','71','1191','3203.73');
INSERT INTO ImprovementsBuildings VALUES (59,19,'0496','9910','','5','2','1','1322010','Industrial','aliquet','3213010','3','1032011','11','3101111','71','99','4','2003-05-9','5','2002-07-11','5','2003-01-19','elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n','2002-06-2','325445','197.76','35','21','metus','nibh','19','lorem','28','sit','varius\r\n massa','velit\r\n leo','4587619','114','310','105','359','43','73','quis\r\n ligula','Ut\r\n turpis','33','enim\r\n Cras','morbi\r\n tristique','2003-04-25','2003-04-15','2003-04-9','216.22','34.36','tincidunt\r\n Quisque\r\n tristique\r','97','4648','636.46');
INSERT INTO ImprovementsBuildings VALUES (60,19,'8199','3474','','4','3','4','3002101','Industrial','imperdiet','3320001','6','2303001','18','2230001','62','20','5','2003-02-24','2','2002-09-25','4','2003-02-1','et\r\n velit\r\n In\r\n lobortis\r\n mag','2002-07-5','869179','350.09','407','465','felis','nulla','9','augue','49','at','senectus\r\n et','velit\r\n In','7928414','160','56','34','285','7','90','Ut\r\n non','In\r\n fermentum','19','est\r\n eget','Fusce\r\n sit','2002-05-19','2003-01-1','2003-03-19','113.10','125.55','euismod\r\n pharetra\r\n nunc\r\n Aene','88','1343','2114.37');
INSERT INTO ImprovementsBuildings VALUES (61,19,'1016','8023','','3','1','4','2010011','Residential','Praesent','2001010','2','2220111','19','3002011','61','88','3','2002-12-10','4','2003-04-7','4','2002-07-12','enim\r\n In\r\n risus\r\n risus\r\n matt','2002-08-27','621499','164.55','489','181','bibendum','non','22','velit','39','Pellentesque','fermentum\r\n vestibulum','ultrices\r\n posuere','9644729','154','10','109','20','92','73','sed\r\n dolor','ac\r\n turpis','83','urna\r\n Nullam','est\r\n eget','2002-07-1','2002-11-29','2003-01-3','133.83','267.50','urna\r\n id\r\n orci\r\n posuere\r\n fer','44','2194','4411.60');
INSERT INTO ImprovementsBuildings VALUES (62,20,'7215','7668','','4','1','1','1231101','Industrial','nulla','3203110','7','1023000','12','1312010','91','26','4','2002-07-8','1','2002-11-15','4','2003-02-9','Pellentesque\r\n egestas\r\n diam\r\n','2002-11-7','957973','24.60','467','498','pharetra','adipiscing','24','interdum','39','Ut sem','magna\r\n purus','ipsum\r\n eros','3583175','161','461','85','722','39','66','sodales\r\n Etiam','id\r\n turpis','80','mollis\r\n sodales','volutpat\r\n velit','2003-03-16','2002-12-17','2002-09-3','218.03','90.55','et\r\n ortor\r\n Sed\r\n eget\r\n elit\r\n','79','3976','3823.87');
INSERT INTO ImprovementsBuildings VALUES (63,20,'5030','5612','','4','4','3','2332101','Residential','porttitor','3213110','7','2311010','8','1001100','16','22','2','2003-03-8','4','2002-12-15','5','2002-09-30','Cum\r\n sociis\r\n natoque\r\n penatib','2003-01-17','569628','29.28','35','405','sollicitudin','nec','17','tellus','46','arcu','fermentum\r\n et','faucibus\r\n eros','9931637','42','120','97','991','100','16','sem\r\n In','Aliquam\r\n nulla','5','In\r\n et','viverra\r\n risus','2003-02-23','2003-01-5','2002-08-26','11.05','299.18','Nullam\r\n fermentum\r\n vestibulum\r','99','1371','200.34');
INSERT INTO ImprovementsBuildings VALUES (64,21,'4468','9828','','2','4','5','1122101','Commercial','nec','3013110','6','1301100','11','2331100','44','27','2','2002-12-7','2','2002-05-13','4','2002-07-9','mattis\r\n vel\r\n pulvinar\r\n ac\r\n i','2003-04-13','819255','463.11','323','147','amet','enim','15','Vestibulum','9','eu','ridiculus\r\n mus','Vivamus\r\n convallis','2955537','96','446','55','772','85','28','dictum\r\n Pellentesque','malesuada\r\n fames','78','vel\r\n nulla','lacus\r\n Nam','2002-09-28','2003-01-25','2002-11-3','292.07','39.82','turpis\r\n consectetuer\r\n tristiqu','36','4668','1275.00');
INSERT INTO ImprovementsBuildings VALUES (65,21,'3766','8685','','1','2','1','2311001','Residential','elit','3313011','3','3311001','19','2322101','10','87','3','2003-04-17','4','2003-01-2','3','2003-02-4','sem\r\n Aliquam\r\n molestie\r\n turpi','2002-08-24','466578','159.80','172','11','ante','euismod','12','Nullam','28','viverra','vitae\r\n varius','et\r\n dui','8164487','75','300','55','457','63','3','et\r\n magnis','sit\r\n amet','56','amet\r\n consectetuer','non\r\n nibh','2003-04-5','2002-08-4','2002-12-17','291.45','212.53','nec\r\n auctor\r\n eget\r\n vulputate\r','21','3426','718.52');
INSERT INTO ImprovementsBuildings VALUES (66,21,'6307','1149','','2','4','1','1211011','Residential','vulputate','3220100','4','1030001','9','1232001','82','6','1','2002-07-5','2','2003-04-15','3','2002-11-7','ut\r\n neque\r\n Duis\r\n id\r\n urna\r\n','2003-04-21','224399','157.53','258','243','magnis','non','22','Duis','51','sapien','Aliquam\r\n non','Morbi\r\n rhoncus','9857594','26','317','127','963','98','25','Etiam\r\n massa','ornare\r\n vitae','55','lacus\r\n Nam','fermentum\r\n et','2003-02-11','2002-06-11','2002-07-10','254.36','225.19','erat\r\n Suspendisse\r\n tempus\r\n qu','16','3077','1297.07');
INSERT INTO ImprovementsBuildings VALUES (67,21,'2551','9016','','5','3','1','3013100','Industrial','et','3332101','2','2102011','20','1323110','58','86','5','2003-05-8','5','2003-05-7','5','2002-09-16','Curabitur\r\n imperdiet\r\n neque\r\n','2002-12-30','753594','399.76','396','374','Etiam','et','5','volutpat','1','enim','faucibus\r\n eros','magnis\r\n dis','7294111','138','298','73','2','63','92','pulvinar\r\n in','nascetur\r\n ridiculus','72','Nunc\r\n volutpat','viverra\r\n Pellentesque','2002-10-5','2002-07-21','2002-06-27','252.16','175.92','Sed\r\n et\r\n velit\r\n In\r\n lobortis','37','3265','4807.13');
INSERT INTO ImprovementsBuildings VALUES (68,22,'1956','2314','','3','1','3','3202100','Commercial','convallis','3033110','2','2222110','22','2332101','90','13','3','2002-08-4','3','2003-01-20','1','2002-06-22','nascetur\r\n ridiculus\r\n mus\r\n In\r','2003-01-27','541583','213.56','415','362','eget','ante','24','eu','71','elit','fermentum\r\n Lorem','quam\r\n vel','4679189','136','365','6','185','78','31','sociis\r\n natoque','non\r\n pellentesque','81','Nullam\r\n non','ac\r\n est','2003-05-3','2002-09-19','2002-08-21','92.95','199.77','sit\r\n amet\r\n orci\r\n Etiam\r\n vive','16','3680','1688.97');
INSERT INTO ImprovementsBuildings VALUES (69,23,'5000','4854','','4','4','2','2002111','Commercial','id','2102101','4','1220100','12','1301101','66','23','4','2002-06-15','3','2003-04-30','3','2003-03-20','urna\r\n erat\r\n vestibulum\r\n nibh\r','2002-05-22','884137','243.78','205','438','Nunc','ac','21','vulputate','33','vulputate','Nulla\r\n vitae','massa\r\n Donec','7482273','32','109','97','947','12','60','Duis\r\n est','porta\r\n sodales','31','posuere\r\n interdum','sociis\r\n natoque','2002-11-12','2003-01-5','2002-10-3','176.10','184.31','velit\r\n viverra\r\n risus\r\n vitae\r','48','2403','4269.13');
INSERT INTO ImprovementsBuildings VALUES (70,24,'9972','0782','','1','4','4','1130001','Commercial','urna','1123101','5','2233000','16','3312110','60','98','2','2003-01-31','5','2003-02-10','2','2002-09-19','aliquam\r\n ac\r\n aliquet\r\n ac\r\n sa','2002-08-1','944651','454.80','365','261','quis','odio','7','libero','74','sed','dui\r\n Phasellus','Etiam\r\n non','5378442','75','81','128','670','31','68','nulla\r\n cursus','id\r\n urna','90','neque\r\n Nam','Ut\r\n non','2003-04-8','2003-01-21','2002-06-5','222.42','276.58','urna\r\n Nullam\r\n molestie\r\n neque','57','1409','4083.64');
INSERT INTO ImprovementsBuildings VALUES (71,24,'8685','0338','','3','5','2','1010000','Residential','amet','1111000','4','2131001','20','1012001','18','68','2','2003-03-12','1','2003-01-12','3','2003-03-12','ligula\r\n condimentum\r\n posuere\r\n','2003-05-7','429838','181.93','43','298','pede Suspendisse','In','24','blandit','32','justo','Donec\r\n fringilla','leo\r\n rhoncus','1928219','170','210','10','557','69','2','Nulla\r\n laoreet','nibh\r\n Etiam','100','Fusce\r\n ante','est\r\n nulla','2002-06-29','2002-11-14','2003-04-9','161.91','53.70','non\r\n neque\r\n Nam\r\n justo\r\n null','90','2456','500.60');
INSERT INTO ImprovementsBuildings VALUES (72,24,'5716','7484','','1','5','5','2102011','Commercial','vestibulum','2030100','3','2121111','13','1131000','15','17','3','2002-12-28','4','2002-10-12','3','2003-01-23','tempor\r\n Cum\r\n sociis\r\n natoque\r','2002-09-4','459668','20.81','120','167','Sed','diam','12','montes','21','ipsum','eget\r\n ligula','Pellentesque\r\n sed','9317844','146','210','109','799','96','57','nunc\r\n cursus','Nulla\r\n tempor','46','Fusce\r\n sit','Curabitur\r\n aliquet','2002-12-26','2002-06-20','2002-08-18','138.23','250.36','pulvinar\r\n ac\r\n iaculis\r\n ut\r\n n','56','2241','2097.96');
INSERT INTO ImprovementsBuildings VALUES (73,25,'6440','0984','','5','1','5','3230011','Industrial','sit','1112111','7','1320110','8','3111111','10','17','4','2002-10-28','5','2002-06-26','1','2003-02-9','eget\r\n ligula\r\n Nam\r\n quam\r\n met','2002-06-9','622867','166.14','71','145','at','egestas','11','Nam','64','dis','porta\r\n Maecenas','fringilla\r\n Donec','2251591','55','431','115','440','51','95','sapien\r\n purus','metus\r\n nec','29','dictum\r\n sapien','mi\r\n eleifend','2003-05-11','2003-03-23','2002-12-3','254.34','87.31','nibh\r\n nunc\r\n consectetuer\r\n leo','11','1588','69.40');
INSERT INTO ImprovementsBuildings VALUES (74,26,'5910','6001','','1','3','4','3311011','Residential','libero','3132001','4','2123111','22','2312010','34','13','3','2003-02-17','5','2003-04-7','3','2003-01-20','In\r\n sit\r\n amet\r\n augue\r\n non\r\n','2003-02-4','648865','466.25','32','33','quam','iaculis','8','leo','88','Cras','sit\r\n amet','ac\r\n iaculis','8571963','144','138','60','726','1','55','urna\r\n Nullam','ante\r\n ligula','15','porta\r\n porta','sem\r\n scelerisque','2002-05-26','2002-05-27','2003-04-12','223.03','190.60','tristique\r\n Quisque\r\n interdum\r\n','41','1981','441.54');
INSERT INTO ImprovementsBuildings VALUES (75,27,'3482','0404','','2','5','4','2030111','Industrial','vulputate','2210010','4','1333101','18','2032010','100','0','5','2003-01-2','1','2003-04-10','5','2003-02-18','ipsum\r\n primis\r\n in\r\n faucibus\r\n','2002-11-3','834954','484.23','178','60','ornare','diam','11','dolor','55','quam','at\r\n volutpat','nulla\r\n Ut sem','9816927','121','389','116','339','12','9','justo\r\n nulla','non\r\n risus','6','mi\r\n Lorem','enim\r\n Cras','2003-05-3','2003-02-28','2003-01-24','183.45','92.29','quam\r\n vel\r\n dictum\r\n dictum\r\n s','51','4300','2414.75');
INSERT INTO ImprovementsBuildings VALUES (76,28,'0005','2370','','5','1','1','1333110','Residential','rhoncus','2213110','6','1333011','27','1132011','5','85','1','2002-10-11','4','2003-03-19','3','2002-08-20','auctor\r\n pharetra\r\n tellus\r\n Pha','2002-08-12','545879','307.78','8','74','nec','pharetra','11','dolor','58','Donec','vehicula\r\n sed','risus\r\n nec','9227743','103','291','29','309','32','37','Donec\r\n purus','Nunc\r\n bibendum','78','quam\r\n metus','nec\r\n pede','2002-09-8','2002-07-10','2002-06-22','287.45','152.90','amet\r\n dapibus\r\n ipsum\r\n nulla\r\n','45','2591','3835.20');
INSERT INTO ImprovementsBuildings VALUES (77,29,'9420','0528','','3','1','5','1223101','Industrial','porta','3112111','3','3120011','29','1232100','26','87','5','2002-09-21','3','2002-06-25','4','2003-01-22','quis\r\n quam\r\n porta\r\n sodales\r\n','2002-05-13','743474','374.04','288','317','in','non','20','tempus','69','est','Nullam\r\n fermentum','sit\r\n amet','5963367','50','163','147','282','96','30','lobortis\r\n magna','et\r\n magnis','82','est\r\n Vestibulum','non\r\n risus','2003-05-1','2002-09-15','2003-02-22','69.74','87.66','iaculis\r\n quis\r\n velit\r\n In\r\n si','76','1217','4514.30');
INSERT INTO ImprovementsBuildings VALUES (78,29,'7287','2815','','1','2','2','2303010','Industrial','vel','3230111','7','3300101','7','3222001','49','8','3','2002-10-16','5','2002-05-24','1','2002-08-6','erat\r\n sodales\r\n elementum\r\n Int','2002-08-26','749593','212.36','356','374','elit','sit','20','malesuada','5','dictum','nulla\r\n Sed','porttitor\r\n pulvinar','2475555','189','496','127','387','39','71','id\r\n urna','Nam\r\n pretium','41','adipiscing\r\n elit','enim\r\n vel','2002-09-11','2002-11-20','2002-10-3','274.99','43.57','mi\r\n euismod\r\n fermentum\r\n Donec','17','4352','4721.13');
INSERT INTO ImprovementsBuildings VALUES (79,29,'4622','2588','','1','4','1','3221110','Commercial','Duis','2220110','3','2211001','25','3101001','89','60','4','2003-04-7','5','2002-08-2','3','2003-03-8','sollicitudin\r\n consectetuer\r\n ma','2003-03-20','528771','43.51','166','8','id','lacus','20','dolor','40','turpis','Ut\r\n elementum','sollicitudin\r\n vel','4544558','179','270','9','273','29','31','in\r\n pharetra','lectus\r\n Cras','61','Cum\r\n sociis','porttitor\r\n pulvinar','2002-07-9','2003-03-11','2002-10-7','98.60','8.29','luctus\r\n justo\r\n Donec\r\n tristiq','81','1827','3449.32');
INSERT INTO ImprovementsBuildings VALUES (80,30,'2292','4968','','5','3','2','1133111','Residential','mattis','3212000','3','2310011','19','2201111','97','44','4','2002-09-21','2','2002-09-10','3','2003-03-27','senectus\r\n et\r\n netus\r\n et\r\n mal','2003-04-25','712297','80.09','89','282','Cras','tempor','13','hac','81','posuere','convallis\r\n in','volutpat\r\n In','5665813','21','220','133','54','50','27','pede\r\n et','magna\r\n Maecenas','50','lorem\r\n et','Suspendisse\r\n tempus','2003-02-5','2003-01-11','2002-10-29','260.85','41.66','Nulla\r\n felis\r\n lorem\r\n sollicit','98','356','4913.76');
INSERT INTO ImprovementsBuildings VALUES (81,31,'6738','8235','','5','1','2','3302111','Residential','euismod','3310101','7','1130010','10','3203110','65','49','3','2002-09-7','2','2002-08-5','1','2003-02-27','interdum\r\n lobortis\r\n nibh\r\n Nul','2002-08-10','732863','41.40','61','299','Nullam','eget','13','sociis','52','neque','dolor\r\n sit','Lorem\r\n ipsum','6917948','109','290','46','468','24','20','ipsum\r\n in','Donec\r\n tristique','68','sit\r\n amet','pede\r\n tempor','2002-07-23','2002-10-26','2002-07-13','156.06','23.73','Duis\r\n sit\r\n amet\r\n enim\r\n Ut\r\n','37','2221','3937.53');
INSERT INTO ImprovementsBuildings VALUES (82,31,'6358','6344','','4','4','3','2001010','Industrial','at','1300100','7','2030011','10','3200001','57','38','5','2003-04-3','4','2003-03-12','5','2002-07-16','euismod\r\n quis\r\n vestibulum\r\n ac','2003-04-26','873341','24.87','311','247','Quisque','fermentum','18','sapien','38','elit','non\r\n eros','tristique\r\n senectus','8382788','69','213','116','157','72','65','velit\r\n non','purus\r\n consectetuer','84','sapien\r\n purus','vestibulum\r\n Ut','2003-05-5','2003-02-3','2002-10-5','210.53','176.16','diam\r\n Aliquam\r\n non\r\n erat\r\n Su','66','624','326.73');
INSERT INTO ImprovementsBuildings VALUES (83,31,'9057','9325','','4','4','5','3132100','Commercial','lacus','1113110','5','2230101','18','1132011','78','36','2','2002-09-29','3','2002-12-17','1','2002-07-24','molestie\r\n neque\r\n non\r\n nibh\r\n','2002-12-7','612542','112.41','11','410','mus','Vivamus','7','elit','63','semper','amet\r\n augue','ac\r\n pretium','3656511','175','203','137','221','36','26','et\r\n velit','ultrices\r\n malesuada','73','ipsum\r\n Aliquam','Ut\r\n euismod','2002-10-25','2002-11-14','2003-04-15','107.83','262.11','interdum\r\n ac\r\n felis\r\n In\r\n fer','51','3260','4634.94');
INSERT INTO ImprovementsBuildings VALUES (84,32,'9447','7300','','5','3','3','1231100','Residential','nulla','1323010','5','1230001','10','3013101','6','10','2','2003-04-22','5','2003-01-14','4','2002-07-4','id\r\n eros\r\n condimentum\r\n malesu','2003-02-5','219552','235.27','314','398','Nulla','hac','15','sapien','51','in','urna\r\n Nullam','augue\r\n non','2496293','4','158','69','158','35','31','feugiat\r\n arcu','In\r\n risus','54','vitae\r\n euismod','Aenean\r\n interdum','2002-09-7','2002-11-13','2002-12-19','140.12','228.34','elit\r\n Nunc\r\n bibendum\r\n turpis\r','47','3515','3719.20');
INSERT INTO ImprovementsBuildings VALUES (85,32,'7019','3480','','5','3','1','2212001','Industrial','potenti','2202100','5','3212000','10','2030011','48','97','3','2002-06-29','1','2002-12-9','2','2003-01-3','risus\r\n Sed\r\n nec\r\n dui\r\n Phasel','2002-10-23','397237','439.68','87','211','diam','velit','3','purus','82','dolor','vulputate\r\n ipsum','non\r\n placerat','7954334','98','390','66','393','20','43','Morbi\r\n feugiat','Morbi\r\n feugiat','3','Etiam\r\n massa','eget\r\n elit','2002-11-3','2002-10-28','2002-11-19','54.93','108.30','sit\r\n amet\r\n consectetuer\r\n adip','95','2761','115.42');
INSERT INTO ImprovementsBuildings VALUES (86,33,'5708','3248','','1','1','5','2002001','Industrial','et','1122110','5','3231111','4','2002000','78','98','1','2003-03-21','2','2003-01-17','5','2002-11-11','Praesent\r\n quis\r\n enim\r\n Etiam\r\n','2002-11-15','138779','268.35','480','90','tincidunt','lacus','2','mauris','76','quam','In\r\n hac','In\r\n hac','7973557','12','134','146','204','59','89','ac\r\n iaculis','vel\r\n turpis','33','Nam\r\n est','justo\r\n Nam','2002-08-2','2002-05-30','2002-12-7','100.60','30.17','quis\r\n velit\r\n In\r\n sit\r\n amet\r\n','87','1699','1279.40');
INSERT INTO ImprovementsBuildings VALUES (87,34,'7374','5267','','3','3','4','1302011','Residential','vulputate','3130111','3','3012011','29','3230001','82','43','3','2003-05-6','5','2002-11-11','3','2002-12-1','netus\r\n et\r\n malesuada\r\n fames\r\n','2003-04-3','569374','402.72','316','258','non','in','17','vel','99','sociis','urna\r\n erat','dolor\r\n Nunc','6432943','126','415','126','920','96','14','Quisque\r\n ante','nec\r\n mi','25','elit\r\n Nam','sit\r\n amet','2003-04-20','2002-10-31','2002-05-14','241.07','163.83','erat\r\n nonummy\r\n sodales\r\n Etiam','1','65','4811.18');
INSERT INTO ImprovementsBuildings VALUES (88,35,'3932','4792','','5','1','5','2101101','Industrial','dictumst','2110100','1','2130110','11','3121101','93','18','3','2003-03-23','2','2002-12-25','5','2003-04-12','rhoncus\r\n wisi\r\n augue\r\n id\r\n or','2002-12-13','481269','46.10','221','263','ac','pede','10','metus','67','ut','montes\r\n nascetur','erat\r\n Vivamus','2192771','98','31','126','127','47','28','ipsum\r\n dolor','erat\r\n sodales','65','convallis\r\n ac','posuere\r\n fermentum','2002-11-20','2002-10-11','2002-10-23','195.18','200.82','urna\r\n faucibus\r\n ac\r\n pretium\r\n','44','2628','1773.37');
INSERT INTO ImprovementsBuildings VALUES (89,35,'3452','7469','','1','1','1','1123001','Industrial','bibendum','3030110','1','1321101','19','1203101','38','21','5','2003-03-12','4','2002-09-29','1','2002-10-6','dis\r\n parturient\r\n montes\r\n nasc','2003-03-12','513232','168.44','466','343','lacus','non','2','eleifend','55','nisl','augue\r\n Quisque','Duis\r\n lacus','7884916','44','313','99','56','43','27','diam\r\n Nam','et\r\n ultrices','81','non\r\n eros','felis\r\n aliquam','2002-08-6','2002-11-29','2002-12-21','11.98','26.31','et\r\n magnis\r\n dis\r\n parturient\r\n','26','2757','838.86');
INSERT INTO ImprovementsBuildings VALUES (90,35,'3604','4770','','5','4','1','2300111','Commercial','vestibulum','1320011','6','1021011','35','2003110','42','29','3','2002-12-28','2','2003-02-10','4','2003-04-5','sapien\r\n vehicula\r\n pede\r\n portt','2002-10-28','373999','298.59','346','262','senectus','massa','12','metus','39','nunc','turpis\r\n Vestibulum','turpis\r\n consectetuer','3811674','183','343','43','380','23','24','habitant\r\n morbi','imperdiet\r\n neque','26','Mauris\r\n at','quis\r\n sem','2003-01-8','2002-09-24','2002-10-15','47.93','37.99','viverra\r\n risus\r\n vitae\r\n varius','91','4512','4680.37');
INSERT INTO ImprovementsBuildings VALUES (91,36,'0335','4852','1','2','2','4','1300100','Industrial','mi','3303000','1','3222111','6','1331100','60','89','4','2002-06-27','4','2002-12-10','1','2002-08-16','tincidunt\r\n Donec\r\n purus\r\n feli','2003-01-24','232448','485.23','286','468','elementum','Nullam','1','arcu','85','vel','ac\r\n est','orci\r\n Etiam','7578925','136','168','124','505','20','67','amet\r\n consectetuer','risus\r\n nec','7','Sed\r\n nec','nisl\r\n consequat','2002-07-16','2003-03-7','2003-01-24','276.32','124.05','vitae\r\n varius\r\n nunc\r\n justo\r\n','31','3987','4030.26');
INSERT INTO ImprovementsBuildings VALUES (92,37,'4009','4822','1','5','4','3','1111011','Industrial','leo','3101010','6','2021000','3','1010010','44','42','2','2002-11-20','1','2002-10-31','2','2003-02-9','adipiscing\r\n elit\r\n Nunc\r\n vulpu','2003-04-24','243737','70.28','284','364','ultrices','dictumst','20','in','34','Mauris','gravida\r\n pede','ante\r\n ipsum','7875228','7','235','127','888','72','3','non\r\n nibh','turpis\r\n nisl','39','Curabitur\r\n imperdiet','vestibulum\r\n Ut','2003-04-5','2003-05-5','2002-08-27','79.90','39.01','sodales\r\n rutrum\r\n massa\r\n purus','97','1277','126.81');
INSERT INTO ImprovementsBuildings VALUES (93,38,'8802','0236','1','1','2','1','3023000','Residential','vel','1303001','3','3221110','4','2310111','33','13','5','2002-09-9','1','2003-01-31','2','2002-08-22','lacus\r\n id\r\n eros\r\n condimentum\r','2002-12-31','666933','221.05','231','150','neque','nec','5','sit','3','et','amet\r\n augue','felis\r\n aliquam','6571881','130','368','16','509','62','79','euismod\r\n enim','metus\r\n dapibus','62','potenti\r\n Nulla','id\r\n ornare','2002-10-9','2002-11-14','2002-12-12','292.65','183.01','vel\r\n turpis\r\n consectetuer\r\n tr','60','3389','4353.14');
INSERT INTO ImprovementsBuildings VALUES (94,38,'8625','6981','1','5','2','5','2202110','Commercial','in','2321111','3','3012010','30','2013100','83','10','4','2002-07-28','2','2002-09-2','4','2002-08-24','non\r\n pellentesque\r\n magna\r\n pur','2002-05-17','445899','35.90','475','144','purus','Quisque','13','pede','48','Nam','mi\r\n eleifend','iaculis\r\n ut','5371149','129','490','29','407','94','12','sed\r\n diam','justo\r\n et','84','parturient\r\n montes','nulla\r\n erat','2002-11-11','2002-09-15','2003-02-25','203.05','16.23','ac\r\n pretium\r\n ac\r\n pellentesque','99','3807','851.54');
INSERT INTO ImprovementsBuildings VALUES (95,38,'4490','3758','1','4','2','2','2322001','Industrial','iaculis','3003111','7','2212001','9','1011010','72','68','5','2002-12-30','5','2003-02-11','3','2003-03-22','consequat\r\n quis\r\n pulvinar\r\n in','2002-11-26','297269','97.03','242','462','penatibus','molestie','3','amet','82','laoreet','faucibus\r\n ac','pulvinar\r\n ullamcorper','5172234','83','476','119','59','78','3','non\r\n metus','at\r\n lorem','96','Mauris\r\n dictum','justo\r\n nulla','2002-11-25','2002-11-25','2002-08-5','7.05','229.41','enim\r\n Etiam\r\n non\r\n metus\r\n nec','93','3284','1904.78');
INSERT INTO ImprovementsBuildings VALUES (96,39,'0724','8651','1','5','5','4','2103010','Residential','sit','2220101','1','2022100','26','2123000','29','92','5','2002-10-22','3','2002-08-8','1','2002-07-21','enim\r\n Cras\r\n vitae\r\n lacus\r\n id','2002-09-16','359274','73.44','16','205','risus','ipsum','20','nonummy','32','pede','Aliquam\r\n non','elit\r\n Cras','4918826','187','195','3','962','27','52','orci\r\n Ut','molestie\r\n neque','50','quam\r\n metus','diam\r\n Nam','2002-06-2','2002-06-24','2003-04-17','51.31','299.78','consequat\r\n eget\r\n pellentesque\r','61','2392','3820.99');
INSERT INTO ImprovementsBuildings VALUES (97,39,'7841','6059','1','3','4','1','3123001','Residential','adipiscing','2131100','3','3122000','1','2211100','70','70','2','2002-10-8','2','2002-07-7','1','2002-07-29','ante\r\n ipsum\r\n primis\r\n in\r\n fau','2002-06-14','656487','303.65','491','217','volutpat','aliquet','25','Pellentesque','15','magna','aliquet\r\n ac','laoreet\r\n sem','2729125','28','360','24','368','32','99','Sed\r\n et','Nunc\r\n vulputate','78','Praesent\r\n quis','In\r\n risus','2002-12-19','2002-07-24','2002-06-9','106.81','58.66','tellus\r\n eu\r\n velit\r\n posuere\r\n','87','426','51.72');
INSERT INTO ImprovementsBuildings VALUES (98,40,'4424','3688','2','5','2','3','1103000','Commercial','auctor','2130111','5','3322110','23','1030010','60','84','2','2002-10-5','1','2002-06-14','4','2002-09-10','leo\r\n at\r\n lorem\r\n Nam\r\n pretium','2002-06-14','788748','9.41','429','296','ultrices','rhoncus','12','morbi','55','dignissim','sit\r\n amet','montes\r\n nascetur','5169366','45','239','33','931','32','35','habitant\r\n morbi','ligula\r\n ornare','3','cursus\r\n justo','blandit\r\n ut','2002-06-24','2002-08-12','2003-05-11','71.37','225.62','lorem\r\n et\r\n lectus\r\n consectetu','69','3789','752.41');
INSERT INTO ImprovementsBuildings VALUES (99,41,'2202','4390','2','4','1','5','1132010','Residential','ornare','2332000','6','2311001','39','3020001','90','50','5','2002-08-21','5','2003-04-15','5','2003-03-5','interdum\r\n tempus\r\n erat\r\n Vivam','2002-08-22','754321','68.86','349','127','quis','scelerisque','19','Donec','87','tempus','turpis\r\n egestas','velit\r\n In','6664332','3','96','142','157','71','40','molestie\r\n volutpat','turpis\r\n ut','8','In\r\n hac','In\r\n fermentum','2002-12-15','2003-03-17','2003-02-25','249.24','112.05','dictumst\r\n Curabitur\r\n imperdiet','42','2213','778.89');
INSERT INTO ImprovementsBuildings VALUES (100,41,'4876','4670','5','2','5','3','3102001','Residential','magna','2102100','6','3220100','13','2111000','13','62','5','2002-10-8','5','2003-02-4','1','2003-02-19','id\r\n eros\r\n condimentum\r\n malesu','2003-02-6','983278','144.32','276','430','faucibus','et','24','ornare','59','Sed','arcu\r\n sed','et\r\n ortor','4572853','139','324','70','460','83','22','quis\r\n pede','pede Suspendisse\r\n potenti','5','magna\r\n sed','at\r\n ipsum','2002-09-4','2002-08-16','2003-04-5','187.78','52.14','odio\r\n Pellentesque\r\n nec\r\n magn','56','885','3945.01');
INSERT INTO ImprovementsBuildings VALUES (101,42,'6999','1579','1','2','1','1','3013000','Industrial','molestie','3110001','2','1221111','21','3101111','14','74','1','2003-03-15','1','2003-04-26','4','2002-12-2','tempus\r\n posuere\r\n felis\r\n mi\r\n','2003-01-8','265322','289.25','265','404','nunc','nascetur','11','vel','69','lorem','vehicula\r\n sed','sodales\r\n rutrum','2989987','25','313','107','259','50','34','Quisque\r\n ante','erat\r\n vestibulum','7','lectus\r\n consectetuer','blandit\r\n ipsum','2002-12-26','2003-04-28','2002-05-24','192.35','109.80','elit\r\n Cras\r\n porttitor\r\n pulvin','23','1040','4292.01');
INSERT INTO ImprovementsBuildings VALUES (102,42,'9196','9527','1','1','5','2','3120110','Residential','Nulla','2010101','6','2213000','30','1311011','87','69','5','2003-02-19','3','2003-03-1','3','2003-04-19','consectetuer\r\n adipiscing\r\n elit','2002-12-13','277618','130.11','22','189','ultricies','nascetur','22','sem','57','Donec','Pellentesque\r\n posuere','ac\r\n laoreet','7331959','93','194','128','344','25','3','Donec\r\n fringilla','mauris\r\n Ut','89','risus\r\n Sed','consequat\r\n eget','2002-07-30','2003-04-6','2002-07-20','41.96','171.20','erat\r\n sit\r\n amet\r\n est\r\n fringi','51','2987','2749.86');
INSERT INTO ImprovementsBuildings VALUES (103,43,'3951','2407','5','5','5','4','2021011','Industrial','feugiat','3022101','1','3223000','24','2102011','69','81','3','2002-12-31','1','2002-09-15','4','2003-05-1','gravida\r\n non\r\n placerat\r\n vel\r\n','2002-11-7','698321','113.07','367','179','Phasellus','velit','16','aliquet','32','neque','Cum\r\n sociis','nec\r\n pede','9577239','4','423','138','767','81','84','leo\r\n sit','volutpat\r\n In','85','justo\r\n nulla','platea\r\n dictumst','2002-07-21','2002-12-28','2002-07-7','59.30','268.67','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','80','1432','1520.08');
INSERT INTO ImprovementsBuildings VALUES (104,44,'0730','2660','8','1','5','2','2113001','Residential','vel','3000001','7','2013100','10','2122010','69','3','1','2002-09-9','4','2002-10-26','1','2003-03-12','ligula\r\n ornare\r\n ut\r\n dapibus\r\n','2003-05-1','624914','451.82','80','360','euismod','malesuada','10','semper','95','montes','In\r\n lobortis','ullamcorper\r\n nibh','4861743','140','243','114','861','89','13','egestas\r\n Nunc','condimentum\r\n posuere','36','est\r\n Cum','ipsum\r\n nulla','2003-01-26','2002-06-4','2002-07-18','257.45','252.02','neque\r\n luctus\r\n congue\r\n Nullam','19','629','1819.94');
INSERT INTO ImprovementsBuildings VALUES (105,45,'7920','9629','8','2','4','4','2220101','Commercial','consequat','1223000','2','3312110','17','3111101','65','0','4','2002-07-9','4','2002-09-24','4','2002-10-3','dictumst\r\n Curabitur\r\n imperdiet','2002-10-9','686191','465.05','134','314','Morbi','enim','16','erat','83','magna','Etiam\r\n odio','erat\r\n lacinia','2841414','9','330','96','731','8','28','ridiculus\r\n mus','feugiat\r\n pede','8','amet\r\n consectetuer','pede\r\n vitae','2002-10-28','2002-06-5','2002-11-13','104.63','123.53','interdum\r\n ac\r\n felis\r\n In\r\n fer','2','1091','4977.55');
INSERT INTO ImprovementsBuildings VALUES (106,45,'9211','4107','7','5','3','5','3230110','Industrial','felis','1101000','3','1333111','18','3001010','62','2','4','2003-01-25','1','2002-06-9','5','2003-04-17','ac\r\n pellentesque\r\n et\r\n ortor\r\n','2002-08-23','357315','419.94','26','304','Etiam','vitae','8','eleifend','3','Ut','pede\r\n Proin','Integer\r\n laoreet','2545793','18','60','64','242','83','57','tincidunt\r\n lacus','laoreet\r\n non','72','orci\r\n Ut','eget\r\n tellus','2003-03-12','2003-01-14','2003-01-14','87.36','163.86','nonummy\r\n sodales\r\n Etiam\r\n lect','26','196','4025.33');
INSERT INTO ImprovementsBuildings VALUES (107,46,'3887','0117','5','5','1','5','3112000','Commercial','In','1110111','2','1303000','12','1120101','0','38','1','2002-11-7','1','2003-03-20','1','2003-01-18','eget\r\n pellentesque\r\n et\r\n moles','2002-12-6','362193','391.49','242','319','elementum','fermentum','10','lorem','86','dis','eleifend\r\n gravida','Aliquam\r\n nulla','7796573','138','417','92','414','77','16','malesuada\r\n leo','sed\r\n ligula','96','enim\r\n In','amet\r\n consectetuer','2002-09-9','2003-04-22','2002-08-31','38.50','91.42','turpis\r\n egestas\r\n Nunc\r\n non\r\n','37','1511','805.97');
INSERT INTO ImprovementsBuildings VALUES (108,46,'9121','0421','6','3','3','2','1301000','Residential','convallis','2201001','1','3100011','10','2301010','28','22','1','2003-03-3','1','2003-02-26','1','2003-03-18','leo\r\n rhoncus\r\n molestie\r\n In\r\n','2003-04-26','657448','153.42','192','156','nec','rhoncus','18','Etiam','6','nascetur','felis\r\n Duis','pulvinar\r\n mi','9947837','197','291','63','745','18','21','vel\r\n nunc','magnis\r\n dis','71','Nullam\r\n molestie','lacinia\r\n lorem','2002-05-18','2003-01-19','2002-08-11','288.03','90.28','cubilia\r\n Curae\r\n Donec\r\n vulput','71','3255','2679.25');
INSERT INTO ImprovementsBuildings VALUES (109,46,'6175','5989','5','2','4','3','2100001','Residential','enim','3102100','4','2132110','8','2120100','99','77','2','2002-07-31','2','2003-02-1','3','2003-02-23','id\r\n urna\r\n Nullam\r\n magna\r\n Mae','2002-05-19','689127','289.84','307','232','cursus','dolor','23','pede','83','tempor','sit\r\n amet','justo\r\n Phasellus','9427823','185','139','99','34','2','29','tincidunt\r\n in','amet\r\n nisl','76','justo\r\n ut','Nunc\r\n volutpat','2003-01-20','2002-12-30','2002-11-14','206.33','94.04','sociis\r\n natoque\r\n penatibus\r\n e','100','3772','4184.61');
INSERT INTO ImprovementsBuildings VALUES (110,46,'9310','5273','8','2','5','4','3303110','Commercial','amet','2301000','1','1203110','9','1331110','72','31','3','2002-10-15','3','2003-01-23','1','2002-11-15','sem\r\n scelerisque\r\n ipsum\r\n in\r\n','2002-10-27','541593','103.20','485','267','quis','malesuada','23','est','52','leo','arcu\r\n adipiscing','ullamcorper\r\n nibh','1844255','91','247','65','978','32','13','sollicitudin\r\n et','nec\r\n magna','12','Vivamus\r\n convallis','sed\r\n diam','2002-08-25','2002-08-24','2003-03-3','169.55','175.90','malesuada\r\n fames\r\n ac\r\n turpis\r','17','1063','420.43');
INSERT INTO ImprovementsBuildings VALUES (111,47,'1220','5399','6','4','1','3','1331101','Industrial','sodales','3000000','3','3203000','4','2031000','79','41','2','2003-03-25','5','2003-02-16','2','2002-06-12','purus\r\n consectetuer\r\n tellus\r\n','2002-06-2','515379','433.22','153','388','turpis','ipsum','10','eu','96','purus','nulla\r\n posuere','amet\r\n est','6535793','164','447','140','161','22','99','ligula\r\n in','pretium\r\n ac','48','libero\r\n Lorem','feugiat\r\n arcu','2003-03-15','2003-04-20','2003-04-2','258.08','132.86','volutpat\r\n velit\r\n leo\r\n at\r\n lo','81','1231','4676.64');
INSERT INTO ImprovementsBuildings VALUES (112,47,'7152','8172','2','2','4','3','1211101','Commercial','libero','2232100','3','2200101','19','1121001','57','33','1','2003-02-26','3','2003-01-6','4','2002-08-23','commodo\r\n nec\r\n convallis\r\n in\r\n','2002-11-10','152997','434.42','189','308','vel','Nam','20','luctus','60','ornare','volutpat\r\n massa','vulputate\r\n Nullam','8876391','6','240','35','19','60','62','montes\r\n nascetur','sit\r\n amet','58','non\r\n mollis','sollicitudin\r\n vulputate','2003-02-9','2003-02-26','2002-07-5','114.68','149.87','interdum\r\n tempus\r\n erat\r\n Vivam','19','2654','1518.95');
INSERT INTO ImprovementsBuildings VALUES (113,47,'4933','2930','5','2','2','2','2033111','Commercial','amet','2111101','6','2120000','33','1223110','63','60','1','2002-10-23','1','2002-05-27','1','2003-03-1','Etiam\r\n viverra\r\n Nulla\r\n laoree','2002-06-25','136964','185.13','457','364','ipsum','vel','19','ac','41','nulla','est\r\n Vestibulum','dolor\r\n sit','2198751','62','339','115','335','79','69','convallis\r\n ac','amet\r\n nisl','13','vel\r\n semper','semper\r\n ac','2003-01-23','2003-01-5','2002-12-12','298.11','218.45','sed\r\n diam\r\n Nam\r\n semper\r\n laci','19','4948','89.13');
INSERT INTO ImprovementsBuildings VALUES (114,48,'6748','0667','5','4','4','3','3301110','Residential','sit','1313100','6','3133001','26','3011110','48','61','5','2002-11-9','3','2002-09-25','4','2003-01-31','viverra\r\n Pellentesque\r\n egestas','2002-05-13','743373','29.66','454','382','tempor','metus','24','ligula','24','magna','non\r\n erat','viverra\r\n id','2872122','1','156','99','682','53','75','nec\r\n neque','in\r\n aliquet','1','sit\r\n amet','laoreet\r\n purus','2002-09-15','2002-12-2','2002-12-24','134.70','97.70','luctus\r\n et\r\n ultrices\r\n posuere','69','245','3867.76');
INSERT INTO ImprovementsBuildings VALUES (115,49,'0753','0387','4','5','5','5','1003101','Residential','potenti','2322101','4','2332011','48','3210010','19','44','5','2003-02-18','1','2002-06-12','3','2003-01-22','congue\r\n Nullam\r\n non\r\n neque\r\n','2003-02-1','724564','364.08','274','353','erat','est','6','fames','99','platea','Nam\r\n quam','turpis\r\n non','2725245','48','88','6','869','66','49','magnis\r\n dis','lorem\r\n et','32','ornare\r\n vitae','mi\r\n lorem','2003-01-30','2003-03-1','2002-10-29','239.93','65.03','Integer\r\n metus\r\n In\r\n commodo\r\n','38','796','1141.88');
INSERT INTO ImprovementsBuildings VALUES (116,49,'1989','0157','1','1','5','2','3111110','Residential','fermentum','3021010','6','1102110','43','1000100','45','73','4','2003-04-8','2','2002-12-14','2','2002-08-17','fames\r\n ac\r\n turpis\r\n egestas\r\n','2003-03-24','947815','262.18','489','344','amet','non','7','nisl','79','ultrices','ipsum\r\n Aliquam','non\r\n erat','8293962','155','266','106','362','76','22','nec\r\n pede','id\r\n turpis','54','Pellentesque\r\n posuere','posuere\r\n fermentum','2002-11-28','2003-03-18','2003-04-19','95.46','47.43','vitae\r\n lacus\r\n id\r\n eros\r\n cond','73','99','1867.53');
INSERT INTO ImprovementsBuildings VALUES (117,50,'6314','0191','1','2','5','3','1012100','Industrial','Fusce','2111010','6','3322101','48','2110010','27','33','1','2002-10-28','5','2002-11-3','3','2003-03-27','lorem\r\n et\r\n lectus\r\n consectetu','2002-10-31','179432','243.19','403','205','justo','viverra','14','nec','51','dapibus','tincidunt\r\n lacus','pulvinar\r\n ullamcorper','6283133','165','215','85','186','3','8','et\r\n magnis','metus\r\n Sed','89','elit\r\n Nunc','Suspendisse\r\n vestibulum','2003-02-15','2002-08-16','2002-08-27','253.18','184.06','sapien\r\n Morbi\r\n feugiat\r\n arcu\r','68','3320','3524.79');
INSERT INTO ImprovementsBuildings VALUES (118,50,'8763','3473','4','3','4','1','2100110','Residential','Nam','1120110','1','2033100','2','3210000','44','68','1','2002-08-23','4','2003-02-13','5','2002-05-25','lacus\r\n Nam\r\n est\r\n nulla\r\n soll','2002-10-23','171486','395.41','269','400','pellentesque','non','25','turpis','53','scelerisque','diam\r\n Fusce','quam\r\n porta','1954396','86','122','72','105','34','47','pulvinar\r\n ac','ipsum\r\n primis','5','adipiscing\r\n elit','metus\r\n Sed','2002-07-26','2002-11-28','2002-10-9','273.80','187.71','dictumst\r\n Cum\r\n sociis\r\n natoqu','38','1819','1357.62');
INSERT INTO ImprovementsBuildings VALUES (119,50,'2888','8224','9','5','1','5','1321101','Residential','consectetuer','1302101','7','3321010','5','3013101','91','42','3','2003-01-25','5','2002-10-24','4','2003-01-29','velit\r\n In\r\n lobortis\r\n magna\r\n','2003-03-29','358144','49.19','3','13','porta','vitae','9','in','38','quis','Nullam\r\n fermentum','fermentum\r\n Lorem','8919431','42','105','1','255','88','93','posuere\r\n fermentum','interdum\r\n ac','18','vel\r\n nulla','amet\r\n dapibus','2002-07-22','2003-03-6','2002-05-28','84.35','137.09','eget\r\n tellus\r\n eu\r\n velit\r\n pos','37','1402','1796.38');
INSERT INTO ImprovementsBuildings VALUES (120,54,'8192','3388','20','2','1','2','1113110','Residential','sapien','3102111','1','2101000','50','3131000','91','100','5','2002-07-29','3','2002-09-2','2','2002-07-6','justo\r\n Phasellus\r\n sollicitudin','2002-07-6','326417','142.90','271','204','Sed','amet','13','non','75','vehicula','pede\r\n Proin','netus\r\n et','5779143','18','183','1','196','3','38','eu\r\n interdum','Pellentesque\r\n eget','14','tempor\r\n nec','Donec\r\n fringilla','2002-09-9','2002-06-9','2003-03-28','18.32','38.17','In\r\n risus\r\n risus\r\n mattis\r\n ve','92','2898','1820.52');
INSERT INTO ImprovementsBuildings VALUES (121,54,'9366','0879','22','5','3','2','3321100','Residential','Quisque','2221100','7','1333111','32','2000100','5','38','4','2003-04-14','3','2003-03-9','5','2002-05-31','sit\r\n amet\r\n est\r\n eget\r\n velit\r','2003-05-4','157191','307.15','272','221','lorem','et','21','Etiam','93','ligula','ac\r\n scelerisque','purus\r\n ultricies','7333886','157','197','13','372','79','96','malesuada\r\n leo','ornare\r\n vitae','63','Nam\r\n quam','vitae\r\n lacus','2002-06-8','2003-04-26','2002-10-26','36.59','169.68','consectetuer\r\n tristique\r\n Quisq','63','21','1801.52');
INSERT INTO ImprovementsBuildings VALUES (122,54,'5119','8257','22','2','5','1','2101011','Commercial','Pellentesque','1100100','1','2001001','44','1223001','51','51','1','2003-01-3','4','2003-04-21','2','2003-05-6','adipiscing\r\n Pellentesque\r\n habi','2003-03-29','724285','129.31','477','44','Cras','turpis','24','posuere','52','nonummy','placerat\r\n vel','consectetuer\r\n tellus','5559766','171','409','14','47','48','87','turpis\r\n egestas','fames\r\n ac','71','eu\r\n leo','nascetur\r\n ridiculus','2002-11-21','2002-08-13','2003-04-15','235.72','134.12','iaculis\r\n quis\r\n velit\r\n In\r\n si','4','3024','4678.56');
INSERT INTO ImprovementsBuildings VALUES (123,54,'9589','7574','10','4','2','4','1132110','Residential','enim','1312110','4','3020011','14','2110101','11','31','5','2002-10-4','3','2002-12-24','4','2002-10-2','non\r\n lorem\r\n et\r\n lectus\r\n cons','2002-10-2','729551','255.69','343','70','tellus','id','5','convallis','89','dictum','sed\r\n nunc','euismod\r\n Sed','2268581','131','444','30','477','10','2','sit\r\n amet','nec\r\n auctor','23','aliquet\r\n at','tristique\r\n senectus','2002-11-11','2002-08-14','2002-11-1','175.08','78.41','montes\r\n nascetur\r\n ridiculus\r\n','70','3954','4526.72');
INSERT INTO ImprovementsBuildings VALUES (124,55,'7950','0072','23','4','1','2','3110010','Industrial','urna','1202010','6','1203001','48','3022101','100','51','1','2003-04-20','1','2002-06-5','4','2002-10-8','at\r\n ipsum\r\n Pellentesque\r\n habi','2002-12-29','767573','415.94','347','458','enim','et','4','at','64','pede','et\r\n enim','arcu\r\n adipiscing','7818683','138','374','105','492','29','37','magna\r\n Maecenas','consectetuer\r\n adipiscing','80','non\r\n mollis','ac\r\n felis','2003-04-27','2002-08-9','2003-02-20','23.82','125.93','non\r\n risus\r\n nec\r\n enim\r\n ultri','84','3621','777.15');
INSERT INTO ImprovementsBuildings VALUES (125,55,'3119','2228','18','5','3','4','3032101','Commercial','non','2212111','4','3212011','33','2130000','90','12','3','2002-07-12','2','2002-12-25','2','2002-11-21','Sed\r\n vitae\r\n erat\r\n sit\r\n amet\r','2002-11-23','868756','477.29','494','45','Ut','Mauris','9','posuere','56','vel','montes\r\n nascetur','sed\r\n dolor','3571319','74','162','40','4','38','23','velit\r\n non','dis\r\n parturient','19','et\r\n mi','Nulla\r\n quis','2002-11-8','2003-04-2','2002-09-14','27.45','1.82','vitae\r\n sollicitudin\r\n sit\r\n ame','44','3319','1678.29');
INSERT INTO ImprovementsBuildings VALUES (126,56,'1437','7592','23','1','5','1','1300110','Industrial','quis','1111001','5','2002110','47','2131100','57','80','4','2003-04-6','1','2002-08-1','2','2003-04-20','molestie\r\n vel\r\n risus\r\n Sed\r\n n','2002-12-29','332155','49.32','332','32','habitasse','Cras','4','metus','13','pharetra','metus\r\n velit','eros\r\n gravida','3339472','37','381','105','543','48','87','scelerisque\r\n enim','ridiculus\r\n mus','25','Vivamus\r\n convallis','amet\r\n consectetuer','2002-09-28','2003-01-19','2003-02-25','193.49','187.82','lorem\r\n Nam\r\n pretium\r\n magna\r\n','77','3058','3547.03');
INSERT INTO ImprovementsBuildings VALUES (127,56,'2728','9582','18','1','4','5','2123111','Commercial','sit','3103110','1','3002110','46','1321010','8','56','2','2003-01-24','2','2002-10-31','5','2002-05-24','dictumst\r\n Cum\r\n sociis\r\n natoqu','2003-02-11','728836','427.18','63','336','pede','non','8','Phasellus','90','Lorem','In\r\n lobortis','Ut\r\n sit','1952862','33','489','93','991','49','34','volutpat\r\n varius','viverra\r\n id','71','tempus\r\n erat','dui\r\n Phasellus','2002-08-2','2002-07-13','2002-11-21','39.61','262.02','ut\r\n nonummy\r\n at\r\n ipsum\r\n Pell','44','1947','4504.18');
INSERT INTO ImprovementsBuildings VALUES (128,57,'7083','3567','19','4','4','1','1332001','Commercial','vitae','1311010','7','3231110','5','3222011','88','56','4','2003-02-11','5','2002-09-29','3','2002-12-29','wisi\r\n Lorem\r\n ipsum\r\n dolor\r\n s','2003-02-24','474868','316.60','374','91','nulla','placerat','8','habitasse','47','nulla','est\r\n Cum','interdum\r\n lobortis','3292975','127','386','108','113','14','69','scelerisque\r\n pulvinar','wisi\r\n Lorem','73','at\r\n sapien','eros\r\n gravida','2003-05-1','2002-05-25','2002-11-2','300.01','82.98','magna\r\n nec\r\n ligula\r\n condiment','31','526','4378.81');
INSERT INTO ImprovementsBuildings VALUES (129,57,'0952','7262','6','2','1','1','3233011','Residential','nec','2212110','4','2011111','51','1300100','76','28','4','2003-03-16','4','2003-01-1','5','2002-11-27','velit\r\n ac\r\n nulla\r\n Sed\r\n vitae','2002-06-5','681371','263.16','13','243','velit','Sed','19','Pellentesque','86','Curae','amet\r\n consectetuer','eget\r\n tellus','6856635','184','369','84','503','39','25','vulputate\r\n eu','Nullam\r\n non','75','sem\r\n Aliquam','tincidunt\r\n Donec','2002-08-17','2003-01-20','2003-04-30','151.07','84.92','quis\r\n sem\r\n In\r\n hac\r\n habitass','87','3425','310.46');
INSERT INTO ImprovementsBuildings VALUES (130,58,'3659','5586','1','2','3','2','3121100','Commercial','convallis','2103101','4','3010101','38','2133110','64','94','4','2003-04-19','1','2002-05-24','2','2002-08-17','enim\r\n vel\r\n turpis\r\n Vestibulum','2002-05-19','274224','177.69','228','105','ut','pulvinar','25','ridiculus','37','Sed','aliquam\r\n ac','erat\r\n nec','3147583','98','329','69','72','2','90','magna\r\n sed','in\r\n fermentum','18','sapien\r\n Nulla','Pellentesque\r\n libero','2003-02-26','2002-10-3','2003-01-4','98.64','199.94','laoreet\r\n purus\r\n et\r\n dui\r\n Don','32','1123','563.14');
INSERT INTO ImprovementsBuildings VALUES (131,59,'2350','1525','7','1','5','5','3103110','Residential','et','2002001','6','3110001','4','2111111','19','75','2','2002-10-22','4','2003-01-29','5','2002-08-18','semper\r\n lacinia\r\n lorem\r\n Pelle','2002-08-13','519794','320.57','478','232','faucibus','ridiculus','3','Nam','61','in','Aliquam\r\n molestie','pede Suspendisse\r\n potenti','3278386','78','392','53','430','88','86','Etiam\r\n non','neque\r\n non','2','Proin\r\n faucibus','et\r\n erat','2002-09-2','2002-11-24','2003-04-13','273.74','1.00','et\r\n magnis\r\n dis\r\n parturient\r\n','36','1117','3294.68');
INSERT INTO ImprovementsBuildings VALUES (132,60,'6742','2345','19','5','2','2','3100011','Commercial','metus','3313011','6','1122001','42','1012010','91','51','2','2003-01-1','2','2003-04-29','5','2003-01-2','vel\r\n semper\r\n ac\r\n laoreet\r\n no','2002-05-23','369417','433.52','248','164','consectetuer','platea','17','ante','45','vulputate','Donec\r\n tristique','aliquam\r\n Morbi','3977824','71','393','105','607','86','25','Mauris\r\n at','nibh\r\n Nulla','47','purus\r\n et','ac\r\n scelerisque','2002-10-11','2003-03-25','2002-11-21','148.61','36.50','dapibus\r\n ipsum\r\n nulla\r\n ac\r\n f','79','3439','1348.66');
INSERT INTO ImprovementsBuildings VALUES (133,60,'3766','9096','1','3','5','2','1223000','Industrial','erat','3332010','4','3111010','1','3200100','13','88','2','2002-07-17','3','2002-11-2','3','2003-04-5','habitasse\r\n platea\r\n dictumst\r\n','2003-04-5','587363','251.26','474','394','Curabitur','sagittis','13','interdum','23','natoque','urna\r\n id','sed\r\n dolor','4499495','156','185','58','614','3','2','tristique\r\n metus','porttitor\r\n pulvinar','40','eros\r\n Curabitur','sodales\r\n elementum','2002-10-29','2002-09-20','2002-12-30','143.14','221.32','et\r\n malesuada\r\n fames\r\n ac\r\n tu','12','361','1670.83');
INSERT INTO ImprovementsBuildings VALUES (134,61,'5798','8594','7','5','4','2','2113011','Commercial','Maecenas','3121110','4','3312000','12','2233000','32','32','3','2002-07-5','4','2002-06-7','3','2003-05-6','tristique\r\n Quisque\r\n interdum\r\n','2002-07-5','713643','10.78','289','6','justo','sit','13','leo','69','sem','vulputate\r\n nisl','Cum\r\n sociis','4654859','145','61','67','381','92','68','odio\r\n Pellentesque','erat\r\n Vivamus','62','purus\r\n ultricies','sociis\r\n natoque','2003-03-25','2002-06-8','2002-07-5','11.60','165.30','sagittis\r\n Fusce\r\n sit\r\n amet\r\n','66','4866','1053.46');
INSERT INTO ImprovementsBuildings VALUES (135,61,'7853','3570','10','5','2','4','1232001','Industrial','sem','1011111','2','3332011','43','3030110','83','88','5','2002-07-21','4','2002-06-22','3','2003-02-26','Pellentesque\r\n eget\r\n tellus\r\n e','2002-06-10','785538','161.82','44','165','diam','semper','6','tristique','75','potenti','posuere\r\n euismod','posuere\r\n cubilia','6382449','180','150','52','250','39','58','et\r\n ortor','ipsum\r\n primis','89','cursus\r\n dictum','non\r\n eros','2002-11-19','2003-05-4','2003-03-20','161.76','283.32','eu\r\n interdum\r\n ac\r\n felis\r\n In\r','68','4902','1672.72');
INSERT INTO ImprovementsBuildings VALUES (136,61,'0454','9246','17','4','3','3','3331010','Industrial','Duis','2322000','6','3300000','7','3021110','1','63','4','2003-01-14','4','2002-11-11','2','2003-02-5','sit\r\n amet\r\n libero\r\n Lorem\r\n ip','2003-02-24','934524','188.20','150','199','turpis','Suspendisse','21','non','89','dolor','Quisque\r\n diam','ultricies\r\n wisi','8369848','22','419','108','294','60','65','Nunc\r\n bibendum','Quisque\r\n interdum','44','Aenean\r\n velit','platea\r\n dictumst','2002-09-30','2002-09-16','2003-02-25','247.40','165.91','vehicula\r\n sed\r\n dolor\r\n Vivamus','57','266','4789.71');
INSERT INTO ImprovementsBuildings VALUES (137,62,'3800','2499','25','4','1','2','1032101','Residential','ac','2331110','3','1322101','35','3003000','5','100','5','2003-03-2','4','2002-09-14','5','2002-06-23','pharetra\r\n nunc\r\n Aenean\r\n inter','2002-05-22','925497','245.70','33','234','viverra','sociis','18','gravida','68','porta','laoreet\r\n sem','bibendum\r\n sapien','3782426','133','251','122','934','19','45','platea\r\n dictumst','lacus\r\n Nam','100','Ut\r\n non','quis\r\n quam','2002-09-22','2003-01-26','2003-01-22','66.18','1.08','eget\r\n velit\r\n porta\r\n porta\r\n M','17','1116','585.83');
INSERT INTO ImprovementsBuildings VALUES (138,62,'9809','2532','9','2','1','1','1230111','Commercial','orci','2123001','6','1120100','5','2022000','9','77','3','2002-12-7','4','2003-04-16','1','2002-06-8','senectus\r\n et\r\n netus\r\n et\r\n mal','2002-07-23','658861','250.03','113','62','Pellentesque','sit','24','ipsum','92','non','ipsum\r\n Aliquam','convallis\r\n ac','6732385','160','154','1','162','17','35','et\r\n velit','risus\r\n Sed','81','Lorem\r\n ipsum','bibendum\r\n sapien','2002-12-21','2002-07-8','2002-08-18','98.00','134.61','nulla\r\n consequat\r\n quis\r\n pulvi','48','4397','45.60');
INSERT INTO ImprovementsBuildings VALUES (139,62,'6079','4496','20','3','4','5','1030001','Residential','scelerisque','3323110','4','2221000','58','3003011','6','43','2','2002-07-3','1','2003-03-29','3','2002-11-18','ridiculus\r\n mus\r\n Pellentesque\r\n','2003-03-29','353251','62.05','121','340','non','nec','1','sit','30','ac','vel\r\n dictum','adipiscing\r\n elit','4181981','78','54','101','519','55','63','convallis\r\n velit','pede\r\n porttitor','49','scelerisque\r\n non','enim\r\n Curabitur','2002-10-29','2002-07-13','2002-11-4','104.65','254.97','In\r\n hac\r\n habitasse\r\n platea\r\n','11','3726','1621.67');
INSERT INTO ImprovementsBuildings VALUES (140,62,'8907','0525','24','4','5','4','1100001','Residential','sit','3003000','5','2020100','51','3301011','94','7','4','2003-05-14','2','2003-04-18','3','2003-04-22','blandit\r\n ut\r\n nonummy\r\n at\r\n ip','2002-10-14','426629','238.30','281','38','Aliquam','mattis','11','ipsum','62','Ut','sit\r\n amet','nibh\r\n Nulla','2493671','106','214','54','6','59','4','auctor\r\n pharetra','Aliquam\r\n molestie','70','vitae\r\n varius','mi\r\n lorem','2003-02-11','2003-05-8','2002-05-22','197.31','282.64','sit\r\n amet\r\n orci\r\n Etiam\r\n vive','94','1451','2419.11');
INSERT INTO ImprovementsBuildings VALUES (141,63,'8472','4096','20','2','1','3','1312101','Residential','semper','1321000','7','3322100','34','2110000','54','58','2','2003-04-1','4','2002-07-22','5','2002-09-14','Donec\r\n purus\r\n felis\r\n aliquam\r','2003-04-22','967355','189.41','114','254','ipsum','Sed','5','volutpat','63','risus','adipiscing\r\n elit','posuere\r\n Aliquam','2392571','108','28','117','646','66','43','ornare\r\n vitae','rhoncus\r\n wisi','99','enim\r\n ultrices','pede\r\n Proin','2003-01-26','2003-01-15','2002-08-3','265.63','248.76','pede\r\n Proin\r\n sollicitudin\r\n co','60','532','271.29');
INSERT INTO ImprovementsBuildings VALUES (142,63,'2164','1253','23','1','5','3','2111100','Residential','Nunc','2300000','3','1231101','7','1123010','4','94','3','2002-11-1','5','2002-07-30','2','2002-06-3','lectus\r\n Cras\r\n volutpat\r\n variu','2002-08-22','229269','334.36','359','463','consectetuer','Etiam','21','erat','72','purus','erat\r\n Suspendisse','fermentum\r\n et','3563469','87','278','4','197','80','66','ut\r\n nonummy','sodales\r\n Fusce','5','vel\r\n dictum','quis\r\n pede','2002-12-8','2002-08-12','2002-06-7','56.71','161.86','ullamcorper\r\n nibh\r\n nunc\r\n cons','96','2747','2678.05');
INSERT INTO ImprovementsBuildings VALUES (143,65,'5234','5316','11','5','5','1','1330111','Commercial','vitae','3021010','7','3220001','22','3020010','5','31','1','2002-12-13','5','2003-05-1','3','2002-08-1','quam\r\n scelerisque\r\n pulvinar\r\n','2003-05-3','656594','55.28','429','409','et','Pellentesque','24','velit','92','sollicitudin','ultrices\r\n malesuada','posuere\r\n euismod','5288591','114','398','9','883','84','67','pede\r\n et','pede\r\n vitae','25','pulvinar\r\n mi','ipsum\r\n nulla','2003-02-13','2003-04-19','2003-04-15','180.28','173.39','vel\r\n turpis\r\n consectetuer\r\n tr','46','88','4074.22');
INSERT INTO ImprovementsBuildings VALUES (144,65,'6452','8907','18','4','5','4','2303010','Commercial','neque','2021000','4','2123111','111','2111110','13','95','2','2002-07-30','1','2002-09-4','2','2003-03-29','volutpat\r\n ac\r\n sapien\r\n Morbi\r\n','2003-03-11','996483','94.11','263','267','Cum','Maecenas','11','et','60','commodo','posuere\r\n metus','quis\r\n quam','1126397','197','296','12','24','93','72','ipsum\r\n primis','quis\r\n pulvinar','99','at\r\n lorem','orci\r\n Etiam','2003-03-25','2002-11-30','2002-08-19','79.89','194.86','dolor\r\n sit\r\n amet\r\n consectetue','97','625','887.47');
INSERT INTO ImprovementsBuildings VALUES (145,65,'8227','6892','23','1','3','2','3102001','Commercial','quis','3323101','7','2322111','38','3301001','29','5','3','2003-02-26','2','2002-08-19','3','2002-10-5','vitae\r\n nulla\r\n Nulla\r\n tincidun','2003-01-22','188985','309.96','421','88','libero','risus','6','laoreet','87','Donec','Phasellus\r\n adipiscing','Ut\r\n non','2637142','101','21','123','438','34','86','nunc\r\n eu','molestie\r\n neque','67','sed\r\n nunc','Nulla\r\n nec','2002-08-28','2002-08-22','2002-12-13','170.50','198.69','Pellentesque\r\n habitant\r\n morbi\r','75','2168','4006.04');
INSERT INTO ImprovementsBuildings VALUES (146,66,'7897','987','32','','','','078','86','97','087','07','96','','','6745','875','','2003-05-06','','2003-05-08','','2003-05-05','895','','98798','798','798','7897','897','897','897','897','97','907','907','907','907','987','987','986','87658','757','657','6858','98','79087','987','9867','2003-05-06','2003-05-05','2003-05-06','9769','68','5','7645','5','');
INSERT INTO ImprovementsBuildings VALUES (147,68,'','','41','','','','','','','','','','','','','','','2003-05-19','','2003-05-19','','2003-05-19','','','','','','','','','','','','','','','','','','','','','','','','','','','2003-05-19','2003-05-19','2003-05-19','','','','','','');
INSERT INTO ImprovementsBuildings VALUES (148,71,'54326','12-34-56-78-98','46','1','2','3','300,000','Residential','Residential','200,000.00','30','60,000.00','','','','','4','2003-05-20','4','2003-05-20','4','2003-05-20','','','12-34-56-78-99','','','','','','','','','','','','','','','','','','','','','','','','2003-05-20','2003-05-20','2003-05-20','400','400','','100,000','100,000.00','200,000.00');
INSERT INTO ImprovementsBuildings VALUES (149,76,'07070-00997','045-07-070-05-032-1001','71','','','','879862','Building','Commercial','571,910.00','32','183,011.20','','','Taxable','2000','','2003-05-22','','2003-05-22','','2003-05-22','','','','concrete','concrete','','wood','G.I. Sheets','CHB with cement plaster','Plain Cement','Wood','Plywood','Type','Residential / Commercial','','','','2','Glass Jalousie','Wood','','Concrete','Conduit','CHB with tiles','PVC','','2003-05-22','2003-05-22','2003-05-22','225.56','451.12','','307952','307,952.00','571,910.00');
INSERT INTO ImprovementsBuildings VALUES (150,0,'1','1','92','','','','','','sdfsdf','','','','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','1','','','','','','','','','','','ASD','','','','','','','','','','','','','2003-06-04','2003-06-04','2003-06-04','','','','','','');
INSERT INTO ImprovementsBuildings VALUES (151,0,'2','2','93','','','','','','dfdfdfddfd','','','','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','2','','','','','','','','','','','dfdfdfdfd','','','','','','','','','','','','','2003-06-04','2003-06-04','2003-06-04','','','','','','');
INSERT INTO ImprovementsBuildings VALUES (152,83,'','','','','','','777','777','','','','','','','','','','','','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','777','','','','','');
INSERT INTO ImprovementsBuildings VALUES (153,84,'','','','','','','888','888','','','','','','','','','','','','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','888','','','','','');
INSERT INTO ImprovementsBuildings VALUES (154,97,'','','','','','','1234','1234','','','','','','','','','','','','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','1234','','','','','');
INSERT INTO ImprovementsBuildings VALUES (155,90,'333333','33','113','','','','','','dfdfdfddfd','','','','','','','','','2003-06-13','','2003-06-13','','2003-06-13','','','333333','','','','','','','','','','','dfdfdfdfd','','','','','','','','','','','','','2003-06-13','2003-06-13','2003-06-13','','','','','','');
INSERT INTO ImprovementsBuildings VALUES (156,99,'','','','','','','testMarketValue','testImprovementsBuildings','','','','','','','','','','','','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','testGroundFloor','','','','','');
INSERT INTO ImprovementsBuildings VALUES (157,104,'ertert','ertertertert','121','','','','2000','879','dfdfdfddfd','1,800.00','50','900.00','','','','79','','2003-06-13','','2003-06-13','','2003-06-13','fwergegergerg','','ertertert','tetetertet','iu','hih','ih','iuh','uih','iuhi','uhi','hi','gig','dfdfdfdfd','ug','ih','lgl','fgjyi','gjkg','jk','kh','khk','hk','hkg','hjfg','jf','2003-02-13','2003-07-13','2003-06-13','hklh','kjh','53ggfdbgfdgffgdfg','200','200.00','1,800.00');

--
-- Table structure for table 'ImprovementsBuildingsActualUses'
--

CREATE TABLE ImprovementsBuildingsActualUses (
  improvementsBuildingsActualUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (improvementsBuildingsActualUsesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'ImprovementsBuildingsActualUses'
--


INSERT INTO ImprovementsBuildingsActualUses VALUES (1,'dfdfdfddfd','dfdf',34,'active');
INSERT INTO ImprovementsBuildingsActualUses VALUES (2,'sdfsdf','sdfsdf',3,'inactive');

--
-- Table structure for table 'ImprovementsBuildingsClasses'
--

CREATE TABLE ImprovementsBuildingsClasses (
  improvementsBuildingsClassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (improvementsBuildingsClassesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'ImprovementsBuildingsClasses'
--


INSERT INTO ImprovementsBuildingsClasses VALUES (1,'dfdfdfdfd','dfdfdfdsdfsdfsdf',45467,'active');
INSERT INTO ImprovementsBuildingsClasses VALUES (2,'asfasf','asdfasdf',5,'active');
INSERT INTO ImprovementsBuildingsClasses VALUES (3,'xxfdxf','dfdfd',4,'inactive');
INSERT INTO ImprovementsBuildingsClasses VALUES (4,'ASD','SS',9,'inactive');

--
-- Table structure for table 'LUT'
--

CREATE TABLE LUT (
  forYear int(11) NOT NULL default '0',
  monthCount int(11) NOT NULL default '0',
  rate double(14,2) NOT NULL default '0.00',
  PRIMARY KEY  (forYear,monthCount),
  KEY byYear (forYear)
) TYPE=InnoDB;

--
-- Dumping data for table 'LUT'
--



--
-- Table structure for table 'Land'
--

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
  PRIMARY KEY  (propertyID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Land'
--


INSERT INTO Land VALUES (1,0,'9664','3370','','3','3','5','1200100','Residential','sit','1223100','4','3220010','3223000','3223000','54','37','5','2003-05-7','4','2002-09-15','2','2002-07-14','sollicitudin\r\n et\r\n euismod\r\n quis\r\n vestibulum\r\n ac\r\n est\r\n Pellentesque\r\n quis\r\n pede\r\n et','2003-05-5','1411','6529','3841.29','2953.65','5731.45','5768.17','justo\r\n dignissim','justo\r\n Phasellus','378.58',NULL,'313010',0,'in\r\n iaculis','15','12110');
INSERT INTO Land VALUES (2,2,'1317','8687','','4','2','4','3130011','Industrial','ipsum','1123101','2','2232100','3201001','3201001','73','59','3','2002-08-26','5','2003-02-5','3','2003-03-31','quis\r\n vestibulum\r\n ac\r\n est\r\n Pellentesque\r\n quis\r\n pede\r\n et\r\n erat\r\n sodales\r\n elementum','2003-03-17','1466','4454','3287.54','6431.73','6435.81','4149.78','Praesent\r\n quis','Ut\r\n non','978.21',NULL,'211111',0,'Morbi\r\n mi','3','31101');
INSERT INTO Land VALUES (3,2,'0444','4941','','1','5','4','1221100','Commercial','massa','1312010','7','2022100','1013110','1013110','49','94','2','2003-04-12','1','2002-10-10','4','2002-06-4','sollicitudin\r\n consectetuer\r\n mauris\r\n Ut\r\n elementum\r\n dignissim\r\n mi\r\n Morbi\r\n mi\r\n lorem\r\n viverra','2003-03-30','1681','6837','9868.55','7216.89','6581.41','7869.94','platea\r\n dictumst','feugiat\r\n arcu','283.41',NULL,'311110',0,'vel\r\n pulvinar','20','31011');
INSERT INTO Land VALUES (4,3,'1696','6918','','4','5','4','1030001','Commercial','ac','1230101','6','2203000','3122010','3122010','48','61','4','2003-01-28','1','2003-04-9','4','2003-01-17','ut\r\n nonummy\r\n at\r\n ipsum\r\n Pellentesque\r\n habitant\r\n morbi\r\n tristique\r\n senectus\r\n et\r\n netus','2003-04-23','1586','8238','9735.32','2147.11','2648.79','5659.59','luctus\r\n et','viverra\r\n In','613.30',NULL,'332101',0,'sodales\r\n elementum','85','23011');
INSERT INTO Land VALUES (5,3,'6074','0239','','5','1','5','3121001','Commercial','euismod','1123101','1','2232000','1313100','1313100','78','99','2','2002-11-29','5','2003-02-5','1','2002-11-7','pede\r\n Proin\r\n sollicitudin\r\n consectetuer\r\n mauris\r\n Ut\r\n elementum\r\n dignissim\r\n mi\r\n Morbi\r\n mi','2003-01-25','2732','7497','6983.93','9459.26','4347.58','1555.53','malesuada\r\n urna','Etiam\r\n viverra','822.20',NULL,'111011',0,'rhoncus\r\n tincidunt','43','11100');
INSERT INTO Land VALUES (6,4,'1950','2930','','1','4','4','3020001','Commercial','natoque','1032110','3','3032100','3033101','3033101','20','55','5','2002-10-30','3','2002-06-17','1','2003-01-31','augue\r\n non\r\n erat\r\n nonummy\r\n sodales\r\n Etiam\r\n lectus\r\n urna\r\n faucibus\r\n ac\r\n pretium','2002-09-3','2842','1941','8957.51','7214.93','6855.81','4263.26','sollicitudin\r\n et','elit\r\n Nunc','820.75',NULL,'133011',0,'auctor\r\n vel','76','33001');
INSERT INTO Land VALUES (7,4,'5754','9059','','1','3','4','3212111','Industrial','Fusce','1130010','6','1023101','2232100','2232100','24','13','1','2002-06-28','2','2002-09-25','2','2002-06-18','ac\r\n dolor\r\n quis\r\n quam\r\n porta\r\n sodales\r\n Fusce\r\n aliquam\r\n Morbi\r\n rhoncus\r\n arcu','2002-10-29','6472','2348','4469.16','6739.27','2667.84','9721.94','felis\r\n lorem','dictum\r\n sapien','214.78',NULL,'222001',0,'at\r\n lorem','65','12001');
INSERT INTO Land VALUES (8,4,'4396','5140','','2','4','1','2322101','Residential','ligula','3120100','4','3123101','1112100','1112100','26','39','2','2003-02-9','3','2002-11-30','4','2002-12-1','elit\r\n Pellentesque\r\n sed\r\n purus\r\n eu\r\n quam\r\n scelerisque\r\n pulvinar\r\n Nulla\r\n vitae\r\n nisl','2003-02-6','4764','3545','9661.58','1194.93','5973.98','8672.89','in\r\n iaculis','Suspendisse\r\n tempus','335.00',NULL,'233101',0,'molestie\r\n In','13','31000');
INSERT INTO Land VALUES (9,4,'1765','8155','','5','1','2','3223100','Commercial','Curabitur','2132111','3','3202110','2211100','2211100','93','76','5','2002-07-1','2','2003-05-4','1','2003-04-7','nulla\r\n consequat\r\n quis\r\n pulvinar\r\n in\r\n volutpat\r\n ac\r\n sapien\r\n Morbi\r\n feugiat\r\n arcu','2002-12-21','7352','2859','7257.66','4147.27','3922.32','4251.56','vulputate\r\n nisl','dolor\r\n sit','116.54',NULL,'311011',0,'Etiam\r\n massa','59','33111');
INSERT INTO Land VALUES (10,4,'5733','5674','','2','4','3','3132100','Industrial','non','3013001','2','1101000','3321111','3321111','76','93','4','2002-10-26','5','2002-12-19','1','2002-09-20','dictumst\r\n Ut\r\n euismod\r\n enim\r\n vel\r\n turpis\r\n Vestibulum\r\n ante\r\n ipsum\r\n primis\r\n in','2003-01-19','7265','9116','1717.74','7287.51','3233.55','6631.93','metus\r\n In','Nulla\r\n quis','277.76',NULL,'312001',0,'vel\r\n semper','30','23100');
INSERT INTO Land VALUES (11,5,'1773','6690','','5','2','1','2220111','Residential','in','3311101','3','1000111','1211001','1211001','46','35','2','2002-10-8','3','2003-04-19','2','2002-09-28','pharetra\r\n nec\r\n sem\r\n Aliquam\r\n molestie\r\n turpis\r\n ut\r\n neque\r\n Duis\r\n id\r\n urna','2003-04-21','8547','2668','7756.24','4515.13','6727.15','8274.97','orci\r\n luctus','non\r\n lorem','244.06',NULL,'332011',0,'at\r\n lorem','59','33001');
INSERT INTO Land VALUES (12,5,'3024','4005','','2','1','1','2201000','Commercial','molestie','2122111','3','3303110','1223011','1223011','6','73','1','2002-11-6','5','2003-02-27','5','2002-09-28','lorem\r\n et\r\n lectus\r\n consectetuer\r\n commodo\r\n Etiam\r\n odio\r\n neque\r\n consequat\r\n non\r\n vulputate','2003-05-10','2836','7827','9819.67','5979.15','2299.76','1279.16','dis\r\n parturient','Pellentesque\r\n quis','920.02',NULL,'133010',0,'consectetuer\r\n commodo','65','33010');
INSERT INTO Land VALUES (13,5,'6998','0657','','1','5','2','1323110','Commercial','turpis','3312110','5','1310011','2222101','2222101','95','15','2','2002-08-20','1','2002-06-17','1','2002-05-29','neque\r\n Nam\r\n justo\r\n nulla\r\n consequat\r\n quis\r\n pulvinar\r\n in\r\n volutpat\r\n ac\r\n sapien','2002-12-18','6986','6284','7955.98','8152.15','3348.25','2541.31','elit\r\n Cras','Ut\r\n posuere','229.58',NULL,'313110',0,'purus\r\n et','43','21000');
INSERT INTO Land VALUES (14,6,'0423','2277','','1','4','5','2331001','Commercial','molestie','2000101','4','3333011','3030111','3030111','33','8','4','2002-06-23','2','2002-09-23','5','2002-07-6','est\r\n eget\r\n velit\r\n porta\r\n porta\r\n Maecenas\r\n odio\r\n pede\r\n auctor\r\n vel\r\n semper','2002-11-24','7269','8547','8972.95','3917.11','8793.34','8511.93','sollicitudin\r\n vel','euismod\r\n enim','785.76',NULL,'322101',0,'rutrum\r\n massa','12','13111');
INSERT INTO Land VALUES (15,6,'8262','7649','','1','2','4','2331101','Residential','et','3211101','4','1213001','1023101','1023101','40','19','5','2002-12-27','3','2003-03-3','2','2002-07-10','vel\r\n turpis\r\n consectetuer\r\n tristique\r\n Quisque\r\n interdum\r\n tempus\r\n erat\r\n Vivamus\r\n convallis\r\n velit','2002-09-6','7857','9691','4838.88','1899.78','3222.72','1199.86','wisi\r\n sit','wisi\r\n augue','37.86',NULL,'313111',0,'vitae\r\n nulla','67','21011');
INSERT INTO Land VALUES (16,7,'7291','1157','','2','3','4','1023101','Commercial','sit','2233001','3','3021001','3322001','3322001','75','10','3','2003-02-8','1','2002-09-18','5','2002-07-31','sit\r\n amet\r\n consectetuer\r\n adipiscing\r\n elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n quam\r\n porta','2003-05-1','3794','6218','4261.81','1242.98','7397.64','5711.57','ipsum\r\n In','et\r\n risus','904.68',NULL,'213000',0,'non\r\n vulputate','23','12110');
INSERT INTO Land VALUES (17,7,'9954','8044','','1','3','3','1322110','Industrial','quis','1303100','1','1002110','1310000','1310000','85','62','5','2002-08-22','3','2003-03-19','2','2002-09-19','et\r\n magnis\r\n dis\r\n parturient\r\n montes\r\n nascetur\r\n ridiculus\r\n mus\r\n In\r\n malesuada\r\n leo','2002-08-22','9153','3647','5546.74','9813.66','9976.79','9113.39','interdum\r\n elit','Ut sem\r\n pede','795.94',NULL,'132011',0,'scelerisque\r\n enim','14','33010');
INSERT INTO Land VALUES (18,7,'1079','7205','','3','1','1','3321110','Industrial','felis','1113011','2','3001011','2022111','2022111','51','98','4','2002-06-28','4','2002-11-25','4','2002-06-7','aliquam\r\n Morbi\r\n rhoncus\r\n arcu\r\n sed\r\n diam\r\n Nam\r\n semper\r\n lacinia\r\n lorem\r\n Pellentesque','2003-02-9','5115','7363','5627.55','8746.67','6396.79','3229.88','Nam\r\n est','eget\r\n vulputate','436.89',NULL,'131101',0,'magnis\r\n dis','61','23101');
INSERT INTO Land VALUES (19,7,'3276','6486','','5','1','2','2320010','Residential','tellus','2113110','1','3131111','2303000','2303000','13','75','5','2002-07-9','2','2002-12-3','5','2002-10-1','Morbi\r\n feugiat\r\n arcu\r\n sed\r\n pulvinar\r\n ullamcorper\r\n nibh\r\n nunc\r\n consectetuer\r\n leo\r\n sit','2002-11-20','6187','8389','3152.98','3168.13','9424.22','2264.11','nascetur\r\n ridiculus','eget\r\n pellentesque','874.08',NULL,'312011',0,'cursus\r\n dictum','74','21000');
INSERT INTO Land VALUES (20,8,'1117','2682','','5','4','2','2122011','Commercial','pede','3311110','2','3313000','2101011','2101011','60','53','5','2003-01-25','3','2002-12-29','3','2002-06-30','Cras\r\n vitae\r\n lacus\r\n id\r\n eros\r\n condimentum\r\n malesuada\r\n Mauris\r\n at\r\n sapien\r\n vehicula','2002-06-16','9946','2731','6761.29','4688.62','2294.83','9949.79','sed\r\n nunc','tellus\r\n at','676.02',NULL,'112110',0,'nec\r\n pede','96','32111');
INSERT INTO Land VALUES (21,8,'2185','8765','','2','5','2','3121111','Industrial','pede','2112011','2','2003111','3030000','3030000','65','77','2','2002-12-1','2','2003-04-13','4','2002-06-22','et\r\n malesuada\r\n fames\r\n ac\r\n turpis\r\n egestas\r\n Nunc\r\n non\r\n risus\r\n nec\r\n enim','2002-08-23','4314','8311','3176.11','2785.81','8558.93','6684.29','dapibus\r\n in','enim\r\n Ut','768.52',NULL,'322111',0,'erat\r\n Suspendisse','14','23100');
INSERT INTO Land VALUES (22,9,'6579','4117','','2','4','1','3331110','Residential','cubilia','3222010','4','1000101','3221101','3221101','89','19','3','2002-09-2','4','2003-03-23','1','2002-11-24','sed\r\n pulvinar\r\n ullamcorper\r\n nibh\r\n nunc\r\n consectetuer\r\n leo\r\n sit\r\n amet\r\n dapibus\r\n ipsum','2003-01-3','2684','2493','3634.93','5923.57','7936.57','3631.45','risus\r\n mattis','ullamcorper\r\n nibh','476.14',NULL,'333110',0,'urna\r\n faucibus','98','11101');
INSERT INTO Land VALUES (23,9,'1264','1791','','1','2','3','1330101','Residential','Cras','1331111','4','3232000','1311011','1311011','92','30','1','2003-01-8','5','2003-04-6','5','2002-12-21','est\r\n nulla\r\n sollicitudin\r\n vel\r\n blandit\r\n ut\r\n nonummy\r\n at\r\n ipsum\r\n Pellentesque\r\n habitant','2003-02-27','1189','5624','2822.78','8996.97','9369.39','4217.12','lorem\r\n et','pulvinar\r\n ullamcorper','463.08',NULL,'221110',0,'Quisque\r\n tristique','5','13110');
INSERT INTO Land VALUES (24,9,'5563','6985','','4','5','2','2031000','Commercial','lorem','2322111','3','1012101','3012000','3012000','18','1','2','2002-10-18','5','2003-04-25','1','2002-10-23','at\r\n ipsum\r\n Pellentesque\r\n habitant\r\n morbi\r\n tristique\r\n senectus\r\n et\r\n netus\r\n et\r\n malesuada','2002-08-22','4929','2479','4362.29','8347.76','7986.19','8923.65','Nullam\r\n fermentum','dictumst\r\n Quisque','114.76',NULL,'232011',0,'orci\r\n luctus','20','12110');
INSERT INTO Land VALUES (25,10,'2720','4974','','2','5','5','2231101','Commercial','ac','3310010','7','3013101','3201101','3201101','97','99','2','2002-12-11','2','2002-12-12','4','2003-02-9','justo\r\n ut\r\n lectus\r\n Cras\r\n volutpat\r\n varius\r\n massa\r\n Donec\r\n fringilla\r\n Donec\r\n vitae','2003-02-24','7786','2687','5597.26','2968.59','1628.48','3666.23','montes\r\n nascetur','turpis\r\n egestas','284.67',NULL,'121101',0,'dictum\r\n sapien','50','21100');
INSERT INTO Land VALUES (26,10,'0731','8852','','3','4','2','2000101','Industrial','justo','1321010','7','2022011','1222110','1222110','86','49','1','2003-05-4','1','2002-12-22','1','2003-03-15','aliquet\r\n luctus\r\n justo\r\n Donec\r\n tristique\r\n metus\r\n elementum\r\n nibh\r\n Etiam\r\n massa\r\n metus','2002-06-27','8734','8458','6552.74','6742.36','1943.41','5331.22','volutpat\r\n ac','est\r\n eget','372.51',NULL,'322010',0,'In\r\n risus','3','21010');
INSERT INTO Land VALUES (27,10,'8124','8974','','5','2','5','3130110','Industrial','tincidunt','2312100','3','2003001','3300101','3300101','57','88','4','2002-09-10','3','2002-06-16','3','2002-11-7','wisi\r\n augue\r\n id\r\n orci\r\n Ut\r\n non\r\n lorem\r\n et\r\n lectus\r\n consectetuer\r\n commodo','2002-10-28','6994','6959','2311.13','4259.81','5655.52','6315.86','Nam\r\n et','In\r\n hac','615.25',NULL,'323100',0,'posuere\r\n interdum','78','32111');
INSERT INTO Land VALUES (28,11,'8071','7717','','3','4','4','3302000','Industrial','est','2312111','4','1021010','2332100','2332100','48','4','2','2002-05-18','1','2003-01-16','2','2002-08-27','et\r\n ortor\r\n Sed\r\n eget\r\n elit\r\n Mauris\r\n dictum\r\n ipsum\r\n sed\r\n tempus\r\n posuere','2002-12-28','5185','7879','5912.67','8358.69','7768.21','4334.31','et\r\n varius','Etiam\r\n sit','328.29',NULL,'133100',0,'lacus\r\n id','31','11110');
INSERT INTO Land VALUES (29,12,'8978','5047','','4','5','5','3131010','Industrial','Lorem','3011001','7','2203100','2100000','2100000','93','6','5','2002-12-4','1','2003-04-19','1','2002-11-18','viverra\r\n Pellentesque\r\n egestas\r\n diam\r\n Fusce\r\n ante\r\n pede\r\n tempor\r\n nec\r\n auctor\r\n eget','2002-07-14','1818','9779','9433.18','6275.71','4477.79','4618.88','urna\r\n erat','ullamcorper\r\n nibh','542.73',NULL,'211101',0,'arcu\r\n sed','35','32111');
INSERT INTO Land VALUES (30,12,'9316','8693','','4','5','2','1130101','Industrial','feugiat','1232011','3','1011111','3002110','3002110','81','55','3','2002-09-23','5','2002-08-21','1','2002-11-12','consectetuer\r\n tellus\r\n at\r\n volutpat\r\n velit\r\n leo\r\n at\r\n lorem\r\n Nam\r\n pretium\r\n magna','2002-07-26','5961','5698','7558.45','2391.55','4123.81','3238.82','et\r\n mi','platea\r\n dictumst','333.37',NULL,'331001',0,'eget\r\n elit','44','33000');
INSERT INTO Land VALUES (31,13,'6695','2800','','4','3','1','2230100','Commercial','adipiscing','1312001','5','1100010','1333001','1333001','3','16','4','2003-03-26','5','2002-10-16','5','2003-03-11','netus\r\n et\r\n malesuada\r\n fames\r\n ac\r\n turpis\r\n egestas\r\n Praesent\r\n quis\r\n enim\r\n Etiam','2002-07-31','2926','6842','4625.69','1218.72','6646.45','7555.72','pede\r\n commodo','quis\r\n sem','806.71',NULL,'311100',0,'ante\r\n ligula','100','31101');
INSERT INTO Land VALUES (32,13,'3774','5948','','5','5','3','2130001','Industrial','Sed','1211100','7','3221000','3103010','3103010','46','9','2','2002-08-26','5','2003-03-22','4','2002-10-25','Praesent\r\n quis\r\n enim\r\n Etiam\r\n non\r\n metus\r\n nec\r\n neque\r\n luctus\r\n congue\r\n Nullam','2003-03-24','8954','6495','2854.28','1748.85','9511.15','5519.55','convallis\r\n ac','cursus\r\n dictum','215.37',NULL,'311110',0,'dis\r\n parturient','84','21111');
INSERT INTO Land VALUES (33,14,'9171','7966','','5','3','2','3223111','Residential','posuere','1122101','3','1313111','1021010','1021010','49','90','1','2002-09-24','3','2002-12-3','3','2002-10-20','metus\r\n velit\r\n ac\r\n nulla\r\n Sed\r\n vitae\r\n erat\r\n sit\r\n amet\r\n est\r\n fringilla','2002-08-2','4967','5695','4979.45','7334.21','6247.31','6141.37','turpis\r\n egestas','montes\r\n nascetur','726.69',NULL,'213000',0,'tempus\r\n erat','60','12110');
INSERT INTO Land VALUES (34,14,'3401','0049','','2','2','2','3002000','Residential','ut','2102111','2','1033011','1331100','1331100','55','15','5','2002-11-27','5','2002-10-28','3','2002-10-25','tempus\r\n posuere\r\n felis\r\n mi\r\n eleifend\r\n quam\r\n vel\r\n rhoncus\r\n wisi\r\n augue\r\n id','2002-09-22','6969','1757','8622.21','3219.39','2348.63','5495.97','vulputate\r\n Nullam','amet\r\n augue','710.40',NULL,'133000',0,'quis\r\n pede','52','12110');
INSERT INTO Land VALUES (35,15,'4344','6717','','4','2','4','2033011','Residential','vulputate','3211100','2','2022101','1311111','1311111','75','62','4','2002-12-28','3','2002-11-24','5','2002-12-20','leo\r\n rhoncus\r\n molestie\r\n In\r\n et\r\n risus\r\n nec\r\n arcu\r\n adipiscing\r\n tincidunt\r\n Donec','2003-03-28','5281','2644','1372.59','6538.25','5896.25','5145.74','wisi\r\n augue','risus\r\n nec','221.37',NULL,'132001',0,'dolor\r\n sit','24','33001');
INSERT INTO Land VALUES (36,15,'6770','8062','','2','4','4','1112010','Residential','et','1010001','2','1131001','2323100','2323100','43','72','1','2002-11-14','4','2002-11-19','1','2002-12-17','cursus\r\n justo\r\n in\r\n urna\r\n Nullam\r\n molestie\r\n neque\r\n non\r\n nibh\r\n Nam\r\n et','2003-02-7','5521','5416','4997.28','8628.13','3476.82','5676.65','porttitor\r\n pulvinar','ipsum\r\n Aliquam','630.42',NULL,'232100',0,'metus\r\n convallis','40','21000');
INSERT INTO Land VALUES (37,15,'4780','4056','','3','4','4','1211100','Industrial','sed','2201100','2','1312011','3332000','3332000','62','5','1','2002-05-18','4','2002-07-30','2','2002-11-1','dui\r\n Phasellus\r\n cursus\r\n justo\r\n in\r\n urna\r\n Nullam\r\n molestie\r\n neque\r\n non\r\n nibh','2002-08-19','2848','6745','1993.37','9798.45','6578.98','6484.79','sed\r\n dolor','justo\r\n in','339.70',NULL,'121111',0,'nec\r\n magna','89','32101');
INSERT INTO Land VALUES (38,15,'5443','6868','','1','2','1','3003111','Commercial','sit','3021111','4','3330001','1330101','1330101','62','60','2','2002-10-3','1','2002-06-23','5','2002-05-12','velit\r\n posuere\r\n euismod\r\n Sed\r\n et\r\n velit\r\n In\r\n lobortis\r\n magna\r\n sed\r\n dolor','2003-01-26','8646','2773','9284.35','8523.81','7267.69','7981.71','ac\r\n sapien','Nam\r\n ac','116.36',NULL,'211100',0,'laoreet\r\n eget','97','23011');
INSERT INTO Land VALUES (39,15,'8323','4254','','1','5','2','1231001','Residential','elit','3120101','5','2010100','3100010','3100010','13','12','5','2003-02-17','2','2002-08-13','1','2003-03-19','lacinia\r\n lorem\r\n Pellentesque\r\n posuere\r\n interdum\r\n elit\r\n Duis\r\n lacus\r\n Duis\r\n sit\r\n amet','2002-10-12','6638','3369','1776.29','5389.89','2868.86','2498.57','habitasse\r\n platea','ligula\r\n vel','651.71',NULL,'111001',0,'Nam\r\n et','97','21000');
INSERT INTO Land VALUES (40,16,'4815','8668','','4','4','1','1312000','Commercial','amet','1110011','7','1322010','3310111','3310111','6','41','4','2003-02-19','4','2002-10-13','1','2002-07-30','penatibus\r\n et\r\n magnis\r\n dis\r\n parturient\r\n montes\r\n nascetur\r\n ridiculus\r\n mus\r\n Pellentesque\r\n eget','2002-06-15','3876','6734','4174.79','1199.86','8923.45','5959.56','consectetuer\r\n mauris','ut\r\n neque','449.27',NULL,'233110',0,'enim\r\n Curabitur','42','33110');
INSERT INTO Land VALUES (41,16,'5479','3337','','3','1','2','3100011','Commercial','nulla','3203101','7','1233011','1101000','1101000','71','66','4','2002-09-7','3','2003-03-18','3','2003-03-6','aliquet\r\n luctus\r\n justo\r\n Donec\r\n tristique\r\n metus\r\n elementum\r\n nibh\r\n Etiam\r\n massa\r\n metus','2002-10-8','4898','7174','7414.96','2965.89','1596.62','3462.47','ipsum\r\n in','vestibulum\r\n Ut','912.30',NULL,'222110',0,'metus\r\n convallis','60','32000');
INSERT INTO Land VALUES (42,17,'0617','9279','','3','4','3','1031000','Residential','semper','3303010','5','3320000','3000111','3000111','96','77','3','2002-10-22','2','2003-04-26','5','2003-03-6','morbi\r\n tristique\r\n senectus\r\n et\r\n netus\r\n et\r\n malesuada\r\n fames\r\n ac\r\n turpis\r\n egestas','2003-01-30','9714','1929','4963.72','6367.61','1865.45','5795.94','viverra\r\n id','lectus\r\n consectetuer','363.89',NULL,'123100',0,'porta\r\n sodales','35','13110');
INSERT INTO Land VALUES (43,17,'5179','5874','','5','5','3','1130110','Residential','quis','2010010','1','1310110','1021001','1021001','59','82','4','2002-06-17','2','2003-04-13','3','2002-08-18','pulvinar\r\n mi\r\n Phasellus\r\n est\r\n Vestibulum\r\n sed\r\n ligula\r\n in\r\n sapien\r\n ullamcorper\r\n viverra','2002-09-12','8919','9533','5672.45','2834.65','6919.45','6116.98','amet\r\n nisl','Nam\r\n ac','90.93',NULL,'123000',0,'posuere\r\n Aliquam','8','31101');
INSERT INTO Land VALUES (44,17,'9966','9464','','5','5','4','1302100','Industrial','a','2330100','4','1312000','2223100','2223100','9','96','3','2003-04-19','1','2003-03-6','5','2003-01-25','tempor\r\n Cum\r\n sociis\r\n natoque\r\n penatibus\r\n et\r\n magnis\r\n dis\r\n parturient\r\n montes\r\n nascetur','2002-12-13','3427','3662','3751.51','8235.98','6181.27','4392.93','malesuada\r\n Mauris','quis\r\n pede','282.81',NULL,'122010',0,'et\r\n varius','32','11100');
INSERT INTO Land VALUES (45,17,'8157','7807','','4','4','4','1330110','Residential','pulvinar','2122010','6','1323010','2233011','2233011','41','19','5','2003-03-16','2','2002-08-18','4','2003-01-3','Nunc\r\n non\r\n risus\r\n nec\r\n enim\r\n ultrices\r\n malesuada\r\n Proin\r\n faucibus\r\n eros\r\n in','2002-08-25','1119','9829','4118.34','9267.68','9569.65','5421.81','vitae\r\n erat','ac\r\n scelerisque','908.74',NULL,'313000',0,'consectetuer\r\n adipiscing','36','11101');
INSERT INTO Land VALUES (46,18,'2889','2049','','4','1','2','2003100','Commercial','eget','2320001','2','3021101','2202001','2202001','57','71','1','2002-12-28','2','2002-09-2','5','2002-11-10','semper\r\n id\r\n turpis\r\n Aliquam\r\n nulla\r\n erat\r\n lacinia\r\n quis\r\n tincidunt\r\n in\r\n iaculis','2002-09-29','1823','8952','5837.34','5665.92','8359.74','2925.84','dolor\r\n sit','posuere\r\n vitae','510.07',NULL,'232001',0,'posuere\r\n euismod','89','11010');
INSERT INTO Land VALUES (47,18,'1650','6120','','1','1','5','2030011','Commercial','ante','3112110','4','2333000','1011111','1011111','37','12','1','2003-03-27','3','2002-09-14','1','2002-11-13','felis\r\n aliquam\r\n ac\r\n aliquet\r\n ac\r\n sagittis\r\n sit\r\n amet\r\n orci\r\n Etiam\r\n viverra','2002-10-23','3232','1878','8372.42','5591.64','1957.57','5955.78','quis\r\n ligula','nunc\r\n cursus','432.07',NULL,'131011',0,'Phasellus\r\n est','15','32111');
INSERT INTO Land VALUES (48,18,'7693','8864','','3','4','5','3130101','Commercial','tincidunt','1200001','6','1102110','1031111','1031111','38','41','4','2002-09-2','4','2002-10-5','1','2003-04-30','pede\r\n Proin\r\n sollicitudin\r\n consectetuer\r\n mauris\r\n Ut\r\n elementum\r\n dignissim\r\n mi\r\n Morbi\r\n mi','2003-05-7','7218','6846','8125.54','1636.79','4469.51','5826.98','quis\r\n sem','justo\r\n dignissim','200.61',NULL,'322111',0,'Ut sem\r\n pede','65','21101');
INSERT INTO Land VALUES (49,19,'7374','0166','','1','3','1','2122110','Residential','id','3001010','5','2333101','1200011','1200011','95','98','4','2002-12-15','1','2002-06-3','2','2002-05-21','dolor\r\n sit\r\n amet\r\n consectetuer\r\n adipiscing\r\n elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n quam','2002-08-24','5495','7152','6237.15','4823.47','4457.85','9731.57','Proin\r\n faucibus','interdum\r\n tempus','918.41',NULL,'332011',0,'pellentesque\r\n et','53','12110');
INSERT INTO Land VALUES (50,20,'8424','4421','','5','1','1','3022011','Commercial','tristique','1022101','6','3133000','3330001','3330001','40','55','2','2003-01-15','3','2003-02-11','1','2002-09-13','odio\r\n neque\r\n consequat\r\n non\r\n vulputate\r\n eu\r\n interdum\r\n ac\r\n felis\r\n In\r\n fermentum','2003-04-4','7858','7479','2517.96','4123.77','2932.11','1141.11','nascetur\r\n ridiculus','dictumst\r\n Cum','934.51',NULL,'332111',0,'penatibus\r\n et','92','21010');
INSERT INTO Land VALUES (51,20,'4591','0896','','1','4','3','1112111','Industrial','Ut','1000110','1','2133100','3221011','3221011','12','94','1','2002-10-10','4','2003-04-16','2','2002-11-4','erat\r\n sodales\r\n elementum\r\n Integer\r\n metus\r\n In\r\n commodo\r\n Nulla\r\n tempor\r\n justo\r\n et','2002-07-28','5951','2849','2815.95','3594.98','8564.78','7815.43','consequat\r\n quis','Pellentesque\r\n quis','975.53',NULL,'333100',0,'amet\r\n consectetuer','46','23000');
INSERT INTO Land VALUES (52,21,'1441','6266','','3','2','1','1110100','Commercial','platea','3013011','6','1211110','1320100','1320100','66','29','5','2002-06-15','4','2002-07-12','4','2002-09-20','sociis\r\n natoque\r\n penatibus\r\n et\r\n magnis\r\n dis\r\n parturient\r\n montes\r\n nascetur\r\n ridiculus\r\n mus','2002-11-3','4778','3995','2197.89','7832.13','2583.29','2174.17','at\r\n ipsum','hac\r\n habitasse','908.65',NULL,'111001',0,'mi\r\n lorem','47','12110');
INSERT INTO Land VALUES (53,21,'1794','0817','','2','2','1','3012100','Residential','vel','1231101','3','3320001','1123110','1123110','57','76','4','2002-11-13','3','2002-07-20','4','2003-04-27','placerat\r\n vel\r\n pharetra\r\n nec\r\n sem\r\n Aliquam\r\n molestie\r\n turpis\r\n ut\r\n neque\r\n Duis','2002-10-24','9174','3863','4777.19','2747.62','7354.83','4647.68','Quisque\r\n interdum','quis\r\n pulvinar','659.21',NULL,'212011',0,'justo\r\n Donec','12','11101');
INSERT INTO Land VALUES (54,21,'1159','2542','','2','2','5','3111000','Industrial','scelerisque','1323000','4','3333000','2321011','2321011','94','61','2','2002-06-30','4','2002-11-25','3','2002-12-7','Cum\r\n sociis\r\n natoque\r\n penatibus\r\n et\r\n magnis\r\n dis\r\n parturient\r\n montes\r\n nascetur\r\n ridiculus','2002-07-24','4731','3568','1142.77','5577.36','3564.79','4131.15','lorem\r\n viverra','platea\r\n dictumst','955.69',NULL,'321110',0,'ac\r\n sapien','94','33001');
INSERT INTO Land VALUES (55,21,'5304','6597','','5','5','3','1121001','Residential','In','3213111','1','2311011','1101000','1101000','50','39','4','2003-02-6','5','2003-02-5','3','2002-07-9','quis\r\n quam\r\n porta\r\n sodales\r\n Fusce\r\n aliquam\r\n Morbi\r\n rhoncus\r\n arcu\r\n sed\r\n diam','2002-12-10','6363','8235','6481.71','2568.67','5221.37','9942.76','penatibus\r\n et','varius\r\n nunc','484.96',NULL,'322100',0,'nulla\r\n consequat','70','11101');
INSERT INTO Land VALUES (56,22,'6789','5819','','2','2','1','1322011','Residential','consequat','2223110','6','1133101','3101010','3101010','55','4','5','2003-02-8','2','2002-08-3','4','2003-04-4','tellus\r\n eu\r\n velit\r\n posuere\r\n euismod\r\n Sed\r\n et\r\n velit\r\n In\r\n lobortis\r\n magna','2003-03-24','3945','1966','1123.74','3669.62','1143.25','2678.21','pulvinar\r\n mi','urna\r\n erat','546.75',NULL,'312010',0,'vitae\r\n nisl','61','23011');
INSERT INTO Land VALUES (57,22,'7750','3814','','3','1','4','1211000','Industrial','netus','3331000','4','2020100','2303110','2303110','54','28','3','2002-11-15','3','2003-05-1','2','2002-10-30','imperdiet\r\n neque\r\n in\r\n justo\r\n Nam\r\n vel\r\n nunc\r\n eu\r\n leo\r\n rhoncus\r\n molestie','2002-08-30','8295','7476','7919.28','9556.61','7674.51','8591.99','turpis\r\n non','tempus\r\n erat','598.97',NULL,'123001',0,'massa\r\n velit','91','12010');
INSERT INTO Land VALUES (58,22,'6268','6143','','3','2','5','3322110','Residential','nec','1232000','2','2200011','1231101','1231101','93','78','1','2003-03-1','4','2003-01-31','1','2002-07-31','vestibulum\r\n ac\r\n est\r\n Pellentesque\r\n quis\r\n pede\r\n et\r\n erat\r\n sodales\r\n elementum\r\n Integer','2002-12-7','6725','5332','1867.19','5348.52','5664.41','9169.44','id\r\n augue','Nam\r\n quam','915.33',NULL,'133000',0,'orci\r\n posuere','41','21111');
INSERT INTO Land VALUES (59,23,'2490','7072','','3','2','3','2132010','Commercial','non','1302110','5','2011000','2200110','2200110','39','81','3','2003-05-3','4','2002-11-6','3','2003-02-2','nec\r\n enim\r\n ultrices\r\n malesuada\r\n Proin\r\n faucibus\r\n eros\r\n in\r\n justo\r\n dignissim\r\n tempor','2002-10-27','5934','3879','8469.19','8498.85','2792.51','7222.68','In\r\n lobortis','Nam\r\n justo','411.13',NULL,'321011',0,'et\r\n netus','16','22000');
INSERT INTO Land VALUES (60,23,'2051','5153','','1','1','5','1231101','Residential','Nam','1103011','4','1333110','1313101','1313101','62','91','3','2002-11-18','3','2003-05-9','5','2002-12-22','dui\r\n Donec\r\n enim\r\n Curabitur\r\n aliquet\r\n luctus\r\n justo\r\n Donec\r\n tristique\r\n metus\r\n elementum','2002-07-22','3439','2732','5667.76','5375.72','4248.42','5912.28','non\r\n placerat','Sed\r\n nec','329.02',NULL,'211011',0,'fermentum\r\n Donec','100','23111');
INSERT INTO Land VALUES (61,23,'8855','2819','','5','5','4','3123110','Residential','malesuada','1302011','6','3023110','3223111','3223111','57','0','2','2002-08-17','4','2002-10-29','5','2002-12-6','amet\r\n augue\r\n non\r\n erat\r\n nonummy\r\n sodales\r\n Etiam\r\n lectus\r\n urna\r\n faucibus\r\n ac','2002-05-20','2259','3256','4627.95','6497.39','9886.95','6536.62','eros\r\n in','et\r\n velit','430.06',NULL,'322011',0,'nec\r\n enim','32','31110');
INSERT INTO Land VALUES (62,24,'5002','1493','','2','2','4','2300001','Residential','ac','1020000','6','2223000','2031011','2031011','48','80','4','2002-09-19','5','2002-08-28','4','2003-04-3','wisi\r\n sit\r\n amet\r\n posuere\r\n metus\r\n velit\r\n ac\r\n nulla\r\n Sed\r\n vitae\r\n erat','2002-10-27','6363','4172','5437.97','9628.41','7152.84','2427.73','tellus\r\n Phasellus','Etiam\r\n massa','654.99',NULL,'311001',0,'Nam\r\n semper','46','32011');
INSERT INTO Land VALUES (63,24,'4356','2028','','4','1','5','3222010','Residential','bibendum','1320101','1','1033010','3113000','3113000','78','5','2','2002-08-26','5','2002-08-16','5','2002-12-9','ipsum\r\n Pellentesque\r\n habitant\r\n morbi\r\n tristique\r\n senectus\r\n et\r\n netus\r\n et\r\n malesuada\r\n fames','2003-01-14','2439','1312','3165.52','9956.48','6922.62','3258.25','Pellentesque\r\n habitant','nec\r\n arcu','555.41',NULL,'133111',0,'vel\r\n turpis','27','13010');
INSERT INTO Land VALUES (64,24,'7397','4318','','3','4','2','1130111','Industrial','Donec','2220010','4','1311001','2330101','2330101','79','17','4','2002-05-31','1','2002-10-14','1','2002-05-24','sagittis\r\n Fusce\r\n sit\r\n amet\r\n est\r\n eget\r\n velit\r\n porta\r\n porta\r\n Maecenas\r\n odio','2003-02-11','4275','1882','8178.44','4147.19','4616.16','2638.86','id\r\n urna','neque\r\n Nam','563.31',NULL,'232011',0,'velit\r\n porta','25','23000');
INSERT INTO Land VALUES (65,24,'5376','5668','','3','3','4','1313100','Industrial','quam','2213101','2','3302011','3203100','3203100','71','74','3','2002-08-21','4','2002-12-12','5','2002-11-24','varius\r\n nunc\r\n justo\r\n ut\r\n lectus\r\n Cras\r\n volutpat\r\n varius\r\n massa\r\n Donec\r\n fringilla','2003-03-4','1514','2287','7575.27','8932.51','5423.97','7455.41','molestie\r\n volutpat','In\r\n fermentum','697.87',NULL,'222011',0,'tincidunt\r\n lacus','70','21000');
INSERT INTO Land VALUES (66,24,'5648','4282','','3','5','4','1302001','Residential','id','3330110','4','2102110','2101101','2101101','86','77','2','2002-06-18','2','2002-07-18','5','2002-12-18','adipiscing\r\n tincidunt\r\n Donec\r\n purus\r\n felis\r\n aliquam\r\n ac\r\n aliquet\r\n ac\r\n sagittis\r\n sit','2003-01-12','1479','7232','7615.36','3489.14','6755.39','4497.55','fames\r\n ac','semper\r\n id','501.13',NULL,'333101',0,'sit\r\n amet','3','23100');
INSERT INTO Land VALUES (67,25,'8979','6118','','1','1','4','3122100','Residential','Vivamus','2101001','6','2011100','1023110','1023110','6','94','1','2002-06-28','3','2003-05-3','4','2003-02-20','sem\r\n blandit\r\n ipsum\r\n Aliquam\r\n eget\r\n ligula\r\n Nam\r\n quam\r\n metus\r\n convallis\r\n ac','2002-11-6','9877','7912','2767.41','8473.61','2475.81','5829.19','vestibulum\r\n nibh','Donec\r\n tristique','486.03',NULL,'232001',0,'ipsum\r\n dolor','47','23101');
INSERT INTO Land VALUES (68,25,'6454','1396','','2','4','3','1002010','Residential','felis','2222110','6','2100011','1210101','1210101','77','95','4','2002-11-3','5','2002-11-25','2','2003-03-16','massa\r\n Donec\r\n fringilla\r\n Donec\r\n vitae\r\n nulla\r\n Nulla\r\n tincidunt\r\n Quisque\r\n tristique\r\n sapien','2002-09-4','6915','7868','6714.66','3483.52','4275.36','3541.32','ut\r\n nonummy','parturient\r\n montes','822.69',NULL,'232010',0,'ortor\r\n Sed','56','13010');
INSERT INTO Land VALUES (69,26,'7400','6378','','1','1','1','2000100','Commercial','nulla','1223001','3','2003010','3200011','3200011','34','61','2','2002-05-17','5','2002-09-5','4','2003-03-25','pellentesque\r\n et\r\n molestie\r\n vel\r\n risus\r\n Sed\r\n nec\r\n dui\r\n Phasellus\r\n cursus\r\n justo','2002-06-3','6447','5195','8877.51','4666.69','2114.64','7353.62','ullamcorper\r\n nibh','justo\r\n ut','687.25',NULL,'121001',0,'dictumst\r\n Quisque','12','12110');
INSERT INTO Land VALUES (70,26,'8253','2914','','4','3','1','2331011','Commercial','est','3001111','5','3300001','2123010','2123010','2','76','2','2003-01-29','3','2002-12-15','5','2002-10-5','magnis\r\n dis\r\n parturient\r\n montes\r\n nascetur\r\n ridiculus\r\n mus\r\n Pellentesque\r\n eget\r\n tellus\r\n eu','2002-06-17','5756','1234','6743.55','2942.74','1243.32','8389.38','dolor\r\n sit','non\r\n semper','855.38',NULL,'213100',0,'vitae\r\n varius','45','21000');
INSERT INTO Land VALUES (71,27,'0377','8530','','2','5','4','2011011','Residential','a','1322100','2','1131010','1230110','1230110','64','48','3','2002-05-24','3','2003-04-19','4','2002-08-10','vestibulum\r\n nibh\r\n non\r\n pellentesque\r\n magna\r\n purus\r\n et\r\n felis\r\n Duis\r\n est\r\n Cum','2002-12-24','2397','6629','5712.45','5635.39','2356.29','8545.63','porttitor\r\n pulvinar','id\r\n orci','93.51',NULL,'323100',0,'nunc\r\n consectetuer','88','22100');
INSERT INTO Land VALUES (72,27,'8649','7730','','4','5','2','1203001','Industrial','Pellentesque','1202001','6','1213010','3313011','3313011','8','96','4','2002-06-15','3','2003-03-20','4','2002-11-20','Nam\r\n est\r\n nulla\r\n sollicitudin\r\n vel\r\n blandit\r\n ut\r\n nonummy\r\n at\r\n ipsum\r\n Pellentesque','2002-05-15','8946','8735','3139.54','7176.59','2397.98','9568.65','senectus\r\n et','Donec\r\n vitae','713.52',NULL,'323110',0,'hac\r\n habitasse','77','21111');
INSERT INTO Land VALUES (73,28,'7469','7372','','5','2','1','2032010','Industrial','sit','2300110','6','2333111','2023010','2023010','44','66','2','2003-05-3','1','2002-12-11','3','2003-01-8','mi\r\n lorem\r\n viverra\r\n id\r\n ornare\r\n vitae\r\n sollicitudin\r\n sit\r\n amet\r\n nisl\r\n Nulla','2002-05-24','6331','1712','4181.33','3637.91','1775.36','2246.69','ornare\r\n vitae','euismod\r\n nec','163.14',NULL,'123101',0,'Donec\r\n purus','88','33000');
INSERT INTO Land VALUES (74,28,'4056','3297','','5','1','4','2121010','Residential','aliquam','3133001','6','2310100','3010110','3010110','30','73','3','2003-04-2','1','2002-12-29','2','2003-02-5','nulla\r\n cursus\r\n viverra\r\n In\r\n hac\r\n habitasse\r\n platea\r\n dictumst\r\n Cum\r\n sociis\r\n natoque','2002-09-5','5129','9235','8637.96','3179.69','1169.46','8161.38','malesuada\r\n Proin','bibendum\r\n sapien','874.16',NULL,'322111',0,'imperdiet\r\n neque','96','21011');
INSERT INTO Land VALUES (75,29,'4992','6845','','5','3','4','1323101','Residential','Nam','3022011','7','1201110','1300011','1300011','67','82','5','2002-11-21','1','2002-05-21','5','2002-05-29','amet\r\n dapibus\r\n ipsum\r\n nulla\r\n ac\r\n felis\r\n Suspendisse\r\n vestibulum\r\n Ut\r\n turpis\r\n nisl','2003-04-11','6426','9296','2355.25','6874.22','6612.79','7292.16','Aenean\r\n interdum','volutpat\r\n In','144.11',NULL,'333110',0,'massa\r\n metus','18','33100');
INSERT INTO Land VALUES (76,29,'3034','0918','','5','4','4','2322111','Industrial','nec','2303010','6','2233001','1213010','1213010','26','64','4','2002-11-12','3','2002-07-16','2','2003-03-22','hac\r\n habitasse\r\n platea\r\n dictumst\r\n Ut\r\n euismod\r\n enim\r\n vel\r\n turpis\r\n Vestibulum\r\n ante','2002-05-22','1697','5776','8778.51','9256.56','6829.36','2814.35','In\r\n hac','Sed\r\n vitae','419.06',NULL,'211101',0,'luctus\r\n et','64','32111');
INSERT INTO Land VALUES (77,29,'7930','0913','','1','1','2','3232000','Commercial','in','1023000','2','2111010','1111100','1111100','57','25','5','2002-06-10','1','2003-03-13','3','2002-09-4','eu\r\n interdum\r\n ac\r\n felis\r\n In\r\n fermentum\r\n Nam\r\n id\r\n urna\r\n id\r\n orci','2002-11-25','3735','6315','3839.74','3765.89','3759.17','3578.64','sem\r\n blandit','tristique\r\n metus','5.68',NULL,'311100',0,'felis\r\n Duis','10','33011');
INSERT INTO Land VALUES (78,30,'7986','2734','','1','1','4','1012110','Industrial','mus','1321101','4','2133110','3001100','3001100','18','39','1','2002-11-20','2','2002-07-15','2','2002-12-8','quis\r\n ligula\r\n vel\r\n turpis\r\n consectetuer\r\n tristique\r\n Quisque\r\n interdum\r\n tempus\r\n erat\r\n Vivamus','2002-06-15','9441','5216','5918.97','2943.91','1874.73','1157.31','felis\r\n In','ipsum\r\n dolor','636.59',NULL,'313010',0,'Cras\r\n volutpat','67','23000');
INSERT INTO Land VALUES (79,30,'5337','7318','','1','1','4','1101100','Commercial','scelerisque','1311001','6','3212011','3212001','3212001','85','68','3','2002-12-14','3','2003-03-27','5','2002-12-4','Curabitur\r\n imperdiet\r\n neque\r\n in\r\n justo\r\n Nam\r\n vel\r\n nunc\r\n eu\r\n leo\r\n rhoncus','2002-07-11','9489','5372','8766.82','9794.43','5963.12','5488.49','consectetuer\r\n commodo','vel\r\n pulvinar','487.45',NULL,'233110',0,'sodales\r\n elementum','9','23000');
INSERT INTO Land VALUES (80,30,'7174','5179','','5','3','5','2132011','Commercial','bibendum','1010011','6','1113001','2222110','2222110','56','67','2','2003-01-20','1','2002-07-4','4','2003-04-6','Cum\r\n sociis\r\n natoque\r\n penatibus\r\n et\r\n magnis\r\n dis\r\n parturient\r\n montes\r\n nascetur\r\n ridiculus','2002-11-27','7644','6441','2948.78','5254.82','6716.27','8798.34','amet\r\n enim','augue\r\n non','772.99',NULL,'211111',0,'eget\r\n elit','18','31101');
INSERT INTO Land VALUES (81,31,'8706','8649','','2','4','2','1303001','Commercial','volutpat','2312110','6','1220110','2202001','2202001','37','19','3','2002-08-8','1','2002-05-20','2','2003-05-3','fames\r\n ac\r\n turpis\r\n egestas\r\n Praesent\r\n quis\r\n enim\r\n Etiam\r\n non\r\n metus\r\n nec','2003-04-27','8378','4841','8472.54','3448.34','5412.99','2954.82','leo\r\n at','justo\r\n dignissim','56.86',NULL,'333111',0,'massa\r\n velit','57','13101');
INSERT INTO Land VALUES (82,31,'9323','8923','','1','2','3','2211100','Residential','nec','3011101','3','3000011','3101001','3101001','72','41','3','2003-03-3','1','2002-10-20','3','2002-07-3','lacus\r\n Nam\r\n est\r\n nulla\r\n sollicitudin\r\n vel\r\n blandit\r\n ut\r\n nonummy\r\n at\r\n ipsum','2002-08-7','4986','3294','7442.45','2892.56','5895.29','8927.83','Sed\r\n vitae','vel\r\n risus','647.54',NULL,'211111',0,'commodo\r\n Etiam','70','22100');
INSERT INTO Land VALUES (83,31,'0613','2055','','1','1','2','1230010','Industrial','luctus','1202000','1','1332110','2201110','2201110','4','66','4','2002-07-24','4','2002-07-16','1','2002-06-26','Nam\r\n ac\r\n dolor\r\n quis\r\n quam\r\n porta\r\n sodales\r\n Fusce\r\n aliquam\r\n Morbi\r\n rhoncus','2002-06-22','7495','2142','3864.12','3155.34','3674.47','3574.15','Fusce\r\n aliquam','risus\r\n risus','200.06',NULL,'233111',0,'metus\r\n velit','25','11100');
INSERT INTO Land VALUES (84,32,'5491','2771','','3','1','4','1033110','Industrial','ornare','1033010','1','2110101','3302101','3302101','57','51','3','2003-02-22','5','2002-12-31','3','2002-09-4','wisi\r\n sit\r\n amet\r\n posuere\r\n metus\r\n velit\r\n ac\r\n nulla\r\n Sed\r\n vitae\r\n erat','2002-12-25','1657','7574','3229.79','3261.68','3952.39','2976.56','sem\r\n scelerisque','condimentum\r\n posuere','391.79',NULL,'322111',0,'Pellentesque\r\n habitant','49','21110');
INSERT INTO Land VALUES (85,32,'1244','3682','','3','2','5','3102111','Residential','velit','3131010','3','3332101','1032000','1032000','9','18','3','2002-08-13','1','2003-05-6','4','2003-02-16','magna\r\n nec\r\n ligula\r\n condimentum\r\n posuere\r\n Aliquam\r\n rhoncus\r\n tincidunt\r\n lacus\r\n Nam\r\n est','2002-06-6','1115','5279','8366.42','6281.56','4484.22','9943.33','ipsum\r\n nulla','luctus\r\n congue','321.30',NULL,'213101',0,'velit\r\n neque','21','12100');
INSERT INTO Land VALUES (86,32,'7749','7953','','5','5','3','2213001','Residential','turpis','2302101','6','1202001','1100000','1100000','92','74','4','2002-12-5','3','2003-02-8','5','2003-02-13','ortor\r\n Sed\r\n eget\r\n elit\r\n Mauris\r\n dictum\r\n ipsum\r\n sed\r\n tempus\r\n posuere\r\n felis','2002-06-16','1688','5577','9668.12','5334.23','3611.56','4787.46','at\r\n mattis','fringilla\r\n tempor','615.52',NULL,'313111',0,'ac\r\n felis','11','21001');
INSERT INTO Land VALUES (87,33,'1911','1561','','5','3','3','3310111','Commercial','turpis','3011001','3','3103100','3123101','3123101','76','5','3','2003-01-7','3','2003-04-19','1','2002-09-8','feugiat\r\n arcu\r\n sed\r\n pulvinar\r\n ullamcorper\r\n nibh\r\n nunc\r\n consectetuer\r\n leo\r\n sit\r\n amet','2002-06-23','7578','7352','8277.97','7477.54','5561.48','8951.92','elit\r\n Pellentesque','turpis\r\n Aliquam','326.10',NULL,'221101',0,'augue\r\n Quisque','23','32110');
INSERT INTO Land VALUES (88,33,'3571','5320','','5','4','5','3202110','Commercial','nibh','3201001','5','1301011','2122011','2122011','41','38','4','2002-12-16','1','2003-05-4','1','2002-06-14','ridiculus\r\n mus\r\n Pellentesque\r\n eget\r\n tellus\r\n eu\r\n velit\r\n posuere\r\n euismod\r\n Sed\r\n et','2002-05-25','2948','9378','6593.48','9554.97','9227.68','1585.25','iaculis\r\n vitae','felis\r\n Suspendisse','594.95',NULL,'321110',0,'consectetuer\r\n commodo','73','21101');
INSERT INTO Land VALUES (89,34,'7042','9870','','1','1','3','2100110','Residential','tellus','3022011','3','2133001','2201010','2201010','17','5','3','2003-04-27','3','2003-04-8','3','2002-12-10','Nulla\r\n quis\r\n sem\r\n In\r\n hac\r\n habitasse\r\n platea\r\n dictumst\r\n Quisque\r\n diam\r\n Aliquam','2003-03-2','2633','9111','2464.42','1134.26','6122.12','9138.65','eu\r\n leo','velit\r\n non','180.10',NULL,'133000',0,'commodo\r\n Nulla','24','21100');
INSERT INTO Land VALUES (90,34,'3996','9317','','5','5','2','3230010','Commercial','diam','3323000','4','1001001','3322010','3322010','75','48','4','2003-02-16','1','2002-06-12','2','2002-12-16','elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n quam\r\n porta\r\n sodales\r\n Fusce\r\n aliquam\r\n Morbi','2002-07-22','3446','4131','6146.52','9735.67','6396.18','1162.41','lectus\r\n urna','scelerisque\r\n pulvinar','522.58',NULL,'112001',0,'Nunc\r\n bibendum','77','32000');
INSERT INTO Land VALUES (91,34,'8887','0344','','3','3','2','3030011','Commercial','lacinia','1231000','3','1111010','1031111','1031111','35','46','1','2002-06-27','3','2003-03-25','1','2003-02-15','orci\r\n Integer\r\n laoreet\r\n purus\r\n et\r\n dui\r\n Donec\r\n enim\r\n Curabitur\r\n aliquet\r\n luctus','2002-10-20','6733','5126','6733.44','5181.22','5965.18','3675.89','Vivamus\r\n feugiat','et\r\n molestie','716.17',NULL,'211111',0,'In\r\n hac','88','12001');
INSERT INTO Land VALUES (92,35,'4577','2278','','1','4','5','2230011','Commercial','eu','3301011','2','3021110','2203110','2203110','98','97','1','2003-01-10','1','2003-03-1','2','2002-11-16','rhoncus\r\n molestie\r\n In\r\n et\r\n risus\r\n nec\r\n arcu\r\n adipiscing\r\n tincidunt\r\n Donec\r\n purus','2003-03-14','4223','9762','1646.98','8213.52','6433.35','4959.46','ac\r\n dolor','Fusce\r\n aliquam','771.60',NULL,'231001',0,'ligula\r\n in','42','13010');
INSERT INTO Land VALUES (93,35,'3391','4335','','4','3','5','3113000','Commercial','elementum','3232001','2','2021000','1301010','1301010','99','42','5','2002-06-30','4','2003-04-16','1','2002-09-6','lobortis\r\n nibh\r\n Nulla\r\n quis\r\n sem\r\n In\r\n hac\r\n habitasse\r\n platea\r\n dictumst\r\n Quisque','2003-05-4','2764','9842','6885.87','3276.99','1746.53','9292.53','morbi\r\n tristique','sit\r\n amet','990.60',NULL,'322110',0,'metus\r\n dapibus','93','31111');
INSERT INTO Land VALUES (94,36,'6118','4883','1','2','2','5','2232001','Commercial','vulputate','3222000','6','2032100','1221000','1221000','5','40','4','2002-10-9','5','2003-05-5','5','2003-01-26','Quisque\r\n interdum\r\n tempus\r\n erat\r\n Vivamus\r\n convallis\r\n velit\r\n non\r\n mollis\r\n sodales\r\n elit','2003-03-5','2728','5242','6371.42','6192.25','1136.96','2279.65','neque\r\n consequat','pharetra\r\n augue','184.41',NULL,'313110',0,'magna\r\n Donec','92','31111');
INSERT INTO Land VALUES (95,36,'1389','9817','1','2','1','1','3012110','Commercial','sodales','2032001','2','2223001','3021011','3021011','20','67','1','2002-10-27','5','2002-10-28','3','2002-06-14','purus\r\n felis\r\n aliquam\r\n ac\r\n aliquet\r\n ac\r\n sagittis\r\n sit\r\n amet\r\n orci\r\n Etiam','2002-12-31','8884','6816','7639.93','1464.99','7129.62','8223.33','feugiat\r\n arcu','ut\r\n dapibus','945.85',NULL,'122000',0,'nonummy\r\n at','2','23100');
INSERT INTO Land VALUES (96,37,'5004','2619','2','3','2','3','1302010','Residential','malesuada','2310001','1','1021011','2332010','2332010','5','64','2','2003-04-7','1','2003-03-15','1','2003-04-16','id\r\n ornare\r\n vitae\r\n sollicitudin\r\n sit\r\n amet\r\n nisl\r\n Nulla\r\n quis\r\n ligula\r\n vel','2003-04-18','6782','4479','5597.37','9823.27','7837.29','3276.39','tempus\r\n quam','urna\r\n erat','144.40',NULL,'112111',0,'dignissim\r\n mi','77','21011');
INSERT INTO Land VALUES (97,37,'6567','8125','1','2','3','1','1133001','Residential','vel','1321001','3','1032110','3020110','3020110','62','17','1','2002-06-28','2','2003-01-15','5','2002-07-26','ac\r\n pellentesque\r\n et\r\n ortor\r\n Sed\r\n eget\r\n elit\r\n Mauris\r\n dictum\r\n ipsum\r\n sed','2002-08-29','5741','6298','8942.43','5436.84','1218.12','8233.16','non\r\n erat','amet\r\n nisl','426.05',NULL,'312100',0,'eget\r\n ligula','34','12111');
INSERT INTO Land VALUES (98,37,'7380','0925','1','5','2','3','1321001','Commercial','Morbi','1213010','2','1011011','3103000','3103000','13','24','1','2002-11-23','1','2002-07-21','2','2003-04-14','Curabitur\r\n imperdiet\r\n neque\r\n in\r\n justo\r\n Nam\r\n vel\r\n nunc\r\n eu\r\n leo\r\n rhoncus','2002-07-7','8785','8989','6147.88','6121.96','9229.11','4829.85','wisi\r\n augue','In\r\n hac','755.15',NULL,'232111',0,'eu\r\n velit','50','21010');
INSERT INTO Land VALUES (99,38,'5786','4873','1','5','5','2','2122111','Residential','est','1113100','1','1103001','1220010','1220010','43','77','3','2003-01-30','4','2002-12-1','5','2002-10-10','montes\r\n nascetur\r\n ridiculus\r\n mus\r\n Aenean\r\n velit\r\n neque\r\n iaculis\r\n vitae\r\n euismod\r\n nec','2003-01-16','5476','1639','6979.69','6543.95','8335.91','6614.27','amet\r\n orci','faucibus\r\n orci','858.50',NULL,'322101',0,'convallis\r\n in','94','11010');
INSERT INTO Land VALUES (100,38,'7228','7797','2','1','4','5','3132111','Industrial','Nam','3330000','1','3221001','3102101','3102101','32','52','2','2002-05-29','4','2003-02-12','5','2003-02-16','euismod\r\n nec\r\n laoreet\r\n eget\r\n est\r\n Quisque\r\n lorem\r\n nulla\r\n posuere\r\n vitae\r\n egestas','2002-08-7','1927','5217','9741.48','7643.73','8454.47','7344.75','Vestibulum\r\n ante','In\r\n hac','204.66',NULL,'223011',0,'nulla\r\n ac','67','13010');
INSERT INTO Land VALUES (101,38,'9941','2347','1','5','5','2','3312100','Residential','augue','3030011','7','3002110','3331011','3331011','6','52','3','2002-06-19','3','2002-10-6','2','2002-12-10','nibh\r\n nunc\r\n consectetuer\r\n leo\r\n sit\r\n amet\r\n dapibus\r\n ipsum\r\n nulla\r\n ac\r\n felis','2002-06-23','9841','2149','1629.88','4431.85','8334.37','7573.48','ligula\r\n vel','posuere\r\n felis','430.42',NULL,'332111',0,'tempor\r\n nec','96','21111');
INSERT INTO Land VALUES (102,39,'9501','7422','3','5','2','2','2131001','Industrial','malesuada','2210001','6','2220011','3322001','3322001','66','99','1','2003-04-14','5','2002-07-24','2','2002-07-1','vulputate\r\n nisl\r\n eu\r\n wisi\r\n Lorem\r\n ipsum\r\n dolor\r\n sit\r\n amet\r\n consectetuer\r\n adipiscing','2002-07-25','7594','5977','2168.88','1668.55','4265.79','1163.82','pede\r\n tempor','dapibus\r\n ipsum','71.88',NULL,'112001',0,'eu\r\n leo','18','22101');
INSERT INTO Land VALUES (103,40,'6721','5146','4','5','3','1','2130110','Industrial','tempor','3230111','7','2331011','3220011','3220011','65','80','2','2003-02-10','2','2002-11-24','1','2002-10-17','ac\r\n nulla\r\n Sed\r\n vitae\r\n erat\r\n sit\r\n amet\r\n est\r\n fringilla\r\n tempor\r\n Cum','2002-12-5','8588','5251','3823.92','3981.64','3556.21','2193.65','ligula\r\n ornare','vulputate\r\n ipsum','922.10',NULL,'313100',0,'velit\r\n In','98','33100');
INSERT INTO Land VALUES (104,41,'1019','3142','2','5','2','5','3333110','Residential','Cras','1132111','2','1102100','1332111','1332111','41','91','1','2002-11-15','5','2002-07-9','3','2003-02-14','pharetra\r\n augue\r\n dolor\r\n eu\r\n elit\r\n Nunc\r\n bibendum\r\n turpis\r\n non\r\n sodales\r\n rutrum','2003-01-3','8837','3933','4837.46','8656.42','4213.13','1387.76','vitae\r\n erat','eros\r\n gravida','896.56',NULL,'133010',0,'non\r\n nibh','26','13101');
INSERT INTO Land VALUES (105,42,'2526','8851','2','3','3','2','2333010','Commercial','quis','3220000','1','1001001','1210010','1210010','50','73','3','2002-10-13','2','2002-11-12','3','2002-09-21','non\r\n erat\r\n nonummy\r\n sodales\r\n Etiam\r\n lectus\r\n urna\r\n faucibus\r\n ac\r\n pretium\r\n ac','2002-09-3','6518','6589','1997.64','7583.17','1176.31','6547.74','Aliquam\r\n eget','neque\r\n Duis','236.62',NULL,'223001',0,'parturient\r\n montes','3','23111');
INSERT INTO Land VALUES (106,42,'6075','2031','5','3','1','4','2033011','Industrial','dignissim','1020000','5','3333010','3223011','3223011','12','2','3','2002-09-19','3','2002-07-15','3','2003-01-31','augue\r\n id\r\n orci\r\n Ut\r\n non\r\n lorem\r\n et\r\n lectus\r\n consectetuer\r\n commodo\r\n Etiam','2002-06-3','3711','4355','6298.94','9626.96','9641.73','6165.19','risus\r\n risus','Nullam\r\n molestie','645.35',NULL,'231101',0,'nec\r\n ligula','7','11010');
INSERT INTO Land VALUES (107,42,'6985','5153','4','1','2','2','3223010','Industrial','amet','1202011','6','3323111','1231101','1231101','21','65','4','2003-03-3','5','2003-03-31','3','2002-08-14','platea\r\n dictumst\r\n Quisque\r\n diam\r\n Aliquam\r\n non\r\n erat\r\n Suspendisse\r\n tempus\r\n quam\r\n vel','2003-02-2','5236','9242','5345.84','2994.86','2124.85','7683.89','Nunc\r\n volutpat','vel\r\n semper','614.77',NULL,'331101',0,'eu\r\n wisi','58','21101');
INSERT INTO Land VALUES (108,43,'0858','3278','5','4','5','1','2320101','Industrial','feugiat','3230111','7','3221011','1120111','1120111','73','70','5','2002-09-12','4','2002-07-6','5','2003-01-15','vulputate\r\n Nullam\r\n fermentum\r\n vestibulum\r\n odio\r\n Pellentesque\r\n nec\r\n magna\r\n Donec\r\n interdum\r\n scelerisque','2002-12-23','1794','5757','4394.58','8964.92','3655.15','5779.28','amet\r\n libero','enim\r\n Ut','475.94',NULL,'131000',0,'pulvinar\r\n ullamcorper','94','21110');
INSERT INTO Land VALUES (109,43,'2137','5032','2','2','5','3','2301000','Industrial','aliquam','2332001','4','3311010','1312010','1312010','51','57','5','2002-07-24','3','2002-05-14','1','2002-06-18','vitae\r\n molestie\r\n volutpat\r\n massa\r\n velit\r\n viverra\r\n risus\r\n vitae\r\n varius\r\n nunc\r\n justo','2003-01-28','1717','4268','1751.75','5481.81','4894.89','4534.86','convallis\r\n velit','nibh\r\n nunc','513.24',NULL,'123111',0,'vel\r\n turpis','97','11010');
INSERT INTO Land VALUES (110,43,'4723','7972','4','5','3','1','3022101','Commercial','justo','2313101','5','2233000','2132010','2132010','96','49','1','2002-11-3','2','2002-11-22','4','2002-08-15','nibh\r\n non\r\n pellentesque\r\n magna\r\n purus\r\n et\r\n felis\r\n Duis\r\n est\r\n Cum\r\n sociis','2002-08-1','3875','7771','5727.52','9127.88','6796.71','9381.18','Nam\r\n est','fermentum\r\n et','108.40',NULL,'321111',0,'Nulla\r\n laoreet','68','33111');
INSERT INTO Land VALUES (111,43,'4085','5699','2','2','2','5','3012010','Commercial','aliquet','2310000','3','2021111','3011010','3011010','50','87','4','2002-12-16','3','2002-06-11','3','2002-06-2','Nulla\r\n quis\r\n ligula\r\n vel\r\n turpis\r\n consectetuer\r\n tristique\r\n Quisque\r\n interdum\r\n tempus\r\n erat','2003-01-10','3237','5324','4878.39','5265.15','9266.15','3311.63','in\r\n fermentum','metus\r\n dapibus','505.70',NULL,'111011',0,'urna\r\n faucibus','11','11011');
INSERT INTO Land VALUES (112,43,'5964','6212','6','5','5','2','2131110','Commercial','habitasse','2233101','6','3001001','3121011','3121011','11','57','3','2002-11-25','4','2002-06-15','5','2003-02-17','Nulla\r\n tempor\r\n justo\r\n et\r\n varius\r\n malesuada\r\n urna\r\n erat\r\n vestibulum\r\n nibh\r\n non','2002-08-19','4261','2191','5222.67','7514.54','6939.47','3798.34','ut\r\n nonummy','euismod\r\n nec','443.19',NULL,'333111',0,'erat\r\n nec','62','22000');
INSERT INTO Land VALUES (113,44,'7280','0154','2','5','1','2','2211011','Residential','sapien','1030011','6','2011001','2210010','2210010','93','43','4','2003-04-25','5','2002-09-2','2','2002-11-21','elementum\r\n Integer\r\n metus\r\n In\r\n commodo\r\n Nulla\r\n tempor\r\n justo\r\n et\r\n varius\r\n malesuada','2002-10-11','7843','6318','6698.58','3374.75','7932.29','8377.73','fames\r\n ac','posuere\r\n euismod','42.50',NULL,'222100',0,'Aliquam\r\n eget','22','21011');
INSERT INTO Land VALUES (114,44,'5804','8645','4','1','2','1','2333111','Industrial','pulvinar','1223110','2','1233111','2003111','2003111','71','52','5','2002-11-17','5','2002-10-28','3','2002-10-18','justo\r\n nulla\r\n consequat\r\n quis\r\n pulvinar\r\n in\r\n volutpat\r\n ac\r\n sapien\r\n Morbi\r\n feugiat','2002-08-4','6487','1132','1752.84','1434.39','9942.74','3526.49','sodales\r\n elit','dignissim\r\n mi','65.95',NULL,'222001',0,'Nulla\r\n quis','25','11100');
INSERT INTO Land VALUES (115,44,'2675','7432','2','3','2','5','1023010','Residential','tempus','1331000','7','3122111','2122111','2122111','43','76','1','2002-08-22','1','2003-03-23','1','2002-09-15','sit\r\n amet\r\n consectetuer\r\n adipiscing\r\n elit\r\n Pellentesque\r\n sed\r\n purus\r\n eu\r\n quam\r\n scelerisque','2003-05-4','2183','3528','3429.22','7462.92','3358.14','1734.94','est\r\n Quisque','Nam\r\n pretium','724.35',NULL,'211001',0,'justo\r\n in','1','23001');
INSERT INTO Land VALUES (116,45,'6041','6534','8','5','5','5','1002001','Industrial','turpis','3110000','4','2021011','3101001','3101001','63','81','5','2002-08-7','3','2002-07-20','5','2002-08-4','velit\r\n neque\r\n iaculis\r\n vitae\r\n euismod\r\n nec\r\n laoreet\r\n eget\r\n est\r\n Quisque\r\n lorem','2002-09-11','6529','8629','8988.28','3746.12','7589.36','9317.64','dictumst\r\n Curabitur','pretium\r\n magna','244.17',NULL,'123100',0,'pretium\r\n ac','27','21100');
INSERT INTO Land VALUES (117,45,'7180','7729','4','2','5','3','2303011','Industrial','Nullam','3310100','1','2222010','3311110','3311110','52','9','3','2002-11-9','1','2003-02-17','3','2002-06-10','sem\r\n In\r\n hac\r\n habitasse\r\n platea\r\n dictumst\r\n Quisque\r\n diam\r\n Aliquam\r\n non\r\n erat','2003-02-24','1362','9219','6589.81','3129.19','1639.67','7229.71','ligula\r\n condimentum','vitae\r\n egestas','843.03',NULL,'311001',0,'Aenean\r\n interdum','62','13011');
INSERT INTO Land VALUES (118,45,'3575','4948','1','1','3','4','2103000','Commercial','justo','3032010','1','3101001','1110110','1110110','58','48','2','2002-11-2','1','2002-09-12','1','2002-09-5','nisl\r\n Nulla\r\n quis\r\n ligula\r\n vel\r\n turpis\r\n consectetuer\r\n tristique\r\n Quisque\r\n interdum\r\n tempus','2002-07-13','6612','9841','5999.23','6943.67','9258.26','8185.54','Phasellus\r\n est','eros\r\n in','146.24',NULL,'212010',0,'posuere\r\n Aliquam','42','11111');
INSERT INTO Land VALUES (119,45,'2335','1853','2','4','3','4','1121011','Industrial','eu','2132011','1','2122110','1332101','1332101','31','45','2','2002-12-26','2','2002-11-24','4','2003-01-8','lobortis\r\n magna\r\n sed\r\n dolor\r\n Nunc\r\n volutpat\r\n In\r\n hac\r\n habitasse\r\n platea\r\n dictumst','2002-07-10','2574','4922','9182.28','6799.75','8811.53','4837.76','tristique\r\n senectus','magnis\r\n dis','602.11',NULL,'221111',0,'Etiam\r\n lectus','33','33010');
INSERT INTO Land VALUES (120,46,'4659','7262','3','3','2','1','1133010','Commercial','nascetur','1320101','4','1220100','3003100','3003100','11','27','1','2003-04-16','4','2002-08-11','2','2003-01-12','risus\r\n nec\r\n enim\r\n ultrices\r\n malesuada\r\n Proin\r\n faucibus\r\n eros\r\n in\r\n justo\r\n dignissim','2002-07-16','4891','7395','1729.17','9392.84','4996.89','3519.34','fermentum\r\n Donec','volutpat\r\n varius','207.33',NULL,'322001',0,'sit\r\n amet','51','12101');
INSERT INTO Land VALUES (121,46,'7924','6233','3','5','1','2','1230001','Commercial','Vivamus','2222010','7','3031111','1013001','1013001','6','64','2','2003-03-20','4','2002-11-14','3','2002-07-14','augue\r\n non\r\n erat\r\n nonummy\r\n sodales\r\n Etiam\r\n lectus\r\n urna\r\n faucibus\r\n ac\r\n pretium','2002-08-7','7247','5357','6495.79','6253.35','8673.11','9571.44','pellentesque\r\n et','tincidunt\r\n Donec','522.91',NULL,'323010',0,'montes\r\n nascetur','46','12100');
INSERT INTO Land VALUES (122,46,'5603','2159','3','2','5','1','2313011','Industrial','nibh','3131111','6','3120111','2112010','2112010','57','58','5','2003-04-10','5','2003-04-18','1','2003-01-21','adipiscing\r\n Pellentesque\r\n habitant\r\n morbi\r\n tristique\r\n senectus\r\n et\r\n netus\r\n et\r\n malesuada\r\n fames','2002-12-11','5944','6951','7626.24','7259.94','6734.74','5917.31','metus\r\n In','pulvinar\r\n ullamcorper','169.86',NULL,'113101',0,'dolor\r\n sit','66','11001');
INSERT INTO Land VALUES (123,47,'2615','4596','5','2','2','1','1203101','Residential','vestibulum','2103001','3','2222101','1102010','1102010','70','78','3','2002-07-4','5','2003-01-18','3','2003-05-5','commodo\r\n Nulla\r\n tempor\r\n justo\r\n et\r\n varius\r\n malesuada\r\n urna\r\n erat\r\n vestibulum\r\n nibh','2003-05-7','3362','7351','6283.55','9273.68','9135.94','6271.64','pede\r\n et','laoreet\r\n eget','402.74',NULL,'322101',0,'turpis\r\n consectetuer','97','12010');
INSERT INTO Land VALUES (124,48,'1284','5924','7','5','1','2','1331111','Commercial','in','3302101','6','1210001','3302110','3302110','83','69','4','2002-08-12','4','2002-08-29','1','2003-01-19','Donec\r\n interdum\r\n scelerisque\r\n enim\r\n Cras\r\n vitae\r\n lacus\r\n id\r\n eros\r\n condimentum\r\n malesuada','2003-03-20','8261','8122','4997.15','3938.87','2686.67','1869.59','Sed\r\n vitae','ac\r\n pellentesque','925.36',NULL,'331111',0,'Vestibulum\r\n ante','6','11101');
INSERT INTO Land VALUES (125,48,'2250','9222','5','5','2','4','2131010','Commercial','augue','2302101','5','2212110','2011110','2011110','58','28','4','2003-01-22','3','2003-03-28','3','2003-02-1','In\r\n hac\r\n habitasse\r\n platea\r\n dictumst\r\n Quisque\r\n diam\r\n Aliquam\r\n non\r\n erat\r\n Suspendisse','2002-08-9','9942','6827','6921.47','9424.76','4589.99','4292.53','Integer\r\n metus','et\r\n ultrices','915.16',NULL,'233011',0,'augue\r\n non','76','13110');
INSERT INTO Land VALUES (126,48,'5667','7416','4','3','5','3','1013001','Residential','purus','1132110','3','1310111','1100100','1100100','100','78','3','2003-05-7','5','2002-12-15','2','2003-02-2','Aenean\r\n velit\r\n neque\r\n iaculis\r\n vitae\r\n euismod\r\n nec\r\n laoreet\r\n eget\r\n est\r\n Quisque','2002-10-3','1564','5551','8424.25','5185.25','8816.59','8199.25','non\r\n erat','sed\r\n dolor','888.33',NULL,'322000',0,'hac\r\n habitasse','21','21010');
INSERT INTO Land VALUES (127,49,'2780','9393','2','4','2','1','3332011','Commercial','Phasellus','2212000','2','3100100','1302011','1302011','52','44','5','2002-06-6','2','2002-11-10','5','2003-04-2','et\r\n varius\r\n malesuada\r\n urna\r\n erat\r\n vestibulum\r\n nibh\r\n non\r\n pellentesque\r\n magna\r\n purus','2002-09-6','8439','6132','5774.34','5145.96','7191.16','3732.83','vitae\r\n euismod','Nulla\r\n quis','824.47',NULL,'313011',0,'urna\r\n id','33','12111');
INSERT INTO Land VALUES (128,49,'5744','0219','1','3','3','2','2112001','Residential','Mauris','1232010','6','1333000','1200100','1200100','96','40','5','2002-05-30','3','2002-11-6','1','2002-05-13','felis\r\n aliquam\r\n ac\r\n aliquet\r\n ac\r\n sagittis\r\n sit\r\n amet\r\n orci\r\n Etiam\r\n viverra','2002-11-28','2768','8626','1161.26','6562.41','3615.52','6767.75','bibendum\r\n sapien','amet\r\n pede Suspendisse','406.69',NULL,'222110',0,'ipsum\r\n dolor','7','32011');
INSERT INTO Land VALUES (129,50,'2637','2432','1','2','3','4','1113110','Commercial','ipsum','1232000','2','1201011','3010110','3010110','88','5','1','2003-03-26','4','2002-10-6','5','2002-10-16','dolor\r\n sit\r\n amet\r\n consectetuer\r\n adipiscing\r\n elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n quam','2002-10-5','2618','2333','7251.73','1723.93','7428.87','5749.31','interdum\r\n scelerisque','luctus\r\n justo','713.64',NULL,'323011',0,'consectetuer\r\n adipiscing','91','32001');
INSERT INTO Land VALUES (130,50,'4686','4297','5','4','4','4','1020110','Commercial','malesuada','1101110','7','2312010','3023001','3023001','34','27','3','2002-09-27','2','2003-02-11','2','2003-02-23','ipsum\r\n dolor\r\n sit\r\n amet\r\n consectetuer\r\n adipiscing\r\n elit\r\n Nunc\r\n vulputate\r\n nisl\r\n eu','2003-01-1','7764','5939','9561.69','5884.84','2867.58','8862.73','massa\r\n Donec','odio\r\n neque','239.51',NULL,'111111',0,'hac\r\n habitasse','48','23110');
INSERT INTO Land VALUES (131,50,'2099','5536','11','3','5','3','1332011','Industrial','justo','1212011','5','1020110','2001101','2001101','13','51','5','2002-07-25','5','2003-04-4','5','2003-03-4','sem\r\n In\r\n hac\r\n habitasse\r\n platea\r\n dictumst\r\n Quisque\r\n diam\r\n Aliquam\r\n non\r\n erat','2003-04-18','9146','9399','7648.16','7572.44','8733.75','2611.64','dictumst\r\n Cum','luctus\r\n congue','372.31',NULL,'232100',0,'tincidunt\r\n Quisque','44','32110');
INSERT INTO Land VALUES (132,50,'2649','5312','4','1','5','5','1230100','Commercial','Curabitur','2022111','3','1233000','1112010','1112010','48','43','1','2003-03-10','2','2002-06-24','3','2002-05-24','mus\r\n Aenean\r\n velit\r\n neque\r\n iaculis\r\n vitae\r\n euismod\r\n nec\r\n laoreet\r\n eget\r\n est','2002-08-6','9849','9621','8619.61','1289.17','9475.44','9266.65','molestie\r\n vel','Nullam\r\n magna','84.41',NULL,'123000',0,'in\r\n vehicula','11','13000');
INSERT INTO Land VALUES (133,54,'5546','8973','8','1','1','4','3333011','Commercial','adipiscing','3301101','1','1221000','1302100','1302100','18','7','4','2002-12-12','4','2002-08-12','3','2003-05-6','Ut\r\n posuere\r\n commodo\r\n justo\r\n Phasellus\r\n sollicitudin\r\n vulputate\r\n ipsum\r\n In\r\n hac\r\n habitasse','2003-02-25','8297','2799','9327.44','2963.96','7337.91','1321.81','vel\r\n pharetra','fames\r\n ac','163.95',NULL,'333000',0,'vel\r\n blandit','4','12110');
INSERT INTO Land VALUES (134,55,'7916','4730','9','5','4','1','2100110','Commercial','turpis','1332110','7','3310111','2003011','2003011','50','90','2','2002-07-27','5','2002-12-31','4','2003-02-24','auctor\r\n vel\r\n semper\r\n ac\r\n laoreet\r\n non\r\n metus\r\n Sed\r\n nec\r\n pede\r\n vel','2003-02-6','6399','1775','1515.52','8571.19','7923.67','7153.53','ornare\r\n vitae','pede\r\n et','222.88',NULL,'213010',0,'euismod\r\n enim','46','23000');
INSERT INTO Land VALUES (135,55,'9213','4490','23','1','4','2','2123110','Commercial','morbi','3113000','6','2330110','2103110','2103110','71','79','2','2002-09-28','4','2002-10-8','1','2002-06-25','et\r\n netus\r\n et\r\n malesuada\r\n fames\r\n ac\r\n turpis\r\n egestas\r\n Nunc\r\n non\r\n risus','2002-08-18','4832','2525','7796.62','2453.88','8278.17','2339.29','Suspendisse\r\n tempus','mollis\r\n sodales','338.02',NULL,'332110',0,'nunc\r\n justo','40','13010');
INSERT INTO Land VALUES (136,56,'3125','1480','5','1','4','2','2233001','Commercial','id','1202110','1','2223010','1322010','1322010','11','71','1','2003-03-17','2','2003-01-9','5','2003-03-14','luctus\r\n justo\r\n Donec\r\n tristique\r\n metus\r\n elementum\r\n nibh\r\n Etiam\r\n massa\r\n metus\r\n dapibus','2002-12-25','8377','9945','9366.21','5859.63','6667.99','9566.85','tellus\r\n eu','imperdiet\r\n neque','212.58',NULL,'133010',0,'nonummy\r\n sodales','35','32111');
INSERT INTO Land VALUES (137,56,'0572','6558','4','1','3','5','1320000','Commercial','lectus','1322000','6','3311110','3120110','3120110','44','91','3','2003-03-12','1','2003-01-2','2','2002-09-19','tristique\r\n metus\r\n elementum\r\n nibh\r\n Etiam\r\n massa\r\n metus\r\n dapibus\r\n in\r\n aliquet\r\n at','2002-07-1','9767','7746','3537.21','6536.75','2439.13','5339.56','dis\r\n parturient','adipiscing\r\n tincidunt','857.62',NULL,'133101',0,'interdum\r\n tempus','2','12110');
INSERT INTO Land VALUES (138,56,'1470','1019','10','4','1','4','2031010','Commercial','Cras','1231010','5','2111000','3003110','3003110','22','83','1','2003-03-13','4','2003-04-12','3','2002-12-28','Quisque\r\n lorem\r\n nulla\r\n posuere\r\n vitae\r\n egestas\r\n id\r\n auctor\r\n pharetra\r\n tellus\r\n Phasellus','2002-10-17','4684','9478','2945.52','8276.65','2187.46','3823.24','vitae\r\n nulla','non\r\n eros','719.01',NULL,'233011',0,'fringilla\r\n tempor','83','31011');
INSERT INTO Land VALUES (139,57,'4264','5180','5','4','4','1','2100100','Industrial','tellus','1030001','7','3312011','1223110','1223110','35','92','3','2002-06-11','1','2002-07-23','2','2002-12-3','ipsum\r\n dolor\r\n sit\r\n amet\r\n consectetuer\r\n adipiscing\r\n elit\r\n Cras\r\n porttitor\r\n pulvinar\r\n mi','2002-06-22','2845','7947','3377.63','7792.84','2514.65','2627.51','tempor\r\n justo','metus\r\n dapibus','731.98',NULL,'312111',0,'euismod\r\n Sed','39','12100');
INSERT INTO Land VALUES (140,57,'2510','6392','17','1','4','5','2313000','Commercial','semper','3302111','5','3210010','3312001','3312001','68','56','1','2003-02-13','3','2002-11-2','5','2002-07-3','sed\r\n diam\r\n Nam\r\n semper\r\n lacinia\r\n lorem\r\n Pellentesque\r\n posuere\r\n interdum\r\n elit\r\n Duis','2002-06-13','2827','6842','3439.77','9631.61','9563.52','7951.28','ac\r\n turpis','platea\r\n dictumst','682.16',NULL,'332111',0,'quis\r\n tincidunt','48','12100');
INSERT INTO Land VALUES (141,57,'9583','6618','4','3','5','3','1210111','Commercial','Aenean','1301111','4','2022111','2311110','2311110','33','25','2','2002-12-5','4','2002-09-3','3','2002-06-7','tempus\r\n posuere\r\n felis\r\n mi\r\n eleifend\r\n quam\r\n vel\r\n rhoncus\r\n wisi\r\n augue\r\n id','2002-12-25','9281','9694','4574.25','5156.84','5341.76','9361.54','platea\r\n dictumst','erat\r\n Vivamus','919.23',NULL,'123011',0,'quam\r\n vel','28','31100');
INSERT INTO Land VALUES (142,58,'7629','2056','17','3','1','3','1201101','Industrial','elit','1110011','6','2202001','3001010','3001010','32','56','1','2002-08-10','5','2003-01-28','2','2002-06-12','massa\r\n Donec\r\n fringilla\r\n Donec\r\n vitae\r\n nulla\r\n Nulla\r\n tincidunt\r\n Quisque\r\n tristique\r\n sapien','2002-12-24','9857','6427','9129.42','3684.15','4768.78','1793.84','et\r\n enim','vel\r\n rhoncus','851.10',NULL,'111110',0,'magna\r\n nec','42','21001');
INSERT INTO Land VALUES (143,58,'7038','7054','5','4','4','3','3213001','Industrial','sit','1311100','2','1202101','1133001','1133001','45','61','2','2002-08-16','3','2002-06-2','5','2003-04-6','auctor\r\n vel\r\n semper\r\n ac\r\n laoreet\r\n non\r\n metus\r\n Sed\r\n nec\r\n pede\r\n vel','2002-05-23','7737','4348','6415.31','4745.15','4187.36','4167.76','Phasellus\r\n cursus','mollis\r\n sodales','453.00',NULL,'231000',0,'sit\r\n amet','2','21110');
INSERT INTO Land VALUES (144,59,'8843','1649','21','2','1','4','2223010','Residential','adipiscing','2112101','1','1310101','2110101','2110101','27','62','2','2003-03-9','1','2002-06-3','1','2003-02-8','elementum\r\n dignissim\r\n mi\r\n Morbi\r\n mi\r\n lorem\r\n viverra\r\n id\r\n ornare\r\n vitae\r\n sollicitudin','2002-08-2','8856','9439','3916.78','5537.62','8752.55','7531.79','Ut\r\n turpis','rhoncus\r\n molestie','55.75',NULL,'212100',0,'orci\r\n Integer','15','12100');
INSERT INTO Land VALUES (145,59,'4486','2110','8','3','4','4','2310000','Residential','nec','2332110','4','3230101','2323010','2323010','49','81','4','2002-11-29','2','2002-11-14','4','2002-08-7','sit\r\n amet\r\n orci\r\n Etiam\r\n viverra\r\n Nulla\r\n laoreet\r\n sem\r\n blandit\r\n ipsum\r\n Aliquam','2003-03-29','3412','2337','9642.42','1716.71','2621.69','3295.82','posuere\r\n commodo','pharetra\r\n nunc','356.30',NULL,'121000',0,'lorem\r\n sollicitudin','11','22101');
INSERT INTO Land VALUES (146,59,'2931','3101','5','5','4','1','1232110','Residential','lorem','2112011','1','3333010','3113010','3113010','66','94','4','2003-03-27','4','2003-03-16','3','2003-01-19','metus\r\n elementum\r\n nibh\r\n Etiam\r\n massa\r\n metus\r\n dapibus\r\n in\r\n aliquet\r\n at\r\n mattis','2002-10-20','3899','1128','2913.36','7914.34','6676.81','5851.77','eu\r\n quam','Cras\r\n vitae','461.81',NULL,'233100',0,'ipsum\r\n sed','54','11010');
INSERT INTO Land VALUES (147,60,'5246','6549','20','4','1','5','2213111','Industrial','justo','1000010','3','3021100','2321110','2321110','4','97','4','2002-10-17','4','2002-10-6','1','2002-10-26','Sed\r\n nec\r\n pede\r\n vel\r\n nulla\r\n cursus\r\n viverra\r\n In\r\n hac\r\n habitasse\r\n platea','2002-12-24','9459','1154','6988.25','6526.39','6458.48','2728.92','hac\r\n habitasse','viverra\r\n id','685.06',NULL,'133010',0,'morbi\r\n tristique','99','32110');
INSERT INTO Land VALUES (148,60,'3984','1600','18','5','4','4','1021011','Residential','purus','1310110','3','3111010','2330111','2330111','32','4','3','2003-02-5','5','2002-09-14','2','2002-07-19','placerat\r\n vel\r\n pharetra\r\n nec\r\n sem\r\n Aliquam\r\n molestie\r\n turpis\r\n ut\r\n neque\r\n Duis','2002-10-6','6875','1238','5663.38','1183.54','1986.59','4833.83','non\r\n erat','ipsum\r\n dolor','793.53',NULL,'332011',0,'quam\r\n vel','78','21011');
INSERT INTO Land VALUES (149,60,'7908','9360','7','2','3','5','2320111','Commercial','ac','1231011','3','3313001','2333101','2333101','71','7','5','2003-04-16','3','2003-03-1','2','2002-06-28','gravida\r\n pede\r\n Proin\r\n sollicitudin\r\n consectetuer\r\n mauris\r\n Ut\r\n elementum\r\n dignissim\r\n mi\r\n Morbi','2003-01-12','9524','1566','8834.53','1923.58','3856.14','4541.11','eleifend\r\n gravida','Nullam\r\n fermentum','103.35',NULL,'233111',0,'nascetur\r\n ridiculus','59','22110');
INSERT INTO Land VALUES (150,61,'0606','4809','4','5','1','4','2223011','Commercial','ut','2311101','4','1130000','1013010','1013010','54','55','2','2003-02-11','4','2002-09-30','1','2003-04-23','iaculis\r\n quis\r\n velit\r\n In\r\n sit\r\n amet\r\n augue\r\n non\r\n erat\r\n nonummy\r\n sodales','2002-08-23','9355','1956','1813.59','3358.86','4289.77','7975.83','elementum\r\n Integer','magna\r\n purus','220.19',NULL,'331111',0,'at\r\n lorem','74','31010');
INSERT INTO Land VALUES (151,61,'1966','0451','3','5','2','1','2203100','Industrial','Maecenas','1221010','7','3003001','2012110','2012110','89','46','3','2002-11-15','1','2003-01-2','2','2002-08-1','Ut\r\n non\r\n erat\r\n nec\r\n mi\r\n euismod\r\n fermentum\r\n Donec\r\n euismod\r\n pharetra\r\n nunc','2002-06-21','2644','4963','4357.38','6933.62','4337.98','5168.75','Pellentesque\r\n nec','ac\r\n pellentesque','597.07',NULL,'123101',0,'mus\r\n Pellentesque','20','12001');
INSERT INTO Land VALUES (152,62,'4377','2094','26','3','3','3','2100111','Commercial','ipsum','2313110','5','3331110','3022011','3022011','11','21','4','2002-10-25','2','2003-04-12','2','2003-01-3','sit\r\n amet\r\n augue\r\n non\r\n erat\r\n nonummy\r\n sodales\r\n Etiam\r\n lectus\r\n urna\r\n faucibus','2003-04-28','6579','5415','1784.83','2839.22','4864.57','8871.38','senectus\r\n et','commodo\r\n Etiam','976.02',NULL,'223110',0,'erat\r\n Vivamus','85','12111');
INSERT INTO Land VALUES (153,62,'3123','0754','19','4','3','5','3102111','Industrial','vulputate','1213100','5','1303001','2022101','2022101','45','40','5','2003-05-6','5','2003-01-14','4','2002-07-4','et\r\n magnis\r\n dis\r\n parturient\r\n montes\r\n nascetur\r\n ridiculus\r\n mus\r\n Aenean\r\n velit\r\n neque','2002-06-13','9259','8212','2733.84','1355.59','2313.19','5871.71','felis\r\n mi','Ut\r\n euismod','650.49',NULL,'222000',0,'dis\r\n parturient','86','32011');
INSERT INTO Land VALUES (154,62,'0700','5596','4','3','5','5','1300111','Industrial','vel','1101011','7','2332000','1220101','1220101','45','98','3','2002-07-12','5','2002-11-22','1','2003-04-5','ipsum\r\n sed\r\n tempus\r\n posuere\r\n felis\r\n mi\r\n eleifend\r\n quam\r\n vel\r\n rhoncus\r\n wisi','2003-01-14','9137','2266','4759.15','6596.63','5383.68','8879.85','Nulla\r\n vitae','consequat\r\n quis','266.65',NULL,'332011',0,'consectetuer\r\n tristique','58','13000');
INSERT INTO Land VALUES (155,62,'7725','2006','1','5','1','3','3310101','Commercial','enim','3131110','1','1110110','2301010','2301010','40','78','2','2002-07-5','4','2003-03-22','4','2002-06-16','velit\r\n In\r\n sit\r\n amet\r\n augue\r\n non\r\n erat\r\n nonummy\r\n sodales\r\n Etiam\r\n lectus','2003-03-25','6148','5531','7389.14','2836.54','4462.27','5463.92','molestie\r\n In','sit\r\n amet','37.68',NULL,'113111',0,'Nulla\r\n tempor','9','23000');
INSERT INTO Land VALUES (156,62,'2141','3647','3','2','3','2','3003010','Commercial','nulla','3012011','3','2010111','3210010','3210010','91','79','2','2002-12-30','4','2002-08-19','4','2003-03-27','In\r\n risus\r\n risus\r\n mattis\r\n vel\r\n pulvinar\r\n ac\r\n iaculis\r\n ut\r\n nulla\r\n Donec','2002-11-6','7967','3954','3126.78','7269.19','9461.78','7587.82','non\r\n neque','sit\r\n amet','121.73',NULL,'321011',0,'est\r\n Pellentesque','31','31110');
INSERT INTO Land VALUES (157,63,'3918','9877','23','5','2','2','3300101','Commercial','eu','3201000','3','1311101','2210011','2210011','96','74','2','2002-07-18','5','2002-06-11','5','2003-04-16','Nulla\r\n quis\r\n ligula\r\n vel\r\n turpis\r\n consectetuer\r\n tristique\r\n Quisque\r\n interdum\r\n tempus\r\n erat','2003-02-2','9779','6961','5426.57','6142.26','6524.31','9479.21','vel\r\n turpis','Donec\r\n vitae','572.65',NULL,'332010',0,'ac\r\n nulla','38','31011');
INSERT INTO Land VALUES (158,63,'3747','9196','25','3','3','5','2122110','Industrial','Phasellus','2231110','4','2212000','3201000','3201000','10','25','4','2003-03-5','3','2003-04-24','2','2003-02-13','ac\r\n nulla\r\n Sed\r\n vitae\r\n erat\r\n sit\r\n amet\r\n est\r\n fringilla\r\n tempor\r\n Cum','2003-01-9','5225','4673','9338.11','8577.67','3333.32','7716.72','adipiscing\r\n tincidunt','magna\r\n Donec','398.38',NULL,'311110',0,'Fusce\r\n ante','82','32110');
INSERT INTO Land VALUES (159,0,'2717','9316','10','5','1','5','2230001','Industrial','leo','3023011','6','2212011','1131011','1131011','57','86','5','2003-01-10','1','2002-10-26','3','2003-03-15','molestie turpis ut neque Duis id urna Nullam magna Maecenas bibendum','2003-04-15','8413','1831','1484.62','4528.33','9363.63','9958.71','volutpat varius','risus risus','597.31',NULL,'223001',0,'quis ligula','6','33111');
INSERT INTO Land VALUES (160,65,'5493','5450','21','4','4','3','2212011','Commercial','arcu','2310011','3','3021011','1203111','1203111','10','76','4','2002-08-20','3','2002-12-24','3','2002-12-4','enim\r\n ultrices\r\n malesuada\r\n Proin\r\n faucibus\r\n eros\r\n in\r\n justo\r\n dignissim\r\n tempor\r\n Ut','2003-04-2','9163','5473','7679.98','1923.56','5478.15','3168.59','neque\r\n luctus','pellentesque\r\n et','450.77',NULL,'132100',0,'Cras\r\n porttitor','90','11010');
INSERT INTO Land VALUES (161,65,'4887','9644','2','2','1','5','2103010','Industrial','et','1130010','6','3032000','1012011','1012011','22','63','2','2003-02-6','1','2002-12-13','5','2002-09-24','diam\r\n Aliquam\r\n non\r\n erat\r\n Suspendisse\r\n tempus\r\n quam\r\n vel\r\n dictum\r\n dictum\r\n sapien','2002-11-18','6649','3246','6848.84','8768.46','7664.28','8254.12','nibh\r\n non','pede\r\n vitae','11.83',NULL,'323100',0,'consequat\r\n quis','100','32100');
INSERT INTO Land VALUES (162,65,'5202','2874','26','3','3','2','2230001','Commercial','leo','2011101','2','3223001','1120010','1120010','27','46','3','2002-11-29','3','2002-08-30','5','2003-05-9','turpis\r\n Vestibulum\r\n ante\r\n ipsum\r\n primis\r\n in\r\n faucibus\r\n orci\r\n luctus\r\n et\r\n ultrices','2002-10-31','5632','5279','5986.65','9519.25','2129.75','6122.73','amet\r\n libero','lectus\r\n consectetuer','410.67',NULL,'232010',0,'mi\r\n Lorem','93','11011');
INSERT INTO Land VALUES (163,65,'9079','5732','18','5','1','1','3213110','Commercial','diam','1213001','5','2331110','3200011','3200011','53','84','4','2002-06-24','1','2002-07-11','5','2002-06-28','posuere\r\n Aliquam\r\n rhoncus\r\n tincidunt\r\n lacus\r\n Nam\r\n est\r\n nulla\r\n sollicitudin\r\n vel\r\n blandit','2002-11-14','8332','5569','6958.19','5329.59','7583.86','8185.86','et\r\n velit','laoreet\r\n sem','127.68',NULL,'211011',0,'nulla\r\n posuere','8','23010');
INSERT INTO Land VALUES (164,66,'2341','9879879879','31','2','3','5','1.5million','residential','residential','12313','12312','123123','','','taxable','2003','4','2003-05-17','1','2003-05-17','2','2003-05-17','','','79879879879','9879879879','hilaga','silangan','timog','kanluran','residential','residential','36',NULL,'27000',0,'2','2312312','3123123123');
INSERT INTO Land VALUES (165,69,'w','w','36','4','4','5','1,500,000.00','w','w','750,000.00','50','375,000.00','','','w','w','4','2003-08-23','3','2003-07-22','3','2003-12-19','w','','w','w','w','w','w','w','w','w','500','hectares','3,000',0,'dbwjke qjh','50','-50');
INSERT INTO Land VALUES (166,69,'weryquioyrqiuy','yui','37','','','','3,500,000.00','iyi','hkfoihofqjho','700,000.00','80','560,000.00','','','yes','2003','','2003-05-19','','2003-05-19','','2003-05-19','','','yiou','yiuy','iy','yioy','iuyio','iy','yiyiyiyiyiy','dwdwd','1,000','square meters','3,500',0,'wfwe','20','-80');
INSERT INTO Land VALUES (167,68,'34653279865','68756387456','38','1','2','3','1,152,000.00','2344rr','34r34r','1,382,400.00','20','276,480.00','','','234r34r34','34r34r34','4','2003-05-19','5','2003-05-19','5','2003-10-19','34r324r324r','','564328756787','32875638475','hilaga','silangan','tiomog','kanluran','r324r34r34','r34r34r','36','square meters','32000',0,'2r34r34r','120','20');
INSERT INTO Land VALUES (168,65,'12345','','39','','','','','','','10000','1','10000','','','','','','2003-05-19','','2003-05-19','','2003-05-19','','','','','','','','','','','',NULL,'',0,'','','');
INSERT INTO Land VALUES (169,71,'82345-823-82345','12-34-56-78-99','45','1','2','3','271,060.00','Residential','Residential','243,954.00','30','73,186.20','','','','','4','2003-05-20','5','2003-05-20','5','2003-05-20','','','','','Northern','Eastern','Southern','Western','Residential','R-3','542.12','square meters','500',0,'Unusable','90','-10');
INSERT INTO Land VALUES (170,73,'345678','234567','59','1','1','1','15,000.00','','','15,000.00','50','7,500.00','','','no','2004','1','2003-06-21','1','2003-06-21','1','2003-06-21','hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello ','','','','werwer','erwerwrer','errwewer','ewrwerwerwr','dqdwq','dwsdww','30','square meters','500',0,'gvrg\nkatabi starbucks','100','0');
INSERT INTO Land VALUES (171,73,'979879879','8798','61','','','','1,000,000.00','698','658','750,000.00','80','600,000.00','','','987','85','','2003-05-07','','2003-05-07','','2003-05-07','785','','789','798','798','7897','798','987','798','76897','1000','square meters','1000',0,'5879','75','-25');
INSERT INTO Land VALUES (172,75,'1','1','64','','','','500,000.00','1','1','450,000.00','90','405,000.00','','','1','1','','1900-05-01','','1900-05-01','','1900-05-01','1','','1','1','1','1','1','1','1','1','1000','square meters','500',0,'1','90','-10');
INSERT INTO Land VALUES (173,76,'07070-00886','045-070-07-04','69','','','','4,580.00','Land','Residential','4,580.00','20','916.00','','','Taxable','1997','','2003-05-22','','2003-05-22','','2003-05-22','','','','966','Spouse Antendio Gerbolingo and O','Creek','Lot No. 107-UCCP','Rene Recto','Residential','R-3','57.25','square meters','80',0,'','100','0');
INSERT INTO Land VALUES (174,76,'07070-00886','045-070-07-04','70','','','','6,486.20','Land','Agricultural','6,862.40','40','2,744.96','','','','','','2003-05-22','','2003-05-22','','2003-05-22','','','','966','Spouses Antendio Gerbolingo and','Creek','Lot No. 107_UCCP','Rene Recto','Agricultural','2nd','.9266','hectares','7000',0,'','105.8','5.799999999999997');
INSERT INTO Land VALUES (175,77,'07070-00886','045-070-07-04','75','3','','2','4,580.00','Land','Residential','5,038.00','20','1,007.60','','','Taxable','1997','','2003-05-22','','2003-05-22','4','2003-05-22','','','','966','Antendio Gerbolingo and Ofelia D','Creek','Lot No. 107-UCCP','Rene Recto','Residential','R-3','57.25','square meters','80',0,'Along a Road +20%\nPartially Subm','110','10');
INSERT INTO Land VALUES (176,77,'','','76','','','','6,486.20','Land','Agricultural','6,486.20','40','2,594.48','','','Taxable','1997','','2003-05-22','','2003-05-22','','2003-05-22','','','','','','','','','Residential','2nd','.9266','hectares','7000',0,'','100','0');
INSERT INTO Land VALUES (177,0,'12345','12345','80','1','1','1','152,399,025.00','12345','','18,813,659,636.25','12345','2,322,546,282,095.06','','','12345','12345','1','2003-06-04','1','2003-06-04','1','2003-06-04','12345','','12345','12345','12345','12345','12345','12345','','','12345','square meters','12345',0,'12345','12345','1234512245');
INSERT INTO Land VALUES (178,0,'','','81','','','','','','','','','','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','','','','','','','','','','hectares','',0,'','','');
INSERT INTO Land VALUES (179,0,'','','82','','','','','','','','','','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','','','','','','','','','','hectares','',0,'','','');
INSERT INTO Land VALUES (180,0,'','','83','','','','','','','','','','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','','','','','','','','','','hectares','',0,'','','');
INSERT INTO Land VALUES (181,0,'','','84','','','','','','','','','','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','','','','','','','etwer','','','hectares','',0,'','','');
INSERT INTO Land VALUES (182,0,'','','85','','','','','','','','','','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','','','','','','','etwer','','','hectares','',0,'','','');
INSERT INTO Land VALUES (183,0,'','','86','','','','0.00','','actualuse1','0.00','','0.00','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','','','','','','','etwer','ASDF','','hectares','',0,'','','');
INSERT INTO Land VALUES (184,0,'1','1','88','','','','1.00','1','actualuse2','0.01','1','0.00','','','1','1','','2003-06-04','','2003-06-04','','2003-06-04','','','1','1','1','1','1','1','q','asdfasdf','1','hectares','1',0,'1','1','1');
INSERT INTO Land VALUES (185,0,'2','2','89','','','','0.00','','actualuse2','0.00','','0.00','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','2','2','2','2','2','2','fdasdfsddfdfdfsfsdfsdf','asdfsdf','','hectares','',0,'','','');
INSERT INTO Land VALUES (186,0,'3','3','90','','','','0.00','','actualuse2','0.00','','0.00','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','3','3','3','3','3','3','fdasdfsddfdfdfsfsdfsdf','asdfsdf','','hectares','',0,'','','');
INSERT INTO Land VALUES (187,79,'sdfasdf','asdfsd','95','','','','0.00','','actualuse1','0.00','','0.00','','','','','','2003-06-06','','2003-06-06','','2003-06-06','','','fasdf','dfsafas','dfasdf','dfdfas','asdfas','dfas','etwer','ASDF','','hectares','',0,'','','');
INSERT INTO Land VALUES (188,82,'','','96','','','','12345','12345','','','','','','','','','','','','','','','','','','','','','','','','','12345','','12345',0,'','','');
INSERT INTO Land VALUES (189,0,NULL,'','','','','','765','765','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','765',NULL,'765',0,'',NULL,'');
INSERT INTO Land VALUES (190,0,NULL,'','','','','','765','765','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','765',NULL,'765',0,'',NULL,'');
INSERT INTO Land VALUES (191,83,'','','98','','','','3,108.00','777','actualuse1','0.00','','0.00','','','','','','2003-06-10','','2003-06-10','','2003-06-10','','','','','','','','','etwer','ASDF','777','hectares','4',0,'','','');
INSERT INTO Land VALUES (192,84,NULL,'','','','','','888','888','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','888',NULL,'888',0,'',NULL,'');
INSERT INTO Land VALUES (193,86,NULL,'','','','','','fgdgfdf','dfgdfg','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','dfgdfgd',NULL,'fgdgfd',0,'',NULL,'');
INSERT INTO Land VALUES (194,87,NULL,'','','','','','444','444','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','444',NULL,'444',0,'',NULL,'');
INSERT INTO Land VALUES (195,89,NULL,'','','','','','test','tets','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','test',NULL,'test',0,'',NULL,'');
INSERT INTO Land VALUES (196,0,'1','2','103','','','','3,000.00','3','actualuse1','0.00','','0.00','','','','','','2003-06-11','','2003-06-11','','2003-06-11','','','3','4','5','7','6','8','asdfasdf','ASDF','3','hectares','1000',0,'','','');
INSERT INTO Land VALUES (197,90,'2','8','104','','','','2,466,642.00','9','actualuse1','2,466,642.00','','0.00','','','Yes','','','2003-06-11','','2003-06-11','','2003-06-11','','','j','9','j','j','9','9','etwer','ASDF','111','hectares','22222',0,'3','100','-93');
INSERT INTO Land VALUES (198,90,'1','1','105','5','5','5','1,111.00','1','actualuse1','111.10','2','2.22','','','2','2','5','2003-06-11','5','2003-06-11','5','2003-06-11','','','1','1','1','1','1','1','etwer','ASDF','1','hectares','1111',0,'1','10','-90');
INSERT INTO Land VALUES (199,90,'11111','2222222','107','1','1','1','148,133,331,852.00','SWAMP','actualuse1','0.00','.00000000000000000004','0.00','','','No','4','1','2003-06-12','','2003-06-12','','2003-06-12','','','2222222222','3333333333','22223','33','3','2','etwer','ASDF','3333','hectares','44444444',0,'1','.0000000000001','-99.9999999999999');
INSERT INTO Land VALUES (200,92,NULL,'','','','','','fghfghfh','h','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','ghfghgfh',NULL,'gfhfgh',0,'',NULL,'');
INSERT INTO Land VALUES (201,95,NULL,'','','','','','888','888','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','888',NULL,'888',0,'',NULL,'');
INSERT INTO Land VALUES (202,95,NULL,'','','','','','555','555','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','555',NULL,'555',0,'',NULL,'');
INSERT INTO Land VALUES (203,96,NULL,'','','','','','999','999','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','999',NULL,'999',0,'',NULL,'');
INSERT INTO Land VALUES (204,97,NULL,'','','','','','1234','1234','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','1234',NULL,'1234',0,'',NULL,'');
INSERT INTO Land VALUES (205,97,NULL,'','','','','','12345','12345','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','12345',NULL,'12345',0,'',NULL,'');
INSERT INTO Land VALUES (206,99,NULL,'','','','','','testMarketValue','testKind','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','testArea',NULL,'testUnitValue',0,'',NULL,'');
INSERT INTO Land VALUES (207,101,NULL,'','','','','','78910','78910','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','78910',NULL,'78910',0,'',NULL,'');
INSERT INTO Land VALUES (208,104,'yuiyuiy','uiy','119','','','','500.00','uig','actualuse1','100.00','50','50.00','','','No','65465','','2003-06-04','','2003-06-05','','2003-06-05','654','','uiyui','yui','yui','yuiy','yui','uiy','etwer','ASDF','100','hectares','5',0,'654','20','-80');
INSERT INTO Land VALUES (209,105,NULL,'','','','','','88','789','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','789','square meters','88',0,'',NULL,'');
INSERT INTO Land VALUES (210,68,'867-5309a','1234-56-7890','125','','','','8,000.00','','actualuse1','8,000.00','40','3,200.00','','','No','','','2003-06-13','','2003-06-13','','2003-06-13','','','','','el Norte','El Easte','el Southe','El Weste','etwer','ASDF','400','square meters','20',0,'','100','0');
INSERT INTO Land VALUES (211,104,'312313','o','126','','','','2,000.00','yigiug','actualuse1','1,000.00','50','500.00','','','No','','','2003-06-13','','2003-06-13','','2003-06-13','','','uoi','uo','uoi','uio','uio','uio','etwer','ASDF','100','hectares','20',0,'','50','-50');

--
-- Table structure for table 'LandActualUses'
--

CREATE TABLE LandActualUses (
  landActualUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (landActualUsesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'LandActualUses'
--


INSERT INTO LandActualUses VALUES (1,'actualuse1','asdfasdf',1,'active');
INSERT INTO LandActualUses VALUES (2,'actualuse2','fasdfdsf',3,'active');

--
-- Table structure for table 'LandClasses'
--

CREATE TABLE LandClasses (
  landClassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (landClassesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'LandClasses'
--


INSERT INTO LandClasses VALUES (13,'etwer','rerwerwer',1,'active');
INSERT INTO LandClasses VALUES (14,'q','q',1,'active');
INSERT INTO LandClasses VALUES (15,'asdfasdf','dsfasdfa',3432,'active');
INSERT INTO LandClasses VALUES (16,'adfasdf','asdfasdfasdf',32423,'active');
INSERT INTO LandClasses VALUES (17,'fdasdfsddfdfdfsfsdfsdf','fasdfdsf',3434,'active');

--
-- Table structure for table 'LandSubclasses'
--

CREATE TABLE LandSubclasses (
  landSubclassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (landSubclassesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'LandSubclasses'
--


INSERT INTO LandSubclasses VALUES (1,'ASDF','aksdjfalsdkfjl;sdjf',456,'inactive');
INSERT INTO LandSubclasses VALUES (3,'asdfasdf','asdfasdfasdf',234,'inactive');
INSERT INTO LandSubclasses VALUES (5,'asdfsdf','sdfsdafsdf',45,'active');

--
-- Table structure for table 'Location'
--

CREATE TABLE Location (
  locationID int(11) NOT NULL auto_increment,
  odID int(11) default NULL,
  locationAddressID int(11) NOT NULL default '0',
  PRIMARY KEY  (locationID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Location'
--


INSERT INTO Location VALUES (1,1,1);
INSERT INTO Location VALUES (2,2,2);
INSERT INTO Location VALUES (3,3,3);
INSERT INTO Location VALUES (4,4,4);
INSERT INTO Location VALUES (5,5,5);
INSERT INTO Location VALUES (6,6,6);
INSERT INTO Location VALUES (7,7,7);
INSERT INTO Location VALUES (8,8,8);
INSERT INTO Location VALUES (9,9,9);
INSERT INTO Location VALUES (10,10,10);
INSERT INTO Location VALUES (11,11,11);
INSERT INTO Location VALUES (12,12,12);
INSERT INTO Location VALUES (13,13,13);
INSERT INTO Location VALUES (14,14,14);
INSERT INTO Location VALUES (15,15,15);
INSERT INTO Location VALUES (16,16,16);
INSERT INTO Location VALUES (17,17,17);
INSERT INTO Location VALUES (18,18,18);
INSERT INTO Location VALUES (19,19,19);
INSERT INTO Location VALUES (20,20,20);
INSERT INTO Location VALUES (21,21,21);
INSERT INTO Location VALUES (22,22,22);
INSERT INTO Location VALUES (23,23,23);
INSERT INTO Location VALUES (24,24,24);
INSERT INTO Location VALUES (25,25,25);
INSERT INTO Location VALUES (26,26,26);
INSERT INTO Location VALUES (27,27,27);
INSERT INTO Location VALUES (28,28,28);
INSERT INTO Location VALUES (29,29,29);
INSERT INTO Location VALUES (30,30,30);
INSERT INTO Location VALUES (31,31,31);
INSERT INTO Location VALUES (32,32,32);
INSERT INTO Location VALUES (33,33,33);
INSERT INTO Location VALUES (34,34,34);
INSERT INTO Location VALUES (35,35,35);
INSERT INTO Location VALUES (36,36,36);
INSERT INTO Location VALUES (37,37,37);
INSERT INTO Location VALUES (38,38,38);
INSERT INTO Location VALUES (39,39,39);
INSERT INTO Location VALUES (40,40,40);
INSERT INTO Location VALUES (41,41,41);
INSERT INTO Location VALUES (42,42,42);
INSERT INTO Location VALUES (43,43,43);
INSERT INTO Location VALUES (44,44,44);
INSERT INTO Location VALUES (45,45,45);
INSERT INTO Location VALUES (46,46,46);
INSERT INTO Location VALUES (47,47,47);
INSERT INTO Location VALUES (48,48,48);
INSERT INTO Location VALUES (49,49,49);
INSERT INTO Location VALUES (50,50,50);
INSERT INTO Location VALUES (51,51,51);
INSERT INTO Location VALUES (52,52,52);
INSERT INTO Location VALUES (53,53,53);
INSERT INTO Location VALUES (54,54,54);
INSERT INTO Location VALUES (55,55,55);
INSERT INTO Location VALUES (56,56,56);
INSERT INTO Location VALUES (57,57,57);
INSERT INTO Location VALUES (58,58,58);
INSERT INTO Location VALUES (59,59,59);
INSERT INTO Location VALUES (60,60,60);
INSERT INTO Location VALUES (61,61,61);
INSERT INTO Location VALUES (62,62,62);
INSERT INTO Location VALUES (63,63,63);
INSERT INTO Location VALUES (64,64,64);
INSERT INTO Location VALUES (65,65,65);
INSERT INTO Location VALUES (66,66,66);
INSERT INTO Location VALUES (67,67,67);
INSERT INTO Location VALUES (68,68,68);
INSERT INTO Location VALUES (69,69,69);
INSERT INTO Location VALUES (70,70,70);
INSERT INTO Location VALUES (71,71,71);
INSERT INTO Location VALUES (72,72,72);
INSERT INTO Location VALUES (73,73,73);
INSERT INTO Location VALUES (74,74,74);
INSERT INTO Location VALUES (75,75,75);
INSERT INTO Location VALUES (76,76,76);
INSERT INTO Location VALUES (77,77,77);
INSERT INTO Location VALUES (78,78,78);
INSERT INTO Location VALUES (79,79,79);
INSERT INTO Location VALUES (98,98,98);
INSERT INTO Location VALUES (99,99,99);
INSERT INTO Location VALUES (100,100,100);
INSERT INTO Location VALUES (101,101,101);
INSERT INTO Location VALUES (102,102,102);
INSERT INTO Location VALUES (103,103,103);
INSERT INTO Location VALUES (104,104,104);
INSERT INTO Location VALUES (105,105,105);
INSERT INTO Location VALUES (106,106,106);
INSERT INTO Location VALUES (107,107,107);
INSERT INTO Location VALUES (108,108,108);
INSERT INTO Location VALUES (109,109,109);
INSERT INTO Location VALUES (110,110,110);
INSERT INTO Location VALUES (111,111,111);
INSERT INTO Location VALUES (112,112,112);
INSERT INTO Location VALUES (113,113,113);
INSERT INTO Location VALUES (114,114,114);
INSERT INTO Location VALUES (115,115,115);
INSERT INTO Location VALUES (116,116,116);
INSERT INTO Location VALUES (117,117,117);
INSERT INTO Location VALUES (118,118,118);
INSERT INTO Location VALUES (119,119,119);
INSERT INTO Location VALUES (120,120,120);
INSERT INTO Location VALUES (121,121,121);
INSERT INTO Location VALUES (122,122,122);
INSERT INTO Location VALUES (123,123,123);
INSERT INTO Location VALUES (124,124,124);
INSERT INTO Location VALUES (125,125,125);
INSERT INTO Location VALUES (126,126,126);

--
-- Table structure for table 'LocationAddress'
--

CREATE TABLE LocationAddress (
  locationAddressID int(11) NOT NULL auto_increment,
  number varchar(50) default NULL,
  street varchar(50) default NULL,
  barangayID varchar(50) default NULL,
  district varchar(50) default NULL,
  municipalityCity varchar(50) default NULL,
  province varchar(50) default NULL,
  PRIMARY KEY  (locationAddressID)
) TYPE=InnoDB;

--
-- Dumping data for table 'LocationAddress'
--


INSERT INTO LocationAddress VALUES (1,'136','Lapu-Lapu Rd.','1','District II','municipalityCityF','Metro Manila');
INSERT INTO LocationAddress VALUES (2,'165','F.Makabulos Rd.','10','District II','municipalityCityB','Metro Manila');
INSERT INTO LocationAddress VALUES (3,'45','M.Dizon Rd.','7','District III','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (4,'33','M.M. Agoncillo Blvd.','1','District II','municipalityCityC','Metro Manila');
INSERT INTO LocationAddress VALUES (5,'146','J.Palma Blvd.','1','District II','municipalityCityE','Metro Manila');
INSERT INTO LocationAddress VALUES (6,'198','E.delos Santos St.','5','District IV','municipalityCityC','Metro Manila');
INSERT INTO LocationAddress VALUES (7,'63','Rajah Soliman Ave.','1','District II','municipalityCityI','Metro Manila');
INSERT INTO LocationAddress VALUES (8,'108','T.Tecson St.','9','District III','municipalityCityA','Metro Manila');
INSERT INTO LocationAddress VALUES (9,'154','F.Agoncillo St.','5','District V','municipalityCityA','Metro Manila');
INSERT INTO LocationAddress VALUES (10,'153','T.Tecson Blvd.','4','District V','municipalityCityA','Metro Manila');
INSERT INTO LocationAddress VALUES (11,'117','F.Makabulos Ave.','7','District I','municipalityCityE','Metro Manila');
INSERT INTO LocationAddress VALUES (12,'105','L.Rivera Blvd.','7','District I','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (13,'146','T.Martirez Ave.','3','District I','municipalityCityE','Metro Manila');
INSERT INTO LocationAddress VALUES (14,'155','Lapu-Lapu Blvd.','9','District I','municipalityCityG','Metro Manila');
INSERT INTO LocationAddress VALUES (15,'78','G.del Pilar St.','9','District IV','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (16,'191','M.M. Agoncillo Rd.','10','District III','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (17,'177','M.Silang Ave.','4','District V','municipalityCityC','Metro Manila');
INSERT INTO LocationAddress VALUES (18,'102','E.Aguinaldo Blvd.','1','District I','municipalityCityI','Metro Manila');
INSERT INTO LocationAddress VALUES (19,'1','L.Florentino Rd.','5','District V','municipalityCityF','Metro Manila');
INSERT INTO LocationAddress VALUES (20,'141','M.Dizon Blvd.','10','District II','municipalityCityE','Metro Manila');
INSERT INTO LocationAddress VALUES (21,'199','J.Rizal Ave.','6','District III','municipalityCityB','Metro Manila');
INSERT INTO LocationAddress VALUES (22,'125','Lapu-Lapu Ave.','5','District III','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (23,'11','G.del Pilar St.','4','District II','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (24,'65','M.Silang St.','4','District V','municipalityCityA','Metro Manila');
INSERT INTO LocationAddress VALUES (25,'147','A.Ricarte Ave.','8','District I','municipalityCityI','Metro Manila');
INSERT INTO LocationAddress VALUES (26,'130','G.del Pilar Blvd.','7','District IV','municipalityCityA','Metro Manila');
INSERT INTO LocationAddress VALUES (27,'116','J.Luna Rd.','1','District II','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (28,'114','J.Luna Rd.','3','District V','municipalityCityI','Metro Manila');
INSERT INTO LocationAddress VALUES (29,'73','A.Luna St.','5','District I','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (30,'199','P.Pira Ave.','3','District I','municipalityCityF','Metro Manila');
INSERT INTO LocationAddress VALUES (31,'192','D.Silang Blvd.','2','District II','municipalityCityB','Metro Manila');
INSERT INTO LocationAddress VALUES (32,'176','E.delos Santos Rd.','6','District II','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (33,'178','M.M. Agoncillo St.','8','District IV','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (34,'200','F.Agoncillo Ave.','9','District IV','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (35,'109','E.delos Santos Rd.','2','District II','municipalityCityC','Metro Manila');
INSERT INTO LocationAddress VALUES (36,'111','F.Agoncillo Rd.','6','District V','municipalityCityC','Metro Manila');
INSERT INTO LocationAddress VALUES (37,'163','J.Palma Rd.','7','District II','municipalityCityF','Metro Manila');
INSERT INTO LocationAddress VALUES (38,'4','Lakandola Blvd.','9','District III','municipalityCityI','Metro Manila');
INSERT INTO LocationAddress VALUES (39,'21','A.Esteban Rd.','6','District V','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (40,'158','T.Martirez Rd.','10','District III','municipalityCityC','Metro Manila');
INSERT INTO LocationAddress VALUES (41,'78','T.Tecson Blvd.','10','District IV','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (42,'116','J.Palma Blvd.','6','District II','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (43,'159','R.Palma Blvd.','7','District I','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (44,'19','A.Esteban St.','2','District II','municipalityCityE','Metro Manila');
INSERT INTO LocationAddress VALUES (45,'102','M.Aquino Ave.','6','District III','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (46,'37','J.Felipe Blvd.','6','District IV','municipalityCityA','Metro Manila');
INSERT INTO LocationAddress VALUES (47,'193','M.del Pilar Rd.','4','District III','municipalityCityI','Metro Manila');
INSERT INTO LocationAddress VALUES (48,'111','J.Panganiban St.','5','District II','municipalityCityB','Metro Manila');
INSERT INTO LocationAddress VALUES (49,'157','A.Ricarte Rd.','2','District V','municipalityCityC','Metro Manila');
INSERT INTO LocationAddress VALUES (50,'76','J.Luna Blvd.','6','District II','municipalityCityA','Metro Manila');
INSERT INTO LocationAddress VALUES (51,'q','q','1','District I','municipalityCityA','GHKGHK');
INSERT INTO LocationAddress VALUES (52,'e','e','9','District IV','municipalityCityG','aasdf');
INSERT INTO LocationAddress VALUES (53,'unit 2415 Megaplaza Bldg.','ADB AVe. cor. Garnett St.','2','District III','municipalityCityE','asfasdfasdf');
INSERT INTO LocationAddress VALUES (54,'23','A.Luna Rd.','1','District II','municipalityCityI','Metro Manila');
INSERT INTO LocationAddress VALUES (55,'147','T.Martirez St.','10','District IV','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (56,'173','J.Luna St.','3','District IV','municipalityCityE','Metro Manila');
INSERT INTO LocationAddress VALUES (57,'118','E.delos Santos Rd.','6','District II','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (58,'76','E.Aguinaldo Blvd.','3','District IV','municipalityCityH','Metro Manila');
INSERT INTO LocationAddress VALUES (59,'134','F.Ma Guerrero St.','8','District IV','municipalityCityA','Metro Manila');
INSERT INTO LocationAddress VALUES (60,'200','D.Silang Rd.','3','District III','City C','La Union');
INSERT INTO LocationAddress VALUES (61,'143','Rajah Soliman Ave.','1','District IV','municipalityCityD','Metro Manila');
INSERT INTO LocationAddress VALUES (62,'6','M.del Pilar Ave.','10','District III','municipalityCityB','Metro Manila');
INSERT INTO LocationAddress VALUES (63,'108','M.Silang Rd.','4','District I','municipalityCityG','Metro Manila');
INSERT INTO LocationAddress VALUES (64,'646','Lee','6','District V','municipalityCityD','ddfdsadf');
INSERT INTO LocationAddress VALUES (65,'190','R.Palma Rd.','10','District III','municipalityCityC','Metro Manila');
INSERT INTO LocationAddress VALUES (66,'unit 2415 Mmegaplaza Bldg.','ADB Avenue cor Garnett Street','2','District II','municipalityCityB','TYTYRTYRE');
INSERT INTO LocationAddress VALUES (67,'w','w','1','District I','municipalityCityA','GHKGHK');
INSERT INTO LocationAddress VALUES (68,'#4','1st Avenue','8','District IV','municipalityCityI','ddfdsadf');
INSERT INTO LocationAddress VALUES (69,'q','q','1','District I','municipalityCityA','GHKGHK');
INSERT INTO LocationAddress VALUES (70,'1400','Parkwood Drive','6','District III','municipalityCityC','asfasdf');
INSERT INTO LocationAddress VALUES (71,'1234567','Kangleon St','9','District II','municipalityCityB','asdfasf');
INSERT INTO LocationAddress VALUES (72,'223','Rizal St.','1','District I','municipalityCityA','GHKGHK');
INSERT INTO LocationAddress VALUES (73,'10th floor Orient square','emerald avenue','8','District I','municipalityCityE','asfasdf');
INSERT INTO LocationAddress VALUES (74,'79','horizon street','2','District V','Manila','Metro Manila');
INSERT INTO LocationAddress VALUES (75,'q','q','1','District I','municipalityCityA','Southern Leyte');
INSERT INTO LocationAddress VALUES (76,'NA','NA','12','District I','Maasin City','Southern Leyte');
INSERT INTO LocationAddress VALUES (77,'NA','T. Oppus St.','2','District I','Maasin City','Southern Leyte');
INSERT INTO LocationAddress VALUES (78,'1','Evidente','2','District II','City B','Metro Manila');
INSERT INTO LocationAddress VALUES (79,'dfhsdhf','dfhdfh','11','District I','Butuan City','Agusan del Norte');
INSERT INTO LocationAddress VALUES (98,'444','444','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (99,'777','7th Avenue','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (100,'555','5th Ave','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (101,'555','5th Ave','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (102,'555','5thElement Road','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (103,'777','777','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (104,'888','888','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (105,'hhfhgh','fhfhfghgh','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (106,'hhfhgh','fhfhfghgh','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (107,'999','999','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (108,'123456','2914','7','District I','Butuan City','Agusan del Norte');
INSERT INTO LocationAddress VALUES (109,'123456','2914','7','District I','Butuan City','Agusan del Norte');
INSERT INTO LocationAddress VALUES (110,'77777','Main','4','District IV','Kalibo','Aklan');
INSERT INTO LocationAddress VALUES (111,'3333','ggggg','1','District I desc','Bangued','Abra');
INSERT INTO LocationAddress VALUES (112,'t334t','34t34t34t34','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (113,'trert','tertertert','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (114,'4444','4444','7','District I','Butuan City','Agusan del Norte');
INSERT INTO LocationAddress VALUES (115,'888','888','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (116,'999','999','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (117,'1234','1234','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (118,'789','789','4','District IV','Kalibo','Aklan');
INSERT INTO LocationAddress VALUES (119,'testNumber','testStreet','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (120,'erterte','tretretrertrt','1','District I desc','Bangued','Abra');
INSERT INTO LocationAddress VALUES (121,'78910','78910','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (122,'78911','78911','1','District I','Bangued','Abra');
INSERT INTO LocationAddress VALUES (123,'dfgbdfd','dfgdgfdfgdfg','1','District I desc','Bangued','Abra');
INSERT INTO LocationAddress VALUES (124,'7','Quezon Ave','7','District I','Butuan City','Agusan del Norte');
INSERT INTO LocationAddress VALUES (125,'343','34343','4','District IV','Kalibo','Aklan');
INSERT INTO LocationAddress VALUES (126,'1600','Lincoln Street','7','bc','Butuan City','Agusan del Norte');

--
-- Table structure for table 'Machineries'
--

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
  PRIMARY KEY  (propertyID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Machineries'
--


INSERT INTO Machineries VALUES (1,1,'4982','7388','56','3','2','2','1240763','Residential','Nulla','600,000.00','40','0','','','86','32','2','2002-10-13','4','2002-10-11','4','2003-03-20','mi\n euismod\n fermentum\n Donec','','691841','222345','turpis\n ut\n neque\n Duis\n id\n','sapien vehicula','068996','899','2002-08-22','adipiscing elit','45','16','2002-08-06','2003-01-17','purus\n et\n dui\n Donec\n enim\n','20','40232.85','588.09','4492.78','8292.66','8431.77','57','600000');
INSERT INTO Machineries VALUES (2,1,'9242','8210','57','1','4','3','390484.64','Commercial','platea','90,484.64','20','0','','','34','75','3','2002-12-24','1','2002-12-03','2','2003-02-24','Etiam\n non\n metus\n nec\n nequ','','573364','726462','eu\n velit\n posuere\n euismod\n','turpis non','079367','514','2002-10-10','dignissim mi','15','15','2002-09-22','2002-12-12','posuere\n felis\n mi\n eleifend\n','13','12403.43','1666.87','8938.48','3188.50','3840.00','63','90484.64');
INSERT INTO Machineries VALUES (3,0,'8804','2417','','2','1','3','2100011','Industrial','in','1102110','4','3331001','1','3200000','38','28','2','2002-09-11','4','2002-09-26','3','2003-02-15','in\r\n urna\r\n Nullam\r\n molestie\r\n','2003-04-28','975337','591584','velit\r\n posuere\r\n euismod\r\n Sed\r','lorem\r\n nulla','449981','176','2002-08-9','Ut\r\n non','33','16','2003-02-10','2002-10-21','Ut\r\n euismod\r\n enim\r\n vel\r\n turp','44','28032.22','7748.21','4285.05','7677.73','760.12','49','1844.23');
INSERT INTO Machineries VALUES (4,2,'9089','0804','','5','5','4','1213010','Industrial','eu','2201101','4','3032110','1','2222110','25','55','3','2002-09-7','1','2002-09-1','2','2003-03-12','et\r\n netus\r\n et\r\n malesuada\r\n fa','2003-01-6','775436','683345','et\r\n velit\r\n In\r\n lobortis\r\n mag','nulla\r\n Ut sem','407593','680','2002-06-23','Fusce\r\n aliquam','30','29','2002-07-11','2002-05-19','in\r\n sapien\r\n ullamcorper\r\n vive','62','47645.36','4136.96','8692.96','706.67','2189.73','41','2033.52');
INSERT INTO Machineries VALUES (5,3,'6813','7488','','2','3','4','1223001','Commercial','sollicitudin','2333010','7','1103101','3','2030111','34','66','2','2002-07-22','1','2003-02-28','3','2003-01-18','ullamcorper\r\n viverra\r\n Pellente','2002-10-19','615795','351221','et\r\n malesuada\r\n fames\r\n ac\r\n tu','Proin\r\n faucibus','088499','963','2002-10-31','neque\r\n non','45','25','2002-12-7','2002-05-24','dictumst\r\n Ut\r\n euismod\r\n enim\r\n','76','38350.64','2903.94','1885.17','5836.83','5328.18','84','2634.06');
INSERT INTO Machineries VALUES (6,4,'2518','1849','','2','5','2','2001100','Commercial','viverra','3131001','6','3333000','3','1120100','2','82','5','2002-12-8','5','2003-01-2','4','2003-02-1','posuere\r\n euismod\r\n Sed\r\n et\r\n v','2002-06-25','695444','993372','sit\r\n amet\r\n augue\r\n non\r\n erat\r','erat\r\n Vivamus','607560','879','2002-12-9','ut\r\n nonummy','3','3','2003-03-28','2002-10-26','consectetuer\r\n commodo\r\n Etiam\r\n','27','10334.97','4486.80','1700.71','856.44','5070.47','97','2147.07');
INSERT INTO Machineries VALUES (7,4,'8022','2474','','5','1','1','1002110','Commercial','Nam','2000010','5','1010011','2','3101010','94','98','3','2002-06-25','3','2002-10-15','1','2003-02-27','nulla\r\n consequat\r\n quis\r\n pulvi','2002-07-25','449952','555315','eros\r\n in\r\n justo\r\n dignissim\r\n','sodales\r\n elementum','302053','193','2002-12-22','Fusce\r\n aliquam','35','17','2002-10-28','2003-04-19','consequat\r\n quis\r\n pulvinar\r\n in','1','75418.54','7344.58','7835.06','3573.94','2629.82','58','278.43');
INSERT INTO Machineries VALUES (8,4,'2379','1989','','3','1','1','3210100','Industrial','Ut','1303011','6','1113100','4','3002101','88','20','2','2002-10-14','1','2003-04-21','1','2002-12-1','velit\r\n In\r\n lobortis\r\n magna\r\n','2002-05-29','195397','776669','ac\r\n dolor\r\n quis\r\n quam\r\n porta','magna\r\n sed','404754','488','2002-06-29','non\r\n semper','25','10','2003-01-7','2003-03-25','sodales\r\n elit\r\n sem\r\n scelerisq','83','59873.80','8823.77','3873.02','8478.25','7184.66','72','2828.36');
INSERT INTO Machineries VALUES (9,5,'8964','7857','','5','5','4','1131000','Commercial','Ut','3203111','3','1203110','3','3022011','28','10','5','2002-07-28','4','2003-04-7','1','2002-10-18','elementum\r\n dignissim\r\n mi\r\n Mor','2002-10-17','166785','218749','nisl\r\n Nulla\r\n quis\r\n ligula\r\n v','turpis\r\n nisl','189154','358','2003-02-20','commodo\r\n Etiam','50','21','2003-03-20','2002-10-24','Suspendisse\r\n tempus\r\n quam\r\n ve','87','86986.36','2894.85','9127.96','7604.73','5482.50','45','294.74');
INSERT INTO Machineries VALUES (10,6,'0876','9503','','3','1','2','2230001','Industrial','elementum','1132011','2','3111110','3','1221011','36','51','4','2002-11-16','3','2002-10-23','2','2003-02-4','turpis\r\n egestas\r\n Nunc\r\n non\r\n','2002-10-17','748847','338816','pharetra\r\n nunc\r\n Aenean\r\n inter','ut\r\n dapibus','927005','907','2003-04-17','Fusce\r\n ante','43','16','2002-09-7','2002-11-30','purus\r\n eu\r\n quam\r\n scelerisque\r','15','39602.08','5257.57','8448.28','9995.00','9801.16','30','2937.95');
INSERT INTO Machineries VALUES (11,6,'5940','1211','','5','4','1','1131111','Commercial','nulla','3223010','5','1223101','2','2101001','69','43','3','2002-10-9','3','2003-01-13','3','2002-09-3','metus\r\n Sed\r\n nec\r\n pede\r\n vel\r\n','2003-02-4','681915','928124','Nulla\r\n nec\r\n nulla\r\n Ut sem\r\n p','pharetra\r\n augue','435521','541','2003-02-14','commodo\r\n nec','20','15','2002-06-30','2003-01-25','habitant\r\n morbi\r\n tristique\r\n s','11','92217.01','2962.44','3414.31','7966.84','5742.98','61','4556.50');
INSERT INTO Machineries VALUES (12,6,'4185','1716','','1','4','3','1330010','Industrial','magnis','3211110','4','1023000','3','1130101','48','29','2','2002-09-21','1','2002-12-30','3','2003-03-6','euismod\r\n fermentum\r\n Donec\r\n eu','2003-02-27','833929','588998','Pellentesque\r\n posuere\r\n interdu','et\r\n felis','474279','620','2003-01-25','vulputate\r\n nisl','49','48','2002-07-9','2002-09-14','orci\r\n Etiam\r\n viverra\r\n Nulla\r\n','22','46563.84','1861.48','1698.15','4702.17','558.11','94','3820.18');
INSERT INTO Machineries VALUES (13,6,'9606','0928','','3','4','3','2103100','Industrial','In','3111010','3','2200101','4','1013010','16','51','5','2002-09-24','3','2003-01-8','1','2002-10-2','massa\r\n purus\r\n ultricies\r\n wisi','2002-12-22','828112','961673','risus\r\n vitae\r\n varius\r\n nunc\r\n','erat\r\n vestibulum','360542','531','2002-06-11','In\r\n hac','23','8','2002-06-25','2002-09-2','nec\r\n arcu\r\n adipiscing\r\n tincid','75','55937.89','5371.27','3369.52','9578.11','7086.94','59','1533.14');
INSERT INTO Machineries VALUES (14,6,'6305','4742','','5','5','1','1101011','Residential','habitasse','1232000','7','1032010','2','2311010','19','52','2','2003-04-16','1','2003-04-16','4','2003-02-4','vitae\r\n varius\r\n nunc\r\n justo\r\n','2003-03-21','142175','189318','elit\r\n Pellentesque\r\n sed\r\n puru','rhoncus\r\n tincidunt','832342','733','2003-03-8','vitae\r\n nisl','2','1','2002-05-15','2003-01-12','lorem\r\n viverra\r\n id\r\n ornare\r\n','48','57705.83','7433.80','3430.76','6283.62','5118.50','48','3130.73');
INSERT INTO Machineries VALUES (15,7,'9028','6322','','3','5','1','1110101','Residential','aliquet','3310001','4','1031100','5','1021010','18','0','1','2002-12-21','5','2002-07-2','2','2002-08-18','Sed\r\n nec\r\n pede\r\n vel\r\n nulla\r\n','2003-05-1','423698','224216','orci\r\n Integer\r\n laoreet\r\n purus','eget\r\n ligula','620730','541','2002-12-12','mi\r\n euismod','6','5','2003-02-11','2002-10-31','Nulla\r\n felis\r\n lorem\r\n sollicit','23','19348.42','6653.13','2363.33','7276.72','2496.91','8','2289.28');
INSERT INTO Machineries VALUES (16,7,'0426','9031','','3','3','2','3113000','Residential','amet','1233100','4','1231011','3','2010010','68','7','4','2002-06-3','4','2002-09-11','4','2002-12-4','dui\r\n Donec\r\n enim\r\n Curabitur\r\n','2002-06-29','833595','918685','ac\r\n dolor\r\n quis\r\n quam\r\n porta','consectetuer\r\n adipiscing','923961','750','2003-02-26','ac\r\n dolor','35','33','2002-06-9','2003-03-20','laoreet\r\n purus\r\n et\r\n dui\r\n Don','100','71995.92','7636.48','3812.37','5235.78','2307.97','40','2550.06');
INSERT INTO Machineries VALUES (17,8,'8795','7879','','3','3','4','3123001','Residential','nulla','1030000','2','2222101','4','1233011','61','99','3','2002-06-1','1','2002-11-12','4','2002-08-5','fermentum\r\n Nam\r\n id\r\n urna\r\n id','2002-12-23','528927','376155','quam\r\n porta\r\n sodales\r\n Fusce\r\n','et\r\n lectus','092356','615','2003-05-9','consectetuer\r\n adipiscing','38','30','2002-07-2','2003-05-3','vitae\r\n nisl\r\n sed\r\n nunc\r\n curs','64','62001.34','7924.05','3350.15','5248.31','7091.28','37','1229.44');
INSERT INTO Machineries VALUES (18,8,'3797','4776','','5','4','1','2130011','Commercial','ligula','2322110','2','2033011','8','2111001','30','41','3','2003-03-24','5','2003-03-14','2','2003-02-1','ipsum\r\n Pellentesque\r\n habitant\r','2002-06-11','354764','795254','eros\r\n condimentum\r\n malesuada\r\n','et\r\n ultrices','968509','677','2002-10-21','Sed\r\n et','24','22','2002-08-15','2002-05-14','quam\r\n vel\r\n dictum\r\n dictum\r\n s','91','39715.08','6761.26','5717.56','8591.11','6861.76','3','1228.63');
INSERT INTO Machineries VALUES (19,9,'8002','6306','','2','1','4','2001110','Industrial','penatibus','3313000','4','1102011','1','1003100','96','39','3','2003-01-17','5','2002-06-10','4','2002-11-17','et\r\n magna\r\n nec\r\n ligula\r\n cond','2002-10-29','336146','967242','justo\r\n Donec\r\n tristique\r\n metu','erat\r\n Vivamus','761864','312','2003-01-4','elit\r\n Nunc','3','1','2003-04-10','2003-04-8','ipsum\r\n eros\r\n gravida\r\n non\r\n p','25','38138.60','4618.21','8669.54','7902.59','1021.72','15','3190.02');
INSERT INTO Machineries VALUES (20,9,'7248','5673','','4','4','3','1232000','Residential','ante','3000010','4','2030110','6','1001110','69','18','1','2002-09-7','1','2003-03-20','2','2002-11-13','elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n','2002-11-5','856816','494996','wisi\r\n augue\r\n id\r\n orci\r\n Ut\r\n','lacinia\r\n quis','402309','320','2002-08-17','justo\r\n Donec','11','4','2002-07-9','2002-07-17','erat\r\n nec\r\n mi\r\n euismod\r\n ferm','94','57901.78','1148.10','1233.11','6229.42','8559.01','65','4029.94');
INSERT INTO Machineries VALUES (21,10,'8579','7120','','5','3','2','3300011','Industrial','In','1001101','3','1011000','3','3322010','37','54','5','2002-12-8','4','2002-12-25','5','2002-11-24','vitae\r\n erat\r\n sit\r\n amet\r\n est\r','2002-06-16','347887','128348','cursus\r\n dictum\r\n Pellentesque\r\n','pharetra\r\n augue','773387','764','2002-09-22','erat\r\n sodales','16','4','2003-05-2','2002-10-2','lorem\r\n et\r\n lectus\r\n consectetu','36','29687.19','5718.64','8365.92','1560.46','7005.97','66','2692.96');
INSERT INTO Machineries VALUES (22,10,'1903','7965','','3','4','1','2212101','Commercial','varius','2223011','3','1220001','10','2013110','32','58','5','2002-09-9','1','2002-05-21','1','2003-03-10','felis\r\n lorem\r\n sollicitudin\r\n e','2003-05-2','747486','224194','diam\r\n Fusce\r\n ante\r\n pede\r\n tem','vehicula\r\n sed','780120','533','2002-10-16','metus\r\n In','15','10','2002-06-12','2002-07-25','viverra\r\n id\r\n ornare\r\n vitae\r\n','43','22932.99','9023.39','8280.64','567.23','5005.51','70','3498.23');
INSERT INTO Machineries VALUES (23,10,'0569','1691','','1','3','5','3123111','Residential','molestie','3120001','3','2203100','7','1301010','4','70','4','2002-06-29','5','2002-11-16','2','2002-07-16','sollicitudin\r\n vel\r\n blandit\r\n u','2002-09-28','631436','171429','laoreet\r\n eget\r\n est\r\n Quisque\r\n','amet\r\n augue','841566','980','2002-08-21','Integer\r\n metus','25','22','2002-08-30','2003-05-9','Quisque\r\n ante\r\n ligula\r\n ornare','82','8605.02','5394.19','5888.61','1811.56','7815.98','59','1863.70');
INSERT INTO Machineries VALUES (24,11,'0395','0473','','5','3','5','3312111','Residential','sodales','1000010','7','2223100','8','1000001','36','77','5','2002-10-8','3','2002-05-26','3','2002-08-2','gravida\r\n pede\r\n Proin\r\n sollici','2002-08-18','254885','259965','nunc\r\n consectetuer\r\n leo\r\n sit\r','Etiam\r\n lectus','794702','163','2002-08-27','Aliquam\r\n molestie','16','13','2002-10-7','2002-07-26','nibh\r\n non\r\n pellentesque\r\n magn','59','97426.38','2436.53','4173.72','5093.71','7251.65','74','3470.66');
INSERT INTO Machineries VALUES (25,11,'4792','3688','','5','1','5','3100011','Industrial','consectetuer','1303001','7','1032110','10','2233110','6','29','5','2003-01-23','1','2002-09-7','4','2002-10-19','Vestibulum\r\n ante\r\n ipsum\r\n prim','2002-11-6','427543','215373','justo\r\n Nam\r\n vel\r\n nunc\r\n eu\r\n','porta\r\n sodales','313635','333','2002-12-8','vel\r\n nulla','5','2','2002-11-22','2003-01-20','nulla\r\n Sed\r\n vitae\r\n erat\r\n sit','11','18274.87','7592.27','5371.29','1261.43','2077.86','68','4797.21');
INSERT INTO Machineries VALUES (26,11,'0903','4790','','5','4','2','3032011','Industrial','at','2201111','7','3030010','9','3113100','58','80','1','2002-09-11','3','2003-04-6','2','2002-05-16','Aenean\r\n velit\r\n neque\r\n iaculis','2003-01-26','317689','226276','Vestibulum\r\n ante\r\n ipsum\r\n prim','Curae\r\n Donec','589006','570','2002-06-17','Nunc\r\n bibendum','22','11','2003-05-7','2002-09-21','nec\r\n ligula\r\n condimentum\r\n pos','31','9644.99','8068.29','8213.78','5710.88','9360.80','56','3941.31');
INSERT INTO Machineries VALUES (27,12,'3493','5823','','4','1','2','1332111','Industrial','euismod','3010011','6','1212100','8','1122001','69','55','4','2002-05-26','3','2002-08-4','1','2002-05-22','egestas\r\n Praesent\r\n quis\r\n enim','2002-07-21','693967','872968','elit\r\n sem\r\n scelerisque\r\n ipsum','lorem\r\n Pellentesque','314667','702','2002-08-1','arcu\r\n sed','46','43','2002-07-22','2002-05-20','vitae\r\n nisl\r\n sed\r\n nunc\r\n curs','58','10578.33','2032.74','1351.11','6787.76','6224.89','13','4250.90');
INSERT INTO Machineries VALUES (28,12,'5634','6952','','1','3','3','1031110','Commercial','hac','3021011','6','1230101','8','3300101','65','80','4','2003-04-15','3','2002-08-2','3','2002-12-14','sodales\r\n Etiam\r\n lectus\r\n urna\r','2002-08-7','682672','143261','quis\r\n enim\r\n Etiam\r\n non\r\n metu','erat\r\n Vivamus','345753','956','2003-03-27','Nam\r\n semper','39','26','2003-01-21','2003-04-14','et\r\n magna\r\n nec\r\n ligula\r\n cond','14','78570.68','5240.14','4511.58','7777.76','8697.32','31','888.07');
INSERT INTO Machineries VALUES (29,12,'9482','8508','','2','3','2','2322001','Commercial','enim','3202001','2','2312010','7','1032011','9','43','1','2002-12-29','1','2002-10-2','5','2002-06-18','vulputate\r\n ipsum\r\n In\r\n hac\r\n h','2002-07-31','563568','933612','sit\r\n amet\r\n enim\r\n Ut\r\n sit\r\n a','semper\r\n lacinia','860137','493','2003-04-14','Aenean\r\n interdum','24','15','2002-07-28','2003-04-17','pharetra\r\n nec\r\n sem\r\n Aliquam\r\n','31','40027.52','6388.93','7148.34','7552.18','6675.80','24','4359.46');
INSERT INTO Machineries VALUES (30,13,'2368','2163','','4','2','2','1212101','Commercial','ornare','1111010','6','2111000','8','3121010','66','8','1','2003-03-12','1','2002-12-30','5','2002-10-13','sed\r\n purus\r\n eu\r\n quam\r\n sceler','2002-10-21','846254','972442','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','Pellentesque\r\n egestas','478158','317','2003-02-21','arcu\r\n sed','34','30','2003-05-5','2003-01-7','dictum\r\n ipsum\r\n sed\r\n tempus\r\n','23','27494.28','5967.07','9307.77','5417.07','1759.27','79','4045.29');
INSERT INTO Machineries VALUES (31,13,'2161','4874','','5','2','1','2113001','Residential','ligula','3120111','2','2213001','3','3322110','14','90','5','2002-11-30','4','2002-06-16','5','2002-07-26','at\r\n sapien\r\n vehicula\r\n pede\r\n','2002-07-13','493786','238244','ornare\r\n vitae\r\n sollicitudin\r\n','tempor\r\n justo','626744','717','2002-08-14','quis\r\n pulvinar','27','14','2002-11-21','2002-05-31','Nulla\r\n quis\r\n sem\r\n In\r\n hac\r\n','93','4430.72','5092.28','8604.26','1068.35','9946.13','20','3555.03');
INSERT INTO Machineries VALUES (32,14,'8565','5447','','2','2','1','3032111','Commercial','sapien','1321011','6','3032000','2','1022000','33','25','3','2002-06-17','1','2002-07-25','1','2002-09-19','eu\r\n wisi\r\n Lorem\r\n ipsum\r\n dolo','2002-12-17','645946','779677','pede\r\n porttitor\r\n sagittis\r\n Fu','sed\r\n dolor','283728','642','2003-05-5','euismod\r\n fermentum','48','18','2002-05-28','2002-11-12','dapibus\r\n in\r\n fermentum\r\n et\r\n','69','17571.32','9213.83','3890.10','5084.28','7407.83','48','4631.01');
INSERT INTO Machineries VALUES (33,15,'8749','7377','','5','3','4','1312111','Residential','elit','2030110','6','3332100','6','1022101','27','16','4','2002-10-6','4','2002-05-20','4','2002-06-6','est\r\n fringilla\r\n tempor\r\n Cum\r\n','2003-05-10','986387','632314','Nulla\r\n nec\r\n nulla\r\n Ut sem\r\n p','Integer\r\n metus','646051','788','2002-11-6','orci\r\n Ut','26','4','2003-02-1','2003-01-29','euismod\r\n enim\r\n vel\r\n turpis\r\n','78','34930.82','9125.60','8813.82','787.31','7800.76','84','2550.09');
INSERT INTO Machineries VALUES (34,15,'7251','0954','','3','1','4','1330111','Industrial','sed','1112010','1','2300110','3','2033101','33','50','1','2003-04-13','1','2003-01-11','4','2003-04-12','sem\r\n In\r\n hac\r\n habitasse\r\n pla','2002-10-4','543647','549883','laoreet\r\n sem\r\n blandit\r\n ipsum\r','at\r\n volutpat','396809','361','2002-05-25','pede\r\n et','47','27','2003-02-25','2003-03-10','libero\r\n Lorem\r\n ipsum\r\n dolor\r\n','1','84703.16','2335.43','1040.44','9463.40','3927.20','11','1390.19');
INSERT INTO Machineries VALUES (35,15,'7258','2045','','4','1','3','1303110','Industrial','turpis','2302011','6','2123110','4','3203000','61','98','4','2002-05-31','5','2003-05-1','2','2002-12-3','amet\r\n augue\r\n non\r\n erat\r\n nonu','2003-02-10','896128','335951','nulla\r\n Nulla\r\n tincidunt\r\n Quis','leo\r\n vitae','743282','571','2003-05-3','Suspendisse\r\n tempus','6','2','2002-07-23','2003-04-23','nisl\r\n Nulla\r\n quis\r\n ligula\r\n v','59','22840.31','3435.38','7422.48','7781.89','1460.27','67','2910.55');
INSERT INTO Machineries VALUES (36,16,'4264','6925','','4','4','2','1313011','Industrial','eget','1123111','1','2003011','3','1120110','28','45','3','2003-03-17','2','2002-10-9','1','2002-09-19','interdum\r\n tempus\r\n erat\r\n Vivam','2002-11-1','312128','993432','auctor\r\n vel\r\n semper\r\n ac\r\n lao','commodo\r\n Nulla','316854','621','2002-10-10','id\r\n turpis','24','1','2002-12-10','2003-03-4','vitae\r\n molestie\r\n volutpat\r\n ma','1','2424.07','5149.00','9397.32','645.20','7704.30','25','3686.64');
INSERT INTO Machineries VALUES (37,16,'4808','1423','','1','5','3','1332001','Industrial','tellus','1021100','1','1320101','6','2222100','44','5','1','2003-01-25','2','2002-07-22','5','2002-05-12','adipiscing\r\n elit\r\n Cras\r\n portt','2002-11-19','515453','775677','magna\r\n id\r\n augue\r\n Quisque\r\n a','pharetra\r\n nunc','063218','205','2002-11-10','in\r\n iaculis','11','2','2002-06-23','2002-08-17','In\r\n hac\r\n habitasse\r\n platea\r\n','81','74176.83','7811.35','9129.83','548.55','825.11','15','3866.51');
INSERT INTO Machineries VALUES (38,17,'0183','4680','','2','4','2','3300111','Commercial','vestibulum','3000010','2','3311001','1','2020010','54','45','1','2002-12-10','1','2002-06-8','1','2003-02-15','hac\r\n habitasse\r\n platea\r\n dictu','2003-03-21','386399','144216','lorem\r\n et\r\n lectus\r\n consectetu','Nulla\r\n nec','673592','943','2002-09-12','volutpat\r\n In','23','1','2002-12-18','2002-09-19','purus\r\n consectetuer\r\n tellus\r\n','52','71447.41','3289.44','5471.25','9321.56','3892.24','91','1499.58');
INSERT INTO Machineries VALUES (39,17,'2588','0599','','3','2','3','3320110','Residential','nisl','3310000','2','2210011','2','3133110','68','56','1','2002-06-29','4','2002-06-21','1','2002-12-13','eros\r\n in\r\n justo\r\n dignissim\r\n','2002-12-6','449338','722359','nascetur\r\n ridiculus\r\n mus\r\n Pel','elit\r\n sem','748404','31','2002-08-26','ullamcorper\r\n viverra','34','20','2003-04-17','2002-08-29','in\r\n iaculis\r\n quis\r\n velit\r\n In','100','87884.02','7997.37','1835.57','6657.39','9610.62','99','4641.43');
INSERT INTO Machineries VALUES (40,18,'3987','4341','','3','1','5','3223000','Commercial','amet','1021100','5','1113010','17','2323110','4','13','4','2002-08-14','4','2002-09-12','2','2002-11-1','Nunc\r\n volutpat\r\n In\r\n hac\r\n hab','2002-12-9','939832','691873','porttitor\r\n pulvinar\r\n mi\r\n Phas','dictum\r\n sapien','970124','616','2002-09-5','varius\r\n nunc','35','25','2002-09-30','2003-03-28','Mauris\r\n dictum\r\n ipsum\r\n sed\r\n','99','50660.94','3997.19','816.72','3669.41','3146.86','78','4453.33');
INSERT INTO Machineries VALUES (41,18,'9279','8814','','3','4','3','3303000','Industrial','viverra','1112000','7','1222010','4','3000010','32','38','2','2002-10-25','1','2002-06-15','3','2002-11-14','consectetuer\r\n mauris\r\n Ut\r\n ele','2002-05-24','956717','776425','Donec\r\n vulputate\r\n Nullam\r\n fer','In\r\n sit','490696','571','2003-04-22','non\r\n eros','48','45','2002-08-4','2002-11-26','amet\r\n dapibus\r\n ipsum\r\n nulla\r\n','33','57948.94','6042.22','4021.31','9445.52','6951.67','7','1419.04');
INSERT INTO Machineries VALUES (42,18,'7849','6288','','4','1','5','3101100','Commercial','nulla','3321101','1','1123101','1','3301000','77','89','1','2003-01-4','4','2003-05-8','5','2003-03-15','mollis\r\n sodales\r\n elit\r\n sem\r\n','2002-12-30','631414','347143','Praesent\r\n quis\r\n enim\r\n Etiam\r\n','leo\r\n sit','081888','738','2002-08-7','eu\r\n quam','4','3','2002-12-4','2002-12-24','neque\r\n Duis\r\n id\r\n urna\r\n Nulla','45','80865.59','8247.03','7215.96','7437.40','5564.26','78','670.96');
INSERT INTO Machineries VALUES (43,19,'9587','4051','','4','5','4','1203011','Industrial','Nam','3022111','4','1222100','18','1202111','55','32','5','2002-12-4','4','2002-05-30','5','2002-10-20','posuere\r\n Aliquam\r\n rhoncus\r\n ti','2002-09-1','842211','217434','bibendum\r\n sapien\r\n Nulla\r\n feli','eros\r\n Curabitur','757762','486','2002-12-7','elit\r\n sem','40','18','2003-03-3','2003-04-4','Nam\r\n pretium\r\n magna\r\n id\r\n aug','53','5825.90','5749.42','5217.02','9835.28','8698.52','60','4365.79');
INSERT INTO Machineries VALUES (44,20,'0086','6780','','2','1','4','3310001','Commercial','sollicitudin','1100101','4','3230011','17','1233000','91','38','1','2002-05-17','3','2002-05-31','2','2002-12-3','orci\r\n Etiam\r\n viverra\r\n Nulla\r\n','2002-08-7','796337','154926','tellus\r\n Phasellus\r\n adipiscing\r','dis\r\n parturient','727038','70','2002-05-16','ridiculus\r\n mus','28','19','2002-07-6','2002-10-11','molestie\r\n turpis\r\n ut\r\n neque\r\n','76','16783.34','1472.26','1161.84','2526.02','4205.78','32','1543.52');
INSERT INTO Machineries VALUES (45,20,'7148','7501','','2','3','2','3031010','Commercial','Nullam','1221101','5','2210000','11','2211110','79','25','5','2003-01-17','5','2002-12-21','1','2003-02-14','in\r\n justo\r\n Nam\r\n vel\r\n nunc\r\n','2002-12-27','981865','766271','ut\r\n nulla\r\n Donec\r\n ipsum\r\n ero','dictum\r\n ipsum','114214','419','2003-03-15','Duis\r\n est','14','6','2002-05-29','2003-02-11','et\r\n varius\r\n malesuada\r\n urna\r\n','34','47157.73','3520.30','5434.65','4316.52','8997.12','15','2935.98');
INSERT INTO Machineries VALUES (46,20,'6192','0914','','3','4','5','3020101','Industrial','erat','3201001','4','2210010','16','2121101','89','99','3','2003-04-28','1','2003-01-31','2','2002-07-15','auctor\r\n pharetra\r\n tellus\r\n Pha','2003-01-11','474864','582258','felis\r\n lorem\r\n sollicitudin\r\n e','urna\r\n id','521617','101','2002-08-7','purus\r\n ultricies','33','30','2003-02-26','2002-08-25','semper\r\n lacinia\r\n lorem\r\n Pelle','8','18262.24','7169.97','1353.21','3538.56','7039.32','56','2460.85');
INSERT INTO Machineries VALUES (47,21,'4821','1211','','4','1','4','1011101','Commercial','lacus','3003100','1','2033111','5','2003110','97','14','4','2003-03-19','5','2002-12-10','5','2003-01-14','Nulla\r\n tincidunt\r\n Quisque\r\n tr','2002-10-1','828784','118875','tempor\r\n nec\r\n auctor\r\n eget\r\n v','quis\r\n sem','556847','308','2002-10-7','sollicitudin\r\n vel','10','3','2002-10-15','2002-09-8','Aliquam\r\n molestie\r\n turpis\r\n ut','68','14113.82','2320.56','3235.79','709.23','1013.53','15','4633.07');
INSERT INTO Machineries VALUES (48,22,'0126','9575','','5','4','4','1102111','Industrial','cursus','2001110','1','1003010','7','2213010','28','53','2','2002-11-16','2','2002-10-28','3','2002-09-26','Morbi\r\n feugiat\r\n arcu\r\n sed\r\n p','2003-02-10','199721','569275','dignissim\r\n tempor\r\n Ut\r\n non\r\n','nibh\r\n Nam','245581','543','2002-12-14','vulputate\r\n eu','32','17','2003-04-16','2002-09-30','non\r\n semper\r\n id\r\n turpis\r\n Ali','30','48835.88','8496.81','4129.59','5886.97','3994.49','30','1480.78');
INSERT INTO Machineries VALUES (49,22,'7655','5245','','4','1','5','1322111','Residential','tempor','3210010','4','2332111','20','1332010','71','26','2','2003-01-13','5','2003-04-8','5','2003-02-4','mi\r\n Phasellus\r\n est\r\n Vestibulu','2002-07-23','887686','742136','interdum\r\n ac\r\n felis\r\n In\r\n fer','purus\r\n consectetuer','692470','205','2002-07-11','leo\r\n sit','44','16','2002-08-12','2003-03-19','Pellentesque\r\n nec\r\n magna\r\n Don','87','15921.05','6677.06','756.52','2146.58','4470.56','79','3963.59');
INSERT INTO Machineries VALUES (50,22,'8917','5385','','2','2','2','3211001','Commercial','dapibus','1021000','7','1202011','19','1203110','93','46','3','2002-12-21','1','2003-01-21','2','2003-03-28','congue\r\n Nullam\r\n non\r\n neque\r\n','2002-08-25','461777','363829','et\r\n euismod\r\n quis\r\n vestibulum','penatibus\r\n et','734265','381','2002-05-23','Ut\r\n non','50','1','2002-06-18','2002-10-31','morbi\r\n tristique\r\n senectus\r\n e','42','63736.04','8393.12','9929.68','4707.81','3826.31','25','1579.37');
INSERT INTO Machineries VALUES (51,22,'7937','4546','','4','2','1','1303001','Residential','amet','1021000','2','1211011','3','2333011','69','10','1','2002-12-6','1','2002-11-7','3','2003-04-16','Aenean\r\n velit\r\n neque\r\n iaculis','2002-12-11','865495','981767','Pellentesque\r\n eget\r\n tellus\r\n e','amet\r\n consectetuer','395149','282','2002-07-28','cursus\r\n viverra','47','10','2003-04-18','2003-01-2','Pellentesque\r\n egestas\r\n diam\r\n','21','44060.07','9811.39','9299.11','8113.49','9649.55','71','2635.87');
INSERT INTO Machineries VALUES (52,23,'7572','7921','','3','4','5','3301011','Industrial','sit','1322001','4','1013010','23','1031010','100','44','2','2002-08-31','2','2002-05-14','4','2002-07-19','Etiam\r\n lectus\r\n urna\r\n faucibus','2002-07-17','824767','961261','neque\r\n consequat\r\n non\r\n vulput','consequat\r\n eget','753008','728','2002-09-26','eros\r\n condimentum','7','3','2002-08-31','2002-06-29','ullamcorper\r\n nibh\r\n nunc\r\n cons','9','21024.27','1535.22','7964.54','3892.96','8732.49','34','3259.51');
INSERT INTO Machineries VALUES (53,23,'9259','9777','','1','3','2','1032000','Industrial','felis','2100001','3','3112111','1','2212101','25','43','4','2002-12-13','3','2002-11-18','3','2003-01-23','Vestibulum\r\n ante\r\n ipsum\r\n prim','2002-08-7','888497','752612','dolor\r\n Nunc\r\n volutpat\r\n In\r\n h','sed\r\n ligula','524180','532','2003-01-31','Sed\r\n nec','12','12','2003-04-30','2002-12-16','Nulla\r\n nec\r\n nulla\r\n Ut sem\r\n p','1','91462.74','4505.14','6615.02','9841.88','9502.18','98','2629.61');
INSERT INTO Machineries VALUES (54,24,'6189','1111','','1','3','5','3102000','Residential','vitae','3101010','1','1310010','3','1211110','65','31','3','2002-07-26','1','2003-02-13','5','2003-01-31','ligula\r\n condimentum\r\n posuere\r\n','2003-02-27','136672','942983','velit\r\n ac\r\n nulla\r\n Sed\r\n vitae','molestie\r\n In','735157','120','2003-03-18','in\r\n justo','5','4','2002-07-26','2002-10-7','luctus\r\n justo\r\n Donec\r\n tristiq','27','67053.18','4170.92','3090.86','8150.50','6224.45','91','3528.82');
INSERT INTO Machineries VALUES (55,24,'4171','5316','','5','5','3','2131010','Commercial','vitae','2030110','6','3003011','4','1211101','70','93','1','2003-04-27','3','2002-11-10','5','2002-09-19','tellus\r\n Phasellus\r\n adipiscing\r','2002-09-9','143454','679312','turpis\r\n consectetuer\r\n tristiqu','In\r\n commodo','585799','211','2003-03-30','egestas\r\n Nunc','14','8','2002-12-17','2002-07-12','id\r\n orci\r\n Ut\r\n non\r\n lorem\r\n e','60','23848.73','3755.64','5371.58','9833.40','1791.83','21','4555.95');
INSERT INTO Machineries VALUES (56,24,'2232','2029','','3','2','4','3010001','Residential','aliquet','3210111','5','2221100','12','3212100','84','65','2','2002-08-13','5','2003-01-15','5','2003-03-29','consectetuer\r\n adipiscing\r\n elit','2002-10-18','144929','981541','magna\r\n Donec\r\n interdum\r\n scele','posuere\r\n felis','757916','478','2002-12-14','ac\r\n felis','6','4','2002-11-19','2003-01-2','quis\r\n quam\r\n porta\r\n sodales\r\n','36','53797.56','3418.84','4855.66','1348.58','9807.80','89','2239.12');
INSERT INTO Machineries VALUES (57,25,'9429','9414','','4','2','4','2010000','Residential','pulvinar','2032100','2','2001110','24','2101111','7','14','4','2003-02-18','1','2002-07-28','4','2002-11-23','ut\r\n dapibus\r\n in\r\n fermentum\r\n','2002-11-3','726817','824733','amet\r\n consectetuer\r\n adipiscing','tincidunt\r\n Quisque','927043','816','2002-07-26','Nullam\r\n non','5','4','2002-06-13','2002-09-18','nulla\r\n Nulla\r\n tincidunt\r\n Quis','18','69305.63','8553.77','869.57','2902.61','5788.70','33','2241.52');
INSERT INTO Machineries VALUES (58,25,'1058','6734','','2','1','5','1000010','Residential','sollicitudin','1131111','7','2300101','6','3233110','28','40','1','2002-12-2','5','2003-04-30','4','2002-09-3','Nulla\r\n tempor\r\n justo\r\n et\r\n va','2002-07-15','469897','973522','diam\r\n Fusce\r\n ante\r\n pede\r\n tem','Maecenas\r\n odio','054202','264','2002-05-27','eros\r\n gravida','35','20','2003-04-7','2002-05-15','metus\r\n velit\r\n ac\r\n nulla\r\n Sed','4','76845.14','3396.26','2985.92','4763.09','9323.33','64','2617.99');
INSERT INTO Machineries VALUES (59,25,'8230','6057','','2','1','3','3312011','Commercial','wisi','1201100','3','2032000','21','1313000','62','8','1','2002-06-20','4','2003-04-28','2','2002-09-30','tempor\r\n Ut\r\n non\r\n erat\r\n nec\r\n','2003-04-22','666263','839811','dictumst\r\n Ut\r\n euismod\r\n enim\r\n','dictum\r\n dictum','415392','531','2002-09-17','eu\r\n quam','21','17','2002-10-3','2002-10-31','eros\r\n condimentum\r\n malesuada\r\n','68','41924.86','8157.69','4241.52','6907.33','4269.46','7','1292.05');
INSERT INTO Machineries VALUES (60,26,'4451','2568','','2','4','2','2222100','Industrial','risus','3202100','3','1121011','12','1032011','40','71','1','2002-11-17','1','2002-07-3','1','2002-07-26','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','2003-03-25','286141','969269','consectetuer\r\n commodo\r\n Etiam\r\n','Morbi\r\n feugiat','195984','829','2003-03-12','sollicitudin\r\n vulputate','30','23','2002-06-5','2003-03-4','ac\r\n pretium\r\n ac\r\n pellentesque','74','19533.14','6525.38','5628.49','4334.37','5880.75','62','4670.87');
INSERT INTO Machineries VALUES (61,26,'2712','2312','','4','2','2','1321000','Commercial','ligula','1211111','4','2323111','8','1310001','43','30','4','2003-03-20','5','2003-04-10','3','2002-05-20','interdum\r\n ac\r\n felis\r\n In\r\n fer','2002-11-25','852728','668126','enim\r\n Ut\r\n sit\r\n amet\r\n libero\r','lacus\r\n Duis','014700','103','2002-11-14','Pellentesque\r\n habitant','12','9','2002-10-12','2003-02-21','Donec\r\n ipsum\r\n eros\r\n gravida\r\n','90','73884.10','2302.51','1629.52','5417.36','9612.87','88','4614.45');
INSERT INTO Machineries VALUES (62,26,'1829','0174','','1','2','4','1023011','Residential','commodo','2231011','3','1201111','8','3212011','5','25','5','2002-08-30','3','2002-11-25','2','2002-07-3','faucibus\r\n orci\r\n luctus\r\n et\r\n','2003-01-11','518562','246835','euismod\r\n Sed\r\n et\r\n velit\r\n In\r','Nulla\r\n laoreet','283968','331','2002-11-8','fringilla\r\n tempor','27','15','2003-02-7','2002-12-19','in\r\n justo\r\n Nam\r\n vel\r\n nunc\r\n','7','59644.75','4919.70','1406.92','1421.67','4294.90','61','4924.69');
INSERT INTO Machineries VALUES (63,27,'2334','6218','','5','3','2','1033010','Industrial','laoreet','3332000','6','3121001','4','2001000','49','60','5','2002-09-23','4','2003-03-31','4','2002-09-30','Phasellus\r\n est\r\n Vestibulum\r\n s','2002-09-11','157211','154915','senectus\r\n et\r\n netus\r\n et\r\n mal','Ut\r\n posuere','996113','57','2003-01-28','eget\r\n vulputate','22','1','2002-10-19','2002-08-4','eros\r\n in\r\n justo\r\n dignissim\r\n','77','89298.71','7968.18','7309.21','3268.56','3209.63','26','688.03');
INSERT INTO Machineries VALUES (64,27,'9465','2364','','3','3','1','1000111','Industrial','orci','1330011','2','3212111','1','2212100','83','94','2','2003-03-11','1','2002-07-16','3','2002-11-6','posuere\r\n commodo\r\n justo\r\n Phas','2002-09-8','481569','677947','porttitor\r\n sagittis\r\n Fusce\r\n s','pulvinar\r\n mi','126418','946','2003-02-23','Quisque\r\n diam','12','7','2002-11-22','2003-02-19','euismod\r\n Sed\r\n et\r\n velit\r\n In\r','33','39370.87','4065.47','7660.57','6502.15','9081.25','66','331.38');
INSERT INTO Machineries VALUES (65,27,'5718','2549','','5','5','2','2032100','Commercial','id','3302001','2','1001101','11','3032011','51','21','3','2003-04-5','1','2002-10-8','3','2002-07-9','Mauris\r\n dictum\r\n ipsum\r\n sed\r\n','2003-01-2','853334','271894','quis\r\n quam\r\n porta\r\n sodales\r\n','sit\r\n amet','826386','155','2002-06-6','In\r\n et','8','2','2002-10-5','2002-10-20','velit\r\n In\r\n sit\r\n amet\r\n augue\r','48','50626.27','8573.19','6302.20','804.86','3597.12','60','3491.43');
INSERT INTO Machineries VALUES (66,28,'5152','4806','','3','3','5','2133010','Commercial','odio','3320001','6','2013101','14','2010100','99','44','1','2002-09-16','4','2002-05-31','3','2003-02-19','placerat\r\n vel\r\n pharetra\r\n nec\r','2003-03-2','885126','576778','urna\r\n Nullam\r\n molestie\r\n neque','arcu\r\n sed','849715','857','2002-12-6','penatibus\r\n et','44','5','2003-04-28','2002-06-17','vulputate\r\n et\r\n enim\r\n In\r\n ris','23','61069.10','7841.44','5886.97','1408.17','5845.21','38','394.83');
INSERT INTO Machineries VALUES (67,28,'3640','5229','','4','3','5','3300011','Commercial','potenti','3012111','7','3331010','5','2020101','93','92','3','2003-04-30','2','2002-09-6','4','2002-06-17','luctus\r\n congue\r\n Nullam\r\n non\r\n','2002-09-22','451526','253951','tristique\r\n senectus\r\n et\r\n netu','hac\r\n habitasse','295817','288','2002-10-14','Sed\r\n eget','26','21','2003-05-5','2002-10-31','eleifend\r\n quam\r\n vel\r\n rhoncus\r','14','32221.18','3434.52','1783.40','7561.25','2928.58','21','3761.78');
INSERT INTO Machineries VALUES (68,28,'1789','5924','','3','5','5','2222100','Industrial','sodales','2031000','5','3010110','12','2200010','80','0','1','2002-10-13','4','2003-02-15','5','2003-01-12','et\r\n risus\r\n nec\r\n arcu\r\n adipis','2002-09-26','332116','191899','non\r\n erat\r\n Suspendisse\r\n tempu','eu\r\n leo','833696','790','2003-03-3','nulla\r\n ac','38','28','2003-04-27','2002-07-9','auctor\r\n eget\r\n vulputate\r\n et\r\n','9','20754.79','4450.14','1096.50','3129.48','4959.79','94','3358.27');
INSERT INTO Machineries VALUES (69,29,'7150','0092','','3','2','2','2233000','Industrial','mauris','3033100','1','1113000','23','3010001','52','14','1','2003-03-15','3','2002-12-5','5','2002-06-13','sollicitudin\r\n sit\r\n amet\r\n nisl','2003-03-4','852432','243934','nec\r\n neque\r\n luctus\r\n congue\r\n','ante\r\n ipsum','760474','533','2003-01-7','Nulla\r\n felis','44','44','2002-07-8','2002-08-8','luctus\r\n justo\r\n Donec\r\n tristiq','32','59472.61','766.77','4064.17','2008.89','6386.98','62','2918.27');
INSERT INTO Machineries VALUES (70,30,'7894','9553','','5','2','3','1311010','Commercial','velit','1312100','3','2230000','15','1123001','32','52','5','2002-08-18','2','2003-01-1','1','2002-06-2','dapibus\r\n ipsum\r\n nulla\r\n ac\r\n f','2002-12-18','728817','574272','velit\r\n ac\r\n nulla\r\n Sed\r\n vitae','wisi\r\n sit','002986','865','2003-01-22','euismod\r\n quis','36','23','2002-06-5','2003-01-11','vitae\r\n nulla\r\n Nulla\r\n tincidun','43','84426.06','2934.05','3818.78','1345.53','4275.16','50','1783.90');
INSERT INTO Machineries VALUES (71,30,'5432','6054','','2','4','5','3320010','Residential','ultricies','1321111','5','3220110','20','1322101','14','57','4','2003-02-11','4','2002-11-21','3','2003-03-1','fames\r\n ac\r\n turpis\r\n egestas\r\n','2002-10-5','755893','913352','diam\r\n Nam\r\n semper\r\n lacinia\r\n','Nam\r\n est','741153','843','2003-05-3','posuere\r\n euismod','16','9','2002-07-26','2002-08-29','sapien\r\n purus\r\n consectetuer\r\n','75','37518.57','2677.13','6198.83','2463.78','9204.07','76','112.11');
INSERT INTO Machineries VALUES (72,31,'4227','1411','','4','1','3','3312110','Industrial','elementum','1231010','4','3122011','25','3331001','6','46','2','2002-10-18','5','2002-11-19','1','2003-04-4','urna\r\n Nullam\r\n molestie\r\n neque','2002-09-16','688887','576733','congue\r\n Nullam\r\n non\r\n neque\r\n','vulputate\r\n Nullam','712784','966','2002-08-23','velit\r\n porta','47','31','2002-10-18','2002-07-18','tellus\r\n eu\r\n velit\r\n posuere\r\n','45','99449.80','2946.44','4447.86','8985.58','7473.97','62','34.91');
INSERT INTO Machineries VALUES (73,31,'5634','7145','','5','2','5','2220011','Industrial','commodo','2320111','7','2211111','2','1200010','22','32','4','2003-03-15','5','2003-01-8','1','2002-09-17','Pellentesque\r\n sed\r\n purus\r\n eu\r','2002-07-30','356433','512121','nulla\r\n cursus\r\n viverra\r\n In\r\n','posuere\r\n commodo','263106','34','2003-01-30','penatibus\r\n et','39','6','2002-08-30','2002-08-29','lorem\r\n viverra\r\n id\r\n ornare\r\n','20','43558.14','7061.16','4663.47','6292.33','8691.92','19','1454.95');
INSERT INTO Machineries VALUES (74,31,'5068','4843','','2','3','1','2232111','Commercial','et','2120100','2','2203100','21','3120011','35','46','4','2002-05-19','1','2002-10-31','1','2003-01-19','quam\r\n porta\r\n sodales\r\n Fusce\r\n','2003-04-17','931235','767873','et\r\n malesuada\r\n fames\r\n ac\r\n tu','vel\r\n rhoncus','906777','246','2003-05-8','lectus\r\n consectetuer','11','2','2002-11-6','2003-01-1','Nam\r\n est\r\n nulla\r\n sollicitudin','81','30819.88','6167.97','8632.28','8162.92','1757.29','14','4707.89');
INSERT INTO Machineries VALUES (75,32,'9500','4157','','5','3','4','1133101','Industrial','Lorem','1323010','6','2032000','23','1220111','88','87','4','2002-08-26','5','2002-10-18','2','2002-08-27','nulla\r\n consequat\r\n quis\r\n pulvi','2002-09-17','772794','515439','Duis\r\n sit\r\n amet\r\n enim\r\n Ut\r\n','nascetur\r\n ridiculus','013022','396','2002-09-26','pellentesque\r\n et','20','20','2003-02-27','2002-11-22','eu\r\n wisi\r\n Lorem\r\n ipsum\r\n dolo','47','50180.69','5493.25','6979.05','1807.79','9582.37','26','785.50');
INSERT INTO Machineries VALUES (76,32,'7678','1104','','2','2','3','3103010','Industrial','sodales','2323001','1','1320101','19','2323100','14','100','2','2002-11-30','1','2003-01-7','3','2003-04-5','ante\r\n ligula\r\n ornare\r\n ut\r\n da','2002-09-20','855594','128825','Fusce\r\n aliquam\r\n Morbi\r\n rhoncu','Phasellus\r\n est','323578','220','2002-05-29','amet\r\n dapibus','25','1','2003-01-7','2002-11-23','elit\r\n Nam\r\n ac\r\n dolor\r\n quis\r\n','72','78397.32','2935.32','4177.49','1740.11','8738.75','48','2603.24');
INSERT INTO Machineries VALUES (77,32,'0085','4825','','5','1','3','2221111','Residential','nunc','3033010','5','2012010','32','1130001','55','12','1','2002-09-26','4','2002-10-3','5','2002-12-19','euismod\r\n pharetra\r\n nunc\r\n Aene','2002-11-3','593496','153917','eget\r\n elit\r\n Mauris\r\n dictum\r\n','sit\r\n amet','921083','571','2002-09-1','nec\r\n laoreet','1','1','2003-01-29','2002-07-27','sit\r\n amet\r\n nisl\r\n Nulla\r\n quis','34','95179.80','9072.98','3713.83','9417.82','9054.61','18','2611.31');
INSERT INTO Machineries VALUES (78,33,'0489','7194','','5','4','3','3332111','Residential','mattis','1011011','4','1032110','27','2100010','89','51','1','2002-08-8','5','2003-02-23','1','2003-05-3','nulla\r\n consequat\r\n quis\r\n pulvi','2002-06-26','735926','777892','vestibulum\r\n ac\r\n est\r\n Pellente','Phasellus\r\n est','839129','124','2002-06-3','Nulla\r\n felis','48','24','2003-03-19','2002-10-20','adipiscing\r\n tincidunt\r\n Donec\r\n','83','44375.56','9591.39','2759.77','6195.21','8869.75','24','786.76');
INSERT INTO Machineries VALUES (79,33,'9852','5893','','3','3','2','2330010','Residential','In','2021111','2','2302001','6','3121011','6','74','4','2002-12-22','1','2002-06-23','4','2003-02-10','turpis\r\n nisl\r\n consequat\r\n eget','2002-10-13','247922','423883','scelerisque\r\n ipsum\r\n in\r\n phare','Proin\r\n sollicitudin','835491','291','2002-12-2','egestas\r\n Nunc','16','4','2002-11-19','2003-01-18','amet\r\n pede Suspendisse\r\n potent','30','81472.91','865.88','1139.85','8484.23','9709.97','64','4787.54');
INSERT INTO Machineries VALUES (80,33,'8591','8759','','4','5','4','2013001','Industrial','in','2121100','1','1031100','20','3122111','83','37','2','2002-09-26','4','2002-10-13','2','2003-01-13','posuere\r\n metus\r\n velit\r\n ac\r\n n','2003-03-20','664385','189969','ac\r\n turpis\r\n egestas\r\n Praesent','lorem\r\n viverra','441360','344','2002-07-26','aliquet\r\n ac','9','2','2003-04-10','2002-07-30','odio\r\n pede\r\n auctor\r\n vel\r\n sem','26','47777.51','8125.44','5137.17','9885.63','2897.55','83','2029.61');
INSERT INTO Machineries VALUES (81,34,'5870','5702','','1','5','3','2101010','Residential','molestie','2303010','7','2310000','30','3020101','19','64','5','2003-03-3','4','2003-02-6','4','2002-05-30','sodales\r\n Etiam\r\n lectus\r\n urna\r','2002-05-20','531172','275424','dictumst\r\n Cum\r\n sociis\r\n natoqu','at\r\n ipsum','439389','389','2002-11-25','nec\r\n ligula','13','6','2002-12-27','2002-08-21','magnis\r\n dis\r\n parturient\r\n mont','53','2906.89','5236.28','5160.31','1617.69','5767.31','30','603.43');
INSERT INTO Machineries VALUES (82,34,'6896','1387','','4','2','1','2112100','Residential','velit','3110100','3','2112001','11','1331011','65','98','3','2002-10-21','3','2003-04-20','5','2002-10-14','tristique\r\n Quisque\r\n interdum\r\n','2003-04-23','181621','144413','felis\r\n lorem\r\n sollicitudin\r\n e','Nulla\r\n nec','682121','980','2002-06-25','ut\r\n neque','43','27','2002-11-10','2002-07-27','erat\r\n nec\r\n mi\r\n euismod\r\n ferm','84','13861.24','3902.52','8305.58','7451.40','6410.20','31','4408.95');
INSERT INTO Machineries VALUES (83,35,'8269','8028','','4','5','4','2010111','Residential','non','3003010','1','1313001','6','1310010','41','60','5','2002-09-22','5','2002-11-29','1','2002-05-19','Vivamus\r\n feugiat\r\n pede\r\n vitae','2002-08-20','483828','914716','eget\r\n elit\r\n Mauris\r\n dictum\r\n','gravida\r\n non','153524','294','2003-02-24','magna\r\n nec','18','11','2002-10-1','2003-02-9','Nunc\r\n volutpat\r\n In\r\n hac\r\n hab','50','44220.60','2159.19','1056.17','2776.70','7559.34','64','2219.76');
INSERT INTO Machineries VALUES (84,35,'2600','6257','','4','4','2','2213100','Residential','ut','1212110','7','2211001','35','3121100','32','22','1','2003-02-3','2','2002-08-24','4','2002-05-22','ipsum\r\n Pellentesque\r\n habitant\r','2002-07-3','774511','448666','dictumst\r\n Curabitur\r\n imperdiet','ultrices\r\n malesuada','082423','281','2002-08-13','sit\r\n amet','6','3','2003-05-6','2002-12-10','mi\r\n Phasellus\r\n est\r\n Vestibulu','8','77229.47','2564.07','8425.01','9184.32','4644.99','44','2295.22');
INSERT INTO Machineries VALUES (85,35,'1966','8804','','2','5','3','3113000','Industrial','ortor','1002101','6','2123101','20','3231000','63','42','2','2002-12-11','2','2003-03-25','4','2002-11-1','malesuada\r\n fames\r\n ac\r\n turpis\r','2002-10-17','964937','213325','In\r\n malesuada\r\n leo\r\n vitae\r\n m','elit\r\n sem','735877','388','2003-01-3','Lorem\r\n ipsum','12','10','2002-11-25','2003-04-18','turpis\r\n egestas\r\n Praesent\r\n qu','47','29185.78','4759.61','791.91','2052.12','9882.53','64','1602.10');
INSERT INTO Machineries VALUES (86,36,'3634','3559','1','2','5','2','3212110','Commercial','ac','2312100','4','2320101','16','3320101','85','86','5','2003-02-3','5','2002-09-5','1','2002-08-22','Donec\r\n vitae\r\n nulla\r\n Nulla\r\n','2003-01-26','325739','325719','dui\r\n Phasellus\r\n cursus\r\n justo','feugiat\r\n arcu','820881','671','2003-04-1','amet\r\n consectetuer','29','13','2002-08-20','2002-12-15','justo\r\n Nam\r\n vel\r\n nunc\r\n eu\r\n','46','62050.10','4392.22','3055.07','6149.03','3685.76','20','2030.39');
INSERT INTO Machineries VALUES (87,36,'6892','2628','1','5','1','4','1300001','Residential','ligula','2202011','6','2132110','19','1220010','63','20','3','2002-10-14','5','2003-05-8','1','2002-08-14','Sed\r\n eget\r\n elit\r\n Mauris\r\n dic','2002-09-8','495699','862186','sed\r\n diam\r\n Nam\r\n semper\r\n laci','et\r\n erat','301754','477','2002-07-23','vitae\r\n nisl','48','46','2002-06-24','2002-08-29','in\r\n justo\r\n Nam\r\n vel\r\n nunc\r\n','31','53812.10','1621.00','8125.96','6094.76','9049.36','95','2843.17');
INSERT INTO Machineries VALUES (88,37,'7970','4489','2','3','2','4','2223110','Commercial','eu','2023100','3','3030000','5','1103101','44','44','2','2003-01-14','4','2003-02-24','2','2002-06-12','sodales\r\n Fusce\r\n aliquam\r\n Morb','2002-10-2','993573','246859','vel\r\n turpis\r\n Vestibulum\r\n ante','Morbi\r\n rhoncus','161376','345','2003-01-30','consectetuer\r\n mauris','18','1','2002-08-31','2003-01-16','neque\r\n Nam\r\n justo\r\n nulla\r\n co','49','39874.98','9643.47','5836.62','4427.16','4978.62','91','3506.36');
INSERT INTO Machineries VALUES (89,38,'8724','2719','2','3','3','4','2222100','Industrial','viverra','1131000','5','2332100','20','2310101','33','64','3','2002-07-9','4','2002-09-14','2','2003-01-22','Aenean\r\n velit\r\n neque\r\n iaculis','2002-06-5','669127','245771','quam\r\n metus\r\n convallis\r\n ac\r\n','Fusce\r\n aliquam','967130','647','2003-03-14','Nulla\r\n tincidunt','28','8','2002-12-12','2002-05-18','nec\r\n dui\r\n Phasellus\r\n cursus\r\n','87','51836.32','3765.38','4198.08','5472.97','7281.71','51','2812.05');
INSERT INTO Machineries VALUES (90,38,'2668','3890','2','1','2','2','2130011','Industrial','placerat','2333111','7','1001010','16','2123011','49','99','4','2002-10-28','1','2002-08-5','3','2002-09-13','elit\r\n Nunc\r\n bibendum\r\n turpis\r','2002-08-30','271715','292779','nascetur\r\n ridiculus\r\n mus\r\n Pel','Aliquam\r\n nulla','903892','511','2002-10-16','ac\r\n pellentesque','23','7','2003-01-8','2002-10-19','nulla\r\n Sed\r\n vitae\r\n erat\r\n sit','67','68981.17','3427.13','7044.59','5655.92','3414.00','10','3775.31');
INSERT INTO Machineries VALUES (91,38,'9897','2709','2','2','1','1','3100011','Commercial','pharetra','1331101','6','1000101','23','1222100','70','73','1','2002-07-15','2','2002-10-20','1','2002-12-21','auctor\r\n pharetra\r\n tellus\r\n Pha','2002-07-5','832299','152838','tristique\r\n metus\r\n elementum\r\n','erat\r\n lacinia','296742','303','2003-03-23','Vestibulum\r\n sed','2','1','2002-09-2','2003-04-8','non\r\n lorem\r\n et\r\n lectus\r\n cons','67','87991.85','6884.25','5594.00','8292.45','4087.74','26','2826.53');
INSERT INTO Machineries VALUES (92,39,'6876','1246','1','1','2','2','1021100','Industrial','magnis','3330001','7','1020110','12','3010011','30','30','1','2003-01-31','3','2003-04-26','5','2002-11-17','sit\r\n amet\r\n consectetuer\r\n adip','2003-04-25','855637','557666','pharetra\r\n tellus\r\n Phasellus\r\n','In\r\n hac','609548','148','2002-09-7','amet\r\n est','24','15','2002-09-9','2002-09-24','magnis\r\n dis\r\n parturient\r\n mont','42','14136.92','8819.85','5651.07','1663.65','5691.43','45','1357.98');
INSERT INTO Machineries VALUES (93,39,'1132','2336','1','3','2','1','3331110','Residential','Ut','3223000','2','3232110','8','1000100','58','76','4','2002-06-21','5','2002-08-7','2','2002-06-4','Ut\r\n posuere\r\n commodo\r\n justo\r\n','2002-11-27','268779','882659','metus\r\n nec\r\n neque\r\n luctus\r\n c','dictumst\r\n Ut','685917','93','2002-11-1','In\r\n malesuada','36','14','2002-06-8','2002-09-20','Pellentesque\r\n quis\r\n pede\r\n et\r','54','22527.27','9585.15','3019.07','1841.22','1963.25','23','141.39');
INSERT INTO Machineries VALUES (94,40,'6502','7269','3','3','3','2','1212001','Residential','vitae','3233000','5','1000011','40','1131101','8','48','3','2002-12-31','2','2003-01-31','3','2002-12-5','sit\r\n amet\r\n enim\r\n Ut\r\n sit\r\n a','2002-06-6','154935','294721','justo\r\n ut\r\n lectus\r\n Cras\r\n vol','laoreet\r\n eget','899666','989','2002-08-23','pretium\r\n magna','26','8','2003-02-17','2002-07-8','massa\r\n Donec\r\n fringilla\r\n Done','53','68254.26','3738.91','6770.43','3780.22','3399.93','70','157.73');
INSERT INTO Machineries VALUES (95,40,'8252','1398','3','1','2','5','2330101','Commercial','id','1011001','3','2130010','3','2013001','89','46','3','2002-11-23','3','2002-08-31','4','2002-11-16','vel\r\n turpis\r\n consectetuer\r\n tr','2002-05-25','595738','454511','eget\r\n elit\r\n Mauris\r\n dictum\r\n','sit\r\n amet','655913','972','2002-09-13','quis\r\n quam','16','4','2003-02-26','2002-07-29','elementum\r\n Integer\r\n metus\r\n In','54','16519.12','9009.34','9998.56','9690.61','9394.02','89','2252.80');
INSERT INTO Machineries VALUES (96,41,'4013','2809','1','1','5','5','2020110','Industrial','vel','3330001','4','2320100','32','1013101','66','21','4','2003-02-20','2','2002-11-13','2','2003-05-7','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','2002-11-9','367935','357984','posuere\r\n Aliquam\r\n rhoncus\r\n ti','Aliquam\r\n rhoncus','367281','446','2002-05-30','dolor\r\n quis','50','21','2002-08-18','2003-04-4','neque\r\n luctus\r\n congue\r\n Nullam','82','69140.71','9208.05','9916.32','1701.61','6588.41','8','3398.24');
INSERT INTO Machineries VALUES (97,41,'9569','2526','1','2','1','4','3311001','Commercial','elementum','3123110','6','1200011','15','2302101','15','46','3','2002-06-1','2','2003-05-8','4','2003-05-8','Pellentesque\r\n habitant\r\n morbi\r','2003-05-9','596583','132337','In\r\n fermentum\r\n Nam\r\n id\r\n urna','vel\r\n risus','432487','631','2002-06-19','ipsum\r\n dolor','45','21','2002-07-1','2003-02-16','posuere\r\n fermentum\r\n Lorem\r\n ip','65','76919.08','2752.16','6907.77','1663.68','2995.43','6','3681.99');
INSERT INTO Machineries VALUES (98,41,'6825','1209','4','4','5','5','1200010','Residential','pede Suspendisse','1011001','5','3330010','4','3102010','42','47','5','2003-01-16','1','2002-10-15','2','2002-11-28','eu\r\n quam\r\n scelerisque\r\n pulvin','2003-03-1','189476','954665','morbi\r\n tristique\r\n senectus\r\n e','ac\r\n felis','223326','136','2003-01-2','turpis\r\n nisl','15','2','2002-07-11','2002-06-19','cursus\r\n justo\r\n in\r\n urna\r\n Nul','51','13721.97','543.04','1286.28','6958.22','2615.96','21','507.45');
INSERT INTO Machineries VALUES (99,41,'6157','0517','1','5','3','1','2020100','Industrial','nonummy','3302011','5','1030010','3','1320000','12','81','1','2003-02-2','2','2002-10-28','1','2003-03-2','in\r\n volutpat\r\n ac\r\n sapien\r\n Mo','2002-07-28','657197','768287','et\r\n euismod\r\n quis\r\n vestibulum','nulla\r\n cursus','587826','682','2002-08-19','amet\r\n pede Suspendisse','22','7','2003-03-18','2002-07-29','pede\r\n tempor\r\n nec\r\n auctor\r\n e','29','82142.64','9540.59','3102.48','8190.35','4655.07','85','4456.88');
INSERT INTO Machineries VALUES (100,42,'8284','2389','6','1','2','2','2301000','Commercial','congue','2023010','3','2202100','33','2120010','69','31','2','2002-06-3','2','2002-11-19','5','2002-12-28','arcu\r\n sed\r\n diam\r\n Nam\r\n semper','2003-03-14','245789','813137','quis\r\n ligula\r\n vel\r\n turpis\r\n c','consectetuer\r\n adipiscing','088797','251','2002-05-18','ipsum\r\n dolor','40','36','2003-01-20','2003-05-10','justo\r\n Donec\r\n tristique\r\n metu','59','18354.14','2659.28','7921.86','1684.36','5966.30','7','1468.82');
INSERT INTO Machineries VALUES (101,43,'4150','7205','3','1','1','2','2312101','Industrial','justo','3022011','7','2102010','26','1030110','5','74','4','2002-10-21','5','2002-11-25','1','2002-10-10','vitae\r\n molestie\r\n volutpat\r\n ma','2003-04-29','965965','422215','lacus\r\n Nam\r\n est\r\n nulla\r\n soll','potenti\r\n Nulla','754055','337','2002-09-17','sit\r\n amet','9','6','2002-11-27','2002-09-10','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','87','69188.28','3312.85','4442.30','9357.49','4903.50','43','186.94');
INSERT INTO Machineries VALUES (102,43,'9423','6235','5','4','2','4','2212110','Commercial','commodo','1023101','6','2313010','33','3301110','92','88','3','2002-08-21','3','2002-06-13','2','2003-04-8','In\r\n fermentum\r\n Nam\r\n id\r\n urna','2003-04-29','442439','955855','nisl\r\n eu\r\n wisi\r\n Lorem\r\n ipsum','mi\r\n euismod','077828','51','2002-09-8','iaculis\r\n ut','45','34','2002-10-30','2002-07-5','eu\r\n interdum\r\n ac\r\n felis\r\n In\r','23','15241.55','962.89','6550.78','805.82','7032.69','95','4169.27');
INSERT INTO Machineries VALUES (103,43,'5252','5585','3','5','2','1','3133011','Industrial','quis','2021101','7','3023100','39','1323010','46','80','3','2003-01-5','4','2002-10-27','5','2002-12-4','Nulla\r\n quis\r\n ligula\r\n vel\r\n tu','2002-09-21','443111','468733','amet\r\n consectetuer\r\n adipiscing','et\r\n molestie','962172','393','2002-10-12','ut\r\n nonummy','21','13','2003-01-4','2002-10-8','sit\r\n amet\r\n consectetuer\r\n adip','42','97746.39','7047.28','4396.58','4489.71','5349.83','48','2796.34');
INSERT INTO Machineries VALUES (104,43,'4808','3461','2','2','5','5','2303001','Industrial','dictum','1231111','2','3010000','28','2032010','99','7','2','2002-08-27','2','2002-09-8','1','2003-02-20','tristique\r\n metus\r\n elementum\r\n','2002-11-5','544973','638167','tempor\r\n Ut\r\n non\r\n erat\r\n nec\r\n','Pellentesque\r\n quis','503451','154','2002-07-9','purus\r\n et','38','33','2002-12-5','2002-12-18','elit\r\n Cras\r\n porttitor\r\n pulvin','13','58503.67','1809.54','6273.38','6664.53','5743.36','75','3233.83');
INSERT INTO Machineries VALUES (105,44,'1413','8889','2','2','1','1','3100010','Industrial','nonummy','3132100','5','3301111','1','1213010','41','50','2','2002-10-15','3','2002-12-25','3','2002-06-19','ac\r\n felis\r\n In\r\n fermentum\r\n Na','2003-04-30','418543','524791','sapien\r\n purus\r\n consectetuer\r\n','et\r\n magnis','532209','103','2002-06-4','Nulla\r\n nec','33','30','2003-03-29','2002-06-26','ipsum\r\n Aliquam\r\n eget\r\n ligula\r','37','47334.45','7779.13','7659.05','6462.39','5913.81','25','198.09');
INSERT INTO Machineries VALUES (106,44,'5206','8957','5','1','1','1','2222101','Residential','posuere','3121100','5','3330011','31','3322100','56','14','2','2003-03-15','5','2003-01-15','2','2002-07-16','turpis\r\n egestas\r\n Nunc\r\n non\r\n','2002-06-18','888477','162824','non\r\n risus\r\n nec\r\n enim\r\n ultri','Etiam\r\n sit','449999','836','2002-06-1','sit\r\n amet','34','22','2002-07-6','2003-04-12','metus\r\n elementum\r\n nibh\r\n Etiam','73','47974.85','2488.55','9574.35','6176.18','8147.64','27','402.84');
INSERT INTO Machineries VALUES (107,45,'7166','1080','4','3','3','4','3013111','Industrial','Nulla','3312111','1','2131111','44','2320001','18','57','5','2002-09-14','1','2002-11-3','3','2002-10-29','dictumst\r\n Curabitur\r\n imperdiet','2003-03-24','861878','644175','Pellentesque\r\n sed\r\n purus\r\n eu\r','ipsum\r\n Pellentesque','961132','951','2002-07-29','elementum\r\n dignissim','42','7','2003-02-12','2002-12-13','condimentum\r\n malesuada\r\n Mauris','44','25931.84','6458.92','8371.61','5919.13','3767.90','4','528.71');
INSERT INTO Machineries VALUES (108,46,'0901','1625','5','2','5','2','3203111','Residential','sodales','2122001','4','1331011','36','1310000','48','93','2','2002-09-18','1','2003-01-2','4','2002-10-18','condimentum\r\n malesuada\r\n Mauris','2002-08-18','454144','123489','elementum\r\n Integer\r\n metus\r\n In','fermentum\r\n et','694668','384','2003-04-2','lacus\r\n id','50','30','2002-07-12','2002-07-30','consequat\r\n non\r\n vulputate\r\n eu','39','43452.77','9883.17','5277.59','4268.79','1405.42','77','138.02');
INSERT INTO Machineries VALUES (109,46,'1338','6363','6','1','3','2','2020011','Commercial','et','3322000','6','1020010','24','2121101','76','58','5','2002-11-26','3','2002-07-16','2','2003-03-22','Nunc\r\n volutpat\r\n In\r\n hac\r\n hab','2002-05-30','966594','295814','id\r\n eros\r\n condimentum\r\n malesu','dis\r\n parturient','098149','192','2002-12-24','Phasellus\r\n sollicitudin','12','9','2002-11-8','2002-11-7','nunc\r\n Aenean\r\n interdum\r\n lobor','40','1867.68','5183.86','7329.08','5198.69','2781.56','63','4943.55');
INSERT INTO Machineries VALUES (110,47,'5037','6032','2','5','5','5','2021110','Industrial','nunc','3202111','5','3332010','34','1232001','69','74','4','2002-08-6','1','2003-04-18','3','2002-11-24','Quisque\r\n lorem\r\n nulla\r\n posuer','2002-08-7','727731','551345','Ut\r\n turpis\r\n nisl\r\n consequat\r\n','at\r\n lorem','023964','312','2003-04-4','nisl\r\n sed','38','14','2002-07-11','2003-01-23','eget\r\n pellentesque\r\n et\r\n moles','48','11409.85','4844.77','6849.60','6618.90','9464.96','64','2629.00');
INSERT INTO Machineries VALUES (111,47,'4107','0416','7','2','1','5','3230100','Residential','vitae','3233010','5','2122111','6','2111111','2','38','1','2003-01-29','5','2003-02-27','2','2002-09-9','nec\r\n enim\r\n ultrices\r\n malesuad','2002-06-10','383374','551836','aliquet\r\n luctus\r\n justo\r\n Donec','porta\r\n porta','768674','360','2002-09-28','feugiat\r\n arcu','42','37','2003-03-14','2002-11-20','rhoncus\r\n tincidunt\r\n lacus\r\n Na','5','10923.16','2537.40','5114.74','4612.84','7729.65','87','483.13');
INSERT INTO Machineries VALUES (112,48,'7784','3004','3','5','1','2','2032000','Industrial','pede','2200010','2','1102110','1','1232010','84','31','3','2002-06-4','1','2002-08-14','3','2002-11-17','felis\r\n mi\r\n eleifend\r\n quam\r\n v','2003-04-26','469267','127345','Donec\r\n ipsum\r\n eros\r\n gravida\r\n','pede Suspendisse\r\n potenti','848600','831','2003-01-13','Nulla\r\n felis','45','17','2003-01-10','2003-01-9','eros\r\n condimentum\r\n malesuada\r\n','14','60249.96','7359.70','3244.60','1777.13','2570.14','33','3281.12');
INSERT INTO Machineries VALUES (113,48,'0719','9184','2','5','3','4','1131111','Commercial','euismod','1100110','4','2132000','32','1302100','20','84','1','2003-01-3','1','2002-06-25','5','2003-02-11','turpis\r\n egestas\r\n Praesent\r\n qu','2002-05-30','114137','333238','In\r\n lobortis\r\n magna\r\n sed\r\n do','Duis\r\n sit','775436','687','2003-02-10','non\r\n pellentesque','49','5','2002-11-24','2002-08-22','sed\r\n pulvinar\r\n ullamcorper\r\n n','93','69194.95','8768.66','1162.39','8529.53','5469.87','13','3393.13');
INSERT INTO Machineries VALUES (114,48,'2209','6903','4','2','5','3','3301110','Residential','Maecenas','3322011','3','1220111','17','2130111','59','50','2','2002-08-29','3','2002-10-16','1','2002-05-18','adipiscing\r\n tincidunt\r\n Donec\r\n','2002-11-10','848428','263946','natoque\r\n penatibus\r\n et\r\n magni','nulla\r\n Donec','159421','168','2003-04-23','massa\r\n velit','49','39','2003-03-20','2002-06-6','laoreet\r\n sem\r\n blandit\r\n ipsum\r','81','44173.02','4460.58','4415.52','5921.65','8366.51','93','1023.76');
INSERT INTO Machineries VALUES (115,49,'0117','2851','9','2','4','4','2032000','Commercial','sit','1233100','2','3202101','28','1023111','70','12','1','2002-06-25','5','2002-06-18','2','2002-06-4','sociis\r\n natoque\r\n penatibus\r\n e','2003-02-16','264798','286737','Sed\r\n nec\r\n dui\r\n Phasellus\r\n cu','habitasse\r\n platea','672390','29','2002-07-14','Nunc\r\n vulputate','1','1','2002-05-23','2002-05-19','Duis\r\n id\r\n urna\r\n Nullam\r\n magn','92','66849.42','2718.25','8063.45','7110.35','4503.48','94','4297.09');
INSERT INTO Machineries VALUES (116,49,'1639','2109','5','5','2','1','3010011','Residential','leo','2021101','4','2111000','47','1101000','21','39','4','2003-01-14','2','2002-07-12','3','2002-11-17','natoque\r\n penatibus\r\n et\r\n magni','2002-11-10','719833','195848','commodo\r\n nec\r\n convallis\r\n in\r\n','quam\r\n metus','558656','567','2003-03-3','Donec\r\n vulputate','47','11','2002-07-13','2003-02-9','et\r\n mi\r\n Lorem\r\n ipsum\r\n dolor\r','4','32744.75','4590.44','7766.08','4318.15','6841.90','51','2709.83');
INSERT INTO Machineries VALUES (117,49,'6817','0709','11','3','1','4','2231000','Commercial','Donec','2212001','7','1221100','45','2020010','99','27','2','2003-05-2','2','2002-06-25','5','2003-04-29','fames\r\n ac\r\n turpis\r\n egestas\r\n','2002-12-13','733643','851276','turpis\r\n egestas\r\n Praesent\r\n qu','ac\r\n sagittis','993249','757','2002-06-28','risus\r\n nec','45','7','2002-10-10','2002-10-27','auctor\r\n eget\r\n vulputate\r\n et\r\n','63','10973.44','9033.32','996.97','7276.84','1725.54','29','912.52');
INSERT INTO Machineries VALUES (118,50,'4913','6950','5','3','2','3','2201101','Residential','Nam','2331110','4','1003000','3','2332011','25','89','4','2003-02-27','4','2003-01-17','2','2002-08-8','felis\r\n In\r\n fermentum\r\n Nam\r\n i','2003-04-4','615247','935651','auctor\r\n eget\r\n vulputate\r\n et\r\n','massa\r\n metus','901253','768','2002-05-12','non\r\n erat','22','15','2002-11-26','2002-09-11','bibendum\r\n turpis\r\n non\r\n sodale','62','43971.97','5596.24','5313.29','8669.61','5217.76','46','4066.43');
INSERT INTO Machineries VALUES (119,50,'0954','9051','1','4','4','5','1302000','Residential','vestibulum','1033101','2','3220101','46','3221100','42','16','2','2003-02-9','3','2003-05-3','4','2002-10-11','lacus\r\n id\r\n eros\r\n condimentum\r','2003-02-1','395899','746111','non\r\n pellentesque\r\n magna\r\n pur','nec\r\n dui','953023','105','2002-12-23','fames\r\n ac','47','3','2002-12-20','2003-02-1','nec\r\n auctor\r\n eget\r\n vulputate\r','96','28469.97','9351.67','3041.16','9292.31','8919.78','99','4068.53');
INSERT INTO Machineries VALUES (120,54,'8790','5526','5','1','2','4','3220101','Commercial','sollicitudin','2232101','2','1001111','4','3021010','95','34','5','2002-05-16','2','2003-02-1','1','2002-09-15','sit\r\n amet\r\n est\r\n fringilla\r\n t','2003-02-18','399132','287662','molestie\r\n In\r\n et\r\n risus\r\n nec','dictumst\r\n Cum','589350','310','2003-01-27','mi\r\n euismod','19','7','2002-10-4','2002-08-3','augue\r\n non\r\n erat\r\n nonummy\r\n s','86','28572.47','4334.75','7043.39','4154.76','3772.41','52','1548.18');
INSERT INTO Machineries VALUES (121,54,'9164','8269','12','4','1','2','2210111','Residential','eget','1032110','7','2320111','32','1323101','94','49','4','2002-08-7','4','2003-03-12','4','2003-02-24','Suspendisse\r\n vestibulum\r\n Ut\r\n','2002-08-28','728347','557143','rhoncus\r\n arcu\r\n sed\r\n diam\r\n Na','nunc\r\n cursus','798010','223','2002-10-15','velit\r\n ac','30','4','2002-07-8','2002-06-18','nec\r\n auctor\r\n eget\r\n vulputate\r','82','68374.68','6643.52','5980.95','3141.27','540.09','38','3295.29');
INSERT INTO Machineries VALUES (122,55,'9528','5331','11','3','5','5','3102100','Industrial','Pellentesque','2110100','4','3033011','38','3001111','95','77','3','2003-01-28','1','2002-09-29','5','2003-01-28','ullamcorper\r\n viverra\r\n Pellente','2003-01-29','464874','174444','pulvinar\r\n in\r\n volutpat\r\n ac\r\n','quam\r\n vel','432133','376','2002-12-20','sollicitudin\r\n et','9','3','2002-08-28','2002-09-9','et\r\n magna\r\n nec\r\n ligula\r\n cond','66','33111.27','749.59','1848.54','8249.07','5209.69','28','2609.55');
INSERT INTO Machineries VALUES (123,56,'6806','0248','10','1','3','1','2100010','Industrial','eget','3221010','2','3112101','45','2102101','8','3','3','2002-11-4','4','2002-12-15','3','2002-07-15','nec\r\n auctor\r\n eget\r\n vulputate\r','2002-07-14','416871','939424','ac\r\n pellentesque\r\n et\r\n ortor\r\n','ac\r\n laoreet','010274','589','2003-01-13','ultrices\r\n posuere','17','6','2002-12-20','2003-02-14','vitae\r\n lacus\r\n id\r\n eros\r\n cond','7','4038.44','5010.77','3539.14','1701.14','7687.41','33','4084.58');
INSERT INTO Machineries VALUES (124,56,'8899','6950','9','2','4','5','2322111','Residential','id','2200000','6','3313010','18','2200111','72','8','5','2002-11-10','5','2002-09-15','4','2002-08-15','justo\r\n Phasellus\r\n sollicitudin','2002-10-5','553113','499753','fermentum\r\n et\r\n mi\r\n Lorem\r\n ip','Nam\r\n quam','078367','655','2003-03-18','vulputate\r\n nisl','35','19','2002-06-2','2002-10-9','Nullam\r\n molestie\r\n neque\r\n non\r','83','40563.96','3123.24','2913.45','9915.04','7511.05','47','1712.83');
INSERT INTO Machineries VALUES (125,56,'1688','1263','18','2','2','1','1112000','Commercial','mollis','2211110','2','1101100','57','2230101','77','27','1','2002-06-16','4','2002-12-20','5','2002-08-29','pulvinar\r\n ullamcorper\r\n nibh\r\n','2003-02-6','669794','826933','odio\r\n neque\r\n consequat\r\n non\r\n','dis\r\n parturient','226592','849','2002-12-14','Sed\r\n nec','18','2','2002-11-10','2002-08-10','vel\r\n turpis\r\n consectetuer\r\n tr','94','27492.72','7522.26','6164.19','6604.47','5285.99','16','4459.92');
INSERT INTO Machineries VALUES (126,56,'3707','4237','10','2','3','1','1122100','Residential','interdum','1320111','1','1031011','10','2333110','11','33','4','2002-06-19','2','2002-12-13','2','2002-09-10','ligula\r\n condimentum\r\n posuere\r\n','2002-07-4','334734','646141','ac\r\n scelerisque\r\n non\r\n semper\r','consectetuer\r\n mauris','341850','120','2002-10-20','sit\r\n amet','26','19','2003-02-28','2002-12-23','gravida\r\n pede\r\n Proin\r\n sollici','3','31951.42','8129.78','9109.73','562.01','9137.03','78','2374.97');
INSERT INTO Machineries VALUES (127,57,'7838','8029','3','1','5','4','2101100','Residential','malesuada','1302001','2','2331000','59','3113100','23','76','4','2002-11-16','3','2002-07-16','5','2002-07-4','luctus\r\n congue\r\n Nullam\r\n non\r\n','2003-02-17','222276','354837','sapien\r\n vehicula\r\n pede\r\n portt','nonummy\r\n at','429984','31','2003-01-23','convallis\r\n ac','20','10','2003-04-2','2002-05-17','Nunc\r\n bibendum\r\n turpis\r\n non\r\n','94','68237.82','2204.31','8457.88','2221.77','9162.30','61','1277.92');
INSERT INTO Machineries VALUES (128,57,'3840','3902','21','3','3','5','2312111','Industrial','id','1321011','4','2303000','40','1230110','20','77','1','2002-07-15','4','2002-08-30','4','2002-10-8','Aenean\r\n interdum\r\n lobortis\r\n n','2002-07-2','131357','225744','amet\r\n est\r\n fringilla\r\n tempor\r','laoreet\r\n non','174067','47','2003-04-3','vulputate\r\n eu','21','6','2003-02-23','2002-07-19','nulla\r\n ac\r\n felis\r\n Suspendisse','44','70490.61','1569.39','2592.23','4484.35','2029.85','73','2371.59');
INSERT INTO Machineries VALUES (129,57,'5659','9896','8','4','2','1','1323100','Residential','vulputate','1000010','4','3313010','70','2111101','22','79','5','2002-07-11','1','2002-10-5','3','2002-12-29','erat\r\n nonummy\r\n sodales\r\n Etiam','2003-04-20','613339','516868','euismod\r\n pharetra\r\n nunc\r\n Aene','nulla\r\n ac','759600','813','2002-06-20','sollicitudin\r\n et','36','33','2002-05-21','2002-07-11','ipsum\r\n In\r\n hac\r\n habitasse\r\n p','50','96965.19','5098.33','4083.41','9109.05','3882.15','24','4682.43');
INSERT INTO Machineries VALUES (130,57,'9384','5705','17','5','3','5','1220110','Industrial','pede','2111001','4','3033110','37','3003011','43','13','4','2002-07-31','4','2002-06-12','4','2002-11-3','Nulla\r\n tincidunt\r\n Quisque\r\n tr','2002-11-7','265672','987787','commodo\r\n justo\r\n Phasellus\r\n so','nulla\r\n Ut sem','387940','32','2003-02-19','ac\r\n turpis','41','3','2002-09-7','2003-02-4','Vivamus\r\n feugiat\r\n pede\r\n vitae','99','86673.91','2069.57','9414.42','3848.40','2910.65','80','4308.22');
INSERT INTO Machineries VALUES (131,58,'0551','8226','4','4','5','3','3113110','Residential','posuere','3302101','1','2100000','34','1001001','6','29','2','2002-08-23','1','2002-10-5','4','2003-01-19','Integer\r\n metus\r\n In\r\n commodo\r\n','2002-06-14','122626','128147','primis\r\n in\r\n faucibus\r\n orci\r\n','Duis\r\n lacus','887001','320','2002-06-9','sollicitudin\r\n et','48','34','2003-01-2','2003-01-25','Donec\r\n ipsum\r\n eros\r\n gravida\r\n','79','38258.29','3589.08','1667.45','2281.22','8518.89','68','3553.75');
INSERT INTO Machineries VALUES (132,58,'2806','1351','25','4','2','3','1201010','Residential','velit','1323010','2','2232100','30','3333111','63','61','5','2002-05-28','2','2002-10-14','5','2003-02-7','Morbi\r\n feugiat\r\n arcu\r\n sed\r\n p','2002-11-3','393224','748985','posuere\r\n vitae\r\n egestas\r\n id\r\n','ultrices\r\n malesuada','450074','566','2002-06-26','dolor\r\n eu','20','10','2003-01-13','2002-08-26','Pellentesque\r\n habitant\r\n morbi\r','53','62634.82','3031.54','6170.62','8806.06','9719.44','11','1209.76');
INSERT INTO Machineries VALUES (133,58,'3724','8218','5','2','2','5','2013100','Residential','urna','3022000','4','3122011','37','3331100','99','83','1','2002-11-7','4','2002-08-4','1','2003-03-30','pede\r\n auctor\r\n vel\r\n semper\r\n a','2002-06-16','261523','159414','posuere\r\n cubilia\r\n Curae\r\n Done','pretium\r\n ac','739668','701','2003-01-18','egestas\r\n Praesent','21','9','2002-07-16','2002-09-19','ipsum\r\n dolor\r\n sit\r\n amet\r\n con','59','75450.30','8227.25','4950.63','8786.87','7277.45','23','4342.03');
INSERT INTO Machineries VALUES (134,58,'9930','8324','7','2','3','5','1301111','Residential','pellentesque','2013110','5','1210000','25','1021100','28','3','5','2002-06-27','3','2002-05-25','4','2003-03-20','mollis\r\n sodales\r\n elit\r\n sem\r\n','2002-08-18','579711','383817','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','velit\r\n leo','869695','396','2002-06-2','Nulla\r\n felis','26','14','2002-08-25','2003-01-10','nonummy\r\n at\r\n ipsum\r\n Pellentes','27','27648.30','6420.12','3312.04','9863.30','6433.50','8','2125.35');
INSERT INTO Machineries VALUES (135,59,'1286','1896','17','1','2','2','2320100','Residential','Nam','1033001','6','2221110','72','3212110','83','65','1','2002-07-4','3','2002-08-22','3','2003-05-1','orci\r\n luctus\r\n et\r\n ultrices\r\n','2002-07-4','238851','149592','ornare\r\n ut\r\n dapibus\r\n in\r\n fer','laoreet\r\n purus','874001','495','2002-11-23','ac\r\n aliquet','16','2','2002-12-9','2003-02-25','tellus\r\n Phasellus\r\n adipiscing\r','44','78320.75','4027.30','2099.77','6828.24','1122.13','89','1498.12');
INSERT INTO Machineries VALUES (136,59,'5397','0276','11','2','2','4','3130001','Commercial','nulla','3013101','5','2030010','25','2302110','36','9','3','2003-03-7','5','2002-08-30','4','2003-01-27','sagittis\r\n sit\r\n amet\r\n orci\r\n E','2002-11-2','577349','541437','Pellentesque\r\n eget\r\n tellus\r\n e','ipsum\r\n Pellentesque','424956','716','2003-03-30','Donec\r\n vitae','35','10','2002-10-26','2002-07-23','vel\r\n blandit\r\n ut\r\n nonummy\r\n a','47','3512.53','9345.56','2219.85','3331.37','9348.56','98','1728.05');
INSERT INTO Machineries VALUES (137,60,'7610','3763','3','3','3','4','3003000','Industrial','ac','2011011','5','1102110','4','2221110','9','92','2','2002-10-28','5','2003-04-15','5','2003-03-23','lacinia\r\n lorem\r\n Pellentesque\r\n','2003-05-1','892884','158493','luctus\r\n et\r\n ultrices\r\n posuere','magna\r\n Donec','596475','713','2003-01-11','urna\r\n faucibus','9','3','2003-03-22','2003-05-1','elementum\r\n Integer\r\n metus\r\n In','92','93760.85','8012.13','7825.76','3282.11','3655.03','27','1598.62');
INSERT INTO Machineries VALUES (138,60,'5195','4881','5','2','3','3','3012100','Commercial','porta','2022101','2','2033010','59','3213101','47','87','5','2003-04-27','2','2002-09-3','1','2002-10-31','Nam\r\n semper\r\n lacinia\r\n lorem\r\n','2003-01-16','197794','272818','diam\r\n Nam\r\n semper\r\n lacinia\r\n','Pellentesque\r\n posuere','177059','786','2002-08-25','luctus\r\n justo','42','27','2002-08-18','2002-05-30','metus\r\n elementum\r\n nibh\r\n Etiam','98','41161.93','9227.69','7081.15','2416.65','3528.29','10','4040.82');
INSERT INTO Machineries VALUES (139,60,'6685','5307','25','3','4','1','2101111','Commercial','felis','3011010','2','2220111','72','2222100','58','60','4','2003-05-4','2','2003-02-18','4','2002-11-10','Maecenas\r\n odio\r\n pede\r\n auctor\r','2003-03-17','973911','681854','Aliquam\r\n nulla\r\n erat\r\n lacinia','rhoncus\r\n tincidunt','638067','299','2002-08-30','Curabitur\r\n imperdiet','29','25','2002-05-20','2002-10-7','viverra\r\n risus\r\n vitae\r\n varius','26','8636.80','7663.69','9063.40','3129.13','1620.60','4','1168.05');
INSERT INTO Machineries VALUES (140,61,'3962','4880','9','2','4','1','1101101','Industrial','ut','1101110','2','2130000','74','2322110','87','42','3','2003-02-27','3','2003-02-4','4','2002-05-30','tristique\r\n Quisque\r\n interdum\r\n','2003-03-17','213898','923949','nec\r\n arcu\r\n adipiscing\r\n tincid','sem\r\n blandit','361306','543','2002-08-1','lectus\r\n Cras','26','26','2002-11-25','2002-12-8','Duis\r\n est\r\n Cum\r\n sociis\r\n nato','11','99961.02','7387.05','6895.38','6895.59','9500.86','75','3400.37');
INSERT INTO Machineries VALUES (141,61,'5962','1698','24','3','1','3','3212000','Industrial','aliquet','2121110','1','1120011','13','2100010','67','83','3','2003-04-19','5','2003-04-2','2','2003-01-4','sodales\r\n Etiam\r\n lectus\r\n urna\r','2002-09-11','614886','511263','sit\r\n amet\r\n pede Suspendisse\r\n','Praesent\r\n quis','422788','193','2002-08-15','et\r\n felis','14','9','2003-01-29','2002-10-19','turpis\r\n Aliquam\r\n nulla\r\n erat\r','70','13934.38','8997.14','4705.64','2723.04','2903.17','72','4473.12');
INSERT INTO Machineries VALUES (142,61,'9175','7870','21','1','5','1','2232010','Industrial','habitasse','1332101','1','3221000','28','1330111','51','99','2','2002-07-16','5','2003-01-29','5','2002-11-27','sit\r\n amet\r\n libero\r\n Lorem\r\n ip','2002-07-2','453411','798992','posuere\r\n metus\r\n velit\r\n ac\r\n n','et\r\n lectus','202842','774','2002-11-11','amet\r\n est','35','34','2002-11-4','2002-07-16','in\r\n faucibus\r\n orci\r\n luctus\r\n','65','97375.34','9762.87','7349.64','2303.25','4472.95','91','2345.85');
INSERT INTO Machineries VALUES (143,61,'8775','7076','7','5','5','2','3331011','Residential','mauris','3133101','4','3220111','47','3320100','26','82','5','2002-06-14','1','2002-05-31','2','2002-12-29','ac\r\n pretium\r\n ac\r\n pellentesque','2003-02-19','174839','995421','Praesent\r\n quis\r\n enim\r\n Etiam\r\n','tristique\r\n senectus','173632','331','2002-12-1','egestas\r\n diam','26','7','2002-05-25','2002-10-13','ut\r\n nulla\r\n Donec\r\n ipsum\r\n ero','79','99366.86','9321.04','3681.17','4252.00','8547.64','48','297.81');
INSERT INTO Machineries VALUES (144,62,'7943','7850','19','5','5','3','2111001','Residential','vitae','2112111','7','2313001','8','2330011','15','30','1','2002-12-11','5','2002-07-24','3','2003-02-21','leo\r\n at\r\n lorem\r\n Nam\r\n pretium','2002-07-2','325972','968181','Phasellus\r\n est\r\n Vestibulum\r\n s','Cras\r\n porttitor','323732','310','2003-01-12','Donec\r\n tristique','13','1','2003-04-5','2002-05-30','arcu\r\n adipiscing\r\n tincidunt\r\n','18','46326.24','4936.92','5014.09','2231.44','8652.18','92','1770.04');
INSERT INTO Machineries VALUES (145,62,'6264','8406','19','5','3','4','2030110','Residential','vel','2210000','6','2233001','15','2321011','65','87','5','2003-01-11','4','2003-02-6','4','2002-05-30','id\r\n auctor\r\n pharetra\r\n tellus\r','2002-12-8','898579','251252','parturient\r\n montes\r\n nascetur\r\n','consectetuer\r\n tellus','794991','70','2002-12-27','elit\r\n Cras','42','19','2002-11-15','2002-06-1','augue\r\n Quisque\r\n ante\r\n ligula\r','44','30087.83','5944.09','7272.73','3213.70','6410.84','47','4731.88');
INSERT INTO Machineries VALUES (146,63,'4807','6275','10','3','5','4','1202111','Residential','et','1003111','5','1131110','56','1002000','90','64','2','2002-09-7','4','2003-01-20','2','2003-04-28','Curabitur\r\n imperdiet\r\n neque\r\n','2002-05-25','576252','539221','lacus\r\n Nam\r\n est\r\n nulla\r\n soll','fringilla\r\n Donec','464257','203','2002-11-16','Cum\r\n sociis','3','1','2002-10-21','2002-09-12','In\r\n hac\r\n habitasse\r\n platea\r\n','57','89811.73','3577.34','4062.72','6665.81','1411.85','27','2754.72');
INSERT INTO Machineries VALUES (147,63,'4987','0651','9','2','1','1','2011111','Residential','porta','1300011','5','3203110','3','3120111','55','75','5','2003-04-18','4','2003-05-13','5','2002-05-15','neque\r\n Nam\r\n justo\r\n nulla\r\n co','2002-08-25','273691','316329','et\r\n varius\r\n malesuada\r\n urna\r\n','justo\r\n ut','326002','216','2003-02-17','ac\r\n felis','14','4','2003-04-26','2003-03-2','et\r\n erat\r\n sodales\r\n elementum\r','84','38950.94','5991.04','8540.76','8873.67','7672.72','23','910.11');
INSERT INTO Machineries VALUES (148,65,'1144','7568','4','2','4','5','1030111','Commercial','felis','1022110','4','2332000','47','1130001','18','57','2','2002-10-16','2','2002-06-14','2','2002-06-3','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','2002-05-23','769611','764695','mi\r\n euismod\r\n fermentum\r\n Donec','nunc\r\n consectetuer','356246','61','2002-07-16','Lorem\r\n ipsum','36','32','2003-04-6','2002-06-29','at\r\n ipsum\r\n Pellentesque\r\n habi','14','43627.46','7022.13','1062.71','4168.28','9240.29','52','1550.37');
INSERT INTO Machineries VALUES (149,65,'0586','8096','11','2','2','5','3320100','Commercial','metus','2013100','3','3031000','110','2000001','98','64','3','2002-12-18','3','2002-06-22','3','2002-06-1','et\r\n ultrices\r\n posuere\r\n cubili','2002-11-10','763884','631824','tincidunt\r\n Donec\r\n purus\r\n feli','iaculis\r\n quis','314825','650','2002-09-10','in\r\n pharetra','22','10','2003-04-6','2002-06-25','sit\r\n amet\r\n est\r\n eget\r\n velit\r','10','18924.06','4261.91','2378.37','6618.23','2638.01','45','1011.23');
INSERT INTO Machineries VALUES (150,65,'9369','3592','20','4','3','4','3232000','Residential','est','1003101','7','3111000','30','1130001','99','66','4','2002-07-24','1','2003-04-13','5','2002-09-2','Nam\r\n semper\r\n lacinia\r\n lorem\r\n','2002-05-22','313693','147789','commodo\r\n Etiam\r\n odio\r\n neque\r\n','In\r\n risus','986386','762','2002-09-22','consectetuer\r\n commodo','37','10','2003-03-21','2002-09-19','pulvinar\r\n in\r\n volutpat\r\n ac\r\n','48','74253.21','1472.46','8246.47','8697.06','8658.61','75','4372.49');
INSERT INTO Machineries VALUES (151,65,'0397','4087','22','2','1','4','3030111','Industrial','urna','3230100','3','1023011','71','3302000','46','86','2','2002-07-1','2','2002-09-22','1','2003-02-20','turpis\r\n Aliquam\r\n nulla\r\n erat\r','2003-04-22','397825','688289','Lorem\r\n ipsum\r\n dolor\r\n sit\r\n am','risus\r\n Sed','261938','655','2003-04-8','purus\r\n ultricies','7','2','2003-02-20','2003-01-6','et\r\n netus\r\n et\r\n malesuada\r\n fa','54','90651.81','1127.83','4638.28','802.98','3130.74','66','3585.73');
INSERT INTO Machineries VALUES (152,68,'','','43','','','','5000','','','','','4654654654','','','','','','2003-05-19','','2003-05-19','','2003-05-19','','','3452353535','534545','','','','','2003-05-19','','','','2003-05-19','2003-05-19','','5','200','200','200','200','200','','');
INSERT INTO Machineries VALUES (153,71,'54181','12-34-56-78-94','50','1','2','3','812000','Manufacturing','Agricultural','60,000.00','30','0','','','','','4','2003-05-20','4','2003-05-20','5','2003-05-20','','','','','Cogon Grass Processing','MAKITA','234-999-00','400','1993-04-14','Used','20 years','10','1993-04-20','1993-04-21','','2','400000','2000','2000','2000','0','40000','60000');
INSERT INTO Machineries VALUES (154,76,'07070-00857','045-07-070-04-008-2001','72','','','','40000','','','40,000.00','80','32,000.00','','','','','','2003-05-22','','2003-05-22','','2003-05-22','','','045-07-070-04-008-1001','045-07-070-008','Koppel Slim Aircon SI60','Koppel','','','2003-05-22','','','','1997-05-22','2003-05-22','','1','30000','0','0','0','10000','','40000');
INSERT INTO Machineries VALUES (155,76,'','045-07-070-04-009-2001','73','','','','230000','','','230,000.00','80','184,000.00','','','Taxable','1998','','2003-05-22','','2003-05-22','','2003-05-22','','','045-07-070-04','045-07-070-04-009-2001','Projector','','','','2003-05-22','','','','2003-05-22','2003-05-22','','1','230000','','','','','','230000');
INSERT INTO Machineries VALUES (156,0,'3','3','94','','','','','dfd','machactualUse','','','0.00','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','3','3','','','','','2003-06-04','','','','2003-06-04','2003-06-04','','','','','','','','','');
INSERT INTO Machineries VALUES (157,83,NULL,'','','','','','777','777','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','','','','2003-06-13','','','777','','','','','777','');
INSERT INTO Machineries VALUES (158,84,NULL,'','','','','','888','888','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','','','','2003-06-10','','','888','','','','','888','');
INSERT INTO Machineries VALUES (159,97,NULL,'','','','','','1234','1234','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','','','','2003-06-13','','','1234','','','','','1234','');
INSERT INTO Machineries VALUES (160,99,NULL,'','','','','','testMarketValue','testKind','','','','','','','','','','','','','',NULL,NULL,'','','','','','','','','','','','','2003-06-13','','','testAquisitionCost','','','','','testDepreciation','');
INSERT INTO Machineries VALUES (161,104,'rtert','ertetrert','122','','','','1300','sdfd','dfdf','1,000.00','50','500.00','','','','465','','2003-06-04','','2003-06-06','','2003-06-04','64','','eterter','ertert','rterterterterterthj','lj','ljl','jljljl','2003-01-13','kjkl','jlh','klh','2003-07-13','2003-07-13','ghkl','10','50','20','20','20','20','5','1000');

--
-- Table structure for table 'MachineriesActualUses'
--

CREATE TABLE MachineriesActualUses (
  machineriesActualUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (machineriesActualUsesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'MachineriesActualUses'
--


INSERT INTO MachineriesActualUses VALUES (1,'dfdf','dfdf',34,'inactive');
INSERT INTO MachineriesActualUses VALUES (2,'dfd','dfdf',3,'active');
INSERT INTO MachineriesActualUses VALUES (3,'machactualUse','dfdfas',3,'active');

--
-- Table structure for table 'MachineriesClasses'
--

CREATE TABLE MachineriesClasses (
  machineriesClassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (machineriesClassesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'MachineriesClasses'
--


INSERT INTO MachineriesClasses VALUES (1,'sdfas','dfasdfsdaf',2,'inactive');
INSERT INTO MachineriesClasses VALUES (2,'sdfd','fdasf',2,'inactive');
INSERT INTO MachineriesClasses VALUES (3,'asdfas','dfsdaf',4,'active');
INSERT INTO MachineriesClasses VALUES (4,'dfd','dsdsd',45,'active');

--
-- Table structure for table 'MunicipalityCity'
--

CREATE TABLE MunicipalityCity (
  municipalityCityID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  provinceID int(4) NOT NULL default '1',
  description text,
  status varchar(255) default NULL,
  PRIMARY KEY  (municipalityCityID)
) TYPE=InnoDB;

--
-- Dumping data for table 'MunicipalityCity'
--


INSERT INTO MunicipalityCity VALUES (1,'BG',1,'Bangued','active');
INSERT INTO MunicipalityCity VALUES (6,'Butuan City',5,'Butuan City','active');
INSERT INTO MunicipalityCity VALUES (7,'San Francisco',6,'San Francisco','active');
INSERT INTO MunicipalityCity VALUES (8,'Kalibo',7,'Kalibo','active');
INSERT INTO MunicipalityCity VALUES (9,'Daraga',8,'Daraga','active');
INSERT INTO MunicipalityCity VALUES (10,'Tabaco',8,'Tabaco','active');
INSERT INTO MunicipalityCity VALUES (11,'San Jose',8,'San Jose','active');
INSERT INTO MunicipalityCity VALUES (12,'Legaspi City',13,'Legaspi City','active');
INSERT INTO MunicipalityCity VALUES (13,'Isabela',14,'Isabela','active');
INSERT INTO MunicipalityCity VALUES (14,'Balanga',15,'Balanga','active');
INSERT INTO MunicipalityCity VALUES (15,'Dinalupihan',15,'Dinalupihan','active');
INSERT INTO MunicipalityCity VALUES (16,'Balayan',16,'Balayan','active');
INSERT INTO MunicipalityCity VALUES (17,'Batangas City',16,'Batangas City','active');
INSERT INTO MunicipalityCity VALUES (18,'Bauan',16,'Bauan','active');
INSERT INTO MunicipalityCity VALUES (19,'Calaca',16,'Calaca','active');
INSERT INTO MunicipalityCity VALUES (20,'Kumintang Ilaya',16,'Kumintang Ilaya','active');
INSERT INTO MunicipalityCity VALUES (21,'Lemery',16,'Lemery','active');
INSERT INTO MunicipalityCity VALUES (22,'Lipa City',16,'Lipa City','active');
INSERT INTO MunicipalityCity VALUES (23,'Malvar',16,'Malvar','active');
INSERT INTO MunicipalityCity VALUES (24,'Nasugbu',16,'Nasugbu','active');
INSERT INTO MunicipalityCity VALUES (25,'Rosario',16,'Rosario','active');
INSERT INTO MunicipalityCity VALUES (26,'San Pascual',16,'San Pascual','active');
INSERT INTO MunicipalityCity VALUES (27,'Tanauan',16,'Tanauan','active');
INSERT INTO MunicipalityCity VALUES (28,'Baguio City',17,'Baguio City','active');
INSERT INTO MunicipalityCity VALUES (29,'La Trinidad',17,'La Trinidad','active');
INSERT INTO MunicipalityCity VALUES (30,'Tagbilaran City',18,'Tagbilaran City','active');
INSERT INTO MunicipalityCity VALUES (31,'Valencia',19,'Valencia','active');
INSERT INTO MunicipalityCity VALUES (32,'Balagtas',20,'Balagtas','active');
INSERT INTO MunicipalityCity VALUES (33,'Baliuag',20,'Baliuag','active');
INSERT INTO MunicipalityCity VALUES (34,'Bocaue',20,'Bocaue','active');
INSERT INTO MunicipalityCity VALUES (35,'del Monte',20,'del Monte','active');
INSERT INTO MunicipalityCity VALUES (36,'Guiguinto',20,'Guiguinto','active');
INSERT INTO MunicipalityCity VALUES (37,'Hagonoy',20,'Hagonoy','active');
INSERT INTO MunicipalityCity VALUES (38,'Malolos',20,'Malolos','active');
INSERT INTO MunicipalityCity VALUES (39,'Marilao',20,'Marilao','active');
INSERT INTO MunicipalityCity VALUES (40,'Meycauayan',20,'Meycauayan','active');
INSERT INTO MunicipalityCity VALUES (41,'Plaridel',20,'Plaridel','active');
INSERT INTO MunicipalityCity VALUES (42,'San Miguel',20,'San Miguel','active');
INSERT INTO MunicipalityCity VALUES (43,'Sta. Maria',20,'Sta. Maria','active');
INSERT INTO MunicipalityCity VALUES (44,'Aparri',21,'Aparri','active');
INSERT INTO MunicipalityCity VALUES (45,'Tuguegarao',21,'Tuguegarao','active');
INSERT INTO MunicipalityCity VALUES (46,'Daet',22,'Daet','active');
INSERT INTO MunicipalityCity VALUES (47,'Iriga',22,'Iriga','active');
INSERT INTO MunicipalityCity VALUES (48,'Naga City',23,'Naga City','active');
INSERT INTO MunicipalityCity VALUES (49,'Roxas City',24,'Roxas City','active');
INSERT INTO MunicipalityCity VALUES (50,'Anabu Imus',25,'Anabu Imus','active');
INSERT INTO MunicipalityCity VALUES (51,'Bacoor',25,'Bacoor','active');
INSERT INTO MunicipalityCity VALUES (52,'Caridad',25,'Caridad','active');
INSERT INTO MunicipalityCity VALUES (53,'Caridad District',25,'Caridad District','active');
INSERT INTO MunicipalityCity VALUES (54,'Carmona',25,'Carmona','active');
INSERT INTO MunicipalityCity VALUES (55,'Dasmarinas',25,'Dasmarinas','active');
INSERT INTO MunicipalityCity VALUES (56,'General Trias',25,'General Trias','active');
INSERT INTO MunicipalityCity VALUES (57,'Imus',25,'Imus','active');
INSERT INTO MunicipalityCity VALUES (58,'Kawit',25,'Kawit','active');
INSERT INTO MunicipalityCity VALUES (59,'Naic',25,'Naic','active');
INSERT INTO MunicipalityCity VALUES (60,'Rosario',25,'Rosario','active');
INSERT INTO MunicipalityCity VALUES (61,'Silang',25,'Silang','active');
INSERT INTO MunicipalityCity VALUES (62,'Tagaytay City',25,'Tagaytay City','active');
INSERT INTO MunicipalityCity VALUES (63,'Tanza',25,'Tanza','active');
INSERT INTO MunicipalityCity VALUES (64,'Trece Martires',25,'Trece Martires','active');
INSERT INTO MunicipalityCity VALUES (65,'Bogo',26,'Bogo','active');
INSERT INTO MunicipalityCity VALUES (66,'Cebu City',26,'Cebu City','active');
INSERT INTO MunicipalityCity VALUES (67,'Consolacion',26,'Consolacion','active');
INSERT INTO MunicipalityCity VALUES (68,'Danao City',26,'Danao City','active');
INSERT INTO MunicipalityCity VALUES (69,'Gaisano City',26,'Gaisano City','active');
INSERT INTO MunicipalityCity VALUES (70,'Lahug City',26,'Lahug City','active');
INSERT INTO MunicipalityCity VALUES (71,'Lapu Lapu City',26,'Lapu Lapu City','active');
INSERT INTO MunicipalityCity VALUES (72,'Mandaue City',26,'Mandaue City','active');
INSERT INTO MunicipalityCity VALUES (73,'Minglanilla',26,'Minglanilla','active');
INSERT INTO MunicipalityCity VALUES (74,'Naga',26,'Naga','active');
INSERT INTO MunicipalityCity VALUES (75,'Talisay',26,'Talisay','active');
INSERT INTO MunicipalityCity VALUES (76,'Cotabato City',27,'Cotabato City','active');
INSERT INTO MunicipalityCity VALUES (77,'Davao City',28,'Davao City','active');
INSERT INTO MunicipalityCity VALUES (78,'Matina',28,'Matina','active');
INSERT INTO MunicipalityCity VALUES (79,'Panabo',29,'Panabo','active');
INSERT INTO MunicipalityCity VALUES (80,'Tagum',29,'Tagum','active');
INSERT INTO MunicipalityCity VALUES (81,'Digos',29,'Digos','active');
INSERT INTO MunicipalityCity VALUES (82,'Borongan',30,'Borongan','active');
INSERT INTO MunicipalityCity VALUES (83,'Batac',31,'Batac','active');
INSERT INTO MunicipalityCity VALUES (84,'Laoag City',31,'Laoag City','active');
INSERT INTO MunicipalityCity VALUES (85,'Candon',32,'Candon ','active');
INSERT INTO MunicipalityCity VALUES (86,'Santiago City',32,'Santiago City','active');
INSERT INTO MunicipalityCity VALUES (87,'Vigan',32,'Vigan','active');
INSERT INTO MunicipalityCity VALUES (88,'Iloilo City',33,'Iloilo City','active');
INSERT INTO MunicipalityCity VALUES (89,'Mandurriao',33,'Mandurriao','active');
INSERT INTO MunicipalityCity VALUES (90,'Cauayan',34,'Cauayan','active');
INSERT INTO MunicipalityCity VALUES (91,'Ilagan',34,'Ilagan','active');
INSERT INTO MunicipalityCity VALUES (92,'Santiago',34,'Santiago','active');
INSERT INTO MunicipalityCity VALUES (93,'Agoo',35,'Agoo','active');
INSERT INTO MunicipalityCity VALUES (94,'San Fernando',35,'San Fernando','active');
INSERT INTO MunicipalityCity VALUES (95,'Cabuyao',36,'Cabuyao','active');
INSERT INTO MunicipalityCity VALUES (96,'Calamba',36,'Calamba','active');
INSERT INTO MunicipalityCity VALUES (97,'Canluban',36,'Canluban','active');
INSERT INTO MunicipalityCity VALUES (98,'Los Banos',36,'Los Banos','active');
INSERT INTO MunicipalityCity VALUES (99,'San Pablo City',36,'San Pablo City','active');
INSERT INTO MunicipalityCity VALUES (100,'San Pedro',36,'San Pedro','active');
INSERT INTO MunicipalityCity VALUES (101,'Siniloan',36,'Siniloan','active');
INSERT INTO MunicipalityCity VALUES (102,'Sta. Cruz',36,'Sta. Cruz','active');
INSERT INTO MunicipalityCity VALUES (103,'Sta. Rosa',36,'Sta. Rosa','active');
INSERT INTO MunicipalityCity VALUES (104,'Iligan City',37,'Iligan City','active');
INSERT INTO MunicipalityCity VALUES (105,'Baybay',38,'Baybay','active');
INSERT INTO MunicipalityCity VALUES (106,'Ormoc City',38,'Ormoc City','active');
INSERT INTO MunicipalityCity VALUES (107,'Tacloban City',38,'Tacloban City','active');
INSERT INTO MunicipalityCity VALUES (108,'Masbate',39,'Masbate','active');
INSERT INTO MunicipalityCity VALUES (109,'Binondo, Manila',40,'Binondo, Manila','active');
INSERT INTO MunicipalityCity VALUES (110,'Caloocan City',40,'Caloocan City','active');
INSERT INTO MunicipalityCity VALUES (111,'Binondo, Manila',40,'Binondo, Manila','active');
INSERT INTO MunicipalityCity VALUES (112,'Binondo, Manila',40,'Binondo, Manila','active');
INSERT INTO MunicipalityCity VALUES (113,'Caloocan City',40,'Caloocan City','active');
INSERT INTO MunicipalityCity VALUES (114,'Comercio, Manila',40,'Comercio, Manila','active');
INSERT INTO MunicipalityCity VALUES (115,'Cubao, Quezon City',40,'Cubao, Quezon City','active');
INSERT INTO MunicipalityCity VALUES (116,'Ermita, Manila',40,'Ermita, Manila','active');
INSERT INTO MunicipalityCity VALUES (117,'Escolta, Manila',40,'Escolta, Manila','active');
INSERT INTO MunicipalityCity VALUES (118,'Intramuros, Manila',40,'Intramuros, Manila','active');
INSERT INTO MunicipalityCity VALUES (119,'Las Piñas City',40,'Las Piñas City','active');
INSERT INTO MunicipalityCity VALUES (120,'Makati City',40,'Makati City','active');
INSERT INTO MunicipalityCity VALUES (121,'Malabon',40,'Malabon','active');
INSERT INTO MunicipalityCity VALUES (122,'Malate',40,'Malate','active');
INSERT INTO MunicipalityCity VALUES (123,'Mandaluyong City',40,'Mandaluyong City','active');
INSERT INTO MunicipalityCity VALUES (124,'Manila',40,'Manila','active');
INSERT INTO MunicipalityCity VALUES (125,'Marikina City',40,'Marikina City','active');
INSERT INTO MunicipalityCity VALUES (126,'Munitinlupa City',40,'Munitinlupa City','active');
INSERT INTO MunicipalityCity VALUES (127,'Navotas',40,'Navotas','active');
INSERT INTO MunicipalityCity VALUES (128,'New Manila, Quezon City',40,'New Manila, Quezon City','active');
INSERT INTO MunicipalityCity VALUES (129,'Novaliches',40,'Novaliches','active');
INSERT INTO MunicipalityCity VALUES (130,'Novaliches, Quezon City',40,'Novaliches, Quezon City','active');
INSERT INTO MunicipalityCity VALUES (131,'Ortigas, Pasig City',40,'Ortigas, Pasig City','active');
INSERT INTO MunicipalityCity VALUES (132,'Paco, Manila',40,'Paco, Manila','active');
INSERT INTO MunicipalityCity VALUES (133,'Parañaque',40,'Parañaque','active');
INSERT INTO MunicipalityCity VALUES (134,'Parañaque City',40,'Parañaque City','active');
INSERT INTO MunicipalityCity VALUES (135,'Parang, Marikina City',40,'Parang, Marikina City','active');
INSERT INTO MunicipalityCity VALUES (136,'Pasay City',40,'Pasay City','active');
INSERT INTO MunicipalityCity VALUES (137,'Pasig City',40,'Pasig City','active');
INSERT INTO MunicipalityCity VALUES (138,'Pateros',40,'Pateros','active');
INSERT INTO MunicipalityCity VALUES (139,'Port Area, Manila',40,'Port Area, Manila','active');
INSERT INTO MunicipalityCity VALUES (140,'Quezon City',40,'Quezon City','active');
INSERT INTO MunicipalityCity VALUES (141,'Quiapo, Manila',40,'Quiapo, Manila','active');
INSERT INTO MunicipalityCity VALUES (142,'Sampaloc',40,'Sampaloc','active');
INSERT INTO MunicipalityCity VALUES (143,'San Juan',40,'San Juan','active');
INSERT INTO MunicipalityCity VALUES (144,'Santolan, Pasig City',40,'Santolan, Pasig City','active');
INSERT INTO MunicipalityCity VALUES (145,'Binondo, Manila',40,'Binondo, Manila','active');
INSERT INTO MunicipalityCity VALUES (146,'Sta. Lucia, Pasig City',40,'Sta. Lucia, Pasig City','active');
INSERT INTO MunicipalityCity VALUES (147,'Caloocan City',40,'Caloocan City','active');
INSERT INTO MunicipalityCity VALUES (148,'Sta. Ana, Manila',40,'Sta. Ana, Manila','active');
INSERT INTO MunicipalityCity VALUES (149,'Comercio, Manila',40,'Comercio, Manila','active');
INSERT INTO MunicipalityCity VALUES (150,'Sta. Cruz, Manila',40,'Sta. Cruz, Manila','active');
INSERT INTO MunicipalityCity VALUES (151,'Cubao, Quezon City',40,'Cubao, Quezon City','active');
INSERT INTO MunicipalityCity VALUES (152,'Sta. Mesa, Manila',40,'Sta. Mesa, Manila','active');
INSERT INTO MunicipalityCity VALUES (153,'Ermita, Manila',40,'Ermita, Manila','active');
INSERT INTO MunicipalityCity VALUES (154,'Taguig',40,'Taguig','active');
INSERT INTO MunicipalityCity VALUES (155,'Escolta, Manila',40,'Escolta, Manila','active');
INSERT INTO MunicipalityCity VALUES (156,'Tondo',40,'Tondo','active');
INSERT INTO MunicipalityCity VALUES (157,'Intramuros, Manila',40,'Intramuros, Manila','active');
INSERT INTO MunicipalityCity VALUES (158,'Valenzuela City',40,'Valenzuela City','active');
INSERT INTO MunicipalityCity VALUES (159,'Las Piñas City',40,'Las Piñas City','active');
INSERT INTO MunicipalityCity VALUES (160,'Makati City',40,'Makati City','active');
INSERT INTO MunicipalityCity VALUES (161,'Malabon',40,'Malabon','active');
INSERT INTO MunicipalityCity VALUES (162,'Malate',40,'Malate','active');
INSERT INTO MunicipalityCity VALUES (163,'Mandaluyong City',40,'Mandaluyong City','active');
INSERT INTO MunicipalityCity VALUES (164,'Manila',40,'Manila','active');
INSERT INTO MunicipalityCity VALUES (165,'Marikina City',40,'Marikina City','active');
INSERT INTO MunicipalityCity VALUES (166,'Munitinlupa City',40,'Munitinlupa City','active');
INSERT INTO MunicipalityCity VALUES (167,'Navotas',40,'Navotas','active');
INSERT INTO MunicipalityCity VALUES (168,'New Manila, Quezon City',40,'New Manila, Quezon City','active');
INSERT INTO MunicipalityCity VALUES (169,'Novaliches',40,'Novaliches','active');
INSERT INTO MunicipalityCity VALUES (170,'Novaliches, Quezon City',40,'Novaliches, Quezon City','active');
INSERT INTO MunicipalityCity VALUES (171,'Ortigas, Pasig City',40,'Ortigas, Pasig City','active');
INSERT INTO MunicipalityCity VALUES (172,'Paco, Manila',40,'Paco, Manila','active');
INSERT INTO MunicipalityCity VALUES (173,'Parañaque',40,'Parañaque','active');
INSERT INTO MunicipalityCity VALUES (174,'Parañaque City',40,'Parañaque City','active');
INSERT INTO MunicipalityCity VALUES (175,'Parang, Marikina City',40,'Parang, Marikina City','active');
INSERT INTO MunicipalityCity VALUES (176,'Pasay City',40,'Pasay City','active');
INSERT INTO MunicipalityCity VALUES (177,'Pasig City',40,'Pasig City','active');
INSERT INTO MunicipalityCity VALUES (178,'Pateros',40,'Pateros','active');
INSERT INTO MunicipalityCity VALUES (179,'Port Area, Manila',40,'Port Area, Manila','active');
INSERT INTO MunicipalityCity VALUES (180,'Quezon City',40,'Quezon City','active');
INSERT INTO MunicipalityCity VALUES (181,'Quiapo, Manila',40,'Quiapo, Manila','active');
INSERT INTO MunicipalityCity VALUES (182,'Sampaloc',40,'Sampaloc','active');
INSERT INTO MunicipalityCity VALUES (183,'San Juan',40,'San Juan','active');
INSERT INTO MunicipalityCity VALUES (184,'Santolan, Pasig City',40,'Santolan, Pasig City','active');
INSERT INTO MunicipalityCity VALUES (185,'Sta. Lucia, Pasig City',40,'Sta. Lucia, Pasig City','active');
INSERT INTO MunicipalityCity VALUES (186,'Sta. Ana, Manila',40,'Sta. Ana, Manila','active');
INSERT INTO MunicipalityCity VALUES (187,'Sta. Cruz, Manila',40,'Sta. Cruz, Manila','active');
INSERT INTO MunicipalityCity VALUES (188,'Sta. Mesa, Manila',40,'Sta. Mesa, Manila','active');
INSERT INTO MunicipalityCity VALUES (189,'Taguig',40,'Taguig','active');
INSERT INTO MunicipalityCity VALUES (190,'Tondo',40,'Tondo','active');
INSERT INTO MunicipalityCity VALUES (191,'Valenzuela City',40,'Valenzuela City','active');
INSERT INTO MunicipalityCity VALUES (192,'Valenzuela City',40,'Valenzuela City','active');
INSERT INTO MunicipalityCity VALUES (193,'Ozamis City',41,'Ozamis City','active');
INSERT INTO MunicipalityCity VALUES (194,'Cagayan de Oro City',41,'Cagayan de Oro City','active');
INSERT INTO MunicipalityCity VALUES (195,'Lapasan District',41,'Lapasan District','active');
INSERT INTO MunicipalityCity VALUES (196,'Bacolod City',42,'Bacolod City','active');
INSERT INTO MunicipalityCity VALUES (197,'San Carlos City',42,'San Carlos City','active');
INSERT INTO MunicipalityCity VALUES (198,'Silay City',42,'Silay City','active');
INSERT INTO MunicipalityCity VALUES (199,'Dumaguete City',43,'Dumaguete City','active');
INSERT INTO MunicipalityCity VALUES (200,'Kidapawan',44,'Kidapawan','active');
INSERT INTO MunicipalityCity VALUES (201,'Midsayap',44,'Midsayap','active');
INSERT INTO MunicipalityCity VALUES (202,'Catarman',45,'Catarman','active');
INSERT INTO MunicipalityCity VALUES (203,'Cabanatuan City',46,'Cabanatuan City','active');
INSERT INTO MunicipalityCity VALUES (204,'Gapan',46,'Gapan','active');
INSERT INTO MunicipalityCity VALUES (205,'Muñoz',46,'Muñoz','active');
INSERT INTO MunicipalityCity VALUES (206,'San Jose',46,'San Jose','active');
INSERT INTO MunicipalityCity VALUES (207,'Solano',47,'Solano','active');
INSERT INTO MunicipalityCity VALUES (208,'San Jose',48,'San Jose','active');
INSERT INTO MunicipalityCity VALUES (209,'Calapan City',49,'Calapan City','active');
INSERT INTO MunicipalityCity VALUES (210,'Puerto Princesa',50,'Puerto Princesa','active');
INSERT INTO MunicipalityCity VALUES (211,'Angeles City',51,'Angeles City','active');
INSERT INTO MunicipalityCity VALUES (212,'Clarkfield',51,'Clarkfield','active');
INSERT INTO MunicipalityCity VALUES (213,'Guagua',51,'Guagua','active');
INSERT INTO MunicipalityCity VALUES (214,'Mabalacat',51,'Mabalacat','active');
INSERT INTO MunicipalityCity VALUES (215,'San Fernando',51,'San Fernando ','active');
INSERT INTO MunicipalityCity VALUES (216,'San Fernando City',51,'San Fernando City','active');
INSERT INTO MunicipalityCity VALUES (217,'Alaminos',52,'Alaminos','active');
INSERT INTO MunicipalityCity VALUES (218,'Dagupan City',52,'Dagupan City','active');
INSERT INTO MunicipalityCity VALUES (219,'Lingayen',52,'Lingayen','active');
INSERT INTO MunicipalityCity VALUES (220,'Rosales',52,'Rosales','active');
INSERT INTO MunicipalityCity VALUES (221,'San Carlos City',52,'San Carlos City','active');
INSERT INTO MunicipalityCity VALUES (222,'Tayug',52,'Tayug','active');
INSERT INTO MunicipalityCity VALUES (223,'Urdaneta',52,'Urdaneta','active');
INSERT INTO MunicipalityCity VALUES (224,'Gumaca',53,'Gumaca','active');
INSERT INTO MunicipalityCity VALUES (225,'Lucena',53,'Lucena','active');
INSERT INTO MunicipalityCity VALUES (226,'Angono',54,'Angono','active');
INSERT INTO MunicipalityCity VALUES (227,'Antipolo City',54,'Antipolo City','active');
INSERT INTO MunicipalityCity VALUES (228,'Binangonan',54,'Binangonan','active');
INSERT INTO MunicipalityCity VALUES (229,'Cainta',54,'Cainta','active');
INSERT INTO MunicipalityCity VALUES (230,'San Mateo',54,'San Mateo','active');
INSERT INTO MunicipalityCity VALUES (231,'Tanay',54,'Tanay','active');
INSERT INTO MunicipalityCity VALUES (232,'Taytay',54,'Taytay','active');
INSERT INTO MunicipalityCity VALUES (233,'Catbalogan',55,'Catbalogan','active');
INSERT INTO MunicipalityCity VALUES (234,'Bulan',55,'Bulan','active');
INSERT INTO MunicipalityCity VALUES (235,'Sorsogon',56,'Sorsogon','active');
INSERT INTO MunicipalityCity VALUES (236,'General Santos City',57,'General Santos City','active');
INSERT INTO MunicipalityCity VALUES (237,'Marbel',57,'Marbel','active');
INSERT INTO MunicipalityCity VALUES (238,'Maasin',58,'Maasin','active');
INSERT INTO MunicipalityCity VALUES (239,'Tacurong',59,'Tacurong','active');
INSERT INTO MunicipalityCity VALUES (240,'Jolo',60,'Jolo','active');
INSERT INTO MunicipalityCity VALUES (241,'Surigao',61,'Surigao','active');
INSERT INTO MunicipalityCity VALUES (242,'Camiling',62,'Camiling','active');
INSERT INTO MunicipalityCity VALUES (243,'Concepcion',62,'Concepcion','active');
INSERT INTO MunicipalityCity VALUES (244,'Paniqui',62,'Paniqui','active');
INSERT INTO MunicipalityCity VALUES (245,'San Roque',62,'San Roque','active');
INSERT INTO MunicipalityCity VALUES (246,'San Vicente',62,'San Vicente','active');
INSERT INTO MunicipalityCity VALUES (247,'Tarlac',62,'Tarlac','active');
INSERT INTO MunicipalityCity VALUES (248,'Calbayog City',63,'Calbayog City','active');
INSERT INTO MunicipalityCity VALUES (249,'Iba',64,'Iba','active');
INSERT INTO MunicipalityCity VALUES (250,'Olongapo City',64,'Olongapo City','active');
INSERT INTO MunicipalityCity VALUES (251,'Subic',64,'Subic','active');
INSERT INTO MunicipalityCity VALUES (252,'Dipolog City',65,'Dipolog City','active');
INSERT INTO MunicipalityCity VALUES (253,'Pagadian City',65,'Pagadian City','active');
INSERT INTO MunicipalityCity VALUES (254,'Pagadian City',66,'Pagadian City','active');
INSERT INTO MunicipalityCity VALUES (255,'Zamboanga City',66,'Zamboanga City','active');

--
-- Table structure for table 'OD'
--

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
  PRIMARY KEY  (odID)
) TYPE=InnoDB;

--
-- Dumping data for table 'OD'
--


INSERT INTO OD VALUES (1,'39615','211.52','51','23','5','26',1,1,0,0);
INSERT INTO OD VALUES (2,'25674','946.94','10','18','59','26',2,0,1,1);
INSERT INTO OD VALUES (3,'97526','772.65','8','64','10','30',3,1,0,0);
INSERT INTO OD VALUES (4,'65597','303.88','91','21','70','24',4,1,1,1);
INSERT INTO OD VALUES (5,'21988','366.09','95','65','33','81',5,1,0,0);
INSERT INTO OD VALUES (6,'17545','580.76','80','47','85','85',6,0,1,1);
INSERT INTO OD VALUES (7,'95562','321.04','49','5','65','81',7,1,0,0);
INSERT INTO OD VALUES (8,'69857','806.02','19','24','55','29',8,1,0,1);
INSERT INTO OD VALUES (9,'19919','203.01','78','78','15','53',9,0,1,0);
INSERT INTO OD VALUES (10,'60324','280.71','19','65','39','4',10,1,0,1);
INSERT INTO OD VALUES (11,'22176','913.55','53','36','53','16',11,0,0,0);
INSERT INTO OD VALUES (12,'49027','362.35','15','15','51','18',12,0,1,0);
INSERT INTO OD VALUES (13,'53185','544.50','40','45','87','18',13,1,1,1);
INSERT INTO OD VALUES (14,'87034','969.98','97','85','76','72',14,1,0,1);
INSERT INTO OD VALUES (15,'91452','143.08','27','67','15','76',15,1,1,0);
INSERT INTO OD VALUES (16,'05167','648.34','56','24','34','57',16,1,1,0);
INSERT INTO OD VALUES (17,'59231','26.82','25','37','26','31',17,0,1,0);
INSERT INTO OD VALUES (18,'07967','77.66','100','9','45','42',18,1,0,0);
INSERT INTO OD VALUES (19,'35318','303.45','60','83','86','95',19,0,1,0);
INSERT INTO OD VALUES (20,'99836','946.51','1','89','48','13',20,1,1,0);
INSERT INTO OD VALUES (21,'87900','96.33','41','32','9','67',21,0,0,1);
INSERT INTO OD VALUES (22,'17049','394.26','96','8','21','97',22,0,1,0);
INSERT INTO OD VALUES (23,'43561','995.19','73','63','67','34',23,1,0,1);
INSERT INTO OD VALUES (24,'98951','460.34','80','6','62','13',24,0,1,0);
INSERT INTO OD VALUES (25,'61784','605.42','55','88','5','59',25,1,1,1);
INSERT INTO OD VALUES (26,'61756','855.43','34','28','75','52',26,0,0,0);
INSERT INTO OD VALUES (27,'97415','89.21','47','45','42','92',27,1,1,1);
INSERT INTO OD VALUES (28,'10970','888.62','49','45','44','21',28,0,1,0);
INSERT INTO OD VALUES (29,'42341','536.46','58','49','5','83',29,1,0,0);
INSERT INTO OD VALUES (30,'82126','937.30','96','25','17','66',30,0,1,1);
INSERT INTO OD VALUES (31,'06615','145.64','26','55','40','42',31,0,0,0);
INSERT INTO OD VALUES (32,'55134','167.75','49','88','80','62',32,0,0,0);
INSERT INTO OD VALUES (33,'35108','681.60','14','92','21','79',33,0,1,1);
INSERT INTO OD VALUES (34,'86802','219.85','99','72','87','74',34,0,0,1);
INSERT INTO OD VALUES (35,'30362','690.83','25','98','66','3',35,1,0,1);
INSERT INTO OD VALUES (36,'63034','470.80','69','33','47','14',36,1,0,0);
INSERT INTO OD VALUES (37,'89027','654.71','1','54','70','69',37,1,0,0);
INSERT INTO OD VALUES (38,'09570','178.66','96','19','84','61',38,1,0,1);
INSERT INTO OD VALUES (39,'40459','614.27','90','51','27','88',39,1,1,0);
INSERT INTO OD VALUES (40,'78584','268.71','19','100','96','28',40,0,1,1);
INSERT INTO OD VALUES (41,'82752','926.91','91','92','13','10',41,1,1,1);
INSERT INTO OD VALUES (42,'78356','950.58','62','57','43','46',42,1,1,0);
INSERT INTO OD VALUES (43,'72214','78.11','73','89','78','3',43,1,1,0);
INSERT INTO OD VALUES (44,'16895','57.64','45','69','100','3',44,0,1,1);
INSERT INTO OD VALUES (45,'96204','185.55','24','54','21','90',45,1,1,1);
INSERT INTO OD VALUES (46,'59807','693.69','89','48','36','17',46,1,1,1);
INSERT INTO OD VALUES (47,'49821','613.72','69','38','98','30',47,1,1,0);
INSERT INTO OD VALUES (48,'91304','232.12','13','43','30','81',48,0,1,0);
INSERT INTO OD VALUES (49,'18892','429.46','94','29','67','8',49,0,1,0);
INSERT INTO OD VALUES (50,'30679','49.19','34','65','9','1',50,1,1,1);
INSERT INTO OD VALUES (51,'q','q','q','q','q','q',NULL,1,1,1);
INSERT INTO OD VALUES (52,'s','s','s','s','s','s',NULL,1,1,1);
INSERT INTO OD VALUES (53,'2415','36sqm','24','24','15','15',NULL,0,0,0);
INSERT INTO OD VALUES (54,'37427','713.29','15','2','15','12',69,0,0,0);
INSERT INTO OD VALUES (55,'93966','951.39','75','86','37','25',70,0,1,1);
INSERT INTO OD VALUES (56,'68971','529.77','26','60','38','26',71,1,0,0);
INSERT INTO OD VALUES (57,'13614','116.72','41','14','54','44',72,0,0,1);
INSERT INTO OD VALUES (58,'82929','680.00','15','82','32','49',73,0,1,1);
INSERT INTO OD VALUES (59,'26702','952.53','86','34','40','31',74,0,0,0);
INSERT INTO OD VALUES (60,'04074','500.67','54','51','8','51',75,1,0,1);
INSERT INTO OD VALUES (61,'98288','795.42','94','80','1','97',76,1,1,1);
INSERT INTO OD VALUES (62,'92408','844.85','53','45','2','7',77,1,0,0);
INSERT INTO OD VALUES (63,'04419','938.87','64','61','57','82',78,1,0,1);
INSERT INTO OD VALUES (64,'ABC - 123457 - 12','475.23','250','22','12','A - 1234-5678',NULL,1,1,1);
INSERT INTO OD VALUES (65,'07817','642.49','68','34','26','56',111,0,0,1);
INSERT INTO OD VALUES (66,'2415','36','15','2','24','1223421',NULL,1,1,1);
INSERT INTO OD VALUES (67,'w','w','w','w','w','w',NULL,1,1,1);
INSERT INTO OD VALUES (68,'4','600sqm','4','1','4','2134124124',NULL,1,1,1);
INSERT INTO OD VALUES (69,'q','q','q','q','d','q',NULL,1,1,1);
INSERT INTO OD VALUES (70,'123-456-789-10','5432 sq m','12','5','1','NA',NULL,1,1,1);
INSERT INTO OD VALUES (71,'12345','305','23','12','12','23',NULL,1,1,1);
INSERT INTO OD VALUES (72,'1111-23-4567','400 sq. m.','12','12','12','897-333-4',NULL,1,1,1);
INSERT INTO OD VALUES (73,'3961','100','24222','25222','2222','322',NULL,1,0,1);
INSERT INTO OD VALUES (74,'NA','NA','NA','NA','NA','NA',NULL,0,0,0);
INSERT INTO OD VALUES (75,'NA','NA','NA','NA','NA','NA',NULL,1,1,1);
INSERT INTO OD VALUES (76,'NA','NA','NA','NA','NA','NA',NULL,1,1,1);
INSERT INTO OD VALUES (77,'NA','NA','NA','NA','NA','NA',NULL,1,0,1);
INSERT INTO OD VALUES (78,'2','100 hectares','3','4','5','6',NULL,1,1,1);
INSERT INTO OD VALUES (79,'dfhhdf','dhhd','dhdhf','dhdfhdfh','dfhdfh','dshfsdh',NULL,0,0,0);
INSERT INTO OD VALUES (98,'','','4444','','444','',NULL,0,0,0);
INSERT INTO OD VALUES (99,'','','777777','','777777777','',NULL,0,0,0);
INSERT INTO OD VALUES (100,'','','Five','','5IVE','',NULL,0,0,0);
INSERT INTO OD VALUES (101,'','','Five','','5IVE','',NULL,0,0,0);
INSERT INTO OD VALUES (102,'','','5','','5','',NULL,0,0,0);
INSERT INTO OD VALUES (103,'','','777','','777','',NULL,0,0,0);
INSERT INTO OD VALUES (104,'','','888','','888','',NULL,0,0,0);
INSERT INTO OD VALUES (105,'','','fghfghf','','ghfghfgh','',NULL,0,0,0);
INSERT INTO OD VALUES (106,'','','fghfghf','','ghfghfgh','',NULL,0,0,0);
INSERT INTO OD VALUES (107,'','','999','','999','',NULL,0,0,0);
INSERT INTO OD VALUES (108,'','','2345','','23','',NULL,0,0,0);
INSERT INTO OD VALUES (109,'','','2345','','23','',NULL,0,0,0);
INSERT INTO OD VALUES (110,'3538','33665 hectares','8888','605','1','eee',NULL,1,1,1);
INSERT INTO OD VALUES (111,'1','2','3','4','5','6',NULL,1,1,1);
INSERT INTO OD VALUES (112,'','','t34t34t34t','','4t34t34t','',NULL,0,0,0);
INSERT INTO OD VALUES (113,'','','ertertert','','ertertertet','',NULL,0,0,0);
INSERT INTO OD VALUES (114,'','','4444','','4444','',NULL,0,0,0);
INSERT INTO OD VALUES (115,'','','888','','888','',NULL,0,0,0);
INSERT INTO OD VALUES (116,'','','999','','999','',NULL,0,0,0);
INSERT INTO OD VALUES (117,'','','1234','','1234','',NULL,0,0,0);
INSERT INTO OD VALUES (118,'','','789','','789','',NULL,0,0,0);
INSERT INTO OD VALUES (119,'','','testLotNumber','','testBlockNumber','',NULL,0,0,0);
INSERT INTO OD VALUES (120,'rtetr','rtertetrert','erterte','trerte','erttrerter','rtert',NULL,1,1,1);
INSERT INTO OD VALUES (121,'','','78910','','78910','',NULL,0,0,0);
INSERT INTO OD VALUES (122,'','','78911','','78911','',NULL,0,0,0);
INSERT INTO OD VALUES (123,'sdgfdf','gdfgdf','gdfgdfg','dfgdfg','fgdfgdgf','fgd',NULL,1,1,1);
INSERT INTO OD VALUES (124,'','','789','','789','',NULL,0,0,0);
INSERT INTO OD VALUES (125,'','','3434','','3434','',NULL,0,0,0);
INSERT INTO OD VALUES (126,'','','53','','45','',NULL,0,0,0);

--
-- Table structure for table 'Owner'
--

CREATE TABLE Owner (
  ownerID int(11) NOT NULL auto_increment,
  odID int(11) default NULL,
  rptopID varchar(11) default NULL,
  PRIMARY KEY  (ownerID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Owner'
--


INSERT INTO Owner VALUES (1,1,NULL);
INSERT INTO Owner VALUES (2,2,NULL);
INSERT INTO Owner VALUES (3,3,NULL);
INSERT INTO Owner VALUES (4,4,NULL);
INSERT INTO Owner VALUES (5,5,NULL);
INSERT INTO Owner VALUES (6,6,NULL);
INSERT INTO Owner VALUES (7,7,NULL);
INSERT INTO Owner VALUES (8,8,NULL);
INSERT INTO Owner VALUES (9,9,NULL);
INSERT INTO Owner VALUES (10,10,NULL);
INSERT INTO Owner VALUES (11,11,NULL);
INSERT INTO Owner VALUES (12,12,NULL);
INSERT INTO Owner VALUES (13,13,NULL);
INSERT INTO Owner VALUES (14,14,NULL);
INSERT INTO Owner VALUES (15,15,NULL);
INSERT INTO Owner VALUES (16,16,NULL);
INSERT INTO Owner VALUES (17,17,NULL);
INSERT INTO Owner VALUES (18,18,NULL);
INSERT INTO Owner VALUES (19,19,NULL);
INSERT INTO Owner VALUES (20,20,NULL);
INSERT INTO Owner VALUES (21,21,NULL);
INSERT INTO Owner VALUES (22,22,NULL);
INSERT INTO Owner VALUES (23,23,NULL);
INSERT INTO Owner VALUES (24,24,NULL);
INSERT INTO Owner VALUES (25,25,NULL);
INSERT INTO Owner VALUES (26,26,NULL);
INSERT INTO Owner VALUES (27,27,NULL);
INSERT INTO Owner VALUES (28,28,NULL);
INSERT INTO Owner VALUES (29,29,NULL);
INSERT INTO Owner VALUES (30,30,NULL);
INSERT INTO Owner VALUES (31,31,NULL);
INSERT INTO Owner VALUES (32,32,NULL);
INSERT INTO Owner VALUES (33,33,NULL);
INSERT INTO Owner VALUES (34,34,NULL);
INSERT INTO Owner VALUES (35,35,NULL);
INSERT INTO Owner VALUES (36,36,NULL);
INSERT INTO Owner VALUES (37,37,NULL);
INSERT INTO Owner VALUES (38,38,NULL);
INSERT INTO Owner VALUES (39,39,NULL);
INSERT INTO Owner VALUES (40,40,NULL);
INSERT INTO Owner VALUES (41,41,NULL);
INSERT INTO Owner VALUES (42,42,NULL);
INSERT INTO Owner VALUES (43,43,NULL);
INSERT INTO Owner VALUES (44,44,NULL);
INSERT INTO Owner VALUES (45,45,NULL);
INSERT INTO Owner VALUES (46,46,NULL);
INSERT INTO Owner VALUES (47,47,NULL);
INSERT INTO Owner VALUES (48,48,NULL);
INSERT INTO Owner VALUES (49,49,NULL);
INSERT INTO Owner VALUES (50,50,NULL);
INSERT INTO Owner VALUES (66,51,NULL);
INSERT INTO Owner VALUES (67,52,NULL);
INSERT INTO Owner VALUES (68,53,NULL);
INSERT INTO Owner VALUES (69,54,NULL);
INSERT INTO Owner VALUES (70,55,NULL);
INSERT INTO Owner VALUES (71,56,NULL);
INSERT INTO Owner VALUES (72,57,NULL);
INSERT INTO Owner VALUES (73,58,NULL);
INSERT INTO Owner VALUES (74,59,NULL);
INSERT INTO Owner VALUES (75,60,NULL);
INSERT INTO Owner VALUES (76,61,NULL);
INSERT INTO Owner VALUES (77,62,NULL);
INSERT INTO Owner VALUES (78,63,NULL);
INSERT INTO Owner VALUES (79,64,NULL);
INSERT INTO Owner VALUES (105,NULL,'41');
INSERT INTO Owner VALUES (106,NULL,'42');
INSERT INTO Owner VALUES (107,NULL,'43');
INSERT INTO Owner VALUES (108,NULL,'44');
INSERT INTO Owner VALUES (109,NULL,'45');
INSERT INTO Owner VALUES (110,NULL,'46');
INSERT INTO Owner VALUES (111,65,NULL);
INSERT INTO Owner VALUES (112,NULL,'47');
INSERT INTO Owner VALUES (113,NULL,'48');
INSERT INTO Owner VALUES (114,NULL,'49');
INSERT INTO Owner VALUES (115,NULL,'50');
INSERT INTO Owner VALUES (116,NULL,'51');
INSERT INTO Owner VALUES (117,NULL,'52');
INSERT INTO Owner VALUES (118,66,NULL);
INSERT INTO Owner VALUES (119,NULL,'53');
INSERT INTO Owner VALUES (120,NULL,'54');
INSERT INTO Owner VALUES (121,67,NULL);
INSERT INTO Owner VALUES (122,NULL,'55');
INSERT INTO Owner VALUES (123,68,NULL);
INSERT INTO Owner VALUES (124,69,NULL);
INSERT INTO Owner VALUES (125,70,NULL);
INSERT INTO Owner VALUES (126,71,NULL);
INSERT INTO Owner VALUES (127,NULL,'56');
INSERT INTO Owner VALUES (128,72,NULL);
INSERT INTO Owner VALUES (129,NULL,'57');
INSERT INTO Owner VALUES (130,73,NULL);
INSERT INTO Owner VALUES (131,NULL,'58');
INSERT INTO Owner VALUES (132,74,NULL);
INSERT INTO Owner VALUES (133,75,NULL);
INSERT INTO Owner VALUES (134,NULL,'59');
INSERT INTO Owner VALUES (135,76,NULL);
INSERT INTO Owner VALUES (136,77,NULL);
INSERT INTO Owner VALUES (137,78,NULL);
INSERT INTO Owner VALUES (138,79,NULL);
INSERT INTO Owner VALUES (157,98,NULL);
INSERT INTO Owner VALUES (158,99,NULL);
INSERT INTO Owner VALUES (159,100,NULL);
INSERT INTO Owner VALUES (160,101,NULL);
INSERT INTO Owner VALUES (161,102,NULL);
INSERT INTO Owner VALUES (162,103,NULL);
INSERT INTO Owner VALUES (163,104,NULL);
INSERT INTO Owner VALUES (164,105,NULL);
INSERT INTO Owner VALUES (165,106,NULL);
INSERT INTO Owner VALUES (166,107,NULL);
INSERT INTO Owner VALUES (167,108,NULL);
INSERT INTO Owner VALUES (168,109,NULL);
INSERT INTO Owner VALUES (169,NULL,'60');
INSERT INTO Owner VALUES (170,110,NULL);
INSERT INTO Owner VALUES (171,111,NULL);
INSERT INTO Owner VALUES (172,NULL,'61');
INSERT INTO Owner VALUES (173,NULL,'62');
INSERT INTO Owner VALUES (174,112,NULL);
INSERT INTO Owner VALUES (175,113,NULL);
INSERT INTO Owner VALUES (176,114,NULL);
INSERT INTO Owner VALUES (177,115,NULL);
INSERT INTO Owner VALUES (178,116,NULL);
INSERT INTO Owner VALUES (179,117,NULL);
INSERT INTO Owner VALUES (180,118,NULL);
INSERT INTO Owner VALUES (181,119,NULL);
INSERT INTO Owner VALUES (182,120,NULL);
INSERT INTO Owner VALUES (183,121,NULL);
INSERT INTO Owner VALUES (184,122,NULL);
INSERT INTO Owner VALUES (185,123,NULL);
INSERT INTO Owner VALUES (186,124,NULL);
INSERT INTO Owner VALUES (187,125,NULL);
INSERT INTO Owner VALUES (188,126,NULL);

--
-- Table structure for table 'OwnerCompany'
--

CREATE TABLE OwnerCompany (
  ownerCompanyID int(11) NOT NULL auto_increment,
  ownerID int(11) default NULL,
  companyID int(11) default NULL,
  PRIMARY KEY  (ownerCompanyID)
) TYPE=InnoDB;

--
-- Dumping data for table 'OwnerCompany'
--


INSERT INTO OwnerCompany VALUES (1,1,1);
INSERT INTO OwnerCompany VALUES (2,2,2);
INSERT INTO OwnerCompany VALUES (3,3,3);
INSERT INTO OwnerCompany VALUES (4,4,4);
INSERT INTO OwnerCompany VALUES (5,5,5);
INSERT INTO OwnerCompany VALUES (6,6,6);
INSERT INTO OwnerCompany VALUES (7,7,7);
INSERT INTO OwnerCompany VALUES (8,8,8);
INSERT INTO OwnerCompany VALUES (9,9,9);
INSERT INTO OwnerCompany VALUES (10,10,10);
INSERT INTO OwnerCompany VALUES (11,11,11);
INSERT INTO OwnerCompany VALUES (12,12,12);
INSERT INTO OwnerCompany VALUES (13,13,13);
INSERT INTO OwnerCompany VALUES (14,14,14);
INSERT INTO OwnerCompany VALUES (15,15,15);
INSERT INTO OwnerCompany VALUES (16,16,16);
INSERT INTO OwnerCompany VALUES (17,17,17);
INSERT INTO OwnerCompany VALUES (18,18,18);
INSERT INTO OwnerCompany VALUES (19,19,19);
INSERT INTO OwnerCompany VALUES (20,20,20);
INSERT INTO OwnerCompany VALUES (21,21,21);
INSERT INTO OwnerCompany VALUES (22,22,22);
INSERT INTO OwnerCompany VALUES (23,23,23);
INSERT INTO OwnerCompany VALUES (24,24,24);
INSERT INTO OwnerCompany VALUES (25,25,25);
INSERT INTO OwnerCompany VALUES (26,26,26);
INSERT INTO OwnerCompany VALUES (27,27,27);
INSERT INTO OwnerCompany VALUES (28,28,28);
INSERT INTO OwnerCompany VALUES (29,29,29);
INSERT INTO OwnerCompany VALUES (30,30,30);
INSERT INTO OwnerCompany VALUES (31,31,31);
INSERT INTO OwnerCompany VALUES (32,32,32);
INSERT INTO OwnerCompany VALUES (33,33,33);
INSERT INTO OwnerCompany VALUES (34,34,34);
INSERT INTO OwnerCompany VALUES (35,35,35);
INSERT INTO OwnerCompany VALUES (36,38,36);
INSERT INTO OwnerCompany VALUES (37,45,37);
INSERT INTO OwnerCompany VALUES (38,46,38);
INSERT INTO OwnerCompany VALUES (39,51,2);
INSERT INTO OwnerCompany VALUES (40,52,31);
INSERT INTO OwnerCompany VALUES (41,54,21);
INSERT INTO OwnerCompany VALUES (42,57,33);
INSERT INTO OwnerCompany VALUES (43,58,11);
INSERT INTO OwnerCompany VALUES (44,59,17);
INSERT INTO OwnerCompany VALUES (45,65,37);
INSERT INTO OwnerCompany VALUES (47,50,39);
INSERT INTO OwnerCompany VALUES (55,69,40);
INSERT INTO OwnerCompany VALUES (56,70,41);
INSERT INTO OwnerCompany VALUES (57,72,42);
INSERT INTO OwnerCompany VALUES (58,74,43);
INSERT INTO OwnerCompany VALUES (59,75,44);
INSERT INTO OwnerCompany VALUES (60,78,45);
INSERT INTO OwnerCompany VALUES (70,81,36);
INSERT INTO OwnerCompany VALUES (71,82,5);
INSERT INTO OwnerCompany VALUES (72,83,41);
INSERT INTO OwnerCompany VALUES (73,86,24);
INSERT INTO OwnerCompany VALUES (74,87,24);
INSERT INTO OwnerCompany VALUES (75,90,17);
INSERT INTO OwnerCompany VALUES (76,91,36);
INSERT INTO OwnerCompany VALUES (77,92,17);
INSERT INTO OwnerCompany VALUES (78,94,17);
INSERT INTO OwnerCompany VALUES (79,95,25);
INSERT INTO OwnerCompany VALUES (80,96,42);
INSERT INTO OwnerCompany VALUES (81,97,30);
INSERT INTO OwnerCompany VALUES (82,98,4);
INSERT INTO OwnerCompany VALUES (83,100,2);
INSERT INTO OwnerCompany VALUES (84,101,10);
INSERT INTO OwnerCompany VALUES (85,103,38);
INSERT INTO OwnerCompany VALUES (86,105,35);
INSERT INTO OwnerCompany VALUES (87,106,9);
INSERT INTO OwnerCompany VALUES (88,108,12);
INSERT INTO OwnerCompany VALUES (89,109,3);
INSERT INTO OwnerCompany VALUES (102,112,43);
INSERT INTO OwnerCompany VALUES (104,114,12);
INSERT INTO OwnerCompany VALUES (105,116,12);
INSERT INTO OwnerCompany VALUES (106,117,16);
INSERT INTO OwnerCompany VALUES (107,35,2);
INSERT INTO OwnerCompany VALUES (109,120,10);
INSERT INTO OwnerCompany VALUES (110,118,39);
INSERT INTO OwnerCompany VALUES (119,122,0);
INSERT INTO OwnerCompany VALUES (121,122,0);
INSERT INTO OwnerCompany VALUES (123,122,0);
INSERT INTO OwnerCompany VALUES (125,122,0);
INSERT INTO OwnerCompany VALUES (126,32,39);
INSERT INTO OwnerCompany VALUES (138,122,0);
INSERT INTO OwnerCompany VALUES (148,123,46);
INSERT INTO OwnerCompany VALUES (151,124,49);
INSERT INTO OwnerCompany VALUES (152,124,50);
INSERT INTO OwnerCompany VALUES (153,125,11);
INSERT INTO OwnerCompany VALUES (154,128,1);
INSERT INTO OwnerCompany VALUES (157,129,46);
INSERT INTO OwnerCompany VALUES (165,130,52);
INSERT INTO OwnerCompany VALUES (166,161,53);
INSERT INTO OwnerCompany VALUES (167,161,54);
INSERT INTO OwnerCompany VALUES (168,162,55);
INSERT INTO OwnerCompany VALUES (169,163,56);
INSERT INTO OwnerCompany VALUES (170,168,57);
INSERT INTO OwnerCompany VALUES (171,179,59);

--
-- Table structure for table 'OwnerPerson'
--

CREATE TABLE OwnerPerson (
  ownerPersonID int(11) NOT NULL auto_increment,
  ownerID int(11) default NULL,
  personID int(11) default NULL,
  PRIMARY KEY  (ownerPersonID)
) TYPE=InnoDB;

--
-- Dumping data for table 'OwnerPerson'
--


INSERT INTO OwnerPerson VALUES (1,36,1);
INSERT INTO OwnerPerson VALUES (2,37,2);
INSERT INTO OwnerPerson VALUES (3,39,3);
INSERT INTO OwnerPerson VALUES (4,40,4);
INSERT INTO OwnerPerson VALUES (5,41,5);
INSERT INTO OwnerPerson VALUES (6,42,6);
INSERT INTO OwnerPerson VALUES (7,43,7);
INSERT INTO OwnerPerson VALUES (8,44,8);
INSERT INTO OwnerPerson VALUES (9,47,9);
INSERT INTO OwnerPerson VALUES (10,48,10);
INSERT INTO OwnerPerson VALUES (11,49,11);
INSERT INTO OwnerPerson VALUES (12,50,12);
INSERT INTO OwnerPerson VALUES (13,53,6);
INSERT INTO OwnerPerson VALUES (14,55,4);
INSERT INTO OwnerPerson VALUES (15,56,10);
INSERT INTO OwnerPerson VALUES (16,60,11);
INSERT INTO OwnerPerson VALUES (17,61,7);
INSERT INTO OwnerPerson VALUES (18,62,9);
INSERT INTO OwnerPerson VALUES (19,63,11);
INSERT INTO OwnerPerson VALUES (20,64,1);
INSERT INTO OwnerPerson VALUES (22,50,3);
INSERT INTO OwnerPerson VALUES (31,0,13);
INSERT INTO OwnerPerson VALUES (32,0,14);
INSERT INTO OwnerPerson VALUES (33,0,15);
INSERT INTO OwnerPerson VALUES (34,0,16);
INSERT INTO OwnerPerson VALUES (37,0,17);
INSERT INTO OwnerPerson VALUES (38,0,18);
INSERT INTO OwnerPerson VALUES (39,0,19);
INSERT INTO OwnerPerson VALUES (40,0,20);
INSERT INTO OwnerPerson VALUES (41,0,21);
INSERT INTO OwnerPerson VALUES (58,0,22);
INSERT INTO OwnerPerson VALUES (59,0,23);
INSERT INTO OwnerPerson VALUES (60,50,23);
INSERT INTO OwnerPerson VALUES (61,33,17);
INSERT INTO OwnerPerson VALUES (69,71,24);
INSERT INTO OwnerPerson VALUES (70,73,25);
INSERT INTO OwnerPerson VALUES (71,76,26);
INSERT INTO OwnerPerson VALUES (72,77,27);
INSERT INTO OwnerPerson VALUES (76,79,28);
INSERT INTO OwnerPerson VALUES (83,80,8);
INSERT INTO OwnerPerson VALUES (84,84,22);
INSERT INTO OwnerPerson VALUES (85,85,5);
INSERT INTO OwnerPerson VALUES (86,88,1);
INSERT INTO OwnerPerson VALUES (87,89,20);
INSERT INTO OwnerPerson VALUES (88,93,17);
INSERT INTO OwnerPerson VALUES (89,99,19);
INSERT INTO OwnerPerson VALUES (90,102,20);
INSERT INTO OwnerPerson VALUES (91,104,20);
INSERT INTO OwnerPerson VALUES (92,107,7);
INSERT INTO OwnerPerson VALUES (102,110,9);
INSERT INTO OwnerPerson VALUES (107,110,5);
INSERT INTO OwnerPerson VALUES (109,111,29);
INSERT INTO OwnerPerson VALUES (111,113,21);
INSERT INTO OwnerPerson VALUES (112,115,27);
INSERT INTO OwnerPerson VALUES (113,35,2);
INSERT INTO OwnerPerson VALUES (114,118,30);
INSERT INTO OwnerPerson VALUES (142,119,17);
INSERT INTO OwnerPerson VALUES (146,122,0);
INSERT INTO OwnerPerson VALUES (148,122,0);
INSERT INTO OwnerPerson VALUES (149,122,0);
INSERT INTO OwnerPerson VALUES (150,122,0);
INSERT INTO OwnerPerson VALUES (151,122,0);
INSERT INTO OwnerPerson VALUES (152,122,0);
INSERT INTO OwnerPerson VALUES (153,122,0);
INSERT INTO OwnerPerson VALUES (155,122,0);
INSERT INTO OwnerPerson VALUES (156,122,0);
INSERT INTO OwnerPerson VALUES (157,122,0);
INSERT INTO OwnerPerson VALUES (160,122,0);
INSERT INTO OwnerPerson VALUES (161,122,0);
INSERT INTO OwnerPerson VALUES (162,122,0);
INSERT INTO OwnerPerson VALUES (163,122,0);
INSERT INTO OwnerPerson VALUES (164,122,0);
INSERT INTO OwnerPerson VALUES (165,122,0);
INSERT INTO OwnerPerson VALUES (166,122,0);
INSERT INTO OwnerPerson VALUES (167,122,0);
INSERT INTO OwnerPerson VALUES (170,122,0);
INSERT INTO OwnerPerson VALUES (171,122,0);
INSERT INTO OwnerPerson VALUES (172,122,0);
INSERT INTO OwnerPerson VALUES (173,122,0);
INSERT INTO OwnerPerson VALUES (174,122,0);
INSERT INTO OwnerPerson VALUES (175,122,0);
INSERT INTO OwnerPerson VALUES (176,122,0);
INSERT INTO OwnerPerson VALUES (177,122,0);
INSERT INTO OwnerPerson VALUES (178,122,0);
INSERT INTO OwnerPerson VALUES (179,122,0);
INSERT INTO OwnerPerson VALUES (180,122,0);
INSERT INTO OwnerPerson VALUES (181,122,0);
INSERT INTO OwnerPerson VALUES (182,122,0);
INSERT INTO OwnerPerson VALUES (183,122,0);
INSERT INTO OwnerPerson VALUES (184,122,0);
INSERT INTO OwnerPerson VALUES (185,122,0);
INSERT INTO OwnerPerson VALUES (186,122,0);
INSERT INTO OwnerPerson VALUES (187,122,0);
INSERT INTO OwnerPerson VALUES (188,122,0);
INSERT INTO OwnerPerson VALUES (189,122,0);
INSERT INTO OwnerPerson VALUES (190,122,0);
INSERT INTO OwnerPerson VALUES (191,122,0);
INSERT INTO OwnerPerson VALUES (192,122,0);
INSERT INTO OwnerPerson VALUES (193,122,0);
INSERT INTO OwnerPerson VALUES (194,122,0);
INSERT INTO OwnerPerson VALUES (195,122,0);
INSERT INTO OwnerPerson VALUES (196,122,0);
INSERT INTO OwnerPerson VALUES (197,122,0);
INSERT INTO OwnerPerson VALUES (212,122,0);
INSERT INTO OwnerPerson VALUES (213,122,0);
INSERT INTO OwnerPerson VALUES (226,122,30);
INSERT INTO OwnerPerson VALUES (227,123,34);
INSERT INTO OwnerPerson VALUES (228,124,35);
INSERT INTO OwnerPerson VALUES (230,126,42);
INSERT INTO OwnerPerson VALUES (231,0,44);
INSERT INTO OwnerPerson VALUES (233,128,47);
INSERT INTO OwnerPerson VALUES (235,127,42);
INSERT INTO OwnerPerson VALUES (236,0,58);
INSERT INTO OwnerPerson VALUES (243,129,34);
INSERT INTO OwnerPerson VALUES (245,130,30);
INSERT INTO OwnerPerson VALUES (246,129,17);
INSERT INTO OwnerPerson VALUES (247,129,30);
INSERT INTO OwnerPerson VALUES (248,129,38);
INSERT INTO OwnerPerson VALUES (250,133,63);
INSERT INTO OwnerPerson VALUES (252,135,66);
INSERT INTO OwnerPerson VALUES (253,0,67);
INSERT INTO OwnerPerson VALUES (254,136,74);
INSERT INTO OwnerPerson VALUES (255,134,63);
INSERT INTO OwnerPerson VALUES (256,0,77);
INSERT INTO OwnerPerson VALUES (257,133,30);
INSERT INTO OwnerPerson VALUES (258,137,79);
INSERT INTO OwnerPerson VALUES (260,131,30);
INSERT INTO OwnerPerson VALUES (261,165,99);
INSERT INTO OwnerPerson VALUES (262,166,100);
INSERT INTO OwnerPerson VALUES (263,168,101);
INSERT INTO OwnerPerson VALUES (264,170,102);
INSERT INTO OwnerPerson VALUES (265,174,108);
INSERT INTO OwnerPerson VALUES (266,176,109);
INSERT INTO OwnerPerson VALUES (267,177,110);
INSERT INTO OwnerPerson VALUES (268,178,111);
INSERT INTO OwnerPerson VALUES (269,180,112);
INSERT INTO OwnerPerson VALUES (270,181,114);
INSERT INTO OwnerPerson VALUES (271,0,115);
INSERT INTO OwnerPerson VALUES (272,183,116);
INSERT INTO OwnerPerson VALUES (273,184,117);
INSERT INTO OwnerPerson VALUES (274,185,118);
INSERT INTO OwnerPerson VALUES (275,186,123);
INSERT INTO OwnerPerson VALUES (276,187,124);

--
-- Table structure for table 'Person'
--

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
) TYPE=InnoDB;

--
-- Dumping data for table 'Person'
--


INSERT INTO Person VALUES (1,'Sammy','Cho','Santiago','male','1985-12-24','married','2206337707','553 3960','0919 63824716','In@nisl.com');
INSERT INTO Person VALUES (2,'Natalie','Ziga','Uy','female','1981-06-08','single','7883036426','899 4196','0917 35403669','augue@est.ph');
INSERT INTO Person VALUES (3,'Faustino','Sy','Paterno','male','1987-09-18','married','3342439421','577 3411','0916 78339634','Duis@nibh.ph');
INSERT INTO Person VALUES (4,'Margaret','Pangilinan','Santos','female','1980-07-10','single','6666431726','897 1707','0918 95357136','nulla@fames.org.ph');
INSERT INTO Person VALUES (5,'Rizza','Ku','Sy','female','1987-09-30','single','8418653696','369 1817','0919 92308217','vulputate@sapien.com.ph');
INSERT INTO Person VALUES (6,'Helena','Ayala','Pe','female','1987-12-24','single','2978671110','785 5976','0920 91178730','dapibus@Lorem.org');
INSERT INTO Person VALUES (7,'Maria','Perez','Sy','female','1980-01-08','married','1440594875','375 9044','0920 88586726','posuere@tempus.org.ph');
INSERT INTO Person VALUES (8,'Welwin','Zarachai','Cho','male','1970-01-01','single','987445412','987-9898','0919-6544561','z@d.net');
INSERT INTO Person VALUES (9,'Manny','Sy','Santiago','male','1983-09-17','single','5916196403','397 0346','0916 43035413','amet@ipsum.net');
INSERT INTO Person VALUES (10,'Sammy','Montinola','Remulla','male','1987-10-23','single','7668216447','686 1153','0917 39141408','ipsum@tincidunt.com');
INSERT INTO Person VALUES (11,'Cybele','Cho','Ziga','female','1987-01-26','single','9048206294','758 7253','0917 30921035','amet@Etiam.com');
INSERT INTO Person VALUES (12,'Efren','Paterno','Luna','male','1977-08-22','single','4086659496','769 3033','0917 42555796','Aliquam@et.org');
INSERT INTO Person VALUES (17,'nelson','nelsno','nelson','male','2003-05-13','single','987698789','q','q','nelson@k2ia.com');
INSERT INTO Person VALUES (18,'asdf','asdf','asdf','male','2003-05-13','single','asdf','asdf','asdf','asdf@asdf.com');
INSERT INTO Person VALUES (19,'Zidaniee','Zippididooda','Zenadinnny','female','1970-01-01','others','982343243','445-454544','919-1000010','45@fortyfive.com');
INSERT INTO Person VALUES (20,'Samantah','Blair','Tan','female','1979-05-13','single','asdf','asdf','asdf','asdf@asdf.com');
INSERT INTO Person VALUES (21,'df','df','df','male','2003-05-13','single','df','df','df','df@df.com');
INSERT INTO Person VALUES (22,'asdf','asdf','asdfdfdfdfsadf','male','2003-05-14','single','asdf','asdf','asdf','asdf@asdf.com');
INSERT INTO Person VALUES (23,'Nyadn','Rundsa','Mnemvnoa','male','1974-11-11','single','1111111111','927-1111','0919-8211111','eleven@eleven.com');
INSERT INTO Person VALUES (24,'Beatrice','Chua','Paterno','female','1982-09-04','single','3742934445','954 7223','0916 95448625','eu@montes.com');
INSERT INTO Person VALUES (25,'Ezekiel','Luna','Tan','male','1979-02-14','married','6672398308','498 3275','0916 32455893','elementum@tempus.com.ph');
INSERT INTO Person VALUES (26,'Carol','Reyes','Ziga','female','1989-04-27','single','5029535056','398 8842','0917 69238397','felis@euismod.com');
INSERT INTO Person VALUES (27,'Tammy','Santillan','Ziga','female','1971-12-26','single','4812825611','558 9600','0918 35408679','turpis@pulvinar.com.ph');
INSERT INTO Person VALUES (28,'Allan','Kariton','de la Cruz','male','1970-01-01','single','611-611-8299','1-800-245-2000','0917-450-8000','amosias@globalfrequency.org');
INSERT INTO Person VALUES (29,'Emma','Uy','Montinola','female','1977-04-15','married','9898590085','739 5666','0920 72779875','pede@dapibus.org');
INSERT INTO Person VALUES (30,'Nelson','Miranda','Manlapaz','male','1977-07-09','single','1234567890','09175302791','09175302791','nelson@k2ia.com');
INSERT INTO Person VALUES (31,'none','noen','none','','2003-05-17','','','none','','none@k2ia.com');
INSERT INTO Person VALUES (32,'8798','79','79','','2003-05-17','','','798','','798');
INSERT INTO Person VALUES (33,'970','979','97','','2003-05-17','','','897','','6897');
INSERT INTO Person VALUES (34,'Fausto','Leoquinco','Manlapaz','male','1970-01-01','married','0987654321','6584746','09209202251','istym@yahoo.com');
INSERT INTO Person VALUES (35,'w','w','w','male','2003-05-19','single','w','2414124','23424','nelson@k2ia.com');
INSERT INTO Person VALUES (36,'w','w','w','','2003-05-19','','','w','','w');
INSERT INTO Person VALUES (37,'uyiou','yiu','iuyi','','2003-05-19','','','iuy','','iuyiy');
INSERT INTO Person VALUES (38,'nelson','juan','manlapaz','','2003-05-19','','','lkjlkj','','nelson@k2ia.com');
INSERT INTO Person VALUES (39,'','','','','2003-05-19','','','','','');
INSERT INTO Person VALUES (40,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (41,'','','','','2003-05-19','','','','','');
INSERT INTO Person VALUES (42,'Mae Salvanette','Dator','Leyson','female','1978-10-10','single','123456','6875183','0916-4344952','maan@k2ia.com');
INSERT INTO Person VALUES (43,'','','','','2003-05-19','','','','','');
INSERT INTO Person VALUES (44,'reuben','k2','ravago','male','2003-05-20','married','4234234','234243','234123412','ravage@k2ia.com');
INSERT INTO Person VALUES (45,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (46,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (47,'Jeremiah','Cruz','del Rosario','male','1970-01-01','single','991-342-3876','724.5333','+63917.450.3301','jdrosario@i-next.com');
INSERT INTO Person VALUES (48,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (49,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (50,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (51,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (52,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (53,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (54,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (55,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (56,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (57,'','','','','2003-05-20','','','','','');
INSERT INTO Person VALUES (58,'ncc','ncc','ncc','male','2003-05-20','single','52525245','q','q','nelson@k2ia.com');
INSERT INTO Person VALUES (59,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (60,'Maan','Dator','Leyson','female','1978-10-10','single','123457','123456','123456','maan@k2ia.com');
INSERT INTO Person VALUES (61,'98798','798','987','','2003-05-22','','','57685','','87');
INSERT INTO Person VALUES (62,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (63,'q','q','q','male','2003-05-22','single','q','q','q','q@k2ia.com');
INSERT INTO Person VALUES (64,'1','1','1','','2003-05-22','','','1','','1');
INSERT INTO Person VALUES (65,'2','2','2','','2003-05-22','','','2','','2');
INSERT INTO Person VALUES (66,'Fatima','X.','Asuncion','female','1970-01-01','single','NA','NA','NA','blank@blank.com');
INSERT INTO Person VALUES (67,'SGD. Pamela','M.','Espere','female','2003-05-22','married','NA','NA','NA','NA@NA.com');
INSERT INTO Person VALUES (68,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (69,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (70,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (71,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (72,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (73,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (74,'Esperanza','M.','Casinello','female','2003-05-22','others','NA','NA','NA','NA@NA.com');
INSERT INTO Person VALUES (75,'','','','','2003-05-22','','','','','');
INSERT INTO Person VALUES (76,'','','','','2003-05-27','','','','','');
INSERT INTO Person VALUES (77,'maan','dator','leyson','female','1978-10-10','single','12345','12','12','maan@k2ia.com');
INSERT INTO Person VALUES (78,'','','','','2003-05-27','','','','','');
INSERT INTO Person VALUES (79,'Mike','Doctor','Evidente','male','1970-05-28','married','1234567890','555-5555','666-6666','dontknow@dontask.com');
INSERT INTO Person VALUES (80,'12345','12345','12345','','2003-06-04','','','12345','','12345');
INSERT INTO Person VALUES (81,'','','','','2003-06-04','','','','','');
INSERT INTO Person VALUES (82,'','','','','2003-06-04','','','','','');
INSERT INTO Person VALUES (83,'','','','','2003-06-04','','','','','');
INSERT INTO Person VALUES (84,'','','','','2003-06-04','','','','','');
INSERT INTO Person VALUES (85,'','','','','2003-06-04','','','','','');
INSERT INTO Person VALUES (86,'','','','','2003-06-04','','','','','');
INSERT INTO Person VALUES (87,'1','1','1','','2003-06-04','','','1','','1');
INSERT INTO Person VALUES (88,'11','11','1','','2003-06-04','','','1','','1');
INSERT INTO Person VALUES (89,'2','2','2','','2003-06-04','','','','','');
INSERT INTO Person VALUES (90,'','','','','2003-06-04','','','','','');
INSERT INTO Person VALUES (91,'2','2','2','','2003-06-04','','','','','');
INSERT INTO Person VALUES (92,'1','','1','','2003-06-04','','','','','');
INSERT INTO Person VALUES (93,'2','2','2','','2003-06-04','','','','','');
INSERT INTO Person VALUES (94,'3','3','3','','2003-06-04','','','','','');
INSERT INTO Person VALUES (95,'','','','','2003-06-06','','','','','');
INSERT INTO Person VALUES (96,'','','','','2003-06-09','','','','','');
INSERT INTO Person VALUES (97,'11','11','11','','2003-06-09','','','11','','11');
INSERT INTO Person VALUES (98,'','','','','2003-06-10','','','','','');
INSERT INTO Person VALUES (99,'ghfhfg','hfghfgh','ghfgh','','2003-06-10','','','','','');
INSERT INTO Person VALUES (100,'999','999','999','','2003-06-10','','','','','');
INSERT INTO Person VALUES (101,'Maan','Dator','Leyson','','2003-06-10','','','','','');
INSERT INTO Person VALUES (102,'Neo','Trinity','Morpheus','male','1999-01-01','single','123-456-789','555-5555','0917-555-5555','dontask@dontknow.com');
INSERT INTO Person VALUES (103,'x','z','a','','2003-06-11','','','d','','3');
INSERT INTO Person VALUES (104,'9','j','j','','2003-06-11','','','9','','j');
INSERT INTO Person VALUES (105,'1','1','1','','2003-06-11','','','1','','1');
INSERT INTO Person VALUES (106,'','','','','2003-06-11','','','','','');
INSERT INTO Person VALUES (107,'regina','w','cruz','','2003-06-12','','','4','','4@5.COM');
INSERT INTO Person VALUES (108,'dsfsdf','sdfsdfsdfs','dfsdf','','2003-06-12','','','','','');
INSERT INTO Person VALUES (109,'4444','4444','4444','','2003-06-12','','','','','');
INSERT INTO Person VALUES (110,'888','888','888','','2003-06-12','','','','','');
INSERT INTO Person VALUES (111,'999','999','999','','2003-06-12','','','','','');
INSERT INTO Person VALUES (112,'789','789','789','','2003-06-13','','','','','');
INSERT INTO Person VALUES (113,'fff','fff','fff','','2003-06-13','','','333','','none');
INSERT INTO Person VALUES (114,'testFirstName','testMiddleName','testLastName','','2003-06-13','','','','','');
INSERT INTO Person VALUES (115,'444','444','444','','2003-06-13','','','','','');
INSERT INTO Person VALUES (116,'78910','78910','78910','','2003-06-13','','','','','');
INSERT INTO Person VALUES (117,'78911','78911','78911','','2003-06-13','','','','','');
INSERT INTO Person VALUES (118,'sdfsdf','sdfsdfsdf','dsfsdf','male','2003-06-13','single','sadfsdf','sdfsdf','sdf','nelson@k2ia.com');
INSERT INTO Person VALUES (119,'gf','fghui','uig','','2003-06-13','','','iogi','','gig');
INSERT INTO Person VALUES (120,'rtyrtyr','rtyrtyrty','ytryrtyrty','','2003-06-13','','','yrtyrty','','ryrtyrty');
INSERT INTO Person VALUES (121,'erterter','terterte','ertetrert','','2003-06-13','','','ertetr','','');
INSERT INTO Person VALUES (122,'etrertert','etert','tetert','','2003-06-13','','','tertertetrterterte','','');
INSERT INTO Person VALUES (123,'879','789','789','','2003-06-13','','','','','');
INSERT INTO Person VALUES (124,'454','454','445','','2003-06-13','','','','','');
INSERT INTO Person VALUES (125,'','','','','2003-06-13','','','','','');
INSERT INTO Person VALUES (126,'ihi','gi','iugh','','2003-06-13','','','iyiy','','iyui');

--
-- Table structure for table 'PersonAddress'
--

CREATE TABLE PersonAddress (
  personAddressID int(11) NOT NULL auto_increment,
  personID int(11) NOT NULL default '0',
  addressID int(11) NOT NULL default '0',
  PRIMARY KEY  (personAddressID)
) TYPE=InnoDB;

--
-- Dumping data for table 'PersonAddress'
--


INSERT INTO PersonAddress VALUES (1,1,36);
INSERT INTO PersonAddress VALUES (2,2,37);
INSERT INTO PersonAddress VALUES (3,3,39);
INSERT INTO PersonAddress VALUES (4,4,40);
INSERT INTO PersonAddress VALUES (5,5,41);
INSERT INTO PersonAddress VALUES (6,6,42);
INSERT INTO PersonAddress VALUES (7,7,43);
INSERT INTO PersonAddress VALUES (8,8,44);
INSERT INTO PersonAddress VALUES (9,9,47);
INSERT INTO PersonAddress VALUES (10,10,48);
INSERT INTO PersonAddress VALUES (11,11,49);
INSERT INTO PersonAddress VALUES (12,12,50);
INSERT INTO PersonAddress VALUES (13,8,51);
INSERT INTO PersonAddress VALUES (14,8,52);
INSERT INTO PersonAddress VALUES (15,8,53);
INSERT INTO PersonAddress VALUES (16,8,54);
INSERT INTO PersonAddress VALUES (17,13,56);
INSERT INTO PersonAddress VALUES (18,14,57);
INSERT INTO PersonAddress VALUES (19,15,58);
INSERT INTO PersonAddress VALUES (20,16,59);
INSERT INTO PersonAddress VALUES (21,17,60);
INSERT INTO PersonAddress VALUES (22,18,61);
INSERT INTO PersonAddress VALUES (23,19,62);
INSERT INTO PersonAddress VALUES (24,20,63);
INSERT INTO PersonAddress VALUES (25,21,64);
INSERT INTO PersonAddress VALUES (26,22,65);
INSERT INTO PersonAddress VALUES (27,23,66);
INSERT INTO PersonAddress VALUES (28,24,69);
INSERT INTO PersonAddress VALUES (29,25,71);
INSERT INTO PersonAddress VALUES (30,26,74);
INSERT INTO PersonAddress VALUES (31,27,75);
INSERT INTO PersonAddress VALUES (32,28,77);
INSERT INTO PersonAddress VALUES (33,29,78);
INSERT INTO PersonAddress VALUES (34,30,79);
INSERT INTO PersonAddress VALUES (35,31,80);
INSERT INTO PersonAddress VALUES (36,32,81);
INSERT INTO PersonAddress VALUES (37,33,82);
INSERT INTO PersonAddress VALUES (38,34,83);
INSERT INTO PersonAddress VALUES (39,35,85);
INSERT INTO PersonAddress VALUES (40,36,90);
INSERT INTO PersonAddress VALUES (41,37,91);
INSERT INTO PersonAddress VALUES (42,38,92);
INSERT INTO PersonAddress VALUES (43,39,93);
INSERT INTO PersonAddress VALUES (44,40,94);
INSERT INTO PersonAddress VALUES (45,41,95);
INSERT INTO PersonAddress VALUES (46,42,96);
INSERT INTO PersonAddress VALUES (47,43,97);
INSERT INTO PersonAddress VALUES (48,44,98);
INSERT INTO PersonAddress VALUES (49,45,99);
INSERT INTO PersonAddress VALUES (50,46,100);
INSERT INTO PersonAddress VALUES (51,47,101);
INSERT INTO PersonAddress VALUES (52,48,102);
INSERT INTO PersonAddress VALUES (53,49,103);
INSERT INTO PersonAddress VALUES (54,50,104);
INSERT INTO PersonAddress VALUES (55,51,105);
INSERT INTO PersonAddress VALUES (56,52,106);
INSERT INTO PersonAddress VALUES (57,53,107);
INSERT INTO PersonAddress VALUES (58,54,108);
INSERT INTO PersonAddress VALUES (59,55,109);
INSERT INTO PersonAddress VALUES (60,56,110);
INSERT INTO PersonAddress VALUES (61,57,111);
INSERT INTO PersonAddress VALUES (62,58,112);
INSERT INTO PersonAddress VALUES (63,59,114);
INSERT INTO PersonAddress VALUES (64,60,115);
INSERT INTO PersonAddress VALUES (65,61,117);
INSERT INTO PersonAddress VALUES (66,62,118);
INSERT INTO PersonAddress VALUES (67,63,119);
INSERT INTO PersonAddress VALUES (68,64,120);
INSERT INTO PersonAddress VALUES (69,65,121);
INSERT INTO PersonAddress VALUES (70,66,122);
INSERT INTO PersonAddress VALUES (71,67,123);
INSERT INTO PersonAddress VALUES (72,68,124);
INSERT INTO PersonAddress VALUES (73,69,125);
INSERT INTO PersonAddress VALUES (74,70,126);
INSERT INTO PersonAddress VALUES (75,71,127);
INSERT INTO PersonAddress VALUES (76,72,128);
INSERT INTO PersonAddress VALUES (77,73,129);
INSERT INTO PersonAddress VALUES (78,74,130);
INSERT INTO PersonAddress VALUES (79,75,131);
INSERT INTO PersonAddress VALUES (80,76,132);
INSERT INTO PersonAddress VALUES (81,77,133);
INSERT INTO PersonAddress VALUES (82,78,134);
INSERT INTO PersonAddress VALUES (83,79,135);
INSERT INTO PersonAddress VALUES (84,80,136);
INSERT INTO PersonAddress VALUES (85,81,137);
INSERT INTO PersonAddress VALUES (86,82,138);
INSERT INTO PersonAddress VALUES (87,83,139);
INSERT INTO PersonAddress VALUES (88,84,140);
INSERT INTO PersonAddress VALUES (89,85,141);
INSERT INTO PersonAddress VALUES (90,86,142);
INSERT INTO PersonAddress VALUES (91,87,143);
INSERT INTO PersonAddress VALUES (92,88,144);
INSERT INTO PersonAddress VALUES (93,89,145);
INSERT INTO PersonAddress VALUES (94,90,146);
INSERT INTO PersonAddress VALUES (95,91,147);
INSERT INTO PersonAddress VALUES (96,92,148);
INSERT INTO PersonAddress VALUES (97,93,149);
INSERT INTO PersonAddress VALUES (98,94,150);
INSERT INTO PersonAddress VALUES (99,95,151);
INSERT INTO PersonAddress VALUES (100,97,154);
INSERT INTO PersonAddress VALUES (101,98,156);
INSERT INTO PersonAddress VALUES (102,99,158);
INSERT INTO PersonAddress VALUES (103,100,159);
INSERT INTO PersonAddress VALUES (104,101,160);
INSERT INTO PersonAddress VALUES (105,102,161);
INSERT INTO PersonAddress VALUES (106,103,162);
INSERT INTO PersonAddress VALUES (107,104,163);
INSERT INTO PersonAddress VALUES (108,105,164);
INSERT INTO PersonAddress VALUES (109,106,165);
INSERT INTO PersonAddress VALUES (110,107,168);
INSERT INTO PersonAddress VALUES (111,108,169);
INSERT INTO PersonAddress VALUES (112,109,170);
INSERT INTO PersonAddress VALUES (113,110,171);
INSERT INTO PersonAddress VALUES (114,111,172);
INSERT INTO PersonAddress VALUES (115,112,174);
INSERT INTO PersonAddress VALUES (116,113,175);
INSERT INTO PersonAddress VALUES (117,114,176);
INSERT INTO PersonAddress VALUES (118,115,177);
INSERT INTO PersonAddress VALUES (119,116,178);
INSERT INTO PersonAddress VALUES (120,117,179);
INSERT INTO PersonAddress VALUES (121,118,180);
INSERT INTO PersonAddress VALUES (122,119,181);
INSERT INTO PersonAddress VALUES (123,120,182);
INSERT INTO PersonAddress VALUES (124,121,183);
INSERT INTO PersonAddress VALUES (125,122,184);
INSERT INTO PersonAddress VALUES (126,123,185);
INSERT INTO PersonAddress VALUES (127,124,186);
INSERT INTO PersonAddress VALUES (128,125,187);
INSERT INTO PersonAddress VALUES (129,126,188);

--
-- Table structure for table 'PlantsTrees'
--

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
  PRIMARY KEY  (propertyID)
) TYPE=InnoDB;

--
-- Dumping data for table 'PlantsTrees'
--


INSERT INTO PlantsTrees VALUES (1,1,'1150','1127','','5','4','4','2222100','Commercial','interdum','3332110','7','1232001','1','1010110','15','47','5','2002-12-15','5','2003-02-8','3','2002-12-23','Cum\r\n sociis\r\n natoque\r\n penatib','2003-04-25','314589','2894','eu','638.20','5','3','5','132','3091.72','tincidunt\r\n Donec','56','23101');
INSERT INTO PlantsTrees VALUES (2,1,'1060','8653','','2','1','4','3322101','Industrial','fringilla','2222011','4','1221010','1','1133010','58','20','5','2002-10-17','5','2002-06-6','1','2002-11-3','amet\r\n dapibus\r\n ipsum\r\n nulla\r\n','2002-12-8','651445','1566','ipsum','434.25','71','30','71','136','2260.94','Donec\r\n ipsum','96','21000');
INSERT INTO PlantsTrees VALUES (3,2,'1751','9704','','1','5','5','3132100','Industrial','Nunc','2130001','4','2121100','1','1001010','87','78','2','2003-01-5','3','2003-03-13','1','2003-04-3','fermentum\r\n et\r\n mi\r\n Lorem\r\n ip','2002-08-27','248638','2597','mollis','149.11','69','50','69','103','3356.18','quam\r\n vel','90','22111');
INSERT INTO PlantsTrees VALUES (4,2,'7942','7482','','3','4','2','2031101','Residential','augue','2220000','5','3200000','1','1200011','26','80','1','2002-11-30','2','2003-04-20','5','2003-03-5','aliquet\r\n ac\r\n sagittis\r\n sit\r\n','2003-04-4','849942','7826','velit','345.46','46','46','46','63','1802.60','aliquam\r\n Morbi','7','32000');
INSERT INTO PlantsTrees VALUES (5,3,'9375','9027','','5','1','4','1222000','Residential','mi','1021001','6','2102011','2','2230000','2','39','1','2002-05-29','1','2002-11-11','1','2002-07-17','sit\r\n amet\r\n dapibus\r\n ipsum\r\n n','2002-09-13','872162','9948','Ut sem','129.11','62','55','62','67','228.49','vulputate\r\n et','66','22010');
INSERT INTO PlantsTrees VALUES (6,3,'0010','7824','','2','1','4','3003011','Industrial','turpis','2103110','7','2033100','2','2110101','91','77','1','2002-11-18','3','2002-05-21','1','2002-07-1','habitant\r\n morbi\r\n tristique\r\n s','2003-04-2','477469','1818','et','424.58','75','33','75','198','4560.86','eu\r\n velit','40','31101');
INSERT INTO PlantsTrees VALUES (7,4,'7814','0207','','1','1','5','1023101','Residential','ipsum','3223100','6','2330100','2','2201001','37','59','3','2003-01-2','3','2002-10-24','4','2002-06-30','felis\r\n aliquam\r\n ac\r\n aliquet\r\n','2002-06-25','143791','3485','convallis','74.93','85','79','85','175','86.38','sodales\r\n elit','45','22101');
INSERT INTO PlantsTrees VALUES (8,4,'2517','9576','','2','4','5','3220011','Industrial','velit','1132011','3','3220000','2','2131101','60','91','4','2002-12-25','4','2002-10-16','1','2003-04-21','ipsum\r\n eros\r\n gravida\r\n non\r\n p','2002-09-22','586918','1676','tristique','934.23','51','27','51','90','3163.54','nulla\r\n sollicitudin','75','31110');
INSERT INTO PlantsTrees VALUES (9,4,'6358','6889','','3','1','3','2130011','Industrial','eget','3131011','4','2012110','3','1300011','78','54','3','2002-11-6','2','2003-04-24','5','2003-03-6','Sed\r\n vitae\r\n erat\r\n sit\r\n amet\r','2002-07-1','797986','4678','Nulla','906.78','8','5','8','83','4576.02','nibh\r\n Nulla','1','22001');
INSERT INTO PlantsTrees VALUES (10,5,'5942','7929','','2','2','1','1031010','Commercial','leo','2012110','6','2202101','2','1032101','97','17','3','2002-07-7','1','2002-09-29','2','2003-01-23','lorem\r\n viverra\r\n id\r\n ornare\r\n','2002-06-28','572846','2195','magna','153.97','35','15','35','152','1518.37','viverra\r\n id','32','12110');
INSERT INTO PlantsTrees VALUES (11,5,'9039','8442','','2','4','3','3101110','Commercial','id','3222110','3','3020000','4','3313000','37','81','1','2002-12-5','4','2002-07-4','3','2002-08-15','sollicitudin\r\n sit\r\n amet\r\n nisl','2002-11-10','288922','9877','purus','183.51','5','0','5','159','1555.94','turpis\r\n non','63','21010');
INSERT INTO PlantsTrees VALUES (12,5,'1910','2055','','4','5','3','1223110','Residential','potenti','3230001','4','1101101','2','3312100','20','12','1','2002-06-20','3','2002-11-15','1','2002-07-19','dictum\r\n sapien\r\n purus\r\n consec','2002-05-26','434833','7191','quam','17.52','60','37','60','200','3941.89','eget\r\n elit','69','32010');
INSERT INTO PlantsTrees VALUES (13,6,'6182','0841','','4','1','1','1201010','Commercial','luctus','3033101','4','3110100','2','3321000','77','43','4','2002-07-27','5','2003-05-3','2','2002-07-26','ligula\r\n Nam\r\n quam\r\n metus\r\n co','2002-09-13','844218','1698','lacus','843.84','94','59','94','106','2446.06','Aliquam\r\n rhoncus','99','23100');
INSERT INTO PlantsTrees VALUES (14,6,'9087','5861','','3','1','4','2323010','Commercial','Aenean','3210000','7','1211010','3','3201110','36','71','2','2002-05-13','2','2003-04-16','1','2002-10-19','fermentum\r\n Lorem\r\n ipsum\r\n dolo','2003-03-25','377272','5879','sodales','753.76','5','2','5','64','448.50','orci\r\n luctus','12','32111');
INSERT INTO PlantsTrees VALUES (15,6,'5894','3006','','3','5','1','1320001','Industrial','in','3110110','4','2301101','2','3222100','25','10','4','2002-10-3','1','2002-06-26','3','2002-05-19','tristique\r\n Quisque\r\n interdum\r\n','2002-12-26','543315','8311','faucibus','285.33','45','20','45','114','171.00','vitae\r\n sollicitudin','1','21011');
INSERT INTO PlantsTrees VALUES (16,6,'4748','8679','','5','4','5','2110100','Industrial','In','2131111','7','2332101','4','3212001','0','0','1','2002-07-7','2','2002-07-9','1','2003-02-20','sed\r\n ligula\r\n in\r\n sapien\r\n ull','2003-03-8','678129','7322','commodo','625.64','15','11','15','14','4238.00','enim\r\n Etiam','39','12111');
INSERT INTO PlantsTrees VALUES (17,7,'6284','0939','','3','1','2','3323010','Industrial','dolor','3221000','3','3110111','2','2230110','20','33','1','2002-08-30','5','2003-04-1','2','2003-01-15','ipsum\r\n dolor\r\n sit\r\n amet\r\n con','2002-08-16','687881','5656','tempor','243.25','18','3','18','5','450.71','sit\r\n amet','66','12110');
INSERT INTO PlantsTrees VALUES (18,7,'8725','1406','','5','1','4','1013100','Commercial','Praesent','3331001','1','3102010','3','2003110','6','54','3','2002-09-12','4','2002-08-29','5','2003-01-17','ac\r\n scelerisque\r\n non\r\n semper\r','2002-12-6','582496','1498','libero','557.27','16','4','16','200','4764.48','blandit\r\n ut','33','11101');
INSERT INTO PlantsTrees VALUES (19,7,'8710','6063','','3','2','3','1333110','Industrial','Pellentesque','3100111','4','2123011','4','3100011','91','100','3','2003-02-13','2','2002-08-31','2','2002-10-21','eu\r\n quam\r\n scelerisque\r\n pulvin','2002-07-3','452421','4232','sem','678.34','87','65','87','185','9.44','Nunc\r\n bibendum','28','23010');
INSERT INTO PlantsTrees VALUES (20,8,'3716','5132','','3','4','3','1003111','Commercial','ultrices','2123010','7','1310111','4','3321000','99','35','3','2002-11-21','5','2002-12-14','3','2003-04-14','Pellentesque\r\n nec\r\n magna\r\n Don','2003-03-9','786866','3772','leo','885.87','88','32','88','91','197.83','turpis\r\n ut','46','11100');
INSERT INTO PlantsTrees VALUES (21,8,'2513','5957','','3','2','1','3322000','Residential','ac','2010000','2','1311111','2','1211001','3','5','1','2002-05-22','2','2003-01-22','3','2002-11-7','amet\r\n augue\r\n non\r\n erat\r\n nonu','2002-07-15','114767','6573','morbi','831.29','18','0','18','67','2096.74','massa\r\n Donec','2','21000');
INSERT INTO PlantsTrees VALUES (22,8,'7444','3717','','4','3','3','3220110','Residential','sit','1223000','5','1012000','2','3012111','14','79','3','2003-01-19','4','2003-02-16','4','2002-12-3','libero\r\n Etiam\r\n sit\r\n amet\r\n pe','2002-09-20','667616','9686','dolor','832.35','83','56','83','172','3109.41','sociis\r\n natoque','45','31010');
INSERT INTO PlantsTrees VALUES (23,9,'8908','6880','','1','5','1','2311101','Commercial','laoreet','2102001','5','2013110','8','2100101','56','34','4','2002-11-5','3','2002-09-17','5','2002-08-5','sem\r\n Aliquam\r\n molestie\r\n turpi','2003-01-3','964477','3311','eget','635.33','10','10','10','188','3169.64','fermentum\r\n et','20','33011');
INSERT INTO PlantsTrees VALUES (24,9,'6203','2866','','4','3','5','3130100','Industrial','sit','1130110','2','1213100','3','1031101','98','22','1','2002-11-26','5','2002-09-5','1','2002-09-24','erat\r\n sodales\r\n elementum\r\n Int','2003-03-2','928918','3353','interdum','658.72','60','28','60','120','2147.51','egestas\r\n Praesent','57','33000');
INSERT INTO PlantsTrees VALUES (25,10,'2579','1581','','5','2','3','2212101','Industrial','felis','2033100','6','1201000','7','2213110','59','4','4','2003-02-9','2','2002-05-19','1','2003-05-11','felis\r\n lorem\r\n sollicitudin\r\n e','2002-05-13','666426','3499','euismod','689.39','12','6','12','190','4060.50','sodales\r\n elementum','5','23001');
INSERT INTO PlantsTrees VALUES (26,11,'3480','8467','','5','4','4','1231001','Residential','hac','3033100','6','1132000','11','1033000','95','3','3','2003-03-7','4','2003-02-7','5','2003-04-29','pede\r\n vitae\r\n orci\r\n Integer\r\n','2002-05-15','763731','2393','massa','671.82','34','0','34','178','2802.97','Pellentesque\r\n egestas','84','22110');
INSERT INTO PlantsTrees VALUES (27,11,'4659','7914','','3','4','4','2012101','Commercial','erat','2011000','5','2022110','1','3020110','75','85','3','2002-06-10','2','2002-08-22','5','2002-07-23','nulla\r\n Sed\r\n vitae\r\n erat\r\n sit','2003-05-4','514111','9864','Etiam','65.95','66','0','66','170','3046.00','lectus\r\n urna','65','22110');
INSERT INTO PlantsTrees VALUES (28,11,'6984','7541','','3','2','3','2210101','Residential','erat','2030100','4','3212110','5','2001101','73','47','1','2002-10-31','1','2003-04-23','3','2002-07-16','Duis\r\n est\r\n Cum\r\n sociis\r\n nato','2002-05-18','919132','8675','libero','736.92','74','71','74','159','84.52','et\r\n molestie','72','23100');
INSERT INTO PlantsTrees VALUES (29,12,'6863','6018','','5','1','1','1103110','Industrial','volutpat','2001101','2','1223101','3','3231000','75','75','2','2002-10-14','3','2002-06-17','1','2003-03-9','et\r\n magnis\r\n dis\r\n parturient\r\n','2002-06-19','544717','7386','Aliquam','794.80','63','21','63','144','195.18','in\r\n sapien','42','32100');
INSERT INTO PlantsTrees VALUES (30,12,'9519','9749','','3','1','5','1010010','Residential','sit','3132011','3','1111111','7','2001101','64','74','4','2002-11-7','5','2003-02-16','1','2003-03-5','purus\r\n et\r\n dui\r\n Donec\r\n enim\r','2002-06-17','334398','7822','In','966.39','68','16','68','125','3533.27','tristique\r\n Quisque','46','21111');
INSERT INTO PlantsTrees VALUES (31,12,'4680','3132','','5','3','3','3321000','Residential','nunc','1202110','7','1302000','6','1312011','88','4','3','2002-05-15','5','2002-06-6','5','2003-02-19','eros\r\n in\r\n justo\r\n dignissim\r\n','2002-09-10','225413','4233','eget','293.64','33','23','33','182','4465.06','at\r\n sapien','9','12101');
INSERT INTO PlantsTrees VALUES (32,13,'6400','2636','','2','1','2','1021110','Industrial','purus','1110100','5','2002010','13','3013000','62','52','2','2002-06-2','2','2003-04-1','5','2002-07-7','Pellentesque\r\n habitant\r\n morbi\r','2002-10-11','714415','2391','Nullam','828.10','65','38','65','144','3731.34','vel\r\n risus','79','12001');
INSERT INTO PlantsTrees VALUES (33,14,'3511','6220','','1','4','4','1132011','Commercial','dapibus','2013011','4','2223111','4','2212101','87','17','3','2002-10-11','4','2002-06-21','1','2002-11-20','pellentesque\r\n magna\r\n purus\r\n e','2002-10-5','916695','4221','nec','5.05','24','20','24','40','832.35','vestibulum\r\n ac','83','31001');
INSERT INTO PlantsTrees VALUES (34,15,'4041','4565','','5','3','5','3102100','Commercial','ultricies','1300101','3','3003000','5','2133010','0','44','1','2002-05-30','4','2003-03-2','3','2002-08-31','est\r\n eget\r\n velit\r\n porta\r\n por','2003-04-13','797612','3443','vitae','488.30','5','3','5','146','2391.78','semper\r\n ac','88','21100');
INSERT INTO PlantsTrees VALUES (35,15,'2340','2756','','2','2','2','3232000','Commercial','sed','1020001','3','1330110','11','3230001','23','49','2','2002-06-24','3','2002-12-7','2','2002-12-26','pellentesque\r\n et\r\n molestie\r\n v','2002-09-14','119912','4622','Phasellus','201.17','25','14','25','148','4414.40','hac\r\n habitasse','64','32110');
INSERT INTO PlantsTrees VALUES (36,16,'0848','3327','','5','5','5','1301101','Industrial','Ut','3031011','6','2011011','10','2201001','35','81','4','2003-01-31','1','2002-06-6','2','2003-04-3','ac\r\n sagittis\r\n sit\r\n amet\r\n orc','2002-10-19','128572','3167','tempus','190.59','58','3','58','162','3814.98','lorem\r\n sollicitudin','1','12100');
INSERT INTO PlantsTrees VALUES (37,16,'8835','1563','','3','3','2','1122110','Commercial','est','1213010','7','1012000','1','2210111','88','60','4','2002-06-2','4','2003-04-23','2','2003-01-6','dui\r\n Phasellus\r\n cursus\r\n justo','2002-06-15','221441','1251','nibh','150.51','91','69','91','77','2758.54','quam\r\n vel','80','22101');
INSERT INTO PlantsTrees VALUES (38,16,'5589','6145','','4','2','2','1123011','Commercial','urna','2232010','3','1213010','11','3322010','74','79','5','2002-10-13','4','2002-11-26','5','2003-05-3','scelerisque\r\n pulvinar\r\n Nulla\r\n','2002-05-14','434973','8777','et','155.65','29','7','29','91','4498.46','tristique\r\n senectus','92','23000');
INSERT INTO PlantsTrees VALUES (39,17,'1628','5134','','3','5','3','2320000','Commercial','posuere','1020000','5','3301010','11','2331001','21','0','5','2002-11-28','3','2003-03-27','3','2002-10-12','consectetuer\r\n tristique\r\n Quisq','2002-11-23','762345','9796','at','512.69','95','41','95','152','2933.47','rutrum\r\n massa','55','33011');
INSERT INTO PlantsTrees VALUES (40,18,'2393','8578','','4','4','3','2333110','Industrial','Nam','2223010','6','3123000','15','2321000','58','55','1','2002-09-14','2','2003-02-9','3','2002-08-25','magna\r\n purus\r\n et\r\n felis\r\n Dui','2002-08-9','675169','8277','semper','302.01','33','12','33','190','1497.36','massa\r\n Donec','38','12100');
INSERT INTO PlantsTrees VALUES (41,19,'9731','3146','','5','2','4','2211110','Commercial','amet','1200101','6','2223101','3','2113000','62','4','1','2003-01-19','4','2003-03-18','1','2003-04-24','Nam\r\n ac\r\n dolor\r\n quis\r\n quam\r\n','2002-11-8','295422','8311','justo','170.00','84','28','84','129','1916.73','neque\r\n non','88','12001');
INSERT INTO PlantsTrees VALUES (42,19,'3920','3377','','4','2','2','2032100','Residential','sem','3230000','6','1333011','13','1322100','96','22','5','2002-08-13','1','2002-10-1','2','2002-08-16','erat\r\n sit\r\n amet\r\n est\r\n fringi','2002-06-9','891741','7239','Ut','678.63','50','5','50','100','4640.70','nibh\r\n non','21','31110');
INSERT INTO PlantsTrees VALUES (43,19,'3186','1890','','5','1','3','1002001','Industrial','velit','1123111','3','3333010','8','1133000','9','63','4','2002-07-3','5','2002-11-17','3','2002-10-26','eros\r\n Curabitur\r\n eleifend\r\n gr','2002-12-18','938469','3385','dis','748.35','51','13','51','34','3706.64','ligula\r\n vel','70','21011');
INSERT INTO PlantsTrees VALUES (44,20,'1967','2372','','3','5','2','2213111','Residential','hac','2302111','2','2030001','14','3212100','3','9','2','2003-02-10','4','2002-09-18','2','2003-02-21','consectetuer\r\n tristique\r\n Quisq','2002-05-21','535982','7941','erat','836.44','6','1','6','45','3020.30','Pellentesque\r\n eget','45','13010');
INSERT INTO PlantsTrees VALUES (45,20,'7826','9938','','3','1','1','3302000','Industrial','diam','1220100','5','2203010','7','1121101','78','38','3','2003-01-24','5','2003-02-20','2','2003-01-30','gravida\r\n non\r\n placerat\r\n vel\r\n','2002-11-10','143886','1835','vel','154.53','22','16','22','44','3365.82','vel\r\n pharetra','56','23101');
INSERT INTO PlantsTrees VALUES (46,21,'9300','4958','','3','3','4','2030111','Residential','quis','2210111','7','1123000','16','2201101','51','68','5','2002-10-13','2','2002-07-19','1','2002-08-1','quis\r\n enim\r\n Etiam\r\n non\r\n metu','2002-10-21','274612','7686','pede','913.32','72','67','72','170','1677.50','dolor\r\n eu','78','12111');
INSERT INTO PlantsTrees VALUES (47,21,'4268','6654','','1','3','5','1001010','Industrial','risus','2223001','1','2331110','15','2101011','68','98','3','2002-07-1','3','2003-05-11','3','2002-09-4','sit\r\n amet\r\n orci\r\n Etiam\r\n vive','2003-04-13','655534','6672','elit','118.07','5','5','5','57','3850.54','est\r\n nulla','1','21101');
INSERT INTO PlantsTrees VALUES (48,22,'1386','9932','','4','1','4','2133110','Residential','eget','2222100','5','2121000','12','2300001','44','83','3','2002-05-30','2','2002-09-15','4','2002-08-19','in\r\n iaculis\r\n quis\r\n velit\r\n In','2002-08-1','464124','6653','dui','812.91','43','24','43','172','900.63','sociis\r\n natoque','88','21000');
INSERT INTO PlantsTrees VALUES (49,22,'4999','4893','','1','3','4','1013101','Industrial','et','2020101','4','1312111','4','3110111','58','52','1','2002-07-13','4','2002-08-18','2','2003-04-26','est\r\n Quisque\r\n lorem\r\n nulla\r\n','2003-04-21','376898','3256','eu','706.88','50','10','50','126','32.38','elit\r\n Nam','47','13111');
INSERT INTO PlantsTrees VALUES (50,22,'4796','2697','','3','1','3','2221100','Commercial','varius','1211110','1','2303010','17','2110100','71','69','4','2003-05-9','3','2002-09-2','4','2002-11-1','leo\r\n at\r\n lorem\r\n Nam\r\n pretium','2002-06-20','591831','2698','pellentesque','828.71','41','15','41','134','1372.36','et\r\n molestie','38','23110');
INSERT INTO PlantsTrees VALUES (51,23,'4850','3760','','2','5','4','3102011','Commercial','et','3221111','7','1113001','2','1212010','30','30','2','2002-11-6','1','2003-01-6','5','2003-04-13','Quisque\r\n interdum\r\n tempus\r\n er','2003-01-23','315547','7631','nunc','463.59','72','11','72','23','2458.74','dapibus\r\n in','76','33110');
INSERT INTO PlantsTrees VALUES (52,24,'0798','4876','','1','5','4','2302100','Residential','viverra','1113101','1','3203011','13','3231101','14','6','5','2003-02-3','3','2002-11-18','1','2003-02-5','Donec\r\n ipsum\r\n eros\r\n gravida\r\n','2003-05-9','671812','1887','pede','903.41','38','35','38','128','1450.18','dictumst\r\n Cum','19','32000');
INSERT INTO PlantsTrees VALUES (53,24,'8687','7875','','1','1','1','3331001','Industrial','vestibulum','2321000','3','2222101','23','3112010','34','52','2','2003-04-12','1','2002-10-1','2','2003-04-21','non\r\n nibh\r\n Nam\r\n et\r\n magna\r\n','2002-06-3','328429','8336','in','730.77','49','26','49','174','4146.38','urna\r\n Nullam','28','12010');
INSERT INTO PlantsTrees VALUES (54,24,'2417','4790','','1','4','2','1222110','Residential','aliquet','3301001','5','1131101','21','3130101','83','8','2','2002-05-22','5','2002-10-30','4','2003-05-2','dolor\r\n eu\r\n elit\r\n Nunc\r\n biben','2002-08-19','226797','5281','eget','612.56','69','67','69','115','1009.18','ipsum\r\n eros','67','31110');
INSERT INTO PlantsTrees VALUES (55,25,'3050','4948','','3','2','5','1002111','Industrial','posuere','1011100','5','3130000','17','2122011','12','20','3','2003-02-27','2','2002-12-1','5','2003-03-5','enim\r\n ultrices\r\n malesuada\r\n Pr','2003-02-6','664442','3574','nonummy','909.88','71','63','71','131','3721.18','Nam\r\n et','59','21101');
INSERT INTO PlantsTrees VALUES (56,25,'5754','0974','','3','3','1','1201111','Commercial','malesuada','3013101','1','3301000','11','3202100','70','14','5','2002-07-2','3','2002-09-22','2','2002-08-3','et\r\n magnis\r\n dis\r\n parturient\r\n','2003-03-8','963982','2992','Vestibulum','603.57','99','40','99','124','2775.49','Nam\r\n est','100','31111');
INSERT INTO PlantsTrees VALUES (57,26,'1979','4258','','5','4','3','2002100','Residential','ac','2103001','6','1033110','16','1300111','99','35','3','2002-12-20','1','2002-07-8','5','2003-01-13','augue\r\n id\r\n orci\r\n Ut\r\n non\r\n l','2002-11-29','274772','2262','mi','882.94','75','75','75','157','862.40','non\r\n neque','87','22110');
INSERT INTO PlantsTrees VALUES (58,26,'9590','5636','','5','1','4','3023110','Industrial','molestie','1320000','5','1030001','19','2101011','97','66','3','2002-07-22','3','2002-09-6','5','2002-06-13','scelerisque\r\n enim\r\n Cras\r\n vita','2002-06-26','254933','5512','eleifend','736.60','79','76','79','46','3894.82','Quisque\r\n diam','18','13010');
INSERT INTO PlantsTrees VALUES (59,26,'1158','7779','','3','1','4','1232011','Commercial','quis','1331111','6','2110100','15','1033001','18','34','4','2003-04-24','3','2002-11-4','3','2002-09-9','nisl\r\n sed\r\n nunc\r\n cursus\r\n dic','2002-09-15','199114','8233','Nam','842.61','69','30','69','57','3193.59','Nunc\r\n volutpat','32','12001');
INSERT INTO PlantsTrees VALUES (60,27,'8675','4617','','1','4','5','2011001','Residential','ligula','3322101','6','3202111','24','2322001','90','44','3','2002-06-26','1','2003-03-9','4','2002-06-27','gravida\r\n pede\r\n Proin\r\n sollici','2003-02-14','321743','9129','nascetur','262.80','20','6','20','60','862.51','ornare\r\n ut','2','33001');
INSERT INTO PlantsTrees VALUES (61,27,'0506','5814','','3','1','4','2133100','Industrial','enim','2222000','6','2103001','27','3210101','94','97','1','2002-05-17','5','2002-11-24','2','2002-06-8','nec\r\n arcu\r\n adipiscing\r\n tincid','2003-05-9','155858','4845','ut','23.79','40','2','40','161','324.95','amet\r\n libero','83','33011');
INSERT INTO PlantsTrees VALUES (62,27,'3968','4181','','4','3','5','3213011','Industrial','lorem','2220111','3','1323010','5','1231111','31','24','5','2002-09-14','5','2002-10-2','1','2002-10-5','eu\r\n interdum\r\n ac\r\n felis\r\n In\r','2002-06-8','517851','9543','eleifend','280.51','73','13','73','155','3657.87','varius\r\n malesuada','82','11111');
INSERT INTO PlantsTrees VALUES (63,28,'6916','7885','','1','3','5','2130100','Commercial','Nulla','2201011','4','3120001','1','3202111','78','10','5','2002-08-3','3','2003-02-15','1','2002-07-12','et\r\n felis\r\n Duis\r\n est\r\n Cum\r\n','2002-12-18','135489','7345','habitasse','596.19','43','4','43','20','1179.95','orci\r\n Integer','92','31000');
INSERT INTO PlantsTrees VALUES (64,29,'7052','7767','','5','5','3','1231011','Residential','In','1032001','3','1321000','16','1013000','56','6','1','2002-06-16','5','2003-04-12','5','2002-06-10','Ut\r\n sit\r\n amet\r\n libero\r\n Lorem','2002-10-29','749737','5935','pretium','908.62','73','7','73','176','2227.12','et\r\n enim','80','31110');
INSERT INTO PlantsTrees VALUES (65,30,'6429','8895','','2','4','4','2121011','Commercial','interdum','2300010','7','2220110','4','2333001','6','35','4','2002-10-10','4','2002-06-14','1','2002-06-6','eros\r\n Curabitur\r\n eleifend\r\n gr','2003-01-5','552863','2523','Nam','793.64','79','60','79','180','809.37','consectetuer\r\n mauris','16','22010');
INSERT INTO PlantsTrees VALUES (66,30,'7834','9080','','3','5','2','1022000','Commercial','ipsum','3301011','3','2001100','7','3023001','2','38','4','2002-09-15','5','2002-08-27','1','2002-05-22','Aliquam\r\n eget\r\n ligula\r\n Nam\r\n','2003-01-30','692464','9679','in','396.26','63','4','63','148','4706.76','scelerisque\r\n enim','22','23001');
INSERT INTO PlantsTrees VALUES (67,31,'3283','7372','','3','5','5','1001100','Industrial','enim','3310001','2','2223000','8','3223100','97','48','4','2002-09-9','2','2002-09-29','2','2002-12-10','Nulla\r\n felis\r\n lorem\r\n sollicit','2002-09-11','514761','3295','vel','596.23','17','12','17','17','2968.85','augue\r\n non','9','13111');
INSERT INTO PlantsTrees VALUES (68,31,'9353','6080','','5','1','1','2302001','Industrial','ridiculus','3033110','4','2123001','3','1023111','41','39','2','2002-09-6','5','2002-12-25','3','2002-07-25','magna\r\n nec\r\n ligula\r\n condiment','2002-11-22','783366','6968','ac','834.18','6','6','6','142','4726.98','ipsum\r\n Pellentesque','47','32001');
INSERT INTO PlantsTrees VALUES (69,31,'2821','9166','','5','2','2','2120110','Commercial','interdum','2333010','5','2232000','1','2010011','49','40','2','2002-09-13','5','2002-07-6','3','2002-09-28','et\r\n enim\r\n In\r\n risus\r\n risus\r\n','2002-12-3','962124','3948','sem','33.20','72','62','72','24','23.92','mollis\r\n sodales','31','12111');
INSERT INTO PlantsTrees VALUES (70,32,'8129','1203','','5','1','1','3332010','Residential','tellus','3310010','7','1321000','2','3123010','66','73','1','2002-07-8','3','2003-03-3','3','2003-01-25','tempor\r\n nec\r\n auctor\r\n eget\r\n v','2002-10-12','981184','3156','risus','841.65','60','15','60','88','2673.24','fermentum\r\n Lorem','85','31101');
INSERT INTO PlantsTrees VALUES (71,33,'5070','9348','','2','5','2','1011010','Commercial','consectetuer','1233011','1','2310101','2','2300010','3','73','1','2002-07-13','3','2003-02-17','3','2003-02-23','dictum\r\n dictum\r\n sapien\r\n purus','2002-09-5','533517','4179','sodales','696.60','48','30','48','116','3531.48','Quisque\r\n diam','24','32100');
INSERT INTO PlantsTrees VALUES (72,33,'1707','6021','','3','5','5','2311000','Commercial','ac','1313000','3','1120110','2','2132001','0','76','2','2002-06-28','1','2002-06-11','4','2003-04-15','ipsum\r\n dolor\r\n sit\r\n amet\r\n con','2002-12-23','376987','7116','Etiam','222.40','23','12','23','31','740.84','Nulla\r\n quis','43','32110');
INSERT INTO PlantsTrees VALUES (73,34,'4796','2734','','1','2','1','3002100','Residential','Lorem','1032010','3','3012101','2','1002110','30','11','1','2002-08-2','5','2003-04-30','1','2002-09-3','nec\r\n enim\r\n ultrices\r\n malesuad','2003-01-25','965415','9566','posuere','831.96','66','46','66','51','3200.57','lorem\r\n viverra','85','31110');
INSERT INTO PlantsTrees VALUES (74,34,'4801','0695','','2','4','3','3111011','Residential','non','2202111','6','2002000','18','3113010','84','88','3','2003-05-5','2','2002-08-29','5','2002-05-20','ligula\r\n condimentum\r\n posuere\r\n','2003-05-2','463845','3288','est','79.85','27','9','27','10','1002.63','sit\r\n amet','30','12000');
INSERT INTO PlantsTrees VALUES (75,35,'3893','6018','','5','3','1','2312101','Commercial','pretium','2011011','7','1310000','17','1211110','20','45','5','2002-11-8','4','2002-05-15','2','2002-09-14','sollicitudin\r\n sit\r\n amet\r\n nisl','2002-12-14','262843','5491','pellentesque','95.53','1','0','1','40','3686.57','pulvinar\r\n ac','12','12110');
INSERT INTO PlantsTrees VALUES (76,35,'2684','1086','','4','5','2','2122110','Residential','tempor','3233101','6','2221011','20','1100111','56','1','4','2002-07-4','4','2002-08-22','3','2002-05-18','sollicitudin\r\n sit\r\n amet\r\n nisl','2002-09-22','887889','2167','In','624.95','34','26','34','192','2639.68','eleifend\r\n gravida','41','21010');
INSERT INTO PlantsTrees VALUES (77,36,'4079','8969','1','1','3','1','2132100','Commercial','dis','2033010','7','2021111','34','3103010','78','46','1','2003-04-26','3','2002-08-22','2','2002-07-10','amet\r\n posuere\r\n metus\r\n velit\r\n','2002-11-5','843991','8877','est','48.03','28','10','28','118','4516.50','viverra\r\n Nulla','42','13110');
INSERT INTO PlantsTrees VALUES (78,37,'1194','8838','2','2','5','5','2330000','Industrial','ridiculus','2201011','2','2132110','25','1033100','79','53','1','2002-07-11','1','2002-07-7','2','2002-09-1','ipsum\r\n Aliquam\r\n eget\r\n ligula\r','2002-10-28','111915','3931','Pellentesque','126.65','13','11','13','72','2255.60','pede\r\n porttitor','64','13110');
INSERT INTO PlantsTrees VALUES (79,37,'7944','3093','2','5','3','1','1230000','Industrial','ipsum','3223111','1','3222110','34','3001001','61','51','1','2003-02-16','3','2002-09-11','3','2003-02-15','adipiscing\r\n Pellentesque\r\n habi','2002-12-29','342184','9385','habitasse','725.77','25','11','25','27','4272.77','Donec\r\n fringilla','52','23101');
INSERT INTO PlantsTrees VALUES (80,37,'6920','5110','1','5','5','3','3302110','Residential','In','3110000','1','2013000','3','2303101','73','65','3','2002-10-12','1','2002-08-23','1','2002-06-18','amet\r\n orci\r\n Etiam\r\n viverra\r\n','2003-05-10','459617','1796','vel','606.27','28','3','28','87','4337.34','id\r\n orci','81','32010');
INSERT INTO PlantsTrees VALUES (81,38,'6319','3159','2','5','4','1','3220001','Commercial','scelerisque','3031000','2','3213101','31','2022001','27','58','2','2003-01-23','3','2002-09-28','4','2002-09-9','sollicitudin\r\n vel\r\n blandit\r\n u','2002-11-24','772156','4212','quam','779.94','93','23','93','184','34.52','interdum\r\n scelerisque','4','21100');
INSERT INTO PlantsTrees VALUES (82,39,'8904','7627','2','4','4','3','1000001','Residential','sit','2122000','5','1020111','19','1013011','84','18','4','2003-04-3','2','2002-10-8','4','2002-11-2','sociis\r\n natoque\r\n penatibus\r\n e','2003-04-30','425388','8587','neque','194.77','22','13','22','100','4961.92','montes\r\n nascetur','28','33100');
INSERT INTO PlantsTrees VALUES (83,39,'4481','4570','3','3','2','4','1102100','Industrial','Cras','2202110','7','3313010','29','1133001','13','2','2','2002-11-7','1','2002-11-6','3','2002-12-22','sodales\r\n elementum\r\n Integer\r\n','2003-01-15','138498','9836','purus','438.37','20','14','20','199','49.21','amet\r\n libero','11','11110');
INSERT INTO PlantsTrees VALUES (84,39,'7867','9886','1','5','5','4','3000111','Residential','non','3103011','5','3023100','34','2010000','30','96','1','2002-05-17','3','2002-10-17','4','2002-07-12','Ut\r\n turpis\r\n nisl\r\n consequat\r\n','2002-06-8','554272','7942','et','230.63','14','6','14','95','4521.79','sapien\r\n Morbi','90','21100');
INSERT INTO PlantsTrees VALUES (85,39,'1118','9779','3','3','5','2','1201110','Residential','Maecenas','2313010','1','1211111','13','1123101','64','19','5','2003-04-10','1','2002-06-26','3','2003-05-6','elit\r\n Nunc\r\n bibendum\r\n turpis\r','2002-08-11','841358','6915','nunc','98.69','2','1','2','23','4813.28','imperdiet\r\n neque','78','21011');
INSERT INTO PlantsTrees VALUES (86,40,'3968','5961','2','4','2','3','3130000','Industrial','pede','2012010','2','2310101','22','2200010','90','38','1','2003-03-12','4','2002-06-18','4','2002-08-7','malesuada\r\n fames\r\n ac\r\n turpis\r','2002-10-6','984736','7339','sit','570.61','36','9','36','167','4254.31','massa\r\n purus','44','13010');
INSERT INTO PlantsTrees VALUES (87,40,'0921','9910','2','2','4','1','3011010','Residential','adipiscing','1322110','7','3130000','12','3232001','20','71','2','2003-04-20','1','2002-06-12','3','2003-02-20','urna\r\n faucibus\r\n ac\r\n pretium\r\n','2002-07-10','459935','6834','et','628.50','35','9','35','32','279.82','Quisque\r\n tristique','10','33111');
INSERT INTO PlantsTrees VALUES (88,41,'9084','9051','3','3','4','2','2201101','Residential','vestibulum','2111011','6','3120111','3','3130111','55','43','5','2003-04-14','1','2002-12-26','3','2003-04-22','Cras\r\n vitae\r\n lacus\r\n id\r\n eros','2003-04-24','438482','1629','Quisque','114.17','69','8','69','68','1313.25','justo\r\n Phasellus','74','33000');
INSERT INTO PlantsTrees VALUES (89,41,'5024','9115','5','1','1','2','2030011','Commercial','natoque','2103000','1','3232110','25','2200011','55','29','1','2003-04-1','5','2002-07-3','1','2003-04-26','nulla\r\n consequat\r\n quis\r\n pulvi','2003-04-26','954835','3245','Donec','923.81','12','8','12','157','2360.17','nec\r\n magna','1','31001');
INSERT INTO PlantsTrees VALUES (90,41,'7315','9292','4','5','3','5','2212001','Commercial','pede','2121000','7','1002000','37','1312011','44','100','5','2003-01-29','2','2002-08-19','5','2003-05-2','Nulla\r\n tempor\r\n justo\r\n et\r\n va','2003-03-24','554616','6873','risus','446.52','48','16','48','193','2087.86','est\r\n fringilla','75','23100');
INSERT INTO PlantsTrees VALUES (91,41,'8198','2157','2','1','4','4','2122111','Residential','Morbi','2332110','1','2122000','25','2010111','46','78','1','2002-07-4','2','2003-03-31','2','2003-04-7','est\r\n eget\r\n velit\r\n porta\r\n por','2002-08-27','964852','2792','quis','94.01','72','19','72','12','4563.25','velit\r\n leo','83','13000');
INSERT INTO PlantsTrees VALUES (92,41,'4625','8526','5','5','2','4','1312111','Residential','risus','1023000','5','1112011','1','2210001','46','34','3','2002-07-19','4','2003-03-30','2','2002-10-21','et\r\n magnis\r\n dis\r\n parturient\r\n','2002-09-26','971533','3155','tincidunt','246.82','42','4','42','15','2451.26','arcu\r\n adipiscing','36','23011');
INSERT INTO PlantsTrees VALUES (93,42,'1446','2669','5','1','1','3','1011011','Residential','purus','3213101','3','3103011','30','2202101','39','94','5','2002-12-1','1','2002-08-8','5','2002-09-15','laoreet\r\n eget\r\n est\r\n Quisque\r\n','2003-02-16','837141','3666','non','548.72','52','26','52','67','1558.31','ac\r\n iaculis','72','21011');
INSERT INTO PlantsTrees VALUES (94,42,'2244','5576','4','2','3','5','3212100','Commercial','auctor','1113000','2','1120110','5','1122010','26','59','3','2003-03-16','3','2002-12-19','1','2003-01-9','primis\r\n in\r\n faucibus\r\n orci\r\n','2003-04-6','932533','3796','convallis','500.67','13','3','13','131','1863.08','sapien\r\n ullamcorper','32','12010');
INSERT INTO PlantsTrees VALUES (95,43,'7024','2147','3','5','3','1','1221101','Residential','purus','2333110','5','2032011','20','1230100','55','99','1','2002-07-27','4','2003-04-1','1','2002-12-16','et\r\n magna\r\n nec\r\n ligula\r\n cond','2002-12-17','961857','7981','scelerisque','344.55','97','86','97','42','4687.96','amet\r\n enim','9','21011');
INSERT INTO PlantsTrees VALUES (96,43,'8497','4780','4','5','2','4','3212101','Commercial','volutpat','3020000','7','1031110','29','2023110','56','9','4','2002-12-16','2','2002-07-4','2','2002-10-7','erat\r\n Vivamus\r\n convallis\r\n vel','2002-06-23','898139','5314','pretium','1000.96','59','54','59','7','4958.33','eleifend\r\n quam','47','11100');
INSERT INTO PlantsTrees VALUES (97,44,'4511','1063','7','5','1','4','2021110','Residential','montes','2232011','5','3220001','20','3213101','34','43','2','2002-08-11','1','2002-08-4','3','2002-10-14','est\r\n Vestibulum\r\n sed\r\n ligula\r','2002-12-10','179592','4948','montes','219.49','17','17','17','54','2392.64','ullamcorper\r\n viverra','18','23001');
INSERT INTO PlantsTrees VALUES (98,44,'3444','9432','4','3','2','5','2033001','Commercial','vitae','1310111','2','3321011','19','2301111','11','27','1','2002-09-13','2','2002-10-29','5','2002-08-10','in\r\n fermentum\r\n et\r\n mi\r\n Lorem','2002-05-23','271119','5793','cubilia','330.73','40','3','40','39','2052.80','Nam\r\n id','15','11101');
INSERT INTO PlantsTrees VALUES (99,44,'1708','9641','2','5','4','4','2231111','Commercial','Fusce','2221110','2','2233001','40','1231101','43','12','5','2002-12-27','1','2003-05-7','3','2002-09-30','Maecenas\r\n odio\r\n pede\r\n auctor\r','2002-07-10','597853','4952','feugiat','547.07','91','54','91','61','443.91','in\r\n vehicula','12','31011');
INSERT INTO PlantsTrees VALUES (100,45,'7377','1139','6','5','2','5','3102110','Residential','pellentesque','1300000','6','2132110','4','1322100','56','79','4','2003-03-5','3','2002-09-19','4','2002-12-28','amet\r\n consectetuer\r\n adipiscing','2002-08-7','544729','5716','eget','880.51','31','29','31','142','3816.34','vitae\r\n orci','4','11000');
INSERT INTO PlantsTrees VALUES (101,45,'7982','9297','8','1','3','1','2330100','Industrial','mauris','3032101','6','2212010','30','2002010','76','42','1','2002-08-7','4','2003-04-13','2','2002-11-1','ac\r\n nulla\r\n Sed\r\n vitae\r\n erat\r','2002-08-15','751724','8539','ac','876.17','88','43','88','171','2457.34','pede\r\n vel','65','13101');
INSERT INTO PlantsTrees VALUES (102,45,'1486','5443','8','1','3','2','2123000','Commercial','In','3333010','1','3233111','11','3211010','39','44','2','2002-07-15','5','2002-08-31','3','2002-12-26','et\r\n magnis\r\n dis\r\n parturient\r\n','2003-03-4','318841','2847','dis','761.11','4','1','4','25','1434.79','scelerisque\r\n non','47','21111');
INSERT INTO PlantsTrees VALUES (103,46,'7313','6046','7','4','4','4','3123100','Industrial','Sed','1203111','5','3111111','12','1120101','34','75','3','2002-12-25','3','2002-07-7','1','2002-12-25','Pellentesque\r\n egestas\r\n diam\r\n','2002-12-30','936231','6513','amet','964.06','15','11','15','164','4313.17','viverra\r\n Nulla','37','31111');
INSERT INTO PlantsTrees VALUES (104,46,'2760','8363','3','5','4','2','3300100','Commercial','sapien','3311011','6','1133110','9','3202010','24','3','3','2002-11-7','1','2002-11-15','5','2002-11-29','nulla\r\n cursus\r\n viverra\r\n In\r\n','2002-12-14','676387','7722','sapien','528.41','2','2','2','194','3297.91','quam\r\n metus','38','21000');
INSERT INTO PlantsTrees VALUES (105,47,'5419','4212','7','1','2','2','1301101','Commercial','eget','1102100','5','2322100','9','2030110','66','15','3','2002-08-8','1','2002-11-9','5','2003-01-15','condimentum\r\n malesuada\r\n Mauris','2002-09-17','593268','3993','eleifend','363.36','20','5','20','190','3874.09','tellus\r\n eu','43','12101');
INSERT INTO PlantsTrees VALUES (106,47,'5161','5071','1','3','3','5','3031000','Residential','amet','1102100','3','1211101','42','3112110','35','69','1','2003-02-3','3','2002-07-25','4','2002-07-18','dis\r\n parturient\r\n montes\r\n nasc','2002-06-29','612257','6487','Cras','713.31','94','26','94','44','179.66','Cum\r\n sociis','65','32000');
INSERT INTO PlantsTrees VALUES (107,47,'8852','9032','9','5','3','3','3033100','Residential','enim','3030101','3','3232001','28','1130011','87','78','5','2002-09-19','1','2002-09-20','2','2002-05-25','risus\r\n vitae\r\n varius\r\n nunc\r\n','2002-06-15','278518','8633','non','123.26','16','0','16','147','2435.52','purus\r\n consectetuer','17','33001');
INSERT INTO PlantsTrees VALUES (108,48,'9657','3823','8','1','5','3','1132010','Commercial','Suspendisse','3123110','1','3313011','12','1122001','69','16','1','2002-08-20','3','2002-07-1','1','2003-02-4','lobortis\r\n nibh\r\n Nulla\r\n quis\r\n','2002-12-3','443296','8258','Proin','961.13','42','22','42','110','2597.33','sollicitudin\r\n sit','91','12011');
INSERT INTO PlantsTrees VALUES (109,49,'5265','5889','7','1','2','2','2103011','Commercial','ut','3000100','7','2123110','46','3121001','74','39','5','2002-10-2','1','2003-02-23','3','2003-02-21','mus\r\n Aenean\r\n velit\r\n neque\r\n i','2003-02-11','697169','9525','diam','480.81','42','14','42','162','2349.16','Aenean\r\n velit','16','11100');
INSERT INTO PlantsTrees VALUES (110,49,'7284','1513','11','2','2','2','1302011','Commercial','placerat','2302100','6','3231110','29','2220110','60','45','2','2002-12-3','2','2002-06-10','2','2003-02-21','tempor\r\n Cum\r\n sociis\r\n natoque\r','2003-03-6','433743','6444','wisi','277.42','9','4','9','2','880.80','elit\r\n Nunc','8','21000');
INSERT INTO PlantsTrees VALUES (111,50,'8047','7912','3','5','4','3','1311101','Industrial','vestibulum','3133011','4','3132011','29','1100010','81','83','4','2002-10-22','2','2003-02-8','3','2003-01-1','bibendum\r\n turpis\r\n non\r\n sodale','2003-01-2','165697','8964','dolor','387.49','62','54','62','114','1510.94','id\r\n augue','41','31011');
INSERT INTO PlantsTrees VALUES (112,50,'0494','1082','6','4','5','2','2220001','Residential','penatibus','1000010','1','1203000','8','2231110','43','93','2','2002-08-25','5','2002-06-9','4','2002-09-20','nibh\r\n Nam\r\n et\r\n magna\r\n nec\r\n','2003-04-2','374915','2462','non','696.54','0','0','0','41','4496.78','et\r\n malesuada','5','21100');
INSERT INTO PlantsTrees VALUES (113,50,'0546','3790','2','1','1','3','1110100','Commercial','neque','1132010','2','1000111','25','1031101','100','64','3','2002-06-4','3','2002-12-15','4','2002-12-29','Sed\r\n eget\r\n elit\r\n Mauris\r\n dic','2002-08-10','255571','2111','quis','722.41','17','11','17','27','2435.60','mi\r\n lorem','54','32111');
INSERT INTO PlantsTrees VALUES (114,54,'9408','9000','23','5','3','4','3222001','Industrial','amet','3322110','7','3032100','43','1122110','93','33','5','2003-01-28','1','2003-04-17','1','2003-04-17','metus\r\n elementum\r\n nibh\r\n Etiam','2003-05-14','295932','4652','In','733.61','14','5','14','122','242.65','felis\r\n Duis','29','23111');
INSERT INTO PlantsTrees VALUES (115,54,'2933','2112','23','2','3','4','1022000','Industrial','amet','1210011','7','3321111','35','1203011','55','63','2','2002-09-15','4','2003-05-2','1','2003-04-6','viverra\r\n In\r\n hac\r\n habitasse\r\n','2003-03-12','664922','8295','magna','942.67','46','36','46','44','2572.85','gravida\r\n pede','94','32001');
INSERT INTO PlantsTrees VALUES (116,54,'0803','0752','4','3','2','2','1003001','Residential','massa','2203010','4','3311110','16','3332000','52','99','2','2003-01-14','4','2002-11-5','4','2002-06-6','interdum\r\n ac\r\n felis\r\n In\r\n fer','2003-04-4','227796','1954','mi','63.05','88','67','88','180','2071.56','quis\r\n tincidunt','84','13010');
INSERT INTO PlantsTrees VALUES (117,55,'4495','5238','3','5','5','5','2021011','Commercial','auctor','1230011','3','1103011','37','2020110','19','79','5','2002-08-21','1','2002-11-29','3','2003-04-20','laoreet\r\n non\r\n metus\r\n Sed\r\n ne','2002-12-9','951416','3758','consectetuer','728.98','50','34','50','6','51.92','gravida\r\n pede','54','11000');
INSERT INTO PlantsTrees VALUES (118,55,'5574','6649','6','1','4','1','3120001','Commercial','volutpat','1102110','5','2131110','33','1002010','63','76','4','2002-12-31','1','2002-10-19','3','2002-09-10','eu\r\n wisi\r\n Lorem\r\n ipsum\r\n dolo','2002-06-19','769125','2139','sed','218.53','11','11','11','87','1790.66','sapien\r\n Nulla','28','22110');
INSERT INTO PlantsTrees VALUES (119,56,'6233','9815','8','4','5','1','3120011','Commercial','enim','1113111','1','3012011','68','2020101','11','71','5','2002-07-25','4','2002-10-23','4','2003-04-28','Curae\r\n Donec\r\n vulputate\r\n Null','2002-10-13','995797','4754','gravida','680.21','56','53','56','71','2012.42','et\r\n dui','78','21101');
INSERT INTO PlantsTrees VALUES (120,57,'9554','7992','5','1','5','2','2301110','Industrial','ornare','3201001','1','3133000','25','1031101','44','60','1','2002-09-12','4','2002-05-31','5','2003-01-4','parturient\r\n montes\r\n nascetur\r\n','2003-05-13','419995','4346','vitae','972.77','100','75','100','29','1358.58','In\r\n et','70','22010');
INSERT INTO PlantsTrees VALUES (121,57,'8919','7334','2','4','4','5','1001111','Residential','blandit','1202110','4','1300011','45','2020001','0','93','4','2002-06-6','1','2002-08-22','3','2002-07-22','risus\r\n vitae\r\n varius\r\n nunc\r\n','2003-01-18','287298','3329','interdum','92.01','50','5','50','21','1820.85','mattis\r\n vel','29','22011');
INSERT INTO PlantsTrees VALUES (122,57,'4561','9791','12','4','2','5','3211100','Commercial','sit','3330000','4','3131001','9','1201010','42','94','2','2003-03-16','2','2002-11-27','2','2003-05-1','vel\r\n turpis\r\n Vestibulum\r\n ante','2002-09-21','582342','5478','magnis','810.68','98','50','98','187','2085.17','ut\r\n lectus','97','12001');
INSERT INTO PlantsTrees VALUES (123,58,'4173','5479','24','2','2','1','1112001','Commercial','penatibus','2030111','2','1300110','40','3113001','53','15','5','2003-02-5','5','2003-04-24','3','2003-03-28','vitae\r\n orci\r\n Integer\r\n laoreet','2002-09-13','315618','5572','sit','709.79','57','15','57','49','4911.27','vehicula\r\n sed','97','21010');
INSERT INTO PlantsTrees VALUES (124,58,'0015','1456','5','5','5','3','2100111','Commercial','arcu','2132001','5','1021100','3','2220111','35','8','1','2002-12-19','4','2003-03-9','5','2002-11-28','neque\r\n consequat\r\n non\r\n vulput','2002-12-21','737135','9948','at','549.51','16','0','16','139','4952.95','dictum\r\n Pellentesque','83','22111');
INSERT INTO PlantsTrees VALUES (125,58,'0996','8872','6','5','1','4','3203001','Commercial','cursus','3003000','5','2131000','20','1233111','53','0','2','2003-01-7','4','2002-09-14','1','2002-08-19','non\r\n risus\r\n nec\r\n enim\r\n ultri','2003-01-27','956899','8556','consectetuer','158.34','39','8','39','138','2578.52','sit\r\n amet','88','22010');
INSERT INTO PlantsTrees VALUES (126,58,'4545','0001','9','4','2','3','1121010','Commercial','ligula','1003111','2','1002111','54','2330110','89','37','4','2002-07-28','4','2002-08-18','4','2003-01-9','adipiscing\r\n Pellentesque\r\n habi','2002-08-23','436859','4144','est','551.07','3','1','3','132','172.16','vel\r\n dictum','56','12001');
INSERT INTO PlantsTrees VALUES (127,59,'0996','9750','11','2','4','4','2312101','Industrial','faucibus','2031101','5','1311011','61','2220101','2','85','2','2002-11-19','3','2002-09-17','3','2002-10-22','In\r\n malesuada\r\n leo\r\n vitae\r\n m','2003-02-27','121491','8513','sed','994.41','48','39','48','78','4572.81','lorem\r\n Pellentesque','100','33010');
INSERT INTO PlantsTrees VALUES (128,59,'7757','3328','11','4','2','1','3220110','Residential','Etiam','2312110','4','1132110','26','2120100','74','23','1','2002-07-16','1','2002-10-7','5','2002-07-1','enim\r\n In\r\n risus\r\n risus\r\n matt','2003-04-9','614549','6411','id','820.80','24','14','24','152','3504.83','enim\r\n vel','84','11010');
INSERT INTO PlantsTrees VALUES (129,59,'2965','9344','1','4','5','3','3001000','Commercial','placerat','2000010','3','1220011','38','1221100','7','25','4','2003-04-11','5','2002-12-24','1','2002-12-11','fermentum\r\n vestibulum\r\n odio\r\n','2003-01-30','878954','1178','eget','171.13','96','15','96','67','3145.42','vulputate\r\n et','88','12110');
INSERT INTO PlantsTrees VALUES (130,60,'1069','1165','20','3','4','3','1221101','Commercial','Phasellus','1222110','2','1233100','74','3102111','43','93','1','2002-10-25','5','2003-04-23','5','2002-05-27','nisl\r\n eu\r\n wisi\r\n Lorem\r\n ipsum','2002-12-9','997765','6588','fringilla','528.36','75','34','75','51','4838.40','amet\r\n consectetuer','1','13000');
INSERT INTO PlantsTrees VALUES (131,60,'1056','4305','3','2','2','4','3132011','Industrial','in','2011111','2','1322010','15','1311010','76','1','5','2002-10-20','4','2003-03-31','5','2002-08-4','aliquam\r\n Morbi\r\n rhoncus\r\n arcu','2002-11-18','517516','2361','adipiscing','973.09','18','14','18','133','3297.76','Donec\r\n tristique','17','13110');
INSERT INTO PlantsTrees VALUES (132,61,'6528','0532','10','2','2','5','2301101','Commercial','magnis','2031110','1','1011001','35','2010011','17','99','1','2002-11-17','5','2002-06-12','4','2002-11-21','id\r\n eros\r\n condimentum\r\n malesu','2003-04-24','281715','6484','Pellentesque','101.37','78','75','78','3','1378.90','Nulla\r\n tempor','86','11101');
INSERT INTO PlantsTrees VALUES (133,62,'3904','1373','12','5','1','4','2233110','Residential','posuere','1301011','1','1323011','28','2002000','23','61','5','2002-11-21','2','2002-07-31','4','2002-12-18','justo\r\n Nam\r\n vel\r\n nunc\r\n eu\r\n','2002-12-29','595532','1761','consequat','238.10','57','5','57','7','1830.35','et\r\n euismod','11','22111');
INSERT INTO PlantsTrees VALUES (134,62,'5150','8526','7','2','2','5','1103011','Industrial','velit','3203000','3','1231100','33','2232001','10','0','1','2003-02-4','4','2002-06-5','5','2002-08-31','vel\r\n pharetra\r\n nec\r\n sem\r\n Ali','2003-03-29','228571','1795','In','153.75','95','30','95','154','318.92','sit\r\n amet','76','23011');
INSERT INTO PlantsTrees VALUES (135,62,'7843','1338','21','2','4','5','1322011','Commercial','Nam','3000000','7','3312010','39','2303100','92','29','2','2002-12-3','3','2002-05-17','2','2003-04-3','primis\r\n in\r\n faucibus\r\n orci\r\n','2002-12-26','818985','3967','mattis','281.49','62','35','62','104','3571.84','ut\r\n nulla','88','11100');
INSERT INTO PlantsTrees VALUES (136,63,'8910','5932','23','2','1','3','3332011','Industrial','Donec','3031101','3','3212001','64','1100101','9','15','4','2002-06-2','3','2002-12-5','1','2003-05-6','egestas\r\n Praesent\r\n quis\r\n enim','2002-06-13','142527','9729','Duis','505.63','72','9','72','153','1838.82','Ut\r\n sit','90','32000');
INSERT INTO PlantsTrees VALUES (137,63,'4737','6096','20','5','5','2','3221010','Residential','ipsum','3212101','2','3023111','14','1031100','43','46','3','2002-12-28','5','2002-07-8','4','2002-06-26','viverra\r\n Pellentesque\r\n egestas','2003-01-11','598667','8323','vestibulum','106.80','83','48','83','106','680.94','urna\r\n erat','77','11100');
INSERT INTO PlantsTrees VALUES (138,63,'6706','9214','26','2','4','4','2110010','Industrial','viverra','2323100','4','3302101','8','2100101','25','40','5','2002-07-1','4','2002-09-26','2','2003-01-14','ipsum\r\n Pellentesque\r\n habitant\r','2003-02-24','621144','3795','vulputate','49.85','33','29','33','45','4221.14','ac\r\n dolor','9','21001');
INSERT INTO PlantsTrees VALUES (139,63,'6923','0231','8','3','4','2','1131001','Commercial','fermentum','1331110','4','1012111','45','3131100','62','44','4','2003-04-26','4','2002-12-18','1','2003-04-21','amet\r\n est\r\n eget\r\n velit\r\n port','2002-09-7','928796','1238','aliquet','228.35','49','46','49','190','827.64','sapien\r\n non','86','13111');
INSERT INTO PlantsTrees VALUES (140,65,'5313','4245','9','2','4','4','1231111','Industrial','fermentum','3032000','4','1122111','2','3302110','87','13','5','2002-11-4','4','2003-01-23','2','2002-11-2','elit\r\n Mauris\r\n dictum\r\n ipsum\r\n','2002-05-26','421176','3999','faucibus','304.28','95','48','95','80','1021.35','cursus\r\n dictum','27','33100');
INSERT INTO PlantsTrees VALUES (141,65,'7695','9724','7','1','5','2','1221001','Residential','non','3003000','3','2233110','1','3113011','23','86','1','2003-04-13','3','2002-07-5','1','2002-08-13','rhoncus\r\n tincidunt\r\n lacus\r\n Na','2003-02-27','649135','8843','neque','342.39','7','1','7','2','4594.71','platea\r\n dictumst','44','22101');
INSERT INTO PlantsTrees VALUES (142,66,'790879','08798','33','','','','6753','67547','643','63','64','64','','','75','6745','','2003-05-06','','2003-05-04','','2003-05-07','58','','87','79','687','687','68','687','686','86','876','8765','6875','6754');
INSERT INTO PlantsTrees VALUES (143,68,'','','40','5','5','5','500','','','250.00','50','125.00','','','','','5','2003-05-19','5','2003-05-19','5','2003-05-19','','','','','','','25','20','5','20','20','','50','-50');
INSERT INTO PlantsTrees VALUES (144,0,'','','48','1','2','3','40000','Agricultural','Agricultural','32,000.00','40','12,800.00','','','','','4','2003-05-20','4','2003-05-20','5','2003-05-20','','','','','Agricultural','','100','50','50','','400.00','Waterlogged','80','-70');
INSERT INTO PlantsTrees VALUES (145,71,'89703','12-34-56-78-90','49','1','2','3','24000','Agricultural','Agricultural','24,000.00','80','19,200.00','','','','','4','2003-05-20','4','2003-05-20','5','2003-05-20','','','12-34-56-78-99','','','','60','30','30','10','400','','100','0');
INSERT INTO PlantsTrees VALUES (146,73,'','','62','','','','800','','','560.00','50','280.00','','','','','','2003-05-22','','2003-05-22','','2003-05-22','','','','','','','10','5','5','8','80','','70','-30');
INSERT INTO PlantsTrees VALUES (147,75,'2','2','65','','','','75000','2','2','75,000.00','50','37,500.00','','','2','2','','2000-05-23','','2000-05-23','','2003-05-22','','','2','2','2','2','3000','1000','2000','2','25','2','100','0');
INSERT INTO PlantsTrees VALUES (148,76,'07070-00886','045-070-07-04','68','','','','2800','','','2,800.00','','0.00','','','','','','2003-05-22','','2003-05-22','','2003-05-22','','','','966','Cocos','','40','0','40','','70','','100','0');
INSERT INTO PlantsTrees VALUES (149,77,'456','','78','','','','0','','','0.00','','0.00','','','','','','2003-05-27','','2003-05-27','','2003-05-27','','','','123','','','0','','','','','','','');
INSERT INTO PlantsTrees VALUES (150,0,'1','1','87','1','2','','2','1','asdfasdfasdf','0.02','1','0.00','','','1','1','','2003-06-04','','2003-06-04','','2003-06-04','1','','1','1','dwq','1','2','1','1','1','1','1','1','1');
INSERT INTO PlantsTrees VALUES (151,0,'2','2','91','','','','0','','dd','0.00','','0.00','','','','','','2003-06-04','','2003-06-04','','2003-06-04','','','2','2','dwq','','0','','','','','','','');
INSERT INTO PlantsTrees VALUES (152,0,'11','11','97','','','','242','11','asdfasdfasdf','26.62','11','2.93','','','','','','2003-06-09','','2003-06-09','','2003-06-09','','','11','11','asasdsadfasdf','11','22','11','11','11','11','11','11','11');
INSERT INTO PlantsTrees VALUES (153,83,NULL,'','','','','','','777','','','','777','','','','','','','','','',NULL,NULL,'','',NULL,'','','','','','','777','','','');
INSERT INTO PlantsTrees VALUES (154,83,NULL,'','','','','','','88','','','','888','','','','','','','','','',NULL,NULL,'','',NULL,'','','','','','','888','','','');
INSERT INTO PlantsTrees VALUES (155,84,NULL,'','','','','','','888','','','','888','','','','','','','','','',NULL,NULL,'','',NULL,'','','','','','','888','','','');
INSERT INTO PlantsTrees VALUES (156,0,'','','106','','','','0','','asdfasdfasdf','0.00','','0.00','','','','','','2003-06-11','','2003-06-11','','2003-06-11','','','','','asasdsadfasdf','','66','66','','','','','','');
INSERT INTO PlantsTrees VALUES (157,94,NULL,'','','','','','','555','','','','555','','','','','','','','','',NULL,NULL,'','',NULL,'','','','','','','555','','','');
INSERT INTO PlantsTrees VALUES (158,97,NULL,'','','','','','','1234','','','','1234','','','','','','','','','',NULL,NULL,'','',NULL,'','','','','','','1234','','','');
INSERT INTO PlantsTrees VALUES (159,98,NULL,'','','','','','','789','','','','789','','','','','','','','','',NULL,NULL,'','',NULL,'','','','','','','789','','','');
INSERT INTO PlantsTrees VALUES (160,99,NULL,'','','','','','','testKind','','','','testAssessedValue','','','','','','','','','',NULL,NULL,'','',NULL,'','','','','','','testUnitPrice','','','');
INSERT INTO PlantsTrees VALUES (162,102,NULL,'','','','','','','78911','','','','78911','','','','','','','','','',NULL,NULL,'','',NULL,'','','78911','','','','78911','','','');
INSERT INTO PlantsTrees VALUES (163,104,'tytryyrtyrty','tyrtyryrty','120','','','','30','64','','6.00','50','3.00','','','','46','','2003-06-06','','2003-06-04','','2003-06-05','46','','rtyretyerytr','rtyrtyertytry','','rtyrty','15','10','5','654','2','654','20','-80');
INSERT INTO PlantsTrees VALUES (164,106,NULL,'','','','','','','4545','','','','454','','','','','','','','','',NULL,NULL,'','',NULL,'','','545','','','','4545','','','');

--
-- Table structure for table 'PlantsTreesActualUses'
--

CREATE TABLE PlantsTreesActualUses (
  plantsTreesActualUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (plantsTreesActualUsesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'PlantsTreesActualUses'
--


INSERT INTO PlantsTreesActualUses VALUES (1,'asdfasdfasdf','asdfasdfasdf',1233,'active');
INSERT INTO PlantsTreesActualUses VALUES (2,'sdgfsdfsd','fsfsdfsd',1,'inactive');
INSERT INTO PlantsTreesActualUses VALUES (3,'dfsdfs','dfsdfsdf',332,'active');
INSERT INTO PlantsTreesActualUses VALUES (4,'dfsfsa','dfd',33,'active');
INSERT INTO PlantsTreesActualUses VALUES (5,'dd','dfd',555,'inactive');

--
-- Table structure for table 'PlantsTreesClasses'
--

CREATE TABLE PlantsTreesClasses (
  plantsTreesClassesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (plantsTreesClassesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'PlantsTreesClasses'
--


INSERT INTO PlantsTreesClasses VALUES (1,'asasdsadfasdf','assdfasfasdf',2323,'active');
INSERT INTO PlantsTreesClasses VALUES (3,'asfasdfasd','fasdfasdfsda',454645,'active');
INSERT INTO PlantsTreesClasses VALUES (4,'asfsadf','sdfsdfs',223,'inactive');
INSERT INTO PlantsTreesClasses VALUES (5,'dwq','dqwdqwdqw',1,'active');

--
-- Table structure for table 'PropAssessKinds'
--

CREATE TABLE PropAssessKinds (
  propAssessKindsID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (propAssessKindsID)
) TYPE=InnoDB;

--
-- Dumping data for table 'PropAssessKinds'
--


INSERT INTO PropAssessKinds VALUES (1,'asdfasdfa','sdfasdfasdf',23,'inactive');
INSERT INTO PropAssessKinds VALUES (2,'asdfasfas','3sdfgsdgsdgsd',3489989,'inactive');
INSERT INTO PropAssessKinds VALUES (3,'DASSFAS','FASFASDF',23,'active');
INSERT INTO PropAssessKinds VALUES (4,'asfsdfasfasdfasd','asdfsafasdf',78678,'active');

--
-- Table structure for table 'PropAssessUses'
--

CREATE TABLE PropAssessUses (
  propAssessUsesID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  value int(4) default NULL,
  status varchar(255) default NULL,
  PRIMARY KEY  (propAssessUsesID)
) TYPE=InnoDB;

--
-- Dumping data for table 'PropAssessUses'
--


INSERT INTO PropAssessUses VALUES (1,'dsdsds','asfasdfsadf',2323423,'inactive');
INSERT INTO PropAssessUses VALUES (2,'asdfasdfasdfasd','fasfasfs',2147483647,'inactive');
INSERT INTO PropAssessUses VALUES (4,'asdfasdfas','fasfasfsd',4544,'inactive');
INSERT INTO PropAssessUses VALUES (6,'sadgfasdfas','dfasdfsdfs',2343,'inactive');
INSERT INTO PropAssessUses VALUES (7,'adfsfas','fasdfadfa',445,'active');

--
-- Table structure for table 'Property'
--

CREATE TABLE Property (
  propertyID int(11) NOT NULL auto_increment,
  afsID int(11) default NULL,
  arpNumber varchar(32) default NULL,
  propertyIndexNumber varchar(32) default NULL,
  propertyAdministrator int(11) default NULL,
  verifiedBy int(11) default NULL,
  plottingsBy int(11) default NULL,
  notedBy int(11) default NULL,
  marketValue double default NULL,
  kind varchar(32) default NULL,
  actualUse varchar(32) default NULL,
  adjustedMarketValue double default NULL,
  assessedValue double default NULL,
  previousOwner int(32) default NULL,
  previouseAssessedValue varchar(32) default NULL,
  taxability varchar(32) default NULL,
  effectivity varchar(32) default NULL,
  appraisedBy int(11) default NULL,
  apparisedByDate date default NULL,
  recommendingApproval int(11) default NULL,
  recommendingApprovalDate date default NULL,
  approvedBy int(11) default NULL,
  approvedByDate date default NULL,
  memoranda varchar(32) default NULL,
  postingDate date default NULL,
  PRIMARY KEY  (propertyID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Property'
--



--
-- Table structure for table 'Province'
--

CREATE TABLE Province (
  provinceID int(4) NOT NULL auto_increment,
  code varchar(50) default NULL,
  description text,
  status varchar(255) default NULL,
  PRIMARY KEY  (provinceID)
) TYPE=InnoDB;

--
-- Dumping data for table 'Province'
--


INSERT INTO Province VALUES (1,'AB','Abra','active');
INSERT INTO Province VALUES (5,'Agusan del Norte','Agusan del Norte','active');
INSERT INTO Province VALUES (6,'Agusan del Sur','Agusan del Sur','active');
INSERT INTO Province VALUES (7,'Aklan','Aklan','active');
INSERT INTO Province VALUES (8,'Albay','Albay','active');
INSERT INTO Province VALUES (13,'Antique','Antique','active');
INSERT INTO Province VALUES (14,'Basilan','Basilan','active');
INSERT INTO Province VALUES (15,'Bataan','Bataan','active');
INSERT INTO Province VALUES (16,'Batangas','Batangas','active');
INSERT INTO Province VALUES (17,'Benguet','Benguet','active');
INSERT INTO Province VALUES (18,'Bohol','Bohol','active');
INSERT INTO Province VALUES (19,'Bukidnon','Bukidnon','active');
INSERT INTO Province VALUES (20,'Bulacan','Bulacan','active');
INSERT INTO Province VALUES (21,'Cagayan','Cagayan','active');
INSERT INTO Province VALUES (22,'Camarines Norte','Camarines Norte','active');
INSERT INTO Province VALUES (23,'Camarines Sur','Camarines Sur','active');
INSERT INTO Province VALUES (24,'Capiz','Capiz','active');
INSERT INTO Province VALUES (25,'Cavite','Cavite','active');
INSERT INTO Province VALUES (26,'Cebu','Cebu','active');
INSERT INTO Province VALUES (27,'Cotabato','Cotabato','active');
INSERT INTO Province VALUES (28,'Davao','Davao','active');
INSERT INTO Province VALUES (29,'Davao del Norte','Davao del Norte','active');
INSERT INTO Province VALUES (30,'Eastern Samar','Eastern Samar','active');
INSERT INTO Province VALUES (31,'Ilocos Norte','Ilocos Norte','active');
INSERT INTO Province VALUES (32,'Ilocos Sur','Ilocos Sur','active');
INSERT INTO Province VALUES (33,'Iloilo','Iloilo','active');
INSERT INTO Province VALUES (34,'Isabela','Isabela','active');
INSERT INTO Province VALUES (35,'La Union','La Union','active');
INSERT INTO Province VALUES (36,'Laguna','Laguna','active');
INSERT INTO Province VALUES (37,'Lanao del Norte','Lanao del Norte','active');
INSERT INTO Province VALUES (38,'Leyte','Leyte','active');
INSERT INTO Province VALUES (39,'Masbate','Masbate','active');
INSERT INTO Province VALUES (40,'Metro Manila','Metro Manila','active');
INSERT INTO Province VALUES (41,'Misamis Oriental','Misamis Oriental','active');
INSERT INTO Province VALUES (42,'Negros Occidental','Negros Occidental','active');
INSERT INTO Province VALUES (43,'Negros Oriental','Negros Oriental','active');
INSERT INTO Province VALUES (44,'North Cotabato','North Cotabato','active');
INSERT INTO Province VALUES (45,'Northern Samar','Northern Samar','active');
INSERT INTO Province VALUES (46,'Nueva Ecija','Nueva Ecija','active');
INSERT INTO Province VALUES (47,'Nueva Vizcaya','Nueva Vizcaya','active');
INSERT INTO Province VALUES (48,'Occidental Mindoro','Occidental Mindoro','active');
INSERT INTO Province VALUES (49,'Oriental Mindoro','Oriental Mindoro','active');
INSERT INTO Province VALUES (50,'Palawan','Palawan','active');
INSERT INTO Province VALUES (51,'Pampanga','Pampanga','active');
INSERT INTO Province VALUES (52,'Pangasinan','Pangasinan','active');
INSERT INTO Province VALUES (53,'Quezon','Quezon','active');
INSERT INTO Province VALUES (54,'Rizal','Rizal ','active');
INSERT INTO Province VALUES (55,'Samar','Samar','active');
INSERT INTO Province VALUES (56,'Sorsogon','Sorsogon','active');
INSERT INTO Province VALUES (57,'South Cotabato','South Cotabato','active');
INSERT INTO Province VALUES (58,'Southern Leyte','Southern Leyte','active');
INSERT INTO Province VALUES (59,'Sultan Kudarat','Sultan Kudarat','active');
INSERT INTO Province VALUES (60,'Sulu','Sulu','active');
INSERT INTO Province VALUES (61,'Surigao del Norte','Surigao del Norte','active');
INSERT INTO Province VALUES (62,'Tarlac','Tarlac','active');
INSERT INTO Province VALUES (63,'Western Samar','Western Samar','active');
INSERT INTO Province VALUES (64,'Zambales','Zambales','active');
INSERT INTO Province VALUES (65,'Zamboanga del Norte','Zamboanga del Norte','active');
INSERT INTO Province VALUES (66,'Zamboanga del Sur','Zamboanga del Sur','active');

--
-- Table structure for table 'RPTOP'
--

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
  PRIMARY KEY  (rptopID)
) TYPE=MyISAM;

--
-- Dumping data for table 'RPTOP'
--


INSERT INTO RPTOP VALUES (57,NULL,'8907987987987','','2003','4','2','4369111.5','1708114','3322510','3430336','2002079','3231207','4343011','3333101','14036711.5','11702758');
INSERT INTO RPTOP VALUES (56,NULL,'00001','','2004','','','271060','73186.2','','','300000','60000','','','571060','133186.2');
INSERT INTO RPTOP VALUES (55,NULL,'34123421432143','','2003','','','1.5','123123','','','78','96','','','79.5','123219');
INSERT INTO RPTOP VALUES (54,NULL,'000000000000000000','','2003','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (53,NULL,'1234','','2003','2','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (52,'117','65047440658','2002-09-8','2003','1','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (51,'116','67312142635','2003-01-26','2009','3','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (50,'115','22867291356','2002-08-19','2007','5','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (49,'114','92252445421','2002-11-21','2007','2','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (48,'113','54523032692','2002-08-22','2007','2','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (47,'112','16221251075','2002-09-24','2019','3','5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (45,'109','40750711993','2002-10-2','2009','5','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (44,'108','04034652201','2003-03-3','2013','4','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (43,'107','99178783133','2002-12-24','2017','4','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (42,'106','46825240364','2003-03-2','2005','5','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (41,'105','35051284482','2003-04-12','2008','3','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO RPTOP VALUES (58,NULL,'3453245345','','2003','3','2','515001.5','535623','75000','37500','78','96','4343011','3333101','4933090.5','3906320');
INSERT INTO RPTOP VALUES (59,NULL,'','','2006','','','500000','405000','75000','37500','','','','','575000','442500');
INSERT INTO RPTOP VALUES (60,NULL,'123123123','','2006','','','','','','','','','','','0','0');
INSERT INTO RPTOP VALUES (61,NULL,'123654','','2006','','','','','','','','','','','0','0');
INSERT INTO RPTOP VALUES (62,NULL,'111111','','2006','','','','','','','','','','','0','0');

--
-- Table structure for table 'RPTOPTD'
--

CREATE TABLE RPTOPTD (
  rptoptdID int(11) NOT NULL auto_increment,
  rptopID int(11) default NULL,
  tdID int(11) default NULL,
  PRIMARY KEY  (rptoptdID)
) TYPE=InnoDB;

--
-- Dumping data for table 'RPTOPTD'
--


INSERT INTO RPTOPTD VALUES (373,41,335);
INSERT INTO RPTOPTD VALUES (374,41,336);
INSERT INTO RPTOPTD VALUES (375,41,337);
INSERT INTO RPTOPTD VALUES (376,41,338);
INSERT INTO RPTOPTD VALUES (377,41,339);
INSERT INTO RPTOPTD VALUES (378,41,340);
INSERT INTO RPTOPTD VALUES (379,41,341);
INSERT INTO RPTOPTD VALUES (380,41,342);
INSERT INTO RPTOPTD VALUES (381,41,343);
INSERT INTO RPTOPTD VALUES (382,41,344);
INSERT INTO RPTOPTD VALUES (383,42,90);
INSERT INTO RPTOPTD VALUES (384,42,91);
INSERT INTO RPTOPTD VALUES (385,42,92);
INSERT INTO RPTOPTD VALUES (386,42,93);
INSERT INTO RPTOPTD VALUES (387,42,94);
INSERT INTO RPTOPTD VALUES (388,42,95);
INSERT INTO RPTOPTD VALUES (389,42,96);
INSERT INTO RPTOPTD VALUES (390,42,97);
INSERT INTO RPTOPTD VALUES (391,42,98);
INSERT INTO RPTOPTD VALUES (392,42,99);
INSERT INTO RPTOPTD VALUES (393,42,100);
INSERT INTO RPTOPTD VALUES (394,42,101);
INSERT INTO RPTOPTD VALUES (395,43,404);
INSERT INTO RPTOPTD VALUES (396,43,405);
INSERT INTO RPTOPTD VALUES (397,43,406);
INSERT INTO RPTOPTD VALUES (398,43,407);
INSERT INTO RPTOPTD VALUES (399,43,408);
INSERT INTO RPTOPTD VALUES (400,43,409);
INSERT INTO RPTOPTD VALUES (401,43,410);
INSERT INTO RPTOPTD VALUES (402,43,411);
INSERT INTO RPTOPTD VALUES (403,43,412);
INSERT INTO RPTOPTD VALUES (404,43,413);
INSERT INTO RPTOPTD VALUES (405,43,414);
INSERT INTO RPTOPTD VALUES (406,43,415);
INSERT INTO RPTOPTD VALUES (407,44,121);
INSERT INTO RPTOPTD VALUES (408,44,122);
INSERT INTO RPTOPTD VALUES (409,44,123);
INSERT INTO RPTOPTD VALUES (410,44,124);
INSERT INTO RPTOPTD VALUES (411,44,125);
INSERT INTO RPTOPTD VALUES (412,44,126);
INSERT INTO RPTOPTD VALUES (413,44,127);
INSERT INTO RPTOPTD VALUES (414,44,128);
INSERT INTO RPTOPTD VALUES (415,44,129);
INSERT INTO RPTOPTD VALUES (416,45,22);
INSERT INTO RPTOPTD VALUES (417,45,23);
INSERT INTO RPTOPTD VALUES (418,45,24);
INSERT INTO RPTOPTD VALUES (419,45,25);
INSERT INTO RPTOPTD VALUES (420,45,26);
INSERT INTO RPTOPTD VALUES (421,45,27);
INSERT INTO RPTOPTD VALUES (422,45,28);
INSERT INTO RPTOPTD VALUES (423,17,351);
INSERT INTO RPTOPTD VALUES (424,17,352);
INSERT INTO RPTOPTD VALUES (425,17,353);
INSERT INTO RPTOPTD VALUES (426,17,354);
INSERT INTO RPTOPTD VALUES (427,17,355);
INSERT INTO RPTOPTD VALUES (428,17,356);
INSERT INTO RPTOPTD VALUES (429,17,357);
INSERT INTO RPTOPTD VALUES (430,17,358);
INSERT INTO RPTOPTD VALUES (431,17,335);
INSERT INTO RPTOPTD VALUES (432,17,336);
INSERT INTO RPTOPTD VALUES (433,17,337);
INSERT INTO RPTOPTD VALUES (434,17,338);
INSERT INTO RPTOPTD VALUES (435,17,339);
INSERT INTO RPTOPTD VALUES (436,17,340);
INSERT INTO RPTOPTD VALUES (437,17,341);
INSERT INTO RPTOPTD VALUES (438,17,342);
INSERT INTO RPTOPTD VALUES (439,17,343);
INSERT INTO RPTOPTD VALUES (440,17,344);
INSERT INTO RPTOPTD VALUES (441,17,12);
INSERT INTO RPTOPTD VALUES (442,17,13);
INSERT INTO RPTOPTD VALUES (443,17,14);
INSERT INTO RPTOPTD VALUES (444,17,15);
INSERT INTO RPTOPTD VALUES (445,17,16);
INSERT INTO RPTOPTD VALUES (446,17,17);
INSERT INTO RPTOPTD VALUES (447,17,18);
INSERT INTO RPTOPTD VALUES (448,17,19);
INSERT INTO RPTOPTD VALUES (449,17,20);
INSERT INTO RPTOPTD VALUES (450,17,21);
INSERT INTO RPTOPTD VALUES (451,46,446);
INSERT INTO RPTOPTD VALUES (452,46,447);
INSERT INTO RPTOPTD VALUES (453,46,448);
INSERT INTO RPTOPTD VALUES (454,46,449);
INSERT INTO RPTOPTD VALUES (455,46,450);
INSERT INTO RPTOPTD VALUES (456,46,451);
INSERT INTO RPTOPTD VALUES (457,46,452);
INSERT INTO RPTOPTD VALUES (458,46,453);
INSERT INTO RPTOPTD VALUES (459,46,454);
INSERT INTO RPTOPTD VALUES (460,46,384);
INSERT INTO RPTOPTD VALUES (461,46,385);
INSERT INTO RPTOPTD VALUES (462,46,386);
INSERT INTO RPTOPTD VALUES (463,46,387);
INSERT INTO RPTOPTD VALUES (464,46,388);
INSERT INTO RPTOPTD VALUES (465,46,389);
INSERT INTO RPTOPTD VALUES (466,46,390);
INSERT INTO RPTOPTD VALUES (467,46,391);
INSERT INTO RPTOPTD VALUES (468,46,392);
INSERT INTO RPTOPTD VALUES (469,46,393);
INSERT INTO RPTOPTD VALUES (470,46,394);
INSERT INTO RPTOPTD VALUES (471,46,395);
INSERT INTO RPTOPTD VALUES (472,47,534);
INSERT INTO RPTOPTD VALUES (473,47,535);
INSERT INTO RPTOPTD VALUES (474,47,536);
INSERT INTO RPTOPTD VALUES (475,47,537);
INSERT INTO RPTOPTD VALUES (476,47,538);
INSERT INTO RPTOPTD VALUES (477,47,539);
INSERT INTO RPTOPTD VALUES (478,47,540);
INSERT INTO RPTOPTD VALUES (479,47,541);
INSERT INTO RPTOPTD VALUES (480,47,542);
INSERT INTO RPTOPTD VALUES (481,49,121);
INSERT INTO RPTOPTD VALUES (482,49,122);
INSERT INTO RPTOPTD VALUES (483,49,123);
INSERT INTO RPTOPTD VALUES (484,49,124);
INSERT INTO RPTOPTD VALUES (485,49,125);
INSERT INTO RPTOPTD VALUES (486,49,126);
INSERT INTO RPTOPTD VALUES (487,49,127);
INSERT INTO RPTOPTD VALUES (488,49,128);
INSERT INTO RPTOPTD VALUES (489,49,129);
INSERT INTO RPTOPTD VALUES (490,50,563);
INSERT INTO RPTOPTD VALUES (491,50,564);
INSERT INTO RPTOPTD VALUES (492,50,565);
INSERT INTO RPTOPTD VALUES (493,50,566);
INSERT INTO RPTOPTD VALUES (494,50,567);
INSERT INTO RPTOPTD VALUES (495,50,568);
INSERT INTO RPTOPTD VALUES (496,50,569);
INSERT INTO RPTOPTD VALUES (497,50,570);
INSERT INTO RPTOPTD VALUES (498,50,571);
INSERT INTO RPTOPTD VALUES (499,50,572);
INSERT INTO RPTOPTD VALUES (500,50,573);
INSERT INTO RPTOPTD VALUES (501,50,574);
INSERT INTO RPTOPTD VALUES (502,50,575);
INSERT INTO RPTOPTD VALUES (503,50,576);
INSERT INTO RPTOPTD VALUES (504,51,121);
INSERT INTO RPTOPTD VALUES (505,51,122);
INSERT INTO RPTOPTD VALUES (506,51,123);
INSERT INTO RPTOPTD VALUES (507,51,124);
INSERT INTO RPTOPTD VALUES (508,51,125);
INSERT INTO RPTOPTD VALUES (509,51,126);
INSERT INTO RPTOPTD VALUES (510,51,127);
INSERT INTO RPTOPTD VALUES (511,51,128);
INSERT INTO RPTOPTD VALUES (512,51,129);
INSERT INTO RPTOPTD VALUES (513,52,160);
INSERT INTO RPTOPTD VALUES (514,52,161);
INSERT INTO RPTOPTD VALUES (515,52,162);
INSERT INTO RPTOPTD VALUES (516,52,163);
INSERT INTO RPTOPTD VALUES (517,52,164);
INSERT INTO RPTOPTD VALUES (518,52,165);
INSERT INTO RPTOPTD VALUES (519,52,166);
INSERT INTO RPTOPTD VALUES (520,52,167);
INSERT INTO RPTOPTD VALUES (521,52,168);
INSERT INTO RPTOPTD VALUES (523,53,601);
INSERT INTO RPTOPTD VALUES (543,54,102);
INSERT INTO RPTOPTD VALUES (544,54,103);
INSERT INTO RPTOPTD VALUES (545,54,104);
INSERT INTO RPTOPTD VALUES (546,54,106);
INSERT INTO RPTOPTD VALUES (547,54,108);
INSERT INTO RPTOPTD VALUES (548,54,111);
INSERT INTO RPTOPTD VALUES (568,53,320);
INSERT INTO RPTOPTD VALUES (569,53,321);
INSERT INTO RPTOPTD VALUES (570,53,322);
INSERT INTO RPTOPTD VALUES (571,53,323);
INSERT INTO RPTOPTD VALUES (572,53,325);
INSERT INTO RPTOPTD VALUES (573,53,326);
INSERT INTO RPTOPTD VALUES (1028,55,600);
INSERT INTO RPTOPTD VALUES (1029,55,601);
INSERT INTO RPTOPTD VALUES (1030,56,602);
INSERT INTO RPTOPTD VALUES (1031,56,603);
INSERT INTO RPTOPTD VALUES (1048,57,604);
INSERT INTO RPTOPTD VALUES (1049,57,605);
INSERT INTO RPTOPTD VALUES (1050,57,320);
INSERT INTO RPTOPTD VALUES (1051,57,321);
INSERT INTO RPTOPTD VALUES (1052,57,322);
INSERT INTO RPTOPTD VALUES (1053,57,323);
INSERT INTO RPTOPTD VALUES (1054,57,325);
INSERT INTO RPTOPTD VALUES (1055,57,326);
INSERT INTO RPTOPTD VALUES (1056,57,600);
INSERT INTO RPTOPTD VALUES (1057,57,601);
INSERT INTO RPTOPTD VALUES (1058,57,607);
INSERT INTO RPTOPTD VALUES (1059,58,600);
INSERT INTO RPTOPTD VALUES (1060,58,601);
INSERT INTO RPTOPTD VALUES (1061,58,607);
INSERT INTO RPTOPTD VALUES (1062,59,608);
INSERT INTO RPTOPTD VALUES (1063,59,609);
INSERT INTO RPTOPTD VALUES (1070,58,608);
INSERT INTO RPTOPTD VALUES (1071,58,609);

--
-- Table structure for table 'TD'
--

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
  PRIMARY KEY  (tdID)
) TYPE=InnoDB;

--
-- Dumping data for table 'TD'
--


INSERT INTO TD VALUES (1,1,'Land','00081',5,'2002-09-20',1,'2002-09-09','28145','87923','1999','2008','2007','4','','37374','3719','3799','7518');
INSERT INTO TD VALUES (2,1,'PlantsTrees','53619',1,'2002-12-24',2,'2002-12-19','40060','64184','1999','2004','2005','3','','88321','7925','9580','17505');
INSERT INTO TD VALUES (3,2,'PlantsTrees','77236',1,'2002-09-08',4,'2002-11-05','84901','12974','1999','2004','2006','4','','16123','4910','5783','10693');
INSERT INTO TD VALUES (4,1,'ImprovementsBuildings','54543',2,'2003-03-08',3,'2002-09-20','37435','58629','1999','2001','2005','4','','85829','9104','4554','13658');
INSERT INTO TD VALUES (5,2,'ImprovementsBuildings','21679',5,'2002-07-13',3,'2002-08-18','34357','21439','2004','2005','2001','1','','82258','9773','5625','15398');
INSERT INTO TD VALUES (6,3,'ImprovementsBuildings','66401',3,'2003-03-17',1,'2003-02-18','43641','59595','1999','2007','2001','2','','93312','5153','3419','8572');
INSERT INTO TD VALUES (7,4,'ImprovementsBuildings','65335',4,'2002-12-27',5,'2002-07-10','31400','23780','1999','2002','2002','4','','13725','3122','7234','10356');
INSERT INTO TD VALUES (8,5,'ImprovementsBuildings','86298',4,'2002-07-21',4,'2002-10-11','53505','65416','1999','2006','2002','3','','14554','5878','6854','12732');
INSERT INTO TD VALUES (9,1,'Machineries','67878',5,'2002-10-24',1,'2002-07-30','59797','66031','1999','2001','2001','5','','21456','5205','8139','13344');
INSERT INTO TD VALUES (10,2,'Machineries','88506',2,'2002-07-20',1,'2003-02-02','02043','61822','1999','2008','2009','2','','73485','2097','4424','6521');
INSERT INTO TD VALUES (11,3,'Machineries','65283',3,'2002-11-11',5,'2002-06-05','00659','41463','1999','2008','2009','1','','23192','9484','1382','10866');
INSERT INTO TD VALUES (12,2,'Land','85772',5,'2003-01-20',1,'2002-10-14','96642','26877','1999','2006','2003','2','','54503','2177','7884','10061');
INSERT INTO TD VALUES (13,3,'Land','09966',5,'2002-10-25',2,'2002-06-26','28041','31987','1999','2005','2009','2','','2220','1059','6108','7167');
INSERT INTO TD VALUES (14,3,'PlantsTrees','85895',2,'2003-04-20',4,'2002-09-01','48782','78924','1999','2005','2003','2','','87253','4585','5994','10579');
INSERT INTO TD VALUES (15,4,'PlantsTrees','66845',1,'2002-11-12',2,'2003-04-08','64189','15132','1999','2005','2003','5','','23521','1871','5786','7657');
INSERT INTO TD VALUES (16,6,'ImprovementsBuildings','53687',3,'2003-05-02',4,'2002-07-30','82735','88740','1999','2009','2009','4','','54474','9253','3478','12731');
INSERT INTO TD VALUES (17,7,'ImprovementsBuildings','98765',4,'2002-09-01',3,'2002-11-17','72468','93890','1999','2000','2007','2','','77077','280','9975','10255');
INSERT INTO TD VALUES (18,8,'ImprovementsBuildings','83027',4,'2002-05-20',2,'2002-08-05','11625','06111','1999','2000','2003','1','','12905','2847','9159','12006');
INSERT INTO TD VALUES (19,9,'ImprovementsBuildings','09217',3,'2002-07-08',1,'2003-04-14','61802','80950','1999','2006','2008','1','','49453','9952','3654','13606');
INSERT INTO TD VALUES (20,10,'ImprovementsBuildings','62250',5,'2002-08-10',2,'2002-12-27','24099','35161','1999','2003','2009','4','','2295','5418','2051','7469');
INSERT INTO TD VALUES (21,4,'Machineries','34522',1,'2002-12-25',3,'2002-11-06','58373','78519','1999','2009','2001','1','','96984','2602','2828','5430');
INSERT INTO TD VALUES (22,4,'Land','46511',5,'2002-10-19',2,'2003-01-04','76398','56047','1999','2006','2008','4','','84495','6989','873','7862');
INSERT INTO TD VALUES (23,5,'Land','41001',4,'2002-06-01',5,'2003-05-03','70354','28246','1999','2000','2005','3','','53655','2834','9894','12728');
INSERT INTO TD VALUES (24,5,'PlantsTrees','40803',5,'2002-11-02',2,'2003-01-25','70017','88282','1999','2002','2000','3','','33601','7532','7385','14917');
INSERT INTO TD VALUES (25,6,'PlantsTrees','19268',3,'2003-04-07',3,'2002-10-04','31224','74490','1999','2006','2003','5','','83315','9536','336','9872');
INSERT INTO TD VALUES (26,11,'ImprovementsBuildings','02814',5,'2002-09-22',5,'2003-03-20','99025','18705','1999','2004','2007','3','','82984','683','1671','2354');
INSERT INTO TD VALUES (27,12,'ImprovementsBuildings','54174',2,'2002-07-20',4,'2002-05-23','51480','77410','1999','2004','2009','2','','59764','4438','4464','8902');
INSERT INTO TD VALUES (28,5,'Machineries','97131',3,'2003-05-07',1,'2002-11-09','40872','56632','1999','2004','2009','4','','1338','4795','1014','5809');
INSERT INTO TD VALUES (29,6,'Land','99873',2,'2003-04-15',3,'2002-12-03','07921','01830','1999','2002','2005','5','','99999','6851','5236','12087');
INSERT INTO TD VALUES (30,7,'Land','97455',1,'2002-11-21',5,'2003-01-02','50981','78277','1999','2000','2006','3','','43110','4578','3102','7680');
INSERT INTO TD VALUES (31,8,'Land','04341',5,'2002-11-08',5,'2003-04-02','41407','02699','1999','2007','2005','2','','84606','5268','3408','8676');
INSERT INTO TD VALUES (32,9,'Land','49821',5,'2002-06-27',2,'2003-05-10','23185','65594','1999','2007','2001','5','','99722','2209','3557','5766');
INSERT INTO TD VALUES (33,10,'Land','60204',3,'2002-11-13',5,'2002-10-08','35765','66869','1999','2009','2002','4','','55573','2392','649','3041');
INSERT INTO TD VALUES (34,7,'PlantsTrees','66681',3,'2002-10-17',2,'2003-04-22','55839','43501','1999','2001','2006','3','','91989','9850','6127','15977');
INSERT INTO TD VALUES (35,8,'PlantsTrees','10696',2,'2003-04-25',4,'2002-08-12','57413','93038','1999','2007','2007','2','','74544','6808','3303','10111');
INSERT INTO TD VALUES (36,9,'PlantsTrees','89737',1,'2003-03-12',2,'2002-10-06','74420','28907','1999','2006','2007','3','','26900','6548','6974','13522');
INSERT INTO TD VALUES (37,13,'ImprovementsBuildings','94738',3,'2002-06-29',2,'2002-10-25','03958','29380','1999','2008','2008','2','','96537','1334','9179','10513');
INSERT INTO TD VALUES (38,14,'ImprovementsBuildings','69021',5,'2002-09-07',1,'2003-02-05','86504','73500','1999','2003','2002','4','','63226','9901','4331','14232');
INSERT INTO TD VALUES (39,15,'ImprovementsBuildings','69292',1,'2002-08-28',1,'2002-07-25','22748','93247','1999','2005','2005','4','','38201','5642','5174','10816');
INSERT INTO TD VALUES (40,6,'Machineries','19402',4,'2002-07-05',3,'2002-08-19','74822','35689','1999','2001','2001','3','','82550','604','9753','10357');
INSERT INTO TD VALUES (41,7,'Machineries','57002',5,'2003-04-25',3,'2003-02-11','40703','89459','1999','2000','2004','4','','75618','496','6919','7415');
INSERT INTO TD VALUES (42,8,'Machineries','61650',1,'2003-01-03',3,'2002-10-11','29823','17925','1999','2005','2004','5','','59114','3822','6542','10364');
INSERT INTO TD VALUES (43,11,'Land','84266',2,'2003-02-06',1,'2003-01-25','86912','09368','1999','2006','2009','2','','76271','8970','7876','16846');
INSERT INTO TD VALUES (44,12,'Land','33576',3,'2002-05-20',2,'2002-05-23','01821','70836','1999','2006','2008','3','','72317','8290','463','8753');
INSERT INTO TD VALUES (45,13,'Land','48374',3,'2002-12-12',4,'2002-05-19','38850','30258','1999','2002','2005','1','','97026','6007','8713','14720');
INSERT INTO TD VALUES (46,10,'PlantsTrees','89029',3,'2002-06-07',1,'2002-10-12','87647','09726','1999','2006','2006','5','','48241','2985','7446','10431');
INSERT INTO TD VALUES (47,11,'PlantsTrees','59069',3,'2003-03-28',4,'2002-12-12','00023','76565','1999','2007','2002','1','','8121','6352','8013','14365');
INSERT INTO TD VALUES (48,12,'PlantsTrees','06269',2,'2002-10-04',3,'2003-03-17','67267','88949','1999','2007','2007','4','','56047','1276','4043','5319');
INSERT INTO TD VALUES (49,16,'ImprovementsBuildings','97083',3,'2003-04-26',1,'2003-01-02','28498','97660','1999','2006','2001','3','','37817','480','1629','2109');
INSERT INTO TD VALUES (50,17,'ImprovementsBuildings','56789',5,'2003-04-13',1,'2002-12-11','67860','22812','1999','2009','2000','3','','32418','8217','8574','16791');
INSERT INTO TD VALUES (51,18,'ImprovementsBuildings','21235',4,'2002-12-10',5,'2003-04-17','78834','86437','1999','2006','2008','5','','39637','8217','9326','17543');
INSERT INTO TD VALUES (52,19,'ImprovementsBuildings','98028',1,'2003-04-05',2,'2002-08-27','10449','86049','1999','2005','2004','1','','5818','892','1049','1941');
INSERT INTO TD VALUES (53,20,'ImprovementsBuildings','99051',2,'2003-01-17',5,'2003-04-06','02442','88426','1999','2003','2009','3','','72691','255','3563','3818');
INSERT INTO TD VALUES (54,9,'Machineries','68042',3,'2003-03-02',5,'2002-09-13','72115','82794','1999','2003','2004','5','','90336','4872','8179','13051');
INSERT INTO TD VALUES (55,14,'Land','84200',5,'2002-11-10',4,'2002-08-27','81931','00755','1999','2000','2006','4','','22276','927','7386','8313');
INSERT INTO TD VALUES (56,15,'Land','81260',1,'2002-11-03',5,'2002-09-07','73143','89097','1999','2002','2007','2','','64284','1091','1836','2927');
INSERT INTO TD VALUES (57,13,'PlantsTrees','48771',4,'2003-03-23',5,'2002-08-21','04762','98991','1999','2001','2003','1','','77552','2148','8652','10800');
INSERT INTO TD VALUES (58,14,'PlantsTrees','07600',2,'2002-06-19',2,'2002-06-05','58578','09035','1999','2007','2000','4','','41089','3641','8250','11891');
INSERT INTO TD VALUES (59,15,'PlantsTrees','32520',4,'2002-06-20',5,'2002-06-07','95488','31294','1999','2000','2008','5','','6830','7082','4587','11669');
INSERT INTO TD VALUES (60,16,'PlantsTrees','74907',3,'2003-02-15',5,'2002-05-26','27209','64323','1999','2005','2003','5','','52319','4270','2835','7105');
INSERT INTO TD VALUES (61,21,'ImprovementsBuildings','71482',2,'2002-08-04',2,'2003-04-13','38637','15853','1999','2002','2004','3','','46678','3141','4335','7476');
INSERT INTO TD VALUES (62,22,'ImprovementsBuildings','01741',1,'2002-10-26',3,'2002-12-02','51749','61026','1999','2008','2000','2','','59033','9123','4364','13487');
INSERT INTO TD VALUES (63,23,'ImprovementsBuildings','39770',3,'2002-09-22',5,'2002-09-30','43835','31771','1999','2007','2009','4','','94684','7080','395','7475');
INSERT INTO TD VALUES (64,24,'ImprovementsBuildings','83111',3,'2003-01-08',4,'2003-04-03','35664','09168','1999','2002','2008','5','','32658','2820','5849','8669');
INSERT INTO TD VALUES (65,10,'Machineries','58759',2,'2002-06-13',5,'2002-07-21','07535','84975','1999','2000','2005','5','','67473','9605','4947','14552');
INSERT INTO TD VALUES (66,11,'Machineries','80285',4,'2002-06-03',3,'2002-06-01','90696','95301','1999','2006','2009','3','','72822','9931','9326','19257');
INSERT INTO TD VALUES (67,12,'Machineries','50817',4,'2003-01-04',1,'2002-06-16','84105','40488','1999','2005','2009','2','','10773','4539','8299','12838');
INSERT INTO TD VALUES (68,13,'Machineries','82543',4,'2002-05-12',2,'2002-08-11','05107','88742','1999','2003','2004','5','','38329','9231','6670','15901');
INSERT INTO TD VALUES (69,14,'Machineries','93702',2,'2003-01-14',2,'2003-01-20','22668','51818','1999','2002','2006','1','','92755','1679','602','2281');
INSERT INTO TD VALUES (70,16,'Land','55603',4,'2003-01-22',5,'2002-09-04','34021','92396','1999','2005','2008','2','','52896','5761','8400','14161');
INSERT INTO TD VALUES (71,17,'Land','35073',4,'2002-07-06',3,'2002-12-22','15520','68883','1999','2008','2000','5','','28418','2599','5611','8210');
INSERT INTO TD VALUES (72,18,'Land','32314',1,'2002-12-17',1,'2002-06-25','62836','87971','1999','2000','2007','4','','70330','8272','6519','14791');
INSERT INTO TD VALUES (73,19,'Land','66291',3,'2003-02-26',1,'2003-05-11','41367','34824','1999','2009','2000','2','','55519','3901','2196','6097');
INSERT INTO TD VALUES (74,17,'PlantsTrees','96320',3,'2003-04-04',3,'2002-09-30','02577','41281','1999','2001','2006','5','','58109','8386','1475','9861');
INSERT INTO TD VALUES (75,18,'PlantsTrees','14478',3,'2002-07-24',1,'2002-05-15','64697','41441','1999','2005','2009','5','','59440','5092','3176','8268');
INSERT INTO TD VALUES (76,19,'PlantsTrees','98877',1,'2002-09-27',5,'2003-04-27','28364','16304','1999','2005','2004','2','','64452','8666','1826','10492');
INSERT INTO TD VALUES (77,25,'ImprovementsBuildings','96546',1,'2002-11-22',2,'2002-12-14','75066','80990','1999','2004','2009','2','','14034','474','745','1219');
INSERT INTO TD VALUES (78,26,'ImprovementsBuildings','41546',5,'2003-01-13',1,'2003-03-23','44099','68053','1999','2008','2008','1','','39191','9342','6361','15703');
INSERT INTO TD VALUES (79,15,'Machineries','06209',5,'2003-03-08',1,'2002-08-01','56376','52051','1999','2008','2001','5','','19702','6434','3173','9607');
INSERT INTO TD VALUES (80,16,'Machineries','67537',2,'2002-11-24',1,'2002-06-09','08538','80855','1999','2002','2009','4','','82089','6480','4066','10546');
INSERT INTO TD VALUES (81,20,'Land','12859',2,'2002-06-08',5,'2003-02-25','74347','01203','1999','2007','2006','3','','12445','6916','6922','13838');
INSERT INTO TD VALUES (82,21,'Land','99596',4,'2003-04-08',1,'2003-01-18','37309','38078','1999','2002','2008','4','','91801','9646','138','9784');
INSERT INTO TD VALUES (83,20,'PlantsTrees','82645',3,'2002-11-21',5,'2002-05-19','36379','93209','1999','2006','2006','5','','5567','3144','7053','10197');
INSERT INTO TD VALUES (84,21,'PlantsTrees','32773',4,'2003-04-22',2,'2002-08-15','29655','53687','1999','2007','2004','4','','1724','9399','3552','12951');
INSERT INTO TD VALUES (85,22,'PlantsTrees','17920',3,'2002-07-25',5,'2002-09-20','64722','69490','1999','2004','2006','5','','48494','8504','5589','14093');
INSERT INTO TD VALUES (86,27,'ImprovementsBuildings','73120',3,'2002-12-25',2,'2002-08-12','56732','92160','1999','2003','2002','5','','32337','4713','3159','7872');
INSERT INTO TD VALUES (87,28,'ImprovementsBuildings','51248',2,'2002-10-15',1,'2003-03-28','64489','63115','1999','2007','2005','1','','91701','3391','619','4010');
INSERT INTO TD VALUES (88,17,'Machineries','14947',1,'2002-06-24',4,'2002-12-05','12242','20876','1999','2006','2002','3','','4504','4566','9883','14449');
INSERT INTO TD VALUES (89,18,'Machineries','55040',5,'2003-04-20',4,'2002-08-24','32906','14535','1999','2002','2003','3','','11421','3496','9738','13234');
INSERT INTO TD VALUES (90,22,'Land','89270',2,'2002-08-28',4,'2003-04-14','25519','19774','1999','2001','2005','5','','77746','2526','1256','3782');
INSERT INTO TD VALUES (91,23,'Land','68689',2,'2002-12-19',1,'2002-11-02','17157','08751','1999','2005','2008','2','','46595','2319','3541','5860');
INSERT INTO TD VALUES (92,24,'Land','51684',1,'2003-03-27',4,'2003-04-15','43092','41194','1999','2004','2005','2','','68693','2230','183','2413');
INSERT INTO TD VALUES (93,23,'PlantsTrees','74230',3,'2002-06-25',2,'2002-10-03','36914','90271','1999','2008','2004','5','','55888','4886','9933','14819');
INSERT INTO TD VALUES (94,24,'PlantsTrees','28197',2,'2003-03-19',2,'2002-09-15','23376','93181','1999','2007','2007','4','','13308','5922','6436','12358');
INSERT INTO TD VALUES (95,29,'ImprovementsBuildings','63131',1,'2002-06-24',5,'2002-11-12','90774','04020','1999','2000','2007','3','','50506','4262','220','4482');
INSERT INTO TD VALUES (96,30,'ImprovementsBuildings','03739',3,'2003-03-05',1,'2002-07-08','47652','10094','1999','2001','2008','1','','58069','1442','7009','8451');
INSERT INTO TD VALUES (97,31,'ImprovementsBuildings','82614',3,'2002-06-14',2,'2003-05-05','97709','34141','1999','2002','2006','1','','26540','9792','7289','17081');
INSERT INTO TD VALUES (98,32,'ImprovementsBuildings','72092',5,'2002-11-23',3,'2002-06-02','72936','62023','1999','2003','2009','3','','79529','5531','7367','12898');
INSERT INTO TD VALUES (99,33,'ImprovementsBuildings','93110',5,'2003-04-25',2,'2002-11-17','23121','41748','1999','2003','2006','4','','26862','7297','8726','16023');
INSERT INTO TD VALUES (100,19,'Machineries','88767',1,'2002-08-28',3,'2002-06-27','55512','58545','1999','2002','2007','4','','1823','506','3813','4319');
INSERT INTO TD VALUES (101,20,'Machineries','55620',2,'2002-11-10',5,'2003-01-24','56509','01244','1999','2008','2004','3','','19869','4915','6735','11650');
INSERT INTO TD VALUES (102,25,'Land','68786',4,'2002-10-18',4,'2002-06-24','37450','86817','1999','2005','2003','5','','39367','1008','2499','3507');
INSERT INTO TD VALUES (103,26,'Land','12657',5,'2002-11-02',5,'2003-03-17','29178','61126','1999','2006','2000','3','','18546','1057','6365','7422');
INSERT INTO TD VALUES (104,27,'Land','56275',2,'2002-09-25',3,'2003-02-19','11082','17718','1999','2007','2005','4','','54761','6058','7538','13596');
INSERT INTO TD VALUES (105,25,'PlantsTrees','81925',4,'2002-06-26',1,'2002-06-29','43849','46309','1999','2002','2002','1','','72277','1785','4780','6565');
INSERT INTO TD VALUES (106,34,'ImprovementsBuildings','19393',3,'2002-10-23',5,'2002-07-22','00060','17214','1999','2004','2001','4','','12728','4657','404','5061');
INSERT INTO TD VALUES (107,35,'ImprovementsBuildings','66152',3,'2002-05-19',3,'2003-04-01','44265','84753','1999','2001','2003','3','','73507','728','3425','4153');
INSERT INTO TD VALUES (108,36,'ImprovementsBuildings','89916',4,'2002-06-28',5,'2002-05-19','23588','78472','1999','2006','2005','5','','5410','5542','1241','6783');
INSERT INTO TD VALUES (109,21,'Machineries','53588',3,'2003-03-29',4,'2003-02-23','50951','02563','1999','2000','2007','4','','97244','522','5388','5910');
INSERT INTO TD VALUES (110,22,'Machineries','33398',1,'2003-04-11',5,'2003-01-03','25566','17545','1999','2002','2004','4','','56065','6758','9431','16189');
INSERT INTO TD VALUES (111,23,'Machineries','85274',5,'2003-01-15',2,'2003-02-22','65052','84606','1999','2005','2000','2','','99319','935','3154','4089');
INSERT INTO TD VALUES (112,28,'Land','89940',4,'2003-01-11',2,'2002-12-25','46669','20248','1999','2002','2000','3','','51447','1602','7655','9257');
INSERT INTO TD VALUES (113,26,'PlantsTrees','43085',3,'2003-04-14',3,'2002-06-24','12209','42982','1999','2009','2009','3','','19596','8601','7120','15721');
INSERT INTO TD VALUES (114,27,'PlantsTrees','50283',5,'2002-12-04',5,'2002-06-23','21732','18855','1999','2007','2005','1','','55974','1410','2692','4102');
INSERT INTO TD VALUES (115,28,'PlantsTrees','60212',4,'2003-02-22',1,'2002-08-13','03963','61709','1999','2005','2008','4','','84049','6985','6129','13114');
INSERT INTO TD VALUES (116,37,'ImprovementsBuildings','80074',4,'2003-02-15',3,'2003-03-07','35782','91944','1999','2007','2002','5','','21172','3801','6863','10664');
INSERT INTO TD VALUES (117,38,'ImprovementsBuildings','44917',3,'2002-07-03',3,'2002-09-20','43640','79083','1999','2008','2004','4','','59890','2732','369','3101');
INSERT INTO TD VALUES (118,24,'Machineries','05439',5,'2003-04-13',2,'2002-12-03','92110','58230','1999','2005','2006','3','','57152','7561','6422','13983');
INSERT INTO TD VALUES (119,25,'Machineries','92994',1,'2002-07-07',4,'2002-08-06','45005','90262','1999','2008','2003','4','','30654','7766','2537','10303');
INSERT INTO TD VALUES (120,26,'Machineries','91398',5,'2003-01-07',5,'2002-11-10','79420','68333','1999','2000','2005','5','','22651','2569','6335','8904');
INSERT INTO TD VALUES (121,29,'Land','23657',2,'2003-01-04',1,'2002-10-04','33226','72481','1999','2009','2009','4','','4576','5097','1782','6879');
INSERT INTO TD VALUES (122,30,'Land','39783',4,'2002-12-31',1,'2002-08-13','87423','97961','1999','2007','2007','5','','87698','8914','4378','13292');
INSERT INTO TD VALUES (123,29,'PlantsTrees','97045',1,'2002-08-28',1,'2002-09-23','13941','98923','1999','2006','2005','4','','10016','7309','3406','10715');
INSERT INTO TD VALUES (124,30,'PlantsTrees','15288',4,'2002-08-04',3,'2002-12-23','31970','46114','1999','2002','2005','3','','59425','7103','7742','14845');
INSERT INTO TD VALUES (125,31,'PlantsTrees','38046',3,'2003-05-02',1,'2002-06-25','51200','88603','1999','2008','2000','1','','96351','765','5494','6259');
INSERT INTO TD VALUES (126,39,'ImprovementsBuildings','31430',5,'2002-07-07',3,'2002-08-12','60429','44943','1999','2007','2003','5','','2448','2015','3182','5197');
INSERT INTO TD VALUES (127,27,'Machineries','90888',2,'2003-01-04',5,'2002-05-26','85470','26865','1999','2001','2005','2','','58653','779','1564','2343');
INSERT INTO TD VALUES (128,28,'Machineries','66783',3,'2003-01-30',5,'2002-06-01','30827','52105','1999','2009','2005','4','','83262','7553','8543','16096');
INSERT INTO TD VALUES (129,29,'Machineries','32212',5,'2003-02-20',4,'2002-09-26','48045','12210','1999','2008','2001','3','','36009','4422','3398','7820');
INSERT INTO TD VALUES (130,31,'Land','37332',5,'2002-05-13',2,'2002-05-27','21859','62015','1999','2003','2003','4','','18085','9685','9728','19413');
INSERT INTO TD VALUES (131,32,'Land','67208',5,'2002-10-29',4,'2002-07-04','96633','71093','1999','2001','2002','2','','5908','6209','8486','14695');
INSERT INTO TD VALUES (132,32,'PlantsTrees','93780',2,'2002-12-08',3,'2003-01-20','20251','81703','1999','2003','2009','5','','61062','9334','4106','13440');
INSERT INTO TD VALUES (133,40,'ImprovementsBuildings','02913',1,'2003-04-29',1,'2003-04-15','03685','22254','1999','2001','2008','3','','24325','940','5585','6525');
INSERT INTO TD VALUES (134,41,'ImprovementsBuildings','80661',1,'2002-06-11',2,'2002-08-03','16057','25965','1999','2003','2002','1','','66580','6771','1905','8676');
INSERT INTO TD VALUES (135,42,'ImprovementsBuildings','19386',2,'2002-12-14',4,'2002-06-09','10608','42352','1999','2003','2000','5','','63850','6229','8002','14231');
INSERT INTO TD VALUES (136,30,'Machineries','06741',3,'2003-01-03',4,'2002-07-15','20339','75337','1999','2000','2004','3','','98443','726','353','1079');
INSERT INTO TD VALUES (137,31,'Machineries','94070',5,'2003-05-07',2,'2002-08-26','09369','38861','1999','2006','2008','3','','82343','2977','2525','5502');
INSERT INTO TD VALUES (138,33,'Land','38708',5,'2002-08-29',3,'2002-12-21','95633','54169','1999','2009','2006','1','','14959','4119','4970','9089');
INSERT INTO TD VALUES (139,34,'Land','53859',1,'2002-08-04',4,'2002-10-23','53537','65580','1999','2005','2008','5','','29528','8650','2284','10934');
INSERT INTO TD VALUES (140,33,'PlantsTrees','73110',1,'2002-07-10',3,'2002-08-21','29495','97000','1999','2005','2005','1','','31970','3439','953','4392');
INSERT INTO TD VALUES (141,43,'ImprovementsBuildings','96829',2,'2002-07-13',5,'2003-02-17','43940','78815','1999','2002','2009','2','','91965','5563','9397','14960');
INSERT INTO TD VALUES (142,44,'ImprovementsBuildings','35189',2,'2003-04-27',1,'2003-03-30','06946','20334','1999','2001','2002','3','','37058','8768','7480','16248');
INSERT INTO TD VALUES (143,45,'ImprovementsBuildings','52131',1,'2002-07-22',1,'2002-07-18','51238','16356','1999','2003','2000','4','','13690','3198','213','3411');
INSERT INTO TD VALUES (144,32,'Machineries','57494',4,'2002-09-28',4,'2002-12-03','44334','47075','1999','2002','2000','5','','36258','6003','2387','8390');
INSERT INTO TD VALUES (145,35,'Land','81766',4,'2003-01-07',2,'2002-05-17','63485','35119','1999','2009','2002','1','','72392','450','279','729');
INSERT INTO TD VALUES (146,36,'Land','77022',2,'2002-12-24',3,'2003-03-20','15311','70061','1999','2004','2006','2','','34747','2735','3609','6344');
INSERT INTO TD VALUES (147,37,'Land','21832',5,'2002-08-12',1,'2003-01-01','56093','50283','1999','2007','2003','4','','13587','7995','2023','10018');
INSERT INTO TD VALUES (148,38,'Land','53278',1,'2003-04-06',1,'2003-04-30','15465','22151','1999','2001','2006','3','','62475','4327','3571','7898');
INSERT INTO TD VALUES (149,39,'Land','55368',5,'2003-03-07',1,'2003-02-17','92418','06603','1999','2003','2003','4','','57575','2422','6820','9242');
INSERT INTO TD VALUES (150,34,'PlantsTrees','46834',4,'2003-01-27',1,'2002-07-18','40765','52723','1999','2005','2000','1','','19148','5745','9704','15449');
INSERT INTO TD VALUES (151,35,'PlantsTrees','75013',5,'2002-08-02',5,'2002-05-12','31031','49978','1999','2002','2001','2','','14831','278','6776','7054');
INSERT INTO TD VALUES (152,46,'ImprovementsBuildings','64360',5,'2002-06-13',3,'2002-12-10','76407','52454','1999','2008','2001','3','','78635','3073','9725','12798');
INSERT INTO TD VALUES (153,47,'ImprovementsBuildings','58768',3,'2002-11-30',3,'2002-10-06','11285','29321','1999','2005','2007','3','','45020','9782','8112','17894');
INSERT INTO TD VALUES (154,48,'ImprovementsBuildings','22083',1,'2002-07-01',1,'2003-05-07','15917','60109','1999','2003','2004','5','','55539','2908','6263','9171');
INSERT INTO TD VALUES (155,49,'ImprovementsBuildings','65307',4,'2002-07-03',2,'2002-11-18','86733','69333','1999','2004','2007','2','','23740','8559','482','9041');
INSERT INTO TD VALUES (156,50,'ImprovementsBuildings','78275',2,'2002-10-19',1,'2002-07-27','87879','70631','1999','2006','2003','2','','12307','9659','7391','17050');
INSERT INTO TD VALUES (157,33,'Machineries','55260',1,'2003-02-14',2,'2003-01-16','46963','29092','1999','2002','2009','3','','59911','9597','6275','15872');
INSERT INTO TD VALUES (158,34,'Machineries','14895',2,'2003-04-21',2,'2002-11-26','53887','88601','1999','2008','2004','5','','9297','642','5044','5686');
INSERT INTO TD VALUES (159,35,'Machineries','59728',5,'2002-07-23',1,'2002-08-02','65018','36993','1999','2003','2006','1','','19745','8229','5923','14152');
INSERT INTO TD VALUES (160,40,'Land','42470',1,'2003-04-18',3,'2003-03-13','27044','79641','1999','2009','2009','5','','9179','3909','4891','8800');
INSERT INTO TD VALUES (161,41,'Land','42844',2,'2002-12-11',4,'2002-09-30','70092','25418','1999','2008','2009','4','','23006','4392','2516','6908');
INSERT INTO TD VALUES (162,36,'PlantsTrees','50901',4,'2003-02-09',1,'2003-04-28','91107','68161','1999','2008','2009','5','','50930','7835','3759','11594');
INSERT INTO TD VALUES (163,37,'PlantsTrees','99950',4,'2003-04-18',2,'2002-10-08','50301','67931','1999','2006','2004','5','','77068','2505','3214','5719');
INSERT INTO TD VALUES (164,38,'PlantsTrees','57207',2,'2002-11-11',1,'2002-08-08','29072','15935','1999','2003','2009','2','','15779','2601','7727','10328');
INSERT INTO TD VALUES (165,51,'ImprovementsBuildings','29922',4,'2003-04-13',1,'2003-04-15','88875','93968','1999','2007','2008','4','','22539','9037','3466','12503');
INSERT INTO TD VALUES (166,52,'ImprovementsBuildings','79674',1,'2003-03-09',5,'2003-03-15','03734','15108','1999','2007','2007','4','','28712','7726','2753','10479');
INSERT INTO TD VALUES (167,36,'Machineries','85282',4,'2002-10-19',3,'2003-03-05','75696','25334','1999','2008','2000','4','','34148','8868','9455','18323');
INSERT INTO TD VALUES (168,37,'Machineries','96200',2,'2002-12-20',4,'2003-02-01','99888','50071','1999','2000','2000','3','','81915','5408','8459','13867');
INSERT INTO TD VALUES (169,42,'Land','06866',5,'2003-03-11',4,'2003-05-06','70060','60045','1999','2003','2003','5','','12337','7897','1296','9193');
INSERT INTO TD VALUES (170,43,'Land','71277',1,'2002-12-15',4,'2002-10-26','07397','81982','1999','2004','2007','3','','9214','6898','5213','12111');
INSERT INTO TD VALUES (171,44,'Land','05866',3,'2002-07-01',1,'2002-12-25','76389','37082','1999','2002','2003','4','','51443','5240','4383','9623');
INSERT INTO TD VALUES (172,45,'Land','16084',5,'2003-04-18',5,'2002-06-14','32955','99077','1999','2000','2008','2','','20999','9054','3568','12622');
INSERT INTO TD VALUES (173,39,'PlantsTrees','77769',4,'2002-08-04',3,'2003-02-12','07363','34394','1999','2000','2000','4','','95313','5634','9269','14903');
INSERT INTO TD VALUES (174,53,'ImprovementsBuildings','45811',2,'2002-10-01',5,'2002-05-25','25194','90446','1999','2000','2004','2','','84929','9578','5753','15331');
INSERT INTO TD VALUES (175,38,'Machineries','79556',3,'2003-04-22',2,'2002-07-31','88293','42281','1999','2003','2001','3','','51272','8384','5182','13566');
INSERT INTO TD VALUES (176,39,'Machineries','51053',2,'2002-12-11',4,'2002-09-27','22498','18039','1999','2000','2003','1','','88159','2374','8999','11373');
INSERT INTO TD VALUES (177,46,'Land','23721',2,'2002-11-07',4,'2003-03-03','97991','61569','1999','2004','2000','5','','7591','6627','2747','9374');
INSERT INTO TD VALUES (178,47,'Land','54071',3,'2002-06-25',1,'2002-12-23','22696','25297','1999','2004','2008','4','','3155','7811','1601','9412');
INSERT INTO TD VALUES (179,48,'Land','99305',2,'2002-08-16',5,'2003-01-24','88549','88024','1999','2002','2003','3','','74708','4269','2241','6510');
INSERT INTO TD VALUES (180,40,'PlantsTrees','80184',3,'2002-07-06',1,'2003-01-08','39986','45215','1999','2007','2000','3','','1115','8813','1856','10669');
INSERT INTO TD VALUES (181,54,'ImprovementsBuildings','24958',2,'2003-01-08',5,'2002-08-13','86902','03987','1999','2008','2006','1','','35411','802','8024','8826');
INSERT INTO TD VALUES (182,55,'ImprovementsBuildings','71489',1,'2002-11-26',1,'2002-07-25','67382','51120','1999','2003','2005','4','','91406','9894','2944','12838');
INSERT INTO TD VALUES (183,56,'ImprovementsBuildings','11341',3,'2002-12-14',4,'2002-10-18','27303','49859','1999','2001','2001','2','','77496','7764','9024','16788');
INSERT INTO TD VALUES (184,57,'ImprovementsBuildings','75657',2,'2002-05-25',3,'2003-01-23','71311','08829','1999','2008','2006','3','','97652','9115','1891','11006');
INSERT INTO TD VALUES (185,40,'Machineries','31831',2,'2003-04-03',2,'2002-12-27','15022','01486','1999','2004','2002','4','','72889','6083','7636','13719');
INSERT INTO TD VALUES (186,41,'Machineries','02619',5,'2003-01-20',1,'2003-02-10','92273','73437','1999','2006','2005','4','','82297','2874','2133','5007');
INSERT INTO TD VALUES (187,42,'Machineries','44438',2,'2003-03-15',1,'2002-12-30','41280','03330','1999','2008','2007','1','','93530','329','548','877');
INSERT INTO TD VALUES (188,49,'Land','28107',1,'2003-03-16',1,'2002-05-21','22949','23367','1999','2005','2001','3','','64230','2124','2209','4333');
INSERT INTO TD VALUES (189,41,'PlantsTrees','27872',2,'2002-07-17',3,'2002-10-30','12475','04930','1999','2001','2002','5','','51281','3079','5987','9066');
INSERT INTO TD VALUES (190,42,'PlantsTrees','89746',4,'2003-03-28',1,'2002-07-14','27979','05594','1999','2006','2008','1','','88156','5268','495','5763');
INSERT INTO TD VALUES (191,43,'PlantsTrees','06292',3,'2003-04-03',3,'2002-06-28','04291','94892','1999','2005','2006','2','','20306','6664','2845','9509');
INSERT INTO TD VALUES (192,58,'ImprovementsBuildings','50507',4,'2002-12-31',2,'2003-04-21','93298','27044','1999','2002','2001','3','','57395','7272','4114','11386');
INSERT INTO TD VALUES (193,59,'ImprovementsBuildings','23556',1,'2002-09-10',3,'2002-06-24','20627','86131','1999','2000','2001','3','','87766','4163','6761','10924');
INSERT INTO TD VALUES (194,60,'ImprovementsBuildings','35997',1,'2003-04-21',5,'2002-06-01','76675','58436','1999','2004','2005','4','','66415','1553','9948','11501');
INSERT INTO TD VALUES (195,61,'ImprovementsBuildings','44165',5,'2002-05-19',2,'2002-12-21','07865','42976','1999','2007','2007','5','','72355','708','304','1012');
INSERT INTO TD VALUES (196,43,'Machineries','61096',2,'2002-07-02',4,'2002-07-11','30136','98481','1999','2001','2008','3','','70859','2406','4632','7038');
INSERT INTO TD VALUES (197,50,'Land','97865',3,'2003-03-14',5,'2003-04-14','92444','72524','1999','2002','2006','4','','30402','5676','8970','14646');
INSERT INTO TD VALUES (198,51,'Land','76046',5,'2002-05-27',5,'2003-01-27','01609','38769','1999','2009','2001','4','','90654','3878','4989','8867');
INSERT INTO TD VALUES (199,44,'PlantsTrees','11956',3,'2002-05-22',1,'2002-06-25','50078','87582','1999','2006','2003','2','','81331','303','1525','1828');
INSERT INTO TD VALUES (200,45,'PlantsTrees','36881',2,'2002-10-13',3,'2002-12-29','00431','83538','1999','2008','2006','3','','51907','6998','3682','10680');
INSERT INTO TD VALUES (201,62,'ImprovementsBuildings','96737',3,'2002-09-25',5,'2002-07-03','98611','63476','1999','2004','2003','3','','38487','9774','2278','12052');
INSERT INTO TD VALUES (202,63,'ImprovementsBuildings','89838',3,'2002-09-10',3,'2003-01-24','64040','82262','1999','2001','2000','2','','99542','9005','5123','14128');
INSERT INTO TD VALUES (203,44,'Machineries','09853',5,'2002-08-08',5,'2002-06-17','77251','72332','1999','2007','2006','4','','98397','2035','114','2149');
INSERT INTO TD VALUES (204,45,'Machineries','34280',3,'2003-03-07',5,'2002-11-26','69314','89379','1999','2002','2002','1','','78386','8254','5582','13836');
INSERT INTO TD VALUES (205,46,'Machineries','07751',3,'2002-07-19',5,'2002-06-22','05150','53746','1999','2002','2006','1','','60436','3595','4694','8289');
INSERT INTO TD VALUES (206,52,'Land','16754',3,'2002-10-07',2,'2003-02-03','46776','78111','1999','2002','2007','2','','36503','3192','412','3604');
INSERT INTO TD VALUES (207,53,'Land','24436',5,'2002-12-08',1,'2003-03-02','75747','00893','1999','2006','2000','4','','33104','3708','3054','6762');
INSERT INTO TD VALUES (208,54,'Land','51514',3,'2003-02-18',5,'2002-11-05','74437','57703','1999','2007','2009','4','','58601','6185','202','6387');
INSERT INTO TD VALUES (209,55,'Land','89218',4,'2002-11-17',4,'2003-01-17','54674','36454','1999','2006','2008','4','','41127','9143','6679','15822');
INSERT INTO TD VALUES (210,46,'PlantsTrees','00771',4,'2002-09-21',4,'2003-03-12','29647','79551','1999','2002','2000','3','','78029','6814','4233','11047');
INSERT INTO TD VALUES (211,47,'PlantsTrees','60843',5,'2002-08-24',2,'2003-04-15','59493','85608','1999','2008','2000','2','','94000','8569','491','9060');
INSERT INTO TD VALUES (212,64,'ImprovementsBuildings','79695',1,'2002-05-16',4,'2003-03-08','96515','61471','1999','2009','2005','3','','53489','7813','9599','17412');
INSERT INTO TD VALUES (213,65,'ImprovementsBuildings','89419',4,'2003-01-02',2,'2002-08-02','42563','43056','1999','2009','2000','5','','10058','6481','6101','12582');
INSERT INTO TD VALUES (214,66,'ImprovementsBuildings','38694',2,'2002-11-16',5,'2003-01-14','36470','14704','1999','2004','2008','2','','11517','9892','6805','16697');
INSERT INTO TD VALUES (215,67,'ImprovementsBuildings','01022',2,'2003-05-01',2,'2002-11-30','24798','70024','1999','2000','2009','5','','53171','431','960','1391');
INSERT INTO TD VALUES (216,47,'Machineries','16013',4,'2003-05-04',1,'2002-06-18','17356','81044','1999','2005','2003','1','','30788','2977','3578','6555');
INSERT INTO TD VALUES (217,56,'Land','00723',3,'2003-03-15',3,'2002-09-21','17193','24212','1999','2006','2009','2','','39392','9757','5026','14783');
INSERT INTO TD VALUES (218,57,'Land','53511',5,'2003-04-03',3,'2003-01-29','54154','89328','1999','2008','2009','2','','23884','1150','1992','3142');
INSERT INTO TD VALUES (219,58,'Land','23044',4,'2002-05-28',5,'2002-05-25','47701','60568','1999','2004','2007','3','','92399','3057','6376','9433');
INSERT INTO TD VALUES (220,48,'PlantsTrees','32720',4,'2003-03-18',4,'2002-09-27','33439','00084','1999','2000','2003','5','','8563','1199','9240','10439');
INSERT INTO TD VALUES (221,49,'PlantsTrees','67568',2,'2002-06-21',1,'2002-07-27','41343','74188','1999','2002','2003','4','','7551','350','2254','2604');
INSERT INTO TD VALUES (222,50,'PlantsTrees','78612',3,'2002-12-13',2,'2003-01-15','77132','00498','1999','2003','2004','4','','91505','8025','7120','15145');
INSERT INTO TD VALUES (223,68,'ImprovementsBuildings','01551',1,'2002-08-28',1,'2002-11-30','98138','56955','1999','2001','2003','5','','17477','8473','396','8869');
INSERT INTO TD VALUES (224,48,'Machineries','75796',4,'2002-08-07',1,'2002-07-21','32197','18339','1999','2000','2007','3','','13972','1608','8079','9687');
INSERT INTO TD VALUES (225,49,'Machineries','33600',4,'2003-01-06',4,'2002-09-11','48268','96476','1999','2006','2008','1','','30886','3328','8676','12004');
INSERT INTO TD VALUES (226,50,'Machineries','74811',3,'2002-07-25',2,'2003-05-05','18609','60417','1999','2001','2005','2','','99158','5514','4573','10087');
INSERT INTO TD VALUES (227,51,'Machineries','02473',1,'2002-12-24',3,'2002-07-18','54046','64092','1999','2004','2005','4','','57378','2636','6820','9456');
INSERT INTO TD VALUES (228,59,'Land','37026',2,'2003-05-06',5,'2002-12-15','18284','67715','1999','2001','2005','4','','24737','8150','5856','14006');
INSERT INTO TD VALUES (229,60,'Land','17315',1,'2002-12-21',5,'2002-07-29','57766','51398','1999','2008','2008','5','','61510','9593','9453','19046');
INSERT INTO TD VALUES (230,61,'Land','73929',5,'2003-01-03',1,'2002-05-21','03206','61408','1999','2004','2008','3','','4768','9719','6569','16288');
INSERT INTO TD VALUES (231,51,'PlantsTrees','04812',5,'2002-05-23',2,'2002-06-04','39841','86830','1999','2006','2005','3','','22133','6434','5216','11650');
INSERT INTO TD VALUES (232,69,'ImprovementsBuildings','77429',5,'2003-01-21',5,'2003-02-07','81596','00728','1999','2002','2005','5','','12929','9243','2123','11366');
INSERT INTO TD VALUES (233,52,'Machineries','19295',3,'2002-09-07',5,'2002-06-12','91583','52950','1999','2001','2005','2','','66090','6479','8683','15162');
INSERT INTO TD VALUES (234,53,'Machineries','69694',1,'2003-02-09',3,'2002-12-12','63234','44248','1999','2007','2000','3','','82572','978','9771','10749');
INSERT INTO TD VALUES (235,62,'Land','98188',4,'2002-06-26',5,'2002-07-22','27119','67365','1999','2004','2001','4','','6930','1503','3525','5028');
INSERT INTO TD VALUES (236,63,'Land','19384',5,'2002-11-13',1,'2002-05-24','50787','02452','1999','2006','2007','1','','98847','1786','6793','8579');
INSERT INTO TD VALUES (237,64,'Land','97188',4,'2002-05-23',5,'2002-09-06','47724','47181','1999','2004','2001','1','','37827','4335','8033','12368');
INSERT INTO TD VALUES (238,65,'Land','00790',3,'2003-01-01',2,'2003-02-05','24988','11105','1999','2009','2009','4','','21344','8442','4010','12452');
INSERT INTO TD VALUES (239,66,'Land','41596',1,'2002-11-25',3,'2003-04-13','92265','66814','1999','2002','2005','2','','95443','9907','677','10584');
INSERT INTO TD VALUES (240,52,'PlantsTrees','40627',5,'2002-09-30',2,'2002-05-28','89257','63516','1999','2000','2004','2','','51877','2675','7984','10659');
INSERT INTO TD VALUES (241,53,'PlantsTrees','93943',1,'2003-01-27',4,'2002-11-07','67167','92689','1999','2005','2000','4','','22695','7814','2780','10594');
INSERT INTO TD VALUES (242,54,'PlantsTrees','75072',1,'2002-09-11',3,'2003-01-09','50901','38558','1999','2002','2003','1','','89683','2091','5258','7349');
INSERT INTO TD VALUES (243,70,'ImprovementsBuildings','45078',5,'2003-03-02',3,'2002-06-02','24138','57130','1999','2007','2006','1','','21712','2804','878','3682');
INSERT INTO TD VALUES (244,71,'ImprovementsBuildings','71839',5,'2002-11-27',5,'2002-05-15','48936','86040','1999','2002','2003','3','','27380','9930','4575','14505');
INSERT INTO TD VALUES (245,72,'ImprovementsBuildings','60549',4,'2002-11-02',2,'2003-04-04','06699','61056','1999','2004','2001','3','','35633','1889','4518','6407');
INSERT INTO TD VALUES (246,54,'Machineries','21437',1,'2002-07-17',3,'2002-07-03','08873','33392','1999','2001','2005','3','','75267','4526','6491','11017');
INSERT INTO TD VALUES (247,55,'Machineries','91071',4,'2002-08-20',1,'2002-06-25','68256','61912','1999','2009','2000','4','','74842','7348','7872','15220');
INSERT INTO TD VALUES (248,56,'Machineries','53103',4,'2002-12-29',2,'2002-07-16','87475','09333','1999','2009','2004','5','','69722','5866','1237','7103');
INSERT INTO TD VALUES (249,67,'Land','30321',1,'2003-01-25',3,'2002-09-27','50673','94227','1999','2006','2003','5','','10703','8101','423','8524');
INSERT INTO TD VALUES (250,68,'Land','61354',2,'2002-12-09',2,'2003-01-31','09303','67227','1999','2008','2008','2','','63359','6286','1687','7973');
INSERT INTO TD VALUES (251,55,'PlantsTrees','17851',1,'2003-04-29',1,'2002-08-12','76470','28011','1999','2006','2007','5','','30934','643','9007','9650');
INSERT INTO TD VALUES (252,56,'PlantsTrees','40512',3,'2002-08-12',1,'2003-02-21','97547','48548','1999','2005','2004','2','','15045','8759','8590','17349');
INSERT INTO TD VALUES (253,73,'ImprovementsBuildings','67074',1,'2002-07-06',2,'2002-06-28','66736','65023','1999','2006','2007','3','','48188','1894','1731','3625');
INSERT INTO TD VALUES (254,57,'Machineries','43170',1,'2002-11-15',2,'2002-10-06','95017','49767','1999','2009','2005','5','','96106','3490','5491','8981');
INSERT INTO TD VALUES (255,58,'Machineries','99513',4,'2002-08-17',1,'2002-08-23','42289','93349','1999','2006','2008','3','','28281','745','5198','5943');
INSERT INTO TD VALUES (256,59,'Machineries','46657',5,'2003-02-23',1,'2002-10-20','96679','45522','1999','2004','2005','1','','74413','9487','4826','14313');
INSERT INTO TD VALUES (257,69,'Land','15741',2,'2003-01-16',1,'2002-07-08','75171','11986','1999','2002','2000','1','','51352','6561','6900','13461');
INSERT INTO TD VALUES (258,70,'Land','95231',5,'2003-02-06',3,'2003-02-27','45498','93170','1999','2005','2002','5','','42284','1090','992','2082');
INSERT INTO TD VALUES (259,57,'PlantsTrees','70649',2,'2003-01-17',5,'2003-02-18','39229','00149','1999','2008','2008','5','','64048','8824','4002','12826');
INSERT INTO TD VALUES (260,58,'PlantsTrees','55099',2,'2003-01-13',5,'2002-12-22','07010','51859','1999','2001','2005','2','','84988','557','1029','1586');
INSERT INTO TD VALUES (261,59,'PlantsTrees','75122',5,'2003-04-09',5,'2002-05-24','76466','11607','1999','2008','2007','2','','79325','2565','7587','10152');
INSERT INTO TD VALUES (262,74,'ImprovementsBuildings','46574',5,'2003-04-02',3,'2003-03-16','49832','33713','1999','2004','2000','1','','9661','5400','8926','14326');
INSERT INTO TD VALUES (263,60,'Machineries','12626',5,'2002-10-29',1,'2003-01-31','40359','58514','1999','2009','2000','2','','99512','5738','4743','10481');
INSERT INTO TD VALUES (264,61,'Machineries','12180',5,'2002-06-06',1,'2002-05-26','15011','14852','1999','2003','2007','3','','58017','6208','8235','14443');
INSERT INTO TD VALUES (265,62,'Machineries','42113',2,'2002-08-02',2,'2003-02-15','76979','60702','1999','2005','2001','1','','32487','4912','5721','10633');
INSERT INTO TD VALUES (266,71,'Land','71317',4,'2002-07-03',5,'2003-02-26','86161','34765','1999','2000','2003','5','','36492','4628','7692','12320');
INSERT INTO TD VALUES (267,72,'Land','88224',2,'2002-10-13',4,'2002-12-24','76397','86456','1999','2007','2009','5','','24876','5138','9080','14218');
INSERT INTO TD VALUES (268,60,'PlantsTrees','20596',4,'2002-09-26',1,'2002-09-26','49526','57260','1999','2001','2004','4','','44113','2637','9841','12478');
INSERT INTO TD VALUES (269,61,'PlantsTrees','74767',3,'2003-01-28',3,'2003-05-04','65572','63928','1999','2003','2007','5','','68237','8652','5374','14026');
INSERT INTO TD VALUES (270,62,'PlantsTrees','32118',2,'2002-07-16',1,'2002-12-12','22657','93882','1999','2007','2001','1','','7300','3306','1202','4508');
INSERT INTO TD VALUES (271,75,'ImprovementsBuildings','02387',4,'2002-12-25',5,'2003-03-24','15685','30592','1999','2002','2002','2','','27948','3045','203','3248');
INSERT INTO TD VALUES (272,63,'Machineries','75582',2,'2002-07-05',2,'2003-02-02','12567','89718','1999','2004','2001','3','','28568','9863','1769','11632');
INSERT INTO TD VALUES (273,64,'Machineries','12498',3,'2003-05-04',4,'2002-09-21','29041','66637','1999','2008','2002','4','','48996','8949','4588','13537');
INSERT INTO TD VALUES (274,65,'Machineries','36747',2,'2002-07-30',4,'2003-02-20','58802','01792','1999','2007','2006','4','','37869','8636','3081','11717');
INSERT INTO TD VALUES (275,73,'Land','24071',1,'2003-03-13',1,'2003-05-03','47883','94316','1999','2000','2007','1','','94408','8895','1295','10190');
INSERT INTO TD VALUES (276,74,'Land','07238',1,'2002-10-30',1,'2002-10-28','21413','30730','1999','2003','2002','2','','13301','2269','2675','4944');
INSERT INTO TD VALUES (277,63,'PlantsTrees','54925',4,'2002-10-16',3,'2003-03-10','55933','38391','1999','2004','2006','5','','11722','5549','7673','13222');
INSERT INTO TD VALUES (278,76,'ImprovementsBuildings','52996',4,'2003-02-02',4,'2003-01-08','70991','16732','1999','2002','2000','3','','49874','8888','4521','13409');
INSERT INTO TD VALUES (279,66,'Machineries','69111',4,'2002-12-21',1,'2002-10-01','57547','81785','1999','2005','2007','4','','88818','6784','2953','9737');
INSERT INTO TD VALUES (280,67,'Machineries','24276',1,'2002-09-16',1,'2002-08-18','14206','03984','1999','2008','2003','3','','88988','6182','3325','9507');
INSERT INTO TD VALUES (281,68,'Machineries','60593',2,'2003-05-04',4,'2003-04-29','20253','09084','1999','2001','2004','5','','48070','6273','6404','12677');
INSERT INTO TD VALUES (282,75,'Land','31707',5,'2003-02-01',5,'2002-06-01','43667','76732','1999','2009','2006','3','','72420','3532','2916','6448');
INSERT INTO TD VALUES (283,76,'Land','53266',4,'2003-04-16',4,'2002-06-21','30271','69254','1999','2002','2008','5','','74260','8707','699','9406');
INSERT INTO TD VALUES (284,77,'Land','51263',2,'2002-10-30',5,'2003-02-10','96771','67839','1999','2003','2000','4','','13166','4916','550','5466');
INSERT INTO TD VALUES (285,64,'PlantsTrees','01989',1,'2003-01-06',1,'2002-05-16','48962','03685','1999','2009','2003','3','','83184','3705','4457','8162');
INSERT INTO TD VALUES (286,77,'ImprovementsBuildings','25012',3,'2002-10-10',2,'2002-05-24','81873','98885','1999','2006','2009','5','','52406','3228','5941','9169');
INSERT INTO TD VALUES (287,78,'ImprovementsBuildings','80296',4,'2002-12-21',2,'2003-02-27','64344','06026','1999','2000','2000','1','','68473','9108','8061','17169');
INSERT INTO TD VALUES (288,79,'ImprovementsBuildings','29031',3,'2002-08-26',5,'2002-09-28','86789','59201','1999','2000','2009','1','','92292','6745','8066','14811');
INSERT INTO TD VALUES (289,69,'Machineries','91834',5,'2002-06-05',4,'2002-12-19','49051','34941','1999','2009','2003','5','','5949','3328','4644','7972');
INSERT INTO TD VALUES (290,78,'Land','02914',3,'2003-02-09',1,'2003-02-06','17782','03463','1999','2008','2005','5','','78385','5632','5193','10825');
INSERT INTO TD VALUES (291,79,'Land','62077',1,'2003-01-07',5,'2002-10-16','47216','80957','1999','2002','2000','3','','59783','3586','2080','5666');
INSERT INTO TD VALUES (292,80,'Land','92779',4,'2003-01-06',5,'2003-05-08','84492','44823','1999','2008','2008','1','','60562','4577','6359','10936');
INSERT INTO TD VALUES (293,65,'PlantsTrees','52422',4,'2002-11-20',5,'2002-05-28','55140','62668','1999','2001','2003','1','','54892','5876','8603','14479');
INSERT INTO TD VALUES (294,66,'PlantsTrees','32948',2,'2002-09-23',2,'2002-07-13','91760','00713','1999','2007','2006','4','','36938','4077','6998','11075');
INSERT INTO TD VALUES (295,80,'ImprovementsBuildings','70987',3,'2003-02-13',1,'2003-01-24','51823','20437','1999','2006','2000','3','','66309','7929','5353','13282');
INSERT INTO TD VALUES (296,70,'Machineries','23477',3,'2002-12-31',3,'2002-06-20','79405','99407','1999','2000','2003','5','','63305','5356','926','6282');
INSERT INTO TD VALUES (297,71,'Machineries','93656',4,'2002-11-10',4,'2002-11-06','41060','23856','1999','2004','2009','1','','35656','6525','8902','15427');
INSERT INTO TD VALUES (298,81,'Land','32528',4,'2002-09-01',4,'2002-09-26','71434','15099','1999','2001','2003','2','','11634','3568','4697','8265');
INSERT INTO TD VALUES (299,82,'Land','85220',1,'2002-07-05',2,'2003-01-30','15799','74963','1999','2003','2007','3','','51798','1486','4537','6023');
INSERT INTO TD VALUES (300,83,'Land','71637',5,'2002-08-17',5,'2002-06-22','49808','69045','1999','2005','2000','3','','72972','5247','8524','13771');
INSERT INTO TD VALUES (301,67,'PlantsTrees','37073',3,'2002-05-21',3,'2002-07-28','30872','76384','1999','2004','2009','4','','80651','1614','995','2609');
INSERT INTO TD VALUES (302,68,'PlantsTrees','51070',4,'2003-01-26',5,'2002-06-17','26584','25226','1999','2003','2008','1','','4342','6808','9387','16195');
INSERT INTO TD VALUES (303,69,'PlantsTrees','52226',2,'2003-04-20',3,'2002-08-27','60331','91697','1999','2004','2002','4','','4955','4386','1265','5651');
INSERT INTO TD VALUES (304,81,'ImprovementsBuildings','48696',4,'2002-06-29',5,'2002-05-12','09536','70597','1999','2003','2007','1','','88549','8275','4452','12727');
INSERT INTO TD VALUES (305,82,'ImprovementsBuildings','19823',2,'2003-02-01',1,'2003-03-24','06478','99094','1999','2004','2009','4','','92545','3096','1596','4692');
INSERT INTO TD VALUES (306,83,'ImprovementsBuildings','25115',5,'2002-12-09',1,'2003-03-11','27517','77189','1999','2008','2001','2','','45656','1810','2744','4554');
INSERT INTO TD VALUES (307,72,'Machineries','43222',1,'2003-03-10',1,'2002-05-23','31811','54858','1999','2006','2000','4','','47174','3917','9160','13077');
INSERT INTO TD VALUES (308,73,'Machineries','53140',4,'2002-12-30',3,'2002-12-28','40575','57928','1999','2004','2000','2','','33159','9257','1253','10510');
INSERT INTO TD VALUES (309,74,'Machineries','76816',2,'2002-10-20',3,'2002-10-09','76278','37927','1999','2000','2006','3','','36960','7465','3463','10928');
INSERT INTO TD VALUES (310,84,'Land','41711',4,'2002-08-10',4,'2003-01-09','81170','67528','1999','2000','2006','3','','53388','5625','7454','13079');
INSERT INTO TD VALUES (311,85,'Land','43275',1,'2003-04-01',4,'2002-05-25','46495','49522','1999','2000','2004','4','','73816','9998','4156','14154');
INSERT INTO TD VALUES (312,86,'Land','37282',1,'2003-02-21',4,'2003-01-22','53490','82760','1999','2009','2005','4','','19047','9604','4768','14372');
INSERT INTO TD VALUES (313,70,'PlantsTrees','94799',1,'2002-11-24',2,'2003-01-28','86661','38402','1999','2005','2003','4','','12923','754','4759','5513');
INSERT INTO TD VALUES (314,84,'ImprovementsBuildings','05039',3,'2003-03-01',1,'2003-05-10','71083','57498','1999','2000','2002','2','','60318','8918','4538','13456');
INSERT INTO TD VALUES (315,85,'ImprovementsBuildings','82725',1,'2002-11-11',5,'2002-07-13','27726','48885','1999','2001','2006','3','','33147','6183','7758','13941');
INSERT INTO TD VALUES (316,75,'Machineries','66897',3,'2002-07-31',3,'2002-06-14','75629','17089','1999','2003','2007','1','','55368','5557','4719','10276');
INSERT INTO TD VALUES (317,76,'Machineries','20205',1,'2002-05-29',3,'2003-03-08','13854','79549','1999','2002','2002','4','','65414','6444','4467','10911');
INSERT INTO TD VALUES (318,77,'Machineries','80563',5,'2003-02-28',5,'2003-04-15','15156','08647','1999','2007','2000','4','','49238','9105','4763','13868');
INSERT INTO TD VALUES (319,87,'Land','80375',4,'2003-02-17',3,'2002-09-14','39266','14038','1999','2000','2005','2','','76688','1644','7954','9598');
INSERT INTO TD VALUES (320,88,'Land','74918',5,'2003-01-22',1,'2002-05-21','71135','58185','2003','2004','2003','1','','68699','1483','8513','9996');
INSERT INTO TD VALUES (321,71,'PlantsTrees','15923',5,'2002-08-18',4,'2003-04-24','37199','53598','1999','2009','2009','4','','65388','2089','9464','11553');
INSERT INTO TD VALUES (322,72,'PlantsTrees','22727',4,'2002-08-06',1,'2003-01-10','75525','95323','1999','2003','2004','2','','44013','1435','9354','10789');
INSERT INTO TD VALUES (323,86,'ImprovementsBuildings','06255',2,'2002-09-03',5,'2002-09-28','18740','05804','1999','2006','2001','2','','99714','5581','3654','9235');
INSERT INTO TD VALUES (324,78,'Machineries','45811',2,'2002-12-12',1,'2003-05-04','96233','27389','1999','2000','2003','2','','16045','1469','5454','6923');
INSERT INTO TD VALUES (325,79,'Machineries','03775',4,'2003-03-21',5,'2002-08-26','48754','48477','2001','2004','2006','3','','44616','957','5230','6187');
INSERT INTO TD VALUES (326,80,'Machineries','08526',4,'2002-11-01',1,'2002-08-23','58837','18477','2003','2007','2006','5','','93611','6569','7355','13924');
INSERT INTO TD VALUES (327,89,'Land','98018',2,'2002-06-03',1,'2003-03-08','44575','84535','1999','2007','2000','2','','31193','4776','5688','10464');
INSERT INTO TD VALUES (328,90,'Land','78241',5,'2002-10-02',3,'2002-06-16','35474','88666','1999','2004','2001','2','','43975','639','1358','1997');
INSERT INTO TD VALUES (329,91,'Land','19264',3,'2002-09-03',4,'2002-08-17','38012','79074','1999','2003','2005','5','','40872','9052','4925','13977');
INSERT INTO TD VALUES (330,73,'PlantsTrees','57074',5,'2003-02-10',2,'2002-12-08','15642','99758','1999','2000','2007','3','','17797','1556','8322','9878');
INSERT INTO TD VALUES (331,74,'PlantsTrees','84289',1,'2003-02-26',1,'2003-04-07','48527','31512','1999','2004','2004','3','','94702','2988','6041','9029');
INSERT INTO TD VALUES (332,87,'ImprovementsBuildings','53796',4,'2002-09-22',3,'2003-05-10','71884','90535','1999','2006','2003','5','','88516','4072','6708','10780');
INSERT INTO TD VALUES (333,81,'Machineries','99605',2,'2002-10-14',4,'2002-10-14','85043','84801','1999','2002','2009','1','','59069','8344','3253','11597');
INSERT INTO TD VALUES (334,82,'Machineries','38116',1,'2002-09-21',3,'2002-08-07','67535','66586','1999','2008','2003','4','','88965','7113','927','8040');
INSERT INTO TD VALUES (335,92,'Land','66702',1,'2003-03-26',2,'2002-11-17','66775','42950','1999','2008','2005','5','','83821','3137','313','3450');
INSERT INTO TD VALUES (336,93,'Land','88585',4,'2002-11-06',5,'2002-11-06','66795','48263','1999','2000','2003','1','','19107','9498','8632','18130');
INSERT INTO TD VALUES (337,75,'PlantsTrees','26490',3,'2002-06-15',2,'2002-08-29','51568','96796','1999','2006','2003','5','','23021','6633','4841','11474');
INSERT INTO TD VALUES (338,76,'PlantsTrees','62913',5,'2002-08-09',4,'2003-02-03','61790','88832','1999','2005','2000','1','','17765','9535','8872','18407');
INSERT INTO TD VALUES (339,88,'ImprovementsBuildings','98114',4,'2002-06-06',5,'2002-06-26','85350','56811','1999','2001','2009','5','','40926','5675','6974','12649');
INSERT INTO TD VALUES (340,89,'ImprovementsBuildings','93571',2,'2002-07-29',3,'2003-01-15','28897','48822','1999','2007','2004','5','','47577','9073','7656','16729');
INSERT INTO TD VALUES (341,90,'ImprovementsBuildings','64600',5,'2003-05-06',5,'2002-06-17','94251','45676','1999','2006','2009','5','','55532','5260','781','6041');
INSERT INTO TD VALUES (342,83,'Machineries','19868',2,'2002-07-01',3,'2002-11-09','39955','23109','1999','2001','2008','2','','65348','250','3045','3295');
INSERT INTO TD VALUES (343,84,'Machineries','86411',1,'2002-11-21',5,'2003-04-17','39899','42181','1999','2006','2007','5','','93412','9678','5940','15618');
INSERT INTO TD VALUES (344,85,'Machineries','17681',1,'2003-01-10',1,'2002-08-18','26873','23334','1999','2006','2008','3','','85138','3634','6236','9870');
INSERT INTO TD VALUES (345,94,'Land','50085',4,'2002-08-04',3,'2003-03-15','71719','69268','1999','2005','2009','1','1','52994','1023','3395','4418');
INSERT INTO TD VALUES (346,95,'Land','71086',2,'2002-10-16',3,'2003-02-25','88103','03985','1999','2005','2000','4','1','72319','5135','7997','13132');
INSERT INTO TD VALUES (347,77,'PlantsTrees','86944',1,'2003-04-07',4,'2003-05-06','58518','12930','1999','2000','2002','4','1','18936','5889','3426','9315');
INSERT INTO TD VALUES (348,91,'ImprovementsBuildings','94254',2,'2002-08-01',4,'2002-06-07','80138','50508','1999','2001','2000','2','1','22908','1216','1197','2413');
INSERT INTO TD VALUES (349,86,'Machineries','95773',3,'2002-09-23',4,'2003-04-07','39408','03880','1999','2008','2005','2','1','13947','2215','814','3029');
INSERT INTO TD VALUES (350,87,'Machineries','68119',5,'2002-12-21',3,'2002-11-07','94472','51820','1999','2004','2004','5','1','86000','8185','5279','13464');
INSERT INTO TD VALUES (351,96,'Land','38601',1,'2002-09-29',1,'2002-08-17','07534','52395','1999','2001','2006','3','1','67669','5363','2260','7623');
INSERT INTO TD VALUES (352,97,'Land','14823',3,'2002-09-10',1,'2003-01-12','78636','29570','1999','2009','2005','1','1','46755','3737','8751','12488');
INSERT INTO TD VALUES (353,98,'Land','81767',4,'2002-08-09',3,'2002-12-22','56347','28034','1999','2008','2002','1','1','55526','5073','7125','12198');
INSERT INTO TD VALUES (354,78,'PlantsTrees','33210',2,'2003-02-16',2,'2003-02-23','76319','17067','1999','2009','2008','4','2','43957','5684','5147','10831');
INSERT INTO TD VALUES (355,79,'PlantsTrees','63192',3,'2002-12-14',1,'2002-06-20','79971','96095','1999','2004','2007','4','1','88438','7598','2004','9602');
INSERT INTO TD VALUES (356,80,'PlantsTrees','47904',4,'2003-02-02',3,'2003-04-28','61116','61501','1999','2007','2008','1','1','95207','936','6881','7817');
INSERT INTO TD VALUES (357,92,'ImprovementsBuildings','14781',3,'2002-09-11',3,'2002-05-30','71122','04069','1999','2000','2003','3','2','26132','6090','7666','13756');
INSERT INTO TD VALUES (358,88,'Machineries','10847',4,'2003-02-22',5,'2002-11-18','92755','98522','1999','2002','2004','3','1','40672','5907','3000','8907');
INSERT INTO TD VALUES (359,99,'Land','09800',3,'2003-02-15',2,'2003-05-05','19919','09851','1999','2005','2005','1','1','74354','4848','1301','6149');
INSERT INTO TD VALUES (360,100,'Land','77184',1,'2003-01-18',2,'2002-10-03','99670','37588','1999','2004','2002','4','2','25670','7011','871','7882');
INSERT INTO TD VALUES (361,101,'Land','28331',2,'2002-10-25',2,'2002-08-14','45078','22707','1999','2009','2000','3','1','44105','2317','8396','10713');
INSERT INTO TD VALUES (362,81,'PlantsTrees','50669',2,'2002-08-15',2,'2002-10-29','37789','88921','1999','2008','2002','5','1','10995','8757','3526','12283');
INSERT INTO TD VALUES (363,93,'ImprovementsBuildings','72225',3,'2003-04-26',5,'2002-12-18','18308','72860','1999','2006','2001','2','1','32416','7441','6510','13951');
INSERT INTO TD VALUES (364,94,'ImprovementsBuildings','13124',3,'2002-07-17',5,'2002-11-12','21982','53638','1999','2008','2004','4','2','98988','3055','9645','12700');
INSERT INTO TD VALUES (365,95,'ImprovementsBuildings','03929',5,'2002-12-08',2,'2002-09-12','32493','86930','1999','2002','2006','1','2','65570','9904','6981','16885');
INSERT INTO TD VALUES (366,89,'Machineries','86849',4,'2002-11-09',4,'2002-05-23','70254','32425','1999','2003','2001','4','2','56444','2914','3426','6340');
INSERT INTO TD VALUES (367,90,'Machineries','02945',5,'2003-04-24',5,'2002-05-21','14553','87090','1999','2002','2009','4','2','27366','9874','9143','19017');
INSERT INTO TD VALUES (368,91,'Machineries','78307',3,'2002-12-23',5,'2003-02-01','82203','28494','1999','2005','2009','3','2','87033','6834','4384','11218');
INSERT INTO TD VALUES (369,102,'Land','34965',2,'2002-08-18',5,'2002-10-30','69775','39106','1999','2009','2008','4','2','50561','8419','9722','18141');
INSERT INTO TD VALUES (370,82,'PlantsTrees','12829',1,'2002-07-08',5,'2003-04-26','37951','17553','1999','2006','2003','2','1','40029','508','7303','7811');
INSERT INTO TD VALUES (371,83,'PlantsTrees','88470',2,'2002-06-26',2,'2002-12-19','16343','27275','1999','2001','2000','5','1','61703','4534','6006','10540');
INSERT INTO TD VALUES (372,84,'PlantsTrees','82819',5,'2002-10-05',2,'2002-06-04','61525','72585','1999','2005','2007','1','2','85720','6550','1997','8547');
INSERT INTO TD VALUES (373,85,'PlantsTrees','75755',5,'2002-12-18',2,'2002-05-23','81740','90139','1999','2002','2007','5','1','57802','879','3511','4390');
INSERT INTO TD VALUES (374,96,'ImprovementsBuildings','22181',4,'2002-07-02',5,'2002-05-13','10049','28195','1999','2008','2001','1','3','82282','8993','3656','12649');
INSERT INTO TD VALUES (375,97,'ImprovementsBuildings','56037',2,'2003-01-17',4,'2002-05-31','87274','26523','1999','2002','2007','2','3','72077','6050','5890','11940');
INSERT INTO TD VALUES (376,92,'Machineries','63861',3,'2002-09-19',3,'2002-05-12','50568','71248','1999','2001','2003','1','3','28185','1051','5838','6889');
INSERT INTO TD VALUES (377,93,'Machineries','02537',3,'2002-12-22',1,'2003-02-28','40872','06737','1999','2002','2005','1','3','10528','8131','3720','11851');
INSERT INTO TD VALUES (378,103,'Land','29445',5,'2002-08-01',3,'2002-12-20','47744','72677','1999','2001','2009','4','3','5639','7055','856','7911');
INSERT INTO TD VALUES (379,86,'PlantsTrees','50733',5,'2002-06-15',2,'2002-12-19','06206','86761','1999','2000','2004','1','3','39039','2952','1614','4566');
INSERT INTO TD VALUES (380,87,'PlantsTrees','45753',5,'2002-10-21',5,'2002-09-23','29357','44991','1999','2004','2009','1','4','85220','2269','2338','4607');
INSERT INTO TD VALUES (381,98,'ImprovementsBuildings','51076',4,'2002-11-20',1,'2002-10-31','90699','55833','1999','2007','2001','4','1','32013','3683','6940','10623');
INSERT INTO TD VALUES (382,94,'Machineries','26053',3,'2002-06-11',5,'2002-07-07','47948','97672','1999','2007','2006','4','2','49717','8227','483','8710');
INSERT INTO TD VALUES (383,95,'Machineries','52781',2,'2003-01-29',3,'2003-04-10','45083','12697','1999','2004','2003','3','1','65071','3907','2270','6177');
INSERT INTO TD VALUES (384,104,'Land','10129',4,'2002-09-09',4,'2002-11-02','07323','93992','1999','2004','2009','2','3','81412','3031','6072','9103');
INSERT INTO TD VALUES (385,88,'PlantsTrees','67295',2,'2002-11-21',3,'2002-05-12','63205','57549','1999','2006','2001','2','5','58061','9530','4048','13578');
INSERT INTO TD VALUES (386,89,'PlantsTrees','58896',5,'2003-03-21',3,'2003-02-17','07150','46442','1999','2005','2005','5','3','39879','7842','5044','12886');
INSERT INTO TD VALUES (387,90,'PlantsTrees','56476',3,'2003-02-03',2,'2002-11-23','67628','13785','1999','2007','2004','1','3','47805','3710','3384','7094');
INSERT INTO TD VALUES (388,91,'PlantsTrees','87188',5,'2002-12-03',5,'2002-09-28','68281','55496','1999','2000','2000','1','4','76565','5712','2755','8467');
INSERT INTO TD VALUES (389,92,'PlantsTrees','72264',1,'2003-02-28',1,'2002-07-15','71395','73976','1999','2002','2004','2','4','43621','8510','1585','10095');
INSERT INTO TD VALUES (390,99,'ImprovementsBuildings','28809',2,'2003-05-09',4,'2003-03-14','86165','44127','1999','2006','2001','4','5','15251','5057','6547','11604');
INSERT INTO TD VALUES (391,100,'ImprovementsBuildings','53960',5,'2002-10-07',1,'2003-01-04','79266','89236','1999','2002','2002','3','1','44778','6582','9987','16569');
INSERT INTO TD VALUES (392,96,'Machineries','63537',1,'2002-07-14',1,'2002-10-12','27172','33444','1999','2006','2004','4','4','99881','7598','1083','8681');
INSERT INTO TD VALUES (393,97,'Machineries','70231',3,'2002-10-14',2,'2003-01-14','86728','79576','1999','2000','2001','4','5','4673','631','6743','7374');
INSERT INTO TD VALUES (394,98,'Machineries','36522',2,'2002-09-20',4,'2002-06-30','40867','21627','1999','2009','2001','5','3','35557','9038','4951','13989');
INSERT INTO TD VALUES (395,99,'Machineries','44962',2,'2002-08-21',3,'2003-01-29','32645','02330','1999','2007','2006','4','1','68923','3845','1715','5560');
INSERT INTO TD VALUES (396,105,'Land','61470',2,'2002-06-28',2,'2002-05-22','56016','80373','1999','2003','2003','3','2','14199','9484','8879','18363');
INSERT INTO TD VALUES (397,106,'Land','43692',1,'2002-08-16',4,'2002-10-07','06062','70862','1999','2009','2003','4','1','54586','1462','1685','3147');
INSERT INTO TD VALUES (398,107,'Land','34256',4,'2002-09-30',5,'2003-05-03','62734','84807','1999','2004','2004','4','3','42356','7321','8476','15797');
INSERT INTO TD VALUES (399,93,'PlantsTrees','62931',1,'2003-04-30',4,'2002-11-13','53921','49815','1999','2003','2007','5','4','99667','9193','8785','17978');
INSERT INTO TD VALUES (400,94,'PlantsTrees','47771',1,'2002-10-28',3,'2003-04-17','30731','77931','1999','2002','2005','4','6','87623','9572','6011','15583');
INSERT INTO TD VALUES (401,101,'ImprovementsBuildings','56804',2,'2002-07-01',1,'2002-06-06','83005','85608','1999','2006','2004','1','6','34673','4836','3141','7977');
INSERT INTO TD VALUES (402,102,'ImprovementsBuildings','50158',4,'2002-11-13',5,'2003-04-20','13776','35212','1999','2001','2005','4','5','10932','7174','2930','10104');
INSERT INTO TD VALUES (403,100,'Machineries','14393',1,'2003-03-24',4,'2002-11-02','82692','03858','1999','2003','2003','5','4','6891','6031','4517','10548');
INSERT INTO TD VALUES (404,108,'Land','45427',2,'2003-01-19',2,'2002-12-28','59565','46778','1999','2003','2001','3','5','19916','9370','6373','15743');
INSERT INTO TD VALUES (405,109,'Land','26790',3,'2002-08-16',2,'2002-11-29','55093','28583','1999','2001','2007','2','3','29594','137','2040','2177');
INSERT INTO TD VALUES (406,110,'Land','39649',5,'2003-02-11',5,'2003-04-04','77385','43670','1999','2007','2006','2','7','70416','9169','6536','15705');
INSERT INTO TD VALUES (407,111,'Land','55622',2,'2002-06-22',5,'2002-11-19','28071','93108','1999','2006','2003','5','3','94732','5565','4473','10038');
INSERT INTO TD VALUES (408,112,'Land','50302',1,'2002-05-31',2,'2002-10-22','55443','67547','1999','2009','2001','4','1','21572','7890','2349','10239');
INSERT INTO TD VALUES (409,95,'PlantsTrees','06043',3,'2003-02-24',3,'2002-10-06','00760','55324','1999','2007','2003','1','3','45433','3499','9704','13203');
INSERT INTO TD VALUES (410,96,'PlantsTrees','03797',2,'2002-08-25',4,'2002-06-03','02156','15287','1999','2002','2008','5','4','48623','6776','2132','8908');
INSERT INTO TD VALUES (411,103,'ImprovementsBuildings','34980',1,'2002-09-13',4,'2002-11-08','93133','24934','1999','2001','2002','5','3','85516','8596','2523','11119');
INSERT INTO TD VALUES (412,101,'Machineries','44421',4,'2002-11-08',4,'2003-02-09','74138','16804','1999','2005','2000','2','2','19650','5412','1352','6764');
INSERT INTO TD VALUES (413,102,'Machineries','77666',1,'2003-04-22',4,'2003-01-03','53362','62595','1999','2003','2005','5','2','54071','6523','854','7377');
INSERT INTO TD VALUES (414,103,'Machineries','01597',3,'2002-08-06',2,'2002-11-04','56936','17139','1999','2008','2004','3','2','98054','3160','6635','9795');
INSERT INTO TD VALUES (415,104,'Machineries','63053',5,'2002-11-18',3,'2002-08-19','90151','62437','1999','2007','2002','5','2','25764','8726','646','9372');
INSERT INTO TD VALUES (416,113,'Land','99619',4,'2003-02-18',5,'2002-06-30','25536','71242','1999','2003','2001','4','7','12476','9431','6079','15510');
INSERT INTO TD VALUES (417,114,'Land','27849',5,'2002-08-05',2,'2002-07-21','87747','03956','1999','2009','2001','4','2','96273','8934','4407','13341');
INSERT INTO TD VALUES (418,115,'Land','31541',1,'2003-03-07',4,'2002-09-03','24351','58266','1999','2003','2009','5','7','77106','9632','2247','11879');
INSERT INTO TD VALUES (419,97,'PlantsTrees','71519',4,'2002-06-15',3,'2002-05-26','24805','58346','1999','2009','2009','1','1','69886','9479','2716','12195');
INSERT INTO TD VALUES (420,98,'PlantsTrees','47076',1,'2002-10-03',5,'2003-03-15','00221','12838','1999','2003','2003','5','7','68280','3746','1123','4869');
INSERT INTO TD VALUES (421,99,'PlantsTrees','02088',2,'2002-08-12',5,'2002-11-30','15691','02064','1999','2000','2009','3','8','58218','4452','1234','5686');
INSERT INTO TD VALUES (422,104,'ImprovementsBuildings','17841',2,'2003-04-27',5,'2003-01-27','51116','66303','1999','2003','2000','2','4','15154','4919','3178','8097');
INSERT INTO TD VALUES (423,105,'Machineries','68830',1,'2003-05-08',2,'2002-08-18','91310','22986','1999','2004','2005','2','8','40527','8674','357','9031');
INSERT INTO TD VALUES (424,106,'Machineries','92295',3,'2003-03-21',1,'2003-02-05','07650','62707','1999','2009','2005','2','7','11819','9962','9534','19496');
INSERT INTO TD VALUES (425,116,'Land','52166',4,'2003-02-25',3,'2002-07-09','40675','87753','1999','2001','2004','1','2','66272','6853','3242','10095');
INSERT INTO TD VALUES (426,117,'Land','89677',4,'2003-02-28',1,'2002-08-27','79853','35826','1999','2008','2002','5','8','89170','3929','5255','9184');
INSERT INTO TD VALUES (427,118,'Land','32899',1,'2002-10-29',4,'2003-03-11','24283','83533','1999','2009','2004','4','2','5694','8393','3511','11904');
INSERT INTO TD VALUES (428,119,'Land','62657',2,'2002-10-01',5,'2003-01-18','04171','91548','1999','2000','2001','3','8','7137','4066','744','4810');
INSERT INTO TD VALUES (429,100,'PlantsTrees','76602',4,'2002-07-29',2,'2003-02-09','27936','86938','1999','2006','2007','3','8','93858','4415','882','5297');
INSERT INTO TD VALUES (430,101,'PlantsTrees','15422',5,'2003-03-03',3,'2002-10-27','13811','59231','1999','2000','2007','2','2','40424','1597','9707','11304');
INSERT INTO TD VALUES (431,102,'PlantsTrees','42626',4,'2002-09-28',1,'2003-03-20','04568','56997','1999','2009','2001','2','3','50779','794','1894','2688');
INSERT INTO TD VALUES (432,105,'ImprovementsBuildings','64423',3,'2002-05-24',5,'2003-04-15','42695','10058','1999','2002','2005','1','1','16624','3814','259','4073');
INSERT INTO TD VALUES (433,106,'ImprovementsBuildings','51354',5,'2003-01-07',2,'2003-03-08','27319','41776','1999','2002','2005','4','6','63402','8590','8335','16925');
INSERT INTO TD VALUES (434,107,'Machineries','29688',1,'2002-06-19',1,'2002-10-01','09560','46511','1999','2008','2000','4','8','47827','7983','8537','16520');
INSERT INTO TD VALUES (435,120,'Land','86342',2,'2003-01-11',5,'2002-09-04','32147','46908','1999','2001','2004','4','3','88783','7243','9040','16283');
INSERT INTO TD VALUES (436,121,'Land','22996',2,'2002-06-19',4,'2003-01-02','96621','50275','1999','2005','2003','4','2','74918','1329','6312','7641');
INSERT INTO TD VALUES (437,122,'Land','12253',3,'2003-02-07',5,'2002-09-17','53671','57325','1999','2006','2000','5','1','31885','6605','3264','9869');
INSERT INTO TD VALUES (438,103,'PlantsTrees','55380',3,'2003-04-15',1,'2002-05-29','84012','91709','1999','2000','2007','3','7','40972','9871','2820','12691');
INSERT INTO TD VALUES (439,104,'PlantsTrees','80794',4,'2002-05-28',1,'2003-01-02','80029','12920','1999','2003','2009','4','6','85527','2755','9712','12467');
INSERT INTO TD VALUES (440,107,'ImprovementsBuildings','73754',5,'2002-11-12',4,'2003-02-11','71336','18926','1999','2003','2006','1','4','26649','8478','2484','10962');
INSERT INTO TD VALUES (441,108,'ImprovementsBuildings','18982',5,'2002-09-01',4,'2002-06-01','39154','46346','1999','2003','2004','3','7','50306','6583','1418','8001');
INSERT INTO TD VALUES (442,109,'ImprovementsBuildings','18904',1,'2002-09-19',5,'2003-05-11','01336','18059','1999','2000','2008','2','8','96607','9494','5864','15358');
INSERT INTO TD VALUES (443,110,'ImprovementsBuildings','91120',1,'2002-12-16',1,'2002-08-11','20071','92491','1999','2002','2003','1','4','45045','8531','4970','13501');
INSERT INTO TD VALUES (444,108,'Machineries','37014',4,'2003-03-07',3,'2002-09-12','77126','49682','1999','2004','2005','5','8','22235','6453','9111','15564');
INSERT INTO TD VALUES (445,109,'Machineries','52736',1,'2002-10-30',2,'2003-01-28','83053','10206','1999','2009','2007','3','6','58159','397','4227','4624');
INSERT INTO TD VALUES (446,123,'Land','32233',3,'2002-08-07',3,'2002-09-13','72513','78091','1999','2005','2000','3','8','14863','6461','3827','10288');
INSERT INTO TD VALUES (447,105,'PlantsTrees','87547',4,'2003-03-06',3,'2002-08-28','73119','02788','1999','2007','2005','4','6','82292','3314','2470','5784');
INSERT INTO TD VALUES (448,106,'PlantsTrees','78687',2,'2003-01-08',2,'2002-06-10','70735','21328','1999','2002','2003','5','3','28909','9118','2798','11916');
INSERT INTO TD VALUES (449,107,'PlantsTrees','83287',1,'2003-04-09',4,'2003-05-09','06972','46649','1999','2006','2006','4','4','79274','1327','8661','9988');
INSERT INTO TD VALUES (450,111,'ImprovementsBuildings','01725',5,'2002-11-04',2,'2003-01-21','45224','26371','1999','2005','2005','5','5','97382','722','608','1330');
INSERT INTO TD VALUES (451,112,'ImprovementsBuildings','59329',4,'2002-09-10',4,'2003-04-09','53627','92579','1999','2008','2009','3','7','8766','5748','3277','9025');
INSERT INTO TD VALUES (452,113,'ImprovementsBuildings','95767',3,'2002-08-22',1,'2002-12-15','80265','86226','1999','2005','2006','4','8','98050','1604','639','2243');
INSERT INTO TD VALUES (453,110,'Machineries','58161',2,'2002-11-17',5,'2002-05-18','84710','02161','1999','2007','2002','2','2','19673','6329','9779','16108');
INSERT INTO TD VALUES (454,111,'Machineries','97928',3,'2003-03-09',1,'2002-08-21','08729','26940','1999','2002','2006','1','4','40247','3933','2319','6252');
INSERT INTO TD VALUES (455,124,'Land','76387',1,'2002-05-27',5,'2002-08-14','29606','00797','1999','2007','2001','5','6','68713','1740','778','2518');
INSERT INTO TD VALUES (456,125,'Land','99987',2,'2003-01-30',1,'2003-02-20','31065','72940','1999','2000','2007','3','8','6778','1582','689','2271');
INSERT INTO TD VALUES (457,126,'Land','25226',3,'2002-07-05',3,'2002-12-07','63402','01556','1999','2006','2004','5','3','50388','5053','8698','13751');
INSERT INTO TD VALUES (458,108,'PlantsTrees','49341',1,'2003-05-11',3,'2002-09-30','90115','05384','1999','2004','2000','4','7','98068','6748','4890','11638');
INSERT INTO TD VALUES (459,114,'ImprovementsBuildings','99027',2,'2002-07-18',3,'2003-05-04','36373','16548','1999','2002','2006','5','1','49812','314','5266','5580');
INSERT INTO TD VALUES (460,112,'Machineries','10295',5,'2002-07-30',3,'2002-11-06','57479','16032','1999','2004','2003','5','4','79140','9645','7631','17276');
INSERT INTO TD VALUES (461,113,'Machineries','19516',3,'2003-02-21',3,'2003-03-10','67304','35742','1999','2003','2007','4','7','66563','2948','3516','6464');
INSERT INTO TD VALUES (462,114,'Machineries','81279',2,'2002-05-26',3,'2002-11-02','61574','92113','1999','2007','2003','3','6','83634','6221','5346','11567');
INSERT INTO TD VALUES (463,127,'Land','49858',5,'2002-08-22',5,'2002-10-12','09728','18225','1999','2002','2005','5','9','22619','8820','7704','16524');
INSERT INTO TD VALUES (464,128,'Land','11377',3,'2002-08-19',4,'2002-10-31','89813','08468','1999','2000','2003','5','1','60624','770','3724','4494');
INSERT INTO TD VALUES (465,109,'PlantsTrees','86513',2,'2002-12-10',2,'2002-11-10','05377','84033','1999','2007','2009','1','9','94180','4166','9683','13849');
INSERT INTO TD VALUES (466,110,'PlantsTrees','24637',5,'2002-05-27',3,'2002-12-24','53389','02826','1999','2005','2007','3','7','9730','1502','2696','4198');
INSERT INTO TD VALUES (467,115,'ImprovementsBuildings','31523',3,'2002-10-19',3,'2003-01-28','26740','78676','1999','2000','2005','5','7','85664','5625','2769','8394');
INSERT INTO TD VALUES (468,116,'ImprovementsBuildings','36859',4,'2002-11-05',5,'2002-09-23','99992','22210','1999','2007','2003','2','4','2283','8320','1923','10243');
INSERT INTO TD VALUES (469,115,'Machineries','31453',1,'2003-01-30',5,'2002-08-17','38817','82542','1999','2000','2003','3','1','44839','3893','5280','9173');
INSERT INTO TD VALUES (470,116,'Machineries','77114',2,'2002-10-02',5,'2002-05-18','81880','72163','1999','2004','2004','4','11','65410','5771','3740','9511');
INSERT INTO TD VALUES (471,117,'Machineries','25330',1,'2002-11-08',3,'2002-10-25','52914','44071','1999','2004','2005','4','10','22516','5699','2241','7940');
INSERT INTO TD VALUES (472,129,'Land','31598',4,'2002-05-24',2,'2002-10-19','28598','65351','2003','2007','2003','5','5','68963','9601','1452','11053');
INSERT INTO TD VALUES (473,130,'Land','90357',2,'2002-11-09',4,'2002-07-02','57421','90844','1999','2002','2006','4','1','18143','4652','8109','12761');
INSERT INTO TD VALUES (474,131,'Land','84754',3,'2003-04-03',1,'2002-06-02','18407','02550','1999','2009','2007','1','3','97581','7596','9284','16880');
INSERT INTO TD VALUES (475,132,'Land','08721',4,'2003-04-01',2,'2003-01-17','21768','48104','1999','2001','2001','4','6','83642','3314','5531','8845');
INSERT INTO TD VALUES (476,111,'PlantsTrees','85915',3,'2002-07-04',4,'2002-06-12','83757','51068','1999','2008','2004','3','3','50710','2693','7688','10381');
INSERT INTO TD VALUES (477,112,'PlantsTrees','98111',5,'2002-11-05',2,'2002-05-24','57108','40085','1999','2003','2006','4','3','45844','9852','2257','12109');
INSERT INTO TD VALUES (478,113,'PlantsTrees','37368',1,'2002-07-24',5,'2003-01-19','26968','05675','1999','2000','2000','3','3','48983','9846','6221','16067');
INSERT INTO TD VALUES (479,117,'ImprovementsBuildings','98946',3,'2002-12-30',3,'2002-12-23','74688','23021','1999','2009','2005','1','6','66242','5796','3502','9298');
INSERT INTO TD VALUES (480,118,'ImprovementsBuildings','13075',3,'2002-07-05',1,'2003-04-16','68703','37593','1999','2003','2000','4','1','58466','8777','4705','13482');
INSERT INTO TD VALUES (481,119,'ImprovementsBuildings','98180',1,'2002-12-06',2,'2002-05-12','58007','61617','1999','2004','2007','1','4','41809','5035','6533','11568');
INSERT INTO TD VALUES (482,118,'Machineries','02707',1,'2003-04-23',1,'2003-03-04','21011','44021','1999','2005','2008','1','8','67593','8538','3899','12437');
INSERT INTO TD VALUES (483,119,'Machineries','63201',4,'2002-12-12',5,'2002-07-31','44893','83193','1999','2009','2000','5','8','86827','4229','9393','13622');
INSERT INTO TD VALUES (484,133,'Land','14246',5,'2002-08-28',5,'2003-05-07','25468','63313','1999','2001','2003','3','20','75220','2808','5442','8250');
INSERT INTO TD VALUES (485,114,'PlantsTrees','25002',3,'2003-01-17',4,'2003-02-06','45438','68074','1999','2001','2000','1','4','9226','5644','4025','9669');
INSERT INTO TD VALUES (486,115,'PlantsTrees','18232',1,'2003-04-04',4,'2003-02-15','86711','46561','1999','2006','2006','2','17','76467','6292','5932','12224');
INSERT INTO TD VALUES (487,116,'PlantsTrees','06533',2,'2002-09-16',3,'2002-06-10','17916','92475','1999','2009','2007','2','22','21049','3572','3561','7133');
INSERT INTO TD VALUES (488,120,'ImprovementsBuildings','71864',3,'2002-11-28',5,'2002-09-13','73823','41321','1999','2002','2009','4','12','77148','4408','832','5240');
INSERT INTO TD VALUES (489,121,'ImprovementsBuildings','97422',1,'2002-11-14',4,'2002-10-21','00031','97454','1999','2006','2009','5','2','8748','9743','8955','18698');
INSERT INTO TD VALUES (490,122,'ImprovementsBuildings','62454',4,'2002-11-16',3,'2002-10-10','35705','85055','1999','2000','2005','2','8','64992','6424','641','7065');
INSERT INTO TD VALUES (491,123,'ImprovementsBuildings','20595',1,'2002-07-01',2,'2002-06-15','49388','45018','1999','2004','2002','3','19','57204','7526','3359','10885');
INSERT INTO TD VALUES (492,120,'Machineries','19353',5,'2003-01-06',2,'2003-01-26','66164','02123','1999','2005','2008','1','11','50279','3900','8747','12647');
INSERT INTO TD VALUES (493,121,'Machineries','82823',4,'2003-01-30',2,'2002-08-09','08262','87656','1999','2008','2001','2','22','17480','8254','7018','15272');
INSERT INTO TD VALUES (494,134,'Land','62357',4,'2003-01-12',3,'2003-03-05','51425','00146','1999','2001','2000','4','17','56103','8189','4337','12526');
INSERT INTO TD VALUES (495,135,'Land','28120',4,'2002-11-29',2,'2002-08-18','81010','22897','1999','2008','2000','5','18','99612','4326','5780','10106');
INSERT INTO TD VALUES (496,117,'PlantsTrees','42757',2,'2002-07-21',3,'2002-08-26','70849','60121','1999','2008','2005','5','10','71511','3718','780','4498');
INSERT INTO TD VALUES (497,118,'PlantsTrees','69252',1,'2002-11-21',5,'2002-08-23','60790','14678','1999','2007','2009','2','4','21559','6266','3031','9297');
INSERT INTO TD VALUES (498,124,'ImprovementsBuildings','59340',5,'2002-07-30',4,'2003-04-13','88496','99583','1999','2006','2002','1','19','29847','8470','6357','14827');
INSERT INTO TD VALUES (499,125,'ImprovementsBuildings','73891',2,'2003-05-11',5,'2002-11-19','61322','70281','1999','2008','2001','2','5','48723','6343','1404','7747');
INSERT INTO TD VALUES (500,122,'Machineries','97562',2,'2003-02-12',1,'2003-04-03','54586','43814','1999','2000','2004','3','23','29406','3947','6803','10750');
INSERT INTO TD VALUES (501,136,'Land','83001',1,'2002-07-29',4,'2002-08-27','07135','64267','1999','2003','2006','1','5','86512','1851','5732','7583');
INSERT INTO TD VALUES (502,137,'Land','31867',1,'2002-08-23',3,'2002-07-05','45998','09814','1999','2000','2005','4','17','50545','4084','1897','5981');
INSERT INTO TD VALUES (503,138,'Land','48233',5,'2003-03-11',4,'2003-05-05','14430','23464','1999','2002','2003','2','23','31488','1068','8314','9382');
INSERT INTO TD VALUES (504,119,'PlantsTrees','97961',5,'2003-01-17',1,'2002-08-24','98790','98672','1999','2002','2005','4','18','45102','9750','7285','17035');
INSERT INTO TD VALUES (505,126,'ImprovementsBuildings','53076',1,'2002-09-29',2,'2002-11-04','29230','99365','1999','2003','2008','1','10','22083','8395','2686','11081');
INSERT INTO TD VALUES (506,127,'ImprovementsBuildings','13595',5,'2002-09-01',3,'2002-05-22','61387','88351','1999','2001','2007','3','20','91273','9486','3182','12668');
INSERT INTO TD VALUES (507,123,'Machineries','46454',2,'2002-09-11',5,'2003-02-24','82160','93212','1999','2007','2002','1','7','88980','7426','2953','10379');
INSERT INTO TD VALUES (508,124,'Machineries','36675',5,'2003-02-08',1,'2003-01-05','07500','32474','1999','2007','2003','5','6','97461','672','6658','7330');
INSERT INTO TD VALUES (509,125,'Machineries','61635',1,'2002-08-07',5,'2002-09-05','82152','32654','1999','2003','2001','2','9','29561','7882','9878','17760');
INSERT INTO TD VALUES (510,126,'Machineries','71033',5,'2002-10-31',3,'2002-05-29','13240','70652','1999','2000','2006','3','3','8271','2690','9695','12385');
INSERT INTO TD VALUES (511,139,'Land','28483',3,'2003-01-27',3,'2002-12-12','54105','16882','1999','2003','2000','3','6','51531','1270','2791','4061');
INSERT INTO TD VALUES (512,140,'Land','21490',4,'2002-11-10',1,'2003-03-27','24567','78506','1999','2009','2005','1','23','97030','5401','358','5759');
INSERT INTO TD VALUES (513,141,'Land','95564',4,'2003-05-01',1,'2003-01-19','44293','20753','1999','2001','2008','3','4','63990','3526','6510','10036');
INSERT INTO TD VALUES (514,120,'PlantsTrees','37779',5,'2002-10-10',3,'2002-11-18','11466','26106','1999','2001','2005','2','8','13838','9182','1197','10379');
INSERT INTO TD VALUES (515,121,'PlantsTrees','02438',4,'2003-01-08',3,'2002-07-14','98701','34191','1999','2005','2009','3','22','38027','9947','4814','14761');
INSERT INTO TD VALUES (516,122,'PlantsTrees','23966',4,'2002-12-12',1,'2002-05-21','87207','42533','1999','2007','2008','2','9','72062','2511','401','2912');
INSERT INTO TD VALUES (517,128,'ImprovementsBuildings','66067',1,'2003-01-29',3,'2002-08-31','90063','55283','1999','2008','2008','4','7','54821','4144','5561','9705');
INSERT INTO TD VALUES (518,129,'ImprovementsBuildings','81794',4,'2003-02-15',4,'2003-05-07','01189','00947','1999','2003','2002','5','4','50375','8822','6130','14952');
INSERT INTO TD VALUES (519,127,'Machineries','47328',4,'2002-11-21',4,'2002-08-10','04630','77925','1999','2008','2004','4','7','80847','6469','9594','16063');
INSERT INTO TD VALUES (520,128,'Machineries','99478',1,'2003-01-20',5,'2003-03-07','67450','45361','1999','2007','2008','1','4','17667','4526','2083','6609');
INSERT INTO TD VALUES (521,129,'Machineries','17491',3,'2003-01-30',2,'2003-02-07','80129','24451','1999','2003','2005','5','19','13506','5611','5710','11321');
INSERT INTO TD VALUES (522,130,'Machineries','38056',3,'2003-05-09',4,'2002-06-21','09733','89732','1999','2002','2004','1','6','6920','3381','4917','8298');
INSERT INTO TD VALUES (523,142,'Land','69286',3,'2002-09-27',1,'2002-10-24','50966','79700','1999','2009','2002','3','23','58775','3598','9372','12970');
INSERT INTO TD VALUES (524,143,'Land','29509',2,'2002-07-05',1,'2002-10-17','23104','45629','1999','2000','2000','3','9','14088','8578','3528','12106');
INSERT INTO TD VALUES (525,123,'PlantsTrees','90318',3,'2003-01-31',4,'2002-06-13','37765','00125','1999','2003','2006','4','5','82884','4661','2687','7348');
INSERT INTO TD VALUES (526,124,'PlantsTrees','56768',3,'2003-04-14',3,'2003-03-01','90231','91838','1999','2000','2005','3','21','83241','9226','5490','14716');
INSERT INTO TD VALUES (527,125,'PlantsTrees','61225',3,'2002-11-26',2,'2002-12-27','23014','36334','1999','2003','2001','3','17','63868','820','5593','6413');
INSERT INTO TD VALUES (528,126,'PlantsTrees','56644',4,'2002-07-04',2,'2002-12-19','51381','83833','1999','2008','2006','4','8','72739','3582','8938','12520');
INSERT INTO TD VALUES (529,130,'ImprovementsBuildings','13852',3,'2003-05-04',4,'2002-07-03','72553','19197','1999','2001','2003','2','17','33361','5475','5930','11405');
INSERT INTO TD VALUES (530,131,'Machineries','48819',2,'2003-02-13',3,'2002-08-02','23151','99960','1999','2007','2007','5','2','60105','5084','5088','10172');
INSERT INTO TD VALUES (531,132,'Machineries','39095',5,'2002-12-18',5,'2002-06-12','97739','07954','1999','2001','2000','1','4','70256','6271','7513','13784');
INSERT INTO TD VALUES (532,133,'Machineries','70705',1,'2002-07-02',5,'2003-01-26','05955','48579','1999','2008','2009','2','10','16946','4073','4926','8999');
INSERT INTO TD VALUES (533,134,'Machineries','96631',4,'2002-06-02',5,'2002-09-18','38157','67788','1999','2006','2000','4','20','70337','469','9818','10287');
INSERT INTO TD VALUES (534,144,'Land','30734',5,'2003-05-09',1,'2002-06-29','19722','17163','1999','2005','2003','1','2','48787','2786','9366','12152');
INSERT INTO TD VALUES (535,145,'Land','74010',4,'2003-02-17',3,'2002-10-19','31190','29898','1999','2006','2004','4','20','78938','1538','9596','11134');
INSERT INTO TD VALUES (536,146,'Land','79244',3,'2003-02-03',1,'2002-11-18','51373','21039','1999','2008','2000','2','1','87972','6087','3140','9227');
INSERT INTO TD VALUES (537,127,'PlantsTrees','63208',5,'2003-02-14',2,'2002-09-28','06209','84207','1999','2009','2005','3','1','31165','3123','9629','12752');
INSERT INTO TD VALUES (538,128,'PlantsTrees','71707',1,'2002-10-07',4,'2003-02-02','06847','68933','1999','2006','2005','3','10','47274','5207','7622','12829');
INSERT INTO TD VALUES (539,129,'PlantsTrees','77149',3,'2003-01-22',5,'2003-04-09','00773','57586','1999','2007','2006','2','5','12769','3066','6537','9603');
INSERT INTO TD VALUES (540,131,'ImprovementsBuildings','50860',3,'2002-06-02',5,'2002-08-20','93676','79927','1999','2003','2000','4','21','1556','3212','9305','12517');
INSERT INTO TD VALUES (541,135,'Machineries','15355',2,'2002-05-19',2,'2002-11-23','39394','11670','1999','2008','2005','5','9','52261','9809','4318','14127');
INSERT INTO TD VALUES (542,136,'Machineries','83345',4,'2003-05-06',1,'2002-11-12','09716','92014','1999','2002','2005','4','6','11024','279','8666','8945');
INSERT INTO TD VALUES (543,147,'Land','91654',3,'2003-03-26',3,'2002-12-16','81071','17545','1999','2000','2003','4','2','71329','4716','556','5272');
INSERT INTO TD VALUES (544,148,'Land','30996',2,'2002-06-28',3,'2002-06-05','10676','18999','1999','2009','2000','5','21','40659','1673','8518','10191');
INSERT INTO TD VALUES (545,149,'Land','16940',2,'2002-07-25',2,'2002-11-15','02327','86663','1999','2002','2002','4','4','11511','4524','5080','9604');
INSERT INTO TD VALUES (546,130,'PlantsTrees','73506',5,'2002-12-19',5,'2002-05-15','13680','35027','1999','2001','2006','1','21','76757','9863','9453','19316');
INSERT INTO TD VALUES (547,131,'PlantsTrees','11706',1,'2002-08-30',2,'2002-12-09','59519','85746','1999','2002','2000','1','12','14701','1984','2253','4237');
INSERT INTO TD VALUES (548,132,'ImprovementsBuildings','06063',4,'2002-06-21',2,'2003-01-18','28738','17824','1999','2005','2001','1','7','22784','8210','4129','12339');
INSERT INTO TD VALUES (549,133,'ImprovementsBuildings','58260',2,'2003-02-05',3,'2003-02-05','92490','69534','1999','2001','2006','1','6','43671','4798','9914','14712');
INSERT INTO TD VALUES (550,137,'Machineries','84558',3,'2003-01-13',5,'2002-11-21','66484','50801','1999','2003','2005','2','21','39346','8391','5401','13792');
INSERT INTO TD VALUES (551,138,'Machineries','06605',3,'2002-05-23',2,'2003-03-12','81323','94679','1999','2001','2006','3','10','75038','1173','4881','6054');
INSERT INTO TD VALUES (552,139,'Machineries','32903',3,'2002-08-21',1,'2003-01-15','44805','08714','1999','2007','2002','3','10','28515','5046','2915','7961');
INSERT INTO TD VALUES (553,150,'Land','42643',3,'2002-06-25',3,'2003-02-19','07187','66876','1999','2007','2004','1','10','22080','9675','333','10008');
INSERT INTO TD VALUES (554,151,'Land','05626',1,'2002-09-07',5,'2002-11-12','89700','99379','1999','2006','2003','2','6','62923','7772','8117','15889');
INSERT INTO TD VALUES (555,132,'PlantsTrees','13298',3,'2003-05-14',5,'2003-04-07','56401','68724','1999','2003','2001','4','10','73515','6460','1897','8357');
INSERT INTO TD VALUES (556,134,'ImprovementsBuildings','87903',5,'2002-07-13',5,'2002-09-30','57426','82185','1999','2003','2008','1','26','60730','3558','552','4110');
INSERT INTO TD VALUES (557,135,'ImprovementsBuildings','45803',3,'2003-05-05',5,'2002-08-19','29684','42391','1999','2004','2003','1','18','35200','5575','9089','14664');
INSERT INTO TD VALUES (558,136,'ImprovementsBuildings','52511',3,'2002-05-20',5,'2002-05-15','03149','53638','1999','2004','2002','1','26','85239','9141','7326','16467');
INSERT INTO TD VALUES (559,140,'Machineries','19317',2,'2003-01-07',3,'2002-12-05','79425','40794','1999','2009','2000','3','25','89506','5309','3139','8448');
INSERT INTO TD VALUES (560,141,'Machineries','94957',4,'2002-12-15',5,'2002-11-14','19670','42398','1999','2005','2008','4','8','41164','8507','3728','12235');
INSERT INTO TD VALUES (561,142,'Machineries','44170',2,'2003-03-31',3,'2002-07-05','70859','71632','1999','2007','2005','5','17','86196','9205','2403','11608');
INSERT INTO TD VALUES (562,143,'Machineries','43414',3,'2002-09-09',4,'2002-11-01','66881','97426','1999','2006','2004','2','26','26069','7952','2027','9979');
INSERT INTO TD VALUES (563,152,'Land','67209',4,'2002-08-25',5,'2002-09-12','23577','83269','1999','2000','2008','2','23','94003','4082','2743','6825');
INSERT INTO TD VALUES (564,153,'Land','20020',5,'2003-01-20',3,'2002-11-10','33575','22833','1999','2002','2008','2','17','39860','5706','9342','15048');
INSERT INTO TD VALUES (565,154,'Land','32244',1,'2003-02-07',5,'2002-09-05','82912','64135','1999','2001','2006','2','21','21719','8390','4943','13333');
INSERT INTO TD VALUES (566,155,'Land','09094',4,'2003-03-22',2,'2003-03-11','44407','84720','1999','2000','2009','3','20','7514','9369','646','10015');
INSERT INTO TD VALUES (567,156,'Land','17575',4,'2002-07-18',5,'2002-08-16','14964','82122','1999','2008','2007','1','24','55752','9692','5771','15463');
INSERT INTO TD VALUES (568,133,'PlantsTrees','94913',2,'2003-04-29',1,'2002-05-16','68496','74466','1999','2006','2007','5','9','7846','496','7957','8453');
INSERT INTO TD VALUES (569,134,'PlantsTrees','05312',5,'2003-01-31',1,'2003-02-02','45774','72952','1999','2003','2002','1','5','31875','6144','9547','15691');
INSERT INTO TD VALUES (570,135,'PlantsTrees','66427',4,'2003-01-16',5,'2002-07-15','42718','41581','1999','2007','2003','1','20','47244','9812','5016','14828');
INSERT INTO TD VALUES (571,137,'ImprovementsBuildings','64637',4,'2002-07-27',4,'2002-09-15','29905','93519','1999','2002','2001','2','4','35289','3979','4377','8356');
INSERT INTO TD VALUES (572,138,'ImprovementsBuildings','53150',5,'2002-06-22',5,'2003-01-19','45851','26893','1999','2001','2005','1','8','69321','4443','4195','8638');
INSERT INTO TD VALUES (573,139,'ImprovementsBuildings','59318',3,'2002-10-22',1,'2002-06-15','44555','66992','1999','2003','2002','1','12','72913','1044','1307','2351');
INSERT INTO TD VALUES (574,140,'ImprovementsBuildings','29417',1,'2003-01-21',2,'2003-03-19','40615','06089','1999','2001','2006','5','4','35135','9021','7551','16572');
INSERT INTO TD VALUES (575,144,'Machineries','09382',4,'2002-07-08',2,'2002-07-21','46319','51872','1999','2008','2000','2','5','59726','1052','9367','10419');
INSERT INTO TD VALUES (576,145,'Machineries','86604',5,'2002-06-08',4,'2002-11-09','44760','77560','1999','2003','2008','1','3','45489','4534','4370','8904');
INSERT INTO TD VALUES (577,157,'Land','74139',2,'2002-10-13',3,'2002-10-14','55953','76614','1999','2001','2003','1','26','59191','2152','557','2709');
INSERT INTO TD VALUES (578,158,'Land','14119',3,'2002-08-28',5,'2002-08-19','64241','58664','1999','2006','2008','3','1','73997','6816','3970','10786');
INSERT INTO TD VALUES (579,136,'PlantsTrees','13531',2,'2002-09-13',1,'2003-04-12','91174','82053','1999','2006','2001','2','8','21153','4494','8660','13154');
INSERT INTO TD VALUES (580,137,'PlantsTrees','07977',4,'2002-12-08',2,'2002-08-08','27126','91228','1999','2005','2009','5','21','18264','1068','6721','7789');
INSERT INTO TD VALUES (581,138,'PlantsTrees','74576',1,'2002-07-02',2,'2002-11-30','83695','74849','1999','2004','2005','3','22','43545','4284','5669','9953');
INSERT INTO TD VALUES (582,139,'PlantsTrees','06081',1,'2002-10-30',2,'2003-03-13','67613','77680','1999','2001','2006','5','19','3541','910','1614','2524');
INSERT INTO TD VALUES (583,141,'ImprovementsBuildings','50352',2,'2002-07-18',2,'2002-12-08','10908','71904','1999','2008','2008','1','6','65823','8391','4064','12455');
INSERT INTO TD VALUES (584,142,'ImprovementsBuildings','83242',5,'2002-12-18',1,'2002-07-07','75983','78107','1999','2008','2006','2','2','58016','7981','188','8169');
INSERT INTO TD VALUES (585,146,'Machineries','97139',3,'2002-07-27',3,'2003-05-05','21015','30404','1999','2001','2001','1','10','97139','2958','4103','7061');
INSERT INTO TD VALUES (586,147,'Machineries','88731',1,'2002-07-10',5,'2002-07-16','94571','21009','1999','2001','2007','5','24','18185','9033','4515','13548');
INSERT INTO TD VALUES (587,160,'Land','90616',1,'2003-02-09',4,'2002-07-22','16903','78452','1999','2008','2006','1','29','70475','7309','9706','17015');
INSERT INTO TD VALUES (588,161,'Land','64130',5,'2002-12-17',4,'2003-04-06','06124','72391','1999','2000','2004','1','10','44049','1216','3358','4574');
INSERT INTO TD VALUES (589,162,'Land','13264',2,'2003-05-01',1,'2002-05-16','80876','68378','1999','2002','2005','5','11','42998','351','2230','2581');
INSERT INTO TD VALUES (590,163,'Land','77711',3,'2002-12-16',1,'2003-01-16','19302','29888','1999','2000','2004','5','22','45134','1562','5345','6907');
INSERT INTO TD VALUES (591,140,'PlantsTrees','41649',5,'2003-04-15',1,'2002-10-19','96038','30815','1999','2002','2006','5','20','87661','2844','7134','9978');
INSERT INTO TD VALUES (592,141,'PlantsTrees','75719',2,'2003-02-26',2,'2003-03-06','19736','91738','1999','2007','2007','5','11','98118','8319','4013','12332');
INSERT INTO TD VALUES (593,143,'ImprovementsBuildings','79520',1,'2002-07-28',1,'2003-04-17','45241','86799','1999','2008','2005','4','26','27601','7327','5091','12418');
INSERT INTO TD VALUES (594,144,'ImprovementsBuildings','54885',3,'2002-07-17',1,'2002-07-11','13328','50656','1999','2009','2007','5','29','48814','3055','3628','6683');
INSERT INTO TD VALUES (595,145,'ImprovementsBuildings','23453',5,'2003-03-23',3,'2002-11-04','25005','58049','1999','2001','2008','5','9','95489','2270','6126','8396');
INSERT INTO TD VALUES (596,148,'Machineries','71652',2,'2002-10-24',3,'2002-12-17','15667','99730','1999','2002','2000','4','11','78517','4578','2134','6712');
INSERT INTO TD VALUES (597,149,'Machineries','76367',5,'2003-05-08',3,'2003-02-24','57300','81154','1999','2003','2004','4','4','55680','2462','2845','5307');
INSERT INTO TD VALUES (598,150,'Machineries','69091',4,'2002-09-17',4,'2003-02-02','54790','91304','1999','2000','2003','5','17','56893','3191','4040','7231');
INSERT INTO TD VALUES (599,151,'Machineries','80599',3,'2003-03-26',3,'2002-11-07','01359','30321','1999','2000','2001','2','2','93233','1447','2449','3896');
INSERT INTO TD VALUES (600,164,'Land','237592759027',1,'2003-06-18',1,'2003-06-18','3453453','53534535','2003','2007','35245345','','35324535','345325',NULL,NULL,NULL);
INSERT INTO TD VALUES (601,146,'ImprovementsBuildings','35353453453453453453',0,'2003-05-17',0,'2003-05-17','45345324534','53452345345345345','2003','2007','3453245345','2','34324534532','3453245',NULL,NULL,NULL);
INSERT INTO TD VALUES (602,169,'Land','3334567',1,'2003-05-20',2,'2003-05-20','2224567','','2004','2007','2003','3','Archibald Dimagiba','400000.00',NULL,NULL,NULL);
INSERT INTO TD VALUES (603,148,'ImprovementsBuildings','3334568',1,'2003-05-20',2,'2003-05-20','2224568','','2004','2007','2003','1','Archibald Dimalanta','500000',NULL,NULL,NULL);
INSERT INTO TD VALUES (604,143,'PlantsTrees','ertyryeryery',0,'2003-05-20',0,'2003-05-20','','','2003','2007','','','','',NULL,NULL,NULL);
INSERT INTO TD VALUES (605,167,'Land','76464564',0,'2003-05-20',0,'2003-05-20','','','2003','2007','','','','',NULL,NULL,NULL);
INSERT INTO TD VALUES (606,147,'ImprovementsBuildings','6564566',2,'2000-02-20',4,'2003-05-20','54564646','','2004','2007','5565464','4','56564','564564645656',NULL,NULL,NULL);
INSERT INTO TD VALUES (607,170,'Land','1234567',2,'2003-05-20',4,'2003-05-20','12345','','2003','2007','','5','','',NULL,NULL,NULL);
INSERT INTO TD VALUES (608,172,'Land','q',0,'2003-05-22',0,'2003-05-22','q','q','2003','2007','q','','q','q',NULL,NULL,NULL);
INSERT INTO TD VALUES (609,147,'PlantsTrees','w',0,'2003-05-22',0,'2003-05-22','w','w','2003','2007','w','','w','w',NULL,NULL,NULL);
INSERT INTO TD VALUES (610,175,'Land','8675309',0,'2003-05-27',0,'2003-05-27','','','2004','2007','','','','',NULL,NULL,NULL);
INSERT INTO TD VALUES (611,192,'Land','777',NULL,NULL,NULL,NULL,'777',NULL,'2004','2007',NULL,NULL,NULL,'777',NULL,NULL,NULL);
INSERT INTO TD VALUES (612,192,'Land','777',NULL,NULL,NULL,NULL,'777',NULL,'2004','2007',NULL,NULL,NULL,'777',NULL,NULL,NULL);
INSERT INTO TD VALUES (613,192,'Land','888',NULL,NULL,NULL,NULL,'888',NULL,'2004','2007',NULL,NULL,NULL,'888',NULL,NULL,NULL);
INSERT INTO TD VALUES (614,155,'PlantsTrees','888',NULL,NULL,NULL,NULL,'888',NULL,'2004','2007',NULL,NULL,NULL,'888',NULL,NULL,NULL);
INSERT INTO TD VALUES (615,153,'ImprovementsBuildings','888',NULL,NULL,NULL,NULL,'888',NULL,'2004','2007',NULL,NULL,NULL,'888',NULL,NULL,NULL);
INSERT INTO TD VALUES (616,158,'Machineries','888',NULL,NULL,NULL,NULL,'888',NULL,'2004','2007',NULL,NULL,NULL,'888',NULL,NULL,NULL);
INSERT INTO TD VALUES (617,192,'Land','888',NULL,NULL,NULL,NULL,'888',NULL,'2004','2007',NULL,NULL,NULL,'888',NULL,NULL,NULL);
INSERT INTO TD VALUES (618,155,'PlantsTrees','888',NULL,NULL,NULL,NULL,'888',NULL,'2004','2007',NULL,NULL,NULL,'888',NULL,NULL,NULL);
INSERT INTO TD VALUES (619,153,'ImprovementsBuildings','888',NULL,NULL,NULL,NULL,'888',NULL,'2004','2007',NULL,NULL,NULL,'888',NULL,NULL,NULL);
INSERT INTO TD VALUES (620,158,'Machineries','888',NULL,NULL,NULL,NULL,'888',NULL,'2004','2007',NULL,NULL,NULL,'888',NULL,NULL,NULL);
INSERT INTO TD VALUES (621,195,'Land','1234567',NULL,NULL,NULL,NULL,'123456',NULL,'2004','2007',NULL,NULL,NULL,'130000',NULL,NULL,NULL);
INSERT INTO TD VALUES (622,195,'Land','1234567',NULL,NULL,NULL,NULL,'123456',NULL,'2004','2007',NULL,NULL,NULL,'130000',NULL,NULL,NULL);
INSERT INTO TD VALUES (623,157,'PlantsTrees','456',NULL,NULL,NULL,NULL,'456',NULL,'2003','2006',NULL,NULL,NULL,'456',NULL,NULL,NULL);
INSERT INTO TD VALUES (624,157,'PlantsTrees','456',NULL,NULL,NULL,NULL,'456',NULL,'2003','2006',NULL,NULL,NULL,'456',NULL,NULL,NULL);
INSERT INTO TD VALUES (625,157,'PlantsTrees','456',NULL,NULL,NULL,NULL,'456',NULL,'2003','2006',NULL,NULL,NULL,'456',NULL,NULL,NULL);
INSERT INTO TD VALUES (626,157,'PlantsTrees','456',NULL,NULL,NULL,NULL,'456',NULL,'2003','2006',NULL,NULL,NULL,'456',NULL,NULL,NULL);
INSERT INTO TD VALUES (627,157,'PlantsTrees','4545',NULL,NULL,NULL,NULL,'4545',NULL,'2004','2007',NULL,NULL,NULL,'45454',NULL,NULL,NULL);
INSERT INTO TD VALUES (628,201,'Land','555',NULL,NULL,NULL,NULL,'555',NULL,'2004','2007',NULL,NULL,NULL,'555',NULL,NULL,NULL);
INSERT INTO TD VALUES (629,202,'Land','555',NULL,NULL,NULL,NULL,'555',NULL,'2004','2007',NULL,NULL,NULL,'555',NULL,NULL,NULL);
INSERT INTO TD VALUES (630,203,'Land','999',NULL,NULL,NULL,NULL,'999',NULL,'2004','2007',NULL,NULL,NULL,'999',NULL,NULL,NULL);
INSERT INTO TD VALUES (631,204,'Land','12345',NULL,NULL,NULL,NULL,'12345',NULL,'2004','2007',NULL,NULL,NULL,'12345',NULL,NULL,NULL);
INSERT INTO TD VALUES (632,205,'Land','12345',NULL,NULL,NULL,NULL,'12345',NULL,'2004','2007',NULL,NULL,NULL,'12345',NULL,NULL,NULL);
INSERT INTO TD VALUES (633,158,'PlantsTrees','12345',NULL,NULL,NULL,NULL,'12345',NULL,'2004','2007',NULL,NULL,NULL,'12345',NULL,NULL,NULL);
INSERT INTO TD VALUES (634,154,'ImprovementsBuildings','12345',NULL,NULL,NULL,NULL,'12345',NULL,'2004','2007',NULL,NULL,NULL,'12345',NULL,NULL,NULL);
INSERT INTO TD VALUES (635,159,'Machineries','12345',NULL,NULL,NULL,NULL,'12345',NULL,'2004','2007',NULL,NULL,NULL,'12345',NULL,NULL,NULL);
INSERT INTO TD VALUES (636,159,'PlantsTrees','789',NULL,NULL,NULL,NULL,'789',NULL,'2004','2007',NULL,NULL,NULL,'789',NULL,NULL,NULL);
INSERT INTO TD VALUES (637,206,'Land','testTDNumber',NULL,NULL,NULL,NULL,'testCancelsTDNumber',NULL,'2004','2007',NULL,NULL,NULL,'testPreviousAssessedValue',NULL,NULL,NULL);
INSERT INTO TD VALUES (638,160,'PlantsTrees','testTDNumber',NULL,NULL,NULL,NULL,'testCancelsTDNumber',NULL,'2004','2007',NULL,NULL,NULL,'testPreviousAssessedValue',NULL,NULL,NULL);
INSERT INTO TD VALUES (639,156,'ImprovementsBuildings','testTDNumber',NULL,NULL,NULL,NULL,'testCancelsTDNumber',NULL,'2004','2007',NULL,NULL,NULL,'testPreviousAssessedValue',NULL,NULL,NULL);
INSERT INTO TD VALUES (640,160,'Machineries','testTDNumber',NULL,NULL,NULL,NULL,'testCancelsTDNumber',NULL,'2004','2007',NULL,NULL,NULL,'testPreviousAssessedValue',NULL,NULL,NULL);
INSERT INTO TD VALUES (641,161,'PlantsTrees','457',NULL,NULL,NULL,NULL,'457',NULL,'2004','2007',NULL,NULL,NULL,'457',NULL,NULL,NULL);
INSERT INTO TD VALUES (642,161,'PlantsTrees','457',NULL,NULL,NULL,NULL,'457',NULL,'2004','2007',NULL,NULL,NULL,'457',NULL,NULL,NULL);
INSERT INTO TD VALUES (643,207,'Land','78910',NULL,NULL,NULL,NULL,'78910',NULL,'2004','2007',NULL,NULL,NULL,'78910',NULL,NULL,NULL);
INSERT INTO TD VALUES (644,162,'PlantsTrees','78911',NULL,NULL,NULL,NULL,'78911',NULL,'2004','2007',NULL,NULL,NULL,'78911',NULL,NULL,NULL);
INSERT INTO TD VALUES (645,208,'Land','75677547',0,'2003-06-13',0,'2003-06-13','67547645','567567567','2004','2007','567567567','','567567','5675675',NULL,NULL,NULL);
INSERT INTO TD VALUES (646,163,'PlantsTrees','fsdfsfsdfsdf',0,'2003-06-13',0,'2003-06-13','dfsdfs','dfsdfsdfs','2004','2007','dfsdf','','sdfsdfsdf','sdfsdfs',NULL,NULL,NULL);
INSERT INTO TD VALUES (647,157,'ImprovementsBuildings','dfhdfhdfh',0,'2003-06-13',0,'2003-06-13','dhdh','dfhdfhdfhdfhdfhdfh','2004','2007','dfhdfhdfh','','fhdfhdfhdfh','dfhdfhd',NULL,NULL,NULL);
INSERT INTO TD VALUES (648,209,'Land','789',NULL,NULL,NULL,NULL,'789',NULL,'2004','2007',NULL,NULL,NULL,'789',NULL,NULL,NULL);
INSERT INTO TD VALUES (649,164,'PlantsTrees','45',NULL,NULL,NULL,NULL,'45',NULL,'2004','2007',NULL,NULL,NULL,'45',NULL,NULL,NULL);
INSERT INTO TD VALUES (650,210,'Land','345-2888',0,'2003-06-13',0,'2003-06-13','','','2004','2007','','','','',NULL,NULL,NULL);

--
-- Table structure for table 'active_sessions'
--

CREATE TABLE active_sessions (
  sid varchar(32) NOT NULL default '',
  name varchar(32) NOT NULL default '',
  val text,
  changed varchar(14) NOT NULL default '',
  PRIMARY KEY  (name,sid),
  KEY changed (changed)
) TYPE=InnoDB;

--
-- Dumping data for table 'active_sessions'
--



--
-- Table structure for table 'active_sessions_split'
--

CREATE TABLE active_sessions_split (
  ct_sid varchar(32) NOT NULL default '',
  ct_name varchar(32) NOT NULL default '',
  ct_pos varchar(6) NOT NULL default '',
  ct_val text,
  ct_changed varchar(14) NOT NULL default '',
  PRIMARY KEY  (ct_name,ct_sid,ct_pos),
  KEY ct_changed (ct_changed)
) TYPE=InnoDB;

--
-- Dumping data for table 'active_sessions_split'
--


INSERT INTO active_sessions_split VALUES ('0551671cb12e699f09c7441fd106da84','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDcyNTMxJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NzE2MDInOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030613103354');
INSERT INTO active_sessions_split VALUES ('07a66814aca5104226357fa2f43e9400','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612184525');
INSERT INTO active_sessions_split VALUES ('0b22ff50a3e7ef44080a6574d5658dea','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc2YzIwYWFmZGUzMTliM2ZiYjNlYjdkN2MxOTllODliZic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612150442');
INSERT INTO active_sessions_split VALUES ('0c4c4e4d04aee6ffb6a93be441fca26b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDExODU5JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MTA5MzUnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030612174240');
INSERT INTO active_sessions_split VALUES ('108a9c0a92f7d5ba9f4087dc93d20098','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613103809');
INSERT INTO active_sessions_split VALUES ('115ed30c5cab47e8d5ee2163fc00d35b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612175722');
INSERT INTO active_sessions_split VALUES ('153dc0e14efd3421d72f940c6c7084e7','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdhOWIwNGYxZGM5NGY5NGJmYWRjNDhlNGQ2OGY5ZWFhZCc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612150448');
INSERT INTO active_sessions_split VALUES ('177482d7adda6493cd41d2d827e4c7ff','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613103407');
INSERT INTO active_sessions_split VALUES ('17a5e3440438985c680cefe70cb67619','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612184819');
INSERT INTO active_sessions_split VALUES ('199d790c0b7d1dc7245516f1aa94aa9b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612123112');
INSERT INTO active_sessions_split VALUES ('19badd67bea2d4683ad3d27899fa63f6','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDA2NjYyJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MDU3NTQnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030612161602');
INSERT INTO active_sessions_split VALUES ('19ee3102efcfdaf481a7aef3888061bb','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDE0MzE5JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MTM0MTknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030612182403');
INSERT INTO active_sessions_split VALUES ('1c243bd5f7aee913544ca9371d8e9df6','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdhNWJkNWY5YTVhZTJiOTk3MWI3MDcyMTk4YmU1YzdlZSc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612144137');
INSERT INTO active_sessions_split VALUES ('1c7129939c38c14a9c4451e36511cb7a','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181821');
INSERT INTO active_sessions_split VALUES ('23b65817f4945ed4ff054bc6ef7021fe','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612114642');
INSERT INTO active_sessions_split VALUES ('24cc63c1aa036199a91e94985e34f662','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181905');
INSERT INTO active_sessions_split VALUES ('25562639a0c2cc04d4dac85e9cf9e660','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdjM2EyMGJiYmVkNDM5YjI1NDIyNzlhYWYzMGE1NzU1NCc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145627');
INSERT INTO active_sessions_split VALUES ('26fd9bd2f9ddc611163e226beca5b99c','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612115429');
INSERT INTO active_sessions_split VALUES ('29ecedfdec0896515cf9de2403cd8cb4','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612114512');
INSERT INTO active_sessions_split VALUES ('2acd1dfc71c18e4ffd197b1129279cbb','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDEzMTkwJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MTIxMTMnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030612180903');
INSERT INTO active_sessions_split VALUES ('2b50903d9035cdf17d7c6a1eb51c7fb6','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7IA==','20030612183301');
INSERT INTO active_sessions_split VALUES ('2be5437f128ba3599e533acf61e9367b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612123139');
INSERT INTO active_sessions_split VALUES ('2ca157594854f18437ad57097d93b339','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDc1MjczJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NzM5NTAnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030613111933');
INSERT INTO active_sessions_split VALUES ('2ee461cd6d334487e4284909c0329130','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612180133');
INSERT INTO active_sessions_split VALUES ('309b72032159d27ae0c273c72a6b9426','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612175804');
INSERT INTO active_sessions_split VALUES ('36e6a4e913e4130cd7ad5a2e4cd0408e','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613104912');
INSERT INTO active_sessions_split VALUES ('3bafa4a065eb8c51e8aeffafddad7ee2','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181456');
INSERT INTO active_sessions_split VALUES ('3ca2e93364e39b48927f50f2f2583872','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc5NmI3MDFjZDFhZDVhYTgzMTJlNGZhODBhMmJmNmRhZic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612150410');
INSERT INTO active_sessions_split VALUES ('42ad20dbf115476085478e578701b692','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc4ZGUxOWRmZGYyMzY3ZjdkZTMxMDIyN2VhYzI4M2QwNic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612151143');
INSERT INTO active_sessions_split VALUES ('42d3ec07a29fb01805d34695f27e1ad1','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdhYTFlY2RjZTNiZmZlY2MxNjBjOGY0OGNjMWZlMDRlYSc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145129');
INSERT INTO active_sessions_split VALUES ('48ba2d3caa0bfbb104c717e8d66f5cf3','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612163137');
INSERT INTO active_sessions_split VALUES ('4b31930198bd9c71e2e838ebdc63fef5','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613111852');
INSERT INTO active_sessions_split VALUES ('4bf221b186c392bdc404c596ccb34b97','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612115424');
INSERT INTO active_sessions_split VALUES ('5151a5f1ce6bf97f5335219990f53906','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613103410');
INSERT INTO active_sessions_split VALUES ('52f05abfe046ed9f7fa6026fe40f5e5a','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612114313');
INSERT INTO active_sessions_split VALUES ('555ac7a7a5a7c84eb4a3cb73a5f371e5','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDA0NjYyJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MDM3NTYnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030612154245');
INSERT INTO active_sessions_split VALUES ('57438653bd25aca5dfd881a803d1be00','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181452');
INSERT INTO active_sessions_split VALUES ('5752cb62630e773c08fe632299afbdf1','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612115428');
INSERT INTO active_sessions_split VALUES ('57e03a458e6691a2979810ad8deffb1f','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612123639');
INSERT INTO active_sessions_split VALUES ('5a21859bae1d6def1062262038cadad1','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdmZmVhZTViM2FlMWQzZmMwMjk2ODZkMGYyOTlmMDQ1Myc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145821');
INSERT INTO active_sessions_split VALUES ('5bd57d1d571b458c9f2d739ae3176215','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDE2MDY2JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MTUxMjEnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030612185252');
INSERT INTO active_sessions_split VALUES ('5d362420bddf615c3446ffa0863b25c3','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181448');
INSERT INTO active_sessions_split VALUES ('5dada6c01a3be41a274db0135d38d956','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc2M2MyOWNmYWJiNDg4MGNmZmNhMjJmMTM0NzkzZGFiZic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612152707');
INSERT INTO active_sessions_split VALUES ('5e4c0ce4eac490fe1902a4920868a8ac','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612175712');
INSERT INTO active_sessions_split VALUES ('630c9d64a5714ebfae942a65ede25d6e','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdmYTZlM2ZhODE4Yzk2NzZhOTllZjRiZmIzZDkxZDAxYSc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612144623');
INSERT INTO active_sessions_split VALUES ('66b8bc079a8335caf9988d9d7bd4f87b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612114507');
INSERT INTO active_sessions_split VALUES ('67a802d19bfa43d17106ecf1c7cd1409','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDcxOTA0JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NzEwMDInOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030613105832');
INSERT INTO active_sessions_split VALUES ('682f6add82e3875badd0e5c88cd61da0','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613110716');
INSERT INTO active_sessions_split VALUES ('69604f00a423cc6d78ca6a9d8e9e1e53','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc4MzhjNTViZjhjYzA1YzVlZmZhMjcyMjBhMDBmODg4Zic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145454');
INSERT INTO active_sessions_split VALUES ('69cd86805f80065bd5749efaf2488a64','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613105324');
INSERT INTO active_sessions_split VALUES ('6a48ae8a9f041436c0ea7f425d1e2603','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDA4NDQwJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MDc1MzAnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030612164556');
INSERT INTO active_sessions_split VALUES ('6b9aa690862e85419b5d32224a004a73','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdiYmVmNzUwZGQ1YTk1YzJjYWZkYjkwYTllNTQzZDlmNyc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612153443');
INSERT INTO active_sessions_split VALUES ('6e0dc584a0b1bc3314d8af74c9b8ad9b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612114340');
INSERT INTO active_sessions_split VALUES ('6e79bf06fb92057d29f09f3c18952df6','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc4NWFiNDBjOTE3NGQ4NGIxNjliYWFiZGU4NzlkNjM4Nyc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612144051');
INSERT INTO active_sessions_split VALUES ('6fc4c5a5e2ab49af17afb83ddee91a98','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181819');
INSERT INTO active_sessions_split VALUES ('71c852fa775c07d07fbd36aa1c9c795e','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDA0OTc2JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MDQwNTEnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030612154756');
INSERT INTO active_sessions_split VALUES ('74200f9d7dd5324e919fd04c06c8b02f','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612122640');
INSERT INTO active_sessions_split VALUES ('74bb53941567068694e0fa750b61ba88','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc0NjE4YTE3MDY1M2NiMGZmMmQ1YjU1YzNiNmY0NTcxZic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145248');
INSERT INTO active_sessions_split VALUES ('7c98d2eed1a07e4d94db01d51f4823ce','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICczMGQyZjRlZGZmOTc0NmJlYWVkNzc3NTcwNGQ3OTI5Zic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145713');
INSERT INTO active_sessions_split VALUES ('883ddd2f6b2bf62b78d13c898c74ee49','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdhYzY1MjQyOWEzNzhjMmMwYjA0M2U1OGZlMzU1MTI1Myc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145545');
INSERT INTO active_sessions_split VALUES ('8a610c23693affee70c688aca6556c4b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc0Y2FmNjk0NWQ5YTNkYjE4MmU4YWYwODUxOWFkOTZiNyc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612153215');
INSERT INTO active_sessions_split VALUES ('8cb8c26826fdb206805ebe50af7b47c9','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612122653');
INSERT INTO active_sessions_split VALUES ('8db014339cd9a67d18949ab07a318dc7','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612174727');
INSERT INTO active_sessions_split VALUES ('93065284a8e592b74c019e78fa6229b1','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612122828');
INSERT INTO active_sessions_split VALUES ('96213388a80776209373b56fe4f7b9e4','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7IA==','20030612180148');
INSERT INTO active_sessions_split VALUES ('9a377e68601ad876332d02cfdb96882d','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDc0MzQ0JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NzI1NTknOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030613110407');
INSERT INTO active_sessions_split VALUES ('9ff4c47c62ea8c3706e549530c0012a9','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181816');
INSERT INTO active_sessions_split VALUES ('a130eeb7d44c19c35b4129462b7ed859','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612115418');
INSERT INTO active_sessions_split VALUES ('a1fa10c6c17508bc5ae64e360a6a199c','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613103431');
INSERT INTO active_sessions_split VALUES ('a666a2548f83cc3349a5dfc74106f1bd','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdlNjM1N2M4NzNjNDBiZDY0NzkyNWU4ODFkNDczYWI1Yic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145706');
INSERT INTO active_sessions_split VALUES ('a7436994fb88c37386bdaa3d71c94379','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612122647');
INSERT INTO active_sessions_split VALUES ('aca312dc83b567a5cc58920fdf370671','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613112022');
INSERT INTO active_sessions_split VALUES ('b2b84a8b3362b645e98f700bf3048fbf','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDc0NTgyJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NzMzNzAnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030613110804');
INSERT INTO active_sessions_split VALUES ('b2cde14df7e28001f748548d61d38cb0','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612184104');
INSERT INTO active_sessions_split VALUES ('b4c6b2f6ebd511c79ded5ae4c2cca6f5','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICcxMTY2ZWJlNWM1NjZjYjBkZDMyYTY2ZGIxNjg1ZTZkMSc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612153649');
INSERT INTO active_sessions_split VALUES ('b6c80de20ea65b18f3673e59392e819d','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612180917');
INSERT INTO active_sessions_split VALUES ('b848596f37a7039dde0286f61d638e57','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc3ZWZhOTljZmYwN2RhYmI2MTI5YTM3ZWM1N2ZjMWYzMic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612153556');
INSERT INTO active_sessions_split VALUES ('b95ab1c4798982da9149338be3dc1083','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181824');
INSERT INTO active_sessions_split VALUES ('ba4bd1f03a10e173dce5f892b3ee7873','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc2NTI3NWU5YTU1YThiNzdiZDFmYWJlODg4MTU5OGZmNCc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612150307');
INSERT INTO active_sessions_split VALUES ('bc368f48a6f7bc82397aee937c58d692','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613103418');
INSERT INTO active_sessions_split VALUES ('c3db923f8e21e3821d77e0faed419d59','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1MzkyMDM2JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTUzODYzMzMnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030612122430');
INSERT INTO active_sessions_split VALUES ('c4274efd6292abd0300f9998287a4e4b','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDY3NjUyJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NjY2OTgnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030613091745');
INSERT INTO active_sessions_split VALUES ('c50a95e9829607eb66aec222f5080208','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDc0Mzc3JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NzE3NTInOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030613110441');
INSERT INTO active_sessions_split VALUES ('cd5e32ef55c9f225a2ba368aad89c896','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDExMDgzJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MDk0OTInOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030612172944');
INSERT INTO active_sessions_split VALUES ('cfb890c5f067d7e18f8b991d840bea0e','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612114253');
INSERT INTO active_sessions_split VALUES ('cfd020ff1c895e1def14a9222e7764a8','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDA4NzA4JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MDc1OTcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030612165009');
INSERT INTO active_sessions_split VALUES ('d0d292ffa31b78b721b6dbc0f5b109f2','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc1ZmFmNDAxNjRiN2ViNzNlOGViMzc4YTk2NjI1OGM5MSc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612145553');
INSERT INTO active_sessions_split VALUES ('d1216fbdfdc9d85c85560d4157135391','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdlNDYwZmRiZjM0OTA1YWRjMTUxODM1OGM3OGVlNTAxNCc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612150450');
INSERT INTO active_sessions_split VALUES ('d2411e2a8ce51322b461685d9e4ea506','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613103435');
INSERT INTO active_sessions_split VALUES ('d2f2dbc6d0356043929b7aa3b94a576d','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICcwNGE1NDU2ZjM5ZTVjMmI4NmRiNTU5ZjhkOGMyODNkMic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612144146');
INSERT INTO active_sessions_split VALUES ('d3fecba0510f9f43fb5278393889b1fc','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613103441');
INSERT INTO active_sessions_split VALUES ('d7c6ee5486d1f2bcb0bd5b22a62bff59','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc1MDBlOWEzYmY5NjdiYzg5N2M0Mzc4YTk2YWMxZTRhOCc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612150446');
INSERT INTO active_sessions_split VALUES ('dc53157af7cd4af4fe74fdee76fbf475','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdlZDUyMGIyMDIxMGU0OTJjOTlkMDQ2NGU1ODc5NTRjYic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612153505');
INSERT INTO active_sessions_split VALUES ('dd89553638ebea9416f7038d27d822c4','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDEzNjAzJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MTEzOTMnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030612181145');
INSERT INTO active_sessions_split VALUES ('e59da8271dfbb20a290a8507fce70403','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDExNDkwJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MTA1NjInOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030612173631');
INSERT INTO active_sessions_split VALUES ('ea1708d69e53d73d99265f66d7deb775','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612181827');
INSERT INTO active_sessions_split VALUES ('ea6d251ecd3c8b41cf5a7100b81412a7','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDQ3NjMyJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NDY2ODAnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030613033856');
INSERT INTO active_sessions_split VALUES ('ebb47a021aabef078f2b678482cdff96','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0OSc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDc0NDcwJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NzM1MjEnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ2Rhbm55Jzsg','20030613110651');
INSERT INTO active_sessions_split VALUES ('ec487e3e5b6b84f82546b100c224c59c','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613103427');
INSERT INTO active_sessions_split VALUES ('ee2b51a06d2d87583285b3b8057b7066','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDcyNjQyJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0NzE2NTEnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030613103542');
INSERT INTO active_sessions_split VALUES ('f280da58dad71364f89bfb9b911c4a02','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612115623');
INSERT INTO active_sessions_split VALUES ('f2cd49f50969697f3621ef195f5ac8f8','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030612122831');
INSERT INTO active_sessions_split VALUES ('f3ce3a71b7b00a7758fdac855d3c266a','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICdlYzdhY2QzMDk2NGEyNWNlMjJmNDgyMjA0M2I2MWNhNyc7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612150755');
INSERT INTO active_sessions_split VALUES ('f432fd72480141fea9c6be55ed0c6687','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7IA==','20030612184511');
INSERT INTO active_sessions_split VALUES ('f745baa826d1a4551771733804dae064','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICc0Myc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ3Blcm0nXSA9ICcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydleHAnXSA9ICcxMDU1NDA4OTU4JzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncmVmcmVzaCddID0gJzEwNTU0MDc5NzUnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1bmFtZSddID0gJ25lbHNvbic7IA==','20030612165428');
INSERT INTO active_sessions_split VALUES ('f87faafdfac51ba96d6bdcaa30bc396d','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7ICR0aGlzLT5wdFsnYXV0aCddID0gJzEnOyAkdGhpcy0+cHRbJ2NoYWxsZW5nZSddID0gJzEnOyAkdGhpcy0+cHRbJ3Nlc3NMb2dnZWRJbiddID0gJzEnOyAkR0xPQkFMU1snYXV0aCddID0gbmV3IHJwdHNfQ2hhbGxlbmdlX0F1dGg7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGggPSBhcnJheSgpOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWyd1aWQnXSA9ICdmb3JtJzsgJEdMT0JBTFNbJ2F1dGgnXS0+YXV0aFsncGVybSddID0gJyc7ICRHTE9CQUxTWydhdXRoJ10tPmF1dGhbJ2V4cCddID0gJzIxNDc0ODM2NDcnOyAkR0xPQkFMU1snYXV0aCddLT5hdXRoWydyZWZyZXNoJ10gPSAnMjE0NzQ4MzY0Nyc7ICRHTE9CQUxTWydjaGFsbGVuZ2UnXSA9ICc5ZDViOWE4Y2JkN2ExNjM3YTUwZDYyODBkYjVkYTE0Yic7ICRHTE9CQUxTWydzZXNzTG9nZ2VkSW4nXSA9ICcnOyA=','20030612144201');
INSERT INTO active_sessions_split VALUES ('fb08d9c89b338f0d97c1724d0e88011e','rpts_Session','000000','JHRoaXMtPmluID0gJyc7ICR0aGlzLT5wdCA9IGFycmF5KCk7IA==','20030613112332');

--
-- Table structure for table 'auth_user_md5'
--

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
  PRIMARY KEY  (userID)
) TYPE=InnoDB;

--
-- Dumping data for table 'auth_user_md5'
--


INSERT INTO auth_user_md5 VALUES (43,'Super User','nelson','a4e360681676c770121e891f8c407572',17,'2003-05-13 00:00:00',20030612000000,'enabled',NULL);
INSERT INTO auth_user_md5 VALUES (45,'Assessor','zidane','27a2b32c77baa6ad3a5cfc4903810c60',19,'2003-05-13 00:00:00',20030612000000,'enabled',NULL);
INSERT INTO auth_user_md5 VALUES (46,'Guest','sammythan','4ba483fd2e3db4065375c1c4a1b0613e',20,'2003-05-13 00:00:00',20030612000000,'enabled',NULL);
INSERT INTO auth_user_md5 VALUES (47,'Super User','sammy2','eff7d5dba32b4da32d9a67a519434d3f',21,'2003-05-13 00:00:00',20030612000000,'disabled',NULL);
INSERT INTO auth_user_md5 VALUES (49,'Records','danny','b7bee6b36bd35b773132d4e3a74c2bb5',23,'2003-05-14 00:00:00',20030612000000,'disabled',NULL);
INSERT INTO auth_user_md5 VALUES (50,'Super User','chowmeinsoup','5259ee4a034fdeddd1b65be92debe731',18,'2003-05-14 00:00:00',20030612000000,'disabled',NULL);
INSERT INTO auth_user_md5 VALUES (51,'Super User','ravage','39c7f6c7bd2769583fa9f664660b699b',44,'2003-05-20 00:00:00',20030612000000,'disabled',NULL);
INSERT INTO auth_user_md5 VALUES (52,'Super User','ncc','b06de212b821659277d610b28ad7357c',58,'2003-05-20 00:00:00',20030612000000,'disabled',NULL);
INSERT INTO auth_user_md5 VALUES (53,'Assessor','Assessor1','5f4dcc3b5aa765d61d8327deb882cf99',67,'2003-05-22 00:00:00',20030612000000,'disabled',NULL);
INSERT INTO auth_user_md5 VALUES (54,'Super User','maan','52d6e985084cf747bc211510f8a006a7',77,'2003-05-26 00:00:00',20030612000000,'disabled',NULL);

--
-- Table structure for table 'collectionPayments'
--

CREATE TABLE collectionPayments (
  collectionID bigint(20) NOT NULL default '0',
  paymentID bigint(20) NOT NULL default '0',
  PRIMARY KEY  (paymentID),
  KEY byCollection (collectionID)
) TYPE=InnoDB;

--
-- Dumping data for table 'collectionPayments'
--



--
-- Table structure for table 'collections'
--

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
) TYPE=InnoDB;

--
-- Dumping data for table 'collections'
--



--
-- Table structure for table 'dues'
--

CREATE TABLE dues (
  dueID bigint(20) unsigned NOT NULL auto_increment,
  basic double(14,2) NOT NULL default '0.00',
  penalty double(14,2) NOT NULL default '0.00',
  sef double(14,2) NOT NULL default '0.00',
  tdnum bigint(20) default NULL,
  dueDate date default NULL,
  currentDate datetime default NULL,
  paidBasic double(14,2) NOT NULL default '0.00',
  paidSEF double(14,2) NOT NULL default '0.00',
  paidPenalty double(14,2) NOT NULL default '0.00',
  paymentMode varchar(15) default NULL,
  paidQuarters int(11) default NULL,
  PRIMARY KEY  (dueID),
  KEY byTDnum (tdnum),
  KEY byDate (dueDate),
  KEY byDueID (dueID)
) TYPE=InnoDB;

--
-- Dumping data for table 'dues'
--


INSERT INTO dues VALUES (15487,1.92,0.00,0.96,9223372036854775807,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15488,26020.22,0.00,13010.11,74918,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15489,46202.02,0.00,23101.01,15923,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15490,22402.20,0.00,11201.10,22727,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15491,64622.22,0.00,32311.11,6255,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15492,46040.02,0.00,23020.01,3775,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15493,20622.00,0.00,10311.00,8526,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15494,1.92,0.00,0.96,9223372036854775807,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15495,26020.22,0.00,13010.11,74918,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15496,46202.02,0.00,23101.01,15923,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15497,22402.20,0.00,11201.10,22727,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15498,64622.22,0.00,32311.11,6255,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15499,46040.02,0.00,23020.01,3775,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15500,20622.00,0.00,10311.00,8526,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15501,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15502,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15503,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15504,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15505,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15506,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15507,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15508,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15509,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15510,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15511,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15512,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15513,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15514,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15515,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15516,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15517,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15518,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15519,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15520,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15521,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15522,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15523,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15524,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15525,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15526,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15527,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15528,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15529,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15530,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15531,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15532,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15533,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15534,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15535,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15536,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15537,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15538,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15539,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15540,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15541,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15542,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15543,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15544,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15545,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15546,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15547,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15548,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15549,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15550,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15551,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15552,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15553,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15554,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15555,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15556,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15557,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15558,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15559,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15560,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15561,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15562,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15563,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15564,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15565,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15566,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15567,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15568,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15569,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15570,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15571,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15572,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15573,44062.00,0.00,22031.00,23657,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15574,20222.22,0.00,10111.11,39783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15575,24462.02,0.00,12231.01,97045,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15576,22222.22,0.00,11111.11,15288,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15577,26040.00,0.00,13020.00,38046,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15578,64400.00,0.00,32200.00,31430,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15579,24242.00,0.00,12121.00,90888,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15580,24602.02,0.00,12301.01,66783,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15581,46240.20,0.00,23120.10,32212,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15582,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15583,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15584,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15585,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15586,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15587,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15588,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15589,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15590,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15591,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15592,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15593,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15594,1.92,0.00,0.96,9223372036854775807,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15595,26020.22,0.00,13010.11,74918,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15596,46202.02,0.00,23101.01,15923,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15597,22402.20,0.00,11201.10,22727,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15598,64622.22,0.00,32311.11,6255,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15599,46040.02,0.00,23020.01,3775,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15600,20622.00,0.00,10311.00,8526,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15601,1.92,0.00,0.96,9223372036854775807,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15602,26020.22,0.00,13010.11,74918,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15603,46202.02,0.00,23101.01,15923,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15604,22402.20,0.00,11201.10,22727,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15605,64622.22,0.00,32311.11,6255,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15606,46040.02,0.00,23020.01,3775,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15607,20622.00,0.00,10311.00,8526,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15608,1.46,0.00,0.73,3334567,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15609,1.20,0.00,0.60,3334568,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15610,1.92,0.00,0.96,9223372036854775807,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15611,26020.22,0.00,13010.11,74918,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15612,46202.02,0.00,23101.01,15923,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15613,22402.20,0.00,11201.10,22727,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15614,64622.22,0.00,32311.11,6255,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15615,46040.02,0.00,23020.01,3775,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15616,20622.00,0.00,10311.00,8526,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15617,1.92,0.00,0.96,9223372036854775807,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15618,26020.22,0.00,13010.11,74918,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15619,46202.02,0.00,23101.01,15923,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15620,22402.20,0.00,11201.10,22727,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15621,64622.22,0.00,32311.11,6255,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15622,46040.02,0.00,23020.01,3775,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15623,20622.00,0.00,10311.00,8526,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15624,1.46,0.00,0.73,3334567,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15625,1.20,0.00,0.60,3334568,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15626,1.46,0.00,0.73,3334567,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15627,1.20,0.00,0.60,3334568,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15628,2462.46,0.00,1231.23,237592759027,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15629,1.92,0.00,0.96,9223372036854775807,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15630,1.46,0.00,0.73,3334567,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15631,1.20,0.00,0.60,3334568,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'full',0);
INSERT INTO dues VALUES (15632,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15633,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15634,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15635,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15636,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15637,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15638,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15639,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15640,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15641,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15642,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15643,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15644,66622.20,0.00,33311.10,67209,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15645,26060.02,0.00,13030.01,20020,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15646,46640.00,0.00,23320.00,32244,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15647,22202.20,0.00,11101.10,9094,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15648,40202.22,0.00,20101.11,17575,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15649,26460.22,0.00,13230.11,94913,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15650,24622.00,0.00,12311.00,5312,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15651,66240.20,0.00,33120.10,66427,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15652,26442.02,0.00,13221.01,64637,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15653,22402.00,0.00,11201.00,53150,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15654,44420.00,0.00,22210.00,59318,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15655,40402.00,0.00,20201.00,29417,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15656,46260.02,0.00,23130.01,9382,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15657,44660.02,0.00,22330.01,86604,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15658,66622.20,0.00,33311.10,67209,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15659,26060.02,0.00,13030.01,20020,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15660,46640.00,0.00,23320.00,32244,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15661,22202.20,0.00,11101.10,9094,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15662,40202.22,0.00,20101.11,17575,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15663,26460.22,0.00,13230.11,94913,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15664,24622.00,0.00,12311.00,5312,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15665,66240.20,0.00,33120.10,66427,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15666,26442.02,0.00,13221.01,64637,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15667,22402.00,0.00,11201.00,53150,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15668,44420.00,0.00,22210.00,59318,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15669,40402.00,0.00,20201.00,29417,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15670,46260.02,0.00,23130.01,9382,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15671,44660.02,0.00,22330.01,86604,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15672,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15673,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15674,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15675,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15676,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15677,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15678,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15679,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15680,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15681,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15682,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15683,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15684,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15685,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15686,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15687,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15688,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15689,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15690,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15691,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15692,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15693,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15694,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15695,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15696,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15697,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15698,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15699,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15700,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15701,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15702,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15703,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15704,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15705,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15706,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15707,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15708,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15709,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15710,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15711,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15712,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15713,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15714,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15715,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15716,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15717,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15718,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15719,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15720,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15721,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15722,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15723,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15724,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15725,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15726,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15727,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15728,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15729,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15730,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15731,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15732,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15733,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15734,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15735,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15736,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15737,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15738,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15739,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15740,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15741,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15742,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15743,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15744,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15745,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15746,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15747,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15748,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15749,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15750,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15751,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15752,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15753,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15754,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15755,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15756,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15757,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15758,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15759,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15760,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15761,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15762,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15763,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15764,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15765,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15766,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15767,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15768,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15769,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15770,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15771,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15772,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15773,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15774,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15775,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15776,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15777,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15778,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15779,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15780,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15781,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15782,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15783,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15784,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15785,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15786,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15787,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15788,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15789,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15790,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15791,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15792,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15793,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15794,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15795,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15796,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15797,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15798,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15799,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15800,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15801,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15802,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15803,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15804,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15805,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15806,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15807,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15808,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15809,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15810,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15811,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15812,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15813,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15814,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15815,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15816,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15817,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15818,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15819,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15820,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15821,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15822,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15823,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15824,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15825,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15826,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15827,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15828,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15829,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15830,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15831,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15832,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15833,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15834,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15835,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15836,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15837,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15838,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15839,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15840,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15841,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15842,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15843,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15844,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15845,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15846,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15847,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15848,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15849,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15850,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15851,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15852,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15853,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15854,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15855,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15856,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15857,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15858,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15859,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15860,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15861,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15862,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15863,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15864,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15865,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15866,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15867,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15868,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15869,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15870,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15871,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15872,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15873,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15874,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15875,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15876,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15877,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15878,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15879,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15880,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15881,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15882,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15883,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15884,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15885,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15886,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15887,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15888,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15889,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15890,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15891,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15892,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15893,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15894,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15895,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15896,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15897,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15898,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15899,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15900,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15901,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15902,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15903,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15904,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15905,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15906,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15907,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15908,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15909,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15910,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15911,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15912,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15913,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15914,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15915,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15916,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15917,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15918,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15919,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15920,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15921,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15922,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15923,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15924,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15925,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15926,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15927,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15928,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15929,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15930,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15931,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15932,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15933,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15934,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15935,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15936,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15937,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15938,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15939,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15940,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15941,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15942,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15943,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15944,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15945,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15946,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15947,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15948,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15949,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15950,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15951,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15952,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15953,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15954,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15955,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15956,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15957,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15958,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15959,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15960,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15961,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15962,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15963,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15964,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15965,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15966,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15967,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15968,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15969,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15970,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15971,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15972,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15973,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15974,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15975,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15976,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15977,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15978,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15979,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15980,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15981,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15982,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15983,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15984,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15985,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15986,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15987,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15988,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15989,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15990,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15991,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15992,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15993,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15994,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15995,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15996,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15997,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15998,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (15999,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16000,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16001,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16002,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16003,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16004,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16005,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16006,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16007,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16008,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16009,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16010,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16011,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16012,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16013,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16014,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16015,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16016,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16017,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16018,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16019,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16020,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16021,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16022,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16023,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16024,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16025,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16026,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16027,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16028,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16029,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16030,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16031,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16032,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16033,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16034,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16035,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16036,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16037,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16038,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16039,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16040,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16041,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16042,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16043,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16044,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16045,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16046,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16047,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16048,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16049,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16050,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16051,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16052,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16053,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16054,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16055,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16056,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16057,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16058,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16059,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16060,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16061,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16062,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16063,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16064,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16065,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16066,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16067,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16068,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16069,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16070,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16071,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16072,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16073,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16074,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16075,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16076,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16077,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16078,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16079,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16080,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16081,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16082,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16083,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16084,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16085,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16086,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16087,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16088,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16089,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16090,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16091,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16092,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16093,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16094,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16095,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16096,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16097,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16098,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16099,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16100,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16101,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16102,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16103,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16104,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16105,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16106,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16107,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16108,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16109,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16110,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16111,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16112,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16113,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16114,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16115,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16116,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16117,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16118,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16119,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16120,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16121,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16122,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16123,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16124,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16125,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16126,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16127,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16128,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16129,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16130,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16131,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16132,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16133,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16134,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16135,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16136,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16137,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16138,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16139,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16140,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16141,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16142,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16143,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16144,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16145,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16146,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16147,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16148,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16149,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16150,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16151,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16152,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16153,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16154,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16155,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16156,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16157,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16158,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16159,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16160,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16161,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16162,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16163,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16164,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16165,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16166,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16167,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16168,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16169,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16170,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16171,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16172,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16173,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16174,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16175,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16176,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16177,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16178,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16179,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16180,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16181,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16182,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16183,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16184,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16185,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16186,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16187,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16188,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16189,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16190,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16191,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16192,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16193,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16194,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16195,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16196,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16197,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16198,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16199,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16200,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16201,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16202,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16203,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16204,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16205,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16206,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16207,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16208,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16209,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16210,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16211,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16212,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16213,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16214,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16215,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16216,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16217,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16218,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16219,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16220,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16221,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16222,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16223,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16224,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16225,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16226,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16227,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16228,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16229,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16230,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16231,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16232,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16233,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16234,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16235,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16236,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16237,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16238,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16239,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16240,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16241,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16242,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16243,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16244,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16245,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16246,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16247,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16248,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16249,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16250,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16251,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16252,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16253,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16254,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16255,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16256,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16257,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16258,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16259,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16260,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16261,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16262,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16263,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16264,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16265,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16266,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16267,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16268,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16269,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16270,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16271,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16272,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16273,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16274,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16275,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16276,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16277,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16278,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16279,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16280,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16281,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16282,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16283,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16284,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16285,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16286,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16287,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16288,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16289,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16290,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16291,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16292,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16293,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16294,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16295,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16296,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16297,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16298,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16299,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16300,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16301,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16302,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16303,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16304,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16305,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16306,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16307,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16308,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16309,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16310,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16311,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16312,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16313,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16314,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16315,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16316,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16317,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16318,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16319,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16320,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16321,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16322,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16323,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16324,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16325,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16326,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16327,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16328,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16329,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16330,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16331,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16332,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16333,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16334,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16335,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16336,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16337,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16338,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16339,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16340,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16341,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16342,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16343,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16344,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16345,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16346,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16347,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16348,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16349,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16350,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16351,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16352,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16353,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16354,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16355,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16356,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16357,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16358,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16359,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16360,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16361,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16362,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16363,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16364,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16365,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16366,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16367,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16368,20002.02,0.00,10001.01,89270,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16369,64640.00,0.00,32320.00,68689,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16370,20242.02,0.00,10121.01,51684,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16371,40262.20,0.00,20131.10,74230,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16372,24262.00,0.00,12131.00,28197,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16373,46262.20,0.00,23131.10,63131,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16374,40422.00,0.00,20211.00,3739,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16375,64060.20,0.00,32030.10,82614,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16376,42402.22,0.00,21201.11,72092,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16377,66242.22,0.00,33121.11,93110,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16378,22040.22,0.00,11020.11,88767,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16379,40602.20,0.00,20301.10,55620,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16380,26440.20,0.00,13220.10,42470,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16381,24660.22,0.00,12330.11,42844,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16382,40220.22,0.00,20110.11,50901,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16383,20240.00,0.00,10120.00,99950,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16384,24260.20,0.00,12130.10,57207,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16385,26260.20,0.00,13130.10,29922,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16386,64660.02,0.00,32330.01,79674,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16387,40060.22,0.00,20030.11,85282,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16388,26402.02,0.00,13201.01,96200,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16389,26440.20,0.00,13220.10,42470,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16390,24660.22,0.00,12330.11,42844,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16391,40220.22,0.00,20110.11,50901,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16392,20240.00,0.00,10120.00,99950,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16393,24260.20,0.00,12130.10,57207,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16394,26260.20,0.00,13130.10,29922,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16395,64660.02,0.00,32330.01,79674,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16396,40060.22,0.00,20030.11,85282,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16397,26402.02,0.00,13201.01,96200,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);
INSERT INTO dues VALUES (16398,5.52,0.00,2.76,76464564,'1970-01-01','1970-01-01 08:00:00',0.00,0.00,0.00,'Annual',0);

--
-- Table structure for table 'payments'
--

CREATE TABLE payments (
  paymentID bigint(20) unsigned NOT NULL auto_increment,
  amount double(14,2) default '0.00',
  application set('full','Q1','Q2','Q3','Q4') default NULL,
  penalty double(14,2) default '0.00',
  sef double(14,2) default '0.00',
  basic double(14,2) default '0.00',
  dueID bigint(20) NOT NULL default '0',
  PRIMARY KEY  (paymentID,dueID),
  KEY dueID (dueID)
) TYPE=InnoDB;

--
-- Dumping data for table 'payments'
--


INSERT INTO payments VALUES (1,1010.00,'full',0.00,10.00,1000.00,1);
INSERT INTO payments VALUES (2,2040.00,'Q1',20.00,20.00,2000.00,2);
INSERT INTO payments VALUES (4,1010.00,'full',0.00,10.00,1000.00,4);
INSERT INTO payments VALUES (5,2040.00,'Q1',20.00,20.00,2000.00,5);
INSERT INTO payments VALUES (7,1010.00,'full',0.00,10.00,1000.00,7);
INSERT INTO payments VALUES (8,2040.00,'Q1',20.00,20.00,2000.00,8);
INSERT INTO payments VALUES (10,1010.00,'full',0.00,10.00,1000.00,10);
INSERT INTO payments VALUES (11,2040.00,'Q1',20.00,20.00,2000.00,11);
INSERT INTO payments VALUES (13,1010.00,'full',0.00,10.00,1000.00,13);
INSERT INTO payments VALUES (14,2040.00,'Q1',20.00,20.00,2000.00,14);
INSERT INTO payments VALUES (16,1010.00,'full',0.00,10.00,1000.00,16);
INSERT INTO payments VALUES (17,2040.00,'Q1',20.00,20.00,2000.00,17);
INSERT INTO payments VALUES (19,1010.00,'full',0.00,10.00,1000.00,19);
INSERT INTO payments VALUES (20,2040.00,'Q1',20.00,20.00,2000.00,20);
INSERT INTO payments VALUES (22,1010.00,'full',0.00,10.00,1000.00,22);
INSERT INTO payments VALUES (23,2040.00,'Q1',20.00,20.00,2000.00,23);
INSERT INTO payments VALUES (25,1010.00,'full',0.00,10.00,1000.00,25);
INSERT INTO payments VALUES (26,2040.00,'Q1',20.00,20.00,2000.00,26);
INSERT INTO payments VALUES (28,1010.00,'full',0.00,10.00,1000.00,28);
INSERT INTO payments VALUES (29,2040.00,'Q1',20.00,20.00,2000.00,29);
INSERT INTO payments VALUES (31,1010.00,'full',0.00,10.00,1000.00,31);
INSERT INTO payments VALUES (32,2040.00,'Q1',20.00,20.00,2000.00,32);
INSERT INTO payments VALUES (34,1010.00,'full',0.00,10.00,1000.00,34);
INSERT INTO payments VALUES (35,2040.00,'Q1',20.00,20.00,2000.00,35);
INSERT INTO payments VALUES (37,1010.00,'full',0.00,10.00,1000.00,37);
INSERT INTO payments VALUES (38,2040.00,'Q1',20.00,20.00,2000.00,38);
INSERT INTO payments VALUES (40,1010.00,'full',0.00,10.00,1000.00,40);
INSERT INTO payments VALUES (41,2040.00,'Q1',20.00,20.00,2000.00,41);
INSERT INTO payments VALUES (43,1010.00,'full',0.00,10.00,1000.00,43);
INSERT INTO payments VALUES (44,2040.00,'Q1',20.00,20.00,2000.00,44);
INSERT INTO payments VALUES (46,1010.00,'full',0.00,10.00,1000.00,46);
INSERT INTO payments VALUES (47,2040.00,'Q1',20.00,20.00,2000.00,47);
INSERT INTO payments VALUES (49,1010.00,'full',0.00,10.00,1000.00,49);
INSERT INTO payments VALUES (50,2040.00,'Q1',20.00,20.00,2000.00,50);
INSERT INTO payments VALUES (52,1010.00,'full',0.00,10.00,1000.00,52);
INSERT INTO payments VALUES (53,2040.00,'Q1',20.00,20.00,2000.00,53);
INSERT INTO payments VALUES (55,1010.00,'full',0.00,10.00,1000.00,55);
INSERT INTO payments VALUES (56,2040.00,'Q1',20.00,20.00,2000.00,56);
INSERT INTO payments VALUES (58,1010.00,'full',0.00,10.00,1000.00,58);
INSERT INTO payments VALUES (59,2040.00,'Q1',20.00,20.00,2000.00,59);
INSERT INTO payments VALUES (61,1010.00,'full',0.00,10.00,1000.00,61);
INSERT INTO payments VALUES (62,2040.00,'Q1',20.00,20.00,2000.00,62);
INSERT INTO payments VALUES (64,1010.00,'full',0.00,10.00,1000.00,64);
INSERT INTO payments VALUES (65,2040.00,'Q1',20.00,20.00,2000.00,65);
INSERT INTO payments VALUES (67,1010.00,'full',0.00,10.00,1000.00,67);
INSERT INTO payments VALUES (68,2040.00,'Q1',20.00,20.00,2000.00,68);
INSERT INTO payments VALUES (70,1010.00,'full',0.00,10.00,1000.00,70);
INSERT INTO payments VALUES (71,2040.00,'Q1',20.00,20.00,2000.00,71);
INSERT INTO payments VALUES (73,1010.00,'full',0.00,10.00,1000.00,73);
INSERT INTO payments VALUES (74,2040.00,'Q1',20.00,20.00,2000.00,74);
INSERT INTO payments VALUES (76,1010.00,'full',0.00,10.00,1000.00,76);
INSERT INTO payments VALUES (77,2040.00,'Q1',20.00,20.00,2000.00,77);
INSERT INTO payments VALUES (79,1010.00,'full',0.00,10.00,1000.00,79);
INSERT INTO payments VALUES (80,2040.00,'Q1',20.00,20.00,2000.00,80);
INSERT INTO payments VALUES (82,1010.00,'full',0.00,10.00,1000.00,82);
INSERT INTO payments VALUES (83,2040.00,'Q1',20.00,20.00,2000.00,83);
INSERT INTO payments VALUES (85,1010.00,'full',0.00,10.00,1000.00,85);
INSERT INTO payments VALUES (86,2040.00,'Q1',20.00,20.00,2000.00,86);
INSERT INTO payments VALUES (88,1010.00,'full',0.00,10.00,1000.00,88);
INSERT INTO payments VALUES (89,2040.00,'Q1',20.00,20.00,2000.00,89);
INSERT INTO payments VALUES (91,1010.00,'full',0.00,10.00,1000.00,91);
INSERT INTO payments VALUES (92,2040.00,'Q1',20.00,20.00,2000.00,92);
INSERT INTO payments VALUES (94,1010.00,'full',0.00,10.00,1000.00,94);
INSERT INTO payments VALUES (95,2040.00,'Q1',20.00,20.00,2000.00,95);
INSERT INTO payments VALUES (97,1010.00,'full',0.00,10.00,1000.00,97);
INSERT INTO payments VALUES (98,2040.00,'Q1',20.00,20.00,2000.00,98);
INSERT INTO payments VALUES (100,1010.00,'full',0.00,10.00,1000.00,100);
INSERT INTO payments VALUES (101,2040.00,'Q1',20.00,20.00,2000.00,101);
INSERT INTO payments VALUES (103,1010.00,'full',0.00,10.00,1000.00,103);
INSERT INTO payments VALUES (104,2040.00,'Q1',20.00,20.00,2000.00,104);
INSERT INTO payments VALUES (106,1010.00,'full',0.00,10.00,1000.00,106);
INSERT INTO payments VALUES (107,2040.00,'Q1',20.00,20.00,2000.00,107);
INSERT INTO payments VALUES (109,1010.00,'full',0.00,10.00,1000.00,109);
INSERT INTO payments VALUES (110,2040.00,'Q1',20.00,20.00,2000.00,110);
INSERT INTO payments VALUES (112,1010.00,'full',0.00,10.00,1000.00,112);
INSERT INTO payments VALUES (113,2040.00,'Q1',20.00,20.00,2000.00,113);
INSERT INTO payments VALUES (115,1010.00,'full',0.00,10.00,1000.00,115);
INSERT INTO payments VALUES (116,2040.00,'Q1',20.00,20.00,2000.00,116);
INSERT INTO payments VALUES (118,1010.00,'full',0.00,10.00,1000.00,118);
INSERT INTO payments VALUES (119,2040.00,'Q1',20.00,20.00,2000.00,119);
INSERT INTO payments VALUES (121,1010.00,'full',0.00,10.00,1000.00,121);
INSERT INTO payments VALUES (122,2040.00,'Q1',20.00,20.00,2000.00,122);
INSERT INTO payments VALUES (124,1010.00,'full',0.00,10.00,1000.00,124);
INSERT INTO payments VALUES (125,2040.00,'Q1',20.00,20.00,2000.00,125);
INSERT INTO payments VALUES (127,1010.00,'full',0.00,10.00,1000.00,127);
INSERT INTO payments VALUES (128,2040.00,'Q1',20.00,20.00,2000.00,128);
INSERT INTO payments VALUES (129,1010.00,'full',0.00,10.00,1000.00,129);
INSERT INTO payments VALUES (131,2040.00,'Q1',20.00,20.00,2000.00,131);
INSERT INTO payments VALUES (133,1010.00,'full',0.00,10.00,1000.00,133);
INSERT INTO payments VALUES (134,2040.00,'Q1',20.00,20.00,2000.00,134);
INSERT INTO payments VALUES (136,1010.00,'full',0.00,10.00,1000.00,136);
INSERT INTO payments VALUES (137,1010.00,'full',0.00,10.00,1000.00,137);
INSERT INTO payments VALUES (138,2040.00,'Q1',20.00,20.00,2000.00,138);
INSERT INTO payments VALUES (139,2040.00,'Q1',20.00,20.00,2000.00,139);
INSERT INTO payments VALUES (142,1010.00,'full',0.00,10.00,1000.00,142);
INSERT INTO payments VALUES (143,2040.00,'Q1',20.00,20.00,2000.00,143);
INSERT INTO payments VALUES (145,1010.00,'full',0.00,10.00,1000.00,145);
INSERT INTO payments VALUES (146,2040.00,'Q1',20.00,20.00,2000.00,146);
INSERT INTO payments VALUES (148,1010.00,'full',0.00,10.00,1000.00,148);
INSERT INTO payments VALUES (149,2040.00,'Q1',20.00,20.00,2000.00,149);
INSERT INTO payments VALUES (151,1010.00,'full',0.00,10.00,1000.00,151);
INSERT INTO payments VALUES (152,2040.00,'Q1',20.00,20.00,2000.00,152);
INSERT INTO payments VALUES (154,1010.00,'full',0.00,10.00,1000.00,154);
INSERT INTO payments VALUES (155,2040.00,'Q1',20.00,20.00,2000.00,155);
INSERT INTO payments VALUES (157,1010.00,'full',0.00,10.00,1000.00,157);
INSERT INTO payments VALUES (158,2040.00,'Q1',20.00,20.00,2000.00,158);
INSERT INTO payments VALUES (160,1010.00,'full',0.00,10.00,1000.00,160);
INSERT INTO payments VALUES (161,2040.00,'Q1',20.00,20.00,2000.00,161);
INSERT INTO payments VALUES (163,1010.00,'full',0.00,10.00,1000.00,163);
INSERT INTO payments VALUES (164,2040.00,'Q1',20.00,20.00,2000.00,164);
INSERT INTO payments VALUES (166,1010.00,'full',0.00,10.00,1000.00,166);
INSERT INTO payments VALUES (167,2040.00,'Q1',20.00,20.00,2000.00,167);
INSERT INTO payments VALUES (169,1010.00,'full',0.00,10.00,1000.00,169);
INSERT INTO payments VALUES (170,2040.00,'Q1',20.00,20.00,2000.00,170);
INSERT INTO payments VALUES (172,1010.00,'full',0.00,10.00,1000.00,172);
INSERT INTO payments VALUES (173,2040.00,'Q1',20.00,20.00,2000.00,173);
INSERT INTO payments VALUES (175,1010.00,'full',0.00,10.00,1000.00,175);
INSERT INTO payments VALUES (176,2040.00,'Q1',20.00,20.00,2000.00,176);
INSERT INTO payments VALUES (178,1010.00,'full',0.00,10.00,1000.00,178);
INSERT INTO payments VALUES (179,2040.00,'Q1',20.00,20.00,2000.00,179);
INSERT INTO payments VALUES (181,1010.00,'full',0.00,10.00,1000.00,181);
INSERT INTO payments VALUES (182,2040.00,'Q1',20.00,20.00,2000.00,182);
INSERT INTO payments VALUES (184,1010.00,'full',0.00,10.00,1000.00,184);
INSERT INTO payments VALUES (185,2040.00,'Q1',20.00,20.00,2000.00,185);
INSERT INTO payments VALUES (187,1010.00,'full',0.00,10.00,1000.00,187);
INSERT INTO payments VALUES (188,2040.00,'Q1',20.00,20.00,2000.00,188);
INSERT INTO payments VALUES (190,1010.00,'full',0.00,10.00,1000.00,190);
INSERT INTO payments VALUES (191,2040.00,'Q1',20.00,20.00,2000.00,191);
INSERT INTO payments VALUES (193,1010.00,'full',0.00,10.00,1000.00,193);
INSERT INTO payments VALUES (194,2040.00,'Q1',20.00,20.00,2000.00,194);
INSERT INTO payments VALUES (196,1010.00,'full',0.00,10.00,1000.00,196);
INSERT INTO payments VALUES (197,2040.00,'Q1',20.00,20.00,2000.00,197);
INSERT INTO payments VALUES (199,1010.00,'full',0.00,10.00,1000.00,199);
INSERT INTO payments VALUES (200,2040.00,'Q1',20.00,20.00,2000.00,200);
INSERT INTO payments VALUES (202,1010.00,'full',0.00,10.00,1000.00,202);
INSERT INTO payments VALUES (203,2040.00,'Q1',20.00,20.00,2000.00,203);
INSERT INTO payments VALUES (205,1010.00,'full',0.00,10.00,1000.00,205);
INSERT INTO payments VALUES (206,2040.00,'Q1',20.00,20.00,2000.00,206);
INSERT INTO payments VALUES (208,1010.00,'full',0.00,10.00,1000.00,208);
INSERT INTO payments VALUES (209,2040.00,'Q1',20.00,20.00,2000.00,209);
INSERT INTO payments VALUES (211,1010.00,'full',0.00,10.00,1000.00,211);
INSERT INTO payments VALUES (212,2040.00,'Q1',20.00,20.00,2000.00,212);
INSERT INTO payments VALUES (214,1010.00,'full',0.00,10.00,1000.00,214);
INSERT INTO payments VALUES (215,2040.00,'Q1',20.00,20.00,2000.00,215);
INSERT INTO payments VALUES (217,1010.00,'full',0.00,10.00,1000.00,217);
INSERT INTO payments VALUES (218,2040.00,'Q1',20.00,20.00,2000.00,218);
INSERT INTO payments VALUES (220,1010.00,'full',0.00,10.00,1000.00,220);
INSERT INTO payments VALUES (221,2040.00,'Q1',20.00,20.00,2000.00,221);
INSERT INTO payments VALUES (223,1010.00,'full',0.00,10.00,1000.00,223);
INSERT INTO payments VALUES (224,2040.00,'Q1',20.00,20.00,2000.00,224);
INSERT INTO payments VALUES (226,1010.00,'full',0.00,10.00,1000.00,226);
INSERT INTO payments VALUES (227,2040.00,'Q1',20.00,20.00,2000.00,227);
INSERT INTO payments VALUES (229,1010.00,'full',0.00,10.00,1000.00,229);
INSERT INTO payments VALUES (230,2040.00,'Q1',20.00,20.00,2000.00,230);
INSERT INTO payments VALUES (232,1010.00,'full',0.00,10.00,1000.00,232);
INSERT INTO payments VALUES (233,2040.00,'Q1',20.00,20.00,2000.00,233);
INSERT INTO payments VALUES (235,1010.00,'full',0.00,10.00,1000.00,235);
INSERT INTO payments VALUES (236,2040.00,'Q1',20.00,20.00,2000.00,236);
INSERT INTO payments VALUES (238,1010.00,'full',0.00,10.00,1000.00,238);
INSERT INTO payments VALUES (239,2040.00,'Q1',20.00,20.00,2000.00,239);
INSERT INTO payments VALUES (241,1010.00,'full',0.00,10.00,1000.00,241);
INSERT INTO payments VALUES (242,2040.00,'Q1',20.00,20.00,2000.00,242);
INSERT INTO payments VALUES (244,1010.00,'full',0.00,10.00,1000.00,244);
INSERT INTO payments VALUES (245,2040.00,'Q1',20.00,20.00,2000.00,245);
INSERT INTO payments VALUES (247,1010.00,'full',0.00,10.00,1000.00,247);
INSERT INTO payments VALUES (248,2040.00,'Q1',20.00,20.00,2000.00,248);
INSERT INTO payments VALUES (250,1010.00,'full',0.00,10.00,1000.00,250);
INSERT INTO payments VALUES (251,2040.00,'Q1',20.00,20.00,2000.00,251);
INSERT INTO payments VALUES (253,1010.00,'full',0.00,10.00,1000.00,253);
INSERT INTO payments VALUES (254,2040.00,'Q1',20.00,20.00,2000.00,254);
INSERT INTO payments VALUES (256,1010.00,'full',0.00,10.00,1000.00,256);
INSERT INTO payments VALUES (257,2040.00,'Q1',20.00,20.00,2000.00,257);
INSERT INTO payments VALUES (259,1010.00,'full',0.00,10.00,1000.00,259);
INSERT INTO payments VALUES (260,2040.00,'Q1',20.00,20.00,2000.00,260);
INSERT INTO payments VALUES (262,1010.00,'full',0.00,10.00,1000.00,262);
INSERT INTO payments VALUES (263,2040.00,'Q1',20.00,20.00,2000.00,263);
INSERT INTO payments VALUES (265,1010.00,'full',0.00,10.00,1000.00,265);
INSERT INTO payments VALUES (266,2040.00,'Q1',20.00,20.00,2000.00,266);
INSERT INTO payments VALUES (268,1010.00,'full',0.00,10.00,1000.00,268);
INSERT INTO payments VALUES (269,2040.00,'Q1',20.00,20.00,2000.00,269);
INSERT INTO payments VALUES (271,1010.00,'full',0.00,10.00,1000.00,271);
INSERT INTO payments VALUES (272,2040.00,'Q1',20.00,20.00,2000.00,272);
INSERT INTO payments VALUES (274,1010.00,'full',0.00,10.00,1000.00,274);
INSERT INTO payments VALUES (275,2040.00,'Q1',20.00,20.00,2000.00,275);
INSERT INTO payments VALUES (277,1010.00,'full',0.00,10.00,1000.00,277);
INSERT INTO payments VALUES (278,2040.00,'Q1',20.00,20.00,2000.00,278);
INSERT INTO payments VALUES (280,1010.00,'full',0.00,10.00,1000.00,280);
INSERT INTO payments VALUES (281,2040.00,'Q1',20.00,20.00,2000.00,281);
INSERT INTO payments VALUES (283,1010.00,'full',0.00,10.00,1000.00,283);
INSERT INTO payments VALUES (284,2040.00,'Q1',20.00,20.00,2000.00,284);
INSERT INTO payments VALUES (286,1010.00,'full',0.00,10.00,1000.00,286);
INSERT INTO payments VALUES (287,2040.00,'Q1',20.00,20.00,2000.00,287);
INSERT INTO payments VALUES (289,1010.00,'full',0.00,10.00,1000.00,289);
INSERT INTO payments VALUES (290,2040.00,'Q1',20.00,20.00,2000.00,290);
INSERT INTO payments VALUES (292,1010.00,'full',0.00,10.00,1000.00,292);
INSERT INTO payments VALUES (293,2040.00,'Q1',20.00,20.00,2000.00,293);
INSERT INTO payments VALUES (295,1010.00,'full',0.00,10.00,1000.00,295);
INSERT INTO payments VALUES (296,2040.00,'Q1',20.00,20.00,2000.00,296);
INSERT INTO payments VALUES (298,1010.00,'full',0.00,10.00,1000.00,298);
INSERT INTO payments VALUES (299,2040.00,'Q1',20.00,20.00,2000.00,299);
INSERT INTO payments VALUES (301,1010.00,'full',0.00,10.00,1000.00,301);
INSERT INTO payments VALUES (302,2040.00,'Q1',20.00,20.00,2000.00,302);
INSERT INTO payments VALUES (304,1010.00,'full',0.00,10.00,1000.00,304);
INSERT INTO payments VALUES (305,2040.00,'Q1',20.00,20.00,2000.00,305);
INSERT INTO payments VALUES (307,1010.00,'full',0.00,10.00,1000.00,307);
INSERT INTO payments VALUES (308,2040.00,'Q1',20.00,20.00,2000.00,308);
INSERT INTO payments VALUES (310,1010.00,'full',0.00,10.00,1000.00,310);
INSERT INTO payments VALUES (311,2040.00,'Q1',20.00,20.00,2000.00,311);
INSERT INTO payments VALUES (313,1010.00,'full',0.00,10.00,1000.00,313);
INSERT INTO payments VALUES (314,2040.00,'Q1',20.00,20.00,2000.00,314);
INSERT INTO payments VALUES (316,1010.00,'full',0.00,10.00,1000.00,316);
INSERT INTO payments VALUES (317,2040.00,'Q1',20.00,20.00,2000.00,317);
INSERT INTO payments VALUES (319,1010.00,'full',0.00,10.00,1000.00,319);
INSERT INTO payments VALUES (320,2040.00,'Q1',20.00,20.00,2000.00,320);
INSERT INTO payments VALUES (322,1010.00,'full',0.00,10.00,1000.00,322);
INSERT INTO payments VALUES (323,2040.00,'Q1',20.00,20.00,2000.00,323);
INSERT INTO payments VALUES (325,1010.00,'full',0.00,10.00,1000.00,325);
INSERT INTO payments VALUES (326,2040.00,'Q1',20.00,20.00,2000.00,326);
INSERT INTO payments VALUES (328,1010.00,'full',0.00,10.00,1000.00,328);
INSERT INTO payments VALUES (329,2040.00,'Q1',20.00,20.00,2000.00,329);
INSERT INTO payments VALUES (331,1010.00,'full',0.00,10.00,1000.00,331);
INSERT INTO payments VALUES (332,2040.00,'Q1',20.00,20.00,2000.00,332);
INSERT INTO payments VALUES (334,1010.00,'full',0.00,10.00,1000.00,334);
INSERT INTO payments VALUES (335,2040.00,'Q1',20.00,20.00,2000.00,335);
INSERT INTO payments VALUES (337,1010.00,'full',0.00,10.00,1000.00,337);
INSERT INTO payments VALUES (338,2040.00,'Q1',20.00,20.00,2000.00,338);
INSERT INTO payments VALUES (340,1010.00,'full',0.00,10.00,1000.00,340);
INSERT INTO payments VALUES (341,2040.00,'Q1',20.00,20.00,2000.00,341);
INSERT INTO payments VALUES (343,1010.00,'full',0.00,10.00,1000.00,343);
INSERT INTO payments VALUES (344,2040.00,'Q1',20.00,20.00,2000.00,344);
INSERT INTO payments VALUES (346,1010.00,'full',0.00,10.00,1000.00,346);
INSERT INTO payments VALUES (347,2040.00,'Q1',20.00,20.00,2000.00,347);
INSERT INTO payments VALUES (349,1010.00,'full',0.00,10.00,1000.00,349);
INSERT INTO payments VALUES (350,2040.00,'Q1',20.00,20.00,2000.00,350);
INSERT INTO payments VALUES (352,1010.00,'full',0.00,10.00,1000.00,352);
INSERT INTO payments VALUES (353,2040.00,'Q1',20.00,20.00,2000.00,353);
INSERT INTO payments VALUES (355,1010.00,'full',0.00,10.00,1000.00,355);
INSERT INTO payments VALUES (356,2040.00,'Q1',20.00,20.00,2000.00,356);
INSERT INTO payments VALUES (358,1010.00,'full',0.00,10.00,1000.00,358);
INSERT INTO payments VALUES (359,2040.00,'Q1',20.00,20.00,2000.00,359);
INSERT INTO payments VALUES (361,1010.00,'full',0.00,10.00,1000.00,361);
INSERT INTO payments VALUES (362,2040.00,'Q1',20.00,20.00,2000.00,362);
INSERT INTO payments VALUES (364,1010.00,'full',0.00,10.00,1000.00,364);
INSERT INTO payments VALUES (365,2040.00,'Q1',20.00,20.00,2000.00,365);
INSERT INTO payments VALUES (367,1010.00,'full',0.00,10.00,1000.00,367);
INSERT INTO payments VALUES (368,2040.00,'Q1',20.00,20.00,2000.00,368);
INSERT INTO payments VALUES (370,1010.00,'full',0.00,10.00,1000.00,370);
INSERT INTO payments VALUES (371,2040.00,'Q1',20.00,20.00,2000.00,371);
INSERT INTO payments VALUES (373,1010.00,'full',0.00,10.00,1000.00,373);
INSERT INTO payments VALUES (374,2040.00,'Q1',20.00,20.00,2000.00,374);
INSERT INTO payments VALUES (376,1010.00,'full',0.00,10.00,1000.00,376);
INSERT INTO payments VALUES (377,2040.00,'Q1',20.00,20.00,2000.00,377);
INSERT INTO payments VALUES (379,1010.00,'full',0.00,10.00,1000.00,379);
INSERT INTO payments VALUES (380,2040.00,'Q1',20.00,20.00,2000.00,380);
INSERT INTO payments VALUES (382,1010.00,'full',0.00,10.00,1000.00,382);
INSERT INTO payments VALUES (383,2040.00,'Q1',20.00,20.00,2000.00,383);
INSERT INTO payments VALUES (385,1010.00,'full',0.00,10.00,1000.00,385);
INSERT INTO payments VALUES (386,2040.00,'Q1',20.00,20.00,2000.00,386);
INSERT INTO payments VALUES (388,1010.00,'full',0.00,10.00,1000.00,388);
INSERT INTO payments VALUES (389,2040.00,'Q1',20.00,20.00,2000.00,389);
INSERT INTO payments VALUES (391,1010.00,'full',0.00,10.00,1000.00,391);
INSERT INTO payments VALUES (392,2040.00,'Q1',20.00,20.00,2000.00,392);
INSERT INTO payments VALUES (394,1010.00,'full',0.00,10.00,1000.00,394);
INSERT INTO payments VALUES (395,2040.00,'Q1',20.00,20.00,2000.00,395);
INSERT INTO payments VALUES (397,1010.00,'full',0.00,10.00,1000.00,397);
INSERT INTO payments VALUES (398,2040.00,'Q1',20.00,20.00,2000.00,398);
INSERT INTO payments VALUES (400,1010.00,'full',0.00,10.00,1000.00,400);
INSERT INTO payments VALUES (401,2040.00,'Q1',20.00,20.00,2000.00,401);
INSERT INTO payments VALUES (403,1010.00,'full',0.00,10.00,1000.00,403);
INSERT INTO payments VALUES (404,2040.00,'Q1',20.00,20.00,2000.00,404);
INSERT INTO payments VALUES (406,1010.00,'full',0.00,10.00,1000.00,406);
INSERT INTO payments VALUES (407,2040.00,'Q1',20.00,20.00,2000.00,407);
INSERT INTO payments VALUES (409,1010.00,'full',0.00,10.00,1000.00,409);
INSERT INTO payments VALUES (410,2040.00,'Q1',20.00,20.00,2000.00,410);
INSERT INTO payments VALUES (412,1010.00,'full',0.00,10.00,1000.00,412);
INSERT INTO payments VALUES (413,2040.00,'Q1',20.00,20.00,2000.00,413);
INSERT INTO payments VALUES (415,1010.00,'full',0.00,10.00,1000.00,415);
INSERT INTO payments VALUES (416,2040.00,'Q1',20.00,20.00,2000.00,416);
INSERT INTO payments VALUES (418,1010.00,'full',0.00,10.00,1000.00,418);
INSERT INTO payments VALUES (419,2040.00,'Q1',20.00,20.00,2000.00,419);
INSERT INTO payments VALUES (421,1010.00,'full',0.00,10.00,1000.00,421);
INSERT INTO payments VALUES (422,2040.00,'Q1',20.00,20.00,2000.00,422);
INSERT INTO payments VALUES (424,1010.00,'full',0.00,10.00,1000.00,424);
INSERT INTO payments VALUES (425,2040.00,'Q1',20.00,20.00,2000.00,425);
INSERT INTO payments VALUES (427,1010.00,'full',0.00,10.00,1000.00,427);
INSERT INTO payments VALUES (428,2040.00,'Q1',20.00,20.00,2000.00,428);
INSERT INTO payments VALUES (430,1010.00,'full',0.00,10.00,1000.00,430);
INSERT INTO payments VALUES (431,2040.00,'Q1',20.00,20.00,2000.00,431);
INSERT INTO payments VALUES (433,1010.00,'full',0.00,10.00,1000.00,433);
INSERT INTO payments VALUES (434,2040.00,'Q1',20.00,20.00,2000.00,434);
INSERT INTO payments VALUES (436,1010.00,'full',0.00,10.00,1000.00,436);
INSERT INTO payments VALUES (437,2040.00,'Q1',20.00,20.00,2000.00,437);
INSERT INTO payments VALUES (439,1010.00,'full',0.00,10.00,1000.00,439);
INSERT INTO payments VALUES (440,2040.00,'Q1',20.00,20.00,2000.00,440);
INSERT INTO payments VALUES (442,1010.00,'full',0.00,10.00,1000.00,442);
INSERT INTO payments VALUES (443,2040.00,'Q1',20.00,20.00,2000.00,443);
INSERT INTO payments VALUES (445,1010.00,'full',0.00,10.00,1000.00,445);
INSERT INTO payments VALUES (446,2040.00,'Q1',20.00,20.00,2000.00,446);
INSERT INTO payments VALUES (448,1010.00,'full',0.00,10.00,1000.00,448);
INSERT INTO payments VALUES (449,2040.00,'Q1',20.00,20.00,2000.00,449);
INSERT INTO payments VALUES (451,1010.00,'full',0.00,10.00,1000.00,451);
INSERT INTO payments VALUES (452,2040.00,'Q1',20.00,20.00,2000.00,452);
INSERT INTO payments VALUES (454,1010.00,'full',0.00,10.00,1000.00,454);
INSERT INTO payments VALUES (455,2040.00,'Q1',20.00,20.00,2000.00,455);
INSERT INTO payments VALUES (457,1010.00,'full',0.00,10.00,1000.00,457);
INSERT INTO payments VALUES (458,2040.00,'Q1',20.00,20.00,2000.00,458);
INSERT INTO payments VALUES (460,1010.00,'full',0.00,10.00,1000.00,460);
INSERT INTO payments VALUES (461,2040.00,'Q1',20.00,20.00,2000.00,461);
INSERT INTO payments VALUES (463,1010.00,'full',0.00,10.00,1000.00,463);
INSERT INTO payments VALUES (464,2040.00,'Q1',20.00,20.00,2000.00,464);
INSERT INTO payments VALUES (466,1010.00,'full',0.00,10.00,1000.00,466);
INSERT INTO payments VALUES (467,2040.00,'Q1',20.00,20.00,2000.00,467);
INSERT INTO payments VALUES (469,1010.00,'full',0.00,10.00,1000.00,469);
INSERT INTO payments VALUES (470,2040.00,'Q1',20.00,20.00,2000.00,470);
INSERT INTO payments VALUES (472,1010.00,'full',0.00,10.00,1000.00,472);
INSERT INTO payments VALUES (473,2040.00,'Q1',20.00,20.00,2000.00,473);
INSERT INTO payments VALUES (475,1010.00,'full',0.00,10.00,1000.00,475);
INSERT INTO payments VALUES (476,2040.00,'Q1',20.00,20.00,2000.00,476);
INSERT INTO payments VALUES (478,1010.00,'full',0.00,10.00,1000.00,478);
INSERT INTO payments VALUES (479,2040.00,'Q1',20.00,20.00,2000.00,479);
INSERT INTO payments VALUES (481,1010.00,'full',0.00,10.00,1000.00,481);
INSERT INTO payments VALUES (482,2040.00,'Q1',20.00,20.00,2000.00,482);
INSERT INTO payments VALUES (484,1010.00,'full',0.00,10.00,1000.00,484);
INSERT INTO payments VALUES (485,2040.00,'Q1',20.00,20.00,2000.00,485);
INSERT INTO payments VALUES (487,1010.00,'full',0.00,10.00,1000.00,487);
INSERT INTO payments VALUES (488,2040.00,'Q1',20.00,20.00,2000.00,488);
INSERT INTO payments VALUES (490,1010.00,'full',0.00,10.00,1000.00,490);
INSERT INTO payments VALUES (491,2040.00,'Q1',20.00,20.00,2000.00,491);
INSERT INTO payments VALUES (493,1010.00,'full',0.00,10.00,1000.00,493);
INSERT INTO payments VALUES (494,2040.00,'Q1',20.00,20.00,2000.00,494);
INSERT INTO payments VALUES (496,1010.00,'full',0.00,10.00,1000.00,496);
INSERT INTO payments VALUES (497,2040.00,'Q1',20.00,20.00,2000.00,497);
INSERT INTO payments VALUES (499,1010.00,'full',0.00,10.00,1000.00,499);
INSERT INTO payments VALUES (500,2040.00,'Q1',20.00,20.00,2000.00,500);
INSERT INTO payments VALUES (502,1010.00,'full',0.00,10.00,1000.00,502);
INSERT INTO payments VALUES (503,2040.00,'Q1',20.00,20.00,2000.00,503);
INSERT INTO payments VALUES (505,1010.00,'full',0.00,10.00,1000.00,505);
INSERT INTO payments VALUES (506,2040.00,'Q1',20.00,20.00,2000.00,506);
INSERT INTO payments VALUES (508,1010.00,'full',0.00,10.00,1000.00,508);
INSERT INTO payments VALUES (509,2040.00,'Q1',20.00,20.00,2000.00,509);
INSERT INTO payments VALUES (511,1010.00,'full',0.00,10.00,1000.00,511);
INSERT INTO payments VALUES (512,1010.00,'full',0.00,10.00,1000.00,512);
INSERT INTO payments VALUES (513,2040.00,'Q1',20.00,20.00,2000.00,513);
INSERT INTO payments VALUES (514,2040.00,'Q1',20.00,20.00,2000.00,514);
INSERT INTO payments VALUES (517,1010.00,'full',0.00,10.00,1000.00,517);
INSERT INTO payments VALUES (518,2040.00,'Q1',20.00,20.00,2000.00,518);
INSERT INTO payments VALUES (520,1010.00,'full',0.00,10.00,1000.00,520);
INSERT INTO payments VALUES (521,2040.00,'Q1',20.00,20.00,2000.00,521);
INSERT INTO payments VALUES (523,1010.00,'full',0.00,10.00,1000.00,523);
INSERT INTO payments VALUES (524,2040.00,'Q1',20.00,20.00,2000.00,524);
INSERT INTO payments VALUES (526,1010.00,'full',0.00,10.00,1000.00,526);
INSERT INTO payments VALUES (527,2040.00,'Q1',20.00,20.00,2000.00,527);
INSERT INTO payments VALUES (529,1010.00,'full',0.00,10.00,1000.00,529);
INSERT INTO payments VALUES (530,2040.00,'Q1',20.00,20.00,2000.00,530);
INSERT INTO payments VALUES (532,1010.00,'full',0.00,10.00,1000.00,532);
INSERT INTO payments VALUES (533,2040.00,'Q1',20.00,20.00,2000.00,533);
INSERT INTO payments VALUES (535,1010.00,'full',0.00,10.00,1000.00,535);
INSERT INTO payments VALUES (536,2040.00,'Q1',20.00,20.00,2000.00,536);
INSERT INTO payments VALUES (538,1010.00,'full',0.00,10.00,1000.00,538);
INSERT INTO payments VALUES (539,2040.00,'Q1',20.00,20.00,2000.00,539);
INSERT INTO payments VALUES (541,1010.00,'full',0.00,10.00,1000.00,541);
INSERT INTO payments VALUES (542,2040.00,'Q1',20.00,20.00,2000.00,542);
INSERT INTO payments VALUES (544,1010.00,'full',0.00,10.00,1000.00,544);
INSERT INTO payments VALUES (545,2040.00,'Q1',20.00,20.00,2000.00,545);
INSERT INTO payments VALUES (547,1010.00,'full',0.00,10.00,1000.00,547);
INSERT INTO payments VALUES (548,2040.00,'Q1',20.00,20.00,2000.00,548);
INSERT INTO payments VALUES (550,1010.00,'full',0.00,10.00,1000.00,550);
INSERT INTO payments VALUES (551,2040.00,'Q1',20.00,20.00,2000.00,551);
INSERT INTO payments VALUES (553,1010.00,'full',0.00,10.00,1000.00,553);
INSERT INTO payments VALUES (554,2040.00,'Q1',20.00,20.00,2000.00,554);
INSERT INTO payments VALUES (556,1010.00,'full',0.00,10.00,1000.00,556);
INSERT INTO payments VALUES (557,2040.00,'Q1',20.00,20.00,2000.00,557);
INSERT INTO payments VALUES (559,1010.00,'full',0.00,10.00,1000.00,559);
INSERT INTO payments VALUES (560,2040.00,'Q1',20.00,20.00,2000.00,560);
INSERT INTO payments VALUES (562,1010.00,'full',0.00,10.00,1000.00,562);
INSERT INTO payments VALUES (563,2040.00,'Q1',20.00,20.00,2000.00,563);
INSERT INTO payments VALUES (565,1010.00,'full',0.00,10.00,1000.00,565);
INSERT INTO payments VALUES (566,2040.00,'Q1',20.00,20.00,2000.00,566);
INSERT INTO payments VALUES (568,1010.00,'full',0.00,10.00,1000.00,568);
INSERT INTO payments VALUES (569,2040.00,'Q1',20.00,20.00,2000.00,569);
INSERT INTO payments VALUES (571,1010.00,'full',0.00,10.00,1000.00,571);
INSERT INTO payments VALUES (572,2040.00,'Q1',20.00,20.00,2000.00,572);
INSERT INTO payments VALUES (574,1010.00,'full',0.00,10.00,1000.00,574);
INSERT INTO payments VALUES (575,2040.00,'Q1',20.00,20.00,2000.00,575);
INSERT INTO payments VALUES (577,1010.00,'full',0.00,10.00,1000.00,577);
INSERT INTO payments VALUES (578,2040.00,'Q1',20.00,20.00,2000.00,578);
INSERT INTO payments VALUES (580,1010.00,'full',0.00,10.00,1000.00,580);
INSERT INTO payments VALUES (581,2040.00,'Q1',20.00,20.00,2000.00,581);
INSERT INTO payments VALUES (583,1010.00,'full',0.00,10.00,1000.00,583);
INSERT INTO payments VALUES (584,2040.00,'Q1',20.00,20.00,2000.00,584);
INSERT INTO payments VALUES (586,1010.00,'full',0.00,10.00,1000.00,586);
INSERT INTO payments VALUES (587,2040.00,'Q1',20.00,20.00,2000.00,587);
INSERT INTO payments VALUES (589,1010.00,'full',0.00,10.00,1000.00,589);
INSERT INTO payments VALUES (590,2040.00,'Q1',20.00,20.00,2000.00,590);
INSERT INTO payments VALUES (592,1010.00,'full',0.00,10.00,1000.00,592);
INSERT INTO payments VALUES (593,2040.00,'Q1',20.00,20.00,2000.00,593);
INSERT INTO payments VALUES (595,1010.00,'full',0.00,10.00,1000.00,595);
INSERT INTO payments VALUES (596,2040.00,'Q1',20.00,20.00,2000.00,596);
INSERT INTO payments VALUES (598,1010.00,'full',0.00,10.00,1000.00,598);
INSERT INTO payments VALUES (599,2040.00,'Q1',20.00,20.00,2000.00,599);
INSERT INTO payments VALUES (601,1010.00,'full',0.00,10.00,1000.00,601);
INSERT INTO payments VALUES (602,2040.00,'Q1',20.00,20.00,2000.00,602);
INSERT INTO payments VALUES (604,1010.00,'full',0.00,10.00,1000.00,604);
INSERT INTO payments VALUES (605,2040.00,'Q1',20.00,20.00,2000.00,605);
INSERT INTO payments VALUES (607,1010.00,'full',0.00,10.00,1000.00,607);
INSERT INTO payments VALUES (608,2040.00,'Q1',20.00,20.00,2000.00,608);
INSERT INTO payments VALUES (610,1010.00,'full',0.00,10.00,1000.00,610);
INSERT INTO payments VALUES (611,2040.00,'Q1',20.00,20.00,2000.00,611);
INSERT INTO payments VALUES (613,1010.00,'full',0.00,10.00,1000.00,613);
INSERT INTO payments VALUES (614,2040.00,'Q1',20.00,20.00,2000.00,614);
INSERT INTO payments VALUES (616,1010.00,'full',0.00,10.00,1000.00,616);
INSERT INTO payments VALUES (617,2040.00,'Q1',20.00,20.00,2000.00,617);
INSERT INTO payments VALUES (619,1010.00,'full',0.00,10.00,1000.00,619);
INSERT INTO payments VALUES (620,2040.00,'Q1',20.00,20.00,2000.00,620);
INSERT INTO payments VALUES (622,1010.00,'full',0.00,10.00,1000.00,622);
INSERT INTO payments VALUES (623,2040.00,'Q1',20.00,20.00,2000.00,623);
INSERT INTO payments VALUES (625,1010.00,'full',0.00,10.00,1000.00,625);
INSERT INTO payments VALUES (626,2040.00,'Q1',20.00,20.00,2000.00,626);
INSERT INTO payments VALUES (628,1010.00,'full',0.00,10.00,1000.00,628);
INSERT INTO payments VALUES (629,2040.00,'Q1',20.00,20.00,2000.00,629);
INSERT INTO payments VALUES (631,1010.00,'full',0.00,10.00,1000.00,631);
INSERT INTO payments VALUES (632,2040.00,'Q1',20.00,20.00,2000.00,632);
INSERT INTO payments VALUES (634,1010.00,'full',0.00,10.00,1000.00,634);
INSERT INTO payments VALUES (635,2040.00,'Q1',20.00,20.00,2000.00,635);
INSERT INTO payments VALUES (637,1010.00,'full',0.00,10.00,1000.00,637);
INSERT INTO payments VALUES (638,2040.00,'Q1',20.00,20.00,2000.00,638);
INSERT INTO payments VALUES (640,1010.00,'full',0.00,10.00,1000.00,640);
INSERT INTO payments VALUES (641,2040.00,'Q1',20.00,20.00,2000.00,641);
INSERT INTO payments VALUES (643,1010.00,'full',0.00,10.00,1000.00,643);
INSERT INTO payments VALUES (644,2040.00,'Q1',20.00,20.00,2000.00,644);
INSERT INTO payments VALUES (646,1010.00,'full',0.00,10.00,1000.00,646);
INSERT INTO payments VALUES (647,2040.00,'Q1',20.00,20.00,2000.00,647);
INSERT INTO payments VALUES (649,1010.00,'full',0.00,10.00,1000.00,649);
INSERT INTO payments VALUES (650,2040.00,'Q1',20.00,20.00,2000.00,650);
INSERT INTO payments VALUES (652,1010.00,'full',0.00,10.00,1000.00,652);
INSERT INTO payments VALUES (653,2040.00,'Q1',20.00,20.00,2000.00,653);
INSERT INTO payments VALUES (655,1010.00,'full',0.00,10.00,1000.00,655);
INSERT INTO payments VALUES (656,2040.00,'Q1',20.00,20.00,2000.00,656);
INSERT INTO payments VALUES (658,1010.00,'full',0.00,10.00,1000.00,658);
INSERT INTO payments VALUES (659,2040.00,'Q1',20.00,20.00,2000.00,659);
INSERT INTO payments VALUES (661,1010.00,'full',0.00,10.00,1000.00,661);
INSERT INTO payments VALUES (662,2040.00,'Q1',20.00,20.00,2000.00,662);
INSERT INTO payments VALUES (664,1010.00,'full',0.00,10.00,1000.00,664);
INSERT INTO payments VALUES (665,2040.00,'Q1',20.00,20.00,2000.00,665);
INSERT INTO payments VALUES (667,1010.00,'full',0.00,10.00,1000.00,667);
INSERT INTO payments VALUES (668,2040.00,'Q1',20.00,20.00,2000.00,668);
INSERT INTO payments VALUES (670,1010.00,'full',0.00,10.00,1000.00,670);
INSERT INTO payments VALUES (671,2040.00,'Q1',20.00,20.00,2000.00,671);
INSERT INTO payments VALUES (673,1010.00,'full',0.00,10.00,1000.00,673);
INSERT INTO payments VALUES (674,2040.00,'Q1',20.00,20.00,2000.00,674);
INSERT INTO payments VALUES (676,1010.00,'full',0.00,10.00,1000.00,676);
INSERT INTO payments VALUES (677,2040.00,'Q1',20.00,20.00,2000.00,677);
INSERT INTO payments VALUES (679,1010.00,'full',0.00,10.00,1000.00,679);
INSERT INTO payments VALUES (680,2040.00,'Q1',20.00,20.00,2000.00,680);
INSERT INTO payments VALUES (682,1010.00,'full',0.00,10.00,1000.00,682);
INSERT INTO payments VALUES (683,2040.00,'Q1',20.00,20.00,2000.00,683);
INSERT INTO payments VALUES (685,1010.00,'full',0.00,10.00,1000.00,685);
INSERT INTO payments VALUES (686,2040.00,'Q1',20.00,20.00,2000.00,686);
INSERT INTO payments VALUES (688,1010.00,'full',0.00,10.00,1000.00,688);
INSERT INTO payments VALUES (689,2040.00,'Q1',20.00,20.00,2000.00,689);
INSERT INTO payments VALUES (691,1010.00,'full',0.00,10.00,1000.00,691);
INSERT INTO payments VALUES (692,2040.00,'Q1',20.00,20.00,2000.00,692);
INSERT INTO payments VALUES (694,1010.00,'full',0.00,10.00,1000.00,694);
INSERT INTO payments VALUES (695,2040.00,'Q1',20.00,20.00,2000.00,695);
INSERT INTO payments VALUES (697,1010.00,'full',0.00,10.00,1000.00,697);
INSERT INTO payments VALUES (698,2040.00,'Q1',20.00,20.00,2000.00,698);
INSERT INTO payments VALUES (700,1010.00,'full',0.00,10.00,1000.00,700);
INSERT INTO payments VALUES (701,2040.00,'Q1',20.00,20.00,2000.00,701);
INSERT INTO payments VALUES (703,1010.00,'full',0.00,10.00,1000.00,703);
INSERT INTO payments VALUES (704,2040.00,'Q1',20.00,20.00,2000.00,704);
INSERT INTO payments VALUES (706,1010.00,'full',0.00,10.00,1000.00,706);
INSERT INTO payments VALUES (707,1010.00,'full',0.00,10.00,1000.00,707);
INSERT INTO payments VALUES (708,1010.00,'full',0.00,10.00,1000.00,708);
INSERT INTO payments VALUES (709,1010.00,'full',0.00,10.00,1000.00,709);
INSERT INTO payments VALUES (710,1010.00,'full',0.00,10.00,1000.00,710);
INSERT INTO payments VALUES (711,2040.00,'Q1',20.00,20.00,2000.00,711);
INSERT INTO payments VALUES (712,2040.00,'Q1',20.00,20.00,2000.00,712);
INSERT INTO payments VALUES (713,2040.00,'Q1',20.00,20.00,2000.00,713);
INSERT INTO payments VALUES (714,2040.00,'Q1',20.00,20.00,2000.00,714);
INSERT INTO payments VALUES (715,2040.00,'Q1',20.00,20.00,2000.00,715);
INSERT INTO payments VALUES (721,1010.00,'full',0.00,10.00,1000.00,721);
INSERT INTO payments VALUES (722,1010.00,'full',0.00,10.00,1000.00,722);
INSERT INTO payments VALUES (723,1010.00,'full',0.00,10.00,1000.00,723);
INSERT INTO payments VALUES (724,1010.00,'full',0.00,10.00,1000.00,724);
INSERT INTO payments VALUES (725,1010.00,'full',0.00,10.00,1000.00,725);
INSERT INTO payments VALUES (726,2040.00,'Q1',20.00,20.00,2000.00,726);
INSERT INTO payments VALUES (727,2040.00,'Q1',20.00,20.00,2000.00,727);
INSERT INTO payments VALUES (728,2040.00,'Q1',20.00,20.00,2000.00,728);
INSERT INTO payments VALUES (729,2040.00,'Q1',20.00,20.00,2000.00,729);
INSERT INTO payments VALUES (730,2040.00,'Q1',20.00,20.00,2000.00,730);
INSERT INTO payments VALUES (732,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (733,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (736,1010.00,'full',0.00,10.00,1000.00,736);
INSERT INTO payments VALUES (737,1010.00,'full',0.00,10.00,1000.00,737);
INSERT INTO payments VALUES (738,1010.00,'full',0.00,10.00,1000.00,738);
INSERT INTO payments VALUES (739,1010.00,'full',0.00,10.00,1000.00,739);
INSERT INTO payments VALUES (740,1010.00,'full',0.00,10.00,1000.00,740);
INSERT INTO payments VALUES (741,2040.00,'Q1',20.00,20.00,2000.00,741);
INSERT INTO payments VALUES (742,2040.00,'Q1',20.00,20.00,2000.00,742);
INSERT INTO payments VALUES (743,2040.00,'Q1',20.00,20.00,2000.00,743);
INSERT INTO payments VALUES (744,2040.00,'Q1',20.00,20.00,2000.00,744);
INSERT INTO payments VALUES (745,2040.00,'Q1',20.00,20.00,2000.00,745);
INSERT INTO payments VALUES (751,1010.00,'full',0.00,10.00,1000.00,751);
INSERT INTO payments VALUES (752,1010.00,'full',0.00,10.00,1000.00,752);
INSERT INTO payments VALUES (753,1010.00,'full',0.00,10.00,1000.00,753);
INSERT INTO payments VALUES (754,1010.00,'full',0.00,10.00,1000.00,754);
INSERT INTO payments VALUES (755,2040.00,'Q1',20.00,20.00,2000.00,755);
INSERT INTO payments VALUES (756,1010.00,'full',0.00,10.00,1000.00,756);
INSERT INTO payments VALUES (757,2040.00,'Q1',20.00,20.00,2000.00,757);
INSERT INTO payments VALUES (758,2040.00,'Q1',20.00,20.00,2000.00,758);
INSERT INTO payments VALUES (759,2040.00,'Q1',20.00,20.00,2000.00,759);
INSERT INTO payments VALUES (761,2040.00,'Q1',20.00,20.00,2000.00,761);
INSERT INTO payments VALUES (766,1010.00,'full',0.00,10.00,1000.00,766);
INSERT INTO payments VALUES (767,1010.00,'full',0.00,10.00,1000.00,767);
INSERT INTO payments VALUES (768,1010.00,'full',0.00,10.00,1000.00,768);
INSERT INTO payments VALUES (769,2040.00,'Q1',20.00,20.00,2000.00,769);
INSERT INTO payments VALUES (770,1010.00,'full',0.00,10.00,1000.00,770);
INSERT INTO payments VALUES (771,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (772,2040.00,'Q1',20.00,20.00,2000.00,772);
INSERT INTO payments VALUES (773,2040.00,'Q1',20.00,20.00,2000.00,773);
INSERT INTO payments VALUES (775,1010.00,'full',0.00,10.00,1000.00,775);
INSERT INTO payments VALUES (776,2040.00,'Q1',20.00,20.00,2000.00,776);
INSERT INTO payments VALUES (779,2040.00,'Q1',20.00,20.00,2000.00,779);
INSERT INTO payments VALUES (781,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (783,1010.00,'full',0.00,10.00,1000.00,783);
INSERT INTO payments VALUES (784,1010.00,'full',0.00,10.00,1000.00,784);
INSERT INTO payments VALUES (785,1010.00,'full',0.00,10.00,1000.00,785);
INSERT INTO payments VALUES (786,1010.00,'full',0.00,10.00,1000.00,786);
INSERT INTO payments VALUES (787,2040.00,'Q1',20.00,20.00,2000.00,787);
INSERT INTO payments VALUES (788,2040.00,'Q1',20.00,20.00,2000.00,788);
INSERT INTO payments VALUES (789,1010.00,'full',0.00,10.00,1000.00,789);
INSERT INTO payments VALUES (790,2040.00,'Q1',20.00,20.00,2000.00,790);
INSERT INTO payments VALUES (791,2040.00,'Q1',20.00,20.00,2000.00,791);
INSERT INTO payments VALUES (794,2040.00,'Q1',20.00,20.00,2000.00,794);
INSERT INTO payments VALUES (796,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (798,1010.00,'full',0.00,10.00,1000.00,798);
INSERT INTO payments VALUES (799,1010.00,'full',0.00,10.00,1000.00,799);
INSERT INTO payments VALUES (800,1010.00,'full',0.00,10.00,1000.00,800);
INSERT INTO payments VALUES (801,1010.00,'full',0.00,10.00,1000.00,801);
INSERT INTO payments VALUES (802,2040.00,'Q1',20.00,20.00,2000.00,802);
INSERT INTO payments VALUES (803,2040.00,'Q1',20.00,20.00,2000.00,803);
INSERT INTO payments VALUES (804,1010.00,'full',0.00,10.00,1000.00,804);
INSERT INTO payments VALUES (805,2040.00,'Q1',20.00,20.00,2000.00,805);
INSERT INTO payments VALUES (806,2040.00,'Q1',20.00,20.00,2000.00,806);
INSERT INTO payments VALUES (809,2040.00,'Q1',20.00,20.00,2000.00,809);
INSERT INTO payments VALUES (811,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (813,1010.00,'full',0.00,10.00,1000.00,813);
INSERT INTO payments VALUES (814,1010.00,'full',0.00,10.00,1000.00,814);
INSERT INTO payments VALUES (815,1010.00,'full',0.00,10.00,1000.00,815);
INSERT INTO payments VALUES (816,1010.00,'full',0.00,10.00,1000.00,816);
INSERT INTO payments VALUES (817,2040.00,'Q1',20.00,20.00,2000.00,817);
INSERT INTO payments VALUES (818,2040.00,'Q1',20.00,20.00,2000.00,818);
INSERT INTO payments VALUES (819,1010.00,'full',0.00,10.00,1000.00,819);
INSERT INTO payments VALUES (820,2040.00,'Q1',20.00,20.00,2000.00,820);
INSERT INTO payments VALUES (821,2040.00,'Q1',20.00,20.00,2000.00,821);
INSERT INTO payments VALUES (824,2040.00,'Q1',20.00,20.00,2000.00,824);
INSERT INTO payments VALUES (826,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (828,1010.00,'full',0.00,10.00,1000.00,828);
INSERT INTO payments VALUES (829,1010.00,'full',0.00,10.00,1000.00,829);
INSERT INTO payments VALUES (830,1010.00,'full',0.00,10.00,1000.00,830);
INSERT INTO payments VALUES (831,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (832,2040.00,'Q1',20.00,20.00,2000.00,832);
INSERT INTO payments VALUES (833,2040.00,'Q1',20.00,20.00,2000.00,833);
INSERT INTO payments VALUES (834,1010.00,'full',0.00,10.00,1000.00,834);
INSERT INTO payments VALUES (835,1010.00,'full',0.00,10.00,1000.00,835);
INSERT INTO payments VALUES (836,2040.00,'Q1',20.00,20.00,2000.00,836);
INSERT INTO payments VALUES (837,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (839,2040.00,'Q1',20.00,20.00,2000.00,839);
INSERT INTO payments VALUES (840,2040.00,'Q1',20.00,20.00,2000.00,840);
INSERT INTO payments VALUES (841,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (844,1010.00,'full',0.00,10.00,1000.00,844);
INSERT INTO payments VALUES (845,1010.00,'full',0.00,10.00,1000.00,845);
INSERT INTO payments VALUES (847,2040.00,'Q1',20.00,20.00,2000.00,847);
INSERT INTO payments VALUES (848,1010.00,'full',0.00,10.00,1000.00,848);
INSERT INTO payments VALUES (849,2040.00,'Q1',20.00,20.00,2000.00,849);
INSERT INTO payments VALUES (850,1010.00,'full',0.00,10.00,1000.00,850);
INSERT INTO payments VALUES (852,2040.00,'Q1',20.00,20.00,2000.00,852);
INSERT INTO payments VALUES (853,1010.00,'full',0.00,10.00,1000.00,853);
INSERT INTO payments VALUES (855,2040.00,'Q1',20.00,20.00,2000.00,855);
INSERT INTO payments VALUES (857,2040.00,'Q1',20.00,20.00,2000.00,857);
INSERT INTO payments VALUES (858,1010.00,'full',0.00,10.00,1000.00,858);
INSERT INTO payments VALUES (860,1010.00,'full',0.00,10.00,1000.00,860);
INSERT INTO payments VALUES (862,2040.00,'Q1',20.00,20.00,2000.00,862);
INSERT INTO payments VALUES (863,1010.00,'full',0.00,10.00,1000.00,863);
INSERT INTO payments VALUES (864,2040.00,'Q1',20.00,20.00,2000.00,864);
INSERT INTO payments VALUES (865,1010.00,'full',0.00,10.00,1000.00,865);
INSERT INTO payments VALUES (867,2040.00,'Q1',20.00,20.00,2000.00,867);
INSERT INTO payments VALUES (868,1010.00,'full',0.00,10.00,1000.00,868);
INSERT INTO payments VALUES (870,2040.00,'Q1',20.00,20.00,2000.00,870);
INSERT INTO payments VALUES (872,2040.00,'Q1',20.00,20.00,2000.00,872);
INSERT INTO payments VALUES (873,1010.00,'full',0.00,10.00,1000.00,873);
INSERT INTO payments VALUES (875,1010.00,'full',0.00,10.00,1000.00,875);
INSERT INTO payments VALUES (877,2040.00,'Q1',20.00,20.00,2000.00,877);
INSERT INTO payments VALUES (878,1010.00,'full',0.00,10.00,1000.00,878);
INSERT INTO payments VALUES (879,2040.00,'Q1',20.00,20.00,2000.00,879);
INSERT INTO payments VALUES (880,1010.00,'full',0.00,10.00,1000.00,880);
INSERT INTO payments VALUES (882,2040.00,'Q1',20.00,20.00,2000.00,882);
INSERT INTO payments VALUES (883,1010.00,'full',0.00,10.00,1000.00,883);
INSERT INTO payments VALUES (885,2040.00,'Q1',20.00,20.00,2000.00,885);
INSERT INTO payments VALUES (887,2040.00,'Q1',20.00,20.00,2000.00,887);
INSERT INTO payments VALUES (888,1010.00,'full',0.00,10.00,1000.00,888);
INSERT INTO payments VALUES (890,1010.00,'full',0.00,10.00,1000.00,890);
INSERT INTO payments VALUES (892,2040.00,'Q1',20.00,20.00,2000.00,892);
INSERT INTO payments VALUES (893,1010.00,'full',0.00,10.00,1000.00,893);
INSERT INTO payments VALUES (894,2040.00,'Q1',20.00,20.00,2000.00,894);
INSERT INTO payments VALUES (895,1010.00,'full',0.00,10.00,1000.00,895);
INSERT INTO payments VALUES (897,2040.00,'Q1',20.00,20.00,2000.00,897);
INSERT INTO payments VALUES (898,1010.00,'full',0.00,10.00,1000.00,898);
INSERT INTO payments VALUES (900,2040.00,'Q1',20.00,20.00,2000.00,900);
INSERT INTO payments VALUES (902,2040.00,'Q1',20.00,20.00,2000.00,902);
INSERT INTO payments VALUES (903,1010.00,'full',0.00,10.00,1000.00,903);
INSERT INTO payments VALUES (904,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (905,1010.00,'full',0.00,10.00,1000.00,905);
INSERT INTO payments VALUES (907,1010.00,'full',0.00,10.00,1000.00,907);
INSERT INTO payments VALUES (908,1010.00,'full',0.00,10.00,1000.00,908);
INSERT INTO payments VALUES (909,2040.00,'Q1',20.00,20.00,2000.00,909);
INSERT INTO payments VALUES (910,2040.00,'Q1',20.00,20.00,2000.00,910);
INSERT INTO payments VALUES (911,2040.00,'Q1',20.00,20.00,2000.00,911);
INSERT INTO payments VALUES (912,2040.00,'Q1',20.00,20.00,2000.00,912);
INSERT INTO payments VALUES (913,1010.00,'full',0.00,10.00,1000.00,913);
INSERT INTO payments VALUES (918,2040.00,'Q1',20.00,20.00,2000.00,918);
INSERT INTO payments VALUES (919,1010.00,'full',0.00,10.00,1000.00,919);
INSERT INTO payments VALUES (920,1010.00,'full',0.00,10.00,1000.00,920);
INSERT INTO payments VALUES (922,1010.00,'full',0.00,10.00,1000.00,922);
INSERT INTO payments VALUES (923,1010.00,'full',0.00,10.00,1000.00,923);
INSERT INTO payments VALUES (924,2040.00,'Q1',20.00,20.00,2000.00,924);
INSERT INTO payments VALUES (925,2040.00,'Q1',20.00,20.00,2000.00,925);
INSERT INTO payments VALUES (926,2040.00,'Q1',20.00,20.00,2000.00,926);
INSERT INTO payments VALUES (927,2040.00,'Q1',20.00,20.00,2000.00,927);
INSERT INTO payments VALUES (928,1010.00,'full',0.00,10.00,1000.00,928);
INSERT INTO payments VALUES (933,2040.00,'Q1',20.00,20.00,2000.00,933);
INSERT INTO payments VALUES (934,1010.00,'full',0.00,10.00,1000.00,934);
INSERT INTO payments VALUES (935,1010.00,'full',0.00,10.00,1000.00,935);
INSERT INTO payments VALUES (937,1010.00,'full',0.00,10.00,1000.00,937);
INSERT INTO payments VALUES (938,1010.00,'full',0.00,10.00,1000.00,938);
INSERT INTO payments VALUES (939,2040.00,'Q1',20.00,20.00,2000.00,939);
INSERT INTO payments VALUES (940,2040.00,'Q1',20.00,20.00,2000.00,940);
INSERT INTO payments VALUES (941,2040.00,'Q1',20.00,20.00,2000.00,941);
INSERT INTO payments VALUES (942,2040.00,'Q1',20.00,20.00,2000.00,942);
INSERT INTO payments VALUES (943,1010.00,'full',0.00,10.00,1000.00,943);
INSERT INTO payments VALUES (948,2040.00,'Q1',20.00,20.00,2000.00,948);
INSERT INTO payments VALUES (949,1010.00,'full',0.00,10.00,1000.00,949);
INSERT INTO payments VALUES (950,1010.00,'full',0.00,10.00,1000.00,950);
INSERT INTO payments VALUES (952,1010.00,'full',0.00,10.00,1000.00,952);
INSERT INTO payments VALUES (953,1010.00,'full',0.00,10.00,1000.00,953);
INSERT INTO payments VALUES (954,2040.00,'Q1',20.00,20.00,2000.00,954);
INSERT INTO payments VALUES (955,2040.00,'Q1',20.00,20.00,2000.00,955);
INSERT INTO payments VALUES (956,2040.00,'Q1',20.00,20.00,2000.00,956);
INSERT INTO payments VALUES (957,2040.00,'Q1',20.00,20.00,2000.00,957);
INSERT INTO payments VALUES (958,1010.00,'full',0.00,10.00,1000.00,958);
INSERT INTO payments VALUES (963,2040.00,'Q1',20.00,20.00,2000.00,963);
INSERT INTO payments VALUES (964,1010.00,'full',0.00,10.00,1000.00,964);
INSERT INTO payments VALUES (965,1010.00,'full',0.00,10.00,1000.00,965);
INSERT INTO payments VALUES (967,1010.00,'full',0.00,10.00,1000.00,967);
INSERT INTO payments VALUES (968,1010.00,'full',0.00,10.00,1000.00,968);
INSERT INTO payments VALUES (969,2040.00,'Q1',20.00,20.00,2000.00,969);
INSERT INTO payments VALUES (970,2040.00,'Q1',20.00,20.00,2000.00,970);
INSERT INTO payments VALUES (971,2040.00,'Q1',20.00,20.00,2000.00,971);
INSERT INTO payments VALUES (972,2040.00,'Q1',20.00,20.00,2000.00,972);
INSERT INTO payments VALUES (973,1010.00,'full',0.00,10.00,1000.00,973);
INSERT INTO payments VALUES (978,2040.00,'Q1',20.00,20.00,2000.00,978);
INSERT INTO payments VALUES (979,1010.00,'full',0.00,10.00,1000.00,979);
INSERT INTO payments VALUES (980,1010.00,'full',0.00,10.00,1000.00,980);
INSERT INTO payments VALUES (982,1010.00,'full',0.00,10.00,1000.00,982);
INSERT INTO payments VALUES (983,1010.00,'full',0.00,10.00,1000.00,983);
INSERT INTO payments VALUES (984,2040.00,'Q1',20.00,20.00,2000.00,984);
INSERT INTO payments VALUES (985,2040.00,'Q1',20.00,20.00,2000.00,985);
INSERT INTO payments VALUES (986,2040.00,'Q1',20.00,20.00,2000.00,986);
INSERT INTO payments VALUES (987,2040.00,'Q1',20.00,20.00,2000.00,987);
INSERT INTO payments VALUES (988,1010.00,'full',0.00,10.00,1000.00,988);
INSERT INTO payments VALUES (993,2040.00,'Q1',20.00,20.00,2000.00,993);
INSERT INTO payments VALUES (994,1010.00,'full',0.00,10.00,1000.00,994);
INSERT INTO payments VALUES (995,1010.00,'full',0.00,10.00,1000.00,995);
INSERT INTO payments VALUES (997,1010.00,'full',0.00,10.00,1000.00,997);
INSERT INTO payments VALUES (998,1010.00,'full',0.00,10.00,1000.00,998);
INSERT INTO payments VALUES (999,2040.00,'Q1',20.00,20.00,2000.00,999);
INSERT INTO payments VALUES (1000,2040.00,'Q1',20.00,20.00,2000.00,1000);
INSERT INTO payments VALUES (1001,2040.00,'Q1',20.00,20.00,2000.00,1001);
INSERT INTO payments VALUES (1002,2040.00,'Q1',20.00,20.00,2000.00,1002);
INSERT INTO payments VALUES (1003,1010.00,'full',0.00,10.00,1000.00,1003);
INSERT INTO payments VALUES (1008,2040.00,'Q1',20.00,20.00,2000.00,1008);
INSERT INTO payments VALUES (1009,1010.00,'full',0.00,10.00,1000.00,1009);
INSERT INTO payments VALUES (1010,1010.00,'full',0.00,10.00,1000.00,1010);
INSERT INTO payments VALUES (1012,1010.00,'full',0.00,10.00,1000.00,1012);
INSERT INTO payments VALUES (1013,1010.00,'full',0.00,10.00,1000.00,1013);
INSERT INTO payments VALUES (1014,2040.00,'Q1',20.00,20.00,2000.00,1014);
INSERT INTO payments VALUES (1015,2040.00,'Q1',20.00,20.00,2000.00,1015);
INSERT INTO payments VALUES (1016,2040.00,'Q1',20.00,20.00,2000.00,1016);
INSERT INTO payments VALUES (1017,2040.00,'Q1',20.00,20.00,2000.00,1017);
INSERT INTO payments VALUES (1018,1010.00,'full',0.00,10.00,1000.00,1018);
INSERT INTO payments VALUES (1023,2040.00,'Q1',20.00,20.00,2000.00,1023);
INSERT INTO payments VALUES (1024,1010.00,'full',0.00,10.00,1000.00,1024);
INSERT INTO payments VALUES (1025,1010.00,'full',0.00,10.00,1000.00,1025);
INSERT INTO payments VALUES (1027,1010.00,'full',0.00,10.00,1000.00,1027);
INSERT INTO payments VALUES (1028,1010.00,'full',0.00,10.00,1000.00,1028);
INSERT INTO payments VALUES (1029,2040.00,'Q1',20.00,20.00,2000.00,1029);
INSERT INTO payments VALUES (1030,2040.00,'Q1',20.00,20.00,2000.00,1030);
INSERT INTO payments VALUES (1031,2040.00,'Q1',20.00,20.00,2000.00,1031);
INSERT INTO payments VALUES (1032,2040.00,'Q1',20.00,20.00,2000.00,1032);
INSERT INTO payments VALUES (1033,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (1037,1010.00,'full',0.00,10.00,1000.00,1037);
INSERT INTO payments VALUES (1039,1010.00,'full',0.00,10.00,1000.00,1039);
INSERT INTO payments VALUES (1040,2040.00,'Q1',20.00,20.00,2000.00,1040);
INSERT INTO payments VALUES (1041,1010.00,'full',0.00,10.00,1000.00,1041);
INSERT INTO payments VALUES (1042,1010.00,'full',0.00,10.00,1000.00,1042);
INSERT INTO payments VALUES (1043,1010.00,'full',0.00,10.00,1000.00,1043);
INSERT INTO payments VALUES (1044,2040.00,'Q1',20.00,20.00,2000.00,1044);
INSERT INTO payments VALUES (1046,2040.00,'Q1',20.00,20.00,2000.00,1046);
INSERT INTO payments VALUES (1047,2040.00,'Q1',20.00,20.00,2000.00,1047);
INSERT INTO payments VALUES (1048,2040.00,'Q1',20.00,20.00,2000.00,1048);
INSERT INTO payments VALUES (1052,1010.00,'full',0.00,10.00,1000.00,1052);
INSERT INTO payments VALUES (1054,1010.00,'full',0.00,10.00,1000.00,1054);
INSERT INTO payments VALUES (1055,2040.00,'Q1',20.00,20.00,2000.00,1055);
INSERT INTO payments VALUES (1056,1010.00,'full',0.00,10.00,1000.00,1056);
INSERT INTO payments VALUES (1057,1010.00,'full',0.00,10.00,1000.00,1057);
INSERT INTO payments VALUES (1058,1010.00,'full',0.00,10.00,1000.00,1058);
INSERT INTO payments VALUES (1059,2040.00,'Q1',20.00,20.00,2000.00,1059);
INSERT INTO payments VALUES (1061,2040.00,'Q1',20.00,20.00,2000.00,1061);
INSERT INTO payments VALUES (1062,2040.00,'Q1',20.00,20.00,2000.00,1062);
INSERT INTO payments VALUES (1063,2040.00,'Q1',20.00,20.00,2000.00,1063);
INSERT INTO payments VALUES (1067,1010.00,'full',0.00,10.00,1000.00,1067);
INSERT INTO payments VALUES (1069,1010.00,'full',0.00,10.00,1000.00,1069);
INSERT INTO payments VALUES (1070,2040.00,'Q1',20.00,20.00,2000.00,1070);
INSERT INTO payments VALUES (1071,1010.00,'full',0.00,10.00,1000.00,1071);
INSERT INTO payments VALUES (1072,1010.00,'full',0.00,10.00,1000.00,1072);
INSERT INTO payments VALUES (1073,1010.00,'full',0.00,10.00,1000.00,1073);
INSERT INTO payments VALUES (1074,2040.00,'Q1',20.00,20.00,2000.00,1074);
INSERT INTO payments VALUES (1076,2040.00,'Q1',20.00,20.00,2000.00,1076);
INSERT INTO payments VALUES (1077,2040.00,'Q1',20.00,20.00,2000.00,1077);
INSERT INTO payments VALUES (1078,2040.00,'Q1',20.00,20.00,2000.00,1078);
INSERT INTO payments VALUES (1082,1010.00,'full',0.00,10.00,1000.00,1082);
INSERT INTO payments VALUES (1084,1010.00,'full',0.00,10.00,1000.00,1084);
INSERT INTO payments VALUES (1085,2040.00,'Q1',20.00,20.00,2000.00,1085);
INSERT INTO payments VALUES (1086,1010.00,'full',0.00,10.00,1000.00,1086);
INSERT INTO payments VALUES (1087,1010.00,'full',0.00,10.00,1000.00,1087);
INSERT INTO payments VALUES (1088,1010.00,'full',0.00,10.00,1000.00,1088);
INSERT INTO payments VALUES (1089,2040.00,'Q1',20.00,20.00,2000.00,1089);
INSERT INTO payments VALUES (1091,2040.00,'Q1',20.00,20.00,2000.00,1091);
INSERT INTO payments VALUES (1092,2040.00,'Q1',20.00,20.00,2000.00,1092);
INSERT INTO payments VALUES (1093,2040.00,'Q1',20.00,20.00,2000.00,1093);
INSERT INTO payments VALUES (1097,1010.00,'full',0.00,10.00,1000.00,1097);
INSERT INTO payments VALUES (1099,1010.00,'full',0.00,10.00,1000.00,1099);
INSERT INTO payments VALUES (1100,1010.00,'full',0.00,10.00,1000.00,1100);
INSERT INTO payments VALUES (1101,2040.00,'Q1',20.00,20.00,2000.00,1101);
INSERT INTO payments VALUES (1102,1010.00,'full',0.00,10.00,1000.00,1102);
INSERT INTO payments VALUES (1103,1010.00,'full',0.00,10.00,1000.00,1103);
INSERT INTO payments VALUES (1104,2040.00,'Q1',20.00,20.00,2000.00,1104);
INSERT INTO payments VALUES (1105,2040.00,'Q1',20.00,20.00,2000.00,1105);
INSERT INTO payments VALUES (1107,2040.00,'Q1',20.00,20.00,2000.00,1107);
INSERT INTO payments VALUES (1108,2040.00,'Q1',20.00,20.00,2000.00,1108);
INSERT INTO payments VALUES (1113,1010.00,'full',0.00,10.00,1000.00,1113);
INSERT INTO payments VALUES (1114,1010.00,'full',0.00,10.00,1000.00,1114);
INSERT INTO payments VALUES (1115,1010.00,'full',0.00,10.00,1000.00,1115);
INSERT INTO payments VALUES (1116,2040.00,'Q1',20.00,20.00,2000.00,1116);
INSERT INTO payments VALUES (1117,1010.00,'full',0.00,10.00,1000.00,1117);
INSERT INTO payments VALUES (1118,1010.00,'full',0.00,10.00,1000.00,1118);
INSERT INTO payments VALUES (1119,2040.00,'Q1',20.00,20.00,2000.00,1119);
INSERT INTO payments VALUES (1120,2040.00,'Q1',20.00,20.00,2000.00,1120);
INSERT INTO payments VALUES (1122,2040.00,'Q1',20.00,20.00,2000.00,1122);
INSERT INTO payments VALUES (1123,2040.00,'Q1',20.00,20.00,2000.00,1123);
INSERT INTO payments VALUES (1128,1010.00,'full',0.00,10.00,1000.00,1128);
INSERT INTO payments VALUES (1129,1010.00,'full',0.00,10.00,1000.00,1129);
INSERT INTO payments VALUES (1130,1010.00,'full',0.00,10.00,1000.00,1130);
INSERT INTO payments VALUES (1131,2040.00,'Q1',20.00,20.00,2000.00,1131);
INSERT INTO payments VALUES (1132,1010.00,'full',0.00,10.00,1000.00,1132);
INSERT INTO payments VALUES (1133,1010.00,'full',0.00,10.00,1000.00,1133);
INSERT INTO payments VALUES (1134,2040.00,'Q1',20.00,20.00,2000.00,1134);
INSERT INTO payments VALUES (1135,2040.00,'Q1',20.00,20.00,2000.00,1135);
INSERT INTO payments VALUES (1137,2040.00,'Q1',20.00,20.00,2000.00,1137);
INSERT INTO payments VALUES (1138,2040.00,'Q1',20.00,20.00,2000.00,1138);
INSERT INTO payments VALUES (1143,1010.00,'full',0.00,10.00,1000.00,1143);
INSERT INTO payments VALUES (1144,1010.00,'full',0.00,10.00,1000.00,1144);
INSERT INTO payments VALUES (1145,1010.00,'full',0.00,10.00,1000.00,1145);
INSERT INTO payments VALUES (1146,2040.00,'Q1',20.00,20.00,2000.00,1146);
INSERT INTO payments VALUES (1147,1010.00,'full',0.00,10.00,1000.00,1147);
INSERT INTO payments VALUES (1148,1010.00,'full',0.00,10.00,1000.00,1148);
INSERT INTO payments VALUES (1149,2040.00,'Q1',20.00,20.00,2000.00,1149);
INSERT INTO payments VALUES (1150,2040.00,'Q1',20.00,20.00,2000.00,1150);
INSERT INTO payments VALUES (1152,2040.00,'Q1',20.00,20.00,2000.00,1152);
INSERT INTO payments VALUES (1153,2040.00,'Q1',20.00,20.00,2000.00,1153);
INSERT INTO payments VALUES (1158,1010.00,'full',0.00,10.00,1000.00,1158);
INSERT INTO payments VALUES (1159,1010.00,'full',0.00,10.00,1000.00,1159);
INSERT INTO payments VALUES (1160,1010.00,'full',0.00,10.00,1000.00,1160);
INSERT INTO payments VALUES (1161,2040.00,'Q1',20.00,20.00,2000.00,1161);
INSERT INTO payments VALUES (1162,1010.00,'full',0.00,10.00,1000.00,1162);
INSERT INTO payments VALUES (1163,1010.00,'full',0.00,10.00,1000.00,1163);
INSERT INTO payments VALUES (1164,2040.00,'Q1',20.00,20.00,2000.00,1164);
INSERT INTO payments VALUES (1165,2040.00,'Q1',20.00,20.00,2000.00,1165);
INSERT INTO payments VALUES (1166,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (1167,2040.00,'Q1',20.00,20.00,2000.00,1167);
INSERT INTO payments VALUES (1168,2040.00,'Q1',20.00,20.00,2000.00,1168);
INSERT INTO payments VALUES (1170,1010.00,'full',0.00,10.00,1000.00,1170);
INSERT INTO payments VALUES (1174,2040.00,'Q1',20.00,20.00,2000.00,1174);
INSERT INTO payments VALUES (1175,1010.00,'full',0.00,10.00,1000.00,1175);
INSERT INTO payments VALUES (1176,1010.00,'full',0.00,10.00,1000.00,1176);
INSERT INTO payments VALUES (1178,1010.00,'full',0.00,10.00,1000.00,1178);
INSERT INTO payments VALUES (1179,2040.00,'Q1',20.00,20.00,2000.00,1179);
INSERT INTO payments VALUES (1180,1010.00,'full',0.00,10.00,1000.00,1180);
INSERT INTO payments VALUES (1181,2040.00,'Q1',20.00,20.00,2000.00,1181);
INSERT INTO payments VALUES (1182,2040.00,'Q1',20.00,20.00,2000.00,1182);
INSERT INTO payments VALUES (1184,1010.00,'full',0.00,10.00,1000.00,1184);
INSERT INTO payments VALUES (1185,2040.00,'Q1',20.00,20.00,2000.00,1185);
INSERT INTO payments VALUES (1188,2040.00,'Q1',20.00,20.00,2000.00,1188);
INSERT INTO payments VALUES (1190,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (1192,1010.00,'full',0.00,10.00,1000.00,1192);
INSERT INTO payments VALUES (1193,1010.00,'full',0.00,10.00,1000.00,1193);
INSERT INTO payments VALUES (1194,1010.00,'full',0.00,10.00,1000.00,1194);
INSERT INTO payments VALUES (1195,1010.00,'full',0.00,10.00,1000.00,1195);
INSERT INTO payments VALUES (1196,2040.00,'Q1',20.00,20.00,2000.00,1196);
INSERT INTO payments VALUES (1197,2040.00,'Q1',20.00,20.00,2000.00,1197);
INSERT INTO payments VALUES (1198,1010.00,'full',0.00,10.00,1000.00,1198);
INSERT INTO payments VALUES (1199,2040.00,'Q1',20.00,20.00,2000.00,1199);
INSERT INTO payments VALUES (1200,2040.00,'Q1',20.00,20.00,2000.00,1200);
INSERT INTO payments VALUES (1203,2040.00,'Q1',20.00,20.00,2000.00,1203);
INSERT INTO payments VALUES (1205,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (1207,1010.00,'full',0.00,10.00,1000.00,1207);
INSERT INTO payments VALUES (1208,1010.00,'full',0.00,10.00,1000.00,1208);
INSERT INTO payments VALUES (1209,1010.00,'full',0.00,10.00,1000.00,1209);
INSERT INTO payments VALUES (1210,1010.00,'full',0.00,10.00,1000.00,1210);
INSERT INTO payments VALUES (1211,2040.00,'Q1',20.00,20.00,2000.00,1211);
INSERT INTO payments VALUES (1212,2040.00,'Q1',20.00,20.00,2000.00,1212);
INSERT INTO payments VALUES (1213,1010.00,'full',0.00,10.00,1000.00,1213);
INSERT INTO payments VALUES (1214,2040.00,'Q1',20.00,20.00,2000.00,1214);
INSERT INTO payments VALUES (1215,2040.00,'Q1',20.00,20.00,2000.00,1215);
INSERT INTO payments VALUES (1218,2040.00,'Q1',20.00,20.00,2000.00,1218);
INSERT INTO payments VALUES (1220,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (1222,1010.00,'full',0.00,10.00,1000.00,1222);
INSERT INTO payments VALUES (1223,1010.00,'full',0.00,10.00,1000.00,1223);
INSERT INTO payments VALUES (1224,1010.00,'full',0.00,10.00,1000.00,1224);
INSERT INTO payments VALUES (1225,1010.00,'full',0.00,10.00,1000.00,1225);
INSERT INTO payments VALUES (1226,2040.00,'Q1',20.00,20.00,2000.00,1226);
INSERT INTO payments VALUES (1227,2040.00,'Q1',20.00,20.00,2000.00,1227);
INSERT INTO payments VALUES (1228,1010.00,'full',0.00,10.00,1000.00,1228);
INSERT INTO payments VALUES (1229,2040.00,'Q1',20.00,20.00,2000.00,1229);
INSERT INTO payments VALUES (1230,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (1233,2040.00,'Q1',20.00,20.00,2000.00,1233);
INSERT INTO payments VALUES (1234,1010.00,'full',0.00,10.00,1000.00,1234);
INSERT INTO payments VALUES (1237,1010.00,'full',0.00,10.00,1000.00,1237);
INSERT INTO payments VALUES (1238,2040.00,'Q1',20.00,20.00,2000.00,1238);
INSERT INTO payments VALUES (1239,1010.00,'full',0.00,10.00,1000.00,1239);
INSERT INTO payments VALUES (1240,2040.00,'Q1',20.00,20.00,2000.00,1240);
INSERT INTO payments VALUES (1241,1010.00,'full',0.00,10.00,1000.00,1241);
INSERT INTO payments VALUES (1243,1010.00,'full',0.00,10.00,1000.00,1243);
INSERT INTO payments VALUES (1244,2040.00,'Q1',20.00,20.00,2000.00,1244);
INSERT INTO payments VALUES (1246,2040.00,'Q1',20.00,20.00,2000.00,1246);
INSERT INTO payments VALUES (1247,2040.00,'Q1',20.00,20.00,2000.00,1247);
INSERT INTO payments VALUES (1249,1010.00,'full',0.00,10.00,1000.00,1249);
INSERT INTO payments VALUES (1252,1010.00,'full',0.00,10.00,1000.00,1252);
INSERT INTO payments VALUES (1253,2040.00,'Q1',20.00,20.00,2000.00,1253);
INSERT INTO payments VALUES (1254,1010.00,'full',0.00,10.00,1000.00,1254);
INSERT INTO payments VALUES (1255,2040.00,'Q1',20.00,20.00,2000.00,1255);
INSERT INTO payments VALUES (1256,1010.00,'full',0.00,10.00,1000.00,1256);
INSERT INTO payments VALUES (1258,1010.00,'full',0.00,10.00,1000.00,1258);
INSERT INTO payments VALUES (1259,2040.00,'Q1',20.00,20.00,2000.00,1259);
INSERT INTO payments VALUES (1261,2040.00,'Q1',20.00,20.00,2000.00,1261);
INSERT INTO payments VALUES (1262,2040.00,'Q1',20.00,20.00,2000.00,1262);
INSERT INTO payments VALUES (1264,1010.00,'full',0.00,10.00,1000.00,1264);
INSERT INTO payments VALUES (1267,1010.00,'full',0.00,10.00,1000.00,1267);
INSERT INTO payments VALUES (1268,2040.00,'Q1',20.00,20.00,2000.00,1268);
INSERT INTO payments VALUES (1269,1010.00,'full',0.00,10.00,1000.00,1269);
INSERT INTO payments VALUES (1270,2040.00,'Q1',20.00,20.00,2000.00,1270);
INSERT INTO payments VALUES (1271,1010.00,'full',0.00,10.00,1000.00,1271);
INSERT INTO payments VALUES (1273,1010.00,'full',0.00,10.00,1000.00,1273);
INSERT INTO payments VALUES (1274,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (1276,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (1277,1010.00,'full',0.00,10.00,1000.00,1277);
INSERT INTO payments VALUES (1278,2040.00,'Q1',20.00,20.00,2000.00,1278);
INSERT INTO payments VALUES (1279,1010.00,'full',0.00,10.00,1000.00,1279);
INSERT INTO payments VALUES (1280,1010.00,'full',0.00,10.00,1000.00,1280);
INSERT INTO payments VALUES (1281,1010.00,'full',0.00,10.00,1000.00,1281);
INSERT INTO payments VALUES (1282,2040.00,'Q1',20.00,20.00,2000.00,1282);
INSERT INTO payments VALUES (1284,2040.00,'Q1',20.00,20.00,2000.00,1284);
INSERT INTO payments VALUES (1285,2040.00,'Q1',20.00,20.00,2000.00,1285);
INSERT INTO payments VALUES (1286,2040.00,'Q1',20.00,20.00,2000.00,1286);
INSERT INTO payments VALUES (1290,1010.00,'full',0.00,10.00,1000.00,1290);
INSERT INTO payments VALUES (1292,1010.00,'full',0.00,10.00,1000.00,1292);
INSERT INTO payments VALUES (1293,2040.00,'Q1',20.00,20.00,2000.00,1293);
INSERT INTO payments VALUES (1294,1010.00,'full',0.00,10.00,1000.00,1294);
INSERT INTO payments VALUES (1295,1010.00,'full',0.00,10.00,1000.00,1295);
INSERT INTO payments VALUES (1296,1010.00,'full',0.00,10.00,1000.00,1296);
INSERT INTO payments VALUES (1297,2040.00,'Q1',20.00,20.00,2000.00,1297);
INSERT INTO payments VALUES (1299,2040.00,'Q1',20.00,20.00,2000.00,1299);
INSERT INTO payments VALUES (1300,2040.00,'Q1',20.00,20.00,2000.00,1300);
INSERT INTO payments VALUES (1301,2040.00,'Q1',20.00,20.00,2000.00,1301);
INSERT INTO payments VALUES (1305,1010.00,'full',0.00,10.00,1000.00,1305);
INSERT INTO payments VALUES (1307,1010.00,'full',0.00,10.00,1000.00,1307);
INSERT INTO payments VALUES (1308,2040.00,'Q1',20.00,20.00,2000.00,1308);
INSERT INTO payments VALUES (1309,1010.00,'full',0.00,10.00,1000.00,1309);
INSERT INTO payments VALUES (1310,1010.00,'full',0.00,10.00,1000.00,1310);
INSERT INTO payments VALUES (1311,1010.00,'full',0.00,10.00,1000.00,1311);
INSERT INTO payments VALUES (1312,2040.00,'Q1',20.00,20.00,2000.00,1312);
INSERT INTO payments VALUES (1314,2040.00,'Q1',20.00,20.00,2000.00,1314);
INSERT INTO payments VALUES (1315,2040.00,'Q1',20.00,20.00,2000.00,1315);
INSERT INTO payments VALUES (1316,2040.00,'Q1',20.00,20.00,2000.00,1316);
INSERT INTO payments VALUES (1320,1010.00,'full',0.00,10.00,1000.00,1320);
INSERT INTO payments VALUES (1322,1010.00,'full',0.00,10.00,1000.00,1322);
INSERT INTO payments VALUES (1323,2040.00,'Q1',20.00,20.00,2000.00,1323);
INSERT INTO payments VALUES (1324,1010.00,'full',0.00,10.00,1000.00,1324);
INSERT INTO payments VALUES (1325,1010.00,'full',0.00,10.00,1000.00,1325);
INSERT INTO payments VALUES (1326,1010.00,'full',0.00,10.00,1000.00,1326);
INSERT INTO payments VALUES (1327,2040.00,'Q1',20.00,20.00,2000.00,1327);
INSERT INTO payments VALUES (1329,2040.00,'Q1',20.00,20.00,2000.00,1329);
INSERT INTO payments VALUES (1330,2040.00,'Q1',20.00,20.00,2000.00,1330);
INSERT INTO payments VALUES (1331,2040.00,'Q1',20.00,20.00,2000.00,1331);
INSERT INTO payments VALUES (1335,1010.00,'full',0.00,10.00,1000.00,1335);
INSERT INTO payments VALUES (1337,1010.00,'full',0.00,10.00,1000.00,1337);
INSERT INTO payments VALUES (1338,2040.00,'Q1',20.00,20.00,2000.00,1338);
INSERT INTO payments VALUES (1339,1010.00,'full',0.00,10.00,1000.00,1339);
INSERT INTO payments VALUES (1340,1010.00,'full',0.00,10.00,1000.00,1340);
INSERT INTO payments VALUES (1341,1010.00,'full',0.00,10.00,1000.00,1341);
INSERT INTO payments VALUES (1342,2040.00,'Q1',20.00,20.00,2000.00,1342);
INSERT INTO payments VALUES (1344,2040.00,'Q1',20.00,20.00,2000.00,1344);
INSERT INTO payments VALUES (1345,2040.00,'Q1',20.00,20.00,2000.00,1345);
INSERT INTO payments VALUES (1346,2040.00,'Q1',20.00,20.00,2000.00,1346);
INSERT INTO payments VALUES (1350,1010.00,'full',0.00,10.00,1000.00,1350);
INSERT INTO payments VALUES (1352,1010.00,'full',0.00,10.00,1000.00,1352);
INSERT INTO payments VALUES (1353,2040.00,'Q1',20.00,20.00,2000.00,1353);
INSERT INTO payments VALUES (1354,1010.00,'full',0.00,10.00,1000.00,1354);
INSERT INTO payments VALUES (1355,1010.00,'full',0.00,10.00,1000.00,1355);
INSERT INTO payments VALUES (1356,1010.00,'full',0.00,10.00,1000.00,1356);
INSERT INTO payments VALUES (1357,2040.00,'Q1',20.00,20.00,2000.00,1357);
INSERT INTO payments VALUES (1359,2040.00,'Q1',20.00,20.00,2000.00,1359);
INSERT INTO payments VALUES (1360,2040.00,'Q1',20.00,20.00,2000.00,1360);
INSERT INTO payments VALUES (1361,2040.00,'Q1',20.00,20.00,2000.00,1361);
INSERT INTO payments VALUES (1363,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (1365,1010.00,'full',0.00,10.00,1000.00,1365);
INSERT INTO payments VALUES (1367,1010.00,'full',0.00,10.00,1000.00,1367);
INSERT INTO payments VALUES (1368,2040.00,'Q1',20.00,20.00,2000.00,1368);
INSERT INTO payments VALUES (1369,2040.00,'Q1',20.00,20.00,2000.00,1369);
INSERT INTO payments VALUES (1372,1010.00,'full',0.00,10.00,1000.00,1372);
INSERT INTO payments VALUES (1373,2040.00,'Q1',20.00,20.00,2000.00,1373);
INSERT INTO payments VALUES (1375,1010.00,'full',0.00,10.00,1000.00,1375);
INSERT INTO payments VALUES (1376,2040.00,'Q1',20.00,20.00,2000.00,1376);
INSERT INTO payments VALUES (1378,1010.00,'full',0.00,10.00,1000.00,1378);
INSERT INTO payments VALUES (1379,2040.00,'Q1',20.00,20.00,2000.00,1379);
INSERT INTO payments VALUES (1381,1010.00,'full',0.00,10.00,1000.00,1381);
INSERT INTO payments VALUES (1382,2040.00,'Q1',20.00,20.00,2000.00,1382);
INSERT INTO payments VALUES (1384,1010.00,'full',0.00,10.00,1000.00,1384);
INSERT INTO payments VALUES (1385,2040.00,'Q1',20.00,20.00,2000.00,1385);
INSERT INTO payments VALUES (1387,1010.00,'full',0.00,10.00,1000.00,1387);
INSERT INTO payments VALUES (1388,2040.00,'Q1',20.00,20.00,2000.00,1388);
INSERT INTO payments VALUES (1390,1010.00,'full',0.00,10.00,1000.00,1390);
INSERT INTO payments VALUES (1391,1010.00,'full',0.00,10.00,1000.00,1391);
INSERT INTO payments VALUES (1392,1010.00,'full',0.00,10.00,1000.00,1392);
INSERT INTO payments VALUES (1393,1010.00,'full',0.00,10.00,1000.00,1393);
INSERT INTO payments VALUES (1394,1010.00,'full',0.00,10.00,1000.00,1394);
INSERT INTO payments VALUES (1395,2040.00,'Q1',20.00,20.00,2000.00,1395);
INSERT INTO payments VALUES (1396,2040.00,'Q1',20.00,20.00,2000.00,1396);
INSERT INTO payments VALUES (1397,2040.00,'Q1',20.00,20.00,2000.00,1397);
INSERT INTO payments VALUES (1398,2040.00,'Q1',20.00,20.00,2000.00,1398);
INSERT INTO payments VALUES (1399,2040.00,'Q1',20.00,20.00,2000.00,1399);
INSERT INTO payments VALUES (1405,1010.00,'full',0.00,10.00,1000.00,1405);
INSERT INTO payments VALUES (1406,1010.00,'full',0.00,10.00,1000.00,1406);
INSERT INTO payments VALUES (1407,1010.00,'full',0.00,10.00,1000.00,1407);
INSERT INTO payments VALUES (1408,1010.00,'full',0.00,10.00,1000.00,1408);
INSERT INTO payments VALUES (1409,1010.00,'full',0.00,10.00,1000.00,1409);
INSERT INTO payments VALUES (1410,2040.00,'Q1',20.00,20.00,2000.00,1410);
INSERT INTO payments VALUES (1411,2040.00,'Q1',20.00,20.00,2000.00,1411);
INSERT INTO payments VALUES (1412,2040.00,'Q1',20.00,20.00,2000.00,1412);
INSERT INTO payments VALUES (1413,2040.00,'Q1',20.00,20.00,2000.00,1413);
INSERT INTO payments VALUES (1414,2040.00,'Q1',20.00,20.00,2000.00,1414);
INSERT INTO payments VALUES (1420,1010.00,'full',0.00,10.00,1000.00,1420);
INSERT INTO payments VALUES (1421,1010.00,'full',0.00,10.00,1000.00,1421);
INSERT INTO payments VALUES (1422,1010.00,'full',0.00,10.00,1000.00,1422);
INSERT INTO payments VALUES (1423,1010.00,'full',0.00,10.00,1000.00,1423);
INSERT INTO payments VALUES (1424,1010.00,'full',0.00,10.00,1000.00,1424);
INSERT INTO payments VALUES (1425,2040.00,'Q1',20.00,20.00,2000.00,1425);
INSERT INTO payments VALUES (1426,2040.00,'Q1',20.00,20.00,2000.00,1426);
INSERT INTO payments VALUES (1427,2040.00,'Q1',20.00,20.00,2000.00,1427);
INSERT INTO payments VALUES (1428,2040.00,'Q1',20.00,20.00,2000.00,1428);
INSERT INTO payments VALUES (1429,2040.00,'Q1',20.00,20.00,2000.00,1429);
INSERT INTO payments VALUES (1435,1010.00,'full',0.00,10.00,1000.00,1435);
INSERT INTO payments VALUES (1436,1010.00,'full',0.00,10.00,1000.00,1436);
INSERT INTO payments VALUES (1437,1010.00,'full',0.00,10.00,1000.00,1437);
INSERT INTO payments VALUES (1438,1010.00,'full',0.00,10.00,1000.00,1438);
INSERT INTO payments VALUES (1439,1010.00,'full',0.00,10.00,1000.00,1439);
INSERT INTO payments VALUES (1440,2040.00,'Q1',20.00,20.00,2000.00,1440);
INSERT INTO payments VALUES (1441,2040.00,'Q1',20.00,20.00,2000.00,1441);
INSERT INTO payments VALUES (1442,2040.00,'Q1',20.00,20.00,2000.00,1442);
INSERT INTO payments VALUES (1443,2040.00,'Q1',20.00,20.00,2000.00,1443);
INSERT INTO payments VALUES (1444,2040.00,'Q1',20.00,20.00,2000.00,1444);
INSERT INTO payments VALUES (1450,1010.00,'full',0.00,10.00,1000.00,1450);
INSERT INTO payments VALUES (1451,1010.00,'full',0.00,10.00,1000.00,1451);
INSERT INTO payments VALUES (1452,1010.00,'full',0.00,10.00,1000.00,1452);
INSERT INTO payments VALUES (1453,1010.00,'full',0.00,10.00,1000.00,1453);
INSERT INTO payments VALUES (1454,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (1455,2040.00,'Q1',20.00,20.00,2000.00,1455);
INSERT INTO payments VALUES (1456,2040.00,'Q1',20.00,20.00,2000.00,1456);
INSERT INTO payments VALUES (1457,2040.00,'Q1',20.00,20.00,2000.00,1457);
INSERT INTO payments VALUES (1458,1010.00,'full',0.00,10.00,1000.00,1458);
INSERT INTO payments VALUES (1459,2040.00,'Q1',20.00,20.00,2000.00,1459);
INSERT INTO payments VALUES (1463,2040.00,'Q1',20.00,20.00,2000.00,1463);
INSERT INTO payments VALUES (1465,1010.00,'full',0.00,10.00,1000.00,1465);
INSERT INTO payments VALUES (1467,1010.00,'full',0.00,10.00,1000.00,1467);
INSERT INTO payments VALUES (1468,1010.00,'full',0.00,10.00,1000.00,1468);
INSERT INTO payments VALUES (1469,1010.00,'full',0.00,10.00,1000.00,1469);
INSERT INTO payments VALUES (1470,2040.00,'Q1',20.00,20.00,2000.00,1470);
INSERT INTO payments VALUES (1471,2040.00,'Q1',20.00,20.00,2000.00,1471);
INSERT INTO payments VALUES (1472,2040.00,'Q1',20.00,20.00,2000.00,1472);
INSERT INTO payments VALUES (1473,1010.00,'full',0.00,10.00,1000.00,1473);
INSERT INTO payments VALUES (1474,2040.00,'Q1',20.00,20.00,2000.00,1474);
INSERT INTO payments VALUES (1478,2040.00,'Q1',20.00,20.00,2000.00,1478);
INSERT INTO payments VALUES (1480,1010.00,'full',0.00,10.00,1000.00,1480);
INSERT INTO payments VALUES (1482,1010.00,'full',0.00,10.00,1000.00,1482);
INSERT INTO payments VALUES (1483,1010.00,'full',0.00,10.00,1000.00,1483);
INSERT INTO payments VALUES (1484,1010.00,'full',0.00,10.00,1000.00,1484);
INSERT INTO payments VALUES (1485,2040.00,'Q1',20.00,20.00,2000.00,1485);
INSERT INTO payments VALUES (1486,2040.00,'Q1',20.00,20.00,2000.00,1486);
INSERT INTO payments VALUES (1487,2040.00,'Q1',20.00,20.00,2000.00,1487);
INSERT INTO payments VALUES (1488,1010.00,'full',0.00,10.00,1000.00,1488);
INSERT INTO payments VALUES (1489,2040.00,'Q1',20.00,20.00,2000.00,1489);
INSERT INTO payments VALUES (1493,2040.00,'Q1',20.00,20.00,2000.00,1493);
INSERT INTO payments VALUES (1495,1010.00,'full',0.00,10.00,1000.00,1495);
INSERT INTO payments VALUES (1497,1010.00,'full',0.00,10.00,1000.00,1497);
INSERT INTO payments VALUES (1498,1010.00,'full',0.00,10.00,1000.00,1498);
INSERT INTO payments VALUES (1499,1010.00,'full',0.00,10.00,1000.00,1499);
INSERT INTO payments VALUES (1500,2040.00,'Q1',20.00,20.00,2000.00,1500);
INSERT INTO payments VALUES (1501,2040.00,'Q1',20.00,20.00,2000.00,1501);
INSERT INTO payments VALUES (1502,2040.00,'Q1',20.00,20.00,2000.00,1502);
INSERT INTO payments VALUES (1503,1010.00,'full',0.00,10.00,1000.00,1503);
INSERT INTO payments VALUES (1504,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (1508,1010.00,'full',0.00,10.00,1000.00,1508);
INSERT INTO payments VALUES (1509,2040.00,'Q1',20.00,20.00,2000.00,1509);
INSERT INTO payments VALUES (1510,1010.00,'full',0.00,10.00,1000.00,1510);
INSERT INTO payments VALUES (1511,2040.00,'Q1',20.00,20.00,2000.00,1511);
INSERT INTO payments VALUES (1512,1010.00,'full',0.00,10.00,1000.00,1512);
INSERT INTO payments VALUES (1514,1010.00,'full',0.00,10.00,1000.00,1514);
INSERT INTO payments VALUES (1515,2040.00,'Q1',20.00,20.00,2000.00,1515);
INSERT INTO payments VALUES (1517,2040.00,'Q1',20.00,20.00,2000.00,1517);
INSERT INTO payments VALUES (1518,2040.00,'Q1',20.00,20.00,2000.00,1518);
INSERT INTO payments VALUES (1520,1010.00,'full',0.00,10.00,1000.00,1520);
INSERT INTO payments VALUES (1523,1010.00,'full',0.00,10.00,1000.00,1523);
INSERT INTO payments VALUES (1524,2040.00,'Q1',20.00,20.00,2000.00,1524);
INSERT INTO payments VALUES (1525,1010.00,'full',0.00,10.00,1000.00,1525);
INSERT INTO payments VALUES (1526,2040.00,'Q1',20.00,20.00,2000.00,1526);
INSERT INTO payments VALUES (1527,1010.00,'full',0.00,10.00,1000.00,1527);
INSERT INTO payments VALUES (1529,1010.00,'full',0.00,10.00,1000.00,1529);
INSERT INTO payments VALUES (1530,2040.00,'Q1',20.00,20.00,2000.00,1530);
INSERT INTO payments VALUES (1532,2040.00,'Q1',20.00,20.00,2000.00,1532);
INSERT INTO payments VALUES (1533,2040.00,'Q1',20.00,20.00,2000.00,1533);
INSERT INTO payments VALUES (1535,1010.00,'full',0.00,10.00,1000.00,1535);
INSERT INTO payments VALUES (1538,1010.00,'full',0.00,10.00,1000.00,1538);
INSERT INTO payments VALUES (1539,2040.00,'Q1',20.00,20.00,2000.00,1539);
INSERT INTO payments VALUES (1540,1010.00,'full',0.00,10.00,1000.00,1540);
INSERT INTO payments VALUES (1541,2040.00,'Q1',20.00,20.00,2000.00,1541);
INSERT INTO payments VALUES (1542,1010.00,'full',0.00,10.00,1000.00,1542);
INSERT INTO payments VALUES (1544,1010.00,'full',0.00,10.00,1000.00,1544);
INSERT INTO payments VALUES (1545,2040.00,'Q1',20.00,20.00,2000.00,1545);
INSERT INTO payments VALUES (1547,2040.00,'Q1',20.00,20.00,2000.00,1547);
INSERT INTO payments VALUES (1548,2040.00,'Q1',20.00,20.00,2000.00,1548);
INSERT INTO payments VALUES (1550,1010.00,'full',0.00,10.00,1000.00,1550);
INSERT INTO payments VALUES (1553,1010.00,'full',0.00,10.00,1000.00,1553);
INSERT INTO payments VALUES (1554,2040.00,'Q1',20.00,20.00,2000.00,1554);
INSERT INTO payments VALUES (1555,1010.00,'full',0.00,10.00,1000.00,1555);
INSERT INTO payments VALUES (1556,2040.00,'Q1',20.00,20.00,2000.00,1556);
INSERT INTO payments VALUES (1557,1010.00,'full',0.00,10.00,1000.00,1557);
INSERT INTO payments VALUES (1559,1010.00,'full',0.00,10.00,1000.00,1559);
INSERT INTO payments VALUES (1560,2040.00,'Q1',20.00,20.00,2000.00,1560);
INSERT INTO payments VALUES (1562,2040.00,'Q1',20.00,20.00,2000.00,1562);
INSERT INTO payments VALUES (1563,2040.00,'Q1',20.00,20.00,2000.00,1563);
INSERT INTO payments VALUES (1565,1010.00,'full',0.00,10.00,1000.00,1565);
INSERT INTO payments VALUES (1566,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (1568,1010.00,'full',0.00,10.00,1000.00,1568);
INSERT INTO payments VALUES (1569,1010.00,'full',0.00,10.00,1000.00,1569);
INSERT INTO payments VALUES (1570,2040.00,'Q1',20.00,20.00,2000.00,1570);
INSERT INTO payments VALUES (1571,1010.00,'full',0.00,10.00,1000.00,1571);
INSERT INTO payments VALUES (1572,2040.00,'Q1',20.00,20.00,2000.00,1572);
INSERT INTO payments VALUES (1573,2040.00,'Q1',20.00,20.00,2000.00,1573);
INSERT INTO payments VALUES (1574,1010.00,'full',0.00,10.00,1000.00,1574);
INSERT INTO payments VALUES (1576,2040.00,'Q1',20.00,20.00,2000.00,1576);
INSERT INTO payments VALUES (1579,2040.00,'Q1',20.00,20.00,2000.00,1579);
INSERT INTO payments VALUES (1581,1010.00,'full',0.00,10.00,1000.00,1581);
INSERT INTO payments VALUES (1583,1010.00,'full',0.00,10.00,1000.00,1583);
INSERT INTO payments VALUES (1584,2040.00,'Q1',20.00,20.00,2000.00,1584);
INSERT INTO payments VALUES (1585,1010.00,'full',0.00,10.00,1000.00,1585);
INSERT INTO payments VALUES (1586,1010.00,'full',0.00,10.00,1000.00,1586);
INSERT INTO payments VALUES (1587,2040.00,'Q1',20.00,20.00,2000.00,1587);
INSERT INTO payments VALUES (1589,1010.00,'full',0.00,10.00,1000.00,1589);
INSERT INTO payments VALUES (1590,2040.00,'Q1',20.00,20.00,2000.00,1590);
INSERT INTO payments VALUES (1591,2040.00,'Q1',20.00,20.00,2000.00,1591);
INSERT INTO payments VALUES (1593,2040.00,'Q1',20.00,20.00,2000.00,1593);
INSERT INTO payments VALUES (1595,1010.00,'full',0.00,10.00,1000.00,1595);
INSERT INTO payments VALUES (1598,1010.00,'full',0.00,10.00,1000.00,1598);
INSERT INTO payments VALUES (1599,2040.00,'Q1',20.00,20.00,2000.00,1599);
INSERT INTO payments VALUES (1600,1010.00,'full',0.00,10.00,1000.00,1600);
INSERT INTO payments VALUES (1601,2040.00,'Q1',20.00,20.00,2000.00,1601);
INSERT INTO payments VALUES (1602,1010.00,'full',0.00,10.00,1000.00,1602);
INSERT INTO payments VALUES (1604,1010.00,'full',0.00,10.00,1000.00,1604);
INSERT INTO payments VALUES (1605,2040.00,'Q1',20.00,20.00,2000.00,1605);
INSERT INTO payments VALUES (1607,2040.00,'Q1',20.00,20.00,2000.00,1607);
INSERT INTO payments VALUES (1608,2040.00,'Q1',20.00,20.00,2000.00,1608);
INSERT INTO payments VALUES (1610,1010.00,'full',0.00,10.00,1000.00,1610);
INSERT INTO payments VALUES (1613,1010.00,'full',0.00,10.00,1000.00,1613);
INSERT INTO payments VALUES (1614,2040.00,'Q1',20.00,20.00,2000.00,1614);
INSERT INTO payments VALUES (1615,1010.00,'full',0.00,10.00,1000.00,1615);
INSERT INTO payments VALUES (1616,1010.00,'full',0.00,10.00,1000.00,1616);
INSERT INTO payments VALUES (1617,2040.00,'Q1',20.00,20.00,2000.00,1617);
INSERT INTO payments VALUES (1618,1010.00,'full',0.00,10.00,1000.00,1618);
INSERT INTO payments VALUES (1620,1010.00,'full',0.00,10.00,1000.00,1620);
INSERT INTO payments VALUES (1621,2040.00,'Q1',20.00,20.00,2000.00,1621);
INSERT INTO payments VALUES (1622,2040.00,'Q1',20.00,20.00,2000.00,1622);
INSERT INTO payments VALUES (1624,2040.00,'Q1',20.00,20.00,2000.00,1624);
INSERT INTO payments VALUES (1625,2040.00,'Q1',20.00,20.00,2000.00,1625);
INSERT INTO payments VALUES (1627,1010.00,'full',0.00,10.00,1000.00,1627);
INSERT INTO payments VALUES (1631,1010.00,'full',0.00,10.00,1000.00,1631);
INSERT INTO payments VALUES (1632,2040.00,'Q1',20.00,20.00,2000.00,1632);
INSERT INTO payments VALUES (1633,1010.00,'full',0.00,10.00,1000.00,1633);
INSERT INTO payments VALUES (1635,1010.00,'full',0.00,10.00,1000.00,1635);
INSERT INTO payments VALUES (1636,2040.00,'Q1',20.00,20.00,2000.00,1636);
INSERT INTO payments VALUES (1637,1010.00,'full',0.00,10.00,1000.00,1637);
INSERT INTO payments VALUES (1638,2040.00,'Q1',20.00,20.00,2000.00,1638);
INSERT INTO payments VALUES (1639,2040.00,'Q1',20.00,20.00,2000.00,1639);
INSERT INTO payments VALUES (1641,1010.00,'full',0.00,10.00,1000.00,1641);
INSERT INTO payments VALUES (1642,2040.00,'Q1',20.00,20.00,2000.00,1642);
INSERT INTO payments VALUES (1643,1010.00,'full',0.00,10.00,1000.00,1643);
INSERT INTO payments VALUES (1646,2040.00,'Q1',20.00,20.00,2000.00,1646);
INSERT INTO payments VALUES (1648,1010.00,'full',0.00,10.00,1000.00,1648);
INSERT INTO payments VALUES (1649,2040.00,'Q1',20.00,20.00,2000.00,1649);
INSERT INTO payments VALUES (1651,1010.00,'full',0.00,10.00,1000.00,1651);
INSERT INTO payments VALUES (1652,1010.00,'full',0.00,10.00,1000.00,1652);
INSERT INTO payments VALUES (1653,2040.00,'Q1',20.00,20.00,2000.00,1653);
INSERT INTO payments VALUES (1655,1010.00,'full',0.00,10.00,1000.00,1655);
INSERT INTO payments VALUES (1656,2040.00,'Q1',20.00,20.00,2000.00,1656);
INSERT INTO payments VALUES (1657,2040.00,'Q1',20.00,20.00,2000.00,1657);
INSERT INTO payments VALUES (1658,1010.00,'full',0.00,10.00,1000.00,1658);
INSERT INTO payments VALUES (1660,2040.00,'Q1',20.00,20.00,2000.00,1660);
INSERT INTO payments VALUES (1663,2040.00,'Q1',20.00,20.00,2000.00,1663);
INSERT INTO payments VALUES (1665,1010.00,'full',0.00,10.00,1000.00,1665);
INSERT INTO payments VALUES (1666,1010.00,'full',0.00,10.00,1000.00,1666);
INSERT INTO payments VALUES (1668,1010.00,'full',0.00,10.00,1000.00,1668);
INSERT INTO payments VALUES (1669,1010.00,'full',0.00,10.00,1000.00,1669);
INSERT INTO payments VALUES (1670,2040.00,'Q1',20.00,20.00,2000.00,1670);
INSERT INTO payments VALUES (1671,2040.00,'Q1',20.00,20.00,2000.00,1671);
INSERT INTO payments VALUES (1672,1010.00,'full',0.00,10.00,1000.00,1672);
INSERT INTO payments VALUES (1673,2040.00,'Q1',20.00,20.00,2000.00,1673);
INSERT INTO payments VALUES (1674,2040.00,'Q1',20.00,20.00,2000.00,1674);
INSERT INTO payments VALUES (1675,1010.00,'full',0.00,10.00,1000.00,1675);
INSERT INTO payments VALUES (1678,2040.00,'Q1',20.00,20.00,2000.00,1678);
INSERT INTO payments VALUES (1681,2040.00,'Q1',20.00,20.00,2000.00,1681);
INSERT INTO payments VALUES (1683,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (1685,1010.00,'full',0.00,10.00,1000.00,1685);
INSERT INTO payments VALUES (1686,1010.00,'full',0.00,10.00,1000.00,1686);
INSERT INTO payments VALUES (1687,1010.00,'full',0.00,10.00,1000.00,1687);
INSERT INTO payments VALUES (1688,1010.00,'full',0.00,10.00,1000.00,1688);
INSERT INTO payments VALUES (1689,1010.00,'full',0.00,10.00,1000.00,1689);
INSERT INTO payments VALUES (1690,2040.00,'Q1',20.00,20.00,2000.00,1690);
INSERT INTO payments VALUES (1691,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (1692,1010.00,'full',0.00,10.00,1000.00,1692);
INSERT INTO payments VALUES (1693,2040.00,'Q1',20.00,20.00,2000.00,1693);
INSERT INTO payments VALUES (1694,2040.00,'Q1',20.00,20.00,2000.00,1694);
INSERT INTO payments VALUES (1695,2040.00,'Q1',20.00,20.00,2000.00,1695);
INSERT INTO payments VALUES (1696,1010.00,'full',0.00,10.00,1000.00,1696);
INSERT INTO payments VALUES (1698,2040.00,'Q1',20.00,20.00,2000.00,1698);
INSERT INTO payments VALUES (1702,2040.00,'Q1',20.00,20.00,2000.00,1702);
INSERT INTO payments VALUES (1704,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (1706,1010.00,'full',0.00,10.00,1000.00,1706);
INSERT INTO payments VALUES (1707,1010.00,'full',0.00,10.00,1000.00,1707);
INSERT INTO payments VALUES (1708,1010.00,'full',0.00,10.00,1000.00,1708);
INSERT INTO payments VALUES (1709,1010.00,'full',0.00,10.00,1000.00,1709);
INSERT INTO payments VALUES (1710,2040.00,'Q1',20.00,20.00,2000.00,1710);
INSERT INTO payments VALUES (1711,2040.00,'Q1',20.00,20.00,2000.00,1711);
INSERT INTO payments VALUES (1712,1010.00,'full',0.00,10.00,1000.00,1712);
INSERT INTO payments VALUES (1713,2040.00,'Q1',20.00,20.00,2000.00,1713);
INSERT INTO payments VALUES (1714,2040.00,'Q1',20.00,20.00,2000.00,1714);
INSERT INTO payments VALUES (1717,2040.00,'Q1',20.00,20.00,2000.00,1717);
INSERT INTO payments VALUES (1719,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (1721,1010.00,'full',0.00,10.00,1000.00,1721);
INSERT INTO payments VALUES (1722,1010.00,'full',0.00,10.00,1000.00,1722);
INSERT INTO payments VALUES (1723,1010.00,'full',0.00,10.00,1000.00,1723);
INSERT INTO payments VALUES (1724,1010.00,'full',0.00,10.00,1000.00,1724);
INSERT INTO payments VALUES (1725,2040.00,'Q1',20.00,20.00,2000.00,1725);
INSERT INTO payments VALUES (1726,2040.00,'Q1',20.00,20.00,2000.00,1726);
INSERT INTO payments VALUES (1727,1010.00,'full',0.00,10.00,1000.00,1727);
INSERT INTO payments VALUES (1728,2040.00,'Q1',20.00,20.00,2000.00,1728);
INSERT INTO payments VALUES (1729,2040.00,'Q1',20.00,20.00,2000.00,1729);
INSERT INTO payments VALUES (1732,2040.00,'Q1',20.00,20.00,2000.00,1732);
INSERT INTO payments VALUES (1734,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (1736,1010.00,'full',0.00,10.00,1000.00,1736);
INSERT INTO payments VALUES (1737,1010.00,'full',0.00,10.00,1000.00,1737);
INSERT INTO payments VALUES (1738,1010.00,'full',0.00,10.00,1000.00,1738);
INSERT INTO payments VALUES (1739,1010.00,'full',0.00,10.00,1000.00,1739);
INSERT INTO payments VALUES (1740,2040.00,'Q1',20.00,20.00,2000.00,1740);
INSERT INTO payments VALUES (1741,2040.00,'Q1',20.00,20.00,2000.00,1741);
INSERT INTO payments VALUES (1742,1010.00,'full',0.00,10.00,1000.00,1742);
INSERT INTO payments VALUES (1743,2040.00,'Q1',20.00,20.00,2000.00,1743);
INSERT INTO payments VALUES (1744,2040.00,'Q1',20.00,20.00,2000.00,1744);
INSERT INTO payments VALUES (1747,2040.00,'Q1',20.00,20.00,2000.00,1747);
INSERT INTO payments VALUES (1749,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (1751,1010.00,'full',0.00,10.00,1000.00,1751);
INSERT INTO payments VALUES (1752,1010.00,'full',0.00,10.00,1000.00,1752);
INSERT INTO payments VALUES (1753,1010.00,'full',0.00,10.00,1000.00,1753);
INSERT INTO payments VALUES (1754,1010.00,'full',0.00,10.00,1000.00,1754);
INSERT INTO payments VALUES (1755,2040.00,'Q1',20.00,20.00,2000.00,1755);
INSERT INTO payments VALUES (1756,2040.00,'Q1',20.00,20.00,2000.00,1756);
INSERT INTO payments VALUES (1757,1010.00,'full',0.00,10.00,1000.00,1757);
INSERT INTO payments VALUES (1758,2040.00,'Q1',20.00,20.00,2000.00,1758);
INSERT INTO payments VALUES (1759,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (1762,2040.00,'Q1',20.00,20.00,2000.00,1762);
INSERT INTO payments VALUES (1763,1010.00,'full',0.00,10.00,1000.00,1763);
INSERT INTO payments VALUES (1766,1010.00,'full',0.00,10.00,1000.00,1766);
INSERT INTO payments VALUES (1767,2040.00,'Q1',20.00,20.00,2000.00,1767);
INSERT INTO payments VALUES (1768,1010.00,'full',0.00,10.00,1000.00,1768);
INSERT INTO payments VALUES (1769,2040.00,'Q1',20.00,20.00,2000.00,1769);
INSERT INTO payments VALUES (1770,1010.00,'full',0.00,10.00,1000.00,1770);
INSERT INTO payments VALUES (1772,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (1773,2040.00,'Q1',20.00,20.00,2000.00,1773);
INSERT INTO payments VALUES (1775,2040.00,'Q1',20.00,20.00,2000.00,1775);
INSERT INTO payments VALUES (1776,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (1778,1010.00,'full',0.00,10.00,1000.00,1778);
INSERT INTO payments VALUES (1779,1010.00,'full',0.00,10.00,1000.00,1779);
INSERT INTO payments VALUES (1781,1010.00,'full',0.00,10.00,1000.00,1781);
INSERT INTO payments VALUES (1782,2040.00,'Q1',20.00,20.00,2000.00,1782);
INSERT INTO payments VALUES (1783,2040.00,'Q1',20.00,20.00,2000.00,1783);
INSERT INTO payments VALUES (1784,1010.00,'full',0.00,10.00,1000.00,1784);
INSERT INTO payments VALUES (1785,2040.00,'Q1',20.00,20.00,2000.00,1785);
INSERT INTO payments VALUES (1787,1010.00,'full',0.00,10.00,1000.00,1787);
INSERT INTO payments VALUES (1789,2040.00,'Q1',20.00,20.00,2000.00,1789);
INSERT INTO payments VALUES (1791,2040.00,'Q1',20.00,20.00,2000.00,1791);
INSERT INTO payments VALUES (1792,1010.00,'full',0.00,10.00,1000.00,1792);
INSERT INTO payments VALUES (1794,1010.00,'full',0.00,10.00,1000.00,1794);
INSERT INTO payments VALUES (1796,2040.00,'Q1',20.00,20.00,2000.00,1796);
INSERT INTO payments VALUES (1797,1010.00,'full',0.00,10.00,1000.00,1797);
INSERT INTO payments VALUES (1798,2040.00,'Q1',20.00,20.00,2000.00,1798);
INSERT INTO payments VALUES (1799,1010.00,'full',0.00,10.00,1000.00,1799);
INSERT INTO payments VALUES (1801,2040.00,'Q1',20.00,20.00,2000.00,1801);
INSERT INTO payments VALUES (1802,1010.00,'full',0.00,10.00,1000.00,1802);
INSERT INTO payments VALUES (1804,2040.00,'Q1',20.00,20.00,2000.00,1804);
INSERT INTO payments VALUES (1806,2040.00,'Q1',20.00,20.00,2000.00,1806);
INSERT INTO payments VALUES (1807,1010.00,'full',0.00,10.00,1000.00,1807);
INSERT INTO payments VALUES (1809,1010.00,'full',0.00,10.00,1000.00,1809);
INSERT INTO payments VALUES (1811,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (1812,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (1813,2040.00,'Q1',20.00,20.00,2000.00,1813);
INSERT INTO payments VALUES (1814,1010.00,'full',0.00,10.00,1000.00,1814);
INSERT INTO payments VALUES (1815,1010.00,'full',0.00,10.00,1000.00,1815);
INSERT INTO payments VALUES (1816,1010.00,'full',0.00,10.00,1000.00,1816);
INSERT INTO payments VALUES (1817,1010.00,'full',0.00,10.00,1000.00,1817);
INSERT INTO payments VALUES (1819,2040.00,'Q1',20.00,20.00,2000.00,1819);
INSERT INTO payments VALUES (1820,2040.00,'Q1',20.00,20.00,2000.00,1820);
INSERT INTO payments VALUES (1821,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (1822,2040.00,'Q1',20.00,20.00,2000.00,1822);
INSERT INTO payments VALUES (1824,1010.00,'full',0.00,10.00,1000.00,1824);
INSERT INTO payments VALUES (1825,1010.00,'full',0.00,10.00,1000.00,1825);
INSERT INTO payments VALUES (1828,2040.00,'Q1',20.00,20.00,2000.00,1828);
INSERT INTO payments VALUES (1829,2040.00,'Q1',20.00,20.00,2000.00,1829);
INSERT INTO payments VALUES (1830,1010.00,'full',0.00,10.00,1000.00,1830);
INSERT INTO payments VALUES (1832,1010.00,'full',0.00,10.00,1000.00,1832);
INSERT INTO payments VALUES (1834,1010.00,'full',0.00,10.00,1000.00,1834);
INSERT INTO payments VALUES (1835,2040.00,'Q1',20.00,20.00,2000.00,1835);
INSERT INTO payments VALUES (1836,2040.00,'Q1',20.00,20.00,2000.00,1836);
INSERT INTO payments VALUES (1837,1010.00,'full',0.00,10.00,1000.00,1837);
INSERT INTO payments VALUES (1838,2040.00,'Q1',20.00,20.00,2000.00,1838);
INSERT INTO payments VALUES (1840,1010.00,'full',0.00,10.00,1000.00,1840);
INSERT INTO payments VALUES (1842,2040.00,'Q1',20.00,20.00,2000.00,1842);
INSERT INTO payments VALUES (1844,2040.00,'Q1',20.00,20.00,2000.00,1844);
INSERT INTO payments VALUES (1845,1010.00,'full',0.00,10.00,1000.00,1845);
INSERT INTO payments VALUES (1847,1010.00,'full',0.00,10.00,1000.00,1847);
INSERT INTO payments VALUES (1849,2040.00,'Q1',20.00,20.00,2000.00,1849);
INSERT INTO payments VALUES (1850,1010.00,'full',0.00,10.00,1000.00,1850);
INSERT INTO payments VALUES (1851,2040.00,'Q1',20.00,20.00,2000.00,1851);
INSERT INTO payments VALUES (1852,1010.00,'full',0.00,10.00,1000.00,1852);
INSERT INTO payments VALUES (1854,2040.00,'Q1',20.00,20.00,2000.00,1854);
INSERT INTO payments VALUES (1855,1010.00,'full',0.00,10.00,1000.00,1855);
INSERT INTO payments VALUES (1857,2040.00,'Q1',20.00,20.00,2000.00,1857);
INSERT INTO payments VALUES (1859,2040.00,'Q1',20.00,20.00,2000.00,1859);
INSERT INTO payments VALUES (1860,1010.00,'full',0.00,10.00,1000.00,1860);
INSERT INTO payments VALUES (1862,1010.00,'full',0.00,10.00,1000.00,1862);
INSERT INTO payments VALUES (1864,2040.00,'Q1',20.00,20.00,2000.00,1864);
INSERT INTO payments VALUES (1865,1010.00,'full',0.00,10.00,1000.00,1865);
INSERT INTO payments VALUES (1866,2040.00,'Q1',20.00,20.00,2000.00,1866);
INSERT INTO payments VALUES (1867,1010.00,'full',0.00,10.00,1000.00,1867);
INSERT INTO payments VALUES (1869,2040.00,'Q1',20.00,20.00,2000.00,1869);
INSERT INTO payments VALUES (1870,1010.00,'full',0.00,10.00,1000.00,1870);
INSERT INTO payments VALUES (1872,2040.00,'Q1',20.00,20.00,2000.00,1872);
INSERT INTO payments VALUES (1874,2040.00,'Q1',20.00,20.00,2000.00,1874);
INSERT INTO payments VALUES (1875,1010.00,'full',0.00,10.00,1000.00,1875);
INSERT INTO payments VALUES (1877,1010.00,'full',0.00,10.00,1000.00,1877);
INSERT INTO payments VALUES (1879,2040.00,'Q1',20.00,20.00,2000.00,1879);
INSERT INTO payments VALUES (1880,1010.00,'full',0.00,10.00,1000.00,1880);
INSERT INTO payments VALUES (1881,2040.00,'Q1',20.00,20.00,2000.00,1881);
INSERT INTO payments VALUES (1882,1010.00,'full',0.00,10.00,1000.00,1882);
INSERT INTO payments VALUES (1884,2040.00,'Q1',20.00,20.00,2000.00,1884);
INSERT INTO payments VALUES (1885,1010.00,'full',0.00,10.00,1000.00,1885);
INSERT INTO payments VALUES (1887,2040.00,'Q1',20.00,20.00,2000.00,1887);
INSERT INTO payments VALUES (1889,2040.00,'Q1',20.00,20.00,2000.00,1889);
INSERT INTO payments VALUES (1890,1010.00,'full',0.00,10.00,1000.00,1890);
INSERT INTO payments VALUES (1892,1010.00,'full',0.00,10.00,1000.00,1892);
INSERT INTO payments VALUES (1894,2040.00,'Q1',20.00,20.00,2000.00,1894);
INSERT INTO payments VALUES (1895,1010.00,'full',0.00,10.00,1000.00,1895);
INSERT INTO payments VALUES (1896,2040.00,'Q1',20.00,20.00,2000.00,1896);
INSERT INTO payments VALUES (1897,1010.00,'full',0.00,10.00,1000.00,1897);
INSERT INTO payments VALUES (1899,2040.00,'Q1',20.00,20.00,2000.00,1899);
INSERT INTO payments VALUES (1900,1010.00,'full',0.00,10.00,1000.00,1900);
INSERT INTO payments VALUES (1902,2040.00,'Q1',20.00,20.00,2000.00,1902);
INSERT INTO payments VALUES (1904,2040.00,'Q1',20.00,20.00,2000.00,1904);
INSERT INTO payments VALUES (1905,1010.00,'full',0.00,10.00,1000.00,1905);
INSERT INTO payments VALUES (1907,1010.00,'full',0.00,10.00,1000.00,1907);
INSERT INTO payments VALUES (1909,2040.00,'Q1',20.00,20.00,2000.00,1909);
INSERT INTO payments VALUES (1910,1010.00,'full',0.00,10.00,1000.00,1910);
INSERT INTO payments VALUES (1911,2040.00,'Q1',20.00,20.00,2000.00,1911);
INSERT INTO payments VALUES (1912,1010.00,'full',0.00,10.00,1000.00,1912);
INSERT INTO payments VALUES (1914,2040.00,'Q1',20.00,20.00,2000.00,1914);
INSERT INTO payments VALUES (1915,1010.00,'full',0.00,10.00,1000.00,1915);
INSERT INTO payments VALUES (1917,2040.00,'Q1',20.00,20.00,2000.00,1917);
INSERT INTO payments VALUES (1919,2040.00,'Q1',20.00,20.00,2000.00,1919);
INSERT INTO payments VALUES (1920,1010.00,'full',0.00,10.00,1000.00,1920);
INSERT INTO payments VALUES (1922,1010.00,'full',0.00,10.00,1000.00,1922);
INSERT INTO payments VALUES (1924,2040.00,'Q1',20.00,20.00,2000.00,1924);
INSERT INTO payments VALUES (1925,1010.00,'full',0.00,10.00,1000.00,1925);
INSERT INTO payments VALUES (1926,2040.00,'Q1',20.00,20.00,2000.00,1926);
INSERT INTO payments VALUES (1927,1010.00,'full',0.00,10.00,1000.00,1927);
INSERT INTO payments VALUES (1929,2040.00,'Q1',20.00,20.00,2000.00,1929);
INSERT INTO payments VALUES (1930,1010.00,'full',0.00,10.00,1000.00,1930);
INSERT INTO payments VALUES (1932,2040.00,'Q1',20.00,20.00,2000.00,1932);
INSERT INTO payments VALUES (1934,2040.00,'Q1',20.00,20.00,2000.00,1934);
INSERT INTO payments VALUES (1935,1010.00,'full',0.00,10.00,1000.00,1935);
INSERT INTO payments VALUES (1937,1010.00,'full',0.00,10.00,1000.00,1937);
INSERT INTO payments VALUES (1939,2040.00,'Q1',20.00,20.00,2000.00,1939);
INSERT INTO payments VALUES (1940,1010.00,'full',0.00,10.00,1000.00,1940);
INSERT INTO payments VALUES (1941,2040.00,'Q1',20.00,20.00,2000.00,1941);
INSERT INTO payments VALUES (1942,1010.00,'full',0.00,10.00,1000.00,1942);
INSERT INTO payments VALUES (1944,2040.00,'Q1',20.00,20.00,2000.00,1944);
INSERT INTO payments VALUES (1945,1010.00,'full',0.00,10.00,1000.00,1945);
INSERT INTO payments VALUES (1947,2040.00,'Q1',20.00,20.00,2000.00,1947);
INSERT INTO payments VALUES (1949,2040.00,'Q1',20.00,20.00,2000.00,1949);
INSERT INTO payments VALUES (1950,1010.00,'full',0.00,10.00,1000.00,1950);
INSERT INTO payments VALUES (1952,1010.00,'full',0.00,10.00,1000.00,1952);
INSERT INTO payments VALUES (1954,2040.00,'Q1',20.00,20.00,2000.00,1954);
INSERT INTO payments VALUES (1955,1010.00,'full',0.00,10.00,1000.00,1955);
INSERT INTO payments VALUES (1956,2040.00,'Q1',20.00,20.00,2000.00,1956);
INSERT INTO payments VALUES (1957,1010.00,'full',0.00,10.00,1000.00,1957);
INSERT INTO payments VALUES (1959,2040.00,'Q1',20.00,20.00,2000.00,1959);
INSERT INTO payments VALUES (1960,1010.00,'full',0.00,10.00,1000.00,1960);
INSERT INTO payments VALUES (1962,2040.00,'Q1',20.00,20.00,2000.00,1962);
INSERT INTO payments VALUES (1964,2040.00,'Q1',20.00,20.00,2000.00,1964);
INSERT INTO payments VALUES (1965,1010.00,'full',0.00,10.00,1000.00,1965);
INSERT INTO payments VALUES (1967,1010.00,'full',0.00,10.00,1000.00,1967);
INSERT INTO payments VALUES (1969,1010.00,'full',0.00,10.00,1000.00,1969);
INSERT INTO payments VALUES (1970,2040.00,'Q1',20.00,20.00,2000.00,1970);
INSERT INTO payments VALUES (1971,1010.00,'full',0.00,10.00,1000.00,1971);
INSERT INTO payments VALUES (1972,2040.00,'Q1',20.00,20.00,2000.00,1972);
INSERT INTO payments VALUES (1973,1010.00,'full',0.00,10.00,1000.00,1973);
INSERT INTO payments VALUES (1974,2040.00,'Q1',20.00,20.00,2000.00,1974);
INSERT INTO payments VALUES (1976,1010.00,'full',0.00,10.00,1000.00,1976);
INSERT INTO payments VALUES (1977,2040.00,'Q1',20.00,20.00,2000.00,1977);
INSERT INTO payments VALUES (1979,2040.00,'Q1',20.00,20.00,2000.00,1979);
INSERT INTO payments VALUES (1981,2040.00,'Q1',20.00,20.00,2000.00,1981);
INSERT INTO payments VALUES (1983,1010.00,'full',0.00,10.00,1000.00,1983);
INSERT INTO payments VALUES (1985,1010.00,'full',0.00,10.00,1000.00,1985);
INSERT INTO payments VALUES (1987,2040.00,'Q1',20.00,20.00,2000.00,1987);
INSERT INTO payments VALUES (1988,1010.00,'full',0.00,10.00,1000.00,1988);
INSERT INTO payments VALUES (1989,2040.00,'Q1',20.00,20.00,2000.00,1989);
INSERT INTO payments VALUES (1990,1010.00,'full',0.00,10.00,1000.00,1990);
INSERT INTO payments VALUES (1992,2040.00,'Q1',20.00,20.00,2000.00,1992);
INSERT INTO payments VALUES (1993,1010.00,'full',0.00,10.00,1000.00,1993);
INSERT INTO payments VALUES (1995,2040.00,'Q1',20.00,20.00,2000.00,1995);
INSERT INTO payments VALUES (1996,1010.00,'full',0.00,10.00,1000.00,1996);
INSERT INTO payments VALUES (1998,2040.00,'Q1',20.00,20.00,2000.00,1998);
INSERT INTO payments VALUES (1999,1010.00,'full',0.00,10.00,1000.00,1999);
INSERT INTO payments VALUES (2001,2040.00,'Q1',20.00,20.00,2000.00,2001);
INSERT INTO payments VALUES (2002,1010.00,'full',0.00,10.00,1000.00,2002);
INSERT INTO payments VALUES (2004,2040.00,'Q1',20.00,20.00,2000.00,2004);
INSERT INTO payments VALUES (2006,2040.00,'Q1',20.00,20.00,2000.00,2006);
INSERT INTO payments VALUES (2009,1010.00,'full',0.00,10.00,1000.00,2009);
INSERT INTO payments VALUES (2010,1010.00,'full',0.00,10.00,1000.00,2010);
INSERT INTO payments VALUES (2011,1010.00,'full',0.00,10.00,1000.00,2011);
INSERT INTO payments VALUES (2012,1010.00,'full',0.00,10.00,1000.00,2012);
INSERT INTO payments VALUES (2013,1010.00,'full',0.00,10.00,1000.00,2013);
INSERT INTO payments VALUES (2014,2040.00,'Q1',20.00,20.00,2000.00,2014);
INSERT INTO payments VALUES (2015,2040.00,'Q1',20.00,20.00,2000.00,2015);
INSERT INTO payments VALUES (2016,2040.00,'Q1',20.00,20.00,2000.00,2016);
INSERT INTO payments VALUES (2017,2040.00,'Q1',20.00,20.00,2000.00,2017);
INSERT INTO payments VALUES (2018,2040.00,'Q1',20.00,20.00,2000.00,2018);
INSERT INTO payments VALUES (2024,1010.00,'full',0.00,10.00,1000.00,2024);
INSERT INTO payments VALUES (2025,1010.00,'full',0.00,10.00,1000.00,2025);
INSERT INTO payments VALUES (2026,1010.00,'full',0.00,10.00,1000.00,2026);
INSERT INTO payments VALUES (2027,1010.00,'full',0.00,10.00,1000.00,2027);
INSERT INTO payments VALUES (2028,1010.00,'full',0.00,10.00,1000.00,2028);
INSERT INTO payments VALUES (2029,2040.00,'Q1',20.00,20.00,2000.00,2029);
INSERT INTO payments VALUES (2030,2040.00,'Q1',20.00,20.00,2000.00,2030);
INSERT INTO payments VALUES (2031,2040.00,'Q1',20.00,20.00,2000.00,2031);
INSERT INTO payments VALUES (2032,2040.00,'Q1',20.00,20.00,2000.00,2032);
INSERT INTO payments VALUES (2033,2040.00,'Q1',20.00,20.00,2000.00,2033);
INSERT INTO payments VALUES (2039,1010.00,'full',0.00,10.00,1000.00,2039);
INSERT INTO payments VALUES (2040,1010.00,'full',0.00,10.00,1000.00,2040);
INSERT INTO payments VALUES (2041,1010.00,'full',0.00,10.00,1000.00,2041);
INSERT INTO payments VALUES (2042,1010.00,'full',0.00,10.00,1000.00,2042);
INSERT INTO payments VALUES (2043,1010.00,'full',0.00,10.00,1000.00,2043);
INSERT INTO payments VALUES (2044,2040.00,'Q1',20.00,20.00,2000.00,2044);
INSERT INTO payments VALUES (2045,2040.00,'Q1',20.00,20.00,2000.00,2045);
INSERT INTO payments VALUES (2046,2040.00,'Q1',20.00,20.00,2000.00,2046);
INSERT INTO payments VALUES (2047,2040.00,'Q1',20.00,20.00,2000.00,2047);
INSERT INTO payments VALUES (2048,2040.00,'Q1',20.00,20.00,2000.00,2048);
INSERT INTO payments VALUES (2054,1010.00,'full',0.00,10.00,1000.00,2054);
INSERT INTO payments VALUES (2055,1010.00,'full',0.00,10.00,1000.00,2055);
INSERT INTO payments VALUES (2056,1010.00,'full',0.00,10.00,1000.00,2056);
INSERT INTO payments VALUES (2057,1010.00,'full',0.00,10.00,1000.00,2057);
INSERT INTO payments VALUES (2058,1010.00,'full',0.00,10.00,1000.00,2058);
INSERT INTO payments VALUES (2059,2040.00,'Q1',20.00,20.00,2000.00,2059);
INSERT INTO payments VALUES (2060,2040.00,'Q1',20.00,20.00,2000.00,2060);
INSERT INTO payments VALUES (2061,2040.00,'Q1',20.00,20.00,2000.00,2061);
INSERT INTO payments VALUES (2062,2040.00,'Q1',20.00,20.00,2000.00,2062);
INSERT INTO payments VALUES (2063,2040.00,'Q1',20.00,20.00,2000.00,2063);
INSERT INTO payments VALUES (2069,1010.00,'full',0.00,10.00,1000.00,2069);
INSERT INTO payments VALUES (2070,1010.00,'full',0.00,10.00,1000.00,2070);
INSERT INTO payments VALUES (2071,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (2072,1010.00,'full',0.00,10.00,1000.00,2072);
INSERT INTO payments VALUES (2073,1010.00,'full',0.00,10.00,1000.00,2073);
INSERT INTO payments VALUES (2074,2040.00,'Q1',20.00,20.00,2000.00,2074);
INSERT INTO payments VALUES (2075,1010.00,'full',0.00,10.00,1000.00,2075);
INSERT INTO payments VALUES (2076,2040.00,'Q1',20.00,20.00,2000.00,2076);
INSERT INTO payments VALUES (2077,2040.00,'Q1',20.00,20.00,2000.00,2077);
INSERT INTO payments VALUES (2078,2040.00,'Q1',20.00,20.00,2000.00,2078);
INSERT INTO payments VALUES (2080,2040.00,'Q1',20.00,20.00,2000.00,2080);
INSERT INTO payments VALUES (2085,1010.00,'full',0.00,10.00,1000.00,2085);
INSERT INTO payments VALUES (2086,1010.00,'full',0.00,10.00,1000.00,2086);
INSERT INTO payments VALUES (2087,1010.00,'full',0.00,10.00,1000.00,2087);
INSERT INTO payments VALUES (2088,2040.00,'Q1',20.00,20.00,2000.00,2088);
INSERT INTO payments VALUES (2089,1010.00,'full',0.00,10.00,1000.00,2089);
INSERT INTO payments VALUES (2090,1010.00,'full',0.00,10.00,1000.00,2090);
INSERT INTO payments VALUES (2091,2040.00,'Q1',20.00,20.00,2000.00,2091);
INSERT INTO payments VALUES (2092,2040.00,'Q1',20.00,20.00,2000.00,2092);
INSERT INTO payments VALUES (2094,2040.00,'Q1',20.00,20.00,2000.00,2094);
INSERT INTO payments VALUES (2095,2040.00,'Q1',20.00,20.00,2000.00,2095);
INSERT INTO payments VALUES (2098,1010.00,'full',0.00,10.00,1000.00,2098);
INSERT INTO payments VALUES (2101,1010.00,'full',0.00,10.00,1000.00,2101);
INSERT INTO payments VALUES (2102,2040.00,'Q1',20.00,20.00,2000.00,2102);
INSERT INTO payments VALUES (2103,1010.00,'full',0.00,10.00,1000.00,2103);
INSERT INTO payments VALUES (2104,1010.00,'full',0.00,10.00,1000.00,2104);
INSERT INTO payments VALUES (2105,2040.00,'Q1',20.00,20.00,2000.00,2105);
INSERT INTO payments VALUES (2106,1010.00,'full',0.00,10.00,1000.00,2106);
INSERT INTO payments VALUES (2108,1010.00,'full',0.00,10.00,1000.00,2108);
INSERT INTO payments VALUES (2109,2040.00,'Q1',20.00,20.00,2000.00,2109);
INSERT INTO payments VALUES (2110,2040.00,'Q1',20.00,20.00,2000.00,2110);
INSERT INTO payments VALUES (2112,2040.00,'Q1',20.00,20.00,2000.00,2112);
INSERT INTO payments VALUES (2113,2040.00,'Q1',20.00,20.00,2000.00,2113);
INSERT INTO payments VALUES (2118,1010.00,'full',0.00,10.00,1000.00,2118);
INSERT INTO payments VALUES (2119,1010.00,'full',0.00,10.00,1000.00,2119);
INSERT INTO payments VALUES (2120,1010.00,'full',0.00,10.00,1000.00,2120);
INSERT INTO payments VALUES (2121,1010.00,'full',0.00,10.00,1000.00,2121);
INSERT INTO payments VALUES (2122,2040.00,'Q1',20.00,20.00,2000.00,2122);
INSERT INTO payments VALUES (2123,1010.00,'full',0.00,10.00,1000.00,2123);
INSERT INTO payments VALUES (2124,1010.00,'full',0.00,10.00,1000.00,2124);
INSERT INTO payments VALUES (2125,2040.00,'Q1',20.00,20.00,2000.00,2125);
INSERT INTO payments VALUES (2126,2040.00,'Q1',20.00,20.00,2000.00,2126);
INSERT INTO payments VALUES (2127,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (2129,2040.00,'Q1',20.00,20.00,2000.00,2129);
INSERT INTO payments VALUES (2130,2040.00,'Q1',20.00,20.00,2000.00,2130);
INSERT INTO payments VALUES (2134,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2135,1010.00,'full',0.00,10.00,1000.00,2135);
INSERT INTO payments VALUES (2136,1010.00,'full',0.00,10.00,1000.00,2136);
INSERT INTO payments VALUES (2137,1010.00,'full',0.00,10.00,1000.00,2137);
INSERT INTO payments VALUES (2138,2040.00,'Q1',20.00,20.00,2000.00,2138);
INSERT INTO payments VALUES (2139,1010.00,'full',0.00,10.00,1000.00,2139);
INSERT INTO payments VALUES (2140,1010.00,'full',0.00,10.00,1000.00,2140);
INSERT INTO payments VALUES (2141,2040.00,'Q1',20.00,20.00,2000.00,2141);
INSERT INTO payments VALUES (2142,2040.00,'Q1',20.00,20.00,2000.00,2142);
INSERT INTO payments VALUES (2144,2040.00,'Q1',20.00,20.00,2000.00,2144);
INSERT INTO payments VALUES (2145,2040.00,'Q1',20.00,20.00,2000.00,2145);
INSERT INTO payments VALUES (2150,1010.00,'full',0.00,10.00,1000.00,2150);
INSERT INTO payments VALUES (2151,1010.00,'full',0.00,10.00,1000.00,2151);
INSERT INTO payments VALUES (2152,1010.00,'full',0.00,10.00,1000.00,2152);
INSERT INTO payments VALUES (2153,2040.00,'Q1',20.00,20.00,2000.00,2153);
INSERT INTO payments VALUES (2154,1010.00,'full',0.00,10.00,1000.00,2154);
INSERT INTO payments VALUES (2155,1010.00,'full',0.00,10.00,1000.00,2155);
INSERT INTO payments VALUES (2156,2040.00,'Q1',20.00,20.00,2000.00,2156);
INSERT INTO payments VALUES (2157,2040.00,'Q1',20.00,20.00,2000.00,2157);
INSERT INTO payments VALUES (2159,2040.00,'Q1',20.00,20.00,2000.00,2159);
INSERT INTO payments VALUES (2160,2040.00,'Q1',20.00,20.00,2000.00,2160);
INSERT INTO payments VALUES (2165,1010.00,'full',0.00,10.00,1000.00,2165);
INSERT INTO payments VALUES (2166,1010.00,'full',0.00,10.00,1000.00,2166);
INSERT INTO payments VALUES (2167,1010.00,'full',0.00,10.00,1000.00,2167);
INSERT INTO payments VALUES (2168,2040.00,'Q1',20.00,20.00,2000.00,2168);
INSERT INTO payments VALUES (2169,1010.00,'full',0.00,10.00,1000.00,2169);
INSERT INTO payments VALUES (2170,1010.00,'full',0.00,10.00,1000.00,2170);
INSERT INTO payments VALUES (2171,2040.00,'Q1',20.00,20.00,2000.00,2171);
INSERT INTO payments VALUES (2172,1010.00,'full',0.00,10.00,1000.00,2172);
INSERT INTO payments VALUES (2173,2040.00,'Q1',20.00,20.00,2000.00,2173);
INSERT INTO payments VALUES (2175,2040.00,'Q1',20.00,20.00,2000.00,2175);
INSERT INTO payments VALUES (2176,2040.00,'Q1',20.00,20.00,2000.00,2176);
INSERT INTO payments VALUES (2178,2040.00,'Q1',20.00,20.00,2000.00,2178);
INSERT INTO payments VALUES (2182,1010.00,'full',0.00,10.00,1000.00,2182);
INSERT INTO payments VALUES (2183,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2184,1010.00,'full',0.00,10.00,1000.00,2184);
INSERT INTO payments VALUES (2185,1010.00,'full',0.00,10.00,1000.00,2185);
INSERT INTO payments VALUES (2186,1010.00,'full',0.00,10.00,1000.00,2186);
INSERT INTO payments VALUES (2187,2040.00,'Q1',20.00,20.00,2000.00,2187);
INSERT INTO payments VALUES (2188,1010.00,'full',0.00,10.00,1000.00,2188);
INSERT INTO payments VALUES (2189,2040.00,'Q1',20.00,20.00,2000.00,2189);
INSERT INTO payments VALUES (2190,2040.00,'Q1',20.00,20.00,2000.00,2190);
INSERT INTO payments VALUES (2191,2040.00,'Q1',20.00,20.00,2000.00,2191);
INSERT INTO payments VALUES (2193,2040.00,'Q1',20.00,20.00,2000.00,2193);
INSERT INTO payments VALUES (2195,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2196,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2197,1010.00,'full',0.00,10.00,1000.00,2197);
INSERT INTO payments VALUES (2199,1010.00,'full',0.00,10.00,1000.00,2199);
INSERT INTO payments VALUES (2200,1010.00,'full',0.00,10.00,1000.00,2200);
INSERT INTO payments VALUES (2201,1010.00,'full',0.00,10.00,1000.00,2201);
INSERT INTO payments VALUES (2202,1010.00,'full',0.00,10.00,1000.00,2202);
INSERT INTO payments VALUES (2203,2040.00,'Q1',20.00,20.00,2000.00,2203);
INSERT INTO payments VALUES (2204,2040.00,'Q1',20.00,20.00,2000.00,2204);
INSERT INTO payments VALUES (2205,2040.00,'Q1',20.00,20.00,2000.00,2205);
INSERT INTO payments VALUES (2206,1010.00,'full',0.00,10.00,1000.00,2206);
INSERT INTO payments VALUES (2207,2040.00,'Q1',20.00,20.00,2000.00,2207);
INSERT INTO payments VALUES (2208,2040.00,'Q1',20.00,20.00,2000.00,2208);
INSERT INTO payments VALUES (2212,2040.00,'Q1',20.00,20.00,2000.00,2212);
INSERT INTO payments VALUES (2214,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2216,1010.00,'full',0.00,10.00,1000.00,2216);
INSERT INTO payments VALUES (2217,1010.00,'full',0.00,10.00,1000.00,2217);
INSERT INTO payments VALUES (2218,1010.00,'full',0.00,10.00,1000.00,2218);
INSERT INTO payments VALUES (2219,1010.00,'full',0.00,10.00,1000.00,2219);
INSERT INTO payments VALUES (2220,2040.00,'Q1',20.00,20.00,2000.00,2220);
INSERT INTO payments VALUES (2221,1010.00,'full',0.00,10.00,1000.00,2221);
INSERT INTO payments VALUES (2222,2040.00,'Q1',20.00,20.00,2000.00,2222);
INSERT INTO payments VALUES (2223,1010.00,'full',0.00,10.00,1000.00,2223);
INSERT INTO payments VALUES (2224,2040.00,'Q1',20.00,20.00,2000.00,2224);
INSERT INTO payments VALUES (2225,2040.00,'Q1',20.00,20.00,2000.00,2225);
INSERT INTO payments VALUES (2227,2040.00,'Q1',20.00,20.00,2000.00,2227);
INSERT INTO payments VALUES (2229,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (2233,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (2234,1010.00,'full',0.00,10.00,1000.00,2234);
INSERT INTO payments VALUES (2235,1010.00,'full',0.00,10.00,1000.00,2235);
INSERT INTO payments VALUES (2236,1010.00,'full',0.00,10.00,1000.00,2236);
INSERT INTO payments VALUES (2237,1010.00,'full',0.00,10.00,1000.00,2237);
INSERT INTO payments VALUES (2238,2040.00,'Q1',20.00,20.00,2000.00,2238);
INSERT INTO payments VALUES (2239,1010.00,'full',0.00,10.00,1000.00,2239);
INSERT INTO payments VALUES (2240,2040.00,'Q1',20.00,20.00,2000.00,2240);
INSERT INTO payments VALUES (2241,2040.00,'Q1',20.00,20.00,2000.00,2241);
INSERT INTO payments VALUES (2242,2040.00,'Q1',20.00,20.00,2000.00,2242);
INSERT INTO payments VALUES (2244,2040.00,'Q1',20.00,20.00,2000.00,2244);
INSERT INTO payments VALUES (2248,1010.00,'full',0.00,10.00,1000.00,2248);
INSERT INTO payments VALUES (2250,1010.00,'full',0.00,10.00,1000.00,2250);
INSERT INTO payments VALUES (2251,1010.00,'full',0.00,10.00,1000.00,2251);
INSERT INTO payments VALUES (2252,2040.00,'Q1',20.00,20.00,2000.00,2252);
INSERT INTO payments VALUES (2253,1010.00,'full',0.00,10.00,1000.00,2253);
INSERT INTO payments VALUES (2254,1010.00,'full',0.00,10.00,1000.00,2254);
INSERT INTO payments VALUES (2255,2040.00,'Q1',20.00,20.00,2000.00,2255);
INSERT INTO payments VALUES (2256,2040.00,'Q1',20.00,20.00,2000.00,2256);
INSERT INTO payments VALUES (2257,1010.00,'full',0.00,10.00,1000.00,2257);
INSERT INTO payments VALUES (2259,2040.00,'Q1',20.00,20.00,2000.00,2259);
INSERT INTO payments VALUES (2260,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (2263,2040.00,'Q1',20.00,20.00,2000.00,2263);
INSERT INTO payments VALUES (2264,1010.00,'full',0.00,10.00,1000.00,2264);
INSERT INTO payments VALUES (2267,1010.00,'full',0.00,10.00,1000.00,2267);
INSERT INTO payments VALUES (2268,2040.00,'Q1',20.00,20.00,2000.00,2268);
INSERT INTO payments VALUES (2269,1010.00,'full',0.00,10.00,1000.00,2269);
INSERT INTO payments VALUES (2270,2040.00,'Q1',20.00,20.00,2000.00,2270);
INSERT INTO payments VALUES (2271,1010.00,'full',0.00,10.00,1000.00,2271);
INSERT INTO payments VALUES (2273,1010.00,'full',0.00,10.00,1000.00,2273);
INSERT INTO payments VALUES (2274,2040.00,'Q1',20.00,20.00,2000.00,2274);
INSERT INTO payments VALUES (2276,2040.00,'Q1',20.00,20.00,2000.00,2276);
INSERT INTO payments VALUES (2277,2040.00,'Q1',20.00,20.00,2000.00,2277);
INSERT INTO payments VALUES (2279,1010.00,'full',0.00,10.00,1000.00,2279);
INSERT INTO payments VALUES (2282,1010.00,'full',0.00,10.00,1000.00,2282);
INSERT INTO payments VALUES (2283,2040.00,'Q1',20.00,20.00,2000.00,2283);
INSERT INTO payments VALUES (2284,1010.00,'full',0.00,10.00,1000.00,2284);
INSERT INTO payments VALUES (2285,2040.00,'Q1',20.00,20.00,2000.00,2285);
INSERT INTO payments VALUES (2286,1010.00,'full',0.00,10.00,1000.00,2286);
INSERT INTO payments VALUES (2288,1010.00,'full',0.00,10.00,1000.00,2288);
INSERT INTO payments VALUES (2289,2040.00,'Q1',20.00,20.00,2000.00,2289);
INSERT INTO payments VALUES (2291,2040.00,'Q1',20.00,20.00,2000.00,2291);
INSERT INTO payments VALUES (2292,2040.00,'Q1',20.00,20.00,2000.00,2292);
INSERT INTO payments VALUES (2294,1010.00,'full',0.00,10.00,1000.00,2294);
INSERT INTO payments VALUES (2297,1010.00,'full',0.00,10.00,1000.00,2297);
INSERT INTO payments VALUES (2298,2040.00,'Q1',20.00,20.00,2000.00,2298);
INSERT INTO payments VALUES (2299,1010.00,'full',0.00,10.00,1000.00,2299);
INSERT INTO payments VALUES (2300,2040.00,'Q1',20.00,20.00,2000.00,2300);
INSERT INTO payments VALUES (2301,1010.00,'full',0.00,10.00,1000.00,2301);
INSERT INTO payments VALUES (2303,1010.00,'full',0.00,10.00,1000.00,2303);
INSERT INTO payments VALUES (2304,2040.00,'Q1',20.00,20.00,2000.00,2304);
INSERT INTO payments VALUES (2306,2040.00,'Q1',20.00,20.00,2000.00,2306);
INSERT INTO payments VALUES (2307,2040.00,'Q1',20.00,20.00,2000.00,2307);
INSERT INTO payments VALUES (2309,1010.00,'full',0.00,10.00,1000.00,2309);
INSERT INTO payments VALUES (2312,1010.00,'full',0.00,10.00,1000.00,2312);
INSERT INTO payments VALUES (2313,2040.00,'Q1',20.00,20.00,2000.00,2313);
INSERT INTO payments VALUES (2314,1010.00,'full',0.00,10.00,1000.00,2314);
INSERT INTO payments VALUES (2315,2040.00,'Q1',20.00,20.00,2000.00,2315);
INSERT INTO payments VALUES (2316,1010.00,'full',0.00,10.00,1000.00,2316);
INSERT INTO payments VALUES (2318,1010.00,'full',0.00,10.00,1000.00,2318);
INSERT INTO payments VALUES (2319,2040.00,'Q1',20.00,20.00,2000.00,2319);
INSERT INTO payments VALUES (2321,2040.00,'Q1',20.00,20.00,2000.00,2321);
INSERT INTO payments VALUES (2322,2040.00,'Q1',20.00,20.00,2000.00,2322);
INSERT INTO payments VALUES (2324,1010.00,'full',0.00,10.00,1000.00,2324);
INSERT INTO payments VALUES (2326,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2327,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (2328,2040.00,'Q1',20.00,20.00,2000.00,2328);
INSERT INTO payments VALUES (2329,1010.00,'full',0.00,10.00,1000.00,2329);
INSERT INTO payments VALUES (2330,1010.00,'full',0.00,10.00,1000.00,2330);
INSERT INTO payments VALUES (2331,1010.00,'full',0.00,10.00,1000.00,2331);
INSERT INTO payments VALUES (2332,1010.00,'full',0.00,10.00,1000.00,2332);
INSERT INTO payments VALUES (2334,2040.00,'Q1',20.00,20.00,2000.00,2334);
INSERT INTO payments VALUES (2335,2040.00,'Q1',20.00,20.00,2000.00,2335);
INSERT INTO payments VALUES (2336,2040.00,'Q1',20.00,20.00,2000.00,2336);
INSERT INTO payments VALUES (2337,2040.00,'Q1',20.00,20.00,2000.00,2337);
INSERT INTO payments VALUES (2340,1010.00,'full',0.00,10.00,1000.00,2340);
INSERT INTO payments VALUES (2342,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2343,2040.00,'Q1',20.00,20.00,2000.00,2343);
INSERT INTO payments VALUES (2344,1010.00,'full',0.00,10.00,1000.00,2344);
INSERT INTO payments VALUES (2345,1010.00,'full',0.00,10.00,1000.00,2345);
INSERT INTO payments VALUES (2346,1010.00,'full',0.00,10.00,1000.00,2346);
INSERT INTO payments VALUES (2347,1010.00,'full',0.00,10.00,1000.00,2347);
INSERT INTO payments VALUES (2349,2040.00,'Q1',20.00,20.00,2000.00,2349);
INSERT INTO payments VALUES (2350,2040.00,'Q1',20.00,20.00,2000.00,2350);
INSERT INTO payments VALUES (2351,2040.00,'Q1',20.00,20.00,2000.00,2351);
INSERT INTO payments VALUES (2352,2040.00,'Q1',20.00,20.00,2000.00,2352);
INSERT INTO payments VALUES (2355,1010.00,'full',0.00,10.00,1000.00,2355);
INSERT INTO payments VALUES (2357,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2358,2040.00,'Q1',20.00,20.00,2000.00,2358);
INSERT INTO payments VALUES (2359,1010.00,'full',0.00,10.00,1000.00,2359);
INSERT INTO payments VALUES (2360,1010.00,'full',0.00,10.00,1000.00,2360);
INSERT INTO payments VALUES (2361,1010.00,'full',0.00,10.00,1000.00,2361);
INSERT INTO payments VALUES (2362,1010.00,'full',0.00,10.00,1000.00,2362);
INSERT INTO payments VALUES (2364,2040.00,'Q1',20.00,20.00,2000.00,2364);
INSERT INTO payments VALUES (2365,2040.00,'Q1',20.00,20.00,2000.00,2365);
INSERT INTO payments VALUES (2366,2040.00,'Q1',20.00,20.00,2000.00,2366);
INSERT INTO payments VALUES (2367,2040.00,'Q1',20.00,20.00,2000.00,2367);
INSERT INTO payments VALUES (2370,1010.00,'full',0.00,10.00,1000.00,2370);
INSERT INTO payments VALUES (2372,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2373,2040.00,'Q1',20.00,20.00,2000.00,2373);
INSERT INTO payments VALUES (2374,1010.00,'full',0.00,10.00,1000.00,2374);
INSERT INTO payments VALUES (2375,1010.00,'full',0.00,10.00,1000.00,2375);
INSERT INTO payments VALUES (2376,1010.00,'full',0.00,10.00,1000.00,2376);
INSERT INTO payments VALUES (2377,1010.00,'full',0.00,10.00,1000.00,2377);
INSERT INTO payments VALUES (2379,2040.00,'Q1',20.00,20.00,2000.00,2379);
INSERT INTO payments VALUES (2380,2040.00,'Q1',20.00,20.00,2000.00,2380);
INSERT INTO payments VALUES (2381,2040.00,'Q1',20.00,20.00,2000.00,2381);
INSERT INTO payments VALUES (2382,2040.00,'Q1',20.00,20.00,2000.00,2382);
INSERT INTO payments VALUES (2385,1010.00,'full',0.00,10.00,1000.00,2385);
INSERT INTO payments VALUES (2387,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2388,2040.00,'Q1',20.00,20.00,2000.00,2388);
INSERT INTO payments VALUES (2389,1010.00,'full',0.00,10.00,1000.00,2389);
INSERT INTO payments VALUES (2390,1010.00,'full',0.00,10.00,1000.00,2390);
INSERT INTO payments VALUES (2391,1010.00,'full',0.00,10.00,1000.00,2391);
INSERT INTO payments VALUES (2392,1010.00,'full',0.00,10.00,1000.00,2392);
INSERT INTO payments VALUES (2394,2040.00,'Q1',20.00,20.00,2000.00,2394);
INSERT INTO payments VALUES (2395,2040.00,'Q1',20.00,20.00,2000.00,2395);
INSERT INTO payments VALUES (2396,2040.00,'Q1',20.00,20.00,2000.00,2396);
INSERT INTO payments VALUES (2397,2040.00,'Q1',20.00,20.00,2000.00,2397);
INSERT INTO payments VALUES (2400,1010.00,'full',0.00,10.00,1000.00,2400);
INSERT INTO payments VALUES (2402,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2403,2040.00,'Q1',20.00,20.00,2000.00,2403);
INSERT INTO payments VALUES (2404,1010.00,'full',0.00,10.00,1000.00,2404);
INSERT INTO payments VALUES (2405,1010.00,'full',0.00,10.00,1000.00,2405);
INSERT INTO payments VALUES (2406,1010.00,'full',0.00,10.00,1000.00,2406);
INSERT INTO payments VALUES (2407,1010.00,'full',0.00,10.00,1000.00,2407);
INSERT INTO payments VALUES (2409,2040.00,'Q1',20.00,20.00,2000.00,2409);
INSERT INTO payments VALUES (2410,2040.00,'Q1',20.00,20.00,2000.00,2410);
INSERT INTO payments VALUES (2411,2040.00,'Q1',20.00,20.00,2000.00,2411);
INSERT INTO payments VALUES (2412,2040.00,'Q1',20.00,20.00,2000.00,2412);
INSERT INTO payments VALUES (2415,1010.00,'full',0.00,10.00,1000.00,2415);
INSERT INTO payments VALUES (2417,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2418,2040.00,'Q1',20.00,20.00,2000.00,2418);
INSERT INTO payments VALUES (2419,1010.00,'full',0.00,10.00,1000.00,2419);
INSERT INTO payments VALUES (2420,1010.00,'full',0.00,10.00,1000.00,2420);
INSERT INTO payments VALUES (2421,1010.00,'full',0.00,10.00,1000.00,2421);
INSERT INTO payments VALUES (2422,1010.00,'full',0.00,10.00,1000.00,2422);
INSERT INTO payments VALUES (2424,2040.00,'Q1',20.00,20.00,2000.00,2424);
INSERT INTO payments VALUES (2425,2040.00,'Q1',20.00,20.00,2000.00,2425);
INSERT INTO payments VALUES (2426,2040.00,'Q1',20.00,20.00,2000.00,2426);
INSERT INTO payments VALUES (2427,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (2429,1010.00,'full',0.00,10.00,1000.00,2429);
INSERT INTO payments VALUES (2431,1010.00,'full',0.00,10.00,1000.00,2431);
INSERT INTO payments VALUES (2433,2040.00,'Q1',20.00,20.00,2000.00,2433);
INSERT INTO payments VALUES (2434,1010.00,'full',0.00,10.00,1000.00,2434);
INSERT INTO payments VALUES (2435,2040.00,'Q1',20.00,20.00,2000.00,2435);
INSERT INTO payments VALUES (2436,1010.00,'full',0.00,10.00,1000.00,2436);
INSERT INTO payments VALUES (2438,2040.00,'Q1',20.00,20.00,2000.00,2438);
INSERT INTO payments VALUES (2439,1010.00,'full',0.00,10.00,1000.00,2439);
INSERT INTO payments VALUES (2441,2040.00,'Q1',20.00,20.00,2000.00,2441);
INSERT INTO payments VALUES (2443,2040.00,'Q1',20.00,20.00,2000.00,2443);
INSERT INTO payments VALUES (2444,1010.00,'full',0.00,10.00,1000.00,2444);
INSERT INTO payments VALUES (2446,1010.00,'full',0.00,10.00,1000.00,2446);
INSERT INTO payments VALUES (2448,2040.00,'Q1',20.00,20.00,2000.00,2448);
INSERT INTO payments VALUES (2449,1010.00,'full',0.00,10.00,1000.00,2449);
INSERT INTO payments VALUES (2450,2040.00,'Q1',20.00,20.00,2000.00,2450);
INSERT INTO payments VALUES (2451,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (2453,2040.00,'Q1',20.00,20.00,2000.00,2453);
INSERT INTO payments VALUES (2454,1010.00,'full',0.00,10.00,1000.00,2454);
INSERT INTO payments VALUES (2455,1010.00,'full',0.00,10.00,1000.00,2455);
INSERT INTO payments VALUES (2458,2040.00,'Q1',20.00,20.00,2000.00,2458);
INSERT INTO payments VALUES (2459,1010.00,'full',0.00,10.00,1000.00,2459);
INSERT INTO payments VALUES (2460,2040.00,'Q1',20.00,20.00,2000.00,2460);
INSERT INTO payments VALUES (2462,1010.00,'full',0.00,10.00,1000.00,2462);
INSERT INTO payments VALUES (2463,2040.00,'Q1',20.00,20.00,2000.00,2463);
INSERT INTO payments VALUES (2464,1010.00,'full',0.00,10.00,1000.00,2464);
INSERT INTO payments VALUES (2466,2040.00,'Q1',20.00,20.00,2000.00,2466);
INSERT INTO payments VALUES (2468,1010.00,'full',0.00,10.00,1000.00,2468);
INSERT INTO payments VALUES (2469,2040.00,'Q1',20.00,20.00,2000.00,2469);
INSERT INTO payments VALUES (2471,1010.00,'full',0.00,10.00,1000.00,2471);
INSERT INTO payments VALUES (2472,2040.00,'Q1',20.00,20.00,2000.00,2472);
INSERT INTO payments VALUES (2474,1010.00,'full',0.00,10.00,1000.00,2474);
INSERT INTO payments VALUES (2475,2040.00,'Q1',20.00,20.00,2000.00,2475);
INSERT INTO payments VALUES (2477,1010.00,'full',0.00,10.00,1000.00,2477);
INSERT INTO payments VALUES (2478,2040.00,'Q1',20.00,20.00,2000.00,2478);
INSERT INTO payments VALUES (2480,1010.00,'full',0.00,10.00,1000.00,2480);
INSERT INTO payments VALUES (2481,2040.00,'Q1',20.00,20.00,2000.00,2481);
INSERT INTO payments VALUES (2483,1010.00,'full',0.00,10.00,1000.00,2483);
INSERT INTO payments VALUES (2484,2040.00,'Q1',20.00,20.00,2000.00,2484);
INSERT INTO payments VALUES (2486,1010.00,'full',0.00,10.00,1000.00,2486);
INSERT INTO payments VALUES (2487,2040.00,'Q1',20.00,20.00,2000.00,2487);
INSERT INTO payments VALUES (2489,1010.00,'full',0.00,10.00,1000.00,2489);
INSERT INTO payments VALUES (2490,2040.00,'Q1',20.00,20.00,2000.00,2490);
INSERT INTO payments VALUES (2492,1010.00,'full',0.00,10.00,1000.00,2492);
INSERT INTO payments VALUES (2493,2040.00,'Q1',20.00,20.00,2000.00,2493);
INSERT INTO payments VALUES (2495,1010.00,'full',0.00,10.00,1000.00,2495);
INSERT INTO payments VALUES (2496,2040.00,'Q1',20.00,20.00,2000.00,2496);
INSERT INTO payments VALUES (2498,1010.00,'full',0.00,10.00,1000.00,2498);
INSERT INTO payments VALUES (2499,2040.00,'Q1',20.00,20.00,2000.00,2499);
INSERT INTO payments VALUES (2501,1010.00,'full',0.00,10.00,1000.00,2501);
INSERT INTO payments VALUES (2502,2040.00,'Q1',20.00,20.00,2000.00,2502);
INSERT INTO payments VALUES (2504,1010.00,'full',0.00,10.00,1000.00,2504);
INSERT INTO payments VALUES (2505,2040.00,'Q1',20.00,20.00,2000.00,2505);
INSERT INTO payments VALUES (2507,1010.00,'full',0.00,10.00,1000.00,2507);
INSERT INTO payments VALUES (2508,2040.00,'Q1',20.00,20.00,2000.00,2508);
INSERT INTO payments VALUES (2510,1010.00,'full',0.00,10.00,1000.00,2510);
INSERT INTO payments VALUES (2511,2040.00,'Q1',20.00,20.00,2000.00,2511);
INSERT INTO payments VALUES (2513,1010.00,'full',0.00,10.00,1000.00,2513);
INSERT INTO payments VALUES (2514,2040.00,'Q1',20.00,20.00,2000.00,2514);
INSERT INTO payments VALUES (2516,1010.00,'full',0.00,10.00,1000.00,2516);
INSERT INTO payments VALUES (2517,2040.00,'Q1',20.00,20.00,2000.00,2517);
INSERT INTO payments VALUES (2519,1010.00,'full',0.00,10.00,1000.00,2519);
INSERT INTO payments VALUES (2520,2040.00,'Q1',20.00,20.00,2000.00,2520);
INSERT INTO payments VALUES (2522,1010.00,'full',0.00,10.00,1000.00,2522);
INSERT INTO payments VALUES (2523,2040.00,'Q1',20.00,20.00,2000.00,2523);
INSERT INTO payments VALUES (2525,1010.00,'full',0.00,10.00,1000.00,2525);
INSERT INTO payments VALUES (2526,2040.00,'Q1',20.00,20.00,2000.00,2526);
INSERT INTO payments VALUES (2528,1010.00,'full',0.00,10.00,1000.00,2528);
INSERT INTO payments VALUES (2529,2040.00,'Q1',20.00,20.00,2000.00,2529);
INSERT INTO payments VALUES (2531,1010.00,'full',0.00,10.00,1000.00,2531);
INSERT INTO payments VALUES (2532,2040.00,'Q1',20.00,20.00,2000.00,2532);
INSERT INTO payments VALUES (2534,1010.00,'full',0.00,10.00,1000.00,2534);
INSERT INTO payments VALUES (2535,2040.00,'Q1',20.00,20.00,2000.00,2535);
INSERT INTO payments VALUES (2537,1010.00,'full',0.00,10.00,1000.00,2537);
INSERT INTO payments VALUES (2538,2040.00,'Q1',20.00,20.00,2000.00,2538);
INSERT INTO payments VALUES (2540,1010.00,'full',0.00,10.00,1000.00,2540);
INSERT INTO payments VALUES (2541,2040.00,'Q1',20.00,20.00,2000.00,2541);
INSERT INTO payments VALUES (2543,1010.00,'full',0.00,10.00,1000.00,2543);
INSERT INTO payments VALUES (2544,2040.00,'Q1',20.00,20.00,2000.00,2544);
INSERT INTO payments VALUES (2546,1010.00,'full',0.00,10.00,1000.00,2546);
INSERT INTO payments VALUES (2547,2040.00,'Q1',20.00,20.00,2000.00,2547);
INSERT INTO payments VALUES (2549,1010.00,'full',0.00,10.00,1000.00,2549);
INSERT INTO payments VALUES (2550,2040.00,'Q1',20.00,20.00,2000.00,2550);
INSERT INTO payments VALUES (2552,1010.00,'full',0.00,10.00,1000.00,2552);
INSERT INTO payments VALUES (2553,2040.00,'Q1',20.00,20.00,2000.00,2553);
INSERT INTO payments VALUES (2554,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2555,1010.00,'full',0.00,10.00,1000.00,2555);
INSERT INTO payments VALUES (2556,2040.00,'Q1',20.00,20.00,2000.00,2556);
INSERT INTO payments VALUES (2557,1010.00,'full',0.00,10.00,1000.00,2557);
INSERT INTO payments VALUES (2558,1010.00,'full',0.00,10.00,1000.00,2558);
INSERT INTO payments VALUES (2560,2040.00,'Q1',20.00,20.00,2000.00,2560);
INSERT INTO payments VALUES (2562,2040.00,'Q1',20.00,20.00,2000.00,2562);
INSERT INTO payments VALUES (2563,2040.00,'Q1',20.00,20.00,2000.00,2563);
INSERT INTO payments VALUES (2565,1010.00,'full',0.00,10.00,1000.00,2565);
INSERT INTO payments VALUES (2568,1010.00,'full',0.00,10.00,1000.00,2568);
INSERT INTO payments VALUES (2569,2040.00,'Q1',20.00,20.00,2000.00,2569);
INSERT INTO payments VALUES (2570,1010.00,'full',0.00,10.00,1000.00,2570);
INSERT INTO payments VALUES (2571,2040.00,'Q1',20.00,20.00,2000.00,2571);
INSERT INTO payments VALUES (2572,1010.00,'full',0.00,10.00,1000.00,2572);
INSERT INTO payments VALUES (2574,1010.00,'full',0.00,10.00,1000.00,2574);
INSERT INTO payments VALUES (2575,2040.00,'Q1',20.00,20.00,2000.00,2575);
INSERT INTO payments VALUES (2577,2040.00,'Q1',20.00,20.00,2000.00,2577);
INSERT INTO payments VALUES (2578,2040.00,'Q1',20.00,20.00,2000.00,2578);
INSERT INTO payments VALUES (2580,1010.00,'full',0.00,10.00,1000.00,2580);
INSERT INTO payments VALUES (2583,1010.00,'full',0.00,10.00,1000.00,2583);
INSERT INTO payments VALUES (2584,2040.00,'Q1',20.00,20.00,2000.00,2584);
INSERT INTO payments VALUES (2585,1010.00,'full',0.00,10.00,1000.00,2585);
INSERT INTO payments VALUES (2586,2040.00,'Q1',20.00,20.00,2000.00,2586);
INSERT INTO payments VALUES (2587,1010.00,'full',0.00,10.00,1000.00,2587);
INSERT INTO payments VALUES (2589,1010.00,'full',0.00,10.00,1000.00,2589);
INSERT INTO payments VALUES (2590,2040.00,'Q1',20.00,20.00,2000.00,2590);
INSERT INTO payments VALUES (2592,2040.00,'Q1',20.00,20.00,2000.00,2592);
INSERT INTO payments VALUES (2593,2040.00,'Q1',20.00,20.00,2000.00,2593);
INSERT INTO payments VALUES (2595,1010.00,'full',0.00,10.00,1000.00,2595);
INSERT INTO payments VALUES (2598,1010.00,'full',0.00,10.00,1000.00,2598);
INSERT INTO payments VALUES (2599,2040.00,'Q1',20.00,20.00,2000.00,2599);
INSERT INTO payments VALUES (2600,2040.00,'Q1',20.00,20.00,2000.00,2600);
INSERT INTO payments VALUES (2603,1010.00,'full',0.00,10.00,1000.00,2603);
INSERT INTO payments VALUES (2604,1010.00,'full',0.00,10.00,1000.00,2604);
INSERT INTO payments VALUES (2605,1010.00,'full',0.00,10.00,1000.00,2605);
INSERT INTO payments VALUES (2606,1010.00,'full',0.00,10.00,1000.00,2606);
INSERT INTO payments VALUES (2607,1010.00,'full',0.00,10.00,1000.00,2607);
INSERT INTO payments VALUES (2608,2040.00,'Q1',20.00,20.00,2000.00,2608);
INSERT INTO payments VALUES (2609,2040.00,'Q1',20.00,20.00,2000.00,2609);
INSERT INTO payments VALUES (2610,2040.00,'Q1',20.00,20.00,2000.00,2610);
INSERT INTO payments VALUES (2611,2040.00,'Q1',20.00,20.00,2000.00,2611);
INSERT INTO payments VALUES (2612,2040.00,'Q1',20.00,20.00,2000.00,2612);
INSERT INTO payments VALUES (2618,1010.00,'full',0.00,10.00,1000.00,2618);
INSERT INTO payments VALUES (2619,1010.00,'full',0.00,10.00,1000.00,2619);
INSERT INTO payments VALUES (2620,1010.00,'full',0.00,10.00,1000.00,2620);
INSERT INTO payments VALUES (2621,1010.00,'full',0.00,10.00,1000.00,2621);
INSERT INTO payments VALUES (2622,1010.00,'full',0.00,10.00,1000.00,2622);
INSERT INTO payments VALUES (2623,2040.00,'Q1',20.00,20.00,2000.00,2623);
INSERT INTO payments VALUES (2624,2040.00,'Q1',20.00,20.00,2000.00,2624);
INSERT INTO payments VALUES (2625,2040.00,'Q1',20.00,20.00,2000.00,2625);
INSERT INTO payments VALUES (2626,2040.00,'Q1',20.00,20.00,2000.00,2626);
INSERT INTO payments VALUES (2627,2040.00,'Q1',20.00,20.00,2000.00,2627);
INSERT INTO payments VALUES (2633,1010.00,'full',0.00,10.00,1000.00,2633);
INSERT INTO payments VALUES (2634,1010.00,'full',0.00,10.00,1000.00,2634);
INSERT INTO payments VALUES (2635,1010.00,'full',0.00,10.00,1000.00,2635);
INSERT INTO payments VALUES (2636,1010.00,'full',0.00,10.00,1000.00,2636);
INSERT INTO payments VALUES (2637,1010.00,'full',0.00,10.00,1000.00,2637);
INSERT INTO payments VALUES (2638,2040.00,'Q1',20.00,20.00,2000.00,2638);
INSERT INTO payments VALUES (2639,2040.00,'Q1',20.00,20.00,2000.00,2639);
INSERT INTO payments VALUES (2640,2040.00,'Q1',20.00,20.00,2000.00,2640);
INSERT INTO payments VALUES (2641,2040.00,'Q1',20.00,20.00,2000.00,2641);
INSERT INTO payments VALUES (2642,2040.00,'Q1',20.00,20.00,2000.00,2642);
INSERT INTO payments VALUES (2648,1010.00,'full',0.00,10.00,1000.00,2648);
INSERT INTO payments VALUES (2649,1010.00,'full',0.00,10.00,1000.00,2649);
INSERT INTO payments VALUES (2650,1010.00,'full',0.00,10.00,1000.00,2650);
INSERT INTO payments VALUES (2651,1010.00,'full',0.00,10.00,1000.00,2651);
INSERT INTO payments VALUES (2652,1010.00,'full',0.00,10.00,1000.00,2652);
INSERT INTO payments VALUES (2653,2040.00,'Q1',20.00,20.00,2000.00,2653);
INSERT INTO payments VALUES (2654,2040.00,'Q1',20.00,20.00,2000.00,2654);
INSERT INTO payments VALUES (2655,2040.00,'Q1',20.00,20.00,2000.00,2655);
INSERT INTO payments VALUES (2656,2040.00,'Q1',20.00,20.00,2000.00,2656);
INSERT INTO payments VALUES (2657,2040.00,'Q1',20.00,20.00,2000.00,2657);
INSERT INTO payments VALUES (2661,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2663,1010.00,'full',0.00,10.00,1000.00,2663);
INSERT INTO payments VALUES (2664,1010.00,'full',0.00,10.00,1000.00,2664);
INSERT INTO payments VALUES (2665,1010.00,'full',0.00,10.00,1000.00,2665);
INSERT INTO payments VALUES (2666,1010.00,'full',0.00,10.00,1000.00,2666);
INSERT INTO payments VALUES (2667,1010.00,'full',0.00,10.00,1000.00,2667);
INSERT INTO payments VALUES (2668,2040.00,'Q1',20.00,20.00,2000.00,2668);
INSERT INTO payments VALUES (2669,2040.00,'Q1',20.00,20.00,2000.00,2669);
INSERT INTO payments VALUES (2670,2040.00,'Q1',20.00,20.00,2000.00,2670);
INSERT INTO payments VALUES (2671,2040.00,'Q1',20.00,20.00,2000.00,2671);
INSERT INTO payments VALUES (2672,2040.00,'Q1',20.00,20.00,2000.00,2672);
INSERT INTO payments VALUES (2678,1010.00,'full',0.00,10.00,1000.00,2678);
INSERT INTO payments VALUES (2679,1010.00,'full',0.00,10.00,1000.00,2679);
INSERT INTO payments VALUES (2680,1010.00,'full',0.00,10.00,1000.00,2680);
INSERT INTO payments VALUES (2681,1010.00,'full',0.00,10.00,1000.00,2681);
INSERT INTO payments VALUES (2682,1010.00,'full',0.00,10.00,1000.00,2682);
INSERT INTO payments VALUES (2683,2040.00,'Q1',20.00,20.00,2000.00,2683);
INSERT INTO payments VALUES (2684,2040.00,'Q1',20.00,20.00,2000.00,2684);
INSERT INTO payments VALUES (2685,2040.00,'Q1',20.00,20.00,2000.00,2685);
INSERT INTO payments VALUES (2686,2040.00,'Q1',20.00,20.00,2000.00,2686);
INSERT INTO payments VALUES (2687,2040.00,'Q1',20.00,20.00,2000.00,2687);
INSERT INTO payments VALUES (2693,1010.00,'full',0.00,10.00,1000.00,2693);
INSERT INTO payments VALUES (2694,1010.00,'full',0.00,10.00,1000.00,2694);
INSERT INTO payments VALUES (2695,1010.00,'full',0.00,10.00,1000.00,2695);
INSERT INTO payments VALUES (2696,1010.00,'full',0.00,10.00,1000.00,2696);
INSERT INTO payments VALUES (2697,1010.00,'full',0.00,10.00,1000.00,2697);
INSERT INTO payments VALUES (2698,2040.00,'Q1',20.00,20.00,2000.00,2698);
INSERT INTO payments VALUES (2699,2040.00,'Q1',20.00,20.00,2000.00,2699);
INSERT INTO payments VALUES (2700,2040.00,'Q1',20.00,20.00,2000.00,2700);
INSERT INTO payments VALUES (2701,2040.00,'Q1',20.00,20.00,2000.00,2701);
INSERT INTO payments VALUES (2702,2040.00,'Q1',20.00,20.00,2000.00,2702);
INSERT INTO payments VALUES (2708,1010.00,'full',0.00,10.00,1000.00,2708);
INSERT INTO payments VALUES (2709,1010.00,'full',0.00,10.00,1000.00,2709);
INSERT INTO payments VALUES (2710,1010.00,'full',0.00,10.00,1000.00,2710);
INSERT INTO payments VALUES (2711,1010.00,'full',0.00,10.00,1000.00,2711);
INSERT INTO payments VALUES (2712,1010.00,'full',0.00,10.00,1000.00,2712);
INSERT INTO payments VALUES (2713,2040.00,'Q1',20.00,20.00,2000.00,2713);
INSERT INTO payments VALUES (2714,2040.00,'Q1',20.00,20.00,2000.00,2714);
INSERT INTO payments VALUES (2715,2040.00,'Q1',20.00,20.00,2000.00,2715);
INSERT INTO payments VALUES (2716,2040.00,'Q1',20.00,20.00,2000.00,2716);
INSERT INTO payments VALUES (2717,2040.00,'Q1',20.00,20.00,2000.00,2717);
INSERT INTO payments VALUES (2721,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2723,1010.00,'full',0.00,10.00,1000.00,2723);
INSERT INTO payments VALUES (2724,1010.00,'full',0.00,10.00,1000.00,2724);
INSERT INTO payments VALUES (2725,1010.00,'full',0.00,10.00,1000.00,2725);
INSERT INTO payments VALUES (2726,1010.00,'full',0.00,10.00,1000.00,2726);
INSERT INTO payments VALUES (2727,1010.00,'full',0.00,10.00,1000.00,2727);
INSERT INTO payments VALUES (2728,2040.00,'Q1',20.00,20.00,2000.00,2728);
INSERT INTO payments VALUES (2729,2040.00,'Q1',20.00,20.00,2000.00,2729);
INSERT INTO payments VALUES (2730,2040.00,'Q1',20.00,20.00,2000.00,2730);
INSERT INTO payments VALUES (2731,2040.00,'Q1',20.00,20.00,2000.00,2731);
INSERT INTO payments VALUES (2732,2040.00,'Q1',20.00,20.00,2000.00,2732);
INSERT INTO payments VALUES (2733,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2737,1010.00,'full',0.00,10.00,1000.00,2737);
INSERT INTO payments VALUES (2739,2040.00,'Q1',20.00,20.00,2000.00,2739);
INSERT INTO payments VALUES (2740,1010.00,'full',0.00,10.00,1000.00,2740);
INSERT INTO payments VALUES (2741,1010.00,'full',0.00,10.00,1000.00,2741);
INSERT INTO payments VALUES (2742,1010.00,'full',0.00,10.00,1000.00,2742);
INSERT INTO payments VALUES (2743,1010.00,'full',0.00,10.00,1000.00,2743);
INSERT INTO payments VALUES (2745,2040.00,'Q1',20.00,20.00,2000.00,2745);
INSERT INTO payments VALUES (2746,2040.00,'Q1',20.00,20.00,2000.00,2746);
INSERT INTO payments VALUES (2747,2040.00,'Q1',20.00,20.00,2000.00,2747);
INSERT INTO payments VALUES (2748,2040.00,'Q1',20.00,20.00,2000.00,2748);
INSERT INTO payments VALUES (2751,1010.00,'full',0.00,10.00,1000.00,2751);
INSERT INTO payments VALUES (2753,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2754,2040.00,'Q1',20.00,20.00,2000.00,2754);
INSERT INTO payments VALUES (2755,1010.00,'full',0.00,10.00,1000.00,2755);
INSERT INTO payments VALUES (2756,1010.00,'full',0.00,10.00,1000.00,2756);
INSERT INTO payments VALUES (2757,1010.00,'full',0.00,10.00,1000.00,2757);
INSERT INTO payments VALUES (2758,1010.00,'full',0.00,10.00,1000.00,2758);
INSERT INTO payments VALUES (2760,2040.00,'Q1',20.00,20.00,2000.00,2760);
INSERT INTO payments VALUES (2761,2040.00,'Q1',20.00,20.00,2000.00,2761);
INSERT INTO payments VALUES (2762,2040.00,'Q1',20.00,20.00,2000.00,2762);
INSERT INTO payments VALUES (2763,2040.00,'Q1',20.00,20.00,2000.00,2763);
INSERT INTO payments VALUES (2766,1010.00,'full',0.00,10.00,1000.00,2766);
INSERT INTO payments VALUES (2768,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2769,2040.00,'Q1',20.00,20.00,2000.00,2769);
INSERT INTO payments VALUES (2770,1010.00,'full',0.00,10.00,1000.00,2770);
INSERT INTO payments VALUES (2771,1010.00,'full',0.00,10.00,1000.00,2771);
INSERT INTO payments VALUES (2772,1010.00,'full',0.00,10.00,1000.00,2772);
INSERT INTO payments VALUES (2773,1010.00,'full',0.00,10.00,1000.00,2773);
INSERT INTO payments VALUES (2775,2040.00,'Q1',20.00,20.00,2000.00,2775);
INSERT INTO payments VALUES (2776,2040.00,'Q1',20.00,20.00,2000.00,2776);
INSERT INTO payments VALUES (2777,2040.00,'Q1',20.00,20.00,2000.00,2777);
INSERT INTO payments VALUES (2778,2040.00,'Q1',20.00,20.00,2000.00,2778);
INSERT INTO payments VALUES (2781,1010.00,'full',0.00,10.00,1000.00,2781);
INSERT INTO payments VALUES (2783,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2784,2040.00,'Q1',20.00,20.00,2000.00,2784);
INSERT INTO payments VALUES (2785,1010.00,'full',0.00,10.00,1000.00,2785);
INSERT INTO payments VALUES (2786,1010.00,'full',0.00,10.00,1000.00,2786);
INSERT INTO payments VALUES (2787,1010.00,'full',0.00,10.00,1000.00,2787);
INSERT INTO payments VALUES (2788,1010.00,'full',0.00,10.00,1000.00,2788);
INSERT INTO payments VALUES (2790,2040.00,'Q1',20.00,20.00,2000.00,2790);
INSERT INTO payments VALUES (2791,2040.00,'Q1',20.00,20.00,2000.00,2791);
INSERT INTO payments VALUES (2792,2040.00,'Q1',20.00,20.00,2000.00,2792);
INSERT INTO payments VALUES (2793,2040.00,'Q1',20.00,20.00,2000.00,2793);
INSERT INTO payments VALUES (2796,1010.00,'full',0.00,10.00,1000.00,2796);
INSERT INTO payments VALUES (2798,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2799,2040.00,'Q1',20.00,20.00,2000.00,2799);
INSERT INTO payments VALUES (2800,1010.00,'full',0.00,10.00,1000.00,2800);
INSERT INTO payments VALUES (2801,1010.00,'full',0.00,10.00,1000.00,2801);
INSERT INTO payments VALUES (2802,1010.00,'full',0.00,10.00,1000.00,2802);
INSERT INTO payments VALUES (2803,1010.00,'full',0.00,10.00,1000.00,2803);
INSERT INTO payments VALUES (2805,2040.00,'Q1',20.00,20.00,2000.00,2805);
INSERT INTO payments VALUES (2806,2040.00,'Q1',20.00,20.00,2000.00,2806);
INSERT INTO payments VALUES (2807,2040.00,'Q1',20.00,20.00,2000.00,2807);
INSERT INTO payments VALUES (2808,2040.00,'Q1',20.00,20.00,2000.00,2808);
INSERT INTO payments VALUES (2811,1010.00,'full',0.00,10.00,1000.00,2811);
INSERT INTO payments VALUES (2813,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2814,2040.00,'Q1',20.00,20.00,2000.00,2814);
INSERT INTO payments VALUES (2815,1010.00,'full',0.00,10.00,1000.00,2815);
INSERT INTO payments VALUES (2816,1010.00,'full',0.00,10.00,1000.00,2816);
INSERT INTO payments VALUES (2817,1010.00,'full',0.00,10.00,1000.00,2817);
INSERT INTO payments VALUES (2818,1010.00,'full',0.00,10.00,1000.00,2818);
INSERT INTO payments VALUES (2820,2040.00,'Q1',20.00,20.00,2000.00,2820);
INSERT INTO payments VALUES (2821,2040.00,'Q1',20.00,20.00,2000.00,2821);
INSERT INTO payments VALUES (2822,2040.00,'Q1',20.00,20.00,2000.00,2822);
INSERT INTO payments VALUES (2823,2040.00,'Q1',20.00,20.00,2000.00,2823);
INSERT INTO payments VALUES (2826,1010.00,'full',0.00,10.00,1000.00,2826);
INSERT INTO payments VALUES (2828,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2829,2040.00,'Q1',20.00,20.00,2000.00,2829);
INSERT INTO payments VALUES (2830,1010.00,'full',0.00,10.00,1000.00,2830);
INSERT INTO payments VALUES (2831,1010.00,'full',0.00,10.00,1000.00,2831);
INSERT INTO payments VALUES (2832,1010.00,'full',0.00,10.00,1000.00,2832);
INSERT INTO payments VALUES (2833,1010.00,'full',0.00,10.00,1000.00,2833);
INSERT INTO payments VALUES (2835,2040.00,'Q1',20.00,20.00,2000.00,2835);
INSERT INTO payments VALUES (2836,2040.00,'Q1',20.00,20.00,2000.00,2836);
INSERT INTO payments VALUES (2837,2040.00,'Q1',20.00,20.00,2000.00,2837);
INSERT INTO payments VALUES (2838,2040.00,'Q1',20.00,20.00,2000.00,2838);
INSERT INTO payments VALUES (2841,1010.00,'full',0.00,10.00,1000.00,2841);
INSERT INTO payments VALUES (2843,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2844,2040.00,'Q1',20.00,20.00,2000.00,2844);
INSERT INTO payments VALUES (2845,1010.00,'full',0.00,10.00,1000.00,2845);
INSERT INTO payments VALUES (2846,1010.00,'full',0.00,10.00,1000.00,2846);
INSERT INTO payments VALUES (2847,1010.00,'full',0.00,10.00,1000.00,2847);
INSERT INTO payments VALUES (2848,1010.00,'full',0.00,10.00,1000.00,2848);
INSERT INTO payments VALUES (2850,2040.00,'Q1',20.00,20.00,2000.00,2850);
INSERT INTO payments VALUES (2851,2040.00,'Q1',20.00,20.00,2000.00,2851);
INSERT INTO payments VALUES (2852,2040.00,'Q1',20.00,20.00,2000.00,2852);
INSERT INTO payments VALUES (2853,2040.00,'Q1',20.00,20.00,2000.00,2853);
INSERT INTO payments VALUES (2856,1010.00,'full',0.00,10.00,1000.00,2856);
INSERT INTO payments VALUES (2859,2040.00,'Q1',20.00,20.00,2000.00,2859);
INSERT INTO payments VALUES (2860,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (2861,1010.00,'full',0.00,10.00,1000.00,2861);
INSERT INTO payments VALUES (2862,1010.00,'full',0.00,10.00,1000.00,2862);
INSERT INTO payments VALUES (2863,1010.00,'full',0.00,10.00,1000.00,2863);
INSERT INTO payments VALUES (2864,1010.00,'full',0.00,10.00,1000.00,2864);
INSERT INTO payments VALUES (2866,2040.00,'Q1',20.00,20.00,2000.00,2866);
INSERT INTO payments VALUES (2867,2040.00,'Q1',20.00,20.00,2000.00,2867);
INSERT INTO payments VALUES (2868,2040.00,'Q1',20.00,20.00,2000.00,2868);
INSERT INTO payments VALUES (2869,2040.00,'Q1',20.00,20.00,2000.00,2869);
INSERT INTO payments VALUES (2872,1010.00,'full',0.00,10.00,1000.00,2872);
INSERT INTO payments VALUES (2874,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2875,2040.00,'Q1',20.00,20.00,2000.00,2875);
INSERT INTO payments VALUES (2876,1010.00,'full',0.00,10.00,1000.00,2876);
INSERT INTO payments VALUES (2877,1010.00,'full',0.00,10.00,1000.00,2877);
INSERT INTO payments VALUES (2878,1010.00,'full',0.00,10.00,1000.00,2878);
INSERT INTO payments VALUES (2879,1010.00,'full',0.00,10.00,1000.00,2879);
INSERT INTO payments VALUES (2881,2040.00,'Q1',20.00,20.00,2000.00,2881);
INSERT INTO payments VALUES (2882,2040.00,'Q1',20.00,20.00,2000.00,2882);
INSERT INTO payments VALUES (2883,2040.00,'Q1',20.00,20.00,2000.00,2883);
INSERT INTO payments VALUES (2884,2040.00,'Q1',20.00,20.00,2000.00,2884);
INSERT INTO payments VALUES (2887,1010.00,'full',0.00,10.00,1000.00,2887);
INSERT INTO payments VALUES (2889,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2890,2040.00,'Q1',20.00,20.00,2000.00,2890);
INSERT INTO payments VALUES (2891,1010.00,'full',0.00,10.00,1000.00,2891);
INSERT INTO payments VALUES (2892,1010.00,'full',0.00,10.00,1000.00,2892);
INSERT INTO payments VALUES (2893,1010.00,'full',0.00,10.00,1000.00,2893);
INSERT INTO payments VALUES (2894,1010.00,'full',0.00,10.00,1000.00,2894);
INSERT INTO payments VALUES (2896,2040.00,'Q1',20.00,20.00,2000.00,2896);
INSERT INTO payments VALUES (2897,2040.00,'Q1',20.00,20.00,2000.00,2897);
INSERT INTO payments VALUES (2898,2040.00,'Q1',20.00,20.00,2000.00,2898);
INSERT INTO payments VALUES (2899,2040.00,'Q1',20.00,20.00,2000.00,2899);
INSERT INTO payments VALUES (2902,1010.00,'full',0.00,10.00,1000.00,2902);
INSERT INTO payments VALUES (2904,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2905,2040.00,'Q1',20.00,20.00,2000.00,2905);
INSERT INTO payments VALUES (2906,1010.00,'full',0.00,10.00,1000.00,2906);
INSERT INTO payments VALUES (2907,1010.00,'full',0.00,10.00,1000.00,2907);
INSERT INTO payments VALUES (2908,1010.00,'full',0.00,10.00,1000.00,2908);
INSERT INTO payments VALUES (2909,1010.00,'full',0.00,10.00,1000.00,2909);
INSERT INTO payments VALUES (2911,2040.00,'Q1',20.00,20.00,2000.00,2911);
INSERT INTO payments VALUES (2912,2040.00,'Q1',20.00,20.00,2000.00,2912);
INSERT INTO payments VALUES (2913,2040.00,'Q1',20.00,20.00,2000.00,2913);
INSERT INTO payments VALUES (2914,2040.00,'Q1',20.00,20.00,2000.00,2914);
INSERT INTO payments VALUES (2917,1010.00,'full',0.00,10.00,1000.00,2917);
INSERT INTO payments VALUES (2919,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2920,2040.00,'Q1',20.00,20.00,2000.00,2920);
INSERT INTO payments VALUES (2921,1010.00,'full',0.00,10.00,1000.00,2921);
INSERT INTO payments VALUES (2922,1010.00,'full',0.00,10.00,1000.00,2922);
INSERT INTO payments VALUES (2923,1010.00,'full',0.00,10.00,1000.00,2923);
INSERT INTO payments VALUES (2924,1010.00,'full',0.00,10.00,1000.00,2924);
INSERT INTO payments VALUES (2925,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2926,2040.00,'Q1',20.00,20.00,2000.00,2926);
INSERT INTO payments VALUES (2927,2040.00,'Q1',20.00,20.00,2000.00,2927);
INSERT INTO payments VALUES (2928,2040.00,'Q1',20.00,20.00,2000.00,2928);
INSERT INTO payments VALUES (2929,1010.00,'full',0.00,10.00,1000.00,2929);
INSERT INTO payments VALUES (2930,2040.00,'Q1',20.00,20.00,2000.00,2930);
INSERT INTO payments VALUES (2934,2040.00,'Q1',20.00,20.00,2000.00,2934);
INSERT INTO payments VALUES (2936,1010.00,'full',0.00,10.00,1000.00,2936);
INSERT INTO payments VALUES (2938,1010.00,'full',0.00,10.00,1000.00,2938);
INSERT INTO payments VALUES (2939,1010.00,'full',0.00,10.00,1000.00,2939);
INSERT INTO payments VALUES (2940,1010.00,'full',0.00,10.00,1000.00,2940);
INSERT INTO payments VALUES (2941,2040.00,'Q1',20.00,20.00,2000.00,2941);
INSERT INTO payments VALUES (2942,2040.00,'Q1',20.00,20.00,2000.00,2942);
INSERT INTO payments VALUES (2943,2040.00,'Q1',20.00,20.00,2000.00,2943);
INSERT INTO payments VALUES (2944,1010.00,'full',0.00,10.00,1000.00,2944);
INSERT INTO payments VALUES (2945,2040.00,'Q1',20.00,20.00,2000.00,2945);
INSERT INTO payments VALUES (2949,2040.00,'Q1',20.00,20.00,2000.00,2949);
INSERT INTO payments VALUES (2951,1010.00,'full',0.00,10.00,1000.00,2951);
INSERT INTO payments VALUES (2953,1010.00,'full',0.00,10.00,1000.00,2953);
INSERT INTO payments VALUES (2954,1010.00,'full',0.00,10.00,1000.00,2954);
INSERT INTO payments VALUES (2955,1010.00,'full',0.00,10.00,1000.00,2955);
INSERT INTO payments VALUES (2956,2040.00,'Q1',20.00,20.00,2000.00,2956);
INSERT INTO payments VALUES (2957,2040.00,'Q1',20.00,20.00,2000.00,2957);
INSERT INTO payments VALUES (2958,2040.00,'Q1',20.00,20.00,2000.00,2958);
INSERT INTO payments VALUES (2959,1010.00,'full',0.00,10.00,1000.00,2959);
INSERT INTO payments VALUES (2960,2040.00,'Q1',20.00,20.00,2000.00,2960);
INSERT INTO payments VALUES (2964,2040.00,'Q1',20.00,20.00,2000.00,2964);
INSERT INTO payments VALUES (2966,1010.00,'full',0.00,10.00,1000.00,2966);
INSERT INTO payments VALUES (2968,1010.00,'full',0.00,10.00,1000.00,2968);
INSERT INTO payments VALUES (2969,1010.00,'full',0.00,10.00,1000.00,2969);
INSERT INTO payments VALUES (2970,1010.00,'full',0.00,10.00,1000.00,2970);
INSERT INTO payments VALUES (2971,2040.00,'Q1',20.00,20.00,2000.00,2971);
INSERT INTO payments VALUES (2972,2040.00,'Q1',20.00,20.00,2000.00,2972);
INSERT INTO payments VALUES (2973,2040.00,'Q1',20.00,20.00,2000.00,2973);
INSERT INTO payments VALUES (2974,1010.00,'full',0.00,10.00,1000.00,2974);
INSERT INTO payments VALUES (2975,2040.00,'Q1',20.00,20.00,2000.00,2975);
INSERT INTO payments VALUES (2979,2040.00,'Q1',20.00,20.00,2000.00,2979);
INSERT INTO payments VALUES (2981,1010.00,'full',0.00,10.00,1000.00,2981);
INSERT INTO payments VALUES (2983,1010.00,'full',0.00,10.00,1000.00,2983);
INSERT INTO payments VALUES (2984,1010.00,'full',0.00,10.00,1000.00,2984);
INSERT INTO payments VALUES (2985,1010.00,'full',0.00,10.00,1000.00,2985);
INSERT INTO payments VALUES (2986,2040.00,'Q1',20.00,20.00,2000.00,2986);
INSERT INTO payments VALUES (2987,2040.00,'Q1',20.00,20.00,2000.00,2987);
INSERT INTO payments VALUES (2988,2040.00,'Q1',20.00,20.00,2000.00,2988);
INSERT INTO payments VALUES (2989,1010.00,'full',0.00,10.00,1000.00,2989);
INSERT INTO payments VALUES (2990,2040.00,'Q1',20.00,20.00,2000.00,2990);
INSERT INTO payments VALUES (2991,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (2994,2040.00,'Q1',20.00,20.00,2000.00,2994);
INSERT INTO payments VALUES (2995,1010.00,'full',0.00,10.00,1000.00,2995);
INSERT INTO payments VALUES (2998,1010.00,'full',0.00,10.00,1000.00,2998);
INSERT INTO payments VALUES (2999,2040.00,'Q1',20.00,20.00,2000.00,2999);
INSERT INTO payments VALUES (3000,1010.00,'full',0.00,10.00,1000.00,3000);
INSERT INTO payments VALUES (3001,2040.00,'Q1',20.00,20.00,2000.00,3001);
INSERT INTO payments VALUES (3002,1010.00,'full',0.00,10.00,1000.00,3002);
INSERT INTO payments VALUES (3004,1010.00,'full',0.00,10.00,1000.00,3004);
INSERT INTO payments VALUES (3005,2040.00,'Q1',20.00,20.00,2000.00,3005);
INSERT INTO payments VALUES (3007,2040.00,'Q1',20.00,20.00,2000.00,3007);
INSERT INTO payments VALUES (3008,2040.00,'Q1',20.00,20.00,2000.00,3008);
INSERT INTO payments VALUES (3010,1010.00,'full',0.00,10.00,1000.00,3010);
INSERT INTO payments VALUES (3013,1010.00,'full',0.00,10.00,1000.00,3013);
INSERT INTO payments VALUES (3014,2040.00,'Q1',20.00,20.00,2000.00,3014);
INSERT INTO payments VALUES (3015,1010.00,'full',0.00,10.00,1000.00,3015);
INSERT INTO payments VALUES (3016,2040.00,'Q1',20.00,20.00,2000.00,3016);
INSERT INTO payments VALUES (3017,1010.00,'full',0.00,10.00,1000.00,3017);
INSERT INTO payments VALUES (3019,1010.00,'full',0.00,10.00,1000.00,3019);
INSERT INTO payments VALUES (3020,2040.00,'Q1',20.00,20.00,2000.00,3020);
INSERT INTO payments VALUES (3022,2040.00,'Q1',20.00,20.00,2000.00,3022);
INSERT INTO payments VALUES (3023,2040.00,'Q1',20.00,20.00,2000.00,3023);
INSERT INTO payments VALUES (3025,1010.00,'full',0.00,10.00,1000.00,3025);
INSERT INTO payments VALUES (3028,1010.00,'full',0.00,10.00,1000.00,3028);
INSERT INTO payments VALUES (3029,2040.00,'Q1',20.00,20.00,2000.00,3029);
INSERT INTO payments VALUES (3030,1010.00,'full',0.00,10.00,1000.00,3030);
INSERT INTO payments VALUES (3031,2040.00,'Q1',20.00,20.00,2000.00,3031);
INSERT INTO payments VALUES (3032,1010.00,'full',0.00,10.00,1000.00,3032);
INSERT INTO payments VALUES (3034,1010.00,'full',0.00,10.00,1000.00,3034);
INSERT INTO payments VALUES (3035,2040.00,'Q1',20.00,20.00,2000.00,3035);
INSERT INTO payments VALUES (3037,2040.00,'Q1',20.00,20.00,2000.00,3037);
INSERT INTO payments VALUES (3038,2040.00,'Q1',20.00,20.00,2000.00,3038);
INSERT INTO payments VALUES (3040,1010.00,'full',0.00,10.00,1000.00,3040);
INSERT INTO payments VALUES (3043,1010.00,'full',0.00,10.00,1000.00,3043);
INSERT INTO payments VALUES (3044,2040.00,'Q1',20.00,20.00,2000.00,3044);
INSERT INTO payments VALUES (3045,1010.00,'full',0.00,10.00,1000.00,3045);
INSERT INTO payments VALUES (3046,2040.00,'Q1',20.00,20.00,2000.00,3046);
INSERT INTO payments VALUES (3047,1010.00,'full',0.00,10.00,1000.00,3047);
INSERT INTO payments VALUES (3049,1010.00,'full',0.00,10.00,1000.00,3049);
INSERT INTO payments VALUES (3050,2040.00,'Q1',20.00,20.00,2000.00,3050);
INSERT INTO payments VALUES (3052,2040.00,'Q1',20.00,20.00,2000.00,3052);
INSERT INTO payments VALUES (3053,2040.00,'Q1',20.00,20.00,2000.00,3053);
INSERT INTO payments VALUES (3055,1010.00,'full',0.00,10.00,1000.00,3055);
INSERT INTO payments VALUES (3058,1010.00,'full',0.00,10.00,1000.00,3058);
INSERT INTO payments VALUES (3059,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (3060,1010.00,'full',0.00,10.00,1000.00,3060);
INSERT INTO payments VALUES (3061,1010.00,'full',0.00,10.00,1000.00,3061);
INSERT INTO payments VALUES (3062,1010.00,'full',0.00,10.00,1000.00,3062);
INSERT INTO payments VALUES (3063,2040.00,'Q1',20.00,20.00,2000.00,3063);
INSERT INTO payments VALUES (3064,2040.00,'Q1',20.00,20.00,2000.00,3064);
INSERT INTO payments VALUES (3065,1010.00,'full',0.00,10.00,1000.00,3065);
INSERT INTO payments VALUES (3066,2040.00,'Q1',20.00,20.00,2000.00,3066);
INSERT INTO payments VALUES (3067,2040.00,'Q1',20.00,20.00,2000.00,3067);
INSERT INTO payments VALUES (3070,2040.00,'Q1',20.00,20.00,2000.00,3070);
INSERT INTO payments VALUES (3072,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3074,1010.00,'full',0.00,10.00,1000.00,3074);
INSERT INTO payments VALUES (3075,1010.00,'full',0.00,10.00,1000.00,3075);
INSERT INTO payments VALUES (3076,1010.00,'full',0.00,10.00,1000.00,3076);
INSERT INTO payments VALUES (3077,1010.00,'full',0.00,10.00,1000.00,3077);
INSERT INTO payments VALUES (3078,2040.00,'Q1',20.00,20.00,2000.00,3078);
INSERT INTO payments VALUES (3079,2040.00,'Q1',20.00,20.00,2000.00,3079);
INSERT INTO payments VALUES (3080,1010.00,'full',0.00,10.00,1000.00,3080);
INSERT INTO payments VALUES (3081,2040.00,'Q1',20.00,20.00,2000.00,3081);
INSERT INTO payments VALUES (3082,2040.00,'Q1',20.00,20.00,2000.00,3082);
INSERT INTO payments VALUES (3085,2040.00,'Q1',20.00,20.00,2000.00,3085);
INSERT INTO payments VALUES (3087,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3089,1010.00,'full',0.00,10.00,1000.00,3089);
INSERT INTO payments VALUES (3090,1010.00,'full',0.00,10.00,1000.00,3090);
INSERT INTO payments VALUES (3091,1010.00,'full',0.00,10.00,1000.00,3091);
INSERT INTO payments VALUES (3092,1010.00,'full',0.00,10.00,1000.00,3092);
INSERT INTO payments VALUES (3093,2040.00,'Q1',20.00,20.00,2000.00,3093);
INSERT INTO payments VALUES (3094,2040.00,'Q1',20.00,20.00,2000.00,3094);
INSERT INTO payments VALUES (3095,1010.00,'full',0.00,10.00,1000.00,3095);
INSERT INTO payments VALUES (3096,2040.00,'Q1',20.00,20.00,2000.00,3096);
INSERT INTO payments VALUES (3097,2040.00,'Q1',20.00,20.00,2000.00,3097);
INSERT INTO payments VALUES (3100,2040.00,'Q1',20.00,20.00,2000.00,3100);
INSERT INTO payments VALUES (3102,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3104,1010.00,'full',0.00,10.00,1000.00,3104);
INSERT INTO payments VALUES (3105,1010.00,'full',0.00,10.00,1000.00,3105);
INSERT INTO payments VALUES (3106,1010.00,'full',0.00,10.00,1000.00,3106);
INSERT INTO payments VALUES (3107,1010.00,'full',0.00,10.00,1000.00,3107);
INSERT INTO payments VALUES (3108,2040.00,'Q1',20.00,20.00,2000.00,3108);
INSERT INTO payments VALUES (3109,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (3110,1010.00,'full',0.00,10.00,1000.00,3110);
INSERT INTO payments VALUES (3111,2040.00,'Q1',20.00,20.00,2000.00,3111);
INSERT INTO payments VALUES (3112,2040.00,'Q1',20.00,20.00,2000.00,3112);
INSERT INTO payments VALUES (3113,1010.00,'full',0.00,10.00,1000.00,3113);
INSERT INTO payments VALUES (3115,2040.00,'Q1',20.00,20.00,2000.00,3115);
INSERT INTO payments VALUES (3118,2040.00,'Q1',20.00,20.00,2000.00,3118);
INSERT INTO payments VALUES (3120,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3122,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3123,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3124,1010.00,'full',0.00,10.00,1000.00,3124);
INSERT INTO payments VALUES (3125,1010.00,'full',0.00,10.00,1000.00,3125);
INSERT INTO payments VALUES (3126,1010.00,'full',0.00,10.00,1000.00,3126);
INSERT INTO payments VALUES (3127,1010.00,'full',0.00,10.00,1000.00,3127);
INSERT INTO payments VALUES (3128,1010.00,'full',0.00,10.00,1000.00,3128);
INSERT INTO payments VALUES (3129,2040.00,'Q1',20.00,20.00,2000.00,3129);
INSERT INTO payments VALUES (3130,2040.00,'Q1',20.00,20.00,2000.00,3130);
INSERT INTO payments VALUES (3131,2040.00,'Q1',20.00,20.00,2000.00,3131);
INSERT INTO payments VALUES (3132,2040.00,'Q1',20.00,20.00,2000.00,3132);
INSERT INTO payments VALUES (3133,2040.00,'Q1',20.00,20.00,2000.00,3133);
INSERT INTO payments VALUES (3139,1010.00,'full',0.00,10.00,1000.00,3139);
INSERT INTO payments VALUES (3140,1010.00,'full',0.00,10.00,1000.00,3140);
INSERT INTO payments VALUES (3141,1010.00,'full',0.00,10.00,1000.00,3141);
INSERT INTO payments VALUES (3142,1010.00,'full',0.00,10.00,1000.00,3142);
INSERT INTO payments VALUES (3143,2040.00,'Q1',20.00,20.00,2000.00,3143);
INSERT INTO payments VALUES (3144,1010.00,'full',0.00,10.00,1000.00,3144);
INSERT INTO payments VALUES (3145,2040.00,'Q1',20.00,20.00,2000.00,3145);
INSERT INTO payments VALUES (3146,2040.00,'Q1',20.00,20.00,2000.00,3146);
INSERT INTO payments VALUES (3147,2040.00,'Q1',20.00,20.00,2000.00,3147);
INSERT INTO payments VALUES (3149,2040.00,'Q1',20.00,20.00,2000.00,3149);
INSERT INTO payments VALUES (3154,1010.00,'full',0.00,10.00,1000.00,3154);
INSERT INTO payments VALUES (3155,1010.00,'full',0.00,10.00,1000.00,3155);
INSERT INTO payments VALUES (3156,2040.00,'Q1',20.00,20.00,2000.00,3156);
INSERT INTO payments VALUES (3157,1010.00,'full',0.00,10.00,1000.00,3157);
INSERT INTO payments VALUES (3158,1010.00,'full',0.00,10.00,1000.00,3158);
INSERT INTO payments VALUES (3159,1010.00,'full',0.00,10.00,1000.00,3159);
INSERT INTO payments VALUES (3160,2040.00,'Q1',20.00,20.00,2000.00,3160);
INSERT INTO payments VALUES (3162,2040.00,'Q1',20.00,20.00,2000.00,3162);
INSERT INTO payments VALUES (3163,2040.00,'Q1',20.00,20.00,2000.00,3163);
INSERT INTO payments VALUES (3164,2040.00,'Q1',20.00,20.00,2000.00,3164);
INSERT INTO payments VALUES (3168,1010.00,'full',0.00,10.00,1000.00,3168);
INSERT INTO payments VALUES (3170,1010.00,'full',0.00,10.00,1000.00,3170);
INSERT INTO payments VALUES (3171,2040.00,'Q1',20.00,20.00,2000.00,3171);
INSERT INTO payments VALUES (3172,1010.00,'full',0.00,10.00,1000.00,3172);
INSERT INTO payments VALUES (3173,1010.00,'full',0.00,10.00,1000.00,3173);
INSERT INTO payments VALUES (3174,1010.00,'full',0.00,10.00,1000.00,3174);
INSERT INTO payments VALUES (3175,2040.00,'Q1',20.00,20.00,2000.00,3175);
INSERT INTO payments VALUES (3177,2040.00,'Q1',20.00,20.00,2000.00,3177);
INSERT INTO payments VALUES (3178,2040.00,'Q1',20.00,20.00,2000.00,3178);
INSERT INTO payments VALUES (3179,2040.00,'Q1',20.00,20.00,2000.00,3179);
INSERT INTO payments VALUES (3183,1010.00,'full',0.00,10.00,1000.00,3183);
INSERT INTO payments VALUES (3185,1010.00,'full',0.00,10.00,1000.00,3185);
INSERT INTO payments VALUES (3186,2040.00,'Q1',20.00,20.00,2000.00,3186);
INSERT INTO payments VALUES (3187,1010.00,'full',0.00,10.00,1000.00,3187);
INSERT INTO payments VALUES (3188,1010.00,'full',0.00,10.00,1000.00,3188);
INSERT INTO payments VALUES (3189,2040.00,'Q1',20.00,20.00,2000.00,3189);
INSERT INTO payments VALUES (3191,1010.00,'full',0.00,10.00,1000.00,3191);
INSERT INTO payments VALUES (3192,2040.00,'Q1',20.00,20.00,2000.00,3192);
INSERT INTO payments VALUES (3193,2040.00,'Q1',20.00,20.00,2000.00,3193);
INSERT INTO payments VALUES (3195,2040.00,'Q1',20.00,20.00,2000.00,3195);
INSERT INTO payments VALUES (3197,1010.00,'full',0.00,10.00,1000.00,3197);
INSERT INTO payments VALUES (3200,1010.00,'full',0.00,10.00,1000.00,3200);
INSERT INTO payments VALUES (3201,2040.00,'Q1',20.00,20.00,2000.00,3201);
INSERT INTO payments VALUES (3202,1010.00,'full',0.00,10.00,1000.00,3202);
INSERT INTO payments VALUES (3203,2040.00,'Q1',20.00,20.00,2000.00,3203);
INSERT INTO payments VALUES (3204,1010.00,'full',0.00,10.00,1000.00,3204);
INSERT INTO payments VALUES (3206,1010.00,'full',0.00,10.00,1000.00,3206);
INSERT INTO payments VALUES (3207,2040.00,'Q1',20.00,20.00,2000.00,3207);
INSERT INTO payments VALUES (3209,2040.00,'Q1',20.00,20.00,2000.00,3209);
INSERT INTO payments VALUES (3210,2040.00,'Q1',20.00,20.00,2000.00,3210);
INSERT INTO payments VALUES (3212,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3215,1010.00,'full',0.00,10.00,1000.00,3215);
INSERT INTO payments VALUES (3216,1010.00,'full',0.00,10.00,1000.00,3216);
INSERT INTO payments VALUES (3217,1010.00,'full',0.00,10.00,1000.00,3217);
INSERT INTO payments VALUES (3218,2040.00,'Q1',20.00,20.00,2000.00,3218);
INSERT INTO payments VALUES (3219,1010.00,'full',0.00,10.00,1000.00,3219);
INSERT INTO payments VALUES (3220,2040.00,'Q1',20.00,20.00,2000.00,3220);
INSERT INTO payments VALUES (3221,1010.00,'full',0.00,10.00,1000.00,3221);
INSERT INTO payments VALUES (3222,2040.00,'Q1',20.00,20.00,2000.00,3222);
INSERT INTO payments VALUES (3224,2040.00,'Q1',20.00,20.00,2000.00,3224);
INSERT INTO payments VALUES (3226,2040.00,'Q1',20.00,20.00,2000.00,3226);
INSERT INTO payments VALUES (3229,1010.00,'full',0.00,10.00,1000.00,3229);
INSERT INTO payments VALUES (3231,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3232,2040.00,'Q1',20.00,20.00,2000.00,3232);
INSERT INTO payments VALUES (3233,1010.00,'full',0.00,10.00,1000.00,3233);
INSERT INTO payments VALUES (3234,1010.00,'full',0.00,10.00,1000.00,3234);
INSERT INTO payments VALUES (3235,1010.00,'full',0.00,10.00,1000.00,3235);
INSERT INTO payments VALUES (3236,1010.00,'full',0.00,10.00,1000.00,3236);
INSERT INTO payments VALUES (3238,2040.00,'Q1',20.00,20.00,2000.00,3238);
INSERT INTO payments VALUES (3239,2040.00,'Q1',20.00,20.00,2000.00,3239);
INSERT INTO payments VALUES (3240,2040.00,'Q1',20.00,20.00,2000.00,3240);
INSERT INTO payments VALUES (3241,2040.00,'Q1',20.00,20.00,2000.00,3241);
INSERT INTO payments VALUES (3246,1010.00,'full',0.00,10.00,1000.00,3246);
INSERT INTO payments VALUES (3247,1010.00,'full',0.00,10.00,1000.00,3247);
INSERT INTO payments VALUES (3248,1010.00,'full',0.00,10.00,1000.00,3248);
INSERT INTO payments VALUES (3249,1010.00,'full',0.00,10.00,1000.00,3249);
INSERT INTO payments VALUES (3250,1010.00,'full',0.00,10.00,1000.00,3250);
INSERT INTO payments VALUES (3251,2040.00,'Q1',20.00,20.00,2000.00,3251);
INSERT INTO payments VALUES (3252,2040.00,'Q1',20.00,20.00,2000.00,3252);
INSERT INTO payments VALUES (3253,2040.00,'Q1',20.00,20.00,2000.00,3253);
INSERT INTO payments VALUES (3254,2040.00,'Q1',20.00,20.00,2000.00,3254);
INSERT INTO payments VALUES (3255,2040.00,'Q1',20.00,20.00,2000.00,3255);
INSERT INTO payments VALUES (3261,1010.00,'full',0.00,10.00,1000.00,3261);
INSERT INTO payments VALUES (3262,1010.00,'full',0.00,10.00,1000.00,3262);
INSERT INTO payments VALUES (3263,1010.00,'full',0.00,10.00,1000.00,3263);
INSERT INTO payments VALUES (3264,1010.00,'full',0.00,10.00,1000.00,3264);
INSERT INTO payments VALUES (3265,1010.00,'full',0.00,10.00,1000.00,3265);
INSERT INTO payments VALUES (3266,1010.00,'full',0.00,10.00,1000.00,3266);
INSERT INTO payments VALUES (3267,2040.00,'Q1',20.00,20.00,2000.00,3267);
INSERT INTO payments VALUES (3268,2040.00,'Q1',20.00,20.00,2000.00,3268);
INSERT INTO payments VALUES (3269,2040.00,'Q1',20.00,20.00,2000.00,3269);
INSERT INTO payments VALUES (3270,2040.00,'Q1',20.00,20.00,2000.00,3270);
INSERT INTO payments VALUES (3271,2040.00,'Q1',20.00,20.00,2000.00,3271);
INSERT INTO payments VALUES (3272,2040.00,'Q1',20.00,20.00,2000.00,3272);
INSERT INTO payments VALUES (3279,1010.00,'full',0.00,10.00,1000.00,3279);
INSERT INTO payments VALUES (3280,1010.00,'full',0.00,10.00,1000.00,3280);
INSERT INTO payments VALUES (3281,1010.00,'full',0.00,10.00,1000.00,3281);
INSERT INTO payments VALUES (3282,1010.00,'full',0.00,10.00,1000.00,3282);
INSERT INTO payments VALUES (3283,2040.00,'Q1',20.00,20.00,2000.00,3283);
INSERT INTO payments VALUES (3284,2040.00,'Q1',20.00,20.00,2000.00,3284);
INSERT INTO payments VALUES (3285,2040.00,'Q1',20.00,20.00,2000.00,3285);
INSERT INTO payments VALUES (3286,2040.00,'Q1',20.00,20.00,2000.00,3286);
INSERT INTO payments VALUES (3291,1010.00,'full',0.00,10.00,1000.00,3291);
INSERT INTO payments VALUES (3292,1010.00,'full',0.00,10.00,1000.00,3292);
INSERT INTO payments VALUES (3293,1010.00,'full',0.00,10.00,1000.00,3293);
INSERT INTO payments VALUES (3294,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3295,1010.00,'full',0.00,10.00,1000.00,3295);
INSERT INTO payments VALUES (3296,2040.00,'Q1',20.00,20.00,2000.00,3296);
INSERT INTO payments VALUES (3297,2040.00,'Q1',20.00,20.00,2000.00,3297);
INSERT INTO payments VALUES (3298,1010.00,'full',0.00,10.00,1000.00,3298);
INSERT INTO payments VALUES (3299,2040.00,'Q1',20.00,20.00,2000.00,3299);
INSERT INTO payments VALUES (3300,2040.00,'Q1',20.00,20.00,2000.00,3300);
INSERT INTO payments VALUES (3303,2040.00,'Q1',20.00,20.00,2000.00,3303);
INSERT INTO payments VALUES (3305,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3307,1010.00,'full',0.00,10.00,1000.00,3307);
INSERT INTO payments VALUES (3308,1010.00,'full',0.00,10.00,1000.00,3308);
INSERT INTO payments VALUES (3309,1010.00,'full',0.00,10.00,1000.00,3309);
INSERT INTO payments VALUES (3310,1010.00,'full',0.00,10.00,1000.00,3310);
INSERT INTO payments VALUES (3311,1010.00,'full',0.00,10.00,1000.00,3311);
INSERT INTO payments VALUES (3312,2040.00,'Q1',20.00,20.00,2000.00,3312);
INSERT INTO payments VALUES (3313,2040.00,'Q1',20.00,20.00,2000.00,3313);
INSERT INTO payments VALUES (3314,1010.00,'full',0.00,10.00,1000.00,3314);
INSERT INTO payments VALUES (3315,2040.00,'Q1',20.00,20.00,2000.00,3315);
INSERT INTO payments VALUES (3316,2040.00,'Q1',20.00,20.00,2000.00,3316);
INSERT INTO payments VALUES (3317,2040.00,'Q1',20.00,20.00,2000.00,3317);
INSERT INTO payments VALUES (3320,2040.00,'Q1',20.00,20.00,2000.00,3320);
INSERT INTO payments VALUES (3325,1010.00,'full',0.00,10.00,1000.00,3325);
INSERT INTO payments VALUES (3326,1010.00,'full',0.00,10.00,1000.00,3326);
INSERT INTO payments VALUES (3327,1010.00,'full',0.00,10.00,1000.00,3327);
INSERT INTO payments VALUES (3328,1010.00,'full',0.00,10.00,1000.00,3328);
INSERT INTO payments VALUES (3329,2040.00,'Q1',20.00,20.00,2000.00,3329);
INSERT INTO payments VALUES (3330,2040.00,'Q1',20.00,20.00,2000.00,3330);
INSERT INTO payments VALUES (3331,1010.00,'full',0.00,10.00,1000.00,3331);
INSERT INTO payments VALUES (3332,2040.00,'Q1',20.00,20.00,2000.00,3332);
INSERT INTO payments VALUES (3333,2040.00,'Q1',20.00,20.00,2000.00,3333);
INSERT INTO payments VALUES (3336,2040.00,'Q1',20.00,20.00,2000.00,3336);
INSERT INTO payments VALUES (3338,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3340,1010.00,'full',0.00,10.00,1000.00,3340);
INSERT INTO payments VALUES (3341,1010.00,'full',0.00,10.00,1000.00,3341);
INSERT INTO payments VALUES (3342,1010.00,'full',0.00,10.00,1000.00,3342);
INSERT INTO payments VALUES (3343,1010.00,'full',0.00,10.00,1000.00,3343);
INSERT INTO payments VALUES (3344,2040.00,'Q1',20.00,20.00,2000.00,3344);
INSERT INTO payments VALUES (3345,2040.00,'Q1',20.00,20.00,2000.00,3345);
INSERT INTO payments VALUES (3346,1010.00,'full',0.00,10.00,1000.00,3346);
INSERT INTO payments VALUES (3347,2040.00,'Q1',20.00,20.00,2000.00,3347);
INSERT INTO payments VALUES (3348,2040.00,'Q1',20.00,20.00,2000.00,3348);
INSERT INTO payments VALUES (3351,2040.00,'Q1',20.00,20.00,2000.00,3351);
INSERT INTO payments VALUES (3353,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3355,1010.00,'full',0.00,10.00,1000.00,3355);
INSERT INTO payments VALUES (3356,1010.00,'full',0.00,10.00,1000.00,3356);
INSERT INTO payments VALUES (3357,1010.00,'full',0.00,10.00,1000.00,3357);
INSERT INTO payments VALUES (3358,1010.00,'full',0.00,10.00,1000.00,3358);
INSERT INTO payments VALUES (3359,2040.00,'Q1',20.00,20.00,2000.00,3359);
INSERT INTO payments VALUES (3360,2040.00,'Q1',20.00,20.00,2000.00,3360);
INSERT INTO payments VALUES (3361,1010.00,'full',0.00,10.00,1000.00,3361);
INSERT INTO payments VALUES (3362,2040.00,'Q1',20.00,20.00,2000.00,3362);
INSERT INTO payments VALUES (3363,2040.00,'Q1',20.00,20.00,2000.00,3363);
INSERT INTO payments VALUES (3365,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3366,2040.00,'Q1',20.00,20.00,2000.00,3366);
INSERT INTO payments VALUES (3369,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3371,1010.00,'full',0.00,10.00,1000.00,3371);
INSERT INTO payments VALUES (3372,1010.00,'full',0.00,10.00,1000.00,3372);
INSERT INTO payments VALUES (3373,1010.00,'full',0.00,10.00,1000.00,3373);
INSERT INTO payments VALUES (3374,2040.00,'Q1',20.00,20.00,2000.00,3374);
INSERT INTO payments VALUES (3375,1010.00,'full',0.00,10.00,1000.00,3375);
INSERT INTO payments VALUES (3376,2040.00,'Q1',20.00,20.00,2000.00,3376);
INSERT INTO payments VALUES (3377,1010.00,'full',0.00,10.00,1000.00,3377);
INSERT INTO payments VALUES (3378,2040.00,'Q1',20.00,20.00,2000.00,3378);
INSERT INTO payments VALUES (3380,2040.00,'Q1',20.00,20.00,2000.00,3380);
INSERT INTO payments VALUES (3382,2040.00,'Q1',20.00,20.00,2000.00,3382);
INSERT INTO payments VALUES (3384,1010.00,'full',0.00,10.00,1000.00,3384);
INSERT INTO payments VALUES (3386,1010.00,'full',0.00,10.00,1000.00,3386);
INSERT INTO payments VALUES (3388,1010.00,'full',0.00,10.00,1000.00,3388);
INSERT INTO payments VALUES (3389,2040.00,'Q1',20.00,20.00,2000.00,3389);
INSERT INTO payments VALUES (3390,1010.00,'full',0.00,10.00,1000.00,3390);
INSERT INTO payments VALUES (3391,2040.00,'Q1',20.00,20.00,2000.00,3391);
INSERT INTO payments VALUES (3392,1010.00,'full',0.00,10.00,1000.00,3392);
INSERT INTO payments VALUES (3393,2040.00,'Q1',20.00,20.00,2000.00,3393);
INSERT INTO payments VALUES (3395,1010.00,'full',0.00,10.00,1000.00,3395);
INSERT INTO payments VALUES (3396,2040.00,'Q1',20.00,20.00,2000.00,3396);
INSERT INTO payments VALUES (3398,2040.00,'Q1',20.00,20.00,2000.00,3398);
INSERT INTO payments VALUES (3400,2040.00,'Q1',20.00,20.00,2000.00,3400);
INSERT INTO payments VALUES (3403,1010.00,'full',0.00,10.00,1000.00,3403);
INSERT INTO payments VALUES (3405,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3406,2040.00,'Q1',20.00,20.00,2000.00,3406);
INSERT INTO payments VALUES (3407,1010.00,'full',0.00,10.00,1000.00,3407);
INSERT INTO payments VALUES (3408,1010.00,'full',0.00,10.00,1000.00,3408);
INSERT INTO payments VALUES (3409,1010.00,'full',0.00,10.00,1000.00,3409);
INSERT INTO payments VALUES (3410,1010.00,'full',0.00,10.00,1000.00,3410);
INSERT INTO payments VALUES (3412,2040.00,'Q1',20.00,20.00,2000.00,3412);
INSERT INTO payments VALUES (3413,2040.00,'Q1',20.00,20.00,2000.00,3413);
INSERT INTO payments VALUES (3414,2040.00,'Q1',20.00,20.00,2000.00,3414);
INSERT INTO payments VALUES (3415,2040.00,'Q1',20.00,20.00,2000.00,3415);
INSERT INTO payments VALUES (3418,1010.00,'full',0.00,10.00,1000.00,3418);
INSERT INTO payments VALUES (3420,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3421,2040.00,'Q1',20.00,20.00,2000.00,3421);
INSERT INTO payments VALUES (3422,1010.00,'full',0.00,10.00,1000.00,3422);
INSERT INTO payments VALUES (3423,1010.00,'full',0.00,10.00,1000.00,3423);
INSERT INTO payments VALUES (3424,1010.00,'full',0.00,10.00,1000.00,3424);
INSERT INTO payments VALUES (3425,1010.00,'full',0.00,10.00,1000.00,3425);
INSERT INTO payments VALUES (3427,2040.00,'Q1',20.00,20.00,2000.00,3427);
INSERT INTO payments VALUES (3428,2040.00,'Q1',20.00,20.00,2000.00,3428);
INSERT INTO payments VALUES (3429,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (3430,2040.00,'Q1',20.00,20.00,2000.00,3430);
INSERT INTO payments VALUES (3432,1010.00,'full',0.00,10.00,1000.00,3432);
INSERT INTO payments VALUES (3433,1010.00,'full',0.00,10.00,1000.00,3433);
INSERT INTO payments VALUES (3435,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3436,2040.00,'Q1',20.00,20.00,2000.00,3436);
INSERT INTO payments VALUES (3437,2040.00,'Q1',20.00,20.00,2000.00,3437);
INSERT INTO payments VALUES (3438,1010.00,'full',0.00,10.00,1000.00,3438);
INSERT INTO payments VALUES (3439,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3441,1010.00,'full',0.00,10.00,1000.00,3441);
INSERT INTO payments VALUES (3443,1010.00,'full',0.00,10.00,1000.00,3443);
INSERT INTO payments VALUES (3444,2040.00,'Q1',20.00,20.00,2000.00,3444);
INSERT INTO payments VALUES (3445,2040.00,'Q1',20.00,20.00,2000.00,3445);
INSERT INTO payments VALUES (3446,1010.00,'full',0.00,10.00,1000.00,3446);
INSERT INTO payments VALUES (3447,2040.00,'Q1',20.00,20.00,2000.00,3447);
INSERT INTO payments VALUES (3449,1010.00,'full',0.00,10.00,1000.00,3449);
INSERT INTO payments VALUES (3451,2040.00,'Q1',20.00,20.00,2000.00,3451);
INSERT INTO payments VALUES (3453,2040.00,'Q1',20.00,20.00,2000.00,3453);
INSERT INTO payments VALUES (3454,1010.00,'full',0.00,10.00,1000.00,3454);
INSERT INTO payments VALUES (3456,1010.00,'full',0.00,10.00,1000.00,3456);
INSERT INTO payments VALUES (3458,2040.00,'Q1',20.00,20.00,2000.00,3458);
INSERT INTO payments VALUES (3459,1010.00,'full',0.00,10.00,1000.00,3459);
INSERT INTO payments VALUES (3460,2040.00,'Q1',20.00,20.00,2000.00,3460);
INSERT INTO payments VALUES (3461,1010.00,'full',0.00,10.00,1000.00,3461);
INSERT INTO payments VALUES (3463,2040.00,'Q1',20.00,20.00,2000.00,3463);
INSERT INTO payments VALUES (3464,1010.00,'full',0.00,10.00,1000.00,3464);
INSERT INTO payments VALUES (3466,2040.00,'Q1',20.00,20.00,2000.00,3466);
INSERT INTO payments VALUES (3468,2040.00,'Q1',20.00,20.00,2000.00,3468);
INSERT INTO payments VALUES (3469,1010.00,'full',0.00,10.00,1000.00,3469);
INSERT INTO payments VALUES (3471,1010.00,'full',0.00,10.00,1000.00,3471);
INSERT INTO payments VALUES (3473,2040.00,'Q1',20.00,20.00,2000.00,3473);
INSERT INTO payments VALUES (3474,1010.00,'full',0.00,10.00,1000.00,3474);
INSERT INTO payments VALUES (3475,2040.00,'Q1',20.00,20.00,2000.00,3475);
INSERT INTO payments VALUES (3476,1010.00,'full',0.00,10.00,1000.00,3476);
INSERT INTO payments VALUES (3478,2040.00,'Q1',20.00,20.00,2000.00,3478);
INSERT INTO payments VALUES (3479,1010.00,'full',0.00,10.00,1000.00,3479);
INSERT INTO payments VALUES (3481,2040.00,'Q1',20.00,20.00,2000.00,3481);
INSERT INTO payments VALUES (3483,2040.00,'Q1',20.00,20.00,2000.00,3483);
INSERT INTO payments VALUES (3484,1010.00,'full',0.00,10.00,1000.00,3484);
INSERT INTO payments VALUES (3486,1010.00,'full',0.00,10.00,1000.00,3486);
INSERT INTO payments VALUES (3488,2040.00,'Q1',20.00,20.00,2000.00,3488);
INSERT INTO payments VALUES (3489,1010.00,'full',0.00,10.00,1000.00,3489);
INSERT INTO payments VALUES (3490,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (3491,1010.00,'full',0.00,10.00,1000.00,3491);
INSERT INTO payments VALUES (3493,1010.00,'full',0.00,10.00,1000.00,3493);
INSERT INTO payments VALUES (3494,1010.00,'full',0.00,10.00,1000.00,3494);
INSERT INTO payments VALUES (3495,2040.00,'Q1',20.00,20.00,2000.00,3495);
INSERT INTO payments VALUES (3496,2040.00,'Q1',20.00,20.00,2000.00,3496);
INSERT INTO payments VALUES (3497,2040.00,'Q1',20.00,20.00,2000.00,3497);
INSERT INTO payments VALUES (3498,2040.00,'Q1',20.00,20.00,2000.00,3498);
INSERT INTO payments VALUES (3499,1010.00,'full',0.00,10.00,1000.00,3499);
INSERT INTO payments VALUES (3504,2040.00,'Q1',20.00,20.00,2000.00,3504);
INSERT INTO payments VALUES (3505,1010.00,'full',0.00,10.00,1000.00,3505);
INSERT INTO payments VALUES (3506,1010.00,'full',0.00,10.00,1000.00,3506);
INSERT INTO payments VALUES (3508,1010.00,'full',0.00,10.00,1000.00,3508);
INSERT INTO payments VALUES (3509,1010.00,'full',0.00,10.00,1000.00,3509);
INSERT INTO payments VALUES (3510,2040.00,'Q1',20.00,20.00,2000.00,3510);
INSERT INTO payments VALUES (3511,2040.00,'Q1',20.00,20.00,2000.00,3511);
INSERT INTO payments VALUES (3512,2040.00,'Q1',20.00,20.00,2000.00,3512);
INSERT INTO payments VALUES (3513,2040.00,'Q1',20.00,20.00,2000.00,3513);
INSERT INTO payments VALUES (3514,1010.00,'full',0.00,10.00,1000.00,3514);
INSERT INTO payments VALUES (3519,2040.00,'Q1',20.00,20.00,2000.00,3519);
INSERT INTO payments VALUES (3520,1010.00,'full',0.00,10.00,1000.00,3520);
INSERT INTO payments VALUES (3521,1010.00,'full',0.00,10.00,1000.00,3521);
INSERT INTO payments VALUES (3523,1010.00,'full',0.00,10.00,1000.00,3523);
INSERT INTO payments VALUES (3524,1010.00,'full',0.00,10.00,1000.00,3524);
INSERT INTO payments VALUES (3525,2040.00,'Q1',20.00,20.00,2000.00,3525);
INSERT INTO payments VALUES (3526,2040.00,'Q1',20.00,20.00,2000.00,3526);
INSERT INTO payments VALUES (3527,2040.00,'Q1',20.00,20.00,2000.00,3527);
INSERT INTO payments VALUES (3528,2040.00,'Q1',20.00,20.00,2000.00,3528);
INSERT INTO payments VALUES (3529,1010.00,'full',0.00,10.00,1000.00,3529);
INSERT INTO payments VALUES (3534,2040.00,'Q1',20.00,20.00,2000.00,3534);
INSERT INTO payments VALUES (3535,1010.00,'full',0.00,10.00,1000.00,3535);
INSERT INTO payments VALUES (3536,1010.00,'full',0.00,10.00,1000.00,3536);
INSERT INTO payments VALUES (3538,1010.00,'full',0.00,10.00,1000.00,3538);
INSERT INTO payments VALUES (3539,1010.00,'full',0.00,10.00,1000.00,3539);
INSERT INTO payments VALUES (3540,2040.00,'Q1',20.00,20.00,2000.00,3540);
INSERT INTO payments VALUES (3541,2040.00,'Q1',20.00,20.00,2000.00,3541);
INSERT INTO payments VALUES (3542,2040.00,'Q1',20.00,20.00,2000.00,3542);
INSERT INTO payments VALUES (3543,2040.00,'Q1',20.00,20.00,2000.00,3543);
INSERT INTO payments VALUES (3544,1010.00,'full',0.00,10.00,1000.00,3544);
INSERT INTO payments VALUES (3549,2040.00,'Q1',20.00,20.00,2000.00,3549);
INSERT INTO payments VALUES (3550,1010.00,'full',0.00,10.00,1000.00,3550);
INSERT INTO payments VALUES (3551,1010.00,'full',0.00,10.00,1000.00,3551);
INSERT INTO payments VALUES (3552,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3553,1010.00,'full',0.00,10.00,1000.00,3553);
INSERT INTO payments VALUES (3554,1010.00,'full',0.00,10.00,1000.00,3554);
INSERT INTO payments VALUES (3555,2040.00,'Q1',20.00,20.00,2000.00,3555);
INSERT INTO payments VALUES (3556,1010.00,'full',0.00,10.00,1000.00,3556);
INSERT INTO payments VALUES (3557,2040.00,'Q1',20.00,20.00,2000.00,3557);
INSERT INTO payments VALUES (3558,2040.00,'Q1',20.00,20.00,2000.00,3558);
INSERT INTO payments VALUES (3559,2040.00,'Q1',20.00,20.00,2000.00,3559);
INSERT INTO payments VALUES (3561,2040.00,'Q1',20.00,20.00,2000.00,3561);
INSERT INTO payments VALUES (3566,1010.00,'full',0.00,10.00,1000.00,3566);
INSERT INTO payments VALUES (3567,1010.00,'full',0.00,10.00,1000.00,3567);
INSERT INTO payments VALUES (3568,1010.00,'full',0.00,10.00,1000.00,3568);
INSERT INTO payments VALUES (3569,2040.00,'Q1',20.00,20.00,2000.00,3569);
INSERT INTO payments VALUES (3570,1010.00,'full',0.00,10.00,1000.00,3570);
INSERT INTO payments VALUES (3571,1010.00,'full',0.00,10.00,1000.00,3571);
INSERT INTO payments VALUES (3572,2040.00,'Q1',20.00,20.00,2000.00,3572);
INSERT INTO payments VALUES (3573,2040.00,'Q1',20.00,20.00,2000.00,3573);
INSERT INTO payments VALUES (3575,2040.00,'Q1',20.00,20.00,2000.00,3575);
INSERT INTO payments VALUES (3576,2040.00,'Q1',20.00,20.00,2000.00,3576);
INSERT INTO payments VALUES (3581,1010.00,'full',0.00,10.00,1000.00,3581);
INSERT INTO payments VALUES (3582,1010.00,'full',0.00,10.00,1000.00,3582);
INSERT INTO payments VALUES (3583,1010.00,'full',0.00,10.00,1000.00,3583);
INSERT INTO payments VALUES (3584,2040.00,'Q1',20.00,20.00,2000.00,3584);
INSERT INTO payments VALUES (3585,1010.00,'full',0.00,10.00,1000.00,3585);
INSERT INTO payments VALUES (3586,1010.00,'full',0.00,10.00,1000.00,3586);
INSERT INTO payments VALUES (3587,2040.00,'Q1',20.00,20.00,2000.00,3587);
INSERT INTO payments VALUES (3588,2040.00,'Q1',20.00,20.00,2000.00,3588);
INSERT INTO payments VALUES (3590,2040.00,'Q1',20.00,20.00,2000.00,3590);
INSERT INTO payments VALUES (3591,2040.00,'Q1',20.00,20.00,2000.00,3591);
INSERT INTO payments VALUES (3596,1010.00,'full',0.00,10.00,1000.00,3596);
INSERT INTO payments VALUES (3597,1010.00,'full',0.00,10.00,1000.00,3597);
INSERT INTO payments VALUES (3598,1010.00,'full',0.00,10.00,1000.00,3598);
INSERT INTO payments VALUES (3599,2040.00,'Q1',20.00,20.00,2000.00,3599);
INSERT INTO payments VALUES (3600,1010.00,'full',0.00,10.00,1000.00,3600);
INSERT INTO payments VALUES (3601,1010.00,'full',0.00,10.00,1000.00,3601);
INSERT INTO payments VALUES (3602,2040.00,'Q1',20.00,20.00,2000.00,3602);
INSERT INTO payments VALUES (3603,2040.00,'Q1',20.00,20.00,2000.00,3603);
INSERT INTO payments VALUES (3605,2040.00,'Q1',20.00,20.00,2000.00,3605);
INSERT INTO payments VALUES (3606,2040.00,'Q1',20.00,20.00,2000.00,3606);
INSERT INTO payments VALUES (3611,1010.00,'full',0.00,10.00,1000.00,3611);
INSERT INTO payments VALUES (3612,1010.00,'full',0.00,10.00,1000.00,3612);
INSERT INTO payments VALUES (3613,1010.00,'full',0.00,10.00,1000.00,3613);
INSERT INTO payments VALUES (3614,2040.00,'Q1',20.00,20.00,2000.00,3614);
INSERT INTO payments VALUES (3615,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3616,1010.00,'full',0.00,10.00,1000.00,3616);
INSERT INTO payments VALUES (3617,2040.00,'Q1',20.00,20.00,2000.00,3617);
INSERT INTO payments VALUES (3618,2040.00,'Q1',20.00,20.00,2000.00,3618);
INSERT INTO payments VALUES (3619,1010.00,'full',0.00,10.00,1000.00,3619);
INSERT INTO payments VALUES (3621,2040.00,'Q1',20.00,20.00,2000.00,3621);
INSERT INTO payments VALUES (3624,2040.00,'Q1',20.00,20.00,2000.00,3624);
INSERT INTO payments VALUES (3626,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3628,1010.00,'full',0.00,10.00,1000.00,3628);
INSERT INTO payments VALUES (3629,1010.00,'full',0.00,10.00,1000.00,3629);
INSERT INTO payments VALUES (3630,1010.00,'full',0.00,10.00,1000.00,3630);
INSERT INTO payments VALUES (3631,1010.00,'full',0.00,10.00,1000.00,3631);
INSERT INTO payments VALUES (3632,2040.00,'Q1',20.00,20.00,2000.00,3632);
INSERT INTO payments VALUES (3633,2040.00,'Q1',20.00,20.00,2000.00,3633);
INSERT INTO payments VALUES (3634,1010.00,'full',0.00,10.00,1000.00,3634);
INSERT INTO payments VALUES (3635,2040.00,'Q1',20.00,20.00,2000.00,3635);
INSERT INTO payments VALUES (3636,2040.00,'Q1',20.00,20.00,2000.00,3636);
INSERT INTO payments VALUES (3639,2040.00,'Q1',20.00,20.00,2000.00,3639);
INSERT INTO payments VALUES (3641,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3643,1010.00,'full',0.00,10.00,1000.00,3643);
INSERT INTO payments VALUES (3644,1010.00,'full',0.00,10.00,1000.00,3644);
INSERT INTO payments VALUES (3645,1010.00,'full',0.00,10.00,1000.00,3645);
INSERT INTO payments VALUES (3646,1010.00,'full',0.00,10.00,1000.00,3646);
INSERT INTO payments VALUES (3647,2040.00,'Q1',20.00,20.00,2000.00,22222222);
INSERT INTO payments VALUES (3648,2040.00,'Q1',20.00,20.00,2000.00,3648);
INSERT INTO payments VALUES (3649,1010.00,'full',0.00,10.00,1000.00,3649);
INSERT INTO payments VALUES (3650,2040.00,'Q1',20.00,20.00,2000.00,3650);
INSERT INTO payments VALUES (3651,1010.00,'full',0.00,10.00,1000.00,3651);
INSERT INTO payments VALUES (3652,2040.00,'Q1',20.00,20.00,2000.00,3652);
INSERT INTO payments VALUES (3654,2040.00,'Q1',20.00,20.00,2000.00,3654);
INSERT INTO payments VALUES (3656,2040.00,'Q1',20.00,20.00,2000.00,3656);
INSERT INTO payments VALUES (3659,1010.00,'full',0.00,10.00,1000.00,3659);
INSERT INTO payments VALUES (3661,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3662,2040.00,'Q1',20.00,20.00,2000.00,3662);
INSERT INTO payments VALUES (3663,1010.00,'full',0.00,10.00,1000.00,3663);
INSERT INTO payments VALUES (3664,1010.00,'full',0.00,10.00,1000.00,3664);
INSERT INTO payments VALUES (3665,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3666,1010.00,'full',0.00,10.00,1000.00,3666);
INSERT INTO payments VALUES (3668,2040.00,'Q1',20.00,20.00,2000.00,3668);
INSERT INTO payments VALUES (3669,1010.00,'full',0.00,10.00,1000.00,3669);
INSERT INTO payments VALUES (3670,2040.00,'Q1',20.00,20.00,2000.00,3670);
INSERT INTO payments VALUES (3671,2040.00,'Q1',20.00,20.00,2000.00,3671);
INSERT INTO payments VALUES (3673,2040.00,'Q1',20.00,20.00,2000.00,3673);
INSERT INTO payments VALUES (3674,1010.00,'full',0.00,10.00,1000.00,3674);
INSERT INTO payments VALUES (3678,2040.00,'Q1',20.00,20.00,2000.00,3678);
INSERT INTO payments VALUES (3679,1010.00,'full',0.00,10.00,1000.00,3679);
INSERT INTO payments VALUES (3680,1010.00,'full',0.00,10.00,1000.00,3680);
INSERT INTO payments VALUES (3682,1010.00,'full',0.00,10.00,1000.00,3682);
INSERT INTO payments VALUES (3683,2040.00,'Q1',20.00,20.00,2000.00,3683);
INSERT INTO payments VALUES (3684,1010.00,'full',0.00,10.00,1000.00,3684);
INSERT INTO payments VALUES (3685,2040.00,'Q1',20.00,20.00,2000.00,3685);
INSERT INTO payments VALUES (3686,2040.00,'Q1',20.00,20.00,2000.00,3686);
INSERT INTO payments VALUES (3688,1010.00,'full',0.00,10.00,1000.00,3688);
INSERT INTO payments VALUES (3689,2040.00,'Q1',20.00,20.00,2000.00,3689);
INSERT INTO payments VALUES (3692,2040.00,'Q1',20.00,20.00,2000.00,3692);
INSERT INTO payments VALUES (3694,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3696,1010.00,'full',0.00,10.00,1000.00,3696);
INSERT INTO payments VALUES (3697,1010.00,'full',0.00,10.00,1000.00,3697);
INSERT INTO payments VALUES (3698,1010.00,'full',0.00,10.00,1000.00,3698);
INSERT INTO payments VALUES (3699,1010.00,'full',0.00,10.00,1000.00,3699);
INSERT INTO payments VALUES (3700,2040.00,'Q1',20.00,20.00,2000.00,3700);
INSERT INTO payments VALUES (3701,2040.00,'Q1',20.00,20.00,2000.00,3701);
INSERT INTO payments VALUES (3702,1010.00,'full',0.00,10.00,1000.00,3702);
INSERT INTO payments VALUES (3703,2040.00,'Q1',20.00,20.00,2000.00,3703);
INSERT INTO payments VALUES (3704,2040.00,'Q1',20.00,20.00,2000.00,3704);
INSERT INTO payments VALUES (3707,2040.00,'Q1',20.00,20.00,2000.00,3707);
INSERT INTO payments VALUES (3709,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3711,1010.00,'full',0.00,10.00,1000.00,3711);
INSERT INTO payments VALUES (3712,1010.00,'full',0.00,10.00,1000.00,3712);
INSERT INTO payments VALUES (3713,1010.00,'full',0.00,10.00,1000.00,3713);
INSERT INTO payments VALUES (3714,1010.00,'full',0.00,10.00,1000.00,3714);
INSERT INTO payments VALUES (3715,2040.00,'Q1',20.00,20.00,2000.00,3715);
INSERT INTO payments VALUES (3716,2040.00,'Q1',20.00,20.00,2000.00,3716);
INSERT INTO payments VALUES (3717,1010.00,'full',0.00,10.00,1000.00,3717);
INSERT INTO payments VALUES (3718,2040.00,'Q1',20.00,20.00,2000.00,3718);
INSERT INTO payments VALUES (3719,2040.00,'Q1',20.00,20.00,2000.00,3719);
INSERT INTO payments VALUES (3722,2040.00,'Q1',20.00,20.00,2000.00,3722);
INSERT INTO payments VALUES (3724,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3726,1010.00,'full',0.00,10.00,1000.00,3726);
INSERT INTO payments VALUES (3727,1010.00,'full',0.00,10.00,1000.00,3727);
INSERT INTO payments VALUES (3728,1010.00,'full',0.00,10.00,1000.00,3728);
INSERT INTO payments VALUES (3729,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3730,2040.00,'Q1',20.00,20.00,2000.00,3730);
INSERT INTO payments VALUES (3731,2040.00,'Q1',20.00,20.00,2000.00,3731);
INSERT INTO payments VALUES (3732,1010.00,'full',0.00,10.00,1000.00,3732);
INSERT INTO payments VALUES (3733,1010.00,'full',0.00,10.00,1000.00,3733);
INSERT INTO payments VALUES (3734,2040.00,'Q1',20.00,20.00,2000.00,3734);
INSERT INTO payments VALUES (3737,2040.00,'Q1',20.00,20.00,2000.00,3737);
INSERT INTO payments VALUES (3738,2040.00,'Q1',20.00,20.00,2000.00,3738);
INSERT INTO payments VALUES (3741,1010.00,'full',0.00,10.00,1000.00,3741);
INSERT INTO payments VALUES (3743,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3744,2040.00,'Q1',20.00,20.00,2000.00,3744);
INSERT INTO payments VALUES (3745,1010.00,'full',0.00,10.00,1000.00,3745);
INSERT INTO payments VALUES (3746,1010.00,'full',0.00,10.00,1000.00,3746);
INSERT INTO payments VALUES (3747,1010.00,'full',0.00,10.00,1000.00,3747);
INSERT INTO payments VALUES (3748,1010.00,'full',0.00,10.00,1000.00,3748);
INSERT INTO payments VALUES (3750,2040.00,'Q1',20.00,20.00,2000.00,3750);
INSERT INTO payments VALUES (3751,2040.00,'Q1',20.00,20.00,2000.00,3751);
INSERT INTO payments VALUES (3752,2040.00,'Q1',20.00,20.00,2000.00,3752);
INSERT INTO payments VALUES (3753,2040.00,'Q1',20.00,20.00,2000.00,3753);
INSERT INTO payments VALUES (3756,1010.00,'full',0.00,10.00,1000.00,3756);
INSERT INTO payments VALUES (3758,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3759,2040.00,'Q1',20.00,20.00,2000.00,3759);
INSERT INTO payments VALUES (3760,1010.00,'full',0.00,10.00,1000.00,3760);
INSERT INTO payments VALUES (3761,1010.00,'full',0.00,10.00,1000.00,3761);
INSERT INTO payments VALUES (3762,1010.00,'full',0.00,10.00,1000.00,3762);
INSERT INTO payments VALUES (3763,1010.00,'full',0.00,10.00,1000.00,3763);
INSERT INTO payments VALUES (3765,2040.00,'Q1',20.00,20.00,2000.00,3765);
INSERT INTO payments VALUES (3766,2040.00,'Q1',20.00,20.00,2000.00,3766);
INSERT INTO payments VALUES (3767,2040.00,'Q1',20.00,20.00,2000.00,3767);
INSERT INTO payments VALUES (3768,2040.00,'Q1',20.00,20.00,2000.00,3768);
INSERT INTO payments VALUES (3771,1010.00,'full',0.00,10.00,1000.00,3771);
INSERT INTO payments VALUES (3773,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3774,2040.00,'Q1',20.00,20.00,2000.00,3774);
INSERT INTO payments VALUES (3775,1010.00,'full',0.00,10.00,1000.00,3775);
INSERT INTO payments VALUES (3776,1010.00,'full',0.00,10.00,1000.00,3776);
INSERT INTO payments VALUES (3777,1010.00,'full',0.00,10.00,1000.00,3777);
INSERT INTO payments VALUES (3778,1010.00,'full',0.00,10.00,1000.00,3778);
INSERT INTO payments VALUES (3780,2040.00,'Q1',20.00,20.00,2000.00,3780);
INSERT INTO payments VALUES (3781,2040.00,'Q1',20.00,20.00,2000.00,3781);
INSERT INTO payments VALUES (3782,2040.00,'Q1',20.00,20.00,2000.00,3782);
INSERT INTO payments VALUES (3783,2040.00,'Q1',20.00,20.00,2000.00,3783);
INSERT INTO payments VALUES (3786,1010.00,'full',0.00,10.00,1000.00,3786);
INSERT INTO payments VALUES (3788,3033.00,'Q3',3.00,30.00,3000.00,33333333);
INSERT INTO payments VALUES (3789,2040.00,'Q1',20.00,20.00,2000.00,3789);
INSERT INTO payments VALUES (3790,1010.00,'full',0.00,10.00,1000.00,3790);
INSERT INTO payments VALUES (3791,1010.00,'full',0.00,10.00,1000.00,3791);
INSERT INTO payments VALUES (3792,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3793,1010.00,'full',0.00,10.00,1000.00,3793);
INSERT INTO payments VALUES (3795,2040.00,'Q1',20.00,20.00,2000.00,3795);
INSERT INTO payments VALUES (3796,1010.00,'full',0.00,10.00,1000.00,3796);
INSERT INTO payments VALUES (3797,2040.00,'Q1',20.00,20.00,2000.00,3797);
INSERT INTO payments VALUES (3798,2040.00,'Q1',20.00,20.00,2000.00,3798);
INSERT INTO payments VALUES (3800,2040.00,'Q1',20.00,20.00,2000.00,3800);
INSERT INTO payments VALUES (3801,1010.00,'full',0.00,10.00,1000.00,3801);
INSERT INTO payments VALUES (3805,2040.00,'Q1',20.00,20.00,2000.00,3805);
INSERT INTO payments VALUES (3806,1010.00,'full',0.00,10.00,1000.00,3806);
INSERT INTO payments VALUES (3807,1010.00,'full',0.00,10.00,1000.00,3807);
INSERT INTO payments VALUES (3809,1010.00,'full',0.00,10.00,1000.00,3809);
INSERT INTO payments VALUES (3810,2040.00,'Q1',20.00,20.00,2000.00,3810);
INSERT INTO payments VALUES (3811,1010.00,'full',0.00,10.00,1000.00,3811);
INSERT INTO payments VALUES (3812,2040.00,'Q1',20.00,20.00,2000.00,3812);
INSERT INTO payments VALUES (3813,2040.00,'Q1',20.00,20.00,2000.00,3813);
INSERT INTO payments VALUES (3815,1010.00,'full',0.00,10.00,1000.00,3815);
INSERT INTO payments VALUES (3816,2040.00,'Q1',20.00,20.00,2000.00,3816);
INSERT INTO payments VALUES (3819,2040.00,'Q1',20.00,20.00,2000.00,3819);
INSERT INTO payments VALUES (3821,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3823,1010.00,'full',0.00,10.00,1000.00,3823);
INSERT INTO payments VALUES (3824,1010.00,'full',0.00,10.00,1000.00,3824);
INSERT INTO payments VALUES (3825,1010.00,'full',0.00,10.00,1000.00,11111111);
INSERT INTO payments VALUES (3826,1010.00,'full',0.00,10.00,1000.00,3826);
INSERT INTO payments VALUES (3827,2040.00,'Q1',20.00,20.00,2000.00,3827);
INSERT INTO payments VALUES (3828,1010.00,'full',0.00,10.00,1000.00,3828);
INSERT INTO payments VALUES (3829,1010.00,'full',0.00,10.00,1000.00,3829);
INSERT INTO payments VALUES (3830,2040.00,'Q1',20.00,20.00,2000.00,3830);
INSERT INTO payments VALUES (3831,2040.00,'Q1',20.00,20.00,2000.00,3831);
INSERT INTO payments VALUES (3833,2040.00,'Q1',20.00,20.00,2000.00,3833);
INSERT INTO payments VALUES (3834,2040.00,'Q1',20.00,20.00,2000.00,3834);
INSERT INTO payments VALUES (3839,1010.00,'full',0.00,10.00,1000.00,3839);
INSERT INTO payments VALUES (3840,1010.00,'full',0.00,10.00,1000.00,3840);
INSERT INTO payments VALUES (3841,1010.00,'full',0.00,10.00,1000.00,3841);
INSERT INTO payments VALUES (3842,2040.00,'Q1',20.00,20.00,2000.00,3842);
INSERT INTO payments VALUES (3843,1010.00,'full',0.00,10.00,1000.00,3843);
INSERT INTO payments VALUES (3844,1010.00,'full',0.00,10.00,1000.00,3844);
INSERT INTO payments VALUES (3845,2040.00,'Q1',20.00,20.00,2000.00,3845);
INSERT INTO payments VALUES (3846,2040.00,'Q1',20.00,20.00,2000.00,3846);
INSERT INTO payments VALUES (3848,2040.00,'Q1',20.00,20.00,2000.00,3848);
INSERT INTO payments VALUES (3849,2040.00,'Q1',20.00,20.00,2000.00,3849);
INSERT INTO payments VALUES (3854,1010.00,'full',0.00,10.00,1000.00,3854);
INSERT INTO payments VALUES (3855,1010.00,'full',0.00,10.00,1000.00,3855);
INSERT INTO payments VALUES (3856,1010.00,'full',0.00,10.00,1000.00,3856);
INSERT INTO payments VALUES (3857,2040.00,'Q1',20.00,20.00,2000.00,3857);
INSERT INTO payments VALUES (3858,1010.00,'full',0.00,10.00,1000.00,3858);
INSERT INTO payments VALUES (3859,1010.00,'full',0.00,10.00,1000.00,3859);
INSERT INTO payments VALUES (3860,2040.00,'Q1',20.00,20.00,2000.00,3860);
INSERT INTO payments VALUES (3861,2040.00,'Q1',20.00,20.00,2000.00,3861);
INSERT INTO payments VALUES (3863,2040.00,'Q1',20.00,20.00,2000.00,3863);
INSERT INTO payments VALUES (3864,2040.00,'Q1',20.00,20.00,2000.00,3864);
INSERT INTO payments VALUES (3869,1010.00,'full',0.00,10.00,1000.00,3869);
INSERT INTO payments VALUES (3870,1010.00,'full',0.00,10.00,1000.00,3870);
INSERT INTO payments VALUES (3871,1010.00,'full',0.00,10.00,1000.00,3871);
INSERT INTO payments VALUES (3872,2040.00,'Q1',20.00,20.00,2000.00,3872);
INSERT INTO payments VALUES (3873,1010.00,'full',0.00,10.00,1000.00,3873);
INSERT INTO payments VALUES (3874,1010.00,'full',0.00,10.00,1000.00,3874);
INSERT INTO payments VALUES (3875,2040.00,'Q1',20.00,20.00,2000.00,3875);
INSERT INTO payments VALUES (3876,2040.00,'Q1',20.00,20.00,2000.00,3876);
INSERT INTO payments VALUES (3878,2040.00,'Q1',20.00,20.00,2000.00,3878);
INSERT INTO payments VALUES (3879,2040.00,'Q1',20.00,20.00,2000.00,3879);
INSERT INTO payments VALUES (3884,1010.00,'full',0.00,10.00,1000.00,3884);
INSERT INTO payments VALUES (3885,1010.00,'full',0.00,10.00,1000.00,3885);
INSERT INTO payments VALUES (3886,1010.00,'full',0.00,10.00,1000.00,3886);
INSERT INTO payments VALUES (3887,2040.00,'Q1',20.00,20.00,2000.00,3887);
INSERT INTO payments VALUES (3888,1010.00,'full',0.00,10.00,1000.00,3888);
INSERT INTO payments VALUES (3889,1010.00,'full',0.00,10.00,1000.00,3889);
INSERT INTO payments VALUES (3890,2040.00,'Q1',20.00,20.00,2000.00,3890);
INSERT INTO payments VALUES (3891,2040.00,'Q1',20.00,20.00,2000.00,3891);
INSERT INTO payments VALUES (3893,2040.00,'Q1',20.00,20.00,2000.00,3893);
INSERT INTO payments VALUES (3894,2040.00,'Q1',20.00,20.00,2000.00,3894);
INSERT INTO payments VALUES (3899,1010.00,'full',0.00,10.00,1000.00,3899);
INSERT INTO payments VALUES (3900,1010.00,'full',0.00,10.00,1000.00,3900);
INSERT INTO payments VALUES (3901,1010.00,'full',0.00,10.00,1000.00,3901);
INSERT INTO payments VALUES (3902,2040.00,'Q1',20.00,20.00,2000.00,3902);
INSERT INTO payments VALUES (3903,1010.00,'full',0.00,10.00,1000.00,3903);
INSERT INTO payments VALUES (3904,2040.00,'Q1',20.00,20.00,2000.00,3904);
INSERT INTO payments VALUES (3905,2040.00,'Q1',20.00,20.00,2000.00,3905);
INSERT INTO payments VALUES (3907,2040.00,'Q1',20.00,20.00,2000.00,3907);

