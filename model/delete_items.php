<?php
include('../condb.php');

$id = $_POST['id'];

$sql_delete = "DELETE FROM db_items WHERE id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $id);
if ($stmt_delete->execute()) {
    echo json_encode(['status' => 'success', 'success' => 'success']); // ส่งผลลัพธ์สำเร็จเป็น JSON
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete items.']); // ส่งผลลัพธ์ข้อผิดพลาดเป็น JSON
}
$stmt_delete->close(); // ปิด statement
$conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
