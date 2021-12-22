<?php
	require_once("init.php");
	/* Đăng nhập */
	function login($name, $pass) {
		global $db;
		$stmt = $db->query("select * from customer where user_name = '$name' and pass_Word ='$pass'");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Đăng ký */
	function signup($name, $username, $pass) {
		global $db;
		$stmt = $db->prepare("INSERT INTO customer (full_Name, user_Name, pass_Word) VALUES (?, ?,?)");
		$stmt->execute(array($name, $username, $pass));
		return $db->lastInsertId();
	}
	/* Đếm số lượng phần tử trong bảng product */
	function getCountProductByCategory($category) {
		global $db;
		$stmt = $db->query("SELECT count(id) as count FROM product WHERE category like '$category';");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Tổng số tin tức */
	function getCountProductByNews() {
		global $db;
		$stmt = $db->query("SELECT count(id) as total from news");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Bình luận */
	function cmt($rate, $productID, $userId , $cmt) {
		global $db;
		$stmt = $db->prepare("INSERT INTO cmt (rate, productID, userId,cmt) VALUES (?, ?, ?, ?)");
		$stmt->execute(array($rate, $productID, $userId, $cmt));
		return $db->lastInsertId();
	}
	/* Tìm người dùng thông qua ID */
	function getUserById($id) {
		global $db;
		$stmt = $db->query("select * from customer where id = '$id'");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Tính trung bình rate */
	function avgRate($id) {
		global $db;
		$stmt = $db->query("select * from cmt where productId = '$id'");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy bình luận */
	function getCmtById($id) {
		global $db;
		$stmt = $db->query("select * from cmt where productId = '$id' limit 5;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy bình luận */
	function getCmtById1($id) {
		global $db;
		$stmt = $db->query("select * from cmt where productId = '$id' limit 5,50;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	function rateOfUser($id , $userID) {
		global $db;
		$stmt = $db->query("select rate from cmt where productId = '$id' and userId = '$userID'");
		return $stmt;
	}
	/* Tìm sản phẩm theo ID */
	function getProductById($id) {
		global $db;
		$stmt = $db->query("SELECT * FROM product WHERE id = $id");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Lấy 2 truyện độc quyền dữ liệu trong bảng product */
	function getTop2Product() {
		global $db;
		$name = "%Truyện độc quyền%";
		$stmt = $db->query("SELECT * FROM product WHERE category like '$name' LIMIT 2 ;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 3 truyện dữ liệu trong bảng product */
	function getTop3Product() {
		global $db;
		$stmt = $db->query("SELECT * FROM product ORDER BY id DESC LIMIT 3;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 1 banner dữ liệu trong bảng product */
	function getTop1Product() {
		global $db;
		$stmt = $db->query("SELECT * FROM product where bannerproduct is not null AND bannerproduct != '' ORDER BY id DESC");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Lấy 5 banner dữ liệu trong bảng product */
	function getTop5Product() {
		global $db;
		$stmt = $db->query("SELECT * FROM product where bannerproduct is not null AND bannerproduct != '' ORDER BY id DESC LIMIT 5;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 4 product từ trên xuống */
	function getTop4Product($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product where category like '%$category%' ORDER BY id DESC LIMIT 4;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 4 product từ dưới lên */
	function getTop4AProduct($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product where category like '%$category%' ORDER BY id ASC LIMIT 4;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu theo quantity trong bảng product */
	function getTop12Product() {
		global $db;
		$stmt = $db->query("SELECT * FROM product ORDER BY quantity DESC LIMIT 12;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



	/* Lấy 12 dữ liệu trong bảng product */
	function getTop12ProductCategory($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' LIMIT 0,12;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu trong bảng product */
	function getTop12ProductCategory1($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' LIMIT 12,50;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu trong bảng product theo topseller */
	function getTop12ProductCategorytopseller($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' order by quantity LIMIT 0,12;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu trong bảng product theo topseller*/
	function getTop12ProductCategorytopseller1($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' order by quantity LIMIT 12,50;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu trong bảng product theo latest */
	function getTop12ProductCategorylatest($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' order by id DESC LIMIT 0,12;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu trong bảng product theo latest*/
	function getTop12ProductCategorylatest1($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' order by id DESC LIMIT 12,50;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu trong bảng product theo highprice */
	function getTop12ProductCategoryhighprice($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' order by price DESC LIMIT 0,12;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu trong bảng product theo highprice*/
	function getTop12ProductCategoryhighprice1($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' order by price DESC LIMIT 12,50;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
		/* Lấy 12 dữ liệu trong bảng product theo lowprice */
	function getTop12ProductCategorylowprice($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' order by price ASC LIMIT 0,12;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy 12 dữ liệu trong bảng product theo lowprice*/
	function getTop12ProductCategorylowprice1($category) {
		global $db;
		$stmt = $db->query("SELECT * FROM product Where category like '%$category%' order by price ASC LIMIT 12,50;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	/* Lấy tin tức */
	function getNews($start , $limit) {
		global $db;
		$stmt = $db->query("SELECT * FROM news ORDER BY id DESC LIMIT $start, $limit");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/* Lấy 6 dữ liệu trong bảng product */
	function getTop4ProductLastest() {
		global $db;
		$stmt = $db->query("SELECT * FROM product order by id DESC LIMIT 4;");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/* Contact */
	function contact($name, $email, $phoneNumber, $content) {
		global $db;
		$stmt = $db->prepare("INSERT INTO contact (customerName, customerEmail, phoneNumber,content) VALUES (?, ?,?,?)");
		$stmt->execute(array($name, $email, $phoneNumber,$content));
		return $db->lastInsertId();
	}



	function updateUser($fullname, $email, $phonenumber, $birtDay, $sex , $address,$id) {
		global $db;
		$stmt = $db->prepare("UPDATE customer SET full_Name = ?, email=?, phoneNum=?,birtday=?, sex=?, address=?, time_update=CURRENT_TIMESTAMP WHERE id=?");
		$stmt->execute(array($fullname, $email, $phonenumber,$birtDay,$sex, $address,$id));
		return $db->lastInsertId();
	}
	/*thay avatar */
	function updateAvatar($avatar,$id) {
		global $db;
		$stmt = $db->prepare("UPDATE customer set avatar= ? where id=?");
		$stmt->execute(array($avatar,$id));
		return $db->lastInsertId();
	}

	/* Thêm sản phẩm vào giỏ hàng */
	function addCart($userID, $productId, $quantily) {
		global $db;
		$stmt = $db->prepare("INSERT INTO cart (userId, productId, quantily) VALUES (?, ?,?)");
		$stmt->execute(array($userID, $productId, $quantily));
		return $db->lastInsertId();
	}

	
	/* Lấy tất cả dữ liệu trong bảng Cars */
	function getCartById($id) {
		global $db;
		$stmt = $db->query("SELECT userId,productId, count(productId) as quantily from cart where userId = '$id' group by userId,productId;	");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	function getQuantilyProduct($id) {
		global $db;
		$stmt = $db->query("SELECT count(DISTINCT productId) as quantily from cart where userId = '$id';");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function deleteCart($id,$productID) {
		global $db;
		$stmt = $db->query("DELETE FROM cart WHERE userId = '$id' AND productId = '$productID';");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/* Lấy tất cả dữ liệu trong bảng Cars */
	function search($search) {
		global $db;
		$stmt = $db->query("SELECT * FROM product where title like'%$search%' OR infor_Item like '%$search%' OR infor_author like '%$search%' OR keyWord like '%$search%' OR code like '%$search%' OR category like '%$search%';");
		return $stmt->fetchALL(PDO::FETCH_ASSOC);
	}
	
	function searchCount($search) {
		global $db;
		$stmt = $db->query("SELECT count(*) as count FROM product where title like'%$search%' OR infor_Item like '%$search%' OR infor_author like '%$search%' OR keyWord like '%$search%' OR code like '%$search%' OR category like '%$search%';");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function updateQuantity($id,$quantity){
		global $db;
		$stmt = $db->prepare("UPDATE product set quantity = quantity + ? where id = ?;");
		$stmt->execute(array($quantity,$id));
		return $db->lastInsertId();
	}

	/* Thêm sản phẩm orders */
	function addorders($customername, $address, $phoneNumner, $productName, $productQuantily, $status) {
		global $db;
		$stmt = $db->prepare("INSERT INTO orders (customerName, address, phoneNumner,productName,productQuantily,status) VALUES (?, ?,?,?,?,?)");
		$stmt->execute(array($customername, $address, $phoneNumner, $productName, $productQuantily, $status));
		return $db->lastInsertId();
	}
