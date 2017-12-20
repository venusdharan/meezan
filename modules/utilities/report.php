<?php
if(session_id() == ""){    session_start();}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
include_once '../config/db_settings.php';


$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//$id = str_replace( 'row_', '' ,$id);
//$id = trim($id);


// sql to delete a record

$result =$conn->query("select count(*) FROM home");
$row = $result->num_rows;

$total = $row;


$conn->close();

$home = new content("Home","Welcome ".$_SESSION['username']);
$total_members = getinfobox("bg-green", "fa fa-users", "Total Members", "$total", false, "0", '<a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a>');
$total_auctions = getinfobox("bg-aqua", "fa fa-gavel", "Total Auction", "6", false, "0", "Running ok!");
$total_functions = getinfobox("bg-yellow", "fa fa-bullhorn", "Total Functions", "6", false, "0", "Running ok!");
$total_income = getinfobox("bg-red", "fa fa-university", "Total Income", "6", false, "0", "Running ok!");
$panel_array = array();
array_push($panel_array, $total_members);
array_push($panel_array, $total_auctions);
array_push($panel_array, $total_functions);
array_push($panel_array, "$total_income");//<button class='btn btn-lg' id='home_btn'>click</button>
$row = createrows($panel_array, 4, "col-lg-3");

$box = '
    <div class="box box-success ">
  <div class="box-header with-border">
    <h3 class="box-title">Quick control panel</h3>
    <!--div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div-->
  
  </div>

  <div class="box-body">
 
  </div>
 
  <div class="box-footer">
    
  </div>

</div>';
$maparr = array();
array_push($maparr, $box);
$row_map = createrows($maparr, 1, "col-lg-12");
echo  $home->getContent($row_map) ;
