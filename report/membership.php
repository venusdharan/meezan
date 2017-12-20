<?php
ini_set("memory_limit","128M");
include_once '../config/db_settings.php';
if(!isset($_GET['id']))
{
    exit();
}
if($_GET['id'] == '')
{
    exit();
}


$id = $_GET['id'];

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$myXMLData = file_get_contents("../mizan.info");
$xml=new SimpleXMLElement($myXMLData);

$sql = "SELECT * FROM membership WHERE mem_type_id = $id";
$result = $conn->query($sql);

$table_start = '
<!DOCTYPE html>
<html>
<head>
<style>
#db_table ,
#db_table th,
#db_table td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
th {
    text-align: left;
}
</style>
</head>
<body>    

</br></br>
<table id="db_table" style="width:100%">
  <tr>
    <th>Username</th>
    <th>Amount</th> 
    <th>Membership Date(YMD)</th>
    <th>Paid Date(YMD)</th>
    <th>Paid</th>
    <!--th>Phone</th>
    <th>Designation</th>
    <th>Read Only</th>
    <th>Admin</th-->
  </tr>';


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["id"]. " - Name: " . $row["uname"]. " " . $row["housename"]. "<br>";
       
        $table_start = $table_start."<tr>".add_tr($row["name"]).add_tr($row["amount"]);
        
        
        $table_start = $table_start.add_tr($row["cre_date"]).add_tr($row["paid_date"]);
        
        if($row["paid"] == '1')
        {
            $table_start = $table_start.add_tr('Yes')."</tr>"; 
        }else
        {
           $table_start = $table_start.add_tr('No')."</tr>"; 
        }
        
    }
} else {
   // echo "0 results";
}

$table_start = $table_start."</table></body>
</html>";

//echo $table_start;

$sql1 = "SELECT * FROM membership_type WHERE id = $id";
$result1 = $conn->query($sql1);
$mem_type_details = '';

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        $mem_type_details = $row["mem_name"]; 
    }
}

$conn->close();

try {

require_once  '../lib/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
        'allow_output_buffering' => true,
        'orientation' => 'L',
        'format' => 'A4-L',

	'margin_left' => 32,
	'margin_right' => 25,
	'margin_top' => 47,
	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10
 
]);

$header = "<h2 style='text-align:center;'>".$xml->MasjidName."</h2> "
        ."<p style='text-align:center;'>".$xml->Address."</p>"
        . "<h3 style='text-align:center;'>Membership Payment Report</h3>"
            ."<h3 style='text-align:center;'>$mem_type_details</h3>"
      //  . "<p style='text-align:left;'>Date:".date("Y/m/d")
        ;
        

$footer = file_get_contents("footer.html");

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($table_start);
$mpdf->debug = true;
$mpdf->Output('Meezan Membership Payment Report.pdf','I');



} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}


function add_tr($data)
{
    return "<td>$data</td>" ;
}