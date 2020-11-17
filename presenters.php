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
<title>WitchCon Online - Presenters for <?php echo $thisyear; ?>!</title>
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- InstanceBeginEditable name="head" -->
	
<meta property="og:image" content="http://witchcon.com/images/facebook-og.jpg" />
<meta property="og:title" content="WitchCon Online - Presenters for <?php echo $thisyear; ?>!" />
<meta property="og:site_name" content="WitchCon Online"/>
<meta property="og:description" content="WitchCon Online <?php echo $thisyear; ?> features over a hundred classes by over a hundred Witches and Conjurers from across the globe ready to share their time-honored wisdom and witchery. Our presenters are the preeminent masters of the magical arts and hail from across a rainbow spectrum of occult and spiritual practices. Each of them are engaging teachers and offer classes personally designed to help beginners, novices, and experts alike draw upon the power of magic!" />
	
<?php $page = "presenters"; ?>	
	
	
<style type="text/css">
	
.maintext {
	width: 100%;	
}

.photosidebar {
	display: none;
}

.photosidebarh6 {
	width: 80%;
	margin-left: 10%;
	margin-right: 10%;
}

.featurephoto {
	display: inline-block;
	width: 90%;
	margin-left: 0%;
	border-radius: 50%;
	border: 1px #000000 solid;
}

.photocontentbox {
	text-align: center;
	width: 100%;
}

.presenterphotocell {
	display: inline-block;
	vertical-align: top;
	margin: 0px;
	padding: 0px;
	width: 25%;
	margin-bottom: 10px;
	text-align: center;
}

@media (min-width: 500px) and (max-width: 768px)  {
	
	.presenterphotocell {
		
		width: 33.33% !important;
	}
	
}

@media (min-width: 300px) and (max-width: 499px)  {

	.presenterphotocell {
		
		width: 50% !important;
	}

	.photosidebarh6 {
		font-size: 3vw !important;
		line-height: 4vw;
	}
	
	.countrycolor {
		font-size: 3.8vw;
	}
	
	
}

@media (max-width: 299px)  {

	.presenterphotocell {
		
		width: 90% !important;
	}

	.photosidebarh6 {
		font-size: 5vw !important;
		line-height: 6vw;
	}
	
	.countrycolor {
		font-size: 6vw;
	}
	
}

</style>
	

	
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
			
			<h1>Presenters</h1>
			
			<p>WitchCon Online <?php echo $thisyear; ?> features over a hundred classes by over a hundred Witches and Conjurers from across the globe ready to share their time-honored wisdom and witchery. Our presenters are the preeminent masters of the magical arts and hail from across a rainbow spectrum of occult and spiritual practices. Each of them are engaging teachers and offer classes personally designed to help beginners, novices, and experts alike draw upon the power of magic! Click on any presenter below to see their bio and what they're offering for WitchCon Online <?php echo $thisyear; ?>.</p>
			
			
			
			<div class="photocontentbox">
				
	
				<?php

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					mysqli_query($conn,"SET CHARACTER SET 'utf8'");

					$sql = "SELECT PresentersName, Country, State, City, PhotoNameKey, ShowPresenterLink FROM $table1 ORDER BY PresentersName";


					// Show only Brian and Christian
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

						// output data of each row
						while($row = $result->fetch_assoc()) {

							$presentersname = $row["PresentersName"];
							$PhotoNameKey = $row["PhotoNameKey"];
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

							if ($row["ShowPresenterLink"] != "False") {

								if (($PhotoNameKey == "brian-cain") or ($PhotoNameKey == "christian-day")) {

									echo "<div class=\"presenterphotocell\"><a href=\"presenter.php?presenter=" . $PhotoNameKey . "\" class=\"featuredlink\"><img src=\"/presenterphotos/photo-". $PhotoNameKey . ".jpg\" class=\"featurephoto\" id=\"featurephotoid\" alt=\"" . $presentersname . "\" /><h6 class=\"photosidebarh6\">" . $presentersname . "<br><span class=\"countrycolor\">" . $citystate . $country . "</span></h6></a></div>";
								}

							}
						}
					} else {
						// leave blank
					}

					// Show everyone but Brian and Christian
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

						// output data of each row
						while($row = $result->fetch_assoc()) {

							$presentersname = $row["PresentersName"];
							$PhotoNameKey = $row["PhotoNameKey"];
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

							if ($row["ShowPresenterLink"] != "False") {

								if (($PhotoNameKey != "brian-cain") and ($PhotoNameKey != "christian-day")) {
									
									if ($presentersname == "Alexis A. Arredondo and Eric J. Labrado") {
										
										$presentersname = "Alexis A. Arredondo<br>and Eric J. Labrado";
									}

									echo "<div class=\"presenterphotocell\"><a href=\"presenter.php?presenter=" . $PhotoNameKey . "\" class=\"featuredlink\"><img src=\"/presenterphotos/photo-". $PhotoNameKey . ".jpg\" class=\"featurephoto\" id=\"featurephotoid\" alt=\"" . $presentersname . "\" /><h6 class=\"photosidebarh6\">" . $presentersname . "<br><span class=\"countrycolor\">" . $citystate . $country . "</span></h6></a></div>";

								}

							}
						}
					} else {
						// leave blank
					}

				?>
			</div>
						
			
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
		asdfadf
		<!-- InstanceEndEditable -->
			
			

				
		</div>

	</div>

</div>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bc383e4006419"></script>


</body>
<!-- InstanceEnd --></html>