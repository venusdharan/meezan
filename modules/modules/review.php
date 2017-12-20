<?php
session_start();
if(isset($_SESSION['module_install_name']))
{
    $fl = $_SESSION['module_install_name'];
    $fl = str_replace(".amp","", $fl);
    $filename ='sandbox/'. $fl . '/info.json';
    
    include_once '../../core/AsterdaModulePackage.php';
    
    $module = new AsterdaModulePackage();
    if($module->load_module('sandbox/',$fl))
    {
    $name =  $module->get_name();
    $ver = $module->get_version();
    $author = $module->get_author();
    $lis = $module->get_author();
    $uri = $module->get_url();
    
   
        
        $rev = "<form class='form-horizontal'>
<fieldset>


<!-- change col-sm-N to reflect how you would like your column spacing (http://getbootstrap.com/css/#forms-control-sizes) -->


<!-- Form Name -->
<legend>Module Data</legend>

<!-- Text input http://getbootstrap.com/css/#forms -->
<div class='form-group'>
  <label for='m_name' class='control-label col-sm-2'>Name</label>
  <div class='col-sm-10'>
    <input type='text' class='form-control' id='m_name' placeholder='' disabled='' value='$name'>
    
  </div>
</div>
<!-- Text input http://getbootstrap.com/css/#forms -->
<div class='form-group'>
  <label for='m_ver' class='control-label col-sm-2'>Version</label>
  <div class='col-sm-10'>
    <input type='text' class='form-control' id='m_ver' placeholder='' disabled=''>
    
  </div>
</div>
<!-- Text input http://getbootstrap.com/css/#forms -->
<div class='form-group'>
  <label for='m_auth' class='control-label col-sm-2'>Author</label>
  <div class='col-sm-10'>
    <input type='text' class='form-control' id='m_auth' placeholder='' readonly='' disabled='' value='$author'>
    
  </div>
</div>
<!-- Text input http://getbootstrap.com/css/#forms -->
<div class='form-group'>
  <label for='m_url' class='control-label col-sm-2'>Url</label>
  <div class='col-sm-10'>
    <!--input type='text' class='form-control' id='m_url' placeholder='' disabled='' value='$uri'-->
    <a href='$uri' target='_blank' style='color:black;'>$uri</a>
  </div>
</div>
<!-- Textarea http://getbootstrap.com/css/#textarea -->
<div class='form-group'>
  <label class='control-label col-sm-2' for='textarea'>Dependencies</label>
  <div class='col-sm-10'>
    <textarea class='form-control' id='textarea' name='textarea' rows='4' disabled=''>$lis</textarea>
    
  </div>
</div>

<!-- Textarea http://getbootstrap.com/css/#textarea -->
<div class='form-group'>
  <label class='control-label col-sm-2' for='m_lis'>Liscence</label>
  <div class='col-sm-10'>
    <textarea class='form-control' id='m_lis' name='m_lis' rows='5' disabled=''></textarea>
    
  </div>
</div>
<button type='button' id='btninstall' class='btn btn-block btn-success btn-flat'>Accept and Install</button>

</fieldset>
</form>
";
        echo $rev;
 
    
}
 else {
 
     echo "<div class='callout callout-danger'>
                <h4>Module install failed!</h4>
                <p>The file uploaded was not a valid module package</p>
              </div>";
 }

//echo $filename ='sandbox/'. $fl . '/info.json';
}
exit();


