<?php
	if (isset($_GET['code']))
		$code = $_GET['code'];

	if (!isset($code))
		include_once 'login.php';
?>