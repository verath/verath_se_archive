<?php
$Lans=array(
  	"Blekinge",
    "Dalarna",
    "Gotland",
    "Gävleborg",
    "Halland",
    "Jämtland",
    "Jönköping",

    "Kalmar",
    "Kronoberg",
    "Norrbotten",
    "Skåne",
    "Stockholm",
    "Södermanland",
    "Uppsala",

    "Värmland",
    "Västerbotten",
    "Västernorrland",
    "Västmanland",
    "Västra Götaland",
    "Örebro",
    "Östergötland");

$name=$_COOKIE["name"];
if($name){
include ('../dbconnect.php');
  if($_POST["submit"] && $name){	
  $content = $_POST['Desc_in'];
  $FName = $_POST['Name'];
  $LName = $_POST['Last'];
  $Email = $_POST['Email'];
  $Msn = htmlspecialchars($_POST['Msn']);
  $Born = $_POST['Year'] . $_POST['Month'] . $_POST['Day'];
  
  $twitter = htmlspecialchars($_POST['twitter']);
  
  $Lan = $_POST['Lan'];
  $Born = (int) $Born;
   if(!get_magic_quotes_gpc())
   {
      $content = addslashes($content);
   }
   $replace=array("<",">","javascript:");
   $content =str_replace($replace,"",$content);
   $FName =str_replace($replace,"",$FName);
   $EName =str_replace($replace,"",$EName);
   $Email =str_replace($replace,"",$Email);
   foreach( $Lans as $value)
   {
   		if($value==$Lan)
		{
			$LanExsist=true;
		}
   }
   if(!$LanExsist)
   {
   		$Lan="- Län -";
   }
   $Lan = htmlentities($Lan);
   mysql_query("UPDATE users SET Info = '$content' WHERE UserName = '$name'")or Die(mysql_error());
   mysql_query("UPDATE users SET FirstName = '$FName' WHERE UserName = '$name'")or Die(mysql_error());
   mysql_query("UPDATE users SET LastName = '$LName' WHERE UserName = '$name'")or Die(mysql_error());
   mysql_query("UPDATE users SET Email = '$Email' WHERE UserName = '$name'")or Die(mysql_error());
   mysql_query("UPDATE users SET Msn = '$Msn' WHERE UserName = '$name'")or Die(mysql_error());
   //mysql_query("UPDATE users SET msgEmail = '$msgEmail' WHERE UserName = '$name'")or Die(mysql_error());
   mysql_query("UPDATE users SET Born = '$Born' WHERE UserName = '$name'")or Die(mysql_error());
   mysql_query("UPDATE users SET twitter = '$twitter' WHERE UserName = '$name'")or Die(mysql_error());
   mysql_query("UPDATE users SET Lan = '$Lan' WHERE UserName = '$name'")or Die(mysql_error());
   echo "<p style='color:red;'>Dina ändringar har sparats!</p>";
  }
 $result = mysql_query("SELECT * FROM users");
  while($row = mysql_fetch_array($result))
  {
  if($row['UserName']==$_COOKIE["name"]){
	  $FirstName=$row["FirstName"];
	  $LastName=$row["LastName"];
	  $Email=$row["Email"];
	  $Msn = $row["Msn"];
	  $msgEmail=$row["msgEmail"];
	  $Year=substr($row["Born"],0,4);
	  $Month=substr($row["Born"],5,2);
	  $Day=substr($row["Born"],8,2);
	  $Lan=$row["Lan"];
	  $desc=$row["Info"];
	  $color=$row["Color"];
	  $back=$row["Background"];
     $twitter = $row['twitter'];
	  break;
  }
  }
mysql_close($con);
if(file_exists("../UserImages/".$name.".bmp")){
$image="<div class=\"ImageContainer\"><a href=\"ChangePic.php\" title=\"Byt bild\"><img style=\"width:200px;height:200px;border:none;\" src=\"../UserImages/$name.bmp\" alt=\"Din Bild\" /></a><strong>Klicka på bilden för att byta.</strong>
</div>";
}else{
$image="<div class=\"ImageContainer\"><a href=\"ChangePic.php\" title=\"Byt bild\"><img src=\"../UserImages/Errors/no.bmp\" style=\"width:200px;height:200px;border:none;\" alt=\"Din Bild\"></a><strong>Klicka på bilden för att byta.</strong>
</div>";
}
$optionYear="
<option value=\"\">- År -</option>
";
for ($year=date(Y); $year>=date(Y)-100; $year--)
{
	if($year==$Year)
	{
		$optionYear.="
		<option value=\"$year\" selected=\"selected\">$year</option> <!-- SELECTED [Year] -->
		";
	}else
	{
		$optionYear.="<option value=\"$year\">$year</option>
		";
	}
}

$optionMonth="<option value=\"\">- Månad -</option>
";
$monthText=array("","Januari","Februari","Mars","April","Maj","Juni","Juli","Augusti","September","Oktober","November","December");

for ($month=01;$month<=12;$month++)
{
	$monthValue=$month;
	if($month < 10)
	{
		$monthValue="0".$month;
	}
	
	if($month==$Month)
	{
		$optionMonth.="<option value=\"$monthValue\" selected=\"selected\">{$monthText[$month]}</option> <!-- SELECTED [Month] -->
		";
	}else
	{
		$optionMonth.="<option value=\"$monthValue\">{$monthText[$month]}</option>
		";
	}
}

$optionDay="<option value=\"\">- Dag -</option>
";

for ($day=01;$day<=31;$day++)
{
	if($day < 10)
	{
		$day="0".$day;
	}
	if($day==$Day)
	{
		$optionDay.="<option value=\"$day\" selected=\"selected\">$day</option> <!-- SELECTED [Day] -->
		";	
	}else
	{
		$optionDay.="<option value=\"$day\">$day</option>
		";	
	}
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<link href="style/personal.php<?php echo "?back=" .$back . "&color=" .$color; ?>" rel="stylesheet" type="text/css" />
<title>Min Profil</title>
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
echo "
<p><a href=\"./desc_show?infoname=$name\"><strong>Visa profil</strong></a></p>
<div class=\"descArea\">
<form action=\"\" method=\"post\">
$image
<table border='0' cellspacing='10'>
<tr><td>Namn: </td><td><input type=\"text\" value=\"$FirstName\" name=\"Name\" /></td></tr>
<tr><td>Efternamn: </td><td><input type=\"text\" value=\"$LastName\" name=\"Last\" /></td></tr>
<tr><td>Email: </td><td><input type=\"text\" value=\"$Email\" name=\"Email\" /></td></tr>
<tr><td>Msn: </td><td><input type=\"text\" value=\"$Msn\" name=\"Msn\" /></td></tr>
<tr><td>Twitter (namn)</td><td><input value=\"$twitter\" type=\"text\" name=\"twitter\" /></td></tr>
<tr><td>Födelsedatum: </td><td><select name=\"Year\">

<!-- Options [Year] -->
$optionYear
<!-- /Options [Year] -->

</select> <select name=\"Month\">

<!-- Options [Month] -->
$optionMonth
<!-- /Options [Month] -->

</select> <select name=\"Day\">

<!-- Options [Day] -->
$optionDay
<!-- /Options [Day] -->


</select>

</td>
</tr>

<tr><td>Län:</td>
<td>
<select name=\"Lan\">

<!-- Options [Län] -->
<option value=\"\">- Län -</option>
";
foreach($Lans as $value)
{
	if($value == html_entity_decode($Lan))
	{
		echo "<option value=\"$value\" selected=\"selected\">$value</option> <!-- Selected Län -->\n";
	}else
	{
		echo "<option value=\"$value\">$value</option>\n";
	}
}
echo "
<!-- /Options [Län] -->
</select>
</td>
</table>
<p>
<a href=\"changeColor.php\">Ändra färg</a>
</p>
<p>
	Beskrivning:
	<textarea name='Desc_in' cols=\"10\" rows=\"10\" style=\"width: 100%; height: 200px;\">$desc</textarea>
</p>
</div>

<!--[if IE]>
<input type=\"submit\" alt=\"Spara\" title=\"Spara\" name=\"submit\" value=\"Spara\" />
<![endif]-->

<comment>
<p>
	<input type=\"image\" src=\"../pics/save.png\" alt=\"Spara\" title=\"Spara\" name=\"submit\" value=\"submit\" />
</p>
</comment>
</form>
";
}else{
 echo"<p>Du måste logga in för att komma åt den här funktionen!<br /><a href=\"./newuser\">Ny användare</a></p>";
}
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