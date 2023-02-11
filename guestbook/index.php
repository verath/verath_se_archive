<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Gästbok</title>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<link href="guestbook.css" rel="stylesheet" type="text/css" />
<style type="text/css">
q { font-size: 10px; }
</style>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'><strong>Gästbok</strong></a></li>
<li><a class="menu_link" href='../../../kul'>Kul</a></li>
<li><a class="menu_link" href='../../../links'>Länkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<?
$namn=$_COOKIE["name"];
$admin="Verath";
if($name==$admin){
echo"<p style=\"margin:5px\">
Admin:<br>
<a href=\"../admin\">Home</a> || <a href=\"../admin/quiz.php\">Quiz</a> || Guestbook</p>";
}
?>
<div id="content">
<?
if(!empty($namn)){
echo '<div id="guestbook_insert">
<p>Skriv ditt medelande i boxen nedanför.<br>Om du vill ha färgad text skriv "FC=" och färgen (på engelska) du vill ha:<br>
<font color=blue>FC=blue min text här.</font><br>
Glöm inte mellanrummet mellan färgen och din text!</p><br>
<form method="POST" action="#">
<textarea name="input" style="width: 500px;" rows="2" ></textarea><br><br>
<input type=submit value="Skicka"></form></div>';
}else
{
	echo
	"
<div id=\"guestbook_insert\">
<p>
För att kunna skriva i gästboken måste du logga in.<br />
<a href=\"../newuser/\">Skapa användare</a>
</p>
</div>
";
}
$namn=$_COOKIE["name"];
$admin="Verath";
  //DELETE FUNCTION
  if(!empty($_GET["del"]) && $name==$admin){
  $ida=$_GET["del"];
  include('dbconnect.php');
  mysql_query("DELETE FROM guestbook WHERE `Id` = $ida LIMIT 1");
  mysql_close($con);
  echo '<script type="text/javascript">
document.location.href="../guestbook";
</script>';
  }

    // om den inte är tom
  if(!empty($_POST["input"]) && $name){
  // så man inte kan göra tabbar som </html>
  $input =htmlentities($_POST["input"]);
  // för att man ska kunna använda färger
  if(strstr($input, "FC=")){
    $input = str_replace("FC=","",$input);
    $input1 = strtok($input," ");
    $input = substr_replace($input,"",0,strlen($input1));
    $input1 = htmlentities($input1) . ";\" >";
    $input = "<span style=\"color:" . $input1 . htmlentities($input) . "</span>";
  }
  if(!get_magic_quotes_gpc())
   {
  $name=addslashes($name);
  $input=addslashes($input);
  }
  $Content=$input;
  $Name=$name;
  $Time=date(YmdHis);
  include('dbconnect.php');
  mysql_query("INSERT INTO guestbook (Name, Content, Time) VALUES ('$Name', '$Content', '$Time')");
  mysql_close($con);
  echo "<script type='text/javascript'> self.location='../guestbook';</script>";
  }
  //läs från filen och visa alla "posts"
  $Name=array();
  $Content=array();
  $Id=array();
  $Time=array();
  $i=0;
  $variant=1;
  include('dbconnect.php');
  $result=mysql_query("SELECT * FROM guestbook ORDER BY Id DESC");
  while($row = mysql_fetch_array($result))
  {
  $Name[$i]=$row['Name'];
  $Content[$i]=nl2br($row['Content']);
  $Id[$i]=$row['Id'];
  $Time[$i]=$row['Time'];
  $i++;
  }
  mysql_close($con);
  for($a=0;$a<$i;$a++){
  if($variant==1){
  echo "<div class=\"guestbook_sep\">[$Time[$a]] <a href=\"../../desc/desc_show/?infoname=$Name[$a]\">$Name[$a]</a>: $Content[$a]</div>
  ";
$variant=2;
  }else{
    echo "<div class=\"guestbook_sep1\">[$Time[$a]] <a href=\"../../desc/desc_show/?infoname=$Name[$a]\">$Name[$a]</a>: $Content[$a]</div>
	";
    $variant=1;
  }
  if($name==$admin){
   echo "<div class=\"guestbook_del\"><a href=\"../guestbook?del=$Id[$a]\">Delete</a></div>
   ";
  }
}
?>
</div>
</div>
<? include('../bottom_frame.php');?>
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