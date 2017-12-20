<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
$sql = "SELECT mem_name,id FROM membership_type";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $r = array();
                while($row = $result->fetch_assoc()) {
                   // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                    
                   array_push($r, $row)  ;
                    
                }
                echo json_encode($r);
            } else {
                //echo "0 results";
            }
            $conn->close();