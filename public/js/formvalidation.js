// TODO: Adapt to new user system.
// These functions make sure that the values entered on the donation page are valid and don't cause errors.
function validateDonation() {
    var name = document.forms["paypalform"]["name"];
    var twitter = document.forms["paypalform"]["twitter"];
    var amount = document.forms["paypalform"]["amount"];
    var custom = document.forms["paypalform"]["custom"];

    if (twitter.value != "" && name.value == "") {
        alert("Please specify a name before proceeding to PayPal");
        name.focus();
        return false;
    }

    if (name.value != "") {
        if (!name.value.match("^([a-zA-Z]+ ?)*$")) {
            alert("Please enter a name without multiple spaces and special characters");
            name.focus();
            return false;

        } else {
            if (name.value.length > 35) {
                alert("Please enter a name containing less than 35 characters");
                name.focus();
                return false;
            }
        }

        if (twitter.value != "") {
            if (!/^@(\w) {1,15}$/.test(twitter.value)) {
                alert("Please enter a valid Twitter handle starting with an @ symbol, containing less than 15 characters and no special characters");
                twitter.focus();
                return false;
            }

            custom.value = name.value + "," + twitter.value.replace("@", "");

        } else {
            custom.value = name.value + ",";
        }
    }

    if (amount.value == "") {
        alert("Please enter an amount before proceeding to PayPal");
        amount.focus();
        return false;

    } else {
        if (parseFloat(amount.value) < 1) {
            alert("The amount should not be less than " + 1 + "€");
            amount.focus();
            return false;
        }
    }

    return true;
}


function onkeyTwitter() {
    var name = document.forms["paypalform"]["name"];
    var twitter = document.forms["paypalform"]["twitter"];

    if (twitter.value != "" && twitter.value.charAt(0) != "@") {
        twitter.value = "@" + twitter.value;
    }

    if (name.value == "" && twitter.value != "") {
        name.setAttribute("required", true);

    } else {
        name.removeAttribute("required");
    }
}

function onfocusTwitter() {
    var name = document.forms["paypalform"]["name"];
    var twitter = document.forms["paypalform"]["twitter"];

    if (twitter.value == "") {
        twitter.value = "@";
    }

    if (name.value == "" && twitter.value != "") {
        name.setAttribute("required", true);

    } else {
        name.removeAttribute("required");
    }
}

function onfocusoutTwitter() {
    var name = document.forms["paypalform"]["name"];
    var twitter = document.forms["paypalform"]["twitter"];

    if (twitter.value == "@") {
        twitter.value = "";
    }

    if (name.value == "" && twitter.value != "") {
        name.setAttribute("required", true);

    } else {
        name.removeAttribute("required");
    }
}
