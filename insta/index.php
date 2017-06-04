<?php
	if (isset($_GET['code']))
		$code = $_GET['code'];

	if (isset($_GET['code']))
		echo $code;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Instagram API TEST</title>
	</head>
	<body>
		<form method="GET" action="api.php">
			<input type="submit" name="login" value="LOGIN Instagram"">
		</form>
	</body>
</html>