<?php
session_cache_expire(30);

session_start();

?>
<html>
<body>
<p><a href="../" target="_parent">Back to Verath.se</a></p>
<p>Hi there! <br /><u>This site is hosted by my computer and will not always be online!</u><br />
Atm there is not much to do here but i'm working on it...</P>
<br /><br />
</body>
<?php
echo "<font color='green'> This month views: " . rand(10,100) ."</font><br />";
echo "<font color='red'> Total views: " . rand(10,100) ."</font><br />" . "<br />";
echo "<font color='blue'> Users who has been here this month: " . "<br />";
?>
</html>