<?php
 
$AccessToken = "5TF8YwajpAxv97xxHptnLVb1sn207x3vSVpyar87nZ1C5NLMI0E1XYb7saPCLLOh7qzRVE4s6PM14kQNvd4xHQTJpkjYIyFccnydz358PaChN4rgMJ5CCMmfG2NwBe1LtEomwWW/IXgPNvom+0y1cAdB04t89/1O/w1cDnyilFU=";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$AccessToken}";
$messager = $arrJson['events'][0]['message']['text'];

if($messager == "สวัสดี"||$messager == "hi"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "hi nice to meet u, your ID is ".$arrJson['events'][0]['source']['userId'];
}else if($messager == "ชื่ออะไร"||$messager == "name"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "my name is JUNE";
}else if($messager == "ทำอะไรได้บ้าง"||$messager == "do"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "i can fly";
}
else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  if (!is_null($arrJson['events'])) {
	  foreach ($arrJson['events'] as $event) {
	  if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
		  $text = $event['message']['text'];
		  
		  $arrPostData['messages'][0]['type'] = "text";
		  $arrPostData['messages'][0]['text'] = $text;		
		}
	  }
  }
  else{
	$arrPostData = array();
	$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
	$arrPostData['messages'][0]['type'] = "text";
	$arrPostData['messages'][0]['text'] = "i don't understand??";
  }
			
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
 
echo "hello i'm June bot";
?>