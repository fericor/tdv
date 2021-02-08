<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        $HTML    = "";
        $FECHA   = isset($_POST["txt_fecha"]) ? $_POST["txt_fecha"] : date("Y-m-d");
        $IDCULTO = isset($_POST["txt_idServicio"]) ? $_POST["txt_idServicio"] : 1;

        echo $ui->tdv_welcome_panel();

        // $res = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idCulto = {$IDCULTO} AND idDepartamento = ".$_SESSION['IDDEPARTAMENTO']." AND idTipoMiembro = 1 AND date(fechaVisita) = TIMESTAMP('{$FECHA}', '%y/%m/%d') ORDER BY apellidos DESC");
        $res = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idCulto = {$IDCULTO} AND date(fechaVisita) = TIMESTAMP('{$FECHA}') ORDER BY apellidos DESC");
     
        while ($rs = $res->fetch_assoc()){
            $BAUTIZADO     = $rs["bautizado"] == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
            $ESPIRITUSANTO = $rs["espirituSanto"] == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
               

            $HTML .= '<tr>
                    <td><img src="data:'.$rs["imgBase64"].'" alt=""></td>
                    <td>'.$rs["nombre"].'</td>
                    <td>'.$rs["apellidos"].'</td>
                    <td onclick="TDV.updateStatus(this, \'miembros\', '.$rs["idMiembro"].', \'bautizado\')">'.$BAUTIZADO.'</td>
                    <td onclick="TDV.updateStatus(this, \'miembros\', '.$rs["idMiembro"].', \'espirituSanto\')">'.$ESPIRITUSANTO.'</td>
                </tr>';
        }

        echo $ui->tfv_image_avatar_modal();

        $SERVICIOS = '';
        $res = $TDV->conn->query("SELECT idServicio, titulo FROM tdv_servicios_cultos ORDER BY titulo DESC");
        while ($rs = $res->fetch_assoc()) {
            $SERVICIOS .= '<option value="'.$rs["idServicio"].'">'.$rs["titulo"].'</option>';
        }
    }  

    //echo "SELECT * FROM tdv_miembros WHERE idCulto = {$IDCULTO} AND idDepartamento = ".$_SESSION['IDDEPARTAMENTO']." AND idTipoMiembro = 1 AND date(fechaVisita) = TIMESTAMP('{$FECHA}', '%y/%m/%d') ORDER BY apellidos DESC";
?>

<div id="divPrint" class="row mt-4">
    <div class="col-lg-12 d-flex stretch-card" style="margin-top:10px;">
        <div class="card sale-diffrence-border">
            <div class="card-body" style="padding:20px;">

                <form method="POST" id="frmRegistroBautismoEspiritu" autocomplete="off">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_idServicio">Servicio o Culto</label>
                                <select id="txt_idServicio" name="txt_idServicio" class="js-basic-single" style="width:100%;">
                                    <?=$SERVICIOS?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_idServicio">Fecha</label>
                                <input type="date" id="txt_fecha" name="txt_fecha" class="js-basic-single" style="width:100%;" value="<?=$FECHA?>">
                            </div>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary" onclick="$('#frmRegistroBautismoEspiritu').submit();">Buscar</button>
                        </div>
                    </div>
                    
                    <div class="table-responsive scroll">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDOS</th>
                                    <th>BAUTIZADO</th>
                                    <th>ESPIRITU SANTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?=$HTML?>
                            </tbody>
                        </table>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //$('.cmbAsistencia option:eq(<?=$IDCULTO?>)').prop('selected', true);
        $('#txt_idServicio').val(<?=$IDCULTO?>).trigger('change');
    });
</script>