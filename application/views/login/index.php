<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title><?php echo $this->config->item('company_name'); ?>:: LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
     <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
     
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body class="loginbody">
  
    <div class="container">		
		<div class="col-md-12 login-top-pad">&nbsp;</div>		
		<div class="col-md-4">&nbsp;</div>
		<div class="col-md-4">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title text-center"><b><?php echo $this->config->item('company_name'); ?> :: LOGIN</b></h3>
		  </div>          
		  <div style="color: red;margin: 0px 0px 0px 90px;">
		    <?php if(isset($msg)): echo $msg; endif; ?>
		  </div>		  
		  <div class="panel-body">		    
            <form role="form" action="<?php echo site_url("login/authenticate");?>" method="post" id="login"  name="login">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email Address</label>
			    <input type="email" name="email" class="form-control input-sm" id="email" placeholder="Enter email">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" name="password" class="form-control input-sm" id="password" placeholder="Enter Password">
			  </div>	
			  <div class="form-group text-center">
			  	 <button type="submit" class="btn btn-primary btn-sm" id="login"><i class="glyphicon glyphicon-check"></i> <strong>Login</strong></button>
			  </div>		
		  </form>		    
		  </div>
		</div>
      </div>		
	  <div class="col-md-4">&nbsp;</div>   
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>   
    <script src="<?php echo base_url('assets/js/login.js');?>"></script>
  </body>
  </html>
