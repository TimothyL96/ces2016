<?php
	session_destroy();
	session_start();
	if (isset($_GET['code']))
	{
		$_SESSION['code'] = $_GET['code'];
		$url = strtok($_SERVER["REQUEST_URI"], '?');
		header("Location: {$url}");
		exit();
	}
	if (isset($_SESSION['code']))
	{
		require 'config.php';

		$code = isset($_SESSION['code']);
		$data = [
			'client_id' => $clientID,
			'client_secret' => $clientSecret,
			'grant_type' => 'authorization_code',
			'redirect_uri' => $clientRedirect,
			'code' => $code
		];

		$curlreturn = curldata("https://api.instagram.com/oauth/access_token", $data);

		$accesstoken = $curlreturn['access_token'];
		$userid = $curlreturn['user']['id'];
		$username = $curlreturn['user']['username'];
		$userprofilepic = $curlreturn['user']['profile_picture'];
		$userfullname = $curlreturn['user']['full_name'];
		$userbio = $curlreturn['user']['bio'];
		$userwebsite = $curlreturn['user']['website'];

		echo "access token : " . $accesstoken . "\n" . $userid . "\n" . $username . "\n" . $userprofilepic . "\n";
	}

	if (!isset($code))
		include_once 'login.php';

	if (!empty($accesstoken))
	{
		//$curlreturn = curldata("https://api.instagram.com/v1/users/self/?access_token={$accesstoken}");

		echo 'accses token not empty!\r\n';
		$urlcurl = "https://api.instagram.com/v1/users/self/?access_token={$accesstoken}";
		$curlinsta = curl_init();
		$options = array(
			CURLOPT_URL => $urlcurl,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data
		);
		curl_setopt_array($curlinsta, $options);

		$result = curl_exec($curlinsta);
		curl_close($curlinsta);

		if (curl_errno($curlinsta))
			die("Error: 0x000CRL. Contact administrator.");

		$jsonresult = json_decode($result, TRUE);

		print_r($jsonresult);
		session_destroy();
	}

	function curldata($urlcurl, $data = array())
	{
		$curlinsta = curl_init();
		$options = array(
			CURLOPT_URL => $urlcurl,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data
		);
		curl_setopt_array($curlinsta, $options);

		$result = curl_exec($curlinsta);
		curl_close($curlinsta);

		if (curl_errno($curlinsta))
			die("Error: 0x000CRL. Contact administrator.");

		$jsonresult = json_decode($result, TRUE);
		return $jsonresult;
	}