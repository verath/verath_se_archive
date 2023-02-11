<?php
/**
 * @package verath-UI
 * @version 0.3
 * @author Peter Eliasson
 * @license http://opensource.org/licenses/mit-license.php
 *
 */
/*
|--------------------------------------------------------------------------
| Definera variabler ÄNDRA INTE
|--------------------------------------------------------------------------
|
| UI_DS     - Directory separator (/ eller \)
| UI_DIR    - Directory (mappen skriptet ligger i) 
|
|  define('UI_DS', DIRECTORY_SEPARATOR);
|  define('UI_DIR', dirname(__FILE__));
|
*/
define('UI_DS', DIRECTORY_SEPARATOR);
define('UI_DIR', dirname(__FILE__)); 
/*
|--------------------------------------------------------------------------
| Samma fil för hela sidan
|--------------------------------------------------------------------------
|
| Ska scriptet leta efter en default.html i foldern det körs
| i eller ska samma användas alltid:
| TRUE / FALSE
|
|  TRUE
|
*/
$UIconf['oneDefaultFile']  = TRUE;
/*
|--------------------------------------------------------------------------
| Layout av websidan
|--------------------------------------------------------------------------
|
| URL till filen du vill använda som 'mall'. Om $UIconf['oneDefaultFile'] är
| TRUE utgår url:en från mappen som det här scriptet ligger i.
| 
| I mallfilen kan du använda följande uttryck:
| {MENU}		= Platsen där menyn ska vara
| {CONTENT}	= Platsen där innehållet i filen som körs
| (tex. index.php) ska vara.
| {VarName} = Du väljer själv värde på variablen (se nedan).
|
| Du kan även skriva {NamnPåVariabel}. Det du skriver innom {} 
| måste vara samma som den variabel du skickar med när du initierar klassen.
| Avänd EJ något av ovanståede namn då dessa redan är upptagna.
|
|	default.html
|
*/
$UIconf['defaultURL'] = 'default.html';
/*
|--------------------------------------------------------------------------
| Standard för Komprimering av utdata
|--------------------------------------------------------------------------
|
| Ska det som skrivs ut komprimeras (blanksteg + radbyten tas bort):
| TRUE / FALSE
|
|	TRUE
|
*/
$UIconf['Compress'] = FALSE;
/*
|--------------------------------------------------------------------------
| Standard för visning av menyn
|--------------------------------------------------------------------------
|
| Ska menyn alltid visas som standard:
| TRUE / FALSE
|
|	TRUE
|
*/
$UIconf['MenuShow'] = TRUE;
/*
|--------------------------------------------------------------------------
| Länkar i menyn
|--------------------------------------------------------------------------
|
| Vilka länkar innehåller menyn:
|
|   array
|   (
|      array(
|         'Name'	=> 'Hem',
|         'URL'		=> 'http://example.com'
|      ),
|      array(
|         'Name'	=> 'Anchor',
|         'URL'		=> '#bottom'
|      )
|   );
|
*/
$UIconf['MenuItems'] = array
(
   array(
      'Name'   => 'Home',
      'URL'    => 'index.php'
   ),
   array(
      'Name'   => 'Contact',
      'URL'    => 'contact.php'
   ),
   array(
      'Name'   => 'Forum',
      'URL'    => 'forum.php'
   )
);
/*
|--------------------------------------------------------------------------
| Menylayout
|--------------------------------------------------------------------------
|
| Uppbyggnaden av menyn, skriv inte ut länkarna, du skriver dem längre ner.
| Istället för att skriva ut länkarna skriver du {LINKS}.
|
|	<div id="menu">
|	<ul>
|	{LINKS}
|	</ul>
|	</div>
|
*/
$UIconf['MenuLayout'] = '
<ul>
{LINKS}
</ul>';
/*
|--------------------------------------------------------------------------
| Länkarnas layout
|--------------------------------------------------------------------------
|
| Uppbyggnaden av länkarna, skriv inte ut namn och URL, skriv istället {Name}
| och {URL}. {Name} och {URL} kommer sedan att blit utbytta mot respektive
| värde i $UIconf['MenuItems'].
|
|  <li><a href="{URL}">{Name}</a></li>
|
*/
$UIconf['MenuLinkLayout'] = '<li><a href="{URL}">{Name}</a></li>';
/*
|--------------------------------------------------------------------------
| Valda länkars layout
|--------------------------------------------------------------------------
|
| Uppbyggnaden av länken som är vald ('selected'), skriv inte ut namn och URL,
| skriv istället {Name} och {URL}. {Name} och {URL} kommer sedan att blit 
| utbytta mot respektive värde i $UIconf['MenuItems'].
|
|  <li><a id="selected" href="{URL}">{Name}</a></li>
|
*/
$UIconf['MenuLinkSelected'] = '<li><a id="selected" href="{URL}">{Name}</a></li>';

?>