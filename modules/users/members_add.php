<?php

$data = $_POST['data'];


$name = $data['mname'];
$susername =$data['username'];
$phone = $data['phone'];
$upassword = $data['password'];
$address = $data['address'];
$designation = $data['designation'];
$email = $data['email'];
$read_only = $data['read_only'];
$admin = $data['admin'];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";

if($upassword == '')
{
    $upassword = 'password';
}



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO users (username,email,phone,password,address,mname,designation,read_only,admin) "
        . "VALUES('$susername','$email','$phone','$upassword','$address','$name','$designation','$read_only','$admin')";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully   ";
} else {
    echo "Error adding record: " . $conn->error;
}

$conn->close();

