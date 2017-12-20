<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";
if(isset($_POST['op']) AND isset($_POST['data']))
{
include_once './DBHelper.php';

$op = $_POST['op'];
$data = $_POST['data'];

//$date = str_replace('/', '-', $data['bdate']);
//$data['bdate'] = date('Y-m-d', strtotime($date));

//$dateInput = explode('/',$data['bdate']);
//$ukDate = $dateInput[2].'-'.$dateInput[0].'-'.$dateInput[1];
//$data['bdate'] = $ukDate;

 if($op === 'add')
 {
     $database->insert("home", $data);
     if($data["owner"] == "Yes")
     {
     $id = $database->id();
     $database->insert("home_num", ['ref_id' => "$id"]);
     }
     echo "record added";
   //print_r($data);
    
    exit();
 }
 
 if($op === 'edit')
 {
     if(isset($_POST['id']))
     {
         if($_POST['id'] != '')
         {
                 $id = $_POST['id'];
                 $owner = $database->select("home","owner",["id" => "$id"]);
                 $ow = $owner[0];
                 if($ow == "Yes" AND $data["owner"] == "No")
                 {
                    $database->delete("home_num",["ref_id" => "$id"]); 
                 }
                 if($ow == "No" AND $data["owner"] == "Yes")
                 {
                    $database->insert("home_num", ['ref_id' => "$id"]); 
                 }
                 $database->update("home", $data,[ "id" => "$id"]);
                 
                 echo "record edited!";
         }
     }
     exit();
   //print_r($data);
 }
 
}