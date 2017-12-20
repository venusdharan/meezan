<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

  "js":["datatables.min.js","bootstrap-datepicker.min.js","dataTables.colReorder.min.js"],
    "css":["datatables.bootstrap.min.css","table.css","bootstrap-datepicker.min.css","dataTables.colReorder.min.css"]

 * 
 * 
 * 
 * */
include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
include_once '../core/GetListner.php';
$home = new content("Membership Data","Welcome user");
$table = '

<div id="add-controls">
<button class="btn btn-success" id="table-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Save</button>
</div>
<div id="table-controls">
<!--button class="btn btn-info" id="table-edit"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit</button-->
<!--button class="btn btn-danger" id="table-delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button-->
</div>
<br>
      <!--table cellpadding="0" cellspacing="0" border="0" class="dataTable table " id="example">

      </table-->
      
<section>
                    <h2>Select modules for the user</h2>
                    


                    <ul id="mod_list" class="list-group ">
                    
                        <!--li class="list-group-item" draggable="true"><strong>Cras justo odio</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  class="btn btn-sm btn-danger">Remove</button></li>
                        <li class="list-group-item" draggable="true"><strong>Cras justo odio</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  class="btn btn-sm btn-danger">Remove</button></li>
                        <li class="list-group-item" draggable="true"><strong>Cras justo odio</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  class="btn btn-sm btn-danger">Remove</button></li>
                        <li class="list-group-item" draggable="true"><strong>Cras justo odio</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  class="btn btn-sm btn-danger">Remove</button></li>
                        <li class="list-group-item" draggable="true"><strong>Cras justo odio</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  class="btn btn-sm btn-danger">Remove</button></li-->
                    </ul>
                </section>

      <br>
        <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
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
            <div class="form-group">
  <label for="sel1">Modules:</label>
  <select class="form-control" id="mod_sel">
  </select>
</div>
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
$cp = array();
$panel_array = array();
array_push($panel_array, $get->get_post_value("data"));
array_push($panel_array, $table);

//array_push($cp,'');
array_push($cp,'<div class="form-group">
  <label for="sel1">Users:</label>
  <select class="form-control" id="user_sel">
  </select>
</div>');
$row = createrows($panel_array, 1, "col-lg-4");
$row1 = createrows($cp, 1, "col-lg-3");
echo  $home->getContent($row1.$row) ;
