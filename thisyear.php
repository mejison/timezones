<?php

/* THIS DATE IS CHANGED TO THE FOLLOWING YEAR AT 4PM CENTRAL THE FRIDAY OF HEXFEST!  */

$thisyear = '2021';


/* DO NOT CHANGE ANYTHING BELOW HERE!  */

$daythree = date('d', strtotime('first sun of march ' . $thisyear));
$daythree = ltrim($daythree, '0');
$daytwo = $daythree - 1;
$dayone = $daytwo - 1;

$projectoricon = "<img src=\"images/projector-screen.svg\" height=\"19\" width=\"19\" alt=\"Multimedia\"/>";
$projectoriconsmall = "<img src=\"images/projector-screen.svg\" height=\"16\" width=\"16\" alt=\"Multimedia\"/>";

if ($dayone == "1") {
	$dayonesuffix = "st";
}
if ($dayone == "2") {
	$dayonesuffix = "nd";
}
if ($dayone == "3") {
	$dayonesuffix = "rd";
}
if (($dayone != "1") && ($dayone != "2") && ($dayone != "3"))  {
	$dayonesuffix = "th";
}

if ($daytwo == "1") {
	$daytwosuffix = "st";
}
if ($daytwo == "2") {
	$daytwosuffix = "nd";
}
if ($daytwo == "3") {
	$daytwosuffix = "rd";
}
if (($daytwo != "1") && ($daytwo != "2") && ($daytwo != "3"))  {
	$daytwosuffix = "th";
}

if ($daythree == "1") {
	$daythreesuffix = "st";
}
if ($daythree == "2") {
	$daythreesuffix = "nd";
}
if ($daythree == "3") {
	$daythreesuffix = "rd";
}
if (($daythree != "1") && ($daythree != "2") && ($daythree != "3"))  {
	$daythreesuffix = "th";
}

?>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '3151766171579005');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=3151766171579005&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
