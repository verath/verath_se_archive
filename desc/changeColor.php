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

// Om det inte är några fel spara datan
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
<title>Färg inställnigar</title>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
<li><a class="menu_link" href='../../../kul'>Kul</a></li>
<li><a class="menu_link" href='../../../links'>Länkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<h3>Färg inställnigar</h3>
<p>Här kan du ändra din bakgrundsfärg och text fär till din profil. du måste skriva färgen i formatet: xxxxxx.<br />
<span style="color:#0000FF">0000FF = Blå.</span> <span style="color:#FF0000">FF0000 = Röd.</span> <span style="color:#00FF00">00FF00 = Grön.</span> <span style="color:000000;">000000 = Svart.</span> <span style="color:#FFFFFF; background:#000000">FFFFFF = Vit.</span></p>
<p>Har du Photoshop eller något annat program så kan du säkert hitta koden där. I Photoshop står den i en ruta längst, ner när, du väljer färg.<br />
Har du inget sådant program så finns det massor med program på internet. <a href="http://www.colorschemer.com/online.html">Här är en sida.</a>
</p>
<p>
	<form action="" method="post">
    <table cellspacing="5">
        <tr><td>Textfärg:</td><td><input name="color" type="text" value="<?=$curColor;?>" /></td><?=$colorError;?></tr>
        <tr><td>Bakgrundsfärg:</td><td><input name="back" type="text" value="<?=$curBack;?>" /></td><?=$backError;?></tr>
        <tr><td></td><td><input type="submit" name="sendBtn" value="Ändra" /></td></tr>
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