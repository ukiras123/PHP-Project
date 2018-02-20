DROP DATABASE IF EXISTS app;
Create DATABASE app;
USE app;


CREATE TABLE department (
  dId int(11) unsigned NOT NULL AUTO_INCREMENT,
  departmentname varchar(255) NOT NULL,
  PRIMARY KEY (dId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE users (
  uId int(11) unsigned NOT NULL AUTO_INCREMENT,
  username varchar(30) NOT NULL UNIQUE ,
  password varchar(255) NOT NULL,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  email varchar(50),
  phone varchar(25),
  sex varchar(10),
  profile varchar(255),
  type char(1) NOT NULL,
  companyname varchar(50),
  dId int(11) unsigned,
  PRIMARY KEY (uId),
  FOREIGN KEY (dId) REFERENCES department (dId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE resources (
  rId int(11) unsigned NOT NULL AUTO_INCREMENT,
  description varchar(255) NOT NULL,
  type varchar(12) NOT NULL,
  PRIMARY KEY (rId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE computer (
  rId int(11) unsigned NOT NULL,
  serialnum int(20) NOT NULL,
  os varchar(25) NOT NULL,
  model varchar(25) NOT NULL,
  manufacturer varchar(25) NOT NULL,
  KEY rId (rId),
  FOREIGN KEY (rId) REFERENCES resources (rId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE projector (
  rId int(11) unsigned NOT NULL,
  serialnum int(20) NOT NULL,
  model varchar(25) NOT NULL,
  manufacturer varchar(25) NOT NULL,
  technology varchar(25) NOT NULL,
  KEY rId (rId),
  FOREIGN KEY (rId) REFERENCES resources (rId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE room (
  rId int(11) unsigned NOT NULL,
  name varchar(50) NOT NULL,
  roomnum int(11) NOT NULL,
  capacity varchar(25) NOT NULL,
  KEY rId (rId),
  FOREIGN KEY (rId) REFERENCES resources (rId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE microphone (
  rId int(11) unsigned NOT NULL,
  serialnum int(20) NOT NULL,
  model varchar(25) NOT NULL,
  manufacturer varchar(25) NOT NULL,
  KEY rId (rId),
  FOREIGN KEY (rId) REFERENCES resources (rId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE user_resources (
  rId int(11) unsigned NOT NULL,
  uId int(11) unsigned NOT NULL,
  reqdatetime timestamp NOT NULL,
  startdatetime timestamp NOT NULL,
  enddatetime timestamp NOT NULL,
  KEY rId (rId),
  KEY uId (uId),
  FOREIGN KEY (rId) REFERENCES resources (rId),
  FOREIGN KEY (uId) REFERENCES users (uId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


insert into department
set departmentname = 'HR';

insert into department
set departmentname = 'Engineering';

insert into department
set departmentname = 'Marketing';

insert into department
set departmentname = 'Finance';


insert into resources
set description = 'Powerful Mac for Gaming',
  type = 'computer';

insert into resources
set description = 'Lenovo for Office',
  type = 'computer';

insert into resources
set description = 'MacBook Pro for Professional',
  type = 'computer';





insert into resources
set description = 'Apple Microphone for the best experience',
  type = 'microphone';

insert into resources
set description = 'Beats headphone, never better before',
  type = 'microphone';

insert into resources
set description = 'Wireless Headphone, no battert needed',
  type = 'microphone';



insert into resources
set description = 'Projector like never seen before',
  type = 'projector';

insert into resources
set description = 'Higher resolution Projector',
  type = 'projector';

insert into resources
set description = 'OLED : New in market',
  type = 'projector';




insert into resources
set description = 'LunchRoom with soda machine',
  type = 'room';

insert into resources
set description = 'Conference Room with monitors',
  type = 'room';


insert into resources
set description = 'Conference Room with A/C',
  type = 'room';




insert into computer
set rId = 1, serialnum = 12323,
  os = 'OSX', model = 'Macbook Air',
  manufacturer = 'Apple';

insert into computer
set rId = 2, serialnum = 15523,
  os = 'Windows', model = 'Thinkpad X',
  manufacturer = 'Lenovo';

insert into computer
set rId = 3, serialnum = 45452,
  os = 'OSX', model = 'Macbook Bro 15"',
  manufacturer = 'Apple';






insert into microphone
set rId = 4, serialnum = 98983,
  model = 'AirPod',
  manufacturer = 'Apple';

insert into microphone
set rId = 5, serialnum = 23132,
  model = 'BeatsX',
  manufacturer = 'Apple';

insert into microphone
set rId = 6, serialnum = 33113,
  model = 'MDR-100',
  manufacturer = 'Sony';



insert into projector
set rId = 7, serialnum = 23222,
  model = 'SonyVega',
  manufacturer = 'Sony',
  technology = 'LED';

insert into projector
set rId = 8, serialnum = 33313,
  model = 'HC160',
  manufacturer = 'Espon',
  technology = '3LCD';

insert into projector
set rId = 9, serialnum = 43422,
  model = 'PH150B',
  manufacturer = 'LG',
  technology = 'OLED';




insert into room
set rId = 10, name = 'Maui',
  roomnum = 100, capacity = '100 people';

insert into room
set rId = 11, name = 'Bali',
  roomnum = 101, capacity = '25 people';

insert into room
set rId = 12, name = 'Mavricks',
  roomnum = 102, capacity = '34 people';