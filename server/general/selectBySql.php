<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    // RECOGEMOS LAS VALORES PARA HACER EL LOGIN
    $ID    = $_POST["tdv_id"];
    $TABLE = $_POST["tdv_table"];
    $CAMPO = $_POST["tdv_campo"];

    $WHERE = $CAMPO." = ".$ID;

    if($ID == ""){
        $SQL = "SELECT * FROM $TABLE ORDER BY $CAMPO DESC";
    }else{
        $SQL = "SELECT * FROM $TABLE WHERE $WHERE ORDER BY $CAMPO DESC";
    }

    // echo $SQL;
    
    echo $TDV->selectBySQL($SQL);
