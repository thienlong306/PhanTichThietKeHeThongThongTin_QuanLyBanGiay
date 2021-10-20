<?php
  class Pages extends Controller {
    public function __construct() {

    }

    public function index() {
      if (isLoggedIn()) {
        redirect("products");
      }

      $data = array(
        "title" => "NIKIDAS",
        "description" => "Hệ thống quản lý bán giày"
      );
      $this->view("pages/index", $data);
    }

    public function about() {
      $data = array(
        "title" => "GIỚI THIỆU",
        "description" => "Hệ thống quản lý bán giày"
      );
      $this->view("pages/about", $data);
    }
  }
?>
