<?php
	// Everything in this file is currently super professional. Don't question it.
	require_once($_SERVER['DOCUMENT_ROOT']. "/scripts/private/auth.php");

	if(!empty($_POST["pass"]) && !empty($_POST["text"])) {
		$pass = htmlspecialchars($_POST["pass"]);
		$text = htmlspecialchars($_POST["text"]);

		if($pass == $verification) {
			$messagefile = fopen($_SERVER['DOCUMENT_ROOT']. "/resources/broadcast.txt", "w") or die("Failed to open the message file.");

			if($text != "NULL") {
				fwrite($messagefile, $text);
			} else {
				fwrite($messagefile, "");
			}

			fclose($messagefile);
			echo "Succesfully updated the broadcast message.";

		} else {
			echo "Please stop.";
		}
	}
?>