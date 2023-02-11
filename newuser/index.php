<?php
$errormsg ='';
if(isset($_POST['add']))
{
// $_POST["LastName"] && $_POST["Email"]&&
if($_POST["UserName"] && $_POST["Password"] && $_POST["FirstName"]&&  $_POST['txtNumber']){
$vaildate="/^[0-9a-zA-ZåäöÅÄÖ\-]+[0-9a-zA-ZåäöÅÄÖ\-]+$/i";
if (preg_match($vaildate,$_POST["UserName"]) && preg_match($vaildate,$_POST["Password"]) && preg_match($vaildate,$_POST["FirstName"])){
$vaildate_email="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$";
if(!eregi($vaildate_email,$_POST["Email"]) && $_POST["Email"]){
  $errormsg="Din Email är ogiltig, skriv en giltig ellre lämna fältet tomt.";
}else{
if(!$_POST["LastName"] || preg_match($vaildate,$_POST["LastName"])){
$number = $_POST['txtNumber'];
if($_POST["Agree"]=="yes")
{
if (md5($number) == $_COOKIE['image_random_value']) {
$info="'".htmlspecialchars($_POST["UserName"])."', '".sha1('^¿^'.$_POST["Password"].'^¿^')."', '".htmlspecialchars($_POST["FirstName"])."', '".htmlspecialchars($_POST["LastName"])."', '".$_POST["Email"]."', '".date(YmdHis)."'";
$username="'".$_POST["UserName"]."'";
include ('../dbconnect.php');
  $query  = "SELECT UserName FROM users WHERE UserName=$username";
  $result = mysql_query($query);
 while(list($UserName)= mysql_fetch_row($result))
{
    $exist=1;
}

if(!$exist){
  mysql_query("INSERT INTO users (UserName, Password, FirstName, LastName, Email, Created) VALUES (".$info.")");
  $errormsg="<script type='text/javascript'>alert('Din användare har skapats utan några problem!'); document.location.href='../';</script>";
  }else{
   $errormsg="<font color=red>Ditt användarnamn finns redan, försök med ett annat.</font>";
  }
  }else{
   $right=$_COOKIE['image_random_value'];
   $errormsg="<font color=red>Du skrev inte rätt säkerhetskod.</font>";
  }
  }else
  {
  	$errormsg="<span style=\"color:red\">Du måste gå med på Verath.se:s regler och sekretesspolicy</span>";
  }
  }else{
  $errormsg="<font color=red>Var snäll och använd bara svenska bokstäver eller siffror.</font>";
  }
  }
  }else{
  $errormsg="<font color=red>Var snäll och använd bara svenska bokstäver eller siffror.</font>";
  }
  }else{
   $errormsg="<font color=red>Var snäll och fyll i alla fält markerade med '*'</font>";
  }
  if($con){
  mysql_close($con);
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>New User</title>
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
<div id="content">
<p><? echo $errormsg;?></p>
<p style="color:red">Fält markerade med "*" måste fyllas i!</p>
<form action="" method="post">
<table border="0" align="left" cellpadding="2" cellspacing="10">
<tr><td><p style="color:red">*</p></td><td>Användarnamn:</td><td><input type="text" name="UserName"></td></tr>
<tr><td><p style="color:red">*</p></td><td>Lösenord:</td><td><input type="password" name="Password"></td></tr>
<tr><td><p style="color:red">*</p></td><td>Förnamn:</td><td><input type="text" name="FirstName"></td></tr>
<tr><td></td><td>Efternamn:</td><td><input type="text" name="LastName"></td></tr>
<tr><td></td><td>Email:</td><td><input type="text" name="Email"></td></tr>
<tr><td><p style="color:red">*</p></td><td>Säkerhetskod:</td><td><input name="txtNumber" type="text" id="txtNumber" value=""></td><td><img src="
randomImage2.php"></td><td><font color=red>Säkerhetskoden är shiftkännslig. Det vill säga "a" är inte samma som "A"</font></td></tr>
<tr><td><p style="color:red">*</p></td><td>Jag accepterar och kommer att följa <a href="http://verath.se/rules" target="_blank">Verath.se:s Regler &amp; sekretesspolicy</a>:</td><td><input type="checkbox" name="Agree" value="yes" /></td></tr>
<tr><td></td><td><input type="submit" value="Create User" name="add"></td></tr>
</table>
</form>
</div>
</div>
<? include ('../bottom_frame.php')?>
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