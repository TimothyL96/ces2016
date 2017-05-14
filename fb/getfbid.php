<?php
    if (isset($_POST['submit']))
    {
        $username = $_POST['fbusername'];
        $link = "https://www.facebook.com/";
        $url = $link . $username;

        $source = file_get_contents($url);

        $pos_entity = strpos($source, "\"entity_id\"");
        $source_cut = substr($source, $pos_entity);

        $pos_curly = strpos($source_cut, "}");
        $source_cut = substr($source_cut, $pos_curly);

        echo $source_cut;
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
