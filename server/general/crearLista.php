<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    // RECOGEMOS LAS VALORES PARA HACER EL LOGIN
    $IDLISTA   = $_POST["idLista"];
    $IDUSER    = $_POST["idUser"];
    $NUM_ITEM  = 0;
    $NUM_ITEM1 = 0;

    // .- SELECCIONA TODA LA INFORMACIN DE LA LISTA
    $res = $TDV->conn->query("SELECT * FROM tdv_lista_miembros WHERE idListaGrupo = ".$IDLISTA);
    $row = $res->fetch_assoc();
    $WHERE_DEPARTAMENTO     = $row["idDepartamento"] == 1 ? " WHERE idTipoMiembro = 2 ORDER BY apellidos ASC" : " WHERE idTipoMiembro = 2 AND idDepartamento = ".$row["idDepartamento"]." ORDER BY nombre ASC";
    //$WHERE_DEPARTAMENTO_NEW = $row["idDepartamento"] == 1 ? " status = 'NEW'" : " idDepartamento = ".$row["idDepartamento"]." AND status = 'NEW'";

    // $HAY_NUEVO = $TDV->existeCampo("miembros", $WHERE_DEPARTAMENTO_NEW);
    // .- COMPROBAMOS SI HAY REGISTROS NUEVOS
    // if($HAY_NUEVO == 1){
        // .- BORRAMOS TODOS LOS ITEMS DE LA LISTA QUE QUEREMOS CREAR
        $TDV->conn->query("DELETE FROM tdv_lista_miembros_items WHERE idLista = ".$IDLISTA);
    // }

    // .- SELECCIONAMOS LOS MIEMBROS Y LOS COMPARAMOS EN LA LISTAS SEGUN LA SOCIEDAD O GRUPO
    echo "<h3>Creando lista con ".$row["numero"]." miembros</h3>";
    echo "<ul>";
    // echo "SELECT * FROM tdv_miembros".$WHERE_DEPARTAMENTO."<br>";
    $res2 = $TDV->conn->query("SELECT * FROM tdv_miembros".$WHERE_DEPARTAMENTO);
    while($row2 = $res2->fetch_assoc()){
        // .- VALIDO SI ESE USUARIO EXISTE EN LA TABLA DE LOS ITEMS DE LAS LISTAS
        // $EXISTE = $TDV->existeCampo("lista_miembros_items", "idMiembro='".$row2['idMiembro']."' AND idLista=".$IDLISTA);
        $EXISTE = $TDV->existeCampo("lista_miembros_items", "idMiembro=".$row2['idMiembro']);
        
        if($EXISTE == 1){
            // if($NUM_ITEM1 > 1){
            //     echo "<li><b>EXITE:</b> <i>".$row2['nombre']." ".$row2['apellidos']." </i></li> ";
            // }else{
                // echo "<li><b>OK:</b> <i> Sin datos nuevos para añadir. </i></li> ";
            // }
        }else{
            // .- INSERTAMOS LOS USUARIOS QUE NO EXISTE EN LA LISTA
            $TDV->conn->query("INSERT INTO tdv_lista_miembros_items (idUser, idMiembro, idLista) VALUES ('$IDUSER', '".$row2["idMiembro"]."', '$IDLISTA')");
            echo "<li><b>OK:</b> <i>".$row2['nombre']." ".$row2['apellidos']."</i> </li> ";
        }

        // CONATMOS Y PARAMOS EN CASO NECESARIO
        $RSCONUT = $TDV->conn->query("SELECT * FROM tdv_lista_miembros_items WHERE idLista = ".$IDLISTA);
        $NUM_ITEM = mysqli_num_rows($RSCONUT);

        $NUM_ITEM1 += 1;
        if($row["numero"] <= $NUM_ITEM){break;}
    }
    //echo $row["numero"]." <= ".$NUM_ITEM;
    // $TDV->conn->query("UPDATE tdv_miembros SET status = 'OLD'");
    echo "</ul>";

    sleep(5);
    echo "<hr> <p>Se ha asignado los miembros a la lista.</p>";
