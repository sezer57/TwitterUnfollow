<html>

<head>
</head>
<body class="text-center">

<?php
require __DIR__ . '/xampp/vendor/autoload.php';
use Curl\Curl;
error_reporting(E_ERROR | E_WARNING | E_PARSE);

class get_flowing{
  //  public $nextusers;
    public $get_flow;
    public $id;
    function __construct($id)
    {      $this->id=$id;
        $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
        $curl = new Curl();
        $curl->setHeader('Authorization',"Bearer $bearer");
        $curl->setHeader('X-Csrf-Token',"$_COOKIE[csrf]");
        $curl->setHeader('Cookie',"ct0=$_COOKIE[csrf];auth_token=$_COOKIE[auth]");
        $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
        $curl->get("https://twitter.com/i/api/graphql/mIwX8GogcobVlRwlgpHNYA/Following?variables=%7B%22userId%22%3A%22$this->id%22%2C%22count%22%3A100%2C%22includePromotedContent%22%3Afalse%2C%22withSuperFollowsUserFields%22%3Atrue%2C%22withDownvotePerspective%22%3Afalse%2C%22withReactionsMetadata%22%3Afalse%2C%22withReactionsPerspective%22%3Afalse%2C%22withSuperFollowsTweetFields%22%3Atrue%2C%22__fs_dont_mention_me_view_api_enabled%22%3Afalse%2C%22__fs_interactive_text_enabled%22%3Afalse%2C%22__fs_responsive_web_uc_gql_enabled%22%3Afalse%7D");

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {

        }
        $get_flow=$curl->getResponse();
        $this->get_flow=$get_flow;


    }
    function nextuser($nextusers,$a,$unf){
        $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
        $curl = new Curl();
        $curl->setHeader('Authorization',"Bearer $bearer");
        $curl->setHeader('X-Csrf-Token',"$_COOKIE[csrf]");
        $curl->setHeader('Cookie',"ct0=$_COOKIE[csrf];auth_token=$_COOKIE[auth]");
        $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
        $curl->get("https://twitter.com/i/api/graphql/mIwX8GogcobVlRwlgpHNYA/Following?variables=%7b%22userId%22%3a%22$this->id%22%2c%22count%22%3a100%2c%22cursor%22%3a%22$nextusers%22%2c%22includePromotedContent%22%3afalse%2c%22withSuperFollowsUserFields%22%3atrue%2c%22withDownvotePerspective%22%3afalse%2c%22withReactionsMetadata%22%3afalse%2c%22withReactionsPerspective%22%3afalse%2c%22withSuperFollowsTweetFields%22%3atrue%2c%22__fs_dont_mention_me_view_api_enabled%22%3afalse%2c%22__fs_interactive_text_enabled%22%3afalse%2c%22__fs_responsive_web_uc_gql_enabled%22%3afalse%7d");

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {

        }

        $get_flow=$curl->getResponse();
        $i=$a;
        $unf=$unf;
        $c=1;
        $d=-2;
        while(true){
            if($get_flow->data->user->result->timeline->timeline->instructions[$d]->type=='TimelineAddEntries'){
                break;}
            else {$d++;}
        }
        while(isset($get_flow->data->user->result->timeline->timeline->instructions[$d]->entries[$c]->content->itemContent)){
            $unf_list=$get_flow->data->user->result->timeline->timeline->instructions[$d]->entries[$c]->content->itemContent->user_results->result->legacy->followed_by;
            $username = $get_flow->data->user->result->timeline->timeline->instructions[$d]->entries[$c]->content->itemContent->user_results->result->legacy->screen_name;
            $name = $get_flow->data->user->result->timeline->timeline->instructions[$d]->entries[$c]->content->itemContent->user_results->result->legacy->name;
            $pimg=$get_flow->data->user->result->timeline->timeline->instructions[$d]->entries[$c]->content->itemContent->user_results->result->legacy->profile_image_url_https;
            if($unf_list==0){
                echo  "<tr>";
                echo "<td>$unf</td>";
                echo "<td><a href='https://twitter.com/$username'>@$username</a></td>";
                echo "<td>$name</td>";
                echo  "<td><img src='$pimg' alt='Avatar' class='avatar'></td>";
                echo "<td>  <button class='flw' type='button' value='$username' onclick='f1(this)' >Unfollow</button>";
                echo "</tr>";
                $i++;
                $unf++;



            }
            else{

            }
            $c++;

        }
        $nextusers=$get_flow->data->user->result->timeline->timeline->instructions[$d]->entries[$c]->content->value;
        if($nextusers[0]==0){

        }else{

            $nextusers=str_replace("|","%7c",$nextusers);
          $this->nextuser($nextusers,$i,$unf);

        }




    }
}



$id= "$_COOKIE[uid]";

$a=new get_flowing("$id");

$get_flow=$a->get_flow;
?>
</body>
</html>