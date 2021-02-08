<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    // RECOGEMOS LAS VALORES PARA HACER EL LOGIN
    foreach($_POST as $nombre_campo => $valor){
        $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
        echo $asignacion;
    }

    // $TDV->getOneRowById($TABLE, $CONDITION);
