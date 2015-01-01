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
            <p style="margin:170px 0">
                <a href="/index.php">Click here to return to the main page</a>
            <p>
        </div>
        <div class="contentdiv gradient">
            <h3 class="shadowed">User information</h3>
            <div class="contentzone shadowed">
                <?php
                    if($online == TRUE){
                        if(!empty($_GET["name"])) {
                            $name = htmlspecialchars($_GET["name"]);

                            function secondsToTime($seconds) {
                                $dtF = new DateTime("@0");
                                $dtT = new DateTime("@$seconds");
                                return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
                            }

                            try {
                                $client = $ts3->clientGetByName($name);
                                $info = $client->getInfo();

                                echo '<h3 style="padding-bottom:0px;">'. $name. '</h3>';

                                echo '<p>';

                                echo 'Server groups:<br>';
                                foreach($client->memberOf() as $group) echo '&emsp;<i>'. $group. '</i><br>';

                                echo    '<br>Client information:<br>'.
                                        '&emsp;Nickname: <i>'. $info["client_nickname"]. '</i><br>';

                                if(!empty($info["client_description"])) echo '&emsp;Description: <i>'. $info["client_description"]. '</i><br>';
                                if(!empty($info["client_flag_avatar"])) echo '&emsp;Avatar: <i>Yes</i><br>';
                                if(!empty($info["client_is_channel_commander"])) echo '&emsp;Channel commander: <i>'. $info["client_is_channel_commander"]. '</i><br>';

                                echo '&emsp;Is talking: ';
                                if($info["client_flag_talking"] == 0){
                                    echo '<i>No</i><br>';
                                } else{
                                    echo '<i>Yes</i><br>';
                                }

                                echo    '&emsp;Country: <i>'. $info["client_country"]. '</i><br>'.
                                        '&emsp;Total Connections: <i>'. $info["client_totalconnections"]. '</i><br>'.
                                        '&emsp;Connection Time: <i>'. secondsToTime(substr($info["connection_connected_time"], 0, -3)) .'</i><br>'.
                                        '&emsp;Version: <i>'. $info["client_version"]. '</i><br>'.
                                        '&emsp;Platform: <i>'. $info["client_platform"]. '</i><br>';

                                // echo    '<br>Client information keys:<br>';
                                // foreach(array_keys($info) as $value) echo '&emsp;<i>' .$value .'</i><br>';

                                echo '<br><br>Executed '. $ts3->getAdapter()->getQueryCount(). ' queries in '. number_format((float)$ts3->getAdapter()->getQueryRuntime(), 2, '.', ''). ' seconds';

                                echo '</p>';

                            } catch (Exception $e){
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
