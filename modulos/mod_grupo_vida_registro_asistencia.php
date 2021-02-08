<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        $FAMILIAS = '';
        $res = $ui->conn->query("SELECT idFamilia, titulo FROM tdv_familias WHERE idFamiliaIntegrantes = 0 ORDER BY idFamilia DESC");
        while ($rs = $res->fetch_assoc()) {
            $FAMILIAS .= '<option value="'.$rs["idFamilia"].'">'.$rs["titulo"].'</option>';
        }

        $LISTADOS = '';
        $res = $ui->conn->query("SELECT idListaGrupo, titulo FROM tdv_lista_miembros WHERE idUser = ".$_SESSION['id']." ORDER BY titulo DESC");
        while ($rs = $res->fetch_assoc()) {
            $LISTADOS .= '<option value="'.$rs["idListaGrupo"].'">'.$rs["titulo"].'</option>';
        }

        $IDLISTA = isset($_POST["idLista"]) ? $_POST["idLista"] : 0;
        
?>
    <style>
        .register{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            margin-top: 3%;
            padding: 3%;
        }
        .register-left{
            text-align: center;
            color: #fff;
            margin-top: 4%;
        }
        .register-left input{
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            width: 60%;
            background: #f8f9fa;
            font-weight: bold;
            color: #383d41;
            margin-top: 30%;
            margin-bottom: 3%;
            cursor: pointer;
        }
        .register-left button{
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            width: 60%;
            background: #f8f9fa;
            font-weight: bold;
            color: #383d41;
            margin-top: 3%;
            margin-bottom: 3%;
            cursor: pointer;
        }
        .register-right{
            background: #f8f9fa;
            border-top-left-radius: 10% 50%;
            border-bottom-left-radius: 10% 50%;
        }
        .register-left img{
            margin-top: 15%;
            margin-bottom: 5%;
            width: 25%;
            -webkit-animation: mover 2s infinite  alternate;
            animation: mover 1s infinite  alternate;
        }
        @-webkit-keyframes mover {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }
        @keyframes mover {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }
        .register-left p{
            font-weight: lighter;
            padding: 12%;
            margin-top: -9%;
        }
        .register .register-form{ padding: 5%;}
        .btnRegister{
            float: right;
            margin-top: 10%;
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            background: #0062cc;
            color: #fff;
            font-weight: 600;
            width: 50%;
            cursor: pointer;
        }
        .register .nav-tabs{
            margin-top: 3%;
            border: none;
            background: #0062cc;
            border-radius: 1.5rem;
            width: 28%;
            float: right;
        }
        .register .nav-tabs .nav-link{
            padding: 2%;
            height: 34px;
            font-weight: 600;
            color: #fff;
            border-top-right-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
        }
        .register .nav-tabs .nav-link:hover{
            border: none;
        }
        .register .nav-tabs .nav-link.active{
            width: 100px;
            color: #0062cc;
            border: 2px solid #0062cc;
            border-top-left-radius: 1.5rem;
            border-bottom-left-radius: 1.5rem;
        }
        .register-heading{
            text-align: center;
            margin-top: 8%;
            margin-bottom: -15%;
            color: #495057;
        }
        .tdvAlert {
            position: absolute;
            z-index: 1;
            right: 10px;
            width: 300px;
            background: deepskyblue;
            color: #fff;
        }
        #snapshot{background: url(images/none.png);background-size: 100% 100%;width: 100%;height: 200px;}
    </style>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a class="btn btn-dark btn-icon-text" href="index.php?mod=mod_registro_asistencia">  Nuevo registro <i class="mdi mdi-library-plus"></i> </a>
                </h4>


                <div class="register">
                    <div class="row">
                        <div class="col-md-3 register-left">
                            <canvas id="snapshot"></canvas>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#camaraModal" onclick="openCamera();">Hacer foto</button><br/>
                        </div>
                        <div class="col-md-9 register-right">
                            <div class="content">
                                <form id="frmRegisteVisitaGrupoVida" action="server/addVisita.php">
                                    <div class="row register-form">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="hidden" id="txt_idMiembro" name="txt_idMiembro" value="0">
                                                <input type="hidden" id="txt_idIglesia" name="txt_idIglesia" value="<?=$_SESSION["S_ID_IGLESIA"]?>">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                                <label class="custom-control-label" for="customCheck1" data-toggle="modal" data-target="#ProteccionDatosModal">He leído y acepto el aviso legal y la política de privacidad</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Nombre *" id="txtNombre" name="txt_nombre" value="" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Apellidos *" id="txtApellidos" name="txt_apellidos" value="" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Email *" id="txtEmail" name="txt_email" value="" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" minlength="9" maxlength="15" id="txtTelefono" name="txt_telefono" class="form-control" placeholder="Teléfono *" value="" required />
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="txt_sexo" name="txt_sexo" style="width: 100%;height: 45px;">
                                                    <option value="">Sexo</option>
                                                    <option value="VARON">Varón</option>
                                                    <option value="MUJER">Mujer</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="txtDireccion" name="txt_direccion" placeholder="Dirección"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="custom-control-input" id="chkEsFamilia" onchange="changeEsFamilia();">
                                            <label class="custom-control-label" for="chkEsFamilia">Es familia</label>

                                            <hr>
                                            <div class="form-group">
                                                <label for="txt_idFamilia" style="width: 100%;"> Familia <br>
                                                    <select class="form-control" id="txt_idFamilia" name="txt_idFamilia" disabled style="width: 100%;height: 45px;">
                                                        <option value="">Seleccionar familia</option>
                                                        <?=$FAMILIAS?>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_idParentesco" style="width: 100%;"> Parentesco <br>
                                                    <select class="form-control" id="txt_idParentesco" name="txt_idParentesco" disabled style="width: 100%;height: 45px;">
                                                        <option class="hidden" selected disabled>Parentesco</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <hr>

                                            <div class="form-group">
                                                <label for="txt_idTipoMiembro" style="width: 100%;"> Tipo <br>
                                                    <select class="form-control" id="txt_idTipoMiembro" name="txt_idTipoMiembro" required style="width: 100%;height: 45px;">
                                                        <option class="hidden" selected disabled>Tipo</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_idDepartamento" style="width: 100%;"> Departamento <br>
                                                    <select class="form-control" id="txt_idDepartamento" name="txt_idDepartamento" required style="width: 100%;height: 45px;">
                                                        <option class="hidden" selected disabled>Deparatameto</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_idCulto" style="width: 100%;"> Mis lista <br>
                                                    <select class="form-control" id="txt_idLista" name="txt_idLista" required style="width: 100%;height: 45px;">
                                                        <option value="">Seleccionar</option>
                                                        <?=$LISTADOS?>
                                                    </select>
                                                </label>
                                            </div>

                                            <input type="submit" class="btnRegister"  value="Guardar"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

<?php
    echo $ui->tdv_grupo_vida_lista_table($_SESSION['id'], $IDLISTA);    
    echo $ui->tdv_delete_modal();
    echo $ui->tfv_image_avatar_modal();
?>

    <!-- Modal -->
    <div class="modal fade" id="camaraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Acceso a la camara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stopCamera();"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <video id="player" controls autoplay style="width: 100%;"></video>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="stopCamera();">Cerrar</button>
                    <button id="capture" type="button" class="btn btn-primary" onclick="$('#camaraModal').modal('hide');">Tomar foto</button>
                    <button id="flip-button" type="button" class="btn btn-info">Cambiar camara</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ProteccionDatosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aviso Legal y Política de Privacidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <?=html_entity_decode($_SESSION["S_PROTECCION_DATOS"])?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="$('#ProteccionDatosModal').modal('hide');">ACCEPTO</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var player         = document.getElementById('player'); 
        var snapshotCanvas = document.getElementById('snapshot');
        var captureButton  = document.getElementById('capture');
        var front          = false;
        var videoTracks;

        function openCamera(){
            var constraints = { video: { facingMode: (front? "user" : "environment") } };
            navigator.mediaDevices.getUserMedia( constraints ).then(handleSuccess);
        }

        function stopCamera(){
            videoTracks.forEach(function(track) {track.stop()});
        }
        

        var handleSuccess = function(stream) {
            // Attach the video stream to the video element and autoplay.
            player.srcObject = stream;
            videoTracks = stream.getVideoTracks();
        };

        captureButton.addEventListener('click', function() {
            var context = snapshot.getContext('2d');
            context.drawImage(player, 0, 0, snapshotCanvas.width, snapshotCanvas.height);

            // Stop all video streams.
            videoTracks.forEach(function(track) {track.stop()});
        });

      
        $( document ).ready(function() {
            // $('.cmbListaGV option:eq(<?=$IDLISTA?>)').prop('selected', true);
            $('#idLista option[value="<?=$IDLISTA?>"]').attr("selected", "selected");

            document.getElementById('flip-button').onclick = function() { 
                front = !front; 
                stopCamera();
                openCamera();
            };

            /* ENVIO DEL FORMULARIO */
            $("#frmRegisteVisitaGrupoVida").submit(function(e) {
                $("#tdv_loader").addClass("is-active");
                e.preventDefault(); // avoid to execute the actual submit of the form.


                var dataURL = snapshotCanvas.toDataURL();
                var form = $('#frmRegisteVisitaGrupoVida')[0];
                var data = new FormData(form);
                    data.append('txt_imgBase64', dataURL);
                    

                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: 'server/miembros/saveVisitaGrupoVida.php',
                    dataType: 'json',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        $.notify({ message: response.msj },{ type: 'info' });
                        setTimeout(function(){ 
                            $("#tdv_loader").removeClass("is-active");
                            location.reload();
                        }, 1000); 
                    }
                });
            });

            TDV.cargarCombo('#txt_idParentesco', 'tdv_parentescos', 'idParentesco', 'txt_idParentesco');
            TDV.cargarCombo('#txt_idTipoMiembro', 'tdv_tipos_miembros', 'idTipoMiembro', 'txt_idTipoMiembro');
            TDV.cargarCombo('#txt_idDepartamento', 'tdv_departamentos', 'idDepartamento', 'txt_idDepartamento');
        });

        function changeEsFamilia(){
            if (document.getElementById('chkEsFamilia').checked){
                $("#txt_idParentesco").prop("disabled", false);
                $("#txt_idFamilia").prop("disabled", false);
            } else {
                $("#txt_idParentesco").prop("disabled", true);
                $("#txt_idFamilia").prop("disabled", true);
            }
        }          

        
    </script> 
<?php 
    }
?>