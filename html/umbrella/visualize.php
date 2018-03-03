<?php
session_start();
session_regenerate_id();
/**
 *
 * @author Shani <support@chartphp.com> - http://www.chartphp.com
 * @version 1.2.3
 * @license: see license.txt included in package
 */
include_once('/var/www/html/umbrella/headLanding.php');
include("../chartphp/lib/inc/chartphp_dist.php");

#Only admin can see visualization page
#isAdmin();
//Don't know why the SESSION is getting lost...
if (empty($_SESSION['userid'])){
			echo "<center><table><font color=\"gold\">User ID has become corrupted!</font></table></center><br>";
		}
		else{
					
			$p = new chartphp();

			$p->data = array(array(array("0",2),array("1",6),array("2",2),array("3",4),array("4",5),array("5",4),array("6",7),array("7",3),array("8",1),array("9",6)));
			$p->chart_type = "bar";

			// Common Options
			$p->title = "Tone Frequency Chart";
			$p->xlabel = "Tones (Numbers Rep.)";
			$p->ylabel = "Occurences";
			$p->export = false;
			$p->options["legend"]["show"] = true;
			$p->series_label = array('Q1','Q2','Q3'); 

			$out = $p->render('c1');
		}
?>
<!DOCTYPE html>
<html>
    <head><center>
        <script src="../chartphp/lib/js/jquery.min.js"></script>
        <script src="../chartphp/lib/js/chartphp.js"></script>
        <link rel="stylesheet" href="../../lib/js/chartphp.css">
    </center></head>
    <body><center>
        <div style="width:50%; min-width:500px;">
            <?php echo $out; ?>
        </div></center>
    </body>
	<center><button type="button" onclick="history.back();">Back</button></center>
</html>
