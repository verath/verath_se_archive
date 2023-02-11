<?

$name=$_COOKIE["name"]; // sätter variablen $name till namnet av besökaren.

if(!$name)
{
	header("location: Level1.php");  // Redirecta till första level
}

$curLevel=11; // Vilken level är det här?

$NextLevel=($curLevel+1)+"";

if ($_POST["submit"])
{  
// Om man har submittat.

	$password="yes"; // lösenordet är ...
	
	if($_POST["pass"] == $password)
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
		header("location: Level".$NextLevel.".php");  // Redirecta till nästa level
}else{
// Fel lösen

$Error="Fel... pass måste vara 'yes'";

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
<title>Hacking Level 11</title>
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




<p>Level 11.</p><br />

<!-- ************************************************************************************************************************************* -->
<!-- * Grattis Du har lyckats klara alla lätta nivåer... Från nu kommer det inte var några tips... Fast du kan ju alltid fråga i forumet * -->
<!-- ************************************************************************************************************************************* -->
<p>Pass:</p>
<?

echo $Error; // skriv ut errors

?>
<p>
<form action="" method="POST">
  <input type="hidden" name="pass" value="no" />
  <input type="submit" value="logga in" name="submit" />
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

