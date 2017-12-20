<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetListner
 *
 * @author Triophore-2
 */
class GetListner {
    var $get_vales = array();
    function __construct() {
        if(count($_GET) > 0)
        {
       
        $this->get_vales = $_GET;
        }
    }
    function get_post_value($key)
    {
        if($key != "")
        {
        if(isset($this->get_vales[$key]))
        {
            return  $this->get_vales[$key];
        }
        }
    }
    function get_post_values()
    {
        
    }
}
