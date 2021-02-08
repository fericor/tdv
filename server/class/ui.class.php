<?php
    class tdv_ui {
        public $conn;

        function __construct($HOST, $USER, $PASS, $DB){
            $this->conn = new mysqli($HOST, $USER, $PASS, $DB) or die(mysql_error());
            $this->conn->set_charset("utf8");
        }

        public function tdv_menu_left(){
            $HTML = '
                <ul class="navbar-nav navbar-nav-left">
                    <li class="nav-item ml-0 mr-5 d-lg-flex d-none">
                        <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
                    </li>
                    <li class="nav-item dropdown" style="display:none;">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-bell mx-0"></i>
                            <span class="count bg-success">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notificaciones</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-information mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Errores</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">Just now</p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-settings mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted"> Private message </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                            <i class="mdi mdi-account-box mx-0"></i>
                            </div>
                            </div>
                            <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">New user registration</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                            2 days ago
                            </p>
                            </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown" style="display:none;">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-email mx-0"></i>
                            <span class="count bg-primary">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-normal">David Grey</h6>
                                    <p class="font-weight-light small-text text-muted mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook</h6>
                                    <p class="font-weight-light small-text text-muted mb-0">New product launch</p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-normal"> Johnson </h6>
                                    <p class="font-weight-light small-text text-muted mb-0"> Upcoming board meeting </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-search d-none d-lg-block ml-3" style="display:none !important;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="search">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Buscar" id="txt-search" aria-label="search" aria-describedby="search">
                        </div>
                    </li>	
                </ul>
                ';

            return $HTML;
        }

        public function tdv_menu_right(){
            $HTML = '
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown  d-lg-flex d-none">
                        <a href="?mod=mod_members" class="btn btn-inverse-primary btn-sm">Miembros </a>
                    </li>
                    <li class="nav-item dropdown d-lg-flex d-none">
                        <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-toggle="dropdown"> Informes </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">
                            <p class="mb-0 font-weight-medium float-left dropdown-header">Informes</p>
                            <a href="server/miembros/getConstituyentesExcel.php" class="dropdown-item"> <i class="mdi mdi-file-pdf text-primary"></i> Pdf </a>
                            <a href="server/miembros/getConstituyentesExcel.php" class="dropdown-item"> <i class="mdi mdi-file-excel text-primary"></i> Exel </a>
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <span class="nav-profile-name">'.$_SESSION["name"].'</span>
                            <span class="online-status"></span>
                            <img src="images/faces/face'.$_SESSION["id"].'.png" alt="profile" onerror="this.src=\'images/none.png\'"/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a href="?mod=mod_profile" class="dropdown-item"> <i class="mdi mdi-settings text-primary"></i> Perfil </a>
                            <a class="dropdown-item" onclick="TDV.logout();"> <i class="mdi mdi-logout text-primary"></i> Salir </a>
                        </div>
                    </li>
                </ul>
                    ';

            return $HTML;
        }

        public function tdv_menu_main(){
            $res = $this->conn->query("SELECT modulos FROM tdv_roles WHERE idRol = ".$_SESSION['idRol']);
            $rs = $res->fetch_assoc();
            $MODULOS = explode("|", $rs["modulos"]);
            $NUM = count($MODULOS);

            if($NUM <= 16){
                $HTML = '<ul class="nav page-navigation">';
                foreach ($MODULOS as &$MOD) {
                    $res1 = $this->conn->query("SELECT * FROM tdv_menus WHERE url = '?mod=".$MOD."' ORDER BY orden ASC");
                    while ($rs1 = $res1->fetch_assoc()) {
                        $HTML .= '<li class="nav-item">
                                <a class="nav-link" href="'.$rs1["url"].'">
                                    <i class="mdi '.$rs1["icon"].' menu-icon"></i>
                                    <span class="menu-title">'.$rs1["titulo"].'</span>
                                </a>
                            </li>';
                    }
                }
                $HTML .= '</ul>';
            }else{
                $res = $this->conn->query("SELECT * FROM tdv_menus WHERE nivel = 0 AND sub_nivel = 0 AND activo = 1 ORDER BY orden ASC");
                $num = mysqli_num_rows($res);
                $MENU = "";
                $SUB_MENU = "";

                $HTML = '<ul class="nav page-navigation">';
                while ($rs = $res->fetch_assoc()) {
                    $res1 = $this->conn->query("SELECT * FROM tdv_menus WHERE nivel = '".$rs["id"]."' AND sub_nivel = 0 AND activo = 1 ORDER BY orden ASC");
                    $num1 = mysqli_num_rows($res1);
                    
                    if($num1 > 0){
                        $MENU = '';
                        while ($rs1 = $res1->fetch_assoc()) {
                            $res2 = $this->conn->query("SELECT * FROM tdv_menus WHERE sub_nivel = '".$rs1["id"]."' AND activo = 1 ORDER BY orden ASC");
                            $num2 = mysqli_num_rows($res2);

                            $SUB_MENU = '';
                            if($num2 > 0){
                                $SUB_MENU .= '<ul style="padding-top: 0px;">';
                                while ($rs2 = $res2->fetch_assoc()) {
                                    $SUB_MENU .= '<li class="nav-item"><a class="nav-link" href="'.$rs2["url"].'">'.$rs2["titulo"].'</a></li>';
                                }
                                $SUB_MENU .= '</ul>';
                            }

                            $MENU .= '<li class="nav-item"><a class="nav-link" href="'.$rs1["url"].'">'.$rs1["titulo"].'</a>'.$SUB_MENU.'</li>';
                        }

                        $ICON_FLECHA = '<i class="menu-arrow"></i>';
                        $HTML1 = '<div class="submenu">
                                <ul>
                                    '.$MENU.'
                                </ul>
                            </div>';
                    }else{
                        $ICON_FLECHA = '';
                        $HTML1 = '';
                    }

                    $HTML .= '<li class="nav-item">
                                <a class="nav-link" href="'.$rs["url"].'">
                                    <i class="mdi '.$rs["icon"].' menu-icon"></i>
                                    <span class="menu-title">'.$rs["titulo"].'</span>
                                    '.$ICON_FLECHA.'
                                </a>
                                '.$HTML1.'
                            </li>';
                }
                $HTML .= '</ul>';
            }

            return $HTML;
        }

        public function tdv_welcome_panel($BOTON="", $TITLE="Informe"){
            $HTML = '<div class="row">
                        <div class="col-sm-6 mb-4 mb-xl-0">
                            <div class="d-lg-flex align-items-center">
                                <div>
                                    <h3 class="text-dark font-weight-bold mb-2">Hola <b>'.$_SESSION['name'].'</b>, bienvenido!</h3>
                                    <h6 class="font-weight-normal mb-2">Última visita fue hace <i>'.$_SESSION['timestamp_login'].'</i></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center justify-content-md-end">
                                '.$BOTON.'

                                <div class="pr-1 mb-3 mb-xl-0">
                                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text" onclick="TDV.printdiv(\'divPrint\', \''.$TITLE.'\');">
                                        Imprimir <i class="mdi mdi-printer btn-icon-append"></i>                          
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_statistics_panel(){
            $LIDISTRITOS    = '';
            $COLORDISTRITOS = '';
            $LABELDISTRITOS = '';
            $NUMDISTRITOS   = '';
            $HOY            = date("Y-m-d");

            $res = $this->conn->query("SELECT * FROM tdv_grupo_vida_distritos WHERE idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            
            while ($rs = $res->fetch_assoc()) {
                $rs2 = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDistrito = ".$rs['idDistrito']);
                $num = mysqli_num_rows($rs2);

                $rs01 = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 7 AND idDistrito = ".$rs['idDistrito']);
                $numCABALLEROS = mysqli_num_rows($rs01);

                $rs02 = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 11 AND idDistrito = ".$rs['idDistrito']);
                $numDAMAS = mysqli_num_rows($rs02);

                $rs03 = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 4 AND idDistrito = ".$rs['idDistrito']);
                $numJOVENES = mysqli_num_rows($rs03);

                $rs04 = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 5 AND idDistrito = ".$rs['idDistrito']);
                $numESCUELADOMINICAL = mysqli_num_rows($rs04);

                $rs05 = $this->conn->query("SELECT * FROM tdv_miembros WHERE bautizado = 'on' AND idDistrito = ".$rs['idDistrito']);
                $numBAUTIZADOS = mysqli_num_rows($rs05);

                $rs06 = $this->conn->query("SELECT * FROM tdv_miembros WHERE espirituSanto = 'on' AND idDistrito = ".$rs['idDistrito']);
                $numESPIRITUSANTO = mysqli_num_rows($rs06);

                $LIDISTRITOS .= '<li style="display:grid;"><div style="background:'.$rs['color'].' !important;color:#fff;padding-left:10px;"> <b>'.$rs['titulo'].' - TOTAL: <i>'.$num.'</i></b> </div>   <div style="padding-left:30px;"> <b>CABALLEROS:</b> <i>'.$numCABALLEROS.'</i>  | <b>DAMAS:</b> <i>'.$numDAMAS.'</i>  | <b>JOVENES:</b> <i>'.$numJOVENES.'</i>  | <b>ESCUELA DOMINICAL:</b> <i>'.$numESCUELADOMINICAL.'</i> </div>  <div style="padding-left:30px;"> <b>BAUTIZADOS:</b> <i>'.$numBAUTIZADOS.'</i>  | <b>ESPIRITU SANTO:</b> <i>'.$numESPIRITUSANTO.'</i> </div> </li>';
                $COLORDISTRITOS .= '"'.$rs['color'].'",';
                $LABELDISTRITOS .= '"'.$rs['titulo'].'",';
                $NUMDISTRITOS .= $num.',';

                
            }

            $rsCaballerosBautizados = $this->conn->query("SELECT idMiembro FROM tdv_miembros WHERE fechaBautizado <= '".$HOY."' AND bautizado = 'on' AND idDepartamento = 7 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $numCaballerosBautizados = mysqli_num_rows($rsCaballerosBautizados);

            $rsDamasBautizados = $this->conn->query("SELECT idMiembro FROM tdv_miembros WHERE fechaBautizado <= '".$HOY."' AND bautizado = 'on' AND idDepartamento = 3 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $numDamasBautizados = mysqli_num_rows($rsDamasBautizados);

            $rsJovenesBautizados = $this->conn->query("SELECT idMiembro FROM tdv_miembros WHERE fechaBautizado <= '".$HOY."' AND bautizado = 'on' AND idDepartamento = 4 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $numJovenesBautizados = mysqli_num_rows($rsJovenesBautizados);

            $rsEscuelaBautizados = $this->conn->query("SELECT idMiembro FROM tdv_miembros WHERE fechaBautizado <= '".$HOY."' AND bautizado = 'on' AND idDepartamento = 5 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $numEscuelaBautizados = mysqli_num_rows($rsEscuelaBautizados);



            $rsCaballerosES = $this->conn->query("SELECT idMiembro FROM tdv_miembros WHERE fechaEspirituSanto <= '".$HOY."' AND espirituSanto = 'on' AND idDepartamento = 7 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $numCaballerosES = mysqli_num_rows($rsCaballerosES);

            $rsDamasES = $this->conn->query("SELECT idMiembro FROM tdv_miembros WHERE fechaEspirituSanto <= '".$HOY."' AND espirituSanto = 'on' AND idDepartamento = 3 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $numDamasES = mysqli_num_rows($rsDamasES);

            $rsJovenesES = $this->conn->query("SELECT idMiembro FROM tdv_miembros WHERE fechaEspirituSanto <= '".$HOY."' AND espirituSanto = 'on' AND idDepartamento = 4 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $numJovenesES = mysqli_num_rows($rsJovenesES);

            $rsEscuelaES = $this->conn->query("SELECT idMiembro FROM tdv_miembros WHERE fechaEspirituSanto <= '".$HOY."' AND espirituSanto = 'on' AND idDepartamento = 5 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $numEscuelaES = mysqli_num_rows($rsEscuelaES);

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="card-title">Bautizados</h4>
                                        <canvas id="bautizados"></canvas>
                                        <p class="mt-3 mb-4 mb-lg-0">
                                            Bautizados a fecha '.date("d/m/Y").'
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 class="card-title">Espíritu Santo</h4>
                                        <canvas id="espiritusanto"></canvas>
                                        <p class="mt-3 mb-4 mb-lg-0">
                                            Espíritu Santo a fecha '.date("d/m/Y").'
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="card-title">GRUPO VIDA</h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <ul class="graphl-legend-rectangle">
                                                    '.$LIDISTRITOS.'
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 grid-margin">
                                                <canvas id="distritos"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

            $HTML .= '<script>
                        var distritosData = {
                            datasets: [{
                                data: ['.$NUMDISTRITOS.'],
                                backgroundColor: ['.$COLORDISTRITOS.'],
                                borderColor: ['.$COLORDISTRITOS.'],
                            }],
                            labels: ['.$LABELDISTRITOS.']
                        };
                        var distritosOptions = {
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
                        if ($("#distritos").length) {
                            var pieChartCanvas = $("#distritos").get(0).getContext("2d");
                            var pieChart = new Chart(pieChartCanvas, {
                                type: "doughnut",
                                data: distritosData,
                                options: distritosOptions
                            });
                        }


                        var bautizadosdata = {
                            labels: ["Caballeros", "Damas", "Jóvenes", "Escuela Dominical"],
                            datasets: [{
                                label: "Bautizados",
                                data: ['.$numCaballerosBautizados.', '.$numDamasBautizados.', '.$numJovenesBautizados.', '.$numEscuelaBautizados.'],
                                backgroundColor: [
                                        "#8169f2",
                                        "#6a4df5",
                                        "#4f2def",
                                        "#2b0bc5",
                                ],
                                borderColor: [
                                        "#8169f2",
                                        "#6a4df5",
                                        "#4f2def",
                                        "#2b0bc5",
                                ],
                                borderWidth: 2,
                                fill: false
                            }],
                        };
                        var bautizadosOptions = {
                            scales: {
                                xAxes: [{
                                    position: "bottom",
                                    display: false,
                                    gridLines: {
                                            display: false,
                                            drawBorder: true,
                                    },
                                    ticks: {
                                            display: false ,//this will remove only the label
                                            beginAtZero: true
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        drawBorder: true,
                                        display: false,
                                    },
                                    ticks: {
                                        beginAtZero: true
                                    },
                                }]
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                show: false,
                                backgroundColor: "rgba(31, 59, 179, 1)",
                            },
                            plugins: {
                            datalabels: {
                                    display: true,
                                    align: "start",
                                    color: "white",
                                }
                            }				
                
                        };
                        if ($("#bautizados").length) {
                            var barChartCanvas = $("#bautizados").get(0).getContext("2d");
                            // This will get the first returned node in the jQuery collection.
                            var barChart = new Chart(barChartCanvas, {
                                type: "horizontalBar",
                                data: bautizadosdata,
                                options: bautizadosOptions,
                            });
                        }


                        var esdata = {
                            labels: ["Caballeros", "Damas", "Jóvenes", "Escuela Dominical"],
                            datasets: [{
                                label: "Espíritu Santo",
                                data: ['.$numCaballerosES.', '.$numDamasES.', '.$numJovenesES.', '.$numEscuelaES.'],
                                backgroundColor: [
                                        "#8169f2",
                                        "#6a4df5",
                                        "#4f2def",
                                        "#2b0bc5",
                                ],
                                borderColor: [
                                        "#8169f2",
                                        "#6a4df5",
                                        "#4f2def",
                                        "#2b0bc5",
                                ],
                                borderWidth: 2,
                                fill: false
                            }],
                        };
                        var esOptions = {
                            scales: {
                                xAxes: [{
                                    position: "bottom",
                                    display: false,
                                    gridLines: {
                                            display: false,
                                            drawBorder: true,
                                    },
                                    ticks: {
                                            display: false ,//this will remove only the label
                                            beginAtZero: true
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        drawBorder: true,
                                        display: false,
                                    },
                                    ticks: {
                                        beginAtZero: true
                                    },
                                }]
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                show: false,
                                backgroundColor: "rgba(31, 59, 179, 1)",
                            },
                            plugins: {
                            datalabels: {
                                    display: true,
                                    align: "start",
                                    color: "white",
                                }
                            }				
                
                        };
                        if ($("#espiritusanto").length) {
                            var barChartCanvas = $("#espiritusanto").get(0).getContext("2d");
                            var barChart = new Chart(barChartCanvas, {
                                type: "horizontalBar",
                                data: esdata,
                                options: esOptions,
                            });
                        }
                    </script>';

            return $HTML;
        }

        public function tdv_GV_statistics_panel(){
            $LIDISTRITOS    = '';
            $COLORDISTRITOS = '';
            $LABELDISTRITOS = '';
            $NUMDISTRITOS   = '';
            $HOY            = date("Y-m-d");

            $res = $this->conn->query("SELECT * FROM tdv_grupo_vida_distritos WHERE idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            
            while ($rs = $res->fetch_assoc()) {
                $rs2 = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDistrito = ".$rs['idDistrito']);
                $num = mysqli_num_rows($rs2);

                $LIDISTRITOS .= '<li><span style="background: '.$rs['color'].' !important;"></span>'.$rs['titulo'].' | <b>TOTAL: </b> <i>'.$num.'</i></li>';
                $COLORDISTRITOS .= '"'.$rs['color'].'",';
                $LABELDISTRITOS .= '"'.$rs['titulo'].'",';
                $NUMDISTRITOS .= $num.',';
            }

            $rsCaballerosBautizados = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 7 AND tb1.tipo = 'GRUPO_VIDA' AND tb3.bautizado = 'on'");
            $numCaballerosBautizados = mysqli_num_rows($rsCaballerosBautizados);
            $rsCaballerosEspirituSanto = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 7 AND tb1.tipo = 'GRUPO_VIDA' AND tb3.espirituSanto = 'on'");
            $numCaballerosEspirituSanto = mysqli_num_rows($rsCaballerosEspirituSanto);

            $rsDamasBautizados = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 11 AND tb1.tipo = 'GRUPO_VIDA' AND tb3.bautizado = 'on'");
            $numDamasBautizados = mysqli_num_rows($rsDamasBautizados);
            $rsDamasEspirituSanto = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 11 AND tb1.tipo = 'GRUPO_VIDA' AND tb3.espirituSanto = 'on'");
            $numDamasEspirituSanto = mysqli_num_rows($rsDamasEspirituSanto);

            $rsJovenesBautizados = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 4 AND tb1.tipo = 'GRUPO_VIDA' AND tb3.bautizado = 'on'");
            $numJovenesBautizados = mysqli_num_rows($rsJovenesBautizados);
            $rsJovenesEspirituSanto = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 4 AND tb1.tipo = 'GRUPO_VIDA' AND tb3.espirituSanto = 'on'");
            $numJovenesEspirituSanto = mysqli_num_rows($rsJovenesEspirituSanto);

            $rsEscuelaBautizados = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 5 AND tb1.tipo = 'GRUPO_VIDA' AND tb3.bautizado = 'on'");
            $numEscuelaBautizados = mysqli_num_rows($rsEscuelaBautizados);
            $rsEscuelaDominicalEspirituSanto = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 5 AND tb1.tipo = 'GRUPO_VIDA' AND tb3.espirituSanto = 'on'");
            $numEscuelaDominicalEspirituSanto = mysqli_num_rows($rsEscuelaDominicalEspirituSanto);



            $rsCaballerosES = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 7 AND tb1.tipo = 'GRUPO_VIDA'");
            $numCaballerosES = mysqli_num_rows($rsCaballerosES);

            $rsDamasES = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 11 AND tb1.tipo = 'GRUPO_VIDA'");
            $numDamasES = mysqli_num_rows($rsDamasES);

            $rsJovenesES = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 4 AND tb1.tipo = 'GRUPO_VIDA'");
            $numJovenesES = mysqli_num_rows($rsJovenesES);

            $rsEscuelaES = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 5 AND tb1.tipo = 'GRUPO_VIDA'");
            $numEscuelaES = mysqli_num_rows($rsEscuelaES);

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="card-title">Bautizados</h4>
                                        <canvas id="bautizados"></canvas>
                                        <p class="mt-3 mb-4 mb-lg-0">
                                            Bautizados a fecha '.date("d/m/Y").'
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 class="card-title">Espíritu Santo</h4>
                                        <canvas id="espiritusanto"></canvas>
                                        <p class="mt-3 mb-4 mb-lg-0">
                                            Espíritu Santo a fecha '.date("d/m/Y").'
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="card-title">GRUPO VIDA</h4>
                                        <div class="row">
                                            <div class="col-3">
                                                <ul class="graphl-legend-rectangle">
                                                    '.$LIDISTRITOS.'
                                                </ul>
                                            </div>
                                            <div class="col-9 grid-margin">
                                                <canvas id="distritos"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">CABALLEROS</h4>
                                <ul class="graphl-legend-rectangle">
                                    '.$LIDISTRITOS.'
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">DAMAS</h4>
                                <ul class="graphl-legend-rectangle">
                                    '.$LIDISTRITOS.'
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">JOVENES</h4>
                                <ul class="graphl-legend-rectangle">
                                    '.$LIDISTRITOS.'
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ESCUELA DOMINICAL</h4>
                                <ul class="graphl-legend-rectangle">
                                    '.$LIDISTRITOS.'
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">BAUTIZADOS</h4>
                                <ul class="graphl-legend-rectangle">
                                    '.$LIDISTRITOS.'
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ESPIRITU SANTO</h4>
                                <ul class="graphl-legend-rectangle">
                                    '.$LIDISTRITOS.'
                                </ul>
                            </div>
                        </div>
                    </div>
                               
                    ';

                $HTML .= '<script>
                        var distritosData = {
                            datasets: [{
                                data: ['.$NUMDISTRITOS.'],
                                backgroundColor: ['.$COLORDISTRITOS.'],
                                borderColor: ['.$COLORDISTRITOS.'],
                            }],
                            labels: ['.$LABELDISTRITOS.']
                        };
                        var distritosOptions = {
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
                        if ($("#distritos").length) {
                            var pieChartCanvas = $("#distritos").get(0).getContext("2d");
                            var pieChart = new Chart(pieChartCanvas, {
                                type: "doughnut",
                                data: distritosData,
                                options: distritosOptions
                            });
                        }


                        var bautizadosdata = {
                            labels: ["Caballeros", "Damas", "Jóvenes", "Escuela Dominical"],
                            datasets: [{
                                label: "Bautizados",
                                data: ['.$numCaballerosBautizados.', '.$numDamasBautizados.', '.$numJovenesBautizados.', '.$numEscuelaBautizados.'],
                                backgroundColor: [
                                        "#8169f2",
                                        "#6a4df5",
                                        "#4f2def",
                                        "#2b0bc5",
                                ],
                                borderColor: [
                                        "#8169f2",
                                        "#6a4df5",
                                        "#4f2def",
                                        "#2b0bc5",
                                ],
                                borderWidth: 2,
                                fill: false
                            }],
                        };
                        var bautizadosOptions = {
                            scales: {
                                xAxes: [{
                                    position: "bottom",
                                    display: false,
                                    gridLines: {
                                            display: false,
                                            drawBorder: true,
                                    },
                                    ticks: {
                                            display: false ,//this will remove only the label
                                            beginAtZero: true
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        drawBorder: true,
                                        display: false,
                                    },
                                    ticks: {
                                        beginAtZero: true
                                    },
                                }]
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                show: false,
                                backgroundColor: "rgba(31, 59, 179, 1)",
                            },
                            plugins: {
                            datalabels: {
                                    display: true,
                                    align: "start",
                                    color: "white",
                                }
                            }				
                
                        };
                        if ($("#bautizados").length) {
                            var barChartCanvas = $("#bautizados").get(0).getContext("2d");
                            // This will get the first returned node in the jQuery collection.
                            var barChart = new Chart(barChartCanvas, {
                                type: "horizontalBar",
                                data: bautizadosdata,
                                options: bautizadosOptions,
                            });
                        }


                        var esdata = {
                            labels: ["Caballeros", "Damas", "Jóvenes", "Escuela Dominical"],
                            datasets: [{
                                label: "Espíritu Santo",
                                data: ['.$numCaballerosEspirituSanto.', '.$numDamasEspirituSanto.', '.$numJovenesEspirituSanto.', '.$numEscuelaDominicalEspirituSanto.'],
                                backgroundColor: [
                                        "#8169f2",
                                        "#6a4df5",
                                        "#4f2def",
                                        "#2b0bc5",
                                ],
                                borderColor: [
                                        "#8169f2",
                                        "#6a4df5",
                                        "#4f2def",
                                        "#2b0bc5",
                                ],
                                borderWidth: 2,
                                fill: false
                            }],
                        };
                        var esOptions = {
                            scales: {
                                xAxes: [{
                                    position: "bottom",
                                    display: false,
                                    gridLines: {
                                            display: false,
                                            drawBorder: true,
                                    },
                                    ticks: {
                                            display: false ,//this will remove only the label
                                            beginAtZero: true
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        drawBorder: true,
                                        display: false,
                                    },
                                    ticks: {
                                        beginAtZero: true
                                    },
                                }]
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                show: false,
                                backgroundColor: "rgba(31, 59, 179, 1)",
                            },
                            plugins: {
                            datalabels: {
                                    display: true,
                                    align: "start",
                                    color: "white",
                                }
                            }				
                
                        };
                        if ($("#espiritusanto").length) {
                            var barChartCanvas = $("#espiritusanto").get(0).getContext("2d");
                            var barChart = new Chart(barChartCanvas, {
                                type: "horizontalBar",
                                data: esdata,
                                options: esOptions,
                            });
                        }
                        </script>';

            return $HTML;
        }

        public function tdv_notification_panel(){
            $HTML = '';
            $HOY = date("Y-m-d");
            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE nacimiento = '".$HOY."'");
            while($rs = $res->fetch_assoc()){
                $HTML .= '<div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="card congratulation-bg text-center">
                            <div id="panelViewNotificacion" class="card-body pb-0">
                                <img src="data:'.$rs["imgBase64"].'" alt="">
                                <h2 class="mt-3 text-white mb-3 font-weight-bold">Cumpleaños de  <i>'.$rs["nombre"].' '.$rs["apellidos"].'</i></h2>
                            </div>
                        </div>
                    </div>';
            }

            return $HTML;
        }

        public function tdv_information_panel(){
            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_MIEMBROS = mysqli_num_rows($res);

            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento != 4 AND idDepartamento != 5 AND idDepartamento != 7 AND idDepartamento != 11 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_MIEMBROS_OTROS_DEPARTAMENTOS = mysqli_num_rows($res);

            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 7 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_MIEMBROS_CABALLEROS = mysqli_num_rows($res);

            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 11 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_MIEMBROS_DAMAS = mysqli_num_rows($res);

            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 4 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_MIEMBROS_JOVENES = mysqli_num_rows($res);

            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 5 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_MIEMBROS_ESCUELA_DOMINICAL = mysqli_num_rows($res);

            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE idTipoMiembro = 1 AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_MIEMBROS_VISITAS = mysqli_num_rows($res);

            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE bautizado = 'on' AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_BAUTIZADOS = mysqli_num_rows($res);

            $res = $this->conn->query("SELECT * FROM tdv_miembros WHERE espirituSanto = 'on' AND idIglesia = ".$_SESSION['S_ID_IGLESIA']);
            $NUM_ESPIRITU_SANTO = mysqli_num_rows($res);

            $HTML = '<div class="row">
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_members">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-success font-weight-bold">'.$NUM_MIEMBROS.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">TOTAL MIEMBROS</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_caballeros">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-danger font-weight-bold">'.$NUM_MIEMBROS_CABALLEROS.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">CABALLEROS</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_damas">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-info font-weight-bold">'.$NUM_MIEMBROS_DAMAS.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">DAMAS</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_jovenes">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-warning font-weight-bold">'.$NUM_MIEMBROS_JOVENES.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">JOVENES</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_escuelaDominical">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-t1 font-weight-bold">'.$NUM_MIEMBROS_ESCUELA_DOMINICAL.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">ESCUELA DOMINICAL</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card" data-toggle="modal" data-target="#modalTableOtrosMiembros" onclick="TDV.cargarListaMiembrosOtros(4);">
                            <div class="card">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-t2 font-weight-bold">'.$NUM_MIEMBROS_OTROS_DEPARTAMENTOS.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">OTROS DEPARTAMENTOS</div>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card" data-toggle="modal" data-target="#modalTableOtrosMiembros" onclick="TDV.cargarListaMiembrosOtros(3);">
                            <div class="card">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-t3 font-weight-bold">'.$NUM_MIEMBROS_VISITAS.'</h2>
                                        <i class="mdi mdi-account-outline text-dark mdi-18px"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">TOTAL VISITAS</div>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card" data-toggle="modal" data-target="#modalTableOtrosMiembros" onclick="TDV.cargarListaMiembrosOtros(2);">
                            <div class="card">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-t4 font-weight-bold">'.$NUM_BAUTIZADOS.'</h2>
                                        <i class="mdi mdi-account-outline text-dark mdi-18px"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">TOTAL BAUTIZADOS</div>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card" data-toggle="modal" data-target="#modalTableOtrosMiembros" onclick="TDV.cargarListaMiembrosOtros(1);">
                            <div class="card">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-t5 font-weight-bold">'.$NUM_ESPIRITU_SANTO.'</h2>
                                        <i class="mdi mdi-account-outline text-dark mdi-18px"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">TOTAL ESPIRITU SANTO</div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_GV_information_panel(){
            $res1 = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb1.tipo = 'GRUPO_VIDA'");
            $NUM_MIEMBROS = mysqli_num_rows($res1);

            $res2 = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 7 AND tb1.tipo = 'GRUPO_VIDA'");
            $NUM_MIEMBROS_CABALLEROS = mysqli_num_rows($res2);

            $res3 = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 11 AND tb1.tipo = 'GRUPO_VIDA'");
            $NUM_MIEMBROS_DAMAS = mysqli_num_rows($res3);

            $res4 = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 4 AND tb1.tipo = 'GRUPO_VIDA'");
            $NUM_MIEMBROS_JOVENES = mysqli_num_rows($res4);

            $res5 = $this->conn->query("SELECT tb3.* FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb3.idDepartamento = 5 AND tb1.tipo = 'GRUPO_VIDA'");
            $NUM_MIEMBROS_ESCUELA_DOMINICAL = mysqli_num_rows($res5);

            $res6 = $this->conn->query("SELECT tb3.idMiembro FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb1.tipo = 'GRUPO_VIDA' AND tb3.bautizado = 'on'");
            $NUM_MIEMBROS_BAUTIZADOS = mysqli_num_rows($res6);

            $res7 = $this->conn->query("SELECT tb3.idMiembro FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_lista_miembros_items AS tb2 ON tb1.idListaGrupo = tb2.idLista LEFT JOIN tdv_miembros AS tb3 ON tb2.idMiembro = tb3.idMiembro WHERE tb1.tipo = 'GRUPO_VIDA' AND tb3.espirituSanto = 'on'");
            $NUM_MIEMBROS_ESPIRITU_SANTO = mysqli_num_rows($res7);
            

            $HTML = '<div class="row">
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_members">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-success font-weight-bold">'.$NUM_MIEMBROS.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">TOTAL MIEMBROS</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_caballeros">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-danger font-weight-bold">'.$NUM_MIEMBROS_CABALLEROS.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">CABALLEROS</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_damas">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-info font-weight-bold">'.$NUM_MIEMBROS_DAMAS.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">DAMAS</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_jovenes">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-warning font-weight-bold">'.$NUM_MIEMBROS_JOVENES.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">JOVENES</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_jovenes">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-t3 font-weight-bold">'.$NUM_MIEMBROS_ESCUELA_DOMINICAL.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">ESCUELA DOMINICAL</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <a href="/index.php?mod=mod_group_escuelaDominical">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-t1 font-weight-bold">'.$NUM_MIEMBROS_BAUTIZADOS.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">BAUTIZADOS</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body pb-5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="text-t2 font-weight-bold">'.$NUM_MIEMBROS_ESPIRITU_SANTO.'</h2>
                                        <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                                    </div>
                                </div>
                                <div class="line-chart-row-title">ESPIRITU SANTO</div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        /** INICIO UI TABLES  */
        public function tdv_parentescos_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT * FROM tdv_parentescos ORDER BY titulo DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $FILAS .= '<tr>
                                <td class="py-1"> </td>
                                <td>'.$rs["titulo"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idParentesco"].'" onclick="TDV.getOneRow(this, \'parentescos\');" data-toggle="modal" data-target="#modalParentescosForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'parentescos\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idParentesco"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalParentescosForm" onclick="TDV.restarForm(\'frm_Parentescos\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>Parentesco</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_nacionalidades_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT * FROM tdv_nacionalidades ORDER BY titulo DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $FILAS .= '<tr>
                                <td class="py-1"> </td>
                                <td>'.$rs["titulo"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idNacionalidad"].'" onclick="TDV.getOneRow(this, \'nacionalidades\');" data-toggle="modal" data-target="#modalNacionalidadesForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'nacionalidades\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idNacionalidad"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalNacionalidadesForm" onclick="TDV.restarForm(\'frm_Nacionallidades\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>Nacionalidad</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_cultos_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT * FROM tdv_servicios_cultos ORDER BY fecha DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {

                $res0 = $this->conn->query("SELECT * FROM tdv_registro_cultos WHERE idCulto = '".$rs["idServicio"]."' ORDER BY nombre ASC");
                $num0 = mysqli_num_rows($res0);

                $FILAS .= '<tr>
                                <td class="py-1">'.$rs["idServicio"].'</td>
                                <td><img src="/images/servicios/'.$rs["idServicio"].'.png" onerror="this.src=\'images/none.png\'"></td>
                                <td>'.$rs["titulo"].'</td>
                                <td>'.$rs["dia"].'</td>
                                <td>'.$rs["fecha"].'</td>
                                <td>'.$rs["hora"].'</td>
                                <td style="color:blue;">'.$rs["limite"].'</td>
                                <td style="color:red;">'.$num0.'</td>
                                <td>
                                    <a class="btn btn-inverse-info btn-icon" href="https://app.tabernaculodevida.es/server/aforo/excelAforo.php?idServicio='.$rs["idServicio"].'" target="_blank" style="line-height: 28px;"> <i class="mdi mdi-file-export"></i> </a>
                                    <button type="button" class="btn btn-inverse-warning btn-icon" data-id="'.$rs["idServicio"].'" onclick="TDV.cargarListaServicio(\''.$rs["idServicio"].'\');" data-toggle="modal" data-target="#modalListaCulto"> <i class="mdi mdi-account-circle"></i> </button>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idServicio"].'" onclick="TDV.getOneRow(this, \'servicios_cultos\');" data-toggle="modal" data-target="#modalServiciosCultoForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'servicios_cultos\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idServicio"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalServiciosCultoForm" onclick="TDV.restarForm(\'frm_ServiciosCultos\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th> </th>
                                                <th>Servicio</th>
                                                <th>Día</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>AFORO</th>
                                                <th>PLAZAS</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_rols_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT * FROM tdv_roles ORDER BY titulo DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $pos = strpos($rs["titulo"], " (*)");

                if ($pos === false) {
                    $BOTON1 = '<button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idRol"].'" onclick="TDV.getOneRow(this, \'roles\');" data-toggle="modal" data-target="#modalRolForm"> <i class="mdi mdi-grease-pencil"></i> </button>';
                    $BOTON2 = '<button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'roles\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idRol"].');"> <i class="mdi mdi-minus-box"></i> </button>';
                } else {
                    $BOTON1 = '<button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idRol"].'" onclick="TDV.getOneRow(this, \'roles\');" data-toggle="modal" data-target="#modalRolForm"> <i class="mdi mdi-grease-pencil"></i> </button>';
                    $BOTON2 = "";
                }

                $FILAS .= '<tr>
                                <td> </td>
                                <td>'.$rs["titulo"].'</td>
                                <td>'.substr($rs["modulos"], 0, 70).'...</td>
                                <td>
                                    '.$BOTON1.'
                                    '.$BOTON2.'
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalRolForm" onclick="TDV.restarForm(\'frm_roles\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>ROL</th>
                                                <th>MODULOS</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_departamentos_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT * FROM tdv_departamentos ORDER BY titulo DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $pos = strpos($rs["titulo"], " (*)");

                if ($pos === false) {
                    $BOTON1 = '<button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idDepartamento"].'" onclick="TDV.getOneRow(this, \'departamentos\');" data-toggle="modal" data-target="#modalDepartamentosForm"> <i class="mdi mdi-grease-pencil"></i> </button>';
                    $BOTON2 = '<button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'departamentos\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idDepartamento"].');"> <i class="mdi mdi-minus-box"></i> </button>';
                } else {
                    $BOTON1 = "";
                    $BOTON2 = "";
                }

                $FILAS .= '<tr>
                                <td> </td>
                                <td>'.$rs["titulo"].'</td>
                                <td>'.$rs["descripcion"].'</td>
                                <td>
                                    '.$BOTON1.'
                                    '.$BOTON2.'
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalDepartamentosForm" onclick="TDV.restarForm(\'frm_departamentos\');">
                                        Crear Grupo o Departamento <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped tdv_table">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>GRUPO o DEPARTAMENTO</th>
                                                <th>DESCRIPCION</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_tipo_miembro_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT * FROM tdv_tipos_miembros ORDER BY titulo DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $FILAS .= '<tr>
                                <td> </td>
                                <td>'.$rs["titulo"].'</td>
                                <td>'.$rs["descripcion"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idTipoMiembro"].'" onclick="TDV.getOneRow(this, \'tipos_miembros\');" data-toggle="modal" data-target="#modalTipoMiembroForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'tipos_miembros\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idTipoMiembro"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalTipoMiembroForm" onclick="TDV.restarForm(\'frm_tipo_miembro\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>TIPO</th>
                                                <th>DESCRIPCION</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_members_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT tb1.*, tb2.titulo FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento WHERE tb1.idIglesia = ".$_SESSION['S_ID_IGLESIA']." ORDER BY tb1.apellidos ASC LIMIT 10");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $BAUTIZADO = $rs["bautizado"] == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
                $ESPIRITUSANTO = $rs["espirituSanto"] == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
               
                $FILAS .= '<tr>
                                <td class="py-1"> <img src="data:'.$rs["imgBase64"].'" alt="image" onerror="this.src=\'images/none.png\'" onclick="TDV.cargarImgeAvatar(this);"/> </td>
                                <td>'.$rs["nombre"].'</td>
                                <td>'.$rs["apellidos"].'</td>
                                <td>'.$rs["telefono"].'</td>
                                <!-- <td onclick="TDV.updateStatus(this, \'miembros\', '.$rs["idMiembro"].', \'bautizado\')">'.$BAUTIZADO.'</td>
                                <td onclick="TDV.updateStatus(this, \'miembros\', '.$rs["idMiembro"].', \'espirituSanto\')">'.$ESPIRITUSANTO.'</td> -->

                                <td>'.$BAUTIZADO.'</td>
                                <td>'.$ESPIRITUSANTO.'</td>

                                <td>'.$rs["titulo"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-warning btn-icon" onclick="TDV.enviarFelicitacion('.$rs["idMiembro"].');"> <i class="mdi mdi-link"></i> </button>
                                    <button type="button" class="btn btn-inverse-warning btn-icon" onclick="TDV.enviarFelicitacion('.$rs["idMiembro"].');"> <i class="mdi mdi-email"></i> </button>
                                    <button type="button" class="btn btn-inverse-warning btn-icon" onclick="TDV.enviarFelicitacion('.$rs["idMiembro"].');"> <i class="mdi mdi-send"></i> </button>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idMiembro"].'"  data-tabla="MIEMBROS" onclick="TDV.getMemberOne(this);" data-toggle="modal" data-target="#modalMiembrosForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'miembros\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idMiembro"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalMiembrosForm" onclick="TDV.restarForm(\'frm_miembros\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table id="tdv_tbl_Miembros" class="table table-striped tdv_tbl_Miembros">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDOS</th>
                                                <th>TELEFONO</th>
                                                <th>BAUT</th>
                                                <th>ES</th>
                                                <th>GRUPO</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_members_table2(){
            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalMiembrosForm" onclick="TDV.restarForm(\'frm_miembros\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table id="tdv_tbl_Miembros2" class="table table-striped tdv_tbl_Miembros2">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDOS</th>
                                                <th>TELEFONO</th>
                                                <th>BAUT</th>
                                                <th>ES</th>
                                                <th>GRUPO</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_members_familias(){
            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalMiembrosFamiliasForm" onclick="TDV.restarForm(\'frm_miembrosFamilias\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table id="tdv_tbl_M_Familias" class="table table-striped tdv_tbl_M_Familias">
                                        <thead>
                                            <tr>
                                                <th>FAMILIA</th>
                                                <th>NOTA</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_grupo_vida_list_members_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT tb1.*, tb2.username, tb3.titulo AS GRUPO, tb2.imgBase64 AS imgUSER, tb4.titulo AS SERVICIO FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_users AS tb2 ON tb1.idUser = tb2.id LEFT JOIN tdv_departamentos AS tb3 ON tb1.idDepartamento = tb3.idDepartamento LEFT JOIN tdv_servicios_cultos AS tb4 ON tb1.idServicio = tb4.idServicio WHERE tb1.tipo = 'GRUPO_VIDA' ORDER BY tb1.titulo DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                if($rs["titulo"] == "MANUAL"){

                }

                $FILAS .= '<tr>
                                <td>'.$rs["titulo"].'</td>
                                <td>'.$rs["SERVICIO"].'</td>
                                <td class="py-1"> <img src="data:'.$rs["imgUSER"].'" alt="image" onerror="this.src=\'images/none.png\'"/> '.$rs["username"].'</td>
                                <td>'.$rs["numero"].'</td>
                                <td>'.$rs["GRUPO"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idListaGrupo"].'" onclick="TDV.cargarListaViewHistorial('.$rs["idUser"].', '.$rs["idListaGrupo"].', 0); TDV.crearHidenValues('.$rs["idListaGrupo"].', '.$rs["idUser"].');" data-toggle="modal" data-target="#modalUserlisHistorial"> <i class="mdi mdi-history"></i> </button>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idListaGrupo"].'" onclick="TDV.getOneRow(this, \'lista_miembros\');" data-toggle="modal" data-target="#modalListaMiembrosForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-info btn-icon" data-id="'.$rs["idListaGrupo"].'" onclick="TDV.cargarListaView('.$rs["idUser"].', '.$rs["idListaGrupo"].');" data-toggle="modal" data-target="#modalListaMiembros"> <i class="mdi mdi-account-multiple-outline"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'lista_miembros\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idListaGrupo"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalListaMiembrosForm" onclick="TDV.cargarListaMiembrosCkb(\'ALL\'); TDV.restarForm(\'frm_lista_miembros\');">
                                        Crear lista <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </div>
                                    
                                <div class="table-responsive scroll">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>TITULO</th>
                                                <th>SERVICIO</th>
                                                <th>USUARIO</th>
                                                <th>NUMERO</th>
                                                <th>GRUPO</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_list_members_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT tb1.*, tb2.username, tb3.titulo AS GRUPO, tb2.imgBase64 AS imgUSER, tb4.titulo AS SERVICIO FROM tdv_lista_miembros AS tb1 LEFT JOIN tdv_users AS tb2 ON tb1.idUser = tb2.id LEFT JOIN tdv_departamentos AS tb3 ON tb1.idDepartamento = tb3.idDepartamento LEFT JOIN tdv_servicios_cultos AS tb4 ON tb1.idServicio = tb4.idServicio WHERE tb1.tipo = 'NORMAL' ORDER BY tb1.titulo DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                if($rs["titulo"] == "MANUAL"){

                }

                $FILAS .= '<tr>
                                <td>'.$rs["titulo"].'</td>
                                <td>'.$rs["SERVICIO"].'</td>
                                <td class="py-1"> <img src="data:'.$rs["imgUSER"].'" alt="image" onerror="this.src=\'images/none.png\'"/> '.$rs["username"].'</td>
                                <td>'.$rs["numero"].'</td>
                                <td>'.$rs["GRUPO"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idListaGrupo"].'" onclick="TDV.cargarListaViewHistorial('.$rs["idUser"].', '.$rs["idListaGrupo"].', 0); TDV.crearHidenValues('.$rs["idListaGrupo"].', '.$rs["idUser"].');" data-toggle="modal" data-target="#modalUserlisHistorial"> <i class="mdi mdi-history"></i> </button>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idListaGrupo"].'" onclick="TDV.getOneRow(this, \'lista_miembros\');" data-toggle="modal" data-target="#modalListaMiembrosForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-info btn-icon" data-id="'.$rs["idListaGrupo"].'" onclick="TDV.cargarListaView('.$rs["idUser"].', '.$rs["idListaGrupo"].');" data-toggle="modal" data-target="#modalListaMiembros"> <i class="mdi mdi-account-multiple-outline"></i> </button>
                                    <button type="button" class="btn btn-inverse-warning btn-icon" data-toggle="modal" onclick="TDV.crearLista('.$rs["idUser"].', '.$rs["idListaGrupo"].');" data-target="#modalLoadingLista"> <i class="mdi mdi-auto-fix"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'lista_miembros\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idListaGrupo"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalListaMiembrosForm" onclick="TDV.cargarListaMiembrosCkb(\'ALL\'); TDV.restarForm(\'frm_lista_miembros\');">
                                        Crear lista <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </div>
                                    
                                <div class="table-responsive scroll">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>TITULO</th>
                                                <th>SERVICIO</th>
                                                <th>USUARIO</th>
                                                <th>NUMERO</th>
                                                <th>GRUPO</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_users_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT tb1.*, tb2.titulo FROM tdv_users AS tb1 LEFT JOIN tdv_roles AS tb2 ON tb1.idRol = tb2.idRol ORDER BY tb1.username DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $ESTADO = $rs["activo"] == "on" ? '<label class="badge badge-info tdv_click">ACTIVO</label>' : '<label class="badge badge-danger tdv_click">DESACTIVO</label>';
               
                $FILAS .= '<tr>
                                <td class="py-1"> <img src="images/faces/face'.$rs["id"].'.jpg" alt="image" onerror="this.src=\'images/none.png\'"/> </td>
                                <td>'.$rs["username"].'</td>
                                <td>'.$rs["email"].'</td>
                                <td>'.$rs["titulo"].'</td>
                                <td onclick="TDV.updateStatus(this, \'users\', '.$rs["id"].', \'activo\')">'.$ESTADO.'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["id"].'" onclick="TDV.getOneRow(this, \'users\');" data-toggle="modal" data-target="#modalUserForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'users\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["id"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalUserForm" onclick="TDV.restarForm(\'frm_users\');">
                                        Crear <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>Usuario</th>
                                                <th>Email</th>
                                                <th>Rol</th>
                                                <th>Estado</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_visitas_hoy_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT tb1.*, tb2.titulo AS FAMILIA, tb3.titulo AS PARENTESCO FROM tdv_miembros AS tb1 LEFT JOIN tdv_familias AS tb2 ON tb1.idFamilia = tb2.idFamilia LEFT JOIN tdv_parentescos AS tb3 ON tb1.idParentesco = tb3.idParentesco WHERE DATE(tb1.fechaVisita) = CURDATE() ORDER BY tb1.fechaVisita DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $FILAS .= '<tr>
                                <td class="py-1"> <img src="data:'.$rs["imgBase64"].'" alt="image" onerror="this.src=\'images/none.png\'" onclick="TDV.cargarImgeAvatar(this);"/> </td>
                                <td>'.$rs["nombre"].'</td>
                                <td>'.$rs["apellidos"].'</td>
                                <td>'.$rs["FAMILIA"].'</td>
                                <td>'.$rs["PARENTESCO"].'</td>
                                <td>'.$rs["telefono"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idMiembro"].'" onclick="TDV.getOneRowVisitas(this, \'miembros\');"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'miembros\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idMiembro"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Familia</th>
                                                <th>Parentesco</th>
                                                <th>Teléfono</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_grupo_vida_lista_table($IDUSER, $IDLISTA=0){
            $FILAS = '';
            $res = $this->conn->query("SELECT tb2.*, tb3.titulo AS FAMILIA, tb4.titulo AS PARENTESCO FROM tdv_lista_miembros_items AS tb1 LEFT JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro LEFT JOIN tdv_familias AS tb3 ON tb2.idFamilia = tb3.idFamilia LEFT JOIN tdv_parentescos AS tb4 ON tb2.idParentesco = tb3.idParentesco WHERE tb1.idLista = {$IDLISTA} ORDER BY tb3.titulo DESC");
            $num = mysqli_num_rows($res);
           
            while ($rs = $res->fetch_assoc()) {
                $FILAS .= '<tr>
                                <td class="py-1"> <img src="data:'.$rs["imgBase64"].'" alt="image" onerror="this.src=\'images/none.png\'" onclick="TDV.cargarImgeAvatar(this);"/> </td>
                                <td>'.$rs["nombre"].'</td>
                                <td>'.$rs["apellidos"].'</td>
                                <td>'.$rs["FAMILIA"].'</td>
                                <td>'.$rs["PARENTESCO"].'</td>
                                <td>'.$rs["telefono"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idMiembro"].'" onclick="TDV.getOneRowVisitas(this, \'miembros\');"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'miembros\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idMiembro"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }



            $LISTADOS = '';
            $res = $this->conn->query("SELECT idListaGrupo, titulo FROM tdv_lista_miembros WHERE idUser = ".$IDUSER." ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $LISTADOS .= '<option value="'.$rs["idListaGrupo"].'">'.$rs["titulo"].'</option>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <div class="form-group">
                                <form id="frmSearchGVLista" method="POST">
                                    <label for="txt_idCulto" style="width:100%;"> Mis lista 
                                        <select class="form-control" id="idLista" name="idLista" style="width:100%;height:45px;" onchange="$(\'#frmSearchGVLista\').submit();">
                                            <option value="">Seleccionar</option>
                                            '.$LISTADOS.'
                                        </select>
                                    </label>
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Familia</th>
                                                <th>Parentesco</th>
                                                <th>Teléfono</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_casas_grupo_vida_table(){
            $FILAS = '';
            $res = $this->conn->query("SELECT tb1.*, tb3.idMiembro AS IDMAESTRO, CONCAT(tb2.nombre, ' ',tb2.apellidos) AS DUENO, CONCAT(tb3.nombre, ' ',tb3.apellidos) AS MAESTRO, CONCAT(tb4.nombre, ' ',tb4.apellidos) AS AYUDANTE FROM tdv_grupo_vida_casas AS tb1 LEFT JOIN tdv_miembros AS tb2 ON tb1.idDueno = tb2.idMiembro LEFT JOIN tdv_miembros AS tb3 ON tb1.idMaestro = tb3.idMiembro LEFT JOIN tdv_miembros AS tb4 ON tb1.idAyudante = tb4.idMiembro ORDER BY tb1.diaReunion DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $FILAS .= '<tr>
                                <td class="py-1"> <img src="images/faces/face'.$rs["IDMAESTRO"].'.jpg" alt="image" onerror="this.src=\'images/none.png\'"/> </td>
                                <td>'.$rs["DUENO"].'</td>
                                <td>'.$rs["MAESTRO"].'</td>
                                <td>'.$rs["AYUDANTE"].'</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-success btn-icon" data-id="'.$rs["idCasa"].'" onclick="TDV.getOneRow(this, \'grupo_vida_casas\');" data-toggle="modal" data-target="#modalCasasForm"> <i class="mdi mdi-grease-pencil"></i> </button>
                                    <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'grupo_vida_casas\'); $(\'#btnDeleteReg\').attr(\'data-rel\','.$rs["idCasa"].');"> <i class="mdi mdi-minus-box"></i> </button>
                                </td>
                            </tr>';
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#modalCasasForm" onclick="TDV.restarForm(\'frm_casas\');">
                                        Crear casa <i class="mdi mdi-library-plus"></i>                          
                                    </button>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-striped tdv_tables">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>DUEÑO</th>
                                                <th>MAESTRO</th>
                                                <th>AYUDANTE</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$FILAS.'
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_ckb_lista_miembros_table(){
            $HTML = '<div id="divTablaListaMiembros" class="table-responsive scroll">
                        <table class="table table-striped tdv_tablesCkb">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th> </th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDOS</th>
                                    <th>DEPARTAMENTO</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTrCkbMiembros">
                            
                            </tbody>
                        </table>
                    </div>';

            return $HTML;
        }
        /** FIN UI TABLES  */


        /** INICIO UI GENERAL  */
        public function tdv_no_module(){
            $HTML = '<div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Información del sistema</h4>
                                <div class="media">
                                    <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i>
                                    <div class="media-body">
                                        <p class="card-text">Tenemos problemas para acceder a este modulo.</p>
                                        <p class="card-text">Tal parece que este modulo no existe o no esta instalado.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_sin_permiso(){
            $HTML = '<div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Información del sistema</h4>
                                <div class="media">
                                    <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i>
                                    <div class="media-body">
                                        <p class="card-text">No tienes permiso para ver este modulo.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_form_edit_panel($MSJ=""){
            if($MSJ == ""){
                $res = $this->conn->query("SELECT proteccionDatos FROM tdv_configuracion WHERE idIglesia = ".$_SESSION["S_ID_IGLESIA"]);
                $rs  = $res->fetch_assoc();
                $MSJ = $rs["proteccionDatos"];
            }

            $HTML = '<div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" id="txtIdIglesia" value="'.$_SESSION["S_ID_IGLESIA"].'">
                                    <div class="col" id="summernote">'.html_entity_decode($MSJ).'</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <a onclick="updateProteccionDatos();" href="#" class="btn btn-primary">Guardar</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_getContentByTable($CAMPO, $TABLE, $WHERE){
            $res = $this->conn->query("SELECT $CAMPO AS contenido FROM $TABLE WHERE $WHERE");
            $rs  = $res->fetch_assoc();
            $MSJ = $rs["contenido"];

            return $MSJ;
        }
        /** FIN UI GENERAL */

        /** INICIO UI MODALS */
        public function tdv_members_otros_table_modal(){

            $HTML = '<div class="modal fade" id="modalTableOtrosMiembros" tabindex="-1" role="dialog" aria-labelledby="modalTableOtrosMiembrosLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTableOtrosMiembrosLabel">Membresia</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDOS</th>
                                                <th>TELEFONO</th>
                                                <th>BAUT</th>
                                                <th>ES</th>
                                                <th>GRUPO</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tblBodyOtrosMiembros">
                                        
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onclick="TDV.printdiv(\'modalTableOtrosMiembros\', \'Membresia\');">Imprimir</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_members_modal(){
            $DISTRITOS = '';
            $res1 = $this->conn->query("SELECT idDistrito, titulo FROM tdv_grupo_vida_distritos ORDER BY titulo DESC");
            while ($rs1 = $res1->fetch_assoc()) {
                $DISTRITOS .= '<option value="'.$rs1["idDistrito"].'">'.$rs1["titulo"].'</option>';
            }

            $DEPARTAMENTOS = '';
            $res = $this->conn->query("SELECT idDepartamento, titulo FROM tdv_departamentos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                if($_SESSION['idRol'] == 1){
                    $DEPARTAMENTOS .= '<option value="'.$rs["idDepartamento"].'">'.$rs["titulo"].'</option>';
                }else{
                    $pos = strpos($rs["titulo"], " (*)");

                    if ($pos === false) {
                        $DEPARTAMENTOS .= '';
                    }else{
                        $DEPARTAMENTOS .= '<option value="'.$rs["idDepartamento"].'">'.$rs["titulo"].'</option>';
                    }
                } 
            }

            $TIPOMIEMBRO = '';
            $res = $this->conn->query("SELECT idTipoMiembro, titulo FROM tdv_tipos_miembros ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $TIPOMIEMBRO .= '<option value="'.$rs["idTipoMiembro"].'">'.$rs["titulo"].'</option>';
            }

            $CIUDADES = '';
            $res = $this->conn->query("SELECT idCiudad, titulo FROM tdv_ciudades ORDER BY titulo ASC");
            while ($rs = $res->fetch_assoc()) {
                $CIUDADES .= '<option value="'.$rs["idCiudad"].'">'.$rs["titulo"].'</option>';
            }

            $ESTADOCIVIL = '';
            $res = $this->conn->query("SELECT idEstadoCivil, titulo FROM tdv_estado_civil ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $ESTADOCIVIL .= '<option value="'.$rs["idEstadoCivil"].'">'.$rs["titulo"].'</option>';
            }

            $NACIONALIDAD = '';
            $res = $this->conn->query("SELECT idNacionalidad, titulo FROM tdv_nacionalidades ORDER BY titulo ASC");
            while ($rs = $res->fetch_assoc()) {
                $NACIONALIDAD .= '<option value="'.$rs["idNacionalidad"].'">'.$rs["titulo"].'</option>';
            }

            $FAMILIAS = '';
            $res = $this->conn->query("SELECT idFamilia, titulo FROM tdv_familias WHERE idFamiliaIntegrantes = 0 ORDER BY idFamilia DESC");
            while ($rs = $res->fetch_assoc()) {
                $FAMILIAS .= '<option value="'.$rs["idFamilia"].'">'.$rs["titulo"].'</option>';
            }

            $PARENTESCOS = '';
            $res = $this->conn->query("SELECT idParentesco, titulo FROM tdv_parentescos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $PARENTESCOS .= '<option value="'.$rs["idParentesco"].'">'.$rs["titulo"].'</option>';
            }

            $HTML = '<div class="modal fade" id="modalMiembrosForm" tabindex="-1" role="dialog" aria-labelledby="modalMiembrosFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalMiembrosFormLabel">Miembros</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <form class="form" action="#" method="post" id="frm_miembrosM">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-4"><!--left col-->
                                            <div class="text-center">
                                                <canvas id="snapshot" width="200" style="background:#dedede;"></canvas>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#camaraModal" onclick="openCamera();">Hacer foto</button><br/>
                                            </div></hr><br>
                        
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left">Fecha nacimiento</span>
                                                    <input type="date" class="form-control" name="txt_nacimiento" id="txt_nacimiento" placeholder="dd/mm/yyyy">
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left"><strong>Espíritu Santo</strong></span>
                                                    <label class="toggle-switch toggle-switch-info" for="txt_espirituSantoM">
                                                        <input type="checkbox" id="txt_espirituSantoM" name="txt_espirituSanto" value="on">
                                                        <span class="toggle-slider round"></span>
                                                    </label>
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <label for="txt_fecha_espirituSanto">Fecha Espíritu Santo</label>
                                                    <input type="date" class="form-control" name="txt_fechaEspirituSanto" id="txt_fechaEspirituSanto" placeholder="dd/mm/yyyy">
                                                </li>
                                                <li class="list-group-item text-left"><span class="pull-left"><strong>Bautizado</strong></span>
                                                    <label class="toggle-switch toggle-switch-info" for="txt_bautizadoM">
                                                        <input type="checkbox" id="txt_bautizadoM" name="txt_bautizado" value="on">
                                                        <span class="toggle-slider round"></span>
                                                    </label>
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <label for="txt_fecha_bautizado">Fecha Bautizado</label>
                                                    <input type="date" class="form-control" name="txt_fechaBautizado" id="txt_fechaBautizado" placeholder="dd/mm/yyyy">
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left">Departamento</span>
                                                    <select id="txt_idDepartamento" name="txt_idDepartamento" class="js-basic-single" style="width:100%;">
                                                        '.$DEPARTAMENTOS.'
                                                    </select>
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left">Tipo</span>
                                                    <select id="txt_idTipoMiembro" name="txt_idTipoMiembro" class="js-basic-single" style="width:100%;">
                                                        '.$TIPOMIEMBRO.'
                                                    </select>
                                                </li>
                                            </ul> 
                                        </div><!--/col-4-->

                                        <div class="col-sm-8">
                                            <input type="hidden" name="txt_idMiembro" id="txt_idMiembro" value="0">
                                            <input type="hidden" name="txt_idUser" id="txt_idUser" value="0">
                                            <input type="hidden" name="txt_status" id="txt_status" value="NEW">
                                            <input type="hidden" name="txt_idIglesia" id="txt_idIglesia" value="'.$_SESSION['S_ID_IGLESIA'].'">

                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label for="txt_nombre">Nombre</label>
                                                    <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" placeholder="Nombre">
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="txt_apellidos">Apellidos</label>
                                                    <input type="text" class="form-control" name="txt_apellidos" id="txt_apellidos" placeholder="Apellidos">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4 form-group">
                                                    <label for="txt_telefono">Teléfono</label>
                                                    <input type="text" class="form-control" name="txt_telefono" id="txt_telefono" placeholder="Teléfono">
                                                </div>

                                                <div class="col-8 form-group">
                                                    <label for="txt_email">Email</label>
                                                    <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="you@email.com">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label for="txt_codigo_postal">Codigo postal</label>
                                                    <input type="text" class="form-control" name="txt_codigoPostal" id="txt_codigoPostal" placeholder="Codigo Postal">
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="txt_idNacionalidad">Nacionalidad</label>
                                                    <select id="txt_idNacionalidad" name="txt_idNacionalidad" class="js-basic-single" style="width:100%;">
                                                        '.$NACIONALIDAD.'
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label for="txt_idCiudad">Ciudad</label>
                                                    <select id="txt_idCiudad" name="txt_idCiudad" class="js-basic-single" style="width:100%;">
                                                        '.$CIUDADES.'
                                                    </select>
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="txt_provincia">Provincia</label>
                                                    <input type="text" class="form-control" name="txt_provincia" id="txt_provincia" placeholder="Provincia">
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="txt_direccion">Dirección</label>
                                                    <textarea class="form-control" name="txt_direccion" id="txt_direccion"></textarea>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-5 form-group">
                                                    <label for="txt_estado_civil">Estado civil</label>
                                                    <select id="txt_estadoCivil" name="txt_estadoCivil" class="js-basic-single" style="width:100%;">
                                                        '.$ESTADOCIVIL.'
                                                    </select>
                                                </div>

                                                <div class="col-2 form-group">
                                                    <label for="txt_n_hijos">Nº hijos</label>
                                                    <input type="text" class="form-control" name="txt_nHijos" id="txt_nHijos" placeholder="Nº hijos">
                                                </div>

                                                <div class="col-5 form-group">
                                                    <label for="txt_sexo">Sexo</label>
                                                    <select class="form-control" id="txt_sexo" name="txt_sexo" style="width: 100%;height: 45px;">
                                                        <option value="">Sexo</option>
                                                        <option value="VARON">Varón</option>
                                                        <option value="MUJER">Mujer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label for="txt_idFamilia" style="width: 100%;"> Familia <br>
                                                        <select class="form-control" id="txt_idFamilia" name="txt_idFamilia" style="width: 100%;height: 45px;">
                                                            <option value="">Seleccionar familia</option>
                                                            '.$FAMILIAS.'
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="txt_idParentesco" style="width: 100%;"> Parentesco <br>
                                                        <select class="form-control" id="txt_idParentesco" name="txt_idParentesco" style="width: 100%;height: 45px;">
                                                            <option class="hidden" value="" selected>Parentesco</option>
                                                            '.$PARENTESCOS.'
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="txt_idDistrito">Distritos</label>
                                                    <select id="txt_idDistrito" name="txt_idDistrito" class="js-basic-single" style="width:100%;" onchange="TDV.cargarCombo(this, \'tdv_grupo_vida_zonas\', \'idDistrito\', \'txt_idZona\');">
                                                        '.$DISTRITOS .' 
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="txt_idZona">Zonas</label>
                                                    <select id="txt_idZona" name="txt_idZona" class="js-basic-single" style="width:100%;" onchange="TDV.cargarCombo(this, \'tdv_grupo_vida_barrios\', \'idZona\', \'txt_idBarrio\');">
                                                    
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="txt_idBarrio">Barrio</label>
                                                    <select id="txt_idBarrio" name="txt_idBarrio" class="js-basic-single" style="width:100%;">
                                                    
                                                    </select>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="txt_observaciones">Observaciones</label>
                                                    <textarea class="form-control" name="txt_observacion" id="txt_observacion"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onclick="printDiv(\'modalMiembrosForm\');">Imprimir</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <input type="submit" class="btn btn-primary" value="Guardar">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_familias_modal(){
            $FAMILIAS = '';
            $res = $this->conn->query("SELECT idFamilia, titulo FROM tdv_familias ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $FAMILIAS .= '<option value="'.$rs["idFamilia"].'">'.$rs["titulo"].'</option>';
            }

            $PARENTESCOS = '';
            $res = $this->conn->query("SELECT idParentesco, titulo FROM tdv_parentescos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $PARENTESCOS .= '<option value="'.$rs["idParentesco"].'">'.$rs["titulo"].'</option>';
            }

            $MIEMBROS = '';
            $res = $this->conn->query("SELECT idMiembro, nombre, apellidos FROM tdv_miembros ORDER BY nombre DESC");
            while ($rs = $res->fetch_assoc()) {
                $MIEMBROS .= '<option value="'.$rs["idMiembro"].'">'.$rs["nombre"].' '.$rs["apellidos"].'</option>';
            }
            
            $HTML = '<div class="modal fade" id="modalMiembrosFamiliasForm" tabindex="-1" role="dialog" aria-labelledby="modalMiembrosFamiliasFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalMiembrosFamiliasFormLabel">Familia</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <form class="form" action="#" method="post" id="frm_miembrosFamilias">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="hidden" name="txt_idFamilia" id="txt_idFamilia" value="0">

                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        <label for="txt_titulo">Nombre familia</label>
                                                        <input type="text" class="form-control" name="txt_titulo" id="txt_titulo" placeholder="Nombre Familia">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        <label for="txt_nota">Notas</label>
                                                        <textarea class="form-control" name="txt_nota" id="txt_nota"></textarea>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="row">
                                                    <div class="col-4 form-group">
                                                        <label for="txt_idFamilia" style="width: 100%;"> Familia <br>
                                                            <select class="js-basic-single" id="txt_idFamilia" style="width: 100%;height: 45px;">
                                                                <option value="">Seleccionar familia</option>
                                                                '.$FAMILIAS.'
                                                            </select>
                                                        </label>
                                                    </div>

                                                    <div class="col-3 form-group">
                                                        <label for="txt_idMiembro" style="width: 100%;"> Constituyente <br>
                                                            <select class="js-basic-single" id="txt_idMiembro" style="width: 100%;height: 45px;">
                                                                <option value="">Seleccionar</option>
                                                                '.$MIEMBROS.'
                                                            </select>
                                                        </label>
                                                    </div>

                                                    <div class="col-3 form-group">
                                                        <label for="txt_idParentesco" style="width: 100%;"> Parentesco <br>
                                                            <select class="js-basic-single" id="txt_idParentesco" style="width: 100%;height: 45px;">
                                                                '.$PARENTESCOS.'
                                                            </select>
                                                        </label>
                                                    </div>

                                                    <div class="col-2 form-group">
                                                        <button type="button" class="btn btn-inverse-success btn-icon" onclick="TDV.addItemFamilia();"> <i class="mdi mdi-plus"></i> </button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table id="tblItemsFamilia" class="table table-striped tblItemsFamilia">
                                                                <thead>
                                                                    <tr>
                                                                        <th> </th>
                                                                        <th>NOMBRE</th>
                                                                        <th>APELLIDOS</th>
                                                                        <th>TELEFONO</th>
                                                                        <th>BAUT</th>
                                                                        <th>ES</th>
                                                                        <th>GRUPO</th>
                                                                        <th> </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div
                                                </div
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <input type="submit" class="btn btn-primary" value="Guardar">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_censo_estadistico(){
            $DISTRITOS = '';
            $res1 = $this->conn->query("SELECT idDistrito, titulo FROM tdv_grupo_vida_distritos ORDER BY titulo DESC");
            while ($rs1 = $res1->fetch_assoc()) {
                $DISTRITOS .= '<option value="'.$rs1["idDistrito"].'">'.$rs1["titulo"].'</option>';
            }

            $DEPARTAMENTOS = '';
            $res = $this->conn->query("SELECT idDepartamento, titulo FROM tdv_departamentos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $DEPARTAMENTOS .= '<option value="'.$rs["idDepartamento"].'">'.$rs["titulo"].'</option>';
            }

            $TIPOMIEMBRO = '';
            $res = $this->conn->query("SELECT idTipoMiembro, titulo FROM tdv_tipos_miembros ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $TIPOMIEMBRO .= '<option value="'.$rs["idTipoMiembro"].'">'.$rs["titulo"].'</option>';
            }

            $CIUDADES = '';
            $res = $this->conn->query("SELECT idCiudad, titulo FROM tdv_ciudades ORDER BY titulo ASC");
            while ($rs = $res->fetch_assoc()) {
                $CIUDADES .= '<option value="'.$rs["idCiudad"].'">'.$rs["titulo"].'</option>';
            }

            $ESTADOCIVIL = '';
            $res = $this->conn->query("SELECT idEstadoCivil, titulo FROM tdv_estado_civil ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $ESTADOCIVIL .= '<option value="'.$rs["idEstadoCivil"].'">'.$rs["titulo"].'</option>';
            }

            $NACIONALIDAD = '';
            $res = $this->conn->query("SELECT idNacionalidad, titulo FROM tdv_nacionalidades ORDER BY titulo ASC");
            while ($rs = $res->fetch_assoc()) {
                $NACIONALIDAD .= '<option value="'.$rs["idNacionalidad"].'">'.$rs["titulo"].'</option>';
            }

            $FAMILIAS = '';
            $res = $this->conn->query("SELECT idFamilia, titulo FROM tdv_familias WHERE idFamiliaIntegrantes = 0 ORDER BY idFamilia DESC");
            while ($rs = $res->fetch_assoc()) {
                $FAMILIAS .= '<option value="'.$rs["idFamilia"].'">'.$rs["titulo"].'</option>';
            }

            $PARENTESCOS = '';
            $res = $this->conn->query("SELECT idParentesco, titulo FROM tdv_parentescos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $PARENTESCOS .= '<option value="'.$rs["idParentesco"].'">'.$rs["titulo"].'</option>';
            }

            $HTML = '<div id="divCensoEstadistico" class="card">
                        <h2 style="text-align: center;  padding: 5px;"> Antes de dar al boton guardar favor de comprobar los datos. </h2>
                        
                        <div class="modal-content">
                            <form class="form" action="#" method="post" id="frm_miembrosC">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <div class="custom-control custom-checkbox">
                                                <input id="ckbPolitica" type="checkbox" class="custom-control-input" id="customCheck1" required>
                                                <label class="custom-control-label" for="customCheck1" style="font-size:25px;">He leído y acepto el aviso legal y la <a href="#" data-toggle="modal" data-target="#ProteccionDatosModal">política de privacidad</a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4"><!--left col-->
                                            <div class="text-center">
                                                <canvas id="snapshot" width="200" style="background:#dedede;"></canvas>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#camaraModal" onclick="openCamera();">Hacer foto</button><br/>
                                            </div></hr><br>
                        
                                            <ul class="list-group">
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left">Fecha nacimiento</span>
                                                    <input type="date" class="form-control" name="txt_nacimiento" id="txt_nacimiento" placeholder="dd/mm/yyyy">
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left"><strong>Espíritu Santo</strong></span>
                                                    <label class="toggle-switch toggle-switch-info" for="txt_espirituSanto">
                                                        <input type="checkbox" id="txt_espirituSanto" name="txt_espirituSanto" value="on">
                                                        <span class="toggle-slider round"></span>
                                                    </label> 
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <label for="txt_fecha_espirituSanto">Fecha Espíritu Santo</label>
                                                    <input type="date" class="form-control" name="txt_fechaEspirituSanto" id="txt_fechaEspirituSanto" placeholder="dd/mm/yyyy">
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left"><strong>Bautizado</strong></span>
                                                    <label class="toggle-switch toggle-switch-info" for="txt_bautizado">
                                                        <input type="checkbox" id="txt_bautizado" name="txt_bautizado" value="on">
                                                        <span class="toggle-slider round"></span>
                                                    </label> 
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <label for="txt_fecha_bautizado">Fecha Bautizado</label>
                                                    <input type="date" class="form-control" name="txt_fechaBautizado" id="txt_fechaBautizado" placeholder="dd/mm/yyyy">
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left">Departamento</span>
                                                    <select id="txt_idDepartamento" name="txt_idDepartamento" class="js-basic-single" style="width:100%;">
                                                        '.$DEPARTAMENTOS.'
                                                    </select>
                                                </li>
                                                <li class="list-group-item text-left">
                                                    <span class="pull-left">Tipo</span>
                                                    <select id="txt_idTipoMiembro" name="txt_idTipoMiembro" class="js-basic-single" style="width:100%;">
                                                        '.$TIPOMIEMBRO.'
                                                    </select>
                                                </li>
                                            </ul> 
                                        </div><!--/col-4-->

                                        <div class="col-sm-8">
                                            <input type="hidden" name="txt_idMiembro" id="txt_idMiembro" value="0">
                                            <input type="hidden" name="txt_idUser" id="txt_idUser" value="0">
                                            <input type="hidden" name="txt_status" id="txt_status" value="NEW">
                                            <input type="hidden" name="txt_idIglesia" id="txt_idIglesia" value="'.$_SESSION['S_ID_IGLESIA'].'">

                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label for="txt_nombre">Nombre</label>
                                                    <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" placeholder="Nombre">
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="txt_apellidos">Apellidos</label>
                                                    <input type="text" class="form-control" name="txt_apellidos" id="txt_apellidos" placeholder="Apellidos">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4 form-group">
                                                    <label for="txt_telefono">Teléfono</label>
                                                    <input type="text" class="form-control" name="txt_telefono" id="txt_telefono" placeholder="Teléfono">
                                                </div>

                                                <div class="col-8 form-group">
                                                    <label for="txt_email">Email</label>
                                                    <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="you@email.com">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label for="txt_codigo_postal">Codigo postal</label>
                                                    <input type="text" class="form-control" name="txt_codigoPostal" id="txt_codigoPostal" placeholder="Codigo Postal">
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="txt_idNacionalidad">Nacionalidad</label>
                                                    <select id="txt_idNacionalidad" name="txt_idNacionalidad" class="js-basic-single" style="width:100%;">
                                                        '.$NACIONALIDAD.'
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label for="txt_idCiudad">Ciudad</label>
                                                    <select id="txt_idCiudad" name="txt_idCiudad" class="js-basic-single" style="width:100%;">
                                                        '.$CIUDADES.'
                                                    </select>
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="txt_provincia">Provincia</label>
                                                    <input type="text" class="form-control" name="txt_provincia" id="txt_provincia" placeholder="Provincia">
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="txt_direccion">Dirección</label>
                                                    <textarea class="form-control" name="txt_direccion" id="txt_direccion"></textarea>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-5 form-group">
                                                    <label for="txt_estado_civil">Estado civil</label>
                                                    <select id="txt_estadoCivil" name="txt_estadoCivil" class="js-basic-single" style="width:100%;">
                                                        '.$ESTADOCIVIL.'
                                                    </select>
                                                </div>

                                                <div class="col-2 form-group">
                                                    <label for="txt_n_hijos">Nº hijos</label>
                                                    <input type="text" class="form-control" name="txt_nHijos" id="txt_nHijos" placeholder="Nº hijos">
                                                </div>

                                                <div class="col-5 form-group">
                                                    <label for="txt_sexo">Sexo</label>
                                                    <select class="form-control" id="txt_sexo" name="txt_sexo" style="width: 100%;height: 45px;">
                                                        <option value="">Sexo</option>
                                                        <option value="VARON">Varón</option>
                                                        <option value="MUJER">Mujer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label for="txt_idFamilia" style="width: 100%;"> Familia <br>
                                                        <select class="form-control" id="txt_idFamilia" name="txt_idFamilia" style="width: 100%;height: 45px;">
                                                            <option value="">Seleccionar familia</option>
                                                            '.$FAMILIAS.'
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="col-6 form-group">
                                                    <label for="txt_idParentesco" style="width: 100%;"> Parentesco <br>
                                                        <select class="form-control" id="txt_idParentesco" name="txt_idParentesco" style="width: 100%;height: 45px;">
                                                            <option class="hidden" value="" selected>Parentesco</option>
                                                            '.$PARENTESCOS.'
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="txt_idDistrito">Distritos</label>
                                                    <select id="txt_idDistrito" name="txt_idDistrito" class="js-basic-single" style="width:100%;" onchange="TDV.cargarCombo(this, \'tdv_grupo_vida_zonas\', \'idDistrito\', \'txt_idZona\');">
                                                        '.$DISTRITOS .' 
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="txt_idZona">Zonas</label>
                                                    <select id="txt_idZona" name="txt_idZona" class="js-basic-single" style="width:100%;" onchange="TDV.cargarCombo(this, \'tdv_grupo_vida_barrios\', \'idZona\', \'txt_idBarrio\');">
                                                    
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="txt_idBarrio">Barrio</label>
                                                    <select id="txt_idBarrio" name="txt_idBarrio" class="js-basic-single" style="width:100%;">
                                                    
                                                    </select>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <b style="color:red; font-size:20px;">En caso que tenga algún error en sus datos. Favor actualizar en el siguiente recuadro.</b>
                                                    <label for="txt_observaciones">Observaciones</label>
                                                    <textarea class="form-control" name="txt_observacion" id="txt_observacion"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onclick="printDiv(\'divCensoEstadistico\');">Imprimir</button>
                                    <input type="submit" class="btn btn-primary" value="Guardar">
                                </div>
                            </form>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_grupo_vida_list_members_modal(){
            $USUARIOS = '';
            $res = $this->conn->query("SELECT id, username FROM tdv_users ORDER BY username DESC");
            while ($rs = $res->fetch_assoc()) {
                $USUARIOS .= '<option value="'.$rs["id"].'">'.$rs["username"].'</option>';
            }

            $DEPARTAMENTOS = '';
            $res = $this->conn->query("SELECT idDepartamento, titulo FROM tdv_departamentos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $DEPARTAMENTOS .= '<option value="'.$rs["idDepartamento"].'">'.$rs["titulo"].'</option>';
            }

            $SERVICIOS = '';
            $res = $this->conn->query("SELECT idServicio, titulo FROM tdv_servicios_cultos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $SERVICIOS .= '<option value="'.$rs["idServicio"].'">'.$rs["titulo"].'</option>';
            }

            $HTML = '<div class="modal fade" id="modalListaMiembrosForm" tabindex="-1" role="dialog" aria-labelledby="modalListaMiembrosFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalListaMiembrosFormLabel">Listado Miembros</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_lista_miembros" autocomplete="off">
                                        <input type="hidden" name="txt_idListaGrupo" id="txt_idListaGrupo" value="0">
                                        <input type="hidden" name="txt_tipo" id="txt_tipo" value="GRUPO_VIDA">
                                        <div class="row">
                                            <div class="col-4 form-group">
                                                <label for="txt_idUser">Asignar usuario</label>
                                                <select id="txt_idUser" name="txt_idUser" class="js-basic-single" style="width:100%;" required>
                                                    '.$USUARIOS.'
                                                </select>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label for="txt_idDepartamento">Departamento o Grupo</label>
                                                <select id="txt_idDepartamento" name="txt_idDepartamento" class="js-basic-single" style="width:100%;">
                                                    '.$DEPARTAMENTOS.'
                                                </select>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label for="txt_idServicio">Servicio o Culto</label>
                                                <select id="txt_idServicio" name="txt_idServicio" class="js-basic-single" style="width:100%;">
                                                    '.$SERVICIOS.'
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-8 form-group">
                                                <label for="txt_titulo">Nombre lista</label>
                                                <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo de la lista" required>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label for="txt_numero">Numero lista</label>
                                                <input type="number" class="form-control" id="txt_numero" name="txt_numero" placeholder="10" value="10" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_comentarios">Comentarios</label>
                                            <textarea class="form-control" id="txt_comentarios" name="txt_comentarios" rows="4"></textarea>
                                        </div>
                                        <hr>
                                        <div id="divBuscarListaMiembros" class="row">
                                            <div class="col-12 form-group">
                                                <label>Filtrar Departamento o Grupo</label>
                                                <select class="js-basic-single" style="width:100%;" onchange="TDV.cargarListaMiembrosCkb(this);">
                                                    <option value="ALL">TODOS</option>
                                                    '.$DEPARTAMENTOS.'
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        '.$this->tdv_ckb_lista_miembros_table().'
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'lista_miembros\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_list_members_modal(){
            $USUARIOS = '';
            $res = $this->conn->query("SELECT id, username FROM tdv_users ORDER BY username DESC");
            while ($rs = $res->fetch_assoc()) {
                $USUARIOS .= '<option value="'.$rs["id"].'">'.$rs["username"].'</option>';
            }

            $DEPARTAMENTOS = '';
            $res = $this->conn->query("SELECT idDepartamento, titulo FROM tdv_departamentos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $DEPARTAMENTOS .= '<option value="'.$rs["idDepartamento"].'">'.$rs["titulo"].'</option>';
            }

            $SERVICIOS = '';
            $res = $this->conn->query("SELECT idServicio, titulo FROM tdv_servicios_cultos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $SERVICIOS .= '<option value="'.$rs["idServicio"].'">'.$rs["titulo"].'</option>';
            }

            $HTML = '<div class="modal fade" id="modalListaMiembrosForm" tabindex="-1" role="dialog" aria-labelledby="modalListaMiembrosFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalListaMiembrosFormLabel">Listado Miembros</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_lista_miembros" autocomplete="off">
                                        <input type="hidden" name="txt_idListaGrupo" id="txt_idListaGrupo" value="0">
                                        <input type="hidden" name="txt_tipo" id="txt_tipo" value="NORMAL">
                                        <div class="row">
                                            <div class="col-4 form-group">
                                                <label for="txt_idUser">Asignar usuario</label>
                                                <select id="txt_idUser" name="txt_idUser" class="js-basic-single" style="width:100%;" required>
                                                    '.$USUARIOS.'
                                                </select>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label for="txt_idDepartamento">Departamento o Grupo</label>
                                                <select id="txt_idDepartamento" name="txt_idDepartamento" class="js-basic-single" style="width:100%;">
                                                    '.$DEPARTAMENTOS.'
                                                </select>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label for="txt_idServicio">Servicio o Culto</label>
                                                <select id="txt_idServicio" name="txt_idServicio" class="js-basic-single" style="width:100%;">
                                                    '.$SERVICIOS.'
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-8 form-group">
                                                <label for="txt_titulo">Nombre lista</label>
                                                <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo de la lista" required>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label for="txt_numero">Numero lista</label>
                                                <input type="number" class="form-control" id="txt_numero" name="txt_numero" placeholder="10" value="10" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_comentarios">Comentarios</label>
                                            <textarea class="form-control" id="txt_comentarios" name="txt_comentarios" rows="4"></textarea>
                                        </div>
                                        <hr>
                                        <div id="divBuscarListaMiembros" class="row">
                                            <div class="col-12 form-group">
                                                <label>Filtrar Departamento o Grupo</label>
                                                <select class="js-basic-single" style="width:100%;" onchange="TDV.cargarListaMiembrosCkb(this);">
                                                    <option value="ALL">TODOS</option>
                                                    '.$DEPARTAMENTOS.'
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        '.$this->tdv_ckb_lista_miembros_table().'
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'lista_miembros\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_list_culto_items_modal(){
            $HTML = '<div class="modal fade" id="modalListaCulto" tabindex="-1" role="dialog" aria-labelledby="modalListaCultoLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalListaCultoLabel">Listado Servicio Culto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                         
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> </th>
                                                    <th> </th>
                                                    <th>NOMBRE</th>
                                                    <th>APELLIDOS</th>
                                                    <th>FECHA</th>
                                                    <th>EMAIL</th>
                                                    <th>TELEFONO</th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody id="bodyTrListaServicioView">
                                            
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_list_members_items_modal(){
            $HTML = '<div class="modal fade" id="modalListaMiembros" tabindex="-1" role="dialog" aria-labelledby="modalListaMiembrosLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalListaMiembrosLabel">Listado Miembros</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                         
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> </th>
                                                    <th>NOMBRE</th>
                                                    <th>APELLIDOS</th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody id="bodyTrListaAsistenciaView">
                                            
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'lista_miembros\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }
        
        public function tdv_user_modal($MODULOS_ARRAY=""){
            $ROLES = '';
            $res = $this->conn->query("SELECT idRol, titulo FROM tdv_roles ORDER BY idRol ASC");

            while ($rs = $res->fetch_assoc()) {
                $ROLES .= '<div class="form-check">
                                <input class="form-check-input" type="radio" name="rdo_idRol" id="rdo_idRol_'.$rs["idRol"].'" value="'.$rs["idRol"].'">
                                <label class="form-check-label" for="rdo_idRol_'.$rs["idRol"].'">'.$rs["titulo"].'</label>
                            </div>';
            }

            $DEPARTAMENTOS = '';
            $res = $this->conn->query("SELECT idDepartamento, titulo FROM tdv_departamentos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $DEPARTAMENTOS .= '<option value="'.$rs["idDepartamento"].'">'.$rs["titulo"].'</option>';
            }

            $MODULOS = '';

            foreach($MODULOS_ARRAY as $rs) {
                $MODULOS .= '<option value="'.$rs.'">'.$rs.'</option>';
            }

            $HTML = '<div class="modal fade" id="modalUserForm" tabindex="-1" role="dialog" aria-labelledby="modalUserFormLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalUserFormLabel">Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_users" autocomplete="off">
                                        <input type="hidden" name="txt_id" id="txt_id" value="0">
                                        <div class="form-group row">
                                            <label for="txt_username" class="col-sm-2 col-form-label">Usuario</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="txt_username" id="txt_username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txt_email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="txt_email" id="txt_email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txt_password" class="col-sm-2 col-form-label">Contraseña</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="txt_password" id="txt_password" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-4 pt-0">Rol de usuario</legend>
                                                <div class="col-sm-8">
                                                    '.$ROLES.'
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-sm-4">Activo (Si/No)</div>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ck_activo" id="ck_activo">
                                                    <label class="form-check-label" for="ck_activo"> Usuario activo </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 form-group">
                                                <label >Modulo por defecto</label>
                                                <select id="txt_modDefault" name="txt_modDefault" class="js-basic-single" style="width:100%;">
                                                    '.$MODULOS.'
                                                </select>
                                            </div>

                                            <div class="col-6 form-group">
                                                <label >Departamento</label>
                                                <select id="txt_idDepartamento" name="txt_idDepartamento" class="js-basic-single" style="width:100%;">
                                                    '.$DEPARTAMENTOS.'
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'users\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_nacionalidades_modal(){
            $HTML = '<div class="modal fade" id="modalNacionalidadesForm" tabindex="-1" role="dialog" aria-labelledby="modalNacionalidadesFormLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalNacionalidadesFormLabel">Nacionalidades</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_nacionalidades" autocomplete="off">
                                        <input type="hidden" name="txt_idNacionalidad" id="txt_idNacionalidad" value="0">
                                        <div class="form-group row">
                                            <label for="txt_titulo" class="col-sm-12 col-form-label">
                                                Nacionalidad
                                                <input type="text" class="form-control" name="txt_titulo" id="txt_titulo">
                                            </label>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'nacionalidades\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_parentescos_modal(){
            $HTML = '<div class="modal fade" id="modalParentescosForm" tabindex="-1" role="dialog" aria-labelledby="modalParentescosFormLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalParentescosFormLabel">Parentescos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_parentescos" autocomplete="off">
                                        <input type="hidden" name="txt_idParentesco" id="txt_idParentesco" value="0">
                                        <div class="form-group row">
                                            <label for="txt_titulo" class="col-sm-12 col-form-label">
                                                Parentesco
                                                <input type="text" class="form-control" name="txt_titulo" id="txt_titulo">
                                            </label>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label>Descripción</label>
                                                <textarea class="form-control" name="txt_descripcion" id="txt_descripcion"> </textarea>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'parentescos\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_cultos_modal(){
            $HTML = '<div class="modal fade" id="modalServiciosCultoForm" tabindex="-1" role="dialog" aria-labelledby="modalServiciosCultoFormLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalServiciosCultoFormLabel">Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_servicios_cultos" autocomplete="off" enctype="multipart/form-data">
                                        <input type="hidden" name="txt_idServicio" id="txt_idServicio" value="0">
                                        <div class="user-image mb-3 text-center">
                                            <div style="width:200px;height:auto;overflow:hidden;background:#cccccc;margin:0 auto">
                                            <img src="..." class="figure-img img-fluid rounded" id="imgServicioCulto" alt="">
                                            </div>
                                        </div>

                                        <div class="custom-file">
                                            <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
                                            <label class="custom-file-label" for="chooseFile">Seleccionar imagen</label>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="txt_titulo" class="col-sm-12 col-form-label">
                                                Servicio culto
                                                <input type="text" class="form-control" name="txt_titulo" id="txt_titulo">
                                            </label>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                Fecha del culto
                                                <input type="date" class="form-control" name="txt_fecha" id="txt_fecha">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-4 form-group">
                                                Día
                                                <select id="txt_dia" name="txt_dia" class="js-basic-single" style="width:100%;">
                                                    <option value="Lunes">Lunes</option>
                                                    <option value="Martes">Martes</option>
                                                    <option value="Miercoles">Miercoles</option>
                                                    <option value="Jueves">Jueves</option>
                                                    <option value="Viernes">Viernes</option>
                                                    <option value="Sabado">Sabado</option>
                                                    <option value="Domingo">Domingo</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-4 form-group">
                                                Hora
                                                <input type="time" class="form-control" name="txt_hora" id="txt_hora">
                                            </div>

                                            <div class="col-4 form-group">
                                                Limite (Aforo)
                                                <input type="text" class="form-control" name="txt_limite" id="txt_limite">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label>Descripción</label>
                                                <textarea class="form-control" name="txt_descripcion" id="txt_descripcion"> </textarea>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitFormImage(\'servicios_cultos\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_casas_grupo_vida_modal(){
            $FILAS     = '';
            $USUARIOS  = '';
            $DISTRITOS = '';
            $LISTADOS  = '';

            ////////////////////////////
            $res0 = $this->conn->query("SELECT id, username FROM tdv_users ORDER BY username DESC");
            while ($rs0 = $res0->fetch_assoc()) {
                $USUARIOS .= '<option value="'.$rs0["id"].'">'.$rs0["username"].'</option>';
            }

            ////////////////////////////
            $res2 = $this->conn->query("SELECT idListaGrupo, titulo FROM tdv_lista_miembros WHERE tipo = 'GRUPO_VIDA' ORDER BY titulo DESC");
            while ($rs2 = $res2->fetch_assoc()) {
                $LISTADOS .= '<option value="'.$rs2["idListaGrupo"].'">'.$rs2["titulo"].'</option>';
            }

            ////////////////////////////
            $res1 = $this->conn->query("SELECT idDistrito, titulo FROM tdv_grupo_vida_distritos ORDER BY titulo DESC");
            while ($rs1 = $res1->fetch_assoc()) {
                $DISTRITOS .= '<option value="'.$rs1["idDistrito"].'">'.$rs1["titulo"].'</option>';
            }

            $res = $this->conn->query("SELECT idMiembro, nombre, apellidos FROM tdv_miembros ORDER BY nombre DESC");
            $num = mysqli_num_rows($res);

            while ($rs = $res->fetch_assoc()) {
                $FILAS .= '<option value="'.$rs["idMiembro"].'">'.$rs["nombre"].' '.$rs["apellidos"].'</option>';
            }

            $HTML = '<div class="modal fade" id="modalCasasForm" tabindex="-1" role="dialog" aria-labelledby="modalCasasFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCasasFormLabel">CASAS::Grupos de Vida</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_casas" autocomplete="off">
                                        <input type="hidden" name="txt_idCasa" id="txt_idCasa" value="0">
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="txt_idUser">Asignar usuario</label>
                                                <select id="txt_idUser" name="txt_idUser" class="js-basic-single" style="width:100%;">
                                                    '.$USUARIOS .'
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label for="txt_idLista">Asignar lista</label>
                                                <select id="txt_idLista" name="txt_idLista" class="js-basic-single" style="width:100%;">
                                                    '.$LISTADOS .'
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="txt_idDistrito">Distritos</label>
                                                <select id="txt_idDistrito" name="txt_idDistrito" class="js-basic-single" style="width:100%;" onchange="TDV.cargarCombo(this, \'tdv_grupo_vida_zonas\', \'idDistrito\', \'txt_idZona\');">
                                                    '.$DISTRITOS .' 
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="txt_idZona">Zonas</label>
                                                <select id="txt_idZona" name="txt_idZona" class="js-basic-single" style="width:100%;" onchange="TDV.cargarCombo(this, \'tdv_grupo_vida_barrios\', \'idZona\', \'txt_idBarrio\');">
                                                   
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="txt_idBarrio">Barrio</label>
                                                <select id="txt_idBarrio" name="txt_idBarrio" class="js-basic-single" style="width:100%;">
                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="txt_direccion" class="col-sm-2 col-form-label">Dirección</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="txt_direccion" id="txt_direccion" rows="4"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col">
                                                <label for="txt_idDueno">Dueño</label>
                                                <select id="txt_idDueno" name="txt_idDueno" class="js-basic-single" style="width:100%;">
                                                    '.$FILAS .'
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label for="txt_idMaestro">Maestro</label>
                                                <select id="txt_idMaestro" name="txt_idMaestro" class="js-basic-single" style="width:100%;">
                                                    '.$FILAS .'
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label for="txt_idAyudante">Ayudante</label>
                                                <select id="txt_idAyudante" name="txt_idAyudante" class="js-basic-single" style="width:100%;">
                                                    '.$FILAS .'
                                                </select>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-6">
                                                <label for="txt_diaReunion">Día</label>
                                                <select id="txt_diaReunion" name="txt_diaReunion" class="form-control w-100">
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES">Miercoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO">Sabado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="txt_horaReunion">Hora</label>
                                                <input type="time" class="form-control" name="txt_horaReunion" id="txt_horaReunion">
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'casas\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_rol_modal($ROLES_ARRAY){
            $ROLES = '';

            foreach($ROLES_ARRAY as $rs) {
                $ROLES .= '<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ck_modulos[]" id="ck_modulos_'.$rs.'" value="'.$rs.'">
                                <label class="form-check-label" for="ck_modulos_'.$rs.'"> '.$rs.' </label>
                            </div>';
            }

            $HTML = '<div class="modal fade" id="modalRolForm" tabindex="-1" role="dialog" aria-labelledby="modalRolFormLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalUserFormLabel">Roles de usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_roles" autocomplete="off">
                                        <input type="hidden" name="txt_idRol" id="txt_idRol" value="0">
                                        <div class="form-group row">
                                            <label for="txt_titulo" class="col-sm-2 col-form-label">Titulo</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="txt_titulo" id="txt_titulo">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txt_descripcion" class="col-sm-2 col-form-label">Descripción</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="txt_descripcion" id="txt_descripcion"></textarea>
                                            </div>
                                        </div>
                                        
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-4 pt-0">Rol de usuario</legend>
                                                <div class="col-sm-8 tdv_scroll">
                                                    '.$ROLES.'
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'roles\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_departamentos_modal(){
            $HTML = '<div class="modal fade" id="modalDepartamentosForm" tabindex="-1" role="dialog" aria-labelledby="modalDepartamentosFormLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalUserFormLabel">Grupo o Departamentos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_departamentos" autocomplete="off">
                                        <input type="hidden" name="txt_idDepartamento" id="txt_idDepartamento" value="0">
                                        <div class="form-group row">
                                            <label for="txt_titulo" class="col-sm-2 col-form-label">Titulo</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="txt_titulo" id="txt_titulo">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txt_descripcion" class="col-sm-2 col-form-label">Descripción</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="txt_descripcion" id="txt_descripcion"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'departamentos\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_tipo_miembro_modal(){
            $HTML = '<div class="modal fade" id="modalTipoMiembroForm" tabindex="-1" role="dialog" aria-labelledby="modalRolFormLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalUserFormLabel">Tipos de miembros</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">

                                    <form id="frm_tipos_miembros" autocomplete="off">
                                        <input type="hidden" name="txt_idTipoMiembro" id="txt_idTipoMiembro" value="0">
                                        <div class="form-group">
                                            <label for="txt_titulo">Titulo</label>
                                            <input type="text" class="form-control" name="txt_titulo" id="txt_titulo">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_permisos">Permiso</label>
                                            <select id="txt_permisos" name="txt_permisos" class="js-basic-single" style="width:100%;">
                                                <option value="">Seleccionar</option>
                                                <option value="LECTURA_ESCRITURA">Lectura y escritura</option>
                                                <option value="LECTURA">Solo lectura</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_descripcion">Descripción</label>
                                            <textarea class="form-control" name="txt_descripcion" id="txt_descripcion"></textarea>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'tipos_miembros\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_delete_modal(){
            $HTML = '<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body"> Esta seguro que desea eliminar este registro? </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                <a href="#" data-rel="0" data-table="null" id="btnDeleteReg" onclick="TDV.deleteRegistro(this); $(\'#modalDelete\').modal(\'hide\');" class="btn btn-primary">Si</a> </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_grupo_vida_distrito_modal(){
            $USUARIOS = '';
            $res = $this->conn->query("SELECT id, username FROM tdv_users ORDER BY username DESC");
            while ($rs = $res->fetch_assoc()) {
                $USUARIOS .= '<option value="'.$rs["id"].'">'.$rs["username"].'</option>';
            }

            $HTML = '<div class="modal fade" id="modalGrupoVidaDistrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Grupo vida Distritos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                
                                    <form id="frm_grupo_vida_distritos" autocomplete="off">
                                        <input type="hidden" name="txt_idDistrito" id="txt_idDistrito" value="0">
                                        <input type="hidden" name="txt_color" id="txt_color" value="0">
                                        <div class="form-group">
                                            <label for="txt_idUser">Asignar usuario</label>
                                            <select id="txt_idUser" name="txt_idUser" class="js-basic-single" style="width:100%;" required>
                                                '.$USUARIOS.'
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-10 form-group">
                                                <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Nombre del distrito" required>
                                            </div>
                                            <div class="col-2" style="padding-top: 5px;">
                                                <div class="picker" id="picker1"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="txt_descripcion" id="txt_descripcion" rows="4" placeholder="Descripcion" ></textarea>
                                        </div>
                                    </form>
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'grupo_vida_distritos\');">Guardar</button> 
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_grupo_vida_zona_modal(){
            $USUARIOS = '';
            $res = $this->conn->query("SELECT id, username FROM tdv_users ORDER BY username DESC");
            while ($rs = $res->fetch_assoc()) {
                $USUARIOS .= '<option value="'.$rs["id"].'">'.$rs["username"].'</option>';
            }

            $DISTRITOS = '';
            $res = $this->conn->query("SELECT idDistrito, titulo FROM tdv_grupo_vida_distritos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $DISTRITOS .= '<option value="'.$rs["idDistrito"].'">'.$rs["titulo"].'</option>';
            }

            $HTML = '<div class="modal fade" id="modalGrupoVidaZonas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Zonas :: Grupo vida</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                
                                    <form id="frm_grupo_vida_zonas" autocomplete="off">
                                        <input type="hidden" name="txt_idZona" id="txt_idZona" value="0">
                                        <div class="form-group">
                                            <label for="txt_idUser">Asignar usuario</label>
                                            <select id="txt_idUser" name="txt_idUser" class="js-basic-single" style="width:100%;" required>
                                                '.$USUARIOS.'
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_idDistrito">Distrito</label>
                                            <select id="txt_idDistrito" name="txt_idDistrito" class="js-basic-single" style="width:100%;" required>
                                                '.$DISTRITOS.'
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Nombre del distrito" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="txt_descripcion" id="txt_descripcion" rows="4" placeholder="Descripcion" ></textarea>
                                        </div>
                                    </form>
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'grupo_vida_zonas\');">Guardar</button> 
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_lista_asistencia_modal(){
            $SERVICIOS = '';
            $res = $this->conn->query("SELECT idServicio, titulo FROM tdv_servicios_cultos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $SERVICIOS .= '<option value="'.$rs["idServicio"].'">'.$rs["titulo"].'</option>';
            }
            $HOY = date("Y-m-d");

            $HTML = '<div class="modal fade" id="modalListaAsistencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Lista asistencia :: '.date("d/m/Y").'</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body">

                            <form id="frm_lista_asistencia" autocomplete="off">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="txt_idServicio">Servicio o Culto</label>
                                            <select id="txt_idServicio" name="txt_idServicio" class="js-basic-single" style="width:100%;" onchange="TDV.resetHiddenAsistencia(this);">
                                                '.$SERVICIOS.'
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="txt_idServicio">Fecha</label>
                                            <input type="date" id="txt_fecha" name="txt_fecha" class="js-basic-single" value="'.$HOY.'" style="width:100%;">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive scroll">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDOS</th>
                                                <th>ESTA</th>
                                                <th>COMENTARIO</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyTrListaAsistencia">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'lista_asistencia\');">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_grupo_vida_barrio_modal(){
            $USUARIOS = '';
            $res = $this->conn->query("SELECT id, username FROM tdv_users ORDER BY username DESC");
            while ($rs = $res->fetch_assoc()) {
                $USUARIOS .= '<option value="'.$rs["id"].'">'.$rs["username"].'</option>';
            }

            $DISTRITOS = '';
            $res = $this->conn->query("SELECT idDistrito, titulo FROM tdv_grupo_vida_distritos ORDER BY titulo DESC");
            while ($rs = $res->fetch_assoc()) {
                $DISTRITOS .= '<option value="'.$rs["idDistrito"].'">'.$rs["titulo"].'</option>';
            }

            $HTML = '<div class="modal fade" id="modalGrupoVidaBarrios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Barrios :: Grupo vida</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                
                                    <form id="frm_grupo_vida_barrios" autocomplete="off">
                                        <input type="hidden" name="txt_idBarrio" id="txt_idBarrio" value="0">
                                        <div class="form-group">
                                            <label for="txt_idUser">Asignar usuario</label>
                                            <select id="txt_idUser" name="txt_idUser" class="js-basic-single" style="width:100%;" required>
                                                '.$USUARIOS.'
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="txt_idDistrito">Distritos</label>
                                                <select id="txt_idDistrito" name="txt_idDistrito" class="js-basic-single" style="width:100%;" onchange="TDV.cargarCombo(this, \'tdv_grupo_vida_zonas\', \'idDistrito\', \'txt_idZona\');">
                                                    '.$DISTRITOS .' 
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="txt_idZona">Zonas</label>
                                                <select id="txt_idZona" name="txt_idZona" class="js-basic-single" style="width:100%;">
                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <hr>
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Nombre de la zona" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="txt_descripcion" id="txt_descripcion" rows="4" placeholder="Descripcion" ></textarea>
                                        </div>
                                    </form>
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="TDV.submitForm(\'grupo_vida_barrios\');">Guardar</button> 
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tdv_create_lista_modal(){
            $HTML = '<div class="modal fade" id="modalLoadingLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body" id="divModalCrearLista">
                                    <button class="btn btn-primary" type="button" disabled style="width:100%;">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Creando lista de miembro...
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }

        public function tfv_image_avatar_modal(){
            $HTML = '<div id="modalImageAvatar" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img id="imgAvatarTDV" src="" style="width: 100%;">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>';

            return $HTML;
        }
        /** FIN UI MODALS */


    }
?>
