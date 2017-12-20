<?php
$id = $_POST['id'];
$name = $_POST['name'];
$housename = $_POST['housename'];
$phone = $_POST['phone'];
$age = $_POST['age'];
$bloodgroup = $_POST['bloodgroup'];
$gender = $_POST['gender'];
$owner = $_POST['owner'];
$married = $_POST['married'];
$email = $_POST['email'];
$ward = $_POST['ward'];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = str_replace( 'row_', '' ,$id);
$id = trim($id);


// sql to delete a record
$sql = "UPDATE home SET house_name='$housename',name='$name',phone='$phone',age='$age',bloodgroup='$bloodgroup',gender='$gender',owner='$owner',martialstatus='$married',email='$email',ward='$ward' WHERE  id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully   $id";
} else {
    echo "Error deleting record: $id" . $conn->error;
}

$conn->close();

