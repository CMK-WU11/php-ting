<?php
require_once("db.php");

$stmt = $conn->prepare("SELECT * FROM cheeses");
$stmt->execute();

$results = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="da">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ostebiks</title>
</head>
<body>
	<?php
		foreach($results as $result) {
			echo "<h2>$result[name]</h2>";
			echo "<p>Pris: DKK $result[price]</p>";
			echo "<img src='$result[image]' alt=''>";
		}
	?>
</body>
</html>