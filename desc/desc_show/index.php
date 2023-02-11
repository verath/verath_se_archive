<?php 
   header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
   header('Cache-Control: no-store, no-cache, must-revalidate'); 
   header('Cache-Control: post-check=0, pre-check=0', FALSE); 
   header('Pragma: no-cache'); 
?>
<?php
$name_desc=$_GET["infoname"];

include ('../../dbconnect.php');

   $twitter = '';

  $result = mysql_query("SELECT * FROM users");
  while($row = mysql_fetch_array($result))
  {
  if(html_entity_decode($row['UserName'])==$name_desc){
  $desc_desc=nl2br($row['Info']);
  $desc_name=$row['UserName'];
  $desc_FirstName=$row["FirstName"];
  $desc_LastName=$row["LastName"];
  $desc_Email=$row["Email"];
  $desc_Msn=$row["Msn"];
  $desc_LastOnline=$row["LastOnline"];
  $desc_Online=$row["Online"];
  $desc_Lan=$row["Lan"];
  $desc_Viewed = $row["Viewed"];
  $color=$row["Color"];
  $back=$row["Background"];
  $twitter=$row['twitter'];
  
  mysql_query("UPDATE users SET Viewed = Viewed+1 WHERE UserName='$desc_name' LIMIT 1");
  
  $desc_Age=date(Y)-substr($row["Born"],0,4);
  $Month=(int)substr($row["Born"],5,2);
  $Day=(int)substr($row["Born"],8,2);
    $Year=date(Y);
  if(mktime(0,0,0,$Month,0,date(y))>mktime(0,0,0,date(m),0,date(y)))
  {
  	$desc_Age--;
  }else
  {
  	 $Year++;
  }
  $DL=round((mktime(0,0,0,$Month,$Day,$Year)-time())/60/60/24);
  $desc_DaysLeft = ", " . $DL . " dagar kvar tills " . $desc_name . " är " . (string)($desc_Age+1) . ".";
    if($row["Born"]=="0000-00-00")
  {
  	$desc_Age="--";
	$desc_DaysLeft = "";
  }
  break;
  }
  }
  
  // HACKING
$hackLevelArray=array("Ingen","N00b","Dålig","Inte bra","Finns sämre...","HTML-kunnig","Javascript??","Hyfsad","Bra","Javascript-kunnig","Javascript-Pro","Wannabe Hacker","Pro","Master","Hacker","H4X0R","1337 H4X0R","D3(ryp73r","T|-|3 M4573r",".","..","...","....");
  $name=$_COOKIE["name"];
  $hackLevel=0;
  $result = mysql_query("SELECT * FROM hacking WHERE Name='$desc_name'");
	while($row = mysql_fetch_array($result))
			{
				$hackLevel=(int)$row['Level'];
			}
			
  
mysql_close($con);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../layout.css" rel="stylesheet" type="text/css" />
<link href="../../meny.css" rel="stylesheet" type="text/css" />
<link href="../style/personal.php<?php echo "?back=" .$back . "&color=" .$color; ?>" rel="stylesheet" type="text/css" />
<title><? echo htmlentities($name_desc) ?>'s Profil</title>
</head>
<body>
<div id="sidlayout">
<?php include ('../../login.php'); ?>
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
<div class="descArea">
<?
// Visa "ändra profl" länken om det är ens egen profil man kollar på.
if($name_desc==$_COOKIE["name"])
{
	echo"
	<p><a href=\"../\"><strong>Ändra profil</strong></a></p>
	";
}

//Online now?
$Online="<span style=\"color:red;\"><strong>Offline</strong></span>";
if(time()-2*60<$desc_Online)
{
	$Online="<span style=\"color:green;\"><strong>Online</strong></span>";
}


if($desc_name){
	if(file_exists("../../UserImages/".$desc_name.".bmp"))
	{
		$image="<div class=\"ImageContainer\"><img style=\"width:200px;height:200px;\" src=\"../../UserImages/$desc_name.bmp\" alt=\"{$desc_name}s Bild\" /></div>";
	}else
	{
		$image="<div class=\"ImageContainer\"><img src=\"../../UserImages/Errors/no.bmp\" alt=\"{$desc_name}s Bild\" /></div>";
	}
	echo "<h3 style=\"text-align:center\">$desc_name</h3><br />
	$image
	<div style=\"border:solid 1px #000000;width:470px;\">
	<table border='0' cellspacing='10'>
	<tr><td><span style=\"color:blue\">Namn:</span></td> <td>$desc_FirstName $desc_LastName</td></tr>
	<tr><td><span style=\"color:blue\">Ålder:</span></td> <td>$desc_Age år $desc_DaysLeft</td></tr>
	<tr><td><span style=\"color:blue\">Email:</span></td> <td>$desc_Email</td></tr>
	<tr><td><span style=\"color:blue\">Msn:</span></td> <td>$desc_Msn</td></tr>
	<tr><td><span style=\"color:blue\">Län:</span></td> <td>$desc_Lan</td></tr>
	<tr><td><span style=\"color:blue\">Loggade senast in:</span></td> <td>$desc_LastOnline</td></tr>
	<tr><td><span style=\"color:blue\">Hacking-level:</span></td><td>{$hackLevelArray[$hackLevel]} ($hackLevel)</td></tr>
	<tr><td><span style=\"color:blue\">Status:</span></td><td>{$Online}</td></tr>
	</table>
	</div>
	<table border='0' cellspacing='10'>
	<tr><td><span style=\"color:blue\">Beskrivning:</span></td></tr>
	<tr><td></td><td>$desc_desc</td></tr>";
   if (strlen($twitter) > 0):
   echo
   "<tr><td><span style=\"color:blue\">Twitter:</span></td></tr>
   <tr><td></td><td><ul id=\"twitter_update_list\"></ul>
<a href=\"http://twitter.com/{$twitter}\" id=\"twitter-link\" style=\"display:block;text-align:right;\">Följ {$desc_name} på Twitter</a>
</td></tr>";
   endif;
   echo
   "</table><br />
	<div style=\"width:600px; float:none; margin-left:auto;margin-right:auto;\">
	<p>
		<span style=\"float:right\">Profilen visad: $desc_Viewed gånger</span>
		<a href='../../msg/?action=send&amp;who=$desc_name'>Skicka ett meddelande till $desc_name</a>
	</p>
	</div>
	
	";
}else
{
	echo "Användaren du letar efter kunde inte hittas!";
}
?>
</div>
</div>
</div>
<? include '../../bottom_frame.php'?>
</div>
</div>
<?php if(strlen($twitter) > 0){
echo "<script type=\"text/javascript\" src=\"http://twitter.com/javascripts/blogger.js\"></script>
<script type=\"text/javascript\" src=\"http://twitter.com/statuses/user_timeline/{$twitter}.json?callback=twitterCallback2&amp;count=7\"></script>
";}?>
</body>
</html>