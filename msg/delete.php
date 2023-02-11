<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript" src="../script/DeleteMsg.js"></script>
<script type="text/javascript" src="../script/FindNames.js"></script>
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<link href="msg.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Msg | Delete_Selected</title>
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
<?php
$name=$_COOKIE["name"];
if(!$name)
{
	header("location: ./?action=read&where=".$_GET["where"]);
	exit;
}

if(!$_POST["deleteIDs"])
{
	header("location: ./?action=read&where=".$_GET["where"]);
	exit;
}

// Få alla ids in till en array
$token = strtok($_POST["deleteIDs"], " ");
while ($token !== false)
	{
		$deleteID[]=(int)$token;
		$token = strtok(" ");
	}

// where variablen
$where=$_POST["where"];
if($where)
{
	$sent="SentFrom";
	$delete="OutboxDelete";
}else
{
	$sent="SentTo";
	$delete="InboxDelete";
}

// inkludera databsfilen
require('../dbconnect.php');

$result=mysql_query("SELECT * FROM msg WHERE $sent = '$name' AND $delete = '' ORDER BY id DESC");

while($row = mysql_fetch_array($result))
{
	$realID[]=$row["id"];
}

// stäng databasanslutningen

foreach($deleteID as $ID)
{
	$currentID=$realID[$ID];
	mysql_query("UPDATE `msg` SET $delete = 'yes' WHERE `id` = $currentID LIMIT 1");
}

mysql_close($con);
header("location: ./?action=read&where=".$_POST["where"]);

?>

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