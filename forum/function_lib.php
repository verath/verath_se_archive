<?php
include_once 'geshi.php';

function bbcode ($string)
{
	// All the default bbcode arrays.
	$bbcode = array(
		//Text Apperence
		'#\[b\](.*?)\[/b\]#si' => '<strong>\\1</strong>',
		'#\[i\](.*?)\[/i\]#si' => '<span style="font-style:italic;">\\1</span>',
		'#\[u\](.*?)\[/u\]#si' => '<u>\\1</u>',
		//Font Color
		'#\[color=([0-9a-z\#]+)\](.*?)\[/color\]#si' => '<span style="color:\\1">\\2</span>',
		//Other
		'#\[url=(http||https)://(.*?)\](.*?)\[/url]#si' => '<a href="\\1://\\2" target="_blank">\\3</a>',
		'#\[spoiler=(.*?)\](.*?)\[/spoiler\]#si' => '<div class="spoilerContainer">Spoiler <span style="font-style:italic;">\\1</span>:<input type="button" onclick="javascript:a=this.parentNode.getElementsByClassName(\'spoiler\');a[0].style.display=\'block\';this.style.display=\'none\';void(0);" value="Visa"><span class=\'spoiler\'>\\2</span></div>',
		//'#\[img\](http||https)://(.*?)\[/img\]#si' => '<img src="\\1://\\2">',
		'#\[email\](.*?)\[/email\]#si' => '<a href="mailto:\\1">\\1</a>'
	);
	$output = preg_replace(array_keys($bbcode), array_values($bbcode), $string);	 

	// Code highlightning...
	preg_match_all('#\[code=(.*?)\](.*?)\[/code\]#si',$output, $out, PREG_PATTERN_ORDER);

	for($i=0;$i < count($out[1]); $i++) {
		$geshi = new GeSHi(html_entity_decode(str_replace("<br />","",$out[2][$i])), $out[1][$i]);
		$code = "<div class=\"codeBox\"><span class=\"codeTitle\">Kod: ". htmlentities($out[1][$i]) ."</span><div class=\"code\">". $geshi->parse_code() ."</div></div>";
		$output = preg_replace('#\[code=(.*?)\](.*?)\[/code\]#si',$code,$output,1);
	}

	return $output;
}
?>