<?php 
include("config.php");
include("queries.php");

if (!isset($_POST["table"])){
    echo "Erreur";
    die("Incorrect table name");
    return;
}
$table = $_POST["table"];
$dbconn = pg_connect('host='.$host.' port='.$port.' dbname='.$databaseName.' user='.$user.' password='.$password) # Host name is container name, WTF ?
    or die('Could not connect');

$ret_4 = pg_query($dbconn, $q4_query_1.$table.$q4_query_2); # Query of point 4
$first_row =pg_fetch_row($ret_4);

$ret_5 = pg_query($dbconn, "SELECT B.attname, C.typname FROM pg_class A JOIN pg_attribute B ON A.oid = B.attrelid JOIN pg_type C ON B.atttypid = C.oid JOIN pg_namespace D ON D.oid = A.relnamespace WHERE B.attname != 'varchar' and D.nspname = 'public' AND NOT A.reltype = 0 AND A.relname='".$_POST["table"]."';"); # Query of point 5

$ret_7 = pg_query($dbconn, $q7_query_1.$table.$q7_query_2); // Query of point 7

pg_close($dbconn);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Propriétés</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <table class="table">

        <thead class="thead-primary">
            <tr>
                <th>Attribute </th>
                <th>Type</th>
                <th>Number of non distinct values</th>
                <th>Min</th>
                <th>Max</th>    
            </tr>
        </thead>
        <tbody>
            <?php while($row = pg_fetch_row($ret_7)): ?>
            <tr>
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
                    <div class="email">
                        <span><?php echo $row[2] ?></span>
                    </div>
                </td>
                <td>
                    <div class="email">
                        <span><?php echo $row[3] ?></span>
                    </div>
                </td>
                <td>
                    <div class="email">
                        <span><?php echo $row[4] ?></span>
                    </div>
                </td>
            </tr>
            <?php endwhile ?>

        </tbody>
    </table>
 
    <h5 class="sub-header">Table : <?php echo $_POST["table"]; ?></h5>
    <h5 class="sub-header">OID : <?php echo $first_row[0]; ?></h5>
    <h5 class="sub-header">Access Method : <?php echo $first_row[1]; ?></h5>

</body>

</html>