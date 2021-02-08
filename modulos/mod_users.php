<?php    
    if(!$TDV->segurity($modulo, $TDV->getArrayModules())){
        echo "Sin permiso.".$ui->tdv_ui_alert();
    }else{
        echo $ui->tdv_users_table();
        echo $ui->tdv_user_modal($TDV->getArrayModules());
        echo $ui->tdv_delete_modal();
    }
?>  