<?php
   if( isset($_POST['ans']) && isset($_POST['startTime']) && isset($_POST['control']) ){
      if( sha1('a' . $_POST['ans'] . $_POST['startTime']) == $_POST['control'] && $_POST['startTime'] > time()-7 ){
         echo 'Password: "2983" <br />Your time was: '.(time()-$_POST['startTime']).' s';
      } else {
         echo 'Wrong or you were to slow! (Your time was: '.(time()-$_POST['startTime']).' s) , <a href="">Go back</a>';
      }
      die();
   }
      
      $number = rand(0, 2000000);
      $hashNumber = md5($number);
      $answear = $number;
      $sTime = time();
?>
<html>
   <head>
      <title>Level 4</title>
   </head>
   <body onload="document.getElementById('ans').focus();">
      <p>The following md5 hash is a number between 0 and 2´000´000. Find it in less than 7 seconds!</p>
      <span class="number"><?php echo $hashNumber ?></span>
      <form action="" method="POST">
         <input type="text" name="ans" id="ans" /><br />
         <input type="submit" value="Send!" />
         <input type="hidden" name="startTime" value="<?php echo $sTime ?>" />
         <input type="hidden" name="control" value="<?php echo sha1('a' . $answear . $sTime);?>" />
      </form>
   </body>
</html>