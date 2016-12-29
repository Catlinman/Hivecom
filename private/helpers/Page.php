<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the site backend error log filename.
defined("SITE_LOG")
	or define("SITE_LOG", LOG_PATH . "/site-error.log");

/**
* HivecomPage
*
* Main wrapper class for the Hivecom page interface. Provides functions and modules
* for easy use across all other areas of the website as well as the API connection.
*
* Information regarding page content vs page intro fields:
*   Although the introduction sections behave almost exactly the same as the main
*   content sections and are prepended to these, they have one very big difference
*   keeping you from loading them will all your favorite information. Page introductions
*   are meant to be used for news and sticky posts to highlight extra information as
*   short guides to the full information. As such their content is stripped down,
*   removing headers and only leaving the content of the introduction. A link is then
*   presented to the user allowing them to access the full post where the content data
*   is additionally displayed. Here the post introduction also contains any headers it
*   might have had.
*/
class HivecomPage {

    // MySQL row indice constants. Used for the data array handling.
    const SQL_ID_INDEX              = 0;
    const SQL_UNIQUE_ID_INDEX       = 1;
    const SQL_TITLE_INDEX           = 2;
    const SQL_AUTHOR_INDEX          = 3;
    const SQL_INTRO_MD_INDEX        = 4;
    const SQL_INTRO_HTML_INDEX      = 5;
    const SQL_CONTENT_MD_INDEX      = 6;
    const SQL_CONTENT_HTML_INDEX    = 7;
    const SQL_DATE_CREATE_INDEX     = 8;
    const SQL_DATE_EDIT_INDEX       = 9;
    const SQL_IS_NEWS_INDEX         = 10;
    const SQL_IS_STICKY_INDEX       = 11;
    const SQL_DISQUS_ID_INDEX       = 12;

    // Might use these variables later to speed things up.

    // private static $latestid; // The last accessed row id.
    // private static $lastrow; // The last accessed row data.

    /**
    * dbconnect
    *
    * Makes a connection to the MySQL database using the private authentication script.
    *
    * @return mysqli_query - Successful query connection object.
    */
    public static function dbconnect() {
        // Connect to MySQL. Connection stored in $dbconnection.
        require(AUTH_PATH . "/mysql.php");

        if (mysqli_connect_errno()) {
            error_log(date("Y-m-d H:i:s ") . "HivecomPage/dbconnect:" . mysqli_connect_error() . "\n", 3, SITE_LOG);

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
    * @param string $intro_md - Opening segment of the page. Does not contain formatting.
    * @param string $content_md - Content string with markdown formatting.
    * @param bool $is_news - If the page is an announcement. Title and opening will be shown on other pages.
    * @param bool $is_sticky - If the page title and opening should be the headline on the landing page.
    * @return array - Associative array which can be used for the create function.
    */
    public static function prepare($title, $author, $intro_md, $content_md, $is_news, $is_sticky) {
        $title      = $title or "Page title";
        $author     = $author or "Hivecom";
        $intro_md      = $intro_md or "Simple page opening. Nothing too long. No formatting.";
        $content_md    = $content_md or "Main content of the page. Can contain markdown.";
        $is_news     = (int) $is_news or (int) false;
        $is_sticky   = (int) $is_sticky or (int) false;

        return array(
            HivecomPage::SQL_AUTHOR_INDEX       => $author,
            HivecomPage::SQL_TITLE_INDEX        => $title,
            HivecomPage::SQL_INTRO_MD_INDEX     => $intro_md,
            HivecomPage::SQL_CONTENT_MD_INDEX   => $content_md,
            HivecomPage::SQL_IS_NEWS_INDEX      => $is_news,
            HivecomPage::SQL_IS_STICKY_INDEX    => $is_sticky,
        );
    }

    /**
    * create
    *
    * Create a new page in the database. Requires a correctly formatted data array to be passed.
    *
    * UID -> slug($title . date('Y-m-d))
    *
    * @param array $data - Correctly formatted associative array of page information.
    * @return string $unique_id - Unique identifier for the newly created page.
    */
    public static function create($data) {
        $dbconnection = HivecomPage::dbconnect(); // Establish a database connection.

        // Make the main query.
        if ($dbconnection) {
            require_once(HELPERS_PATH . "/Utility.php");

            // Store the current time for generating the UID as well as creation date storage.
            $date_create = date('Y-m-d H:i:s');

            // The system requires the data object to be formatted with the correct keys.
            try {
                $unique_id = HivecomUtility::slug($title . date('Y-m-d'));

                $author = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_AUTHOR_INDEX]);
                $title = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_TITLE_INDEX]);
                $intro_md = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_INTRO_MD_INDEX]);
                $content_md = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_CONTENT_MD_INDEX]);
                $is_news = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_IS_NEWS_INDEX]);
                $is_sticky = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_IS_STICKY_INDEX]);

                // Parse the Markdown formatting and assign it for database insertion.
                $intro_html = mysqli_real_escape_string(
                    $dbconnection,
                    HivecomUtility::parsedown($intro_md)
                );

                $content_html = mysqli_real_escape_string(
                    $dbconnection,
                    HivecomUtility::parsedown($content_md)
                );

            } catch (Exception $e) {
                error_log($e, 3, SITE_LOG);

                return;
            }

            // Perform the main query.
            $result = mysqli_query(
                $dbconnection,
                "INSERT INTO pages (`unique_id`, `date_create`, `author`, `title`, `intro_md`, `intro_html`, `content_md`, `content_html`, `is_news`, `is_sticky`, `disqus_id`)
				VALUES (
					'$unique_id',
					'$date_create',
					'$author',
					'$title',
					'$intro_md',
					'$intro_html',
					'$content_md',
					'$content_html',
					'$is_news',
					'$is_sticky',
					1
				);
			"
            ) or error_log(date("Y-m-d H:i:s ") . "HivecomPage/create: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

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
        $dbconnection = HivecomPage::dbconnect();

        if ($dbconnection) {
            require_once(HELPERS_PATH . "/Utility.php");

            try {
                $title = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_TITLE_INDEX]);
                $intro_md = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_INTRO_MD_INDEX]);
                $content_md = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_CONTENT_MD_INDEX]);
                $is_news = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_IS_NEWS_INDEX]);
                $is_sticky = mysqli_real_escape_string($dbconnection, $data[HivecomPage::SQL_IS_STICKY_INDEX]);

                // Parse the Markdown formatting and assign it for database insertion.
                $intro_html = mysqli_real_escape_string(
                    $dbconnection,
                    HivecomUtility::parsedown($data[HivecomPage::SQL_INTRO_MD_INDEX])
                );

                $content_html = mysqli_real_escape_string(
                    $dbconnection,
                    HivecomUtility::parsedown($data[HivecomPage::SQL_CONTENT_MD_INDEX])
                );

            } catch (Exception $e) {
                error_log($e, 3, SITE_LOG);

                return;
            }

            if (!HivecomPage::retrieve($unique_id)) {
                error_log(date("Y-m-d H:i:s ") . "HivecomPage/edit: Page with the unique id of '"  .$unique_id . "' was not found.\n", 3, SITE_LOG);

				return;
            }

            // Perform the main query.
            $result = mysqli_query(
                $dbconnection,
                "UPDATE pages SET
					`title` = '$title',
					`intro_md` = '$intro_md',
					`intro_html` = '$intro_html',
					`content_md` = '$content_md',
					`content_html` = '$content_html',
					`is_news` = $is_news,
					`is_sticky` = $is_sticky
				WHERE `unique_id` = '$unique_id'
				;"
            ) or error_log(date("Y-m-d H:i:s ") . "HivecomPage/edit: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);
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
        $dbconnection = HivecomPage::dbconnect();

        // Make the main query.
        if ($dbconnection) {
            $result = mysqli_query($dbconnection, "DELETE FROM `pages` WHERE `unique_id` = $unique_id;")
                or error_log(date("Y-m-d H:i:s ") . "HivecomPage/retrieve: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

            return $result;
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
        $dbconnection = HivecomPage::dbconnect();

        // Make the main query.
        if ($dbconnection) {
            $result = mysqli_query($dbconnection, "SELECT * FROM `pages` WHERE `unique_id` = '$unique_id';")
                or error_log(date("Y-m-d H:i:s ") . "HivecomPage/retrieve: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

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
        $dbconnection = HivecomPage::dbconnect();

        // Make the main query.
        if ($dbconnection) {
            $result = mysqli_query($dbconnection, "SELECT * FROM `pages` WHERE `is_sticky` = 1 ORDER BY `date_create` DESC LIMIT 1;")
                or error_log(date("Y-m-d H:i:s ") . "HivecomPage/retrieve: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

            return mysqli_fetch_array($result);
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
        $dbconnection = HivecomPage::dbconnect();

        if ($dbconnection) {
            $result = mysqli_query($dbconnection, "SELECT * FROM `pages` WHERE `is_news` = 1 ORDER BY `date_create` DESC LIMIT $count;")
                or error_log(date("Y-m-d H:i:s ") . "HivecomPage/retrieveLastest: " . mysqli_error($dbconnection) . "\n", 3, SITE_LOG);

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
        $dbconnection = HivecomPage::dbconnect();

        if (!mysqli_error($dbconnection)) {
            $result = mysqli_query($dbconnection, "SELECT * FROM `pages`;")
                or error_log(date("Y-m-d H:i:s ") . "HivecomPage/retrieveAll: " . mysqli_error($dbconnection) . ".\n", 3, SITE_LOG);

            if ($result) {
                return mysqli_fetch_all($result);
            }
        }
    }

    /**
    * count
    *
    * Counts the number of page entries in the database
    *
    * @return int - Total number of pages in the database.
    */
    public static function count() {
        $dbconnection = HivecomPage::dbconnect();

        if ($dbconnection) {
            $result = mysqli_query($dbconnection, "SELECT COUNT(`page_id`) FROM `pages`;")
                or error_log(date("Y-m-d H:i:s ") . "HivecomPage/retrieve: " . mysqli_error($dbconnection) . ".\n", 3, SITE_LOG);

            return mysqli_fetch_all($result)[0];
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

    /**
    * CHANGED easyremove
    *
    * Remove a page from the database without knowing the unique identifier.
    *
    * @param string $title - Page title.
    * @return bool - True if the page was found and successfully removed.
    */
    public static function getUID($title) {
        HivecomPage::remove(
            md5(
                HivecomUtility::slug($title)
            )
        );
    }
}
