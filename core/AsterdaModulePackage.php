<?php

class  AsterdaModulePackage {
    var $mpath = null;
    var $name = null;
    var $schema_arr = array();
    public function __construct() {
                
    }
    
    function load_module($path,$name)
    {
        $this->mpath = $path;
        $this->name = $name;
        $filename = $this->mpath. DIRECTORY_SEPARATOR . $this->name . DIRECTORY_SEPARATOR . "info.json";
        if(file_exists($filename))
        {
            if($myfile = fopen("$filename", "r"))
            {
            $temp = fread($myfile,filesize("$filename"));
            $this->schema_arr = json_decode($temp,true);
            fclose($myfile);
            return true;
            }
            else {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    function get_author()
    {
        if(isset($this->schema_arr["author"]))
        {
            return $this->schema_arr["author"];
        }
        else
        {
            return "";
        }
    }
    
    function get_url()
    {
        if(isset($this->schema_arr["url"]))
        {
            return $this->schema_arr["url"];
        }
        else
        {
            return "";
        }
    }
    
    function get_dependencies()
    {
        if(isset($this->schema_arr["dependencies"]))
        {
            return $this->schema_arr["dependencies"];
        }
        else
        {
            return "";
        }
    }
    
    function get_description()
    {
        if(isset($this->schema_arr["description"]))
        {
            return $this->schema_arr["description"];
        }
        else
        {
            return "";
        }
    }
    
    function get_name()
    {
        if(isset($this->schema_arr["name"]))
        {
            return $this->schema_arr["name"];
        }
        else
        {
            return "";
        }
    }
    
    function get_version()
    {
         if(isset($this->schema_arr["version"]))
        {
            return $this->schema_arr["version"];
        }
        else
        {
            return "";
        }
    }
    
    function get_license()
    {
         if(isset($this->schema_arr["license"]))
        {
            return $this->schema_arr["license"];
        }
        else
        {
            return "";
        }
    }
    
    
    
}

