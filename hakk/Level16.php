<?

$name=$_COOKIE["name"]; // sätter variablen $name till namnet av besökaren.

if(!$name)
{
	header("location: Level1.php");  // Redirecta till första level
}

$curLevel=16; // Vilken level är det här?

$NextLevel=($curLevel+1)+"";

if ($_GET["submit"])
{  
// Om man har submittat.

	$password="rot13"; // lösenordet är ...
	
	if($_GET["Pass"] == $password)
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
}else{
// Fel lösen

$Error="Fel lösenord.";

}

}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
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
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<title>Hacking Level 16</title>
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



<!-- Jag vet att jag skrev innan att ni inte får någon hjälp. Men några TIPS kan ni få :)-->

<!--
13
encryption
A=N
B=O
P=C
-->
<p>Level 16.</p><br />



<?

echo $Error; // skriv ut errors

?>
<p>Dekryptera koden...</p>
<?
echo "<p id=\"decThis\">".str_rot13("This encryption does not work in swedish that is why this text is in english. The password is ".str_rot13(strrev("rot13"))." but the password you see now is changed in two ways... using rot13 and reverse")."</p>";
?>
<p>Pass:</p>
<p>
<form action="" method="get">
  <input type="password" name="Pass" id="pass" value="" />
  <input type="submit" value="Rätt?" name="submit" />
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