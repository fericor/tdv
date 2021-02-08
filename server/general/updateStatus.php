<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // VARIABLES
    $VALOR  = $_POST["txtValores"] == "" ? "off" : $_POST["txtValores"];
    $TABLE  = $_POST["txtTabla"]; 
    $CAMPO  = $_POST["txtCampo"]; 
    $VALUES = $CAMPO .'="'.htmlentities($VALOR).'"'; 
    
    if($TABLE == "users"){$CONDITION = "id=".$_POST["txtCondicion"];}
    if($TABLE == "roles"){$CONDITION = "idRol=".$_POST["txtCondicion"];}
    if($TABLE == "casas"){$CONDITION = "idCasa=".$_POST["txtCondicion"];}
    if($TABLE == "miembros"){$CONDITION = "idMiembro=".$_POST["txtCondicion"];}
    if($TABLE == "tipos_miembros"){$CONDITION = "idTipoMiembro=".$_POST["txtCondicion"];}
    if($TABLE == "configuracion"){$CONDITION = "idIglesia=".$_POST["txtCondicion"];}

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $TDV->updateStatus($TABLE, $VALUES, $CONDITION, $CAMPO);