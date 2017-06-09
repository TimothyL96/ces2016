<?php
	/**
	 * Created by PhpStorm.
	 * User: Timothy
	 * Date: 09/6/2017
	 * Time: 3:05 PM
	 */

	$url = "http://www.o2olr.com/shoplist2.php?cat=all&country=1&id=all";

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, FALSE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36");
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$source = curl_exec($ch);

	echo $source;