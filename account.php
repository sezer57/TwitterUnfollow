
<?php
require __DIR__ . '/xampp/vendor/autoload.php';

use Curl\Curl;

class cookie{
    public $cookie;
    function __construct()
    {
        $curl = new Curl();
        $curl->get('https://twitter.com/i/js_inst?c_name=ui_metrics');
        $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $get_cookie = $curl->responseCookies;
            $key = '_twitter_sess';
            $a = $get_cookie[$key];

            $this->cookie=$a;
        }
    }
}

class quest{
    public $quest;
    public $cookie;

    function __construct($cookie)
    {
        $this->cookie=$cookie;
        $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
        $curl = new Curl();
        $curl->setHeader('Authorization',"Bearer $bearer");
        $curl->setHeader('Cookie',"_twitter_sess=$cookie");
        $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
        $curl->post('https://api.twitter.com/1.1/guest/activate.json');
        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $get_quest = $curl->getResponse();
             $a=$get_quest->guest_token;
            $this->quest=$a;


        }
    }
}

class flowtoken{
     public $quest;
    public $cookie;
    public $flowtoken;

    function __construct($quest,$cookie)
    {

        $this->quest=$quest;
        $this->cookie=$cookie;
        $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
        $curl = new Curl();
        $curl->setHeader('Authorization',"Bearer $bearer");
        $curl->setHeader('Cookie',"_twitter_sess=$cookie");
        $curl->setHeader('X-Guest-Token',"$quest");
        $curl->setHeader('Content-Type','application/json');
        $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
        $curl->post('https://twitter.com/i/api/1.1/onboarding/task.json?flow_name=login');
        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $get_flow = $curl->getResponse();

             $a=$get_flow->flow_token;
             $this->flowtoken=$a;



        }
    }
}

class flowtoken_use{
    public $quest;
    public $cookie;
    public $flowtoken;
    public $flowtoken_use;

    function __construct($flowtoken,$quest,$cookie)
    {
        $this->quest=$quest;
        $this->cookie=$cookie;
        $this->flowtoken=$flowtoken;

        $data = [
            "flow_token" => "$flowtoken",
            "subtask_inputs" => [
                [
                    "subtask_id" => "LoginJsInstrumentationSubtask",
                    "js_instrumentation" => [
                        "response" =>' "{"rf":{"cfa8e4957878574a19e31f3bc80ede904e48fc2f6af130fda9a901d12e54a67a":-4,"afab06065b661a6ff66ced1306c94a9e26eb9aec7324f2f920f876940c23d734":98,"a3df27ef06e3f55a88b12d385dee32b7fe5c87e03fe94a19c50376e04c0919c6":168,"a29d4467f97cf31f58a58aec15ee4f8a3b378838cc35cfa3ea5493973d338e11":248},"s":"DHStmb7kX5ZjsCt2qs2iQY4Tf03tFsXu5NlaV82e_nSvKmU0sdFFkgbR_1XmbA7X9kle2Q8m74jOuhUuKxKzEWS0QU-AP9i6lD66Z1lwPqPu-Fy3E0WkU4jeBNnn2Xx-XeTcfTo1FU4bqoQ-F7p8gJbnu2nvfxsfGPYZf4VZ4tyajcySaaoXiKtQJajXUC5Wg7lneOIHhuo9bE9cLy2KYeX10irgqR4tbadDOWaaLTHk9zuaycJsHi2eZOcrJfF5m8RmG_Ecw_YV4y-wtU3cwjIu7uvIj4EAp016FgAWgyIiOIGsSwxaaJa_4advXXweTjgtxByELJZkFAiBYxAbDAAAAX9F0DPC"}"',
               "link" => "next_link"
            ]
         ]
      ]
];

        $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
        $curl = new Curl();
        $curl->setHeader('Authorization',"Bearer $bearer");
        $curl->setHeader('Cookie',"_twitter_sess=$cookie");
        $curl->setHeader('X-Guest-Token',"$quest");
        $curl->setHeader('Content-Type','application/json');
        $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
        $curl->post('https://twitter.com/i/api/1.1/onboarding/task.json',$data);
        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $get_flow = $curl->getResponse();

            $a=$get_flow->flow_token;

            $this->flowtoken_use=$a;


        }
    }


}

class email{
    public $quest;
    public $cookie;
    public $flowtoken_use;
    public $status;

    function __construct($flowtoken_use,$quest,$cookie)
    {
        $this->flowtoken_use=$flowtoken_use;
        $this->quest=$quest;
        $this->cookie=$cookie;
        $usermail=$_POST["inputEmail"];
        $data = [
            "flow_token" => "$flowtoken_use",
            "subtask_inputs" => [
                [
                    "subtask_id" => "LoginEnterUserIdentifierSSOSubtask",
                    "settings_list" => [
                        "setting_responses" => [
                            [
                                "key" => "user_identifier",
                                "response_data" => [
                                    "text_data" => [
                                        "result" => "$usermail"
                                    ]
                                ]
                            ]
                        ],
                        "link" => "next_link"
                    ]
                ]
            ]
        ];
        $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
        $curl = new Curl();
        $curl->setHeader('Authorization',"Bearer $bearer");
        $curl->setHeader('Cookie',"_twitter_sess=$cookie");
        $curl->setHeader('X-Guest-Token',"$quest");
        $curl->setHeader('Content-Type','application/json');
        $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
        $curl->post('https://twitter.com/i/api/1.1/onboarding/task.json',$data);
        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $e . "\n";
        } else {
            $get_flow = $curl->getResponse();
            $b=$get_flow->subtasks[0]->subtask_id;
        if("$b"=='LoginEnterAlternateIdentifierSubtask'){
            echo "numara gerekli<br/>";
            $a=false;
            $this->status=$a;
            $c=$get_flow->flow_token;
            $this->flowtoken_use=$c;
            }
        else{
            echo "basarili<br/>";
            $a=true;
            $this->status=$a;
            $g=$get_flow->flow_token;
            $this->flowtoken_use=$g;
        }
    }
}

}

class password{
    public $quest;
    public $cookie;
    public $flowtoken_use;
    public $status;
    public $t;

    public function __construct($status,$flowtoken_use,$quest,$cookie){
        $this->flowtoken_use=$flowtoken_use;
        $this->quest=$quest;
        $this->cookie=$cookie;
        $userpass=$_POST["inputPassword"];
        $usernam=$_POST["inputUsername"];
        if($status==true){
            $data =
                [
                    "flow_token" => "$flowtoken_use",
                    "subtask_inputs" => [
                        [
                            "subtask_id" => "LoginEnterPassword",
                            "enter_password" => [
                                "password" => "$userpass",
                                "link" => "next_link"
                            ]
                        ]
                    ]
            ];
            $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
            $curl = new Curl();
            $curl->setHeader('Authorization',"Bearer $bearer");
            $curl->setHeader('Cookie',"_twitter_sess=$cookie");
            $curl->setHeader('X-Guest-Token',"$quest");
            $curl->setHeader('Content-Type','application/json');
            $curl->setHeader('Referer','https://twitter.com/i/flow/login');
            $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
            $curl->post('https://twitter.com/i/api/1.1/onboarding/task.json',$data);
            if ($curl->error) {
                $get_flow = $curl->getResponse();
                $e=$get_flow->errors[0]->message;
                echo 'Error: ' . $curl->errorCode . ': ' . $e . "\n";
            } else {
                $get_flow = $curl->getResponse();
                $c=$get_flow->flow_token;
                $this->flowtoken_use=$c;

            }
        }

        else {
            $data =  [
                "flow_token" => "$flowtoken_use",
                "subtask_inputs" => [
                    [
                        "subtask_id" => "LoginEnterAlternateIdentifierSubtask",
                        "enter_text" => [
                            "text" => "$usernam",
                            "link" => "next_link"
                        ]
                    ]
                ]
            ];
            $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
            $curl = new Curl();
            $curl->setHeader('Authorization',"Bearer $bearer");
            $curl->setHeader('Cookie',"_twitter_sess=$cookie");
            $curl->setHeader('X-Guest-Token',"$quest");
            $curl->setHeader('Content-Type','application/json');
            $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
            $curl->post('https://twitter.com/i/api/1.1/onboarding/task.json',$data);
            if ($curl->error) {
                echo 'Error: ' . $curl->errorCode . ': ' . "\n";
            } else {
                $get_flow = $curl->getResponse();
                $c=$get_flow->flow_token;
                $flowtoken_use=$c;
                $data =
                    [
                        "flow_token" => "$flowtoken_use",
                        "subtask_inputs" => [
                            [
                                "subtask_id" => "LoginEnterPassword",
                                "enter_password" => [
                                    "password" => "$userpass",
                                    "link" => "next_link"
                                ]
                            ]
                        ]
                    ];
                $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
                $curl1 = new Curl();
                $curl1->setHeader('Authorization',"Bearer $bearer");
                $curl1->setHeader('Cookie',"_twitter_sess=$cookie");
                $curl1->setHeader('X-Guest-Token',"$quest");
                $curl1->setHeader('Content-Type','application/json');
                $curl1->setHeader('Referer','https://twitter.com/i/flow/login');
                $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
                $curl1->post('https://twitter.com/i/api/1.1/onboarding/task.json',$data);
                if ($curl1->error) {
                    $get_flow = $curl1->getResponse();
                    $t=$get_flow->errors[0]->code;
                    $this->t=$t;
                    echo "Error5:   $t YANLIŞ ŞİFRE" ;
                } else {

                    $get_flow = $curl1->getResponse();
                    $e=$get_flow->flow_token;
                    $this->flowtoken_use=$e;



                }

            }
        }
        }

    }

class dublication{
    public $quest;
    public $cookie;
    public $flowtoken_use;
    public $auth;
    public $csrf;
    public $uid;

    function __construct($flowtoken,$quest,$cookie)
    {
        $this->quest=$quest;
        $this->cookie=$cookie;
        $this->flowtoken=$flowtoken;

        $data = [
            "flow_token" => "$flowtoken",
            "subtask_inputs" => [
                [
                    "subtask_id" => "AccountDuplicationCheck",
                    "check_logged_in_account" => [
                        "link" => "AccountDuplicationCheck_false"
                    ]
                ]
            ]
        ];

        $bearer='AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA';
        $curl = new Curl();
        $curl->setHeader('Authorization',"Bearer $bearer");
        $curl->setHeader('Cookie',"_twitter_sess=$cookie");
        $curl->setHeader('X-Guest-Token',"$quest");
        $curl->setHeader('Content-Type','application/json');
        $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
        $curl->post('https://twitter.com/i/api/1.1/onboarding/task.json',$data);
        if ($curl->error) {
            $get_flow=$curl->getResponse();
            print_r($get_flow);
            echo 'Error6: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $get_flow=$curl->getResponseHeaders();
            $a=$get_flow["set-cookie"];
            $a=str_replace(";","&",$a);
            $a=str_replace(",","&",$a);
            parse_str($a);
            $this->auth=$auth_token;
            $this->csrf=$ct0;
            $twid=substr($twid, 3,-1);

            $this->uid=$twid;

            if(isset($a)){


            header("Location: /dashboard/index.php");
            }
        }
    }
}



        function giris(){

            $firts = new cookie();
            $iki = new quest($firts->cookie);
            $uc = new flowtoken("$iki->quest", "$firts->cookie");
            $dort = new flowtoken_use("$uc->flowtoken", "$iki->quest", "$firts->cookie");
            $bes = new email("$dort->flowtoken_use", "$iki->quest", "$firts->cookie");
            $alti = new password("$bes->status", "$bes->flowtoken_use", "$iki->quest", "$firts->cookie");
            $yedi = new dublication("$alti->flowtoken_use", "$alti->quest", "$alti->cookie");

                $expire = 6 * 30 * 24 * 3600;
                $c_uid = setcookie("uid", $yedi->uid, time() + (86400 * 15));
                $c_quest = setcookie("quest", $iki->quest, time() + (86400 * 15));
                $c_auth = setcookie("auth", $yedi->auth, time() + (86400 * 15));
                $c_csrf = setcookie("csrf", $yedi->csrf, time() + (86400 * 15));
                if (($c_auth == true) && ($c_csrf == true) && ($c_quest == true)) {
                    echo "true";
                } else {
                    echo "dsfsdf";
                }



        }





           if(isset($_COOKIE["auth"]) && isset($_COOKIE["quest"]) && isset($_COOKIE["uid"]) && isset($_COOKIE["csrf"])){
                header("Location: /dashboard/index.php");


            }
            else{

               giris();




        }
    ?>




