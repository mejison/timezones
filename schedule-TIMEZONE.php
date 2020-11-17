<!doctype html>
<html><!-- InstanceBegin template="/Templates/Template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<?php include ('/home/witchcon/public_html/thisyear.php'); ?>	
<?php include ('/home/witchcon/public_html/databasevalues.php'); ?>
	
	
<?php
	$whatpage = $_SERVER['SCRIPT_NAME'];
	$whatpage = $whatpage . "?"; 
	foreach($_GET as $key => $value){
		$parameters = $parameters . $key . "=" . $value . "&"; 
	}
	$parameters = preg_replace('/&$/', '', $parameters, 1);
	$whatpage = $whatpage . $parameters;

	if ($whatpage == "/index.php") { $whatpage = ""; }
?>


<!-- InstanceBeginEditable name="doctitle" -->
<title>WitchCon Online - Class Schedule for <?php echo $thisyear; ?>!</title>
	
<?php 
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>

	
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- InstanceBeginEditable name="head" -->
	
<meta property="og:image" content="http://witchcon.com/images/facebook-og.jpg" />
<meta property="og:title" content="WitchCon Online - Class Schedule for <?php echo $thisyear; ?>!" />
<meta property="og:site_name" content="WitchCon Online"/>
<meta property="og:description" content="WitchCon Online <?php echo $thisyear; ?> features over a hundred classes by over a hundred Witches and Conjurers from across the globe ready to share their time-honored wisdom and witchery. Register to watch 18 livestream classes, rituals, and performances and then watch playbacks of every class on-demand so you don't have to miss a single magical moment! Classrooms are named for the seven classical planets and feature classes by planetary theme!" />

<?php $page = "schedule"; ?>

	
<!-- InstanceEndEditable -->

</head>

<body>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId=1619528024947849&autoLogAppEvents=1" nonce="xfAiSweO"></script>

<div class="mainbox">
	
	<div class="herobox"> <a href="/"><img src="images/logo.png" class="logo" alt=""/></a>

		<div class="herotext"><h2 class="heroh2">Bring the Magic to You!</h2><p>March <?php echo $dayone; ?> to <?php echo $daythree; ?>, <?php echo $thisyear ?>, join the largest online magical conference in the world, featuring over a hundred Witches and Conjurers coming to you by livestream video from across the globe!</p>
			
		<div class="socialboxheader">
	
		</div>

		</div>
	</div>
	


	<div class="navbox">
		<ul class="nav"><li class="button buttonregistration"><a href="registration.php" class="navlink">Registration</a></li><li class="button buttonpresenters"><a href="presenters.php" class="navlink">Presenters</a></li><li class="button buttonschedule"><a href="schedule.php" class="navlink">Schedule</a></li><li class="button buttonvendors"><a href="vendors.php" class="navlink">Vendors</a></li></ul>
	</div>



	<div class="contentbox">
		<div class="maintext">

<!-- InstanceBeginEditable name="CONTENT" -->
			

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
	
	$sql = "SELECT PRESENTERID, PresentersName, PhotoNameKey, WorkshopTitleOne, Country, State, City, PreferredTime FROM $table1 ORDER BY PhotoNameKey";

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
				
				$selectedOne = "";
				$selectedTwo = "";
				$selectedThree = "";
				$selectedFour = "";
                

				if ($getphotonamekey == $row["PhotoNameKey"]) {
                    
                    // this  snippet gets the workshop title for the panelist list.
                    $gettheworkshoptitle = "WorkshopTitle" . $getworkshopnumber;
                    
					if ($getworkshopnumber == "One") { $selectedOne = "SELECTED"; };
					if ($getworkshopnumber == "Two") { $selectedTwo = "SELECTED"; };
					if ($getworkshopnumber == "Three") { $selectedThree = "SELECTED"; };
					if ($getworkshopnumber == "Four") { $selectedFour = "SELECTED"; };
				}
				
				$city = $row["City"]; 
				
				
				if ($row["WorkshopTitleOne"]) { echo "<option " . $selectedOne . " value=\"" . $row["PhotoNameKey"] . "_One\">" . $row["PhotoNameKey"]. " - " . $row["WorkshopTitleOne"] . " - " . $row["Country"] . " - " . $row["State"] . " - " . $city . " - " . $row["PreferredTime"] . "</option>"; }; 
				if ($row["WorkshopTitleTwo"]) { echo  "<option " . $selectedTwo . " value=\"" . $row["PhotoNameKey"] . "_Two\">" . $row["PhotoNameKey"]. " - " . $row["WorkshopTitleTwo"] . " - " . $row["Country"] . " - " . $row["State"] . " - " . $city . " - " . $row["PreferredTime"] . "</option>"; }; 
				if ($row["WorkshopTitleThree"]) { echo  "<option " . $selectedThree . " value=\"" . $row["PhotoNameKey"] . "_Three\">" . $row["PhotoNameKey"]. " - " . $row["WorkshopTitleThree"] . " - " . $row["Country"] . " - " . $row["State"] . " - " . $city . " - " . $row["PreferredTime"] . "</option>"; }; 
				if ($row["WorkshopTitleFour"]) { echo  "<option " . $selectedFour . " value=\"" . $row["PhotoNameKey"] . "_Four\">" . $row["PhotoNameKey"]. " - " . $row["WorkshopTitleFour"] . " - " . $row["Country"] . " - " . $row["State"] . " - " . $city . " - " . $row["PreferredTime"] . "</option>"; }; 

				$selectepdOne = "";
				$selectedTwo = "";
				$selectedThree = "";
				$selectedFour = "";


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
	$sql = "SELECT PresentersName, ShowPresenterLink, $publicwhichworkshop FROM $table1 WHERE PhotoNameKey='$publicgetphotonamekey'";    

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
                      
		// output data of each row
		while($row = $result->fetch_assoc()) {
            
			echo "<i><a href=\"presenter.php?presenter=" . $publicgetphotonamekey . "\">" . $row["PresentersName"] . "</a></i><br>";
			
			echo "<b><a href=\"workshop.php?presenter=" . $publicgetphotonamekey . "&workshop=" . $publicgetworkshopnumber . "&location=" . $celllocation . "\">" . $row["$publicwhichworkshop"] . "</a></b>";
            
            if (($publicgetphotonamekey == "tour") and ($row["$publicwhichworkshop"] == "French Quarter Shop & Pub Crawl")) {
                
                echo "<br>With <i><a href=\"presenter.php?presenter=briancain\">Brian Cain</a> and <a href=\"presenter.php?presenter=christianday\">Christian Day</a></i>";
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

<h1><?php echo $thisyear ?> Schedule</h1>
	
			
<p>WitchCon Online <?php echo $thisyear; ?> features over a hundred classes by over a hundred Witches and Conjurers from across the globe ready to share their time-honored wisdom and witchery. <a href="/registration.php">Register</a> to watch 18 livestream classes, rituals, and performances and then watch playbacks of every class on-demand so you don't have to miss a single magical moment!</p>

			<p>Browse the schedule below and click links for more details. Classrooms are named for the seven classical planets and feature classes by planetary theme! The conference is livestreamed by the <a href="https://www.crowdcast.io/hexeducation">Hex Education Network</a> on Crowdcast, a web-based platform with no need to download an app!</p>

<p>Live sales in our <a href="vendors.php">Virtual Vendors’ Hall</a> and our <a href="/meetandgreet.php">Virtual Meet and Greet on Zoom</a> are each held from 9 am to 6 pm CST on both Saturday and Sunday and are free and open to the public!</p>

	
<h2 class="scheduleheader">Friday, March <?php echo $dayone . ", " . $thisyear ?></h2>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">Friday<br>7:00 pm <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
	<td class="schedulecell"><a name=""></a><h3 class="scheduleroom"><span class="planets">♁ </span>The Earth Amphitheater</h3>
		<strong>Opening Ritual</strong><br>
		<a href="/presenter.php?presenter=brian-cain">Brian Cain</a> and <a href="/presenter.php?presenter=christian-day">Christian Day</a> open the ceremonies of WitchCon with members of the New Orleans Coven and a performance by the <a href="/presenter.php?presenter=dragon-ritual-drummers">Dragon Ritual Drummers</a>!
	</td>
</tr>
</tbody>
</table>
</div>
</div>

<h2 class="scheduleheader">Saturday, March <?php echo $daytwo . ", " . $thisyear ?></h2>
			
<div class="schedulerow">
<div class="schedule-left-column scheduletime">Saturday<br>9:00 am <span class="cst">cst</span></div>
 <div class="schedule-right-column">
<table class="scheduletable">
<tbody>


<tr>
	<td class="schedulecell"><a name="Sat-AM-0900-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0900-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-0900-Sun"); ?>
</td>
</tr>
<tr>
<td class="schedulecell"><a name="Sat-AM-0900-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0900-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-0900-Moon"); ?>
</td>
</tr>
<tr>
<td class="schedulecell"><a name="Sat-AM-0900-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0900-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-0900-Mars"); ?>
</tr>
<tr>
<td class="schedulecell"><a name="Sat-AM-0900-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0900-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-0900-Mercury"); ?>
</td>
</tr>
<tr>
	<td class="schedulecell"><a name="Sat-AM-0900-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
		<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0900-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-0900-Jupiter"); ?>
	</td>
</tr>
<tr>
	<td class="schedulecell"><a name="Sat-AM-0900-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
		<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0900-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-0900-Venus"); ?></td>
</tr>
<tr>
	<td class="schedulecell"><a name="Sat-AM-0900-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
		<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0900-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-0900-Saturn"); ?></td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedulebreak">10:15 am <span class="cst">cst</span> &mdash; 15 Minute Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">Saturday<br>10:30 am <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
	<tr>
		<td class="schedulecell"><a name="Sat-AM-1030-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1030-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-1030-Sun"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-AM-1030-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1030-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-1030-Moon"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-AM-1030-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1030-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-1030-Mars"); ?>
		</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-AM-1030-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1030-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-1030-Mercury"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-AM-1030-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1030-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-1030-Jupiter"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-AM-1030-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1030-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-1030-Venus"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-AM-1030-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1030-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-AM-1030-Saturn"); ?></td>
	</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedulebreak">11:45 am <span class="cst">cst</span> &mdash; 30 Minute Lunch Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">Saturday<br>12:15 pm <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-1215-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1215-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-1215-Sun"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-1215-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1215-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-1215-Moon"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-1215-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1215-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-1215-Mars"); ?>
		</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-1215-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1215-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-1215-Mercury"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-1215-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1215-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-1215-Jupiter"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-1215-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1215-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-1215-Venus"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-1215-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1215-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-1215-Saturn"); ?></td>
	</tr>
</tbody>
</table>
</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">1:30 pm <span class="cst">cst</span> &mdash; 15 Minute Break</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">Saturday<br>1:45 pm <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0145-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0145-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0145-Sun"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0145-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0145-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0145-Moon"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0145-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0145-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0145-Mars"); ?>
		</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0145-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0145-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0145-Mercury"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0145-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0145-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0145-Jupiter"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0145-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0145-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0145-Venus"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0145-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0145-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0145-Saturn"); ?></td>
	</tr>
</tbody>
</table>
</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">3 pm <span class="cst">cst</span> &mdash; 15 Minute Break</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">Saturday<br>3:15 pm <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0315-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0315-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0315-Sun"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0315-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0315-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0315-Moon"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0315-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0315-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0315-Mars"); ?>
		</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0315-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0315-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0315-Mercury"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0315-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0315-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0315-Jupiter"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0315-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0315-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0315-Venus"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sat-PM-0315-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0315-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0315-Saturn"); ?></td>
	</tr>
</tbody>
</table>
</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">4:30 pm <span class="cst">cst</span> &mdash; 15 Minute Break</div>
</div>
			
			
<div class="schedulerow">
	<div class="schedule-left-column scheduletime">Saturday<br>4:45 pm <span class="cst">cst</span></div>
	<div class="schedule-right-column">
	<table class="scheduletable">
	<tbody>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0445-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0445-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0445-Sun"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0445-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0445-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0445-Moon"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0445-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0445-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0445-Mars"); ?>
			</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0445-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0445-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0445-Mercury"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0445-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0445-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0445-Jupiter"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0445-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0445-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0445-Venus"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0445-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0445-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0445-Saturn"); ?></td>
		</tr>
	</tbody>
	</table>
	</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">6:00 pm <span class="cst">cst</span> &mdash; 45 Minute Dinner Break</div>
</div>

<div class="schedulerow">
	<div class="schedule-left-column scheduletime">Saturday<br>6:45 pm <span class="cst">cst</span></div>
	<div class="schedule-right-column">
	<table class="scheduletable">
	<tbody>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0645-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0645-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0645-Sun"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0645-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0645-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0645-Moon"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0645-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0645-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0645-Mars"); ?>
			</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0645-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0645-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0645-Mercury"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0645-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0645-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0645-Jupiter"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0645-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0645-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0645-Venus"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0645-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0645-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0645-Saturn"); ?></td>
		</tr>
	</tbody>
	</table>
	</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">8:00 pm <span class="cst">cst</span> &mdash; 15 Minute  Break</div>
</div>
			
			
<div class="schedulerow">
	<div class="schedule-left-column scheduletime">Saturday<br>8:15 pm <span class="cst">cst</span></div>
	<div class="schedule-right-column">
	<table class="scheduletable">
	<tbody>
		<tr>
			<td class="schedulecell"><a name="Sat-PM-0815-Earth"></a><h3 class="scheduleroom"><span class="planets">♁ </span>The Earth Amphitheater</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0815-Earth",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sat-PM-0815-Earth"); ?></td>
		</tr>
	</tbody>
	</table>
	</div>
</div>
<br>
<h2 class="scheduleheader">Sunday, March <?php echo $daythree . ", " . $thisyear ?></h2>
			
	
<div class="schedulerow">
<div class="schedule-left-column scheduletime">Sunday<br>9:00 am <span class="cst">cst</span></div>
 <div class="schedule-right-column">
<table class="scheduletable">
<tbody>


<tr>
<td class="schedulecell"><a name="Sun-AM-0900-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0900-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-0900-Sun"); ?>
</td>
</tr>
<tr>
<td class="schedulecell"><a name="Sun-AM-0900-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0900-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-0900-Moon"); ?>
</td>
</tr>
<tr>
<td class="schedulecell"><a name="Sun-AM-0900-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0900-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-0900-Mars"); ?>
</tr>
<tr>
<td class="schedulecell"><a name="Sun-AM-0900-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
	<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0900-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-0900-Mercury"); ?>
</td>
</tr>
<tr>
	<td class="schedulecell"><a name="Sun-AM-0900-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
		<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0900-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-0900-Jupiter"); ?>
	</td>
</tr>
<tr>
	<td class="schedulecell"><a name="Sun-AM-0900-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
		<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0900-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-0900-Venus"); ?></td>
</tr>
<tr>
	<td class="schedulecell"><a name="Sun-AM-0900-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
		<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0900-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-0900-Saturn"); ?></td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedulebreak">10:15 am <span class="cst">cst</span> &mdash; 15 Minute Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">Sunday<br>10:30 am <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
	<tr>
		<td class="schedulecell"><a name="Sun-AM-1030-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1030-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-1030-Sun"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-AM-1030-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1030-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-1030-Moon"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-AM-1030-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1030-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-1030-Mars"); ?>
		</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-AM-1030-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1030-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-1030-Mercury"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-AM-1030-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1030-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-1030-Jupiter"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-AM-1030-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1030-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-1030-Venus"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-AM-1030-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1030-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-AM-1030-Saturn"); ?></td>
	</tr>
</tbody>
</table>
</div>
</div>

<div class="schedulerow">
<div class="schedulebreak">11:45 am <span class="cst">cst</span> &mdash; 30 Minute Lunch Break</div>
</div>

<div class="schedulerow">
<div class="schedule-left-column scheduletime">Sunday<br>12:15 pm <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-1215-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1215-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-1215-Sun"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-1215-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1215-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-1215-Moon"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-1215-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1215-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-1215-Mars"); ?>
		</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-1215-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1215-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-1215-Mercury"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-1215-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1215-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-1215-Jupiter"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-1215-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1215-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-1215-Venus"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-1215-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1215-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-1215-Saturn"); ?></td>
	</tr>
</tbody>
</table>
</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">1:30 pm <span class="cst">cst</span> &mdash; 15 Minute Break</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">Sunday<br>1:45 pm <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0145-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0145-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0145-Sun"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0145-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0145-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0145-Moon"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0145-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0145-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0145-Mars"); ?>
		</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0145-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0145-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0145-Mercury"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0145-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0145-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0145-Jupiter"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0145-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0145-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0145-Venus"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0145-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0145-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0145-Saturn"); ?></td>
	</tr>
</tbody>
</table>
</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">3 pm <span class="cst">cst</span> &mdash; 15 Minute Break</div>
</div>
<div class="schedulerow">
<div class="schedule-left-column scheduletime">Sunday<br>3:15 pm <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0315-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0315-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0315-Sun"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0315-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0315-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0315-Moon"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0315-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0315-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0315-Mars"); ?>
		</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0315-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0315-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0315-Mercury"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0315-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0315-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0315-Jupiter"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0315-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0315-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0315-Venus"); ?></td>
	</tr>
	<tr>
		<td class="schedulecell"><a name="Sun-PM-0315-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
			<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0315-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0315-Saturn"); ?></td>
	</tr>
</tbody>
</table>
</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">4:30 pm <span class="cst">cst</span> &mdash; 15 Minute Break</div>
</div>
			
			
<div class="schedulerow">
	<div class="schedule-left-column scheduletime">Sunday<br>4:45 pm <span class="cst">cst</span></div>
	<div class="schedule-right-column">
	<table class="scheduletable">
	<tbody>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0445-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0445-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0445-Sun"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0445-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0445-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0445-Moon"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0445-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0445-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0445-Mars"); ?>
			</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0445-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0445-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0445-Mercury"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0445-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0445-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0445-Jupiter"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0445-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0445-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0445-Venus"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0445-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0445-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0445-Saturn"); ?></td>
		</tr>
	</tbody>
	</table>
	</div>
</div>
<div class="schedulerow">
	<div class="schedulebreak">6:00 pm <span class="cst">cst</span> &mdash; 45 Minute Dinner Break</div>
</div>

<div class="schedulerow">
	<div class="schedule-left-column scheduletime">Sunday<br>6:45 pm <span class="cst">cst</span></div>
	<div class="schedule-right-column">
	<table class="scheduletable">
	<tbody>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0645-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0645-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0645-Sun"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0645-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0645-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0645-Moon"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0645-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0645-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0645-Mars"); ?>
			</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0645-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0645-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0645-Mercury"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0645-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0645-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0645-Jupiter"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0645-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0645-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0645-Venus"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0645-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0645-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0645-Saturn"); ?></td>
		</tr>
	</tbody>
	</table>
	</div>
</div>

<div class="schedulerow">
	<div class="schedulebreak">8:00 pm <span class="cst">cst</span> &mdash; 15 Minute  Break</div>
</div>
			
			
<div class="schedulerow">
	<div class="schedule-left-column scheduletime">Sunday<br>8:15 pm <span class="cst">cst</span></div>
	<div class="schedule-right-column">
	<table class="scheduletable">
	<tbody>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0815-Sun"></a><h3 class="scheduleroom"><span class="planets">☉ </span>The Sun Solarium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0815-Sun",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0815-Sun"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0815-Moon"></a><h3 class="scheduleroom"><span class="planets">☽ </span>The Moon Garden</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0815-Moon",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0815-Moon"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0815-Mars"></a><h3 class="scheduleroom"><span class="planets">♂ </span>The Mars Chamber</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0815-Mars",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0815-Mars"); ?>
			</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0815-Mercury"></a><h3 class="scheduleroom"><span class="planets">☿ </span>The Mercury Atrium</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0815-Mercury",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0815-Mercury"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0815-Jupiter"></a><h3 class="scheduleroom"><span class="planets">♃ </span>The Jupiter Conservatory</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0815-Jupiter",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0815-Jupiter"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0815-Venus"></a><h3 class="scheduleroom"><span class="planets">♀ </span>The Venus Parlor</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0815-Venus",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0815-Venus"); ?></td>
		</tr>
		<tr>
			<td class="schedulecell"><a name="Sun-PM-0815-Saturn"></a><h3 class="scheduleroom"><span class="planets">♄ </span>The Saturn Library</h3>
				<?php if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0815-Saturn",$showduplicate,$showduplicatedlisting,$showupdated); }; GetCurrent("Sun-PM-0815-Saturn"); ?></td>
		</tr> 
	</tbody>
	</table>
	</div>
</div>

<div class="schedulerow">
	<div class="schedulebreak">9:30 pm <span class="cst">cst</span> &mdash; 15 Minute  Break</div>
</div>
			
<div class="schedulerow">
<div class="schedule-left-column scheduletime">9:45 pm <span class="cst">cst</span></div>
<div class="schedule-right-column">
<table class="scheduletable">
<tbody>
<tr>
	<td class="schedulecell"><a name=""></a><h3 class="scheduleroom"><span class="planets">♁ </span>The Earth Amphitheater</h3>
		<strong>Closing Ritual</strong><br>
		<a href="/presenter.php?presenter=brian-cain">Brian Cain</a> and <a href="/presenter.php?presenter=christian-day">Christian Day</a> thank all for attending WitchCon and end with a performance by the <a href="/presenter.php?presenter=dragon-ritual-drummers">Dragon Ritual Drummers</a>!</td>
</tr>
</tbody>
</table>
</div>
</div>

<br clear="all"><br>
<div class="registrationfooter"><h3><a href="registration.php">Register for WitchCon Online!</a></h3></div>
			
			
<!-- InstanceEndEditable -->
			

			
			<br><br><br>

		</div>
		
		<div class="photosidebar">
			
		<!-- InstanceBeginEditable name="contentsidebar" -->
		<?php $numberphotos = 10; include ('/home/witchcon/public_html/presenterphotoinclude.php'); ?>
		<!-- InstanceEndEditable -->
			
			

				
		</div>

	</div>

</div>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bc383e4006419"></script>


</body>
<!-- InstanceEnd --></html>