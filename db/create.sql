-- Schema and table creation scripts pulled from MySQL Workbench
-- These can be ran on any machine to replicate our simple database

CREATE DATABASE `megatravel` /*!40100 DEFAULT CHARACTER SET latin1 */;

DROP TABLE `Reservations`;

CREATE TABLE `reservations` (
    `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(60) NOT NULL,
    `phone` varchar(10) NOT NULL,
    `email` varchar(60) NOT NULL,
    `num_adults` int(2) NOT NULL,
    `num_kids` int(2) NOT NULL,
    `destination` varchar(45) NOT NULL,
    `depart_date` datetime NOT NULL,
    `return_date` datetime NOT NULL,
    `activities` varchar(200),
    PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;