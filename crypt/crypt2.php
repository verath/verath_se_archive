<?php
######################################## 
# THIS CODE IS FREE							#
# If you improved the code, send me a 	#
#	copy :) warackta@gmail.com				#
#													#
# Made by: Verath								#
# Thanks to: 									#
########################################
	session_start();
	$Error="";
	$ranCode="";
	$alphanum  = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	if (isset($_GET["submit"]))
	{  
	// If submited
		$password=$_SESSION["Code"]; // The pass
		if(md5(trim($_GET["Pass"])."...") == $password)
		{
			if(intval(time()-$_SESSION["TIME"]) < 35)
			{
				// Correct
				echo "
				<html>
					<head>
						<title>Completed!</title>
					</head>
					<body>
						<p>
							<span style=\"color:red;font-size: 20px;\">
								You made it, gz :)(it took you ".intval(time()-$_SESSION["TIME"])." seconds)
							</span>
						</p>
						<p>
							The password: 'ILikeAsciiCodes'
						</p>
					</body>
				</html>
				";
				exit;
			}else{
				$Error="Nope, too late... :)";
			}
	}else{
	// Wrong
	$Error="Nope, lol :)";
	}

	}
	// create RanNum
	$input=stripslashes(substr(str_shuffle($alphanum), 0, 9+rand(0,3)));
	$token = strtok($input, " ");
	$b=0;
	while($token!==false)
	{
		$a="";
		$arr[$b]="";
		$a=str_split($token);
		
		foreach($a as $value)
		{
			$arr[$b].=".".ord($value)*strlen($token);
		}
		
		$arr[$b].=".".strlen($token)." ";
		
		$b++;
		
		$token = strtok(" ");
		
	}
	$ranCode1="";
	foreach($arr as $aval)
	{
		$ranCode1 .= $aval; 
	}

	$ranCode = $ranCode1;
	// save it in a session
	$_SESSION["Code"] = md5($input."...");
	// save time in a session
	$_SESSION["TIME"] = time();

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="refresh" content="31">
</head>
<body>
<?php
	echo $Error; // errors
?>
<p>Try decrypting this code (The page reloads every 30 sec...)</p>
<p>Time left: <span id="timeL" style="color:red">30</span></p>
<p>
Code:<span style="color:blue;"> 
<?php
	echo $ranCode; // echo the code.
?>
</span>
</p>
<!-- 
COPYRIGHT Encoder@Verath.se. 
VISIT US: http://verath.se/hakk/Level17code.php
-->
<p>Pass:</p>
<p>
<form action="" method="get">
  <input type="password" name="Pass" autocomplete="off" id="pass" value="" />
  <input type="submit" value="send" name="submit" id="submit" />
</form>
</p>
<script language="javascript">
setTimeout("location.reload(true)",30000);
time=30;
function updateT() {
	time-=1;
	document.getElementById('timeL').innerHTML=time;
	setTimeout(updateT,1000);
}
setTimeout(updateT,1000);
</script>
</body>
</html>
