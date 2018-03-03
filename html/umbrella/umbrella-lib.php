<?php

#Variable Sections
		#User info variables
		isset($_REQUEST['postName']) ? $postName = strip_tags($_REQUEST['postName']) : $postName="";
        isset($_REQUEST['postUserName']) ? $postUserName = strip_tags($_REQUEST['postUserName']) : $postUserName="";
        isset($_REQUEST['postPass']) ? $postPass = strip_tags($_REQUEST['postPass']) : $postPass="";
		isset($_REQUEST['postEmail']) ? $postEmail = strip_tags($_REQUEST['postEmail']) : $postEmail="";
		isset($_REQUEST['postTone']) ? $postTone = strip_tags($_REQUEST['postTone']) : $postTone="";
		isset($_REQUEST['postPIN']) ? $postPIN = strip_tags($_REQUEST['postPIN']) : $postPIN="";


		#Query variables;
		$row="";
		$query="";
		$adminCheck="";

		#General Website variables
		isset($_REQUEST['lockdown']) ? $lockdown = strip_tags($_REQUEST['lockdown']) : $lockdown="";

		#Login variable info
		isset($_REQUEST['loginAttempts']) ? $loginAttempts = strip_tags($_REQUEST['loginAttempts']) : $loginAttempts="";
		isset($_REQUEST['ip']) ? $ip = strip_tags($_REQUEST['ip']) : $ip="";
		isset($_REQUEST['user']) ? $user = strip_tags($_REQUEST['user']) : $user="";
		isset($_REQUEST['userid']) ? $userid = strip_tags($_REQUEST['userid']) : $userid="";
		isset($_REQUEST['date']) ? $date = strip_tags($_REQUEST['date']) : $date="";
		isset($_REQUEST['action']) ? $action = strip_tags($_REQUEST['action']) : $action="";
		isset($_REQUEST['logout']) ? $logout = strip_tags($_REQUEST['logout']) : $logout="";


function homePage(){
	echo "<center>
		<FORM METHOD=\"LINK\" ACTION=\"index.php\">
		<INPUT TYPE=\"submit\" VALUE=\"Home\">
		</center>";
}

function visualPage(){
	
	echo "<form method=\"POST\" action=\"visualize.php\">
	       <center><input type=\"submit\" name=\"visualize\" value=\"See Common Tones\" /></center></form>
		";
}

function logOut(){
		session_unset();
		session_destroy();
		header("Location: /umbrella/index.php");	
}

function logOutButton(){
	echo "<form method=\"post\">
	       <center><input type=\"submit\" name=\"logout\" value=\"Logout\" /></center></form>
		";

	if (isset($_POST['logout'])){
			session_unset();
			session_destroy();
			header("Location: /umbrella/index.php");	
	}
}

function lockdown(){
		echo "<form method=\"post\">
	       <center><input type=\"submit\" name=\"lockdown\" value=\"Lockdown!\" /></center></form>
		";
		if (isset($_REQUEST['lockdown'])){
			$lockdown=True;
			header("Location: /umbrella/lockscreen.php");	
		}
	

}

function inLockdown($checkLock){
		if ($checkLock == True){
			header("Location: /umbrella/lockscreen.php");
		}
		//Else do nothing

}


function displayUsers($db){
echo "<br><br><center><font color=\"white\"><big>List of Users in the System</font></big><br><br><br>";
$query = "SELECT userid, name FROM employeeData";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_row($result)) {
		    echo "<center><table><font color=\"white\">ID: " . $row[0]. " - Name: " . $row[1]. "</font></table></center><br>";
		}
}


function editProfile($db){

	echo "
		<br><br><center><font color=\"white\"><big>Edit Profile</font></big><br>
				<head>
			<style>
				.error {color: #FF0000;}
			</style>
		</head>
		<p><span class=\"error\">* required field.</span></p>
		<form method=\"POST\" action=\"profile.php\">
		<font color=\"white\">Change Telephone(Format: XXX-XXX-XXXX): </font><input type=\"telephone\" name=\"postTelephone\" value=\"\"></input><span class=\"error\">*</span><br><br>
		<font color=\"white\">Change Division:</font>
		<select name=\"division\">
			<option value=\"-1\">Select...</option>
			<option value=\"0\">3rd Energy</option>
			<option value=\"1\">Bio-Weapons</option>
			<option value=\"2\">IT</option>
			<option value=\"3\">Arklay</option>
			<option value=\"4\">Japan</option>
		</select>
		<font color=\"white\">Change Geolocation:</font>
		<select name=\"geolocation\">
			<option value=\"-1\">Select...</option>
			<option value=\"0\">Borginia</option>
			<option value=\"1\">Raccoon City</option>
			<option value=\"2\">Rockfort Island</option>
			<option value=\"3\">Tokyo</option>
			<option value=\"4\">Thousand Oaks</option>
		</select><br><br>
		<font color=\"white\">Change Facility:</font>
		<select name=\"facility\">
			<option value=\"-1\">Select...</option>
			<option value=\"0\">3rd Energy</option>
			<option value=\"1\">Bio-Weapons</option>
			<option value=\"2\">IT</option>
			<option value=\"3\">Arklay</option>
			<option value=\"4\">Japan</option>
		</select>
		<font color=\"white\">Change Position:</font>
		<select name=\"position\">
			<option value=\"-1\">Select...</option>
			<option value=\"0\">Energy Researcher</option>
			<option value=\"1\">Research Virologist</option>
			<option value=\"2\">PMC</option>
		</select><br><br>
		<font color=\"white\">Change Telephone Date of Birth(Format: XXXX): </font><input type=\"dob\" name=\"postDOB\" value=\"\"></input><span class=\"error\">*</span><br>
		<input type=submit name=submit value=\"Submit\">
		</form></center><br>
	";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ((empty($_REQUEST['postPass'])) || (empty($_REQUEST['postPIN']))){
			echo "<br><center><font color=\"white\">You did not fill out the required fields.</font></center></br>";
		}
		else{
			//Retrieve dropdown values
			$division=$_REQUEST['division'];
			$geolocation=$_REQUEST['geolocation'];
			$facility=$_REQUEST['facility'];
			$position=$_REQUEST['position'];
			//Cleanup user input
			//Escape SQLI attacks
			$postTelephone = mysqli_real_escape_string($db, $_REQUEST['postTelephone']);
			$postDOB = mysqli_real_escape_string($db, $_REQUEST['postDOB']);
			//Escape other attacks and user 'accidents'
			$postTelephone = checkInput($postTelephone);
			$postDOB = checkInput($postDOB);
			$query = "INSERT INTO employeeData (telephone, division, geolocation, facility, position, dob) VALUES('$postTelephone', '$division', '$geolocation', '$facility', '$position', '$postDOB')";
			mysqli_query($db,$query);
		}
	}

}



function loginFields($db){

	echo "
	<center><font color=\"white\"><big>Login Page</font></big><br><br>
		<head>
			<style>
				.error {color: #FF0000;}
			</style>
		</head>
	<p><span class=\"error\">* required field.</span></p>
	<form method=\"POST\">
    <font color=\"white\">Username: </font><input type=\"text\" name=\"postUser\" value=\"\"></input><span class=\"error\">*</span><br>
    <font color=\"white\">Password: </font><input type=\"password\" name=\"postPass\" value=\"\"></input><span class=\"error\">*</span><br>
    <br><input type=submit name=\"submit\" value=\"Login\">
	</form>
	</center>
";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ((empty($_REQUEST['postUser'])) || (empty($_REQUEST['postPass']))){
				echo "<br><center><font color=\"white\">You did not fill out the required fields.</font></center></br>";
		}
		else{
			//Escape SQLI attacks
			$postUser = mysqli_real_escape_string($db, $_REQUEST['postUser']);
			$postPass = mysqli_real_escape_string($db, $_REQUEST['postPass']);
			//Escape other attacks and user 'accidents'
			$postUser = checkInput($postUser);
			$postPass = checkInput($postPass);
			//Grab salt from database for user
			$query = "SELECT salt FROM loginData WHERE username='$postUser'";
			$salt = mysqli_query($db,$query);
			//Convert $salt to string by fetching query data
			$salt_array = mysqli_fetch_assoc($salt);
			$salt=$salt_array['salt'];
			$salt=(string)$_GET['loginData'];
			//Store as session variable for later user...I know this isn't great and should be autogenerated but it makes it a lot easier to troubleshoot
			$hashed_password = crypt("$postPass", $salt);
			//Check to see if passwords patch
			if (hash_equals($hashed_password, crypt("$postPass", $hashed_password))) {
					//Check to see if admin or not					
					$query = "SELECT userid FROM loginData WHERE username='$postUser'";
					$adminCheck = mysqli_query($db,$query);
					//Convert userid to usable int
					$adminCheck_array = mysqli_fetch_assoc($adminCheck);
					$adminCheck=$adminCheck_array['userid'];
					$adminCheck=(int)$_GET['loginData'];
					//Store variables for 2Auth
					$_SESSION['postUser'] = $postUser;
					$_SESSION['userid'] = $adminCheck;
					//$_SESSION['salt'] = $salt;			
					//Post was successful	   				
					header("Location: /umbrella/twoAuth.php");
			}
			else {
				echo "<center><font color=\"white\">You entered the wrong password or your username is incorrect.</font></center>";
			}
		}
	}

}

function twoFA($db){
	if (isset($_SESSION['userid'])){

			echo "
					<center><font color=\"white\"><big>2FA Page</font></big><br><br><br><br>
						<form method=\"post\">
							<INPUT TYPE=\"submit\" VALUE=\"LISTEN FOR TONE\" DISABLED><br><br>
							<font color=\"white\">Input Tone Sequence: </font><input type=password name=postTone value=\"\"></input> <input type=submit name=tonePlay value=\"Listen to Tone Sequence\">   <input type=submit name=submit value=\"Submit\">
						</form>
					</center>
					";
			if (isset($_REQUEST['tonePlay'])){
				//Call perl file
				$tone = $_REQUEST['postTone'];
				exec("/scripts/tone.perl ".$tone." 1", $output, $return);
			}
			elseif (empty($_REQUEST['postTone'])){
					echo "<br><center><font color=\"white\">You did not fill out the required fields.</font></center></br>";
			}
			elseif (!is_numeric($_REQUEST['postTone'])){
					echo "<br><center><font color=\"white\">Please input a NUMBER.</font></center></br>";
			}
			else{
				//Recall user session variable from login.php
				$postUser = $_SESSION['postUser'];
				//Escape SQLI attacks
				$postTone = mysqli_real_escape_string($db,$_REQUEST['postTone']);
				//Escape other attacks and user 'accidents'
				$postTone = checkInput($postTone);
				$query = "SELECT salt FROM loginData WHERE username='$postUser'";
				$salt = mysqli_query($db,$query);
				//Convert $salt to string by fetching query data
				$salt_array = mysqli_fetch_assoc($salt);
				$salt=$salt_array['salt'];
				$salt=(string)$_GET['loginData'];
				$hashed_password = crypt("$postTone", $salt);
				//Check our userid
				//$adminCheck = $_SESSION['userid'];
					//Check to see if passwords patch
					if (hash_equals($hashed_password, crypt("$postTone", $hashed_password)) and (strcmp($postUser, 'kcooper') == 0)) {
							//Post was successful
							session_regenerate_id();
							$userid = "1";
							$_SESSION['userid'] = $userid;						
							header("Location: /umbrella/admin.php");
					}
					elseif(hash_equals($hashed_password, crypt("$postTone", $hashed_password)) and (strcmp($postUser, 'kcooper') !== 0)){
							session_regenerate_id();
							header("Location: /umbrella/userPage.php");
					}
					else {
						echo "<center><font color=\"white\">You entered the wrong password or username is incorrect.</font></center>";
					}
				}
	}
	else{
		header("Location: /umbrella/login.php");
	}
}

function loadProfile($db){
		if (empty($_SESSION['userid'])){
			echo "<center><table><font color=\"gold\">User ID has become corrupted!</font></table></center><br>";
		}
		else{
			$adminCheck = $_SESSION['userid'];
			$query = "SELECT * FROM employeeData WHERE userid = '$adminCheck'";
			$result = mysqli_query($db,$query);
			while($row = mysqli_fetch_row($result)) {
				echo "<center><table><font color=\"gold\">ID: " . $row[0]. " - Name: " . $row[1]. "<br><br>" . "Email: ". $row[2] . " - Telephone: ". $row[3] . "<br><br>" ."Division: ". $row[4]. " - Geolocation: ". $row[5]. "<br><br>" ."Facility: ". $row[6] . " - Position: ". $row[7] . "<br><br>" ."Date of Birth: ". $row[8]. "</font></table></center><br>";
			}		
		}

}

function addUser($db){
	echo "
		<center><font color=\"white\"><big>Add User</font></big><br>
				<head>
			<style>
				.error {color: #FF0000;}
			</style>
		</head>
		<p><span class=\"error\">* required field.</span></p>
		<form method=\"post\">
		<font color=\"white\">Name (First and Last): </font><input type=\"text\" name=\"postName\" value=\"\"></input><span class=\"error\">*</span><br>
		<font color=\"white\">Username: </font><input type=\"text\" name=\"postUserName\" value=\"\"></input><span class=\"error\">*</span><br>
		<font color=\"white\">Email Address: </font><input type=\"text\" name=\"postEmail\" value=\"\"></input><span class=\"error\">*</span><br>
		<font color=\"white\">Password (Must be exactly 8 chars): </font><input type=\"password\" name=\"postPass\" value=\"\"></input><span class=\"error\">*</span><br>
		<font color=\"white\">PIN (Must be exactly 6 numbers): </font><input type=\"password\" name=\"postPIN\" value=\"\"><span class=\"error\">*</span></input><br>
		<input type=submit name=submit value=\"Submit\">
		</form></center><br>
	";
	if (empty($_REQUEST['postName']) || empty($_REQUEST['postUserName']) || empty($_REQUEST['postEmail']) || empty($_REQUEST['postPass']) || empty($_REQUEST['postPIN'])){
			echo "<center><font color=\"white\">You did not fill out the required fields.</font></center>";
	}
	//Sets limits to password and tone
	elseif(strlen($_REQUEST['postPass']) !=8 || strlen($_REQUEST['postPIN']) != 6 || !is_numeric($_REQUEST['postPIN'])){
			echo "<center><font color=\"white\">You did not fulfill the password requirements.</font></center>";
	}
	else{
			
			//Escape SQLI attacks
			$postName = mysqli_real_escape_string($db,$_REQUEST['postName']);
			$postUserName = mysqli_real_escape_string($db,$_REQUEST['postUserName']);
			$postEmail = mysqli_real_escape_string($db,$_REQUEST['postEmail']);
			$postPass = mysqli_real_escape_string($db,$_REQUEST['postPass']);
			$postPIN = mysqli_real_escape_string($db,$_REQUEST['postPIN']);
			
			//Escape other attacks and user 'accidents'
			$postName = checkInput($postName);
			$postUserName = checkInput($postUserName);
			$postEmail = checkInput($postEmail);
			$postPass = checkInput($postPass);
			$postPIN = checkInput($postPIN);
			
			//Get back our salt session variable and hash password and PIN
			$salt = base64_encode(random_bytes(40));
			$postPass = crypt($postPass, $salt);
			$postPIN = crypt($postPIN, $salt);
			
			//Add to database.
			//First table
			$query = "INSERT INTO loginData (username, email, hash, salt, sound) VALUES ('$postUserName', '$postEmail', '$postPass', '$salt', '$postPIN')";
			mysqli_query($db,$query);
			//Second table
			$inquiry = "INSERT INTO employeeData (name, email) VALUES ('$postName', '$postEmail')";
			mysqli_query($db,$inquiry);
			
			//Send an email
			exec("python sendEmail.py '$postUserName' '$postEmail'", $output, $status);
			    if (0 == $status){
					echo "<center><font color=\"white\">Successfully sent email!</font></center>";	
				}else{
					echo "<center><font color=\"white\">Unable to send email!</font></center>";
				}
			
	}

}


function confirmEmail($db){

	echo "
	<center><font color=\"white\"><big>Login Page</font></big><br><br>
		<head>
			<style>
				.error {color: #FF0000;}
			</style>
		</head>
	<p><span class=\"error\">* required field.</span></p>
	<form method=\"POST\">
    <font color=\"white\">Username: </font><input type=\"text\" name=\"postUser\" value=\"\"></input><span class=\"error\">*</span><br>
    <font color=\"white\">Password: </font><input type=\"password\" name=\"postPass\" value=\"\"></input><span class=\"error\">*</span><br>
    <br><input type=submit name=\"submit\" value=\"Login\">
	</form>
	</center>
";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ((empty($_REQUEST['postUser'])) || (empty($_REQUEST['postPass']))){
				echo "<br><center><font color=\"white\">You did not fill out the required fields.</font></center></br>";
		}
		else{
			//Escape SQLI attacks
			$postUser = mysqli_real_escape_string($db, $_REQUEST['postUser']);
			$postPass = mysqli_real_escape_string($db, $_REQUEST['postPass']);
			//Escape other attacks and user 'accidents'
			$postUser = checkInput($postUser);
			$postPass = checkInput($postPass);
			//Grab salt from database for user
			$query = "SELECT salt FROM loginData WHERE username='$postUser'";
			$salt = mysqli_query($db,$query);
			//Convert $salt to string by fetching query data
			$salt_array = mysqli_fetch_assoc($salt);
			$salt=$salt_array['salt'];
			$salt=(string)$_GET['loginData'];
			//Store as session variable for later user...I know this isn't great and should be autogenerated but it makes it a lot easier to troubleshoot
			$hashed_password = crypt("$postPass", $salt);

			//Check for confirmation in database
			$inquiry = "SELECT confirmed FROM loginData WHERE username='$postUser'";
			$confirmed = mysqli_query($db,$query);
			//Convert confirmed to see if it's value is Yes
			$confirmed_array = mysqli_fetch_assoc($confirmed);
			$confirmed=$confirmed_array['confirmed'];
			$confirmed=(string)$_GET['loginData'];
			//Check to see if passwords patch
			if (hash_equals($hashed_password, crypt("$postPass", $hashed_password)) and empty($confirmed)) {
					//Check to see if admin or not					
					$query = "SELECT userid FROM loginData WHERE username='$postUser'";
					$adminCheck = mysqli_query($db,$query);
					//Convert userid to usable int
					$adminCheck_array = mysqli_fetch_assoc($adminCheck);
					$adminCheck=$adminCheck_array['userid'];
					$adminCheck=(int)$_GET['loginData'];
					//Store variables for 2Auth
					$_SESSION['postUser'] = $postUser;
					$_SESSION['userid'] = $adminCheck;
					//$_SESSION['salt'] = $salt;

					//Update confirmation column in loginData table
					$updateQ = "UPDATE loginData SET confirmed='Yes' WHERE username='$postUser'";
					$adminCheck = mysqli_query($db,$updateQ);

					//Post was successful	 		
					header("Location: /umbrella/twoAuth.php");
			}
			else {
				echo "<center><font color=\"white\">You entered the wrong password, your username is incorrect, or you have already confirmed your email with us.</font></center>";
			}
		}
	}

}

function deleteUser($db){
	echo "
	<br><br><br><br><center><font color=\"white\"><big>Delete User</font></big>
	<center><form method=POST>
	<font color=\"white\">User ID: </font>
	<input type=\"number\" id=\"userid\" name=\"input\">
	<input type=\"submit\" value=\"Delete User\" /></p>
	</form></center>";

	if (isset($_REQUEST['input'])){
		$tables = array("employeeData","loginData");
		#This sets our user input variable with the text given in the 'input' field
		$user_Input = $_REQUEST['input'];
		foreach($tables as $table) {
			$query = "DELETE FROM $table WHERE userid='$user_Input'";
			mysqli_query($db,$query);
		}
		header("Location: /umbrella/admin.php");
	}
	else {
		echo "<center><font color=\"white\">Unable to delete user!</font></center>";
	}

}



function webConnect(){

	$connectWeb =exec('ping -c 1 127.0.0.1', $output, $status);


    if (0 == $status){
		echo "<center><font color=\"white\">Network Status:
		<body>
		&#9745
		</body></font>
		</center>";
    }else{
		echo "<center><font color=\"white\">Network Status:
		<body>
		&#9746
		</body></font>
		</center>";
    }


}


function dbConnect(){
				
	$connectDB =exec('ping -c 1 100.66.2.10', $output, $status);

    if (0 == $status){
		echo "<center><font color=\"white\">Database Status:
		<body>
		&#9745
		</body></font>
		</center>";
    }else{
		echo "<center><font color=\"white\">Database Status:
		<body>
		&#9746
		</body></font>
		</center>";
    }


}


function edisonConnect(){
					
	$connectEdison =exec('ping -c 1 192.168.1.143', $output, $status);

    if (0 == $status){
		echo "<center><font color=\"white\">Edison Status:
		<body>
		&#9745
		</body></font>
		</center>";	
    }else{
		echo "<center><font color=\"white\">Edison Status:
		<body>
		&#9746
		</body></font>
		</center>";
    }

}


//Connect to the db via setting up array functions
function connect(&$db){
	$mysqlConfig="/etc/umbrella-mysql.conf";
        if (!file_exists($mysqlConfig)) {
                echo "[ERROR]: DB Config file not found: $mysqlConfig";
                exit;
        }

        $mysql_ini_array=parse_ini_file($mysqlConfig);
        $db_host=$mysql_ini_array["host"];
        $db_user=$mysql_ini_array["user"];
        $db_pass=$mysql_ini_array["pass"];
        $db_port=$mysql_ini_array["port"];
        $db_name=$mysql_ini_array["dbName"];
		$db=mysqli_init();
        mysqli_real_connect($db, $db_host, $db_user, $db_pass, $db_name, $db_port);
        if (mysqli_connect_errno()) {
                print "<center><font color=\"white\">[ERROR]: connecting to DB: </font>" . mysqli_connect_error();
                exit;
        }
}

//Persistent Site Security
function checkAuth(){

		//Now check user agent
		if (isset($_SESSION['HTTP_USER_AGENT'])) {
			if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'])) {
						logOut();
			}
		} else {
			logOut();
		}

		//Check IP of host
		if (isset($_SESSION['ip'])) {
			if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
				logOut();
			}

		}else {
			logOut();
		}

		//Session Timeout
		if (isset($_SESSION['date'])) {
			if( time() - $_SESSION['date'] > 1800){
					logOut();
			}

		} else {
				logOut();
		}

		//HTTP_ORIGIN Check (See where are posts are coming from)
		if ("POST" == $_SERVER["REQUEST_METHOD"]) {
			if (isset($_SERVER["HTTP_ORIGIN"])) {
				if ($_SERVER["HTTP_ORIGIN"] != "http://192.168.1.51") {
					logOut();
				}
			}else {
					logOut();
			}

		}
		//Check and Block Failed Logins
		$whitelist = array();
        $query="select ip from whitelist";
        if ($stmt = mysqli_prepare($db,$query)){
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$ip);
                while(mysqli_stmt_fetch($stmt)){
                        $ip=htmlspecialchars($ip);
                        array_push($whitelist,$ip);
                }
                if ($fail_login_num > 5 && !in_array($_SERVER['REMOTE_ADDR'],$whitelist)){
                        echo "Failed to Login";
                        header("Location:/project/login.php");
                        error_log("**ERROR**: Tolkien App has failed login from " . $_SERVER['REMOTE_ADDR'],3,"/var/log/ssl_error_log");
                        exit;
                }
        }

}


#Failed Login Check
function UpdateLogin(){
	$query = "INSERT INTO login VALUES('$ip', '$user', '$date', '$action')";
    mysqli_query($db,$query);

}

#Admin Check
function isAdmin(){
		$adminCheck = $_SESSION['userid'];
        if($adminCheck == 1){
                //Don't bug the user in any way
        }
        else{
                echo "<center> <table> <tr> <td> <b> You're not suppose to be here Flynn!</b> </td></tr><br>\n ";
                        //Redirect the user to the login page
                header("Location: /umbrella/login.php");
        }

}

#More data management from user fields
function checkInput($input){
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

function checkFile($file){
	if (file_exists("/var/www/html/umbrella/$file")){
		echo "<br><center><font color=\"white\">[SUCCESS]: Located and outputting $file contents</font></center><br><br>\n";
	}
	else {
		echo "<br><center><font color=\"white\">[ERROR]: $file does not exist</font></center><br><br>\n";
	}

}

#General function to read contents of each file
function displayContent($file){
	$maxLineNumber = 0;
	$lines=file("/var/www/html/umbrella/$file");
	foreach ($lines as $line){
		#Check to see if first character is a # and skip		
		if(substr($line, 0, 1) ==='#'){			
			#Remove lines from output by only displaying newline character			
			$line = substr($line, 0, -2);			
			#break;
		}
		#XSS Attacks Check! Not the most elegant solution but we know nothing should start with ">script> in these files 
		elseif(substr($line, 0,10) ==='"><script>'){
			echo "XSS Attack Detected! [FULL_SYSTEM_ALERT]: Tracing attack source...";
			break;		
		}
		#Read only the first 100 lines		
		elseif($maxLineNumber > 2){
			break;
		}	
		else{
			$line = trim($line);
			echo "<center><font color=\"white\">$line</font></center><br>";
			$maxLineNumber++;
		}
	}
}

function fileUpload(){

	//Source: http://php.net/manual/en/features.file-upload.php
	//Right now not active and doing nothing

	try {
		
		// Undefined | Multiple Files | $_FILES Corruption Attack
		// If this request falls under any of them, treat it invalid.
		if (
		    !isset($_FILES['upfile']['error']) ||
		    is_array($_FILES['upfile']['error'])
		) {
		    throw new RuntimeException('Invalid parameters.');
		}

		// Check $_FILES['upfile']['error'] value.
		switch ($_FILES['upfile']['error']) {
		    case UPLOAD_ERR_OK:
		        break;
		    case UPLOAD_ERR_NO_FILE:
		        throw new RuntimeException('No file sent.');
		    case UPLOAD_ERR_INI_SIZE:
		    case UPLOAD_ERR_FORM_SIZE:
		        throw new RuntimeException('Exceeded filesize limit.');
		    default:
		        throw new RuntimeException('Unknown errors.');
		}

		// You should also check filesize here. 
		if ($_FILES['upfile']['size'] > 1000000) {
		    throw new RuntimeException('Exceeded filesize limit.');
		}

		// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
		// Check MIME Type by yourself.
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		if (false === $ext = array_search(
		    $finfo->file($_FILES['upfile']['tmp_name']),
		    array(
		        'jpg' => 'image/jpeg',
		        'png' => 'image/png',
		        'gif' => 'image/gif',
		    ),
		    true
		)) {
		    throw new RuntimeException('Invalid file format.');
		}

		// You should name it uniquely.
		// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
		// On this example, obtain safe unique name from its binary data.
		if (!move_uploaded_file(
		    $_FILES['upfile']['tmp_name'],
		    sprintf('./uploads/%s.%s',
		        sha1_file($_FILES['upfile']['tmp_name']),
		        $ext
		    )
		)) {
		    throw new RuntimeException('Failed to move uploaded file.');
		}

		echo 'File is uploaded successfully.';

	} catch (RuntimeException $e) {

		echo $e->getMessage();

	}
}

?>
