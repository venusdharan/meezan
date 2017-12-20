<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once './DBHelper.php';
$data = $_POST['data'];

$database->insert("membership_type", $data);
    echo "record added";
   //print_r($data);
    
    exit();