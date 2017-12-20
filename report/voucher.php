<?php
ini_set("memory_limit","128M");

if(isset($_GET['id']) and isset($_GET['type']))
{
    
    if($_GET['id'] != "" AND $_GET['type'] != "")
    {

        $id = $_GET['id'];
        $ptype = $_GET['type'];
include_once '../config/db_settings.php';

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$vname = "";
$invoice_num = "";
$mazjid_add = "";
$desig_address = "";
$specif = "";
$date = "";
$amoun = "";
$item = "";
$myXMLData = file_get_contents("../mizan.info");
$xml=new SimpleXMLElement($myXMLData);

$sql = "SELECT * FROM $ptype  WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["id"]. " - Name: " . $row["uname"]. " " . $row["housename"]. "<br>";
        $vname = $row["type"];
        $invoice_num = $id;
        $desig_address = $row["des"];
        $date = $row["date"];
        $amoun = $row["amount"];
        $item = $row["pay_id"];
        
    }
} else {
    
}


$table_start = "<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Voucher Meezan ERP</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
       /* border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);*/
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
       /* font-size: 45px;
        line-height: 45px;*/
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.i2 table td {
        padding-top: 40px;
    }
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: 20px solid;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class='invoice-box'>
        <table cellpadding='0' cellspacing='0'>
            <tr class='top'>
                <td colspan='2'>
                    <table>
                        <tr>
                            <td class='title'>
                                <h1 style='width:100%; max-width:300px; font-size: 50px;'>$vname</h1>
                            </td>
                            
                            <td>
                                Invoice #: $id<br>
                                Created (YMD):$date<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class='information'>
                <td colspan='2'>
                    <table>
                        <tr>
                            <td>
                               ".$xml->Address."
                            </td>
                            
                            <td>
                                $desig_address
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <!--tr class='heading'>
                <td>
                    Payment Method
                </td>
                
                <td>
                    Check #
                </td>
            </tr>
            
            <tr class='details'>
                <td>
                    Check
                </td>
                
                <td>
                    1000
                </td>
            </tr-->
            
            <tr class='heading'>
                <td>
                     Details
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <tr class='item'>
                <td>
                    $item
                </td>
                
                <td>
                    $amoun
                </td>
            </tr>

            <tr class='i2'>
                <td colspan='2'>
                    <table>
                        <tr>
                            <td>
                               Sign:____________________________
                            </td>
                            
                            <td>
                                Total:&#8377; $amoun /-
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>"
        ;

/*
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
    
}

$table_start = $table_start."</table></body>
</html>";

//echo $table_start;


$conn->close();
 * 
 */

try {

require_once  '../lib/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
        'allow_output_buffering' => true,
        'orientation' => 'P',
        'format' => 'A4',

//	'margin_left' => 32,
//	'margin_right' => 25,
//	'margin_top' => 47,
//	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10
 
]);

$header = "<h2 style='text-align:center;'>".$xml->MasjidName."</h2> "
        ."<p style='text-align:center;'>".$xml->Address."</p>"
        . "<h3 style='text-align:center;'>Total Members Report</h3>"
      //  . "<p style='text-align:left;'>Date:".date("Y/m/d")
        ;
        

$footer = file_get_contents("footer.html");

//$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($table_start);
$mpdf->debug = true;
$mpdf->Output('Meezan Report.pdf', 'I');



} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}
    }
}

function add_tr($data)
{
    return "<td>$data</td>" ;
}