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
     $database->insert("expense", $data);
     
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
                
                 $database->update("expense", $data,[ "id" => "$id"]);
                 
                 echo "record edited!";
         }
     }
     exit();
   //print_r($data);
 }
 
}