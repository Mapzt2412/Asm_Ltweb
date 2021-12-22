<?php
    session_start();
    require_once('functions.php');
    require_once('transmission.php');
    $user = getUserById($_SESSION["id"]);
    if(isset($_POST["submit"])){
        $fullname= $_POST["fullname"];
        $email = $_POST["email"];
        $phoneNum = $_POST["phoneNum"];
        $sex = $_POST["sex"];
        $birthday = $_POST["birthday"];
        $address = $_POST["address"];
        updateUser($fullname,$email,$phoneNum,$birthday,$sex,$address,$_SESSION["id"]);
        header("location: user_infor.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>
    <link type="text/css" rel="stylesheet" href="/ASM/css/update_infor.css">
    <link type="text/css" rel="stylesheet" href="/ASM/css/back-to-top.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark py-4 nav-fill w-100" >
        <a class="navbar-brand ml-sm-5" href="#" >PekoKun BK</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="/ASM/index.php">Trang chủ</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="gioithieu.php">Giới thiệu</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Thể loại
                  </a>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="user_infor.php?page=Manga">Manga</a>
                    <a class="dropdown-item" href="user_infor.php?page=Fanart">Fanart</a>
                  </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lienhe.php">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tintuc.php">Tin tức</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0 mr-sm-2">
                <div class="form-outline">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Tìm kiếm"
                    aria-label="Search" />
                </div>
              </form>
              <div class="form-inline my-2 my-lg-0 mr-sm-2">
                <a href="user_infor.php?page=cart" class="btn btn-outline-secondary"><i class="fa fa-cart-plus"></i></a>
                <?php
                if(isset($_SESSION["loged"])) {
                ?>
                <div class="btn-group dropleft">
                  <a href="" class="btn btn-outline-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="user_infor.php">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="/ASM/php/logout.php" tite="Logout">Đăng xuất</a>
                  </div>
                </div>
                <?php
                }else {
                ?>
                <a href="user_infor.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i></a>
                <?php
                }
                ?>
              </div>
            </div>
    </nav>
    <?php
		if(isset($_GET["page"]) && $_GET["page"] == "login"){
          $_SESSION['page'] = 'userinfor';
		     header("Location:login.php");
        }
	 ?>
    <div class="banner">
        <h4>Cập nhật thông tin</h4>
    </div>
    <div class="container">
        <form name="registerForm" method="POST">
            <div class="form-group row">
              <label for="firstName" class="col-3 col-form-label">Họ và tên:</label>
              <div class="col-9">
                <input type="text" class="form-control col-9" id="fullname" name="fullname"onfocus="this.placeholder=''" onblur="this.placeholder='Nhập họ và tên '" placeholder="Nhập họ và tên ">
              </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-3 col-form-label">Email:</label>
                <div class="col-9">
                    <input type="text" class="form-control col-9" id="email" name="email" onfocus="this.placeholder=''" onblur="this.placeholder='Nhập Email '" placeholder="Nhập Email ">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-3 col-form-label">Số điện thoại:</label>
                <div class="col-9">
                    <input type="text" class="form-control col-9" id="phoneNum" name="phoneNum" onfocus="this.placeholder=''" onblur="this.placeholder='Nhập số điện thoại '" placeholder="Nhập số điện thoại ">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-3 col-form-label">Ngày sinh:</label>
                <div class="col-9 d-flex">
                    <input type="date" id="birthday" name="birthday">
                </div>
            </div>

            <div class="form-check row d-flex" style="padding-left: 0; margin-bottom: 15px;">
                  <label class="col-3 col-form-label">Giới tính:</label>
                <div class="col-9">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" id="male" value="Nam" checked>
                    <label class="form-check-label" for="male">Nam</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" id="female" value="Nữ">
                    <label class="form-check-label" for="female">Nữ</label>
                  </div>
                </div>
            </div>

            <div class="form-group row">
              <label class="col-3 col-form-label" for="about">Địa chỉ:</label>
              <div class="col-9">
                <textarea class="form-control col-9" name="address"id="about" rows="3"></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-12 text-center">
                <button name="submit" type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="reset" class="btn btn-warning">Reset</button>
              </div>
            </div>
          </form>
    </div>
    <footer class="text-center text-lg-start bg-dark text-muted">
        <!-- Section: Social media -->
        <section
          class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
        >
          <!-- Left -->
          <div class="me-5 d-none d-lg-block">
            <span>Get connected with us on social networks:</span>
          </div>
          <!-- Left -->
    
          <!-- Right -->
          <div>
            <a href="https://www.facebook.com/PekoDreemurr" class="me-4 text-reset">
              <i class="fa fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/Nekkuntakku" class="me-4 text-reset">
              <i class="fa fa-twitter"></i>
            </a>
            <a href="https://www.deviantart.com/pekodreemurrowca" class="me-4 text-reset">
              <i class="fa fa-google"></i>
            </a>
            <a href="https://www.wattpad.com/user/pekodreemurrowca" class="me-4 text-reset">
              <i class="fa fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fa fa-linkedin"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fa fa-github"></i>
            </a>
          </div>
          <!-- Right -->
        </section>
        <!-- Section: Social media -->
    
        <!-- Section: Links  -->
        <section class="">
          <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
              <!-- Grid column -->
              <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold mb-4">
                  <i class="fas fa-gem me-3"></i>PekoKun BK
                </h6>
                <p>
                  Chúng tôi là những người trẻ đang cố gắng hết sức để có thể tạo ra những sản phẩm sáng tạo của người Việt.
                </p>
              </div>
              <!-- Grid column -->
    
              <!-- Grid column -->
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                  Products
                </h6>
                <p>
                  <a href="#!" class="text-reset">Nekkuntakku</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Peko Dreemurr</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Conan</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Doraemon</a>
                </p>
              </div>
              <!-- Grid column -->
    
              <!-- Grid column -->
              <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                  Useful links
                </h6>
                <p>
                  <a href="#!" class="text-reset">Pricing</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Settings</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Orders</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Help</a>
                </p>
              </div>
              <!-- Grid column -->
    
              <!-- Grid column -->
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                  Contact
                </h6>
                <p><i class="fa fa-home me-3"></i> Quế An, Quế Sơn, Quảng Nam</p>
                <p>
                  <i class="fa fa-envelope me-3"></i>
                   toan.vo2412@hcmut.edu.vn
                </p>
                <p><i class="fa fa-phone me-3"></i> +84 858441058</p>
                <p><i class="fa fa-print me-3"></i> +84 379573242</p>
              </div>
              <!-- Grid column -->
            </div>
            <!-- Grid row -->
          </div>
        </section>
        <!-- Section: Links  -->
    
      </footer>
<script src="/ASM/js/btn_top.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>