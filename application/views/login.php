<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Welcome to ACS 1.0</title>
	<link href="<?=base_url('assets/img/avengers.jpg')?>" rel="shortcut icon" type="image/x-icon"/>	
	
	<link href="<?=base_url('../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('assets/css/signin.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('assets/css/style.css')?>" type="text/css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
		<?=form_open('login',array('class'=>'form-signin'))?>
			<h2 class="form-signin-heading">Please sign in</h2>
			<?=validation_errors()?>
			<label for="username" class="sr-only">Username</label>
			<input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" required autofocus>
			<label for="password" class="sr-only">Password</label>
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		<?=form_close()?>
    </div>
</body>
</html>