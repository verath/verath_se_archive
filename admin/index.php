<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Admin</title>
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
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<p style="margin:5px">
Admin:<br>
Home || <a href="quiz.php">Quiz</a> || <a href="../guestbook/">Guestbook</a></p>
<div id="content">
<?
$name=$_COOKIE["name"];
$admin="Verath";
if($name==$admin){
include('../dbconnect.php');
if($_POST["save"]){
$LogedinInfo=$_POST["LogedinInfo"];
$Info=$_POST["Info"];
mysql_query("UPDATE info SET Info = '$Info'");
mysql_query("UPDATE info SET LogedinInfo = '$LogedinInfo'");
echo"Your changes has been saved!<br><a href=\"../\">Home!</a>";
}else{
  $query  = "SELECT * FROM info";
  $result = mysql_query($query);
  while($row = mysql_fetch_array($result))
  {
    $Info=$row['Info'];
    $LogedinInfo=$row['LogedinInfo'];
}
if($_POST["update"]){
  $LogedinInfo=stripslashes($_POST["LogedinInfo"]);
  $LogedinInfo_show=stripslashes($_POST["LogedinInfo"]);
  $Info=stripslashes($_POST["Info"]);
  $Info_show=stripslashes($_POST["Info"]);
}else{
  $Info_show=$Info;
}
print "<form action=\"\" method=\"POST\">
<p style=\"color: Red\">Info(not signed in):</p>
$Info_show
<textarea name='Info' style='width: 100%; height: 200px'>$Info</textarea>
<p style=\"color: Blue\">Info(signed in):</p>
$LogedinInfo
<textarea name='LogedinInfo' style='width: 100%; height: 200px'>$LogedinInfo</textarea>
<input type=\"submit\" name=\"update\" value=\"Update\">&nbsp;&nbsp;
<input type=\"submit\" name=\"save\" value=\"Save!\">
</form><br><br><form action='' method='POST'><input type=\"submit\" name=\"Reset\" value=\"Reset Changes\"></form>";
mysql_close($con);
}
}else{
 header('Location: http://verath.se/not_found');
}
?>
</div>
</div>
<? include ('../bottom_frame.php')?>
</div>
</body>
</html>