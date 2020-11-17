<!doctype html>
<html><!-- InstanceBegin template="/Templates/Template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<?php include ('/home/witchcon/public_html/thisyear.php'); ?>	
<?php include ('/home/witchcon/public_html/databasevalues.php'); ?>
	
<!-- InstanceBeginEditable name="doctitle" -->
<title>WitchCon Online 2021 - The World's Largest Online Magical Conference in <?php echo $thisyear; ?>!</title>
	

<?php 
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

?>
	
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<!-- InstanceBeginEditable name="head" -->
	
<meta property="og:image" content="http://witchcon.com/images/EventBriteBG.jpg" />
<meta property="og:title" content="WitchCon Online 2021 - The World's Largest Online Magical Conference in <?php echo $thisyear; ?>!" />
<meta property="og:site_name" content="WitchCon"/>
<meta property="og:description" content="On March <?php echo $dayone; ?> to <?php echo $daythree; ?>, <?php echo $thisyear ?>, Brian Cain, Christian Day and the HEX Education Network present WitchCon Online 2021: the largest online magical conference in the world, devoted to Witchcraft, Conjure, and Rootwork, where you can connect with leading experts on the arts of magic from across the globe!" />
	
<?php $page = "schedule"; ?>
	
<?php $numberphotos = 10; ?>
	
<!-- InstanceEndEditable -->

</head>

<body>


<div class="mainbox">
	
	<div class="herobox"> <a href="/"><img src="images/logo.png" class="logo" alt=""/></a>

		<div class="herotext"><h2 class="heroh2">Bring the Magic to You!</h2><p>March <?php echo $dayone; ?> to <?php echo $daythree; ?>, <?php echo $thisyear ?>, join the largest online magical conference in the world, featuring one hundred Witches and Conjurers coming to you by livestream video from across the globe!</p></div>
	</div>
	


	<div class="navbox">
		<ul class="nav"><li class="button buttonregistration"><a href="registration.php" class="navlink">Registration</a></li><li class="button buttonpresenters"><a href="presenters.php" class="navlink">Presenters</a></li><li class="button buttonschedule"><a href="schedule.php" class="navlink">Schedule</a></li><li class="button buttonvendors"><a href="vendors.php" class="navlink">Vendors</a></li></ul>
	</div>



	<div class="contentbox">
		<div class="maintext">

<!-- InstanceBeginEditable name="CONTENT" -->
			
<h1><?php echo $thisyear ?> Schedule</h1>
	

	
<?php
	
// get variables 
	
$updatewitch = $_REQUEST['updatewitch'];
$adminwitch = $_REQUEST['adminwitch'];
$workshop = $_REQUEST['workshop'];
$location = $_REQUEST['location'];
			
// define variables    
	
if ($updatewitch == "yes") {
    
	include '/home/witchcon/public_html/databasevalues.php';
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	list($photonamekey, $workshopnumber) = explode("_", $workshop, 2);
	
	// test for duplicates!
	$sql2 = "SELECT Location, PhotoNameKey, WorkshopNumber FROM $table2 WHERE location!='$location'";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
		// output data of each row
		while($row2 = $result2->fetch_assoc()) {

			if (($row2["PhotoNameKey"] == $photonamekey) && ($row2["WorkshopNumber"] == $workshopnumber) && ($row2["WorkshopNumber"] != "")) {
				$duplicateentry = "true";
				$showduplicate = $location . "_" . $duplicateentry;
				
				$showduplicatedlisting = $row2["Location"]  . "_" . $duplicateentry;	
			}
		}

	} else {
		// leave blank
	}
	
	// update 
	if ($duplicateentry != "true") {
		$sql3 = "UPDATE $table2 SET PhotoNameKey='$photonamekey', WorkshopNumber='$workshopnumber' WHERE location='$location'";

		if ($conn->query($sql3) === TRUE) {
			$showupdated = $location;
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}
	
}



// put any admin functions here!

function adminGetCurrent($celllocation, $showduplicatehdr, $duplicatedlisting, $showupdatedhdr) {
	
	include '/home/witchcon/public_html/databasevalues.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
    
	$sql2 = "SELECT Location, PhotoNameKey, WorkshopNumber FROM $table2 WHERE Location='$celllocation'";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
		// output data of each row
		while($row2 = $result2->fetch_assoc()) {

			$getphotonamekey = $row2["PhotoNameKey"];

			$getworkshopnumber = $row2["WorkshopNumber"];	
		}

	} else {
		echo "0 results";
	}
	
	$sql = "SELECT ID, PresentersName, PhotoNameKey, WorkshopTitleOne FROM $table1 ORDER BY PhotoNameKey";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		
		$testduplicatepicklist = $celllocation . "_true";
		if ($showduplicatehdr == $testduplicatepicklist) {
			echo "<a name=\"originallisting\"><b><font color=red>Attempted Duplicate Entry. Choose Something Else.</b><br><a href=\"#duplicatedlisting\">[see existing entry]</a></font><br>";
		}
		
		if ($duplicatedlisting == $testduplicatepicklist) {
			echo "<a name=\"duplicatedlisting\"><b><font color=red>You have Attempted to Duplicate This Entry</b><br><a href=\"#originallisting\">[see attempted duplicate]</a></font><br>";
		}
		
		if ($showupdatedhdr == $celllocation) {
			echo "<b><font color=green>Entry Updated!</font></b><br>";
		}
		
		// Preliminary form
		echo "<form action=\"schedule.php?adminwitch=yes#" . $celllocation . "\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"updatewitch\" value=\"yes\">";
		echo "<input type=\"hidden\" name=\"adminwitch\" value=\"yes\">";
		echo "<input type=\"hidden\" name=\"location\" value=\"$celllocation\">";
		echo "<select style=\"width: 450px;\" onchange=\"this.form.submit()\" name=\"workshop\">";
        echo "<option value=\"\">Choose a Workshop for this Timeslot and Room</option>";
		
		
			// output data of each row
			while($row = $result->fetch_assoc()) {
                
                
                // this two-line snippet gathers all the presenter name keys for the panelist list. 
                $i++;
                $panelistarray[$i] = $row["PresentersName"];

				if ($getphotonamekey == $row["PhotoNameKey"]) {
                    
                    // this  snippet gets the workshop title for the panelist list.
                    $gettheworkshoptitle = "WorkshopTitle" . $getworkshopnumber;
                    
					if ($getworkshopnumber == "One") { $selectedOne = "SELECTED"; };
					if ($getworkshopnumber == "Two") { $selectedTwo = "SELECTED"; };
					if ($getworkshopnumber == "Three") { $selectedThree = "SELECTED"; };
					if ($getworkshopnumber == "Four") { $selectedFour = "SELECTED"; };
				}
				if ($row["WillYouNeedaProjectorandScreenforWorkshopOne"] == "True") { $projectorone = " - PROJECTOR"; };
				if ($row["WillYouNeedaProjectorandScreenforWorkshopTwo"] == "True") { $projectortwo = " - PROJECTOR"; };
				if ($row["WillYouNeedaPro
jectorandScreenforWorkshopThree"] == "True") { $projectorthree = " - PROJECTOR"; };
				
				if ($row["WorkshopTitleOne"]) { echo "<option " . $selectedOne . " value=\"" . $row["PhotoNameKey"] . "_One\">" . $row["PhotoNameKey"]. " - " . $row["WorkshopTitleOne"] . $projectorone . "</option>"; }; 
				if ($row["WorkshopTitleTwo"]) { echo  "<option " . $selectedTwo . " value=\"" . $row["PhotoNameKey"] . "_Two\">" . $row["PhotoNameKey"]. " - " . $row["WorkshopTitleTwo"] . $projectortwo . "</option>"; }; 
				if ($row["WorkshopTitleThree"]) { echo  "<option " . $selectedThree . " value=\"" . $row["PhotoNameKey"] . "_Three\">" . $row["PhotoNameKey"]. " - " . $row["WorkshopTitleThree"] . $projectorthree . "</option>"; }; 
				if ($row["WorkshopTitleFour"]) { echo  "<option " . $selectedFour . " value=\"" . $row["PhotoNameKey"] . "_Four\">" . $row["PhotoNameKey"]. " - " . $row["WorkshopTitleFour"] . "</option>"; };

				$selectedOne = "";
				$selectedTwo = "";
				$selectedThree = "";
				$selectedFour = "";
				$projectorone = "";
				$projectortwo = "";
				$projectorthree = "";
                


			}
		echo "</select>";
		echo "</form>";
        		
	} else {
		// leave blank
	}

}
    
// end admin functions


function GetCurrent($celllocation) {

	include '/home/witchcon/public_html/databasevalues.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql2 = "SELECT Location, PhotoNameKey, WorkshopNumber FROM $table2 WHERE Location='$celllocation'";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
		// output data of each row
		while($row2 = $result2->fetch_assoc()) {

			$publicgetphotonamekey = $row2["PhotoNameKey"];

			$publicgetworkshopnumber = $row2["WorkshopNumber"];	
						
			$publicwhichworkshop = "WorkshopTitle" . $publicgetworkshopnumber;
                        
			$publicneedsprojector = "WillYouNeedaProjectorandScreenforWorkshop" . $publicgetworkshopnumber;
			
			if (!$publicgetphotonamekey) { 
				// keep blank or maybe put To Be Announced though that will screw up panel number four.
                echo "Workshop to be announced.";
                
                // Find out WHY this would screw up panel number four!
			}
		}

	} else {
		// blank 
	}
    	
	// show the link for the current entry!
	$sql = "SELECT PresentersName, ShowPresenterLink, $publicwhichworkshop, $publicneedsprojector FROM $table1 WHERE PhotoNameKey='$publicgetphotonamekey'";    

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
                      
		// output data of each row
		while($row = $result->fetch_assoc()) {
            
			if ($row["ShowPresenterLink"] != "False") {
                
                if ($publicgetphotonamekey != "tour") {
        
    				echo "<i><a href=\"presenter.php?presenter=" . $publicgetphotonamekey . "\">" . $row["PresentersName"] . "</a></i> — ";
                }
			} elseif ($publicgetphotonamekey != "tour") {
				echo "<i>" . $row["PresentersName"] . "</i> — ";
			}
			
			echo "<b><a href=\"workshop.php?presenter=" . $publicgetphotonamekey . "&workshop=" . $publicgetworkshopnumber . "&location=" . $celllocation . "\">" . $row["$publicwhichworkshop"] . "</a></b>";
            
            if (($publicgetphotonamekey == "tour") and ($row["$publicwhichworkshop"] == "French Quarter Shop & Pub Crawl")) {
                
                echo "<br>With <i><a href=\"presenter.php?presenter=briancain\">Brian Cain</a> and <a href=\"presenter.php?presenter=christianday\">Christian Day</a></i>";
            }
            
			if ($row["$publicneedsprojector"] == "True") {
				echo " " . $projectoricon;
			}
            
		}

            
	} else {
		// leave blank
	}
    
    // begin show the panelists
    if ($publicgetphotonamekey == "paneldiscussion") {
        
        $sql4 = "SELECT Panelist1, Panelist2, Panelist3, Panelist4, Panelist5, Panelist6 FROM $table4 WHERE PanelNumber='$publicgetworkshopnumber'";
        
        $result4 = $conn->query($sql4);

        if ($result4->num_rows > 0) {
            // output data of each row

            while($row4 = $result4->fetch_assoc()) {
                $panelistpiclist[1] = $row4[Panelist1];
                $panelistpiclist[2] = $row4[Panelist2];
                $panelistpiclist[3] = $row4[Panelist3];
                $panelistpiclist[4] = $row4[Panelist4];
                $panelistpiclist[5] = $row4[Panelist5];
                $panelistpiclist[6] = $row4[Panelist6];
            }

        } else {
            echo "0 results";
        }            
        
        echo "<br>Featuring ";
        
                
        $countphotokeysforpanelists = 1;        
        while ($countphotokeysforpanelists < 7) {
                        
            // get rid of  ' 
            $panelistpiclist[$countphotokeysforpanelists] = str_replace("#", "'", $panelistpiclist[$countphotokeysforpanelists]);
            
            // get photo code.
            $panelistphotocode[$countphotokeysforpanelists] = str_replace(" ", "", $panelistpiclist[$countphotokeysforpanelists]);
            $panelistphotocode[$countphotokeysforpanelists] = str_replace("'", "", $panelistphotocode[$countphotokeysforpanelists]);
            $panelistphotocode[$countphotokeysforpanelists] = str_replace("’", "", $panelistphotocode[$countphotokeysforpanelists]);
            $panelistphotocode[$countphotokeysforpanelists] = strtolower($panelistphotocode[$countphotokeysforpanelists]);
                        
            if ($panelistphotocode[$countphotokeysforpanelists]) {
                
                // test for the next one so as to correctly use ", and"
                $testnextone = $countphotokeysforpanelists +1;
                $testnextone = $panelistpiclist[$testnextone];
                
                if (!$testnextone) {
                    echo "and ";
                }
                
                echo "<a href=\"presenter.php?presenter=" . $panelistphotocode[$countphotokeysforpanelists] . "\">" . $panelistpiclist[$countphotokeysforpanelists] . "</a>";
                
                if ($testnextone) {
                    echo ", ";
                } else {
                    echo "";
                }
            }
            
            
            $countphotokeysforpanelists++;
        }


    }
    // End show the panelists
    



} // end function GetCurrent

	
?>
<p>HexFest has gathered Witches, rootworkers, and other magical teachers from within New Orleans and around the world to offer their time-honored wisdom. <a href="presenters.php">Featured presenters</a> and <a href="vendors.php">vendors</a> for <?php echo $thisyear ?> hail from across the spectrum of Witchcraft and magic. Our <a href="vendors.php">Vending Ballroom</a> is open from 9am to 7pm on Saturday, March <?php echo $daytwo ?><sup>th</sup> and 9am to 4pm on Sunday, March <?php echo $daythree ?><sup>th</sup>. Browse our schedule below and click on the name of the workshop for complete details. Each workshop  is first come, first serve; hurry to ensure your spot!
	
<h2>Friday, March <?php echo $dayone . ", " . $thisyear ?></h2>
<div class="schedulerow">
<div class="scheduletime">5:30pm Ritual</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><p><a name=""></a><strong class="scheduleroom">Creole Queen</strong><br>
<strong><a href="riverboat.php">Riverboat Ritual</a><br>
1 Poydras Street Behind the Hilton</strong> <a href="https://www.google.com/maps/dir/Bourbon+Orleans+Hotel,+717+Orleans+Street,+New+Orleans,+LA+70116/29.9485833,-90.0621944/@29.9530446,-90.0688336,16z/data=!3m1!4b1!4m9!4m8!1m5!1m1!1s0x8620a611c56f68bb:0x56736b4c84d02ba1!2m2!1d-90.0646667!2d29.9587535!1m0!3e2" class="roommap">[<img src="images/directionsicon.gif" width="12" height="12" style="vertical-align:auto; margin-right:3px; margin-left:2px; border:none;">map+directions]</a><br>
Join us dockside at the Creole Queen for our Riverboat Ritual. Meet at the HexFest table alongside the boat to get your boarding pass. We board promptly at 6 pm so don’t be late! When on-board, visit any of the dining rooms to secure your seat and mingle with presenters and guests as we cruise down the Mississippi. Buffet dinner is served at 6:15 pm, followed by ritual and drumming on the covered roof deck until 9 pm!</p></td>
</tr>
</tbody>
</table>
</div>
</div>

<br>
<h2>Saturday, March <?php echo $daytwo . ", " . $thisyear ?></h2>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">9:00am Workshops</div>
 <div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sat_AM_0900_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_0900_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_0900_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_AM_0900_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_0900_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_0900_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_AM_0900_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_0900_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_0900_Joseph"); ?>
</tr>
<tr>
<td><a name="Sat_AM_0900_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_0900_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_0900_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_AM_0900_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_0900_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_0900_Cottage2"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column schedulebreak">10:15am &mdash; Half Hour Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">10:45am Workshops</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sat_AM_1045_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_1045_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_1045_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_AM_1045_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_1045_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_1045_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_AM_1045_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_1045_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_1045_Joseph"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_AM_1045_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_1045_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_1045_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_AM_1045_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_AM_1045_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_AM_1045_Cottage2"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column schedulebreak">12:00pm &mdash; Hour and a Half Lunch Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">1:30pm Workshops</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sat_PM_0130_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0130_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0130_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0130_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0130_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0130_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0130_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0130_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0130_Joseph"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0130_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0130_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0130_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0130_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0130_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0130_Cottage2"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>
	
<div class="schedulerow" style="margin-top: 10px !important;">
<div class="schedule-left-column scheduletime">1:30pm Tour</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sat_PM_0130_Lobby"></a><strong class="scheduleroom">Bourbon Orleans Hotel Lobby</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0130_Lobby",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0130_Lobby"); ?></td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column schedulebreak">2:45pm &mdash; Half Hour Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">3:15pm Workshops</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sat_PM_0315_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0315_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0315_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0315_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0315_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0315_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0315_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0315_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0315_Joseph"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0315_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong><a> [map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0315_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0315_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0315_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a>[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0315_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0315_Cottage2"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column schedulebreak">4:30pm &mdash; Half Hour Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">5:00pm Workshops</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sat_PM_0500_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong><a>[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0500_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0500_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0500_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0500_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0500_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0500_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0500_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0500_Joseph"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0500_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0500_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0500_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sat_PM_0500_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0500_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0500_Cottage2"); ?>
</td>
</tr>
<tr>
	<td><a name="Sat_PM_0500_Corner"></a><strong class="scheduleroom">Bourbon Orleans Hotel Lobby</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0500_Lobby",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0500_Lobby"); ?>
</td>
	

</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column schedulebreak">6:30pm &mdash; 1 Hour, 45 Minute Dinner Break<br>
<span class="schedulebreaksub">(See <a href="localguide.php">local guide</a> for options. Reservations recommended!)</span></div>
</div>


	
<div class="schedulerow" style="margin-top: 10px !important;">
<div class="schedule-left-column scheduletime">8:00pm Event</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sat_PM_0800_Courtyard"></a><strong class="scheduleroom">Saint Ann Courtyard</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0800_Courtyard",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0800_Courtyard"); ?>
</td>
</tr>
</tbody>
</table>
</div>

</div>
<div class="schedulerow" style="margin-top: 10px !important;">
<div class="schedule-left-column scheduletime">8:00pm Tour</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sat_PM_0800_Lobby"></a><strong class="scheduleroom">Bourbon Orleans Hotel Lobby</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat_PM_0800_Lobby",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat_PM_0800_Lobby"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<br>
<h2>Sunday, March <?php echo $daythree . ", " . $thisyear ?></h2>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">9:00am Workshops</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sun_AM_0900_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_0900_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_0900_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_AM_0900_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_0900_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_0900_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_AM_0900_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_0900_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_0900_Joseph"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_AM_0900_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_0900_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_0900_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_AM_0900_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_0900_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_0900_Cottage2"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column schedulebreak">10:15am &mdash; Half Hour Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">10:45am Workshops</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sun_AM_1045_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_1045_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_1045_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_AM_1045_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_1045_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_1045_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_AM_1045_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_1045_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_1045_Joseph"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_AM_1045_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_1045_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_1045_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_AM_1045_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_AM_1045_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_AM_1045_Cottage2"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column schedulebreak">12:00pm &mdash; Hour and a Half Lunch Break</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">1:30pm Workshops</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sun_PM_0130_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0130_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0130_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0130_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0130_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0130_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0130_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0130_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0130_Joseph"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0130_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0130_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0130_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0130_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0130_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0130_Cottage2"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column schedulebreak">2:45pm &mdash; Half Hour Break</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">3:15pm Workshops</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sun_PM_0315_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0315_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0315_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0315_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0315_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0315_Mary2"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0315_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0315_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0315_Joseph"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0315_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0315_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0315_Cottage1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0315_Cottage2"></a><strong class="scheduleroom">Saint Ann Cottage 2 </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0315_Cottage2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0315_Cottage2"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column schedulebreak">4:30pm &mdash; Half Hour Break</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">5:00pm Panels</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sun_PM_0500_Mary1"></a><strong class="scheduleroom">Saint Mary Salon 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0500_Mary1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0500_Mary1"); ?>
</td>
</tr>
<tr>
<td><a name="Sun_PM_0500_Mary2"></a><strong class="scheduleroom">Saint Mary Salon 2</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0500_Mary2",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0500_Mary2"); ?>
</td>
</tr>
</tr>
<tr>
<td><a name="Sun_PM_0500_Joseph"></a><strong class="scheduleroom">Saint Joseph Salon </strong><a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0500_Joseph",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0500_Joseph"); ?>
</td>
</tr>
</tr>
<tr>
<td><a name="Sun_PM_0500_Cottage1"></a><strong class="scheduleroom">Saint Ann Cottage 1</strong> <a href="#map" class="roommap">[map]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0500_Cottage1",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0500_Cottage1"); ?>
</td>
</tr>
</tbody>
</table>
<div class="schedulerow" style="margin-top: 10px !important;">
<div class="schedule-left-column scheduletime">6:30pm Ritual</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sun_PM_0630_Ballroom"></a><strong class="scheduleroom">Orleans Ballroom</strong><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0630_Ballroom",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0630_Ballroom"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="schedulerow" style="margin-top: 10px !important;">
<div class="schedule-left-column scheduletime">8:00pm Event</div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
<td><a name="Sun_PM_0800_Hex"></a><strong class="scheduleroom">Hex: Old World Witchery </strong><a href="https://www.google.com/maps/dir/Bourbon+Orleans+Hotel,+717+Orleans+St,+New+Orleans,+LA+70116/Hex,+Decatur+Street,+New+Orleans,+LA/@29.9602116,-90.064153,17z/data=!3m1!4b1!4m14!4m13!1m5!1m1!1s0x8620a611c56f68bb:0x56736b4c84d02ba1!2m2!1d-90.0646667!2d29.9587535!1m5!1m1!1s0x8620a6176d30f241:0x44f30c2884d1058e!2m2!1d-90.059064!2d29.9611119!3e2" target="_blank" class="roommap">[<img src="images/directionsicon.gif" width="12" height="12" alt=""/ style="vertical-align:auto; margin-right:3px; margin-left:2px; border:none;">Map<span class="halfspace">+</span>Directions]</a><br>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun_PM_0800_Hex",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun_PM_0800_Hex"); ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<br><br>
<div class="registrationfooter"><h3><a href="registration.php">Register for WitchCon Online!</a></h3></div>
<br><br>

<?php // $conn->close(); ?>
			
			
<!-- InstanceEndEditable -->

		</div>

		<div class="photosidebar">
			
			<?php include ('/home/witchcon/public_html/presenterphotoinclude.php'); ?>
					
		</div>

	</div>

</div>
	
</body>
<!-- InstanceEnd --></html>