<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $ID   = $_POST["tdv_id"];
    $SQL  = "SELECT tb1.*, tb2.titulo as DEPARTAMENTO, tb3.titulo AS TIPOMIEMBRO, tb4.titulo AS DISTRITO, tb5.titulo AS ZONA, tb6.titulo AS BARRIO, tb7.direccion AS DIRECCIONCASA FROM tdv_miembros AS tb1";
    $SQL .= " LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento";
    $SQL .= " LEFT JOIN tdv_tipos_miembros AS tb3 ON tb1.idTipoMiembro = tb3.idTipoMiembro";
    $SQL .= " LEFT JOIN tdv_grupo_vida_distritos AS tb4 ON tb1.idDistrito = tb4.idDistrito";
    $SQL .= " LEFT JOIN tdv_grupo_vida_zonas AS tb5 ON tb1.idZona = tb5.idZona";
    $SQL .= " LEFT JOIN tdv_grupo_vida_barrios AS tb6 ON tb1.idBarrio = tb6.idBarrio";
    $SQL .= " LEFT JOIN tdv_grupo_vida_casas AS tb7 ON tb1.idCasa = tb7.idCasa WHERE tb1.idMiembro = $ID ORDER BY tb1.nombre DESC";


    $res = $TDV->conn->query($SQL);
    $row = $res->fetch_assoc();
    //echo $SQL;

    echo json_encode($row);