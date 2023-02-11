<html>
<?php
if(!empty($_POST['namn']) && !empty($_POST['pass']) && !empty($_POST['pass1']))
{
	$namn = $_POST['namn'];
	$pass = $_POST['pass'];
	$pass1 = $_POST['pass1'];

	if($pass1 == $pass)
	{
		$filnamn1 = "info/un.txt";
		$file1 = fopen($filnamn1, "a+");
		while(!feof($file1))
		{
			if(strstr(fgets($file1),$namn) != FALSE)
			{
				$exist = 1;
			}
		}
		if($exist != 1)
		{
			$file = fopen($filnamn1, "a");
			$nytext = $namn . " " . $pass . "\r\n";
			fwrite($file, $nytext);
			fclose($file);
			echo "<script type='text/javascript'> self.location='main.php?user=" . $namn . "'</script>";
		}
	}
}
?>
<body>
<form action="newuser.php" method="post">
Username:<br /><input type="text" name="namn"><br />
<?php
if($exist == 1)
{
echo "<font color='red'>Your username (" . $namn . ") does alredy exist </font>";
}
?>
<br />
Password:<br /><input type="password" name="pass"><br />
<?php
if($pass1 != $pass)
{
echo "<font color='red'>Passwords didn't match! </font>";
}
?>
<br />
Password again:<br /><input type="password" name="pass1"><br /><br />
<input type="submit" name="skicka" value="Create user!">
</form>
</body>
</html>