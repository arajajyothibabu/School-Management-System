<?php
require("constants.php");
// 1.Create a database connection
$connection = mysqli_connect(server,user,pass);
if(!$connection){
    die("Database connection failed: ");
}
//else {echo "Connection established..!";}

// 2. Select a database to use
$db_select = mysqli_select_db($connection, name);
if(!$db_select){
    die("Database selection failed: " . mysqli_error($connection));
}
?>