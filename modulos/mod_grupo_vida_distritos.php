<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{

        $BOTON = '<div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text" data-toggle="modal" data-target="#modalGrupoVidaDistrito"> 
                        Crear Distrito <i class="mdi mdi-book-plus"></i>                          
                    </button>
                </div>';

        echo $ui->tdv_welcome_panel($BOTON);

        $res = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_distritos ORDER BY titulo DESC");
        $num = mysqli_num_rows($res);

        echo '<div id="divPrint" class="row mt-4">';
        while ($rs = $res->fetch_assoc()){
            $res1 = $TDV->conn->query("SELECT username FROM tdv_users WHERE id = ".$rs["idUser"]);
            $rs1 = $res1->fetch_assoc();

            $res2 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_zonas WHERE idDistrito = ".$rs["idDistrito"]);
            $num2 = mysqli_num_rows($res2);

            $res3 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_barrios WHERE idDistrito = ".$rs["idDistrito"]);
            $num3 = mysqli_num_rows($res3);

            $res4 = $TDV->conn->query("SELECT * FROM tdv_grupo_vida_casas WHERE idDistrito = ".$rs["idDistrito"]);
            $num4 = mysqli_num_rows($res4);

            $res5 = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idDistrito = ".$rs["idDistrito"]);
            $num5 = mysqli_num_rows($res5);

            echo '<div class="col-lg-4 d-flex stretch-card" style="margin-top:10px;">
                        <div class="card" style="background:'.$rs["color"].'">
                            <div class="card-body text-white" style="padding:10px;">
                                <div class="d-flex align-items-center justify-content-between">
									<h4 class="card-title mb-2">Asignado: '.$rs1["username"].'</h4>
									<div class="dropdown">
                                        <a href="#" class="text-white btn btn-link px-1"  data-id="'.$rs["idDistrito"].'" onclick="TDV.getOneRow(this, \'grupo_vida_distritos\');" data-toggle="modal" data-target="#modalGrupoVidaDistrito"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="text-white btn btn-link px-1" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'grupo_vida_distritos\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idDistrito"].');"> <i class="mdi mdi-minus-box"></i> </a>
							        </div>
                                </div>            

                                <h3 class="font-weight-bold mb-3">'.$rs["titulo"].'</h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <ul class="graphl-legend-rectangle">
                                            <li><span class="bg-danger"></span>Zonas</li>
                                            <li><span class="bg-warning"></span>Barrios</li>
                                            <li><span class="bg-info"></span>Casas</li>
                                            <li><span class="bg-success"></span>Miembros</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-8">
                                        <canvas id="distritosGV'.$rs["idDistrito"].'"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

            echo '<script>';
            echo 'var distritosGVData'.$rs["idDistrito"].' = {
                        datasets: [{
                            data: ['.$num2.', '.$num3.', '.$num4.', '.$num5.'],
                            backgroundColor: [
                                "#ee5b5b",
                                "#fcd53b",
                                "#0bdbb8",
                                "#464dee"
                            ],
                            borderColor: [
                                "#ee5b5b",
                                "#fcd53b",
                                "#0bdbb8",
                                "#464dee"
                            ],
                        }],
                        // These labels appear in the legend and in the tooltips when hovering different arcs
                        labels: [
                            "Zonas",
                            "Barrios",
                            "Casas",
                            "Miembros"
                        ]
                    };
                    var distritosGVOptions'.$rs["idDistrito"].' = {
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
                    if ($("#distritosGV'.$rs["idDistrito"].'").length) {
                        var pieChartCanvas = $("#distritosGV'.$rs["idDistrito"].'").get(0).getContext("2d");
                        var pieChart = new Chart(pieChartCanvas, {
                            type: "doughnut",
                            data: distritosGVData'.$rs["idDistrito"].',
                            options: distritosGVOptions'.$rs["idDistrito"].'
                        });
                    }';
            echo '</script>';
        }
        echo '</div>';

        echo $ui->tdv_grupo_vida_distrito_modal();
        echo $ui->tdv_delete_modal();
    }  
?>