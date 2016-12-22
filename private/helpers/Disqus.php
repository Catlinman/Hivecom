<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the Discrod API error log filename.
defined("DISQUS_LOG")
	or define("DISQUS_LOG", "disqus-error.log");

class HivecomDisqus {
	// TODO: Write Disqus API helper.
}
