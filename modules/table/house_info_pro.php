<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$hnum = $_POST['h_num'];
include_once './DBHelper.php';
$data = $database->select("home_num","ref_id",["id" => "$hnum"]);
if(count($data) > 0)
{
$rarray = $data[0];

    $howner = $database->select("home",["housename","uname"],["id" => "$rarray"]);

    $house = $howner[0]["housename"];
    
    $uname = $howner[0]["uname"];

    $houses = $database->select("home","*",["housename" => "$house"]);

$thead = "<table class='table'>
               <tr>
                <th>Name</th>
                <th>House Name</th>
                <th>Phone</th>
                <th>DOB(YMD)</th>
                <th>Blood Group</th>
                <th>Gender</th>
                <th>Owner</th>
                <th>Married</th>
                <th>Email</th>
                <th>Ward</th>
                <th>Category</th>
                <th>Disability</th>
                <th>Country</th>
                <th>Madrasa</th>
                <th>Education</th>
                <th>Base Membership</th>
               </tr>";

$tend="</table>";


$tbd = "";

foreach ($houses as $house_mem) {
    
    $tbd = $tbd. "<tr>".
            "<td>".$house_mem["uname"]."</td>".
            "<td>".$house_mem["housename"]."</td>".
            "<td>".$house_mem["phone"]."</td>".
            "<td>".$house_mem["bdate"]."</td>".
            "<td>".$house_mem["bloodgroup"]."</td>".
            "<td>".$house_mem["gender"]."</td>".
            "<td>".$house_mem["owner"]."</td>".
            "<td>".$house_mem["married"]."</td>".
            "<td>".$house_mem["email"]."</td>".
            "<td>".$house_mem["ward"]."</td>".
            "<td>".$house_mem["category"]."</td>".
            "<td>".$house_mem["dis"]."</td>".
            "<td>".$house_mem["nri"]."</td>".
            "<td>".$house_mem["mad"]."</td>".
            "<td>".$house_mem["edu"]."</td>".
            "<td>".$house_mem["base_mem"]."</td>".
           "</tr>";
    
}

echo $thead.$tbd.$tend;

}
 else {
    
 
    echo '<h1><b style=" color: rgb(156, 0, 0);">House details not found !&nbsp;</b></h1>';
 }