<?php

require_once(realpath(dirname(__FILE__) . "/../../config.php"));

require_once(HELPERS_PATH . "/Utility.php");
require_once(HELPERS_PATH . "/Page.php");

// Fetch the latest sticky post from the database.
$stickypost = Page::retrieveSticky();

// If there is no sticky post we can stop right here.
if (!$stickypost) {
    return;
}

// Get the latest sticky post. If none exist this will be null.
$stickypost = Page::retrieveSticky();

// Display the title of the post and link the page with additional information.
echo sprintf(
    '<h5 class="centered">- Community Announcement -</h5><h3 class="centered"><a href="/page?id=%s">%s</a></h3>',
    $stickypost[Page::SQL_ACCESS_ID_INDEX],
    $stickypost[Page::SQL_TITLE_INDEX]
);

// Create the author and date information.
echo '<p class="centered">Published ';

// Add the post author if it was not created directly as Hivecom.
if (Utility::slug($stickypost[Page::SQL_AUTHOR_INDEX]) != "hivecom") {
    echo sprintf(
        ' by <a href="/user/profile?username=%s">%s</a> ',
        Utility::slug($stickypost[Page::SQL_AUTHOR_INDEX]),
        $stickypost[Page::SQL_AUTHOR_INDEX]
    );
}

// Close the notice paragraph after adding the creation date.
echo sprintf('%s</p>', date_format(date_create($stickypost[Page::SQL_DATE_CREATE_INDEX]), "l jS \of F Y H:i"));

echo '<div class="horizontal-line glow"></div><br>';

// Display the main post introduction.
echo sprintf('<div class="page introduction">%s</div>', stripcslashes($stickypost[Page::SQL_OPENING_HTML_INDEX]));

// Read more and comment link.
echo sprintf(
    '<p class="centered readmore"><a href="/page?id=%s">Click here to read more and comment</a></p>',
    $stickypost[Page::SQL_ACCESS_ID_INDEX]
);

echo '<div class="horizontal-line"></div><div class="horizontal-line"></div>';
