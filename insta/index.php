<?php
	session_start();

	if (empty($accesstoken) && !empty($_SESSION['accesstoken']))
		$accesstoken = $_SESSION['accesstoken'];

	if (empty($code) && !empty($_SESSION['code']))
		$code = $_SESSION['code'];

	if (isset($_GET['code']))
	{
		$_SESSION['code'] = $_GET['code'];
		$url = strtok($_SERVER["REQUEST_URI"], '?');
		header("Location: {$url}");
		exit();
	}
	else if (isset($_SESSION['code']) && empty($accesstoken))
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
		$_SESSION['accesstoken'] = $accesstoken;
		$userid = $curlreturn['user']['id'];
		$username = $curlreturn['user']['username'];
		$userprofilepic = $curlreturn['user']['profile_picture'];
		$userfullname = $curlreturn['user']['full_name'];
		$userbio = $curlreturn['user']['bio'];
		$userwebsite = $curlreturn['user']['website'];
	}
	else if (isset($_POST['finduser']))
	{
		$curlreturn = curldata("https://api.instagram.com/v1/users/259220806/?access_token={$accesstoken}");
		echo '<pre>';
		print_r($curlreturn);
		echo '</pre>';
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

	}else if (isset($_POST['logout']))
	{
		session_destroy();
		$_SESSION = array();
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

	function owndata()
	{
		$curlreturn = curldata("https://api.instagram.com/v1/users/self/?access_token={$accesstoken}");
		print_r($curlreturn);
		$owndatareturn[] = $curlreturn['data']['counts']['media'];
		$owndatareturn[] = $curlreturn['data']['counts']['follows'];
		$owndatareturn[] = $curlreturn['data']['counts']['followed_by'];
		return $owndatareturn;
	}

	if (!isset($code))
	{
		include_once 'login.php';
	}
	else if (!empty($accesstoken))
	{
		$owndatareturn = owndata();
		$usermedia = $owndatareturn[0];
		$userfollows = $owndatareturn[1];
		$userfollower = $owndatareturn[2];

		include_once 'insta.php';
	}