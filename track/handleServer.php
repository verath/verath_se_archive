<?php
   include('updateHosts.php');

   if( ! isset($_POST['port']) ){
      die("false");
   }
   
   $port = intval( $_POST['port'] ) == 0 ? 80 : intval($_POST['port']);
   $newServer = (object) array( 'ip' => $_SERVER['REMOTE_ADDR'], 'port' => $port, 'time' => time() );
   
   $serverExist = false;
   foreach( $hosts as $host ){
      if( $newServer -> ip == $host -> ip ){
         $host -> time = time();
         $host -> port = $port;
         $serverExist = true;
      }
   }
   
   if( ! $serverExist ){
      $hosts[] = $newServer;
   }
   
   $hosts = json_encode( $hosts );
   file_put_contents( "hosts.txt", $hosts );
   
   print "true";
?>