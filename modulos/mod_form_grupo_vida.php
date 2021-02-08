<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo "Sin permiso.".$ui->tdv_ui_alert();
    }else{
        $ANO_FISCAL = '<p style="margin-right:20px;"><b>Fecha fiscal: </b> <i>'.$_SESSION["S_FECHA_FISCAL"].'</i></p>';
        echo $ui->tdv_welcome_panel($ANO_FISCAL);

        echo $ui->tdv_GV_information_panel();
        echo '<div class="row mt-4">';
        echo $ui->tdv_GV_statistics_panel();
        echo '</div>';
    }  