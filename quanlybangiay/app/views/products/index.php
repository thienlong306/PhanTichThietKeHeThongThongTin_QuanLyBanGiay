<?php require_once APPROOT . "/views/inc/header.php";?>

<div>
  <div class="card">
    <div class="card-body">
      <div>
        <h4 class="header-title d-inline-block">Sản phẩm</h4>
        <a href="<?php echo URLROOT; ?>/products/add">(Thêm sản phẩm)</a>
      </div>
      <div class="single-table">
          <div class="table-responsive">
            <table class="table" id="products-table">
              <thead class="text-uppercase bg-info">
                <tr class="text-white">
                  <th scope="col">STT</th>
                  <th scope="col">Tên Giày</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Loại giày</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = 0; $i < $data["totalProducts"]; $i++): ?>
                <tr>
                  <td><?php echo $i + 1; ?></td>
                  <td><?php echo $data["products"][$i]->TenGiay; ?></td>
                  <td><?php echo number_format($data["products"][$i]->Gia); ?>&nbsp;VND</td>
                  <td><?php echo $data["products"][$i]->TenLG; ?></td>
                  <td><?php echo $data["products"][$i]->SLCon; ?></td>
                  <td>
                   <a href="<?php echo URLROOT; ?>/products/edit/<?php echo $data["products"][$i]->MaGiay; ?>"><i class="fa fa-edit fa-lg text-dark"></i></a>
                  </td>
                </tr>
                <?php endfor;?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- table info end -->

<script src="<?php echo URLROOT; ?>/js/filter-table.js"></script>

<?php require_once APPROOT . "/views/inc/footer.php";?>
