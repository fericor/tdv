<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_tipo_miembro_table();
        echo $ui->tdv_tipo_miembro_modal();
        echo $ui->tdv_delete_modal();
    }