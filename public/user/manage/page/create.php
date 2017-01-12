<?php

// Page creater. Shows dialogs for creating a new page on the website.
//
// POST VARIABLES:
// 		create 		-- If set the page will be created with the new information and redirect to the viewer.
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

// Update the page with the new data and redirect to the viewer.
if (isset($_POST["create"])) {
	$uid = Page::create(
		Page::prepare(
			$_POST["title"] ?? "",
			$_POST["subtitle"] ?? "",
			$_SESSION["user_id"] ?? "",
			$_POST["opening"] ?? "",
			$_POST["content"] ?? "",
			(bool) ($_POST["news"] ?? false),
			(bool) ($_POST["sticky"] ?? false)
		)
	);

	// Assign the access identifier.
	if(isset($_POST["access"])) {
		Page::assignAccess(
			$uid,
			Utility::slug($_POST["access"])
		);
	}

	// Redirect to the page viewer.
	header('Location: '."/page?uid=" . $uid);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hivecom - Page creation</title>
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
                New Page Creation
            </h2>
			<p>
				- Content editor -
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
					This content will be published as <?php echo $_SESSION["username"] ?? "Hivecom"; ?>
				</p>
				<form method="post" >

					<!-- Inline input boxes -->
					<div class="form-inline">
						<!-- First row - Title input -->
						<label>Content Title</label>
						<input type="text" name="title" style="width:420px" value="<?php echo $_POST["title"] ?? "" ?>"placeholder="Title" />

						<span class="spacer"></span>

						<!-- News checkbox -->
						<label>Announcement</label>
						<input type="hidden" name="news" value="0" />
						<input type="checkbox" value="true" name="news" <?php if(isset($_POST["news"])) { if($_POST["news"]) echo "checked"; } ?> />

						<!-- Next row - Subtitle input -->
						<label>Subtitle</label>
						<input type="text" name="subtitle" style="width:420px" value="<?php echo $_POST["subtitle"] ?? "" ?>"placeholder="Subtitle" />

						<span class="spacer"></span>

						<!-- Sticky checkbox -->
						<label>Sticky</label>
						<input type="hidden" name="sticky" value="0" />
						<input type="checkbox" value="true" name="sticky" <?php if(isset($_POST["sticky"])) { if($_POST["sticky"]) echo "checked"; } ?> />

						<!-- Last row - Access identifier input -->
						<label>Access ID</label>
						<input type="text" name="access" style="width:420px" value="<?php echo $_POST["access"] ?? "" ?>"placeholder="Access URL" />
						<span class="wedge"></span>
					</div>

					<!-- Content fields -->
					<p>Introduction</p>
					<textarea name="opening"><?php echo $_POST["opening"] ?? "Short summary of the general information. Should be short. Will be prepended before the main content on the page posts. Headers are hidden."?></textarea>

					<p>Content</p>
					<textarea name="content"><?php echo $_POST["content"] ?? "Main page content. This information is shown on the main page and is hidden in shortened listings of this page." ?></textarea>
					<br><br>

					<!-- Action buttons -->
					<div class="centered">
						<button type="submit" name="create" style="width: 240px">Create page</button>
						<button type="submit" name="preview" style="width: 240px"><?php echo (isset($_POST["preview"]) ? "Update" : "Show"); ?> preview</button>
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

					<?php include(TEMPLATES_PATH . "/core/totop.php");?>
				</form>
            </div>
        </div>
		<?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
	</div>
</body>

</html>
