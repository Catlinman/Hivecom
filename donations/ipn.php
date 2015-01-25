<?php
    $validate = true;

    if($validate == true){
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

        $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
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
    } else {
        $res = "INVALID";
    }

    if (strcmp($res, "VERIFIED") == 0 or $validate == false){
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

        if(!empty($_POST["custom"])){
            $dataarray = explode(",", $_POST["custom"]);

            require_once($_SERVER['DOCUMENT_ROOT']. "/scripts/private/sqlauth.php");
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

        $table = 'donation_progress';
        $query = mysql_query("UPDATE {$table} SET amount = amount + {$payment_amount}");

    } else if (strcmp ($res, "INVALID") == 0) {
        // echo "The response from IPN was: <b>" .$res ."</b>";
    }
?>
