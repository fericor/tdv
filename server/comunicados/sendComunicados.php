<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    // VARIABLES
    $ASUNTO         = $_POST["txtAsunto"];
    $IDUSER         = $_POST["txtUser"];
    $IDMIEMBRO      = $_POST["txtMiembro"];
    $IDDEPARTAMENTO = $_POST["txtDepartamento"];
    $EMAIL          = $_POST["txtEmail"];
    $CONTENIDO      = $_POST["txtContenido"];

    if(count($IDUSER) > 0){
        foreach($IDUSER as $key => $value){
            $EMAIL_ENVIAR = $TDV->getContentByTable("email", "tdv_users", "id=".$value);
            $TDV->enviarEmail("comunicados", $ASUNTO, $EMAIL_ENVIAR, $CONTENIDO);
        }        
    }

    if(count($IDMIEMBRO) > 0){
        foreach($IDMIEMBRO as $key => $value){
            $EMAIL_ENVIAR = $TDV->getContentByTable("email", "tdv_miembros", "idMiembro=".$value);
            $TDV->enviarEmail("comunicados", $ASUNTO, $EMAIL_ENVIAR, $CONTENIDO);
        }        
    }

    if(count($IDDEPARTAMENTO) > 0){
        foreach($IDDEPARTAMENTO as $key => $value){
            $res = $TDV->conn->query("SELECT email FROM tdv_miembros WHERE idDepartamento = ".$value);
            while ($rs = $res->fetch_assoc()) {
                $TDV->enviarEmail("comunicados", $ASUNTO, $rs["email"], $CONTENIDO);
            }
        }        
    }

    if($EMAIL != ""){
        $TDV->enviarEmail("comunicados", $ASUNTO, $EMAIL, $CONTENIDO);
    }
  

    echo json_encode(["ERROR"=>false, "msj"=>"Email enviados con exito."]);
    exit();