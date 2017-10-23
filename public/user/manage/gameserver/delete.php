<?php

// Game server delete. Opens a dialog for a given game server to confirm deletion.
//
// GET VARIABLES:
//		uid -- Unique identifier of game server to delete.
//
// POST VARIABLES:
// 		delete 		-- If set the game server will be deleted and the user will be redirected.
//
// SESSION VARIABLES:
// 		user_name	-- Currently logged in user. Used for information on the current gameserver.
// 		user_id		-- Unique identifier of the currently logged in user. Stored in the new gameserver data.
//		user_level	-- Security level of the currently logged in user. Used for permissions.

require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

require_once(HELPERS_PATH . "/Utility.php");
require_once(HELPERS_PATH . "/Gameserver.php");

// Make sure that the logged in user has access rights.
if (isset($_SESSION['user_level'])) {
	if($_SESSION['user_level'] < 3) {
		header($_SERVER["SERVER_PROTOCOL"] ." 403 Access Denied", true, 403);
		include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/403.php");
		die();
	}

} else {
	header($_SERVER["SERVER_PROTOCOL"] ." 403 Access Denied", true, 403);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/403.php");
	die();
}

// Retrieve the gameserver from the unique id. Only uid editing is allowed.
if (isset($_GET["uid"])) {
    $gameserver = Gameserver::retrieve($_GET["uid"]);
}

// If the gameserver does not exist we return the 404 gameserver.
if (!isset($gameserver)) {
	header($_SERVER["SERVER_PROTOCOL"] ." 404 Not found", true, 404);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/404.php");
	die();
}

// Delete the gameserver and redirect.
if (isset($_POST["delete"])) {
	Gameserver::remove($_GET["uid"]);

	// Redirect to the home gameserver.
	header('Location: /user/manage/gameserver/overview');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo sprintf("Hivecom - %s - Game server edit", $gameserver[Gameserver::SQL_TITLE_INDEX]); ?></title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
</head>

<body>
    <div id="wrapper">
		<!-- Header & top bar -->
        <?php include_once(TEMPLATES_PATH . "/core/menu.php");?>

		<!-- Main gameserver headline -->
        <div id="headline" class="noselect">
            <img src="/static/img/logo.png" width="512"/>
            <h2>
                Game Server Deletion
            </h2>
			<p>
				- Site manager game server deletion -
			<p>
        </div>

		<!-- Content section with summary and information banners -->
        <div class="contentdiv striped">
			<h3 class="shadowed"></h3>
			<div class="contentspacer shadowed"></div>
			<div class="divider"></div>
            <div class="content shadowed">
				<h3 class="centered">
					<?php echo $gameserver[Gameserver::SQL_TITLE_INDEX]; ?>
				</h3>
				<!-- Information about the content -->
				<h5 class="centered">
					Are you sure you wish to delete this game server? This action can not be undone.
				</h5>
				<form method="post" >
					<!-- Action buttons -->
					<div class="centered">
						<a class="button" style="width: 240px" href="/user/manage/gameserver/edit?uid=<?php echo htmlspecialchars($_GET["uid"]); ?>">Edit game server</a>
						<button type="submit" name="delete" style="width: 240px">Delete game server</button>
						<a class="button" style="width: 240px" href="/user/manage/gameserver/overview">Go to overview</a>
					</div>
					<br>
				</form>
            </div>
        </div>
		<?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
	</div>
</body>

</html>
