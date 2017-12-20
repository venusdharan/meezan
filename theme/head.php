<?php
//include_once './core/SessionStart.php';
include_once './theme/user_menu.php';
include_once './theme/sidebar.php';
include_once './theme/navbar.php';
include_once './theme/maincontent.php';
include_once './config/webinfo.php';
include_once './config/settings.php';
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php 
get_css("bower_components/bootstrap/dist/css/bootstrap.min.css"."?v=".uniqid(),$full_root);
get_css("bower_components/font-awesome/css/font-awesome.min.css"."?v=".uniqid(),"$full_root");
//get_css("bower_components/Ionicons/css/ionicons.min.css"."?v=".uniqid(),"$full_root");
get_css("dist/css/AdminLTE.min.css"."?v=".uniqid(),$full_root);
get_css("dist/css/splash.css"."?v=".uniqid(),$full_root);
get_css("bower_components/iCheck/skins/square/blue.css"."?v=".uniqid(),$full_root);
get_css("bower_components/fuelux/dist/css/fuelux.min.css"."?v=".uniqid(),$full_root);
get_css("dist/css/skins/skin-green.min.css"."?v=".uniqid(),$full_root);
get_css("bower_components/jquery-toast-plugin/dist/jquery.toast.min.css"."?v=".uniqid(),$full_root);
get_css("bower_components/PACE/themes/green/pace-theme-flash.css"."?v=".uniqid(),$full_root);
//get_css("dist/css/jquery.scrollbar.css"."?v=".uniqid(),$full_root);

get_js("bower_components/moment/moment.js"."?v=".uniqid(),$full_root);
get_js("bower_components/PACE/pace.min.js"."?v=".uniqid(),$full_root);
echo '<script src="'.$full_root.'bower_components/jquery/dist/jquery.min.js" type="text/javascript" onload="window.$ = window.jQuery = require('."'".'jquery'."'".');'.'"'.'></script>';
//get_js("bower_components/jquery/dist/jquery.min.js"."?v=".uniqid(),$full_root);
//get_js("bower_components/jquery/dist/jquery-migrate.min.js"."?v=".uniqid(),$full_root);
get_js("bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"."?v=".uniqid(),$full_root);
get_js("bower_components/bootstrap/dist/js/bootstrap.min.js"."?v=".uniqid(),$full_root);
get_js("bower_components/iCheck/icheck.min.js"."?v=".uniqid(),$full_root);
get_js("bower_components/fuelux/dist/js/fuelux.min.js"."?v=".uniqid(),$full_root);
get_js("dist/js/app.min.js"."?v=".uniqid(),$full_root);
//get_js("dist/js/jquery.scrollbar.min.js"."?v=".uniqid(),$full_root);
get_js("dist/triophore/triophore1.js"."?v=".uniqid(),$full_root);
get_js("dist/triophore/main.js"."?v=".uniqid(),$full_root);
get_js("dist/triophore/auth.js"."?v=".uniqid(),$full_root);

?>
  <style>
   
   /* html,  body{   height: 100%; margin:0;} */
   .direct-chat{margin-bottom: 0px !important;}
    .form_datetime {
      z-index: 1800 !important; /* has to be larger than 1050 */
    }
  /*.datepicker{z-index:1200 !important;}
   .ui-datepicker{ z-index:1151 !important; }*/
  </style>
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

</head>