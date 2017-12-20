<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileLister
 *
 * @author sunior
 */
class FileLister {
    private $dir;
    public function __construct($dir) {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '-1'); 
        $this->dir = $dir;
    }
    
    function getallfiles()
    {
        $ffs = scandir($this->dir);
    $ol =  '<ol>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            $ol. '<li>'.$ff;
            if(is_dir($this->dir.'/'.$ff)) $this->getallfiles($this->dir.'/'.$ff);
            $ol. '</li>';
        }
    
    return $ol .'</ol>';
    }
    }
}
