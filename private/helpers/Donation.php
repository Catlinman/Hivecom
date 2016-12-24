<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the site backend error log filename.
defined("SITE_LOG")
	or define("SITE_LOG", LOG_PATH . "/site-error.log");

class HivecomDonation {
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

	public static function retrieveLatest() {
		$dbconnection = HivecomDonation::dbconnect(); // Make the database connection in not already present.

		// Make the main query.
		if (isset($dbconnection)) {
			$result = mysqli_query($dbconnection, "SELECT * FROM donations ORDER BY id DESC LIMIT 1;") or error_log(mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

		} else {
			return;
		}

		// If a result was returned: create an array from the data.
		if (isset($result)) {
			$row = mysqli_fetch_array($result);
			return $row;
        }
    }

    public static function retrieveAll() {}

    public static function edit($id) {}

    public static function search($term) {}
}
