function validateDonation() {
	var name = document.forms["paypalform"]["name"];
	var twitter = document.forms["paypalform"]["twitter"];
	var amount = document.forms["paypalform"]["amount"];
	var custom = document.forms["paypalform"]["custom"];
	
	if(twitter != "" && name.value == ""){
		alert("Please specify a name before proceeding to PayPal");
		name.focus();
		return false;
	}
	
	if(name != "") {
		if(!name.value.match("^([a-zA-Z]+ ?)*$")){
			alert("Please enter a name without multiple spaces and special characters");
			name.focus();
			return false;
		}
		if(twitter != ""){
			if(!/^@?(\w){1,15}$/.test(twitter.value)){
				alert("Please enter a valid Twitter handle");
				twitter.focus();
				return false;
			}
		}
		custom.value = name.value + "," + twitter.value.replace("@", "");
	}
	
	if(amount.value == ""){
		alert("Please enter an amount before proceeding to PayPal");
		amount.focus();
		return false;
	} else{
		if(parseFloat(amount.value ) < 1){
			alert("The amount should not be less than " + 1 + "€");
			amount.focus();
			return false;
		}	
	}
	
	return true;
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