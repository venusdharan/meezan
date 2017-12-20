<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 
if(isset($_GET['module']))
{
    if($_GET['module'] != '')
    {
        $module_name = $_GET['module'];
        if(is_dir("../modules/$module_name/js")=== true && is_dir("../modules/$module_name/css")=== true )
        {
            if((count(scandir("../modules/$module_name/js")) > 2) && (count(scandir("../modules/$module_name/css")) > 2))
            {
                       $data = array("view" => "ok",
                       "js" =>array(array_diff(scandir("../modules/$module_name/js"), array('.', '..'))),
                       "css" =>array(array_diff(scandir("../modules/$module_name/css"), array('.', '..')))
                       );
                       echo json_encode($data);
                       exit();
            }
        }
        if(is_dir("../modules/$module_name/js")=== true  && is_dir("../modules/$module_name/css")=== false)
        {
            if(count(scandir("../modules/$module_name/js")) > 2) 
            {
                       $data = array("view" => "ok",
                       "js" =>array(array_diff(scandir("../modules/$module_name/js"), array('.', '..'))),
                       "css" =>array()
                       );
                       //echo json_encode($data);
                      
                       print_r(array_diff(scandir("../modules/$module_name/js"), array('.', '..')));
                       exit();
            }
        }
        if(is_dir("../modules/$module_name/js")=== false && is_dir("../modules/$module_name/css")=== true )
        {
            if(count(scandir("../modules/$module_name/css")) > 2)
            {
                       $data = array("view" => "ok",
                       "js" =>array(),
                       "css" =>array(array_diff(scandir("../modules/$module_name/css"), array('.', '..')))
                       );
                       echo json_encode($data);
                       exit();
            }
        }
    }
}
*/

if(isset($_GET['module']) && isset($_GET['sub_module']))
{
    if($_GET['module'] != '')
    {
        $module_name = $_GET['module'];
        if($_GET['sub_module'] != ''){$sub_module = $_GET['sub_module'];}else{$sub_module =  $module_name;}
       
        if(file_exists("../modules/$module_name/$sub_module.json"))
        {
            $json = file_get_contents("../modules/$module_name/$sub_module.json");
            echo $json;
            exit();
        }
        else
        {
          //  echo 'hello';
            exit();
        }
    }
}
           
           
           
           
           

