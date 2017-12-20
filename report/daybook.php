<?php
ini_set("memory_limit","128M");
include_once '../config/db_settings.php';
if(!isset($_GET['date']))
{
    exit();
}
if($_GET['date'] == "")
{
    exit();
}


$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_GET['date'];

$income_total = 0;
$expense_total = 0;

$myXMLData = file_get_contents("../mizan.info");
$xml=new SimpleXMLElement($myXMLData);

$sql = "SELECT * FROM expense where date = '$date'";
$result = $conn->query($sql);

$table_start = '

<!DOCTYPE html>
<html>
<head>
<style>
    .db_table 
    {
        float:leaft;
    }
.db_table ,
.db_table th,
.db_table td {
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
    <div style="width:100%;  text-align: center;">
        <h3>Expense</h3>
  <table class="db_table" style="width:100%;">
  <tr>
    <th>Income Type</th>
    <th>Specificity</th> 
    <th>Description</th>
    <th>Date (YMD)</th>
    <th>AMOUNT</th>
    
  </tr>


';

$file_valid = true;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["id"]. " - Name: " . $row["uname"]. " " . $row["housename"]. "<br>";
        
        $table_start = $table_start."<tr>".add_tr($row["type"]).add_tr($row["pay_id"]).add_tr($row["des"]).add_tr($row["date"]).add_tr($row["amount"])."</tr>";
        $expense_total = $expense_total  + intval($row["amount"]);
    }
} else {
    //echo "0 results";
    //$file_valid = false;
}

$table_start = $table_start.'  </table>
        <p>Total Income:'.$income_total.' /- as of : '.$date.'(YMD) </p>
    </div>
    <div style="width:100%;  text-align: center;">
          <h3>Income</h3>
<table class="db_table" style="width:100%;">
  <tr>
    <th>Expense Type</th>
    <th>Specificity</th> 
    <th>Description</th>
    <th>Date (YMD)</th>
    <th>AMOUNT</th>
    
  </tr>';

$sql1 = "SELECT * FROM income where date = '$date' ";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
       // echo "id: " . $row["id"]. " - Name: " . $row["uname"]. " " . $row["housename"]. "<br>";
        
       // $table_start = $table_start."<tr>".add_tr($row["id"]).add_tr($row["uname"]).add_tr($row["housename"]).add_tr($row["phone"]).add_tr($row["bdate"]).add_tr($row["bloodgroup"]).add_tr($row["gender"]).add_tr($row["owner"]).add_tr($row["married"]).add_tr($row["email"]).add_tr($row["ward"]).add_tr($row["category"]).add_tr($row["dis"]).add_tr($row["nri"]).add_tr($row["mad"]).add_tr($row["edu"]).add_tr($row["base_mem"])."</tr>";
        
        $table_start = $table_start."<tr>".add_tr($row["type"]).add_tr($row["pay_id"]).add_tr($row["des"]).add_tr($row["date"]).add_tr($row["amount"])."</tr>";
        
        $income_total = $income_total + intval($row["amount"]);
    }
} else {
    //echo "0 results";
    //$file_valid = false;
}


$table_start = $table_start.'  </table>
          <p>Total Expense:'.$income_total.' /- as of : '.$date.'(YMD) </p>
    </div>
</body>
</html>';

$conn->close();

try {

    if($file_valid)
    {
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
        . "<h3 style='text-align:center;'>Total Members Report</h3>"
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
$mpdf->Output('Meezan Daybook Report.pdf', 'I');
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename= Meezan Report.pdf");
//header("Content-Length: " . filesize($file));

    }



} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}


function add_tr($data)
{
    return "<td>$data</td>" ;
}