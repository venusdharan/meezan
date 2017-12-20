<?php
include_once './config/settings.php';
include_once './config/webinfo.php';
$site_root= "triophore";
$full_root="http://localhost/$site_root/";
include_once './core/SessionStart.php';
include_once './ops/auth.php';

if(check_auth())
{
    echo "<script>window.location.replace('$full_root"."dashboard#home');</script>";
    exit();
}
/*
if(isset($_POST['email']) AND isset($_POST['password']))
{
    if($_POST['email'] != "" && $_POST['password'] != "")
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        include_once './ops/login.php';
        //echo '<div class="alert alert-danger"><strong>Login failed!</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eamil and paasword mismatch!.</div>';
        //echo "<script>window.location='dashboard#home';</script>";
        exit();
    }
    exit();
}
 * 
 */
?>
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
  
  <style>
     body {  
    background: url('mecca.jpg') no-repeat;
    background-size: 100%;
}


footer {
    background-color:white;
    position: absolute;
    left: 0;
    bottom: 0;
    height: 20px;
    width: 100%;
    overflow:hidden;
}
  </style>
</head>
<body class="hold-transition ">
<div class="login-box">
    <div class="login-logo" >
    <a href="#" style="color:white;"><b>Mizan</b>ERP</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="login">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="email" placeholder="Username">
        <span class="glyphicon glyphicon-user  form-control-feedback" ></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
        </br>
        </br>
       
      </div>
    </form>
 <div id="status"></div>
    <!--div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div-->
    <!-- /.social-auth-links -->

    <!--a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a-->

  </div>
  <!-- /.login-box-body -->
 
  
  
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<?php
get_js("bower_components/jquery/dist/jquery.min.js",$full_root);
get_js("bower_components/bootstrap/dist/js/bootstrap.min.js",$full_root);
get_js("bower_components/iCheck/icheck.min.js",$full_root);
?>




<script>
 $(function () {
     //login-page
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    $("#login").submit(function(e){
        e.preventDefault();
        $("#status").html('');
        var post_data  = $(this).serializeObject();
       // console.log(post_data);
       $.post("",post_data,function(data,status){
            if(status == "success")
            {
                console.log(data);
                if(status.trim() == "success")
                {
                    if(data.trim() == "failed")
                    {
                    $("#status").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Login failed!</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username | Password incorrect!.</div>');
                    }
                    if(data.trim() == "success")
                    {
                      window.location.href = '<?php echo $full_root."dashboard#home" ;?>';
                    }
                }
            }
       });
       return false;
    });
    
});
  $.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
}; 

 $(document).on("click", ".cre", function(e) {
          var href = $(this).attr('data-href');
   callbackObj.openProcess(href);
        return false;
    });

</script>
<!--footer class="main-footer" style="position: fixed; bottom: 0px; width:100%;">
  <strong>Copyright &copy; 2016 <a href="<?php echo compnay_url; ?>"><?php echo company_name; ?></a>.</strong> All rights reserved.
</footer-->

<footer>
   <strong>Copyright &copy; 2016 <a  class="cre" href="#"  data-href="http://www.triophore.com"><?php echo company_name; ?></a>.</strong> All rights reserved. 
</footer>
</body>
</html>
