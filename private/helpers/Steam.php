<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the error log filename.
defined("STEAM_LOG")
    or define("STEAM_LOG", LOG_PATH . "/steam-error.log");

// Get the Steam API authentication information.
// -> STEAM_USER, STEAM_TOKEN
require_once(AUTH_PATH . "/steamapi.php");

class Steam {
    // TODO: Write Steam API helper.
}
