<?php
function slashes($text){
if (!get_magic_quotes_gpc()) {
$text=addslashes($text);
}
return $text;
}
if(!$_COOKIE["name"]){
header("location: http://verath.se");
exit;
}
$catId=$_POST["catId"];
$cat=urlencode($_POST["cat"]);
$loc=$_POST["loc"]."?id=$catId";
if(!$_POST["category"]){
header("location: $loc");
exit;
}
$name=$_COOKIE["name"];

$category=slashes($_POST["category"]);
$category=urlencode($category);

include ('../dbconnect.php');
$result = mysql_query("SELECT ForumLevel FROM users WHERE UserName='$name'");
 while($row = mysql_fetch_array($result))
  {
  $Level=$row["ForumLevel"];
  }
  if($Level>=5){
mysql_query("INSERT INTO forum (Category, InCategory, InCategoryId, Type) VALUES ('$category', '$cat', '$catId', 'Category')");
mysql_close($con);
}
header("location: $loc");
?>