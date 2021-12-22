<?php
    session_start();
    require_once('functions.php');
    require_once('transmission.php');
    if(isset($_GET["page"]) && $_GET["page"] == "login"){
      $_SESSION['page'] = 'category';
      header("Location:login.php");
    }

    if(isset($_GET["sort"]) ){
      $_SESSION['sort'] = $_GET["sort"];
    }
    
    if(isset($_SESSION['sort']) && $_SESSION['sort'] == "topseller"){
      $category = getTop12ProductCategorytopseller($_SESSION['category']);
      $category1 = getTop12ProductCategorytopseller1($_SESSION['category']);
    }
    else if(isset($_SESSION['sort']) && $_SESSION['sort'] == "latest"){
      $category = getTop12ProductCategorylatest($_SESSION['category']);
      $category1 = getTop12ProductCategorylatest1($_SESSION['category']);
    }
    else if(isset($_SESSION['sort']) && $_SESSION['sort'] == "highprice"){
      $category = getTop12ProductCategoryhighprice($_SESSION['category']);
      $category1 = getTop12ProductCategoryhighprice1($_SESSION['category']);
    }
    else if(isset($_SESSION['sort']) && $_SESSION['sort'] == "lowprice"){
      $category = getTop12ProductCategorylowprice($_SESSION['category']);
      $category1 = getTop12ProductCategorylowprice1($_SESSION['category']);
    }
    else {
      $category = getTop12ProductCategory($_SESSION['category']);
      $category1 = getTop12ProductCategory1($_SESSION['category']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thể loại: Manga </title>
    <link type="text/css" rel="stylesheet" href="/ASM/css/manga.css">
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
                <li class="nav-item dropdown active">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Thể loại 
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="productCategory.php?page=Manga">Manga</a>
                    <a class="dropdown-item" href="productCategory.php?page=Fanart">Fanart</a>
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
                <a href="productCategory.php?page=cart" class="btn btn-outline-secondary"><i class="fa fa-cart-plus"></i></a>
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
                <a href="productCategory.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i></a>
                <?php
                }
                ?>
              </div>

            </div>
  </nav>
    <div class="banner">
      <h4><?php echo $_SESSION['category']?></h4>
    </div>
    <div class="container">
        <div class="row">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-grid" viewBox="0 0 16 16">
                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
            </svg>
            <p style="margin-left: 10px;">Hiển thị 1–12 của <?php echo getCountProductByCategory($_SESSION['category'])["count"]?> kết quả</p>
            <div class="dropdown" >
                <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Sắp xếp
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="productCategory.php?page=Manga&sort=topseller">Thứ tự theo mức độ phổ biến</a>
                  <a class="dropdown-item" href="productCategory.php?page=Manga&sort=latest">Mới nhất</a>
                  <a class="dropdown-item" href="productCategory.php?page=Manga&sort=highprice">Thứ tự theo giá từ cao tới thấp</a>
                  <a class="dropdown-item" href="productCategory.php?page=Manga&sort=lowprice">Thứ tự theo giá từ thấp tới cao</a>
                </div>
            </div>
        </div>
      <?php
      
      ?>
        <div class="row">
          <?php foreach($category as $category): ?>
            <div class="card col-sm-3" style="border: none;">
                <a href="productCategory.php?page=product&id=<?php echo $category['id']?>"><img class="card-img-top" src="/ASM/<?php echo $category['image'] ?>" alt="Card image" style="width:100%"></a>
                <div class="card-body">
                <p class="card-text">Giá: <?php echo $category['price'] ?><span>&#36;</span></p>
                <button type="button" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </div>
            </div>
          <?php endforeach; ?>
          </div>
            <div class="collapse" id="boxnoidung">
            <div class="row">
              <?php 
              foreach($category1 as $category1): ?>
                <div class="card col-sm-3" style="border: none;">
                    <a href="productCategory.php?page=product&id=<?php echo $category1['id']?>"><img class="card-img-top" src="/ASM/<?php echo $category1['image'] ?>" alt="Card image" style="width:100%"> </a>
                    <div class="card-body">
                    <p class="card-text">Giá: <?php echo $category['price'] ?><span>&#36;</span></p>
                    <button type="button" class="btn btn-primary">Thêm vào giỏ hàng</button>
                    </div>
                </div>
              <?php endforeach; ?>
            </div>
            </div>
         
          
      <div class="more">
          <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#boxnoidung"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg> Xem thêm</button>
      </div>
      <div class="back-to-top">
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
      </div>
    </div>
  <!-- Footer -->
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