<?php

// Page edit. Retrieves a page via UID and displays data and information for easy editing.
//
// GET VARIABLES:
//		uid -- Unique identifier of page to edit.
//
// POST VARIABLES:
// 		update 		-- If set the page will update with the new information and redirect to the viewer.
// 		preview 	-- If set the page will use the Markdown of the opening and content variables to create a preview.
// 		title		-- Title of the page to be set.
// 		subtitle	-- Subtitle of the page to be set.
// 		access		-- Access identifier of the page to be set.
// 		opening		-- Opening Markdown segment of the page to be set.
// 		content		-- Content Markdown segment of the page to be set.
// 		news 		-- Boolean value if the page is to be treated as news.
// 		sticky		-- Boolean value if the page is supposed to be sticky.
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

// Retrieve the page from the unique id. Only uid editing is allowed.
if (isset($_GET["uid"])) {
    $page = Page::retrieve($_GET["uid"]);
}

// If the page does not exist we return the 404 page.
if (!isset($page)) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not found", true, 404);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/404.php");
	die();
}

// Update the page with the new data and redirect to the viewer.
if (isset($_POST["update"])) {
	Page::edit(
		$_GET["uid"],
		Page::prepare(
			$_POST["title"],
			$_POST["subtitle"],
			$page[Page::SQL_AUTHOR_INDEX],
			$_POST["opening"],
			$_POST["content"],
			(bool) ($_POST["news"] ?? false),
			(bool) ($_POST["sticky"] ?? false)
		)
	);

	// Assign the access identifier.
	Page::assignAccess(
		$_GET["uid"],
		Utility::slug($_POST["access"])
	);

	// Redirect to the page viewer.
	header('Location: /page?uid=' . ($_GET["uid"]));
}

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo sprintf("Hivecom - %s - Page editor", $page[Page::SQL_TITLE_INDEX]); ?></title>
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
                <?php echo $page[Page::SQL_TITLE_INDEX]; ?>
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
				<!-- Information about the content -->
				<p class="centered">
					Content originally created by <?php echo sprintf('<a href="/user/profile?username=%1$s">%1$s</a>', $page[Page::SQL_AUTHOR_INDEX]); ?>
					on <?php echo date_format(date_create($page[Page::SQL_DATE_CREATE_INDEX]), "l jS \of F Y H:i"); ?>
				</p>
				<form method="post" >

					<!-- Inline input boxes -->
					<div class="form-inline">
						<!-- First row - Title input -->
						<label>Content Title</label>
						<input type="text" name="title" style="width:420px" value="<?php echo $_POST["title"] ?? $page[Page::SQL_TITLE_INDEX]; ?>"placeholder="Title" />

						<span class="spacer"></span>

						<!-- News checkbox -->
						<label>Announcement</label>
						<input type="hidden" name="news" value="0" />
						<input type="checkbox" value="true" name="news" <?php if(isset($_POST["news"])) { if($_POST["news"]) echo "checked"; } else { if($page[Page::SQL_IS_NEWS_INDEX]) echo "checked"; } ?> />

						<!-- Next row - Subtitle input -->
						<label>Subtitle</label>
						<input type="text" name="subtitle" style="width:420px" value="<?php echo $_POST["subtitle"] ?? $page[Page::SQL_SUBTITLE_INDEX]; ?>"placeholder="Subtitle" />

						<span class="spacer"></span>

						<!-- Sticky checkbox -->
						<label>Sticky</label>
						<input type="hidden" name="sticky" value="0" />
						<input type="checkbox" value="true" name="sticky" <?php if(isset($_POST["sticky"])) { if($_POST["sticky"]) echo "checked"; } else { if($page[Page::SQL_IS_STICKY_INDEX]) echo "checked"; } ?> />

						<!-- Last row - Access identifier input -->
						<label>Access ID</label>
						<input type="text" name="access" style="width:420px" value="<?php echo $_POST["access"] ?? $page[Page::SQL_ACCESS_ID_INDEX]; ?>"placeholder="Access URL" />
						<span class="wedge"></span>
					</div>

					<!-- Content fields -->
					<p>Introduction</p>
					<textarea name="opening" placeholder="Short summary of the general information. Should be short. Will be prepended before the main content on the page posts. Headers are hidden."><?php echo $_POST["opening"] ?? $page[Page::SQL_OPENING_MD_INDEX]; ?></textarea>

					<p>Content</p>
					<textarea name="content" placeholder="Main page content. This information is shown on the main page and is hidden in shortened listings of this page."><?php echo $_POST["content"] ?? $page[Page::SQL_CONTENT_MD_INDEX]; ?></textarea>
					<br><br>

					<!-- Action buttons -->
					<div class="centered">
						<a class="button medium" href="/user/manage/page/overview">Discard changes</a>
						<button class="medium" type="submit" name="update">Update page</button>
						<button class="medium"  type="submit" name="preview"><?php echo (isset($_POST["preview"]) ? "Update" : "Show"); ?> preview</button>
						<a class="button medium" href="/user/manage/page/delete?uid=<?php echo htmlspecialchars($_GET["uid"]); ?>">Delete page</a>
					</div>
					<br>

					<?php if (isset($_POST["preview"])) : ?>

					<div class="horizontal-line"></div>
					<!-- Preview section -->
					<h3 class="centered">Preview</h3>
					<div class="page preview">
						<?php echo Utility::Parsedown($_POST["opening"]); ?>
						<?php echo Utility::Parsedown($_POST["content"]); ?>
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
