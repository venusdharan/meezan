<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
include_once '../config/webinfo.php';
$home = new content("Home","Welcome user");
$test_info = getinfobox("bg-red", "fa fa-users", "Triotrack uers", "6", false, "0", "Running ok!");
$panel_array = array();
array_push($panel_array, $test_info);
array_push($panel_array, $test_info);
array_push($panel_array, '<img src="cinqueterre.jpg" id="profile" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"> <input id="img_url" style="display:none"/>');
array_push($panel_array, '<a href="../../'.$site_root.'/filemanager/dialog.php?type=0&field_id=img_url" class="btn iframe-btn" type="button">Open Filemanager</a>');
$row = createrows($panel_array, 2, "col-lg-3");
echo  $home->getContent($row) ;