<?php
include_once '../../config/db_settings.php';
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



//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "triophore";

// Create connection
$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//$id = str_replace( 'row_', '' ,$id);
//$id = trim($id);


// sql to delete a record
$sql = "INSERT INTO home (house_name,name,phone,age,bloodgroup,gender,owner,martialstatus,email,ward) VALUES('$housename','$name','$phone','$age','$bloodgroup','$gender','$owner','$married','$email','$ward')";

if ($conn->query($sql) === TRUE) {
    if($owner == "Yes")
    {
       $lid = mysqli_insert_id($conn);
       $sql_hn = "INSERT INTO home_num (ref_id) VALUES($lid)";
       if($conn->query($sql_hn) === TRUE)
       {
          echo "Record added successfully   "; 
       }
       else {
           echo "Error adding record: " . $conn->error; 
       }
       echo $sql_hn;
    }
      
    
} else {
    echo "Error adding record: " . $conn->error;
}

$conn->close();

