
CREATE DATABASE `memberdb`; /*!40100 DEFAULT CHARACTER SET utf8mb4 */


CREATE TABLE `admin_log` (
 `acc_id` int(25) NOT NULL AUTO_INCREMENT,
 `acc_user` varchar(25) NOT NULL,
 `acc_pass` varchar(25) NOT NULL,
 PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `coaches` (
 `id` int(255) NOT NULL AUTO_INCREMENT,
 `coachName` varchar(255) NOT NULL,
 `coachEmail` varchar(255) NOT NULL,
 `teamid` int(25) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `member` (
 `member_id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(255) NOT NULL,
 `last_name` varchar(255) DEFAULT NULL,
 `phone_numb` int(11) DEFAULT NULL,
 `email` varchar(255) DEFAULT NULL,
 `student_status` varchar(25) NOT NULL,
 `student_numb` varchar(25) DEFAULT NULL,
 `teamid` int(11) DEFAULT NULL,
 `schoolId` int(25) DEFAULT NULL,
 PRIMARY KEY (`member_id`),
 KEY `team_ibfk_1` (`teamid`),
 KEY `schooolId` (`schoolId`),
 CONSTRAINT `schoolId` FOREIGN KEY (`schoolId`) REFERENCES `school` (`SchoolId`),
 CONSTRAINT `team_ibfk_1` FOREIGN KEY (`teamid`) REFERENCES `team` (`teamid`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `school` (
 `SchoolId` int(255) NOT NULL AUTO_INCREMENT,
 `SchoolName` varchar(25) NOT NULL,
 PRIMARY KEY (`SchoolId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `team` (
 `teamid` int(25) NOT NULL AUTO_INCREMENT,
 `teamName` varchar(255) NOT NULL,
 `game` varchar(255) NOT NULL,
 PRIMARY KEY (`teamid`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;