<?php require_once(realpath(dirname(__FILE__) . "/../../private/config.php"));?>
<!DOCTYPE html>
<html>

<head>
    <title>Hivecom</title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
</head>

<body>
    <div id="wrapper">
		<!-- Header & top bar -->
        <?php include_once(TEMPLATES_PATH . "/core/header.php");?>

		<!-- Main page headline -->
        <div id="headline" class="noselect">
            <img src="/img/metaicon.png" width="512"/>
            <h2>
                Member Login
            </h2>
        </div>

		<!-- Content section with summary and information banners -->
        <div class="contentdiv striped">
			<h3 class="shadowed"></h3>
			<div class="contentspacer shadowed"></div>
			<div class="divider"></div>
            <div class="content shadowed">
				<!-- Banners for warnings -->
				<?php include_once(TEMPLATES_PATH . "/banner/warnings.php");?>
                <?php include_once(TEMPLATES_PATH . "/form/login.php");?>
            </div>
        </div>
		<?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
	</div>
</body>

</html>
