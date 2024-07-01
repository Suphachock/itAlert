<?php
include_once "../condb.php";
$sql = "SELECT * FROM db_token";
$result = mysqli_query($conn, $sql);
$row = null;
if ($result && mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc();
}
?>
<div class="modal" tabindex="-1" id="md_setting">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ตั้งค่า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_setting">
                <div class="modal-body">
                    <div class="row mb-3 align-items-center">
                        <div class="col-auto">
                            <label class="form-label">Line Token</label>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <input type="text" name="token" value="<?= $row ? $row['token'] : '' ?>" class="form-control token">
                                <button type="button" class="input-group-text btn btn-success" onclick="test_notify()">ทดสอบ<i class="fa-solid fa-arrows-rotate"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        บันทึก
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#edit_setting').on('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: 'model/add_setting.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                let response = JSON.parse(res);
                if (response.status == "success") {
                    $("#md_setting").modal('hide');
                    table_items()
                } else {
                    alert(response.message);
                }
            }
        });
    });

    function test_notify() {
        let token = $(".token").val();
        $.ajax({
            type: "POST",
            data: {
                token
            },
            url: "model/test_notify.php",
            success: function(res) {
                console.log(res);
                let response = JSON.parse(res);
                alert(response.result)
            },
        });
    }
</script>