<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<title>Sök användare</title>
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
<li><a class="menu_link" href='../../../search'><strong>Hitta användare</strong></a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<?
if($_POST["Who"]=="L3CQM")
{
	echo'<script type="text/javascript">alert("Sista teckenet är:\n3")</script>';
}

?>
<div style="border-bottom:thin dashed #000000; padding-bottom:10px;">
<h3>Sök användare:</h3>
<form action="" method="post">
<table>
<tr><td>Namn:</td><td> <input type="text" name="Who" /></td><td><input type="submit" name="submit" value="Sök" /></td></tr>
</table>
</form>
<br />
<?php
$who=$_POST["Who"];
if(strlen($who)!=0){
$a=0;
$WhoA=array();
include ('../dbconnect.php');
$query  = "SELECT * FROM users ORDER BY UserName";
$result = mysql_query($query);
  while($row = mysql_fetch_array($result))
  {
  $WhoA[$a]=$row["UserName"];
  $a++;
  }
  mysql_close($con);
  $Posible=array();
  $b=0;
  for($i=0;$i<$a;$i++){
  if(stristr($WhoA[$i],$who)){
  $Posible[$b]=$WhoA[$i];
  $b++;
  }
  }
  echo "<span style=\"Font-size:14px;\">Din sökning på '" . htmlentities(stripslashes($who)) . "' resulterade i följande träffar:</span><br />";
  if($b==0){
  echo "<span style=\"color:red\">Ingen användare matchade din sökning.</span>";
  }else{
  
    $b=0;
	  echo '
  <div class="userContainer">';
foreach($Posible as $val){

	if(file_exists("../UserImages/".$val.".bmp"))
	{
		$image="<img style=\"width:50px;height:50px;border:none;\" src=\"../UserImages/{$val}.bmp\" alt=\"{$val}s Bild\" />";
	}else
	{
		$image="<img style=\"width:50px;height:50px;border:none;\" src=\"../UserImages/Errors/no.bmp\" alt=\"{$val}s Bild\" />";
	}
	
	if($b==5)
	{
		echo "
		</div>
		<div class=\"userContainer\">";
		$b=0;
	}

echo "<div class=\"userImg\"><a href=\"../desc/desc_show/?infoname=$val\">$image<br />$val</a></div>";
$b++;
}
}
  echo "
  </div>
  <br style=\"clear:both;\" />
  ";
}

?>
</div>
<h4 style="margin-bottom:0px;">Alla Användare:</h4>
<?
// how many rows to show per page
	$rowsPerPage = 20;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
    $pageNum = (int)$_GET['page'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$a=0;

include ('../dbconnect.php');
$query  = "SELECT * FROM users ORDER BY UserName LIMIT $offset, $rowsPerPage";
$result = mysql_query($query);
  while($row = mysql_fetch_array($result))
  {
  $Names[$a]=$row["UserName"];
  $Online[$a]=$row["Online"];
  $a++;
  }
  
  echo '
  <div class="userContainer">';
  $b=0;
for($i=0;$i<$a;$i++)
{
	if(time()-2*60<$Online[$i])
	{
		// Om personen är online, gör så namnet är grönt
		$onlineColor="<span style=\"color:green\">";
	}else
	{
		// Om personen inte är online, gör så att namnet visas i rött
		$onlineColor="<span style=\"color:red\">";
	}


	if(file_exists("../UserImages/".$Names[$i].".bmp"))
	{
		$image="<img style=\"width:50px;height:50px;border:none;\" src=\"../UserImages/{$Names[$i]}.bmp\" alt=\"{$Names[$i]}s Bild\" /><br />";
	}else
	{
		$image="<img style=\"width:50px;height:50px;border:none;\" src=\"../UserImages/Errors/no.bmp\" alt=\"{$Names[$i]}s Bild\" /><br />";
	}
  if($b==5)
  {
	  echo "
	  </div>
	  <div class=\"userContainer\">";
	  $b=0;
  }
  echo "
	<div class=\"userImg\"><a href=\"../desc/desc_show/?infoname=" . $Names[$i] . "\">" .$image. $onlineColor .$Names[$i] . "</span></a></div>
	";
	$b++;
  
}

echo "
</div>
<br style=\"clear:both;\" />
";
    // how many rows we have in database
$query   = "SELECT COUNT(UserName) AS numrows FROM users";
$result  = mysql_query($query) or die('Error, query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav  = '';

for($page = 1; $page <= $maxPage; $page++)
{
   if ($page == $pageNum)
   {
      $nav .= " $page "; // no need to create a link to current page
   }
   else
   {
      $nav .= " <a href=\"$self?page=$page\">$page</a> ";
   }
}

// creating previous and next link
// plus the link to go straight to
// the first and last page
if($maxPage > 1){
if ($pageNum > 1)
{
   $page  = $pageNum - 1;
   $prev  = " <a href=\"$self?page=$page\">[Förra]</a> ";

   $first = " <a href=\"$self?page=1\">[Första sidan]</a> ";
}
else
{
   $prev  = '&nbsp;'; // we're on page one, don't print previous link
   $first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
   $page = $pageNum + 1;
   $next = " <a href=\"$self?page=$page\">[Nästa]</a> ";

   $last = " <a href=\"$self?page=$maxPage\">[Sista sidan]</a> ";
}
else
{
   $next = '&nbsp;'; // we're on the last page, don't print next link
   $last = '&nbsp;'; // nor the last page link
}
// print the navigation link
echo "<p><br />
<br />
<br />
".$first . $prev . $nav . $next . $last."</p>";
}
mysql_close($con);
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