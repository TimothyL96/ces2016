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

		$caccesstoken = curl_init();
		$options = array(
			CURLOPT_URL => $urlaccesstoken,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data
		);
		curl_setopt_array($caccesstoken, $options);

		$result = curl_exec($caccesstoken);
		curl_close($caccesstoken);

		if (curl_errno($caccesstoken))
			die("Error: 0x0000TK. Contact administrator.");

		$jsonresult = json_decode($result, TRUE);

		$accesstoken = $jsonresult['access_token'];
	}
	if (!isset($code))
		include_once 'login.php';
	if (isset($accesstoken))
		echo 'set';
?>