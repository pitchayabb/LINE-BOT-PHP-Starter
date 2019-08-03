	<?php
$access_token = 'rQy/kEpoG83KSi4thyZWyJXLHehNr1N23BStJ2BkJzWBWgvYIkhFfCXYQ9swg4KqfRcDQ6zsVUn328rdLUvWT35NPBUGru6c0QdXG7BPkP2+82nZPwZq/XVY26j19OnZFJQPH2YrYLLra83icEQ8LAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		//if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			$arrHeader = array();
			$arrHeader[] = "Content-Type: application/json";
			$arrHeader[] = "Authorization: Bearer {$access_token}";
			 
			$id_in = $event['source']['userId'];
			$strUrl = "https://api.line.me/v2/bot/profile/".$id_in;
			 
			 
			$ch1 = curl_init();
			curl_setopt($ch1, CURLOPT_URL,$strUrl);
			curl_setopt($ch1, CURLOPT_HEADER, false);
			curl_setopt($ch1, CURLOPT_HTTPHEADER, $arrHeader);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
			$result1 = curl_exec($ch1);
			$result1 = json_decode($result1, true); 
				//echo "profile : ".
				$result1['displayName'];
				//echo "<br/>pictureUrl : ".
				$result1['pictureUrl'];
				//echo "<br/>statusMessage : ".
				$result1['statusMessage'];

			curl_close ($ch1);

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $event['source']['userId'].' [msg] > '.$event['message']['id'].' [pictureUrl1] > '.$result1['pictureUrl'].' [displayName] > '.$result1['displayName'].' [statusMessage] > '.$result1['statusMessage']
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		//}
	}
}
echo "OK";