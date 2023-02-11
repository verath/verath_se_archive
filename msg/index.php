<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript" src="../script/DeleteMsg.js"></script>
<script type="text/javascript" src="../script/FindNames.js"></script>
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<link href="msg.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Meddelanden | <? 
echo htmlspecialchars($_GET["action"]). " ";
if(isset($_GET["id"])){
echo "| Meddelande Id: ".(int)$_GET["id"];
}elseif($_GET["who"]){
echo "| Till: ".htmlspecialchars($_GET["who"]);
}
?></title>
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
$sendName=array();
$name=$_COOKIE["name"];
$head=array();
$content=array();
$from=array();
$id=array();
$read=array();
if($name){
//**********
//Read
//**********
if($_GET["action"]=="read"){
	echo 'Meddelanden: <a href="?action=send">Skicka</a>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>Läs</strong>';
	$i=0;
	include "dbconnect.php";
	$result = mysql_query("SELECT * FROM msg ORDER BY id DESC");
	
	if($_GET["where"]=="outbox")
	{
		
		while($row = mysql_fetch_array($result))
		{
			if($row['SentFrom']==$name && $row['OutboxDelete']!="yes")
			{
				$head[$i]=$row['Head'];
				$content[$i]=wordwrap($row['Content'], 45, "\n",true);
				$content[$i]=nl2br($content[$i]);
				$to[$i]=$row['SentTo'];
				$id[$i]=$row['id'];
				$read[$i]=$row['Read'];
				$sent[$i]=$row['Sent'];
				$i++;
			  }
		  }
		
	}else
	{
		while($row = mysql_fetch_array($result))
		{
			if($row['SentTo']==$name && $row['InboxDelete']!="yes")
			{
				$head[$i]=$row['Head'];
				$content[$i]=wordwrap($row['Content'], 45, "\n",true);
				$content[$i]=nl2br($content[$i]);
				$from[$i]=$row['SentFrom'];
				$id[$i]=$row['id'];
				$read[$i]=$row['Read'];
				$sent[$i]=$row['Sent'];
				$i++;
			  }
		  }
	  }
	  /*
	  	  {
	  	if($_GET["where"]=="outbox")
		{
			header("location: ./?action=read");
			exit;
		}
		echo "<p>Du har inte några meddelande!<br /><br /><a href=\"../msg/?action=send\">Skicka ett meddelande!</a></p>";
	  }
	  */
	  
	  	if($_GET["where"]=="outbox")
		 {
		 	echo '<p style="font-size:18px">Dina meddelanden:</p><p><a href="/msg?action=read">Inkorgen</a> | Skickat';
		 }else
		 {
	  		echo '<p style="font-size:18px">Dina meddelanden:</p><p>Inkorgen | <a href="/msg?action=read&amp;where=outbox">Skickat</a>';
		}
	  $b=1;
	  $c=0;
	  if($i!=0)
	  {
	  	echo"<div class=\"msg_container\">";
	  }else
	  {
		echo"<br />";
	  }
	if(isset($_GET["id"]))
	{
		$b=(int)$_GET["id"];
		$c=1;
	}
		echo
"

<!-- Hur många checkboxar finns det som ska bli ikrysade? -->
<script type=\"text/javascript\">
numCheckboxes=". $i .";		
</script>

";
		for($a=0;$a<$i;$a++){
			if($a==$b && $c==1){
			echo "<div class='msg'><div class='msghead'>Ämne: $head[$a]</div><div class='msgbody'>Kolla till höger ----></div></div>";
			}else{
				if($_GET["where"]=="outbox")
				{
					if($_GET["show"]=="small")
					{
						echo "</div>Ämne: <a href='?action=read&amp;id=$a&amp;where=outbox&amp;show=small'>$head[$a]</a> Skickat: $sent[$a] Till: <a href=\"../desc/desc_show/?infoname={$to[$a]}\"> {$to[$a]}</a><br /><div class=\"msg_container\">";
					}else
					{
						echo "
						<div class='msg'>
						<div class='msghead'>
						Ämne: <a href='?action=read&amp;id=$a&amp;where=outbox'>$head[$a]</a>
						<span style=\"float:right;\"><input type=\"checkbox\" id=\"checkbox$a\" onchange=\"SelectedDelete(this.id)\" /></span>
						<br />
						Skickat: $sent[$a]
						</div>
						<div class='msgbody'>
						Till: <a href=\"../desc/desc_show/?infoname={$to[$a]}\">{$to[$a]}</a>
						</div>
						</div>
						<br />
						";
					}
				}else
				{
					echo "<div class='msg'>
					<div class='msghead'>
					Ämne: <a href='?action=read&amp;id=$a'>$head[$a]</a>
					<span style=\"float:right;\"><input type=\"checkbox\" id=\"checkbox$a\" onchange=\"SelectedDelete(this.id)\" /></span>
					<br />
					Skickat: $sent[$a]
					</div>
					<div class='msgbody'>
					Från: <a href=\"../desc/desc_show/?infoname=$from[$a]\">$from[$a]</a>
					</div>
					</div>
					<br />
					";
				}
			}
		}
    echo "
<a href=\"javascript:void(0)\" onclick=\"checkAll()\">Markera alla</a> | <a href=\"javascript:void(0)\" onclick=\"uncheckAll()\">Avmarkera alla</a>
<br />
<input type=\"button\" value=\"Ta bort markerade\" onclick=\"submitDeleteForm()\" >
";
	if($i!=0){
	echo "</div>";
	}
	if(isset($_GET["id"])){
	
		$a=(int)$_GET["id"];
	
		if($_GET["where"]=="outbox")
		{
			echo "<div class='msg_Read_Container'><div class='msg_Read'><div class='msghead'>";
			echo "Ämne: $head[$a]<br />Till: <a href=../desc/desc_show/?infoname=$to[$a]>$to[$a]</a></div>";
			echo "<div class='msgbody'>$content[$a]</div><br /><a href=\"../msg?action=send&amp;who={$from[$a]}&title={$head[$a]}\">Svara</a>";
			echo "</div><a href=\"../msg/?action=delete&amp;id=$a&amp;where=outbox\" alt='Delete'>Ta bort meddelande</a></div>";
		}else
		{
			
			if($read[$a]!="y")
			{
				$ida=$id[$a];
				mysql_query("UPDATE `msg` SET `Read` = 'y' WHERE `id` = $ida LIMIT 1;");
			 }
			 echo "<div class='msg_Read_Container'><div class='msg_Read'><div class='msghead'>";
			 echo "Ämne: $head[$a]<br />Från: <a href=../desc/desc_show/?infoname=$from[$a]>$from[$a]</a></div>";
			 echo "<div class='msgbody'>$content[$a]</div><br /><a href=\"../msg?action=send&amp;who={$from[$a]}&title={$head[$a]}\">Svara</a>";
			 echo "</div><a href=\"../msg/?action=delete&amp;id=$a\" alt='Delete'>Ta bort meddelande</a></div>";
		 }
	}
	mysql_close($con);
	
}
//**********
// END Read
//**********
//
//
//**********
//Send msg
//**********
elseif($_GET["action"]=="send"){
echo 'Meddelanden: <strong>Skicka</strong>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=read">Läs</a>';
$who=htmlspecialchars($_GET["who"]);
$title=htmlspecialchars($_GET["title"]);
$i=0;
if($title)
{
$title="RE: ".$title;
}
print "<p style=\"font-size:18px\">Skicka meddelande</p>
<form action=\"send.php\" method=\"post\" id=\"msgForm\">
<table>
<tr><td>Till:</td><td><input type=\"text\" name=\"SendTo\" value=\"$who\" maxlength=\"30\" onkeyup='ajaxFunction(this.value);' id='name' /></td></tr>
<tr><td></td><td><span id=\"Posible\"></span></td></tr>
<tr><td>Ämne:</td><td><input type=\"text\" name=\"Head\" maxlength=\"100\" value=\"$title\" /></td></tr>
<tr><td>Meddelande:</td><td><textarea name=\"Content\" rows=\"60\" cols=\"80\" style='width: 400px; height: 200px'></textarea></td></tr>
</table>
<p><a href=\"javascript:document.getElementById('msgForm').submit();\" title=\"Skicka\"><img src=\"../pics/SendMessage.png\" alt=\"Skicka\" style=\"border:none;\" /></a></p>
</form>";
//**********
// END Send msg
//**********
//
//
//**********
// Delete
//**********
}elseif($_GET["action"]=="delete"){
if(isset($_GET["id"]))
{
	$name=$_COOKIE["name"];
	$i=0;
	$a=(int)$_GET["id"];
	
	include "dbconnect.php";
	$result = mysql_query("SELECT * FROM msg ORDER BY id DESC");
	
	if($_GET["where"]=="outbox")
	{
	
		while($row = mysql_fetch_array($result))
			{
				if($row['SentFrom']==$name && $row["OutboxDelete"]!="yes")
				{
					$id[$i]=$row['id'];
					$i++;
				}
				
			}
			$ida=$id[$a];
			mysql_query("UPDATE `msg` SET OutboxDelete = 'yes' WHERE `id` = $ida LIMIT 1");
	
	}else
	{	
		while($row = mysql_fetch_array($result))
		{
			if($row['SentTo']==$name && $row["InboxDelete"]!="yes")
			{
				$id[$i]=$row['id'];
				$i++;
			}
			
		}
		$ida=$id[$a];
		mysql_query("UPDATE `msg` SET InboxDelete = 'yes' WHERE `id` = $ida LIMIT 1");
	}
}
header("location: ./?action=read&where=".$_GET["where"]);
mysql_close($con);
//**********
// END Delete
//**********
//
//
//**********
// No Action
//**********
}else{
 echo"<p><span style=\"font-size:18px\">Meddelanden</span><br />
<br />
Hej! Det här är meddelande funktionen. här kan du:<br /><a href=\"../msg/?action=send\">Skicka</a> ett meddelande eller <br /><a href=\"../msg/?action=read\">Läsa</a> dina meddelanden.";
}
//**********
//END No Action
//**********
}else{
//**********
// Not loged in
//**********
 echo"<p>För att använda den här funktionen måste du logga in!<br /><a href=\"../newuser\">Ny användare</a></p>";
}
//**********
// END Not loged in
//**********
?>

<form id="DeleteForm" action="delete.php" method="post">
<input type="hidden" name="where" value="<?=htmlspecialchars($_GET["where"]);?>" />
<input type="hidden" name="deleteIDs" id="deleteIDs" value="" />
</form>

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