<?php
	if (isset($_GET['code']))
	{
		require 'config.php';

		$code = $_GET['code'];
		$urlaccesstoken = "https://api.instagram.com/oauth/access_token";

		//$data = "client_id={$clientID}&client_secret={$clientSecret}&grant_type=authorization_code&redirect_uri={$clientRedirect}&code={$code}";

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

		echo 'passed   22222 ';
		$result = curl_exec($accesstoken);
		curl_close($accesstoken);

		echo 'passed3';
		if (curl_errno($accesstoken))
			die("Error: 0x0000TK. Contact administrator.");

		echo 'passed4';
		echo 'error : ' . curl_error($accesstoken);
		print_r($result);
	}
	if (!isset($code))
		include_once 'login.php';
?>