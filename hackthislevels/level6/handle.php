<?php
   $action = $_GET['action'];
   
   if($action == 'auth'){
      die(sha1(date('hi') . '12a'));
   } elseif ($action == 'auth2'){
      if( $_GET['auth'] != sha1(date('hi') . '12a') ){ die('false'); }
      die("You made it!\nPass: 'abc123'");
   }
   die('false');

?>