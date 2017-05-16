<?php
	/**
	 * Created by PhpStorm.
	 * User: Timothy
	 * Date: 16/5/2017
	 * Time: 5:20 PM
	 */
	define("VIEW", TRUE);
	require_once 'getfbid.php';

	if (isset($_POST['submit']))
	{
		$id = getfbid($_POST['fburl']);

		$picurl = "https://www.facebook.com/search/{$id}/photos-by";
		//$picurl = "https://www.facebook.com/search/{$fburl}/photos-by{time}";

        $likesurl = "https://www.facebook.com/search/{$id}/photos-liked/intersect";
        //$likesurl = "https://www.facebook.com/search/{age}/{target}/{relationship}/{gender}/{id}/photos-liked{time}/intersect";

        $friendsurl = "https://www.facebook.com/search/{$id}/friends/intersect";
        //$friendsurl = "https://www.facebook.com/search/{age}/{gender}/{relationship}/{id}/friends/intersect";

		$tag_photourl = "https://www.facebook.com/search/{$id}/photos-of/intersect";
		//"https://www.facebook.com/search/{target}/{gender}/{age}/{relationship}/{id}/photos-of{time}/intersect";

        $tag_videourl = "https://www.facebook.com/search/{$id}/videos-of/intersect";
        //$tag_videourl = "https://www.facebook.com/search/{target}/{gender}/{age}/{relationship}/{id}/videos-of{time}/intersect";

        $tag_storyurl = "https://www.facebook.com/search/{$id}/stories-tagged/intersect";
        //"https://www.facebook.com/search/{target}/{gender}/{age}/{relationship}/{id}/stories-tagged{time}/intersect";
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Facebook Profile Scanner</title>
    <h1>
        Scanner v1.2
    </h1>
</head>
<body style="text-align: center;">
    <form action="" method="post">
        <input type="text" placeholder="Profile URL" name="fburl">
        <input type="submit" name="submit" value="Submit"/>
    </form>
    <div name="fburldisplay">
        <p>Facebook ID<?= (isset($id))? ' Found: ' . $id: ': None'?></p>
    </div>
    <div>
        <a href="<?= (isset($picurl))? $picurl: ''?>">Picture</a>
    </div>
    <div>
        <a href="<?= (isset($likesurl))? $likesurl: ''?>">Likes</a>
    </div>
    <div>
        <a href="<?= (isset($friendsurl))? $friendsurl: ''?>">Friends</a>
    </div>
    <div>
        <a href="<?= (isset($tag_photourl))? $tag_photourl: ''?>">Photos Tagged</a>
    </div>
    <div>
        <a href="<?= (isset($tag_videourl))? $tag_videourl: ''?>">Videos Tagged</a>
    </div>
    <div>
        <a href="<?= (isset($tag_storyurl))? $tag_storyurl: ''?>">Stories Tagged</a>
    </div>
</body>
</html>

