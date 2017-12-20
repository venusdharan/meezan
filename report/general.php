<?php
ini_set("memory_limit","128M");

if(isset($_GET['data']) AND isset($_GET['title']))
{
    if($_GET['data'] != "" AND $_GET['title'] != "")
    {
        




$myXMLData = file_get_contents("../mizan.info");
$xml=new SimpleXMLElement($myXMLData);

$title = $_GET['title'];

$data = base64_decode($_GET['data']);

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
'.$data.'
</table></body>
</html>
 ';




echo $table_start;


//try {
//
//require_once  '../lib/vendor/autoload.php';
//$mpdf = new \Mpdf\Mpdf([
//        'allow_output_buffering' => true,
//        'orientation' => 'L',
//        'format' => 'A4-L',
//
//	//'margin_left' => 32,
//	//'margin_right' => 25,
//	'margin_top' => 65,
//	'margin_bottom' => 47,
//	'margin_header' => 10,
//	'margin_footer' => 10
// 
//]);
//
//$header = "<h2 style='text-align:center;'>".$xml->MasjidName."</h2> "
//        ."<p style='text-align:center;'>".$xml->Address."</p>"
//        . "<h3 style='text-align:center;'>$title</h3>"
//        . '<table width="100%" style="vertical-align: bottom;  
//    font-size: 8pt; color: #000000; font-weight: bold; ">
//    <tr>
//        <td width="25%">{DATE j-m-Y}</td>
//        <td width="25%" align="center">{PAGENO}/{nbpg}</td>
//        <td width="25%" style="text-align: right;">Meezan ERP</td>
//        <td width="25%" style="text-align: right;">&copy; Triophore Technologies</td>
//    </tr>
//</table>'
//        ;
//        
//
//$footer = file_get_contents("footer.html");
//
//$mpdf->SetHTMLHeader($header);
//$mpdf->SetHTMLFooter($footer);
//$mpdf->WriteHTML($table_start);
//$mpdf->debug = true;
//$mpdf->Output();
//
//
//
//} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
//    // Process the exception, log, print etc.
//    echo $e->getMessage();
//}

    }
}

function add_tr($data)
{
    return "<td>$data</td>" ;
}