<?php
$stream_opts = [
    "ssl" => [
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ]
]; 

$content = file_get_contents('https://forum.skymusic.app/sitemap.xml');
preg_match_all('/<loc>(.*?)<\/loc>/', $content, $sitemap, PREG_PATTERN_ORDER);

$urls = array_reduce($sitemap, 'array_merge', array());

$api = 'http://data.zz.baidu.com/urls?site=https://forum.skymusic.app&token=Mdwwy5UlqXJtUpwj';
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $urls),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
echo $result;