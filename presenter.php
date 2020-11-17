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

	
<?php
	
	// Function to trim for the Meta OG for Facebook etc. 
	function trim_text($input, $length) {
		
		return (strlen($input) < $length) ? $input : substr($input, 0, strrpos(substr($input, 0, $length), ' ')) . ' …';
		
	}
	
	$presenterphotokey = $_REQUEST['presenter'];    
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	    
	$sql = "SELECT PresentersName, PresenterBio, PresentersWebsite, PlanningtoVend, VendingBusinessName, VendorsBusinessWebsite, MarketingDescriptionofYourBusinessandYourProducts, WorkshopTitleOne, WorkshopDescriptionOne, Country, State, City FROM $table1 WHERE PhotoNameKey='$presenterphotokey'";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
			$presentersname = $row["PresentersName"];
						
			$workshoptitle = $row["WorkshopTitleOne"];
			
			$websiteaddress = $row["PresentersWebsite"];
	
			$websitedisplay = str_replace("http://","",$websiteaddress);
			$websitedisplay = str_replace("https://","",$websitedisplay);
			$websitedisplay = str_replace("www.","",$websitedisplay);
			
			$vending = $row["PlanningtoVend"];
            $VendingBusinessName = $row["VendingBusinessName"];
			$VendingDescription = $row["MarketingDescriptionofYourBusinessandYourProducts"];
            
			$presenterbio = $row["PresenterBio"];
			
			$country = $row["Country"];
			$city = $row["City"];
			$state = $row["State"];

			if (($city) && ($state))  {
				$citystate = $city . ", " . $state . "<br>";
			} elseif (($city) && !($state)) {
				$citystate = $city . "<br>";
			} elseif (!($city) && ($state)) {
				$citystate = $state . "<br>";
			} else {
				$citystate = "";
			}
			
			
			// create format og and meta bios 
			$scrubpresenterbio = $presenterbio;
			$scrubpresenterbio = str_replace(" \"", " “", $scrubpresenterbio);
			$scrubpresenterbio = str_replace("\n\"", " “", $scrubpresenterbio);
			$scrubpresenterbio = str_replace("\" ", "” ", $scrubpresenterbio);
			$scrubpresenterbio = str_replace("\"\n", "” ", $scrubpresenterbio);
			$scrubpresenterbio = str_replace("\"", "”", $scrubpresenterbio); // the catch-all quote converts any left to right quotes.
			$scrubpresenterbio = str_replace("\n", " ", $scrubpresenterbio);
			$scrubpresenterbio = str_replace("<br/>", " ", $scrubpresenterbio);
			$scrubpresenterbio = str_replace("</p>", " ", $scrubpresenterbio);
			$scrubpresenterbio = str_replace("<p>", " ", $scrubpresenterbio);
			$scrubpresenterbio = str_replace("  ", " ", $scrubpresenterbio);
			$ogpresenterbio = trim_text($scrubpresenterbio, 200);
			$metapresenterbio = trim_text($scrubpresenterbio, 150);
			
			$presenterbio = "<p>" . $presenterbio . "</p>";
			
			// format description 
			$presenterbio = str_replace("\n ","\n",$presenterbio);
			$presenterbio = str_replace("\n\n","</p>\n<p>",$presenterbio);
			$presenterbio = str_replace("* ","<li>",$presenterbio);
			$presenterbio = str_replace("*","<li>",$presenterbio);
			$presenterbio = str_replace("</p>\n<p><li>","\n<li>",$presenterbio);
			$presenterbio = preg_replace('/<li>/', '</p><ul><li>', $presenterbio, 1);
			$presenterbio = str_replace("\n</p><ul><li>","</p>\n<ul>\n<li>",$presenterbio);
			$presenterbio = preg_replace('/<li>(.*?)<\/p>/', '<li>$1</ul>', $presenterbio);
			$presenterbio = str_replace("</ul>","\n</ul>",$presenterbio);
			
			// format vending 
			$VendingDescription = str_replace("\n ","\n",$VendingDescription);
			$VendingDescription = str_replace("\n\n","</p>\n<p>",$VendingDescription);
			$VendingDescription = str_replace("* ","<li>",$VendingDescription);
			$VendingDescription = str_replace("*","<li>",$VendingDescription);
			$VendingDescription = str_replace("</p>\n<p><li>","\n<li>",$VendingDescription);
			$VendingDescription = preg_replace('/<li>/', '</p><ul><li>', $VendingDescription, 1);
			$VendingDescription = str_replace("\n</p><ul><li>","</p>\n<ul>\n<li>",$VendingDescription);
			$VendingDescription = preg_replace('/<li>(.*?)<\/p>/', '<li>$1</ul>', $VendingDescription);
			$VendingDescription = str_replace("</ul>","\n</ul>",$VendingDescription);
			

		}
	} else {
		// leave blank
	}
    
?>

<title><?php echo $presentersname; ?> - A Featured Presenter with WitchCon Online <?php echo $thisyear; ?></title>

<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- InstanceBeginEditable name="head" -->
	
<meta name="description" content="<?php echo $metaworkshopdescription; ?>" />

<meta property="og:image"
content="https://witchcon.com/presenter-og-images/facebook-og-<?php echo $presenterphotokey; ?>.jpg" />
<meta property="og:title" content="<?php echo $presentersname; ?> - A Featured Presenter For WitchCon Online <?php echo $thisyear; ?>" />
<meta property="og:site_name" content="WitchCon Online"/>
<meta property="og:description" content="<?php echo $ogpresenterbio; ?>" />
	
<?php $page = "schedule"; ?>
	
	
<?php
			
	// get workshop!
    $sql2 = "SELECT Location, WorkshopNumber FROM $table2 WHERE PhotoNameKey='$presenterphotokey' ORDER BY Location";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {

            list($day, $ampm, $time, $room) = explode("-", $row2["Location"], 4);
            $hour = substr($time, 0, 2);
            $hour = ltrim($hour, '0');
            $minute = substr($time, 2);
            $ampm = strtolower($ampm);
			
            if ($day == "Sat") { $day = "Saturday, March $daytwo"; }
            else { $day = "Sunday, March $daythree"; }
			

			if ($room == "Earth") { $room = "The Earth Ampitheater"; }
			if ($room == "Sun") { $room = "The Sun Solarium"; }
			if ($room == "Moon") { $room = "The Moon Garden"; }
			if ($room == "Mars") { $room = "The Mars Chamber"; }
			if ($room == "Mercury") { $room = "The Mercury Atrium"; }
			if ($room == "Jupiter") { $room = "The Jupiter Conservatory"; }
			if ($room == "Venus") { $room = "The Venus Parlor"; }
			if ($room == "Saturn") { $room = "The Saturn Library"; }
			 
			$workshopnumber = $row2["WorkshopNumber"];
			$location = $row2["Location"];

        }
    } 
	
	
	// Get vending!
	$sql3 = "SELECT Location FROM $table4 WHERE PhotoNameKey='$presenterphotokey'";
	$result3 = $conn->query($sql3);

	if ($result3->num_rows > 0) {
		// output data of each row
		while($row3 = $result3->fetch_assoc()) {
			
			list($dayvend, $ampmvend, $timevend, $roomvend) = explode("-", $row3["Location"], 4);
            $hourvend = substr($timevend, 0, 2);
            $hourvend = ltrim($hourvend, '0');
            $minutevend = substr($timevend, 2);
            $ampmvend = strtolower($ampmvend);
			
            if ($dayvend == "Sat") { $dayvend = "Saturday, March $daytwo"; }
            else { $dayvend = "Sunday, March $daythree"; }
			
			$locationvend = $row3["Location"];

		}

	} else {
		// blank 
	}
			
?>

	
<!-- InstanceEndEditable -->	
	
</head>

<body>

<div class="mainbox">
	<div class="herobox <?php if ($page != "home") { echo "heroboxsub"; }; ?>">
		<a href="/"><img src="images/logo.png" class="logo <?php if ($page != "home") { echo "logosub"; }; ?>" alt=""/><img src="images/logo-witchcon-exocet-only-2line.png" class="<?php if ($page == "home") { echo "hide"; }; ?> <?php if ($page != "home") { echo "logosubalt"; }; ?>" alt=""/></a>
		
		<div class="herotext herotextalt <?php if ($page == "home") { echo "hide"; }; ?>"><h2 class="heroh2 heroh2alt">March <?php echo $dayone; ?><sup><?php echo $dayonesuffix; ?></sup> to <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear ?></h2></div>
		
		<div class="herotext <?php if ($page != "home") { echo "herotextsub"; }; ?>"><h2 class="heroh2">Bring the Magic to You!</h2><p>March <?php echo $dayone; ?><sup><?php echo $dayonesuffix; ?></sup> to <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear ?>, join the largest online magical conference in the world, featuring over a hundred Witches and Conjurers coming to you by livestream video from across the globe!</p></div>
	</div>


 

	<div class="navbox">
		<ul class="nav"><li class="button buttonregistration"><a href="registration.php" class="navlink">Registration</a></li><li class="button buttonpresenters"><a href="presenters.php" class="navlink">Presenters</a></li><li class="button buttonschedule"><a href="schedule.php" class="navlink">Schedule</a></li><li class="button buttonvendors"><a href="vendors.php" class="navlink">Vendors</a></li></ul>
	</div>



	<div class="contentbox">
		<div class="maintext">

<!-- InstanceBeginEditable name="CONTENT" -->
			
			<h1><?php echo $presentersname; ?></h1>
			
			
			<?php if ($day) { ?>
			
				<?php
				echo "<h3>Class – <a href=\"workshop.php?presenter=" . $presenterphotokey . "&workshop=" . $workshopnumber . "&location=" . $location . "\">" . $workshoptitle . "</a></h3>";
				?>

				<h4><?php echo $day; ?> at <?php echo $hour . ":" . $minute;?>&#8202;<span class="cst-agenda"><?php echo $ampm; ?><br>cst</span> in <?php echo $room; ?></h4>
			
			<?php } ?>
			
			
			<?php if ($vending == "Yes") { ?>
						
				<?php
				echo "<h3>Vending – <a href=\"vendors.php?#" . $locationvend . "\">" . $VendingBusinessName . "</a></h3>";
				?>

				<h4><?php echo $dayvend; ?> at <?php echo $hourvend . ":" . $minutevend;?>&#8202;<span class="cst-agenda"><?php echo $ampmvend; ?><br>cst</span> in the Virtual Vendors’ Hall</h4>
			
			<?php } ?>
						
			
			<h2>Bio for <?php echo $presentersname; ?></h2>

			<?php echo $presenterbio; ?>
			
			<?php
			
				if ($websiteaddress) {
			
					echo "<p>Visit " . $presentersname . " online at <a href=\"" . $websiteaddress . "\">" . $websitedisplay . "</a></p>";
				}
			?>

			
			
			
<!-- InstanceEndEditable -->
			
			<?php if ($page != "registration") { ?>
				<div class="registrationfooter"><h3><a href="registration.php">Register for WitchCon Online!<br>
					<img src="images/logo-witchcon-exocet-only-2line.png" class="footerlogo" alt=""/></a></h3>
				</div>
			<?php } ?>
			
			
			<br><br>

		</div>
		
		<div class="photosidebar">
			
		<!-- InstanceBeginEditable name="contentsidebar" -->
			<?php 
			echo "<img src=\"/presenterphotos/photo-". $presenterphotokey . ".jpg\" class=\"featurephoto\" id=\"featurephotoid\" alt=\"" . $presentersname . "\" /><h6 class=\"photosidebarh6\">" . $presentersname . "<br><span class=\"countrycolor\">" . $citystate . $country . "</span></h6>";
			?>
			
			<?php
			
				if ($websiteaddress) {
			
					echo "<p class=\"presenterlink\"><a href=\"" . $websiteaddress . "\">Presenter’s Website</a></p>";
				}
			?>
			
		<!-- InstanceEndEditable -->
			
			

				
		</div>

	</div>

</div>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bc383e4006419"></script>


</body>
<!-- InstanceEnd --></html>