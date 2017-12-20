<?php

class NavigationManager {
    private $home;
    public function __construct($home) {
        $this->home = $home;
    }
    function navigate()
    {
        if(count($_GET) > 0)
        {
        foreach($_GET as $key => $value)
        {
                //echo $key.$value;
                if($key == 'page')
                {
                    include_once './config/Settings.php';
                    include_once "./$web_default_page_location/$value.php";
                }
                if($key == 'error')
                {
                    //echo $value;
                }
        }
        }
        else
        {
             include_once './config/Settings.php';
             include_once "./$web_default_page_location/$this->home.php";
        }
    }
}
