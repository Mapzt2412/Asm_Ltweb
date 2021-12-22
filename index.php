<?php
  session_start();
  require_once('php/functions.php');
  require_once('php/transmission.php');
  $product = getTop5Product();
  $product1 = getTop1Product();
  $product12 = getTop12Product();
  $product2 = getTop2Product();
  $product3 = getTop3Product();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link type="text/css" rel="stylesheet" href="css/index.css">
    <link type="text/css" rel="stylesheet" href="css/back-to-top.css">
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
                <li class="nav-item active">
                  <a class="nav-link" href="#">Trang chủ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="php/gioithieu.php">Giới thiệu</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Thể loại
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="index.php?page=Manga">Manga</a>
                    <a class="dropdown-item" href="index.php?page=Fanart">Fanart</a>
                  </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="php/lienhe.php">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="php/tintuc.php">Tin tức</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0 mr-sm-2">
                <div class="form-outline">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Tìm kiếm"
                    aria-label="Search"/>
                </div>
              </form>
              <div class="form-inline my-2 my-lg-0 mr-sm-2">
                <a href="index.php?page=cart" class="btn btn-outline-secondary"><i class="fa fa-cart-plus"></i></a>
                <?php
                if(isset($_SESSION["loged"])) {
                ?>
                  <div class="btn-group dropleft">
                    <a href="" class="btn btn-outline-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="php/user_infor.php">Thông tin cá nhân</a>
                      <a class="dropdown-item" href="/ASM/php/logout.php" tite="Logout">Đăng xuất</a>
                    </div>
                  </div>
                <?php
                }else {
                ?>
                <a href="index.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i></a>
                <?php
                }
                ?>
              </div>
            </div>
    </nav>
    <?php
    if(isset($_GET["page"]) && $_GET["page"] == "login"){
      $_SESSION['page'] = 'index';
      header("Location:php/login.php");
    }
    if(isset($_GET["page"]) && $_GET["page"] == "product"){
      $_SESSION['idproduct'] = $_GET["id"];
      header("Location:php/product.php");
      }
    if(isset($_GET["page"]) && $_GET["page"] == "cart"){
      if(isset($_SESSION["loged"])) {
        header("Location:php/cart.php");
      }
      else{
        $_SESSION['page'] = 'cart';
        header("Location:php/login.php");
      }
      }
    if(isset($_GET["page"]) && $_GET["page"] == "Manga"){
      $_SESSION['category'] = $_GET["page"];
      header("Location:php/productCategory.php");
    }
    if(isset($_GET["page"]) && $_GET["page"] == "Fanart"){
      $_SESSION['category'] = $_GET["page"];
      header("Location:php/productCategory.php");
    }
    if(isset($_GET["page"]) && $_GET["page"] == "addCart"){
      if($_SESSION["loged"]){
        $productId = $_GET["id"];
        $productQuantily = 1;
        $userId = $_SESSION["id"];
        addCart($userId,$productId,$productQuantily);
        header("location: index.php");
      }
      else{
        $_SESSION['page'] = 'index';
        header("location: php/login.php");
      }
    }
    ?>
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-interval="10000">
        <a href="#"><img src="images/gt (1).png" class="d-block w-100"></a>
            
        </div>
        <?php foreach($product as $product): ?>
          <div class="carousel-item" data-interval="10000">
            <a href="index.php?page=product&id=<?php echo $product['id']?>"><img src="<?php echo $product['bannerproduct']; ?>" class="d-block w-100"></a>
          </div>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-target="#carouselExampleInterval" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-target="#carouselExampleInterval" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </button>
    </div>
    <div class="content">
        <H3>Chúng tôi là PekoKun BK</H3> 
        <p> Chúng tôi là những người trẻ đang cố gắng hết sức để có thể tạo ra những sản phẩm sáng tạo của người Việt </p>
    </div>
    <div class="container">
        <h1>Những sản phẩm bán chạy</h1>
        <div class="row">
            <?php foreach($product12 as $product12): ?>
              <div class="card col-sm-3 col-lg-3 " style="border: none;">
                  <a href="index.php?page=product&id=<?php echo $product12['id']?>"><img class="card-img-top" src="<?php echo $product12['image']; ?>" alt="Card image" style="width:100%;height:350px"></a>
                  <div class="card-body">
                    <p class="card-text"><?php echo $product12['price']; ?>VNĐ</p>
                    <a href="index.php?page=addCart&id=<?php echo $product12["id"]?>"  class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                  </div>
              </div>
            <?php endforeach;?>
        </div>
        <h1>Truyện tranh độc quyền</h1>
        <div class="row">
            <div class="row">
              <?php foreach($product2 as $product2): ?>
                <div class="card col-sm-6" style="border: none;">
                    <a href="index.php?page=product&id=<?php echo $product2['id']?>"><img class="card-img-top" src="<?php echo $product2['image']; ?>" alt="Card image" style="width:100%; height:900px"> </a>
                </div>
                <?php endforeach;?>
            </div>
        </div> 
    </div>

    <div class="banner">
        <img src="images/banner3.jpg" style="width: 100%;height: 300px;">
    </div>
    <div class="container">
        <h1>Và nhiều sản phẩm khác</h1>
          <img src="<?php echo $product1['bannerproduct']; ?>" style="width: 100%; height: 400px;">
        <div class="row">
             <?php foreach($product3 as $product3 ): ?>
              <div class="card col-sm-4" style="border: none;">
                <a href="index.php?page=product&id=<?php echo $product3['id']?>" > <img class="card-img-top" src="<?php echo $product3['image']; ?>" alt="Card image" style="width:100%;"></a>
              </div>
              <?php endforeach;?>
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