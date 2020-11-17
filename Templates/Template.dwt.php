<!doctype html>
<html>
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


<!-- TemplateBeginEditable name="doctitle" -->
<title>WitchCon Online <?php echo $thisyear ?> - The World's Largest Online Magical Conference in <?php echo $thisyear; ?>!</title>
<!-- TemplateEndEditable -->
	
<link href="../styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="../MyFontsWebfontsKit.css" rel="stylesheet" type="text/css">
	
<link rel="stylesheet" href="https://use.typekit.net/xys4fst.css">
	
<meta property="og:url" content="https://www.witchcon.com<?php echo $whatpage; ?>" />

<!-- TemplateBeginEditable name="head" -->	
<meta property="og:image" content="http://witchcon.com/images/facebook-og.jpg" />
<meta property="og:title" content="WitchCon Online 2021 - The World's Largest Online Magical Conference in <?php echo $thisyear; ?>!" />
<meta property="og:site_name" content="WitchCon"/>
<meta property="og:description" content="Bring the Magic to You!</h2><p>On March <?php echo $dayone; ?> to <?php echo $daythree; ?>, <?php echo $thisyear ?>, join the largest online magical conference in the world, featuring one hundred Witches and Conjurers coming to you by livestream video from across the globe!" />
	
<!-- TemplateEndEditable -->	
	
</head>

<body>

<div class="mainbox">
	<div class="herobox <?php if ($page != "home") { echo "heroboxsub"; }; ?>">
		<a href="/"><img src="../images/logo.png" class="logo <?php if ($page != "home") { echo "logosub"; }; ?>" alt=""/><img src="../images/logo-witchcon-exocet-only-2line.png" class="<?php if ($page == "home") { echo "hide"; }; ?> <?php if ($page != "home") { echo "logosubalt"; }; ?>" alt=""/></a>
		
		<div class="herotext herotextalt <?php if ($page == "home") { echo "hide"; }; ?>"><h2 class="heroh2 heroh2alt">March <?php echo $dayone; ?><sup><?php echo $dayonesuffix; ?></sup> to <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear ?></h2></div>
		
		<div class="herotext <?php if ($page != "home") { echo "herotextsub"; }; ?>"><h2 class="heroh2">Bring the Magic to You!</h2><p>March <?php echo $dayone; ?><sup><?php echo $dayonesuffix; ?></sup> to <?php echo $daythree; ?><sup><?php echo $daythreesuffix; ?></sup>, <?php echo $thisyear ?>, join the largest online magical conference in the world, featuring over a hundred Witches and Conjurers coming to you by livestream video from across the globe!</p></div>
	</div>


 

	<div class="navbox">
		<ul class="nav"><li class="button buttonregistration"><a href="../registration.php" class="navlink">Registration</a></li><li class="button buttonpresenters"><a href="../presenters.php" class="navlink">Presenters</a></li><li class="button buttonschedule"><a href="../schedule.php" class="navlink">Schedule</a></li><li class="button buttonvendors"><a href="../vendors.php" class="navlink">Vendors</a></li></ul>
	</div>



	<div class="contentbox">
		<div class="maintext">

<!-- TemplateBeginEditable name="CONTENT" -->
			
			<p>Placeholder text.</p>
				
			
			
<!-- TemplateEndEditable -->
			
			<?php if ($page != "registration") { ?>
				<div class="registrationfooter"><h3><a href="registration.php">Register for WitchCon Online!<br>
					<img src="../images/logo-witchcon-exocet-only-2line.png" class="footerlogo" alt=""/></a></h3>
				</div>
			<?php } ?>
			
			
			<br><br>

		</div>
		
		<div class="photosidebar">
			
		<!-- TemplateBeginEditable name="contentsidebar" -->
		asdfadf
		<!-- TemplateEndEditable -->
			
			

				
		</div>

	</div>

</div>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bc383e4006419"></script>


</body>
</html>