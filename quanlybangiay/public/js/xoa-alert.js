$(document).ready(function () {
  // products table
  $("#btn-xoa").click(function (event) {
    event.preventDefault();
    let xoa = confirm("Bạn có muốn xóa");
    if (xoa) {
      $("#form-xoa").submit();
    }
  });
});
