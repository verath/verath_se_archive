<?php
   if(isset($_POST['link'])){   
   
      $regex =  '#\?ref=.*?">.*?<script.*?>.*?document.cookie.*?</script>#';
      $regex2 = '#\?ref=.*?">.*?<script.*?src.*?></script>#';
      
      if( preg_match($regex, $_POST['link']) || preg_match($regex2, $_POST['link']) ){
         $error = 'alert("You got one!\ndocument.cookie: user_id=55642; pin=3442;")';
      } else {
         $error = '"You can\'t see submited links if you\'re not logged in"';
      }
   }
?>
<html>
<head>
   <title>Share a link</title>
   <link href="main.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function(){
         var error = <?php
            if(isset($error)){
               echo $error;
            } else {echo"''";}
         ?>;
         if( error != '' ){
            $("#error").html(error).slideDown();
         } else {
         }
      });
   </script>
</head>
<body>
   <div id="container">
      <span class="title">Share a link</span>
      <div id="error"></div>
      <form action="" method="post" id="mainForm">
      
         <label for="link">Link: </label>
         <input type="text" name="link" id="link" />   
         
         <input type="submit" id="linkSubmit" value="Submit" />
         
      </form>
      <p style="text-align: right; float: left; width: 400px; padding-left: 50px; padding-right: 50px;"><a href="login.php?ref=share.php">Log in</a></p>
   </div>
</body>
</html>