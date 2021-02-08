<?php  

    $FILAS        = '';
    $F_INI        = isset($_POST["txtFchInicio"]) ? $_POST["txtFchInicio"] : "";
    $F_FIN        = isset($_POST["txtFchFin"]) ? $_POST["txtFchFin"] : "";
    
    if(($F_INI != "") && ($F_FIN != "")){
        $FECHAS  = "AND date(fechaVisita) BETWEEN TIMESTAMP('{$F_INI}') AND TIMESTAMP('{$F_FIN}')";
    }else if(($F_INI != "") && ($F_FIN == "")){
        $FECHAS  = "AND date(tb2.fecha) >= TIMESTAMP('{$F_INI}', '%y/%m/%d')";
    }else{
        $FECHAS  = "";
    }

    $BAUTI   = isset($_POST["txtBautizado"]) ? "AND bautizado = '{$_POST["txtBautizado"]}'"  : '';
    $ESSANTO = isset($_POST["txtEspirituSanto"]) ? "AND espirituSanto = '{$_POST["txtEspirituSanto"]}' " : '';

    $DEPARTAMENTO = "AND idDepartamento = 11";
    $TIPO         = $_POST["txt_idTipoMiembro"] != "" ? "AND idTipoMiembro = '{$_POST["txt_idTipoMiembro"]}'" : '';

    $BAUTIZADOII     = $_POST["txtBautizado"] == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
    $ESPIRITUSANTOII = $_POST["txtEspirituSanto"] == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
    
    if($_POST["txt_idTipoMiembro"] != ""){
        $rs0  = $TDV->conn->query("SELECT titulo FROM tdv_tipos_miembros WHERE idTipoMiembro = ".$_POST['txt_idTipoMiembro']);
        $RS_TIPO = $rs0->fetch_assoc(); 
    }else{

    }
    
    $HOY = date("Y-m-d");

    $D_INI = new DateTime($F_INI);
    $D_FIN = new DateTime($F_FIN);

    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tfv_image_avatar_modal();

        if( ($FECHAS == "") && ($BAUTI == "") && ($ESSANTO == "") && ($DEPARTAMENTO == "") && ($TIPO == "") ){
            $SQL = "SELECT * FROM tdv_miembros ORDER BY apellidos ASC";
            $INFORMEBUSQUEDA = '<b>No se han aplicado filtros.</b><hr>';

            $rs02 = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 11 ");
            $numDAMAS = mysqli_num_rows($rs02);

            $rs05 = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 11 AND bautizado = 'on' ");
            $numBAUTIZADOS = mysqli_num_rows($rs05);

            $rs06 = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 11 AND espirituSanto = 'on' ");
            $numESPIRITUSANTO = mysqli_num_rows($rs06);
        }else{
            $SQL = "SELECT * FROM tdv_miembros WHERE idDepartamento = 11 ".$FECHAS." ".$BAUTI." ".$ESSANTO." ".$TIPO." ORDER BY fechaVisita DESC";        
            $INFORMEBUSQUEDA  = '<b>Fechas: </b> <i>'.$D_INI->format('d/m/Y').'</i> y <i>'.$D_FIN->format('d/m/Y').'</i> <br>';
            $INFORMEBUSQUEDA .= '<b>Bautizados: </b> <i>'.$BAUTIZADOII.'</i>  -  <b>Espíritu Santo: </b> <i>'.$ESPIRITUSANTOII.'</i> <br>';
            $INFORMEBUSQUEDA .= '<b>Tipo Constituyente: </b> <i>'.$RS_TIPO["titulo"].'</i> <hr>';
            
            $rs02 = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 11 ".$FECHAS." ".$BAUTI." ".$ESSANTO." ".$TIPO);
            $numDAMAS = mysqli_num_rows($rs02);

            $rs05 = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 11 AND bautizado = 'on' ".$FECHAS." ".$BAUTI." ".$ESSANTO." ".$TIPO);
            $numBAUTIZADOS = mysqli_num_rows($rs05);

            $rs06 = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 11 AND espirituSanto = 'on' ".$FECHAS." ".$BAUTI." ".$ESSANTO." ".$TIPO);
            $numESPIRITUSANTO = mysqli_num_rows($rs06);
        }

        $res = $TDV->conn->query($SQL);
        $num = mysqli_num_rows($res);
        $i = 1;
        
        while ($rs = $res->fetch_assoc()) {
            $NACIONALIDASID = $rs["idNacionalidad"] != "" ? $rs["idNacionalidad"] : 0;
            $res1 = $TDV->conn->query("SELECT titulo FROM tdv_nacionalidades WHERE idNacionalidad = ".$NACIONALIDASID);
            $rs1 = $res1->fetch_assoc();

            $BAUTIZADO     = $rs["bautizado"] == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
            $ESPIRITUSANTO = $rs["espirituSanto"] == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
            $NACIONALIDAD  = isset($rs1["titulo"]) ? $rs1["titulo"] : "";

            $rs0  = $TDV->conn->query("SELECT titulo FROM tdv_tipos_miembros WHERE idTipoMiembro = ".$rs["idTipoMiembro"]);
            $RS_TIPO = $rs0->fetch_assoc(); 

            $rs00  = $TDV->conn->query("SELECT titulo FROM tdv_departamentos WHERE idDepartamento = ".$rs["idDepartamento"]);
            $RS_DEPARTAMETO = $rs00->fetch_assoc(); 

            $FILAS .= '<tr>
                        <td>'.$i++.'</td>
                        <td class="py-1"> <img src="data:'.$rs["imgBase64"].'" alt="image" onerror="this.src=\'images/none.png\'" onclick="TDV.cargarImgeAvatar(this);"/> </td>        
                        <td>'.$rs["nombre"].'</td>
                        <td>'.$rs["apellidos"].'</td>
                        <td>'.$rs["telefono"].'</td>
                        <td>'.$rs["email"].'</td>
                        <td>'.$RS_DEPARTAMETO["titulo"].'</td>
                        <td onclick="TDV.updateStatus(this, \'miembros\', '.$rs["idMiembro"].', \'bautizado\')">'.$BAUTIZADO.'</td>
                        <td>'.$TDV->cambiarfecha_mysql($rs["fechaBautizado"]).'</td>
                        <td onclick="TDV.updateStatus(this, \'miembros\', '.$rs["idMiembro"].', \'espirituSanto\')">'.$ESPIRITUSANTO.'</td>
                        <td>'.$TDV->cambiarfecha_mysql($rs["fechaEspirituSanto"]).'</td>
                        <td>'.$NACIONALIDAD.'</td>
                        <td>'.$RS_TIPO["titulo"].'</td>
                        <td>'.$TDV->cambiarfecha_mysql($rs["fechaVisita"], 1).'</td>
                    </tr>';
        }
            
        $DEPARTAMENTOS = '<option value="">Seleccionar...</option>';
        $res1 = $TDV->conn->query("SELECT idDepartamento, titulo FROM tdv_departamentos ORDER BY titulo ASC");
        while ($rs = $res1->fetch_assoc()) {
            $DEPARTAMENTOS .= '<option value="'.$rs["idDepartamento"].'">'.$rs["titulo"].'</option>';
        }

        $TIPOS = '<option value="">Seleccionar...</option>';
        $res2 = $TDV->conn->query("SELECT idTipoMiembro, titulo FROM tdv_tipos_miembros ORDER BY titulo ASC");
        while ($rs = $res2->fetch_assoc()) {
            $TIPOS .= '<option value="'.$rs["idTipoMiembro"].'">'.$rs["titulo"].'</option>';
        }
?>
    <script>
        $(document).ready(function(){
            // TDV.cargarCombo('#txt_idTipoMiembro', 'tdv_tipos_miembros', 'idTipoMiembro', 'txt_idTipoMiembro');
            // TDV.cargarCombo('#txt_idDepartamento', 'tdv_departamentos', 'idDepartamento', 'txt_idDepartamento');
        });
    </script>

<form method="post">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="pull-left">Fecha Inicio:</span>
                            <input type="date" id="txtFchInicio" name="txtFchInicio" class="js-basic-single" style="width:100%;" value="<?=$_POST["txtFchInicio"]?>">
                        </div>
                        <div class="col">
                            <span class="pull-left">Fecha Fin:</span>
                            <input type="date" id="txtFchFin" name="txtFchFin" class="js-basic-single" style="width:100%;" value="<?=$_POST["txtFchFin"]?>">
                        </div>

                        <input type="hidden" id="txt_idDepartamento" name="txt_idDepartamento" value="11">
                       
                        <div class="col">
                            <span class="pull-left">Tipo:</span>
                            <select class="form-control" id="txt_idTipoMiembro" name="txt_idTipoMiembro" style="width: 100%;height: 45px;">
                                <?=$TIPOS?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" class="form-radio-input" id="txtBautizadoSI" name="txtBautizado" value="on">
                                <label for="txtBautizado">Bautizados SI</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-radio-input" id="txtBautizadoNO" name="txtBautizado" value="off">
                                <label for="txtBautizado">Bautizados NO</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-check">
                                <input type="radio" class="form-radio-input" id="txtEspirituSantoSI" name="txtEspirituSanto" value="on">
                                <label for="txtBautizado">Espítitu Santo SI</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-radio-input" id="txtEspirituSantoNO" name="txtEspirituSanto" value="off">
                                <label for="txtBautizado">Espítitu Santo NO</label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>  
                
                </div>
            </div>
        </div>
    </div>
</form>
<hr>

<button type="button" class="btn btn-dark btn-icon-text" onclick="TDV.printdiv('divReportes', 'Jóvenes');"> IMPIMIR </button>
<hr>
<div id="divReportes" class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h2>INFORMACION DE BUSQUEDA: </h2>
                        <?=$INFORMEBUSQUEDA?>
                        <b>Numero de registros encontrados: </b> <i><?=$num?></i>
                    </div>

                    <div class="col">
                        <h2>ESTADISTICAS: </h2>
                        <div class="row">
                            <div class="col">
                                <b>Damas: </b> <i><?=$numDAMAS?></i>
                            </div>
                        </div>
                         <hr>
                        <div class="row">
                            <div class="col"><b>Bautizados: </b> <i><?=$numBAUTIZADOS?></i></div>
                            <div class="col"><b>Espíritu Santo: </b> <i><?=$numESPIRITUSANTO?></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> </th>
                                <th> </th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Grupo</th>
                                <th>Baut.</th>
                                <th>FCH.Baut.</th>
                                <th>ES</th>
                                <th>FCH.ES.</th>
                                <th>Nacionalidad</th>
                                <th>Tipo</th>
                                <th>FCH.Visita</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$FILAS?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>