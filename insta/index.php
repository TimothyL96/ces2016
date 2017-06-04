<?php
	session_start();

	if (isset($_GET['code']))
	{
		$_SESSION['code'] = $_GET['code'];
		$url = strtok($_SERVER["REQUEST_URI"], '?');
		header("Location: {$url}");
		exit();
	}
	else if (isset($_SESSION['code']))
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
	else if (isset($_POST['finduser']))
	{
		echo 'find user set';
	}
	else if (isset($_POST['recentmedia']))
	{
		echo 'recent media set';
	}
	else if (isset($_POST['recentmediauser']))
	{
		echo 'recent media user set';
	}
	else if (isset($_POST['recentlikes']))
	{

	}
	else if (isset($_POST['searchuser']))
	{

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
	else if (!empty($accesstoken))
	{
		$curlreturn = curldata("https://api.instagram.com/v1/users/self/?access_token={$accesstoken}");
		$usermedia = $curlreturn['data']['counts']['media'];
		$userfollows = $curlreturn['data']['counts']['follows'];
		$userfollower = $curlreturn['data']['counts']['followed_by'];

		include_once 'insta.php';

		session_destroy();
		$_SESSION = array();
	}