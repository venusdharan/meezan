<?php

include_once '../../core/ModuleResource.php';

$res = new ModuleResource('home');
$res->AddBaseCss('css');
$res->AddBaseJS('js');
$res->AddMain('home.js');
$res->GetResource();



$data = array(
    'name' => 'home',
    'basejs' => 'js',
    'basecss' => 'css',
    'basemain' => 'home.js',
    'js' => array(),
    'css' => array()
);

//echo json_encode($data);