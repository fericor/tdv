<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        $BOTON = '<div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text" data-toggle="modal" data-target="#modalGrupoVidaZonas"> 
                        Crear zona <i class="mdi mdi-book-plus"></i>                          
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


        

        $res = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_zonas ORDER BY titulo DESC");

        echo '<div id="divPrint" class="row mt-4">';
        while ($rs = $res->fetch_assoc()){
            $res1 = $TDV->conn->query("SELECT username FROM tdv_users WHERE id = ".$rs["idUser"]);
            $rs1 = $res1->fetch_assoc();

            $res2 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_barrios WHERE idZona = ".$rs["idZona"]);
            $num2 = mysqli_num_rows($res2);

            $res3 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_casas WHERE idZona = ".$rs["idZona"]);
            $num3 = mysqli_num_rows($res3);

            $res4 = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idZona = ".$rs["idZona"]);
            $num4 = mysqli_num_rows($res4);

            $res5 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_distritos WHERE idDistrito = ".$rs["idDistrito"]);
            $rs5 = $res5->fetch_assoc();

            echo '<div class="col-lg-4 d-flex stretch-card">
                        <div class="card sale-diffrence-border" style="background:'.$rs5["color"].';margin-top:10px;">
                            <div class="card-body" style="padding:20px;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title mb-2">'.$rs5["titulo"].' - Asignado: '.$rs1["username"].'</h4>
                                    <div class="dropdown">
                                        <a href="#" class="text-info btn btn-link px-1" data-id="'.$rs["idZona"].'" onclick="TDV.getOneRow(this, \'grupo_vida_zonas\');" data-toggle="modal" data-target="#modalGrupoVidaZonas"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="text-error btn btn-link px-1" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'grupo_vida_zonas\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idZona"].');"> <i class="mdi mdi-minus-box"></i> </a>
                                    </div>
                                </div>     
                                
                                <h2 class="text-dark mb-2 font-weight-bold">'.$rs["titulo"].'</h2>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <ul class="graphl-legend-rectangle">
                                            <li><span class="bg-warning"></span>Barrios</li>
                                            <li><span class="bg-info"></span>Casas</li>
                                            <li><span class="bg-success"></span>Miembros</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-8">
                                        <canvas id="zonasGV'.$rs["idZona"].'"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

            echo '<script>';
            echo 'var zonasGVData'.$rs["idZona"].' = {
                        datasets: [{
                            data: ['.$num2.', '.$num3.', '.$num4.'],
                            backgroundColor: ["#fcd53b", "#0bdbb8", "#464dee"],
                            borderColor: ["#fcd53b", "#0bdbb8", "#464dee"],
                        }],
                        labels: ["Barrios", "Casas", "Miembros"]
                    };
                    var zonasGVOptions'.$rs["idZona"].' = {
                        responsive: true,
                        cutoutPercentage: 80,
                        legend: {
                                display: false,
                        },
                        animation: {
                                animateScale: true,
                                animateRotate: true
                        },
                        plugins: {
                            datalabels: {
                                display: false,
                                align: "center",
                                anchor: "center"
                            }
                        }				
                
                    };
                    if ($("#zonasGV'.$rs["idZona"].'").length) {
                        var pieChartCanvas = $("#zonasGV'.$rs["idZona"].'").get(0).getContext("2d");
                        var pieChart = new Chart(pieChartCanvas, {
                            type: "doughnut",
                            data: zonasGVData'.$rs["idZona"].',
                            options: zonasGVOptions'.$rs["idZona"].'
                        });
                    }';
            echo '</script>';
        }
        echo '</div>';

        echo $ui->tdv_grupo_vida_zona_modal();
        echo $ui->tdv_delete_modal();
    }  