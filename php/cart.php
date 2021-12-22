<?php
    session_start();
    require_once('transmission.php');
    require_once('functions.php');
    $user = getUserById($_SESSION["id"]);
    $cart = getCartById($_SESSION["id"]);
    if(isset($_GET["page"]) && $_GET["page"]=="delete" ){
      $id = $_GET["id"];
      deleteCart($_SESSION["id"],$id);
      header("location:cart.php");
    }
  $sum = 0;
  if(isset($_GET["page"]) && $_GET["page"]=="payment" ){
    foreach($cart as $cart ):
      $product=getProductById($cart["productId"]);
      $status="Thanh toán khi nhận hàng";
      updateQuantity($product["id"],$cart["quantily"]);
      addorders($user["full_Name"],$user["address"],$user["phoneNum"],$product["title"],$cart["quantily"],$status);
      deleteCart($user["id"],$product["id"]);
      header("location:cart.php");
    endforeach;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link type="text/css" rel="stylesheet" href="/ASM//css/cart.css">
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
                <li class="nav-item">
                  <a class="nav-link" href="/ASM/index.php">Trang chủ</a>
                </li>
                <li class="nav-item">
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
                <a href="cart.php?page=cart" class="btn btn-outline-secondary"><i class="fa fa-cart-plus"></i></a>
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
                <a href="gioithieu.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i></a>
                <?php
                }
                ?>
              </div>
            </div>
    </nav>
    <?php
		if(isset($_GET["page"]) && $_GET["page"] == "login"){
          $_SESSION['page'] = 'cart';
		     header("Location:login.php");
        }
	 ?>
    <div class="banner">
        <h4>Giỏ hàng của bạn</h4>
    </div>
    <div class="cart_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Giỏ hàng<small> (<?php echo getQuantilyProduct($_SESSION["id"])["quantily"];?> sản phẩm trong giỏ hàng của bạn) </small></div>
                        <div class="cart_items">
                          <?php foreach($cart as $cart ): 
                            $product=getProductById($cart["productId"]);
                            ?>
                            <ul class="cart_list">
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image"><img src="/ASM/<?php echo $product["image"]?>" alt=""></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="card col-sm-5" style="border: none;">
                                            <div class="cart_item_title">Tên</div>
                                            <div class="cart_item_text"><?php echo $product["title"]?></div>
                                        </div>
                                        <div class="card col-sm-2"  style="border: none;">
                                            <div class="cart_item_title">Số lượng</div>
                                            <div class="cart_item_text"><?php echo $cart["quantily"]?></div>
                                        </div>
                                        <div class="card col-sm-2"  style="border: none;">
                                            <div class="cart_item_title">Giá</div>
                                            <div class="cart_item_text"><?php echo $product["price"]?>VNĐ</div>
                                        </div>
                                        <div class="card col-sm-2"  style="border: none;">
                                            <div class="cart_item_title">Tổng</div>
                                            <div class="cart_item_text"><?php $sum = $sum+ ($cart["quantily"]*$product["price"]); echo ($cart["quantily"]*$product["price"])?></div>
                                        </div>
                                        <a href="cart.php?page=delete&id=<?php echo $cart["productId"] ?>" type="submit" name="submit" class="btn btn-danger"> Xóa</a>
                                    </div>
                                </li>
                            </ul>
                            <?php endforeach;?>
                        </div>
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Tổng cộng:</div>
                                <div class="order_total_amount"><?php echo $sum?>VNĐ</div>
                            </div>
                        </div>
                        <div class="cart_items">
                          <h3>Chọn hình thức thanh toán</h3>
                            <div class="row">
                               <div class="card col-lg-4">
                                  <div class="form-check-inline">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio" value="delivery">
                                      </label>
                                      <div class="row">
                                          <img src="https://laz-img-cdn.alicdn.com/tfs/TB1ZP8kM1T2gK0jSZFvXXXnFXXa-96-96.png" class="card-icon" style="max-width:40px">
                                          <div class="card-main-content-text-container">
                                              <h6>Thanh toán khi nhận hàng</h6>
                                          </div>
                                      </div>
                                      
                                    </div>
                               </div>
                               <div class="card col-lg-4">
                                  <div class="form-check-inline">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio" value="bank">
                                      </label>
                                      <div class="row">
                                          <div class="card-main-content-text-container">
                                              <h6><i class="fa fa-bank" style="font-size:30px;color:blue"></i>Thanh toán qua thẻ ngân hàng</h6>
                                          </div>
                                      </div> 
                                    </div>
                               </div>
                               <div class="card col-lg-4">
                                  <div class="form-check-inline">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio" value="bank">
                                      </label>
                                      <div class="row">
                                          <img src="https://business.momo.vn/assets/landingpage/img/931b119cf710fb54746d5be0e258ac89-logo-momo.png" alt="" style="max-width:40px">
                                          <div class="card-main-content-text-container">
                                              <h6> Thanh toán qua ví điện tử</h6>
                                          </div>
                                      </div> 
                                    </div>
                               </div>
                              </div>
                        </div>
                        <div class="cart_buttons"> 
                          <a href="/ASM/index.php"class="button cart_button_clear">Tiếp tục mua sắm</a>
                          <a href="cart.php?page=payment"class="button cart_button_checkout">Thanh toán</a> 
                    </div>
                </div>
            </div>
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