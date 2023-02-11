<?php 
   // Include the include file
   require('include.php');
   
   // The layout class
   $data = array(
   'TITLE' => 'Home'
   );
   $layout = new verathUI($data, TRUE, 'Home')
?>
<?php
   // echo the top of the page
   echo $layout->top(FALSE);
?>
<h1 class="header">Home</h1>
<div id="news">
	<h3 class="newsHeader">News</h3>
	<ul>
		<li><span class="newsDate"><img src="images/may17.gif" alt="may 17" /></span><span class="text">We have a new member in the crew, say hi to Chris!</span></li>
		<li><span class="newsDate"><img src="images/may13.gif" alt="may 13" /></span><span class="text">Our forum is up running again! Ask your questions there</span></li>
		<li><span class="newsDate"><img src="images/april22.gif" alt="april 22" /></span><span class="text">Our forum is offline after an attack, we find this very serious and will take a 
		close look at what has happened</span></li>
		<li><span class="newsDate"><img src="images/march22.gif" alt="march 22" /></span><span class="text">The homepage of Hack is now online!</span></li>
	</ul>
</div>
<p>Welcome to the home of Hack.</p>
<p>We are a newly started company aiming to make the internet more secure. We are all highly educated (and well paid)
professionals in internet security, web design and database handling. We are well aware of vulnerabilities 
like XSS and Sql injections and we know how to prevent them from happening.</p>
<?php 
   // echo the bottom of the page
   echo $layout->bottom(FALSE);
?>