<?php
$url ="";
$target_url="http://www.google.se/search?hl=sv&q=".$_GET["q"]."&btnG=Google-sökning&meta=&aq=f&oq=";
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
	$url .= $href->getAttribute('href');
}
?>