<html>
<body>
<?php
if($_GET["logout"]){
 setcookie("logedin","",time()-3600*24);
 $name=$_COOKIE["name"];
 
 
 // Gör offline
 
 	$time=time()-60*2;
	include ('dbconnect.php');
	mysql_query("UPDATE users SET Online = '$time' WHERE UserName = '$name'");
	mysql_close($con);
	
 setcookie("name","",time()-3600*24);
 setcookie("Password","",time()-3600*24);
// setcookie("LastOnline","",time()-3600*24);
 header("location: http://verath.se");
 exit;
}else{
include "dbconnect.php";
  $result = mysql_query("SELECT * FROM users");
  while($row = mysql_fetch_array($result))
  {
  if($row['UserName']==htmlspecialchars($_POST["UserName"])){
  $name=$row['UserName'];
  
  if($row['Password']==md5($_POST["Password"]))
  {
  	$sha1Pass=sha1('^¿^'.$_POST["Password"].'^¿^');
  	mysql_query("UPDATE users SET Password = '$sha1Pass' WHERE UserName = '$name'");
	$md5Pass=true;
  }
  
  if($row['Password']!=sha1('^¿^'.$_POST["Password"].'^¿^') && $md5Pass!=true)
  {
  	header("location: http://verath.se".$_POST["loc"]."?login_error=yes&reasson=sha1");
	exit;
  }
   
  $Password=sha1('^¿^'.$_POST["Password"].'^¿^');
  //$FirstName=$row["FirstName"];
  //$LastName=$row["LastName"];
  //$Email=$row["Email"];
  $LastOnline=$row["LastOnline"];
  $login=1;
  $time=date(YmdHis);
  $uv_time=date(m);
  mysql_query("UPDATE users SET LastOnline = '$time' WHERE UserName = '$name'");
  mysql_query("UPDATE users SET UserVisit = '$uv_time' WHERE UserName = '$name'");
  break;
  }
  }
  if($login){
   setcookie("logedin",md5("y-e-s"."^¿^"),time()+3600*24);
   setcookie("name",$name,time()+3600*24);
   setcookie("Password",sha1($Password),time()+3600*24);   
   //setcookie("FirstName",$FirstName,time()+3600*24);
   //setcookie("LastName",$LastName,time()+3600*24);
   //setcookie("Email",$Email,time()+3600*24);
   //setcookie("LastOnline",$LastOnline,time()+3600*24);
  }else{
  if(!empty($_POST["loc"])){
  $loc=$_POST["loc"];
  if($loc=="/index.php"){
 $loc="../";
 }
  }else{
  $loc="../";
 }
  echo '<script type="text/javascript"> self.location="' . $loc . '?login_error=yes"; </script>';
  }
  mysql_close($con);
  }
  if(!empty($_POST["loc"])){
 $loc=$_POST["loc"];
 if($loc=="/index.php"){
 $loc="../";
 }
}else{
 $loc="../";
}
   echo '<script type="text/javascript"> self.location="' . $loc . '"; </script>';
?>
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
