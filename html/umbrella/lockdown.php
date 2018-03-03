<?php
session_start();

include_once('/var/www/html/umbrella/headLanding.php');
include_once('/var/www/html/umbrella/umbrella-lib.php');

isAdmin();

#Lockdown the website and (in theory) redirect all traffic to lockscreen page until unlocked by admin
lockdown();

?>
