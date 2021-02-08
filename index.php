<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	session_start();

	include_once 'conf.php';
	include_once 'server/class/config.php';
	require_once 'server/class/ui.class.php';
	require_once 'server/class/control.class.php';

	// INICIALIZAMOS LA CLASE
	$TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	$ui  = new tdv_ui($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

	$modulo = (!empty($_GET['mod'])) ? $_GET['mod'] : MODULO_DEFECTO;
		
	if (empty($conf[$modulo])){$modulo = NO_MODULO;}
	if (empty($conf[$modulo]['layout'])){$conf[$modulo]['layout'] = LAYOUT_DEFECTO;}

	$path_layout = LAYOUT_PATH.'/'.$conf[$modulo]['layout'];
	$path_modulo = MODULO_PATH.'/'.$conf[$modulo]['archivo'];
	$TITLE_PAGE  = $conf[$modulo]['title'];

	$res = $ui->conn->query("SELECT idIglesia, proteccionDatos, DATE_FORMAT(fecha_fiscal,'%d - %b - %Y') AS AnoFistal FROM tdv_configuracion WHERE idIglesia = 1");
	$rs  = $res->fetch_assoc();
	$_SESSION["S_FECHA_FISCAL"] = $rs["AnoFistal"];
	$_SESSION["S_ID_IGLESIA"]   = $rs["idIglesia"];
	$_SESSION["S_PROTECCION_DATOS"] = $rs["proteccionDatos"];

	if (file_exists($path_layout)){
		include( $path_layout );
	}else{
		if (file_exists( $path_modulo )){
			include( $path_modulo );
		}else{
			die('Error al cargar el modulo <b>'.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
		}
	}
?>