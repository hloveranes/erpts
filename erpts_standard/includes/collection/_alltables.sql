create table if not exists dues (
       dueID bigint unsigned  not null auto_increment,
       basic double (14,2) not null,
       penalty double (14,2) not null default 0.0,
       sef double (14,2) not null default 0.0,
       tdnum bigint,
       dueDate date,
       currentDate datetime,
       balanceBasic double (14,2) not null default 0.0,
       balanceSEF double (14,2) not null default 0.0,
       balancePenalty double (14,2) not null default 0.0,
       primary key (dueID),
       index byTDnum (tdNum),
       index byDate (dueDate),
       index byDueID (dueID)
) TYPE=INNODB;

create table if not exists payments (
       paymentID bigint unsigned not null auto_increment,
       amount double (14,2) default 0.0,
       application set ('full','Q1','Q2','Q3','Q4'),
       penalty double (14,2) default 0.0,
       sef double (14,2) default 0.0,
       basic double (14,2) default 0.0,
       dueID bigint not null,
       primary key (paymentID,dueID),
       index (dueID)
) TYPE=INNODB;


create table if not exists collections (
       collectionID bigint unsigned not null auto_increment,
       collectionDate date not null,
       collectionSum double(14,2) not null,
       receiptNum varchar(10),
       receivedFrom varchar (50),
       kindOfPayment set ('cash','check','treasury note'),
       checkNum varchar(15) null,
       checkDate date null,
       oldReceiptNum varchar(10),
       oldReceiptDate date,
       municipality varchar (10) not null,
       primary key (collectionID,municipality),
       index byCollection (collectionID)
) TYPE=INNODB;

create table if not exists collectionPayments(
       collectionID bigint not null,
       paymentID bigint not null,
       primary key (paymentID),
       index byCollection (collectionID)
) TYPE=INNODB;