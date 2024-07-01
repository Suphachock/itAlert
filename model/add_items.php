<?php
// เชื่อมต่อกับฐานข้อมูล
include('../condb.php');

// รับข้อมูลจากคำขอ POST
$title = $_POST['title'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';
$total_day = $_POST['total_day'] ?? '';

$day_left = (strtotime($end_date) - strtotime(date("Y-m-d"))) / 86400;

$line_alert_day = $_POST['line_alert_day'] ?? '';
$more_detail = $_POST['more_detail'] ?? '';
$status = $_POST['status'] ?? 'off';

// สร้างคำสั่ง SQL สำหรับการแทรกข้อมูล
$sql = "INSERT INTO db_items (title, start_date, end_date, total_day,day_left, day_alert, more_detail,status) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
$stmt = $conn->prepare($sql);

// ผูกค่าพารามิเตอร์กับคำสั่ง SQL
$stmt->bind_param('sssiiiss', $title, $start_date, $end_date, $total_day, $day_left, $line_alert_day, $more_detail, $status);

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
