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

create table collectionPayments(
       collectionID bigint not null,
       paymentID bigint not null,
       primary key (paymentID),
       index byCollection (collectionID)
) TYPE=INNODB;
