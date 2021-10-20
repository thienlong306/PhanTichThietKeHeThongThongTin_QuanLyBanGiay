<?php
class Products extends Controller {
  public function __construct() {
    if (!isLoggedIn()) {
      $this->view("pages/pagenotfound");
      die();
    }
    $this->productModel = $this->model("Product");
  }

  public function index() {
    $products = $this->productModel->layTatCaSanPham();
    $totalProducts = count($products);
    $data = array(
      "products" => $products,
      "totalProducts" => $totalProducts,
    );
    $this->view("products/index", $data);
  }

  public function add() {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      // Get categories
      $cacHieuGiay = $this->productModel->layTatCaHieuGiay();
      $cacLoaiGiay = $this->productModel->layTatCaLoaiGiay();

      $product = array(
        "tenGiay" => trim($_POST["tenGiay"]),
        "gia" => trim($_POST["gia"]),
        "soLuong" => trim($_POST["soLuong"]),
        "cacHieuGiay" => $cacHieuGiay,
        "cacLoaiGiay" => $cacLoaiGiay,
        "maHG" => trim($_POST["maHG"]),
        "maLG" => trim($_POST["maLG"]),

      );

      $validated = true;

      $namePattern = '/^[^\[\]`!@#$%^&*()_+\\{}|;\'\",.\/<>?]*$/';

      // Validate product name
      if (empty($product["tenGiay"])) {
        $product["tenGiay_err"] = "Vui lòng nhập tên giày";
        $validated = false;
      } elseif (strlen($product["tenGiay"]) < 3) {
        $product["tenGiay_err"] = "Tên sản phẩm phải có ít nhất 3 ký tự";
        $validated = false;
      } else {
        if (!preg_match($namePattern, $product["tenGiay"])) {
          $product["tenGiay_err"] = "Tên sản phẩm không được chứa ký tự đặc biệt";
          $validated = false;
        }
      }

      // Validate price
      if (empty($product["gia"])) {
        $product["gia_err"] = "Vui lòng nhập giá";
        $validated = false;
      } elseif (!is_numeric($product["gia"])) {
        $product["gia_err"] = "Vui lòng chỉ nhập số";
        $validated = false;
      } else {
        if ($product["gia"] < 0) {
          $product["gia_err"] = "Giá không hợp lệ";
          $validated = false;
        }
      }

      // Validate quantity
      if (empty($product["soLuong"])) {
        $product["soLuong_err"] = "Vui lòng nhập số lượng";
        $validated = false;
      } elseif (!is_numeric($product["soLuong"])) {
        $product["soLuong_err"] = "Vui lòng chỉ nhập số";
        $validated = false;
      } else {
        if ($product["soLuong"] < 0) {
          $product["soLuong_err"] = "Số lượng không hợp lệ";
          $validated = false;
        }
      }

      if ($validated) {
        //Validated
        $this->productModel->add($product);

        flash("add_success", "Thêm sản phẩm thành công");

        // init data
        $product = array(
          "tenGiay" => "",
          "gia" => "",
          "soLuong" => "",
          "cacHieuGiay" => $cacHieuGiay,
          "cacLoaiGiay" => $cacLoaiGiay,
          "maHG" => "",
          "maLG" => "",
          "tenGiay_err" => "",
          "gia_err" => "",
          "soLuong_err" => "",
        );

        $this->view("products/add", $product);
      } else {
        $this->view("products/add", $product);
      }
    } else {
      // Get categories
      $cacHieuGiay = $this->productModel->layTatCaHieuGiay();
      $cacLoaiGiay = $this->productModel->layTatCaLoaiGiay();

      // init data
      $product = array(
        "tenGiay" => "",
        "gia" => "",
        "soLuong" => "",
        "cacHieuGiay" => $cacHieuGiay,
        "cacLoaiGiay" => $cacLoaiGiay,
        "maHG" => "",
        "maLG" => "",
        "tenGiay_err" => "",
        "gia_err" => "",
        "soLuong_err" => "",
      );

      $this->view("products/add", $product);
    }
  }

  public function edit($maGiay = "") {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $product = $this->productModel->laySanPhamTheoMa($maGiay);
      if (!$product) {
        //no product found
        die("Page not found");
      }

      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Get categories
      $cacHieuGiay = $this->productModel->layTatCaHieuGiay();
      $cacLoaiGiay = $this->productModel->layTatCaLoaiGiay();

      $product->TenGiay = trim($_POST["tenGiay"]);
      $product->Gia = trim($_POST["gia"]);
      $product->SLCon = trim($_POST["soLuong"]);
      $product->MaHG = trim($_POST["maHG"]);
      $product->MaLG = trim($_POST["maLG"]);

      $data = array(
        "product" => $product,
        "cacHieuGiay" => $cacHieuGiay,
        "cacLoaiGiay" => $cacLoaiGiay,
        "tenGiay_err" => "",
        "gia_err" => "",
        "soLuong_err" => "",
      );

      $validated = true;

      $namePattern = '/^[^\[\]`!@#$%^&*()_+\\{}|;\'\",.\/<>?]*$/';

      // Validate product name
      if (empty($data["product"]->TenGiay)) {
        $data["tenGiay_err"] = "Vui lòng nhập tên giày";
        $validated = false;
      } elseif (strlen($data["product"]->TenGiay) < 3) {
        $data["tenGiay_err"] = "Tên sản phẩm phải có ít nhất 3 ký tự";
        $validated = false;
      } else {
        if (!preg_match($namePattern, $data["product"]->TenGiay)) {
          $data["tenGiay_err"] = "Tên sản phẩm không được chứa ký tự đặc biệt";
          $validated = false;
        }
      }

      // Validate price
      if (empty($data["product"]->Gia)) {
        $data["gia_err"] = "Vui lòng nhập giá";
        $validated = false;
      } elseif (!is_numeric($data["product"]->Gia)) {
        $data["gia_err"] = "Vui lòng chỉ nhập số";
        $validated = false;
      } else {
        if ($data["product"]->Gia < 0) {
          $data["gia_err"] = "Giá không hợp lệ";
          $validated = false;
        }
      }

      // Validate quantity
      if (empty($data["product"]->SLCon)) {
        $data["soLuong_err"] = "Vui lòng nhập số lượng";
        $validated = false;
      } elseif (!is_numeric($data["product"]->SLCon)) {
        $data["soLuong_err"] = "Vui lòng chỉ nhập số";
        $validated = false;
      } else {
        if ($data["product"]->SLCon < 0) {
          $data["soLuong_err"] = "Số lượng không hợp lệ";
          $validated = false;
        }
      }

      if ($validated) {
        //Validated
        $this->productModel->edit($data["product"]);

        flash("edit_success", "Sửa sản phẩm thành công");

        $data = array(
          "product" => $product,
          "cacHieuGiay" => $cacHieuGiay,
          "cacLoaiGiay" => $cacLoaiGiay,
          "tenGiay_err" => "",
          "gia_err" => "",
          "soLuong_err" => "",
        );

        $this->view("products/edit", $data);
      } else {
        $this->view("products/edit", $data);
      }
    } else {
      $product = $this->productModel->laySanPhamTheoMa($maGiay);
      if (!$product) {
        //no product found
        die("Page not found");
      }

      // Get categories
      $cacHieuGiay = $this->productModel->layTatCaHieuGiay();
      $cacLoaiGiay = $this->productModel->layTatCaLoaiGiay();

      // init data
      $data = array(
        "product" => $product,
        "cacHieuGiay" => $cacHieuGiay,
        "cacLoaiGiay" => $cacLoaiGiay,
        "tenGiay_err" => "",
        "gia_err" => "",
        "soLuong_err" => "",
      );

      $this->view("products/edit", $data);
    }
  }

  public function delete($maGiay = "") {
    $this->productModel->delete($maGiay);
    redirect("products");
  }
}
?>
