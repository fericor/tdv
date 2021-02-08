<?php

    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_form_edit_panel();
    }  
?>

<script>
    function updateProteccionDatos(){
        $("#tdv_loader").addClass("is-active");

        var CONTENIDO = $('#summernote').summernote('code');
        var IDIGLESIA =  $('#txtIdIglesia').val();

        $.post( "server/general/updateStatus.php", { txtValores: CONTENIDO, txtCondicion: IDIGLESIA, txtTabla: 'configuracion', txtCampo: 'proteccionDatos' }).done(function( data ) {
            $.notify({ message: data.msj },{ type: 'info' });
            setTimeout(function(){ 
                $("#tdv_loader").removeClass("is-active");
            }, 1000); 
        }, "json");

        return false;
    }
</script>