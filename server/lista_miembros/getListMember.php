<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $IDLISTA = $_POST["idLista"];

    $dbdata = array();
    
    $res = $TDV->conn->query("SELECT * FROM tdv_lista_miembros_items WHERE idLista = $IDLISTA ORDER BY idLista ASC");
    
    
    while($row = $res->fetch_assoc()){
        $dbdata[] = $row;
    }

    echo json_encode($dbdata);