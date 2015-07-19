<!DOCTYPE html>
<html>

<head>
	<title>Hivecom</title>
	<?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/head.php");?>
</head>

<body class="darkbody">
	<div id="wrapper">
		<?php
			include_once($_SERVER['DOCUMENT_ROOT']. "/resources/header.php");
		?>
		<div id="titlediv" class="noselect">
			<img src="images/metaicon.png" width="512"/>
			<h2>
				User Lookup
			</h2>
			<p style="margin:170px 0px">
				<a href="/index.php">Click here to return to the main page</a>
			<p>
		</div>
		<div class="contentdiv gradient">
			<h3 class="shadowed">User information</h3>
			<div class="contentzone shadowed">
				<?php
					if($online == TRUE) {
						if(!empty($_GET["name"])) {
							$name = htmlspecialchars($_GET["name"]);

							function secondsToTime($seconds) {
								try {
									$dtF = new DateTime("@0");
									$dtT = new DateTime("@$seconds");

								} catch(Exception $e) {
									echo '<br>'. $e;
								}

								$valuestring = $dtF->diff($dtT)->format('%a,%h,%i,%s');
								$valuearray = explode(",", $valuestring);
								$formatted = "";

								if(!empty($valuearray[0])) $formatted = $formatted. $valuearray[0]. " Days ";
								if(!empty($valuearray[1])) $formatted = $formatted. $valuearray[1]. " Hours ";
								if(!empty($valuearray[2])) $formatted = $formatted. $valuearray[2]. " Minutes ";

								$formatted = $formatted. $valuearray[3]. " Seconds";

								return $formatted;
							}

							try {
								$client = $ts3->clientGetByName($name);
								$info = $client->getInfo();

								if(!empty($info["client_flag_avatar"])) {
									echo '<a href="avatar?name='. $name. '"><img class="avatar shadowed" src="avatar?name='. $name. '" alt="'. $name. '"></a>';
								}

								echo '<h3 style="padding-bottom:0px;">'. $name. '</h3>';

								echo '<p>';

								$grouplink = $client->memberOf();
								$lastgroup = end($grouplink);

								echo 'Server and channel groups:<br>';
								foreach($grouplink as $group) {
									if($group != "Guest") {
										echo '&emsp;<i>'. $group. '</i><br>';

									} elseif($group == $lastgroup) {
										echo '&emsp;<i>None</i><br>';
									}
								}

								echo    '<br>Client information:<br>'.
										'&emsp;Nickname: <i>'. $info["client_nickname"]. '</i><br>';

								if(!empty($info["client_description"])) echo '&emsp;Description: <i>'. $info["client_description"]. '</i><br>';
								if(!empty($info["client_is_channel_commander"])) echo '&emsp;Channel commander: <i>'. $info["client_is_channel_commander"]. '</i><br>';

								echo    '&emsp;Country: <i>'. $info["client_country"]. '</i><br>'.
										'&emsp;Channel: <i>'. $ts3->channelGetById($info["client_channel_group_inherited_channel_id"]). '</i><br>'.
										'&emsp;Total Connections: <i>'. $info["client_totalconnections"]. '</i><br>'.
										'&emsp;Connection Time: <i>'. secondsToTime(floor($info["connection_connected_time"] / 1000)) .'</i><br>'.
										'&emsp;Idle time: <i>'. secondsToTime(floor($info["client_idle_time"] / 1000)). '</i><br>'.
										'&emsp;Version: <i>'. $info["client_version"]. '</i><br>'.
										'&emsp;Platform: <i>'. $info["client_platform"]. '</i><br>';

								// echo '<br>Client information values:<br>';
								// foreach($info as $key => $value) {
								//    echo '&emsp;<i>'. $key. ' = '. $value. '</i><br>';
								// }
								// echo '<br><br>Executed '. $ts3->getAdapter()->getQueryCount(). ' queries in '. number_format((float)$ts3->getAdapter()->getQueryRuntime(), 2, '.', ''). ' seconds';

								echo '</p>';

							} catch (Exception $e) {
								echo '<p style="text-align:center">'. $name .' was not found on the server<br>Keep in mind that the name is case sensitive</p>';
							}

						} else{
							echo '<p style="text-align:center"> Please enter a name before submitting</p>';
						}

					} else{
						echo '<p style="text-align:center"> The Teamspeak server is currently offline and can not process your lookup request</p>';
					}
				?>
				<div class="horizontal-line"></div>
				<div class="centerinfo">
					<a href="lookup" >Lookup another user</a>
				</div>
			</div>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/footer.php");?>
	</div>
</body>
