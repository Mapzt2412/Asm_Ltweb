<?php
// Connect database
$serverName = 'localhost';
$userName   = 'root';
$password   = 'root';
$dbName     = 'bekokun';
	
try {
	$db       = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
}
catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}