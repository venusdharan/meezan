<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FragmentLoader
 *
 * @author Triophore-2
 */
class FragmentLoader {
    function load_fragment($fragment_name,$param)
    {
        if(file_exists("./modules/$this->name/$this->name.php"))
        {
            include_once "./modules/$this->name/$this->name.php";
            if(function_exists($this->name))
            {
                $ret = call_user_func($this->name, $param);
            }
            return $ret;
        }
    
    }
}
