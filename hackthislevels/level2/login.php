<?php
   if(isset($_POST['user_id'])){
      if( $_POST['user_id'] != '55642' && $_POST['pin'] != '3442' ){
         $error = 'Wrong user ID and/or PIN!';
      } else {
         setcookie('user_id', $_POST['user_id']);
         setcookie('pin', $_POST['pin']);
         header('location: index.php');
      }
   }
?>
<html>
<head>
   <title>Login</title>
   <link href="main.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function(){
         var error = '<?php
            if(isset($error)){
               echo $error;
            }
         ?>';
         if( error != '' ){
            $("#error").html(error).slideDown();
         }
      });
   </script>
</head>
<body>
   <div id="container">
      <span class="title">Login</span>
      <div id="error"></div>
      <form action="" method="post" id="mainForm">
      
         <div class="mainFormInputElement">
            <label for="user_id">User ID: </label>
            <input type="text" name="user_id" id="user_id" />
         </div>     
         <div class="mainFormInputElement">
            <label for="pin">PIN code: </label>
            <input type="password" name="pin" id="pin" />
         </div>
         
         <input type="submit" value="Log in" />
         
         <input type="hidden" name="ref" value="<?=$_GET['ref']?>" />
         
      </form>
      <p style="text-align: right; float: left; width: 400px; padding-left: 50px; padding-right: 50px;"><a href="share.php">Share a link</a></p>
   </div>
</body>
</html>