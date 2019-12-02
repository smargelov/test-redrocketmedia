<?php

function formatstr($str) {
	$str = trim($str);
	$str = stripslashes($str);
	$str = htmlspecialchars($str);
	return $str;
}

$search = $_POST['search'];
$search = formatstr($search);
function youtube_search($apikey, $search, $limit){
	$search =  urlencode($search);
	$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$search&type=video&maxResults=$limit&regionCode=RU&key=$apikey";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT,             "Mozilla/5.0 (Windows NT 5.1; rv:7.0.1) Gecko/20100101 Firefox/7.0.1");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,        FALSE);
	curl_setopt($ch, CURLOPT_HEADER,                false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,        true); //если выпадает ошибка на эту строку - попробуйте закомментировать её
	curl_setopt($ch, CURLOPT_URL,                   $url);
	curl_setopt($ch, CURLOPT_REFERER,               $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,        TRUE);
	$out = curl_exec($ch);
	curl_close($ch);
	return $out;
}
$limit = 5; 
$apikey = "AIzaSyCl1-pOpbV8KeLkCxi8Ouh6FNKprmzNSSM"; 
$res_json = youtube_search($apikey, $search, $limit) ;
$res = json_decode( $res_json );
$videos = [];


function get_one_level_array ($arr)	{
	foreach ($arr as $key => $value) {
		if (is_array($value) || is_object($value)) {
			objectToArray($value);
			get_one_level_array($value);
		}
	}
	return $arr;
}

function objectToArray($d) {
	if (is_object($d)) {
		$d = get_object_vars($d);
	}
	if (is_array($d)) {
		return array_map(__FUNCTION__, $d);
	}
	else {
		return $d;
	}
}

$result = objectToArray(get_one_level_array($res));

foreach ($result['items'] as $key => $value) {
	$video = [];
	$video['service'] = 'yt';
	$video['id'] = $value['id']['videoId'];
	$video['title'] = $value['snippet']['title'];
	array_push($videos, $video);

}
unset($value);

echo json_encode($videos);
