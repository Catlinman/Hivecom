<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the site backend error log filename.
defined("SITE_LOG")
	or define("SITE_LOG", "site-error.log");

class HivecomUser {

    public static function authenticate($handle, $pass) {}

    public static function create($handle, $pass) {}

    public static function remove($handle) {}

    public static function retrieve($handle) {}

    public static function donate($handle, $amount) {}

    public static function edit($handle1, $handle2, $data) {}

    public static function identity($handle, $data) {}

    public static function propagate($handle) {}
}
