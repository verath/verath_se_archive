<?php
// Post Id variablen
$postID=(int)$_POST["postID"];

// namn variable
$name = $_COOKIE["name"];

// Var kommer besökaren från
if(!$_POST["loc"])
{
	$loc="http://verath.se/forum";
}else
{
	$loc=urldecode($_POST["loc"]);
}

// innehållet
$content=htmlspecialchars($_POST['content']);
$content=nl2br($content);
$content=str_replace("\n","",$content);
//öppna databasanslutning
include ('../dbconnect.php');

//hämta information om inlägget

$result = mysql_query("SELECT * FROM forum_posts WHERE Id='$postID' ORDER BY Id");
while($row = mysql_fetch_array($result))
{
	$Name=$row['Name'];
}

// Hämta forumLevel över 5 är admin

$result = mysql_query("SELECT * FROM users");
while($row = mysql_fetch_array($result))
{
	$UserLevel[$row["UserName"]]=$row["ForumLevel"];
	$UserForumPosts[$row["UserName"]]=$row["ForumPosts"];
}
// Level av användaren.
$Level=$UserLevel[$name];


// om man inte är authoriserad att ändra den (inte ägare eller admin) redirecta
if($name!=$Name && $Level < 5 && $Level < $UserLevel[$Name])
{
	header("location: $loc");
	exit;
}

// Reverse magic_quotes_gpc/magic_quotes_sybase effects on those vars if ON.

	if(get_magic_quotes_gpc()) {
		$content = stripslashes($content);
	}
	
	$content = mysql_real_escape_string($content);

mysql_query("UPDATE forum_posts SET Content='$content' WHERE Id='$postID' LIMIT 1")or die(mysql_error());
header("location: $loc");

// stäng DB anslutning
mysql_close($con);
?>