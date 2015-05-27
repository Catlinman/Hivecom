<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="Hivecom is an open gaming community for anyone to feel free to join - we also host a Teamspeak 3 server under the same name">
<meta name="keywords" content="hivecom,teamspeak,catlinman,jokler,trif,cobalt community,game server,voice server">
<meta name="author" content="Hivecom Team - Catlinman">
<meta name="viewport" content="width=640, initial-scale=0.5">

<meta itemprop="image" content="http://hivecom.net/images/metaicon.png">
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@hivecomts">
<meta name="twitter:creator" content="@hivecomts">
<meta name="twitter:title" content="Hivecom">
<meta name="twitter:description" content="Hivecom is an open gaming community for anyone to feel free to join - we also host a Teamspeak 3 server under the same name.">
<meta name="twitter:image" content="http://hivecom.net/images/metaicon.png">
<meta name="twitter:domain" content="http://hivecom.net">
<meta name="twitter:url" content="http://hivecom.net">
<meta property="og:url" content="http://hivecom.net">

<link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
<link rel="icon" href="/images/icon.png" type="image/x-icon">
<link rel="apple-touch-icon" href="/images/apple-icon.png">
<link rel="stylesheet" type="text/css" href="/style.css">

<?php
	include_once($_SERVER['DOCUMENT_ROOT']. "/resources/head.php");
	require_once($_SERVER['DOCUMENT_ROOT']. "/lib/TeamSpeak3/TeamSpeak3.php");
	
	TeamSpeak3::init();

	$online = FALSE;

	try {
		$ts3 = TeamSpeak3::factory("serverquery://nl-voice.fragnet.net:10011/?server_port=10084&use_offline_as_virtual=1&no_query_clients=1");

		$online = TRUE;

	} catch (Exception $e){
		echo '<link rel="stylesheet" type="text/css" href="/style_red.css">';
	}
?>

<link rel="stylesheet" type="text/css" href='http://fonts.googleapis.com/css?family=Aldrich'>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="/scripts/analytics.min.js"></script>
<script type="text/javascript" src="/scripts/smooth-scroll.min.js"></script>
