<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <?php 
  get_css("bower_components/bootstrap/dist/css/bootstrap.min.css",$full_root);
  get_css("bower_components/font-awesome/css/font-awesome.min.css","$full_root");
  get_css("bower_components/Ionicons/css/ionicons.min.css","$full_root");
  get_css("dist/css/AdminLTE.min.css",$full_root);
  get_css("bower_components/iCheck/skins/square/blue.css",$full_root);
  ?>
  
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
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
       
            <div id="modal_inputs">
            </div>  
          
        </div>
        <div class="modal-footer">
          <button  class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <button  class="btn btn-default btn-success pull-left" data-dismiss="modal" id="modal_sub"><span class="glyphicon glyphicon-off"></span>Apply</button>
        </div>
      </div>
    </div>
  </div>

    <input type="button" class="btn btn-success" id="gg" value="file" name="file-dlg" />    
<?php
get_js("bower_components/jquery/dist/jquery.min.js",$full_root);
get_js("bower_components/bootstrap/dist/js/bootstrap.min.js",$full_root);
get_js("bower_components/iCheck/icheck.min.js",$full_root);
?>
    
    <script>
        $(document).ready(function(){
            $("#gg").click(function(){
               
                    $('.modal-body').html('<iframe src="filemanager/dialog.php" style="width:100%; height:100%;" /> ');
                
                $('#myModal').modal({
                backdrop: 'static',
                keyboard: false,
                show:true,
                height:'50%',
                width:'70%'
                });
            });
        });
        </script>
</body>
</html>