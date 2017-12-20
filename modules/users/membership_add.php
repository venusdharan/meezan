<?php
$data = $_POST['data'];
//var_dump($data);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";


$uname = $data['user'];
if($uname == ''){exit();}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



// sql to delete a record
$sql = "DELETE FROM module_users WHERE username = '$uname'";

if ($conn->query($sql) === TRUE) {
   // echo "Record deleted successfully";
} else {
   // echo "Error deleting record: " . $conn->error;
}



$datas = $data['data'];
/*
  $sql = "INSERT INTO module_users (module,username) VALUES('home','$uname')";

if ($conn->query($sql) === TRUE) {
  //  echo "Modules added successfully   ";
} else {
   // echo "Error Adding modules: " . $conn->error;
}
*/
foreach ($datas as $value) {
    $sql = "INSERT INTO module_users (module,username) VALUES('$value','$uname')";

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error Adding modules: " . $conn->error;
    exit();
}
}

echo "Modules added successfully   ";

$conn->close();

