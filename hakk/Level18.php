<?
session_start();
$name=$_COOKIE["name"]; // sätter variablen $name till namnet av besökaren.

if(!$name)
{
	header("location: Level1.php");  // Redirecta till första level
}

$alphanum  = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";


$curLevel=18; // Vilken level är det här?

$NextLevel=($curLevel+1)+"";

if ($_GET["submit"])
{  
// Om man har submittat.

	$password=$_SESSION["Code"]; // lösenordet är ...
	
	if(md5($_GET["Pass"]."...") == $password)
	{  
	// om lösen är rätt
	
		if($name)  // Om personen är inloggad.
		{
			include ('../dbconnect.php'); // inkludera databas "connect" filen
			
			$result = mysql_query("SELECT * FROM hacking WHERE Name='$name'");
			$level=0;
			while($row = mysql_fetch_array($result))
			{
				$level=(int)$row['Level'];
			}
		  
			if($level+1<$curLevel)
			{
				header("location: Level1.php");  // Redirecta till main page
				exit;
			}
		  
			if($level<$curLevel)
			{
				mysql_query("UPDATE hacking SET Level = '$curLevel' WHERE Name = '$name'");
			}
			  
		}
      //header("location: ../hakk");
      header("location: Level".$NextLevel.".php");  // Redirecta till nästa level
   }else
   {
// Fel lösen

$Error="Fel lösenord.";

}

}
// Bestäm ranCode värde ska vara.
 

$input=stripslashes(substr(str_shuffle($alphanum), 0, 8+rand(0,3)));
$token = strtok($input, " ");
$b=0;
while($token!==false)
{
	$a="";
	
	$a=str_split($token);
	
	foreach($a as $value)
	{
		$arr[$b].=".".ord($value)*strlen($token);
	}
	
	$arr[$b].=".".strlen($token)." ";
	
	$b++;
	
	$token = strtok(" ");
	
}
foreach($arr as $aval)
{
	$ranCode1 .= $aval; 
}

$ranCode = $ranCode1;
$_SESSION["Code"] = md5($input."...");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<!-- ****************************************** -->
<!-- *                                        * -->
<!-- * FÖJANDE KOD ÄR BARA TILL FÖR DESIGNEN! * -->
<!-- *    SJÄLVA LEVELN BÖRJAR LÄNGRE NER!    * -->
<!-- *                                        * -->
<!-- ****************************************** -->


<script language="javascript">
function clearPass()
{
document.getElementById('pass').value='';
}
</script>
<!-- End -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="46">
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<title>Hacking Level 18</title>
</head>
<body bgcolor="#ffffff" onLoad="clearPass()">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
<li><a id="selected" href='../../../kul'><strong>Kul</strong></a></li>
<li><a class='selected_sub' href='../../../game/spel.php'>Musspelet</a></li>
<li><a class='selected_sub' href='../../../game/guess.php'>Gissa nummer</a></li>
<li><a class='selected_sub' href='../../../highscore.php'>Highscore</a></li>
<li><a class='selected_sub' href='../../../html_edit'>HTML editor</a></li>
<li><a class='selected_sub' href='../../../quiz'>Frågesport</a></li>
<li><a class='selected_sub' href='../../../hakk'><strong>Hacking</strong></a></li>
<li><a class='selected_sub' href='/kul/history'>"Historia"</a></li>
<li><a class="menu_link" href='../../../links'>Länkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">

<!-- *************** -->
<!-- Start av level  -->
<!-- *************** -->



<p>Level 18.</p><br />



<?

echo $Error; // skriv ut errors

?>
<p>Du måste dekryptera min kod igen... Den här gången laddas dock sidan om var 45:e sekund och för varje omladdnign slumpas en ny kod fram. Kul, eller hur? :D</p>
<p>
Lösenordet är: 
<?
echo $ranCode; // skriv ut slumpade koden.
?>
</p>
<!-- 
COPYRIGHT Encoder@Verath.se. 
VISIT US: http://verath.se/hakk/Level17code.php
-->
<p>Pass:</p>
<p>
<form action="" method="get">
  <input type="password" name="Pass" id="pass" value="" />
  <input type="submit" value="Rätt?" name="submit" />
</form>
</p>

<script type="text/javascript" />
// ENDAST FÖR ADMIN
// Base64
// -----------------
<?php
   if(isset($input))
   {
      echo 'c = "'.base64_encode($input).'"';
   }
?>

</script>

<!-- ************* -->
<!-- Slut av level -->
<!-- ************* -->
<script language="javascript">
setTimeout("location.reload(true)",45000);
</script>
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
