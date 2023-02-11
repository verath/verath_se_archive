<?php 
   // Include the include file
   require('include.php');
   
   // The layout class
   $data = array(
   'TITLE' => 'Contact'
   );
   $layout = new verathUI($data, TRUE, 'Contact')
?>
<?php
   // echo the top of the page
   echo $layout->top(FALSE);
?>
<h1 class="header">Contact us</h1>
   <form action="" method="post">
      <p>
         <label for="name">Your name:</label>
         <br />
         <input class="text" type="text" id="name" name="name" />
         <br />
         <label for="email">Your email:</label>
         <br />
         <input class="text" type="text" id="email" name="email" />
         <br />
         <label for="question">Your message:</label>
         <br />
         <textarea id="question" name="question" rows="9" cols="10" ></textarea>
         <br />
         <input type="submit" value="Submit" />
      </p>
   </form>
<?php 
   // echo the bottom of the page
   echo $layout->bottom(FALSE);
?>