<?php


class AuthenticationManager {
    
    public function __construct() {
        if(session_id() == '') {
            session_start();
        }
    }
    //put your code here
    function checkauthentication()
    {
        $auth = false;
        if(isset($_COOKIE['user']))
        {
            
        }
        return $auth;
    }
    
    function login()
    {
        
    }
    
    function logout()
    {
        
    }
}
