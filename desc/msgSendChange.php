<?php
// Namn cookie
$name=$_COOKIE["name"];

//Omdirigera till desc/index.php om personen inte är inloggad och kör ingen kod efter det här
if( !$name )
{
	header("location: \"../\"");
	exit;
}

// Emailadress

	//Öppna databaslänk
include ('../dbconnect.php');

$result = mysql_query("SELECT * FROM users WHERE UserName='$name'");

while($row = mysql_fetch_array($result))
{
	$Email=$row["Email"];
}

	// stäng databaslänk
mysql_close($con);


// Skicka email om man har tryckt på "skicka email" knappen

if($_POST["sendBtn"])
{

	//Sha1 kod för att veta säkert att det är rätt email.
	$code = sha1($name.$Email.date(m));
	
	//lägg till koden i user databasen
	
	//Öppna databaslänk
	include ('../dbconnect.php');

	mysql_query("UPDATE users set emailCode='$code' WHERE UserName='$name' ");
	
	// stäng databaslänk
	mysql_close($con);	

		// Mottagare
	$to  = $Email;
	
	// subject
	$subject = 'Konfirmera din Email';
	
	// message
	
	$message = "<h3>Hej $name!</h3><br />".
	"<p>För att veta att det här är din email-adress måste du klicka på länken nedan.<br /> Går det inte att klicka, kopiera länkadressen till adressfältet i din webläsare.<br />".
	"<a href=\"http://verath.se/desc/msgSendConfirm.php?code=$code\">http://verath.se/desc/msgSendConfirm.php?code=$code</a><br /><br />".
	"Om du inte vet varför du fått det här meddelandet, bara ta bort det.</p>"
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
<title>Meddelande inställnigar</title>
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
<h3>Meddelande inställnigar</h3>
<p>För att kunna använda funktionen "skicka meddelanden (dvs meddelanden du får här på Verath.se från andra medlemmar) till min email" måste du först bevisa att det är du som äger den. Det gör du genom att klicka på en länk i ett mail.<br /><br />Var vänlig kolla så din email-adress stämmer innan du klickar på "skicka". Om den inte gör det gå <a href="../desc">tillbaka</a> och ändra den.<br /><br />
Din registrerade email-adress är: <span style="color:#0000FF"><?php echo $Email; ?></span></p>
<p>
	<form action="" method="post">
    <input type="submit" name="sendBtn" value="Skicka" disabled="disabled" />
    </form>
</p>
<p style="color:red;">Funktionen är ännu inte helt klar...</p>
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