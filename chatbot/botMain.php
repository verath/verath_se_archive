<?php
session_start();
require('class_lib.php');
$msg = "NOANS";

if(!empty($_GET["msg"]))
{
   $msg=$_GET["msg"];
}

$reply = new reply($msg);
$botReply = $reply->getReply();
echo "<span class=\"bot\">Verath:</span> ".$botReply."<br />";
?>