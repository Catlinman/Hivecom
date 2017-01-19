<?php

// Gamserver overview. Displays a range of gameservers as set by the MAXRANGE constant in the configuration.
//
// GET VARIABLES:
//		offset -- Gameserver offset modifier of the overview.
//		search -- Search term modifier of the overview
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
		header($_SERVER["SERVER_PROTOCOL"]." 403 Access Denied", true, 403);
		include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/403.php");
		die();
	}

} else {
	header($_SERVER["SERVER_PROTOCOL"]." 403 Access Denied", true, 403);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/403.php");
	die();
}

// Retrieve GET variables and set defaults.
$offset = $_GET['offset'] ?? 0;
$search = $_GET['search'] ?? "";

// Retrieve all games ervers from the database. TODO: Change to ranged retrieve.
$gameservers = Gameserver::retrieveAll();
$count = Gameserver::retrieveCount();
$range = count($gameservers);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hivecom - Game Servers Overview</title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
	<link rel="stylesheet" href="/css/font-awesome.min.css">
</head>

<body>
    <div id="wrapper">
		<!-- Header & top bar -->
        <?php include_once(TEMPLATES_PATH . "/core/menu.php");?>

		<!-- Main gameserver headline -->
        <div id="headline" class="noselect">
            <img src="/img/metaicon.png" width="512"/>
            <h2>
                Game Servers Overview
            </h2>
			<p>
				- Site manager panel -
			<p>
        </div>

		<!-- Content section -->
        <div class="contentdiv striped">
			<h3 class="shadowed"></h3>
			<div class="contentspacer shadowed"></div>
			<div class="divider"></div>
            <div class="content shadowed">
				<?php if($count && $range) :

				echo "<p class=\"centered\">- Displaying $range of $count results -</p>";

				// Iterate over each gameserver and display a new information header with buttons.
				foreach ($gameservers as $gameserver) {
					$uid = $gameserver[Gameserver::SQL_UNIQUE_ID_INDEX];
					$game = $gameserver[Gameserver::SQL_GAME_INDEX];
					$title = $gameserver[Gameserver::SQL_TITLE_INDEX];
					$hidden = $gameserver[Gameserver::SQL_HIDDEN_INDEX];

					echo '<div class="infoheader"><h5>';

					// Add the game image if it exists in the game image directory.
					if(!$hidden){
						if (file_exists(IMAGES_PATH . "/logos/". Utility::slug($game) . '.png')) {
							echo sprintf('<img src="/img/logos/%s.png" width="24"/>', Utility::slug($game));
						}
					} else echo '<i class="fa fa-eye-slash"></i> ';

					echo "
							$title</h5>
							<div class=\"buttoncontainer\">
							<a class=\"button\" style=\"width:140px\" href=\"/user/manage/gameserver/edit?uid=$uid\">Edit Server</a>
							<a class=\"button\" style=\"width:140px\" href=\"/user/manage/gameserver/delete?uid=$uid\">Delete Server</a>
							</div>
							<p>GAME: $game / UID: $uid</p>
							</div><br>
						";
				}

				?>

				<div class="horizontal-line"></div>
				<div class="buttoncontainer centered">
					<!-- Show a back button if we have previous gameservers to show. -->
					<a class="button <?php if($range <= MAXRESULT) echo "disabled"; ?>" style="width:100px" href="/user/manage/gameserver/overview?offset=<?php echo $offset - $range; ?>"><</a>

					<!-- Show a back button if we have previous gameservers to show. -->
					<a class="button" style="width:280px" href="/user/manage/gameserver/create">Create a new gameserver</a>

					<!-- Show a forward button if we have more gameservers to show. -->
					<a class="button <?php if($range + $offset <= $count) echo "disabled"; ?>" style="width:100px" href="/user/manage/gameserver/create">></a>

					<br>
				</div>

				<?php else : ?>

				<p class="centered">There are currently no game servers</p>

				<div class="horizontal-line"></div>
				<div class="buttoncontainer centered">
					<!-- Show a back button if we have previous gameservers to show. -->
					<a class="button" style="width:280px" href="/user/manage/gameserver/create">Create a new game server</a>
				</div>

				<?php endif; ?>

				<br>
            </div>
        </div>
		<?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
	</div>
</body>

</html>
