<?php

session_start();

// Funktion NewestForum()
function NewestForum()
{
	include('newestForum.php');
	echo "<div style=\"float:right; width:170px; overflow:hidden; border:1px solid black; padding:3px 3px 3px 3px; margin:8px 8px 8px 8px;\">
<p><strong><span class=\"newestTreadTitle\">Forumtrådar:</span></strong><br />";

	//Nyaste trådarna
	for($i=0;$i<5;$i++)
	{
		$newestTread[$i]=urldecode($newestTreadName[$i]) . " - " .urldecode($newestTreadTitle[$i]);
		$newestTreadTitle[$i]=urldecode($newestTreadTitle[$i]);
		if(strlen($newestTread[$i])>23)
		{
			$newestTread[$i]=substr($newestTread[$i],0,23)."...";
		}
		echo "<a href=\"/forum/showPost.php?id=$newestTreadId[$i]\" title=\"$newestTreadTitle[$i]\">".$newestTread[$i] . "</a><br />";
	}
	
	//nyaste inläggen
	echo "<br /><strong><span class=\"newestPostTitle\">Inlägg i forumet:</span></strong><br />";
	for($i=0;$i<5;$i++)
	{
		$postNewest[$i]=urldecode($postNewestName[$i]). " - " .urldecode($postNewestTitle[$i]);
		$postNewestTitle[$i]=urldecode($postNewestTitle[$i]);
		if(strlen($postNewest[$i])>23)
		{
			$postNewest[$i]=substr($postNewest[$i],0,23)."...";

		}
		echo "<a href=\"/forum/showPost.php?id=$postNewestPostId[$i]\" title=\"$postNewestTitle[$i]\">".$postNewest[$i] . "</a><br />";
	}
	
	echo "</p></div>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript">
function html_entity_decode( string ) {
    var ret, tarea = document.createElement('textarea');
    tarea.innerHTML = string;
    ret = tarea.value;
    return ret;
}
</script>

<title>Veraths</title>
<meta name="verify-v1" content="xVyAQdHa3kuRlUYvOdZMrCPQhUQ76+UrXLtQRfCb48M=" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Skapa en användare och kom med i Verath.se! Skicka medelanden, spela spel eller skriv i forumet." />
<meta name="keywords" content="Verath, Gästbok, Medelanden, Flash, Spel" />
<link href="layout.css" rel="stylesheet" type="text/css" />
<link href="meny.css" rel="stylesheet" type="text/css" />
<link href="guestbook_small/guestbook_small.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />
<style type="text/css">
p.green
{
  color: Green;
  margin: 0 0 0 0;
}
.underline
{
font-size:14px;
text-decoration: underline;
}
p.red
{
  color: Red;
  margin: 0 0 0 0;
}
p.blue
{
  color: Blue;
  margin: 0 0 0 0;
}
</style>
<link href="clouds.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/chkC.js"></script>
</head>
<body onkeyup="chkC(event)">
<div id="sidlayout">
<?php include "login.php"; ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><strong><a class="menu_link" href='../../../'>Hem</a></strong></li>
<li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
<li><a class="menu_link" href='../../../kul'>Kul</a></li>
<li><a class="menu_link" href='../../../links'>Länkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<?php

include "dbconnect.php";



$query  = "SELECT * FROM users ORDER BY `LastOnline` DESC";
$result = mysql_query($query);
$i=0;
$LAcount = 0;
while($row = mysql_fetch_array($result))
{
	
	// Senast inloggade
	if($LAcount < 4)
	{
		if(time()-2*60<$row['Online'])
		{
			// Om personen är online, gör så namnet är grönt
			$onlineColor="<span style=\"color:green\">";
		}else
		{
			// Om personen inte är online, gör så att namnet visas i rött
			$onlineColor="<span style=\"color:red\">";
		}
		if(file_exists("UserImages/".$row['UserName'].".bmp"))
		{
			$image="
			<div class=\"FirstPageImage\">
			<a href=\"/desc/desc_show/?infoname={$row['UserName']}\">
			<img style=\"width:150px;height:150px;border:none;\" src=\"UserImages/{$row['UserName']}.bmp\" alt=\"{$row['UserName']}s Bild\" title=\"{$row['UserName']}s Bild\" />
			</a>
			<br />
			<strong> $onlineColor {$row['UserName']}</span></strong>
			</div>
			";
		}else
		{
		$image="
		<div class=\"FirstPageImage\">
		<a href=\"/desc/desc_show/?infoname={$row['UserName']}\"><img style=\"width:150px;height:150px;border:none;\" src=\"UserImages/Errors/no.bmp\" alt=\"{$row['UserName']}s Bild\" title=\"{$row['UserName']}s Bild\" />
		</a>
		<br />
		<strong> $onlineColor {$row['UserName']}</span></strong>
		</div>
		";
		}
	$userLatestOnline.=$image;
	$LAcount++;
}
  
  // hur många har varit här den här månaden
  
   if($row['UserVisit']==date(m)){
    $users[$i]=$row['UserName'];
    $i++;
   }
  }
	  echo "
<h3>Senast inloggade:</h3>
<div class=\"FirstPageImageContainer\">
	$userLatestOnline
</div>
";
// Skriv ut de nyaste forum inläggen + posts.
NewestForum();

  $result = mysql_query("SELECT * FROM `users` ORDER BY `Created` DESC LIMIT 0 , 4");
  $i=0;
  while($row = mysql_fetch_array($result))
  {
  $lastCreated.="<a href=\"/desc/desc_show/?infoname={$row['UserName']}\">{$row['UserName']}</a><br />";
  }


$query  = "SELECT * FROM info";
  $result = mysql_query($query);
  $i=0;
  while($row = mysql_fetch_array($result))
  {
    $viewstot=$row['ViewsTot']+1;
  }
mysql_query("UPDATE info SET ViewsTot = '$viewstot'");



$query  = "SELECT * FROM info";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
  {
    $info=$row['Info'];
    $LogedinInfo=$row['LogedinInfo'];
}
if(empty($logedin))
{
echo $info;
}
else
{
echo "<h3>Välkommen $name till verath.se</h3>";
echo $LogedinInfo;
}
echo "\n"; // Byt rad

  if($LastOnline)
  {
  echo "<br />Ditt senaste besök: $LastOnline.";
  }
  
     mysql_close($con);
	 
  echo "<script type='text/javascript'>var opened=0;var users=html_entity_decode('";
foreach ($users as $value)
{
echo htmlentities("<a href=\"../../desc/desc_show/?infoname=".$value."\">".$value."<\/a><br />");
}
echo "');</script>";

// användare som varit här
echo "
<p class=\"blue\">Användare som varit här den här månaden:&nbsp;&nbsp;&nbsp;</p>
<a href=\"javascript:if(opened==0){document.getElementById('link').innerHTML='Dölj';document.getElementById('user').innerHTML=users;opened=1;void(0);}else{document.getElementById('link').innerHTML='Visa';document.getElementById('user').innerHTML='';opened=0;void(0);};\" id='link'>
Visa
</a>
<p id='user'>
";
$user = $_REQUEST["user"];
if(empty($logedin)){
if(!empty($user))
{
echo "<br /><div align='center'><h4>Hej " . $user . "! Du kan logga in i menyn till vänster.</h4></div>";
}
}
?>
</p>
</div>
</div>
<?php

// Sidvisningar + nyaste medlemmar
if ( $name )
{
echo "<div class=\"StatusLeft\">
<p style=\"color:red;\"><span style=\"text-align:left;\">Antal sidvisningar: $viewstot</span><br /><br />
Nyaste medlemmarna:<br />
$lastCreated</p>
</div>";
}

?>
<? /* Copyright Frame */ ?>
<div id="bottom_frame">
<div id="btn_txt">
<p><a href="/sitemap">Sitemap</a><br /><a href="http://krullet.se">Krullet.se</a><br /><a href="./rules/cookies.php">Kakor</a></p>
<? include('copyright.php'); ?>
</div>
</div>
<? /* Copyright Frame end */ ?>
</div>
<!-- Google Analytics -->
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