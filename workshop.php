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
		return (strlen($input) < $length) ? $input : substr($input, 0, strrpos(substr($input, 0, $length), ' ')) . '…';
	}

	$currentworkshop = $_REQUEST['workshop']; 
	$presenterphotokey = $_REQUEST['presenter'];
	$location = $_REQUEST['location'];
	list($day, $ampm, $time, $room) = explode("-", $location, 4);
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

	$getworkshop = "WorkshopTitle" . $currentworkshop;
	
	$getworkshopdescription = "WorkshopDescription" . $currentworkshop;
	

	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT PresentersName, ShowPresenterLink, $getworkshop, $getworkshopdescription, Country, State, City FROM $table1 WHERE PhotoNameKey='$presenterphotokey'";

	$result = $conn->query($sql);
	
	
	if ($result->num_rows > 0) {
		
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
			$presentersname = $row["PresentersName"];
			
			$currentworkshoptitle = $row["$getworkshop"];
			
			if ($row["ShowPresenterLink"] == "False") {
				$linkpresenter = "no";
			} else {
				$linkpresenter = "yes";
			}
		
			if ($row["WorkshopTitleTwo"]) { $numrows = "2"; }
			
			$workshopdescription = $row["$getworkshopdescription"];
			
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
			$workshopdescription = $workshopdescription;
			$workshopdescription = str_replace(" \"", " “", $workshopdescription);
			$workshopdescription = str_replace("\r\"", " “", $workshopdescription);
			$workshopdescription = str_replace("\" ", "” ", $workshopdescription);
			$workshopdescription = str_replace("\"\r", "” ", $workshopdescription);
			$workshopdescription = str_replace("\"", "”", $workshopdescription); // the catch-all quote converts any left to right quotes.
			$workshopdescription = str_replace("\r", " ", $workshopdescription);
			$workshopdescription = str_replace("<br/>", " ", $workshopdescription);
			$workshopdescription = str_replace("</p>", " ", $workshopdescription);
			$workshopdescription = str_replace("<p>", " ", $workshopdescription);
			$workshopdescription = str_replace("  ", " ", $workshopdescription);
			$ogpresenterbio = trim_text($workshopdescription, 200);
			$metapresenterbio = trim_text($workshopdescription, 150);
			
			// TEST
			// echo "<h1>" . $workshopdescription . "</H2>";
			
			
			$ogworkshopdescription = trim_text($workshopdescription, 200);
			$metaworkshopdescription = trim_text($workshopdescription, 150);
			
			$workshopdescription = "<p>" . $workshopdescription . "</p>";
			
			// format description 
			$workshopdescription = str_replace("\n ","\n",$workshopdescription);
			$workshopdescription = str_replace("\n\n","</p>\n<p>",$workshopdescription);
			$workshopdescription = str_replace("* ","<li>",$workshopdescription);
			$workshopdescription = str_replace("*","<li>",$workshopdescription);
			$workshopdescription = str_replace("</p>\n<p><li>","\n<li>",$workshopdescription);
			$workshopdescription = preg_replace('/<li>/', '</p><ul><li>', $workshopdescription, 1);
			$workshopdescription = str_replace("\n</p><ul><li>","</p>\n<ul>\n<li>",$workshopdescription);
			$workshopdescription = preg_replace('/<li>(.*?)<\/p>/', '<li>$1</ul>', $workshopdescription);
			$workshopdescription = str_replace("</ul>","\n</ul>",$workshopdescription);
            
            // link Brian, Christian, Fiona, DRD
            $workshopdescription = str_replace("Christian Day","<a href=\"presenter.php?presenter=christianday\">Christian Day</a>",$workshopdescription);
            $workshopdescription = str_replace("Brian Cain","<a href=\"presenter.php?presenter=briancain\">Brian Cain</a>",$workshopdescription);
            $workshopdescription = str_replace("Fiona Horne","<a href=\"presenter.php?presenter=fionahorne\">Fiona Horne</a>",$workshopdescription);
            $workshopdescription = str_replace("Dragon Ritual Drummers","<a href=\"presenter.php?presenter=dragonritualdrummers\">Dragon Ritual Drummers</a>",$workshopdescription);
		
		}
	} else {
		// leave blank
	}
    
?>

<title><?php echo $currentworkshoptitle; ?> - A WitchCon Online <?php echo $thisyear; ?> class with <?php echo $presentersname; ?></title>
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- InstanceBeginEditable name="head" -->
		
	
<meta name="description" content="<?php echo $metaworkshopdescription; ?>" />

<meta property="og:image"
content="https://witchcon.com/presenter-og-images/facebook-og-<?php echo $presenterphotokey; ?>.jpg" />
<meta property="og:title" content="<?php echo $currentworkshoptitle; ?> - A WitchCon Online <?php echo $thisyear; ?> class with <?php echo $presentersname; ?>" />
<meta property="og:site_name" content="WitchCon Online"/>
<meta property="og:description" content="<?php echo $ogworkshopdescription; ?>" />

<?php $page = "schedule"; ?>
	
	
	
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
						
			<h2 class="h2workshop"><?php echo $currentworkshoptitle; ?></h2>
			
			<?php if (($linkpresenter == "yes") && ($presenterphotokey != "dragon-ritual-drummers")) { ?>
				<h3>A Livestream Class with <a href="presenter.php?presenter=<?php echo $presenterphotokey; ?>"><?php echo $presentersname; ?></a></h3>
			<?php } elseif ($presenterphotokey == "dragon-ritual-drummers") {  ?>
				<h3>A Livestream with <a href="presenter.php?presenter=<?php echo $presenterphotokey; ?>"><?php echo $presentersname; ?></a></h3>
			<?php }  ?>
			
			
			
			<h4><?php echo $day; ?> at <?php echo $hour . ":" . $minute;?>&#8202;<span class="cst-agenda"><?php echo $ampm; ?><br>cst</span> in <?php echo $room; ?></h4>
			
			<?php echo $workshopdescription; ?>
			
			
			
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
			echo "<a href=\"presenter.php?presenter=" . $presenterphotokey . "\" class=\"featuredlink\"><img src=\"/presenterphotos/photo-". $presenterphotokey . ".jpg\" class=\"featurephoto\" id=\"featurephotoid\" alt=\"" . $presentersname . "\" /><h6 class=\"photosidebarh6\">" . $presentersname . "<br><span class=\"countrycolor\">" . $citystate . $country . "</span></h6></a>";
			?>
		<!-- InstanceEndEditable -->
			
			

				
		</div>

	</div>

</div>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bc383e4006419"></script>


</body>
<!-- InstanceEnd --></html>