<?php
   include('function_lib.php');
   if(!$_COOKIE["name"]){
      header("location: http://verath.se");
      exit;
   }

   isset($_POST['loc']) ? $loc=$_POST["loc"].'&id='.$_POST['id'] : $loc="http://verath.se/forum";

   if(!$_POST["content"]){
      header("location: $loc");
      exit;
   }

   $name=$_COOKIE["name"];

   $content = htmlspecialchars($_POST['content']);
   $content = nl2br($content);
	//$content = bbcode($content);

   $postId=(int)$_POST["id"];
   $time=date(YmdHis);

   include ('../dbconnect.php');
	
	// Reverse magic_quotes_gpc/magic_quotes_sybase effects on those vars if ON.

	if(get_magic_quotes_gpc()) {
		$content = stripslashes($content);
	}
	
	$content = mysql_real_escape_string($content);

   $result = mysql_query("SELECT * FROM forum WHERE id='$postId'");
   while($row = mysql_fetch_array($result))
   {
      $Locked=$row['Locked'];
   }


   if($Locked!="yes") {		
      mysql_query("INSERT INTO forum_posts (Name, Content, TitleId, Time) VALUES ('$name', '$content', '$postId', '$time')") or die("error");
   	mysql_query("UPDATE users SET ForumPosts = ForumPosts+1 WHERE UserName='$name'");
   }

   mysql_close($con);

   if($postId==122) {
      // SECRET CODE ;)
      header("location: $loc&sCode=1");
      exit;
   }

   header("location: $loc");
?>