<?php
    session_start();
    require_once('transmission.php');
    require_once("functions.php");
    $product = getProductById($_SESSION['idproduct']);
    $product4 = getTop4Product($product["category"]);
    $product4A = getTop4AProduct($product["category"]);
    $rate = avgRate($_SESSION['idproduct']);
    $sum = 0;
    $count = 0;
    foreach($rate as $rate):
        $sum = $sum + $rate["rate"];
        $count = $count + 1;
    endforeach;
    if ($count == 0){
      $avg=0;
    }else{
    $avg = round($sum / $count,2) ;
    }
    function ratePecent($i){
        $rate = avgRate($_SESSION['idproduct']);
        $count = 0;
        $sumRate = 0;
        foreach($rate as $rate):
            $count = $count + 1;
            if($rate["rate"]==$i){
                $sumRate = $sumRate+1;
            }
        endforeach;
        if ($count == 0){
          return 0;
        }else{
          return round(($sumRate/$count)*100); ;
        }  
    }
    if(isset($_GET["page"]) && $_GET["page"] == "addCart"){
      if($_SESSION["loged"]){
        $productId = $_GET["id"];
        $productQuantily = 1;
        $userId = $_SESSION["id"];
        addCart($userId,$productId,$productQuantily);
        header("location: product.php");
      }
      else{
        $_SESSION['page'] = 'product';
        header("location: login.php");
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['title']?></title>
    <link type="text/css" rel="stylesheet" href="/ASM/css/sanpham.css">
    <link type="text/css" rel="stylesheet" href="/ASM/css/back-to-top.css">
    <link rel="stylesheet" href="myProjects/webProject/icofont/css/icofont.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
<?php
    require_once("functions.php");
    if(isset($_POST["submit"])){
        $cmt = $_POST["cmt"];
        $rate = $_POST["inlineRadioOptions"];
        if(isset($_SESSION["loged"])){
            cmt($rate,$_SESSION['idproduct'],$_SESSION['id'], $cmt);
        }
        else{
            $_SESSION['page'] = 'product';
            header("location: login.php");
        }
    }
?>

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
                    <a class="dropdown-item" href="product.php?page=Manga#">Manga</a>
                    <a class="dropdown-item" href="product.php?page=Fanart">Fanart</a>
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
                <a href="product.php?page=cart" class="btn btn-outline-secondary"><i class="fa fa-cart-plus"></i></a>
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
                <a href="product.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i></a>
                <?php
                }
                ?>
              </div>

            </div>
    </nav>
    <?php
		if(isset($_GET["page"]) && $_GET["page"] == "login"){
      $_SESSION['page'] = 'product';
		  header("Location:login.php");
    }
	 ?>
    <div class="container" id="container">
        <div class="row">
            <div class="card col-sm-5" style="border: none;">
                <img src="/ASM/<?php echo $product['image']?>" style="width: 100%; max-height:600px">
            </div>
            <div class="card col-sm-7" style="border: none;">
                
                <h1><?php echo $product['title']?></h1>
                <p class="price"><?php echo $product['price']?> <span>₫</span></p>
                <h5 style="text-align:justify"><?php echo $product['title']?> sẽ chỉ bán duy nhất tại website của Bekokun và các cửa hàng Bekokun Store KHÔNG BÁN ở các trang web bán sách khác cũng như các nhà sách trong cả nước.</h5>
                <div class="row">
                    
                    <div class="col-lg-5 col-xs-4">
                        <a href="product.php?page=addCart&id=<?php echo $product["id"]?>"  class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                    </div>
                    <hr  width="100%" /> </hr>
                </div>
                <div class="code">
                    <span class="code">Mã:</span> 
                    <span class="content"><?php echo $product['code']?></span>
                </div>
                <div class="category">
                    <span class="category">Danh mục:</span> 
                    <span class="content"><?php echo $product['category']?></span>
                </div>
            </div>
            <div class="card col-md-12" style="border: none;">
              <div id="#menu" class="bg-white rounded shadow-sm p-4 mb-4 explore-outlets">
                <h2>Mô tả</h2>
                <p style="text-align:justify"><?php echo $product['dicription']?>
                </p>
                <h3>Thông tin sản phẩm</h3>
                <p style="text-align:justify"><?php echo $product['infor_Item']?></p>
                 
                <h3>Giới thiệu về tác giả</h3>
                <p style="text-align:justify"><?php echo $product['infor_author']?></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="offer-dedicated-body-left">
                  <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade active show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                          <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                              <h5 class="mb-0 mb-4">Đánh giá</h5>
                              <div class="graph-star-rating-header">
                                  <p class="text-black mb-4 mt-2">Đánh giá <?php echo $avg ?> sao trên 5 sao</p>
                              </div>
                              <div class="graph-star-rating-body">
                                  <div class="rating-list">
                                      <div class="rating-list-left text-black">
                                          5 Sao
                                      </div>
                                      <div class="rating-list-center">
                                          <div class="progress">
                                              <div style="width: <?php echo  ratePecent(5)?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                  <span class="sr-only">80% Complete (danger)</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="rating-list-right text-black"><?php echo  ratePecent(5)?>%</div>
                                  </div>
                                  <div class="rating-list">
                                      <div class="rating-list-left text-black">
                                          4 Sao
                                      </div>
                                      <div class="rating-list-center">
                                          <div class="progress">
                                              <div style="width: <?php echo  ratePecent(4)?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                  <span class="sr-only">80% Complete (danger)</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="rating-list-right text-black"><?php echo  ratePecent(4)?>%</div>
                                  </div>
                                  <div class="rating-list">
                                      <div class="rating-list-left text-black">
                                          3 Sao
                                      </div>
                                      <div class="rating-list-center">
                                          <div class="progress">
                                              <div style="width: <?php echo  ratePecent(3)?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                  <span class="sr-only">80% Complete (danger)</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="rating-list-right text-black"><?php echo  ratePecent(3)?>%</div>
                                  </div>
                                  <div class="rating-list">
                                      <div class="rating-list-left text-black">
                                          2 Sao
                                      </div>
                                      <div class="rating-list-center">
                                          <div class="progress">
                                              <div style="width: <?php echo  ratePecent(2)?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                  <span class="sr-only">80% Complete (danger)</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="rating-list-right text-black"><?php echo  ratePecent(2)?>%</div>
                                  </div>
                                  <div class="rating-list">
                                      <div class="rating-list-left text-black">
                                          1 Sao
                                      </div>
                                      <div class="rating-list-center">
                                          <div class="progress">
                                              <div style="width: <?php echo  ratePecent(1)?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                  <span class="sr-only">80% Complete (danger)</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="rating-list-right text-black"><?php echo  ratePecent(1)?>%</div>
                                  </div>
                              </div>
                          </div>
                          <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                              <h5 class="mb-1">Tất cả đánh giá và bình luận</h5>
                           <?php 
                              $rate1 = getCmtById($_SESSION['idproduct']);
                              foreach($rate1 as $rate1):
                                $user = getUserById($rate1["userId"]);
                            ?>
                              <div class="reviews-members pt-4 pb-4">
                                  <div class="media">
                                      <a href="#"><img alt="Generic placeholder image" src="<?php echo $user["avatar"]?>" class="mr-3 rounded-pill"></a>
                                      <div class="media-body">
                                          <div class="reviews-members-header">
                                              <span class="star-rating float-right">
                                                <?php 
                                                  for ($i = 0;$i < $rate1["rate"]; $i++){?>
                                                <a ><i class="fa fa-star checked"></i></a>
                                                <?php }?>
                                                    </span>
                                              <h6 class="mb-1"><a class="text-black" href="#"><?php echo $user["full_Name"]?></a></h6>
                                              <p class="text-gray"><?php echo $rate1["time_create"]?></p>
                                          </div>
                                          <div class="reviews-members-body">
                                              <p style="text-align:justify"><?php echo $rate1["cmt"]?></p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            <?php endforeach; ?>
                            <?php 
                              $rate2 = getCmtById1($_SESSION['idproduct']);
                              foreach($rate2 as $rate2):
                                $user = getUserById($rate2["userId"]);
                            ?>
                            <div class="collapse" id="boxnoidung">
                              <div class="reviews-members pt-4 pb-4">
                                    <div class="media">
                                        <a href="#"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar1.png" class="mr-3 rounded-pill"></a>
                                        <div class="media-body">
                                            <div class="reviews-members-header">
                                                <span class="star-rating float-right">
                                                  <?php 
                                                    for ($i = 0;$i < $rate2["rate"]; $i++){?>
                                                  <a ><i class="fa fa-star checked"></i></a>
                                                  <?php }?>
                                                      </span>
                                                <h6 class="mb-1"><a class="text-black" href="#"><?php echo $user["full_Name"]?></a></h6>
                                                <p class="text-gray"><?php echo $rate2["time_create"]?></p>
                                            </div>
                                            <div class="reviews-members-body">
                                                <p style="text-align:justify"><?php echo $rate2["cmt"]?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <hr>
                          <div class="graph-star-rating-footer text-center mt-3 mb-3">
                              <button type="button" class="btn btn-outline-primary btn-sm"data-toggle="collapse" data-target="#boxnoidung">Xem thêm</button>
                          </div>
                          </div>
                          <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                              <h5 class="mb-4">Để lại bình luận </h5>
                              <p class="mb-2">Đánh giá tại đây</p>
                              <form action="" method="post"> 
                              <div class="mb-4">
                                <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">1 <i class="fa fa-star checked"></i></label>
                                    </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2 <i class="fa fa-star checked"></i></label>
                                    </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
                                    <label class="form-check-label" for="inlineRadio3">3 <i class="fa fa-star checked"></i></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="4">
                                    <label class="form-check-label" for="inlineRadio4">4 <i class="fa fa-star checked"></i></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="5">
                                    <label class="form-check-label" for="inlineRadio5">5 <i class="fa fa-star checked"></i></label>
                                </div>
                              </div>
                                  <div class="form-group">
                                      <label>Bình luận tại đây</label>
                                      <textarea name="cmt"class="form-control"></textarea>
                                  </div>
                                  <div class="form-group">
                                    <input name="submit" type="submit" value="Đăng bình luận">
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
            <div class="container">
              <h2 class="font-weight-light">Sản phẩm liên quan</h2>
              <div class="row">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <div class="d-none d-lg-block">
                        <div class="slide-box">
                        <?php foreach($product4 as $product4): ?>
                            <img src="/ASM/<?php echo $product4["image"]?>" alt="First slide" style="width:100%;height:350px">
                        <?php endforeach;?>
                        </div>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <div class="d-none d-lg-block">
                        <div class="slide-box">
                        <?php foreach($product4A as $product4A): ?>
                            <img src="/ASM/<?php echo $product4A["image"]?>" alt="Second slide" style="width:100%;height:350px">
                        <?php endforeach;?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
        </div>
  </div>
      <div class="back-to-top">
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
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



</body>
</html>