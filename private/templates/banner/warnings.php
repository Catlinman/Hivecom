<!-- Noscript warning in case JavaScript is disabled -->
<noscript class="notice">
	<p>
		Javascript have been detected as disabled - some elements might not function as intended
	</p>
	<div class="horizontal-line"></div>
</noscript>

<!-- Teamspeak warning if no connection was made -->
<?php
if (!HivecomTeamspeak::$query) {
	echo
	'<div class="notice">
		<p>
		The Hivecom Teamspeak server appears to be offline at the moment. For more information take a look at the
		<a href="https://twitter.com/hivecomnetwork">Hivecom Twitter feed</a>.
		</p>
		<div class="horizontal-line"></div>
	</div>';
}
?>
