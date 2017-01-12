<?php

// Make sure that the site configuration was loaded.
require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

// Import the Teamspeak3 PHP library.
require_once(LIBRARY_PATH . "/TeamSpeak3/TeamSpeak3.php");

// Set the error log filename.
defined("TS3_QUERY_LOG")
    or define("TS3_QUERY_LOG", LOG_PATH . "/ts3-error.log");

// Set the query server address.
defined("TS3_QUERY_ADDRESS")
    or define("TS3_QUERY_ADDRESS", "ts.hivecom.net");

// Set the server query port.
defined("TS3_QUERY_PORT")
    or define("TS3_QUERY_PORT", 10011);

// Set the port for the server we will be getting information from.
defined("TS3_QUERY_SERVERPORT")
    or define("TS3_QUERY_SERVERPORT", 9987);

// Get the Teamspeak3 query connection authentication information.
// -> TS3_QUERY_USER, TS3_QUERY_PASS
require_once(AUTH_PATH . "/tsquery.php");

/**
* Page
*
* Wrapper class for the Teamspeak3 PHP framework in relation to use on the Hivecom website.
* Uses the database to cache actively used information.
*/
class Teamspeak {

    // MySQL row indice constants. Used for the data array handling.
    const SQL_SLOTS_INDEX			= 0;
	const SQL_USERS_INDEX			= 1;
	const SQL_CHANNELS_INDEX		= 2;
	const SQL_PEAK_INDEX			= 3;
	const SQL_DATE_RESTART_INDEX	= 4;
	const SQL_DATE_QUERY_INDEX		= 5;

    private static $query; // Active query connection.
	private static $cache; // Cached data from previous connection.

	/**
	* dbconnect
	*
	* Makes a connection to the MySQL database using the private authentication script.
	*
	* @return mysqli_query - Successful query connection object.
	*/
	public static function dbconnect() {
		// Return the already existing connection if it is set.
		if (isset($dbconnection)) {
			return $dbconnection;
		}

		// Connect to MySQL. Connection stored in $dbconnection.
		require(AUTH_PATH . "/mysql.php");

		if (mysqli_connect_errno()) {
			error_log(date("Y-m-d H:i:s ") . "Page/dbconnect:" . mysqli_connect_error() . "\n", 3, SITE_LOG);

		} else {
			// Hivecom database should be selected.
			mysqli_select_db($dbconnection, "hivecom")
				or error_log(date("Y-m-d H:i:s ") . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			return $dbconnection;
		}
	}

    public static function connect() {
        // Return the query directly to make code easier to maintain.
        if (Teamspeak::$query) {
            return Teamspeak::$query;
        }

        try {
            // Create the correctly formatted query for the Teamspeak3 server.
            $querystring = sprintf(
                "serverquery://%s:%s@%s:%u/?server_port=%u&use_offline_as_virtual=1&no_query_clients=1",
                TS3_QUERY_USER,
                TS3_QUERY_PASS,
                TS3_QUERY_ADDRESS,
                TS3_QUERY_PORT,
                TS3_QUERY_SERVERPORT
            );

            Teamspeak::$query = TeamSpeak3::factory($querystring);

        } catch (Exception $e) {
            error_log($e, 3, TS3_QUERY_LOG);

			return;
        }

		Teamspeak::setCache();
    }

	// Returns the cached query connection data.
	public static function getCache() {
		// Make a database connection if the cache is empty.
		Teamspeak::$cache = ["asdf"];

		// Make a query connection if the cache is out of date.
		return Teamspeak::$cache;
	}

	public static function getCacheDate() {
	}

	// Updates the cached query connection data if needed.
	public static function setCache() {
	}

    public static function retrieve($id) {
        if (!Teamspeak::$query) {
            Teamspeak::connect();
        }
    }

    public static function kick($id) {
        if (!Teamspeak::$query) {
            Teamspeak::connect();
        }
    }

    public static function ban($id) {
        if (!Teamspeak::$query) {
            Teamspeak::connect();
        }
    }

    public static function move($id, $chanid) {
        if (!Teamspeak::$query) {
            query();
        }
    }

    public static function groupAssign($id, $grpid) {
        if (!Teamspeak::$query) {
            Teamspeak::connect();
        }
    }

    public static function groupRemove($id, $grpid) {
        if (!Teamspeak::$query) {
            Teamspeak::connect();
        }
    }

    public static function makeAvatar($id) {
        if (!Teamspeak::$query) {
            Teamspeak::connect();
        }
    }

    public static function makeViewer() {
        if (!Teamspeak::$cache) {
            Teamspeak::getCache();
        }
    }
}
