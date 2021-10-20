<?php require_once APPROOT . "/views/inc/header.php";?>
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body mt-5">
      <?php flash("edit_success");?>
      <h2>Cập nhật thông tin sản phẩm</h2>
      <p>Vui lòng điền vào form bên dưới</p>
      <form action="<?php echo URLROOT; ?>/products/edit/<?php echo $data["product"]->MaGiay; ?>" method="post">
        <div class="form-group">
          <label for="tenGiay">Tên giày <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" name="tenGiay" class="form-control form-control-lg<?php echo (!empty($data["tenGiay_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["product"]->TenGiay; ?>">
          <span class="invalid-feedback"><?php echo $data["tenGiay_err"]; ?></span>
        </div>

        <div class="form-group">
          <label for="gia">Giá <span class="text-danger font-weight-bold">*</span></label>
          <input type="number" name="gia" class="form-control form-control-lg <?php echo (!empty($data["gia_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["product"]->Gia; ?>">
          <span class="invalid-feedback"><?php echo $data["gia_err"]; ?></span>
        </div>

        <div class="form-group">
          <label for="soLuong">Số lượng <span class="text-danger font-weight-bold">*</span></label>
          <input type="number" name="soLuong" class="form-control form-control-lg <?php echo (!empty($data["soLuong_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["product"]->SLCon; ?>">
          <span class="invalid-feedback"><?php echo $data["soLuong_err"]; ?></span>
        </div>

        <div class="form-group">
          <label class="col-form-label">Hiệu giày <span class="text-danger small font-weight-bold">*</span></label>
          <select class="custom-select" name="maHG">
            <?php foreach ($data["cacHieuGiay"] as $hieuGiay): ?>
              <option value="<?php echo $hieuGiay->MaHG; ?>"
                <?php if ($data["product"]->MaHG == $hieuGiay->MaHG) {
  echo ("selected");
}
?>
                >
                <?php echo $hieuGiay->TenHG; ?>
                </option>
            <?php endforeach;?>
          </select>
        </div>

        <div class="form-group">
          <label class="col-form-label">Loại giày <span class="text-danger small font-weight-bold">*</span></label>
          <select class="custom-select" name="maLG">
            <?php foreach ($data["cacLoaiGiay"] as $loaiGiay): ?>
              <option value="<?php echo $loaiGiay->MaLG; ?>"
                <?php if ($data["product"]->MaLG == $loaiGiay->MaLG) {
  echo ("selected");
}
?>
                >
                <?php echo $loaiGiay->TenLG; ?>
                </option>
            <?php endforeach;?>
          </select>
        </div>

        <div class="row">
          <div class="col">
            <input type="submit" value="Sửa" class="btn btn-success btn-block">
          </div>
        </div>
      </form>
      <form id="form-xoa" action="<?php echo URLROOT; ?>/products/delete/<?php echo $data["product"]->MaGiay; ?>" method="post">
        <div class="col">
          <input type="button" value="Xóa" class="btn btn-danger btn-block mt-2" id="btn-xoa">
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once APPROOT . "/views/inc/footer.php";?>