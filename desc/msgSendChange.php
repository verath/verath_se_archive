<?php
// Namn cookie
$name=$_COOKIE["name"];

//Omdirigera till desc/index.php om personen inte �r inloggad och k�r ingen kod efter det h�r
if( !$name )
{
	header("location: \"../\"");
	exit;
}

// Emailadress

	//�ppna databasl�nk
include ('../dbconnect.php');

$result = mysql_query("SELECT * FROM users WHERE UserName='$name'");

while($row = mysql_fetch_array($result))
{
	$Email=$row["Email"];
}

	// st�ng databasl�nk
mysql_close($con);


// Skicka email om man har tryckt p� "skicka email" knappen

if($_POST["sendBtn"])
{

	//Sha1 kod f�r att veta s�kert att det �r r�tt email.
	$code = sha1($name.$Email.date(m));
	
	//l�gg till koden i user databasen
	
	//�ppna databasl�nk
	include ('../dbconnect.php');

	mysql_query("UPDATE users set emailCode='$code' WHERE UserName='$name' ");
	
	// st�ng databasl�nk
	mysql_close($con);	

		// Mottagare
	$to  = $Email;
	
	// subject
	$subject = 'Konfirmera din Email';
	
	// message
	
	$message = "<h3>Hej $name!</h3><br />".
	"<p>F�r att veta att det h�r �r din email-adress m�ste du klicka p� l�nken nedan.<br /> G�r det inte att klicka, kopiera l�nkadressen till adressf�ltet i din webl�sare.<br />".
	"<a href=\"http://verath.se/desc/msgSendConfirm.php?code=$code\">http://verath.se/desc/msgSendConfirm.php?code=$code</a><br /><br />".
	"Om du inte vet varf�r du f�tt det h�r meddelandet, bara ta bort det.</p>"
	;
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	//$headers .= 'To: Peter' . "\r\n";
	$headers .= 'From: Verath.se <SvaraInte@verath.se>' . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
	
	// Mail it
	mail($to, $subject, $message, $headers);
	
	
	//Alert med javascript att meddelandet har skickats och redirect till desc/index.php. Avbryt all senare kod.
	echo "<html><body><script type=\"text/javascript\">alert(\"Meddelandet har skickats.\");document.location.href=\"../desc/\";</script></body></html>";
	exit;
	
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<title>Meddelande inst�llnigar</title>
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
<h3>Meddelande inst�llnigar</h3>
<p>F�r att kunna anv�nda funktionen "skicka meddelanden (dvs meddelanden du f�r h�r p� Verath.se fr�n andra medlemmar) till min email" m�ste du f�rst bevisa att det �r du som �ger den. Det g�r du genom att klicka p� en l�nk i ett mail.<br /><br />Var v�nlig kolla s� din email-adress st�mmer innan du klickar p� "skicka". Om den inte g�r det g� <a href="../desc">tillbaka</a> och �ndra den.<br /><br />
Din registrerade email-adress �r: <span style="color:#0000FF"><?php echo $Email; ?></span></p>
<p>
	<form action="" method="post">
    <input type="submit" name="sendBtn" value="Skicka" disabled="disabled" />
    </form>
</p>
<p style="color:red;">Funktionen �r �nnu inte helt klar...</p>
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