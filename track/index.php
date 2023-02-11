<?php

   include('updateHosts.php');
   
   if( count($hosts) > 0 ){
      $host = $hosts[array_rand($hosts)];
      
      $log = file_get_contents('log.txt');
      $log .= "\n" . date("d/m H:i") . ' - ' . $_SERVER['REMOTE_ADDR'] . ' -> ' . $host -> ip . ':' . $host -> port;
      file_put_contents( "log.txt", $log );
      
      header("location: http://". $host->ip . ":" . $host->port );
   } else {
      print "Sorry, no servers available... :(";
   }
?>