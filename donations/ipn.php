<?php
	ini_set("log_errors", 1);
	ini_set("error_log", $_SERVER['DOCUMENT_ROOT']. "/logs/ipn-error.log");
	
	$sandboxed = false;
	
	// Start IPN validation
	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();
	foreach ($raw_post_array as $keyval) {
		$keyval = explode ('=', $keyval);
		if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
	}
	
	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')) {
		$get_magic_quotes_exists = true;
	}
	foreach ($myPost as $key => $value) {
		if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
			$value = urlencode(stripslashes($value));
		} else {
			$value = urlencode($value);
		}
		$req .= "&$key=$value";
	}
	
	if($sandboxed == false){
		$paypalurl = "https://www.paypal.com/cgi-bin/webscr";
	}
	else{
		$paypalurl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	}
	$ch = curl_init($paypalurl);
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	
	if(!($res = curl_exec($ch))){
		curl_close($ch);
		exit;
	}
	curl_close($ch);
	// End IPN validation

    if (strcmp($res, "VERIFIED") == 0){
		try {
			if(!empty($_POST['payer_email'])){
				$email = $_POST['payer_email'];
			} else {
				$email = "placeholder@email.com";
			}
	
			if(!empty($_POST['mc_gross'])){
				$payment_amount = $_POST['mc_gross'];
			} else {
				$payment_amount = 1;
			}
			
			require_once($_SERVER['DOCUMENT_ROOT']. "/scripts/private/sqlauth.php");
			
			if(!empty($_POST['custom'])){
				$dataarray = explode(",", $_POST["custom"]);
				if(count($dataarray) == 2){
					if($dataarray[0] != ""){
						$table = 'donations';
			
						$querystring =
							"INSERT INTO {$table} (name, email, amount, date, twitter) VALUES (\"".
							$dataarray[0]. '","'.
							$email. '",'.
							$payment_amount. ',"'.
							date('Y-m-d'). '","'.
							$dataarray[1]. '");';
			
						$query = mysql_query((string)$querystring);
					}
				} else {
					// error_log("COUNT: ". count($dataarray). " || POST: ". $_POST['custom']);
				}
			}
	
			$table = 'donation_progress';
			$query = mysql_query("UPDATE {$table} SET amount = amount + {$payment_amount}");
		}
		catch (Exception $e){
			error_log($e);
		}

    } else if (strcmp ($res, "INVALID") == 0) {
        error_log("Received an invalid response");
    }
?>
