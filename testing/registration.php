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
	
<?php $numberphotos = 2; ?>
	
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
			
			 
			<h1>Registration</h1>
			<p>WitchCon Online 2021 registration includes admittance to all livestream video workshops, rituals, performances, and vendor Live Spales as well as our Zoom Virtual Video Meet and Greet! It also grants access to watch every workshop after the event has ended via our on-demand library so you don't have to miss a magical moment!</p>
			
			<p>WitchCon Online will be an opportunity to connect and study with leading Witches, Conjurers, and Rootworkers from around the world. Register now to join in the magic!
			</p>
			
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

		</div>

		<div class="photosidebar">
			
			<?php include ('/home/witchcon/public_html/presenterphotoinclude.php'); ?>
					
		</div>

	</div>

</div>
	
</body>
<!-- InstanceEnd --></html>