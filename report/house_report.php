<?php
ini_set("memory_limit","128M");
include_once '../config/db_settings.php';
$myXMLData = file_get_contents("../mizan.info");
$xml=new SimpleXMLElement($myXMLData);
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
';



$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM home_num";
$result = $conn->query($sql);
$file_valid = true;

$house_details = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $ref_id = $row['ref_id'];
        $sql1 = "SELECT housename FROM home WHERE id = $ref_id";
        $res = $conn->query($sql1);
        $house  = array();
        if($res->num_rows > 0)
        {
            while($hrows = $res->fetch_assoc())
            {
                array_push($house, $hrows['housename']);
                array_push($house, $id);
            }
        }
        array_push($house_details, $house);
        
    }
}

foreach ($house_details as $home) {
    $home_name = $home[0];
    $home_num = $home[1];
    $home_mem_sql  = "SELECT * FROM home WHERE housename=$home_name";
   $home_members_dat = $conn->query("SELECT * FROM home WHERE housename = '$home_name'");
    $table_start = $table_start. '<table id="db_table" style="width:100%">
                <tr>
                  <th>ID</th>
                  <th>House Number</th>
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
if (!$home_members_dat) {
    trigger_error('Invalid query: ' . $conn->error);
}
    if($home_members_dat->num_rows > 0)
    {
        while($row = $home_members_dat->fetch_assoc())
        {
          
            
            $table_start = $table_start."<tr>".add_tr($row["id"]).add_tr($home_num).add_tr($row["uname"]).add_tr($row["housename"]).add_tr($row["phone"]).add_tr($row["bdate"]).add_tr($row["bloodgroup"]).add_tr($row["gender"]).add_tr($row["owner"]).add_tr($row["married"]).add_tr($row["email"]).add_tr($row["ward"]).add_tr($row["category"]).add_tr($row["dis"]).add_tr($row["nri"]).add_tr($row["mad"]).add_tr($row["edu"]).add_tr($row["base_mem"])."</tr>";
            
            
        }
        
        $table_start = $table_start."</table>";
    }    
}

$table_start = $table_start."</body>
</html>";

$conn->close();
echo json_encode($house_details);


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
$mpdf->Output('Meezan House Info Report.pdf', 'I');
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