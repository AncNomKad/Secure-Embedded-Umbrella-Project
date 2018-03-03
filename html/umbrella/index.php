<?php
session_start();
include_once('/var/www/html/umbrella/headLanding.php');
include_once('/var/www/html/umbrella/umbrella-lib.php');

#Check if lockdown has occurred on the Website
inLockdown($lockdown);

#Redraw homepage
	echo"	
		<center>
		<big><font color=\"white\">Login or Select Division</font></big><br><br>
		<br>
		<FORM METHOD=\"LINK\" ACTION=\"login.php\">
		<INPUT TYPE=\"submit\" VALUE=\"Login\">
		</FORM><br>
		<FORM METHOD=\"LINK\" ACTION=\"findDivision.php\">
		<INPUT TYPE=\"submit\" VALUE=\"Division Info\">
		</FORM><br>
		</center>
";
homePage();

echo "<br><br><br><br><center><font color=\"white\"><big>Remember: Shodan is always watching...</font></big><br>
		<center><img src=\"images/SHODANEmailAnimation.gif\"></center>";
echo "</body> </html>";
?>
