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
        <a href="https://www.facebook.com/search/{id}/photos-by{time}">Picture</a>
    </div>
    <div>
        <a href="https://www.facebook.com/search/{target}/{gender}/{age}/{relationship}/{id}/{subject}-commented{time}/intersect">Likes</a>
    </div>
</body>
</html>

