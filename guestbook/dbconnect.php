<?
  $con = mysql_connect("mydb11.surftown.se","verath_db1","123verath");
  if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
    mysql_select_db("verath_db", $con);
?>