<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $TITULO = $_POST["tituloCulto"];
    
    $rws = $TDV->conn->query("SELECT * FROM tdv_registro_cultos WHERE idCulto = '".$TITULO."' ORDER BY nombre ASC");
    while( $row = $rws->fetch_assoc() ) { 
		$data[] = $row;
	}
    echo json_encode($data); 