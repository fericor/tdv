<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_members_table2();
        echo $ui->tdv_members_modal();
        echo $ui->tdv_delete_modal();
        echo $ui->tfv_image_avatar_modal();
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

    <div class="modal fade" id="modalCrearLink" tabindex="-1" role="dialog" aria-labelledby="modalCrearLinkLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearLinkLabel">Link Constituyente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <textarea id="linkMiembroUpdate" style="width:100%;height:30px;">
                        https://app.tabernaculodevida.es?idConstituyente=0
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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

        document.getElementById('flip-button').onclick = function() { 
            front = !front; 
            stopCamera();
            openCamera();
        };

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

        /* ENVIO DEL FORMULARIO */
        $("#frm_miembrosM").submit(function(e) {
            $("#tdv_loader").addClass("is-active");
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var dataURL = snapshotCanvas.toDataURL();
            var form = $('#frm_miembrosM')[0];
            var data = new FormData(form);
                data.append('txt_imgBase64', dataURL);

                
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: 'server/miembros/saveForm.php',
                dataType: 'json',
                data: data,
                contentType: false,
                processData: false,
                success: function(response){
                    $('#modalMiembrosForm').modal('hide');
                    $.notify({ message: response.msj },{ type: 'info' });
                    setTimeout(function(){ 
                        $("#tdv_loader").removeClass("is-active");
                        location.reload();
                    }, 3000); 
                }
            });
        });

        function printDiv(div) {    
            // Create and insert new print section
            var elem = document.getElementById(div);
            var domClone = elem.cloneNode(true);
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            $printSection.appendChild(domClone);
            document.body.insertBefore($printSection, document.body.firstChild);

            window.print(); 

            // Clean up print section for future use
            var oldElem = document.getElementById("printSection");
            if (oldElem != null) { oldElem.parentNode.removeChild(oldElem); } 
                                  //oldElem.remove() not supported by IE

            return true;
        }
        
    </script> 