<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
include_once '../core/GetListner.php';
$home = new content("Day Book","Welcome user");
$table = '

<!--div id="add-controls">
<button class="btn btn-success" id="table-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>
</div>
<div id="table-controls">
<button class="btn btn-info" id="table-edit"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit</button>
<button class="btn btn-danger" id="table-delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
</div-->

' 
        ;


$tables = array();
array_push($tables,'<h3>Income Data</h3><table cellpadding="0" style="border-collapse: collapse; border: 1px solid black;" cellspacing="0" border="0" class="dataTable table " id="example">
</table>');

array_push($tables,'<h3>Expense Data</h3><table cellpadding="0" style="border-collapse: collapse; border: 1px solid black;"  cellspacing="0" border="0" class="dataTable table " id="example1">
</table>');

$controls = array();
array_push($controls, $table);

$panel_array = array();
$datepick = array();
//array_push($panel_array, $get->get_post_value("data"));

array_push($datepick, '<div class="form-group">
  <label for="m_age">Date:(DD-MM-YYYY)</label>
   <input type="date" name="mem_age" class="form-control" id="ddate"  name="mem_age" required> 
</div>');
array_push($datepick,'<div class="form-group">
                <label>&nbsp;</label>
                <div class="input-group ">                  
                 <button class="btn btn-success" id="gtdata">Get data</button> &nbsp;&nbsp;&nbsp; <button class="btn btn-warning" id="printdata">Print Data</button>
                </div>
                <!-- /.input group -->
              </div>');
$table_ctl = createrows($controls, 1, "col-lg-12");
$row = createrows($tables, 2, "col-lg-6");
$row1 = createrows($datepick, 3, "col-lg-4");
echo  $home->getContent($table_ctl.$row1.$row) ;
