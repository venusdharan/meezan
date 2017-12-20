<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResourceLoader
 *
 * @author Triophore-2
 */
class ResourceLoader {
    
    static function get_js($path,$full_root)
    {
        echo "<script src='".$full_root.$path."'></script>";
    }

    static function get_css($path,$full_r)
    {
        echo "<link rel='stylesheet' href='".$full_r.$path."'>";
    }
    
}
