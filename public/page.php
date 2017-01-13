<?php

// Page viewer. Retrieves a page via UID or ACCESSID and displays data and information.
//
// GET VARIABLES:
//		uid -- Unique identifier of page to view.
//		id	-- Access identifier of page to view.

require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

require_once(HELPERS_PATH . "/Utility.php");
require_once(HELPERS_PATH . "/Page.php");

// Retrieve the page from the unique id.
if (isset($_GET["uid"])) {
    $page = Page::retrieve(htmlspecialchars($_GET["uid"]));

} elseif (isset($_GET["id"])) {
    $page = Page::retrieveViaAccess(htmlspecialchars($_GET["id"]));

} else {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
    include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/404.php");
    die();
}

if (!$page) {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
    include_once($_SERVER["DOCUMENT_ROOT"] . "/errors/404.php");
    die();
}

?>

<head>
    <title><?php echo sprintf("Hivecom - %s", $page[Page::SQL_TITLE_INDEX]); ?></title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
    <meta name="twitter:description" content="<?php echo $page[Page::SQL_TITLE_INDEX];?>">
</head>

<body>
    <div id="wrapper">
        <!-- Page bar with home navigation and login option -->
        <?php include_once(TEMPLATES_PATH . "/core/menu.php");?>

        <!-- Main headline with page information and title -->
        <div id="headline" class="noselect">
            <img src="/img/metaicon.png" width="512"/>
            <h2>
                <?php echo $page[Page::SQL_TITLE_INDEX];?>
            </h2>
            <p>
                - <?php echo $page[Page::SQL_SUBTITLE_INDEX];?> -
            </p>
        </div>

        <div class="contentspacer shadowed"></div>
        <div class="divider"></div>

        <!-- Main server news & announcements -->
        <div class="contentdiv gradient" id="news">

            <div class="content shadowed">

                <?php include_once(TEMPLATES_PATH . "/banner/noscript.php");?>

                <div class="page">
                    <?php

                    // Show page content.
                    echo $page[Page::SQL_OPENING_HTML_INDEX];
                    echo $page[Page::SQL_CONTENT_HTML_INDEX];

                    // Create the author and date information.
                    echo '<p class="centered">Published ';

                    // Add the post author.
                    if (Utility::slug($page[Page::SQL_AUTHOR_INDEX]) != "") {
                        echo sprintf(
                            ' by <a href="/user/profile?username=%s">%s</a> ',
                            $page[Page::SQL_UNIQUE_ID_INDEX],
                            $page[Page::SQL_AUTHOR_INDEX]
                        );
                    }

                    // Close the notice paragraph after adding the creation date.
                    echo sprintf('%s</p>', date_format(date_create($page[Page::SQL_DATE_CREATE_INDEX]), "l jS \of F Y H:i"));

					/* if ($page[Page::SQL_DATE_CREATE_INDEX] != $page[Page::SQL_DATE_EDIT_INDEX]) {
						echo sprintf('<p class="centered">Last edited %s</p>', date_format(date_create($page[Page::SQL_DATE_EDIT_INDEX]), "l jS \of F Y H:i"));
					} */

                    ?>

                </div>
                <div class="horizontal-line"></div>

                <div class="buttoncontainer centered">

					<?php if (isset($_SESSION['user_level'])) : if($_SESSION['user_level'] > 3) : ?>
					<a class="button" style="width:280px" href="/user/manage/page/edit?uid=<?php echo $page[Page::SQL_UNIQUE_ID_INDEX]; ?>">Open page editor</a>
					<?php endif; endif ?>

					<button type="button" style="width:280px" onclick="copyToClipboard('https://hivecom.net/page?uid=<?php echo $page[Page::SQL_UNIQUE_ID_INDEX]; ?>')">
						Copy page permalink to clipboard
					</button>
				</div>

                <?php if ($page[Page::SQL_IS_NEWS_INDEX]) : ?>
                    <div id="disqus_thread"></div>
                    <!-- Disqus comment section -->
                    <script>

                    var disqus_config = function () {
                        this.page.url = "https://hivecom.net/page?uid=<?php echo $page[Page::SQL_UNIQUE_ID_INDEX]?>";
                        this.page.identifier = "<?php echo $page[Page::SQL_UNIQUE_ID_INDEX]?>";
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
                <?php endif; ?>

                <?php include(TEMPLATES_PATH . "/core/totop.php");?>
            </div>
        <?php include_once(TEMPLATES_PATH . "/core/footer.php");?>
    </div>
</body>

</html>
