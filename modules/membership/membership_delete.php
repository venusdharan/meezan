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
$sql = "DELETE FROM membership_type WHERE  id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully   $id";
} else {
    echo "Error deleting record: $id" . $conn->error;
}

$conn->close();

