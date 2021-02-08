<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $res0 = $TDV->conn->query("SELECT * FROM tdv_registro_cultos WHERE nombre = '".$_POST["txtNombre"]."' AND apellidos = '".$_POST["txtApellidos"]."' ");
    $NUM0 = mysqli_num_rows($res0);

  
    if($_POST["txtNombre"] == ""){
        echo 'No se han rellenados toda la información necesaria.';
    }else{
        if($NUM0 > 0){
            echo '<h2>Ha ocurrido un error:</h2>';
            echo 'Con estos datos ya existe una reserva, intenta con unos nuevos datos.';
    
        }else{
            $PART = explode("|", $_POST["txtServicioCulto"]);

            echo '<hr>
                <p>'.$PART[1].'</p>
                <hr>
                <h4>INFORMACIÓN:</h4>
                <div style="text-align:left;"><p>'.$_POST["txtNombre"].' '.$_POST["txtApellidos"].', '.$_POST["txtLocalidad"].', '.$_POST["txtCP"].'</p>
                <b>Telf.:</b> <i>'.$_POST["txtTelefono"].'</i> <br>
                <b>Email:</b> <i>'.$_POST["txtEmail"].'</i> <br>
                <b>Tipo</b> <i>'.$_POST["txt_idTipoMiembro"].'</i></div>';
        }
    }