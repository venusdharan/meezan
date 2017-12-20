<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function  createrows($column,$number,$attr)
{
    $cols = array_chunk($column, $number);
    $row = '';
    $col_val = '';
    $row_count = count($cols);
    for($r = 0;$r < $row_count;$r++)
    {
        $col_count = count($cols[$r]);
        $row_temp = '<div class="row">';
        $col_temp = '';
        for($c = 0;$c < $col_count ;$c++)
        {
            $col_temp = $col_temp.'<div class="'.$attr.'">'.$cols[$r][$c].'</div>';
        }
        $row = $row.$row_temp.$col_temp.'</div>';
    }
    return $row;
}

