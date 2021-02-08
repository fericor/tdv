<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // VARIABLES
    $TABLE     = $_POST["txtTable"]; 

    if($TABLE == "users"){$CONDITION = "id=".$_POST["txtId"];}
    if($TABLE == "roles"){$CONDITION = "idRol=".$_POST["txtId"];}
    if($TABLE == "casas"){$CONDITION = "idCasa=".$_POST["txtId"];}
    if($TABLE == "tipos_miembros"){$CONDITION = "idTipoMiembro=".$_POST["txtId"];}
    if($TABLE == "lista_miembros"){$CONDITION = "idListaGrupo=".$_POST["txtId"];}
    if($TABLE == "grupo_vida_distritos"){$CONDITION = "idDistrito=".$_POST["txtId"];}
    if($TABLE == "grupo_vida_zonas"){$CONDITION = "idZona=".$_POST["txtId"];}
    if($TABLE == "grupo_vida_casas"){$CONDITION = "idCasa=".$_POST["txtId"];}
    if($TABLE == "grupo_vida_barrios"){$CONDITION = "idBarrio=".$_POST["txtId"];}
    if($TABLE == "departamentos"){$CONDITION = "idDepartamento=".$_POST["txtId"];}
    if($TABLE == "miembros"){$CONDITION = "idMiembro=".$_POST["txtId"];}
    if($TABLE == "servicios_cultos"){$CONDITION = "idServicio=".$_POST["txtId"];}
    if($TABLE == "nacionalidades"){$CONDITION = "idNacionalidad=".$_POST["txtId"];}
    if($TABLE == "parentescos"){$CONDITION = "idParentesco=".$_POST["txtId"];}
    if($TABLE == "familias"){$CONDITION = "idFamilia=".$_POST["txtId"];}
    if($TABLE == "registro_cultos"){$CONDITION = "id=".$_POST["txtId"];}

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $TDV->deleteRegistro($TABLE, $CONDITION);