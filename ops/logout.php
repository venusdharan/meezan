<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(session_id() == '') {
    session_start();
}
    //remove PHPSESSID from browser
//setcookie('username', '', time()-3600);
//setcookie('password', '', time()-3600);

   setcookie('user_id', '', time()-3600); 

//setcookie('email', '', time()-3600);
    //clear session from globals
    unset($_COOKIE["user_id"]);
    //unset($_COOKIE["email"]);
    //unset($_COOKIE["password"]);
    $_SESSION = array();
    //clear session from disk
    session_destroy();
    //unset($_SESSION['username']);
    //unset($_SESSION['email']);
    //unset($_SESSION['password']);
    unset($_SESSION);
    echo "<script type='text/javascript'> document.cookie = 'user_id=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/'; window.location = 'login';</script> ";

