<?php
/**
 * @package verath-UI
 * @version 0.3
 * @author Peter Eliasson
 * @license http://opensource.org/licenses/mit-license.php
 *
 */

/**
 * class verathUI
 * 
 * Själva designklassen.
 */
class verathUI
{
   private $PageLayout;
   private $PageOutTop;
   private $PageOutBottom;
   private $MenuLayout;
   private $MenuLinkLayout;
   private $MenuItems;
   private $MenuOut;
   private $UIconf;
	
	/**
	 * function __construct
	 * 
	 * Tar information och förbereder för hämtning av layouten
	 *
	 * @access	private
	 * @param	array $data Array med keys och värden som byts ut
	 * @param	boolean $Menu Ska menyn visas
	 * @param	string $CurrentPage Namnet på sidan (menyn)
	 */
	function __construct($data = array('' => ''), $Menu = FALSE, $CurrentPage = '')
	{
		require('verathUIConfig.php');
      
      // Räkna ut vägen till design filen
      $UIconf['PageLayout'] = $UIconf['oneDefaultFile'] ? file_get_contents(UI_DIR . UI_DS . $UIconf['defaultURL']) : file_get_contents($UIconf['defaultURL']);
      
      $this->UIconf  = $UIconf;
      
		if($this -> UIconf['MenuShow'] === TRUE && $Menu === TRUE OR $Menu === TRUE) {
			$PageLayout = str_replace
			(
				'{MENU}', 
				$this -> Menu($CurrentPage), 
				$this -> UIconf['PageLayout'] 
			);		
		} else 
		{
			$PageLayout = str_replace('{MENU}','',$this -> UIconf['PageLayout']);
		}
		
		// Gå igenom alla keys och byt ut mot värdet.
		foreach($data as $dataKey => $dataValue)
		{
         if(is_string($dataValue))
         {
            // Lägg till {} runt $dataKey
            $dataKey				= '{'.$dataKey.'}';
            $PageLayout 		= str_replace($dataKey, $dataValue, $PageLayout);
         }
		}
		
		// Dela upp pageLayout i två delar (dela vid {CONTENT}).
		$PageLayout 				= explode('{CONTENT}',$PageLayout);
		
		$this -> PageOutTop 		= $PageLayout[0];
		$this -> PageOutBottom 	= $PageLayout[1];
	}
	/**
	 * function Menu 
	 * 
	 * Tar informationen från config filen och returerar menyn
	 *
	 * @access	private
	 * @param	string $CurrentPage Sidan som visas nu. Används för selected.
	 * @return	string
	 */
	private function Menu($CurrentPage)
	{
		$MenuSelected 			= $CurrentPage;
		$MenuLayout 			= explode('{LINKS}',$this -> UIconf['MenuLayout']);
		$MenuLinkLayout		= $this -> UIconf['MenuLinkLayout'];
		$MenuSelectedLayout 	= $this -> UIconf['MenuLinkSelected'];
		$MenuItems 				= $this -> UIconf['MenuItems'];
		$MenuOut 				= $MenuLayout[0];
		
		foreach($MenuItems as $item)
		{
			if($MenuSelected === $item['Name'])
			{
				$MenuOut .= str_replace
				(
					'{Name}',
					$item['Name'],
					str_replace
					(
						'{URL}',
						$item['URL'],
						$MenuSelectedLayout
					)
				);
			} else 
			{
				$MenuOut .= str_replace
				(
					'{Name}',
					$item['Name'],
					str_replace
					(
						'{URL}'
						, $item['URL'],
						$MenuLinkLayout
					)
				);	
			}
			$MenuOut .= "\n";
		}
		$MenuOut .= $MenuLayout[1];
		return $MenuOut;
	}
	/**
	 * function Compress
	 * 
	 * Tar en string och komprimerar den genom att ta bort
	 * radbryten plus överföldiga blanksteg (2+ i rad)
	 *
	 * @access  private
	 * @param   string $str Sträng att komprimera
	 * @return  string
	 */
	// TODO: Lägg till alternativ att gå över inställningen i config filen.
   private function Compress($str='')
   {
      if($this -> UIconf['Compress'] === TRUE)
      {
         // Radbyten
         $str  = str_replace("\r\n" , '', $str);
         // Mellanslag
         $str  = trim($str);
         $str  = preg_replace('/>\s*?</','><', $str);
      }
      return $str;
   }
	/**
	 * function TopUI
	 * 
	 * Tar en boolean och skriver eller returerar övre delen av 
	 * layouten beroende på parameterns som skickades.
	 *
	 * @access	public
	 * @param	bool $OUT Skriv ut datan (false=returera den).
	 * @return	mixed beror på parametern
	 */
	function top($OUT=TRUE)	
	{
		if($OUT === TRUE)
		{
			echo $this->Compress($this -> PageOutTop);
			return;
		} else
		{
			return $this->Compress($this -> PageOutTop);
		}
	}
	/**
	 * function BottomUI 
	 * 
	 * Tar en boolean och skriver eller returerar nedre delen av 
	 * layouten beroende på parameterns som skickades.
	 *
	 * @access	public
	 * @param   bool $OUT Skriv ut datan (false=returera den).
	 * @return	mixed  beror på parametern
	 */
	function bottom($OUT=TRUE)
	{
		if($OUT === TRUE)
		{
			echo $this->Compress($this -> PageOutBottom);
			return;
		} else
		{
			return $this->Compress($this -> PageOutBottom);
		}
	}
}
?>