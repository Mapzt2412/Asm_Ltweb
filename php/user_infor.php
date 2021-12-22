<?php
    session_start();
    require_once('functions.php');
    require_once('transmission.php');
    $user = getUserById($_SESSION["id"]);
    if (!isset($_FILES["file_upload"]))
    {
        $message= "Dữ liệu không đúng cấu trúc";
    }  
    else if(isset($_POST["submit"])){
        $avatar = $_POST["file_upload"];
        $picture = $_FILES['file_upload']['name'];
        $tmp_name = $_FILES['file_upload']['tmp_name'];
        $time = time();
        $tmp = explode('.',$picture);
        $duoifile = end($tmp);
        $tenfilemoi = "avatar-".$time.'.'.$duoifile;
        $path_name = $_SERVER["DOCUMENT_ROOT"].'/ASM/images/avatar/'.$tenfilemoi;
        $path_upload=move_uploaded_file($tmp_name, $path_name); 
        $image = "/ASM/images/avatar/$tenfilemoi";
        updateAvatar($image,$_SESSION["id"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link type="text/css" rel="stylesheet" href="/ASM/css/user.css">
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
        <h4>Thông tin cá nhân</h4>
    </div>
    <div class="container bootstrap snippets bootdey">
        <div class="panel-body inf-content">
            <div class="row">
                <div class="col-md-4">
                    <img alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip" src="<?php echo $user["avatar"]?>" data-original-title="Usuario"> 
                    <form action="" method="POST" enctype="multipart/form-data" >
                        <div class="col text-center">
                            <button type="button" id="avatar" class="btn btn-primary" data-toggle="collapse" data-target="#boxnoidung" >Thay đổi ảnh đại diện</button>
                        </div>
                        <div class="collapse text-center" id="boxnoidung">
                            <input type="file" name="file_upload" id="file_upload">
                            <input class="btn btn-outline-primary" type="submit" value="Đăng ảnh" name="submit">
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                    <table class="table table-user-information">
                        <tbody>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                        Tên đăng nhập                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                <?php echo $user["user_Name"]?> 
                                </td>
                            </tr>
                            <tr>    
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-user  text-primary"></span>    
                                        Họ và tên                                   
                                    </strong>
                                </td>
                                <td class="text-primary">
                                <?php echo $user["full_Name"]?>    
                                </td>
                            </tr>
        
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                        Ngày sinh                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                <?php 
                                if($user["birtday"]== null){
                                    echo "Vui lòng cập nhật thông tin";
                                }
                                else{
                                    echo $user["birtday"];
                                }
                                ?> 
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-eye-open text-primary"></span> 
                                        Thành viên                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                    VIP
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-envelope text-primary"></span> 
                                        Email                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                <?php 
                                if($user["email"]== null){
                                    echo "Vui lòng cập nhật thông tin";
                                }
                                else{
                                    echo $user["email"];
                                }
                                ?> 
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-envelope text-primary"></span> 
                                        Địa chỉ                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                <?php 
                                if($user["address"]== null){
                                    echo "Vui lòng cập nhật thông tin";
                                }
                                else{
                                    echo $user["address"];
                                }
                                ?> 
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-calendar text-primary"></span>
                                        Tạo                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                    <?php echo $user["time_create"];?>
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-calendar text-primary"></span>
                                        Sửa đổi                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                <?php 
                                if($user["time_update"]== null){
                                    echo "Chưa từng cập nhật thông tin";
                                }
                                else{
                                    echo $user["time_update"];
                                }
                                ?>
                                </td>
                            </tr>                                    
                        </tbody>
                    </table>
                    <a href="update_infor.php"type="button" class="btn btn-primary">Cập nhật thông tin</a>
                    </div>
                </div>
            </div>
        </div>
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