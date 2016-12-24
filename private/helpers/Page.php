<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the site backend error log filename.
defined("SITE_LOG")
	or define("SITE_LOG", LOG_PATH . "/site-error.log");

class HivecomPage {

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

    public static function create($data) {}

    public static function remove($id) {}

    public static function retrieve($id) {}

    public static function retrieveAll() {}

    public static function search($term) {}

    public static function edit($id, $data) {}
}
