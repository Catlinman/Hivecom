<?php

// SESSION VARIABLES:
// 		user_name	-- Currently logged in user. Used for information on the current page.
// 		user_id		-- Unique identifier of the currently logged in user. Stored in the new page data.

?>

<!-- Main page header bar -->
<header id="top">
	<div id="mainbar">
		<div style="float:left;">
			<a href="/index.php">HIVECOM</a>
		</div>
		<div style="float:right;">
		<?php
		/*
		// Show the current logged in user.
		if (isset($_SESSION['user_name'])) {
			require_once(HELPERS_PATH . "/Utility.php");

			echo sprintf(
                '<a href="/user/profile?username=%s">%s</a>',
				Utility::slug($_SESSION['user_name']),
				$_SESSION['user']
			);

			// Display a logout option.
			echo '<span>|</span><a href="/user/logout">LOGOUT</a>';

		} else {
			// If there is no logged in user - show the login option.
			echo '<a href="/user/login">LOGIN</a>';
		}
		*/
		?>
		</div>
	</div>
</header>
