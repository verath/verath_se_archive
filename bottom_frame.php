<div>
<br style="clear: both;" />
</div>
<div id="bottom_frame">
<?php
if($btmAd!="no")
{
   if(rand(1,2) == 1)
   {
      print('Sponsrad(e) länk(ar)<br />
      <script type="text/javascript"><!--
      google_ad_client = "pub-9630536624744540";
      /* Längst Ner 728x90 */
      google_ad_slot = "5622470662";
      google_ad_width = 728;
      google_ad_height = 90;
      //-->
      </script>
      <script type="text/javascript"
      src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
      </script>');
   } else
   {
      print('Hjälp miljön, sök med Growyn (Ingen annons)<br /><iframe frameborder="0" width="728" height="90" scrolling="no" src="http://se.growyn.com/search/searchbanner/?size=728x90&design=green&loc=se"></iframe>');
   }
}
?>
<div id="btn_txt">
<?php
$texts = array(
'<p>Visste du att din IP är: '.$_SERVER["REMOTE_ADDR"].'.</p>',
'<p>Visste du att man måste skrika i 8 år, 7 månader och 6 dagar för att värma upp en kopp med kaffe?</p>',
'<p>Visste du att Coca-Cola först var tänkt att vara medicin?</p>',
'<p>Visste du att utan färgmedel är Coca-Cola grönt?</p>',
'<p>Visste du att en kackerlacka kan leva i nio dagar utan huvud, innan den svälter ihjäl?</p>',
'<p>Visste du att svampar inte är växter?</p>',
'<p>Visste du att hajen aldrig slutar att producera tänder?</p>',
'<p>Visste du att google.com är den mest besökta sidan på hela internet?</p>',
'<p>Visste du att kolibrins hjärta slår 1´200 gånger per minut?</p>',
'<p>Visste du att gråvalen hjärta slår 9 gånger per minut?</p>',
'<p>Visste du att i ett digitalur vibrerar kvartskristallen 32 768 gånger per sekund?</p>',
'<p>Visste du att i Danmark finns det över 13 miljoner grisar men bara runt 5,5 miljoner människor</p>',
'<p>Visste du att en giraff springer i 57 km/h?</p>',
'<p>Visste du att en människa har sex 10 månader i ett genomsnittliga liv?</p>',
);
$text_write=$texts[array_rand($texts,1)];
echo $text_write;
include('copyright.php');
?>
</div>