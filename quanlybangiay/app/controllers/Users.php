<?php
  class Users extends Controller {
    public function __construct() {
      $this->userModel = $this->model("User");
    }

    public function index() {
      redirect("users/login");
    }

    public function register() {
      // Check for post
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = array(
          "name" => trim($_POST["name"]),
          "tenDN" => trim($_POST["tenDN"]),
          "matKhau" => trim($_POST["matKhau"]),
          "confirm_matKhau" => trim($_POST["confirm_matKhau"]),
          "name_err" => "",
          "tenDN_err" => "",
          "matKhau_err" => "",
          "confirm_matKhau_err" => ""
        );

        // Validate tenDN
        if (empty($data["tenDN"])) {
          $data["tenDN_err"] = "Please enter tenDN";
        } elseif ($this->userModel->findUserBytenDN($data["tenDN"])) {
          $data["tenDN_err"] = "tenDN is already taken";
        }

        // Validate name
        if (empty($data["name"])) {
          $data["name_err"] = "Please enter name";
        }

        // Validate matKhau
        if (empty($data["matKhau"])) {
          $data["matKhau_err"] = "Please enter matKhau";
        } elseif (strlen($data["matKhau"]) < 6) {
          $data["matKhau_err"] = "matKhau must at least 6 characters";
        }

        // Validate confirm_matKhau
        if (empty($data["confirm_matKhau"])) {
          $data["confirm_matKhau_err"] = "Please enter confirm_matKhau";
        } elseif ($data["matKhau"] != $data["confirm_matKhau"]) {
          $data["confirm_matKhau_err"] = "matKhaus are not matched";
        }

        // Make sure all errors are empty (no error occured)
        if (empty($data["tenDN_err"]) && empty($data["name_err"]) && empty($data["matKhau_err"]) && empty($data["confirm_matKhau_err"])) {
          // Validated

          // Hash matKhau
          $data["matKhau"] = matKhau_hash($data["matKhau"], matKhau_DEFAULT);

          // Register user
          if ($this->userModel->register($data)) {
            flash("register_success", "You are now registered");
            redirect("users/login");
          } else {
            die("Something went wrong");
          }
        } else {
          // Load view
          $this->view("users/register", $data);
        }
      } else {
        // Init data
        $data = array(
          "name" => "",
          "tenDN" => "",
          "matKhau" => "",
          "confirm_matKhau" => "",
          "name_err" => "",
          "tenDN_err" => "",
          "matKhau_err" => "",
          "confirm_matKhau_err" => ""
        );

        // Load view
        $this->view("users/register", $data);
      }
    }

    public function login() {
      if (isLoggedIn()) {
        redirect("products/index");
        die();
      }

      // Check for POST
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = array(
          "tenDN" => trim($_POST["tenDN"]),
          "matKhau" => trim($_POST["matKhau"]),
          "tenDN_err" => "",
          "matKhau_err" => ""
        );

        // Validate tenDN
        if (empty($data["tenDN"])) {
          $data["tenDN_err"] = "Vui lòng điền tên đăng nhập";
        }

        // Validate matKhau
        if (empty($data["matKhau"])) {
          $data["matKhau_err"] = "Vui lòng điền mật khẩu";
        }

        // Check user/tenDN
        if ($this->userModel->timTaiKhoanTheoTenDN($data["tenDN"])) {
          // User found
        } else {
          // User not found
          $data["matKhau_err"] = "Tên đăng nhập hoặc mật khẩu không chính xác";
        }

        // Make sure all errors are empty (no error occured)
        if (empty($data["tenDN_err"]) && empty($data["matKhau_err"])) {
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data);
          if ($loggedInUser) {
            $this->createUserSession($loggedInUser);
          } else {
            $data["matKhau_err"] = "Tên đăng nhập hoặc mật khẩu không chính xác";
            $this->view("users/login", $data);
          }
        } else {
          // Load view
          $this->view("users/login", $data);
        }
      } else {
        // Init data
        $data = array(
          "tenDN" => "",
          "matKhau" => "",
          "tenDN_err" => "",
          "matKhau_err" => ""
        );

        // Load view
        $this->view("users/login", $data);
      }
    }

    // Create user session
    public function createUserSession($user) {
      $_SESSION["tenDN"] = $user->TenDN;
      // redirect("posts/index");
      redirect("products/index");
    }

    // Logout
    public function logout() {
      unset($_SESSION["tenDN"]);
      session_destroy();
      redirect("users/login");
    }
  }
?>
