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
<title>WitchCon Online <?php echo $thisyear; ?> - Virtual Meet and Greet on Zoom!</title>
<!-- InstanceEndEditable -->
	
<link href="styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- InstanceBeginEditable name="head" -->
		
<meta property="og:image" content="http://witchcon.com/images/facebook-og.jpg" />
<meta property="og:title" content="WitchCon Online <?php echo $thisyear; ?> - Virtual Meet and Greet on Zoom!" />
<meta property="og:site_name" content="WitchCon Online"/>
<meta property="og:description" content="The WitchCon Online <?php echo $thisyear; ?> Virtual Meet and Greet lets you meet and chat live on Zoom with WitchCon presenters and its hosts Brian Cain and Christian Day. The Meet and Greet is open from 9 am to 6 pm CST on Saturday and Sunday, March <?php echo $daytwo; ?><sup><?php echo $daytwosuffix; ?></sup>  and <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear; ?>. This is a great way to get to know your favorite teachers and what's even better is that it's free and open to the public!" />
	
<?php $page = "meetandgreet"; ?>

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
			
			 
			<h1>Virtual Meet and Greet</h1>
			<h2>Free Admission, March <?php echo $daytwo; ?><sup><?php echo $daytwosuffix; ?></sup> and <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear; ?></h2>
			<p>The WitchCon Online <?php echo $thisyear; ?> Virtual Meet and Greet lets you meet and chat live on Zoom with WitchCon presenters and its hosts Brian Cain and Christian Day. The Meet and Greet is open from 9 am to 6 pm CST on Saturday and Sunday, March <?php echo $daytwo; ?><sup><?php echo $daytwosuffix; ?></sup> and <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear; ?>. This is a great way to get to know your favorite teachers and what's even better is that it's free and open to the public!</p>
		
			<h3>Saturday, March <?php echo $daytwo; ?><sup><?php echo $daytwosuffix; ?></sup>, 9 am to 6 pm <span class="cst">cst</span></h3>
			<p><a href="https://us02web.zoom.us/j/83820913503">Click to enter Saturday's Virtual Meet and Greet.</a>*</p>
			
			<h3>Sunday, March <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, 9 am to 6 pm <span class="cst">cst</span></h3>
			<p><a href="https://us02web.zoom.us/j/88124256637">Click to enter Sunday's Virtual Meet and Greet.</a>*</p>
			
			<p>* Meetings will be active at their appointed times.</p>
			
			<p><a href="https://wwww.zoom.us">Click here to get Zoom!</a></p>
			
			


			
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
		<?php $numberphotos = 1; include ('/home/witchcon/public_html/presenterphotoinclude.php'); ?>
		<!-- InstanceEndEditable -->
			
			

				
		</div>

	</div>

</div>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bc383e4006419"></script>


</body>
<!-- InstanceEnd --></html>