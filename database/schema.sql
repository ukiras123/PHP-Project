##SQL Scripts for database, table creation and initialization, along with example queries


#########CREATE TABLES##############

DROP DATABASE IF EXISTS app;
Create DATABASE app;
USE app;

##users
CREATE TABLE UserType (
  userTypeID int unsigned NOT NULL,
  user_type VARCHAR(255),
  CONSTRAINT PK_UserType PRIMARY KEY(userTypeID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Company (
  companyID int unsigned NOT NULL AUTO_INCREMENT,
  companyName varchar(255) NOT NULL,
  companyAddress varchar(255),
  companyPhone varchar(25),
  notes varchar(255),
  CONSTRAINT PK_Company PRIMARY KEY(companyID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


##Note, ` is the quoted identifier (enabling use of reserved keywords like User and password)
CREATE TABLE `User` (
  userID int unsigned NOT NULL AUTO_INCREMENT,
  userTypeID int unsigned NOT NULL,
  companyID int unsigned,
  username varchar(30) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  firstName varchar(255) NOT NULL,
  lastName varchar(255) NOT NULL,
  email varchar(50),
  phone varchar(25),
  sex varchar(10),
  `profile` varchar(255),
  add_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT PK_User PRIMARY KEY(userID),
  CONSTRAINT FK_UserType FOREIGN KEY(userTypeID) REFERENCES UserType(userTypeID),
  CONSTRAINT FK_UserCompany FOREIGN KEY(companyID) REFERENCES Company(companyID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



##Resource Tables. Constraints enforces disjointness.
CREATE TABLE ResourceType (
  resourceTypeID int unsigned NOT NULL,
  resource_type varchar(255),
  CONSTRAINT PK_Resource_type PRIMARY KEY(resourceTypeID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Resource (
  resourceId int unsigned NOT NULL AUTO_INCREMENT,
  resourceTypeID int unsigned NOT NULL,
  CONSTRAINT PK_resource PRIMARY KEY(resourceId),
  CONSTRAINT FK_ResourceType FOREIGN KEY(resourceTypeID) REFERENCES ResourceType(resourceTypeID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Computer (
  resourceID int unsigned NOT NULL AUTO_INCREMENT,
  resourceTypeID int unsigned NOT NULL DEFAULT 1 CHECK(resourceTypeId = 1), ##forces the computer type
  serialNum int(20) NOT NULL,
  os varchar(25) NOT NULL,
  model varchar(25) NOT NULL,
  manufacturer varchar(25) NOT NULL,
  CONSTRAINT PK_Computer PRIMARY KEY(resourceId),
  CONSTRAINT FK_ComputerResource FOREIGN KEY(resourceId) REFERENCES Resource(resourceId),
  CONSTRAINT FK_ComputerResource1 FOREIGN KEY(resourceTypeID) REFERENCES Resource(resourceTypeId) ##enforces referentail integrity
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Projector (
  resourceID int unsigned NOT NULL,
  resourceTypeID int unsigned NOT NULL DEFAULT 2 CHECK(resourceTypeId = 2), ##forces the projector type
  serialNum int(20) NOT NULL,
  model varchar(25) NOT NULL,
  manufacturer varchar(25) NOT NULL,
  technology varchar(25) NOT NULL,
  CONSTRAINT PK_Projector PRIMARY KEY(resourceId),
  CONSTRAINT FK_ProjResource FOREIGN KEY(resourceId) REFERENCES Resource(resourceId),
  CONSTRAINT FK_ProjResource1 FOREIGN KEY(resourceTypeID) REFERENCES Resource(resourceTypeId) ##enforces referentail integrity
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Room (
  resourceID int unsigned NOT NULL,
  resourceTypeID int unsigned NOT NULL DEFAULT 3 CHECK(resourceTypeId = 3), ##forces the room type
  name varchar(50) NOT NULL,
  roomNum int NOT NULL,
  capacity varchar(25) NOT NULL,
  description varchar(255) NOT NULL,
  CONSTRAINT PK_Room PRIMARY KEY(resourceId),
  CONSTRAINT FK_RoomResource FOREIGN KEY(resourceId) REFERENCES Resource(resourceId),
  CONSTRAINT FK_RoomResource1 FOREIGN KEY(resourceTypeID) REFERENCES Resource(resourceTypeId) ##enforces referentail integrity
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Microphone (
  resourceID int unsigned NOT NULL,
  resourceTypeID int unsigned NOT NULL DEFAULT 4 CHECK(resourceTypeId = 4), ##forces the microphone type
  serialNum int NOT NULL,
  model varchar(25) NOT NULL,
  manufacturer varchar(25) NOT NULL,
  CONSTRAINT PK_Microphone PRIMARY KEY(resourceId),
  CONSTRAINT FK_MicResource FOREIGN KEY(resourceId) REFERENCES Resource(resourceId),
  CONSTRAINT FK_MicResource1 FOREIGN KEY(resourceTypeID) REFERENCES Resource(resourceTypeId) ##enforces referentail integrity
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



##Tables for reserves relation
CREATE TABLE Rental (
  rentalID int unsigned NOT NULL AUTO_INCREMENT,
  userID int unsigned NOT NULL,
  start_date datetime NOT NULL,
  end_date datetime NOT NULL,
  add_date datetime DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT PK_Rental PRIMARY KEY(rentalID),
  CONSTRAINT FK_RentalUser FOREIGN KEY(userID) REFERENCES `User`(userID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Rental_Detail (
  rentalID int unsigned NOT NULL AUTO_INCREMENT,
  resourceID int unsigned NOT NULL,
  CONSTRAINT PK_RentDetail PRIMARY KEY(rentalID, resourceID),
  CONSTRAINT FK_RDRental FOREIGN KEY(rentalID) REFERENCES Rental(rentalID),
  CONSTRAINT FK_RDResource FOREIGN KEY(resourceID) REFERENCES Resource(resourceID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





##########POPULATE QUERIES##############
##---------------------------Master Date-----------------------------
##insert for ResourceType
INSERT INTO ResourceType
VALUES
  (1, 'Computer'),
  (2, 'Projector'),
  (3, 'Room'),
  (4, 'Microphone');

#select * from ResourceType

##insert for Resource. Auto generate resource IDs, created 5 of each type, except rooms, created 10
INSERT INTO Resource(resourceTypeID)
VALUES
  (1),
  (1),
  (1),
  (1),
  (1),
  (2),
  (2),
  (2),
  (2),
  (2),
  (3),
  (3),
  (3),
  (3),
  (3),
  (3),
  (3),
  (3),
  (3),
  (3),
  (4),
  (4),
  (4),
  (4),
  (4);

#select * from Resource




##populate resources

#Computers, pull resourceID and TypeID via join. Mostly for example on joins and the one to one relationship
INSERT INTO Computer
  SELECT r.resourceID, t.resourceTypeID, 0000, '', '', ''
  FROM Resource r, ResourceType t 						##implicit join btw
  WHERE r.resourceTypeID = t.resourceTypeID				##just shorthand instead of writing join .... on ....
        AND t.resource_type = 'Computer';


#select * from Computer

##now lets modify those values
UPDATE Computer
SET serialNum = CASE
                WHEN resourceID = 1 THEN 22685582
                WHEN resourceID = 2 THEN 24495589
                WHEN resourceID = 3 THEN 35379994
                WHEN resourceID = 4 THEN 56269364
                WHEN resourceID = 5 THEN 69546442
                ELSE serialNum
                END,
  os = CASE
       WHEN resourceID = 1 THEN 'Windows 7 Professional'
       WHEN resourceID = 2 THEN 'Mac OSX 10.13'
       WHEN resourceID = 3 THEN 'Debian Stretch 9.3'
       WHEN resourceID = 4 THEN 'Windows 7 Professional'
       WHEN resourceID = 5 THEN 'Windows 10 64bit'
       ELSE os
       END,
  model = CASE
          WHEN resourceID = 1 THEN 'Insprion'
          WHEN resourceID = 2 THEN 'IMac Pro'
          WHEN resourceID = 3 THEN 'XPS 8920'
          WHEN resourceID = 4 THEN 'Pavilion x360'
          WHEN resourceID = 5 THEN 'Pavilion 570'
          ELSE model
          END,
  manufacturer = CASE
                 WHEN resourceID = 1 THEN 'Dell'
                 WHEN resourceID = 2 THEN 'Apple'
                 WHEN resourceID = 3 THEN 'Dell'
                 WHEN resourceID = 4 THEN 'HP'
                 WHEN resourceID = 5 THEN 'HP'
                 ELSE manufacturer
                 END
WHERE resourceTypeID = 1; ##where clause normally not needed, however, if you are running safemode it is

#select * from Computer


##for the others we are manually inserting the resourceID and resourceTypeID to keep it simple
INSERT INTO Projector
VALUES
  (6, 2, 88393623, 'x1000', 'BrightLite', 'Laser'),
  (7, 2, 46395782, 'VS250', 'Epson', '3LCD'),
  (8, 2, 75568866, 'HD142X', 'Optoma', '3LCD'),
  (9, 2, 87965297, '3300', 'ViewSonic', '3LCD'),
  (10, 2, 76857742, 'x2000', 'BrightLite', 'Laser');

#select * from Projector


INSERT INTO Room
VALUES
  (11, 3, 'Theater1', 100, 500, 'Theater Hall 1'),
  (12, 3, 'Theater2', 102, 750, 'Theater Hall 2'),
  (13, 3, 'Cochise', 201, 25, 'Cochise Room'),
  (14, 3, 'Pima', 202, 25, 'Pima Room'),
  (15, 3, 'Santa Cruz', 203, 15, 'Santa Cruz Room'),
  (16, 3, 'Coconino', 204, 35, 'Coconino Room'),
  (17, 3, 'Gila', 205, 50, 'Gila Room'),
  (18, 3, 'Maricopa', 206, 35, 'Maricopa Room'),
  (19, 3, 'Navajo', 207, 75, 'Navajo Room'),
  (20, 3, 'Yavapai', 208, 50, 'Yavapai Room');

#select * from Room


INSERT INTO Microphone
VALUES
  (21, 2, 37276254, 'SM48', 'Shure'),
  (22, 2, 53956373, 'SM58', 'Shure'),
  (23, 2, 52986954, 'f55', 'Audix'),
  (24, 2, 34779927, 'NT1', 'Rode'),
  (25, 2, 75985355, 'NT1', 'Rode');

#select * from Microphone


##populate user and company tables
INSERT INTO Company(companyName, companyAddress, companyPhone, notes)
VALUES
  ('A Corp', '2222 55 Street South', '(999) 999-7777', 'known to have tech troubles with equipment'),
  ('Henry Realty', '5555 S Ave', '(111) 222-3333', '');

#select * from Company

INSERT INTO UserType
VALUES
  (1, 'Employee'),
  (2, 'Company');

#select * from UserType

##---------------------------Test Date-----------------------------



INSERT INTO `User`(userTypeID, companyID, username, `password`, firstName, LastName, email, phone, sex, `profile`, add_date)
VALUES
  (1, NULL, 'gcude', 'hashgoeshere', 'Gavin', 'Cude', 'no@email.com', '(222) 222-2222', 'Male', '', NOW()),
  (2, 1, 'coTest', 'hashgoeshere', 'Company', 'Test', 'no@email.com', '(333) 333-3333', 'Male', '', NOW());

#select * from User


##populate some initial rentals
INSERT INTO Rental(userID, start_date, end_date, add_date)
VALUES
  (1, CAST('2018-02-20 10:00:00' AS DATETIME), CAST('2018-02-20 12:00:00' AS DATETIME), NOW()),
  (1, CAST('2018-02-21 11:00:00' AS DATETIME), CAST('2018-02-21 12:30:00' AS DATETIME), NOW()),
  (2, DATE_ADD(NOW(), INTERVAL 3 DAY), DATE_ADD(DATE_ADD(NOW(), INTERVAL 1 HOUR), INTERVAL 3 DAY), NOW()); ##just to showcase date studd

#select * from Rental

INSERT INTO Rental_Detail
VALUES
  (1, 1),
  (1, 6),
  (1, 11),
  (2, 3),
  (2, 16),
  (3, 2),
  (3, 18),
  (3, 24);



#select * from Rental_Detail


############QUERIES#############
##example showing how the check constraint works
INSERT INTO Computer
VALUES
  (100, 2, 0000, '', '', ''); ##get foreign key constraint fail



##now, showing how data can be retrieved from the rents relation. In this case all rentals for user 1
SELECT c.userID, c.firstName, c.lastName, r.rentalID, rs.resourceID, rs.resourceTypeID, rt.resource_type,
  r.start_date, r.end_date, r.add_date
FROM Rental r
  JOIN Rental_Detail rd
    ON r.rentalID = rd.rentalID
  JOIN `User` c
    ON r.userID = c.userID
  JOIN Resource rs
    ON rd.resourceID = rs.resourceID
  JOIN ResourceType RT
    ON rs.resourceTypeID = rt.resourceTypeID
ORDER BY r.rentalID, rs.resourceID;


##say we wanted to check that a timeslot for a resource was open
##lets get a list of resources that are open for timeslot
## 2018-02-20 10:00:00 AND 2018-02-20 12:00:00

##make sure to run variables with query
SET @fromDate = CAST('2018-02-20 10:00:00' AS DATETIME);
SET @toDate = CAST('2018-02-20 12:00:00' AS DATETIME); 	##variables are useful.

SELECT resourceID
FROM Resource r
WHERE resourceID NOT IN
      (
        ##this select IDs where the target from or to dates already exist
        SELECT rd.resourceID
        FROM Rental r
          JOIN rental_detail rd
            ON r.rentalID = rd.rentalID
        WHERE @fromDate BETWEEN r.start_date AND r.end_date
              AND @toDate BETWEEN r.start_date AND r.end_date
      );


##you can do the reverse to see which resources are being used for that time block
##make sure to run variables with query
SET @fromDate = CAST('2018-02-20 10:00:00' AS DATETIME);
SET @toDate = CAST('2018-02-20 12:00:00' AS DATETIME); 	##variables are useful.

SELECT resourceID
FROM Resource r
WHERE resourceID IN
      (
        ##this select IDs where the target from or to dates already exist
        SELECT rd.resourceID
        FROM Rental r
          JOIN rental_detail rd
            ON r.rentalID = rd.rentalID
        WHERE @fromDate BETWEEN r.start_date AND r.end_date
              AND @toDate BETWEEN r.start_date AND r.end_date
      );
