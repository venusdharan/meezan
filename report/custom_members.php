<?php
ini_set("memory_limit","128M");
include_once '../config/db_settings.php';





$sql_where = "";

if($_GET['mem_house_owner'] == '1')
{
    $sql_where = $sql_where." owner = 'Yes'  AND ";
}

if($_GET['mem_house_owner'] == '2')
{
    $sql_where = $sql_where." owner = 'No'  AND ";
}


if($_GET['mem_dis'] == '1')
{
    $sql_where = $sql_where." dis = 'No'  AND ";
}

if($_GET['mem_dis'] == '2')
{
    $sql_where = $sql_where." dis = 'Yes'  AND ";
}


if($_GET['mem_gender'] == '1')
{
    $sql_where = $sql_where." gender = 'Male'  AND ";
}

if($_GET['mem_gender'] == '2')
{
    $sql_where = $sql_where." dis = 'Female'  AND ";
}

if($_GET['mem_nri'] == '1')
{
    $sql_where = $sql_where." nri <> 'India'  AND ";
}


   
    //echo '</br>'. $lower;


if($_GET['mem_bloodgroup'] != '0')
{
    $sql_where = $sql_where." bloodgroup = "."'".$_GET['mem_bloodgroup']."'"."  AND";
    
    
}


 $lage =  $_GET['mem_age'];
    $lower = date('Y-m-d', strtotime("today -$lage years"));
    $sql_where = $sql_where.  " bdate <= '$lower'";
 $sql_where;


$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$myXMLData = file_get_contents("../mizan.info");
$xml=new SimpleXMLElement($myXMLData);

$sql = "SELECT * FROM home where $sql_where";
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
    <th>ID</th>
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
  </tr>';


if(!$result)
{
    echo "<h1>Sorry No Results Found !</h1>";
    exit();
}
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      // echo "id: " . $row["id"]. " - Name: " . $row["uname"]. " " . $row["housename"]. "<br>";
        
        $table_start = $table_start."<tr>".add_tr($row["id"]).add_tr($row["uname"]).add_tr($row["housename"]).add_tr($row["phone"]).add_tr($row["bdate"]).add_tr($row["bloodgroup"]).add_tr($row["gender"]).add_tr($row["owner"]).add_tr($row["married"]).add_tr($row["email"]).add_tr($row["ward"]).add_tr($row["category"]).add_tr($row["dis"]).add_tr($row["nri"]).add_tr($row["mad"]).add_tr($row["edu"]).add_tr($row["base_mem"])."</tr>";
    }
} else {
   // echo "0 results";
}

$table_start = $table_start."</table></body>
</html>";

//echo $table_start;


$conn->close();

try {

require_once  '../lib/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
        'allow_output_buffering' => true,
        'orientation' => 'L',
        'format' => 'A4-L',

	//'margin_left' => 32,
	//'margin_right' => 25,
	'margin_top' => 65,
	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10
 
]);

$header = "<h2 style='text-align:center;'>".$xml->MasjidName."</h2> "
        ."<p style='text-align:center;'>".$xml->Address."</p>"
        . "<h3 style='text-align:center;'>Custom Members Report</h3>"
        . '<table width="100%" style="vertical-align: bottom;  
    font-size: 8pt; color: #000000; font-weight: bold; ">
    <tr>
        <td width="25%">{DATE j-m-Y}</td>
        <td width="25%" align="center">{PAGENO}/{nbpg}</td>
        <td width="25%" style="text-align: right;">Meezan ERP</td>
        <td width="25%" style="text-align: right;">&copy; Triophore Technologies</td>
    </tr>
</table>'
        ;
        

$footer = file_get_contents("footer.html");

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($table_start);
$mpdf->debug = true;
$mpdf->Output('Meezan Custom Members Report.pdf', 'I');



} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}


function add_tr($data)
{
    return "<td>$data</td>" ;
}