<?php
   $answear = "1";
   
   if( isset($_POST['ans']) && isset($_POST['startTime']) && isset($_POST['control']) ){
      if( sha1('a' . $_POST['startTime']) == $_POST['control'] && $_POST['startTime'] > time()-4  && $_POST['ans'] == $answear){
         echo 'Password: "EasyMath" <br />Your time was: '.(time()-$_POST['startTime']).' s';
      } else {
         echo 'Wrong or you were to slow! (Your time was: '.(time()-$_POST['startTime']).' s) , <a href="">Go back</a>';
      }
      die();
   }
      
      $sTime = time();
?>
<html>
   <head>
      <script>
         numbers = new Array();
         for( var i = 1; i <= 1000; i++ ) numbers.push(i);
         
         var a = function(){
            var num1 = numbers[Math.floor( Math.random() * numbers.length )];
            var num2 = numbers[Math.floor( Math.random() * numbers.length )];
            var num3 = numbers[Math.floor( Math.random() * numbers.length )];
            document.getElementById('number').value = ((12*num1+2*num2-2/(num3+2*num1*2331*num2/99)*num3*12+num2-1)-num2)*123/45,2+21-23*11*11*11*(10/3);
            document.getElementById('numbers').innerHTML = '( '+num1+' * '+num2+' / ( '+num3+' * '+num1+' * '+num2+' ) * '+num3+' + '+num2+' ) - '+num2;
            
            
            return false;
         };
         
      </script>
      <title>Level 5</title>
   </head>
   <body onload="document.getElementById('ans').focus();">
      <p>Calculate the following math problem in less than 4 seconds.</p>
      <div style="float:left; height:20px; width: 100%; margin-bottom: 10px; clear: both;" class="number" id="numbers"></div>
      <form action="" method="POST">
         <input type="text" name="ans" id="ans" /><br />
         <input type="submit" value="Send!" />
         <input type="hidden" name="startTime" value="<?php echo $sTime ?>" />
         <input type="hidden" name="control" value="<?php echo sha1('a' . $sTime);?>" />
         <input type="hidden" name="number" id="number" value="" />
      </form>
   </body>
   <script>a()</script>
</html>