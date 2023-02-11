<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<title>Länkar
<?
$tag=htmlspecialchars($_GET["tag"]);
 if($_GET["tag"]){
 echo " | ".$tag;
 }
?>
 </title>
</head>
<body>
<div id="sidlayout">
<?php
$taga=array();
include ('../dbconnect.php');
$result = mysql_query("SELECT Tag FROM links");
  while($row = mysql_fetch_array($result))
  {
  $taga[$i]=$row['Tag'];
  $i++;
  }
  $tags=array();
  $i=0;
  foreach($taga as $value){
  foreach($tags as $val){
  if($value == $val){
  $isSet=1;
  }
  }
  if($isSet!=1){
  $tags[$i]=$value;
  $i++;
  }else{
  $isSet=0;
  }
  }
mysql_close($con);
include ('../login.php'); 
?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
<li><a class="menu_link" href='../../../kul'>Kul</a></li>
<li><a id="selected" href="../../links"><strong>Länkar</strong></a></li>
<?php
foreach($tags as $value){
if($value != $tag){
echo "<li><a class='selected_sub' href='../links?tag=$value'>$value</a></li>
"; // Output link to tagpage
}else{
echo "<li><span class='selected_sub'><strong>$value</strong></span></li>
"; // make current tag page strong
}
}
?>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<?
if($tag)
{
	echo '<div style="border-bottom:#FF0000 1px dotted">
	';
	echo "<a href='../links'>Länkar</a>
	";
	$value="";
	foreach($tags as $value)
	{
		if($value != $tag)
		{
			echo "<a href='../links?tag=$value'>$value</a> 
			";
		}else
		{
			echo "$value 
			";
		}
	}
	echo "</div>";
}
?>
<?php
if($_GET["tag"])
{
echo'
<div style="width:120px; float:right; margin-top:15px;">
<script type="text/javascript"><!--
google_ad_client = "pub-9630536624744540";
/* 120x600, skapad 2008-10-16 */
google_ad_slot = "7198264553";
google_ad_width = 120;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<div style="width:540px; float:left;">';
}
?>
<p>
<span style="text-align:center; font-size:16px;">
<? 
$tagExsist=false;
if($tag){
foreach($tags as $value){
if($value == $tag){
echo "$tag";
$tagExsist=true;
}
}
if(!$tagExsist){
echo "Kategorin finns inte!
";
}
}else{
echo "Länkar
";
}
?>
</span></p>
<?
$i=0;
$name=array();
$location=array();
$desc=array();
$id=array();
// how many rows to show per page
$rowsPerPage = 20;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
    $pageNum =(int) $_GET['page'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
$tag=$_GET["tag"];
if($tag){
include ('../dbconnect.php');
  $result = mysql_query("SELECT * FROM links WHERE Tag='$tag' ORDER BY id DESC LIMIT $offset, $rowsPerPage");
  while($row = mysql_fetch_array($result))
  {
  $name[$i]=$row['Name'];
  $location[$i]=$row['Location'];
  $desc[$i]=$row['Gdesc'];
  $id[$i]=$row['Id'];
  $i++;
  }
  echo "
  <ul>
  ";
  for($a=0;$a<$i;$a++){
  echo "
  <li><a href=\"$location[$a]\" target=\"_blank\">$name[$a]</a> - $desc[$a]</li>
  ";
  }
  echo "
  </ul>
  ";
  // how many rows we have in database
$query   = "SELECT COUNT(Name) AS numrows FROM links WHERE Tag='$tag'";
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
      $nav .= " <a href=\"$self?page=$page&amp;tag=$tag\">$page</a> ";
   }
}

// creating previous and next link
// plus the link to go straight to
// the first and last page
if($maxPage > 1){
if ($pageNum > 1)
{
   $page  = $pageNum - 1;
   $prev  = " <a href=\"$self?page=$page&amp;tag=$tag\">[Förra]</a> ";

   $first = " <a href=\"$self?page=1&amp;tag=$tag\">[Första sidan]</a> ";
}
else
{
   $prev  = '&nbsp;'; // we're on page one, don't print previous link
   $first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
   $page = $pageNum + 1;
   $next = " <a href=\"$self?page=$page&amp;tag=$tag\">[Nästa]</a> ";

   $last = " <a href=\"$self?page=$maxPage&amp;tag=$tag\">[Sista sidan]</a> ";
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
".$first . $prev . $nav . $next . $last;
}
  }else{
$tag=array();
  echo"<p>Alla länkarna är indelade i olika kategorier.<br />
 Tryck på en av kategorierna nedan för att komma till respektive kategori.<br />
<br />
Kategorier:<br /></p>
<ul>";
  foreach($tags as $Tag){
  echo "<li><a href='../links/?tag=$Tag'>$Tag</a></li>
  ";
  }
  echo "</ul><p><br />
Tycker du det saknas någon kategori? Skicka <a href=\"../../msg/?action=send&amp;who=Verath\">mig</a> ett meddelande<br />
";
  }
mysql_close($con);
?>
</p>
<? 
if($tag)
{
echo '</div>';
}

// Lista alla kategorier.
$optionName="";
foreach($tags as $value){
$optionName.="
<option value=\"$value\">$value</option>
";
}
// Print Lägg till länk.
if(isset($_COOKIE["name"]) && !$tag)
{
	print "
	<br />
	<br />
	<h3 style=\"border-top: 1px #000000 dashed\">
	Lägg till en länk:</h3>
	<form action=\"add.php\" method=\"post\">
	<table>
	<tr><td></td><td></td><td> Exempel:</td></tr>
	<tr><td>Namn:</td><td><input type=\"text\" name=\"name\" style=\"width:300px;\" /></td><td> <p style=\"color:red\">Gissa nummer</p></td></tr>
	<tr><td>Kort beskrivning:</td><td><input type=\"text\" name=\"desc\" style=\"width:300px;\" /></td><td> <p style=\"color:red\">Välj ett nummer och datorn listar ut vilket.</p></td></tr>
	<tr><td>Adress:</td><td><input type=\"text\" name=\"location\" style=\"width:300px;\" /></td><td> <p style=\"color:red\">http://verath.se/game/guess.php</p></td></tr>";
	
	$admin="Verath";
	$name=$_COOKIE["name"];
	
	if($name==$admin){
		echo "<tr><td>Kategori:</td><td><input type=\"text\" name=\"tag\" style=\"width:300px;\" /></td>";
	}else{
		echo "<tr><td>Kategori:</td><td><select name=\"tag\" style=\"width:300px;\">". $optionName ."</select></td></tr>";
	}
	
	echo "
	<tr><td></td><td><input type=\"submit\" value=\"Lägg till\" /></td></tr>
	</table>
	</form>";
}
if(!$name && !$tag)
{
	echo "
<p>
För att kunna lägga till länkar måste du logga in.<br />
<a href=\"../newuser/\">Skapa användare</a>
</p>";
}
?>
<?
if(!$tag){
print('<p style="font-size:9px; color:#FF0000"> Verath.se tar inget ansvar för någonting som kan hända dig / din dator genom att klicka på någon av länkarna här!
Jag försöker dock att kolla igenom och ta bort olämpliga länkar så ofta som möjligt!</p>');
}
?>
</div>
</div>
<?
if($tag)
{
	$btmAd="no";
}

 include ('../bottom_frame.php');?>
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