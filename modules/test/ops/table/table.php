<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './../db_settings.php';
$conn = mysqli_connect($db_server, $db_username, $db_password,$db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//$sql = "desc `users`";
$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);
$rows = array();
if($result != FALSE)
{
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)){
        //echo $row[0]."<br>";
        $temp_arr = array();
        //echo count($row[]);
        foreach ($row as $value) {
            array_push($temp_arr, $value); 
        }
          array_push($rows, $temp_arr);
    }
    echo json_encode($rows);
   
}
}

function get_coloum_names()
{
  $sql = "desc `users`";
//$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);
$rows = array();
if($result != FALSE)
{
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)){
        //echo $row[0]."<br>";
        $temp_arr = array();
        //echo count($row[]);
        array_push($rows, $row[0]);
    }
    echo json_encode($rows);
   
}
}  
}