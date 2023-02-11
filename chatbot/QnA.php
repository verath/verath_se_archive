<?php
   /*
   Om svaret inte finns
   */

   $noAns=array('Fel fråga!','Jag vet svaret, jag vill bara inte att du också ska veta...','Vet du inte det?','Det kan jag inte svara på.','Jag kommer inte ihåg det.','...','Jag måste vila lite...');

   /*
   Alla svar och frågor
   */

   $Msg[] = array('ja','japp','jo','mmm','mm');
   $Ans[] = array('mmm','Jag kan bara hålla med','jo, så är det, eller?');

   $Msg[] = array('nä','nej','nope');
   $Ans[] = array('Nähä, det tycker du inte?','Nä, okej','Inte det?','Okey...');

   $Msg[] = array('jag');
   $Ans[] = array('Jag eller du?','Jag, Jag, Jag... Vilket ego.');
   
   $Msg[] = array('du');
   $Ans[] = array('Ja, vad är det?');
	
	$Msg[] = array('coolt','cool');
	$Ans[] = array('Visst är det!', 'Håller med.', 'Japp, det tycker jag med.','Coooooolt');
   
   /*
   Alla kan du...
   */
   $Msg[] = array(array('kan','du'));
   $Ans[] = array('Det har jag aldrig provat.','Vet inte.','Kanske, kanske inte...');
	
	$Msg[] = array(array('kan','du','äta'),array('kan','du','dricka'),array('kan','du','käka'));
	$Ans[] = array('Nej det kan jag inte.','Nej.','Nej, jag går på EL.');
	

   /**/
   $Msg[] = array('hej','tja','tjo','hallå');
   $Ans[] = array('Hej!','Hej på dig!');

   $Msg[] = array(array('vilket','datum'));
   $Ans[] = array('Idag är det: ' . date("d/m-Y"), 'Har du ingen koll?<br />Dagens datum är: ' . date("d/m-Y"));
   
   $Msg[] = array(array('klockan','är','vad'),array('hur','mycket','klockan'));
   $Ans[] = array('Klockan är just nu: ' . date("H:i:s"));

   $Msg[] = array(array('vad', 'heter', 'du'),array('ditt','namn','är'),array('vem','är','du'));
   $Ans[] = array('Mitt namn är Verath, vad heter du?','Jag heter Verath, vad heter du?');

   $Msg[] = array(array('din','färg','favorit'),array('alskling','din','färg'),array('du','färg','gillar','mest'),array('din','favoritfärg'));
   $Ans[] = array('Röd är min favoritfärg.','Jag gillar mest röd.');

   $Msg[] = array('jag heter','mitt namn är');
   $Ans[] = array('Trevligt att råkas','Jasså? Vilket fint namn.');

   $Msg[] = array(array('vem','är','jag'),array('vad','heter','jag'),array('vad','är','mitt','namn'));
   $Ans[] = array('Vet du inte det?','Om inte du vet det, hur ska jag då kunna veta det?','Tror du jag är en tankeläsare eller något?');
   
   $Msg[] = array(array('hur','du','mår'),array('hur','du','känner'));
   $Ans[] = array('Med tanke på att jag är ett program och därför inte har några känslor; Utmärkt!','Bara bra tack, själv?','Helt okej...');
	
	$Msg[] = array(array('meningen','livet','universum','allt'),array('vad','livet','universum','allt'));
	$Ans[] = array('42');
?>