<?php
// Include the database connection file
include('../condb.php');

// รับข้อมูลจากคำขอ POST
$id = $_POST['id'] ?? '';
$title = $_POST['title'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';
$total_day = $_POST['total_day'] ?? '';
$now = date("Y-m-d");
$day_left = (strtotime($end_date) - strtotime($now)) / 86400;
$line_alert_day = $_POST['line_alert_day'] ?? '';
$more_detail = $_POST['more_detail'] ?? '';
$status = $_POST['status'] ?? 'off';

// Prepare and execute the SQL query for updating an existing record
$sql = "UPDATE db_items SET title = ?, start_date = ?, end_date = ?, total_day = ?, day_left = ?, day_alert = ? ,more_detail = ? , status = ?  WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssiiissi', $title, $start_date, $end_date, $total_day, $day_left, $line_alert_day, $more_detail, $status, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update record']);
}

// Close the prepared statement
$stmt->close();
// Close the database connection
$conn->close();
