<?php 
   // Include the include file
   require('include.php');
   
   // The layout class
   $data = array(
   'TITLE' => 'Forum'
   );
   $layout = new verathUI($data, TRUE, 'Forum')
?>
<?php
   // echo the top of the page
   echo $layout->top(FALSE);
?>

<script type="text/javascript">
   $(document).ready(function() 
   {
      // hide the newTopic
      $("#newTopic").hide();
      
      // When the shownewTopic button is clicked
      // show the form
      $("#showNewTopic").click(function(){
         $(this).hide();
         $("#forumPostsContainer").hide(800, function(){
            $("#newTopic").show(400);
         });
      });
      
      // When the hidenewTopic button is clicked
      // hide the form
      $("#hideNewTopic").click(function(){
         $("#newTopic").hide(400, function(){
            $("#forumPostsContainer").show(800);
            $("#showNewTopic").show();
         });
      });
   });
</script>

<h1 class="header">Forum</h1>
<div id="forumPostsContainer">
   <div id="forumHeadLoc">You are here: Forum --> <a href="">Hack</a></div>
   <div id="forumThreads"><span style="font-size: large;">It's empty... Feel free to post a topic!</span></div>
</div>

<div id="newTopic">
   <form action="" method="post">
      <p>
         <label for="subject">Subject:</label>
         <br />
         <input class="text" type="text" id="subject" name="subject" />
         <br />
         <label for="message">Message:</label>
         <br />
         <textarea id="message" name="message" rows="9" cols="10" ></textarea>
         <br />
         <input type="submit" value="Submit" />
      </p>
   </form>
   <p><a id="hideNewTopic" href="javascript:void(0);">Cancel</a></p>
</div>

<div id="forumBottomButtons"><a id="showNewTopic" href="javascript:void(0);"><img src="images/newtopic.gif" alt="New Topic" /></a></div>
<?php 
   // echo the bottom of the page
   echo $layout->bottom(FALSE);
?>