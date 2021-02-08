<?php

    class control {
        public $conn;

        function __construct($HOST, $USER, $PASS, $DB){
            $this->conn = new mysqli($HOST, $USER, $PASS, $DB) or die(mysql_error());
            $this->conn->set_charset("utf8");
        }

        function login($USER, $PASS, $IDs){
            if ( ($USER == "") || ($PASS == "") ) {
                echo json_encode(["auth" => "x101", "msj" => "El usuario o contraseña no pueden estar vacios."]);
                exit();

            } else {
                $res = $this->conn->query("SELECT id, idRol, password, modDefault, timestamp, activo, idDepartamento FROM tdv_users WHERE username = '".$USER."'");
                $num = mysqli_num_rows($res);
                $rs  = $res->fetch_assoc();

                if ($num > 0) {
                    if (password_verify($PASS, $rs['password'])) {
                        if( ($rs['activo'] == "off") || ($rs['activo'] == "") ){
                            echo json_encode(["auth" => "x101", "msj" => "El usuario no esta activado."]);
                            exit();

                        }else{

                            session_start();
                            session_regenerate_id();

                            $_SESSION['loggedin']        = TRUE;
                            $_SESSION['name']            = $USER;
                            $_SESSION['id']              = $rs['id'];
                            $_SESSION['idRol']           = $rs['idRol'];
                            $_SESSION['MODULO']          = $rs['modDefault'];
                            $_SESSION['IDIGLESIA']       = $rs['idIglesia'];
                            $_SESSION['IDDEPARTAMENTO']  = $rs['idDepartamento'];
                            $_SESSION['ID_CONSTITUYENTE_CENSO']  = $IDs;
                            $_SESSION['timestamp_login'] = $this->getElapsedTime($rs['timestamp']);

                            $this->conn->query("UPDATE tdv_users SET timestamp = current_timestamp WHERE id = ".$rs['id']);

                            echo json_encode(["email" => $USER, "password" => $PASS, "auth" => "x100", "mod" => $rs['modDefault']]);
                            exit();
                        }
                        
                    } else {
                        echo json_encode(["auth" => "x101", "msj" => "La contraseña es incorrecta."]);
                        exit();
                    }

                } else {
                    echo json_encode(["auth" => "x101", "msj" => "El usuario es incorrecto."]);
                    exit();
                }
            }            
        }

        function logout(){
            session_start();
            session_destroy();
            
            echo json_encode(["OK" => 'OKs']);
        }

        function segurity($MOD, $MODULOS){
            if (!isset($_SESSION['loggedin'])) {
                echo '<script>window.location="index.php?mod=login";</script>';
                exit();
            }else{
                $res = $this->conn->query("SELECT tb1.idRol, tb2.modulos FROM tdv_users AS tb1 INNER JOIN tdv_roles AS tb2 ON tb1.idRol = tb2.idRol WHERE tb1.id=".$_SESSION['id']);
                $rs  = $res->fetch_assoc();
                $RS_MOD = explode("|", $rs["modulos"]);

                $NEW_ARRAY = array_diff($MODULOS, $RS_MOD);

                if(in_array($MOD, $NEW_ARRAY)){
                    return false;
                }else{
                    return true;
                }
            }
        }

        function getElapsedTime($datetime){
            if( empty($datetime) ){return;}
        
            // check datetime var type
            $strTime = ( is_object($datetime) ) ? $datetime->format('Y-m-d H:i:s') : $datetime;
        
            $time = strtotime($strTime);
            $time = time() - $time;
            $time = ($time<1)? 1 : $time;
        
            $tokens = array (
                    31536000 => 'año',
                    2592000 => 'mes',
                    604800 => 'semana',
                    86400 => 'día',
                    3600 => 'hora',
                    60 => 'minuto',
                    1 => 'segundo'
            );
        
            foreach ($tokens as $unit => $text){
                    if ($time < $unit) continue;
                    $numberOfUnits = floor($time / $unit);
                    $plural = ($unit == 2592000) ? 'es' : 's';
                    return $numberOfUnits . ' ' . $text . ( ($numberOfUnits > 1) ? $plural : '' );
            }
        }

        /** INICIO FUNCTIONS GENERALS */
        function getArrayModules(){
            $RS_MOD  = [];
            $MODULOS = "";
            $dirname = getcwd()."/modulos/";
            $dir = scandir($dirname);

            foreach($dir as $i=>$filename){
                if($filename == '.' || $filename == '..'){
                    continue;
                }else{
                    $MODULOS .= substr($filename, 0, -4)."|";
                }
                $RS_MOD = explode("|", substr($MODULOS, 0, -1));
            }

            return $RS_MOD;
        }

        function existeCampo($TABLE, $CONDICION){
            $res = $this->conn->query("SELECT * FROM tdv_$TABLE WHERE $CONDICION");
            $num = mysqli_num_rows($res);

            /*if($num > 0){
                return true;
            }else{
                return false;
            }*/

            return $num;
        }

        function getContentByTable($CAMPO, $TABLE, $WHERE){
            $res = $this->conn->query("SELECT $CAMPO AS contenido FROM $TABLE WHERE $WHERE");
            $rs  = $res->fetch_assoc();
            $MSJ = $rs["contenido"];

            return $MSJ;
        }

        function getOneRowById($TABLE, $CONDICION){
            $res0 = $this->conn->query("SHOW COLUMNS FROM tdv_$TABLE");
            $res1 = $this->conn->query("SELECT * FROM tdv_$TABLE WHERE $CONDICION");
            $num = mysqli_num_rows($res1);

            $rs1  = $res1->fetch_assoc();

            $myObj = '{';

            if ($num > 0) {
                while ($rs0 = $res0->fetch_assoc()) {
                    $myObj .= '"'.$rs0["Field"].'":"'.$rs1[$rs0["Field"]].'",';
                }
                
                echo substr($myObj, 0, -1).'}';
                exit();
            }            
        }

        function updateStatus($TABLE, $VALUES, $CONDITION, $CAMPO){
            $this->conn->query("UPDATE tdv_$TABLE SET ".$VALUES." WHERE ".$CONDITION);
            echo json_encode(["ERROR"=>false, "msj"=>"Us estado esta actualizado."]);
            exit();
        }

        function deleteRegistro($TABLE, $CONDITION){
            $this->conn->query("DELETE FROM tdv_$TABLE WHERE ".$CONDITION);
            echo json_encode(["ERROR"=>false, "msj"=>"Registro ha sido eliminado con exito."]);
            exit();
        }

        function selectBySQL($SQL){
            $dbdata = array();
            $res = $this->conn->query($SQL);
            while($row = $res->fetch_assoc()){
                $dbdata[] = $row;
            }

            return json_encode($dbdata);
        }

        function selectListaAsistencia($IDLISTA, $IDSERVICIO){
            $dbdata = array();

            // HAY QUE COMPROBAR SI EXISTEN DATOS EN LA TABLA DEL HISTORIAL
            $EXISTE = control::existeCampo('lista_miembros_items_historico', "idLista=$IDLISTA AND idServicio=$IDSERVICIO");

            if($EXISTE){
                $res = $this->conn->query("SELECT tb1.*, tb2.nombre, tb2.apellidos, tb3.idServicio FROM tdv_lista_miembros_items_historico AS tb1 INNER JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro LEFT JOIN tdv_lista_miembros AS tb3 ON tb1.idLista = tb3.idListaGrupo WHERE tb1.idLista = $IDLISTA AND tb1.idServicio = $IDSERVICIO ORDER BY tb2.nombre ASC");
            }else{
                $res = $this->conn->query("SELECT tb1.*, tb2.nombre, tb2.apellidos, tb3.idServicio FROM tdv_lista_miembros_items AS tb1 INNER JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro LEFT JOIN tdv_lista_miembros AS tb3 ON tb1.idLista = tb3.idListaGrupo WHERE tb1.idLista = $IDLISTA ORDER BY tb2.nombre ASC");
            }

            while($row = $res->fetch_assoc()){
                $dbdata[] = $row;
            }

            return json_encode($dbdata);
        }

        function selectListaAsistenciaHistorial($FECHA, $IDLISTA){
            $dbdata = array();
            $res = $this->conn->query("SELECT tb1.*, tb2.nombre, tb2.apellidos, tb3.titulo AS culto FROM tdv_lista_miembros_items_historico AS tb1 INNER JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro INNER JOIN tdv_servicios_cultos AS tb3 ON tb1.idServicio = tb3.idServicio WHERE tb1.idLista = $IDLISTA AND tb1.fecha LIKE '".$FECHA."%' ORDER BY tb3.titulo DESC");
            while($row = $res->fetch_assoc()){
                $dbdata[] = $row;
            }

            return json_encode($dbdata);
        }

        function getEstadisticasLista($LISTA, $FECHA){
            $dbdata = array();
            
            $resDAMAS = $this->conn->query("SELECT COUNT(tb1.idMiembro) AS NUM FROM tdv_lista_miembros_items_historico AS tb1 LEFT JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro WHERE tb1.idLista = {$LISTA} AND tb2.idDepartamento = 11 AND tb1.fecha LIKE '".$FECHA."%'");
            $rowDAMAS = $resDAMAS->fetch_assoc();

            $resCABALLEROS = $this->conn->query("SELECT COUNT(tb1.idMiembro) AS NUM FROM tdv_lista_miembros_items_historico AS tb1 LEFT JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro WHERE tb1.idLista = {$LISTA} AND tb2.idDepartamento = 7 AND tb1.fecha LIKE '".$FECHA."%'");
            $rowCABALLEROS = $resCABALLEROS->fetch_assoc();

            $resJOVENES = $this->conn->query("SELECT COUNT(tb1.idMiembro) AS NUM FROM tdv_lista_miembros_items_historico AS tb1 LEFT JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro WHERE tb1.idLista = {$LISTA} AND tb2.idDepartamento = 4 AND tb1.fecha LIKE '".$FECHA."%'");
            $rowJOVENES = $resJOVENES->fetch_assoc();

            $resED = $this->conn->query("SELECT COUNT(tb1.idMiembro) AS NUM FROM tdv_lista_miembros_items_historico AS tb1 LEFT JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro WHERE tb1.idLista = {$LISTA} AND tb2.idDepartamento = 5 AND tb1.fecha LIKE '".$FECHA."%'");
            $rowED = $resED->fetch_assoc();

            $resBAUTIZADO = $this->conn->query("SELECT COUNT(tb1.idMiembro) AS NUM FROM tdv_lista_miembros_items_historico AS tb1 LEFT JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro WHERE tb1.idLista = {$LISTA} AND tb2.idDepartamento = 5 AND tb1.fecha LIKE '".$FECHA."%' AND tb2.bautizado = 'on'");
            $rowBAUTIZADO = $resBAUTIZADO->fetch_assoc();

            $resEESS = $this->conn->query("SELECT COUNT(tb1.idMiembro) AS NUM FROM tdv_lista_miembros_items_historico AS tb1 LEFT JOIN tdv_miembros AS tb2 ON tb1.idMiembro = tb2.idMiembro WHERE tb1.idLista = {$LISTA} AND tb2.idDepartamento = 5 AND tb1.fecha LIKE '".$FECHA."%' AND tb2.espirituSanto = 'on'");
            $rowEESS = $resEESS->fetch_assoc();

            $dbdata["DAMAS"]      = $rowDAMAS["NUM"];
            $dbdata["CABALLEROS"] = $rowCABALLEROS["NUM"];
            $dbdata["JOVENES"]    = $rowJOVENES["NUM"];
            $dbdata["ED"]         = $rowED["NUM"];
            $dbdata["BAUTIZADO"]  = $rowBAUTIZADO["NUM"];
            $dbdata["EESS"]       = $rowEESS["NUM"];
        

            return json_encode($dbdata);
        }
        /** FIN FUNCTIONS GENERALS */


        /** INICIO FUNCTIONS USERS */
        function saveUsers($POST, $ID, $PASS){
            $SQL       = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    // $VALUE_RS = $RS[1]=='id'?"NULL":$VALOR;
                    $VALUE_RS = $RS[1]=='password'?password_hash($VALOR, PASSWORD_DEFAULT):$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }
                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $SQL = "INSERT INTO tdv_users ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";

            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE = $RS[1] == "password" ? $VALOR!="" ? password_hash($VALOR, PASSWORD_DEFAULT) : $VALOR : $VALOR;
                    $CAMPOS .= $RS[1].'="'.$VALUE.'",'; 
                }
    
                if($PASS == ""){
                    $CAMPOSI = str_replace('password="",', "", $CAMPOS);
                }else{
                    $CAMPOSI = $CAMPOS;
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);
                $SQL = "UPDATE tdv_users SET ".$CAMPOSII." WHERE id = ".$ID;
            }         
            // echo $SQL;
            $this->conn->query($SQL);

            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }
        function saveProfiler($POST, $ID, $PASS){
            $SQL       = "";

            if($POST['txt_password'] != ""){
                if($POST['txt_password'] != $POST['txt_password2']){
                    echo json_encode(["ERROR"=>true, "msj"=>"La contraseñas no son iguales."]);
                    exit();
                }else{
                    $SQL = "UPDATE tdv_users SET password='".password_hash($POST['txt_password'], PASSWORD_DEFAULT)."' WHERE id = ".$ID;
                    $this->conn->query($SQL);
                }
            }

            $SQL = "UPDATE tdv_users SET username='".$POST['txt_username']."' ,email='".$POST['txt_email']."' , imgBase64='".$POST['txt_imgBase64']."' WHERE id = ".$ID;
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }
        /** FIN FUNCTIONS USERS */


        /** INICIO FUNCTIONS MIEMBROS */
        function saveTipoMiembro($POST, $ID){
            $SQL       = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='idTipoMiembro'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }
                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $SQL = "INSERT INTO tdv_tipos_miembros ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOS .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOS, 0, -1);
                $SQL = "UPDATE tdv_tipos_miembros SET ".$CAMPOSII." WHERE idTipoMiembro = ".$ID;
            }         
            
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }
        /** FIN FUNCTIONS MIEMBROS */


        /** INICIO FUNCTIONS ROLES */
        function saveRoles($POST, $ID, $ROLES){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($ROLES as $VALOR){
                    $ROLS .= $VALOR."|"; 
                }
                $ROLS = substr($ROLS, 0, -1);

                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='id'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "INSERT INTO tdv_roles ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($ROLES as $VALOR){
                    $ROLS .= $VALOR."|"; 
                }
                $ROLS = substr($ROLS, 0, -1);

                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "UPDATE tdv_roles SET ".$CAMPOSII." WHERE idRol = ".$ID;
            }         
            // echo $SQL;
            $this->conn->query($SQL);

            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveCultos($POST, $ID){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='idServicio'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "INSERT INTO tdv_servicios_cultos ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "UPDATE tdv_servicios_cultos SET ".$CAMPOSII." WHERE idServicio = ".$ID;
            }         
            //echo $SQL;
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveNacionalidades($POST, $ID){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='idNacionalidad'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "INSERT INTO tdv_nacionalidades ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "UPDATE tdv_nacionalidades SET ".$CAMPOSII." WHERE idNacionalidad = ".$ID;
            }         
            //echo $SQL;
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveParentescos($POST, $ID){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='idParentesco'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "INSERT INTO tdv_parentescos ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "UPDATE tdv_parentescos SET ".$CAMPOSII." WHERE idParentesco = ".$ID;
            }         
            //echo $SQL;
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }
        /** FIN FUNCTIONS ROLES */


        /** INICIO FUNCTIONS ROLES */
        function saveCasas($POST, $ID){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='idCasa'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "INSERT INTO tdv_grupo_vida_casas ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);
                $CAMPOSII = str_replace('Array', $ROLS, $CAMPOSII);

                $SQL = "UPDATE tdv_grupo_vida_casas SET ".$CAMPOSII." WHERE idCasa = ".$ID;
            }         
            // echo $SQL;
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }
        /** FIN FUNCTIONS ROLES */

        /** INICIO FUNCTIONS MIEMBROS */
        function saveDepartamentos($POST, $ID){
            $SQL       = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='idDepartamento'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }
                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $SQL = "INSERT INTO tdv_departamentos ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOS .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOS, 0, -1);
                $SQL = "UPDATE tdv_departamentos SET ".$CAMPOSII." WHERE idDepartamento = ".$ID;
            }         
            
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveVisita($POST, $ID, $IDPARENTESCO){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='idMiembro'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);

                $SQL = "INSERT INTO tdv_miembros ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";

                $MENSAJE = '<br /><br /><br /><br />
            
                <div style="text-align: center;"><span style="font-size:22px;"><strong>&iexcl;Bienvenido a Tabernáculo de Vida!</strong></span><br />
                </div>

                <br /><br />

                <div style="text-align: center;">Mensaje [saveVisita].<br /><br />
                Muchas gracias por confiar en nosotros<br />
                &nbsp;</div>

                <br /><br /><br /><br /><br />';

                $this->enviarEmail("correo-bienvenida", "Bienvenido@::Tabernáculo de Vida", $POST['txt_email'], $MENSAJE);

            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);

                $SQL = "UPDATE tdv_miembros SET ".$CAMPOSII." WHERE idMiembro = ".$ID;
            }         
            //echo $SQL;
            $this->conn->query($SQL);
            $IDINSERT = $this->conn->insert_id;

            if($ID == 0){
                if(isset($IDPARENTESCO)){
                    $IDINTEGRANTES = $POST['txt_idFamilia'] != "" ? $POST['txt_idFamilia'] : 0;
                    $SQL1 = "INSERT INTO tdv_familias (idFamiliaIntegrantes, titulo, idMiembro, idParentesco, nota) VALUES (".$IDINTEGRANTES.", '".$POST['txt_apellidos']." ".$POST['txt_nombre']."', ".$IDINSERT.", '".$POST['txt_idParentesco']."', '')";
                    $this->conn->query($SQL1);
                }
            }

            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveVisitaGrupoVida($POST, $ID, $IDPARENTESCO, $IDUSER){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='idMiembro'?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);

                $SQL = "INSERT INTO tdv_miembros ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";

                $this->conn->query($SQL);
                $IDINSERT = $this->conn->insert_id;


                $SQLI = "INSERT INTO tdv_lista_miembros_items (idUser, idMiembro, idLista) VALUES ({$IDUSER}, {$IDINSERT}, {$POST['txt_idLista']})";
                $this->conn->query($SQLI);

                $MENSAJE = '<br /><br /><br /><br />
            
                <div style="text-align: center;"><span style="font-size:22px;"><strong>&iexcl;Bienvenido a Tabernáculo de Vida!</strong></span><br />
                </div>

                <br /><br />

                <div style="text-align: center;">Mensaje [saveVisita].<br /><br />
                Muchas gracias por confiar en nosotros<br />
                &nbsp;</div>

                <br /><br /><br /><br /><br />';

                $this->enviarEmail("correo-bienvenida", "Bienvenido@::Tabernáculo de Vida", $POST['txt_email'], $MENSAJE);

            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);

                $SQL = "UPDATE tdv_miembros SET ".$CAMPOSII." WHERE idMiembro = ".$ID;
                $this->conn->query($SQL);
            }         

            if($ID == 0){
                if(isset($IDPARENTESCO)){
                    $IDINTEGRANTES = $POST['txt_idFamilia'] != "" ? $POST['txt_idFamilia'] : 0;
                    $SQL1 = "INSERT INTO tdv_familias (idFamiliaIntegrantes, titulo, idMiembro, idParentesco, nota) VALUES (".$IDINTEGRANTES.", '".$POST['txt_apellidos']." ".$POST['txt_nombre']."', ".$IDINSERT.", '".$POST['txt_idParentesco']."', '')";
                    $this->conn->query($SQL1);
                }
            }

            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveMiembro($POST, $ID){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    if($VALOR != ""){
                        $VALUE_RS = $VALOR == "" ? "NULL" : $VALOR; // $RS[1]=='idMiembro'?"NULL":$VALOR; // ?$RS[1]=='nacimiento'?"0000-00-00":$VALOR?$RS[1]=='fechaBautizado'?"0000-00-00":$VALOR?$VALUE_RS = $RS[1]=='fechaEspirituSanto'?"0000-00-00":$VALOR:$VALOR:$VALOR:$VALOR;
                        $VALUE  .= "'".$VALUE_RS."',";
                        $CAMPOS .= $RS[1].','; 
                    }
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);

                $SQL = "INSERT INTO tdv_miembros ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    if($VALOR != ""){
                        $VALUE_RS = $VALOR == "" ? "NULL" : $VALOR;
                        if($RS[1] == "espirituSanto"){
                            $CAMPOSI .= $RS[1].'="on",'; 
                        }else if($RS[1] == "bautizado"){
                            $CAMPOSI .= $RS[1].'="on",'; 
                        }else{
                            $CAMPOSI .= $RS[1].'="'.$VALUE_RS.'",'; 
                        }
                    }
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);

                $SQL = "UPDATE tdv_miembros SET ".$CAMPOSII." WHERE idMiembro = ".$ID;
            }         
            // echo $SQL;
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveFamilia($POST, $ID){
            $SQL       = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS       = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1] == 'idFamilia' ? "NULL" : $VALOR;
                    $VALUE   .= "'".$VALUE_RS."',";
                    $CAMPOS  .= $RS[1].','; 
                }
                $CAMPOSI  = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);
                $SQL = "INSERT INTO tdv_familias ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOS .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOS, 0, -1);
                $SQL = "UPDATE tdv_familias SET ".$CAMPOSII." WHERE idFamilia = ".$ID;
            }         
            
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveMiembro1($POST, $ID){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $VALOR == "" ? "NULL" : $VALOR; // $RS[1]=='idMiembro'?"NULL":$VALOR; // ?$RS[1]=='nacimiento'?"0000-00-00":$VALOR?$RS[1]=='fechaBautizado'?"0000-00-00":$VALOR?$VALUE_RS = $RS[1]=='fechaEspirituSanto'?"0000-00-00":$VALOR:$VALOR:$VALOR:$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);

                $SQL = "INSERT INTO tdv_miembros ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    //$CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                    if($RS[1] == "espirituSanto"){
                        $CAMPOSI .= $RS[1].'="on",'; 
                    }else if($RS[1] == "bautizado"){
                        $CAMPOSI .= $RS[1].'="on",'; 
                    }else{
                        $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                    }
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);

                $SQL = "UPDATE tdv_miembros SET ".$CAMPOSII." WHERE idMiembro = ".$ID;
            }         
            // echo $SQL;
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);

            $MENSAJE  = '<h1>Censo Estadistico</h1><p>Nuevo Registro.</p>';
            $MENSAJE .= '<b>Nombre: </b><i>'.$POST["txt_nombre"].'</i> <br>';
            $MENSAJE .= '<b>Apellidos: </b><i>'.$POST["txt_apellidos"].'</i> <br>';
            $MENSAJE .= '<b>Telefono: </b><i>'.$POST["txt_telefono"].'</i> <br>';
            $MENSAJE .= '<b>Email: </b><i>'.$POST["txt_email"].'</i>';

            $this->enviarEmail("correo-admin", "Censo Estadistico@::Tabernáculo de Vida", 'info@tdvmadrid.com', $MENSAJE);

            exit();
        }

        function saveGrupoVida($POST, $ID, $TIPO){
            $SQL       = "";
            $ROLS      = "";
            $VALUE     = "";
            $CAMPOS    = "";
            $CAMPOSI   = "";
            $CAMPOSII  = "";

            $ID_CAMPO = ucfirst($TIPO);

            if($ID == 0){
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $VALUE_RS = $RS[1]=='id'.substr($ID_CAMPO,0,-1)?"NULL":$VALOR;
                    $VALUE  .= "'".$VALUE_RS."',";
                    $CAMPOS .= $RS[1].','; 
                }

                $CAMPOSI = substr($CAMPOS, 0, -1);
                $CAMPOSII = substr($VALUE, 0, -1);

                switch ($TIPO) {
                    case "DISTRITOS":
                        $SQL = "INSERT INTO tdv_grupo_vida_distritos ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
                        break;
                    case "ZONAS":
                        $SQL = "INSERT INTO tdv_grupo_vida_zonas ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
                        break;
                    case "BARRIOS":
                        $SQL = "INSERT INTO tdv_grupo_vida_barrios ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
                        break;
                    case "CASAS":
                        $SQL = "INSERT INTO tdv_grupo_vida_casas ($CAMPOSI) VALUES (".str_replace("'NULL'", "NULL", $CAMPOSII).")";
                        break;
                }
                
            }else{
                foreach($POST as $CAMPO => $VALOR){
                    $RS = explode("_", $CAMPO);
                    $CAMPOSI .= $RS[1].'="'.$VALOR.'",'; 
                }
    
                $CAMPOSII = substr($CAMPOSI, 0, -1);

                switch ($TIPO) {
                    case "DISTRITOS":
                        $SQL = "UPDATE tdv_grupo_vida_distritos SET ".$CAMPOSII." WHERE idDistrito = ".$ID;
                        break;
                    case "ZONAS":
                        $SQL = "UPDATE tdv_grupo_vida_zonas SET ".$CAMPOSII." WHERE idZona = ".$ID;
                        break;
                    case "BARRIOS":
                        $SQL = "UPDATE tdv_grupo_vida_barrios SET ".$CAMPOSII." WHERE idCasa = ".$ID;
                        break;
                    case "CASAS":
                        $SQL = "UPDATE tdv_grupo_vida_casas SET ".$CAMPOSII." WHERE idCasa = ".$ID;
                        break;
                }

                
            }         
            // echo "SQL: ".$SQL;
            $this->conn->query($SQL);
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveListaMiembro($POST, $ID){
            if($ID == 0){
                $SQL = "INSERT INTO tdv_lista_miembros (titulo, idUser, idDepartamento, idServicio, numero, comentarios, tipo) VALUES ('".$POST["txt_titulo"]."', '".$POST["txt_idUser"]."', '".$POST["txt_idDepartamento"]."', '".$POST["txt_idServicio"]."', '".$POST["txt_numero"]."', '".$POST["txt_comentarios"]."', '".$_POST["txt_tipo"]."')";
                $this->conn->query($SQL);
                $IDLISTA = $this->conn->insert_id;
            }else{
                $SQL = "UPDATE tdv_lista_miembros SET titulo='".$POST["txt_titulo"]."', idUser='".$POST["txt_idUser"]."', idDepartamento='".$POST["txt_idDepartamento"]."', idServicio='".$POST["txt_idServicio"]."', numero='".$POST["txt_numero"]."', comentarios='".$POST["txt_comentarios"]."', tipo='".$_POST["txt_tipo"]."' WHERE idListaGrupo = ".$ID;
                $this->conn->query($SQL);
                $IDLISTA = $ID;
            }         

            if(isset($POST["txt_idMiembro"])){
                $cnt = count($POST['txt_idMiembro']);
                for($i=0; $i<$cnt; $i++){
                    $this->conn->query("INSERT INTO tdv_lista_miembros_items (idUser, idMiembro, idLista) VALUES ('".$POST["txt_idUser"]."', '".$POST["txt_idMiembro"][$i]."', '$IDLISTA')");
                }
            }

            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function saveListaAsistencia($POST){
            $FECHA = $_POST["txt_fecha"]." ".date("H:i:s");

            for($i=0; $i<count($POST["txt_idMiembro"]); $i++){

                $IDUSER      = $_POST["txtIdUser"][$i];
                $IDLISTA     = $_POST["txt_idLista"][$i];
                $IDMIEMBRO   = $_POST["txt_idMiembro"][$i];
                $ASISTENCIA  = $_POST["txtAsistenciaHidden"][$i];
                $IDSERVICIO  = $_POST["txt_idServicio"];
                $COMENTARIOS = $_POST["txt_comentarios"][$i];

                $EXISTE = control::existeCampo('lista_miembros_items_historico', "idMiembro=$IDMIEMBRO AND idLista=$IDLISTA AND idServicio=$IDSERVICIO");

                if($EXISTE){
                    $SQL = "UPDATE tdv_lista_miembros_items_historico SET asistencia='".$ASISTENCIA."',comentarios='".$COMENTARIOS."',fecha='".$FECHA."' WHERE idMiembro='".$IDMIEMBRO."' AND idLista='".$IDLISTA."' AND idServicio='".$IDSERVICIO."' ";
                }else{
                    $SQL = "INSERT INTO tdv_lista_miembros_items_historico (idUser, idMiembro, idLista, idServicio, asistencia, comentarios, fecha) VALUES ('".$IDUSER."','".$IDMIEMBRO."','".$IDLISTA."','".$IDSERVICIO."','".$ASISTENCIA."','".$COMENTARIOS."','".$FECHA."')";
                }

                $this->conn->query($SQL);
            }
            echo json_encode(["ERROR"=>false, "msj"=>"Datos guardados con exito."]);
            exit();
        }

        function enviarEmail($TEMPLATE, $TITULO="TDV::Información", $email="info@tdvmadrid.com", $MENSAJE=""){
            $path = $_SERVER["DOCUMENT_ROOT"].'/server/class/templates_emails/'.$TEMPLATE.'.html';
            $tpl  = file_get_contents($path);
            if(file_exists($path)){ $tpl = file_get_contents($path); }
            $body  = str_replace('{{TDV_MENSAJE}}', $MENSAJE, $tpl);
            $body1 = $body;
            
            $header  = "From: TDV <no-responder@tdvmadrid.com> \r\n";
            $header .= "Bcc: noresponder@tdvmadrid.com \r\n";
            $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
            $header .= "Mime-Version: 1.0 \r\n";
            $header .= "Content-Type: text/html";
            
            if (mail($email, $TITULO, $body1, $header)) {  }
        }
        /** FIN FUNCTIONS MIEMBROS */

        function sendFelicitaciones($IDUSER){
            $rs = $this->conn->query("SELECT * FROM tdv_miembros WHERE idMiembro = ".$IDUSER)->fetch_assoc();

            $SALUDO = $rs["sexo"] == "MUJER" ? "Apreciada" : "Apreciado";
            $HNO    = $rs["sexo"] == "MUJER" ? "Hna." : "Hno.";

            $MENSAJE = '<h3>'.$SALUDO.'</h3>
            <b>'.$HNO.' '.$rs["nombre"]." ".$rs["apellidos"].'</b>
            <p>La Iglesia Tabernáculo de Vida Madrid</p>
            <p>Quiere felicitarte en este día especial de su cumpleaños.</p>
            <p>Que este año sea mejor que el anterior y que todos sus deseos se hagan realidad.</p>
            <b>Feliz Cumpleaños</b>';

            $this->enviarEmail("correo-felicitacion", "Felicitaciones@::Tabernáculo de Vida", $rs['email'], $MENSAJE);

            echo "Felicitación enviada a: ".$rs["nombre"]." ".$rs["apellidos"];
        }

        function sendReserva($ID){
            $rs = $this->conn->query("SELECT * FROM tdv_registro_cultos WHERE id = ".$ID)->fetch_assoc();

            $MENSAJE = '<h3>Datos de su reserva:</h3>
                <hr>
                <b>Nombres: </b> <i>'.$rs["nombre"]." ".$rs["apellidos"].'</i> <br>
                <b>Servicio: </b> <i>'.$rs["culto"].'</i> <br>
                Si necesita darse de baja haz click <a href="https://app.tabernaculodevida.es/index.php?mod=mod_servicio_aforo&'.$ID.'">aquí</a>';

            $this->enviarEmail("correo-reserva", "Reserva@::Tabernáculo de Vida", $rs['email'], $MENSAJE);

            echo "Reserva enviada a: ".$rs["nombre"]." ".$rs["apellidos"];
        }

        function sendLinkMembresia($IDUSER){
            $rs = $this->conn->query("SELECT * FROM tdv_miembros2 WHERE idMiembro = ".$IDUSER)->fetch_assoc();

            $SALUDO = $rs["sexo"] == "MUJER" ? "Apreciada" : "Apreciado";
            $HNO    = $rs["sexo"] == "MUJER" ? "Hna." : "Hno.";

            $MENSAJE = '<h3>'.$SALUDO.'</h3>
            <b>'.$HNO.' '.$rs["nombre"]." ".$rs["apellidos"].'</b>
            <p>Actualice su informacion haciendo un click en el siguiente enlace: <a href="https://app.tabernaculodevida.es?idConstituyente='.$IDUSER.'">app.tabernaculodevida.es</a></p>
            <p>Datos de Acceso.</p>
            <b>Usuario: </b> <i>membresia</i> <br>
            <b>Contraseña: </b> <i>membresia</i>';

            $this->enviarEmail("correo-link", "Actualizacion Censo Estadistico@::Tabernáculo de Vida", $rs['email'], $MENSAJE);

            echo "Link enviado a: ".$rs["nombre"]." ".$rs["apellidos"];
        }

        function cambiarfecha_mysql($fecha, $HSN=0){
            list($FCH, $HR) = array_pad(explode(" ", $fecha), 10, null);
            list($ano,$mes,$dia) = explode("-", $FCH);
            list($h, $m, $s) = array_pad(explode(":", $HR), 10, null);

            $HORAS = $HSN == 1 ? " $h:$m:$s" : "";

            return "$dia/$mes/$ano". $HORAS;
        }

    }
?>
