<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//$dirs = array_filter(glob('*'), 'is_dir');


$username = $_SESSION['username'];

if($username == ""){exit();} //$_SERVER['DOCUMENT_ROOT'].'/'.root.
include_once $_SERVER['DOCUMENT_ROOT'].'/'.'triophore'."/config/FrameworkSettings.php" ;
include_once $_SERVER['DOCUMENT_ROOT'].'/'.root.'/core/DBHelper.php';

if($username != "")
{
    
    
    $datas1 = $database->select("modules", ["name","view_name"],[
           
        "valid" => '1'
    ]);
    //echo count($datas1);
    
    echo json_encode($datas1);
   
}
/*
foreach ($dirs as $value) {
    if(file_exists("$value/nav.php"))
    {
    include_once "$value/nav.php";
    $nav = $nav . $menu;
    }
}
 * *
 */


