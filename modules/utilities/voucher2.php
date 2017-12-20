<?php

include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
$home = new content("Module Installer","Install new module");
$test_info = getinfobox("bg-red", "fa fa-users", "Triotrack uers", "6", false, "0", "Running ok!");
$panel_array = array();
//array_push($panel_array, $test_info);
//array_push($panel_array, $test_info);
//array_push($panel_array, $test_info);
array_push($panel_array,
 eval ('?>' .file_get_contents( 'view/voucher.php',true)    .'<?php' )
);

$row = createrows($panel_array, 1, "col-lg-12");
echo  $home->getContent($row) ;

