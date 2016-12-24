<!-- Noscript warning in case JavaScript is disabled -->
<noscript>
	<p class="notice">
		Javascript have been detected as disabled - some elements might not function as intended
	</p>
	<div class="horizontal-line"></div>
</noscript>

<!-- Teamspeak and Discord warning if no connection was made -->
<?php
if (isset(HivecomTeamspeak::$query) || isset(HivecomTeamspeak::$query)) {
	// Teamspeak warning.
	if (!isset(HivecomTeamspeak::$query)) {
		echo '
		<p class="notice">
			The Hivecom Teamspeak server appears to be offline at the moment.
			<br><br>
			For more information take a look at the
			<a href="https://twitter.com/hivecomnetwork">Hivecom Twitter feed</a>.
		</p>
		<div class="horizontal-line"></div>
		';
	}

	// Discord warning.
	if (!isset(HivecomDiscord::$query)) {
		echo '
		<p class="notice">
			The Hivecom Discord server appears to be offline at the moment.
			<br><br>
			Take a look at the
			<a href="https://twitter.com/hivecomnetwork">Hivecom Twitter feed</a> and the
			<a href="https://twitter.com/discordapp">Discord Twitter account</a> for more information.
		</p>
		<div class="horizontal-line"></div>
		';
	}
} else {
	// Both servers are offline.
	echo '
		<p class="notice">
			The Hivecom Teamspeak & Discord server appear to be offline at the moment.
			<br><br>
			Take a look at the
			<a href="https://twitter.com/hivecomnetwork">Hivecom Twitter feed</a> and the
			<a href="https://twitter.com/discordapp">Discord Twitter account</a> for more information.
		</p>
		<div class="horizontal-line"></div>
	';
}

?>
