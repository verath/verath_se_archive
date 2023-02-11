<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link href="layout.css" rel="stylesheet" type="text/css" />
<link href="meny.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Highscore</title>
</head>
<body>
<div id="sidlayout">
<?php include "login.php"; ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
<li><a id="selected" href='../../../kul'><strong>Kul</strong></a></li>
<li><a class='selected_sub' href='../../../game/spel.php'>Musspelet</a></li>
<li><a class='selected_sub' href='../../../game/guess.php'>Gissa nummer</a></li>
<li><a class='selected_sub' href='../../../highscore.php'><strong>Highscore</strong></a></li>
<li><a class='selected_sub' href='../../../html_edit'>HTML editor</a></li>
<li><a class='selected_sub' href='../../../quiz'>Frågesport</a></li>
<li><a class='selected_sub' href='../../../hakk'>Hacking</a></li>
<li><a class='selected_sub' href='/kul/history'>"Historia"</a></li>
<li><a class="menu_link" href='../../../links'>Länkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<?php
include "dbconnect.php";

$name=$_COOKIE["name"];

if($_COOKIE["name"] && $_REQUEST["highscore"])
{
	while($i<=50000 || md5($i)==$_REQUEST["highscore"])
	{
		if(md5($i)==$_REQUEST["highscore"]){
			$highScore=$i;
			break;
		}
	$i=$i+5;
	}
	
	$result = mysql_query("SELECT * FROM highscore");
	while($row = mysql_fetch_array($result))
	{
		if($row['UserName']==$name)
		{
			$update=1;
			break;
		}
	}
	
	if($update)
	{
		$result = mysql_query("SELECT * FROM highscore WHERE UserName='$name'");
		while($row = mysql_fetch_array($result))
		{
			$cur_score=$row['Score'];
		}
		
		if($cur_score<$highScore)
		{
			mysql_query("
			UPDATE highscore
			SET Score = '$highScore'
			WHERE UserName = '$name'
			");
		}
	}else{
		mysql_query("INSERT INTO highscore (UserName, Score) VALUES ('$name','$highScore')");
	}
	
	if((int)$highScore>480)
	{
		echo '<script type="text/javascript">alert("Första teckenet är:\nL")</script>';
	}
}
	
	
$result = mysql_query("SELECT * FROM highscore ORDER BY Score DESC");

while($row = mysql_fetch_array($result))
{
	if($row['UserName']==$name)
	{
		echo "
		".$row['Score']. " - <a href='../../desc/desc_show/?infoname=".$row['UserName']."'>" . $row['UserName'] ."</a><span style=\"color:green\"> &lt;- Din poäng </span><br />
";
	}else{
		echo "
		".$row['Score']. " - <a href='../../desc/desc_show/?infoname=".$row['UserName']."'>" . $row['UserName'] ."</a><br />
		";
	}
}
mysql_close($con);
?>
</div>
</div>
<? include "bottom_frame.php"?>
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