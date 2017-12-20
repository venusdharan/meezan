<?php
$name = $_POST['name'];
$date = $_POST['date'];
$amount = $_POST['amount'];
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


//$id = str_replace( 'row_', '' ,$id);
//$id = trim($id);


// sql to delete a record
$sql = "INSERT INTO membership (name,date,amount) VALUES('$name',STR_TO_DATE('$date', '%m/%d/%Y'),'$amount')";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully   ";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

