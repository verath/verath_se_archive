<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../layout.css" rel="stylesheet" type="text/css" />
<link href="../meny.css" rel="stylesheet" type="text/css" />
<title>Fr�gesport - Ny fr�ga</title>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
<!-- LISTMENY -->
<ul id='meny'>
<li><a class="menu_link" href='../../../'>Hem</a></li>
<li><a class="menu_link" href='../../../guestbook'>G�stbok</a></li>
<li><a id="selected" href='../../../kul'><strong>Kul</strong></a></li>
<li><a class='selected_sub' href='../../../game/spel.php'>Musspelet</a></li>
<li><a class='selected_sub' href='../../../game/guess.php'>Gissa nummer</a></li>
<li><a class='selected_sub' href='../../../highscore.php'>Highscore</a></li>
<li><a class='selected_sub' href='../../../html_edit'>HTML editor</a></li>
<li><a class='selected_sub' href='../../../quiz'><strong>Fr�gesport</strong></a></li>
<li><a class='selected_sub' href='../../../hakk'>Hacking</a></li>
<li><a class='selected_sub' href='/kul/history'>"Historia"</a></li>
<li><a class="menu_link" href='../../../links'>L�nkar</a></li>
<li><a class="menu_link" href='../../../search'>Hitta anv�ndare</a></li>
<li><a class="menu_link" href='../../../forum'>Forum</a></li>
</ul>
</div>
</div>
<div id="content_container">
<div id="content">
<?php
$name==$_COOKIE["name"];
if(isset($_POST["submit"]) && $name){
if($_POST["q"]!="")
{
   if($_POST["a"]!="" && strlen($_POST["a"])<30)
   {
      $q    = $_POST["q"];
      $q    = htmlspecialchars($q);
      $a    = htmlspecialchars($_POST["a"]);
      $a    = strtolower($a);
      include ('../dbconnect.php');
      
      mysql_query("INSERT INTO quiz (Question, Answer, Name) VALUES ('$q','$a','$name')");
      mysql_close($con);
      
      echo"Tack f�r din fr�ga!<br /><a href=\"\">Jag har en till!</a><br /><a href=\"../\">Hem </a>";
      $submited=1;
   } else
   {
      //Error A
      $errorA="You didn't enter an answer or your answer is to long!";
   } 
} else
{
   $errorQ="Please enter a question!";
   //error Q
   }
}
if($submited!=1)
{ 
   if($name)
   {
   $q = $_POST['q'];
   $a = $_POST['a'];
   print "<p><a href=\"../quiz\">Tillbaka</a><br />
   Fr�gan ska g� att l�sa och svaret ska vara <strong style=\"text-decoration:
   underline\">ETT</strong> ord med inte mer �n 30 bokst�ver/siffror.</p>
   <p style=\"font-size:9px; color:#FF0000\">Ditt anv�ndarnamn ($name) kommer att sparas, s� skriv inget dumt!</p>";
   print "<form action=\"\" method=\"post\">
   <table>
   <tr><td>Fr�ga:</td><td><textarea name=\"q\" title=\"Din fr�ga h�r\" style=\"width:250px;\" rows=\"3\">$q</textarea></td><td>$errorQ</td></tr>
   <tr><td>Svar:</td><td><input type=\"text\" name=\"a\" title=\"Svaret h�r\" value=\"$a\" maxlength=\"30\" style=\"width:250px;\"></td><td>$errorA</td></tr>
   </table>
   <input type=\"submit\" value=\"Skicka\" name=\"submit\">
   </form>"; 
   } else
   {
      echo "Du m�ste logga in f�r att f� tillg�ng till den h�r funktionen!";
   }
}
?>
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