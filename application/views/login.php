<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ELAPAS - ODECO</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/images/logo_elapas3.ico" />
	<!-- Global stylesheets -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> -->
	<link href="<?php echo base_url()?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/forms/styling/uniform.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/notifications/noty.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/pages/login_validation.js"></script>
	<!-- /theme JS files -->
	
</head>

<body class="login-container login-cover">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content pb-20">

					<!-- <?php
						// echo form_open("login/login", array('id'=>'frm_login', "method"=>"post"));
					?> -->
					<!-- <form action="index.html" class="form-validate"> -->
					<!-- <form id="frm_login" action="<?php echo base_url()?>Login/login" method="post"> -->
					<form class="form-horizontal" action="<?php echo base_url()?>login/login" method="POST">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<img src="<?php echo base_url()?>assets/images/logo_elapas3.jpg"></img>
								
								<h5 class="content-group">Ingrese a su cuenta <small class="display-block">Sus credenciales</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" placeholder="Username" name="username" value="" required="required">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password" value="123456" required="required">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="content-divider text-muted form-group"><span>-</span></div>

							<div class="form-group">
								<button type="submit" class="btn bg-blue btn-block " data-layout="topCenter" data-type="error">INGRESAR <i class="icon-arrow-right14 position-right"></i></button>
							</div>


							<?php if (validation_errors()) : ?>
								<div class="alert bg-danger">
									<button type="button" class="close" data-dismiss="alert"><span>&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<?= validation_errors() ?>
								</div>
							<?php endif; ?>

							<?php if (isset($error)) : ?>
								<div class="alert bg-danger">
									<button type="button" class="close" data-dismiss="alert"><span>&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<?= $error ?>
								</div>
							<?php endif; ?>

						</div>
					</form>
					<!-- /form with validation -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>

<script type="text/javascript">
	    $(document).ready(function (){
	        $("#frm_logins").submit(function (e){

	            e.preventDefault();
	            var url = $(this).attr('action');
	            var method = $(this).attr('method');
	            var data = $(this).serialize();
	            $.ajax({
	                url:url,
	                type:method,
	                data:data
	            }).done(function(data){
	                if(data !==' ')
	                {
	                    $("#response").show('fast');
	                    //$("#response").effect( "shake" );
	                    $('#frm_login')[0].reset();
	                }
	                else
	                {
	                    window.location.href='<?php echo base_url() ?>/principal';
	                    // window.location.href='/principal';
	                    // window.open('<?php echo base_url() ?>Login/inicio');
	                    // throw new Error('go');
	                }
	            });
	        });
	    });
	</script>

</html>

