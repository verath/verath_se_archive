<?
include ('../dbconnect.php');
$hackLevelArray=array("Ingen","N00b","D�lig","Inte bra","Finns s�mre...","HTML-kunnig","Javascript??","Hyfsad","Bra","Javascript-kunnig","Javascript-Pro","Wannabe Hacker","Pro","Master","Hacker","H4X0R","1337 H4X0R","D3(ryp73r","T|-|3 M4573r",".","..","...","....");
  $name=$_COOKIE["name"];
  $hackLevel=0;
  $result = mysql_query("SELECT * FROM hacking WHERE Name='$name'");
	while($row = mysql_fetch_array($result))
			{
				$hackLevel=(int)$row['Level'];
			}
			
			$numHackLevels="20";
  
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<title>Hacking</title>
</head>
<body>
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
<?php
if($hackLevel==$numHackLevels)
{
	echo "Grattis, du har klarat alla niv�erna och har nu ranken {$hackLevelArray[$hackLevel]}. Vill du f� en �nnu h�gre rank, g�r en egen niv� och skicka den till mig!";
}
?>
<p>V�lkommen till hacking testet. Det h�r �r ett spel och absolut inget olagligt! Ditt m�l �r att klara alla niv�er genom att f� tag p� l�senordet till niv�n. Har du fastnat p� n�gon niv�? Kolla i forumet (Forum -> Verath.se -> Hakk).<br /></p><p>Din rank: <span style=" color:#FF0000;"><? echo $hackLevelArray[$hackLevel]; ?></span>.<br />
Du har klarat: <? echo "<span style=\" color:#FF0000;\">$hackLevel</span> av $numHackLevels niv�er."; ?></p><p><br /><strong>GL &amp; HF</strong><br />
</p>
<table cellpadding="3" cellspacing="3">
<tr>
<?
$i=0;
for( $count=1; $count <= (int)$hackLevel+1 && $count <= $numHackLevels && $hackLevel>0; $count++)
{
	$i++;
	echo "
	
	<td>
		<a href=\"Level{$count}.php\">Till Level $count</a>
	</td>
";
	
	if($i==6 && ($count-1)!=$hackLevel)
	{
		$i=0;
		echo "
</tr>
<tr>";
	}
}
if($hackLevel==0)
{
	echo "<td><a href=\"Level1.php\">B�rja hacka!</a></td>
";
}
?>
</tr>
</table>
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
