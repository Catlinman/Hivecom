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
		twitter = twitter.substr(1, twitter.length);
	}

	if(name != "") {
		document.forms["paypalform"]["custom"].value = name + "," + twitter + "," + amount;
	}

	return true;
}


function onkeyTwitter(){
	if(document.forms["paypalform"]["twitter"].value.charAt(0) != "@"){
		document.forms["paypalform"]["twitter"].value = "@" + document.forms["paypalform"]["twitter"].value;
	}
}

function onfocusTwitter(){
	if (document.forms["paypalform"]["twitter"].value == ""){
		document.forms["paypalform"]["twitter"].value = "@";
	}
}

function onfocusoutTwitter(){
	if (document.forms["paypalform"]["twitter"].value == "@"){
		document.forms["paypalform"]["twitter"].value = "";
	}
}