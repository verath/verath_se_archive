<?php
// Post Id variablen
$postID=(int)$_GET["postID"];

// namn variable
$name = $_COOKIE["name"];

// Var kommer bes�karen fr�n
if(!$_GET["loc"])
{
	$loc="http://verath.se/forum";
}else
{
	$loc=urldecode($_GET["loc"]);
}

//�ppna databasanslutning
include ('../dbconnect.php');

//h�mta information om inl�gget

$result = mysql_query("SELECT * FROM forum_posts WHERE Id='$postID' ORDER BY Id");
while($row = mysql_fetch_array($result))
{
	$Name=$row['Name'];
	$Content=$row['Content'];
	$deleted=$row['Deleted'];
}

// H�mta forumLevel �ver 5 �r admin

$result = mysql_query("SELECT * FROM users");
while($row = mysql_fetch_array($result))
{
	$UserLevel[$row["UserName"]]=$row["ForumLevel"];
	$UserForumPosts[$row["UserName"]]=$row["ForumPosts"];
}
// Level av anv�ndaren.
$Level=$UserLevel[$name];

// st�ng DB anslutning
mysql_close($con);

// om man inte �r authoriserad att �ndra den (inte �gare eller admin) visa den inte
if($name!=$Name && $Level < 5 || $Level < $UserLevel[$Name])
{
$error="Du har inte beh�righet att �ndra det h�r inl�gget.";
//header("Refresh: 4; URL=\"$loc\"");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<link href="forum.css" rel="stylesheet" type="text/css" />
<title>Forum | | �ndra Inl�gg</title>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>G�stbok</a></li>
<li><a class="menu_link" href='../../../kul'>Kul</a></li>
<li><a class="menu_link" href='../../../links'>L�nkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta anv�ndare</a></li>
<li><a class="menu_link" href='../../../forum'><strong>Forum</strong></a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<div style="width:410px; float:none; margin-left:auto; margin-right:auto;">
<p style="font-size:17px; font-style:oblique; text-align:center;">�ndra inl�gg</p>
<?php

echo "<p style=\"color:red; font-size:14px\">".$error."</p>";

?>

<?php
// Om det inte �r n�gra fel, skriv ut inneh�llet.
if(!$error)
{
	echo "<form action=\"saveChangePost.php\" method=\"post\">
<textarea name=\"content\" style=\"width:400px; height:500px; font: 11px Verdana, Arial, Helvetica, sans-serif;\">".
str_replace("<br />","",$Content).
"</textarea>
<br />
<br />
<input type=\"hidden\" value=\"$postID\" name=\"postID\" />
<input type=\"hidden\" value=\"" . urlencode($loc) . "\" name=\"loc\" />
<input type=\"submit\" name=\"submit\" value=\"Spara\" />
</form>";
}
?>
</div>

<!-- Annonser fr�n google -->
<div style="width:468px; height:60px; float:none; margin-left:auto; margin-right:auto; margin-top:10px;">
<script type="text/javascript"><!--
google_ad_client = "pub-9630536624744540";
/* 468x60, Forum �ndra */
google_ad_slot = "5139190855";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>

<!-- /Annonser fr�n google -->

</div>
</div>
<?
$btmAd="no";
include ('../bottom_frame.php');
?>
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