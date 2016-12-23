<?php
/*

// TODO: Fixed donation system with new user and storage system.

require_once($_SERVER['DOCUMENT_ROOT']. "/scripts/private/sqlauth.php");

if($db_success == TRUE) {
	$table = 'donation_progress';
	$result = mysql_query("SELECT * FROM {$table}");
	$values = mysql_fetch_row($result);
	$amount = round((float)$values[0], 2);
	$goal = round((float)$values[1], 2);
	$progress =  max(min($amount, $goal) / $goal, 0.0225);

} else {
	$amount = 0;
	$goal = 50;
	$progress =  max(min($amount, $goal) / $goal, 0.0225);
}*/
?>

<h5 class="centered">We've received <?php echo 0//$amount;?>€ towards our yearly goal of <?php echo 50//$goal;?>€</h5>
<div class="meter">
	<span style="width:<?php echo 0 // $progress * 100;?>%"></span>
</div>
<a href="/donations" class="centered"><h5>Click here to donate and see who has already donated</h5></a><br>
