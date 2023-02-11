<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<link href="msg.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Game | add</title>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a href='../../../'>Hem</a></li>
<li><a href='../../../guestbook'>Gästbok</a></li>
<li><a href='../../../html_edit'>HTML editor</a></li>
<li><a href='../../../highscore.php'>Highscore</a></li>
<li><b><a href='../../../links'>Länkar</a></b></li>
<li><a href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<?php

function js_sc($str)
   {
       $pattern[0] = '/script/';
       $pattern[1] = '/on/';
       $replacement[0] = 'scr<b></b>ipt';
       $replacement[1] = 'o<b></b>n';
       $string = preg_replace($pattern,$replacement,$str);
       return $string;
   }

if(isset($_COOKIE["name"])){
$name=$_COOKIE["name"];
  $name=$_COOKIE["name"];
  $gname=$_POST["name"];
  $gdesc=$_POST["desc"];
  $gtag=$_POST["tag"];
  $glocation=$_POST["location"];
  if(!get_magic_quotes_gpc())
   {
  $gname=addslashes($gname);
  $gdesc=addslashes($gdesc);
  $glocation=addslashes($glocation);
  $gtag=addslashes($tag);
  }
  $gname=htmlentities($gname, ENT_QUOTES);
  $gdesc=htmlentities($gdesc, ENT_QUOTES);
  $glocation=htmlentities(js_sc($glocation), ENT_QUOTES);
  if($gname && $gdesc && $glocation && $gtag && $name)
  {
  include ('../dbconnect.php');
  mysql_query("INSERT INTO links (Name, Gdesc, Location, Tag, AddedBy) VALUES ('$gname', '$gdesc', '$glocation', '$gtag', '$name')") or die(mysql_error());
  mysql_close($con);
  echo "Din länk har lagts till i databasen.<br><a href='../links'>Tillbaka</a>";
  }
  header("location: ../links");
  }
?>
</div>
</div>
<? include ('../bottom_frame.php');?>
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