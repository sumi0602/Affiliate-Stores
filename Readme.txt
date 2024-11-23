Phpmyadmin

Table to import are

Database - store

Tables - users,sales,payouts


Payouts
===================

CREATE TABLE `payouts` (
 `PayoutID` int(11) NOT NULL AUTO_INCREMENT,
 `SaleID` int(11) NOT NULL,
 `AffiliateID` int(11) NOT NULL,
 `Level` int(11) NOT NULL,
 `Amount` decimal(10,2) NOT NULL,
 `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`PayoutID`),
 KEY `SaleID` (`SaleID`),
 KEY `AffiliateID` (`AffiliateID`),
 CONSTRAINT `payouts_ibfk_1` FOREIGN KEY (`SaleID`) REFERENCES `sales` (`SaleID`),
 CONSTRAINT `payouts_ibfk_2` FOREIGN KEY (`AffiliateID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

sales
============

CREATE TABLE `sales` (
 `SaleID` int(11) NOT NULL AUTO_INCREMENT,
 `AffiliateID` int(11) NOT NULL,
 `Amount` decimal(10,2) NOT NULL,
 `CommissionEarned` decimal(10,2) DEFAULT NULL,
 `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`SaleID`),
 KEY `fk_parent` (`AffiliateID`),
 CONSTRAINT `fk_parent` FOREIGN KEY (`AffiliateID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
 CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`AffiliateID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci



users
===========================
CREATE TABLE `users` (
 `UserID` int(11) NOT NULL AUTO_INCREMENT,
 `Name` varchar(100) NOT NULL,
 `Email` varchar(100) NOT NULL,
 `ParentID` int(11) DEFAULT NULL,
 `Level` int(11) NOT NULL DEFAULT 1,
 PRIMARY KEY (`UserID`),
 UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
