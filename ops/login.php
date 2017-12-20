<?php


if(isset($_POST['email']) AND isset($_POST['password']))
{
    if($_POST['email'] != "" && $_POST['password'] != "")
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
       include_once './core/SessionStart.php';
      

include_once $_SERVER['DOCUMENT_ROOT']."/triophore/config/FrameworkSettings.php";
include_once $_SERVER['DOCUMENT_ROOT']."/triophore/core/DBHelper.php";
include_once $_SERVER['DOCUMENT_ROOT']."/triophore/core/SessionManager.php";
$count = $database->count("users",[ 'AND' => [ "username" => "$email" ,"password" => "$password"] ]);


if($count > 0)
{
    $db_data = $database->select("users","*",[ 'AND' => [ "username" => "$email" ,"password" => "$password"] ]);
    $s_manager = new SessionManager();
    
    foreach($db_data as $data)
    {
           // echo "user_name:" . $data["user_name"] . " - email:" . $data["email"] . "<br/>";
           foreach ($data as $key => $val)
           {
              $_SESSION[$key] = $val;
              //setcookie($key,$val, time() + (86400 * 1), "/"); // 86400 = 1 day
           }
       
          setcookie("user_id",$s_manager->encode_session(json_encode($data)), time() + (86400 * 1), "/"); // 86400 = 1 day
        
        
    }
    
    echo "success";
        exit();
}else
{
    echo "failed";
        exit();
}

}}


/*

$conn = mysqli_connect($settings["db_server"], $settings['db_username'], $settings['db_password'],$settings['db_name']);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = 'SELECT `username` FROM `users` WHERE `username`="'.$email.'" AND `password`="'. $password.'"'; //mysql_real_escape_string
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        setcookie('username',$row['username'], time() + (86400 * 1), "/"); // 86400 = 1 day
        setcookie('email',$email, time() + (86400 * 1), "/"); // 86400 = 1 day
        setcookie('password',$password, time() + (86400 * 1), "/"); // 86400 = 1 day
        
        echo "success";
        exit();
    }
} else {
    echo 'failed';
    exit();
}

mysqli_close($conn);

        //echo '<div class="alert alert-danger"><strong>Login failed!</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eamil and paasword mismatch!.</div>';
        //echo "<script>window.location='dashboard#home';</script>";
        exit();
    }
    exit();
}

 */

