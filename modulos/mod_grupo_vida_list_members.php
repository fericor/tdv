<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_grupo_vida_list_members_table();
        echo $ui->tdv_grupo_vida_list_members_modal();
        echo $ui->tdv_list_members_items_modal();
        // echo $ui->tdv_create_lista_modal();
        echo $ui->tdv_delete_modal();
    }  
?>

<div id="modalUserlisHistorial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-3">
                    <h2>ESTADISTICAS</h2>
                    <div style="margin-left:20px;">
                        <b>Bautizados: </b> <i class="lblBautizadoInfo"></i> <br>
                        <b>Espíritu Santo: </b> <i class="lblEspirituSantoInfo"></i> <hr>
                        <b>Caballeros: </b> <i class="lblCaballerosInfo"></i> <br>
                        <b>Damas: </b> <i class="lblDamasInfo"></i> <br>
                        <b>Jóvenes: </b> <i class="lblJovenesInfo"></i> <br>
                        <b>Escuela Dominical: </b> <i class="lblEscuelaDominicalInfo"></i> <br>
                    </div>
                    <hr>
                    <div id="divFecha"></div>
                </div>
                <div id="divListaAsistenciaHsitorial" class="col-9">
                    <div class="table-responsive scroll">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th> </th>
                                    <th>SERVICIO</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDOS</th>
                                    <th>FECHA</th>
                                    <th>COMENTARIOS</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTrListaAsistenciaViewHistorial">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>
    $('div#divFecha').datepicker({todayHighlight: true}).on('changeDate', function(e) {
        var FECHA   = formatDate(e.date);
        var IDUSER  = $("#txtIdUser").val();
        var IDLISTA = $("#txtIdLista").val();

        TDV.cargarListaViewHistorial(IDUSER, IDLISTA, FECHA);
        TDV.cargarEstadisticasHistorial(IDUSER, IDLISTA, FECHA);
    });

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }

</script>