
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sarvika Insider | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assetspath')?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assetspath')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assetspath')?>css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Sarvika</b>Insider</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

    	<?php echo form_open('',array('class'=>"ajaxform",'id'=>"loginformm",'name'=>"form122",'method'=>"post",'accept-charset'=>"utf-8")); ?>
      <div class="ajax_report alert" style="display:none">
				<button class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only"></span></button>
				<span class="ajax_message">Hello Message</span>
			</div> 
      <div class="input-group mb-3">
        <input name="username" id="username" class="form-control" placeholder="Enter mobile number or Email Id" type="text">
               <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input name="password" id="password" class="form-control" placeholder="Enter password" type="password">
              <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!--div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
          <p class="mb-1">
        <a href="forgot-password">I forgot my password</a>
      </p>
      </div-->
      <!-- /.social-auth-links -->

    
      <p class="mb-0">
        <a href="register" class="text-center">Register a new user</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo $this->config->item('assetspath')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $this->config->item('assetspath')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->config->item('assetspath')?>js/adminlte.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>js/jquery.form.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>js/formclass.js"></script>

</body>
</html>
