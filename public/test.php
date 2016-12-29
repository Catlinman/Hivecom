<?php

require_once(realpath(dirname(__FILE__) . "/../private/config.php"));
require_once(HELPERS_PATH . "/Page.php");

HivecomPage::edit(
	"ec619d52dcc9fdc942fc284a75afc82c",
    HivecomPage::prepare(
		"Game Night November 27th",
		"Catlinman",
		"
# It's that time again! #
Once again as we do every year we are going to have a game night in the community! Everyone is invited to join. Bring your friends, bring your family!
We will be hanging out in a custom channel on the official Teamspeak server so be there or be square!

We will be kicking things off [November 27th, 2016, 8PM CEST](a).

List of games we will be playing:

- Trouble in Terrorist Town
- Hide & Seek
- The Hidden
- Golf With Friends
- Dirt 3

I look forward to seeing you! Until then, stay awesome!",
		"",
		true,
		true
    )
);
