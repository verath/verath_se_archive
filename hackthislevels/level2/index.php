<?php
   if( !isset($_COOKIE['user_id']) || !isset($_COOKIE['pin']) ){
      header('location: login.php?ref=index.php');
   }
   if( $_COOKIE['user_id'] == '55642' && $_COOKIE['pin'] == '3442' ){
      echo 'Password: "cookie monster"';
   }
?>