<?php
session_start();
session_regenerate_id();

include_once('/var/www/html/umbrella/header0.php');
include_once('/var/www/html/umbrella/umbrella-lib.php');

#Check if lockdown has occurred on the Website
inLockdown($lockdown);

#Security checks
isAdmin();
#checkAuth();


connect($db);

displayUsers($db);
visualPage();
		echo "<br><form method=\"POST\" action=\"adminAdd.php\">
	       <center><input type=\"submit\" name=\"addDelete\" value=\"Add or Delete Users\" /></center></form>
		<br>";
logOutButton();

?>
