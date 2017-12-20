<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//$dirs = array_filter(glob('*'), 'is_dir');

$pu = $_POST['uname'];

$username = $_SESSION['username'];

if($username == ""){exit();} //$_SERVER['DOCUMENT_ROOT'].'/'.root.
include_once $_SERVER['DOCUMENT_ROOT'].'/'.'triophore'."/config/FrameworkSettings.php" ;
include_once $_SERVER['DOCUMENT_ROOT'].'/'.root.'/core/DBHelper.php';


if($username != "")
{
    $datas = $database->select("module_users", "*" ,[
	"username" => $pu
    ]);
    $m = array();
    foreach($datas as $data)
    {
        $m_name = $data['module'];
        array_push($m, $m_name) ; 
          
    }
   echo json_encode($m);
   
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


