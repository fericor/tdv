<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_departamentos_table();
        echo $ui->tdv_departamentos_modal();
        echo $ui->tdv_delete_modal();
    }  