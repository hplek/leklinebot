<?php
$access_token = 'HdFb3n2OGmwyqNijVDMdTj3S952Mo/MfWtdMC5qieGmgwweN6uBq+d6wTLV14P9A9MYU4dGgViJ00h72pBTWQFkffLasm3LStlW/bLnoiq6eeBmgq0shYh7zQuDd5WvpbAd/HYUluriGFOZXQ57+gwdB04t89/1O/w1cDnyilFU=';
$roomToken = 'U55f4811d1fec65aa0a696177be2acf93';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		$join = 0;
		if ($event['type'] == 'join'){
			$join = 1;
		}
		if ( ($event['type'] == 'message' && $event['message']['type'] == 'text' ) || $join == 1) {
			// Get text sent
			
			$question = [
				0 => [
					'keywords' => 'สี',
					'ans' => 'สีเหลือง'
				],
				1 => [
					'keywords' => 'จังหวัด',
					'ans' => 'สิงห์บุรี'
				],
				2 => [
					'keywords' => 'พก',
					'ans' => 'ช้อน'
				],
				3 => [
					'keywords' => 'ผิดแล้วช้อน',
					'ans' => 'เค้าขอโทดดด'
				],
				4 => [
					'keywords' => 'ฉายา',
					'ans' => 'เชเช่,ดอรี่,เซนต์แจน'
				],
				5 => [
					'keywords' => 'เทศกาล',
					'ans' => 'คริสต์มาส'
				],
				6 => [
					'keywords' => 'catchphrase',
					'ans' => 'ด้วยพลังแห่งเซนต์ เราจะครองโลกไปด้วยกัน เฮ้!'
				],
				7 => [
					'keywords' => 'คนสวย',
					'ans' => 'เชเช่ใช่ม้า'
				],
				8 => [
					'keywords' => 'กาก',
					'ans' => 'SO VERY กระจอก'
				],
				9 => [
					'keywords' => 'บอท',
					'ans' => 'เรื่องของบอท'
				],
				10 => [
					'keywords' => 'กิน',
					'ans' => 'เช่กินมันหมดนั่นแหละ ยกเว้นผัก'
				],
				11 => [
					'keywords' => 'ครองโลก',
					'ans' => 'เฮ้!! บอทเอาด้วย'
				],
				12 => [
					'keywords' => 'น่ารัก',
					'ans' => 'น่ารักสุดๆ ในสายตาของช้อน คือเช่คนเดียว'
				],
				13 => [
					'keywords' => 'แกลบ',
					'ans' => 'กินมาม่าสิ'
				],
				14 => [
					'keywords' => 'กลับบ้าน',
					'ans' => 'GO HOME VERY GOOD'
				],
				15 => [
					'keywords' => 'ได้ไหม',
					'ans' => 'ช้อนขอไม่ตอบได้ป่ะ'
				]
				16 => [
					'keywords' => 'ทำไม',
					'ans' => 'นี่ก็ขี้สงสัยจัง'
				]
			];
			$found = 0;
			if($join == 0){
				foreach ( $question as $row ){
					if( strpos($event['message']['text'],$row['keywords']) !== false ){
						$text = $row['ans'];
						$found = 1;
						break;
					}
				}
			}else{
				$text = "ทุกๆคนที่เข้ามาใหม่ เมื่อเข้ามาแล้วให้ทำดังนี้นะคะ \n 1.) แนะนำตัวเอง \n 2.) ประทับใจอะไรใน bnk48 \n แล้วอดใจรอซักครู่นะคะ";	
			}
			
			if($found !== 0 || $join == 1){
				//$text = 'ช้อนไม่เข้าใจ ช้อน SO VERY กระจอก';
			
				//$text = $event['message']['text'];
					// Get replyToken
				$replyToken = $event['replyToken'];
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $text
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
			}
		}
	}
	
}
echo "OK";
?>
