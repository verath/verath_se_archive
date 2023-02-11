<?php 
function IPtoCoords($ip)
{
	$dom = new DOMDocument();
	$ipcheck = ip2long($ip);
    if($ipcheck == -1 || $ipcheck === false)
	{
    	return false;
	}
	else
	{
		$uri = 'http://api.hostip.info/?ip=' . $ip;
	}
 
	$dom->load($uri);
	$location = (strpos($dom->getElementsByTagName('name')->item(1)->nodeValue, 'Unknown') === false)
					? $dom->getElementsByTagName('name')->item(1)->nodeValue
					: $dom->getElementsByTagName('countryAbbrev')->item(0)->nodeValue;
 	$cords= $dom->getElementsByTagName('coordinates')->item(0)->nodeValue;
	if(!$cords)
	{
		$cords="14.8974609375,61.3546135846894";
		$cordError="<br /><span style=\"color:red\">Det gick inte att fastställa din position...</span>";
	}
	if($location == 'XX')
	{
		return false;
	}
	else
	{
		//$dom->load('http://local.yahooapis.com/MapsService/V1/geocode?appid=YahooDemo&location=' . $location);
		//$longitude = $dom->getElementsByTagName('Longitude')->item(0)->nodeValue;
		//$latitude  = $dom->getElementsByTagName('Latitude')->item(0)->nodeValue;
		return array('location' => utf8_decode($location), 'cords' => $cords);//, 'longitude' => $longitude, 'latitude' => $latitude);
	}
}
$IpInfo=IPtoCoords($_SERVER['REMOTE_ADDR']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAtDiVYYN7mfdEhJhOT7aQvxRcvlXDyfiG9ZGQLOdnW31eJyAmFhTQ7JYjLWv736Z6hfQWagpKETR0GA"
      type="text/javascript"></script>
    <script type="text/javascript">

    //<![CDATA[

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap(document.getElementById("map"));
   		map.centerAndZoom(new GPoint(<?=$IpInfo['cords'];?>), 13);
    	var point = new GPoint(<?=$IpInfo['cords'];?>);
    	var marker = new GMarker(point);
    	map.addOverlay(marker);

      }
    }

    //]]>
    </script>
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1" />
<title>Info om din webbl&auml;sare...</title>
</head>
<body onload="load()" onunload="GUnload()">
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>G&auml;stbok</a></li>
<li><a id="selected" href='../../../kul'><strong>Kul</strong></a></li>
<li><a class='selected_sub' href='../../../game/spel.php'>Musspelet</a></li>
<li><a class='selected_sub' href='../../../game/guess.php'>Gissa nummer</a></li>
<li><a class='selected_sub' href='../../../highscore.php'>Highscore</a></li>
<li><a class='selected_sub' href='../../../html_edit'>HTML editor</a></li>
<li><a class='selected_sub' href='../../../quiz'>Fr&aring;gesport</a></li>
<li><a class='selected_sub' href='../../../hakk'>Hacking</a></li>
<li><a class='selected_sub' href='/kul/history'>"Historia"</a></li>
<li><a class="menu_link" href='../../../links'>L&auml;nkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta anv&auml;ndare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<style type="text/css">
.infoWebb
{
	color:blue;
}
.infoComp
{
	color: #006600;
}
.infoAnsl
{
	color:#CC0000;
}
</style>
<div style="width: 400px; float:left;">
<h2>
<?php
echo $_SERVER['REMOTE_ADDR']
?>
</h2>
<h3 style="color:blue;">Info om din webbl&auml;sare</h3>
<p>
Webbl&auml;sare: <span id="browser" class="infoWebb"></span><br />
Info om webbl&auml;sare: <span id="userAgent" class="infoWebb"></span><br />
Version: <span id="version" class="infoWebb"></span><br />
Kod-namn: <span id="code" class="infoWebb"></span><br />
Till&aring;ts kakor: <span id="cookie" class="infoWebb"></span><br />
Java: <span id="java" class="infoWebb"></span><br />
Sidor visade: <span id="pages" class="infoWebb"></span><br />
</p>
<h3 style="color:#006600">Info om din dator</h3>
<p>
Uppl&ouml;sning: <span id="rez" class="infoComp"></span><br />
Tillg&auml;nglig uppl&ouml;sning: <span id="availrez" class="infoComp"></span><br />
F&auml;rgdjup: <span id="colorDep" class="infoComp"></span><br />
Spr&aring;k: <span id="lang" class="infoComp"></span><br />
Operativsystem: <span id="platform" class="infoComp"></span><br />
</p>
<h3 style="color:#CC0000">Information om din anslutning till servern</h3>
<p>
<?php
echo "
IP: <span class=\"infoAnsl\">" . $_SERVER['REMOTE_ADDR']. "</span><br />";

echo "
Port: <span class=\"infoAnsl\">" . $_SERVER['REMOTE_PORT']. "</span><br />";

echo "
Länk från: <span class=\"infoAnsl\">" . $_SERVER['HTTP_REFERER']. "</span><br />";

echo "
Stad: <span class=\"infoAnsl\">" . $IpInfo['location'] . "</span><br />";

echo "
På karta: $cordError<br />";

?>
</p>
</div>
<div style="float:right; width:120px;">
<script type="text/javascript"><!--
google_ad_client = "pub-9630536624744540";
/* 120x240, Info, Höger */
google_ad_slot = "4653242031";
google_ad_width = 120;
google_ad_height = 240;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<div id="map" style="width: 500px; height: 300px; float:left;"></div>
<script type="text/javascript">

//Läsare
Browser = navigator.appName;
document.getElementById('browser').innerHTML = Browser;

//Läsar Version
Browserversion = navigator.appVersion;
document.getElementById('version').innerHTML = Browserversion;

// Kod-namn
Code = navigator.appCodeName;
document.getElementById('code').innerHTML = Code;

// Operativsystem
Platform = navigator.platform;
document.getElementById('platform').innerHTML = Platform;

// Kakor
Cookies = navigator.cookieEnabled;
if(Cookies)
{
	Cookies="Ja";
}else
{
	Cookies="Nej";
}
document.getElementById('cookie').innerHTML = Cookies;

//UserAgent
userAgent = navigator.userAgent;
document.getElementById('userAgent').innerHTML = userAgent;

// Java På?
Java=navigator.javaEnabled();
if(Java)
{
	Java="Ja";
}else
{
	Java="Nej";
}
document.getElementById('java').innerHTML = Java;

// upplösningn
Rez=window.screen.width + " x " + window.screen.height;
document.getElementById('rez').innerHTML = Rez;

// max-upplösningn
availRez = window.screen.availWidth + " x " + window.screen.availHeight;
document.getElementById('availrez').innerHTML = availRez;

// färg Djup
colorDepth = window.screen.colorDepth + " bitar";
document.getElementById('colorDep').innerHTML = colorDepth;

// Språk
if (navigator.language)
{
	lang=navigator.language;
} 
else if(navigator.userLanguage)
{
	lang=navigator.userLanguage;
} 
document.getElementById('lang').innerHTML = lang;

// Historia
Pages=history.length;
document.getElementById('pages').innerHTML = Pages;
</script>
</div>
</div>
<? include ('../bottom_frame.php');?>
</div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4927306-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</body>
</html>