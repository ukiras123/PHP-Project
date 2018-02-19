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
  description varchar(255) DEFAULT NULL,
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
