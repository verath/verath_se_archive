<?
// Form submit
if($_POST["sendBtn"])
{
	$color = $_POST["color"];
	$back = $_POST["back"];
	
	$validate="/^[a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9]$/i";
	
	if(!preg_match($validate,$color))
	{
		$colorError="<td><span style=\"color:red\">Fel format!</span></td>";
	}
	
	if(!preg_match($validate,$back))
	{
		$backError="<td><span style=\"color:red\">Fel format!</span></td>";
	}

// Om det inte �r n�gra fel spara datan
if(!$backError && !$colorError)
{
	$name=$_COOKIE["name"];
	
	include ('../dbconnect.php');
	mysql_query("UPDATE users SET Color = '$color' WHERE UserName = '$name'")or Die(mysql_error());
	mysql_query("UPDATE users SET Background = '$back' WHERE UserName = '$name'")or Die(mysql_error());
	mysql_close($con);
	header("location: ../desc");
}

}

?>

<?
//Current Values
$name=$_COOKIE["name"];
include ('../dbconnect.php');

$result = mysql_query("SELECT * FROM users");

while($row = mysql_fetch_array($result))
{
	if(html_entity_decode($row['UserName'])==$name)
	{
		$curColor=$row["Color"];
		$curBack=$row["Background"];
	}
}
mysql_close($con);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<title>F�rg inst�llnigar</title>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>G�stbok</a></li>
<li><a class="menu_link" href='../../../kul'>Kul</a></li>
<li><a class="menu_link" href='../../../links'>L�nkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta anv�ndare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<h3>F�rg inst�llnigar</h3>
<p>H�r kan du �ndra din bakgrundsf�rg och text f�r till din profil. du m�ste skriva f�rgen i formatet: xxxxxx.<br />
<span style="color:#0000FF">0000FF = Bl�.</span> <span style="color:#FF0000">FF0000 = R�d.</span> <span style="color:#00FF00">00FF00 = Gr�n.</span> <span style="color:000000;">000000 = Svart.</span> <span style="color:#FFFFFF; background:#000000">FFFFFF = Vit.</span></p>
<p>Har du Photoshop eller n�got annat program s� kan du s�kert hitta koden d�r. I Photoshop st�r den i en ruta l�ngst, ner n�r, du v�ljer f�rg.<br />
Har du inget s�dant program s� finns det massor med program p� internet. <a href="http://www.colorschemer.com/online.html">H�r �r en sida.</a>
</p>
<p>
	<form action="" method="post">
    <table cellspacing="5">
        <tr><td>Textf�rg:</td><td><input name="color" type="text" value="<?=$curColor;?>" /></td><?=$colorError;?></tr>
        <tr><td>Bakgrundsf�rg:</td><td><input name="back" type="text" value="<?=$curBack;?>" /></td><?=$backError;?></tr>
        <tr><td></td><td><input type="submit" name="sendBtn" value="�ndra" /></td></tr>
    </table>
    </form>
</p>
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