<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_rols_table();
        echo $ui->tdv_rol_modal($TDV->getArrayModules());
        echo $ui->tdv_delete_modal();
    }