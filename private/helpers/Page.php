<?php

// Make sure that the site configuration was loaded.
require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

// Set the site backend error log filename.
defined("SITE_LOG")
    or define("SITE_LOG", LOG_PATH . "/site-error.log");

/**
* Page
*
* Main wrapper class for the Hivecom page data. Provides functions and modules
* for easy use across all other areas of the website as well as the API connection.
*
*/
class Page {

    // MySQL row indice constants. Used for the data array handling.
    const SQL_ID_INDEX				= 0;
	const SQL_UNIQUE_ID_INDEX		= 1;
	const SQL_ACCESS_ID_INDEX		= 2;
	const SQL_TITLE_INDEX			= 3;
	const SQL_SUBTITLE_INDEX		= 4;
	const SQL_AUTHOR_INDEX			= 5;
	const SQL_OPENING_MD_INDEX		= 6;
	const SQL_OPENING_HTML_INDEX	= 7;
	const SQL_CONTENT_MD_INDEX		= 8;
	const SQL_CONTENT_HTML_INDEX	= 9;
	const SQL_DATE_CREATE_INDEX		= 10;
	const SQL_DATE_EDIT_INDEX		= 11;
	const SQL_IS_NEWS_INDEX			= 12;
	const SQL_IS_STICKY_INDEX		= 13;

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

	/**
	* prepare
	*
	* Returns a correctly key associative array of page data. Mainly used for the create & edit function.
	*
	* @param string $author - Author of the page.
	* @param string $title - Title of the page.
	* @param string $opening_md - Page/post opening with markdown formatting. Headings are disabled in post format.
	* @param string $content_md - Page content with markdown formatting. This is hidden in post format.
	* @param bool $is_news - If the page is an announcement. Title and opening will be shown on other pages.
	* @param bool $is_sticky - If the page title and opening should be the headline on the landing page.
	* @return array - Associative array which can be used for the create function.
	*/
	public static function prepare($title, $subtitle, $author, $opening_md, $content_md, $is_news, $is_sticky) {
		$title		= empty($title) 		? "Page title" : $title;
		$subtitle	= empty($subtitle) 		? "Community Announcement" : $subtitle;
		$author		= empty($author) 		? "Hivecom" : $author;
		$opening_md	= empty($opening_md)	? "Page opening." : $opening_md;
		$content_md	= empty($content_md)	? "Page content." : $content_md;

		$is_news	= (int) $is_news or (int) false;
		$is_sticky	= (int) $is_sticky or (int) false;

		return array(
			Page::SQL_AUTHOR_INDEX		=> htmlspecialchars($author),
			Page::SQL_TITLE_INDEX		=> htmlspecialchars($title),
			Page::SQL_SUBTITLE_INDEX	=> htmlspecialchars($subtitle),
			Page::SQL_OPENING_MD_INDEX	=> htmlspecialchars($opening_md),
			Page::SQL_CONTENT_MD_INDEX	=> htmlspecialchars($content_md),
			Page::SQL_IS_NEWS_INDEX		=> htmlspecialchars($is_news),
			Page::SQL_IS_STICKY_INDEX	=> htmlspecialchars($is_sticky),
		);
	}

	/**
	* create
	*
	* Create a new page in the database. Requires a correctly formatted data array to be passed.
	*
	* @param array $data - Correctly formatted associative array of page information.
	* @return string $unique_id - Unique identifier for the newly created page.
	*/
	public static function create($data) {
		$dbconnection = Page::dbconnect(); // Establish a database connection.

		// Make the main query.
		if ($dbconnection) {
			require_once(HELPERS_PATH . "/Utility.php");

			// The system requires the data object to be formatted with the correct keys.
			try {
				// Generate the unique ID of the page as well as the access ID.
				$unique_id = uniqid();

				// Assign the title as an access identifier.
				$access_id = Utility::slug(mysqli_real_escape_string($dbconnection, $data[Page::SQL_TITLE_INDEX]));

				// Check that the access identifier is unique. Otherwise prepend the unique identifier.
				if (Page::retrieveViaAccess($access_id)) {
					$access_id = Utility::slug($unique_id . " " . mysqli_real_escape_string($dbconnection, $data[Page::SQL_TITLE_INDEX]));
				}

				// Assign variables for easier use in the query.
				$author		= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Page::SQL_AUTHOR_INDEX]));
				$title		= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Page::SQL_TITLE_INDEX]));
				$subtitle	= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Page::SQL_SUBTITLE_INDEX]));
				$opening_md	= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Page::SQL_OPENING_MD_INDEX]));
				$content_md	= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Page::SQL_CONTENT_MD_INDEX]));
				$is_news	= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Page::SQL_IS_NEWS_INDEX]));
				$is_sticky	= mysqli_real_escape_string($dbconnection, htmlspecialchars($data[Page::SQL_IS_STICKY_INDEX]));

				// Parse the Markdown formatting and assign it for database insertion.
				$opening_html = mysqli_real_escape_string(
					$dbconnection,
					Utility::parsedown($data[Page::SQL_OPENING_MD_INDEX])
				);

				$content_html = mysqli_real_escape_string(
					$dbconnection,
					Utility::parsedown($data[Page::SQL_CONTENT_MD_INDEX])
				);

			} catch (Exception $e) {
				error_log($e, 3, SITE_LOG);

				return;
			}

			// Perform the main query.
			$result = mysqli_query(
				$dbconnection,
				"INSERT INTO pages (`unique_id`, `access_id`, `author`, `title`, `subtitle`, `opening_md`, `opening_html`, `content_md`, `content_html`, `is_news`, `is_sticky`)
				VALUES (
					'$unique_id',
					'$access_id',
					'$author',
					'$title',
					'$subtitle',
					'$opening_md',
					'$opening_html',
					'$content_md',
					'$content_html',
					'$is_news',
					'$is_sticky'
				);
			"
			) or error_log(date("Y-m-d H:i:s ") . "Page/create: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			// Return the unique id for possible further use in the system.
			return $unique_id;
		}
	}

	/**
	* edit
	*
	* Passes a set of formatted page data to the page using the specified unique identifier.
	*
	* @param string $unique_id - Unique identifier for the page to be edited.
	* @param array - Associative array containing the data to be applied.
	*/
	public static function edit($unique_id, $data) {
		$dbconnection = Page::dbconnect();

		if ($dbconnection) {
			require_once(HELPERS_PATH . "/Utility.php");

			// Assign variables for easier handling. Also escape
			try {
				$title = mysqli_real_escape_string($dbconnection, $data[Page::SQL_TITLE_INDEX]);
				$subtitle = mysqli_real_escape_string($dbconnection, $data[Page::SQL_SUBTITLE_INDEX]);
				$opening_md = mysqli_real_escape_string($dbconnection, $data[Page::SQL_OPENING_MD_INDEX]);
				$content_md = mysqli_real_escape_string($dbconnection, $data[Page::SQL_CONTENT_MD_INDEX]);
				$is_news = mysqli_real_escape_string($dbconnection, $data[Page::SQL_IS_NEWS_INDEX]);
				$is_sticky = mysqli_real_escape_string($dbconnection, $data[Page::SQL_IS_STICKY_INDEX]);

				// Parse the Markdown formatting and assign it for database insertion.
				$opening_html = mysqli_real_escape_string(
					$dbconnection,
					Utility::parsedown($data[Page::SQL_OPENING_MD_INDEX])
				);

				$content_html = mysqli_real_escape_string(
					$dbconnection,
					Utility::parsedown($data[Page::SQL_CONTENT_MD_INDEX])
				);

			} catch (Exception $e) {
				error_log($e, 3, SITE_LOG);

				return;
			}

			// Get the
			if (!Page::retrieve($unique_id)) {
				error_log(date("Y-m-d H:i:s ") . "Page/edit: Page with the unique id of '"  .$unique_id . "' was not found.\n", 3, SITE_LOG);

				return;
			}

			// Perform the main query.
			$result = mysqli_query(
				$dbconnection,
				"UPDATE pages SET
					`title` = '$title',
					`subtitle` = '$subtitle',
					`opening_md` = '$opening_md',
					`opening_html` = '$opening_html',
					`content_md` = '$content_md',
					`content_html` = '$content_html',
					`is_news` = $is_news,
					`is_sticky` = $is_sticky
				WHERE `unique_id` = '$unique_id'
				;"
			) or error_log(date("Y-m-d H:i:s ") . "Page/edit: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);
		}
	}

	/**
	* remove
	*
	* Remove a page from the database.
	*
	* @param string $unique_id - Unique identifier for the page to be removed.
	* @return bool - True if the page was found and successfully removed.
	*/
	public static function remove($unique_id) {
		$dbconnection = Page::dbconnect();

		// Make the main query.
		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "DELETE FROM `pages` WHERE `unique_id` = '$unique_id';")
				or error_log(date("Y-m-d H:i:s ") . "Page/remove: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			return $result;
		}
	}

	/**
	* assignAccess
	*
	* Assigns a new access id to a page with the supplied unique id.
	*
	* @param string $unique_id - Unique identifier of the page to be edited.
	* @param string $access_id - New unique access identifier to be set for the page.
	* @return string $access_id - Returns the access_id if it was successfully set.
	*/
	public static function assignAccess($unique_id, $access_id) {
		$dbconnection = Page::dbconnect();

		if ($dbconnection) {
			// Perform the main query.
			$result = mysqli_query(
				$dbconnection,
				"UPDATE pages SET
					`access_id` = '$access_id'
				WHERE `unique_id` = '$unique_id'
				;"
			) or error_log(date("Y-m-d H:i:s ") . "Page/assignAccess: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			return $access_id;
		}
	}

	/**
	* resetAccess
	*
	* Assigns the original access id to the given page.
	*
	* @param string $unique_id - Unique identifier of the page to be reset.
	* @return string $access_id - Returns the access_id if it was successfully set.
	*/
	public static function resetAccess($unique_id) {
		$page = Page::retrieve($unique_id);

		// Make sure the fetched page exists.
		if (!$page) {
			return;
		}

		// Retrieve the original $access_id.
		$access_id = Utility::slug($unique_id . " " . mysqli_real_escape_string($data[Page::SQL_TITLE_INDEX]));

		$dbconnection = Page::dbconnect();

		if ($dbconnection) {
			// Perform the main query.
			$result = mysqli_query(
				$dbconnection,
				"UPDATE pages SET
					`access_id` = '$access_id'
				WHERE `unique_id` = '$unique_id'
				;"
			) or error_log(date("Y-m-d H:i:s ") . "Page/resetAccess: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);
		}
	}

	/**
	* retrieve
	*
	* Retrieve a page from the database by its unique identifier.
	*
	* @param string $unique_id - The entry unique identifier.
	* @return array - Associative array containing the entire page database row.
	*/
	public static function retrieve($unique_id) {
		$dbconnection = Page::dbconnect();

		// Make the main query.
		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT * FROM `pages` WHERE `unique_id` = '$unique_id';")
				or error_log(date("Y-m-d H:i:s ") . "Page/retrieve: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			if ($result) {
				return mysqli_fetch_array($result);
			}
		}
	}

	/**
	* retrieveViaAccess
	*
	* Retrieve a page from the database by its unique access identifier.
	*
	* @param string $unique_id - The entry unique access identifier.
	* @return array - Associative array containing the entire page database row.
	*/
	public static function retrieveViaAccess($access_id) {
		$dbconnection = Page::dbconnect();

		// Make the main query.
		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT * FROM `pages` WHERE `access_id` = '$access_id';")
				or error_log(date("Y-m-d H:i:s ") . "Page/retrieveViaAccess: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			if ($result) {
				return mysqli_fetch_array($result);
			}
		}
	}

	/**
	* retrieveSticky
	*
	* Retrieve the latest sticky page entry.
	*
	* @return array - Associative array containing the entire page database row.
	*/
	public static function retrieveSticky() {
		$dbconnection = Page::dbconnect();

		// Make the main query.
		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT * FROM `pages` WHERE `is_sticky` = 1 ORDER BY `date_create` DESC LIMIT 1;")
				or error_log(date("Y-m-d H:i:s ") . "Page/retrieveSticky: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			if ($result) {
				return mysqli_fetch_array($result);
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
	public static function retrieveNews($count) {
		$dbconnection = Page::dbconnect();

		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT * FROM `pages` WHERE `is_news` = 1 ORDER BY `date_create` DESC LIMIT $count;")
				or error_log(date("Y-m-d H:i:s ") . "Page/retrieveNews: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

			if ($result) {
				return mysqli_fetch_all($result);
			}
		}
	}

	/**
	* retrieveAll
	*
	* Fetch all page entries from the database as a large three dimensional array.
	*
	* Warning: The second level array is not associative. Key definitions should be used
	*   for consistency in either case to allow easier editing of future table columns/keys.
	*
	* @return array - Three dimensional array containing all pages and their data.
	*/
	public static function retrieveAll() {
		$dbconnection = Page::dbconnect();

		if (!mysqli_error($dbconnection)) {
			$result = mysqli_query($dbconnection, "SELECT * FROM `pages`;")
				or error_log(date("Y-m-d H:i:s ") . "Page/retrieveAll: " . mysqli_error($dbconnection) . ".\n", 3, SITE_LOG);

			if ($result) {
				return mysqli_fetch_all($result);
			}
		}
	}

	/**
	* retrieveCount
	*
	* Counts the number of page entries in the database
	*
	* @return int - Total number of pages in the database.
	*/
	public static function retrieveCount() {
		$dbconnection = Page::dbconnect();

		if ($dbconnection) {
			$result = mysqli_query($dbconnection, "SELECT COUNT(`page_id`) FROM `pages`;")
				or error_log(date("Y-m-d H:i:s ") . "Page/count: " . mysqli_error($dbconnection) . ".\n", 3, SITE_LOG);

			return mysqli_fetch_all($result)[0][0];
		}
	}

	/**
	* TODO search
	*
	* Runs a term against the database to retrieve a possible page entry. Any matching entries
	* are added to an array and then returned in bulk.
	*
	* Search order:
	* 1. Title
	* 2. Unique identifier
	*
	* @param string $term - Search term to use on the system.
	* @return array - Three dimensional array containing all found pages and their data.
	*/
	public static function search($term) {
		// Search by ID, Title & Author.
	}
}
