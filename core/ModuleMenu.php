<?php

class ModuleMenu {
    var $label;
    var $multi;
    var $sunmenu = array();
    var $icon;
    function __construct($label,$icon,$multilevel = false) {
        $this->label = $label;
        $this->multi = $multilevel;
        $this->icon = $icon;
    }
    
    function AddSubMenu($submenu)
    {
        array_push($this->sunmenu, $submenu);
    }
    
    function GetLink()
    {
        $item = '';
        foreach($this->sunmenu as $vale)
        {
            $item = $item . $vale;
        }
        $menu_full = "<li class='treeview'>
            <a href='#'><i class='$this->icon'></i>$this->label
                  <span class='pull-right-container'>
                    <i class='fa fa-angle-left pull-right'></i>
                  </span>
            </a>
            <ul class='treeview-menu' style='display: block;'>
                $item
            </ul>
          </li>";
        
        return $menu_full;
    }
   
}

class SubMenu {
    
}

class SingleMenu{
    
    var $link = array();
    function __construct($data_path,$data_sub_path,$icon,$label) {
        $link = "<li><a href='#' data-path='$data_path' data-sub-path='$data_sub_path' ><i class='$icon'></i>$label</a></li>"; 
        array_push($this->link, $link);
    }
    public function AddMenuItem($data_path,$data_sub_path,$icon,$label)
    {
        $link = "<li><a href='#' data-path='$data_path' data-sub-path='$data_sub_path' ><i class='$icon'></i>$label</a></li>"; 
        array_push($this->link, $link);
    }
    public function GetLink()
    {
       $end_link = "";
       foreach($this->link as $val)
       {
           $end_link = $end_link . $val;
           
       }
       return $end_link;
    }
}