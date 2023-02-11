<?

$name=$_COOKIE["name"]; // sätter variablen $name till namnet av besökaren.

$curLevel=1; // Vilken level är det här?

$NextLevel = ($curLevel+1)+"";

if ($_GET["submit"])
{  
	// Om man har submittat.
	
	$password="verath"; // lösenordet är "verath"
	
	if($_GET["Pass"] == $password)
	{  
		// om lösen är rätt
		
		if($name)  // Om personen  är inloggad.
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
			  
			  header("location: Level".$NextLevel.".php");  // Redirecta till nästa level
			    
		}else
		{
			  $Error="Du angav rätt lösenord men du måste logga in för att komma vidare.";
		}
		
	}else{
		// Fel lösen
		
		$Error="Fel lösenord. Ett tips: <strong>källa (source) <br />Firefox: [ctrl+u]</strong>";
	
	}

}

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
function aCode(){alert("Andra teckenet är:\n"+String.fromCharCode(51));}
</script>
</head>
<body onload="clearPass()">
<div id="sidlayout">
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




<p>Level 1.</p><br />
<p style="color:#FFFFFF; font-size:8px;">
<!-- Första nivån ska vara enkel, eller? Hittar du inte lösenordet nu är du blind (KOLLA NEDANFÖR)-->
<!-- ****************************** -->
<!-- ****************************** -->
<!-- ****************************** -->
Lösenordet är "verath"
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
  <input type="submit" value="Rätt?" name="submit" />
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

