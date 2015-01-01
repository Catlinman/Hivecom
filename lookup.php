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
                Lookup Request
            </h2>
            <p style="margin:170px 0">
                <a href="/index.php">Click here to return to the main page</a>
            <p>
        </div>
        <div class="contentdiv gradient">
            <h3 class="shadowed">Retrieve user information</h3>
            <div class="contentzone shadowed">
                <?php
                    if($online == TRUE){
                        echo
                            '<form action="result" method="get">
                                <label>Lookup name</label>
                                <input type="text" name="name" maxlength="30">
                                <input type="submit">
                            </form>
                            <div class="horizontal-line"></div>
                            <p style="text-align:center;">
                            - Users currently available for lookup -<br><br>';

                        $clients = $ts3->clientList();
                        $lastClient = end($clients);

                        foreach($clients as $c){
                            if($c != $lastClient){
                                echo $c .' | ';
                            } else{
                                echo $c;
                            }
                        }

                        // echo '<br><br>Executed '. $ts3->getAdapter()->getQueryCount(). ' queries in '. number_format((float)$ts3->getAdapter()->getQueryRuntime(), 2, '.', ''). ' seconds';

                        echo '</p>';

                    } else{
                        echo '<p style="text-align:center"> The Teamspeak server is currently offline and can not process your lookup request</p>';
                    }
                ?>
            </div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/footer.php");?>
    </div>
</body>
