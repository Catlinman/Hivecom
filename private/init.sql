
-- Make sure that a database was created. We suggest assigning a new and single user to it.

USE hivecom;

-- Table for Hivecom site variables.
CREATE TABLE site (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`name` VARCHAR(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom gameserver information.
CREATE TABLE `gameservers` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`title` VARCHAR(55) NOT NULL,
`description` TEXT NOT NULL,
`game` VARCHAR(255) NOT NULL,
`address` VARCHAR(255) NOT NULL,
`link` VARCHAR(512) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom page content and announcement binding.
CREATE TABLE `pages` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`uniqueid` CHAR(32) NOT NULL,
`title` VARCHAR(55) NOT NULL,
`summary` TEXT NOT NULL,
`content` TEXT NOT NULL,
`createdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
`editdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`news` BIT NOT NULL DEFAULT 0,
`sticky` BIT NOT NULL DEFAULT 0,
`disqusid` INT NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY uniqueid (`uniqueid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom users. Stores all information and logging.
CREATE TABLE `users` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`username` VARCHAR(15) NOT NULL,
`password` BINARY(60) NOT NULL,
`email` VARCHAR(254) NOT NULL,
`alias` VARCHAR(255) NOT NULL,
`joindate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

-- Personal user information.
`tagline` VARCHAR(255),
`location` VARCHAR(255),
`image` BIT NOT NULL DEFAULT 0,
`badges` TEXT,

-- Donation / Supporter system data.
`supporter` BIT DEFAULT 0,
`supportersum` INT(11) DEFAULT 0,
`supporterdate` DATETIME,

-- External site integration data.
`steamid` VARCHAR(18),
`twitterid` VARCHAR(16),

-- Page user verification, variables and records.
`sitekey` CHAR(32) NOT NULL,
`siteverified` BIT DEFAULT 0,
`sitegroups` VARCHAR(255),
`siteseen` DATETIME,

-- Teamspeak server user verification, variables and records.
`tskey` CHAR(32),
`tsverified` BIT DEFAULT 0,
`tsid` INT(11),
`tsgroups` VARCHAR(255),
`tsalias` VARCHAR(255),
`tsonline` BIT,
`tsseen` DATETIME,
`tsidentity` TEXT,
`tsconnections` INT(11),

-- Discord API user verification, variables and records.
`dckey` CHAR(32),
`dcverified` BIT DEFAULT 0,
`dcid` VARCHAR(255),
`dcgroups` VARCHAR(255),
`dconline` BIT DEFAULT 0,
`dcseen` DATETIME,

PRIMARY KEY (`id`),
UNIQUE KEY username (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom donation pools. Used to store the current pool as well as past ones.
CREATE TABLE donations (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`startdate` DATETIME NOT NULL,
`enddate` DATETIME NOT NULL,
`amount` INT(11) NOT NULL DEFAULT 0,
`goal` INT(11) NOT NULL DEFAULT 50,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
