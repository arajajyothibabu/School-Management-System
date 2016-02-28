<?php
require("constants.php");
// 1.Create a database connection
$connection = mysql_connect(server,user,pass);
if(!$connection){
    die("Database connection failed: " . mysql_error());
}
//else {echo "Connection established..!";}

// 2. Select a database to use
$db_select = mysql_select_db(name,$connection);
if(!$db_select){
    die("Database selection failed: " . mysql_error());
}
?>