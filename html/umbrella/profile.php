<?php
session_start();
session_regenerate_id();

include_once('/var/www/html/umbrella/header2.php');
include_once('/var/www/html/umbrella/umbrella-lib.php');

#Check if lockdown has occurred on the Website
inLockdown($lockdown);


connect($db);

#Security checks
#checkAuth();

loadProfile($db);
editProfile($db);
//Back button
echo "<center><button type=\"button\" onclick=\"history.back();\">Back</button></center>";
logOutButton();

?>