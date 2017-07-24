<?php
$access_token = '5TF8YwajpAxv97xxHptnLVb1sn207x3vSVpyar87nZ1C5NLMI0E1XYb7saPCLLOh7qzRVE4s6PM14kQNvd4xHQTJpkjYIyFccnydz358PaChN4rgMJ5CCMmfG2NwBe1LtEomwWW/IXgPNvom+0y1cAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;