<?
// Kolla s� att det finns ett id och att
// det inneh�ller 32 tecken.
if(!isset($_GET['id'])){die;}
if(strlen($_GET['id']) != 32){die('error!');}

include ('../dbconnect.php');

// G� igenom databasen efter ett matchande id
$result = mysql_query("SELECT * FROM users");

while($row = mysql_fetch_array($result))
{
	if(md5($row['UserName'].$row["Password"]) == $_GET["id"])
	{
		$name = $row['UserName'];
		break;
	}
}

// H�mta alla meddelande fr�n databasen
$numMsg		= 0;
$msgArray	= array();
$messages 	= '';

$result 		= mysql_query("SELECT * FROM msg WHERE SentTo='$name' ORDER BY id DESC LIMIT 0,3");
while($row 	= mysql_fetch_array($result))
{
	$msgArray[] = $row;
	$numMsg++;
}

// Om man inte har n�gra meddelanden
if($numMsg==0)
{
	$messages = 'Du har inte n�gra meddelanden.';
} else 
{
	foreach($msgArray as $msg)
	{
		$messages .= '- �mne: '.$msg['Head'].' | Skickat: '.$msg['Sent'].' | Fr�n: '.$msg['SentFrom'].'<nl>';
	}
}
// H�mta information fr�n databasen om forumeposts
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

// St�ng databasanslutningen
mysql_close($con);

// Skriv ut resultatet.
// Anv�nd <nl> ist�llet f�r <br />
echo "Meddelanden: <nl>".$messages . "<nl><nl>Nyaste forum tr�darna:<nl>$forum<nl>";

?>