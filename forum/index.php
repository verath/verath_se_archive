<?php 
$taga=array();
include ('../dbconnect.php');

  $p=0;
  $result = mysql_query("SELECT * FROM forum_posts WHERE Deleted = '0' ORDER BY Id DESC LIMIT 0,5");
  while($row = mysql_fetch_array($result))
  {
  $NewestFPName[$p]=$row['Name'];
  $NewestFPId[$p]=$row['TitleId'];
  $p++;
  }

$q=0;
$result = mysql_query("SELECT * FROM forum WHERE Type='Post' ORDER BY Id DESC");
  while($row = mysql_fetch_array($result))
  {
  $Newestpost[$q]=$row['Title'];
  $Newestid[$q]=$row['Id'];
  for($b=0;$b<$p;$b++)
  {
  if($Newestid[$q]==$NewestFPId[$b]){
  $NewestFPTitle[$b]=$row['Title'];
  }
  }
  $Newesttime[$q]=$row['Time'];
  $NewestPostedby[$q]=$row['Name'];
  $q++;
  }
  
$result = mysql_query("SELECT ForumLevel FROM users WHERE UserName='$name'");
 while($row = mysql_fetch_array($result))
  {
  $Level=$row["ForumLevel"];
  }
$c=0; 
$result = mysql_query("SELECT * FROM forum WHERE InCategory='Forum' ORDER BY Id");
  while($row = mysql_fetch_array($result))
  {
  $post[$c]=$row['Title'];
  $id[$c]=$row['Id'];
  $type[$c]=$row['Type'];
  $category[$c]=$row['Category'];
  $time[$c]=$row['Time'];
  $Postedby[$c]=$row['Name'];
  $c++;
  }
mysql_close($con);
if($q>5){
$q=5;
}
for($a=0;$a<$q;$a++){

$Newestpost[$a]=urldecode($Newestpost[$a]);

$Title=$Newestpost[$a];

if(strlen($Newestpost[$a]) > 12)
{
	$Newestpost[$a]=substr($Newestpost[$a],0,12)."...";
	
}

if(strlen($NewestPostedby[$a]) > 13)
{

	$NewestPostedby[$a]=substr($NewestPostedby[$a],0,13)."...";

}

$Newest.="<a href=\"showPost.php?id=$Newestid[$a]\" class=\"forum_post_title_small\" title=\"$Title\"><strong><div class=\"forum_small_post_container_tread\">".$Newestpost[$a]."</strong> - Skapad av: $NewestPostedby[$a]</div></a>\n";

}

$Newest.="</td>\n<td>\n<strong>Nyaste inläggen:</strong><br />";

for($a=0;$a<$p;$a++){
$NewestFPTitle[$a]=urldecode($NewestFPTitle[$a]);

$Title1=$NewestFPTitle[$a];

if(strlen($NewestFPTitle[$a]) > 12)
{
	$NewestFPTitle[$a]=substr($NewestFPTitle[$a],0,12)."...";
	
}

if(strlen($NewestFPName[$a]) > 13)
{

	$NewestFPName[$a]=substr($NewestFPName[$a],0,13)."...";

}


$Newest.="<a href=\"showPost.php?id=$NewestFPId[$a]\" class=\"forum_post_title_small\" title=\"$Title1\"><div class=\"forum_small_post_container_post\"><strong>".$NewestFPTitle[$a]."</strong> - Sagt av: $NewestFPName[$a]</div></a>\n";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<!-- a / b index page test -->
<script>
function utmx_section(){}function utmx(){}
(function(){var k='2916749837',d=document,l=d.location,c=d.cookie;function f(n){
if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.indexOf(';',i);return c.substring(i+n.
length+1,j<0?c.length:j)}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;
d.write('<sc'+'ript src="'+
'http'+(l.protocol=='https:'?'s://ssl':'://www')+'.google-analytics.com'
+'/siteopt.js?v=1&utmxkey='+k+'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='
+new Date().valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"></sc'+'ript>')})();
</script><script>utmx("url",'A/B');</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<link href="forum.css" rel="stylesheet" type="text/css" />
<title>Forum | | Index</title>
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
<li><a class="menu_link" href='../../../forum'><strong>Forum</strong></a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<img src="../pics/Forum_Title.png" alt="Veraths Forum (Beta)" />
<?php
/*
if(!$_COOKIE["name"]){
echo "
<p>
	<span style=\"font-size:15px;\">Välkommen till forumet på verath.se</span><br />
	För att kunna använda den här funktionen måste du vara inloggad.<br />
	<a href=\"../newuser\">Ny användare</a>	
</p>
</div>
</div>
</div>
</body>
</html>
";
//header("location: http://verath.se");
exit;
}*/
?>
<p>
	<span style="font-size:15px;">Välkommen till forumet</span><br />Här nedan är alla katagorier listade.<br />
    Tycker du att det fattas någon kategori i forumet? Skapa en tråd och säg vad du tycker.
</p>
<div class="forum_kategori_top">
<div class="forum_over_cat">Forum:</div>
<?php
for($a=0;$a<$c;$a++){
echo "
<a href=\"showCat.php?id=$id[$a]\">\n<div class=\"forum_kategori\">".urldecode($category[$a])."</div>\n</a>\n";
}
?>
</div>
<br style="clear:both;" />
<br />
<div class="newestContainer">
<table cellspacing="5" cellpadding="5" cols="2">
<tr><td>
<strong>Nyaste trådarna:</strong>
<?php echo $Newest; ?>
</td></tr>
</table>
</div>

<?php
  if($Level>=5){
  echo "
  <div class=\"forum_new_post_input\" />\n
  <div class=\"forum_new_cat_form\" />\n
  <p><strong>Ny kategori:</strong></p>\n
  <form action=\"NewCat.php\" method=\"post\">\n
<p>Namn:<br />\n
<input type=\"text\" name=\"category\" />\n
<input type=\"hidden\" value=\"Forum\" name=\"cat\" />\n</p>
<p><input type=\"submit\" value=\"Lägg till\" />\n
<input type=\"hidden\" name=\"loc\" value=\"". $_SERVER["SCRIPT_NAME"]."\" />\n</p>
</form>\n
</div>
</div>
";
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

<script>
if(typeof(urchinTracker)!='function')document.write('<sc'+'ript src="'+
'http'+(document.location.protocol=='https:'?'s://ssl':'://www')+
'.google-analytics.com/urchin.js'+'"></sc'+'ript>')
</script>
<script>
try {
_uacct = 'UA-4927397-4';
urchinTracker("/2916749837/test");
} catch (err) { }
</script>

</body>
</html>