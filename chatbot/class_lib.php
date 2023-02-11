<?php
class mysql {

   private $mysqlHost;
   private $mysqlUser;
   private $mysqlPass;
   private $mysqlDBName;
   private $con;

   function __construct() {
      $this->mysqlHost   = "mydb11.surftown.se";  // mydb11.surftown.se , localhost
      $this->mysqlUser   = "verath_db1";
      $this->mysqlPass   = "123verath";
      $this->mysqlDBName = "verath_db";
   }

   public function setCon($host,$user,$pass,$DB)
   {
      $this->mysqlHost = $host;
      $this->mysqlUser = $user;
      $this->mysqlPass = $pass;
      $this->mysqlDBName = $DB;
   }

   public function connect() {
      $this->con = mysql_connect($this->mysqlHost,$this->mysqlUser,$this->mysqlPass) or die(mysql_error());
      mysql_select_db($this->mysqlDBName) or die(mysql_error());
   }

   public function close() {
      mysql_close($this->con) or die(mysql_error());
   }

   public function select($table)  {

      if(!$this->con) {
         $this->connect();
      }
      $sql = "SELECT * FROM `".$table."`";
      $result = mysql_query($sql);
      return $result;

   }

   public function fetchArray($results,$sortBy="Id") {
         $fetchResults = array();
         while($row = mysql_fetch_array($results))
         {
            $keys = array_keys($row);
            foreach($keys as $value)
            {
               $fetchResults[$row[$sortBy]][$value]=$row[$value];
            }
         }
         return $fetchResults;
   }
}


class reply {

   private $userInput;
   private $botAnswear;
   private $userInputArray;
   private $numMatches;
   public  $cmd;

   private function tokString($string,$token=" ") {
      $tok = strtok($string,$token);
      while($tok !== false) {
         $tokArray[]=$tok;
         $tok = strtok($token);
      }
      return $tokArray;
   }

   function __construct($msg) {
      $this->userInput = utf8_decode($msg);
      $this->userInputArray = $this->tokString($this->userInput);
   }

   private function googleIt() {
      /*Return search results from google*/
		$searchFor="";
      $searchForTemp=explode(" ",$this->userInput);
      $searchForArr=explode(" ",str_replace($searchForTemp[0]." ","",$this->userInput));
		foreach($searchForArr as $search) {
			$searchFor.=" ".$search;
		}
      $ret="Resultat ('".trim($searchFor)."'):<br />";
		$searchFor=urlencode(trim($searchFor));
		$target_url="http://www.google.se/search?hl=sv&q=".$searchFor."&btnG=Google-sökning&meta=&aq=f&oq=";
		$userAgent="Firefox (WindowsXP) - Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_URL,$target_url);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$html = curl_exec($ch);
		if (!$html) {
			echo "<br />cURL error number:" .curl_errno($ch);
			echo "<br />cURL error:" . curl_error($ch);
			exit;
		}
		
		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		
		$xpath = new DOMXPath($dom);
		$hrefs = $xpath->evaluate("/html/body/div/div/ol/li/h3//a");
		
		for ($i = 0; $i < 3; $i++) { // $hrefs->length;
			$href = $hrefs->item($i);
			$Url = $href->getAttribute('href');
			$ret.="<a href=\"$Url\">";
			if(strlen($Url)>=32) {
				$ret.=substr($Url,0,32)."..."."</a><br />";
			} else {
				$ret.=$Url."</a><br />";
			}
		}
      return $ret;
   }

   private function cmdCheck($string) {
      if(substr($string,0,5)=="-cmd-") {
         eval(html_entity_decode(str_replace("-cmd-","",$string)));
      }
      return $string;
   }

   private function QuestionCheck()
   {
      if(isset($_SESSION["Question"])) {
         return true;
      }

   }

   private function newQuestionCheck ($string,$mysqlData,$keyWithMostMatches) {
      if(substr($string,strlen($string)-1,1)=="?")
      {
         $_SESSION["Question"]=utf8_encode($mysqlData[$keyWithMostMatches]["QuestionVariable"]);
      } else {
         return false;
      }

   }

   public function getReply() {
      $mysqlCon=new mysql();
      $mysqlCon->connect();
      $result = $mysqlCon->select("chatbotans");
      $mysqlData = $mysqlCon->fetchArray($result,"Question");
      $mysqlCon->close();

      if($this->QuestionCheck()) {
         /*$mysqlCon->connect();
         $question = utf8_decode($_SESSION["Question"]);
         $answear = mysql_real_escape_string($this->userInput);
         $ip = $_SERVER["REMOTE_ADDR"];

         //mysql_query("INSERT INTO chatbotmemory (Question,Answear,Ip) VALUES('$question','$answear','$ip')")or die(mysql_error());
         $mysqlCon->close();
          */
         unset($_SESSION["Question"]);
			$questionAns=array("Okej.","Nu vet jag det.","Jasså.");
			
         return utf8_encode($questionAns[array_rand($questionAns)]);
      } else {
         $dbInputs = array_keys($mysqlData);
         foreach($dbInputs as $value) {
            $dbInputsSplited = $this->tokString($value);
            foreach($dbInputsSplited as $dbValue) {
               foreach($this->userInputArray as $val) {
                  if(strtolower($dbValue)==strtolower($val)) {
                     // Add one to num matches for the current array key.
                     if(empty($this->numMatches[$value])) {
                        $this->numMatches[$value]=1;
                     } else {
                        $this->numMatches[$value]++;
                     }
                  }
               }
            }
         }
         if(is_array($this->numMatches)) {
            arsort($this->numMatches);
            $numMacthesKeys = array_keys($this->numMatches);
            $keyWithMostMatches=$numMacthesKeys[0];

            $botAnsArray=$this->tokString($mysqlData[$keyWithMostMatches]["Reply"],"||");
            $botAns=$botAnsArray[rand(0,count($botAnsArray)-1)];
            $this->newQuestionCheck($botAns,$mysqlData,$keyWithMostMatches);
            $botAns=$this->cmdCheck($botAns);
            return utf8_encode($botAns);
         } else {
				if($this->userInput!="NOANS")
				{
					$mysqlCon->connect();
					$question = mysql_real_escape_string($this->userInput);
					mysql_query("INSERT INTO chatbotmemory (Question) VALUES('$question')")or die(mysql_error());
					$mysqlCon->close();
					return utf8_encode("Jag har tyvärr inget svar på den frågan...");
				}
         }
      }
   }

}



?>