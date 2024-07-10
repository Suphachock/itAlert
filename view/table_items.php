<?php
// เชื่อมต่อกับฐานข้อมูล
include_once "../condb.php";

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง db_items โดยเรียงตาม day_alert จากน้อยไปมาก
$sql = "SELECT * FROM db_items ORDER BY status DESC , day_left ASC";
$result = mysqli_query($conn, $sql);
?>
<div class="row mb-3">
    <div class="col-lg-9 col-md-7 col-sm-6 col-9">
        <h3 class="text-center">ตารางแจ้งเตือนอุปกรณ์ภายในโรงงาน</h3>
    </div>
    <div class="col-lg-3 col-md-5 col-sm-6 col-3">
        <div class="d-flex justify-content-end">
            <!-- <button class="btn btn-info me-2" onclick="line_notify()">
                ทดสอบ
            </button> -->
            <button class="btn btn-warning me-2" onclick="edit_setting()">
                <i class="fa-solid fa-gear"></i> ตั้งค่า
            </button>
            <button class="btn btn-primary" onclick="add_items()">
                <i class="fa-solid fa-file-circle-plus"></i> เพิ่มข้อมูล
            </button>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-primary">
            <tr class="text-center">
                <th>ลำดับ</th>
                <th>รายละเอียด</th>
                <th>วันที่เริ่มใช้</th>
                <th>วันหมดอายุ</th>
                <th>เหลือเวลา</th>
                <th>หมายเหตุ</th>
                <th>แจ้งเตือน</th>
                <th>แก้ไข / ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1; // กำหนดตัวนับลำดับ
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr class="text-center">
                    <td><?= htmlspecialchars($counter) ?></td>
                    <td class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['start_date']) ?></td>
                    <td><?= htmlspecialchars($row['end_date']) ?></td>
                    <td class="<?= $row['day_left'] <= 0 ? 'text-danger fw-bold' : 'text-success fw-bold' ?>"><?= $row['day_left'] <= 0 ? 'หมดอายุแล้ว' : htmlspecialchars($row['day_left']) . ' วัน' ?></td>
                    <td class="text-truncate" style="max-width: 100px;"><?= htmlspecialchars($row['more_detail']) ?></td>
                    <td class="<?= $row['status'] == "off" ? 'text-danger fw-bold' : 'text-success fw-bold' ?>"><?= htmlspecialchars($row['status']) ?></td>
                    <td>
                        <button class="btn btn-primary" onclick="items_detail('<?= htmlspecialchars($row['id']) ?>')"><i class="fa-solid fa-eye"></i></button>
                        <button class="btn btn-warning" onclick="edit_items('<?= htmlspecialchars($row['id']) ?>')"><i class="fa-solid fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="if(confirm('Are you Sure!!')) { delete_items('<?= htmlspecialchars($row['id']) ?>'); } return false;"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            <?php $counter++;
            } ?>
        </tbody>
    </table>
</div>