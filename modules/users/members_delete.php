<?php
session_start();
$username = $_SESSION['username'];



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




if($username == ""){exit();}
if($id == $uid)
{
    echo "Cannot delete admin account !";
    exit();
}


// sql to delete a record
$sql = "DELETE FROM users WHERE  id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: $id" . $conn->error;
}

$conn->close();

