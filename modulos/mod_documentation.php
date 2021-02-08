<?php
    $IDROL = $ui->tdv_getContentByTable("idRol", "tdv_users", "id = ".$_SESSION['id'] );

    if($IDROL == 1){
        echo '<div id="summernote">'.$ui->tdv_getContentByTable("contenido", "tdv_textos", "titulo LIKE 'Documentaci%' ").'</div>';
    }else{
        echo $ui->tdv_getContentByTable("contenido", "tdv_textos", "titulo LIKE 'Documentaci%' ");
    }