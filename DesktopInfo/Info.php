<?
// Kolla så att det finns ett id och att
// det innehåller 32 tecken.
if(!isset($_GET['id'])){die;}
if(strlen($_GET['id']) != 32){die('error!');}

include ('../dbconnect.php');

// Gå igenom databasen efter ett matchande id
$result = mysql_query("SELECT * FROM users");

while($row = mysql_fetch_array($result))
{
	if(md5($row['UserName'].$row["Password"]) == $_GET["id"])
	{
		$name = $row['UserName'];
		break;
	}
}

// Hämta alla meddelande från databasen
$numMsg		= 0;
$msgArray	= array();
$messages 	= '';

$result 		= mysql_query("SELECT * FROM msg WHERE SentTo='$name' ORDER BY id DESC LIMIT 0,3");
while($row 	= mysql_fetch_array($result))
{
	$msgArray[] = $row;
	$numMsg++;
}

// Om man inte har några meddelanden
if($numMsg==0)
{
	$messages = 'Du har inte några meddelanden.';
} else 
{
	foreach($msgArray as $msg)
	{
		$messages .= '- Ämne: '.$msg['Head'].' | Skickat: '.$msg['Sent'].' | Från: '.$msg['SentFrom'].'<nl>';
	}
}
// Hämta information från databasen om forumeposts
$forum		= '';
include('forumInfo.php');
for($i = 0; $i < 3; $i++)
{
	$newestTread[$i]			= urldecode($newestTreadTitle[$i]). " || Sagt av: ".urldecode($newestTreadName[$i]);	
	if(strlen($newestTread[$i])>52)
	{
		$newestTread[$i]=substr($newestTread[$i],0,49)."...";
	}
	$forum .= ' - '.$newestTread[$i] . '<nl>';
}

// Stäng databasanslutningen
mysql_close($con);

// Skriv ut resultatet.
// Använd <nl> istället för <br />
echo "Meddelanden: <nl>".$messages . "<nl><nl>Nyaste forum trådarna:<nl>$forum<nl>";

?>