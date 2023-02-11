<?php
   if( isset($_POST['ans']) && isset($_POST['startTime']) && isset($_POST['control']) ){
      if( sha1('a' . $_POST['ans'] . $_POST['startTime']) == $_POST['control'] && $_POST['startTime'] > time()-6 ){
         echo 'Password: "IHasMathSkillz" <br />Your time was: '.(time()-$_POST['startTime']).' s';
      } else {
         echo 'Wrong or you were to slow! (Your time was: '.(time()-$_POST['startTime']).' s) , <a href="">Go back</a>';
      }
      die();
   }
      
      $randomNumbers = array( rand(10000, 200000), rand(10000, 200000), rand(10000, 200000) );
      $solveString = '
      <div class="solveThis">
         <span class="1">' . $randomNumbers[0] . '</span>
         +
         <span class="2">' . $randomNumbers[1] . '</span>' . '
         *
         <span class="3">' . $randomNumbers[2] . '</span> 
      </div>';
      
      $answear = $randomNumbers[0] + $randomNumbers[1] * $randomNumbers[2];
      $sTime = time();
?>
<html>
   <head>
      <title>Level 1</title>
   </head>
   <body onload="document.getElementById('ans').focus();">
      <p>Solve the math problem in less then 5 seconds!</p>
      <?php echo $solveString ?>
      <form action="" method="POST">
         = <input type="text" name="ans" id="ans"><br />
         <input type="submit" value="Send!">
         <input type="hidden" name="startTime" value="<?php echo $sTime ?>" />
         <input type="hidden" name="control" value="<?php echo sha1('a' . $answear . $sTime);?>" />
      </form>
   </body>
</html>