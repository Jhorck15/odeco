<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta http-equiv="Content-Type"  content="text/html; charset=UTF-8">
	<title>ELAPAS - ODECO</title>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/images/logo_elapas3.ico" />
	<!-- Global stylesheets -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> -->

	<link href="<?php echo base_url();?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<link href="<?php echo base_url('assets/datetimepicker/css/bootstrap-datetimepicker.min.css')?>" rel="stylesheet" media="screen">

	<!-- css martin -->
	<link href="<?php echo base_url('assets/css/bootmani.css')?>" rel="stylesheet" media="screen">	
	<!-- css martin -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/inputs/autosize.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/inputs/formatter.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/inputs/typeahead/handlebars.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/inputs/passy.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/inputs/maxlength.min.js"></script>
	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/app.js"></script>
	<!-- /theme JS files -->

	<!-- Theme JS files DATATABLE -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/pages/datatables_basic.js"></script>
	<!-- /theme JS files DATATABLE-->
	
	<!-- DATETIMEPICKER -->
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/datetimepicker/js/bootstrap-datetimepicker.min.js')?>"></script>

    <!-- Theme JS files MASK MASCARAS-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<!-- /theme JS files -->

	<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/forms/selects/bootstrap_select.min.js"></script> -->

	<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/core/app.js"></script> -->
	<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/pages/form_bootstrap_select.js"></script> -->

	<!-- Theme JS files  subir archivos e imagenes -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/uploaders/fileinput.min.js"></script>
	<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/pages/uploader_bootstrap.js"></script> -->
	<!-- /theme JS files -->

	<script type="text/javascript">
		
		function funcnumero (){
		$.get('<?php echo base_url('cprincipal/numero') ?>', function(data) {
				// alert(data);
				var fr = $.parseJSON(data);
		// alert(fr);
				// $.each(fr, function(index, val) {
					// $('#numeroreg').text();		
					$('#numeroreg').text(data);
					$('#nom_reclamo').text(data);

				// });
			});
		
		// return $data;
		};

		

		// console.log(funcnumero());
		// console.log(numeroreg);
	
		

	$(document).ready(function(){
		funcnumero();	
	});
	$.get('<?php echo base_url('cprincipal/odecos') ?>', function(data) {
			// alert(data);
			// var fr = $.parseJSON(data);				
				$('#odeco_num').text(data);					
	});	

	
	</script>

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="assets/images/barra_elapas.jpg" alt="" width="100" height="150"></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

				<li class="dropdown">
					<!-- class="dropdown-toggle" data-toggle="dropdown" -->
					<a href="<?php echo base_url()?>Cterm_odeco" >
						<i class="icon-git-compare"></i>
						<span class="visible-xs-inline-block position-right">Git updates</span>
						<span class="badge bg-warning-400" id="odeco_num" name="odeco_num" >9</span>
					</a>
					

				</li>
			</ul>

			<p class="navbar-text"><span class="label bg-success">Online</span></p>

			<ul class="nav navbar-nav navbar-right">
				<!-- <li class="dropdown language-switch">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/flags/gb.png" class="position-left" alt="">
						English
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li><a class="deutsch"><img src="assets/images/flags/de.png" alt=""> Deutsch</a></li>
						<li><a class="ukrainian"><img src="assets/images/flags/ua.png" alt=""> Українська</a></li>
						<li><a class="english"><img src="assets/images/flags/gb.png" alt=""> English</a></li>
						<li><a class="espana"><img src="assets/images/flags/es.png" alt=""> España</a></li>
						<li><a class="russian"><img src="assets/images/flags/ru.png" alt=""> Русский</a></li>
					</ul>
				</li> -->

				<li class="dropdown">
					<!-- class="dropdown-toggle" data-toggle="dropdown" -->
					<a href="<?php echo base_url()?>cprincipal" >
						<i class="icon-bubbles4"></i>
						<span class="visible-xs-inline-block position-right">Messages</span>
						<span class="badge bg-warning-400" name="numeroreg" id="numeroreg"></span>
					</a>
					
					<!-- <div class="dropdown-menu dropdown-content width-350">
						<div class="dropdown-content-heading">
							Messages
							<ul class="icons-list">
								<li><a href="#"><i class="icon-compose"></i></a></li>
							</ul>
						</div>

						<ul class="media-list dropdown-content-body">
							<li class="media">
								<div class="media-left">
									<img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
									<span class="badge bg-danger-400 media-badge">5</span>
								</div>

								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">James Alexander</span>
										<span class="media-annotation pull-right">04:58</span>
									</a>

									<span class="text-muted">who knows, maybe that would be the best thing for me...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
									<span class="badge bg-danger-400 media-badge">4</span>
								</div>

								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Margo Baker</span>
										<span class="media-annotation pull-right">12:16</span>
									</a>

									<span class="text-muted">That was something he was unable to do because...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Jeremy Victorino</span>
										<span class="media-annotation pull-right">22:48</span>
									</a>

									<span class="text-muted">But that would be extremely strained and suspicious...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Beatrix Diaz</span>
										<span class="media-annotation pull-right">Tue</span>
									</a>

									<span class="text-muted">What a strenuous career it is that I've chosen...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Richard Vango</span>
										<span class="media-annotation pull-right">Mon</span>
									</a>
									
									<span class="text-muted">Other travelling salesmen live a life of luxury...</span>
								</div>
							</li>
						</ul>

						<div class="dropdown-content-footer">
							<a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
						</div>
					</div> -->
				</li>

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url('assets/images/ela/sill.png') ?>" alt="">
						<span name="nomuser" id="nomuser"></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-plus"></i> Mi cuenta</a></li>
						<li><a href="#" onclick="odeco()"><i class="icon-printer"></i> Imprimir ODECO</a></li>
						<li><a href="<?php echo base_url()?>Login/inicio"><span class="badge bg-teal-400 pull-right" name="nom_reclamo" id="nom_reclamo">58</span> <i class=" icon-reading"></i> Reclamos</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-cog5"></i> Cambiar comtraseña</a></li>
						<li><a href="<?php echo base_url()?>login/create"><i class="icon-user-plus"></i> Crear Perfil</a></li>
						<li><a href="<?php echo base_url()?>login/logout"><i class="icon-switch2"></i> Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img style="border-radius: 50%;" src="<?php echo base_url('assets/images/ela/sill.png') ?>" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold" name="nom_user" id="nom_user"> <?php echo $_SESSION['username']; ?> </span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small" name="nom_cargo" id="nom_cargo"></i>
									</div>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="#"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<?php echo $_SESSION['menu'];?>
							</ul>
						</div>
					</div>
					<!-- /main navigation -->


				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<!-- <div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
							</div>
						</div>
					</div> -->

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo base_url()?>Login/inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
							<li class="">ODECO</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#" onclick="odeco()"><i class="icon-printer position-left"></i> ODECO</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-newspaper position-left"></i>
									Reportes
									<span class="caret"></span>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-user-lock"></i> Reclamos vencidos</a></li>
									<li><a href="#"><i class="icon-statistics"></i> Estadisticas</a></li>
									<li><a href="#"><i class="icon-file-spreadsheet2"></i> Por rango de fechas</a></li>
									<li><a href="#"><i class="icon-magazine"></i> Planilla EFC-5</a></li>

									<li class="divider"></li>
									<li><a href="#"><i class="icon-file-stats "></i> Semestral</a></li>
									<li><a href="#"><i class="icon-file-presentation2"></i> Anual</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Main charts -->
					<div class="row">

