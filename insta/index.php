<?php
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

		$code = $_SESSION['code'];
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
	}

	function curldata($urlcurl, $data = array())
	{
		$curlinsta = curl_init();

		if (!empty($data))
		{
			$options = array(CURLOPT_URL => $urlcurl, CURLOPT_HEADER => FALSE, CURLOPT_RETURNTRANSFER => TRUE, CURLOPT_POSTFIELDS => $data);
		}
		else
		{
			$options = array(CURLOPT_URL => $urlcurl, CURLOPT_HEADER => FALSE, CURLOPT_RETURNTRANSFER => TRUE);
		}
		curl_setopt_array($curlinsta, $options);

		$result = curl_exec($curlinsta);
		curl_close($curlinsta);

		if (curl_errno($curlinsta))
			die("Error: 0x000CRL. Contact administrator.");

		$jsonresult = json_decode($result, TRUE);
		return $jsonresult;
	}

	if (!isset($code))
		include_once 'login.php';

	if (!empty($accesstoken))
	{
		$curlreturn = curldata("https://api.instagram.com/v1/users/self/?access_token={$accesstoken}");
		print_r($curlreturn);

		session_destroy();
		$_SESSION = array();
	}