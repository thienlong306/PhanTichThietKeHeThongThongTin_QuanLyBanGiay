<?php require_once APPROOT . "/views/inc/header.php"; ?>
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body mt-5">
      <?php flash("add_success"); ?>
      <h2>Thêm sản phẩm</h2>
      <p>Vui lòng điền vào form bên dưới</p>
      <form action="<?php echo URLROOT; ?>/products/add" method="post">
        <div class="form-group">
          <label for="tenGiay">Tên giày <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" name="tenGiay" class="form-control form-control-lg<?php echo (!empty($data["tenGiay_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["tenGiay"]; ?>">
          <span class="invalid-feedback"><?php echo $data["tenGiay_err"]; ?></span>
        </div>

        <div class="form-group">
          <label for="gia">Giá <span class="text-danger font-weight-bold">*</span></label>
          <input type="number" name="gia" class="form-control form-control-lg <?php echo (!empty($data["gia_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["gia"]; ?>">
          <span class="invalid-feedback"><?php echo $data["gia_err"]; ?></span>
        </div>

        <div class="form-group">
          <label for="soLuong">Số lượng <span class="text-danger font-weight-bold">*</span></label>
          <input type="number" name="soLuong" class="form-control form-control-lg <?php echo (!empty($data["soLuong_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["soLuong"]; ?>">
          <span class="invalid-feedback"><?php echo $data["soLuong_err"]; ?></span>
        </div>

        <div class="form-group">
          <label class="col-form-label">Hiệu giày <span class="text-danger small font-weight-bold">*</span></label>
          <select class="custom-select" name="maHG">
            <?php foreach ($data["cacHieuGiay"] as $hieuGiay) : ?>
              <option value="<?php echo $hieuGiay->MaHG; ?>" <?php if ($data["maHG"] == $hieuGiay->MaHG) echo ("selected"); ?>><?php echo $hieuGiay->TenHG; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label class="col-form-label">Loại giày <span class="text-danger small font-weight-bold">*</span></label>
          <select class="custom-select" name="maLG">
            <?php foreach ($data["cacLoaiGiay"] as $loaiGiay) : ?>
              <option value="<?php echo $loaiGiay->MaLG; ?>" <?php if ($data["maLG"] == $loaiGiay->MaLG) echo ("selected"); ?>><?php echo $loaiGiay->TenLG; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="row">
          <div class="col">
            <input type="submit" value="Thêm" class="btn btn-success btn-block">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require_once APPROOT . "/views/inc/footer.php"; ?>