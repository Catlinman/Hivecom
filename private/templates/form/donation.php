<!-- TODO: Should be moved to new member system. -->
<!-- New donation dialog -->
<p class="centered">
	All donations are done through PayPal and require a minimum amount of 1€.
</p>
<p class="centered">
	Leave the personal information fields empty if you wish to make an anonymous donation.
</p>
<form name="paypalform" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" onsubmit="return validateDonation()">
	<label for="amount">Enter the amount you wish to donate:</label>
	<input type="number" name="amount" min="1.00" step="0.01" max="250" placeholder="Donation amount in Euros" required>
	<input type="hidden" name="currency_code" value="EUR">
	<input type="hidden" name="item_name" value="Donation to Hivecom">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="contact@catlinman.com">
	<input type="hidden" name="custom" value="">
	<input type="hidden" name="notify_url" value="https://hivecom.net/donations/ipn/">
	<input type="hidden" name="return" value="https://hivecom.net/donations/success/">
	<input type="hidden" name="cancel_return" value="https://hivecom.net/donations/">
	<input type="submit" value="Proceed to PayPal">
</form>
