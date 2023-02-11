<?php
$name=$_COOKIE["name"];
if($name)
{
	$time=time();
	include ('dbconnect.php');
   //echo "<!--UPDATE users SET Online = '$time' WHERE UserName = '$name' -->";
	mysql_query("UPDATE users SET Online = '$time' WHERE UserName = '$name'");
	mysql_close($con);
}



?>