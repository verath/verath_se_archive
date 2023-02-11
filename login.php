<script type="text/javascript" src="http://clouds.verath.se/move.js"></script>
<!-- Verath.se Bild -->
<div style="margin-left:230px; float:left; width:300px;"><a href="http://verath.se"><img title="Home" src="http://verath.se/pics/verathTop.png" style="border:none;" alt="Home" /></a>
</div>
<div>
<br style="clear:both"  />
<br style="clear:both" />
</div>

<div style="float:right;position:absolute;left:700px;top: 85px;">
<span style="color:white;">Googla på Verath.se</span><br />

<form action="http://www.google.com/cse" id="cse-search-box">
  <div>
    <input type="hidden" name="cx" value="partner-pub-9630536624744540:y5dj14-gnre" />
    <input type="hidden" name="ie" value="ISO-8859-1" />
    <input type="text" name="q" size="31" />
    <input type="submit" name="sa" value="S&#246;k" />
  </div>
</form>
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=sv"></script>
</div>

<?php
// Variabler
$CookieMatch=false;

// Om personen har cookien "name" (offtast innebär det att personen är inloggad)
if($_COOKIE["name"])
{

    // Inkluderar "öppna databasanslutnings filen"
    include ('dbconnect.php');

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
	
	include('menuOnline.php');

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
else
{
    include('menuOffline.php');
}
?>