<?php
// L�s de 3 f�rsta inl�ggen som inte �r markerade som "Deleted"
$result = mysql_query("SELECT * FROM forum_posts WHERE Deleted = '0' ORDER BY Id DESC LIMIT 0,3");
$postCount=0;

while($row = mysql_fetch_array($result))
{
	$postNewestName[]=$row['Name'];  // Namnet p� den som gjort inl�gget.
	$postNewestPostId[]=$row['TitleId'];  // Id:n p� det den ligger i.
	$postCount++;
}

// L�s alla rader i forum. ordna det nyaste f�rst.

$result = mysql_query("SELECT * FROM `forum` WHERE Type='Post' ORDER BY `Id` DESC");
$treadCount=0;

while($row = mysql_fetch_array($result))
{
	$treadNewestTitle[]=$row['Title'];  // Namn p� tr�den
	$treadNewestName[]=$row['Name'];  // Namnet p� den som gjort tr�den.
	$treadNewestId[]=$row['Id'];  // Id:n p� tr�den.
	$treadCount++;
}

// Ta reda p� titlen p� tr�den de tre inl�ggen ligger i.
for($i=0; $i < $treadCount; $i++)
{
	for($a=0; $a < $postCount; $a++)
	{
		// Om Tr�d id:n �r samma som post id:n
		if($treadNewestId[$i]==$postNewestPostId[$a])
		{
			$postNewestTitle[$a]=$treadNewestTitle[$i];
		}
		
	}
}

// ta bort alla tr�dare f�rutom de tre f�rsta.
for($i=0;$i<3;$i++)
{
	$newestTreadName[]=$treadNewestName[$i];
	$newestTreadTitle[]=$treadNewestTitle[$i];
	$newestTreadId[]=$treadNewestId[$i];
}
/*
Resulterar i:


	-Nyaste tr�darna:
	
		$newestTreadName     =  Namnet p� den som gjorde tr�den.
		$newestTreadTitle    =  Namnet p� tr�den.
		$newestTreadId       =  Id:n p� tr�den.
	
	
	-Nyaste Inl�ggen
	
		$postNewestName      =  Namnet p� den som gorde inl�gget.
		$postNewestTitle     =  Namnet p� tr�den inl�ggets gjordes i.
		$postNewestPostId    =  Id:n p� tr�den med inl�gget.
	
*/
?>