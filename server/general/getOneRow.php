<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    // RECOGEMOS LAS VALORES PARA HACER EL LOGIN
    $ID        = $_POST["tdv_id"];
    $TABLE     = $_POST["tdv_table"];

    if($TABLE == "users"){$CONDITION = "id=".$ID;}
    if($TABLE == "roles"){$CONDITION = "idRol=".$ID;}
    if($TABLE == "miembros"){$CONDITION = "idMiembro=".$ID;}
    if($TABLE == "tipos_miembros"){$CONDITION = "idTipoMiembro=".$ID;}
    if($TABLE == "lista_miembros"){$CONDITION = "idListaGrupo=".$ID;}
    if($TABLE == "grupo_vida_distritos"){$CONDITION = "idDistrito=".$ID;}
    if($TABLE == "grupo_vida_zonas"){$CONDITION = "idZona=".$ID;}
    if($TABLE == "grupo_vida_casas"){$CONDITION = "idCasa=".$ID;}
    if($TABLE == "grupo_vida_barrios"){$CONDITION = "idBarrio=".$ID;}
    if($TABLE == "departamentos"){$CONDITION = "idDepartamento=".$ID;}
    if($TABLE == "servicios_cultos"){$CONDITION = "idServicio=".$ID;}
    if($TABLE == "nacionalidades"){$CONDITION = "idNacionalidad=".$ID;}
    if($TABLE == "parentescos"){$CONDITION = "idParentesco=".$ID;}
    
    $TDV->getOneRowById($TABLE, $CONDITION);
