<?php
include_once '../../config/db_settings.php';
$name = $_POST['amount'];
$housename = $_POST['type'];
$phone = $_POST['discription'];
$age = $_POST['date'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";



//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "triophore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//$id = str_replace( 'row_', '' ,$id);
//$id = trim($id);

$date = str_replace('/', '-', $age);
$age = date('Y-m-d', strtotime($date));

// sql to delete a record
$sql = "INSERT INTO income (amount,type,des,date) VALUES('$name','$housename','$phone','$age')";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully   ";
} else {
    echo "Error adding record: " . $conn->error;
}

$conn->close();

