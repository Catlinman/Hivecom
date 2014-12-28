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
        <div class="divider"></div>
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
        <div class="contentdiv gradient" id="server">
            <h3 class="shadowed">The Teamspeak server</h3>
            <div class="divider"></div>
            <div class="contentzone shadowed">
                <p>
                    The Hivecom Teamspeak server is hosted over at <a href="http://www.fragnet.net/" alt="Fragnet">Fragnet</a>
                    and is situated in Amsterdam. At this current point in time the server has a total of 20 slots
                    open to anyone willing to join. Within the server there are a few specified groups of users that
                    have different options of interaction on the server.
                    <br>
                    <br>
                    Non-registered users are restricted to the
                    lobby and the open hub while registered users and up are allowed to move as they see fit. They
                    also have the option of creating their own temporary private channels which they can use to moderate
                    on their own. We also have a group of moderators that keep track of what goes about on the server
                    when there are no admins in sight. They generally have the option to register new users as well as to
                    kick and move any registered and non-registered user as they see fit. For more information on how to
                    become registered on Hivecom, see the section further below.
                </p>
                <div class="horizontal-line"></div>
                <div class="widgetcontainer">
                    <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/tsviewer.php");?>
                    <div class="vertical-line"></div>
                    <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/twitterhivecom.php");?>
                </div>
                <div class="horizontal-line"></div>
                <p>
                    Becoming registered can be done quite fast. If you are an outsider and do not know anyone
                    within the Hivecom community, your best bet is to simply start a text chat with one of our
                    moderators or admins. Poking is allowed but we suggest not going overboard with it when
                    trying to get someone's attention. From there on a quick introduction or hello world is
                    all you should need if you were to want to become registered. The moderator or admin
                    should then ideally assign you to the registered server group allowing you to enter
                    the main area of the Hivecom Teamspeak server.
                    <br>
                    <br>
                    So, to keep the topic of becoming registered short: Ask politely. That is all you need to do.
                </p>
                <div class="backtotop">
                    <a data-scroll href="#top" alt="Back to top">Back to top</a>
                </div>
            </div>
        </div>
        <div class="contentdiv gradient" id="about" style="height:1200px">
            <h3 class="shadowed">The people behind Hivecom</h3>
            <div class="divider"></div>
            <div class="contentzone shadowed">
                <ul>
                    <li>Admins and information</li>
                    <li>Moderators</li>
                    <li>What we do</li>
                    <li>Donation pool</li>
                </ul>
                <div class="backtotop">
                    <a data-scroll href="#top" alt="Back to top">Back to top</a>
                </div>
            </div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/footer.php");?>
    </div>
</body>
</html>
