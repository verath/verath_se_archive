<html>
<?php
if(rand(1,2)==1)
{
echo "<script type='text/javascript'> parent.main.location='main.php' </script>";
}
else
{
echo "<script type='text/javascript'> self.location='login.php?error=Error' </script>";
}
?>
<body>
<b><u><p>Menu!</p></u></b>
<br />
<a href="login.php">Sign out</a>
</body>
</html>