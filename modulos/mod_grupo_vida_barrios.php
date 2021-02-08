<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        $BOTON = '<div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text" data-toggle="modal" data-target="#modalGrupoVidaBarrios"> 
                        Crear Barrio <i class="mdi mdi-book-plus"></i>                          
                    </button>
                </div>';

        echo $ui->tdv_welcome_panel($BOTON);

        // CARGAMOS LOS DISTRITOS
        $res0 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_distritos ORDER BY titulo DESC");
        echo '<div class="row mt-4">';
        while ($rs0 = $res0->fetch_assoc()){
            echo '<div class="col-lg-3 d-flex stretch-card"><button type="button" class="btn btn-outline-info btn-icon-text">
                    '.$rs0["titulo"].'                                                                             
                </button></div>';
        }
        echo '</div>';


        

        $res = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_barrios ORDER BY titulo DESC");

        echo '<div id="divPrint" class="row mt-4">';
        while ($rs = $res->fetch_assoc()){
            $res1 = $TDV->conn->query("SELECT username FROM tdv_users WHERE id = ".$rs["idUser"]);
            $rs1 = $res1->fetch_assoc();

            $res3 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_casas WHERE idZona = ".$rs["idZona"]);
            $num3 = mysqli_num_rows($res3);

            $res5 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_distritos WHERE idDistrito = ".$rs["idDistrito"]);
            $rs5 = $res5->fetch_assoc();

            echo '<div class="col-lg-4">
                    <div class="card" style="background:'.$rs5["color"].';margin-top:10px;">
                        <div class="card-body" style="padding:20px;">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-2">'.$rs5["titulo"].' - Asignado: '.$rs1["username"].'</h4>
                                <div class="dropdown">
                                    <a href="#" class="text-info btn btn-link px-1" data-id="'.$rs["idBarrio"].'" onclick="TDV.getOneRow(this, \'grupo_vida_barrios\');" data-toggle="modal" data-target="#modalGrupoVidaBarrios"><i class="mdi mdi-pencil"></i></a>
                                    <a href="#" class="text-error btn btn-link px-1" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'grupo_vida_barrios\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idBarrio"].');"> <i class="mdi mdi-minus-box"></i> </a>
                                </div>
                            </div>     
                            
                            <h2 class="text-dark mb-2 font-weight-bold">'.$rs["titulo"].'</h2>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="progress progress-lg grouped mb-2">
                                        <div class="progress-bar  bg-danger" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <ul class="graphl-legend-rectangle">
                                        <li><span class="bg-danger"></span>Casas ('.$num3.'%)</li>
                                        <li><span class="bg-info"></span>Miembros (20%)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        echo '</div>';

        echo $ui->tdv_grupo_vida_barrio_modal();
        echo $ui->tdv_delete_modal();
    }  