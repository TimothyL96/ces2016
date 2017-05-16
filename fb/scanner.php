<?php
	/**
	 * Created by PhpStorm.
	 * User: Timothy
	 * Date: 16/5/2017
	 * Time: 5:20 PM
	 */
	require_once 'getfbid.php';
	if (isset($_POST['submit']))
	{
		$fburl = getfbid($_POST['fburl']);

		$picurl = "https://www.facebook.com/search/{$fburl}/photos-by";
		//$picurl = "https://www.facebook.com/search/{$fburl}/photos-by{time}";

        $likesurl = "https://www.facebook.com/search/{$fburl}/photos-liked/intersect";
        //$likesurl = "https://www.facebook.com/search/{age}/{target}/{relationship}/{gender}/{id}/photos-liked{time}/intersect";
	}
?>
<!DOCTYPE html>
<html>
<head>
    <h1>
        Scanner v1.0
    </h1>
</head>
<body>
    <form action="" method="post">
        <input type="text" placeholder="Profile URL" name="fburl">
        <input type="submit" name="submit" value="Submit"/>
    </form>
    <div name="fburldisplay">
        <p><?= (isset($fburl))? $fburl: 'None'?></p>
    </div>
    <div>
        <a href="<?= (isset($picurl))? $picurl: ''?>">Picture</a>
    </div>
    <div>
        <a href="<?= (isset($likesurl))? $likesurl: ''?>">Likes</a>
    </div>
</body>
</html>

