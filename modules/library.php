<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function load_library($name)
{
   include_once '../theme/$name.php';
}

function load_config($name)
{
    include_once '../config/$name.php';
}