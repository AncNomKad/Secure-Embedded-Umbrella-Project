<?php
session_start();

include_once('/var/www/html/umbrella/umbrella-lib.php');
include_once('/etc/umbrella-mysql.conf');
echo "<body style='background-color:black'>";
echo "<div style=\"float:right;\"><img src=\"images/umbrella_corp_symbol_anim.gif\"></div>";

connect($db);

//Setup look of the page
//Change index.php to user page
loginFields($db);
homePage();

#Check if admin to send to 2Auth.php page

?>
