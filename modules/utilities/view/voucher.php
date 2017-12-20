<?php ?>
<div class="wizard" data-initialize="wizard" id="myWizard">
<div class="steps-container">
	<ul class="steps">
		<li data-step="1" data-name="upload" class="active">
			<span class="badge">1</span>Create
			<span class="chevron"></span>
		</li>
		<li data-step="2">
			<span class="badge">2</span>Review
			<span class="chevron"></span>
		</li>
		<li data-step="3" data-name="install">
			<span class="badge">3</span>Print
			<span class="chevron"></span>
		</li>
	</ul>
</div>
<div class="actions">
	<button type="button" class="btn btn-default btn-prev">
		<span class="glyphicon glyphicon-arrow-left"></span>Prev</button>
	<button type="button" class="btn btn-primary btn-next" data-last="Complete">Next
		<span class="glyphicon glyphicon-arrow-right"></span>
	</button>
</div>
<div class="step-content">
	<div class="step-pane active sample-pane alert" data-step="1">

            <form role="form" id="modal_form">


<div class="form-group">
  <label for="m_name">To Address:</label>
  <input type="text" name="mem_name" class="form-control" id="m_name" value="">
</div>

<div class="form-group">
  <label for="m_date">Date:</label>
  <input type="date" name="mem_date" class="form-control" id="m_date" >
</div>




<div class="form-group">
  <label for="m_amt">Amount:</label>
   <input type="number" class="form-control" name="mem_amt" id="m_amt" value="0"  required min="1" step="any"> 
</div>

<button class="btn btn-success" type="submit" id="table-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>

</form>

<!--label class="checkbox-custom checkbox-inline" data-initialize="checkbox"  id="myCheckbox5">
  <input class="sr-only" type="checkbox" value="all"> <span class="checkbox-label">Update base membership</span>
</label-->

<div id="status">
   
</div>
            
            

	</div>
	<div class="step-pane sample-pane  alert" data-step="2">
		<h4>Choose Recipients</h4>
		<div id="up_status" ></div>
	</div>
	<div class="step-pane sample-pane  alert" data-step="3">
		<h4>Post Install</h4>
		<div id="post_status" ></div>
	</div>
</div>


</div>



