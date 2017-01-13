<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/../private/config.php");

$_SESSION['user_level'] = 5;

echo "Unlocked admin mode.";
