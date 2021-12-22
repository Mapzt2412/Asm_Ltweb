<?php 
	session_start();
    require_once("functions.php");
	$product = getProductById($_SESSION["productid"]);
	if(isset($_POST["submit"])){
		$title = $_POST["title"];
		$author = $_POST["author"];
		$price = $_POST["price"];
		$code = $_POST["code"];
		$category = $_POST["category"];
		$infor_Item = $_POST["infor_Item"];
		$dicription = $_POST["dicription"];
		$image = $_POST["image"];
		$bannerproduct = $_POST["bannerproduct"];
		$keyword = $_POST["keyword"];
		updateProduct($_SESSION["productid"],$title, $author, $price, $code, $category , $infor_Item,$dicription,$image,$bannerproduct,$keyword);
		header("Location:admin.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm "<?php echo $product["title"]?>"</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4 nav-fill w-100" >
            <a class="navbar-brand ml-sm-5" href="/ASM/admin/admin.php" ><img src="https://img.icons8.com/external-itim2101-lineal-itim2101/64/000000/external-admin-internet-of-things-itim2101-lineal-itim2101.png"/>Admin PekoKun BK</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                  <a class="nav-link " href="admin.php">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="listNews.php">Danh sách tin tức</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="listContact.php">Danh sách contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listOrder.php">Danh sách đặt hàng</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0 mr-sm-2">
                <div class="form-outline">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Tìm kiếm"
                    aria-label="Search"/>
                </div>
              </form>
              <div class="form-inline my-2 my-lg-0 mr-sm-2">
                <?php
                if(isset($_SESSION["loged"])) {
                ?>
                  <a href="index.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i>Đăng xuất</a>
                <?php
                }else {
                ?>
                <a href="index.php?page=login" class="btn btn-outline-secondary"><i class="fa fa-user"></i> Đăng nhập</a>
                <?php
                }
                ?>
              </div>
            </div>
    </nav>
	<div class="container">
	<form method="POST" action="">
                <div class="form-group row">
					<label for="title" class="col-3 col-form-label">Tên:</label>
					<div class="col-9">
						<input type="text" class="form-control col-9" name="title" id="title" value="<?php echo $product["title"]?>">
					</div>
                </div>
				
                <div class="form-group row">
                    <label for="author" class="col-3 col-form-label">Tác giả:</label>
                    <div class="col-9">
                        <input type="text" class="form-control col-9" name="author" id="author" value="<?php echo $product["infor_author"]?>">
                    </div>
                </div>

                <div class="form-group row">
					<label for="price" class="col-3 col-form-label">Giá:</label>
					<div class="col-9">
						<input type="number" class="form-control col-9" name="price" id="price" value="<?php echo $product["price"]?>">
					</div>
                </div>

                <div class="form-group row">
                    <label for="code" class="col-3 col-form-label">Mã:</label>
                    <div class="col-9">
                        <input type="text" class="form-control col-9" name="code" id="code" value="<?php echo $product["code"]?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-3 col-form-label">Thể loại:</label>
                    <div class="col-9">
                        <input type="text" class="form-control col-9" name="category"id="category" value="<?php echo $product["category"]?>">
                    </div>
                </div>
				
                <div class="form-group row">
                    <label for="infor_Item" class="col-3 col-form-label">Thông tin sản phẩm:</label>
                    <div class="col-9">
						<textarea class="form-control col-9" name="infor_Item"id="infor_Item" rows="3" ><?php echo $product["infor_Item"]?> </textarea>
					</div>
                </div>

                <div class="form-group row">
					<label for="about" class="col-3 col-form-label" >Mô tả:</label>
					<div class="col-9">
						<textarea class="form-control col-9" name="dicription" id="dicription" rows="3"><?php echo $product["dicription"]?></textarea>
					</div>
                </div>
				
				<div class="form-group row">
					<label for="price" class="col-3 col-form-label">Hình ảnh:</label>
					<div class="col-9">
						<input type="text" class="form-control col-9" name="image" id="image" value="<?php echo $product["image"]?>">
					</div>
                </div>
                <div class="form-group row">
					<label for="price" class="col-3 col-form-label">Banner:</label>
					<div class="col-9">
						<input type="text" class="form-control col-9" name="bannerproduct" id="bannerproduct" value="<?php echo $product["bannerproduct"]?>">
					</div>
                </div>
                <div class="form-group row">
					<label for="price" class="col-3 col-form-label">Key word:</label>
					<div class="col-9">
						<input type="text" class="form-control col-9" name="keyword" id="keyword" value="<?php echo $product["keyWord"]?>">
					</div>
                </div>

                <div class="row">
                  <div class="col-12 text-c">
                    <button name="submit"type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                  </div>
                </div>
              </form>
	</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>