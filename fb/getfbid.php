<?php
    if (isset($_POST['submit']) || !empty($_POST['fbusername']))
    {
        $username = $_POST['fbusername'];
        $link = "https://www.facebook.com/";
        $url = $link . $username;

        $headers = array(
            'https' => array(
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36"
            )
        );
        $context = stream_context_create($headers);
        $source = file_get_contents($url, false, $context);

        /*$pos_entity = strpos($source, "\"entity_id\"");
        $source_cut = substr($source, $pos_entity);

        $pos_curly = strpos($source_cut, "}");
        $source_cut = substr($source_cut, $pos_curly);

        echo $source_cut;*/
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <h2>Get Facebook ID from username</h2>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="fbusername" placeholder="Enter FB username here:"/>
            <input type="submit" name="submit" value="Search ID" />
        </form>
    </body>
</html>
