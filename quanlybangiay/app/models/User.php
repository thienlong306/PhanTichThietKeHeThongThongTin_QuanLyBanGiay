<?php
  class User {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    // Find user by tenDN
    public function timTaiKhoanTheoTenDN($tenDN) {
      $this->db->query("SELECT * FROM TaiKhoan WHERE tenDN = :tenDN");

      // Bind value
      $this->db->bind(":tenDN", $tenDN);

      $row = $this->db->single();

      // Check row
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    // Register user
    public function register($data) {
      $this->db->query("INSERT INTO TaiKhoan(tenDN, matKhau) VALUES(:tenDN, :matKhau)");

      // Bind values
      $this->db->bind(":tenDN", $data["tenDN"]);
      $this->db->bind(":matKhau", $data["matKhau"]);

      // Execute
      if($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    // Login
    public function login($data) {
      $this->db->query("SELECT * FROM TaiKhoan WHERE tenDN = :tenDN");
      $this->db->bind(":tenDN", $data["tenDN"]);

      $row = $this->db->single();
      $hashed_password = $row->MatKhau;
      if (password_verify($data["matKhau"], $hashed_password)) {
        return $row;
      } else {
        return false;
      }
    }

    // Get user by id
    public function getUserById($id) {
      $this->db->query("SELECT * FROM TaiKhoan WHERE id = :id");

      // Bind value
      $this->db->bind(":id", $id);

      $row = $this->db->single();

      return $row;
    }
  }
?>
