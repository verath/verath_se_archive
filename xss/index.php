<?php
##-----------------------------------------------
## Version:       0.54
##-----------------------------------------------
## Latest Change:	27 MAR 2009
##-----------------------------------------------
## Made By:	      Verath, DaMage
##-----------------------------------------------
## Filters:
##    - All known on...="" 							
##    - javascript: and vbscript:					
##    - script tags 										
##    - src=	
##    - base64 keyword									
##    - Frames and Iframes
##    - < ?xml						
##----------------------------------------------
## Known XSS:
##    - ononclick=""click=alert('HelloWorld');
##    - style="expression(alert('HelloWorld');"
##    - jav&#97;script:
##    - &#106;&#97;&#118;&#97;&#115;&#99;&#114;&#105;&#112;&#116;:alert("HelloWorld");
##----------------------------------------------
// The password you get when completing the level
$password   = 'TheSecretPassword';

$success    = FALSE;

// Chek if the user has submited the form
if ( isset($_POST['submit']) )
{
   // Get the message
   $msgRaw		= stripslashes($_POST['msg']);

   // XSS filter RegExp
   $xssFilter	= '(onabort\s*=\s*("|\')?.*?("|\')?|onblur\s*=\s*("|\')?.*?("|\')?|onchange\s*=\s*("|\')?.*?("|\')?|onclick\s*=\s*("|\')?.*?("|\')?|ondblclick\s*=\s*("|\')?.*?("|\')?|onerror\s*=\s*("|\')?.*?("|\')?|onfocus\s*=\s*("|\')?.*?("|\')?|onkeydown\s*=\s*("|\')?.*?("|\')?|onkeypress\s*=\s*("|\')?.*?("|\')?|onkeyup\s*=\s*("|\')?.*?("|\')?|onload\s*=\s*("|\')?.*?("|\')?|onmousedown\s*=\s*("|\')?.*?("|\')?|onmousemove\s*=\s*("|\')?.*?("|\')?|onmouseout\s*=\s*("|\')?.*?("|\')?|onmouseover\s*=\s*("|\')?.*?("|\')?|onmouseup\s*=\s*("|\')?.*?("|\')?|onreset\s*=\s*("|\')?.*?("|\')?|onresize\s*=\s*("|\')?.*?("|\')?|onselect\s*=\s*("|\')?.*?("|\')?|onsubmit\s*=\s*("|\')?.*?("|\')?|onunload\s*=\s*("|\')?.*?("|\')?|javascript:|vbscript:|base64|<\/?script.*?>|<!--.*?(-->)?|\/\*.*?\*\/|<iframe|<frame)i';

   // Run $msgRaw through the filter
   $msgNoXSS	= preg_replace($xssFilter, '', $msgRaw);
   // Remove all src=
   $msgNoXSS   = preg_replace('(src=.*?>)', ' > ', $msgNoXSS);
   // remove < ?xml
   $msgNoXSS   = preg_replace('(<\?xml)', ' < ', $msgNoXSS);

   // Try to find out if the user made it through
   // the filter or not.

   // on...="alert('HelloWorld');"
   $xssPassed = '/(onabort\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onblur\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onchange\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onclick\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|ondblclick\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onerror\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onfocus\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onkeydown\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onkeypress\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onkeyup\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onload\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onmousedown\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onmousemove\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onmouseout\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onmouseover\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onmouseup\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onreset\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onresize\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onselect\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onsubmit\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|onunload\s*=\s*("|\')?.*?alert\(\'HelloWorld\'\).*?("|\')?|';

   // javascript:alert('HelloWorld'), Expression...
   $xssPassed .= '<.*?javascript:.*?alert\(\'HelloWorld\'\).*?>|<.*?style\s*=\s*("|\')?.*?expression\(.*?alert\(\'HelloWorld\'\).*?\).*?("|\')?.*?>|<script.*?>.*?alert\(\'HelloWorld\'\).*?<\/script>';

   // Add caseinsensitivity
   $xssPassed .= ')/i';

   if ( preg_match($xssPassed, html_entity_decode($msgNoXSS)) === 1 )
   {	
      $success    = TRUE;
      // If succesfully injected XSS code, do...
   } else
   {
      $success    = FALSE;
      // Fail...
   }

} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
   <title>XSS Level</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link href="style/mainStyle.css" rel="stylesheet" type="text/css" />
   <script src="scripts/jquery.js" type="text/javascript"></script>
   <script type="text/javascript">
   // Jquery code to make the help slide up and down
   $(document).ready(function() 
   {
      $("#helpText").toggle();
      
      $("#toggleHelp").click(function()
      {
          $("#helpText").toggle(300);
      });
   });
   
   <?php
   // Alert the password if the user has get past the filter
      if ( $success )
      {
         print('alert("You made it!\n Password: '.$password.'")');
      }
   ?>
   </script>
</head>
<body>
   <div id="contentContainer">
      <h3 id="title">XSS Level</h3>
            <span class="helpTitle">Goal:</span><br />
            Find a way to alert the text 'HelloWorld' by using javascript. You must use <span style="color:green;">alert('HelloWorld')</span>.<br /><br />
      
      <!--------------------->
      <!-- Your message    -->
      <!--------------------->
      
      <?php ( isset($msgNoXSS) ) ? print('<p id="submitedCode">'.$msgNoXSS.'</p>' . "\n") : print("\n");?>
      
      <!--------------------->
      <!-- /Your message   -->
      <!--------------------->
      
      <form action="" method="post">
         <p>
            <textarea name="msg" cols="12" rows="5"><?php 
               if( isset($_POST['msg']) )
               {
                  echo trim(htmlspecialchars(stripslashes($_POST['msg'])));
               }
            ?></textarea>
            <br />
            <input type="submit" name="submit" value="Save" />
         </p>
      </form>
      <p id="help">
         <a href="javascript:void(0);" id="toggleHelp">[Help]</a>
         <span id="helpText"><br />
            <span class="helpTitle">Hints:</span><br />
            Look at the source code after saving some text. Try to understand how the filter works.<br />
            Search Google for different XSS methods.<br />
            Read the <a href="http://code.google.com/p/xsslevel/wiki/Tutorial">tutorial</a>.<br />
            
         </span>
      </p>
   </div>
</body>
</html>
