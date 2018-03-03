<?php
session_start();
include_once('/var/www/html/umbrella/header1.php');
include_once('/var/www/html/umbrella/umbrella-lib.php');

#Check if lockdown has occurred on the Website
inLockdown($lockdown);

	echo "<center><form method=\"POST\">
		<font color=\"white\">Find Division:</font>
		<select name=\"userOption\">
			<option value=\"-1\">Select...</option>
			<option value=\"0\">3rd Energy</option>
			<option value=\"1\">Bio-Weapons</option>
			<option value=\"2\">IT</option>
			<option value=\"3\">Arklay</option>
			<option value=\"4\">Japan</option>
		</select>
		<input type=\"submit\" name=\"submit\" value=\"Submit\" /></p>
		</form></center>";
//<center><font color=\"white\">Select an option to learn more about that division and its history</font></center>
	#Must be authenticated to use it
	if (isset($_REQUEST['submit'])){
	#Display files or days of the week
		$userOption = $_REQUEST['userOption'];	
		if(is_numeric($userOption)){
			switch($userOption){
				case "0";
					echo "<br><br><div style=\"float:left;\"><img src=\"images/3rdEnergyLogo2.png\" alt=\"3rd Energy Logo\"></div><br><br><br><br><br><center><font color=\"gold\">At the turn of the 21st century, fossil fuels have been drained to such an extent that Nuclear Power - \"Second Energy\" - has become a necessity. Due to the hazardous nature of its accidents, research begins on a hypothetical third generation of reactor which releases no hazardous waste products, nor could be exhaustible - this is dubbed \"Third Energy\". Main facilities are located at Ibis island and Edward City.</font></center>";
				break;
				case "1";
					echo "<br><br><div style=\"float:left;\"><img src=\"images/umbrella_Labs.jpg\" alt=\"Umbrella Labs\"></div><br><br><br><br><br><center><font color=\"gold\">White Umbrella's fortunes meant it could maintain its own line of facilities and products, all in the name of the rest of mainstream Umbrella, and also possessed its own security forces e.g. a three-man clean-up crew team, and Ground Teams (of 4-men-each, and 170 teams at least).

Umbrella's officials also gave White Umbrella an enormous amount of authorization and free reign, allowing the department to perform covert investigations and spying missions on rivals, governments, intelligence & law-enforcement agencies, potential hazards etc., all to make sure as few people as possible know about Umbrella's dealings. To this end, they employ a wide variety of weapons and tactics to ensure they succeed, to sabotage, blackmail, discrediting and even murder. As a result, White Umbrella was entrusted by the corporation's top officials with the corporation's most valued secrets and private files & documents, most notably the White Umbrella Facility Complete Directory Code Books, of which only 3 are in existence. White Umbrella also disposes of employees whenever they have outlived their usefulness, or were found to have been a danger to Umbrella. .</font></center>";
				break;
				case "2";
					echo "<br><br><div style=\"float:left;\"><img src=\"images/information-technology.png\" alt=\"IT\"></div><br><br><br><br><br><center><font color=\"gold\">The IT division ensures zero downtime of all global Umbrella operations while maintaining high security at every site.</font></center>";
				break;
				case "3";
					echo "<br><br><div style=\"float:left;\"><img src=\"images/Arklay_Lab.png\" alt=\"Arklay Lab\"></div><br><br><br><br><br><center><font color=\"gold\">The Arklay Laboratory was a laboratory complex located in the Arklay Mountains, and managed by Umbrella USA. Hidden beneath the seclusive Spencer Mansion, the Arklay Laboratory was one of the earth's key Umbrella facilities, and was involved with viral and bio-weapons research and development. The facility was destroyed following a sabotage which left the entire research staff and associated employees dead or otherwise infected with the t-Virus.</font></center>";
				break;
				case "4";
					echo "<br><br><div style=\"float:left;\"><img src=\"images/umbrella_research_theme_2.png\" alt=\"Japan\"></div><br><br><br><br><br><center><font color=\"gold\">The Umbrella Executive Training Center was a student research facility with a separate laboratory complex hidden below an adjacent church. The main facility was designed to train researchers as prospective executive officers to become the next generation of the company's management.</font></center>";
				break;
			}
	}
			#Error
			else{
				echo "[ERROR]: Your input was not a digit";
			}
}
echo "</body></html>";
?>
