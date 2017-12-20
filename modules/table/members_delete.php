<?php
$id = $_POST['id'];

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
$sql = "DELETE FROM home WHERE  id=$id";

if ($conn->query($sql) === TRUE) {
    echo "ok";
} else {
    echo "Error deleting record:";
}

$conn->close();

