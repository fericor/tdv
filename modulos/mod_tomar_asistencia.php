<?php  

    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{

        echo $ui->tdv_welcome_panel();

        if($_SESSION['idRol'] == 1){
            $res = $TDV->conn->query("SELECT tb1.*, tb2.titulo AS culto FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_servicios_cultos AS tb2 ON tb1.idServicio = tb2.idServicio ORDER BY tb1.titulo DESC");
        }else{
            $res = $TDV->conn->query("SELECT tb1.*, tb2.titulo AS culto FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_servicios_cultos AS tb2 ON tb1.idServicio = tb2.idServicio WHERE tb1.idUser = ".$_SESSION['id']." ORDER BY tb1.titulo DESC");
        }
     
        echo '<div id="divPrint" class="row mt-4">';
        while ($rs = $res->fetch_assoc()){
            $res1 = $TDV->conn->query("SELECT username FROM tdv_users WHERE id = ".$rs["idUser"]);
            $rs1 = $res1->fetch_assoc();

            $res2 = $TDV->conn->query("SELECT titulo FROM tdv_departamentos WHERE idDepartamento = ".$rs["idDepartamento"]);
            $rs2 = $res2->fetch_assoc();

            $res3 = $TDV->conn->query("SELECT * FROM tdv_lista_miembros_items WHERE idLista = ".$rs["idListaGrupo"]);
            // $res3 = $TDV->conn->query("SELECT * FROM tdv_lista_miembros_items WHERE idUser = ".$rs["idUser"]." AND idLista = ".$rs["idListaGrupo"]);
            $num = mysqli_num_rows($res3);

            echo '<div class="col-lg-4 d-flex stretch-card" data-toggle="modal" data-target="#modalListaAsistencia" onclick="TDV.cargarLista('.$rs["idUser"].', '.$rs["idListaGrupo"].', '.$rs["idServicio"].');" style="margin-top:10px;">
                        <div class="card sale-diffrence-border">
                            <div class="card-body" style="padding:20px;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title mb-2">'.$rs2["titulo"].' :: '.$rs1["username"].'</h4>
                                </div>     
                                
                                <h2 class="text-dark mb-2 font-weight-bold">'.$rs["titulo"].'</h2>
                                <p><b>Miembros:</b> <i>'.$num.'</i> | <b>Servicio:</b> <i>'.$rs["culto"].'</i></p>
                            </div>
                        </div>
                    </div>';
        }
        echo '</div>';

        echo $ui->tdv_lista_asistencia_modal();
        echo $ui->tfv_image_avatar_modal();
    }  