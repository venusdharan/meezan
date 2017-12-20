<?php
/**
 * An HtmlPage class
 *
 * The HtmlPage class is an extended class of basic HtmlPage class.
 *
 * @package    Asterda
 * @subpackage Common
 * @author     Venu S Dharan <venusdharan@gmail.com>
 */
class HtmlPage {
    
    private $title ;
    private $body_cont = array();
    private $body_script = array();
    private $head_script = array();
    private $css = array();
    private $meta = array();
    private $favicon = null;
    function __construct($webpageTitle) {
        $this->title = $webpageTitle;
    }
    /**
    * Adds a new meta data
    *
    * @param meta tag as string
    * @return null
    */
    function addmeta($meta)
    {   if($meta != "")
        {
          array_push($this->meta, $meta);
        }
    }
    /*
    function load_module($name,$param,$values)
    {
        if(file_exists("./modules/$name/$name.php"))
        {
            include_once "./modules/$name/$name.php";
            if(function_exists($name))
            {
                $ret = call_user_func($name, $param);
                
                
                if($ret != FALSE)
                {
                    $t_js = $ret['js'];
                    $t_css = $ret['css'];
                    foreach ($t_css as $value) {
                        $this->addcss("./modules/$name/$value");
                    }
                    foreach ($t_js as $value) {
                        $this->addtoheadscript("./modules/$name/$value");
                    }
                    if($ret['ui'] == 'true')
                    {
                    
                        $t_js = $ret['js'];
                        $t_css = $ret['css'];
                        foreach ($t_css as $value) {
                            $this->addcss("./modules/$name/$value");
                        }
                        foreach ($t_js as $value) {
                            $this->addtoheadscript("./modules/$name/$value");
                        }
                        //adding ui
                        $ui_path = $ret['ui_path'];
                        if(file_exists("./modules/$name/$ui_path.php"))
                        {
                        include_once "./modules/$name/$ui_path.php";
                            if(function_exists("$ui_path"))
                            {
                                $ui_con = call_user_func("$ui_path",$values);
                                $this->addtobody($ui_con);
                            }
                        }
                        
                    }
                }
            }
        }
    }
     
     */
    function addtobody($object)
    {
        if($object != "")
        {
        array_push($this->body_cont, $object);
        }
    }
    function addcss($cssname)
    {
        if($cssname != "")
        {
        array_push($this->css, $cssname);
        }
    }
    function addtoheadscript($object)
    {
        if($object != "")
        {
        array_push($this->head_script, $object);
        }
    }
    function getpage()
    {
        if($this->favicon != null)
        {
          $this->favicon = "<link rel='shortcut icon' href='assets/images/favicon/$this->favicon.ico' type='image/x-icon'>"; 
        }   
        $bodyc = null;
        
        foreach ($this->body_cont as $value) {
            $bodyc = $bodyc.$value;
        }
        $hscript = null;
        
        foreach ($this->head_script as $value) {
            $hscript = $hscript. "<script src='$value' type=text/javascript ></script>"."\n";
        }
        $css = null;

        foreach ($this->css as $value) {
            $css = $css."<link href='$value' type='text/css' rel='stylesheet'>"."\n";
        }
       
        $meta = NULL;
        
        foreach ($this->meta as $value) {
            $meta = $meta."<meta $value>"."\n";
        }
         
       
$page = "<html>
        <head>
        $meta
        $css
        $hscript
        <title>$this->title</title>
        </head>
        <body>
        $bodyc
        </body>
        </html>";
echo $page;
    }
}
