<?php
	if (isset($_GET['code']))
	{
		require 'config.php';

		$code = $_GET['code'];
		$urlaccesstoken = "https://api.instagram.com/oauth/access_token";
		$urlaccesstoken .= '?';
		$urlaccesstoken .= "client_id={$clientID}&";
		$urlaccesstoken .= "client_secret={$clientSecret}&";
		$urlaccesstoken .= "grant_type=authorization_code&";
		$urlaccesstoken .= "code={$code}";

		$accesstoken = curl_init();
		$options = array(
			CURLOPT_URL => $urlaccesstoken,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
		);
		curl_setopt_array($ch, $options);

		$result = curl_exec($accesstoken);
		curl_close($accesstoken);

		if (curl_errno($accesstoken))
			die("Error: 0x0000TK. Contact administrator.");

		print_r($result);
	}
	if (!isset($code))
		include_once 'login.php';
?>