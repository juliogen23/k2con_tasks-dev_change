<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Masamo Dash - <?php PROJECT_NAME ?>">
		<meta name="author" content="Masamo Dash - <?php PROJECT_NAME ?>">
		<title>
			<?php echo $title." - ".PROJECT_NAME; ?>
		</title>

		<!-- Favicon -->
		<link rel="icon" href="<?php echo RAIZ; ?>assets/images/favicon_masamo.png" type="image/x-icon"/>

		<!-- Bootstrap css-->
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/web-fonts/icons.css" rel="stylesheet"/>
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/web-fonts/plugin.css" rel="stylesheet"/>

		<!-- Style css-->
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/css/style.css?1=2" rel="stylesheet">
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/css/skins.css" rel="stylesheet">
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/css/dark-style.css" rel="stylesheet">
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/css/colors/default.css" rel="stylesheet">

		<!-- Color css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo RAIZ; ?>assets/dashboard/assets/css/colors/color.css">

		<!-- Select2 css-->
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/select2/css/select2.min.css" rel="stylesheet">

		<!-- Mutipleselect css-->
		<link rel="stylesheet" href="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/multipleselect/multiple-select.css">

		<!-- Sidemenu css-->
		<link href="<?php echo RAIZ; ?>assets/dashboard/assets/css/sidemenu/sidemenu.css?1=2" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo RAIZ; ?>src/intl-tel-input-master/build/css/intlTelInput.css">

		<link href="<?php echo RAIZ; ?>src/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="<?php echo RAIZ; ?>src/datatable/responsive.bootstrap.min.css" rel="stylesheet">

		<link href="<?php echo RAIZ; ?>src/main.css" rel="stylesheet">
		<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/jquery/jquery.min.js"></script>

		<style media="screen">

			.btn-outline-primary {

			}
			.btn-outline-primary:hover{
		    color: #fff !important;

		  }
		.btn-outline-primary:focus {
		    color: #fff !important;

		    outline: 0;
		    box-shadow: 0 0 0 0.2rem rgba(135, 96, 251, 0.5);
		  }
		.btn-primary {
			color: #fff;

		}
		.btn-primary:hover {
			color: #fff;
			background-color: #231F20;
			border-color: #231F20;
		}
			.main-content-title {

			}
			li.active{

			}
			.main-sidebar-body li.active .sidemenu-icon {

			}
			.main-sidebar-body li.active .sidemenu-label, .main-sidebar-body li.active {

			}
			.tx-10 {
			    font-size: 15px !important;
			}
			.grafico{
				padding: 5px 20px !important;
			}
			#back-to-top{
		    bottom: 53px;
			}
		</style>
	</head>

	<body class="main-body leftmenu <?php echo ($menu_hide)?"main-sidebar-hide":""; ?>">

			<!-- Loader -->
			<div id="global-loader">
				<img src="<?php echo RAIZ; ?>assets/dashboard/assets/img/loader.svg" class="loader-img" alt="Loader">
			</div>
			<!-- End Loader -->

			<!-- Page -->
			<div class="page">




			<?php require_once("top.php"); ?>
			<?php require_once("menu.php"); ?>
