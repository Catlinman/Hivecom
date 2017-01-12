<?php

// Make sure that the site configuration was loaded.
require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

// Set the site backend error log filename.
defined("SITE_LOG")
    or define("SITE_LOG", LOG_PATH . "/site-error.log");

/**
* Utility
*
* Static class containing general helper commands used throughout modules.
*/
class Utility {

    /**
    * parsedown
    *
    * Generates a HTML compliant content string using the Parsedown library.
    *
    * @param string $s - Markdown formatted content string to be used for HTML generation.
    * @return string - Generated HTML output.
    */
    public static function parsedown($s) {
        // Import the Parsedown markdown conversion library.
        require_once(LIBRARY_PATH . "/Parsedown/Parsedown.php");
        $Parsedown = new Parsedown();

        return $Parsedown->text($s);
    }

    /**
    * slug
    *
    * Sluggifies a string.
    *
    * @param string $s - String to be sluggified.
    * @return string - New sluggified string output.
    */
    public static function slug($s) {
        return strtolower(str_replace(' ', '-', preg_replace('/[^\p{L}\p{N}\s]/u', '', $s)));
    }
}
