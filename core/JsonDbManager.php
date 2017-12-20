<?php
/*
 * This Clas helps to create and use simple text files to use as database
 * Using the Json encode and decode methods to store data in text files
 * This class is not intented to use for storing large data or as a replacement for a complete database
 * 
 */
class JsonDbManager
{
    var $json_loaded = array();
    var $path = null;
    function __construct($path) {
        $this->path = $path;
    }
    function create_entry($name,$value)
    {
     $home_settings_file = fopen("$this->path/$name.pif", "w+") or die("Unable to open file!");
     fwrite($home_settings_file, $value);
     fclose($home_settings_file);
    }
    function append_entry($name,$key,$value)
    {
        if(file_exists("$this->path/$name.pif"))
        {
        $myfile = fopen("$this->path/$name.pif", "r") or die("Unable to open file!");
        $temp = fread($myfile,filesize("$this->path/$name.pif"));
        $json_loaded = json_decode($temp,true);       
        fclose($myfile);
        return true;
        }
        else {return false;}
    }
    function load_entry($name)
    {
        if(file_exists("$this->path/$name.pif"))
        {
        $myfile = fopen("$this->path/$name.pif", "r") or die("Unable to open file!");
        $temp = fread($myfile,filesize("$this->path/$name.pif"));
        $this->json_loaded = json_decode($temp,true);
        fclose($myfile);
        return true;
        }
        else {return false;}
    }
    function get_entry($name)
    {
        if(isset($this->json_loaded["$name"]))
        {
            return $this->json_loaded["$name"];
        }
        else
        {
            return NULL;
        }
    }
    
}

