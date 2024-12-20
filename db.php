<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cheeseshop";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<script>console.log('Database connection successful :)')</script>";
} catch (PDOException $e) {
	echo "<script>console.log('Connection to database failed: " . $e->getMessage() . "')</script>";
}
