-- admin  vu5JF2bUqgd6

CREATE DATABASE IF NOT EXISTS carBuddy;
USE carBuddy;

DROP TABLE IF EXISTS shop, customer, reservation, service;

CREATE TABLE shop
(shopNo int NOT NULL AUTO_INCREMENT,
	shopName varchar(35),
	password char(8),
	numMechanic int,
	zipCode int,
	PRIMARY KEY (shopNo)
);

INSERT INTO shop (shopName, password, numMechanic, zipCode) VALUES("Bob's Auto",'1886Ford', 3, 46227);
INSERT INTO shop (shopName, password, numMechanic, zipCode) VALUES("Leeroy's Lifts",'1886Ford', 1, 46227);
INSERT INTO shop (shopName, password, numMechanic, zipCode) VALUES("Jeromy's Junkyard",'1886Ford', 2, 46227);


CREATE TABLE customer
(custNo int NOT NULL AUTO_INCREMENT,
	FName varchar(20),
	LName varchar(20),
	password char(10),
	address varchar(40),
	phoneNum char(13),
	PRIMARY KEY (custNo)
);

INSERT INTO customer (fName, lName, password, address, phoneNum) VALUES("RealFName", "RealLName", '1886Ford', '1400 E Hanna Av, Indianapolis, IN 46227', '317-788-3368');

CREATE TABLE service
(servNo int NOT NULL AUTO_INCREMENT,
	shopNo int,
	service varchar(40),
	minutes int,
	price decimal(5,2),
	PRIMARY KEY (servNo),
	FOREIGN KEY (shopNo) REFERENCES shop(shopNo)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

INSERT INTO service (shopNo, service, minutes, price) VALUES( 1, 'service job', 60 , 110.00);
INSERT INTO service (shopNo, service, minutes, price) VALUES( 1, 'tire rotation', 60 , 85.00);
INSERT INTO service (shopNo, service, minutes, price) VALUES( 2, 'oil change', 30 , 85.00);
INSERT INTO service (shopNo, service, minutes, price) VALUES( 3, 'oil change', 45 , 100.00);
INSERT INTO service (shopNo, service, minutes, price) VALUES( 3, 'tire rotation', 45 , 95.00);

CREATE TABLE reservation
(resNo int NOT NULL AUTO_INCREMENT,
	custNo int,
	shopNo int,
	servNo int,
	cost decimal(5,2),
	startD date,
	startT time,
	endD date,
	endT time,
	PRIMARY KEY (resNo),
	FOREIGN KEY (custNo) REFERENCES customer(custNo)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (shopNo) REFERENCES shop(shopNo)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (servNo) REFERENCES service(servNo)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

INSERT INTO reservation (custNo, shopNo, servNo, cost, startD, startT, endD, endT) VALUES( 1, 1, 2, 85.00, "2022-05-29", "15:00:00", "2022-05-29", "16:00:00");
INSERT INTO reservation (custNo, shopNo, servNo, cost, startD, startT, endD, endT) VALUES( 1, 2, 3, 85.00, "2022-05-29", "16:00:00", "2022-05-29", "16:30:00");