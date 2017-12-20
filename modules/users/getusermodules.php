<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//$dirs = array_filter(glob('*'), 'is_dir');

$u = $_GET['u'];

$username = $_SESSION['username'];

if($username == ""){exit();} //$_SERVER['DOCUMENT_ROOT'].'/'.root.
include_once $_SERVER['DOCUMENT_ROOT'].'/'.'triophore'."/config/FrameworkSettings.php" ;
include_once $_SERVER['DOCUMENT_ROOT'].'/'.root.'/core/DBHelper.php';

//$u = $username;
if($username != "")
{
    
    
    $datas1 = $database->select("module_users", "module",["username" => $u]);
    //echo count($datas1);
    /*
    $datas = $database->select("modules", "name" );
    $datasm = array_diff($datas, array('users', 'home'));
    $m = array();
    $int = array_diff($datasm,$datas1);
    foreach($int as $key => $value){
        array_push($m, $value);
    }
     * 
     */
    echo json_encode( $datas1);
   
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


