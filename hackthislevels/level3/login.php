<?php
   if(isset($_POST['user_id'])){
      $regex = '/(\'|")\s*OR\s*(\'|").*?(\'|")\s*=\s*(\'|").*?((\'|")\s*(\/\*|--))?/i';
      if( $_POST['user_id'] == '4532' && preg_match( $regex, $_POST['pin'] ) ){
         echo "Password: '1945-Aug-06 8:15 AM'";
         die();
      } elseif( strstr($_POST['pin'], "'") || strstr($_POST['pin'], "'") > 0){
         $error = 'Database error!';
         $db_error = true;
      } else {
         $error = 'No match for ID and PIN in users table.';
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
      </form>
      <p style="text-align: right; float: left; width: 400px; padding-left: 50px; padding-right: 50px;"><a href="news.php">News</a></p>
   </div>
</body>
<?php if(isset($db_error)){
   echo '<!-- DB error when sending query to `users`. The query returned null for user_id, name and pin :(. -->';
}?>
</html>