<?php
$use_auth = true;
$default = "/dashboard";
$routes = array(
   "dashboard" => array(
    "ops"  => "dashboard",
    "auth" => "true",
    "post" => "true"
   ),
    "login"=>array(
        "ops"=>'login',
        "auth" => "false",
        "post" => "true"
    ),
    "docs"=>array(
        "ops"=>'docs',
        "auth" => "false" 
    ),
    "logout"=>array(
        "ops"=>'logout',
        "auth" => "false" 
    ),
    "file"=>array(
        "ops"=>'file',
        "auth" => "true" 
    )
    
);






