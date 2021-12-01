<?php

include("config.php");

$dbconn = pg_connect('host='.$host.' port='.$port.' dbname='.$databaseName.' user='.$user.' password='.$password) # Host name is container name, WTF ?
    or die('Could not connect');

$ret = pg_query($dbconn, $q3_query); # Query of point 1

pg_close($dbconn);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Full Secondary Column, 1/2 x 1/2 Main Column.</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <div id="doc" class="yui-t7">
        <div id="header">
            <h1>Step 3</h1>
            <h6>Paul Théron</h6>
            <h6>Louis Proffit</h6>
        </div>
        <div id="bd">
            <div id="yui-main">
                <div class="yui-b">
                    <div class="yui-g">
                        <div class="yui-u first">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>Table name</th>
                                        <th>Table owner</th>
                                        <th>Button</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = pg_fetch_row($ret)): ?>
                                    <td>
                                        <div class="email">
                                            <span><?php echo $row[0] ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="email">
                                            <span><?php echo $row[1] ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="table" value=<?php echo $row[0];?> />
                                            <input type="submit" value="Select" />
                                        </form>
                                    </td>
                                    </tr>
                                    <?php endwhile ?>


                                </tbody>
                            </table>
                        </div>
                        <div class="yui-u">
                            <?php
                            if (empty($_POST["table"])){
                                echo "Sélectionner une table pour commencer";
                            } else {
                                require("dynamicContent-table.php");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ft">
        </div>
    </div>
</body>
</html>