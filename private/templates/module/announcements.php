<?php

require_once(realpath(dirname(__FILE__) . "/../../config.php"));

require_once(HELPERS_PATH . "/Utility.php");
require_once(HELPERS_PATH . "/Page.php");

// Retrieve the latest news posts with our global limit.
$news = HivecomPage::retrieveNews(MAXNEWS);

// Add a placeholder text if there are no news posts or an error occured.
if (!$news) {
	echo '<h5 class="centered">There are currently no announcements</h5><br>';
    return;
}

// Get the latest sticky post. If none exist this will be null.
$stickypost = HivecomPage::retrieveSticky();

// Variables used during iteration.
$i = 0;
$len = count($news);

// Iterate over each fetched post.
foreach ($news as $post) {
	// Skip the current post if there is a sticky post and it matches up with this post.
	if ($stickypost) {
		if ($post[HivecomPage::SQL_UNIQUE_ID_INDEX] == $stickypost[HivecomPage::SQL_UNIQUE_ID_INDEX]) {
			$i++;

			if ($i == $len) {
				echo '<h5 class="centered">For the newest community announcement navigate to the top of the page</h5><br>';
			}

            continue;
        }
	}

	// Display the title of the post and link the page with additional information.
	echo sprintf(
        '<h3 class="centered"><a href="/page?uid=%s">%s</a></h3>',
        $post[HivecomPage::SQL_UNIQUE_ID_INDEX],
        $post[HivecomPage::SQL_TITLE_INDEX]
    );

	// Create the author and date information.
	echo '<p class="notice centered">Published ';

	// Add the post author if it was not created directly as Hivecom.
	if (HivecomUtility::slug($post[HivecomPage::SQL_AUTHOR_INDEX]) != "hivecom") {
		echo sprintf(
			' by <a href="/user/profile?username=%s">%s</a> ',
			$post[HivecomPage::SQL_UNIQUE_ID_INDEX],
			$post[HivecomPage::SQL_AUTHOR_INDEX]
		);
	}

	// Close the notice paragraph after adding the creation date.
	echo sprintf('%s</p>', date_format(date_create($post[HivecomPage::SQL_DATE_CREATE_INDEX]), "l jS \of F Y H:i"));

	echo '<div class="horizontal-line glow"></div><br>';

	// Display the main post introduction.
	echo sprintf('<div class="page introduction">%s</div>', stripcslashes($post[HivecomPage::SQL_OPENING_HTML_INDEX]));

	// Display a read more section after the post introduction if there is content.
	echo sprintf(
		'<p class="centered"><a href="/page?uid=%s">Click here to read more and comment</a></p>',
		$post[HivecomPage::SQL_UNIQUE_ID_INDEX]
	);

	// Insert a divider if this is not the last post.
	if ($i < $len - 1) {
		echo '<div class="horizontal-line"></div><div class="horizontal-line"></div><br>';
	}

	$i++;
}
