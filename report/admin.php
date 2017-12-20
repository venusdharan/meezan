<?php
ini_set("memory_limit","128M");
include_once '../config/db_settings.php';

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$myXMLData = file_get_contents("../mizan.info");
$xml=new SimpleXMLElement($myXMLData);

$sql = "SELECT * FROM users";
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
    <th>Email</th> 
    <th>Password</th>
    <th>Name</th>
    <th>Adress</th>
    <th>Phone</th>
    <th>Designation</th>
    <th>Read Only</th>
    <th>Admin</th>
  </tr>';


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["id"]. " - Name: " . $row["uname"]. " " . $row["housename"]. "<br>";
        if($row["username"] != "admin")
        {
        $table_start = $table_start."<tr>".add_tr($row["username"]).add_tr($row["email"]).add_tr($row["password"]).add_tr($row["mname"]).add_tr($row["address"]).add_tr($row["phone"]).add_tr($row["designation"]).add_tr($row["read_only"]).add_tr($row["admin"])."</tr>";
        }
    }
} else {
    echo "0 results";
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

	'margin_left' => 32,
	'margin_right' => 25,
	'margin_top' => 47,
	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10
 
]);

$header = "<h2 style='text-align:center;'>".$xml->MasjidName."</h2> "
        ."<p style='text-align:center;'>".$xml->Address."</p>"
        . "<h3 style='text-align:center;'>Total Members Report</h3>"
      //  . "<p style='text-align:left;'>Date:".date("Y/m/d")
        ;
        

$footer = file_get_contents("footer.html");

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($table_start);
$mpdf->debug = true;
$mpdf->Output();



} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}


function add_tr($data)
{
    return "<td>$data</td>" ;
}