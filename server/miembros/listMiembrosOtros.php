<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $VALOR = $_POST["txtValor"];

    $dbdata = array();
    if($VALOR == 1){
        $res = $TDV->conn->query("SELECT tb1.*, tb2.titulo as DEPARTAMENTO FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento WHERE tb1.espirituSanto = 'on' ORDER BY tb1.apellidos ASC");
    }else if($VALOR == 2){
        $res = $TDV->conn->query("SELECT tb1.*, tb2.titulo as DEPARTAMENTO FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento WHERE tb1.bautizado = 'on' ORDER BY tb1.apellidos ASC");
    }else if($VALOR == 3){
        $res = $TDV->conn->query("SELECT tb1.*, tb2.titulo as DEPARTAMENTO FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento WHERE tb1.idTipoMiembro = 1 ORDER BY tb1.apellidos ASC");
    }else if($VALOR == 4){
        $res = $TDV->conn->query("SELECT tb1.*, tb2.titulo as DEPARTAMENTO FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento WHERE tb1.idDepartamento != 4 AND tb1.idDepartamento != 5 AND tb1.idDepartamento != 7 AND tb1.idDepartamento != 11 ORDER BY tb1.apellidos ASC");
    }
    
    while($row = $res->fetch_assoc()){
        $dbdata[] = $row;
    }

    echo json_encode($dbdata);