

<?php
require_once __DIR__."/../config.php";
require SITE_ROOT. '/xampp/vendor/autoload.php';

use Curl\Curl;


if(isset($_POST['ss']))
{
    $btnValue = $_POST['ss'];
    $bearer = 'AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
    $curl = new Curl();
    $curl->setHeader('Authorization', "Bearer $bearer");
    $curl->setHeader('X-Csrf-Token', "$_COOKIE[csrf]");
    $curl->setHeader('Cookie', "ct0=$_COOKIE[csrf];auth_token=$_COOKIE[auth]");
    $curl->post("https://api.twitter.com/1.1/friendships/destroy.json?screen_name=$btnValue");
    if ($curl->error) {
        echo 'Error: ' . $btnValue  . ': ' . $curl->errorMessage . "\n";
    } else {
        echo "Success";


    }


}else
{
    echo "asdas";
}


?>
