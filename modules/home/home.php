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

$result =$conn->query("select * FROM home");
$row1 = $result->num_rows;
$total = $row1;


$admin_result = $conn->query("select * FROM users");
$admin_row = $admin_result->num_rows;
$admin_count = $admin_row;

$dis_re = $conn->query("select * FROM home where `dis` = 'Yes'");
$dis_row = $dis_re->num_rows;
$des_count = $dis_row;


$h_r = $conn->query("select * FROM home where `owner` = 'Yes'");
$h_row = $h_r->num_rows;
$h_count = $h_row;

$cat_r = $conn->query("select * FROM category");
$cat_row = $cat_r->num_rows;


$ward_r = $conn->query("select * FROM ward");
$ward_row = $ward_r->num_rows;

$nri_r = $conn->query("select * FROM home where `nri` <> 'India'");
$nri_row = $nri_r->num_rows;

$mem_num_r = $conn->query("select * FROM ward");
$mem_num = $mem_num_r->num_rows;

$conn->close();

$home = new content("Home","Welcome ".$_SESSION['username']);
$total_members = getinfobox("bg-green", "fa fa-users", "Members", "$total", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->');
$total_auctions = getinfobox("bg-aqua", "fa fa-user-secret", "Admin Users", "$admin_count", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->');
$total_functions = getinfobox("bg-yellow", "fa fa-wheelchair-alt", "Disabled Members", "$des_count", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="disability" data-path="table">View More</a-->');
$total_income = getinfobox("bg-red", "fa fa-university", "House Owners", "$h_count", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->');
$panel_array = array();
array_push($panel_array, $total_members);
array_push($panel_array, $total_auctions);
array_push($panel_array, $total_functions);
array_push($panel_array, "$total_income");//<button class='btn btn-lg' id='home_btn'>click</button>
$row = createrows($panel_array, 4, "col-lg-3");


//bottom

$total_wards = getinfobox("bg-green", "fa fa-map", "Wards", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->');
$total_cat = getinfobox("bg-aqua", "fa fa-map-signs", "Categories", "$cat_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->');
$total_memplan = getinfobox("bg-yellow", "fa fa-street-view", "Membership Plans", "$mem_num", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="disability" data-path="table">View More</a-->');
$total_meet = getinfobox("bg-red", "fa fa-globe", "NRI", "$nri_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->');
$panel_array_bottom = array();
array_push($panel_array_bottom, $total_wards);
array_push($panel_array_bottom, $total_cat);
array_push($panel_array_bottom, $total_memplan);
array_push($panel_array_bottom, "$total_meet");//<button class='btn btn-lg' id='home_btn'>click</button>
$row_bottom = createrows($panel_array_bottom, 4, "col-lg-3");

//end bottom

$info_box = '
    <div class="box box-success ">
  <div class="box-header with-border">
    <h1 class="box-title">Quick info</h1>
    <!--div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div-->
  
  </div>

  <div class="box-body">
   '.$row.' </div>
 
  <div class="box-footer">
    '."<strong>These are the updated quick info about your mazjid</strong>".'
  </div>

</div>';


$info_box_bottom = '
    <div class="box box-success ">
  <div class="box-header with-border">
    <h1 class="box-title">Miscellaneous info</h1>
    <!--div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div-->
  
  </div>

  <div class="box-body">
   '.$row_bottom.' </div>
 
  <div class="box-footer">
    '."<strong>Other mazjid Info</strong>".'
  </div>

</div>';




$box = '
    <div class="box box-success ">
  <div class="box-header with-border">
    <h1 class="box-title">Mazjid Info</h1>
    <!--div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div-->
  
  </div>

  <div class="box-body">
   ';

$myXMLData = file_get_contents("../../mizan.info");
$xml=new SimpleXMLElement($myXMLData);

 $mazjidname = "Mazjid Name: ". $xml->MasjidName;
 $usenam = '';//"Mazjid Re: ". $xml->UserName;
 $email = "Email: ". $xml->Email;
 $phone = "Phone: ". $xml->Phone;
 $addres = "Address: ". $xml->Address;
 $skey = $xml->Key;
//print_r($xml);

$box = $box ."
    <h3>$mazjidname</h3></br>
    <p>$usenam</p>
    <p>$email</p>
    <p>$phone</p>
    <p>$addres</p>
";

$box = $box.'
  </div>
 
  <div class="box-footer">
    '."<strong>Serial Key:$skey</strong>".'
  </div>

</div>';

$boxsec = array();

array_push($boxsec, 
        getinfobox("bg-green", "fa fa-heart", "Nikah", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->')
);

array_push($boxsec, 
        getinfobox("bg-green", "fa fa-leaf", "Kabar", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->')
);

array_push($boxsec, 
        getinfobox("bg-green", "fa fa-gift", "Mettings", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->')
);

array_push($boxsec, 
        getinfobox("bg-green", "fa fa-users", "Other Events", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->')
);

$bthird = array();

array_push($bthird, 
        getinfobox("bg-green", "fa fa-angle-double-right", "Income Types", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->')
);

array_push($bthird, 
        getinfobox("bg-green", "fa fa-angle-double-left", "Expense Types", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->')
);

array_push($bthird, 
        getinfobox("bg-green", "fa fa-users", "Wards", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->')
);

array_push($bthird, 
        getinfobox("bg-green", "fa fa-users", "Wards", "$ward_row", false, "0", '<!--a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a-->')
);

$boxsecongd = '
    <div class="box box-success ">
  <div class="box-header with-border">
    <h3 class="box-title">Functions and Events</h3>
    <!--div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div-->
  
  </div>

  <div class="box-body">
  <div style="width: 100%;">
   '.createrows($boxsec, 2, "col-lg-6").'
       </div>
  </div>
 
  <div class="box-footer">
    </br>
  </div>

</div>';

$boxthird = '
    <div class="box box-success ">
  <div class="box-header with-border">
    <h3 class="box-title">Accounts Quick Info</h3>
    <!--div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div-->
  
  </div>

  <div class="box-body">
  <div style="width: 100%;">
   '.createrows($bthird, 2, "col-lg-6").'
       </div>
  </div>
 
  <div class="box-footer">
    </br>
  </div>

</div>';

$maparr = array();
array_push($maparr, $box);
array_push($maparr, $boxsecongd);
array_push($maparr, $boxthird);
$row_map = createrows($maparr, 3, "col-lg-4");


echo  $home->getContent($info_box . $row_map .$info_box_bottom ) ;
//var_dump($_SESSION);