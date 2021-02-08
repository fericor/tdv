<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $ID   = $_POST["tdv_id"];
    $SQL  = "SELECT * FROM tdv_familias WHERE idFamilia = $ID";


    $res = $TDV->conn->query($SQL);
    $row = $res->fetch_assoc();
    //echo $SQL;

    echo json_encode($row);