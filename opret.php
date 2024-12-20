<?php
if (!$_COOKIE["cheese_id"]) {
	header("location: login.php");
}

require_once("db.php");

if (!empty($_POST)) {

	$targetDir = "images/";
	$targetFile = $targetDir . basename($_FILES["image"]["name"]);
	$uploadOk = true;
	$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

	if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
		$uploadOk = false;
	}

	if ($uploadOk == false) {
		echo "Nope, din fil er dum!";
	} else {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
			header("location: cheeses.php");
		} else {
			echo "Filen blev ikke uploadet.";
		}
	}

	$cols = "name, price, weight, description, sku, stock, taste, image";
	$values = ":name, :price, :weight, :description, :sku, :stock, :taste, :image";

	$stmt = $conn->prepare("INSERT INTO cheeses ($cols) VALUES($values)");
	$stmt->bindParam(":name", $_POST["name"]);
	$stmt->bindParam(":price", $_POST["price"]);
	$stmt->bindParam(":weight", $_POST["weight"]);
	$stmt->bindParam(":description", $_POST["description"]);
	$stmt->bindParam(":sku", $_POST["sku"]);
	$stmt->bindParam(":stock", $_POST["stock"]);
	$stmt->bindParam(":taste", $_POST["taste"]);
	$stmt->bindParam(":image", $targetFile);

	$stmt->execute();
	$result = $stmt->fetchAll();
	echo $result;
}
?>
<!DOCTYPE html>
<html lang="da">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Opret ny ost</title>
</head>
<body>
	<h2>Opret ny ost</h2>
	<form action="" method="POST" enctype="multipart/form-data">
		<div>
			<label>
				Navn
				<input type="text" name="name">
			</label>
		</div>
		<div>
			<label>
				Pris
				<input type="number" name="price">
			</label>
		</div>
		<div>
			<label>
				Vægt (i gram)
				<input type="number" name="weight">
			</label>
		</div>
		<div>
			<label>
				Varenummer
				<input type="text" name="sku">
			</label>
		</div>
		<div>
			<label>
				Lagerbeholdning
				<input type="number" name="stock">
			</label>
		</div>
		<div>
			<label>
				Beskrivelse
				<textarea name="description"></textarea>
			</label>
		</div>
		<div>
			<label>
				Smag
				<select name="taste">
					<option value="stærk">Stærk</option>
					<option value="mild">Mild</option>
					<option value="sød">Sød</option>
					<option value="salt">Salt</option>
				</select>
			</label>
		</div>
		<div>
			<label>
				Billede
				<input type="file" name="image">
			</label>
		</div>
		<button type="submit">Opret</button>
	</form>
</body>
</html>