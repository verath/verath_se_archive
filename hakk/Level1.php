<?

$name=$_COOKIE["name"]; // s�tter variablen $name till namnet av bes�karen.

$curLevel=1; // Vilken level �r det h�r?

$NextLevel = ($curLevel+1)+"";

if ($_GET["submit"])
{  
	// Om man har submittat.
	
	$password="verath"; // l�senordet �r "verath"
	
	if($_GET["Pass"] == $password)
	{  
		// om l�sen �r r�tt
		
		if($name)  // Om personen  �r inloggad.
		{
			
			include ('../dbconnect.php'); // inkludera databas "connect" filen
			$level=0;
			$result = mysql_query("SELECT * FROM hacking WHERE Name='$name'");
			while($row = mysql_fetch_array($result))
			  {
				$nameExist=true;
				$level=(int)$row['Level'];
			  }
			  if($nameExist)
			  {
				if($level<$curLevel)
				{
				
					mysql_query("UPDATE hacking SET Level = '$curLevel' WHERE Name = '$name'");
				
				}
			  }else
			  {
			  
			  mysql_query("INSERT INTO hacking (Name, Level) VALUES ('$name','$curLevel')");
			  
			  }
			  
			  header("location: Level".$NextLevel.".php");  // Redirecta till n�sta level
			    
		}else
		{
			  $Error="Du angav r�tt l�senord men du m�ste logga in f�r att komma vidare.";
		}
		
	}else{
		// Fel l�sen
		
		$Error="Fel l�senord. Ett tips: <strong>k�lla (source) <br />Firefox: [ctrl+u]</strong>";
	
	}

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<!-- ****************************************** -->
<!-- *                                        * -->
<!-- * F�JANDE KOD �R BARA TILL F�R DESIGNEN! * -->
<!-- *    SJ�LVA LEVELN B�RJAR L�NGRE NER!    * -->
<!-- *                                        * -->
<!-- ****************************************** -->


<script type="text/javascript">
function clearPass()
{
document.getElementById('pass').value='';
}
</script>
<!-- End -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<title>Hacking Level 1</title>
<script type="text/javascript">
function aCode(){alert("Andra teckenet �r:\n"+String.fromCharCode(51));}
</script>
</head>
<body onload="clearPass()">
<div id="sidlayout">
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




<p>Level 1.</p><br />
<p style="color:#FFFFFF; font-size:8px;">
<!-- F�rsta niv�n ska vara enkel, eller? Hittar du inte l�senordet nu �r du blind (KOLLA NEDANF�R)-->
<!-- ****************************** -->
<!-- ****************************** -->
<!-- ****************************** -->
L�senordet �r "verath"
<!-- ****************************** -->
<!-- ****************************** -->
<!-- ****************************** -->
</p>
<p>Pass:</p>
<p style="color:#FF0000">
<?

echo $Error; // skriv ut errors

?>
<p>
<form action="" method="get">
  <input type="password" name="Pass" id="pass" value="" />
  <input type="submit" value="R�tt?" name="submit" />
</form>
</p>



<!-- ************* -->
<!-- Slut av level -->
<!-- ************* -->
<a href="javascript:aCode()"><div  style="background:#FFFFFF; width:10px; height:10px; float:right;"></div></a>
</div>
</div>
<? include ('../bottom_frame.php');?>
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

