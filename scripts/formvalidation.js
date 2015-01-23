function roundNumber(number, decimals) {
	var newnumber = new Number(number + '').toFixed(parseInt(decimals));
	document.roundform.roundedfield.value =  parseFloat(newnumber);
}

function validateDonation() {
	var name = document.forms["paypalform"]["name"].value;
	var twitter = document.forms["paypalform"]["twitter"].value;
	var amount = document.forms["paypalform"]["amount"].value;

	if(amount == ""){
		document.forms["paypalform"]["amount"].style.border = "1px #FF0000 solid";
		return false;
	} else{
		document.forms["paypalform"]["amount"].style.border = "";
	}

	if(twitter != "") {
		twitter = twitter.replace(/[|&;$%@"<>()+,]/g, "");
	}

	if(name != "") {
		document.forms["paypalform"]["custom"].value = name + "," + twitter + "," + amount;
	}

	return true;
}
