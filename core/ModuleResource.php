<?php

class ModuleResource{
    private $name = '';
    private $basemain = '';
    private $js = array();
    private $css = array();
    private $basecss = '';
    private $basejs = '';
    function __construct($name) {
        $this->name = $name;
    }
    
    function AddJs($name)
    {
        array_push($this->js, $name);
    }
    
    function AddCss($name)
    {
        array_push($this->css, $name);
    }
    
    function AddMain($name)
    {
        $this->basemain = $name;
    }
    
    function AddBaseJS($name)
    {
        $this->basejs = $name;
    }
    
    function AddBaseCss($name)
    {
        $this->basecss = $name;
    }
    
    function GetResource()
    {
        $data = array(
            'name' => $this->name,
            'basejs' => $this->basejs,
            'basecss' => $this->basecss,
            'basemain' => $this->basemain,
            'js' => $this->js,
            'css' => $this->css
        );
        
        echo json_encode($data);
    }
}

