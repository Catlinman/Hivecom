<!-- Teamspeak and Discord warning if no connection was made -->
<?php
if (isset(Teamspeak::$query) || isset(Teamspeak::$query)) {
    // Teamspeak warning.
    if (!isset(Teamspeak::$query)) {
        echo '
		<p class="notice">
			The Hivecom Teamspeak server appears to be offline at the moment.
			<br><br>
			For more information take a look at the
			<a href="https://twitter.com/' . TWITTER . '">Hivecom Twitter feed</a>.
		</p>
		';
    }

    // Discord warning.
    if (!isset(Discord::$query)) {
        echo '
		<p class="notice">
			The Hivecom Discord server appears to be offline at the moment.
			<br><br>
			Take a look at the
			<a href="https://twitter.com/' . TWITTER . '">Hivecom Twitter feed</a> and the
			<a href="https://twitter.com/discordapp">Discord Twitter account</a> for more information.
		</p>
		';
    }
} else {
    // Both servers are offline.
    echo '
		<p class="notice">
			The Hivecom Teamspeak & Discord server appear to be offline at the moment.
			<br><br>
			Take a look at the
			<a href="https://twitter.com/' . TWITTER . '">Hivecom Twitter feed</a> and the
			<a href="https://twitter.com/discordapp">Discord Twitter account</a> for more information.
		</p>
	';
}

?>
