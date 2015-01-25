function validateDonation() {
	var name = document.forms["paypalform"]["name"];
	var twitter = document.forms["paypalform"]["twitter"];
	var amount = document.forms["paypalform"]["amount"];
	var custom = document.forms["paypalform"]["custom"];

	if(twitter.value != ""){
		twitter.value = twitter.value.substr(1, twitter.value.length);
	}
	
	if(amount.value == ""){
		return false;
	}
	
	if(name != "") {
		custom.value = name.value + "," + twitter.value;
	}

	return false;
}


function onkeyTwitter(){
	var name = document.forms["paypalform"]["name"];
	var twitter = document.forms["paypalform"]["twitter"];
		
	if(twitter.value != "" && twitter.value.charAt(0) != "@"){
		twitter.value = "@" + twitter.value;
	}
	
	if(name.value == "" && twitter.value != ""){
		name.setAttribute("required", true);
	}
	else {
		name.removeAttribute("required");
	}
}

function onfocusTwitter(){
	var name = document.forms["paypalform"]["name"];
	var twitter = document.forms["paypalform"]["twitter"];
	
	if (twitter.value == ""){
		twitter.value = "@";
	}
	
	if(name.value == "" && twitter.value != ""){
		name.setAttribute("required", true);
	}
	else {
		name.removeAttribute("required");
	}
}

function onfocusoutTwitter(){
	var name = document.forms["paypalform"]["name"];
	var twitter = document.forms["paypalform"]["twitter"];
	
	if (twitter.value == "@"){
		twitter.value = "";
	}
	
	if(name.value == "" && twitter.value != ""){
		name.setAttribute("required", true);
	}
	else {
		name.removeAttribute("required");
	}
}