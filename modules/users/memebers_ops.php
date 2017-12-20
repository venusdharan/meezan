<?php
include_once '../module_data.php';

$data_array = json_decode($data,true);
print_r($data_array);
if($ops == 'add')
{
  echo $database->insert("users",$data_array); 
}



