<?php

require_once(realpath(dirname(__FILE__) . "/../../config.php"));

require_once(HELPERS_PATH . "/Donation.php");

$latest = HivecomDonation::retrieveLatest();

if ($latest) {
	$start = date_format(date_create($latest["date_end"]), "l jS \of F Y");
	$end = date_format(date_create($latest["date_end"]), "l jS \of F Y");
	$amount = round((float) $latest["amount"], 2);
	$goal = round((float) $latest["goal"], 2);
	$progress = max(min($amount, $goal) / $goal, 0.0225);

} else {
	echo '<h5 class="centered">There is currently no active donation pool</h5>';
	echo '<div class="meter"><span style="width:0;"></span></div><br>';

	return;
}

?>

<h5 class="centered">We've received <?php echo $amount;?>€ towards our yearly goal of <?php echo $goal;?>&euro;</h5>
<div class="meter">
	<span style="width:<?php echo $progress * 100;?>%"></span>
</div>
<p class="centered notice">This donation pool will be reset on <?php echo $end;?></p>
<a href="/donations" class="centered"><h5>Click here to donate and see who has already donated</h5></a><br>
