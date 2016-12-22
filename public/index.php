<?php require_once(realpath(dirname(__FILE__) . "/../private/config.php"));?>
<!DOCTYPE html>
<html>

<head>
    <title>Hivecom</title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
</head>

<body>
    <div id="wrapper">
		<!-- HEADER & TOP BAR -->
        <?php include_once(TEMPLATES_PATH . "/core/header.php");?>

		<!-- MAIN LANDING AND CURRENT PAGE TITLE/INFORMATION -->
        <div id="titlediv" class="noselect">
            <img src="img/metaicon.png" width="512"/>
            <h2>
                Welcome to Hivecom
            </h2>
            <p>
                - Official website of the Hivecom Teamspeak server -
            <p>
        </div>

		<!-- INDEX PAGE NAVIGATION -->
        <div id="navcontainer">
            <nav id="navmenu"  class="shadowed">
                <a href="/ts.php" id="tsbutton" alt="Connect to the Hivecom Teamspeak server">CONNECT USING TEAMSPEAK</a>
                <a data-scroll href="#server" id="serverbutton" alt="Server information">THE SERVER</a>
                <a data-scroll href="#about" id="aboutbutton" alt="The people behind Hivecom">ABOUT US</a>
            </nav>
        </div>

        <div class="divider"></div>

		<!-- CONTENT DIVIDER WITH SUMMARY & BANNERS -->
        <div class="contentdiv striped">
            <div class="contentzone shadowed">
				<!-- BANNERS FOR WARNINGS AND ANNOUNCEMENTS -->
				<?php include_once(TEMPLATES_PATH . "/banner/warnings.php");?>
				<?php include_once(TEMPLATES_PATH . "/banner/news.php");?>
                <p>
                    Hivecom is a community based around a Teamspeak server hosted by a few cool people from all around the world.
                    We're a constantly growing group open to those willing to join. The community itself is partially made up of a few others
                    that generally enjoy playing games and are looking for a simple place to hang out and chat. The
                    most prominent folks on the server are those of the
                    <i><a href="http://webchat.esper.net/?channels=cobalt" alt="Espernet IRC">Cobalt IRC community</a></i>. Of course they
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

		<!-- MAIN SERVER INFORMATION & CONTENT (TS+DC) -->
        <div class="contentdiv gradient" id="server">
            <h3 class="shadowed">The Teamspeak server</h3>
            <div class="divider"></div>
            <div class="contentzone shadowed">
                <p>
                    The Hivecom Teamspeak server is hosted over at <i><a href="http://www.fragnet.net/" alt="Fragnet">Fragnet</a></i>
                    and is situated in Amsterdam. At this current point in time the server has a total of

                    slots open to anyone willing to join. Within the server there are a few specified groups of users that
                    have different levels of interaction on the server.
                    <br>
                    <br>
                    Non-registered users are restricted to the
                    lobby and the one open hub while registered users and up are allowed to move as they see fit. They
                    also have the option of creating their own temporary private channels which they can use to moderate
                    on their own. We also have a group of moderators that keep track of what goes about on the server
                    when there are no administrators in sight. They generally have the option to register new users as well as to
                    kick and move any registered and non-registered user as they see fit. For more information on how to
                    become registered on Hivecom, see the section further below.
                    <br>
                    <br>
                    There are a few options for connecting to the Teamspeak server. We suggest using the <i>'Connect to Teamspeak'</i>
                    button at the top of the page and then having you save the server address as a bookmark. You can however
                    also connect directly using "<i>ts.hivecom.net</i>".
                </p>
                <div class="horizontal-line"></div>
                <?php include_once(TEMPLATES_PATH. "/module/twitter.php");?>
				<div class="horizontal-line"></div>
                <?php
                if (HivecomTeamspeak::$query) {
                    echo
                    '
					<p class="centered">Current connections: '. HivecomTeamspeak::$query->clientCount(). ' / '. HivecomTeamspeak::$query["virtualserver_maxclients"]. '</p>
					<a href="lookup" class="centered"><h5>Click here to lookup a user</h5></a><br>
					<div class="horizontal-line"></div>';
                }
                ?>

                <p>
                    Becoming registered can be done quite fast. If you are an outsider and do not know anyone
                    within the Hivecom community, your best bet is to simply start a text chat with one of our
                    moderators or administrators. Poking is allowed but we suggest not going overboard with it when
                    trying to get someone's attention. From there on a quick introduction or hello world is
                    all you should need if you were to want to become registered. The moderator or administrator
                    should then ideally assign you to the registered server group allowing you to enter
                    the main area of the Hivecom Teamspeak server.
                    <br>
                    <br>
                    So, to keep the topic of becoming registered short: Ask politely. That is all you need to do.
                </p>
                <div class="horizontal-line"></div>
                <p>
                    Hivecom also has a <i><a href="/files/hivecomskin.zip" alt="Link to the Hivecom Teamspeak skin">Teamspeak skin</a></i>
                    you might want to try out. It's generally customized to fit the theme of Hivecom but it also
                    works well on other Teamspeak servers. You can download the skin <i><a href="/files/hivecomskin.zip" alt="Link to the Hivecom Teamspeak skin">here</a></i>.
                </p>
                <div class="horizontal-line"></div>
                <h4 class="centered" style="margin-top:16px;">Keeping the server alive</h4>
                <p>
                    Due to the fact that this server and website is funded without any sponsoring or ads and is open to
                    anyone to join and use, we encourage people to possibly donate a bit towards our yearly server costs.
                    Catlinman is currently in charge of the entire server's costs meaning that any extra funds he receives
                    will go towards maintaining and renewing the website and server.
                </p>

                <div class="horizontal-line"></div>
                <div class="centerinfo">
                    <a data-scroll href="#top" alt="Back to top">Back to top</a>
                </div>
            </div>
        </div>

		<!-- MAIN COMMUNITY BACKGROUND & MANAGEMENT -->
        <div class="contentdiv gradient" id="about">
            <h3 class="shadowed">The people behind Hivecom</h3>
            <div class="divider"></div>
            <div class="contentzone shadowed">
                <p>
                    The server is mainly managed by the two server administrators:
                    <i><a href="https://twitter.com/Catlinman_" alt="Catlinman">Catlinman</a></i> and
                    <i><a href="https://twitter.com/Jokler" alt="Jokler">Jokler</a></i>.
                    All three started hosting a server back in 2013 on a local machine. The demand for a better
                    connection and a 24/7 uptime made them reconsider this small hosting plan. They later on that year went over
                    to actually acquiring a dedicated Teamspeak server from
                    <i><a href="http://www.fragnet.net/" alt="Fragnet">Fragnet</a></i>.
                    The server and domain costs are currently being covered by Catlinman while Jokler makes sure
                    that the Raspberry Pi this website is running on stays online.
                    <br>
                    <br>
                    Hivecom wouldn't be anything without it's members though. The server has a total of about
                    200 registered members and is constantly growing. We also have moderators which take over some of the client management from
                    time to time. The full list of the administrators and moderators can be seen below.
                </p>
                <div class="horizontal-line"></div>
				<?php include_once(TEMPLATES_PATH. "/module/admins.php");?>
                <div class="horizontal-line"></div>
                <?php include_once(TEMPLATES_PATH. "/module/moderators.php");?>
                <div class="centerinfo">
                    <a data-scroll href="#top" alt="Back to top">Back to top</a>
                </div>
            </div>
        </div>
        <?php include_once(TEMPLATES_PATH. "/core/footer.php");?>
    </div>
</body>

</html>
