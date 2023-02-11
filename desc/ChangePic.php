<?php
 
if(!$_COOKIE["name"])
{
	header("location: http://verath.se/"); // Om man inte är inloggad
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<title>Ladda upp bild</title>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php');
// set a max file size for the html upload form
$max_file_size = 30000; // size in bytes
?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
<li><a class="menu_link" href='../../../kul'>Kul</a></li>
<li><a class="menu_link" href='../../../links'>Länkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
    
    <form id="Upload" action="UploadPic.php" enctype="multipart/form-data" method="post">
    
        <h3>
            Ladda upp ny bild.
        </h3>
        <p>Max filstorlek: 100 KB.<br />
        Rekomenderad storlek: 200 x 200 pixlar.</p> 
        <p>
            <label for="file">Bild:</label>
            <input id="file" type="file" name="file" />
        </p>
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>" />
        </p>     
        <p>
            <input id="submit" type="submit" name="submit" value="Ladda upp"  />
        </p>
    
    </form>
    
</div>
</div>
<? include ('../bottom_frame.php');?>
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