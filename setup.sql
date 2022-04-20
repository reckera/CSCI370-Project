-- admin  Kvinajdvnjsh

CREATE DATABASE IF NOT EXISTS carBuddy;
USE carBuddy;

DROP TABLE IF EXISTS shop, customer, transaction, service;

CREATE TABLE shop
(shopNo int AUTO_INCREMENT,
	shopName varchar(35),
	password char(8),
	zipCode int,
	rating int,
	PRIMARY KEY (shopNo)
);

CREATE TABLE customer
(custNo int AUTO_INCREMENT,
	FName varchar(20),
	LName varchar(20),
	password char(10),
	address varchar(40),
	PRIMARY KEY (custNo)
);

CREATE TABLE transaction
(transNo int AUTO_INCREMENT,
	custNo int,
	shopNo int,
	totCost decimal(5,2),
	start datetime,
	end datetime,
	PRIMARY KEY (transNo),
	FOREIGN KEY (custNo) REFERENCES customer(custNo)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (shopNo) REFERENCES shop(shopNo)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE service
(shopNo int,
	service varchar(40),
	time int,
	price decimal(5,2),
	PRIMARY KEY (shopNo, service),
	FOREIGN KEY (shopNo) REFERENCES shop(shopNo)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);