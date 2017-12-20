<?php

$data =  $_POST['data'];


$address =$data['address'];
$id = $data['id'];
$username = $data['username'];
$password= $data['password'];
$mname = $data['mname'];
$email = $data['email'];
$phone = $data['phone'];
$designation = $data['designation'];
$read_only = $data['read_only'];
$admin = $data['admin'];



$servername = "localhost";
$dusername = "root";
$dpassword = "";
$dbname = "triophore";

// Create connection
$conn = new mysqli($servername, $dusername, $dpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = str_replace( 'row_', '' ,$id);
$id = trim($id);


$uid ;
$result = $conn->query("SELECT id FROM USERS WHERE username = 'admin'");

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $uid = $row["id"];
    }
} else {
    //echo "0 results";
}





if($uid == $id)
{
    
   $username = 'admin';
   $read_only = 'Yes';
   $admin = 'Yes';
}

// sql to delete a record
$sql = "UPDATE users SET username='$username',mname='$mname',phone='$phone',email='$email',password ='$password',address='$address',read_only='$read_only',designation='$designation',admin='$admin' WHERE  id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully   $id";
} else {
    echo "Error deleting record: $id" . $conn->error;
}

$conn->close();

