<?php

class ModuleLoader {
    private $name;
    private $param;
    private $js = array();
    private $css = array();
    private $view;
    function load_module($module_name,$param ,$values)
    {
        $this->name = $module_name;
        $this->param = $param;
        if(file_exists("./modules/$this->name/$this->name.php"))
        {
            include_once "./modules/$this->name/$this->name.php";
            if(function_exists($this->name))
            {
                $ret = call_user_func($this->name, $param);
                
                
                if($ret != FALSE)
                {
                    if($ret['ui'] == 'false')
                    {
                    $t_js = explode(",", $ret['js']);
                    $t_css = explode(",", $ret['css']);
                    
                    foreach ($t_css as $value) {
                        if($value != NULL)
                            {
                            array_push($this->css,"./modules/$this->name/$value");
                            }
                    }
                    foreach ($t_js as $value) {
                        if($value != NULL)
                            {
                            array_push($this->js,"./modules/$this->name/$value");
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
                            array_push($this->css,"./modules/$this->name/$value");
                            }
                        }
                        foreach ($t_js as $value) {
                            if($value != NULL)
                            {
                            array_push($this->js,"./modules/$this->name/$value");
                            }
                        }
                         
                         
                        //adding ui
                        $ui_path = $ret['ui_path'];
                        if(file_exists("./modules/$this->name/$ui_path.php"))
                        {
                        include_once "./modules/$this->name/$ui_path.php";
                            if(function_exists("$ui_path"))
                            {
                                $ui_con = call_user_func("$ui_path",$values);
                                $this->view =  $ui_con;
                            }
                        }
                        
                    }
                }
            }
        }
    }
    function get_view()
    {
        return $this->view;
    }
    function get_controller_js()
    {
        return $this->js;
    }
    function get_controller_css()
    {
        return $this->css;
    }

}
