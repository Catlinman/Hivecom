<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the site backend error log filename.
defined("SITE_LOG")
	or define("SITE_LOG", LOG_PATH . "/site-error.log");

class HivecomUser {

	public static function dbconnect() {
		// Connect to MySQL. Connection stored in $dbconnection.
		require_once(AUTH_PATH . "/mysql.php");

		if (!isset($dbconnection)) {
			error_log("MySQL connection failed.\n", 3, SITE_LOG);

		} else {
			// Hivecom database should be selected.
			mysqli_select_db($dbconnection, "hivecom") or error_log(mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			return $dbconnection;
		}
	}

    public static function authenticate($handle, $pass) {}

    public static function create($handle, $pass) {}

    public static function remove($handle) {}

    public static function retrieve($handle) {}

    public static function donate($handle, $amount) {}

    public static function edit($handle1, $handle2, $data) {}

    public static function identity($handle, $data) {}

    public static function propagate($handle) {}
}
