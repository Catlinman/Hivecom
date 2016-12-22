<!-- NOSCRIPT WARNING IN CASE JS IS DISABLED -->
<noscript class="notice">
	<p>
		Javascript have been detected as disabled - some elements might not function as intended
	</p>
	<div class="horizontal-line"></div>
</noscript>

<!-- TEAMSPEAK WARNING IF NO CONNECTION WAS MADE -->
<?php
if (!HivecomTeamspeak::$query) {
	echo
	'<div class="notice">
		<p>
		The Hivecom server appears to be offline at the moment. For more information take a look at the
		<a href="https://twitter.com/hivecomts">Hivecom Twitter feed</a> or check
		<a href="https://clients.fragnet.net/serverstatus.php?view=open">Fragnet\'s network status center</a>.
		</p>
		<div class="horizontal-line"></div>
	</div>';
}
?>
