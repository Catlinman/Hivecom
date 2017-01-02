<?php

require_once(realpath(dirname(__FILE__) . "/../../config.php"));

require_once(HELPERS_PATH . "/Utility.php");
require_once(HELPERS_PATH . "/Gameserver.php");

// Retrieve the latest news posts with our global limit.
$gameservers = HivecomGameserver::retrieveAll();

// Add a placeholder text if there are no news posts or an error occured.
if (!$gameservers) {
	echo '<h5 class="centered">There are currently no registered Hivecom gameservers</h5><br>';
    return;
}

// Variables used during iteration.
$i = 0;
$len = count($gameservers);

// Iterate over each fetched post.
foreach ($gameservers as $server) {
	// Skip this server if it is hidden.
	if ($server[HivecomGameserver::SQL_HIDDEN_INDEX]) {
		continue;
	}

	$game = ucwords($server[HivecomGameserver::SQL_GAME_INDEX]);
	$address = $server[HivecomGameserver::SQL_ADDRESS_INDEX];
	$address_easy = $server[HivecomGameserver::SQL_ADDRESS_EASY_INDEX];
	$address_info = $server[HivecomGameserver::SQL_ADDRESS_INFO_INDEX];
	$title = $server[HivecomGameserver::SQL_TITLE_INDEX];
	$summary = $server[HivecomGameserver::SQL_SUMMARY_INDEX];
	$admins = $server[HivecomGameserver::SQL_ADMINS_INDEX];

	// Start creating the game header.
	echo '<div class="gameheader"><h4>';

	// Add the game image if it exists in the game image directory.
	if (file_exists(IMAGES_PATH . "/logos/". HivecomUtility::slug($game) . '.png')) {
		echo sprintf('<img src="/img/logos/%s.png" width="24"/>', HivecomUtility::slug($game));
	}

	// Create the game header and address.
	echo sprintf('%s</h4><p>%s</p>', $game, $address);

	// Create the clipboard copy button.
	echo sprintf('<button class="nomobile" onclick="copyToClipboard(\'%s\')" type="button">Copy address to clipboard</button>', $address);

	// Add an easy connect button if there is a connection for it.
	if ($address_easy) {
		echo sprintf('<button class="nomobile" onclick="window.location=\'%s\'" type="button">Quick connect</button>', $address_easy);
	}

	// Close the main header with the actual server title and a summary.
	echo sprintf('</div><h5>- %s -</h5>', $title);
	echo sprintf('<p>%s', $summary);


	// Display the server admins with links to their profiles.
	echo '<br><br>Server admins: ';

	// Iterate over admins and create links if the information exists.
	if ($admins) {
		$admin_array = explode(",", $admins);
		$admin_count = count($admin_array);
		$j = 0;

		foreach ($admin_array as $name) {
			echo sprintf('<a href="user/profile?username=%s">%s</a>', $name, ucfirst($name));

			if ($j < $admin_count - 1) {
				echo ' / ';
			}

			$j++;
		}
	}

	// Show a link to more information if one exists.
	if ($address_info) {
		echo sprintf('<br><br><a alt="More information" href="%s">Click here for more information</a>', $address_info);
	}

	// Close off the entire section.
	echo '</p>';

	// Add a divider if there is another listing following this one.
	if ($i < $len - 1) {
		echo '<div class="horizontal-line"></div><br>';
	}

	$i++;
}
