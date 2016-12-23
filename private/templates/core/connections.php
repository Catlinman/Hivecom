<?php
// Establish the query & API connections for further use in this section.
require_once(HELPERS_PATH . "/Teamspeak.php");
require_once(HELPERS_PATH . "/Discord.php");

HivecomTeamspeak::connect();

if (!HivecomTeamspeak::$query) {
	echo '<link rel="stylesheet" type="text/css" href="/css/style-red.css">';
}
