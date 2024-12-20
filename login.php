<?php
require_once("db.php");

if (!empty($_POST)) {
	$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
	$stmt->bindParam(":username", $_POST["username"]);

	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if (!empty($results)) {
		if (password_verify($_POST["password"] . $results[0]["salt"], $results[0]["password"])) {
			// success, brugernavn OG adgangskode er korrekt
			setCookie("cheese_id", $results[0]["id"], time() + (24 * 60 * 60));
		} else {
			// øv, adgangskoden er IKKE korrekt
			echo "Fejl: Brugernavn eller ADGANGSKODE er forkert. Prøv igen. Du har nu 16.021 forsøg.";
		}
	} else {
		// Der blev IKKE fundet en bruger
		echo "Fejl: BRUGERNAVN eller adgangskode er forkert. Prøv igen. Du har nu 16.021 forsøg.";
	}
}
?>
<!DOCTYPE html>
<html lang="da">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log ind</title>
</head>
<body>
	<h2>Log ind</h2>
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
		<button type="submit">Log ind</button>
	</form>
</body>
</html>