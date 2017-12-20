<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
include_once '../core/GetListner.php';
$home = new content("Members Data","Welcome user");
$table_ctl = '
<div id="add-controls">
<button class="btn btn-success" id="table-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>
<button class="btn btn-danger" id="table-print"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Print</button>
</div>
<div id="table-controls">
<button class="btn btn-info" id="table-edit"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit</button>
<button class="btn btn-danger" id="table-delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>

</div>';

$table ='<br>
      <table cellpadding="0" cellspacing="0" border="0" class="dataTable table  "  id="example">
     
<tfoot><th></th></tfoot>
      </table>
      <br>
        <!-- Modal -->
  <div class="modal  fade in" id="myModal" role="dialog">
    <div class="">

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
          <button  class="btn btn-default btn-success pull-left" type="button" id="modal_sub"><span class="glyphicon glyphicon-off"></span>Apply</button>
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
