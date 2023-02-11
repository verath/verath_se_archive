<?php   
   function getQuestion()
   {
      if(!isset($_COOKIE['name']))
      {
         return FALSE;
      }
      
      require('../dbconnect.php');
      
      $sql        = 'SELECT * FROM `quiz` WHERE Okey = "1" ORDER BY RAND() LIMIT 0,1';
      $result     = mysql_query($sql);
      $row        = mysql_fetch_array($result);      
      mysql_close($con);
      
      return $row;
   }



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link href="../layout.css" rel="stylesheet" type="text/css" />
   <link href="../meny.css" rel="stylesheet" type="text/css" />
   <title>Frågesport</title>
   <script type="text/javascript" src="base64.js"></script>
</head>
<body>
<div id="sidlayout">
<?php include ('../login.php'); ?>
<div id='meny_container1'>
   <!-- LISTMENY -->
   <ul id='meny'>
      <li><a class="menu_link" href='../../../'>Hem</a></li>
      <li><a class="menu_link" href='../../../guestbook'>Gästbok</a></li>
      <li><a id="selected" href='../../../kul'><strong>Kul</strong></a></li>
      <li><a class='selected_sub' href='../../../game/spel.php'>Musspelet</a></li>
      <li><a class='selected_sub' href='../../../game/guess.php'>Gissa nummer</a></li>
      <li><a class='selected_sub' href='../../../highscore.php'>Highscore</a></li>
      <li><a class='selected_sub' href='../../../html_edit'>HTML editor</a></li>
      <li><a class='selected_sub' href='../../../quiz'><strong>Frågesport</strong></a></li>
      <li><a class='selected_sub' href='../../../hakk'>Hacking</a></li>
      <li><a class='selected_sub' href='/kul/history'>"Historia"</a></li>
      <li><a class="menu_link" href='../../../links'>Länkar</a></li>
      <li><a class="menu_link" href='../../../search'>Hitta användare</a></li>
      <li><a class="menu_link" href='../../../forum'>Forum</a></li>
   </ul>
</div>
</div>
<div id="content_container">
   <div id="content">
   <?php 
   $dbRow   =  getQuestion();
   if($dbRow):?>
   <script type="text/javascript">
      cAns  =  '<?=base64_encode($dbRow['Answer']);?>';
      tried = 0;
      function checkAns(val)
      {
         if(Base64.encode(val) == cAns)
         {
            alert('Rätt Svar!');
            document.location.href = "";
         } else
         {
            tried ++;
            if(tried == 3)
            {
               alert('Fel Svar!\nDet rätta svaret var: \''+Base64.decode(cAns)+'\'');
               document.location.href = "";
            } else
            {
               alert('Fel Svar!');
               
            }
            document.getElementById('ans').value = '';
         }
      }
   </script>
   
      <p><?=$dbRow['Name'];?>: <?=$dbRow['Question'];?></p>
         <p>Svar: <input type="text" id="ans" name="ans" onLoad="this.value=''"/></p>
         <p><input type="button" value="Svara" onclick="checkAns(document.getElementById('ans').value.toLowerCase())" /></p>
         <p><a href="">Jag vill ha en annan fråga</a> | <a href="newQuestion.php">Jag har en fråga</a></p>
   <?php endif;?>
   <?php if(!$dbRow):?>
      <p>Du måste vara inloggad...</p>
   <?php endif;?>
   </div>
</div>
<? include ('../bottom_frame.php');?>
</div>
</div>
</body>
</html>
