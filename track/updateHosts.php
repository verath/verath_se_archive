<?php
   function filterByTime( $host ){
      if( $host -> time < time() - 60*5 ){
         return false;
      }
      return true;
   }
   
   $hosts = json_decode( file_get_contents('hosts.txt') );
   
   $updatedHosts = "";
   
   if( is_array($hosts) ){
      $hosts = array_filter($hosts, 'filterByTime');
      $updatedHosts = json_encode( $hosts );
   }
   
   file_put_contents( "hosts.txt", $updatedHosts );
?>