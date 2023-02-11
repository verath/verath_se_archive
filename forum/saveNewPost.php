<?php
   include('function_lib.php');

   if(!isset($_COOKIE["name"])){
      header("location: http://verath.se");
      exit;
   }

   $cat=urlencode($_POST["cat"]);
   $catId=$_POST["catId"];
   $loc=$_POST["loc"]."?id=$catId";

   if(!isset($_POST["content"])){
      header("location: $loc");
      exit;
   }
   $name=$_COOKIE["name"];
   $content=htmlspecialchars($_POST['content']);
   $content=nl2br($content);
   //$content = bbcode($content);

   $title=htmlspecialchars($_POST['title']);
   $title=urlencode($title);

   include ('../dbconnect.php');
	
	// Reverse magic_quotes_gpc/magic_quotes_sybase effects on those vars if ON.

	if(get_magic_quotes_gpc()) {
		$content = stripslashes($content);
		$title = stripslashes($title);
	}
	$content = mysql_real_escape_string($content);
	$title = mysql_real_escape_string($title);
	
	

   $result = mysql_query("SELECT * FROM forum WHERE Title='".$title."'");

   while($row = mysql_fetch_array($result))
   {
      $exist=1;
   }

   if($exist!=1){
      $time=date(YmdHis);

      mysql_query("INSERT INTO forum (Title, InCategory, InCategoryId, Type, Time, Name) VALUES ('$title', '$cat', '$catId', 'Post', '$time', '$name')");

      $result = mysql_query("SELECT Id FROM forum WHERE Title='".$title."'");

      while($row = mysql_fetch_array($result))
      {
         $postId=$row['Id'];
      }
      mysql_query("INSERT INTO forum_posts (Name, Content, TitleId, Time) VALUES ('$name', '$content', '$postId', '$time')") or die("error");

      mysql_query("UPDATE users SET ForumPosts = ForumPosts+1 WHERE UserName='$name'");
   }

   mysql_close($con);
   header("location: $loc");
?>