<?php

include_once './core/ModuleMenu.php';

$mainmenu = new ModuleMenu("Lebl",'fa fa-circle-o');
$testmenu = new SingleMenu('path','path-ex','fa fa-circle-o',"linl");
$mainmenu->AddSubMenu($testmenu->GetLink());


// echo $mainmenu->GetLink();

$d = '[{"name":"undefined","value":""},{"name":"undefined","value":""},{"name":"undefined","value":""},{"name":"bloodgroup","value":"A-"},{"name":"gender","value":"Male"},{"name":"owner","value":"Yes"},{"name":"undefined","value":"Yes"},{"name":"undefined","value":""},{"name":"ward","value":"145"},{"name":"category","value":"dfsdf"},{"name":"undefined","value":""},{"name":"undefined","value":""},{"name":"undefined","value":""},{"name":"undefined","value":""}]';

$ar = json_decode($d,true);

var_dump($ar[0]);