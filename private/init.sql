
-- Make sure that a database was created. We suggest assigning a new and
-- single user to it for further authentication and use throughout the project.

USE hivecom;

-- Table for the cached Teamspeak query data.
CREATE TABLE `tsquery` (
`slots` INT(4) NOT NULL,
`users` TEXT NOT NULL,
`structure` TEXT NOT NULL,
`peak` INT NOT NULL,
`date_restart` DATETIME,
`date_query` DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for the cached Discord query data.
CREATE TABLE `dcquery` (
`chat_users` TEXT NOT NULL,
`voice_users` TEXT NOT NULL,
`channels` TEXT NOT NULL,
`peak` INT NOT NULL,
`date_query` DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom page content and announcement binding.
CREATE TABLE `pages` (
`page_id` INT(11) NOT NULL AUTO_INCREMENT,
`unique_id` CHAR(13) NOT NULL,
`access_id` VARCHAR(255) NOT NULL,
`title` VARCHAR(24) NOT NULL,
`subtitle` VARCHAR(46) NOT NULL,
`author` VARCHAR(15),
`opening_md` TEXT NOT NULL,
`opening_html` TEXT NOT NULL,
`content_md` MEDIUMTEXT NOT NULL,
`content_html` MEDIUMTEXT NOT NULL,
`date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_edit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`is_news` BOOLEAN NOT NULL DEFAULT FALSE,
`is_sticky` BOOLEAN NOT NULL DEFAULT FALSE,
PRIMARY KEY (`page_id`),
UNIQUE KEY uniqueid (`unique_id`, `access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom gameserver information.
CREATE TABLE `gameservers` (
`gameserver_id` INT(11) NOT NULL AUTO_INCREMENT,
`unique_id` CHAR(13) NOT NULL,
`game` VARCHAR(255) NOT NULL,
`address` VARCHAR(512) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
`address_easy` VARCHAR(512) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
`address_info` VARCHAR(512) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
`title` VARCHAR(128) NOT NULL,
`summary` TEXT NOT NULL,
`admins` VARCHAR(255) NOT NULL,
`hidden` BOOLEAN NOT NULL DEFAULT FALSE,
PRIMARY KEY (`gameserver_id`),
UNIQUE KEY uniqueid (`unique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom users. Stores all information and logging.
CREATE TABLE `users` (
`user_id` INT(11) NOT NULL AUTO_INCREMENT,
`unique_id` CHAR(13) NOT NULL,
`username` VARCHAR(15) NOT NULL,
`password` BINARY(60) NOT NULL,
`email` VARCHAR(254) NOT NULL,
`alias` VARCHAR(255) NOT NULL,
`date_join` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

-- Personal user information.
`bio` VARCHAR(255),
`birthday` DATETIME,
`location` VARCHAR(255),
`image` BOOLEAN NOT NULL DEFAULT FALSE,
`badges` TEXT,

-- Donation / Supporter system data.
`supporter` BOOLEAN DEFAULT FALSE,
`supporter_sum` DECIMAL(8,2) UNSIGNED ZEROFILL,
`supporter_date` DATETIME,

-- External site integration data.
`steam_id` VARCHAR(18),
`twitter_id` VARCHAR(16),

-- Page user verification, variables and records.
`site_key` CHAR(32) NOT NULL,
`site_verified` BOOLEAN DEFAULT FALSE,
`site_groups` VARCHAR(255),
`site_lastseen` DATETIME,

-- Teamspeak server user verification, variables and records.
`ts_key` CHAR(32),
`ts_verified` BOOLEAN DEFAULT FALSE,
`ts_id` INT(11),
`ts_groups` VARCHAR(255),
`ts_alias` VARCHAR(255),
`ts_online` BOOLEAN,
`ts_seen` DATETIME,
`ts_identity` TEXT,
`ts_connections` INT(11),

-- Discord API user verification, variables and records.
`dc_key` CHAR(32),
`dc_verified` BOOLEAN DEFAULT FALSE,
`dc_id` VARCHAR(255),
`dc_groups` VARCHAR(255),
`dc_online` BOOLEAN DEFAULT FALSE,
`dc_seen` DATETIME,

PRIMARY KEY (`user_id`),
UNIQUE KEY username (`unique_id`, `username`, `email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom donation pools. Used to store the current pool as well as past ones.
CREATE TABLE donations (
`donation_id` INT(11) NOT NULL AUTO_INCREMENT,
`date_start` DATETIME NOT NULL,
`date_end` DATETIME NOT NULL,
`amount` INT(11) NOT NULL DEFAULT 0,
`goal` INT(11) NOT NULL DEFAULT 50,
PRIMARY KEY (`donation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table for Hivecom user badges.
CREATE TABLE badges (
`badge_id` INT(11) NOT NULL AUTO_INCREMENT,
`name` DATETIME NOT NULL,
`description` DATETIME NOT NULL,
PRIMARY KEY (`badge_id`),
UNIQUE KEY username (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
