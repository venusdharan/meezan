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
  <label for="m_name">Name:</label>
  <input type="text" name="mem_name" class="form-control" id="m_name" value="" required>
</div>

<div class="form-group">
  <label for="m_date">Date:</label>
  <input type="date" name="mem_date" class="form-control" id="m_date" required>
</div>

<div class="form-group">
  <label for="m_house" >House owner inclusion:</label>
  <!--input type="date" class="form-control" id="m_house"-->
    <select class="input-large selectpicker form-control" id="m_house" name="mem_house_owner" required>
      <option value="0">Include House-owners along with non House-owners</option>
      <option value="1">Include only House-owners and avoid non House-owners</option>
      <option value="2">Exclude House-owners and add only non House-owners</option>
      
    </select>
</div>

<div class="form-group">
  <label for="m_dis" >Include Disabled persons?:</label>
    <select class="input-large selectpicker form-control" id="m_dis" name="mem_dis" required>
      <option value="0">No</option>
      <option value="1">Yes</option> 
    </select>
</div>

<div class="form-group">
  <label for="m_gender" >Gender?:</label>
    <select class="input-large selectpicker form-control" id="m_gender" name="mem_gender" required>
      <option value="0">Male</option>
      <option value="1">Female</option> 
      <option value="2">Both Male and Female</option> 
    </select>
</div>

<div class="form-group">
  <label for="m_age">Minimum age(0 for adding all age groups):</label>
   <input type="number" name="mem_age" class="form-control" id="m_age" value="0" name="mem_age" required> 
</div>

<div class="form-group">
  <label for="m_nri">Include NRI?:</label>
    <select name="mem_nri" class="input-large selectpicker form-control" id="m_nri" name="mem_nri" required>
      <option value="0">No</option>
      <option value="1">Yes</option> 
    </select>
</div>

<div class="form-group">
  <label for="m_base_mem">Base membership:</label>
    <select class="input-large selectpicker form-control" id="m_base_mem" name="mem_base" required>
      <option value="0">Not depended on base membership</option>
      <option value="1">No leave it as it is, but add with base membership</option>
      <option value="2">Yes Update base membership with new amount</option> 
    </select>
</div>


<div class="form-group">
  <label for="m_amt">Amount:</label>
   <input type="number" class="form-control" name="mem_amt" id="m_amt" value="0"  required> 
</div>

<button class="btn btn-success" type="submit" id="table-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>

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
