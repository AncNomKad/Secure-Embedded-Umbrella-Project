<?php
session_start();

include_once('/var/www/html/umbrella/headLanding.php');
include_once('/var/www/html/umbrella/umbrella-lib.php');
#include_once('/var/www/html/phpseclib1.0.5/Net/SSH2.php');

#Check if lockdown has occurred on the Website
inLockdown($lockdown);

checkAuth();

echo "<body style='background-color:black'>";
echo "<center><img src=\"images/ThirdEnergyLogo.png\"></center>";

echo "<center><font color=\"white\"><big>Test Tones</font></big><br><br><br><br>
		<form method=\"POST\">
		<font color=\"white\">Input Tone Sequence (Only 6 Numbers): </font><input type=password name=testTone value=\"\"></input>
		<input type=submit name=submit value=\"Submit\">
		</form>
	  </center>";

if ($_SERVER["REQUEST_METHOD"] == "POST" and strlen($_REQUEST['testTone']) == 6){
	$testTone = mysql_real_escape_string($_REQUEST['testTone']);
	$testTone = checkInput($testTone);
	if (is_numeric($testTone)){
		shell_exec('edisonCaC.sh');
		echo "<center><font color=\"white\">Transmission Complete!</font></center>";
		#Check the file contents we got back from the Intel Edison
		$file = "audioConfirmation.txt";
		checkFile($file);
		displayContent($file);
	}
	else{
		echo "<center><font color=\"white\">Please input numbers only!</font></center>";
	}
	
}
else{
	echo "<center><font color=\"white\">Input had bad data </font></center>";
}
/*
if ($_SERVER["REQUEST_METHOD"] == "POST" and strlen($_REQUEST['testTone']) == 6){
	$ssh = new Net_SSH2('192.168.1.191');
	if (!$ssh->login('root', '@LunarSoftware159&')){
		exit('Login Failed');	
	}
	echo $ssh->exec('/home/root/umbrella/audioCheck.pl');
	echo $ssh->exec('gst-launch-1.0 filesrc location=/home/root/umbrella/314104.wav ! wavparse ! pulsesink');
}
*/
/*
//header('Content-Type: text/plain; charset=utf-8');
if ($_SERVER["REQUEST_METHOD"] == "POST" and strlen($_REQUEST['testTone']) == 6){
		try{
			$connection = ssh2_connect('192.168.1.191', 22);
			ssh2_auth_password($connection, 'root', '@LunarSoftware159&');
			$stream = ssh2_exec($connection, '/home/root/umbrella/audioCheck.pl && gst-launch-1.0 filesrc location=/home/root/umbrella/314104.wav ! wavparse ! pulsesink');
		}
		catch (Exception $e) {
			echo "<font color=\"white\">Caught exception: </font>",  $e->getMessage(), "\n";
		}
}
*/
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
logOut();
include_once('/var/www/html/umbrella/footer.php');
?>

