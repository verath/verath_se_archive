<html>
<body bgcolor="#0b8e32">
<form action="meny.php" method="post">
Name:<br/ >
<input name="namn" type="text">
<br />Password:<br/ >
<input name="pass" type="password">
<br /><input type="submit" name="skicka" value="Sign in">
<br />
</form>
</body>
<?php
$error = $_GET["error"];
if($error == "Error")
{
echo "<p style='color:#000000; font-size:11px;'>There is a 50% that you<br>
will be signed in.<br>
Try again :P</p><br>";
}
?>
</html>
