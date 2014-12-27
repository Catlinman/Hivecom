<!DOCTYPE html>
<html>

<head>
    <title>Hivecom</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/head.php");?>
</head>

<body>
    <div id="wrapper">
        <header id="top">
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
            <nav id="navmenu"  class="shadowed">
                <a href="/ts.php" id="tsbutton" alt="Connect to the Hivecom Teamspeak server">CONNECT USING TEAMSPEAK</a>
                <a data-scroll href="#server" id="serverbutton" alt="Server information">THE SERVER</a>
                <a data-scroll href="#about" id="aboutbutton" alt="The people behind Hivecom">ABOUT US</a>
            </nav>
        </div>
        <div class="contentdiv striped">
            <div class="contentzone shadowed">
                <p>
                    Hivecom is a community based around a Teamspeak server hosted by a few cool people from all around the world.
                    We're a constantly growing group open to those willing to join. The community itself is partially made up of a few others
                    that generally enjoy playing games and are looking for a simple place to hang out and chat. The
                    most prominent folks on the server are those of the
                    <a href="http://webchat.esper.net/?channels=cobalt" alt="Espernet IRC">Cobalt IRC community</a>. Of course those
                    are not all - over the time that the server was initially hosted we've also picked up friends of friends and even
                    complete strangers to some. As mentioned, people from all around the world are known visitors of the server. The
                    range goes from countries like New Zealand, over to all of Europe and across to North America.
                    <br>
                    <br>
                    Interested? Check out the server section for more information on how to become registered. We hope to see you amidst us!
                    <br>
                    <br>
                    <i>The Hivecom Team</i>
                </p>
            </div>
        </div>
        <div class="contentdiv" id="server">
            <h3 class="shadowed" style="text-align:center">The Teamspeak server</h3>
            <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/tsviewer.php");?>
            <ul>
                <li>Teamspeak viewer module</li>
                <li>Slots</li>
                <li>Hosting information</li>
                <li>Becoming registered</li>
                <li>Connection links</li>
            </ul>
        </div>
        <div class="contentdiv" id="about">
            <h3 class="shadowed" style="text-align:center">The people behind Hivecom</h3>
            <ul>
                <li>Admins and information</li>
                <li>Moderators</li>
                <li>What we do</li>
                <li>Donation pool</li>
            </ul>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/footer.php");?>
    </div>
</body>

</html>
