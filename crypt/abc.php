<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Crypt</title>
</head>

<body>

<?php
if(isset($_POST["input"])) {

   // The system used to encrypt the message.
   $letters = Array();
   $letters["a"] = "a";
   $letters["b"] = "aa";
   $letters["c"] = "aaa";
   $letters["d"] = "ab";
   $letters["e"] = "b";
   $letters["f"] = "ba";
   $letters["g"] = "baa";
   $letters["h"] = "baaa";
   $letters["i"] = "ac";
   $letters["j"] = "c";
   $letters["k"] = "ca";
   $letters["l"] = "caa";
   $letters["m"] = "caaa";
   $letters["n"] = "cab";
   $letters["o"] = "cb";
   $letters["p"] = "cba";
   $letters["q"] = "cbaa";
   $letters["r"] = "cbaaa";
   $letters["s"] = "cac";
   $letters["t"] = "cc";
   $letters["u"] = "cca";
   $letters["v"] = "ccaa";
   $letters["w"] = "ccaaa";
   $letters["x"] = "ccab";
   $letters["y"] = "ccb";
   $letters["z"] = "ccba";

	$text = trim($_POST["input"]);
	$text = strtolower($text);
   $text = str_split($text);
   
	$out="";
	
   foreach($text as $value)
   {
        isset($letters[$value]) ? $tempText = $letters[$value] : $tempText = $value;
        $out .= $tempText . "_";
   }
	
	$out = str_replace(" ","||",$out);
	
	echo substr($out,0,strlen($out)-1);
}
?>
<form action="" method="post">
<textarea name="input" rows="10" cols="20" style="width:10cm;height:5cm;"></textarea>
<br />
<input type="submit" value="Crypt" />
</form>
</body>

</html>