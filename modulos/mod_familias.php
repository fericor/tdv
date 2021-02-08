<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_members_familias();
        echo $ui->tdv_familias_modal();
        echo $ui->tdv_delete_modal();
    }  
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

    <script>
        /* ENVIO DEL FORMULARIO */
        $("#frm_miembrosFamilias").submit(function(e) {
            $("#tdv_loader").addClass("is-active");
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $('#frm_miembrosFamilias')[0];
            var data = new FormData(form);

                
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: 'server/miembros/saveFamilia.php',
                dataType: 'json',
                data: data,
                contentType: false,
                processData: false,
                success: function(response){
                    $('#modalMiembrosForm').modal('hide');
                    $.notify({ message: response.msj },{ type: 'info' });
                    setTimeout(function(){ 
                        $("#tdv_loader").removeClass("is-active");
                        // location.reload();
                    }, 1000); 
                }
            });
        });        
    </script> 