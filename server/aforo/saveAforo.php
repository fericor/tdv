<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $HOY       = date("Y-m-d h:i:s");
    $NOMBRE    = $_POST["txtNombre"];
    $APELLIDOS = $_POST["txtApellidos"]; 
    $LOCALIDAD = $_POST["txtLocalidad"];
    $CP        = $_POST["txtCP"];
    $TELEFONO  = $_POST["txtTelefono"];
    $EMAIL     = $_POST["txtEmail"];
    $CULTO     = $_POST["txtServicioCulto"];
    $TIPO      = $_POST["txt_idTipoMiembro"];

    $PART = explode("|", $CULTO);

    $SQL = "INSERT INTO tdv_registro_cultos (nombre, apellidos, localidad, cp, telefono, email, idCulto, culto, tipo) VALUES ('$NOMBRE', '$APELLIDOS', '$LOCALIDAD', '$CP', '$TELEFONO', '$EMAIL', '".$PART[0]."', '".$PART[1]."', '$TIPO')";
    $TDV->conn->query($SQL);
    $ID = base64_encode("id=".mysqli_insert_id($TDV->conn));

    $MENSAJE = '<h3>Datos de su reserva:</h3>
        <hr>
        <b>Nombres: </b> <i>'.$_POST["txtNombre"]." ".$_POST["txtApellidos"].'</i> <br>
        <b>Servicio: </b> <i>'.$_POST["txtServicioCulto"].'</i> <br>
        Si necesita darse de baja haz click <a href="https://app.tabernaculodevida.es/index.php?mod=mod_servicio_aforo&'.$ID.'">aquí</a>';

    $MENSAJE1 = '<h3>Reserva:</h3>
        <hr>
        <b>Nombres: </b> <i>'.$_POST["txtNombre"]." ".$_POST["txtApellidos"].'</i> <br>
        <b>Servicio: </b> <i>'.$_POST["txtServicioCulto"].'</i> <br>
        Si necesita darse de baja haz click <a href="https://app.tabernaculodevida.es/index.php?mod=mod_servicio_aforo&'.$ID.'">aquí</a>';

    $TDV->enviarEmail("correo-reserva", "Reserva@::Tabernáculo de Vida", $_POST['txtEmail'], $MENSAJE);
    // $TDV->enviarEmail("correo-reserva", "Reserva@::Tabernáculo de Vida", 'noresponder@tdvmadrid.com', $MENSAJE1);

    echo "Tu reserva se ha realizado con exito.";
    echo "<h1>E S P E R A</h1>";

    // <p>Actualice su informacion haciendo un click en el siguiente enlace: <a href="https://app.tabernaculodevida.es?idConstituyente='.$IDUSER.'">app.tabernaculodevida.es</a></p>
