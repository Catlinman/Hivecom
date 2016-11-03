<?php

	// TODO: Define global variables that handle activity of server and current query connection.

    defined("LOG_PATH")
        or define("LOG_PATH", realpath(dirname(__FILE__) . '/log'));

    defined("LIBRARY_PATH")
        or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));

    defined("TEMPLATES_PATH")
        or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

    ini_set("error_reporting", "true");
    ini_set("log_errors", 1);
    ini_set("error_log", "/log/php-error.log");
    error_reporting(E_ALL|E_STRCT);
?>
