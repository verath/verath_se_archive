<?php header("Content-type: text/css"); ?>

<?
$background = htmlspecialchars($_GET["back"]);
$color = htmlspecialchars($_GET["color"]);
if(!$background)
{
	$background = "FFFFFF";
}

if(!$color)
{
	$color = "000000";
}
?>

.descArea {
	padding: 5px;
	background-color: #<? echo $background; ?>;
	color:#<? echo $color; ?>;
}