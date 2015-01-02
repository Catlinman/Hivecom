<?php
    $name = htmlspecialchars($_GET["name"]);

    require_once($_SERVER['DOCUMENT_ROOT']. "/lib/TeamSpeak3/TeamSpeak3.php");

    function avatarGetName($member){
        return new TeamSpeak3_Helper_String("/avatar_" . $member["client_base64HashClientUID"]);
    }

    function avatarDownload($member){
        $download = $member->getParent()->transferInitDownload(rand(0x0000, 0xFFFF), 0, $member->avatarGetName());
        $transfer = TeamSpeak3::factory("filetransfer://" . $download["host"] . ":" . $download["port"]);
        return $transfer->download($download["ftkey"], $download["size"]);
    }

    $ts3 = TeamSpeak3::factory("serverquery://nl-voice.fragnet.net:10011/?server_port=10084");
    $client = $ts3->clientGetByName($name);

    $avatar = avatarDownload($client);

    header("Content-Type: " . TeamSpeak3_Helper_Convert::imageMimeType($avatar));

    echo $avatar;
?>
