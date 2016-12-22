<?php

// Make sure that the site configuration was loaded.
require_once(realpath(dirname(__FILE__) . "/../config.php"));

// Set the Discrod API error log filename.
defined("DISCORD_LOG")
	or define("DISCORD_LOG", "discord-error.log");

class HivecomDiscord {

	// Latest query connection data.
    public static $query;

    public static function connect() {}

    public static function retrieve($id) {}

    public static function kick($id) {}

    public static function ban($id) {}

    public static function move($id, $chanid) {}

    public static function groupAssign($id, $grpid) {}

    public static function groupRemove($id, $grpid) {}

    public static function getAvatar($id) {}
}
