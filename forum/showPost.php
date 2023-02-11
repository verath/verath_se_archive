<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<link href="forum.css" rel="stylesheet" type="text/css" />
<?php
include('function_lib.php');

function smilies($text)
{
	/*
		Funktion som omvandlar :) etc till bilder.
	*/
	$smilies['plaintext'] = array(":-)","(-:",":-(",")-:");
	$smilies['htmltext'] = array("<img src='pics/glad.png'>", "<img src='pics/glad.png'>","<img src='pics/sur.png'>", "<img src='pics/sur.png'>");
	$text = str_replace($smilies['plaintext'],$smilies['htmltext'],$text);
	return $text;
}

/*if(!$_COOKIE["name"]){
header("location: http://verath.se");
}*/
?>
<?php

// Olika namn för Forum Levlar
$LevelNames=array("Nykomling","Medlem","Aktiv Medlem","Stammis","<span style=\"color:red;\">Veteran</span>","<span style=\"color:blue\">Forum-admin</span>","<span style=\"color:green\">Admin</span>");

$name = $_COOKIE["name"];
include ('../dbconnect.php');
// GET USER Forum. Level 5 = ADMIN

$result = mysql_query("SELECT * FROM users");
while($row = mysql_fetch_array($result))
{
	$UserLevel[$row["UserName"]]=$row["ForumLevel"];
	$UserForumPosts[$row["UserName"]]=$row["ForumPosts"];
}
// Current users level (the 1 viewing the page)
$Level=$UserLevel[$name];


$OnlineCounter=0;
$result = mysql_query("SELECT * FROM users");
while($row = mysql_fetch_array($result))
{
	$OnlineRaw[$OnlineCounter]=$row['Online'];
	$OnlineName[$OnlineCounter]=$row['UserName'];
	$OnlineCounter++;
}

// Category name

// how many rows to show per page
	$rowsPerPage = 10;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if($_GET['page'])
{
    $pageNum = (int)$_GET['page'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$id=(int)$_GET["id"];
$post=array(); 
$c=0;
$TitleId=(int)$_GET["id"];
$result = mysql_query("SELECT * FROM forum_posts WHERE TitleId='$TitleId' ORDER BY Id LIMIT $offset, $rowsPerPage");
  while($row = mysql_fetch_array($result))
  {
  $Name[$c]=$row['Name'];
  $Content[$c]=smilies(bbcode($row['Content']));
  $Id[$c]=$row['Id'];
  $time[$c]=$row['Time'];
  $deleted[$c]=$row['Deleted'];
  $c++;
  }
  
  $result = mysql_query("SELECT * FROM forum WHERE id='$id'");
  while($row = mysql_fetch_array($result))
  {
	  $overCat=$row['InCategory'];
	  $catId=$row['InCategoryId'];
	  $PostTitle=$row['Title'];
	  $Locked=$row['Locked'];
  }
  
    // how many rows we have in database
$query   = "SELECT COUNT(Id) AS numrows FROM forum_posts WHERE TitleId='$TitleId'";
$result  = mysql_query($query) or die('Error, query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

$self = $_SERVER['PHP_SELF']."?id=".$_GET["id"];
  
mysql_close($con);

//Online now?
for($oc=0;$oc<$OnlineCounter;$oc++)
{
	$Online[$OnlineName[$oc]]="<img style=\"width:9px;height:9px;\" src=\"../pics/Offline.png\" alt=\"Offline\" />";
	if(time()-2*60<$OnlineRaw[$oc])
	{
		$Online[$OnlineName[$oc]]="<img style=\"width:9px;height:9px;\" src=\"../pics/Online.png\" alt=\"Online\" />";
	}
}
?>
<title>Forum | | 
<?php
if($Locked=="yes")
{
	$lockedText=" --(Låst)--";
}
echo urldecode($overCat)." -> -> ".urldecode($PostTitle).$lockedText;
?>
</title>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
<li><a class="menu_link" href='../../../kul'>Kul</a></li>
<li><a class="menu_link" href='../../../links'>Länkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'><strong>Forum</strong></a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<?php
// VISA TECKEN

if($_GET["sCode"])
{
	echo '<script type="text/javascript">alert("Femte teckenet är:\nM")</script>';
}
?>
<h3>
<?php
if($Locked=="yes")
{
	$lockedText=" <span style=\"color:blue\">*Låst*<br /></span>";
}
echo $lockedText."<a href=\"showCat.php?id=$catId\">".urldecode($overCat)."</a> -> -> ".urldecode($PostTitle) ." &nbsp;(Sida " . $pageNum . " av " . $maxPage. ")";
?>
</h3>
<?php
if($maxPage > 1)
{
	$linkNav="Sida: ";
	for($PageCount=1;$PageCount<=$maxPage;$PageCount++)
	{
	
		if($PageCount==$pageNum)
		{
			$linkNav.= "$PageCount ";
		}else
		{
			$linkNav.="<a href=\"$self&amp;page=$PageCount\">$PageCount</a> ";
		}
	
	}	
	
	echo "<p>$linkNav</p>";
	
}
?>
<div class="forum_post_top">
<?php
$loc=urlencode("showPost.php?id=".$id."&page=".$page);
for($a=0;$a<$c;$a++){
	if($deleted[$a]!=1)
	{
		echo "
<div class=\"forum_post\">";
		if(file_exists("../UserImages/".$Name[$a].".bmp")){
			$image="<img style=\"width:100px;height:100px;\" src=\"../UserImages/$Name[$a].bmp\" alt=\"{$Name[$a]}s bild\" />";
		}else{
			$image="<img style=\"width:100px;height:100px;\" src=\"../UserImages/Errors/no.bmp\" alt=\"{$Name[$a]}s bild\" />";
		}
		echo"
	<div class=\"forum_post_left\">
		<span style=\"font-size:9px;\">$time[$a]</span><br />
		{$Online[$Name[$a]]} <strong><a href=\"../desc/desc_show/?infoname=$Name[$a]\">$Name[$a]</a></strong><br />
		$image<br />
		{$LevelNames[$UserLevel[$Name[$a]]]}<br />
		Antal inlägg: {$UserForumPosts[$Name[$a]]}
	</div>
	<div class=\"forum_post_right\">
		$Content[$a]
	</div>
";
		if($Level>=5)
		{
			echo "
<div class=\"forum_delete_post\">
	<a href=\"changePost.php?postID={$Id[$a]}&amp;loc=$loc\">Ändra</a><br /><br /><br /><a href=\"javascript:if(confirm('Är du säker på att du vill ta bort inlägget?')){document.location.href=unescape('delPost.php%3Fid%3D')+'$Id[$a]'+unescape('%26loc%3DshowPost.php%3Fid%3D')+'$id'+unescape('%26')+'page=$pageNum'}\">Ta bort</a>
</div>";
		}elseif($name==$Name[$a])
		{
				echo "
				<div class=\"forum_delete_post\"><a href=\"changePost.php?postID={$Id[$a]}&amp;loc=$loc\">Ändra</a></div>
				";
		}
		echo"
</div>
		";
	}else{
		//Raderat inlägg
		echo "
		<div class=\"forum_post_deleted\">
			<!--<div class=\"forum_post_left\">
				Raderat
			</div>-->
			<div class=\"forum_post_right_deleted\">
				Inlägget har raderats.
			</div>
		</div>";
	}
}
?> 
</div>
<?
echo "<br style=\"clear:both\" /><p>".$linkNav."</p>";

// Annons efter sista posten
echo '
<div style="width:468px; height:60px; float:none; margin-left:auto; margin-right:auto;">
<script type="text/javascript"><!--
google_ad_client = "pub-9630536624744540";
/* 468x60, Forum (ändra + läsa inlägg) */
google_ad_slot = "5139190855";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
';

if($Locked=="yes")
{
	echo
	'
	<div class="forum_post_input">
	<p style="font-size:13px;"><strong>Den här tråden är låst. Du kan inte längre skriva i den.<br />Läsa i den går dock bra.</strong>
	</p>
	</div>
	';
	
	if($Level>=5)
	{
		echo "<br /><a href=\"lockPost.php?id=$id&amp;loc=showPost.php&amp;lock=no\">Lås upp tråden</a>";
	}
}
else if(isset($_COOKIE["name"]))
{

	echo'
	<div class="forum_post_input">
	<p><strong>Skriv ett svar:</strong></p>
	<form action="savePost.php" method="post">
	<p>
	<textarea name="content" rows="10" cols="10" style="width:400px; height:100px; font: 11px Verdana, Arial, Helvetica, sans-serif;"></textarea>
	<input type="hidden" value="'.$id.'" name="id" />
	<input type="submit" value="Spara" />
	<input type="hidden" name="loc" value="'.$_SERVER["SCRIPT_NAME"].'?page='.$_GET["page"].'" />
	</p>
	</form>
	</div>
	';
	
		
	if($Level>=5)
	{
		echo "<p><a href=\"lockPost.php?id=$id&amp;loc=showPost.php&amp;lock=yes\">Lås Tråden</a></p>";
	}
}
?>
</div>
</div>
<? 
$btmAd="no";
include ('../bottom_frame.php');?>
</div>
</div>

<script>
if(typeof(urchinTracker)!='function')document.write('<sc'+'ript src="'+
'http'+(document.location.protocol=='https:'?'s://ssl':'://www')+
'.google-analytics.com/urchin.js'+'"></sc'+'ript>')
</script>
<script>
try {
_uacct = 'UA-4927397-4';
urchinTracker("/2916749837/test");
} catch (err) { }
</script>

</body>
</html>