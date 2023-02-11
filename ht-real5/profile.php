<?php 
   // Include the include file
   require('include.php');
   
   // The layout class
   $data = array(
   'TITLE' => 'Edit profile'
   );
   $layout = new verathUI($data, TRUE, '')
?>
<?php
   // echo the top of the page
   echo $layout->top(FALSE);
?>
<h1 class="header">Edit profile</h1>
<form action="" method="post">
   <p>
      <label for="profile">Profile:</label>
      <br />
      <textarea id="profile" name="profile" rows="9" cols="10" ></textarea>
      <br />
      <input type="submit" value="Submit" />
   </p>
</form>
<?php 
   // echo the bottom of the page
   echo $layout->bottom(FALSE);
?>