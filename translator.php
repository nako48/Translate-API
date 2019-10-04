<?php
// Code By NakoCode
// Thanks For Tatsumi-Crew!
header('Content-Type: application/json');
function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,$str[1]);
	return $str[0];
}
function inStr($s, $as){
	$s = strtoupper($s);
	if(!is_array($as)) $as=array($as);
	for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
		return false;
}
function translate($text) {
    $bahasa = "id|en"; //set bahasa parameter |
    $e  = explode("|", $bahasa);
	$ch = curl_init();
	$postdata = "&fromLang=" . $e[0] . "&text=$text&to=" . $e[1] . "";
	curl_setopt($ch, CURLOPT_URL, 'https://www.bing.com/ttranslatev3?isVertical=1&&IG=4277BDEB50444C99B49157B40722646F&IID=translator.5026.3');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

	$headers = array();
	$headers[] = 'Origin: https://www.bing.com';
	$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Accept: */*';
	$headers[] = 'Referer: https://www.bing.com/translator';
	$headers[] = 'Authority: www.bing.com';
	$headers[] = 'Sec-Fetch-Site: same-origin';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	$hasil = getStr($result, '"text":"','"');
	$data = array('error_code' => 0,'text' => $hasil);
	echo json_encode($data);
	exit();
}
$text = $_GET['text'];
if($text == null) {
	$data = array('error_code' => 3,'text' => 'Masukan Text');
	echo json_encode($data);
	exit();
}
translate($text);