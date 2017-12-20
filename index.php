<?php
if(file_exists("./config/FrameworkSettings.php") === FALSE){ die("FrameworkSettings File missing ! Cannot start Application"); }
if(!isset($_SESSION)){session_start();}
if (session_status() === PHP_SESSION_NONE){session_start();}
include_once "./config/FrameworkSettings.php";
include_once  './lib/vendor/autoload.php';
//print_r($_POST);
// Create Router instance
$router = new \Bramus\Router\Router();

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
          include_once "./view/notfound.php"; 
});

$router->get('/', function() {
include_once './config/FrameworkSettings.php';
include_once './config/routes.php';
include_once './core/SessionStart.php';
include_once './config/webinfo.php';
include_once './config/settings.php';
include_once './ops/auth.php'; 
  //  echo "<script>setTimeout(function() { window.location.href='http://localhost/triophore/$default';}, 100);</script>";
header("location: http://localhost/triophore/$default");
                               //exit();
});


$router->get('/(\w+)', function($r) {
    
include_once './config/FrameworkSettings.php';
include_once './config/routes.php';
include_once './core/SessionStart.php';
include_once './config/webinfo.php';
include_once './config/settings.php';
include_once './ops/auth.php'; 
$root = root;
    if($r != "")
    {
         include_once './config/FrameworkSettings.php';
        
            if(isset($routes["$r"]))
            {

                if($routes["$r"]["auth"] === "true")
                {

                   if(check_auth())
                   {

                      include_once  $_SERVER['DOCUMENT_ROOT'].'/'.root."/view/$r.php"; 
                      exit();
                   }
                   else 
                   {

                       // echo "<script>setTimeout(function() { window.location.href='http://localhost/triophore/logout';}, 100);</script>";
                        header("location: http://localhost/triophore/logout");
                        exit();
                   }
                }
                else
                {

                    include_once  $_SERVER['DOCUMENT_ROOT'].'/'.root."/view/$r.php"; 
                    exit();
                }
                 //print_r($routes);
            }else
            {
                 //echo "<script>setTimeout(function() { window.location.href='http://localhost/triophore/$default';}, 100);</script>";
                include_once $_SERVER['DOCUMENT_ROOT'].'/'.root."/view/notfound.php"; 
                        exit();
            }
    }
    else
    {

    }


});

/*
$router->get('/movies/(\w+)/photos/(\w+)', function($movieId, $photoId) {
    echo 'Movie #' . $movieId . ', photo #' . $photoId;
});
*/

$router->post('/(\w+)', function($r) {
include_once './config/FrameworkSettings.php';
include_once './config/routes.php';
include_once './core/SessionStart.php';
include_once './config/webinfo.php';
include_once './config/settings.php';
include_once './ops/auth.php'; 
    if($r != "")
    {
        
            if(isset($routes["$r"]))
            {
                if($routes["$r"]["post"] === "true")
                {
                    include_once $_SERVER['DOCUMENT_ROOT'].'/'.root."/ops/$r.php"; 
                    //echo "post data";
                    exit();
                }
            }
    }
});



// Run it!
$router->run();






