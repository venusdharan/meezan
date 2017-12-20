<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$info = array(
    "name" => "module_name",
    "author" => "Author Name",
    "description" => "this module helps to do some things in awsesome",
    "url" => "www.example.com"
);

include '../../core/SessionManager.php';
$session = new SessionManager();

echo json_encode($info).'</br>';
echo $session->encode_session(json_encode($info));