<?php
// Inkludera Databasanslutningn
include('dbconnect.php');

// Läs de 5 första inläggen som inte är markerade som "Deleted"
$result = mysql_query("SELECT * FROM forum_posts WHERE Deleted = '0' ORDER BY Id DESC LIMIT 0,5");
$postCount=0;

while($row = mysql_fetch_array($result))
{
	$postNewestName[]=$row['Name'];  // Namnet på den som gjort inlägget.
	$postNewestPostId[]=$row['TitleId'];  // Id:n på det den ligger i.
	$postCount++;
}

// Läs alla rader i forum. ordna det nyaste först.

$result = mysql_query("SELECT * FROM `forum` WHERE Type='Post' ORDER BY `Id` DESC");
$treadCount=0;

while($row = mysql_fetch_array($result))
{
	$treadNewestTitle[]=$row['Title'];  // Namn på tråden
	$treadNewestName[]=$row['Name'];  // Namnet på den som gjort tråden.
	$treadNewestId[]=$row['Id'];  // Id:n på tråden.
	$treadCount++;
}

// Ta reda på titlen på tråden de fem inläggen ligger i.
for($i=0; $i < $treadCount; $i++)
{
	for($a=0; $a < $postCount; $a++)
	{
		// Om Tråd id:n är samma som post id:n
		if($treadNewestId[$i]==$postNewestPostId[$a])
		{
			$postNewestTitle[$a]=$treadNewestTitle[$i];
		}
		
	}
}

// ta bort alla trådare förutom de fem första.
for($i=0;$i<5;$i++)
{
	$newestTreadName[]=$treadNewestName[$i];
	$newestTreadTitle[]=$treadNewestTitle[$i];
	$newestTreadId[]=$treadNewestId[$i];
}
/*
Resulterar i:


	-Nyaste trådarna:
	
		$newestTreadName     =  Namnet på den som gjorde tråden.
		$newestTreadTitle    =  Namnet på tråden.
		$newestTreadId       =  Id:n på tråden.
	
	
	-Nyaste Inläggen
	
		$postNewestName      =  Namnet på den som gorde inlägget.
		$postNewestTitle     =  Namnet på tråden inläggets gjordes i.
		$postNewestPostId    =  Id:n på tråden med inlägget.
	
*/
?>