<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $TDV->saveVisita($_POST, $_POST["txt_idMiembro"], $_POST["txt_idParentesco"]);
    $TDV->sendMail($_POST["txt_email"], '<h2>Bienvenid@</h2>', 'HOLA');