// TODO: Should be moved to new member system.
<p class="centered">
	All donations are done through PayPal and require a minimum amount of 1€.
</p>
<p class="centered">
	Leave the personal information fields empty if you wish to make an anonymous donation.
</p>
<form name="paypalform" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" onsubmit="return validateDonation()">
	<label for="amount">Personal information:</label>
	<input type="text" name="name" maxlength="35" placeholder="Display name" pattern="^([a-zA-Z]+\s?)*$" title="May only contain characters without multiple spaces inbetween">
	<input type="text" name="twitter" maxlength="15" placeholder="Optional Twitter handle" onkeydown="onkeyTwitter()" onfocus="onfocusTwitter()" onfocusout="onfocusoutTwitter()" pattern="^@(\w){1,15}$" title="Must start with an @ symbol, be below 15 characters and not contain spaces or special characters">
	<br>
	<label for="amount">Enter the amount you wish to donate:</label>
	<input type="number" name="amount" min="1.00" step="0.01" max="250" placeholder="Donation amount in Euros" required>
	<input type="hidden" name="currency_code" value="EUR">
	<input type="hidden" name="item_name" value="Donation to Hivecom">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="dev.catlinman@gmail.com">
	<input type="hidden" name="custom" value="">
	<input type="hidden" name="notify_url" value="http://hivecom.net/donations/ipn/">
	<input type="hidden" name="return" value="http://hivecom.net/donations/success/">
	<input type="hidden" name="cancel_return" value="http://hivecom.net/donations/">
	<input type="submit" value="Proceed to PayPal">
</form>
