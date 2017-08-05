<?php
$access_token = 'iyx7Z0eGYPRFjBG6XHnHbnHLO4fPjAU8pFgi9ykz/HMqZJbn0zoErtfnV28qNYTf+LQYbkD96uoLfeUcum22n9zo08Y37eFnJnlEI2HxnR/+ocXxJvtsJRGhrxz8LOOqrV9tXx0TiRaAm2LPmRslzQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			$answer = $text;
			if($text == '1'){
				$answer = 'หนึ่ง';
			} elseif ($text == '2') {
				$answer = 'สอง';
			} elseif ($text == 'วาวา') {
				$answer = 'วาวา น่ารักที่สุดเลย';
			} elseif ($text == 'ทดสอบ') {
				$answer = 'ทดสอบอะไรเหรอ !';
			} elseif ($text == 'สวัสดี') {
				$answer = 'สวัสดีครับ ยินดีที่ได้รู้จักครับ';
			}

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $answer
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);

			$proxy = 'velodrome.usefixie.com:80';
			$proxyauth = 'fixie:NKAGFbRPZHYddbI';

			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

			curl_setopt($ch, CURLOPT_PROXY, $proxy);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);

			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>