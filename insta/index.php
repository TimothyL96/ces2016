<?php
	if (isset($_GET['code']))
	{
		$code = $_GET['code'];
		echo $code;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Instagram API TEST</title>
	</head>
	<body>
		<form method="POST" action="api.php">
			<input type="submit" name="login" value="LOGIN Instagram"">
		</form>
	</body>
</html>