<?php

include_once 'LibraryManager.php';
include_once 'HtmlPage.php';

class BootstrapPage extends HtmlPage {
    private $container;
    private $row = array();
    private $col = array();
    public function __construct($webpageTitle,$use_CDN) {
        parent::__construct($webpageTitle);
        if($use_CDN == false)
        {
        parent::addcss(getbootstrapcss());
        parent::addtoheadscript(getjquery());
        parent::addtoheadscript(getbootstrapjs());
        }
        else
        {
        parent::addcss("http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css");
        parent::addtoheadscript("https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js");
        parent::addtoheadscript("http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js");  
        }
    }
    function add_to_conatiner($cont)
    {
       $ret=' <div class="container">'.$cont.'</div>';
       parent::addtobody($ret);
    }
    public function load_module($name, $param ,$values) {
        if(file_exists("./modules/$name/$name.php"))
        {
            include_once "./modules/$name/$name.php";
            if(function_exists($name))
            {
                $ret = call_user_func($name, $param ,$values);
                
                
                if($ret != FALSE)
                {
                    if($ret['ui'] == 'false')
                    {
                    $t_js = explode(",", $ret['js']);
                    $t_css = explode(",", $ret['css']);
                    
                    foreach ($t_css as $value) {
                        if($value != NULL)
                            {
                             parent::addcss("./modules/$name/$value");
                            }
                    }
                    foreach ($t_js as $value) {
                        if($value != NULL)
                            {
                            parent::addtoheadscript("./modules/$name/$value");
                            }
                    }
                    }
                    else
                    {
                        
                        $t_js = explode(",", $ret['js']);
                        $t_css = explode(",", $ret['css']);
                        foreach ($t_css as $value) {
                            if($value != NULL)
                            {
                            parent::addcss("./modules/$name/$value");
                            }
                        }
                        foreach ($t_js as $value) {
                            if($value != NULL)
                            {
                            parent::addtoheadscript("./modules/$name/$value");
                            }
                        }
                         
                         
                        //adding ui
                        $ui_path = $ret['ui_path'];
                        if(file_exists("./modules/$name/$ui_path.php"))
                        {
                        include_once "./modules/$name/$ui_path.php";
                            if(function_exists("$ui_path"))
                            {
                                $ui_con = call_user_func("$ui_path",$values);
                                return $ui_con;
                            }
                        }
                        
                    }
                }
            }
        }
    }
     
     
   
    
}
class BootstrapRow 
{
    private $col = array();
    function  add_colum($content)
    {
        $col = "<div class='row'>$content</div>";
        array_push($this->col, $col);
    }
    function get_coloums()
    {
        return $this->col;
    }
}
class BootstrapColoum
{
    private $col = '';
    function create_coloum($type,$content)     
    {
        return "<div class='$type'>$content</div>";
    }
}

class BootstrapContainer
{
    
    function create_container($rows)
    {
        $start ="<div class='container'>";
        $content = "" ;
        foreach ($rows as $value) {
            $content = $content.$value;
        }
        $stop = "</div>";
        return $start.$content.$stop;
        
    }
}
