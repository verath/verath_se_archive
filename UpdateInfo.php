<?php

$name=$_COOKIE["name"];

if($name)
{
	include ('dbconnect.php');
	
	$result = mysql_query("SELECT * FROM msg ORDER BY id DESC");
	
	
	while($row = mysql_fetch_array($result))
	{
		if($row['SentTo']==$name)
		{
			if($row['Read']!="y")
			{
				$unreadMsg=true;
				break;	
			}
		}
	}

	mysql_close($con);
}

if($unreadMsg == true)
{
	echo "yes";
}



?>