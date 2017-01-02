<?php

// Define constants for the paths used in the project.
defined("LOG_PATH")
    or define("LOG_PATH", realpath(dirname(__FILE__) . "/log"));

defined("SOURCE_PATH")
    or define("HELPERS_PATH", realpath(dirname(__FILE__) . "/helpers"));

defined("AUTH_PATH")
    or define("AUTH_PATH", realpath(dirname(__FILE__) . "/authentication"));

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . "/library"));

defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . "/templates"));

defined("IMAGES_PATH")
    or define("IMAGES_PATH", realpath(dirname(__FILE__) . "/../public/img"));


// Time in seconds between API and data queries.
defined("QUERYINTERVAL")
	or define("QUERYINTERVAL", 300);

// Maximum number of news entries on the main page.
defined("MAXNEWS")
    or define("MAXNEWS", 3);

// Main Steam Group handle of the site.
defined("STEAM")
	or define("STEAM", "hivecomnetwork");

// Main Twitter handle of the site.
defined("TWITTER")
	or define("TWITTER", "hivecomnetwork");

// Main Facebook handle of the site.
defined("FACEBOOK")
	or define("FACEBOOK", "hivecom");

// Set the default timezone to keep uid gen consistent.
date_default_timezone_set("Europe/Berlin");

// Set error log levels and default output.
ini_set("log_errors", 1);
ini_set("error_log", LOG_PATH . "/php-error.log");

// Set which errors should be reported.
error_reporting(E_ALL);

session_start();
