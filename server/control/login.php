<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    // RECOGEMOS LAS VALORES PARA HACER EL LOGIN
    $USER = $_POST["tdv_username"];
    $PASS = $_POST["tdv_password"];
    $IDs  = $_POST["tdv_idMiembro"];

    $TDV->login($USER, $PASS, $IDs);
