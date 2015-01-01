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
                            </form>';
                    } else{
                        echo '<p style="text-align:center"> The Teamspeak server is currently offline and can not process your lookup request</p>';
                    }
                ?>
                <div class="horizontal-line"></div>
                <p style="text-align:center;">Make sure to select a user from the users currently online on the server</p>
                <div class="horizontal-line"></div>
                <div>
                    <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/tsviewer.php");?>
                </div>
            </div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/footer.php");?>
    </div>
</body>
