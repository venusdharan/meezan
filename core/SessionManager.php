<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionManager
 *
 * @author sunior
 */
class SessionManager {
    function __construct() {
        if(session_id() == '') {
            session_start();
        }
    }
    function encode_session($json)
    {
        $json1 = base64_encode($json);  //e
        $json2 = base64_encode(strrev($json1)); //r e
        $json3 = strrev(base64_encode($json2));  //e r
        $json4 = base64_encode(strrev($json3));  //r e
        return	$json5 = strrev(base64_encode($json4));  //e r
    }
    function decode_session($json)
    {
        $json1 = base64_decode(strrev($json));
        $json2 = strrev(base64_decode($json1));
        $json3 = base64_decode(strrev($json2));
        $json4 =strrev(base64_decode($json3));
        return base64_decode($json4);
    }
    function get_session_data($key)
    {
        if(count($_SESSION) > 0)
        {
            foreach($_SESSION as $key => $value)
            {
                    //echo $key.$value;
                    if($key == "$key")
                    {
                    return  $value ;
                    }

            }
            return NULL;
        }
        return NULL;
    }
    function get_session_datas($keys)
    {
        
    }
    
}
