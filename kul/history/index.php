<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript">
function hideImg()
{
	document.getElementById('HighZImgContainer').style.display='none';
	document.getElementById('darkBackgroundLayer').style.display='none';
}

function showImg(imgId)
{
	document.getElementById('HighZImgContainer').style.display='';
	document.getElementById('darkBackgroundLayer').style.display='';
	document.getElementById('bigImg').src = document.getElementById(imgId).src;
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../layout.css" rel="stylesheet" type="text/css" />
<link href="../../meny.css" rel="stylesheet" type="text/css" />
<title>Verath.se:s bildhistoria</title>
<link href="history.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="sidlayout">
<?php include ('../../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
<li><a id="selected" href='../../../kul'><strong>Kul</strong></a></li>
<li><a class='selected_sub' href='../../../game/spel.php'>Musspelet</a></li>
<li><a class='selected_sub' href='../../../game/guess.php'>Gissa nummer</a></li>
<li><a class='selected_sub' href='../../../highscore.php'>Highscore</a></li>
<li><a class='selected_sub' href='../../../html_edit'>HTML editor</a></li>
<li><a class='selected_sub' href='../../../quiz'>Frågesport</a></li>
<li><a class='selected_sub' href='../../../hakk'>Hacking</a></li>
<li><a class='selected_sub' href='/kul/history'><strong>"Historia"</strong></a></li>
<li><a class="menu_link" href='../../../links'>Länkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>


<div class="HighZImgContainer" id="HighZImgContainer" style="display:none;">
<a href="javascript:void(0);" onclick="hideImg()">
<img id="bigImg" src="" style="height: 700px;width: 1120px; border:none" alt="BigImage" title="Klicka för att stänga" />
</a>
</div>

<div id="darkBackgroundLayer" class="darkenBackground" style="display:none;"></div>
<div id="content_container">
<div id="content">
<h2>Verath.se:s bildhistoria</h2>
<p>Som titlen antyder så kommer det finns verath.se:s "historia" här i bilder. Har du någon bild, skicka ett meddelande till mig.</p>
<table cellspacing="4" cellpadding="2">
<tr>
<td>
<a href="javascript:void(0);" onclick="showImg('0')">
<img id="0" style="width:200px; height:200px; border:none;" src="../../pics/history/awardspace.com-index.png" alt="awardspace.com-index" title="Klicka för en större bild" />
</a>
</td>
<td>
<a href="javascript:void(0);" onclick="showImg('1')">
<img id="1" style="width:200px; height:200px; border:none;" src="../../pics/history/awardspace.Guestbook.png" alt="awardspace.Guestbook" title="Klicka för en större bild" />
</a>
</td>
<td>
<a href="javascript:void(0);" onclick="showImg('2')">
<img id="2" style="width:200px; height:200px; border:none;" src="../../pics/history/verath.se.2008-08-03.png" alt="verath.se.2008-08-03" title="Klicka för en större bild" />
</a>
</td>
</tr>

<tr>
<td>
<a href="javascript:void(0);" onclick="showImg('3')">
<img id="3" style="width:200px; height:200px; border:none;" src="../../pics/history/verath.se.2008-08-17.Forum.png" alt="verath.se.2008-08-17" title="Klicka för en större bild" />
</a>
</td>
<td>
<a href="javascript:void(0);" onclick="showImg('4')">
<img id="4" style="width:200px; height:200px; border:none;" src="../../pics/history/verath.se.Guestbook.2008-08.png" alt="Guestbook.2008-08" title="Klicka för en större bild" />
</a>
</td>
<td>
<a href="javascript:void(0);" onclick="showImg('5')">
<img id="5" style="width:200px; height:200px; border:none;" src="../../pics/history/verath.se.2008-09-04.png" alt="2008-09-04" title="Klicka för en större bild" />
</a>
</td>
</tr>

</table> 
<p>Klicka på bilderna för att visa en större version.</p>
</div>
</div>
<? include ('../../bottom_frame.php');?>
</div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4927306-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</body>
</html>