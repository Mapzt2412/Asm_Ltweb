
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
<?php
        require_once("functions.php");
		if(isset($_POST["signup"])){
			$user_name = $_POST["username"];
			$pass1 = $_POST["password"];
			$pass2 = $_POST["retypepassword"];
			$name = $_POST["fullname"];
			//kiểm tra xem 2 mật khẩu có giống nhau hay không:
			if($pass1 != $pass2){
				header("location: login.php");
				setcookie("error", "Đăng ký không thành công!", time()+1, "/","", 0);
			}
			else{
				$pass = md5($pass1);
                signup($name,$user_name,$pass);
				header("location:login.php");
				setcookie("success", "Đăng ký thành công!", time()+1, "/","", 0);
			}
		}

	?>
 <div class="header">
		<div class="header-main">
		       <h1>Đăng ký</h1>
			<div class="header-bottom">
				<div class="header-right w3agile">
					<div class="header-left-bottom agileinfo">
					 <form action="" method="post">
						<input type="text"  name="fullname" placeholder="Họ và tên"/>
						<input type="text"  name="username" placeholder="Tên đăng nhập"/>
						<input type="password"  name="password" placeholder="Mặt khẩu"/>
						<input type="password"   name="retypepassword" placeholder="Nhập lại mật khẩu"/>
						<div class="remember">
						<div class="clear"> </div>
					  </div>
						<input name="signup" type="submit" value="Đăng ký">
					</form>	
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