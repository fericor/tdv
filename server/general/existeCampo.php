<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    // RECOGEMOS LAS VALORES PARA HACER EL LOGIN
    $ID        = $_POST["tdv_id"];
    $TABLE     = $_POST["tdv_table"];
    $CONDITION = "id=".$ID;

    echo $TDV->existeCampo($TABLE, $CONDITION);
