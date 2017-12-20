<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
$home = new content("Home","Welcome user");
$test_info = getinfobox("bg-red", "fa fa-users", "Triotrack uers", "6", false, "0", "Running ok!");
$panel_array = array();
array_push($panel_array, $test_info);
array_push($panel_array, $test_info);
array_push($panel_array, $test_info);
array_push($panel_array, "<button class='btn btn-lg' id='home_btn'>click</button>");
$row = createrows($panel_array, 4, "col-lg-3");
echo  $home->getContent($row) ;
