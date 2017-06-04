<?php
	require_once 'api.php';

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
		<form method="GET" action="">
			<input type="submit" name="submit" value="LOGIN Instagram" onclick="<?= loginInsta(); ?>">
		</form>
	</body>
</html>