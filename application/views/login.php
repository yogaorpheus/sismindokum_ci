<!DOCTYPE html>
<html lang="en">
<head>
	<title>SISMINDOKUM - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/loginv2'); ?>/<?php echo base_url('assets/loginv2'); ?>/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginv2'); ?>/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter" style="background-color: #1c929c;">
		<br><br>
		<div align="middle" style="margin-bottom: -110px; margin-top: -6px">
			<img src="<?php echo base_url('assets/img'); ?>/logo_pjb_white_small.png" width="13%" height="13%">
		</div>
		
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="<?php echo base_url('auth/login'); ?>">
					<span class="login100-form-title p-b-48">
						<img src="<?php echo base_url('assets/img'); ?>/sismindokum_small.png" width="100%" height="100%">
					</span>

 					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nid" required>
						<span class="focus-input100" data-placeholder="NID"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Masukkan password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" required>
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
					<?php if ($this->session->flashdata('error') >= 1)
					{
					?>
					<div class="container-login100-form-btn" style="background-color : red;">
						<p style="color : white; text-align : center; vertical-align : middle;">Messages : <?php echo $this->session->flashdata('error_message'); ?></p>
					</div>
					<?php
					}
					?>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								MASUK
							</button>
						</div>
					</div>
				</form>
				
				<center style="margin-top: 15px; color: #bbb; font-size: 11px;">&copy; 2018 oleh BTIF<br/>PT Pembangkitan Jawa-Bali</center>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/loginv2'); ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/loginv2'); ?>/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/loginv2'); ?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url('assets/loginv2'); ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/loginv2'); ?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/loginv2'); ?>/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url('assets/loginv2'); ?>/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/loginv2'); ?>/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/loginv2'); ?>/js/main.js"></script>

</body>
</html>