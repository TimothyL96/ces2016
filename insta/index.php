<?php
	if (isset($_GET['code']))
	{
		require 'config.php';

		$code = $_GET['code'];
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
		$userid = $curlreturn['user']['username'];
		$userid = $curlreturn['user']['profile_picture'];
		$userid = $curlreturn['user']['full_name'];
		$userid = $curlreturn['user']['bio'];
		$userid = $curlreturn['user']['website'];
	}

	function curldata($urlcurl = "", $data = array())
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

	if (!isset($code))
		include_once 'login.php';

	if (!empty($accesstoken))
	{
		$curlreturn = curldata("https://api.instagram.com/v1/users/self/?access_token={$accesstoken}");
		print_r($curlreturn);
	}