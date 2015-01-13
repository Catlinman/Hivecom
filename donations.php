<!DOCTYPE html>
<html>

<head>
    <title>Hivecom - Donation Center</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/head.php");?>
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
            <h3 class="shadowed">List of contributors</h3>
            <div class="contentzone shadowed">
                <p>
                    <?php
                        require_once($_SERVER['DOCUMENT_ROOT']. "/scripts/private/sqlauth.php");
                        $table = 'donations';

                        $result = mysql_query("SELECT * FROM {$table}");
                        $fields_num = mysql_num_fields($result);

                        while($row = mysql_fetch_row($result)){
                            echo "{$row[2]}€ {$row[1]} ";
                            if($row[4] != NULL){
                                echo '- <a href="https://twitter.com/'. ltrim($row[4], "@"). '">Twitter</a>';
                            }
                            echo "<br>";
                        }
                    ?>
                </p>
            </div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT']. "/resources/footer.php");?>
    </div>
</body>

</html>
