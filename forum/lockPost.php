<?php
if(!$_COOKIE["name"])
{
	header("location: http://verath.se");
	exit;
}

$loc=$_GET["loc"]."?id=".$_GET["id"];
$name=$_COOKIE["name"];
$id=$_GET["id"];
$lock=$_GET["lock"];

include ('../dbconnect.php');

$result = mysql_query("SELECT ForumLevel FROM users WHERE UserName='$name'");

while($row = mysql_fetch_array($result))
{
	$Level=$row["ForumLevel"];
}

if($Level>=5)
{
	//mysql_query("DELETE FROM forum_posts WHERE Id='$id' LIMIT 1") or die(mysql_error());
	mysql_query("UPDATE forum SET Locked = '$lock' WHERE Id='$id' LIMIT 1") or die(mysql_error());
}

header("location: $loc");
?>