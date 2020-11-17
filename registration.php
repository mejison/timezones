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
<title>WitchCon Online <?php echo $thisyear; ?> Registration!</title>
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- InstanceBeginEditable name="head" -->
		
<meta property="og:image" content="http://witchcon.com/images/facebook-og.jpg" />
<meta property="og:title" content="WitchCon Online <?php echo $thisyear; ?> Registration!" />
<meta property="og:site_name" content="WitchCon Online"/>
<meta property="og:description" content="WitchCon Online <?php echo $thisyear; ?> registration includes admittance to all livestream video classes, rituals, and performances, each personally designed to help beginners, novices, and experts alike draw upon the power of magic. It also grants access to watch every class after the event has ended via our on-demand library so you don't have to miss a magical moment!" />
	
	
<?php $page = "registration"; ?>	
	
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
			
			 
			<h1>Registration</h1>
			<p>WitchCon Online <?php echo $thisyear; ?> registration includes admittance to all livestream video <a href="/schedule.php">classes, rituals, and performances</a>, each personally designed to help beginners, novices, and experts alike draw upon the power of magic. It also grants access to watch every class after the event has ended via our on-demand library so you don't have to miss a magical moment! Live sales in our <a href="vendors.php">Virtual Vendors’ Hall</a> and our <a href="/meetandgreet.php">Virtual Meet and Greet on Zoom</a> are free and open to the public.</p>
			
			<p>Registration is capped at 1,000 attendees so be sure to register while slots are still available!</p>
			
			<p>The conference is livestreamed by the <a href="https://www.crowdcast.io/hexeducation">Hex Education Network</a> on Crowdcast, a web-based platform with no need to download an app!</p>
			
			<p>WitchCon Online <?php echo $thisyear; ?> brings you together with over a hundred Witches and Conjurers and other seekers just like you from across the globe. Register now to bring the magic to you!</p>
			
			<div id="eventbrite-widget-container-114840107854"></div>

			<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>

			<script type="text/javascript">
				var exampleCallback = function() {
					console.log('Order complete!');
				};

				window.EBWidgets.createWidget({
					// Required
					widgetType: 'checkout',
					eventId: '114840107854',
					iframeContainerId: 'eventbrite-widget-container-114840107854',

					// Optional
					iframeContainerHeight: 425,  // Widget height in pixels. Defaults to a minimum of 425px if not provided
					onOrderComplete: exampleCallback  // Method called when an order has successfully completed
				});
			</script>
			
			
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
		<?php $numberphotos = 2; include ('/home/witchcon/public_html/presenterphotoinclude.php'); ?>
		<!-- InstanceEndEditable -->
			
			

				
		</div>

	</div>

</div>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bc383e4006419"></script>


</body>
<!-- InstanceEnd --></html>