
<?php require_once(realpath(dirname(__FILE__) . "/../private/config.php"));?>
<!DOCTYPE html>
<html>

<head>
    <title>Hivecom</title>
    <?php include_once(TEMPLATES_PATH . "/core/head.php");?>
</head>

<body>
    <div id="wrapper">
		<!-- Page bar with home navigation and login option -->
        <?php include_once(TEMPLATES_PATH . "/core/header.php");?>

		<!-- Main headline with page information and title -->
        <div id="headline" class="noselect">
            <img src="/img/metaicon.png" width="512"/>
            <h2>
                Welcome to Hivecom
            </h2>
            <p>
                - Official website of the Hivecom community -
            <p>
        </div>

		<!-- Page navigation bar with buttons -->
        <div id="navcontainer" class="shadowed">
            <nav id="navmenu">
                <a href="/ts.php" class="navlarge" alt="Connect to the Hivecom Teamspeak server">CONNECT TO TEAMSPEAK</a>
				<a href="/dc.php" class="navlarge" alt="Connect to the Hivecom Discord server">CONNECT TO DISCORD</a>
				<a data-scroll href="#news" class="navsmall" alt="Hivecom news and announcements">NEWS</a>
                <a data-scroll href="#voice" class="navsmall" alt="Voice servers run by Hivecom">VOICE SERVERS</a>
                <a data-scroll href="#game" class="navsmall" alt="Game servers run by Hivecom">GAME SERVERS</a>
				<a data-scroll href="#community" class="navsmall" alt="The people behind Hivecom">COMMUNITY</a>
            </nav>
        </div>

        <div class="divider"></div>

		<!-- Site summary with possible information banners -->
        <div class="contentdiv striped">
            <div class="content shadowed">
				<!-- Banners for warnings and important announcements -->
				<?php include_once(TEMPLATES_PATH . "/banner/warnings.php");?>
				<?php include_once(TEMPLATES_PATH . "/banner/news.php");?>
                <p>
					Hivecom is a gaming community run by folks from all around the world. We're a constantly growing
					group open to those willing to join. Our servers were initially hosted locally, but as sub communities
					and friends of friends joined we started building more advanced systems. As mentioned, people from
					all around the world are known visitors of our servers. The range goes from countries like New Zealand,
					over to all of Europe and across to North America.
					<br><br>
					Interested? Check out the voice and game server section for more information! We hope to see you amidst us!
					<br><br>
					<i>The Hivecom Team</i>
                </p>
            </div>
        </div>

		<!-- Main server news & announcements -->
        <div class="contentdiv gradient" id="news">
            <div class="contentheader shadowed">NEWS &amp; ANNOUNCEMENTS</div>
            <div class="divider"></div>
            <div class="content shadowed">
                <?php include_once(TEMPLATES_PATH . "/module/newsinfo.php");?>
				<?php include(TEMPLATES_PATH . "/module/totop.php");?>
            </div>
        </div>

		<!-- Voice server information and current connection data (TS+DC) -->
		<div class="contentdiv gradient" id="voice">
			<div class="contentheader shadowed">VOICE SERVERS</div>
			<div class="divider"></div>
			<div class="content shadowed">
				<p>
					Short summary about the hosting information for both main voice servers.
					<br><br>
					There are a few options for connecting to our voice servers. We suggest using one of the connection
					buttons at the top of the page and then having you save the server address as a bookmark. You can however
					also connect directly using the connection information listed below.
				<div class="split">
					<div class="splitcontent splittwo">
						<?php include(TEMPLATES_PATH . "/module/tsinfo.php");?>
					</div>
					<div class="vertical-line"></div>
					<div class="splitcontent splittwo">
						<?php include(TEMPLATES_PATH . "/module/dcinfo.php");?>
					</div>
					<br>
					<br>
				</div>
				<div class="horizontal-line"></div>

				<h4 class="centered">Member registration &amp; voice server management</h4>
				<p>
					Due to the fact that the server is open for anyone to join but we have limited slots and resources you will
					require an invite in a way to become a voice server member. You can either receive your registered status by
					creating and authenticating with an account on this page. You will then receive the basic registered status on all
					our	voice servers. However, you will not be able to register any other members unless you are approved by our staff.
					Non-registered users are restricted to the lobby while registered users and up are allowed to move as they see fit
					and	create their own temporary private channels.
					<br><br>
					If you run a your own community and are looking for a free voice server	solution then we would gladly work out a
					higher server ranking with you. Moderators can create permanent channels and are able to manage basic users making
					it an ideal fit for easy sub community management. Although there are administrators present most of the time, our
					setup relies a lot on our moderators to register new users and manage the server.
					<br><br>
					In case you do not intend to make an account here on our main website - we do encourage it though since it comes with
					some perks such as cross server authentication - you can always connect to one of our voice servers and write a
					moderator or administrator a message. Although approved users can register you as well they are most likely to
					push the matter off onto a higher ranking member. In that sense, if you are worried just chill, write us and we
					will see what we can do for you!
				</p>
				<div class="horizontal-line"></div>

				<h4 class="centered">Teamspeak skin</h4>
				<p>
					Hivecom also has a <i><a href="/files/hivecomskin.zip" alt="Link to the Hivecom Teamspeak skin">Teamspeak skin</a></i>
					you might want to try out. It's generally customized to fit the theme of Hivecom but it also
					works well on other Teamspeak servers. You can download the skin <i><a href="/files/hivecomskin.zip" alt="Link to the Hivecom Teamspeak skin">here</a></i>.
				</p>
				<?php include(TEMPLATES_PATH . "/module/totop.php");?>
			</div>
		</div>

		<!-- Game server list and content links -->
		<div class="contentdiv gradient" id="game">
			<div class="contentheader shadowed">GAME SERVERS</div>
			<div class="divider"></div>
			<div class="content shadowed">
				<p>
					Write amazing information about the game servers Hivecom hosts here.
				</p>
				<?php include(TEMPLATES_PATH . "/module/totop.php");?>
			</div>
		</div>

		<!-- Main community background information, management & donations -->
        <div class="contentdiv gradient" id="community">
			<div class="contentheader shadowed">ABOUT THE HIVECOM COMMUNITY</div>
            <h3 class="shadowed"></h3>
            <div class="divider"></div>
            <div class="content shadowed">
				<p>
					Write about background.
				</p>
                <div class="horizontal-line"></div>

				<h4 class="centered">The administrators</h4>
				<?php include_once(TEMPLATES_PATH . "/module/admincards.php");?>
				<p>
					Talk about admins and background here.
                </p>
				<div class="horizontal-line"></div>

				<h4 class="centered">Site managers and server moderators</h4>
				<p>
					Talk about moderators and staff here.
				</p>
				<?php include_once(TEMPLATES_PATH . "/module/staffinfo.php");?>
				<div class="horizontal-line"></div>

				<h4 class="centered">Keeping things running</h4>
				<p>
					Due to the fact that this server and website is funded without any sponsoring or ads and is open to
					anyone to join and use, we encourage people to possibly donate a bit towards our yearly server and
					maintenance costs. <a href="/users/profile?handle=catlinman">Catlinman</a> is currently in charge of
					the entire server's costs meaning that any extra funds he receives will go towards maintaining and
					renewing the website and server. Anything extra is left as a tip which will most likely be reinvested
					in one of our joined development projects or simply saved for later.
					<br><br>
					Even though the server costs will be paid for either way and things will continue running we still
					appreciate any help and extra encouragement we receive. We're already extremely thankful for the
					amazing community either way. Thanks for being a part of this journey!
				</p>
				<?php include(TEMPLATES_PATH . "/module/donationmeter.php");?>
				<div class="horizontal-line"></div>

				<h4 class="centered">In retrospect</h4>
				<p>
					Hivecom wouldn't be anything without its members though. The server has a total of about 400
					registered members and is constantly growing. We're overly thankful for	what we have now
					considering this all started from three friends getting together to chat and hang out.
				</p>
				<?php include(TEMPLATES_PATH . "/module/totop.php");?>
            </div>
        </div>
        <?php include_once(TEMPLATES_PATH . "/core/footer.php");?>
    </div>
</body>

</html>
