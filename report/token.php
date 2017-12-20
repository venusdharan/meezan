<?php
ini_set("memory_limit","128M");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../config/db_settings.php';


$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//$id = str_replace( 'row_', '' ,$id);
//$id = trim($id);


// sql to delete a record

$home_num = array();
$home_arr = array();



$result =$conn->query("select * FROM home_num");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        

        $home_det = array();
       $id = $row['id'];
       $ref_id = $row['ref_id'];
        array_push($home_det, $id);
        array_push($home_det,$ref_id );
        
        array_push($home_num, $home_det);
    }
}



//print_r($home_num);
foreach ($home_num as $hom)
{
    $hid = $hom[1] ."</br>";
    $hresult =$conn->query("select housename , uname FROM home where id = '$hid'");
    $hname ="";
    $uname ="";
    if ($hresult->num_rows > 0) {
          while($row = $hresult->fetch_assoc()) {
             $hname = $row['housename'];
             $uname = $row['uname'];
          }
    }
    $totmem = $conn->query("select id  FROM home where housename = '$hname'");
    $tot_mem = $totmem->num_rows;
    
    $mem = array();
    array_push($mem, $hom[0]);
    array_push($mem, $hname);
    array_push($mem, $uname);
    array_push($mem, $tot_mem);
    array_push($home_arr, $mem);
}






$conn->close();


//print_r($home_arr);

$div = "<!DOCTYPE html>
<html>
<head>
<title>Token</title>
<body>"    
        ;

foreach($home_arr as $val)
{
   
    
    
    $div = $div."<div style='border: 2px solid black; width:300px; height:150px; float:left; '>
<div style='text-align: center;'><p>".$val[2]."</p></div>
<div style='text-align: center;  width:139px; float:left; border-bottom:  2px solid black; border-top: 2px solid black; border-right: 2px solid black;'><p>House No:".$val[0]."</p></div>
<div style='text-align: center;   width:157px; float:right; border-bottom: 2px solid black; border-top: 2px solid black;'><p>".$val[1]."</p></div>
<div style='text-align: center;'><p>Total Members:".$val[3]."</p></div>
</div>"
            ;
    
    


    
    
    
}

   $div = $div."</body></html>";
$footer = file_get_contents("footer.html");
//echo $div;

try {
require_once  '../lib/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
        'allow_output_buffering' => true,
        'orientation' => 'L',
        'format' => 'A4-L'//,

	//'margin_left' => 32,
	//'margin_right' => 25,
//	'margin_top' => 65,
//	'margin_bottom' => 47,
//	'margin_header' => 10,
//	'margin_footer' => 10
 
]);

//$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($div);
$mpdf->debug = true;
$mpdf->Output("Tokens.pdf","I");

} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}