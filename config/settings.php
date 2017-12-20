 <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$web_default_page_location = "pages";
$module_location = "modules";
$title = 'Triophore Technologies';
$copy_right = "Triophore Technologies";
$company_name = "Triophore Technologies";
$compnay_url = "#";
$site_root= "triophore";
$host = file_get_contents(__DIR__."/host.tas");
$port = file_get_contents(__DIR__."/port.tas");
$full_root="http://$host:$port/$site_root/";
function get_js($path,$full_root)
{
    echo "<script src='".$full_root.$path."'></script>";
}

function get_css($path,$full_r)
{
    echo "<link rel='stylesheet' href='".$full_r.$path."'>";
}

