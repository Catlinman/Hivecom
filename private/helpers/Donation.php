<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the site backend error log filename.
defined("SITE_LOG")
	or define("SITE_LOG", LOG_PATH . "/site-error.log");

class HivecomDonation {
	public static function dbconnect() {
		// Connect to MySQL. Connection stored in $dbconnection.
		require(AUTH_PATH . "/mysql.php");

		if (mysqli_connect_errno()) {
            error_log(date("Y-m-d H:i:s ") . "HivecomDonation/dbconnect:" . mysqli_connect_error() . ".\n", 3, SITE_LOG);

        } else {
            // Hivecom database should be selected.
            mysqli_select_db($dbconnection, "hivecom")
				or error_log(date("Y-m-d H:i:s ") . "HivecomDonation/dbconnect:" . mysqli_error($dbconnection) . ".\n", 3, SITE_LOG);

            return $dbconnection;
        }
	}

	public static function create($data) {}

	public static function remove($id) {}

	public static function retrieve($id) {}

	public static function retrieveLatest() {
		$dbconnection = HivecomDonation::dbconnect(); // Make the database connection in not already present.

		// Make the main query.
		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT * FROM donations ORDER BY `date_start` DESC LIMIT 1;")
				or error_log(date("Y-m-d H:i:s ") . "HivecomDonation/retrieveLatest: " . mysqli_error($dbconnection) . ".\n", 3, SITE_LOG);

			// If a result was returned: create an array from the data.
			if ($result) {
				$row = mysqli_fetch_array($result);
				return $row;
			}
		}
    }

    public static function retrieveAll() {}

    public static function edit($id) {}

    public static function search($term) {}
}
