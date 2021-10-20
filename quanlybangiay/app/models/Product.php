<?php
class Product {
  private $__db;

  public function __construct() {
    $this->db = new Database();
  }

  // lấy tất cả hiệu giày
  public function layTatCaHieuGiay() {
    $this->db->query('SELECT * FROM HieuGiay');

    $result = $this->db->resultSet();
    return $result;
  }

  // lấy tất cả loại giày
  public function layTatCaLoaiGiay() {
    $this->db->query('SELECT * FROM LoaiGiay');

    $result = $this->db->resultSet();
    return $result;
  }

  // Get all product (Admin)
  public function layTatCaSanPham() {
    $this->db->query("SELECT * FROM Giay JOIN HieuGiay ON Giay.MaHG = HieuGiay.MaHG JOIN LoaiGiay ON Giay.MaLG = LoaiGiay.MaLG");

    $result = $this->db->resultSet();
    return $result;
  }

  public function laySanPhamTheoMa($maGiay) {
    $this->db->query("SELECT * FROM Giay JOIN HieuGiay ON Giay.MaHG = HieuGiay.MaHG JOIN LoaiGiay ON Giay.MaLG = LoaiGiay.MaLG WHERE magiay = :magiay");
    $this->db->bind(":magiay", $maGiay);
    $result = $this->db->single();
    return $result;
  }

  // add product
  public function add($product) {
    $this->db->query('INSERT INTO Giay(TenGiay, Gia, SLCon, MaHG, MaLG) VALUES(:tengiay, :gia, :slcon, :mahg, :malg)');

    $this->db->bind(":tengiay", $product["tenGiay"]);
    $this->db->bind(":gia", $product["gia"]);
    $this->db->bind(":slcon", $product["soLuong"]);
    $this->db->bind(":mahg", $product["maHG"]);
    $this->db->bind(":malg", $product["maLG"]);

    $this->db->execute();
  }

  // edit product
  public function edit($product) {
    $this->db->query("UPDATE Giay SET tengiay = :tenGiay, gia = :gia, slcon = :slcon, mahg = :mahg, malg = :malg WHERE magiay = :maGiay");

    $this->db->bind(":tenGiay", $product->TenGiay);
    $this->db->bind(":gia", $product->Gia);
    $this->db->bind(":slcon", $product->SLCon);
    $this->db->bind(":mahg", $product->MaHG);
    $this->db->bind(":malg", $product->MaLG);
    $this->db->bind(":maGiay", $product->MaGiay);

    $this->db->execute();
  }

  public function delete($maGiay) {
    $this->db->query("DELETE FROM Giay WHERE magiay = :maGiay ");

    $this->db->bind(":maGiay", $maGiay);
    $this->db->execute();
  }
}
?>
