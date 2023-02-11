<?php

// Check if user is online...
// Variabler
$CookieMatch=false;

// Om personen har cookien "name" (offtast innebär det att personen är inloggad)
if($_COOKIE["name"])
{
    // Inkluderar "öppna databasanslutnings filen"
    include ('../dbconnect.php');
    // Jämmför cookies med databsen för att se om personen är inloggad
    $result = mysql_query("SELECT * FROM users");
    while($row = mysql_fetch_array($result))
    {
        if($row['UserName']==$_COOKIE["name"] && $_COOKIE["Password"]==sha1($row["Password"]))
        {
            $CookieMatch=true;
            break;
        }
    }
    // Stäng databasanslutningen
    mysql_close($con);
    // Kolla resultatet av jämmförelsen
    if($CookieMatch==false)
    {
       header("location: http://verath.se/set_cookie.php?logout=logout");
       exit; // Hoppa över all följande php kod.
    }
	 
    // Uppdatera OnlineTabellen med ajax och Updatera Info
	echo "
	<!-- UpdateOnline script -->
	<script type=\"text/javascript\" src=\"http://verath.se/script/UpdateOnline.js\"></script>
	<script type=\"text/javascript\">
	UpdateOnline()
	</script>
	<!-- End UpdateOnline -->\n";
	echo "
	<!-- UpdateInfo script -->
	<script type=\"text/javascript\" src=\"http://verath.se/script/UpdateInfo.js\"></script>
	<script type=\"text/javascript\">
	setTimeout(\"UpdateInfo()\",30000);
	</script>
	<!-- End UpdateInfo -->\n";
}

$taga=array();
include ('../dbconnect.php');

  $p=0;
  $result = mysql_query("SELECT * FROM forum_posts WHERE Deleted = '0' ORDER BY Id DESC LIMIT 0,5");
  while($row = mysql_fetch_array($result))
  {
  $NewestFPName[$p]=$row['Name'];
  $NewestFPId[$p]=$row['TitleId'];
  $temp = explode(" ",$row['Time']);
  $NewestFPTime[$p] = $temp[0];
  $p++;
  }

$q=0;
$result = mysql_query("SELECT * FROM forum WHERE Type='Post' ORDER BY Id DESC");
  while($row = mysql_fetch_array($result))
  {
  $Newestpost[$q]=$row['Title'];
  $Newestid[$q]=$row['Id'];
  for($b=0;$b<$p;$b++)
  {
  if($Newestid[$q]==$NewestFPId[$b]){
  $NewestFPTitle[$b]=$row['Title'];
  $NewestFPCategory[$b]=urldecode($row['InCategory']);
  }
  }
  $Newesttime[$q]=$row['Time'];
  $NewestPostedby[$q]=$row['Name'];
  $NewestCategory[$q]=urldecode($row['InCategory']);
  $temp = explode(" ",$row['Time']);
  $NewestTime[$q]=$temp[0];
  $q++;
  }
  
$result = mysql_query("SELECT ForumLevel FROM users WHERE UserName='$name'");
 while($row = mysql_fetch_array($result))
  {
  $Level=$row["ForumLevel"];
  }
$c=0; 
$result = mysql_query("SELECT * FROM forum WHERE InCategory='Forum' ORDER BY Id");
  while($row = mysql_fetch_array($result))
  {
  $post[$c]=$row['Title'];
  $id[$c]=$row['Id'];
  $type[$c]=$row['Type'];
  $category[$c]=$row['Category'];
  $categoryDesc[$c]="";
  $categoryDesc[$c] .= $row['CategoryDesc'];
  $time[$c]=$row['Time'];
  $Postedby[$c]=$row['Name'];
  $c++;
  }
mysql_close($con);
if($q>5){
$q=5;
}

for($a=0;$a<$q;$a++){

	$Newestpost[$a]=urldecode($Newestpost[$a]);
	$Title=$Newestpost[$a];

	if(strlen($Newestpost[$a]) > 20)
	{
		$Newestpost[$a]=substr($Newestpost[$a],0,20)."...";
		
	}

	if(strlen($NewestPostedby[$a]) > 20)
	{

		$NewestPostedby[$a]=substr($NewestPostedby[$a],0,20)."...";

	}
	$NewestThreads[]=$NewestTime[$q].": <a href=\"showPost.php?id=$Newestid[$a]\" title=\"$Title\">".$NewestCategory[$a]." -> ".$Newestpost[$a]."</a> <span class=\"catDesc\" style=\"display:none;\">- Skapad av: ".$NewestPostedby[$a]."</span>\n";

}

//$Newest.="</td>\n<td>\n<strong>Nyaste inläggen:</strong><br />";


for($a=0;$a<$p;$a++){
	$NewestFPTitle[$a]=urldecode($NewestFPTitle[$a]);

	$Title1=$NewestFPTitle[$a];

	if(strlen($NewestFPTitle[$a]) > 20)
	{
		$NewestFPTitle[$a]=substr($NewestFPTitle[$a],0,20)."...";
		
	}

	if(strlen($NewestFPName[$a]) > 13)
	{

		$NewestFPName[$a]=substr($NewestFPName[$a],0,20)."...";

	}


	$NewestPosts[]=$NewestFPTime[$a].": <a href=\"showPost.php?id=$NewestFPId[$a]\" title=\"$Title1\">".$NewestFPCategory[$a]." -> ".$NewestFPTitle[$a]."</a> <span class=\"catDesc\" style=\"display:none;\">- Sagt av: ".$NewestFPName[$a]."</span>\n";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery.js"></script>
<script type="text/javascript" src="../script/accordion.jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#accordion").accordion({header: "a.head",event: "mouseover"});
		$(".cat a").hover(function() {
			$(this).parent().find(".catDesc").toggle();
		}, function() {
			$(this).parent().find(".catDesc").toggle();
		});
	});
</script>
<title>Forum | | Index</title>
</head>
<body>
<!-- content START -->
	<div class="pageContainer">
		<div class="forumAd">
			<script type="text/javascript"><!--
				google_ad_client = "pub-9630536624744540";
				/* 160x600, skapad 2009-01-11, Index 2 */
				google_ad_slot = "2290421930";
				google_ad_width = 160;
				google_ad_height = 600;
			//-->
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
		<div class="content">
			<table class="contentContainer" cellspacing="0" cellpadding="0">
				<tr><td><img class="borderPic" src="pics/bordertop.gif" alt="top"/></td></tr>
				<tr>
					<td class="middleContent">
						<span class="titleContent"><img src="../pics/Forum_Title.png" alt="Veraths Forum (Beta)" /></span>				
						<p>
							<a href="../" style="font-size:12px; float:right">Tillbaka till Verath.se</a>
							<span style="font-size:15px;">Välkommen till forumet</span><br />Här nedan är alla katagorier listade.<br />
							 Tycker du att det fattas någon kategori i forumet? Skapa en tråd och säg vad du tycker.
						</p>
						<ul id="accordion" class="accordion">
							<li>
								<a href="#" class="head">Kategorier</a>
								<div>
									<?php
										for($a=0;$a<$c;$a++){
											echo "
											<p class=\"cat\"><a href=\"showCat.php?id=$id[$a]\">".urldecode($category[$a])."</a> <span class=\"catDesc\" style=\"display:none;\">- ".$categoryDesc[$a]."</span></p>";
										}
									?>
								</div>
							</li>
							<li>
								<a href="#" class="head">Nya Trådar</a>
								<div>
									<?php
										for($a=0;$a<$c;$a++){
											echo "
											<p class=\"cat\">".$NewestThreads[$a]."</p>";
										}
									?>
								</div>
							</li>
							<li>
								<a href="#" class="head">Nya Inlägg</a>
								<div>
									<?php
										for($a=0;$a<$c;$a++){
											echo "
											<p class=\"cat\">".$NewestPosts[$a]."</p>";
										}
									?>
								</div>
							</li>
						</ul>
						
						<?php/*<!--
						<br style="clear:both;" />
						<br />
						<div class="newestContainer">
							<table cellspacing="5" cellpadding="5" cols="2">
								<tr>
									<td>
										<strong>Nyaste trådarna:</strong>
										<?php echo $Newest; ?>
									</td>
								</tr>
							</table>
						</div>

						<?php
						  if($Level>=5){
						  echo "
						  <div class=\"forum_new_post_input\" />\n
							  <div class=\"forum_new_cat_form\" />\n
							  <p><strong>Ny kategori:</strong></p>\n
							  <form action=\"NewCat.php\" method=\"post\">\n
									<p>Namn:<br />\n
									<input type=\"text\" name=\"category\" />\n
									<input type=\"hidden\" value=\"Forum\" name=\"cat\" />\n</p>
									<p><input type=\"submit\" value=\"Lägg till\" />\n
									<input type=\"hidden\" name=\"loc\" value=\"". $_SERVER["SCRIPT_NAME"]."\" />\n</p>
							</form>\n
						</div>
						</div>
						";
						  }
						?>
						-->*/?>
				  </td>
			  </tr>
				<tr><td><img class="borderPic" src="pics/borderbtm.gif" alt ="bottom"/></td></tr>
			</table>
		</div>
	</div>
   <!-- content END -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4927306-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>

<script>
if(typeof(urchinTracker)!='function')document.write('<sc'+'ript src="'+
'http'+(document.location.protocol=='https:'?'s://ssl':'://www')+
'.google-analytics.com/urchin.js'+'"></sc'+'ript>')
</script>
<script>
try {
_uacct = 'UA-4927397-4';
urchinTracker("/2916749837/test");
} catch (err) { }
</script>

</body>
</html>