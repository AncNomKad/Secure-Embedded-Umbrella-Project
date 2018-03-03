<?php
session_start();
session_regenerate_id();

include_once('/var/www/html/umbrella/umbrella-lib.php');
echo "<body style='background-color:black'>";
echo "<div style=\"float:right;\"><img src=\"images/sound_puzzle.jpg\"></div>";

connect($db);

twoFA($db);
homePage();

?>
