<?php

// Gameserver creator. Shows dialogs for creating a new gameserver on the website.
//
// GET VARIABLES:
//		uid -- Unique identifier of game server to edit.
//
// POST VARIABLES:
// 		update 			-- If set the game server will update with the new information and redirect to the overview.
// 		preview 		-- If set the gameserver should display a preview of the gameserver field.
// 		game			-- Name of the game. Will be sluggified.
// 		address			-- Server address.
// 		address_easy	-- Easy connection address.
// 		address_info	-- Extra information address.
// 		summary			-- Summary of the server.
// 		admins 			-- Comma separated server administrator names.
// 		hidden			-- If the server should be shown or hidden for the time being.
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

// Retrieve the page from the unique id. Only uid editing is allowed.
if (isset($_GET["uid"])) {
    $gameserver = Gameserver::retrieve($_GET["uid"]);
}

// If the page does not exist we return the 404 page.
if (!isset($gameserver)) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not found", true, 404);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/404.php");
	die();
}

// Update the gameserver with the new data and redirect to the viewer.
if (isset($_POST["update"])) {
	$uid = Gameserver::edit(
		$_GET["uid"],
		Gameserver::prepare(
			$_POST["game"] ?? "",
			$_POST["address"] ?? "",
			$_POST["address_easy"] ?? "",
			$_POST["address_info"] ?? "",
			$_POST["title"] ?? "",
			$_POST["summary"] ?? "",
			$_POST["admins"] ?? "",
			(bool) ($_POST["hidden"] ?? false)
		)
	);

	// Redirect to the overview.
	header('Location: /user/manage/gameserver/overview');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo sprintf("Hivecom - %s - Game server editor", $gameserver[Gameserver::SQL_TITLE_INDEX]); ?></title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
</head>

<body>
    <div id="wrapper">
		<!-- Header & top bar -->
        <?php include_once(TEMPLATES_PATH . "/core/menu.php");?>

		<!-- Main gameserver headline -->
        <div id="headline" class="noselect">
            <img src="/img/metaicon.png" width="512"/>
            <h2>
                Game Server Editor
            </h2>
			<p>
				- Site manager content editor -
			<p>
        </div>

		<!-- Content section with summary and information banners -->
        <div class="contentdiv striped">
			<h3 class="shadowed"></h3>
			<div class="contentspacer shadowed"></div>
			<div class="divider"></div>
            <div class="content shadowed">
				<form method="post" >
					<!-- Inline input boxes -->
					<div class="form-inline">
						<!-- First row - Title input -->
						<label>Game Title</label>
						<input type="text" name="game" style="width:420px" value="<?php echo $_POST["game"] ?? $gameserver[Gameserver::SQL_GAME_INDEX]; ?>"placeholder="Canonical game title" />

						<span class="spacer"></span>

						<!-- News checkbox -->
						<label>Hidden</label>
						<input type="hidden" name="hidden" value="0" />
						<input type="checkbox" value="true" name="hidden" <?php if(isset($_POST["hidden"])) { if($_POST["hidden"]) echo "checked"; } else { if($gameserver[Gameserver::SQL_HIDDEN_INDEX]) echo "checked"; } ?> />

						<!-- Next row - Subtitle input -->
						<label>Server Address</label>
						<input type="text" name="address" style="width:420px" value="<?php echo $_POST["address"] ?? $gameserver[Gameserver::SQL_ADDRESS_INDEX]; ?>"placeholder="address:port" />
						<span class="wedge"></span>

						<!-- Last row - Access identifier input -->
						<label>Quick Address</label>
						<input type="text" name="address_easy" style="width:420px" value="<?php echo $_POST["address_easy"] ?? $gameserver[Gameserver::SQL_ADDRESS_EASY_INDEX]; ?>"placeholder="steam://connect/address:port" />
						<span class="wedge"></span>

						<!-- Last row - Access identifier input -->
						<label>Information</label>
						<input type="text" name="address_info" style="width:420px" value="<?php echo $_POST["address_info"] ?? $gameserver[Gameserver::SQL_ADDRESS_INFO_INDEX]; ?>"placeholder="https://serverinformation.tld/page" />
						<span class="wedge"></span>

						<br><br>
						<div class="horizontal-line"></div>
						<br>

						<!-- Last row - Access identifier input -->
						<label>Server Title</label>
						<input type="text" name="title" style="width:420px" value="<?php echo $_POST["title"] ?? $gameserver[Gameserver::SQL_TITLE_INDEX]; ?>"placeholder="Game server title" />
						<span class="wedge"></span>

						<!-- Last row - Access identifier input -->
						<label>Administrators</label>
						<input type="text" name="admins" style="width:420px" value="<?php echo $_POST["admins"] ?? $gameserver[Gameserver::SQL_ADMINS_INDEX]; ?>"placeholder="Comma separated names" />
						<span class="wedge"></span>

					</div>

					<br>
					<div class="horizontal-line"></div>

					<!-- Content fields -->
					<p>Summary</p>
					<textarea name="summary" placeholder="Short summary of server settings and general information. This text does not allow custom formatting."><?php echo $_POST["summary"] ?? $gameserver[Gameserver::SQL_SUMMARY_INDEX]; ?></textarea>
					<br><br>

					<div class="horizontal-line"></div>
					<br>

					<!-- Action buttons -->
					<div class="centered">
						<a class="button" style="width: 200px" href="/user/manage/gameserver/overview">Discard changes</a>
						<button type="submit" name="update" style="width: 200px">Update game server</button>
						<button type="submit" name="preview" style="width: 200px"><?php echo (isset($_POST["preview"]) ? "Update" : "Show"); ?> preview</button>
						<a class="button" style="width: 200px" href="/user/manage/gameserver/delete?uid=<?php echo htmlspecialchars($_GET["uid"]); ?>">Delete game server</a>
					</div>
					<br>

					<?php if (isset($_POST["preview"])) : ?>

					<div class="horizontal-line"></div>

					<!-- Preview section -->
					<h3 class="centered">Preview</h3>
					<div class="page preview">

						<?php

						$game 			= empty($_POST["game"]) ? "Game Title" : $_POST["game"];
						$address 		= empty($_POST["address"]) ? "address:port" : $_POST["address"];
						$address_easy 	= empty($_POST["address_easy"]) ? "" : $_POST["address_easy"];
						$address_info 	= empty($_POST["address_info"]) ? "" : $_POST["address_info"];
						$title 			= empty($_POST["title"]) ? "Server Title" : $_POST["title"];
						$summary 		= empty($_POST["summary"]) ? "Information summary." : $_POST["summary"];
						$admins 		= empty($_POST["admins"]) ? "" : $_POST["admins"];

						// Start creating the game header.
						echo '<div class="infoheader"><h4>';

						// Add the game image if it exists in the game image directory.
						if (file_exists(IMAGES_PATH . "/logos/". Utility::slug($game) . '.png')) {
							echo sprintf('<img src="/img/logos/%s.png" width="24"/>', Utility::slug($game));
						}

						// Create the game header and close the already opened header tag.
						echo sprintf('%s</h4>', $game);

						// Start the button div tag and create the clipboard copy button.
						echo sprintf('<div class="buttoncontainer nomobile"><button onclick="copyToClipboard(\'%s\')" type="button">Copy address to clipboard</button>', $address);

						// Add an easy connect button if there is a connection for it.
						if ($address_easy) {
							echo sprintf('<button onclick="window.location=\'%s\'" type="button">Quick connect</button>', $address_easy);
						}

						// Add the server address and close the button div tag.
						echo sprintf('</div><p>%s</p>', $address);

						// Close the main header tag with the actual server title and a summary.
						echo sprintf('</div><h5>- %s -</h5>', $title);
						echo sprintf('<p>%s', $summary);

						// Display the server admins with links to their profiles.
						if($admins) {
							echo '<br><br>Server admins: ';

							// Iterate over admins and create links if the information exists.
							if ($admins) {
								$admin_array = explode(",", $admins);
								$admin_count = count($admin_array);
								$j = 0;

								foreach ($admin_array as $name) {
									echo sprintf('<a href="user/profile?username=%s">%s</a>', Utility::slug($name), ucfirst($name));

									if ($j < $admin_count - 1) {
										echo ' / ';
									}

									$j++;
								}
							}
						}

						// Show a link to more information if one exists.
						if ($address_info) {
							echo sprintf('<br><br><a alt="More information" href="%s">Click here for more information</a>', $address_info);
						}

						// Close off the entire section.
						echo '</p>';

						?>

					</div>

					<?php endif ?>

				</form>

				<?php include(TEMPLATES_PATH . "/core/totop.php");?>
            </div>
        </div>
		<?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
	</div>
</body>

</html>
