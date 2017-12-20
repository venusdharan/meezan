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
$home = new content("Create New Membership Plan","Welcome user");
$table = '
<form role="form" id="modal_form">




<div class="form-group">
  <label for="m_house" >House owner inclusion:</label>
  <!--input type="date" class="form-control" id="m_house"-->
    <select class="input-large selectpicker form-control" id="m_house" name="mem_house_owner" required>
      <option value="0">ALL</option>
      <option value="1">House Owners</option>
      <option value="2">Non House Owners</option>
      
    </select>
</div>

<div class="form-group">
  <label for="m_dis" >Disability:</label>
    <select class="input-large selectpicker form-control" id="m_dis" name="mem_dis" required>
      <option value="0">ALL</option>
      <option value="1">No</option>
      <option value="2">Yes</option> 
    </select>
</div>

<div class="form-group">
  <label for="m_gender" >Gender?:</label>
    <select class="input-large selectpicker form-control" id="m_gender" name="mem_gender" required>
      <option value="0">All</option>
      <option value="1">Male</option> 
      <option value="2">Female</option> 
    </select>
</div>

<div class="form-group">
  <label for="m_gender" >Martial Status:</label>
    <select class="input-large selectpicker form-control" id="m_gender" name="mem_married" required>
      <option value="0">All</option>
      <option value="1">Married</option> 
      <option value="2">Not Married</option> 
    </select>
</div>

<div class="form-group">
  <label for="m_age">Minimum age(0 for adding all age groups):</label>
   <input type="number" name="mem_age" class="form-control" id="m_age" value="0" name="mem_age" required> 
</div>

<div class="form-group">
  <label for="m_nri">Country:</label>
    <select name="mem_nri" class="input-large selectpicker form-control" id="m_nri" name="mem_nri" required>
      <option value="0">ALL</option>
      <option value="1">NRI</option> 
    </select>
</div>

<div class="form-group">
  <label for="m_base_mem">Blood Group:</label>
    <select class="input-large selectpicker form-control" id="m_base_mem" name="mem_bloodgroup" required>
            <option value="0">ALL</option>            
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option> 
    </select>
</div>




<button class="btn btn-success" type="submit" id="table-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Generate Report</button>

</form>

<!--label class="checkbox-custom checkbox-inline" data-initialize="checkbox"  id="myCheckbox5">
  <input class="sr-only" type="checkbox" value="all"> <span class="checkbox-label">Update base membership</span>
</label-->

<div id="status">
   
</div>







</br></br>


'
        
        
        ;
$get = new GetListner();
$panel_array = array();
array_push($panel_array, $get->get_post_value("data"));
array_push($panel_array, $table);

$row = createrows($panel_array, 1, "col-lg-4");
echo  $home->getContent($row) ;
