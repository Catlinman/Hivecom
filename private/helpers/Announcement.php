<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the site backend error log filename.
defined("SITE_LOG")
	or define("SITE_LOG", "site-error.log");

class HivecomAnnouncement {
	public static function create($data) {}

	public static function remove($id) {}

	public static function retrieve($id) {}

	public static function retrieveAll() {}

	public static function edit($id) {}

	public static function search($term) {}
}
