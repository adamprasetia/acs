<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Welcome to ACS 1.0</title>
	<link href="<?php echo base_url('assets/img/avengers.jpg')?>" rel="shortcut icon" type="image/x-icon"/>	
	
	<link href="<?php echo base_url('../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('../assets/AdminLTE-2.1.1/dist/css/AdminLTE.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('../assets/AdminLTE-2.1.1/dist/css/skins/_all-skins.min.css')?>" type="text/css" rel="stylesheet"/>	
	<link href="<?php echo base_url('assets/css/signin.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('assets/css/style.css')?>" type="text/css" rel="stylesheet"/>
</head>
<body class="skin-green">
    <header class="main-header">
      <?php echo anchor('dashboard','<span class="logo-mini">'.img(array('src'=>'assets/img/logo.png')).'</span><span class="logo-lg">'.img(array('src'=>'assets/img/logo.png')).' ACS 2.0</span>',array('class'=>'logo'))?>
      <nav class="navbar navbar-static-top" role="navigation">
      </nav>
    </header>	
    <div class="container">
			<?php echo form_open('login',array('class'=>'form-signin box box-default'))?>
				<div class="box-body">
					<h2 class="form-signin-heading">Please sign in</h2>
					<?php echo validation_errors()?>
					<label for="username" class="sr-only">Username</label>
					<input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" required autofocus>
					<label for="password" class="sr-only">Password</label>
					<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
				</div>
				<div class="box-footer">
					<strong>Copyright &copy; 2016 <a href="#">ADirect</a>.</strong> All rights reserved.
				</div>
			<?php echo form_close()?>
    </div>
</body>
</html>