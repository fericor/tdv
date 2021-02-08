<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_casas_grupo_vida_table();
        echo $ui->tdv_casas_grupo_vida_modal();
        echo $ui->tdv_delete_modal();
    }