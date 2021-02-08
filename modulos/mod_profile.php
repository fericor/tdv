<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        $res = $ui->conn->query("SELECT * FROM tdv_users WHERE id = ".$_SESSION['id']);
        $rs  = $res->fetch_assoc();
        $IMAGEN = $rs["imgBase64"];
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
        #snapshot{background: url(images/none.png);background-size: 100% 100%;}
    </style>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="register">
                    <div class="row">
                        <div class="col-md-3 register-left">
                            <canvas id="snapshot" width="320" height="240"></canvas>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#camaraModal" onclick="openCamera();">Hacer foto</button><br/>
                        </div>
                        <div class="col-md-9 register-right">
                            <div class="content">
                                <form id="frmPerfilUpdate" action="#">
                                    <div class="row register-form">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="hidden" id="txt_id" name="txt_id" value="<?=$_SESSION['id']?>">
                                                <input type="hidden" id="txt_idIglesia" name="txt_idIglesia" value="<?=$_SESSION["S_ID_IGLESIA"]?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Nick *" id="txt_username" name="txt_username" value="<?=$rs["username"]?>" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Email *" id="txt_email" name="txt_email" value="<?=$rs["email"]?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Contraseña" id="txt_password" name="txt_password" value="" />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Repetir Contraseña" id="txt_password2" name="txt_password2" value="" />
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
                </div>
            </div>
        </div>
    </div>

    <script>
        var player         = document.getElementById('player'); 
        var snapshotCanvas = document.getElementById('snapshot');
        var captureButton  = document.getElementById('capture');
        var videoTracks;

        function openCamera(){
            navigator.mediaDevices.getUserMedia({video: true}).then(handleSuccess);
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
            /* ENVIO DEL FORMULARIO */
            $("#frmPerfilUpdate").submit(function(e) {
                $("#tdv_loader").addClass("is-active");
                e.preventDefault(); // avoid to execute the actual submit of the form.


                var dataURL = snapshotCanvas.toDataURL();
                var form = $('#frmPerfilUpdate')[0];
                var data = new FormData(form);
                    data.append('txt_imgBase64', dataURL);
                    
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: 'server/users/saveProfile.php',
                    dataType: 'json',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.ERROR){
                            $.notify({ message: response.msj },{ type: 'danger' });
                            $("#tdv_loader").removeClass("is-active");
                        }else{
                            $.notify({ message: response.msj },{ type: 'info' });
                            setTimeout(function(){ 
                                $("#tdv_loader").removeClass("is-active");
                                location.reload();
                            }, 3000); 
                        }
                        
                    }
                });
            });
        });        
    </script> 
<?php 
    }
?>
