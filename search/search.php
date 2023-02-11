<?
$name=$_POST["Who"];
if(strlen($name)!=0){
$a=0;
$sendName=array();
include ('../dbconnect.php');
$query  = "SELECT * FROM users";
$result = mysql_query($query);
  while($row = mysql_fetch_array($result))
  {
  $Names[$a]=$row["UserName"];
  $a++;
  }
  $Posible=array();
  $b=0;
  for($i=0;$i<$a;$i++){
  if(strtolower($name)==strtolower(substr($Names[$i],0,strlen($name))) && $name!=$Names[$i]){
  $Posible[$b]=$Names[$i];
  $b++;
  }
  }
foreach($Posible as $val){
echo "$val <br>";
}
}
  mysql_close($con);
?>
