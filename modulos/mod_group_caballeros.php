<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        $BOTON = '<div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text" data-toggle="modal" data-target="#modalMiembrosForm" onclick="TDV.restarForm(\'frm_miembros\');"> 
                        Crear miembro caballeros <i class="mdi mdi-book-plus"></i>                          
                    </button>
                </div>';

        echo $ui->tdv_welcome_panel($BOTON, "Caballeros");
        

        $res = $TDV->conn->query("SELECT * FROM tdv_miembros WHERE idDepartamento = 7 ORDER BY apellidos ASC");

        echo '<div class="row py-2">
            <div class="col-sm-4">
            <input id="searchForm" type="search" placeholder="Buscar..." name="search" class="form-control searchbox-input" required="">
            </div>
        </div>';

        echo '<div id="divPrint" class="row mt-4">';
        while ($rs = $res->fetch_assoc()){
            echo '<!-- Team member -->
                <div class="col-xs-12 col-sm-5 col-md-3 cardSearch">
                    <div class="image-flip">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card" style="margin-top: 20px;">
                                    <div class="card-body text-center" style="padding: 5px;">
                                        <p><img class=" img-fluid" src="data:'.$rs["imgBase64"].'" alt="image" onerror="this.src=\'images/none.png\'" alt="card image" style="height: 200px;"></p>
                                        <h4 class="card-title">'.$rs["nombre"].' '.$rs["apellidos"].'</h4>
                                        <p class="card-text">'.$rs["direccion"].'</p>
                                        <hr>
                                            <ul class="list-group">
                                                <li class="list-group-item text-left"><b>Telefóno: </b> <i>'.$rs["telefono"].'</i></li>
                                                <li class="list-group-item text-left"><b>Email: </b> <i>'.$rs["email"].'</i></li>
                                            </ul>
                                        <hr>    
                                        <a href="#" class="btn btn-primary btn-sm" data-id="'.$rs["idMiembro"].'" onclick="TDV.getMemberOne(this);" data-toggle="modal" data-target="#modalMiembrosForm"> Ver informacíon</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Team member -->';
        }
        echo '</div>';

        
        echo $ui->tfv_image_avatar_modal();
        echo $ui->tdv_members_modal();
    }  

?>
<script>
    $('#searchForm').keyup(function(){
        search_text($(this).val());
    });

    function search_text(value){
        $('#divPrint .cardSearch').each(function(){
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                {
                    found = 'true';
                }
            });
            if(found == 'true'){
                $(this).show()
            }
            else {
                $(this).hide();
            }
        })
    }
</script>