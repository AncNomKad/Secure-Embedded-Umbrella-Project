<?php
session_start();
session_regenerate_id();

include_once('/var/www/html/umbrella/headLanding.php');
include_once('/var/www/html/umbrella/umbrella-lib.php');

#Check if lockdown has occurred on the Website
inLockdown($lockdown);

#checkAuth();

#User info variables specific to this page
isset($_REQUEST['testTone']) ? $testTone = strip_tags($_REQUEST['testTone']) : $testTone="";

echo "<body style='background-color:black'>";
echo "<center><img src=\"images/ThirdEnergyLogo.png\"></center>";

echo "<center><font color=\"white\"><big>Test Tones</font></big><br><br><br><br>
		<form method=\"POST\">
		<font color=\"white\">Input Tone Sequence (Only 6 Numbers): </font><input type=password name=testTone value=\"\"></input>
		<input type=submit name=submit value=\"Submit\">
		</form>
	  </center>";

//Run Tone Script and submit to Intel Edison

if ($_SERVER["REQUEST_METHOD"] == "POST" and strlen($_REQUEST['testTone']) == 6){
	$testTone = mysqli_real_escape_string($db, $_REQUEST['testTone']);
	$testTone = checkInput($testTone);
	$testTone = (int)$testTone;
	if (is_numeric($testTone)){
		exec("python callSH.py",$output, $status);
		if (0 == $status){
			echo "<center><font color=\"white\">Transmission Complete!</font></center>";
			#Check the file contents we got back from the Intel Edison
			$file = "audioConfirmation.txt";
			checkFile($file);
			displayContent($file);
		}
		else{
			echo "<center><font color=\"white\">Transmission Incomplete!</font></center>";
		}
	}
	else{
		echo "<center><font color=\"white\">Please input numbers only!</font></center>";
	}
	
}
else{
	echo "<center><font color=\"white\">Input had bad data </font></center>";
}

/*
//Check File Upload
 if(isset($_FILES['image'])){
	//Source: https://www.tutorialspoint.com/php/php_file_uploading.htm
	$file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
	$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be exactly 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
	fileUpload();
	}

//Create tone for user
$digits = 6;
$userNumbers = rand(pow(10, $digits-1), pow(10, $digits)-1);
echo $userNumbers;
#Usage: $0 [DTMF tones] [play]
system("/scripts/tone.perl $userNumbers 1");
*/
echo "<br><form method=\"POST\" action=\"profile.php\">
	       <center><input type=\"submit\" name=\"profile\" value=\"Edit Profile and Data Settings\" /></center></form>
		<br>";
logOutButton();
//include_once('/var/www/html/umbrella/footer.php');
?>

