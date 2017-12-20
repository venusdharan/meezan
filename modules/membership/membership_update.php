<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id = $_GET['id'];
$paid = $_GET['paid'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";

$id = str_replace("row_","",$id);
//$id = $id.trim();
//echo $paid;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if($paid == 1)
{
   $sql = "UPDATE membership SET paid = '$paid' , paid_date = NOW() WHERE id = '$id'"; 
}

if($paid == 0)
{
   $sql = "UPDATE membership SET paid = '$paid' , paid_date = cre_date WHERE id = '$id'"; 
}
// sql to delete a record


if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
