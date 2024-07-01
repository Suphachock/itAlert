<?php
$token = $_POST['token'];
// กำหนด URL และ Token สำหรับการแจ้งเตือนผ่าน LINE Notify
$url = 'https://notify-api.line.me/api/notify';
$headers = [
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer ' . $token
];
// กำหนดข้อความที่จะแจ้งเตือน
$message = "\n⚠️ทดสอบแจ้งเตือนอุปกรณ์หมดอายุ!";
$fields = 'message=' . urlencode($message);

// เริ่มต้นการส่งข้อมูลด้วย cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

// ส่งผลการแจ้งเตือนกลับไปยัง AJAX
echo json_encode(['result' => $result]);
