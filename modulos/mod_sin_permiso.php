<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo $ui->tdv_sin_permiso();
    }else{
        echo $ui->tdv_no_module();
    }