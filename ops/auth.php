<?php
if(session_id() == ""){    session_start();}

/*
if(isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password']))
{
            if($route_temp != "" )
            {
                if($route_temp =="login")
                {
                  //  header('Location: /dashboard/');
                //  include_once "./view/dashboard.php";
                   
                  echo  "<script> window.location = 'dashboard';</script> ";
                // header("Location : dashboard");
                }
                else {
                       include_once "./view/$route_temp.php";  
                   // echo  "<script> window.location = 'dashboard';</script> ";
                }
            } 
            else   
            {
          
              include_once "./view/$default_auth_path.php"; 
            }
  // include_once "./view/dashboard.php";
          //  echo $route_temp;
}
else
{
    if(isset($_COOKIE['username']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        if($_COOKIE['username'] != "" && $_COOKIE['email'] != "" && $_COOKIE['password']!="")
        {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['email'] = $_COOKIE['email'];
        $_SESSION['password'] = $_COOKIE['password'];
        //header('Location: dashboard.php');
        //echo '<script type="text/javascript">console.log("$route_path");</script>';
            if($route_temp != "" || $route_temp !="login")
            {
            // include_once "./view/$route_temp";
            } 
            else   
            {
            //include_once "./view/$default_auth_path";
                
            }
        }
    }
    else
    {
    //header('Location: login.php');
    echo '<script type="text/javascript">window.location = "login";</script>';
       // include_once './view/login.php';
    }
    //header('Location: login');
    //echo '<script type="text/javascript">window.location = "login";</script>';
    // include_once './view/login.php';
}
*/
function check_auth()
{
    include_once $_SERVER['DOCUMENT_ROOT']."/triophore/config/FrameworkSettings.php";
    //include_once $_SERVER['DOCUMENT_ROOT']."/triophore/core/DBHelper.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/triophore/core/SessionManager.php";
    if(isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password']))
    {
        return TRUE;
    }
    else {

            if(isset($_COOKIE['user_id'])) 
                {
                   if($_COOKIE['user_id'] != "")
                   {
                       $s = new SessionManager();
                       $data = json_decode($s->decode_session($_COOKIE['user_id']),true);
                        foreach($data as $key => $val)
                        {
                           $_SESSION[$key] = $val;
                           //setcookie($key,$val, time() + (86400 * 1), "/"); // 86400 = 1 day
                        }
                        return TRUE;

                   }
                   else
                   {
                       return FALSE;
                   }

                }
                else
                {
                    return FALSE;
                }

   }
}