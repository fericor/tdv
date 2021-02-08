<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    
    
    $res = $TDV->conn->query("SELECT * FROM tdv_miembrosCopia ORDER BY nombre ASC");
    
    while($row = $res->fetch_assoc()){
        echo $row["nombre"]." - ";
        $porciones = explode(" ", $row["nombre"]);

        $NOMBRE1 = isset($porciones[0]) ? $porciones[0] : "";
        $NOMBRE2 = isset($porciones[1]) ? $porciones[1] : "";

        $APELLIDO1 = isset($porciones[2]) ? $porciones[2] : "";
        $APELLIDO2 = isset($porciones[3]) ? $porciones[3] : "";

        if(COUNT($porciones) == 4){
            $NOMBRES   = $NOMBRE1." ".$NOMBRE2;
            $APELLIDOS = $APELLIDO1." ".$APELLIDO2;
            echo "4";
        }

        if(COUNT($porciones) == 3){
            $NOMBRES   = $NOMBRE1;
            $APELLIDOS = $APELLIDO1." ".$APELLIDO2;
            echo "3";
        }

        if(COUNT($porciones) == 2){
            $NOMBRES   = $NOMBRE1;
            $APELLIDOS = $NOMBRE2;
            echo "2";
        }

        $SQL = "UPDATE tdv_miembros SET nombre='".$NOMBRES."', apellidos='".$APELLIDOS."' WHERE idMiembro=".$row["idMiembro"];
        $TDV->conn->query($SQL);

        echo $NOMBRES." ".$APELLIDOS."<br>";
       
    }