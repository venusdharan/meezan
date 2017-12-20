<?php

include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';
$home = new content("Module Installer","Install new module");
$test_info = getinfobox("bg-red", "fa fa-users", "Triotrack uers", "6", false, "0", "Running ok!");
$panel_array = array();
//array_push($panel_array, $test_info);
//array_push($panel_array, $test_info);
//array_push($panel_array, $test_info);
array_push($panel_array,
  '
      
<div class="wizard" data-initialize="wizard" id="myWizard">
<div class="steps-container">
	<ul class="steps">
		<li data-step="1" data-name="upload" class="active">
			<span class="badge">1</span>Upload
			<span class="chevron"></span>
		</li>
		<li data-step="2">
			<span class="badge">2</span>Review
			<span class="chevron"></span>
		</li>
		<li data-step="3" data-name="install">
			<span class="badge">3</span>Install
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
		<!--h4>Setup Campaign</h4>
		<p>Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic. Beetroot water spinach okra water chestnut ricebean pea catsear courgette.</p-->
                <form  action="/file-upload" id="uploader" class="dropzone">
  <div class="fallback">
    <input name="file" enctype="multipart/form-data" type="file" single />
  </div>
</form>

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


'      
);

$row = createrows($panel_array, 2, "col-lg-12");
echo  $home->getContent($row) ;

