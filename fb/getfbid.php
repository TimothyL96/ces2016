<?php
    if (isset($_POST['submit']) && !empty($_POST['fbusername']))
    {
        $username = $_POST['fbusername'];
        $link = "https://www.facebook.com/";
        $url = $link . $username;
/*
        $headers = array(
            'https' => array(
                'method' => 'get',
                'follow_location' => true,
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36"
            )
        );
        $context = stream_context_create($headers);
        $source = file_get_contents($url, false, $context);
        var_dump($http_response_header);

        $pos_entity = strpos($source, "\"entity_id\"");
        $source_cut = substr($source, $pos_entity);*/

        //$pos_curly = strpos($source_cut, "}");
        //$source_cut = substr($source_cut, $pos_curly);

       // echo 'Search entity_id result: ' . $pos_entity . "\n";
       // echo "<textarea rows=\"6\" cols=\"50\">";
       // echo $source_cut;
       // echo '</textarea>';

        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_POST, false );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
        curl_setopt( $ch, CURLOPT_HEADER, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $data = curl_exec( $ch );
        echo 'dat: ' . $data;
        echo 'curl error: ' . curl_error($ch);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <h2>Get Facebook ID from username v2.2</h2>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="fbusername" placeholder="Enter FB username here:"/>
            <input type="submit" name="submit" value="Search ID" />
        </form>
    </body>
</html>
