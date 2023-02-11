<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<link href="msg.css" rel="stylesheet" type="text/css">
<link href="msg.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Messages</title>
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
<a href="../admin">Home</a> || Quiz || <a href="../guestbook/">Guestbook</a></p>
<div id="content">
<?
$admin="Verath";
if($name==$admin){
include ('../dbconnect.php');
if($_GET["okey"] && $_GET["id"]){
$okey=$_GET["okey"];
$id=$_GET["id"];
if($okey==1){
mysql_query("UPDATE quiz SET Okey = '1' WHERE Id=$id LIMIT 1");
echo "The question with id:$id was marked as okey=1<br>
<a href=\"quiz.php\">Back</a>";
}else{
mysql_query("DELETE FROM `quiz` WHERE `Id` = $id LIMIT 1");
echo "The question with id:$id was Deleted!<br>
<a href=\"\">Back</a>";
}
}else{
$Question=array();
$Answer=array();
$Name=array();
$Id=array();
$i=0;
$name=$_COOKIE["name"];
  $result = mysql_query('SELECT * FROM `quiz` WHERE `Okey`=0');
  while($row = mysql_fetch_array($result))
  {
  $Question[$i]=$row["Question"];
  $Answer[$i]=$row["Answer"];
  $Id[$i]=$row["Id"];
  $Name[$i]=$row["Name"];
  $i++;
}
for($a=0;$a<$i;$a++){
echo "<div class='msg'>
<div class='msghead'>
Posted by:<br>
$Name[$a]
</div>
<div class='msghead'>
Question:<br>
$Question[$a]</div>
<div class='msgbody'>Answer:<br>
$Answer[$a]
</div>
<a href=\"?okey=1&id=$Id[$a]\">Okey</a>&nbsp;&nbsp;&nbsp;<a href=\"?okey=2&id=$Id[$a]\">NOT Okey</a>
</div>
<br>";
}
if($i==0){
echo "No new question has been posted!";
}
}
mysql_close($con);
}
?>
</div>
</div>
<? include ('../bottom_frame.php');?>
</div>
</body>
</html>