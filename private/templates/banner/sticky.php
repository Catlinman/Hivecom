<?php

require_once(realpath(dirname(__FILE__) . "/../../config.php"));

require_once(HELPERS_PATH . "/Utility.php");
require_once(HELPERS_PATH . "/Page.php");

// Fetch the latest sticky post from the database.
$stickypost = HivecomPage::retrieveSticky();

// If there is no sticky post we can stop right here.
if (!$stickypost) {
    return;
}

// Get the latest sticky post. If none exist this will be null.
$stickypost = HivecomPage::retrieveSticky();

// Display the title of the post and link the page with additional information.
echo sprintf(
	'<h5 class="centered">- Community Announcement -</h5><h3 class="centered"><a href="/page?uid=%s">%s</a></h3>',
	$stickypost[HivecomPage::SQL_UNIQUE_ID_INDEX],
	$stickypost[HivecomPage::SQL_TITLE_INDEX]
);

// Create the author and date information.
echo '<p class="centered">Published ';

// Add the post author if it was not created directly as Hivecom.
if (HivecomUtility::slug($stickypost[HivecomPage::SQL_AUTHOR_INDEX]) != "hivecom") {
	echo sprintf(
		' by <a href="/user/profile?username=%s">%s</a> ',
		HivecomUtility::slug($stickypost[HivecomPage::SQL_AUTHOR_INDEX]),
		$stickypost[HivecomPage::SQL_AUTHOR_INDEX]
	);
}

// Close the notice paragraph after adding the creation date.
echo sprintf('%s</p>', date_format(date_create($stickypost[HivecomPage::SQL_DATE_CREATE_INDEX]), "l jS \of F Y H:i"));

echo '<div class="horizontal-line glow"></div><br>';

// Display the main post introduction.
echo sprintf('<div class="page introduction">%s</div>', stripcslashes($stickypost[HivecomPage::SQL_OPENING_HTML_INDEX]));

// Read more and comment link.
echo sprintf(
	'<p class="centered readmore"><a href="/page?uid=%s">Click here to read more and comment</a></p>',
	$stickypost[HivecomPage::SQL_UNIQUE_ID_INDEX]
);

echo '<div class="horizontal-line"></div><div class="horizontal-line"></div>';
