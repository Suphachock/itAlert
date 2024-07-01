<div class="modal" tabindex="-1" id="md_add_items">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_item">
                <div class="modal-body">
                    <div class="row mb-3 align-items-center">
                        <div class="col-3">
                            <label class="form-label">รายละเอียด</label>
                        </div>
                        <div class="col">
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-3">
                            <label class="form-label">วันที่เริ่มใช้</label>
                        </div>
                        <div class="col">
                            <input name="start_date" class="form-control" id="datepicker" />
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-3">
                            <label class="form-label">วันใช้งาน</label>
                        </div>
                        <div class="col">
                            <div class="input-group ">
                                <input type="number" name="total_day" class="form-control" id="total_day">
                                <span class="input-group-text">วัน</span>
                            </div>
                        </div>
                        <div class="col">
                            <input type="text" name="end_date" class="form-control" id="end_date" readonly />
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-3">
                            <label class="form-label">แจ้งเตือน</label>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <input type="number" name="line_alert_day" class="form-control">
                                <span class="input-group-text">วันก่อนหมดอายุ</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-3">
                            <label class="form-label">หมายเหตุ</label>
                        </div>
                        <div class="col">
                            <textarea class="form-control" name="more_detail"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-3">
                            <label class="form-label">สถานะ</label>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status">
                                <label class="form-check-label" >
                                    แจ้งเตือนไปยัง Line Notify
                                </label>
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
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap5',
        format: 'yyyy-mm-dd' // กำหนดรูปแบบวันที่เป็นปี-เดือน-วัน
    }).on('change', calculateEndDate);

    $('#total_day').on('input', calculateEndDate);

    function calculateEndDate() {
        let startDate = $('#datepicker').val();
        let expireDays = parseInt($('#total_day').val());

        if (startDate && !isNaN(expireDays)) {
            let start = new Date(startDate);
            let end = new Date(start);
            end.setDate(start.getDate() + expireDays);

            let endDate = end.toISOString().split('T')[0];
            $('#end_date').val(endDate);
        }
    }

    $('#add_item').on('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: 'model/add_items.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                let response = JSON.parse(res);
                if (response.status == "success") {
                    $("#md_add_items").modal('hide');
                    table_items()
                } else {
                    alert(response.message);
                }
            }
        });
    });
</script>