<?php

if(isset($_COOKIE["auth"]) && isset($_COOKIE["quest"]) && isset($_COOKIE["csrf"]) && isset($_COOKIE["uid"])){
    setcookie('quest', '', time() - 3600,'/');
    setcookie('auth', '', time() - 3600,'/');
    setcookie('csrf', '', time() - 3600,'/');
    setcookie('uid', '', time() - 3600,'/');
    header("Location: /");
    echo "haata";
}
else {
    echo "hata";
}
?>