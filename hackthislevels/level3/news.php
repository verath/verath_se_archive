<?php
   $sql = false;
   if( isset($_GET['id']) ){
      $sql = preg_match( '/(\'|")/', $_GET['id'] );
   }
   
   if( $sql ){
      $error = 'DB error!';
      
      // Matches common "see where it outputs stuff" method
      $regex = '%("|\')\s*UNION\s*(all)?\s*SELECT\s*(\*|[a-z,]+)\s*FROM\s*`?users`?%i';
      if( preg_match( $regex, $_GET['id'] ) ){
         $success = true;
      }
      
   }
?>

<html>
<head>
   <title>News</title>
   <link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <div id="container">
      <span class="title">News</span>
      <?php if(!isset($_GET['id'])) : ?>
         <div class="news-title">
            <span class="news-title-arrow">»</span> <a href="?id=1">Site is live!</a>
         </div>
         <p style="text-align: right; float: left; width: 400px; padding-left: 50px; padding-right: 50px;"><a href="login.php">Log in</a></p>
      <?php elseif( $sql == false ): ?>
         <div class="news-title">
            <a href="news.php">News</a> <span class="news-title-arrow">»</span> <a href="?id=1">Site is live!</a>
         </div>
         <div class="news-content">
            My cool site is now online. If you find an errors (you probably will, I've just began learning about php and mysql) please tell me!<br />
            <span class="news-author">by Verath, 2 days ago</span>
         </div>
      <?php elseif( isset($success) ): ?>
         <script type="text/javascript">
            alert("This is what you found:\nuser_id = 4532\nname = admin\npin = 90c9ede71be8c72fcaaae7ee70ea02d4");
         </script>
      <?php else: ?>
         <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
         <script type="text/javascript">
            $(document).ready(function(){
               $("#error").slideDown();
            });
         </script>
      <div id="error"><?php echo $error; ?></div>
      <?php endif; ?>
   </div>
</body>
</html>