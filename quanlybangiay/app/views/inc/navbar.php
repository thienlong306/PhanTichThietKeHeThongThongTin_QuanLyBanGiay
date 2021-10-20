<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT . "/pages/about"; ?>">Giới thiệu</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <?php if (isLoggedIn()) : ?>
          <li class="nav-item">
            <a href="" class="nav-link">Xin chào <?php echo $_SESSION["tenDN"]; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT . "/users/logout"; ?>">Đăng xuất</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT . "/users/login"; ?>">Đăng nhập</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
