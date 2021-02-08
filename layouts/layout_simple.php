<?php

	define('DEBUG', false);

	error_reporting(E_ALL);
	ini_set('display_errors', DEBUG ? 'On' : 'Off');
	
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>TDV::<?=$TITLE_PAGE?></title>
		<!-- base:css -->
		<link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
		<link rel="stylesheet" href="vendors/css-loader/css-loader.css">
		<link rel="stylesheet" href="vendors/summernote/summernote.min.css">
		<!-- endinject -->
		<!-- plugin css for this page -->
		<link rel="stylesheet" href="vendors/select2/select2.min.css">
  		<link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
		<!-- End plugin css for this page -->
		<!-- inject:css -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/tdv_style.css">
		<link rel="stylesheet" href="css/tdv_profile.css">

		<!-- endinject -->
		<link rel="shortcut icon" href="images/favicon.png" />

		<link rel="stylesheet" href="vendors/colorPick/colorPick.css">
		<link rel="stylesheet" href="vendors/colorPick/colorPick.dark.theme.css">
		<link rel="stylesheet" href="vendors/DataTables/datatables.min.css"/>	
		<link rel="stylesheet" href="vendors/bootstrap_datepicker/css/bootstrap-datepicker.css"/>	
		<link rel="stylesheet" href="vendors/buttons/css/buttons.dataTables.min.css"/>	

		<style>
			.picker {
				border-radius: 5px;
				width: 36px;
				height: 36px;
				cursor: pointer;
				-webkit-transition: all linear .2s;
				-moz-transition: all linear .2s;
				-ms-transition: all linear .2s;
				-o-transition: all linear .2s;
				transition: all linear .2s;
				border: thin solid #eee;
			}
			.picker:hover {
				transform: scale(1.1);
			}
		</style>

		<!-- base:js -->
		<script src="vendors/base/vendor.bundle.base.js"></script>

		<!-- inject:js -->
		<script src="js/template.js"></script>
		<!-- endinject -->
		<!-- plugin js for this page -->
		<!-- End plugin js for this page -->
		<script src="vendors/chart.js/Chart.min.js"></script>
		<script src="vendors/progressbar.js/progressbar.min.js"></script>
		<script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="vendors/justgage/justgage.js"></script>
		<script src="vendors/summernote/summernote.min.js"></script>
		<script src="vendors/select2/select2.min.js"></script>
		<script src="vendors/colorPick/colorPick.js"></script>
		<script src="vendors/DataTables/datatables.min.js"></script>
		<script src="vendors/bootstrap_datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="vendors/buttons/js/dataTables.buttons.min.js"></script>

		<!-- funciones:js -->
        <script src="js/bootstrap-notify.min.js"></script>
        <script src="js/tdv_funciones.js"></script>
		<!-- end funciones -->
		
		<!-- Custom js for this page-->
		<script src="js/dashboard.js"></script>
		<!-- End custom js for this page-->
	</head>

	<body>

		<div id="tdv_loader" class="loader loader-default" data-text="Espere..."></div>
		<div class="container-scroller">
			<!-- partial:partials/_horizontal-navbar.html -->
			<?php include('includes/horizontal-menu.php'); ?>

			<!-- partial -->
			<div class="container-fluid page-body-wrapper">
				<div class="main-panel">
					<div class="content-wrapper">
						<?php
							if(file_exists( $path_modulo )){
								include( $path_modulo );
							}else{
								die('Error al cargar el modulo <b>'.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
							}
						?>
					</div>
					<?php include('includes/partials/footer.php'); ?>
					<!-- partial -->
				</div>
			</div>
			<!-- page-body-wrapper ends -->
    	</div>
    	<!-- container-scroller -->


	</body>
</html>