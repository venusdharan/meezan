<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//$dirs = array_filter(glob('*'), 'is_dir');
$nav = '';

$username = $_SESSION['username'];
$admin = $_SESSION['admin'];
$nav="";

if($username != "")
{
    $datas = $database->select("module_users", [
	"module",

    ], [
            "username" => "$username",
       
    ]);
    /*
    $ro = $_SERVER['DOCUMENT_ROOT'].'/'.root.'/modules/';
        if(file_exists($ro."home/nav.php"))
        {
        include_once $ro."home/nav.php";
        $nav = $nav . $menu;
        }
    */
    foreach($datas as $data)
    {
        $m_name = $data['module'];
        $ro = $_SERVER['DOCUMENT_ROOT'].'/'.root.'/modules/';
        if(file_exists("$ro$m_name/nav.php"))
        {
        include_once "$ro$m_name/nav.php";
        $nav = $nav . $menu;
        }   
          
    }
 /*
   $ro = $_SERVER['DOCUMENT_ROOT'].'/'.root.'/modules/';
        if(file_exists($ro."members/nav.php"))
        {
        include_once $ro."members/nav.php";
        $nav = $nav . $menu;
        }
  * 
  */
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
 echo $nav;