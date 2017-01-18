<?php

// Page overview. Displays a range of pages as set by the MAXRANGE constant in the configuration.
//
// GET VARIABLES:
//		offset -- Page offset modifier of the overview.
//		search -- Search term modifier of the overview
//
// SESSION VARIABLES:
// 		user_name	-- Currently logged in user. Used for information on the current page.
// 		user_id		-- Unique identifier of the currently logged in user. Stored in the new page data.
//		user_level	-- Security level of the currently logged in user. Used for permissions.

require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

require_once(HELPERS_PATH . "/Utility.php");
require_once(HELPERS_PATH . "/Page.php");

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

// Retrieve all pages from the database. TODO: Change to ranged retrieve.
$pages = Page::retrieveAll();
$count = Page::retrieveCount();
$range = count($pages);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hivecom - Pages Overview</title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
</head>

<body>
    <div id="wrapper">
		<!-- Header & top bar -->
        <?php include_once(TEMPLATES_PATH . "/core/menu.php");?>

		<!-- Main page headline -->
        <div id="headline" class="noselect">
            <img src="/img/metaicon.png" width="512"/>
            <h2>
                Pages Overview
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

				// Iterate over each page and display a new information header with buttons.
				foreach ($pages as $page) {
					$uid = $page[Page::SQL_UNIQUE_ID_INDEX];
					$title = $page[Page::SQL_TITLE_INDEX];

					echo "<div class=\"infoheader\">
							<h5>$title</h5>
							<div class=\"buttoncontainer\">
							<a class=\"button\" style=\"width:140px\" href=\"/page?uid=$uid\">View Page</a>
							<a class=\"button\" style=\"width:140px\" href=\"/user/manage/page/edit?uid=$uid\">Edit Page</a>
							<a class=\"button\" style=\"width:140px\" href=\"/user/manage/page/delete?uid=$uid\">Delete Page</a>
							</div>
							<p>UID: $uid</p>
							</div><br>
						";
				}

				?>

				<div class="horizontal-line"></div>
				<div class="buttoncontainer centered">
					<!-- Show a back button if we have previous gameservers to show. -->
					<a class="button <?php if($range < MAXRESULT) echo "disabled"; ?>" style="width:100px" href="/user/manage/page/overview?offset=<?php echo $offset - $range; ?>"><</a>

					<!-- Show a back button if we have previous gameservers to show. -->
					<a class="button" style="width:280px" href="/user/manage/page/create">Create a new page</a>

					<!-- Show a forward button if we have more gameservers to show. -->
					<a class="button <?php if($range + $offset <= $count) echo "disabled"; ?>" style="width:100px" href="/user/manage/page/create">></a>

					<br>
				</div>

				<?php else : ?>

				<p class="centered">There are currently no pages</p>

				<div class="horizontal-line"></div>
				<div class="buttoncontainer centered">

				<!-- Show a button to create a new gameserver. -->
				<a class="button" style="width:280px" href="/user/manage/page/create">Create a new page</a>

				<?php endif; ?>

				<br>
            </div>
        </div>
		<?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
	</div>
</body>

</html>
