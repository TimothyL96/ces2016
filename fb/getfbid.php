<?php
	if ((!defined("VIEW")))
	{
		header("Refresh: 5; Location: scanner.php");
		echo 'Error 404: Forbidden Page! Redirecting ....';
		exit();
	}

    function getfbid($fburl)
    {
        if (isset($fburl) && !empty($fburl))
        {
            $pos_profileid = strpos($fburl, "profile.php?id=");
            if ($pos_profileid !== FALSE)
            {
                $id = substr($fburl, $pos_profileid + 15);

                return $id;
            }

            $pos_facebookcom = strpos($fburl, "facebook.com");
            if ($pos_facebookcom !== FALSE)
            {
                $fburl = substr($fburl, $pos_facebookcom + 13);
            }

            $pos_fbcom = strpos($fburl, "fb.com");
            if ($pos_fbcom !== FALSE)
            {
                $fburl = substr($fburl, $pos_fbcom + 7);
            }

            $link = "https://www.facebook.com/";
            $url = $link . $fburl;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36");
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $source = curl_exec($ch);

            $pos_entity = strpos($source, '"entity_id"');
            $source_cut = substr($source, $pos_entity);

            $pos_curly = strpos($source_cut, "}");
            $source_cut = substr($source_cut, 0, $pos_curly);
            $source_cut = '{' . $source_cut . '}';

            $dataarray = json_decode($source_cut, TRUE);

            return !empty($dataarray) ? $dataarray['entity_id'] : FALSE;
        }
        else
        {
            return FALSE;
        }
    }