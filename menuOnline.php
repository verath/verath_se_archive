<div id="top_meny_online">
<?
// Nya meddelanden eller inte?
$msgImage="<a href=\"http://verath.se/msg\" title=\"Meddelanden\" style=\"background:none; width:auto; height:auto;\" id=\"msgLink\">
<img src=\"http://verath.se/pics/menuTop/Meddelanden.png\" style=\"height:45px; width:65px; border:none;\" alt=\"Meddelanden\" id=\"msgPic\" /></a>";
$i=0;
$unreadMsg=false;
$name=$_COOKIE["name"];
$logedin=$_COOKIE["logedin"];
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

if($unreadMsg == true)
{
$msgImage="<a href=\"http://verath.se/msg?action=read&id=0\" title=\"Nya Meddelanden\" style=\"background:none; width:auto; height:auto;\" id=\"msgLink\">
<img src=\"http://verath.se/pics/menuTop/NyaMeddelanden.png\" style=\"height:45px; width:65px; border:none;\" alt=\"Nya Meddelanden\" id=\"msgPic\" /></a>";
}
  
?>
<? echo $msgImage; ?>
<a href="http://verath.se/desc" title="Min profil" style="background:none; width:auto; height:auto;">
<img src="http://verath.se/pics/menuTop/Change.png" style="height:45px; width:65px; border:none;" alt="Min profil" />
</a>
&nbsp;&nbsp;&nbsp;
<a href="http://verath.se/set_cookie.php?logout=logout" title="Logga ut" style="background:none; width:auto; height:auto;">
<img src="http://verath.se/pics/menuTop/Logout.png" style="height:45px; width:65px; border:none;" alt="Logga ut" />
</a>
</div>
<!-- Meny till vänster -->
<div class='meny_container'>