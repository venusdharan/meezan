<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
include_once '../core/GetListner.php';
$home = new content("Member ward","Welcome user");
$table_ctl = '
<div id="add-controls">
<button class="btn btn-success" id="table-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>
</div>
<!--div id="table-controls">
<button class="btn btn-info" id="table-edit"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit</button>
<button class="btn btn-danger" id="table-delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
</div>
<br-->';
        $table='
    <table id="ward_table" class="table table-striped">
    <thead>
      <tr>
        <th>Ward Name</th>
        <th>Operation</th>
      </tr>
    </thead>
	<tbody>
      
	</tbody>
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
          <div class="form-group">
            <label for="ward">New Ward Name:</label>
            <input type="text" class="form-control" id="ward">
          </div>
        </div>
        <div class="modal-footer">
          <button  class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <button  class="btn btn-default btn-success pull-left" data-dismiss="modal" id="modal_sub"><span class="glyphicon glyphicon-off"></span>Apply</button>
        </div>
      </div>
    </div>
  </div> '
        
        
        ;


if($_SESSION["read_only"] == "No")
       {
          $tc = $table_ctl.$table; 
       }else
       {
           $tc = $table;
       }
$get = new GetListner();
$panel_array = array();
array_push($panel_array, $tc);
$row = createrows($panel_array, 1, "col-lg-12");
echo  $home->getContent($row) ;
