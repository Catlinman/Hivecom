<!DOCTYPE html>
<html>

<head>
	<title>Hivecom - Donation Center</title>
	<?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/head.php");?>
	<script type="text/javascript" src="/scripts/formvalidation.js"></script>
</head>

<body class="darkbody">
	<div id="wrapper">
		<?php
			include_once($_SERVER['DOCUMENT_ROOT']. "/resources/header.php");
		?>
		<div id="titlediv">
			<img src="/images/metaicon.png" width="512"/>
			<h2>
				Donation Center
			</h2>
			<p style="margin:170px 0px">
				<a href="/index.php">Click here to return to the main page</a>
			</p>
		</div>
		<div class="contentdiv gradient">
			<h3 class="shadowed">Support Hivecom</h3>
			<div class="contentzone shadowed">
				<br>
				<h4 class="centered">Make a donation</h4>
				<noscript class="notice">
					<p>
						Javascript have been detected as disabled - some elements might not function as intended
					</p>
					<div class="horizontal-line"></div>
				</noscript>
				<div class="jsenabled">
					<?php
						require_once($_SERVER['DOCUMENT_ROOT']. "/scripts/private/sqlauth.php");

						if($db_success) {
							include_once($_SERVER['DOCUMENT_ROOT']. "/resources/donationform.php");
						}
					?>
				</div>
				<div class="horizontal-line"></div>
				<br>
				<h4 class="centered">List of donations</h4>
				<?php
					if($db_success) {
						$result = mysql_query("SELECT * FROM donations ORDER BY amount DESC;");
						$fields_num = mysql_num_fields($result);

						if(mysql_num_rows($result) != 0){
							echo
								'<ul class="columnlist listhead">
								<li>Name</li>
								<li>Donation Date</li>
								<li>Amount</li>
								<li>Twitter</li>
								</ul>';
						} else {
							echo '<p class="centered">Looks like there\'s nothing to see here at the moment</p>';
						}
						
					} else {
						echo '<p class="centered">Donations can not be fetched at the moment due to the Hivecom database not being available. Please check back another time and if possible alert an admin of this issue.</p>';
					}
				?>
				<ul class="columnlist">
					<?php
						if($db_success) {
							while($row = mysql_fetch_row($result)){
								echo '<li title="'. $row[1]. '">'. $row[1]. '</li><li>'. date_format(date_create($row[4]), 'd.m.Y'). '</li><li>'. $row[3]. '€</li>';
								if($row[5] != NULL){
									echo '<li><a href="https://twitter.com/'. $row[5]. '">@'. $row[5]. '</a></li>';
								} else {
									echo '<li><br></li>';
								}
								echo "<br>";
							}
						}
					?>
				</ul>
				<div class="listclear"></div>
				<?php
					if($db_success) {
						if(mysql_num_rows($result) != 0) echo "<br>";
					}
				?>
			</div>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/footer.php");?>
	</div>
</body>

</html>
