<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

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
*/
class Teamspeak {

    public static $query ;// Latest query connection.

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
        }
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
        if (!Teamspeak::$query) {
            Teamspeak::connect();
        }

        Teamspeak::$query->getViewer(new TeamSpeak3_Viewer_Html("img/icons/", "img/flags/", "data:image"));
    }
}
