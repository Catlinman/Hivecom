<?php

// Page delete. Opens a dialog for a given page to confirm deletion.
//
// GET VARIABLES:
//		uid -- Unique identifier of page to delete.
//
// POST VARIABLES:
// 		delete 		-- If set the page will be deleted and the user will be redirected.
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
		header($_SERVER["SERVER_PROTOCOL"] ." 403 Access Denied", true, 403);
		include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/403.php");
		die();
	}

} else {
	header($_SERVER["SERVER_PROTOCOL"] ." 403 Access Denied", true, 403);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/403.php");
	die();
}

// Retrieve the page from the unique id. Only uid editing is allowed.
if (isset($_GET["uid"])) {
    $page = Page::retrieve($_GET["uid"]);
}

// If the page does not exist we return the 404 page.
if (!isset($page)) {
	header($_SERVER["SERVER_PROTOCOL"] ." 404 Not found", true, 404);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/404.php");
	die();
}

// Delete the page and redirect.
if (isset($_POST["delete"])) {
	Page::remove($_GET["uid"]);

	// Redirect to the home page.
	header('Location: /user/manage/page/overview');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hivecom - Page deletion</title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
</head>

<body>
    <div id="wrapper">
		<!-- Header & top bar -->
        <?php include_once(TEMPLATES_PATH . "/core/menu.php");?>

		<!-- Main page headline -->
        <div id="headline" class="noselect">
            <img src="/static/img/logo.png" width="512"/>
            <h2>
                Page Deletion
            </h2>
			<p>
				- Site manager page deletion -
			<p>
        </div>

		<!-- Content section with summary and information banners -->
        <div class="contentdiv striped">
			<h3 class="shadowed"></h3>
			<div class="contentspacer shadowed"></div>
			<div class="divider"></div>
            <div class="content shadowed">
				<h3 class="centered">
					 <?php echo $page[Page::SQL_TITLE_INDEX]; ?>
				 </h3>
				<!-- Information about the content -->
				<h5 class="centered">
					Are you sure you wish to delete this page? This action can not be undone.
				</h5>
				<form method="post" >
					<!-- Action buttons -->
					<div class="centered">
						<a class="button" style="width: 240px" href="/user/manage/page/edit?uid=<?php echo htmlspecialchars($_GET["uid"]); ?>">Edit page</a>
						<button type="submit" name="delete" style="width: 240px">Delete page</button>
						<a class="button" style="width: 240px" href="/user/manage/page/overview">Go to overview</a>
					</div>
					<br>
				</form>
            </div>
        </div>
		<?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
	</div>
</body>

</html>
