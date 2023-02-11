<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<script type="text/javascript">
function setCookie(c_name,value,expiredays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate()+expiredays);
document.cookie=c_name+ "=" +escape(value)+
((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../layout.css" rel="stylesheet" type="text/css">
<link href="../meny.css" rel="stylesheet" type="text/css">
<link href="forum.css" rel="stylesheet" type="text/css">
<?php
/*
if(!$_COOKIE["name"]){
header("location: http://verath.se");
}*/
?>
<?php
$name = $_COOKIE['name'];
$post=array(); 
$c=0;
$id=(int)$_GET['id'];
$id_Cat=array();
include ('../dbconnect.php');
$result = mysql_query("SELECT ForumLevel FROM users WHERE UserName='$name'");
 while($row = mysql_fetch_array($result))
  {
  $Level=$row["ForumLevel"];
  }
  
  $result = mysql_query("SELECT * FROM forum WHERE Id='$id'");
  while($row = mysql_fetch_array($result))
  {
  $overCat=$row['InCategory'];
  $overCatId=$row['InCategoryId'];
  $cat=urldecode($row['Category']);
  }
  
  /*$result = mysql_query("SELECT * FROM forum WHERE Category='$overCat'");
  while($row = mysql_fetch_array($result))
  {
  $overCatId=$row['Id'];
  }*/
$result = mysql_query("SELECT * FROM forum WHERE InCategory='".urlencode($cat)."'ORDER BY Id");
  while($row = mysql_fetch_array($result))
  {
  if(strlen($row['Title'])>35)
  {
  	$post[$c]=substr(urldecode($row['Title']),0,35)."...";
  }
  else
  {
  	$post[$c]=urldecode($row['Title']);
  }
  $id_Cat[$c]=$row['Id'];
  $type[$c]=$row['Type'];
  $category[$c]=$row['Category'];
  $time[$c]=$row['Time'];
  $Postedby[$c]=$row['Name'];
  $c++;
  }
mysql_close($con);

$posts="";
$cats="";
//$overCats=$_GET[overCats]."&nbsp;-&gt;&nbsp;".urldecode($_GET["cat"]);
for($a=0;$a<$c;$a++){
if($type[$a]=="Category"){
$cats.="<a href=\"showCat.php?id=".$id_Cat[$a]."\" >
<div class=\"forum_kategori\">
".urldecode($category[$a])."
</div>
</a>";
}else{
$posts.="
<a href=\"showPost.php?id=$id_Cat[$a]\"><div class=\"forum_post_title\"><strong>".$post[$a]."</strong> - Skapad av: $Postedby[$a]</div></a>\n";
 if($Level>=5 && !isset($_COOKIE["DontShowDelete"])){
 $posts.="<a href=\"javascript:if(confirm('Är du säker på att du vill ta bort tråden?')){document.location.href='delWholePost.php?id=$id_Cat[$a]&loc=showCat.php&CatId=$id'}\"><div class=\"forum_post_delete\"><strong>Ta bort</strong></div></a>\n";
 }
}
}

?>
<title>Forum | | 
<?php 
if($overCat=="Forum"){
echo "$overCat -> $cat";
}else{
echo urldecode($overCat)." -> ".urldecode($cat);
}
 ?></title>
</head>
<body bgcolor="#ffffff">
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
<?
if($Level>=5)
{
	if(!isset($_COOKIE["DontShowDelete"]))
	{
		echo "<a href=\"\" onClick=\"setCookie('DontShowDelete','1',365);\" style=\"float:right\">Dölj \"Ta bort länkar\"</a><br />";
	}else
	{
		echo "<a href=\"\" onClick=\"setCookie('DontShowDelete','',-365);\" style=\"float:right\">Visa \"Ta bort länkar\"</a><br />";
	}
}
?>
<div class="forum_right_list"><p>Förslag på vad som kan vara här.<br>Skriv <a href="http://verath.se/forum/showPost.php?id=60">här</a>.</p>
</div> 
<h3>
<?php
echo urldecode($cat);
if($overCat=="Forum")
{
	$overCatText= "<a href=../forum>$overCat</a> -> $cat";
}else
{
	$overCatText= "<a href=showCat.php?id=$overCatId>".urldecode($overCat)."</a> -> ".urldecode($cat);
}
 ?>
 </h3>
 <div class="forum_kategori_top">
<?php
echo "<div class=\"forum_over_cat\">".$overCatText.":</div>";
if($cats!="")
{
	echo $cats;
}
if($posts!="")
{
	// "<div class=\"forum_post_title_container\">".."</div>"
	echo "<div class=\"forum_post_title_container\">".$posts."</div>";
}
?>
</div>
<div class="forum_new_post_input">
<?php if($_GET["error"]){
echo "<span style=\"color:red;\">".htmlentities($_GET["error"])."</span>";
}
// Visa endast vid inloggad
if(isset($_COOKIE["name"])) {
echo'<div style="border:dashed 1px #333333; width:500px; padding:5px 5px 5px 5px;">
<p><strong>Skriv ett inlägg:</strong></p>
<form action="saveNewPost.php" method="post">
<p>Rubrik:<br>
<input type="text" name="title"></p>
<p>Skriv ditt inlägg här:<br />
<textarea name="content" style="width:400px; height:100px; font: 11px Verdana, Arial, Helvetica, sans-serif;">
</textarea></p>
<p>
<input type="hidden" value="'.$cat.'" name="cat">
<input type="submit" value="Spara">
<input type="hidden" name="loc" value="'.$_SERVER["SCRIPT_NAME"].'">
<input type="hidden" name="catId" value="'.$id.'">
</p>
</form>
</div>';
}
  if($Level>=5){
  echo "
  <div class=\"forum_new_cat_form\">
  <p><strong>Ny kategori:</strong></p>
  <form action=\"NewCat.php\" method=\"post\">
<p>Namn:<br>
<input type=\"text\" name=\"category\"></p>
<input type=\"hidden\" value=\"". $cat ."\" name=\"cat\">
<p><input type=\"submit\" value=\"Lägg till\"></p>
<input type=\"hidden\" name=\"loc\" value=\"". $_SERVER["SCRIPT_NAME"]."\">
<input type=\"hidden\" name=\"catId\" value=\"$id\">
</form>
</div>
  ";
  }
?>
</div>
</div>
</div>
<? include ('../bottom_frame.php');?>
</div>

<script>
if(typeof(urchinTracker)!='function')document.write('<sc'+'ript src="'+
'http'+(document.location.protocol=='https:'?'s://ssl':'://www')+
'.google-analytics.com/urchin.js'+'"></sc'+'ript>')
</script>
<script>
try {
_uacct = 'UA-4927397-4';
urchinTracker("/2916749837/goal");
} catch (err) { }
</script>

</body>
</html>