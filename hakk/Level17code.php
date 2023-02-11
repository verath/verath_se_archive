<?
if($_POST["submit"])
{
	$input=stripslashes($_POST["input"]);
	$token = strtok($input, " ");
	$b=0;
	while($token!==false)
	{
		$a="";
		$a=str_split($token);
		foreach($a as $value)
		{
		$arr[$b].=".".ord($value)*strlen($token);
		}
		$arr[$b].=".".strlen($token)." ";
		$b++;
		$token = strtok(" ");
	}
foreach($arr as $aval)
{
	echo "$aval"; 
}
}

?>


<html>
<body>
<form action="" method="post">
<textarea name="input" style="width:300px; height:200px;">
</textarea><br />
<input type="submit" name="submit" value="Kryptera" />
</form>
</body>
</html>