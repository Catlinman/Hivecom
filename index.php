<!DOCTYPE html>
<html>

<head>
    <title>Hivecom</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/head.php");?>
</head>

<body>
    <div id="wrapper">
        <header>
            <div id="headerinfo">
                <h3>
                    <a href="index.php">HIVECOM</a>
                </h3>
            </div>
        </header>
        <div id="titlediv" class="noselect">
            <img src="images/metaicon.png" width="512"/>
            <h2>
                Welcome to Hivecom
            </h2>
            <p>
                - Official website of the Hivecom Teamspeak server -
            <p>
        </div>
        <div id="navcontainer">
            <nav id="navmenu">
                <a href="/ts.php" id="tsbutton" alt="Connect to the Hivecom Teamspeak server">CONNECT USING TEAMSPEAK</a>
                <a href="#" id="serverbutton" alt="Server information">THE SERVER</a>
                <a href="#" id="aboutbutton" alt="The people behind Hivecom">ABOUT US</a>
            </nav>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/tsviewer.php");?>
        <div style="color:white;height:800px;">
            <h3 style="text-align:center">Server information area</h3>
            <ul>
                <li>Teamspeak viewer module</li>
                <li>Slots</li>
                <li>Hosting information</li>
                <li>Becoming registered</li>
                <li>Connection links</li>
            </ul>
        </div>
        <div class="divider"></div>
        <div style="color:white;height:800px;">
            <h3 style="text-align:center">Hivecom staff and user area</h3>
            <ul>
                <li>Admins and information</li>
                <li>Moderators</li>
                <li>What we do</li>
                <li>Donation pool</li>
            </ul>
        </div>
        <footer>
            <a href="http://catlinman.com/" alt="Catlinman homepage">The Hivecom website was created by Catlinman - &copy Catlinman 2014</a>
        </footer>
    </div>
</body>

</html>
