<?php
	if (isset($_GET['code']))
	{
		require 'config.php';

		$code = $_GET['code'];
		$urlaccesstoken = "https://api.instagram.com/oauth/access_token";

		$data = [
			'client_id' => $clientID,
			'client_secret' => $clientSecret,
			'grant_type' => 'authorization_code',
			'redirect_uri' => $clientRedirect,
			'code' => $code
		];

		$accesstoken = curl_init();
		$options = array(
			CURLOPT_URL => $urlaccesstoken,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data
		);
		curl_setopt_array($accesstoken, $options);

		$result = curl_exec($accesstoken);
		curl_close($accesstoken);

		if (curl_errno($accesstoken))
			die("Error: 0x0000TK. Contact administrator.");

		$jsonresult = json_decode($result);
		print_r($jsonresult);
	}
	if (!isset($code))
		include_once 'login.php';
?>