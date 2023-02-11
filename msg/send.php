<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<link href="msg.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Messages - sent</title>
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
<?
if(isset($_COOKIE["name"])){
  $name=$_COOKIE["name"];
  $SentFrom=$name;
  $SentTo=$_POST["SendTo"];
  $SentToUncoded=$_POST["SendTo"];
  $Content=$_POST["Content"];
  $Head=$_POST["Head"];
  if(!get_magic_quotes_gpc())
   {
  $SentFrom=addslashes($name);
  $SentTo=addslashes($_POST["SendTo"]);
  $Content=addslashes($_POST["Content"]);
  $Head=addslashes($_POST["Head"]);
  }
  $Sent=date("d/m G:i");
  $SentFrom =htmlspecialchars($SentFrom);
  $SentTo =htmlspecialchars($SentTo);
  $Content = htmlspecialchars($Content);
  $Head = htmlspecialchars($Head);
  if($Head==""){
   $Head="Inget ämne";
  }
  if($Content!="")
  {
  if($SentTo!=""){
  include "dbconnect.php";
  $query  = "SELECT * FROM users WHERE UserName='$SentToUncoded'";
  $result = mysql_query($query);
 while($row = mysql_fetch_array($result))
{
    $exist=1;
	$toEmail=$row["Email"];
	$wantEmail=$row["msgEmail"];
}
if($exist==1){
  mysql_query("INSERT INTO msg (SentFrom,SentTo,Content,Head,Sent) VALUES ('$SentFrom','$SentTo','$Content','$Head','$Sent')");
  
  mysql_close($con);
  
  // SICKA EMAIL
  if($wantEmail == "yes")
  {
	    // Mottagare
		$to  = $toEmail;
		
		// subject
		$subject = $Head;
		
		// message
		$message = '
		<html>
		<body>
		<style type="text/css">
		body
		{
		font: 11px Verdana, Arial, Helvetica, sans-serif; background: url(http://verath.se/pics/Back1.gif) repeat;
		}
		
		a
		{
		color: red;
		}
		 .msghead {
		   padding: 5px 5px 5px 5px;
		   font-size: 11px;
		   background: GreenYellow;
		  font-family: Verdana, Arial, Helvetica, sans-serif;
		  border-bottom: dotted 2px White;
		}
		.msgbody {
		   padding: 5px 5px 5px 5px;
		   font-size: 11px;
		   background: Aquamarine;
		  font-family: Verdana, Arial, Helvetica, sans-serif;
		}
		.msg_Read {
		   float:left;
		   width:300px;
		   margin: 0 5px 5px 0;
		   padding: 5px 5px 5px 5px;
		   font-size: 11px;
		   border: 2px dashed #FF3300;
		   background: #FFFF00;
		  font-family: Verdana, Arial, Helvetica, sans-serif;
		}
		
		</style> 
		<div class="msg_Read">
		<div class="msghead">
		Ämne: '.$Head.'<br />
		Från: <a href="http://verath.se//desc/desc_show/?infoname='.$SentFrom.'">'.$SentFrom.'</a>
		</div>
		<div class="msgbody">
		'. nl2br($Content) .'
		</div>
		<br />
		<a href="http://verath.se/msg?action=send&amp;who='.$SentFrom.'&amp;title='.$Head.'">Svara</a>
		</div>
		</body>
		</html>
		';
		
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
	}
  
  echo "Ditt meddelande har skickats till $SentTo.<br>
<br><a href='../msg?action=send&who=$SentTo'>Tillbaka</a>";
	if($SentTo == "GoogleBotSearch" )
	{
		echo '<script type="text/javascript">alert("Fjärde teckenet är:\nQ")</script>';	
	}
}else{
echo "Det finns ingen användare som heter $SentTo!<br>";
echo"<a href='../msg?action=send&who=$SentTo'>Tillbaka</a>";
}
  }else{
   echo "Du måste ha en mottagare!<br>";
   echo"<a href='../msg?action=send&who=$SentTo'>Tillbaka</a>";
  }
  }else{
  echo "Du måste ha ett meddelande!<br>
  <a href='../msg?action=send&who=$SentTo'>Tillbaka</a>";
  }
  }
?>
</div>
</div>
<? include ('../bottom_frame.php');?>
</div>
</body>
</html>