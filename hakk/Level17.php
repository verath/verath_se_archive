<?

$name=$_COOKIE["name"]; // s�tter variablen $name till namnet av bes�karen.

if(!$name)
{
	header("location: Level1.php");  // Redirecta till f�rsta level
}

$curLevel=17; // Vilken level �r det h�r?

$NextLevel=($curLevel+1)+"";

if ($_GET["submit"])
{  
// Om man har submittat.

	$password="Level17"; // l�senordet �r ...
	
	if($_GET["Pass"] == $password)
	{  
	// om l�sen �r r�tt
	
		if($name)  // Om personen �r inloggad.
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
	header("location: Level".$NextLevel.".php");  // Redirecta till n�sta level
}else{
// Fel l�sen

$Error="Fel l�senord.";

}

}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<!-- ****************************************** -->
<!-- *                                        * -->
<!-- * F�JANDE KOD �R BARA TILL F�R DESIGNEN! * -->
<!-- *    SJ�LVA LEVELN B�RJAR L�NGRE NER!    * -->
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
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<title>Hacking Level 17</title>
</head>
<body bgcolor="#ffffff" onLoad="clearPass()">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>G�stbok</a></li>
<li><a id="selected" href='../../../kul'><strong>Kul</strong></a></li>
<li><a class='selected_sub' href='../../../game/spel.php'>Musspelet</a></li>
<li><a class='selected_sub' href='../../../game/guess.php'>Gissa nummer</a></li>
<li><a class='selected_sub' href='../../../highscore.php'>Highscore</a></li>
<li><a class='selected_sub' href='../../../html_edit'>HTML editor</a></li>
<li><a class='selected_sub' href='../../../quiz'>Fr�gesport</a></li>
<li><a class='selected_sub' href='../../../hakk'><strong>Hacking</strong></a></li>
<li><a class='selected_sub' href='/kul/history'>"Historia"</a></li>
<li><a class="menu_link" href='../../../links'>L�nkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta anv�ndare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">

<!-- *************** -->
<!-- Start av level  -->
<!-- *************** -->



<p>Level 17.</p><br />



<?

echo $Error; // skriv ut errors

?>
<p>�terigen m�ste du dekryptera en kod. Men den h�r g�ngen en kod jag sj�lv hittat p� :).</p>
<div style="width:680px;">
<p>
.497.798.679.812.812.735.805.7<br>
.200.234.2 .312.291.342.3 .756.847.693.749.679.812.805.7<br>
.582.708.642.666.600.582.6<br>
.1526.1414.1400.1400.1414.1512.1358.1540.1400.1414.1624.644.644.644.14 <br>
.1080.2460.1150.1010.1100.1110.1140.1000.1010.1160.10 <br>
.464.420.432.432.4 .300.303.330.3 .312.684.342.3 .550.525.590.1145.550.5 <br>
.456.228.2 .306.684.909.1062.909.972.441.495.306.9
</p>
</div>
<!-- 
COPYRIGHT Encoder@Verath.se. 
VISIT US: http://verath.se/hakk/Level17code.php
-->
<p>Pass:</p>
<p>
<form action="" method="get">
  <input type="password" name="Pass" id="pass" value="" />
  <input type="submit" value="R�tt?" name="submit" />
</form>
</p>



<!-- ************* -->
<!-- Slut av level -->
<!-- ************* -->

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
