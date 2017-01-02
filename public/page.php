<?php

// Page viewer. Retrieves a page via UID or ACCESSID and displays data and information.

require_once(realpath(dirname(__FILE__) . "/../private/config.php"));

require_once(HELPERS_PATH . "/Utility.php");
require_once(HELPERS_PATH . "/Page.php");

// Retrieve the page from the unique id.
if (isset($_GET["uid"])) {
	$page = HivecomPage::retrieve(htmlspecialchars($_GET["uid"]));

} elseif (isset($_GET["access"])) {
	$page = HivecomPage::retrieveViaAccess(htmlspecialchars($_GET["access"]));

} else {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
	include_once(realpath(dirname(__FILE__)) . "/errors/404.php");
	die();
}


if (!$page) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
	include_once(realpath(dirname(__FILE__)) . "/errors/404.php");
	die();
}

?>

<head>
    <title>Hivecom - <?php echo $page[HivecomPage::SQL_TITLE_INDEX];?></title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
	<meta name="twitter:description" content="<?php echo $page[HivecomPage::SQL_TITLE_INDEX];?>">
</head>

<body>
    <div id="wrapper">
		<!-- Page bar with home navigation and login option -->
        <?php include_once(TEMPLATES_PATH . "/core/menu.php");?>

		<!-- Main headline with page information and title -->
		<div id="headline" class="noselect">
			<img src="/img/metaicon.png" width="512"/>
			<h2>
				<?php echo $page[HivecomPage::SQL_TITLE_INDEX];?>
			</h2>
			<p>
				- <?php echo $page[HivecomPage::SQL_SUBTITLE_INDEX];?> -
			</p>
		</div>

		<!-- Main server news & announcements -->
        <div class="contentdiv gradient" id="news">
            <div class="contentspacer shadowed"></div>
            <div class="divider"></div>
            <div class="content shadowed">
				<div class="page">
					<?php

					// Show page content.
					echo $page[HivecomPage::SQL_OPENING_HTML_INDEX];
					echo $page[HivecomPage::SQL_CONTENT_HTML_INDEX];

					// Create the author and date information.
					echo '<p class="centered">Published ';

					// Add the post author if it was not created directly as Hivecom.
					if (HivecomUtility::slug($page[HivecomPage::SQL_AUTHOR_INDEX]) != "hivecom") {
						echo sprintf(
							' by <a href="/user/profile?username=%s">%s</a> ',
							$page[HivecomPage::SQL_UNIQUE_ID_INDEX],
							$page[HivecomPage::SQL_AUTHOR_INDEX]
						);
					}

					// Close the notice paragraph after adding the creation date.
					echo sprintf('%s</p>', date_format(date_create($page[HivecomPage::SQL_DATE_CREATE_INDEX]), "l jS \of F Y H:i"));

					?>
				</div>
				<div class="horizontal-line"></div>
				<?php

				// Show the page permalink.
				echo sprintf('<div class="buttoncontainer"><button class="buttoncenter" onclick="copyToClipboard(\'https://hivecom.net/page?uid=%s\')" type="button">Copy page permalink to clipboard</button></div>', $page[HivecomPage::SQL_UNIQUE_ID_INDEX]);

				?>
				<div id="disqus_thread"></div>
				<!-- Disqus comment section -->
				<script>

				var disqus_config = function () {
					this.page.url = "https://hivecom.net/page?uid=<?php echo $page[HivecomPage::SQL_UNIQUE_ID_INDEX]?>";
					this.page.identifier = "<?php echo $page[HivecomPage::SQL_UNIQUE_ID_INDEX]?>";
				};

				(function() {
					var d = document, s = d.createElement('script');
					s.src = '//hivecom.disqus.com/embed.js';
					s.setAttribute('data-timestamp', +new Date());
					(d.head || d.body).appendChild(s);
				})();

				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				<br>
				<?php include(TEMPLATES_PATH . "/core/totop.php");?>
            </div>
		<?php include_once(TEMPLATES_PATH . "/core/footer.php");?>
    </div>
</body>

</html>
