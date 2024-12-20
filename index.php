<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "flergh";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<script>console.log('Database connection successful :)')</script>";
} catch (PDOException $e) {
	echo "Connection to database failed: " . $e->getMessage();
}

$stmt = $conn->prepare("SELECT * FROM wu11");
$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$results = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="da">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>PDO MySQL</title>
</head>
<body>

	<h1>PDO MySQL</h1>
	<?php
	if (!empty($results)) {
		foreach($results as $result) {
			echo "<p>$result[name], $result[age] år</p>";
		}
	}
	?>
</body>
</html>
