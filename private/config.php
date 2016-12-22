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

// Set error log levels and default output.
ini_set("log_errors", 1);
ini_set("error_log", LOG_PATH . "/log/php-error.log");

// Set which errors should be reported.
error_reporting(E_ALL);
