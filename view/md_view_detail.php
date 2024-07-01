<?php
include_once "../condb.php";

// Prepare statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM db_items WHERE id = ?");
$stmt->bind_param("i", $_POST['id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<div class="modal" tabindex="-1" id="md_view_items">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียดข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label class="col-3 col-form-label">รายละเอียด</label>
                    <div class="col">
                        <p class="form-control-plaintext"><?= htmlspecialchars($row['title']) ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-3 col-form-label">วันที่เริ่มใช้</label>
                    <div class="col">
                        <p class="form-control-plaintext"><?= htmlspecialchars($row['start_date']) ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-3 col-form-label">วันหมดอายุ</label>
                    <div class="col">
                        <p class="form-control-plaintext"><?= htmlspecialchars($row['end_date']) ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-3 col-form-label">วันใช้งาน</label>
                    <div class="col">
                        <p class="form-control-plaintext"><?= htmlspecialchars($row['total_day']) ?> วัน</p>
                    </div>
                  
                </div>
                <div class="row mb-3">
                    <label class="col-3 col-form-label">แจ้งเตือน</label>
                    <div class="col">
                        <p class="form-control-plaintext"><?= htmlspecialchars($row['day_alert']) ?> วันก่อนหมดอายุ</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-3 col-form-label">หมายเหตุ</label>
                    <div class="col">
                        <p class="form-control-plaintext"><?= nl2br(htmlspecialchars($row['more_detail'])) ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-3 col-form-label">สถานะ</label>
                    <div class="col">
                        <p class="form-control-plaintext">
                            <?= htmlspecialchars($row['status']) == 'on' ? 'แจ้งเตือนไปยัง Line Notify' : 'ไม่แจ้งเตือน' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<?php
// Close statement and connection
$stmt->close();
$conn->close();
?>
