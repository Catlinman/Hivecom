<?php

// Make sure that the site configuration was loaded.
require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

// Set the Discrod API error log filename.
defined("DISCORD_LOG")
    or define("DISCORD_LOG", LOG_PATH . "/discord-error.log");

class Discord {
    // MySQL row indice constants. Used for the data array handling.
    const SQL_SLOTS_INDEX			= 0;
	const SQL_USERS_INDEX			= 1;
	const SQL_CHANNELS_INDEX		= 2;
	const SQL_PEAK_INDEX			= 3;
	const SQL_DATE_RESTART_INDEX	= 4;
	const SQL_DATE_QUERY_INDEX		= 5;

	private static $query; // Latest query connection.
	private static $cache;

	// Returns the cached query connection data.
	public static function getCache() {
		// Make a database connection if the cache is empty.
		Discord::$cache = ["asdf"];

		// Make a query connection if the cache is out of date.
		return Discord::$cache;
	}

	public static function getCacheDate() {
	}

	// Updates the cached query connection data if needed.
	public static function setCache() {
	}

	public static function connect() {
		// Return the query directly to make code easier to maintain.
		if (Discord::$query) {
			return Discord::$query;
		}

		// Make the Discord data connection.

		Discord::setCache();
	}

	public static function retrieve($id) {
		if (!Discord::$query) {
			Discord::connect();
		}
	}



	public static function kick($id) {
		if (!Discord::$query) {
			Discord::connect();
		}
	}

	public static function ban($id) {
		if (!Discord::$query) {
			Discord::connect();
		}
	}

	public static function move($id, $chanid) {
		if (!Discord::$query) {
			query();
		}
	}

	public static function groupAssign($id, $grpid) {
		if (!Discord::$query) {
			Discord::connect();
		}
	}

	public static function groupRemove($id, $grpid) {
		if (!Discord::$query) {
			Discord::connect();
		}
	}

	public static function makeAvatar($id) {
		if (!Discord::$query) {
			Discord::connect();
		}
	}

	public static function makeViewer() {
		if (!Discord::$cache) {
			Discord::getCache();
		}
	}
}
