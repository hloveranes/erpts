CREATE TABLE cancelledCollections (
  cancelID bigint(20) unsigned NOT NULL auto_increment primary key,
  dateCancelled date NOT NULL,
  cancelledBy int,
  collectionID bigint(20) unsigned NOT NULL,
  collectionDate date NOT NULL default '0000-00-00',
  collectionSum double(14,2) NOT NULL default '0.00',
  receiptNum varchar(10) default NULL,
  receivedFrom varchar(50) default NULL,
  kindOfPayment set('cash','check','treasury note') default NULL,
  checkNum varchar(15) default NULL,
  checkDate date default NULL,
  oldReceiptNum varchar(10) default NULL,
  oldReceiptDate date default NULL,
  municipality varchar(10) NOT NULL default ''
) TYPE=MyISAM;

CREATE TABLE cancelledCollectionPayments (
  collectionID bigint(20) NOT NULL default '0',
  paymentID bigint(20) NOT NULL default '0',
  PRIMARY KEY  (paymentID),
  KEY byCollection (collectionID)
) TYPE=MyISAM;

CREATE TABLE cancelledPayments (
  paymentID bigint(20) unsigned NOT NULL,
  amount double(14,2) default '0.00',
  application set('full','Q1','Q2','Q3','Q4') default NULL,
  dueID bigint(20) NOT NULL default '0',
  dueType varchar(10) NOT NULL default '',
  receiptNum varchar(15) NOT NULL default '',
  PRIMARY KEY  (paymentID,dueID),
  KEY dueID (dueID)
) TYPE=MyISAM;

