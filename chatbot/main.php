<?php
$Msg = array();
$Ans = array();
$botAns="";

require('QnA.php');
function InMsg($what)
{
   $sayToBot=$_GET["msg"];
   if(stristr($sayToBot,$what))
   {
      return true;
   }else
   {
      return false;
   }
}

if(!empty($_GET["msg"]))
{
   $botAns=$noAns[rand(0,sizeof($noAns)-1)];

   for($i=0; $i<sizeof($Msg); $i++)
   {
      for($i1=0; $i1<sizeof($Msg[$i]); $i1++)
      {
         if(is_array($Msg[$i][$i1]))
         {
            $isInMsg = true;

            foreach($Msg[$i][$i1] as $value)
            {
               if(InMsg($value) != true)
               {
                  $isInMsg = false;
               }
            }

            if($isInMsg)
            {
               $botAns = $Ans[$i][rand(0,sizeof($Ans[$i])-1)];
            }
         }else
         {
            $isInMsg = true;

            if(InMsg($Msg[$i][$i1]) != true)
            {
                 $isInMsg = false;
            }

            if($isInMsg)
            {
               $botAns = $Ans[$i][rand(0,sizeof($Ans[$i])-1)];
            }
         }
      }
   }
      $botAns="<a name=\"newest\"></a><span class=\"bot\">Verath:</span> ".$botAns."<br />";
}
echo $botAns;
?>