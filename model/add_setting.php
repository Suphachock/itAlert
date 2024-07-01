<?php
// เชื่อมต่อกับฐานข้อมูล
include('../condb.php');

// รับข้อมูลจากคำขอ POST
$token = $_POST['token'] ?? '';

// ตรวจสอบว่ามี token อยู่ในฐานข้อมูลแล้วหรือไม่
$sql_check = "SELECT COUNT(*) FROM db_token";
$result = $conn->query($sql_check);
$row = $result->fetch_row();

// ถ้ามีแถวอยู่ในฐานข้อมูลแล้ว ให้ทำการอัปเดต
if ($row[0] > 0) {
    $sql_update = "UPDATE db_token SET token = ? WHERE id = (SELECT id FROM db_token LIMIT 1)";
    $stmt = $conn->prepare($sql_update);
} else {
    // ถ้าไม่มีแถวในฐานข้อมูล ให้ทำการแทรกข้อมูลใหม่
    $sql_insert = "INSERT INTO db_token (token) VALUES (?)";
    $stmt = $conn->prepare($sql_insert);
}

// ผูกค่าพารามิเตอร์กับคำสั่ง SQL
$stmt->bind_param('s', $token);

// ดำเนินการคำสั่ง SQL
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'error']);
}

// ปิดคำสั่งที่เตรียมไว้
$stmt->close();

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
