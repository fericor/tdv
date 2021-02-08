<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        $MIEMBROS = '';
        $USUARIOS = '';
        $DEPARTAMENTOS = '';

        ////////////////////////////
        $res0 = $ui->conn->query("SELECT id, username FROM tdv_users ORDER BY username DESC");
        while ($rs0 = $res0->fetch_assoc()) {
            $USUARIOS .= '<option value="'.$rs0["id"].'">'.$rs0["username"].'</option>';
        }

        ////////////////////////////
        $res = $ui->conn->query("SELECT idMiembro, nombre, apellidos FROM tdv_miembros ORDER BY nombre DESC");
        $num = mysqli_num_rows($res);

        while ($rs = $res->fetch_assoc()) {
            $MIEMBROS .= '<option value="'.$rs["idMiembro"].'">'.$rs["nombre"].' '.$rs["apellidos"].'</option>';
        }

        ////////////////////////////
        $res = $ui->conn->query("SELECT idDepartamento, titulo FROM tdv_departamentos ORDER BY titulo DESC");
        while ($rs = $res->fetch_assoc()) {
            $DEPARTAMENTOS .= '<option value="'.$rs["idDepartamento"].'">'.$rs["titulo"].'</option>';
        }
?>

    <style>
        .contact{
            padding: 4%;
        }
        .col-md-3{
            background: #ff9b00;
            padding: 4%;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }
        .contact-info{
            margin-top:10%;
        }
        .contact-info img{
            margin-bottom: 15%;
        }
        .contact-info h2{
            margin-bottom: 10%;
        }
        .col-md-9{
            background: #fff;
            padding: 3%;
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }
        .contact-form label{
            font-weight:600;
        }
        .contact-form button{
            background: #25274d;
            color: #fff;
            font-weight: 600;
            width: 25%;
        }
        .contact-form button:focus{
            box-shadow:none;
        }
        .divider {width: 100%;text-align: center;margin-bottom: 10px;margin-top: 10px;}

        .divider hr {
            margin-left:auto;
            margin-right:auto;
            width:40%;

        }

        .left {
            float:left;
        }

        .right {
            float:right;
        }
    </style>

    <form id="frmComunicados" action="#" method="post">
        <div class="container contact">
            <div class="row">
                <div class="col-md-3">
                    <div class="contact-info">
                        <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
                        <h2>Comunicados</h2>
                        <h4>Envio de email a los miembros y usuarios de la plataforma !</h4>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="contact-form">				
                        <div class="form-group" style="background:#dedede;height: 90px;">
                            <label class="control-label col-sm-2" for="txtAsunto">Asunto:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txtAsunto" placeholder="Asunto" required name="txtAsunto">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div id="summernote">
                                
                                </div>
                            </div>
                        </div>
                        
                        <div class="divider"> <hr class="left"/>Enviar a <hr class="right" /> </div>
                        <div class="form-group"></div>
                        
                        <div class="row" style="background:#dedede;">
                            <div class="col form-group">
                                <label for="txtUser">Usuarios</label>
                                <select id="txtUser" name="txtUser[]" class="js-basic-multi" multiple="multiple" style="width:100%;">
                                    <option>Seleccionar</option>
                                    <?=$USUARIOS?>
                                </select>
                            </div> ó
                            <div class="col form-group col">
                                <label for="txtMiembro">Miembro</label>
                                <select id="txtMiembro" name="txtMiembro[]" class="js-basic-multi" multiple="multiple" style="width:100%;">
                                    <option>Seleccionar</option>
                                    <?=$MIEMBROS?>
                                </select>
                            </div> ó
                            <div class="col form-group col">
                                <label for="txtDepartamento">Departamento</label>
                                <select id="txtDepartamento" name="txtDepartamento[]" class="js-basic-multi" multiple="multiple" style="width:100%;">
                                    <option>Seleccionar</option>
                                    <?=$DEPARTAMENTOS?>
                                </select>
                            </div>
                        </div>

                        <div class="divider"> <hr class="left"/>ó<hr class="right" /> </div>

                        <div class="form-group" style="background:#dedede;height: 90px;">
                            <label class="control-label col-sm-2" for="txtEmail">Email:</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="txtEmail" placeholder="Email" name="txtEmail">
                            </div>
                        </div>
                        
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>      
        $( document ).ready(function() {
            $('.js-basic-multi').select2({
                multiple: true
            });

            /* ENVIO DEL FORMULARIO */
            $("#frmComunicados").submit(function(e) {
                $("#tdv_loader").addClass("is-active");
                e.preventDefault(); // avoid to execute the actual submit of the form.


                var CONTENIDO = $('#summernote').summernote('code');
                var form      = $('#frmComunicados')[0];
                var data      = new FormData(form);
                    data.append('txtContenido', CONTENIDO);                  

                $.ajax({
                    type: "POST",
                    //enctype: 'multipart/form-data',
                    url: 'server/comunicados/sendComunicados.php',
                    dataType: 'json',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        $.notify({ message: response.msj },{ type: 'info' });
                        $("#frmComunicados")[0].reset()
                        setTimeout(function(){ 
                            $("#tdv_loader").removeClass("is-active");
                            //location.reload();
                        }, 5000); 
                    }
                });
            });
        });        
    </script> 
<?php 
    }
?>