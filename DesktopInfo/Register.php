<?
include ('../dbconnect.php');

$result = mysql_query("SELECT * FROM users");

while($row = mysql_fetch_array($result))
{
	if($row['UserName']==htmlspecialchars($_GET["name"]) && $row['Password']==sha1("^¿^".$_GET["password"]."^¿^"))
	{
		$name = $row['UserName'];
		$password = $row['Password'];
		echo md5($name . $password);
		break;
	}
}

mysql_close($con);
?>