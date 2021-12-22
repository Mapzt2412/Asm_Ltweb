<?php
    session_start();
    require_once("transmission.php");
    if(isset($_GET["page"]) && $_GET["page"] == "product"){
        $_SESSION['idproduct'] = $_GET["id"];
        header("Location:product.php");
    }
    if(isset($_GET["page"]) && $_GET["page"] == "login"){
      $_SESSION['page'] = 'tintuc';
     header("Location:login.php");
    }
    require_once("functions.php");
    $row = getCountProductByNews();
    $total_records = $row['total'];
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 21;
    $total_page = ceil($total_records / $limit);
    if ($current_page > $total_page){
        $current_page = $total_page;
    }
    else if ($current_page < 1){
        $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
    $result = getNews($start,$limit);
    $product = getTop4ProductLastest();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
    <link type="text/css" rel="stylesheet" href="/ASM/css/tintuc.css">
    <link type="text/css" rel="stylesheet" href="/ASM/css/back-to-top.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark py-4 nav-fill w-100" >
        <a class="navbar-brand ml-sm-5" href="#" >PekoKun BK </a>
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
                <li class="nav-item">
                    <a class="nav-link" href="lienhe.php">Liên hệ</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="tintuc.php">Tin tức</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0 mr-sm-2">
                <div class="form-outline">
                    <input type="search"name="search" id="search" class="form-control" placeholder="Tìm kiếm"
                    aria-label="Search" />
                </div>
              </form>
              <div class="form-inline my-2 my-lg-0 mr-sm-2">
                <a href="tintuc.php?page=cart" class="btn btn-outline-secondary"><i class="fa fa-cart-plus"></i></a>
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
                <a href="tintuc.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i></a>
                <?php
                }
                ?>
              </div>
            </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <h4>TIN MỚI NHẤT</h4>
                <hr  width="100%" /> </hr>
                <div class="row">
                    <?php foreach($result as $result): ?>
                        <div class="card col-md-4 col-sm-4" style="border: none;">
                            <h6 id="text"><?php echo $result["category"]?></h6>
                            <a href="<?php echo $result["url"]?>"><img class="card-img-top" src="<?php echo $result["imageUrl"]?>" alt="Card image" style="width:100%"></a>
                            <p class="card-text"><?php echo $result["note"]?></p>
                        </div>
                    <?php endforeach; ?> 
                    
                    <ul class="pagination justify-content-end">
                        <li class="page-item "><a class="page-link" href="tintuc.php?page=<?php echo $current_page-1; ?>">Previous</a></li>
                        <?php 
                            for($i = 0; $i<  $total_page ; $i++){
                        ?>
                        <li class="page-item "><a class="page-link" href="tintuc.php?page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
                        <?php } ?>
                        <li class="page-item"><a class="page-link" href="tintuc.php?page=<?php echo $current_page+1; ?>">Next</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <H4>TRUYỆN MỚI NHẤT</H4>
                <hr  width="100%" /> </hr>
                <?php foreach($product as $product): ?>
                    <div class="card col-sm-12" style="border: none;"   >
                        <a href="tintuc.php?page=product&id=<?php echo $product['id']?>"><img class="card-img-top" src="/ASM/<?php echo $product["image"]?>" alt="Card image" style="width:100%"></a>
                    </div>
                <?php endforeach; ?> 
            </div>
            
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
            <h5 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>PekoKun BK
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

<script src="/ASM/js/btn_top.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>