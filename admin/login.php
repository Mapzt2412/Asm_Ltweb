<?php
         require_once("functions.php");
         session_start();
         $message="";
         if(isset($_POST["login"])){
             $tk = $_POST["name"];
             $mk = md5($_POST["password"]);
             $row = login($tk,$mk);
             if(isset($row['id'])){
                 $_SESSION["loged"] = true;
                 $_SESSION["id"] = $row['id'];
                 $_SESSION["fullname"] = $row['full_Name'];
                 header("location:admin.php");
             }
             else{
                 $message = "Tên đăng nhập hoặc mật khẩu không đúng";
             }
         }
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="/ASM/css/regiter.css">
    <title>Login/Register</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="header">
		<div class="header-main">
		    <h1>Đăng Nhập </h1>
			<div class="header-bottom">
                <div class="header-left-bottom agileinfo">
                        <form action="#" method="post">
                        <input type="text"  value="User name" name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User name';}"/>
                        <input type="password"  value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"/>
                        <font color="#f3f3f3">
                            <div class="message"><?php if($message!="") { echo $message; } ?></div>   
                        </font>
                        <div class="remember">
                            <span class="checkbox1">
                                  <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>Remember me </label>
                            </span>
                            <div class="forgot">
                                <h6><a href="#">Forgot Password?</a></h6>
                            </div>
                           <div class="clear"> </div>
                         </div>
                           <input name="login" type="submit" value="Đăng nhập">
                       </form>	
                   </div>
				</div>
			</div>
        </div>
    
</div>
	</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/ASM/js/login.js"></script>
</body>
</html>