<?php
require_once("db.php");

if (!empty($_POST)) {
	$cols = "username, password, salt";
	$values = ":username, :password, :salt";
	$stmt = $conn->prepare("INSERT INTO users ($cols) VALUES($values)");
	$stmt->bindParam(":username", $_POST["username"]);

	$salt = bin2hex(random_bytes(16));
	$hash = password_hash($_POST["password"] . $salt, PASSWORD_BCRYPT);

	$stmt->bindParam(":password", $hash);
	$stmt->bindParam(":salt", $salt);

	try {
		$stmt->execute();
		echo "Du er nu oprettet som bruger. Tillykke med fødselsdagen og god julepåske!";
	} catch (PDOException $error) {
		echo "Noget gik galt, prøv igen.";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrer en ny bruger</title>
</head>
<body>
	<h2>Registrer en ny bruger</h2>
	<form action="" method="POST">
		<div>
			<label>
				Brugernavn
				<input type="email" name="username">
			</label>
		</div>
		<div>
			<label>
				Adgangskode
				<input type="password" name="password">
			</label>
		</div>
		<button type="submit">Opret bruger</button>
	</form>
</body>
</html>