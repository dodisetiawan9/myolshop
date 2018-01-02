<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Myolshop</title>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/materialize.min.css">
  <!-- Font-Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
  <!-- customCss -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">

  <style media="screen">
  	body{
  		background: #022f53;
  		color: #fff;
  	}
  	.form {
  		background: #fefefe;
  		color: #777777;
  	}
  	.action {
  		margin: 20px auto;
  	}
  	hr {
  		margin-top: 5px;
  		margin-bottom: 30px;
  		border: 0px;
  		border-top: 1px solid #00a7c4;
  	}
  	.row .col {
  		padding:5px 30px;
  	}

  	.btn {
  		display: inline;
  		padding: 6px 10px;
  		margin-top: 0;
  		font-size: 14px;
  		font-weight: normal;
  		line-height: 1.42857143;
  		text-align: center;
  		white-space: nowrap;
  		vertical-align: middle;
  		-ms-touch-action: manipulation;
  				touch-action: manipulation;
  		cusrsor: pointer;
  		-webkit-user-select: none;
  			-moz-user-select: none;
  			-ms-user-select: none;
  					user-select: none;
  		background-image: none;
  		border: 1px solid transparent;
  		border-radius: 1px;	
  	}

  	.alert {
  		padding: 15px;
  		margin-top: 20px;
  		border: 1 px solid transparent;
  		border-radius: 	4px;
  	}

  	.alert-success {
  		color: #3c763d;
  		background-color: #dff0d8;
  		border-color: #d6e9c6;
  	}
  </style>
</head>
<body>
	<div class="row">
		<center>
			<h2 style="margin-top: 5%;"><i class="fa fa-shopping-cart" style="border-radius:50px; border:2px solid #fff; padding: 5px;"></i> Myolshop</h2>
		</center>

		<?php 
			if($this->session->flashdata('alert'))
			{
				echo $this->session->flashdata('alert');
			} 
		?>

		<div class="col m4 s12 offset-m4 form">
			<form action="" method="post">
				<h4><i class="fa fa-user"></i> Please sign in..</h4>
				<hr />

				<?php echo validation_errors('<p style="color:red;">','</p>'); ?>
				<div class="input-field">
					<input type="text" id="username" class="validate" name="username">
					<label for="username">Email / Username</label>
				</div>

				<div class="input-field">
					<input type="password" id="password" class="validate" name="password">
					<label for="password"> Password</label>
				</div>
				
				<div class="action right">
					<a href="<?= base_url(); ?>lost_user" class="btn white black-text">Lost Password..</a>
					<button type="submit" name="submit" value="Submit" class="btn blue">Sign in..</button>	
				</div>

			</form>
		</div>

		<div class="col m4 s12 offset-m4">
			<br />
			<center>
				Belum punya akun? Daftar <a href="<?= base_url(); ?>home/register">disini</a>
				<p><a href="<?= base_url(); ?>home" style="font-size: 30px;"><i class="fa fa-home"></i> Back to Home</a></p>	
			</center>
		</div>
	</div>

	<!-- Jquery -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
  <!-- materialize -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/js/materialize.min.js"></script>
  <!-- custom -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/js/custom.js"></script>
</body>
</html>