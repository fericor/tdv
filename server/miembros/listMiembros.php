<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $GRUPO = $_POST["idGrupo"];

    $dbdata = array();
    if($GRUPO == "ALL"){
        $res = $TDV->conn->query("SELECT tb1.*, tb2.titulo as DEPARTAMENTO FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento ORDER BY tb1.apellidos ASC");
    }else{
        $res = $TDV->conn->query("SELECT tb1.*, tb2.titulo as DEPARTAMENTO FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento WHERE tb1.idDepartamento = $GRUPO ORDER BY tb1.apellidos ASC");
    }
    
    while($row = $res->fetch_assoc()){
        $dbdata[] = $row;
    }

    echo json_encode($dbdata);