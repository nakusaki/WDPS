<?php
$access_token = '5TF8YwajpAxv97xxHptnLVb1sn207x3vSVpyar87nZ1C5NLMI0E1XYb7saPCLLOh7qzRVE4s6PM14kQNvd4xHQTJpkjYIyFccnydz358PaChN4rgMJ5CCMmfG2NwBe1LtEomwWW/IXgPNvom+0y1cAdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');

$events = json_decode($content, true);

if (!is_null($events['events'])) {
	foreach ($events['events'] as $event) {
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			//$text = $event['message']['text'];
			$text = $event['message']['text'];
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => 'hello world'
			];
			
			$url = 'https://api.line.me/v1/oauth/verify';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			//$headers = array('Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			
			echo $result . "\r\n";
		}
	}
}

echo "Bot OK";