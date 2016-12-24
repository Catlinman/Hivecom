<header id="top">
	<div id="mainbar">
		<h3>
			<a style="float:left;" href="/index.php">HIVECOM</a>

			<?php
			if (isset($_SESSION['user'])) {
				echo '<a style="float:right;" href="/user/logout.php">LOGOUT</a>';
				echo sprintf('<p style="float:right";>|</p><a style="float:right;" href="/user/profile.php?user=%s">%s</a>', $_SESSION['user'], $_SESSION['user']);
			} else {
				echo '<a style="float:right;" href="/user/login.php">LOGIN</a>';
			}
			?>
		</h3>
	</div>
</header>
