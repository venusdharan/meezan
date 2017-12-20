<?php
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



// sql to delete a record
$sql = "SELECt * FROM users ";

$result = $conn->query($sql);
$rows = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($rows, $row);
    }
    
    echo json_encode($rows);
}

$conn->close();

