<?php

// Make sure that the site configuration was loaded.
require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

// Set the site backend error log filename.
defined("SITE_LOG")
    or define("SITE_LOG", LOG_PATH . "/site-error.log");

class User {

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

    public static function authenticate($unique_id, $pass) {}

    public static function create($unique_id, $pass) {}

    public static function remove($unique_id) {}

    public static function retrieve($unique_id) {}

    public static function retrieveHandle($unique_id){}

    public static function donate($unique_id, $amount) {}

    public static function edit($unique_id, $data) {}

    public static function identity($unique_id, $key, $data) {}

    public static function propagate($unique_id) {}
}
