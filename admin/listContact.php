<?php 
    session_start();
    require_once("functions.php");
    $row = getCountContact();
    $total_records = $row["total"];
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 10;
    $total_page = ceil($total_records / $limit);
    if ($current_page > $total_page){
        $current_page = $total_page;
    }
    else if ($current_page < 1){
        $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
    $result1 = getContact($start,$limit);
    if(isset($_GET["delete"])){
        deleteContact($_GET["delete"]);
        header("Location:listContact.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách liên hệ</title>

    <link type="text/css" rel="stylesheet" href="/ASM/css/admin.css">
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
                  <a class="nav-link" href="admin.php">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="listNews.php">Danh sách tin tức</a>
                </li>
                <li class="nav-item active">
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
    <table class="table">
            <thead>
                <tr>
                <th scope="col">Tương tác</th>
                <th scope="col">ID</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Nội dung</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($result1 as $result1): ?>
                <tr>
                <td>
                <a href="listContact.php?delete=<?php echo $result1["id"]?>"class="nav-link"> Xóa</a>
                </td>
                <td><?php echo $result1["id"]?></td>
                <td><?php echo $result1["customerName"]?></td>
                <td><?php echo $result1["customerEmail"]?></td>
                <td>0<?php echo $result1["phoneNumber"]?></td>
                <td><?php echo $result1["content"]?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
            </table>
                <ul class="pagination justify-content-end">
                        <li class="page-item "><a class="page-link" href="listNews.php?page=<?php echo $current_page-1; ?>">Previous</a></li>
                        <?php 
                            for($i = 0; $i<  $total_page ; $i++){
                        ?>
                        <li class="page-item "><a class="page-link" href="listNews.php?page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
                        <?php } ?>
                        <li class="page-item"><a class="page-link" href="listNews.php?page=<?php echo $current_page+1; ?>">Next</a></li>
                    </ul>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>