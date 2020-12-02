CREATE TABLE dues (
  dueID bigint(20) unsigned NOT NULL auto_increment,
  basic double(14,2) NOT NULL default '0.00',
  penalty double(14,2) NOT NULL default '0.00',
  sef double(14,2) NOT NULL default '0.00',
  tdnum bigint(20) default NULL,
  dueDate date default NULL,
  upDate datetime default NULL,
  paidBasic double(14,2) NOT NULL default '0.00',
  paidSEF double(14,2) NOT NULL default '0.00',
  paidPenalty double(14,2) NOT NULL default '0.00',
  paymentMode varchar(15) default NULL,
  paidQuarters int(11) default NULL,
  PRIMARY KEY  (dueID),
  UNIQUE KEY byTDDate (tdnum,dueDate),
  KEY byDueID (dueID)
) TYPE=INNODB;

create table if not exists LUT (
       forYear int not null,
       monthCount int not null,
       rate double (14,2) not null default 0.0,
       primary key (forYear, monthCount),
       index byYear (forYear)
) TYPE=INNODB;
       

