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
<title>WitchCon Online 2021 - The World's Largest Online Magical Conference in <?php echo $thisyear; ?>!</title>
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- InstanceBeginEditable name="head" -->
	
<meta property="og:image" content="http://witchcon.com/images/facebook-og.jpg" />
<meta property="og:title" content="WitchCon Online <?php echo $thisyear; ?> - The World's Largest Online Magical Conference!" />
<meta property="og:site_name" content="WitchCon Online"/>
<meta property="og:description" content="March <?php echo $dayone; ?><?php echo $dayonesuffix; ?> to <?php echo $daythree; ?><?php echo $daythreesuffix; ?>, <?php echo $thisyear; ?>, Brian Cain, Christian Day and the HEX Education Network present WitchCon Online, featuring over a hundred classes by over a hundred Witches and Conjurers from across the globe ready to share their time-honored wisdom and witchery." />

<?php $page = "home"; ?>

	
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
			
			<p>March <?php echo $dayone; ?><sup><?php echo $dayonesuffix; ?></sup> to <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear; ?>, <a href="/presenter.php?presenter=brian-cain">Brian Cain</a>, <a href="/presenter.php?presenter=christian-day">Christian Day</a> and the HEX Education Network present WitchCon Online, featuring <a href="/schedule.php">over a hundred classes</a> by over a hundred Witches and Conjurers from across the globe ready to share their time-honored wisdom and witchery.</p>
				
			<p>WitchCon Online <a href="/presenters.php">presenters</a> are the preeminent masters of the magical arts and hail from across a rainbow spectrum of occult and spiritual practices. Their classes are personally designed to help beginners, novices, and experts alike draw upon the power of magic!</p>
			
			<p>WitchCon Online <?php echo $thisyear; ?> <a href="/registration.php">registration</a> includes admittance to all livestream video <a href="/schedule.php">classes, rituals, and performances</a>, each personally designed to help beginners, novices, and experts alike draw upon the power of magic. It also grants access to watch every class after the event has ended via our on-demand library so you don't have to miss a magical moment!</p>
			
			<p>The conference is livestreamed by the <a href="https://www.crowdcast.io/hexeducation">Hex Education Network</a> on Crowdcast, a web-based platform with no need to download an app!</p>

			<p>WitchCon Online attendees will love <a href="/vendors.php">shopping live</a> with our magical presenters, each showcasing powerful ritual tools, signed books, exquisite jewelry, and spellcrafts handmade by true practitioners in half-hour Live Sales. You don’t have to travel to the ends of the Earth to scour the witch markets: you can buy from enchanting artisans and score amazing tools and talismans from the comfort of your own home. Our Virtual Vendors’ Hall is free to the public as well!</p>
			
			<p>The WitchCon Online <a href="/meetandgreet.php">Virtual Meet and Greet</a> lets you meet and interact live on Zoom with WitchCon presenters and its hosts Brian Cain and Christian Day. This is a great way to get to know your favorite teachers and what's even better is that it's free and open to the public!</p>
	
			
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