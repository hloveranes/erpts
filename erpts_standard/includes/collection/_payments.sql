
CREATE TABLE payments (
  paymentID bigint(20) unsigned NOT NULL auto_increment,
  amount double(14,2) default '0.00',
  dueType set('basic','sef','penalty') NOT NULL default '',
  application set('full','Q1','Q2','Q3','Q4') default NULL,
  dueID bigint(20) NOT NULL default '0',
  PRIMARY KEY  (paymentID),
  KEY dueID (dueID)
) TYPE=INNODB

