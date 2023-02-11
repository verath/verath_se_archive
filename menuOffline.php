<script type="text/javascript" src="script/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#darkBackgroundLayer").css({opacity: 0.7})
	});
</script>
<!-- Meny till vänster -->
<div class='meny_container'>
<!-- LOGIN BOX -->
<div class="highZ" id="loginPrompt">
<div class="login" style="position:relative;">
<img style="z-index: 60; float:right" src="../../pics/close.png" onmouseover="this.src='../../pics/close_hover.png';" onmouseout="this.src='../../pics/close.png';" onclick="document.getElementById('darkBackgroundLayer').style.display = 'none';document.getElementById('loginPrompt').style.display = 'none';" alt="close" />
<form action="../../set_cookie.php" method="post">
<p>
<br />
<? if($_GET["login_error"]){echo '<span style="color:red;">Fel Namn eller Lösen!</span><br />';} ?>
Användarnamn:
<input name="UserName" type="text" /><br /><br />
Lösenord:<br />
<input name="Password" type="password" />
<input name="loc" type="hidden" value="<? echo $_SERVER["SCRIPT_NAME"]; ?>" />
<br /><br /><input type="submit" name="skicka" value="Logga in" /></p>
</form>
</div>
</div>
<div id="darkBackgroundLayer" class="darkenBackground"></div>
<!-- LOGIN BOX END -->
<div id="top_meny_container">
<p><a href="javascript:document.getElementById('darkBackgroundLayer').style.display = '';document.getElementById('loginPrompt').style.display = '';document.forms[0].UserName.focus();void(0);" id='lgn'><strong>Logga in</strong></a><br /><br />
<a href="/newuser">Ny användare</a></p>
</div>
<?
// Om inte loginError dölj inloggnings boxen
if(!$_GET["login_error"])
{
echo "\n<!-- Dölj LOGIN BOX -->
<script type=\"text/javascript\">
document.getElementById('darkBackgroundLayer').style.display = 'none';
document.getElementById('loginPrompt').style.display = 'none';
</script>\n";
}
?>