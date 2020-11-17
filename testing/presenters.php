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
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<!-- InstanceBeginEditable name="head" -->
	
<meta property="og:image" content="http://witchcon.com/images/EventBriteBG.jpg" />
<meta property="og:title" content="WitchCon Online 2021 - The World's Largest Online Magical Conference in <?php echo $thisyear; ?>!" />
<meta property="og:site_name" content="WitchCon"/>
<meta property="og:description" content="On August <?php echo $dayone; ?> to <?php echo $daythree; ?>, <?php echo $thisyear ?>, Brian Cain, Christian Day and the HEX Education Network present WitchCon Online 2021: the largest online magical conference in the world, devoted to Witchcraft, Conjure, and Rootwork, where you can connect with leading experts on the arts of magic from across the globe!" />
	
<link href="../styles-presenters.css" rel="stylesheet" type="text/css" media="screen">
	
<?php $page = "presenters"; ?>
	
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
			
			<h1>Presenters</h1>
			<p>WitchCon Online <?php echo $thisyear; ?> has gathered Witches, Rootworkers, Conjurers, and other magical teachers from around the world to deliver their time-honored wisdom to conference attendees. Presenters hail from across the spectrum of Witchcraft and magic and offer a variety of workshops designed to help participants draw on the power from within! Click on any presenter below to see their bio.</p> 
			
			
			<div class="photocontentbox">
				
	
				<?php

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					mysqli_query($conn,"SET CHARACTER SET 'utf8'");

					$sql = "SELECT PresentersName, Country, PhotoNameKey, ShowPresenterLink FROM $table1 ORDER BY PresentersName";


					// Show only Brian and Christian
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

						// output data of each row
						while($row = $result->fetch_assoc()) {

							$presentersname = $row["PresentersName"];
							$PhotoNameKey = $row["PhotoNameKey"];
							$Country = $row["Country"];

							if ($row["ShowPresenterLink"] != "False") {

								if (($PhotoNameKey == "brian-cain") or ($PhotoNameKey == "christian-day")) {

									echo "<div class=\"presenterphotocell\"><a href=\"presenter.php?presenter=" . $PhotoNameKey . "\" class=\"featuredlink\"><img src=\"/presenterphotos/photo-". $PhotoNameKey . ".jpg\" class=\"featurephoto\" id=\"featurephotoid\" alt=\"" . $presentersname . "\" /><h6 class=\"photosidebarh6\">" . $presentersname . "<br><span class=\"countrycolor\">" . $Country . "</span></h6></a></div>";
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
							$Country = $row["Country"];

							if ($row["ShowPresenterLink"] != "False") {

								if (($PhotoNameKey != "brian-cain") and ($PhotoNameKey != "christian-day")) {
									
									if ($presentersname == "Alexis A. Arredondo and Eric J. Labrado") {
										
										$presentersname = "Alexis A. Arredondo<br>and Eric J. Labrado";
									}

									echo "<div class=\"presenterphotocell\"><a href=\"presenter.php?presenter=" . $PhotoNameKey . "\" class=\"featuredlink\"><img src=\"/presenterphotos/photo-". $PhotoNameKey . ".jpg\" class=\"featurephoto\" id=\"featurephotoid\" alt=\"" . $presentersname . "\" /><h6 class=\"photosidebarh6\">" . $presentersname . "<br><span class=\"countrycolor\">" . $Country . "</span></h6></a></div>";

								}

							}
						}
					} else {
						// leave blank
					}

				?>
			</div>
			
			<br><br>
			<div class="registrationfooter"><h3><a href="registration.php">Register for WitchCon Online!</a></h3></div>
			<br><br>
			
			
<!-- InstanceEndEditable -->

		</div>

		<div class="photosidebar">
			
			<?php include ('/home/witchcon/public_html/presenterphotoinclude.php'); ?>
					
		</div>

	</div>

</div>
	
</body>
<!-- InstanceEnd --></html>