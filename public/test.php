<?php

require_once(realpath(dirname(__FILE__) . "/../private/config.php"));
require_once(HELPERS_PATH . "/Gameserver.php");
require_once(HELPERS_PATH . "/Page.php");

/*
// MySQL row indice constants. Used for the data array handling.
const SQL_ID_INDEX              = 0;
const SQL_UNIQUE_ID_INDEX       = 1;
const SQL_GAME_INDEX            = 2;
const SQL_ADDRESS_INDEX         = 3;
const SQL_ADDRESS_EASY_INDEX    = 4;
const SQL_ADDRESS_INFO_INDEX    = 5;
const SQL_TITLE_INDEX           = 6;
const SQL_SUMMARY_INDEX         = 7;
const SQL_ADMINS_INDEX          = 8;
 */

/*echo Gameserver::edit(
    "5869945d75068",
    Gameserver::prepare(
        "rust",
        "rust.hivecom.net:28036",
        "steam://connect/rust.hivecom.net:28036",
        "",
        "The Leaky Faucet",
        "Freeplay Vanilla Rust server that is updated on a regular basis. Has slots for up to 60 players and is open to anyone willing to join.",
        "rapid,catlinman",
        false
    )
);*/

/*
const SQL_ID_INDEX              = 0;
const SQL_UNIQUE_ID_INDEX       = 1;
const SQL_ACCESS_ID_INDEX       = 2;
	const SQL_TITLE_INDEX           = 3;
	const SQL_SUBTITLE_INDEX        = 4;
	const SQL_AUTHOR_INDEX          = 5;
	const SQL_OPENING_MD_INDEX      = 6;
const SQL_OPENING_HTML_INDEX    = 7;
	const SQL_CONTENT_MD_INDEX      = 8;
const SQL_CONTENT_HTML_INDEX    = 9;
const SQL_DATE_CREATE_INDEX     = 10;
const SQL_DATE_EDIT_INDEX       = 11;
	const SQL_IS_NEWS_INDEX         = 12;
	const SQL_IS_STICKY_INDEX       = 13;

echo Page::edit(
	"58699a8e44a51",
    Page::prepare(
		"New Site Update",
		"Community Announcement",
		"Catlinman",
		"
# It's finally here! #

Been a long time since the site had any sort of update. As many might know, over the last few months the site has been completely dead with most information
actually being broken or completely out of date. Although [Catlinman](/user/profile?username=catlinman) had intended to get the site up to date and with all
new features around November some things got inbetween and it had to get pushed off. It's here now though and better than ever!
		",
		"
## Why it took so long ##

I have some extra explaining to do I think. I initially intended to have the site running even earlier than the first revamp deadline
I set for myself but man has this year been rough. Not only did I have a ton of work to do that I simply had to put ahead of my plans for expanding and remaking
the main Hivecom website system but I also had some big personal and more family related things to take care of that I could not just push off.

In a sense I am sorry that it took so long to get things going but on the other hand I am happy that I got this site - for the most part - done before the end of
the year. What you are seeing so far is a rather functional site. I've added a ton of new features and reworked a lot of the core ideas of the page. It turned out
to be a lot more work than I thought it would be but I'm making a good deal of progress. As you can see one of the biggest new features is that we can make some
really big posts here on our page alone. Before you had to rely on the Twitter feeds and such to give you up to date information but we can now have it all in
one nice little spot. Something I wanted very early on but gave up. One of the biggest issues was the project structure and set up. I hadn't really future-proofed
it so to say and just let it die for the most part. Didn't expect to have to rewrite almost every single aspect of the page later on but that's what I ended up
doing this entire last week. It's looking good and I have made sure to keep things as organized and easy to understand as possible while also keeping my eye
out on performance of the site and it's general size. These are things that I personally factor in very heavily. The site is far from done but it is looking
to have a promosing future. If you want to track my work on the page you can head over to the official [GitHub repository](https://github.com/catlinman/hivecom.net).
There you can see my newest changes as well as the work I am putting in the page.

## What's still ahead ##

First off, announcements are done, custom pages are done, game server listings are done, style sheet rewrites and HTML cleanup is done, project modularisation
has been complete which was a big pain previously, Teamspeak and Discord server integrations are mostly done although the viewer systems - which are now
custom and handled by Hivecom on it's own - still require some tinkering until I am happy to release them on the main page. The biggest new feature that
is there in the backend but not quite ready for public release is the new user system. Some of you might have heard of my plans for it but I am not quite
happy with throwing it out there just yet. Once it is done though the staff section on the main page will have a revamp and everything will flow together
very nicely. It's technically all ready and just waiting to be used due to the new system allowing me to work on multiple subsystems of the page without
breaking others. I'll inform everyone once changes roll out. When the page reaches the point where I have implemented and tested all planned features I'll
write a changelog post where everything will be listed. That'll be fun for sure!

Either way, I hope that you are happy with the changes I have made so far. I hope to see you around. Happy new year by the way!
		",
		true,
		true
    )
);
*/

echo Page::assignAccess("58699a8e44a51", "site-launch");
