<!DOCTYPE html>
<html>

<head>
    <title>Hivecom - Donation Center</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/head.php");?>
    <script type="text/javascript" src="/scripts/formvalidation.js"></script>
</head>

<body class="darkbody">
    <div id="wrapper">
        <?php
            include_once($_SERVER['DOCUMENT_ROOT']. "/resources/header.php");
        ?>
        <div id="titlediv">
            <h2>
                Donation Center
            </h2>
            <p style="margin:170px 0px">
                <a href="/index.php">Click here to return to the main page</a>
            </p>
        </div>
        <div class="contentdiv gradient">
            <h3 class="shadowed">Support Hivecom</h3>
            <div class="contentzone shadowed">
                <br>
                <h4 class="centered">Make a donation</h4>
                <noscript id="jsnotice">
                    <p>
                        Javascript have been detected as disabled - some elements might not function as intended
                    </p>
                </noscript>
                <div class="jsenabled">
                    <p class="centered">
                        All donations are done through PayPal and require a minimum amount of 1€.
                    </p>
                    <p class="centered">
                        Leave the personal information fields empty if you wish to make an anonymous donation.
                    </p>
                </div>
                <form name="paypalform" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" onsubmit="return validateDonation()">
                    <div class="jsenabled">
                        <label for="amount">Personal information:</label>
                        <input type="text" name="name" maxlength="50" placeholder="Display name">
                        <input type="text" name="twitter" maxlength="15" placeholder="Optional Twitter handle" onkeydown="onkeyTwitter()" onfocus="onfocusTwitter()" onfocusout="onfocusoutTwitter()" pattern="^@?(\w){1,15}$" title="May not contain spaces or special characters">
                        <br>
                    </div>
                    <label for="amount">Enter the amount you wish to donate:</label>
                    <input type="number" name="amount" min="1.00" step="0.01" max="250" placeholder="Donation amount in Euros" required>
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="item_name" value="Donation to Hivecom">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="dev.catlinman@gmail.com">
                    <input type="hidden" name="custom" value="">
                    <input type="hidden" name="notify_url" value="http://hivecom.net/donations/ipn/"> 
                    <input type="submit" value="Proceed to PayPal">
                </form>
                <div class="horizontal-line"></div>
                <br>
                <h4 class="centered">List of donations</h4>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT']. "/scripts/private/sqlauth.php");
                    $table = 'donations';

                    $result = mysql_query("SELECT * FROM {$table}");
                    $fields_num = mysql_num_fields($result);

                    if(mysql_num_rows($result) != 0){
                        echo
                            '<ul class="columnlist listhead">
                            <li>Name</li>
                            <li>Donation Date</li>
                            <li>Amount</li>
                            <li>Twitter</li>
                            </ul>';
                    } else {
                        echo '<p class="centered">Looks like there\'s nothing to see here at the moment</p>';
                    }
                ?>
                <ul class="columnlist">
                    <?php
                        while($row = mysql_fetch_row($result)){
                            echo '<li title="'. $row[1]. '">'. $row[1]. '</li><li>'. date_format(date_create($row[4]), 'd.m.Y'). '</li><li>'. $row[3]. '€</li>';
                            if($row[5] != NULL){
                                echo '<li><a href="https://twitter.com/'. $row[5]. '">@'. $row[5]. '</a></li>';
                            } else {
                                echo '<li><br></li>';
                            }
                            echo "<br>";
                        }
                    ?>
                </ul>
                <div class="listclear"></div>
                <?php
                    if(mysql_num_rows($result) != 0) echo "<br>";
                ?>
            </div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/footer.php");?>
    </div>
</body>

</html>
