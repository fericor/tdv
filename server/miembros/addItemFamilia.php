<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $IDFAMILIA    = $_POST["idFamilia"];
    $IDMIEMBRO    = $_POST["idMiembro"];
    $IDPARENTESCO = $_POST["idParentesco"];

    $SQL  = "INSERT INTO tdv_familias (idFamiliaIntegrantes,idMiembro,idParentesco) VALUES ($IDFAMILIA,$IDMIEMBRO,$IDPARENTESCO)";
    $TDV->conn->query($SQL);

    echo json_encode('Miembro añadido con exito.');