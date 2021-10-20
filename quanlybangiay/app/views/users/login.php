<?php require_once APPROOT . "/views/inc/header.php"; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body mt-5">
        <?php flash("register_success"); ?>
        <h2>Đăng nhập</h2>
        <form action="<?php echo URLROOT; ?>/users/login" method="post">
          <div class="form-group">
            <label for="tenDN">Tên đăng nhập <span class="text-danger font-weight-bold">*</span></label>
            <input type="text" name="tenDN" class="form-control form-control-lg<?php echo (!empty($data["tenDN_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["tenDN"] ?>">
            <span class="invalid-feedback"><?php echo $data["tenDN"]; ?></span>
          </div>
          <div class="form-group">
            <label for="matKhau">Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
            <input type="password" name="matKhau" class="form-control form-control-lg <?php echo (!empty($data["matKhau_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["matKhau"] ?>">
            <span class="invalid-feedback"><?php echo $data["matKhau_err"]; ?></span>
          </div>

          <div class="row">
            <div class="col">
              <input type="submit" value="Đăng nhập" class="btn btn-success btn-block">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require_once APPROOT . "/views/inc/footer.php"; ?>
