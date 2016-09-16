<?php
define("HOST","localhost");
define("USER","root");
define("PASS","test");
define("DB","mexpense");
$con  =  mysql_pconnect(HOST,USER,PASS);
mysql_select_db(DB,$con);
/*if (!$con) {
    die('Could not connect: ' . mysql_error());
}
else echo 'Connected successfully';*/
?>

