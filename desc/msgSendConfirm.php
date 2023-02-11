<?php
// GET code
$code=$_GET["code"];

//Öppna databaslänk
include ('../dbconnect.php');

$result = mysql_query("SELECT * FROM users");

while($row = mysql_fetch_array($result))
{
	$name=$row["UserName"];
	
	if ($code==$row["emailCode"])
	{
		mysql_query("UPDATE users set emailConfirmed='1' WHERE UserName='$name'");
		mysql_query("UPDATE users set emailCode='' WHERE UserName='$name' ");
		echo "<html><body><script type=\"text/javascript\">alert(\"Din email är nu konfirmerad\");</script></body></html>";
		exit;
	}
}

// stäng databaslänk
mysql_close($con);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Konfirmera din email</title>
</head>

<body>
</body>
</html>
