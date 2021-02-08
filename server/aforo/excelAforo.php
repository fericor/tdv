<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $IDCULTO = $_GET["idServicio"];
    $FILAS = "";
    $i=0;

    $rws0 = $TDV->conn->query("SELECT * FROM tdv_servicios_cultos WHERE idServicio = ".$IDCULTO);
    $rs0 = $rws0->fetch_assoc();

    $HTML  = '<h4>'.$rs0["titulo"].'</h4>';
    $HTML .= '<p>'.$rs0["descripcion"].'</p>';
    $HTML .= '<p><b>Día: </b>'.$rs0["dia"].'  |  <b>Aforo: </b>'.$rs0["limite"].'</p>';
    $HTML .= '<p><b>Fecha: </b>'.$TDV->cambiarfecha_mysql($rs0["fecha"]).'  |  <b>Hora: </b>'.$rs0["hora"].'</p>';
    
    $rws = $TDV->conn->query("SELECT * FROM tdv_registro_cultos WHERE idCulto = '".$IDCULTO."' ORDER BY id DESC");
    while ($rs = $rws->fetch_assoc()) {
        $i++;

        $FILAS .= '<tr>
            <td>'.$i.'</td>
            <td>'.$rs["nombre"].' '.$rs["apellidos"].'</td>
            <td>'.$rs["telefono"].'</td>
            <td>'.$rs["email"].'</td>
            <td>'.$TDV->cambiarfecha_mysql($rs["fecha"], 1).'</td>
            <td>'.$rs["tipo"].'</td>
            <td></td>
            <td></td>
        </tr>';
    }

    header("Pragma: public");
    header("Expires: 0");
    $filename = trim($rs0["titulo"]).".xls";
    header("Content-type: application/x-msdownload");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas TDV</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
        .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
        .center{width: 50px; text-align: center;}
    </style>
    <table class="tg">
        <thead>
            <tr>
                <th colspan="2" rowspan="2">
                    <img src="https://app.tabernaculodevida.es/images/logo.png" alt="" style="width: 300px;">
                </th>
                <th class="tg-c3ow" colspan="4"><h2>ASISTENCIA CULTO</h2></th>
            </tr>
            
            <tr>
                <td colspan="4">
                    <?=$HTML?>
                </td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nombre Completo</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Fecha &amp; Hora</th>
                <th>Observación</th>
                <th class="center">Si</th>
                <th class="center">No</th>
            </tr>
        </thead>
        <tbody>
            <?=$FILAS?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>