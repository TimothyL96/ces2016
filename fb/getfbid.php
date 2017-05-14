<?php
    if ($_GET['a'] == 1)
    {
        echo $_SERVER['REQUEST_URI'];
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    if (isset($_POST['submit']) && !empty($_POST['fbusername']))
    {
        $username = $_POST['fbusername'];

        $pos_profileid = strpos($username, "profile.php?id=");
        if ($pos_profileid !== FALSE)
        {
            $id = substr($username, $pos_profileid + 15, 0);
            echo 'ID already exist: ' . $id;
            exit();
        }

        $pos_facebookcom = strpos($username, "facebook.com");
        if ($pos_facebookcom !== FALSE)
        {
            $username = substr($username, $pos_facebookcom + 13, 0);
            echo $username;
            exit();
        }

        $pos_fbcom = strpos($username, "fb.com");
        if ($pos_fbcom !== FALSE)
        {
            $username = substr($username, $pos_fbcom + 7, 0);
            echo $username;
            exit();
        }

        $link = "https://www.facebook.com/";
        $url = $link . $username;

        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_POST, false );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36");
        curl_setopt( $ch, CURLOPT_HEADER, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $source = curl_exec( $ch );

        $pos_entity = strpos($source, '"entity_id"');
        $source_cut = substr($source, $pos_entity);

        $pos_curly = strpos($source_cut, "}");
        $source_cut = substr($source_cut, 0, $pos_curly);

        $source_cut = '{' . $source_cut . '}';
        $dataarray = json_decode($source_cut, TRUE);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <h2>Get Facebook ID from username v3.02</h2>
    </head>
    <body>
        <form action="getfbid.php?a=1" method="post">
            <input type="text" name="fbusername" placeholder="Enter FB username or profile URL here:" width="50px"/>
            <input type="submit" name="submit" value="Find ID" />
        </form>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready( function()
            {
                if (<?= (!empty($dataarray)?1:0); ?>)
                {
                    alert("<?= $dataarray['entity_id']; ?>");
                }
            });
        </script>
    </body>
</html>
