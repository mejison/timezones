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
<title>WitchCon Online <?php echo $thisyear; ?> - Live Sales in Our Virtual Vendors’ Hall!</title>
	

<?php 
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	
?>

	
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- InstanceBeginEditable name="head" -->
	
<meta property="og:image" content="http://witchcon.com/images/facebook-og.jpg" />
<meta property="og:title" content="WitchCon Online <?php echo $thisyear; ?> - Live Sales in Our Virtual Vendors’ Hall!" />
<meta property="og:site_name" content="WitchCon Online"/>
<meta property="og:description" content="WitchCon Online attendees will love shopping live with our magical presenters, each showcasing powerful ritual tools, signed books, exquisite jewelry, and spellcrafts handmade by true practitioners in half-hour Live Sales. You don’t have to travel to the ends of the Earth to scour the witch markets: you can buy from enchanting artisans and score amazing tools and talismans from the comfort of your own home. Our Virtual Vendors’ Hall is free to the public as well!" />
	
<?php $page = "vendors"; ?>

	
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
			
<h1>Virtual Vendors’ Hall <?php echo $thisyear ?></h1>
<h2>Free Admission, March <?php echo $daytwo; ?><sup><?php echo $daytwosuffix; ?></sup> and <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear; ?></h2>

<p>WitchCon Online attendees will love shopping live with our magical presenters, each showcasing powerful ritual tools, signed books, exquisite jewelry, and spellcrafts handmade by true practitioners in half-hour Live Sales. You don’t have to travel to the ends of the Earth to scour the witch markets: you can buy from enchanting artisans and score amazing tools and talismans from the comfort of your own home. Our Virtual Vendors’ Hall is free to the public as well!</p>
			
<p>Browse the schedule below to learn about vendors and when they'll be offering their magical wares. Sessions are livestreamed on the <a href="https://www.crowdcast.io/hexeducation">Hex Education Network</a> on the web-based Crowdcast Platform (no app needed!), where participants can choose . You can also watch playbacks on-demand of any vending sessions that you missed so you don't miss out on a single treasure!</p>
			
<?php
	
// get variables 
	
$updatewitch = $_REQUEST['updatewitch'];
$adminwitch = $_REQUEST['adminwitch'];
$location = $_REQUEST['location'];
$photonamekey = $_REQUEST['photonamekey'];	
		
			
// define variables    
	
if ($updatewitch == "yes") {
    
	include '/home/witchcon/public_html/databasevalues.php';
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// test for duplicates!
	$sql2 = "SELECT Location, PhotoNameKey FROM $table4 WHERE location!='$location'";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
		// output data of each row
		while($row2 = $result2->fetch_assoc()) {

			if (($row2["PhotoNameKey"] == $photonamekey) && ($row2["PhotoNameKey"] != "")) {
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
				
		$sql3 = "UPDATE $table4 SET PhotoNameKey='$photonamekey' WHERE location='$location'";
		
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
    
	$sql2 = "SELECT Location, PhotoNameKey FROM $table4 WHERE Location='$celllocation'";
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
	
	$sql = "SELECT PresentersName, PhotoNameKey, VendingBusinessName, VendorsBusinessWebsite, MarketingDescriptionofYourBusinessandYourProducts FROM $table1 ORDER BY PhotoNameKey";

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
		echo "<form action=\"vendors.php?adminwitch=yes#" . $celllocation . "\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"updatewitch\" value=\"yes\">";
		echo "<input type=\"hidden\" name=\"adminwitch\" value=\"yes\">";
		echo "<input type=\"hidden\" name=\"location\" value=\"$celllocation\">";
		echo "<select style=\"width: 350px;\" onchange=\"this.form.submit()\" name=\"photonamekey\">";
        echo "<option  name=\"testphotonamekey\" value=\"\">Choose a Vendor for this Timeslot</option>";

		
			// output data of each row
			while($row = $result->fetch_assoc()) {
				
				$selectedOne = "";
				$selectedTwo = "";
				$selectedThree = "";
				$selectedFour = "";
                

				if ($getphotonamekey == $row["PhotoNameKey"]) {
                    
                    // this  snippet gets the workshop title for the panelist list.
                    $gettheworkshoptitle = "WorkshopTitle" . $getworkshopnumber;
                    
					$selectedOne = "SELECTED";
				}
				
				$city = $row["City"]; 
				
				
				if ($row["VendingBusinessName"]) { echo "<option " . $selectedOne . " value=\"" . $row["PhotoNameKey"] . "\">" . $row["PresentersName"]. " —— " . $row["VendingBusinessName"] . "</option>"; }; 

				$selectepdOne = "";
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

	$sql2 = "SELECT Location, PhotoNameKey FROM $table4 WHERE Location='$celllocation'";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
		// output data of each row
		while($row2 = $result2->fetch_assoc()) {

			$publicgetphotonamekey = $row2["PhotoNameKey"];
									
			if (!$publicgetphotonamekey) { 
				// keep blank or maybe put To Be Announced though that will screw up panel number four.
                echo "Vendor to be announced.";
                
                // Find out WHY this would screw up panel number four!
			}
		}

	} else {
		// blank 
	}
    	
	// show the link for the current entry!
	$sql = "SELECT PresentersName, VendingBusinessName, VendorsBusinessWebsite, MarketingDescriptionofYourBusinessandYourProducts FROM $table1 WHERE PhotoNameKey='$publicgetphotonamekey'";    

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
                      
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
			$websiteaddress = $row["VendorsBusinessWebsite"];
	
			$websitedisplay = str_replace("http://","",$websiteaddress);
			$websitedisplay = str_replace("https://","",$websitedisplay);
			$websitedisplay = str_replace("www.","",$websitedisplay);
			
			$vendorbio = $row["MarketingDescriptionofYourBusinessandYourProducts"];

			$vendorbio = "<p>" . $vendorbio . "</p>";
			
			// format description 
			$vendorbio = str_replace("\n ","\n",$vendorbio);
			$vendorbio = str_replace("\n\n","</p>\n<p>",$vendorbio);
			$vendorbio = str_replace("* ","<li>",$vendorbio);
			$vendorbio = str_replace("*","<li>",$vendorbio);
			$vendorbio = str_replace("</p>\n<p><li>","\n<li>",$vendorbio);
			$vendorbio = preg_replace('/<li>/', '</p><ul><li>', $vendorbio, 1);
			$vendorbio = str_replace("\n</p><ul><li>","</p>\n<ul>\n<li>",$vendorbio);
			$vendorbio = preg_replace('/<li>(.*?)<\/p>/', '<li>$1</ul>', $vendorbio);
			$vendorbio = str_replace("</ul>","\n</ul>",$vendorbio);
			
			$publicpresentersname = $row["PresentersName"];
			
			// Christian changes to Sandra for vending host!
			if ($publicgetphotonamekey == "christian-day") {
				$publicgetphotonamekey = "sandra-mariah-wright";
				$publicpresentersname = "Sandra Mariah Wright";
			}

            
			echo "<h3 class=\"scheduleroom\">" . $row["VendingBusinessName"] . "</h3>";
			
			echo "<a href=\"" . $websiteaddress . "\">" . $websitedisplay . "</a><br>";
			
			echo "<i>Featuring <a href=\"presenter.php?presenter=" . $publicgetphotonamekey . "\">" . $publicpresentersname . "</a></i>";
			
			echo $vendorbio;
			
            
		}

            
	} else {
		// leave blank
	}
    

} // end function GetCurrent
	
?>
		
<h2 class="scheduleheader">Saturday, March <?php echo $daytwo . ", " . $thisyear ?></h2>
			
<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>9:00 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-AM-0900-Vending"></a><?php GetCurrent("Sat-AM-0900-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0900-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>9:30 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-AM-0930-Vending"></a><?php GetCurrent("Sat-AM-0930-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-0930-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>10:00 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-AM-1000-Vending"></a><?php GetCurrent("Sat-AM-1000-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1000-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>10:30 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-AM-1030-Vending"></a><?php GetCurrent("Sat-AM-1030-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1030-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>11:00 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-AM-1100-Vending"></a><?php GetCurrent("Sat-AM-1100-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-AM-1100-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow">
<div class="schedulebreak">11:30 am <span class="cst">cst</span> &mdash; 45 Minute Lunch Break</div>
</div>
			
	
<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>12:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-1215-Vending"></a><?php GetCurrent("Sat-PM-1215-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1215-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>12:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-1245-Vending"></a><?php GetCurrent("Sat-PM-1245-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-1245-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>1:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0115-Vending"></a><?php GetCurrent("Sat-PM-0115-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0115-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>1:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0145-Vending"></a><?php GetCurrent("Sat-PM-0145-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0145-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>2:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0215-Vending"></a><?php GetCurrent("Sat-PM-0215-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0215-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>2:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0245-Vending"></a><?php GetCurrent("Sat-PM-0245-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0245-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>3:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0315-Vending"></a><?php GetCurrent("Sat-PM-0315-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0315-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>3:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0345-Vending"></a><?php GetCurrent("Sat-PM-0345-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0345-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>4:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0415-Vending"></a><?php GetCurrent("Sat-PM-0415-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0415-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>4:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0445-Vending"></a><?php GetCurrent("Sat-PM-0445-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0445-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Saturday<br>5:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sat-PM-0515-Vending"></a><?php GetCurrent("Sat-PM-0515-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sat-PM-0515-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>
			
<h2 class="scheduleheader">Sunday, March <?php echo $daythree . ", " . $thisyear ?></h2>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>9:00 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-AM-0900-Vending"></a><?php GetCurrent("Sun-AM-0900-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0900-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>9:30 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-AM-0930-Vending"></a><?php GetCurrent("Sun-AM-0930-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-0930-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>10:00 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-AM-1000-Vending"></a><?php GetCurrent("Sun-AM-1000-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1000-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>10:30 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-AM-1030-Vending"></a><?php GetCurrent("Sun-AM-1030-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1030-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>11:00 am <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-AM-1100-Vending"></a><?php GetCurrent("Sun-AM-1100-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-AM-1100-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>
			
<div class="schedulerow">
<div class="schedulebreak">11:30 am <span class="cst">cst</span> &mdash; 45 Minute Lunch Break</div>
</div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>12:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-1215-Vending"></a><?php GetCurrent("Sun-PM-1215-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1215-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>12:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-1245-Vending"></a><?php GetCurrent("Sun-PM-1245-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-1245-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>1:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0115-Vending"></a><?php GetCurrent("Sun-PM-0115-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0115-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>1:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0145-Vending"></a><?php GetCurrent("Sun-PM-0145-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0145-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>2:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0215-Vending"></a><?php GetCurrent("Sun-PM-0215-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0215-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>2:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0245-Vending"></a><?php GetCurrent("Sun-PM-0245-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0245-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>3:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0315-Vending"></a><?php GetCurrent("Sun-PM-0315-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0315-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>3:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0345-Vending"></a><?php GetCurrent("Sun-PM-0345-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0345-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>4:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0415-Vending"></a><?php GetCurrent("Sun-PM-0415-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0415-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>4:45 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0445-Vending"></a><?php GetCurrent("Sun-PM-0445-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0445-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>

<div class="schedulerow"><div class="schedule-left-column scheduletime">Sunday<br>5:15 pm <span class="cst">cst</span></div><div class="schedule-right-column"><table class="scheduletable"><tbody><tr><td class="schedulecell"><a name="Sun-PM-0515-Vending"></a><?php GetCurrent("Sun-PM-0515-Vending");  if ($adminwitch == "yes") { adminGetCurrent("Sun-PM-0515-Vending",$showduplicate,$showduplicatedlisting,$showupdated); }; ?></td></tr></tbody></table></div></div>


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