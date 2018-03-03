<?php
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

        $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
        if (!$db) {
                print "[ERROR]: connecting to DB: " . mysqli_connect_error();
                exit;
        }

$query = "SELECT id, name FROM testData";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_row($result)) {
			echo "<center><font color=\"black\">Hello!</font>";
		    echo "<center><table><font color=\"black\">id: " . $row[0]. " - Name: " . $row[1]. "</font></table></center><br>";
		}

?>
