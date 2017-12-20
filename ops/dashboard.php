<?php
if(isset($_POST['load_module']))
{
    if($_POST['load_module'] != "")
    {
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.root.'/core/DBHelper.php';
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.root.'/modules/menu_maker.php';
    }
}

