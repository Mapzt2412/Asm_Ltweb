<?php
    session_start();
    require_once("functions.php");
    require_once("transmission.php");
    $message="";
    if(isset($_GET["page"]) && $_GET["page"] == "login"){
        $_SESSION['page'] = 'lienhe';
        header("Location:login.php");
    }
    if(isset($_POST["submit"])){
			$name = $_POST["name"];
			$email = $_POST["email"];
			$phoneNumber = $_POST["phone"];
			$content = $_POST["content"];
      contact($name,$email,$phoneNumber,$content);
      $message = "Gửi thành công";
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <link type="text/css" rel="stylesheet" href="/ASM/css/lienhe.css">
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
                  <a class="dropdown-item" href="gioithieu.php?page=Manga">Manga</a>
                    <a class="dropdown-item" href="gioithieu.php?page=Fanart">Fanart</a>
                  </div>
                </li>
                <li class="nav-item active">
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
                <a href="lienhe.php?page=cart" class="btn btn-outline-secondary"><i class="fa fa-cart-plus"></i></a>
                <?php
                if(isset($_SESSION["loged"])) {
                ?>
                <div class="btn-group dropleft">
                  <a href="" class="btn btn-outline-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="/ASM/php/logout.php" tite="Logout">Đăng xuất</a>
                  </div>
                </div>
                <?php
                }else {
                ?>
                <a href="lienhe.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i></a>
                <?php
                }
                ?>
              </div>
            </div>
    </nav>
    <div class="row">
        <div class="card col-sm-6" style="border: none;">
            <h2>Văn phòng miền Trung</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d807.7060327662192!2d108.20674975247046!3d15.638648003066695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3169fb716c3a6d83%3A0x1db2f4dc71245498!2zUXXhur8gQW4sIFF14bq_IFPGoW4sIFF14bqjbmcgTmFtLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1636968836153!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <i class='fa fa-map-marker'>   : Quế An, Quế Sơn, Quảng Nam </i>
            <i class="fa fa-phone red-color ">   : 0379573242</i>
            <i class="fa fa-envelope">   : toan.vo2412@hcmut.edu.vn</i>
            <i class="fa fa-clock-o">   : Thứ 2-6: 8h00-17h00  |  Thứ 7: 8h00-12h00</i>
        </div>
        <div class="card col-sm-6" style="border: none;">
            <h2>Văn phòng miền Bắc</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d807.7060327662192!2d108.20674975247046!3d15.638648003066695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3169fb716c3a6d83%3A0x1db2f4dc71245498!2zUXXhur8gQW4sIFF14bq_IFPGoW4sIFF14bqjbmcgTmFtLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1636968836153!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <i class='fa fa-map-marker'>   : Quế An, Quế Sơn, Quảng Nam </i>
            <i class="fa fa-phone red-color ">   : 0379573242</i>
            <i class="fa fa-envelope">   : toan.vo2412@hcmut.edu.vn</i>
            <i class="fa fa-clock-o">   : Thứ 2-6: 8h00-17h00  |  Thứ 7: 8h00-12h00</i>
        </div>

    </div>
    <div class="banner">
        LIÊN HỆ NGAY VỚI CHÚNG TÔI
    </div>
    <div class="container">
     <form action="" method="POST">
        <div class="row">
          
            <div class="card col-sm-4 col-xs-6" style="border: none;">
                <input type="text" class="form-control" name="name" id="name" placeholder="TÊN *">
            </div>
            <div class="card col-sm-4 col-xs-6" style="border: none;">
                <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL*">
            </div>
            <div class="card col-sm-4 col-xs-6" style="border: none;">
                <input type="number" class="form-control" name="phone" id="phone" placeholder="SỐ ĐIỆN THOẠI">
            </div>
            <div class="card col-sm-12 col-xs-6" style="border: none;margin-top: 20px;">
                <textarea class="form-control" name="content" id="content" rows="4" placeholder="NỘI DUNG"></textarea>
            </div>
            <div class="card col-sm-12 col-xs-6" style="border: none;margin-top: 20px;margin-bottom: 20px;">
                <button name="submit" type="submit" class="btn btn-danger">Gửi</button>
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
                <h5 class="text-uppercase fw-bold mb-4">
                  <i class="fas fa-gem me-3"></i>PekoKun 
                </h5>
                <p>
                  Chúng tôi là những người trẻ đang cố gắng hết sức để có thể tạo ra những sản phẩm sáng tạo của người Việt.
                </p>
              </div>
              <!-- Grid column -->
    
              <!-- Grid column -->
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h5 class="text-uppercase fw-bold mb-4">
                  Products
                </h5>
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
                <h5 class="text-uppercase fw-bold mb-4">
                  Useful links
                </h5>
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
                <h5 class="text-uppercase fw-bold mb-4">
                  Contact
                </h5>
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
    
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>