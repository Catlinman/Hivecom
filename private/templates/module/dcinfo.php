<!-- Discord server information and viewer -->
<h3>Discord</h3>
<br>

<?php
// Check if the server is online. If not, return the offline information and return.
if (!isset(HivecomDiscord::$query)) {
    echo '
		<div class="horizontal-line glow-red"></div>
		<h5>Server connection failed</h5>
	';

    return;
}
?>

<div class="horizontal-line glow"></div>
<br>
<ul>
	<li>Server address: <a href="/dc">dc.hivecom.net</a></li>
	<li>Connected users:</li>
	<li>Peak users:</li>
	<li>Chat users:</li>
	<li>Voice users:</li>
</ul>
<br>
<div class="horizontal-line"></div>
