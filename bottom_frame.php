<div>
<br style="clear: both;" />
</div>
<div id="bottom_frame">
<?php
if($btmAd!="no")
{
   if(rand(1,2) == 1)
   {
      print('Sponsrad(e) l�nk(ar)<br />
      <script type="text/javascript"><!--
      google_ad_client = "pub-9630536624744540";
      /* L�ngst Ner 728x90 */
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
      print('Hj�lp milj�n, s�k med Growyn (Ingen annons)<br /><iframe frameborder="0" width="728" height="90" scrolling="no" src="http://se.growyn.com/search/searchbanner/?size=728x90&design=green&loc=se"></iframe>');
   }
}
?>
<div id="btn_txt">
<?php
$texts = array(
'<p>Visste du att din IP �r: '.$_SERVER["REMOTE_ADDR"].'.</p>',
'<p>Visste du att man m�ste skrika i 8 �r, 7 m�nader och 6 dagar f�r att v�rma upp en kopp med kaffe?</p>',
'<p>Visste du att Coca-Cola f�rst var t�nkt att vara medicin?</p>',
'<p>Visste du att utan f�rgmedel �r Coca-Cola gr�nt?</p>',
'<p>Visste du att en kackerlacka kan leva i nio dagar utan huvud, innan den sv�lter ihj�l?</p>',
'<p>Visste du att svampar inte �r v�xter?</p>',
'<p>Visste du att hajen aldrig slutar att producera t�nder?</p>',
'<p>Visste du att google.com �r den mest bes�kta sidan p� hela internet?</p>',
'<p>Visste du att kolibrins hj�rta sl�r 1�200 g�nger per minut?</p>',
'<p>Visste du att gr�valen hj�rta sl�r 9 g�nger per minut?</p>',
'<p>Visste du att i ett digitalur vibrerar kvartskristallen 32 768 g�nger per sekund?</p>',
'<p>Visste du att i Danmark finns det �ver 13 miljoner grisar men bara runt 5,5 miljoner m�nniskor</p>',
'<p>Visste du att en giraff springer i 57 km/h?</p>',
'<p>Visste du att en m�nniska har sex 10 m�nader i ett genomsnittliga liv?</p>',
);
$text_write=$texts[array_rand($texts,1)];
echo $text_write;
include('copyright.php');
?>
</div>