<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    // RECOGEMOS LAS VALORES PARA HACER EL LOGIN
    $IDLISTA    = $_POST["idLista"];
    $IDSERVICIO = $_POST["idServicio"];    
    
    echo $TDV->selectListaAsistencia($IDLISTA, $IDSERVICIO);
