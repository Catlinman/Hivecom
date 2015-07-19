<?php
	require_once($_SERVER['DOCUMENT_ROOT']. "/scripts/private/sqlauth.php");

	if(!empty($_POST["user"]) && !empty($_POST["pass"]) && !empty($_POST["text"])) {
		$user = htmlspecialchars($_POST["user"]);
		$pass = htmlspecialchars($_POST["pass"]);
		$text = htmlspecialchars($_POST["text"]);

		$realpass = mysql_fetch_row(mysql_query("SELECT pass FROM users WHERE name LIKE \"{$user}\";"))[0];

		if(hash("sha256", $pass) == $realpass) {
			$messagefile = fopen($_SERVER['DOCUMENT_ROOT']. "/data/broadcast.txt", "w") or die("Failed to open the message file.");

			if($text != "NULL") {
				fwrite($messagefile, $text. "\n");
				fwrite($messagefile, $user);
			} else {
				fwrite($messagefile, "");
			}

			fclose($messagefile);
			echo "Succesfully updated the broadcast message.";
		}
	}
?>