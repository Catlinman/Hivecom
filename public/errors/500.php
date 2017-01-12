<!DOCTYPE html>
<html>

<head>
	<title>Hivecom - 500</title>
	<?php require_once TEMPLATES_PATH . "/core/head.php";?>
</head>

<body class="darkbody">
    <div id="wrapper">
		<!-- Page bar with home navigation and login option -->
		<?php include_once(TEMPLATES_PATH . "/core/menu.php");?>

		<!-- Main headline with page information and title -->
        <div id="headline" class="noselect">
            <img src="/img/metaicon.png" width="512"/>
            <h2>
                Interal server error. Tell an administrator about this.
            </h2>
            <p>
                <a href="/index.php">- Click here to return to the main page -</a>
            </p>
        </div>

		<div class="contentdiv striped">
			<h3 class="shadowed"></h3>
			<div class="contentspacer shadowed"></div>
			<div class="divider"></div>
			<div class="content shadowed">
			</div>
		</div>
		<?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
    </div>
</body>

</html>
