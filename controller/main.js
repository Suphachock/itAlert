$(document).ready(function () {
  table_items();
});

// ดึงข้อมูลตารางจาก database
function table_items() {
  $.ajax({
    type: "POST",
    url: "view/table_items.php",
    dataType: "html",
    success: function (res) {
      $(".table_show").html(res);
    },
  });
}

// Show Modal รายละเอียดข้อมูล
function items_detail(id) {
  $.ajax({
    type: "POST",
    url: "view/md_view_detail.php",
    data: { id },
    dataType: "html",
    success: function (res) {
      $(".modal_show").html(res);
      $("#md_view_items").modal("show");
    },
  });
}

// Show Modal สำหรับเพิ่มข้อมูล
function add_items() {
  $.ajax({
    type: "POST",
    url: "view/md_add_detail.php",
    dataType: "html",
    success: function (res) {
      $(".modal_show").html(res);
      $("#md_add_items").modal("show");
    },
  });
}

// Show Modal สำหรับแก้ไขข้อมูล
function edit_items(id) {
  $.ajax({
    type: "POST",
    url: "view/md_edit_detail.php",
    dataType: "html",
    data: { id },
    success: function (res) {
      $(".modal_show").html(res);
      $("#md_edit_items").modal("show");
    },
  });
}
// Show Modal สำหรับตั้งค่า Line Notify
function edit_setting() {
  $.ajax({
    type: "POST",
    url: "view/md_setting.php",
    dataType: "html",
    success: function (res) {
      $(".modal_show").html(res);
      $("#md_setting").modal("show");
    },
  });
}

// ลบข้อมูลในตาราง
function delete_items(id) {
  $.ajax({
    type: "POST",
    url: "model/delete_items.php",
    data: { id },
    success: function (res) {
      let response = JSON.parse(res);
      if (response.status == "success") {
        table_items();
      } else {
        alert(response.message);
      }
    },
  });
}
// ส่ง Line Notify
function line_notify() {
  $.ajax({
    type: "POST",
    url: "model/line_notify.php",
    success: function (res) {
      // let response = JSON.parse(res);
      console.log(res);
    },
  });
}
