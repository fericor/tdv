<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo "Sin permiso.".$ui->tdv_ui_alert();
    }else{
        $ANO_FISCAL = '<p style="margin-right:20px;"><b>Fecha fiscal: </b> <i>'.$_SESSION["S_FECHA_FISCAL"].'</i></p>';
        echo $ui->tdv_welcome_panel($ANO_FISCAL);
        
        echo $ui->tdv_information_panel();
        echo '<div class="row mt-4">';
        echo $ui->tdv_statistics_panel();
        echo $ui->tdv_notification_panel();
        echo '</div>';

        echo $ui->tdv_members_otros_table_modal();
        echo $ui->tdv_members_modal();
        echo $ui->tdv_delete_modal();
        echo $ui->tfv_image_avatar_modal();
    }  