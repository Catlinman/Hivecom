<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="Hivecom is an open gaming community for anyone to feel free to join! We host multiple open voice and game servers!">
<meta name="keywords" content="hivecom,teamspeak,discord,forum,game server,voice server">
<meta name="author" content="Hivecom Team - Catlinman">
<meta name="viewport" content="width=640, initial-scale=0.5">

<meta itemprop="image" content="https://hivecom.net/img/metaicon.png">
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@<?php echo TWITTER;?>">
<meta name="twitter:creator" content="@<?php echo TWITTER;?>">
<meta name="twitter:title" content="Hivecom">
<meta name="twitter:description" content="Hivecom is an open gaming community for anyone to feel free to join!">
<meta name="twitter:image" content="https://hivecom.net/img/metaicon.png">
<meta name="twitter:domain" content="https://hivecom.net">
<meta name="twitter:url" content="https://hivecom.net">
<meta property="og:url" content="https://hivecom.net">

<link rel="shortcut icon" href="/img/icon.png" type="image/x-icon">
<link rel="icon" href="/img/icon.png" type="image/x-icon">
<link rel="apple-touch-icon" href="/img/apple-icon.png">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript" src="/js/analytics.min.js"></script>
<script type="text/javascript" src="/js/smooth-scroll.min.js"></script>

<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href='https://fonts.googleapis.com/css?family=Aldrich'>

<?php

include_once(TEMPLATES_PATH . "/core/connections.php");

if (!Teamspeak::getCache() && !Discord::getCache()) {
    echo '<link rel="stylesheet" type="text/css" href="/css/style-red.css">';
}

?>
