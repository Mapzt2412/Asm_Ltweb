<?php
	require_once("init.php");
	/* Đăng nhập */
	function login($name, $pass) {
		global $db;
		$stmt = $db->query("select * from admin where user_name = '$name' and pass_Word ='$pass'");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Lấy tất cả sản phẩm*/
	function searchCount() {
		global $db;
		$stmt = $db->query("SELECT * FROM product");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy số lượng tin tức*/
	function getCountNews() {
		global $db;
		$stmt = $db->query("SELECT count(id) as total from news");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Lấy số lượng contact*/
	function getCountContact() {
		global $db;
		$stmt = $db->query("SELECT count(id) as total from contact");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/* Lấy số lượng orders*/
	function getCountOrders() {
		global $db;
		$stmt = $db->query("SELECT count(id) as total from orders");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Xóa order */
	function deleteOrder($productID) {
		global $db;
		$stmt = $db->query("DELETE FROM Orders WHERE id = '$productID';");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/* Lấy orders */
	function getOrders($start , $limit) {
		global $db;
		$stmt = $db->query("SELECT * FROM orders LIMIT $start, $limit");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy contact */
	function getContact($start , $limit) {
		global $db;
		$stmt = $db->query("SELECT * FROM contact LIMIT $start, $limit");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Xóa contact */
	function deleteContact($productID) {
		global $db;
		$stmt = $db->query("DELETE FROM contact WHERE id = '$productID';");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/* Tổng sản phẩm */
	function getCountProduct() {
		global $db;
		$stmt = $db->query("SELECT count(id) as total from product");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Lấy sản phẩm */
	function getProduct($start , $limit) {
		global $db;
		$stmt = $db->query("SELECT * FROM product LIMIT $start, $limit");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Lấy tin tức */
	function getNews($start , $limit) {
		global $db;
		$stmt = $db->query("SELECT * FROM news LIMIT $start, $limit");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/* Xóa sản phẩm */
	function deleteCart($productID) {
		global $db;
		$stmt = $db->query("DELETE FROM product WHERE id = '$productID';");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Xóa Tin tức */
	function deleteNews($newsId) {
		global $db;
		$stmt = $db->query("DELETE FROM news WHERE id = '$newsId';");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/* Tìm sản phẩm theo ID */
	function getProductById($id) {
		global $db;
		$stmt = $db->query("SELECT * FROM product WHERE id = $id");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/* Tìm tin tức theo ID */
	function getNewsById($id) {
		global $db;
		$stmt = $db->query("SELECT * FROM news WHERE id = $id");
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/* Update product */
	function updateProduct($id,$title, $author, $price, $code, $category , $infor_Item,$dicription,$image,$bannerproduct,$keyword) {
		global $db;
		$stmt = $db->prepare("UPDATE product SET title = ?, price=?, code=?,category=?, dicription=?,infor_Item=?, infor_author=?, image=?, bannerproduct=?, keyword=? WHERE id=?");
		$stmt->execute(array($title, $price, $code,$category, $dicription,$infor_Item,$author,$image,$bannerproduct,$keyword,$id));
		return $db->lastInsertId();
	}
	/* Thêm sản phẩm */
	function addProduct($title, $author, $price, $code, $category , $infor_Item,$dicription,$image,$bannerproduct,$keyword) {
		global $db;
		$stmt = $db->prepare("INSERT INTO product (title, price, code,category,dicription,infor_Item,infor_author,image,bannerproduct,keyword) VALUES (?, ?,?,?,?,?,?,?,?,?)");
		$stmt->execute(array($title, $price, $code,$category, $dicription,$infor_Item,$author,$image,$bannerproduct,$keyword));
		return $db->lastInsertId();
	}

	/* Thêm tin tức */
	function addNews($imageUrl, $url, $category, $note) {
		global $db;
		$stmt = $db->prepare("INSERT INTO news (imageUrl, url,category,note) VALUES (?, ?,?,?)");
		$stmt->execute(array($imageUrl, $url,$category, $note));
		return $db->lastInsertId();
	}
	/* Update tin tức */
	function updateNews($id,$imageUrl, $url, $category, $note) {
		global $db;
		$stmt = $db->prepare("UPDATE news SET imageUrl=?,url=?,category=?,note=? where id=?");
		$stmt->execute(array($imageUrl, $url,$category, $note , $id));
		return $db->lastInsertId();
	}