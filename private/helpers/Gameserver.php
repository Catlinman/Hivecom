<?php

// Make sure that the site configuration was loaded.
require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

// Set the site backend error log filename.
defined("SITE_LOG")
    or define("SITE_LOG", LOG_PATH . "/site-error.log");

/**
* Gameserver
*
* Main wrapper class for the Hivecom game server information. Provides functions and modules
* for easy use across all other areas of the website as well as the API connection.
*
*/
class Gameserver {

    // MySQL row indice constants. Used for the data array handling.
    const SQL_ID_INDEX				= 0;
	const SQL_UNIQUE_ID_INDEX		= 1;
	const SQL_GAME_INDEX			= 2;
	const SQL_ADDRESS_INDEX			= 3;
	const SQL_ADDRESS_EASY_INDEX	= 4;
	const SQL_ADDRESS_INFO_INDEX	= 5;
	const SQL_TITLE_INDEX			= 6;
	const SQL_SUMMARY_INDEX			= 7;
	const SQL_ADMINS_INDEX			= 8;
	const SQL_HIDDEN_INDEX			= 9;

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
			error_log(date("Y-m-d H:i:s ") . "Gameserver/dbconnect:" . mysqli_connect_error() . "\n", 3, SITE_LOG);

		} else {
			// Hivecom database should be selected.
			mysqli_select_db($dbconnection, "hivecom")
				or error_log(date("Y-m-d H:i:s ") . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			return $dbconnection;
		}
	}

	/**
	* prepare
	*
	* Returns a correctly key associative array of game server data. Mainly used for the create & edit function.
	*
	* @param string $game - Canonical game name.
	* @param string $address - Server connection address.
	* @param string $address_easy - Opening segment of the page. Does not contain formatting.
	* @param string $address_info - Content string with markdown formatting.
	* @param string $title - Server title. Useful if the server has a custom name or branding.
	* @param string $summary - Server summary. Can be used for server specific information such as gamemodes etc.
	* @param array $admins - Array of Hivecom usernames that are the designated game server admins.
	* @param bool $hidden - If the server should be hidden. Useful for later publishing or maintenance.
	* @return array - Associative array which can be used for further processing function.
	*/
	public static function prepare($game, $address, $address_easy, $address_info, $title, $summary, $admins, $hidden) {
		$game           = empty($game) 			? "Game Title" : $game;
		$address        = empty($address) 		? "" : $address;
		$address_easy   = empty($address_easy) 	? "" : $address_easy;
		$address_info   = empty($address_info)	? "" : $address_info;
		$title          = empty($title)			? "Server Title" : $title;
		$summary        = empty($summary)		? "Server information summary" : $summary;
		$admins         = empty($admins) 		? "" : preg_replace('/\s+/', '', $admins);

		$hidden         = (int) $hidden or (int) false;

		return array(
			Gameserver::SQL_GAME_INDEX			=> htmlspecialchars($game),
			Gameserver::SQL_ADDRESS_INDEX		=> htmlspecialchars($address),
			Gameserver::SQL_ADDRESS_EASY_INDEX	=> htmlspecialchars($address_easy),
			Gameserver::SQL_ADDRESS_INFO_INDEX	=> htmlspecialchars($address_info),
			Gameserver::SQL_TITLE_INDEX			=> htmlspecialchars($title),
			Gameserver::SQL_SUMMARY_INDEX		=> htmlspecialchars($summary),
			Gameserver::SQL_ADMINS_INDEX		=> htmlspecialchars($admins),
			Gameserver::SQL_HIDDEN_INDEX		=> htmlspecialchars($hidden)
		);
	}

	/**
	* create
	*
	* Create a new game server in the database. Requires a correctly formatted data array to be passed.
	*
	* @param array $data - Correctly formatted associative array of game server information.
	* @return string $unique_id - Unique identifier for the newly created page.
	*/
	public static function create($data) {
		$dbconnection = Gameserver::dbconnect(); // Establish a database connection.

		// Make the main query.
		if ($dbconnection) {
			// The system requires the data object to be formatted with the correct keys.
			try {
				// Generate the unique ID of the game server as well as the access ID.
				$unique_id = uniqid();

				// Assign variables for easier use in the query.
				$game			= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Gameserver::SQL_GAME_INDEX]));
				$address		= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Gameserver::SQL_ADDRESS_INDEX]));
				$address_easy	= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Gameserver::SQL_ADDRESS_EASY_INDEX]));
				$address_info	= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Gameserver::SQL_ADDRESS_INFO_INDEX]));
				$title			= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Gameserver::SQL_TITLE_INDEX]));
				$summary		= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Gameserver::SQL_SUMMARY_INDEX]));
				$admins			= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Gameserver::SQL_ADMINS_INDEX]));
				$hidden			= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Gameserver::SQL_HIDDEN_INDEX]));

			} catch (Exception $e) {
				error_log($e, 3, SITE_LOG);

				return;
			}

			// Perform the main query.
			$result = mysqli_query(
				$dbconnection,
				"INSERT INTO `gameservers` (`unique_id`, `game`, `address`, `address_easy`, `address_info`, `title`, `summary`, `admins`, `hidden`)
				VALUES (
					'$unique_id',
					'$game',
					'$address',
					'$address_easy',
					'$address_info',
					'$title',
					'$summary',
					'$admins',
					'$hidden'
				);
			"
			) or error_log(date("Y-m-d H:i:s ") . "Gameserver/create: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			// Return the unique id for possible further use in the system.
			return $unique_id;
		}
	}

	/**
	* edit
	*
	* Passes a set of formatted game server data to the game server using the specified unique identifier.
	*
	* @param string $unique_id - Unique identifier for the game server to be edited.
	* @param array - Associative array containing the data to be applied.
	*/
	public static function edit($unique_id, $data) {
		$dbconnection = Gameserver::dbconnect();

		if ($dbconnection) {
			require_once(HELPERS_PATH . "/Utility.php");

			try {
				// Edit all values except the game entry.
				$game			= mysqli_real_escape_string($dbconnection, $data[Gameserver::SQL_GAME_INDEX]);
				$address		= mysqli_real_escape_string($dbconnection, $data[Gameserver::SQL_ADDRESS_INDEX]);
				$address_easy	= mysqli_real_escape_string($dbconnection, $data[Gameserver::SQL_ADDRESS_EASY_INDEX]);
				$address_info	= mysqli_real_escape_string($dbconnection, $data[Gameserver::SQL_ADDRESS_INFO_INDEX]);
				$title			= mysqli_real_escape_string($dbconnection, $data[Gameserver::SQL_TITLE_INDEX]);
				$summary		= mysqli_real_escape_string($dbconnection, $data[Gameserver::SQL_SUMMARY_INDEX]);
				$admins			= mysqli_real_escape_string($dbconnection, $data[Gameserver::SQL_ADMINS_INDEX]);
				$hidden			= mysqli_real_escape_string($dbconnection, $data[Gameserver::SQL_HIDDEN_INDEX]);

			} catch (Exception $e) {
				error_log($e, 3, SITE_LOG);

				return;
			}

			if (!Gameserver::retrieve($unique_id)) {
				error_log(date("Y-m-d H:i:s ") . "Gameserver/edit: Game server with the unique id of '"  .$unique_id . "' was not found.\n", 3, SITE_LOG);

				return;
			}

			// Perform the main query.
			$result = mysqli_query(
				$dbconnection,
				"UPDATE `gameservers` SET
					`game` = '$game',
					`address` = '$address',
					`address_easy` = '$address_easy',
					`address_info` = '$address_info',
					`title` = '$title',
					`summary` = '$summary',
					`admins` = '$admins',
					`hidden` = '$hidden'
				WHERE `unique_id` = '$unique_id'
				;"
			) or error_log(date("Y-m-d H:i:s ") . "Gameserver/edit: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);
		}
	}

	/**
	* remove
	*
	* Remove a game server from the database.
	*
	* @param string $unique_id - Unique identifier for the game server to be removed.
	* @return bool - True if the game server was found and successfully removed.
	*/
	public static function remove($unique_id) {
		$dbconnection = Gameserver::dbconnect();

		// Make the main query.
		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "DELETE FROM `gameservers` WHERE `unique_id` = '$unique_id';")
				or error_log(date("Y-m-d H:i:s ") . "Gameserver/remove: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			return $result;
		}
	}

	/**
	* retrieve
	*
	* Retrieve a game server from the database by its unique identifier.
	*
	* @param string $unique_id - The data unique identifier.
	* @return array - Associative array containing the entire game server database row.
	*/
	public static function retrieve($unique_id) {
		$dbconnection = Gameserver::dbconnect();

		// Make the main query.
		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT * FROM `gameservers` WHERE `unique_id` = '$unique_id';")
				or error_log(date("Y-m-d H:i:s ") . "Gameserver/retrieve: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			if ($result) {
				return mysqli_fetch_array($result);
			}
		}
	}

	/**
	* retrieveAll
	*
	* Fetch all game server entries from the database as a large three dimensional array.
	*
	* Warning: The second level array is not associative. Key definitions should be used
	*   for consistency in either case to allow easier editing of future table columns/keys.
	*
	* @return array - Three dimensional array containing all game servers and their data.
	*/
	public static function retrieveAll() {
		$dbconnection = Gameserver::dbconnect();

		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT * FROM `gameservers`;")
				or error_log(date("Y-m-d H:i:s ") . "Gameserver/retrieveAll: " . mysqli_error($dbconnection) . ".\n", 3, SITE_LOG);

			if ($result) {
				return mysqli_fetch_all($result);
			}
		}
	}

	/**
	* retrieveNews
	*
	* Retrieve a specified amount of news posts.
	*
	* @param $count int - Amount of news posts to return.
	* @return array - Three dimensional array containing the news pages' data.
	*/
	public static function retrieveOnline($count) {
		$dbconnection = Gameserver::dbconnect();

		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT * FROM `gameservers` WHERE `hidden` = 0 ORDER BY `gameserver_id` DESC LIMIT $count;")
				or error_log(date("Y-m-d H:i:s ") . "Gameserver/retrieveOnline: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			if ($result) {
				return mysqli_fetch_all($result);
			}
		}
	}

	/**
	* retrieveCount
	*
	* Counts the number of game server entries in the database
	*
	* @return int - Total number of game servers in the database.
	*/
	public static function retrieveCount() {
		$dbconnection = Gameserver::dbconnect();

		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT COUNT(`gameserver_id`) FROM `gameservers`;")
				or error_log(date("Y-m-d H:i:s ") . "Gameserver/count: " . mysqli_error($dbconnection) . ".\n", 3, SITE_LOG);

			return mysqli_fetch_all($result)[0][0];
		}
	}
}
