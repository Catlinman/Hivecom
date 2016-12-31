<?php

require_once(realpath(dirname(__FILE__) . "/../private/config.php"));
require_once(HELPERS_PATH . "/Page.php");

echo HivecomPage::assignAccess(
    "586543cf00b3a",
	"asdf"
);
