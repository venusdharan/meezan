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
$home = new content("Search Bloodgroup","Welcome user");
$table = '

<div id="add-controls">
<!--button class="btn btn-success" id="table-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button-->
</div>
<div id="table-controls">
<!--button class="btn btn-info" id="table-edit"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit</button-->
<!--button class="btn btn-danger" id="table-delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button-->
</div>



<br>
      <table cellpadding="0" cellspacing="0" border="0" class="dataTable table " id="example">
<tfoot><th></th></tfoot>
      </table>
      <br>
        <!-- Modal -->
  <div class="modal fade in" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="modaltitle"></h4>
        </div>
        <div class="modal-body">
          <form role="form" id="modal_form">
            <div id="modal_inputs">
            </div>  
          </form>
        </div>
        <div class="modal-footer">
          <button  class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <button  class="btn btn-default btn-success pull-left" data-dismiss="modal" id="modal_sub"><span class="glyphicon glyphicon-off"></span>Apply</button>
        </div>
      </div>
    </div>
  </div> '
        
        
        ;
$get = new GetListner();
$panel_array = array();
array_push($panel_array, $get->get_post_value("data"));
array_push($panel_array, $table);

$row = createrows($panel_array, 1, "col-lg-12");
echo  $home->getContent(
        
     '<div class="row">
      
<div class="col-lg-2">

<div class="form-group">
  <label for="sel1">Select Bloodgroup:</label>
  <select class="form-control" id="sel1">
    <option>A+</option>
    <option>A-</option>
    <option>B+</option>
    <option>B-</option>
     <option>O+</option>
      <option>O-</option>
       <option>AB+</option>
        <option>AB-</option>
  </select>
</div>

</div>
</div>
        
        '.$row) ;
