<?php
if(!isset($_POST['ops']))
{
   exit(); 
}
$ops = $_POST['ops'];
if($ops === '')
{
    exit();
}
if(!isset($_POST['data']))
{
    exit();
}
$data = $_POST['data'];
if($data == '')
{
    exit();
}

include_once $_SERVER['DOCUMENT_ROOT']."/triophore/core/DBHelper.php";
