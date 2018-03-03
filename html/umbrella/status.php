<?php
include_once('/var/www/html/umbrella/headLanding.php');
include_once('/var/www/html/umbrella/umbrella-lib.php');

#Check if lockdown has occurred on the Website
inLockdown($lockdown);

//Check network status
webConnect();
dbConnect();
edisonConnect();

echo "<center><img src=\"images/umbrella-logo-psd.jpg\"></center>";
?>
