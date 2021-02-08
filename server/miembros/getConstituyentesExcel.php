<?php

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    $filename = 'constituyentes.xls';
 
    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment; filename=$filename");  
    header("Pragma: no-cache"); 
    header("Expires: 0");

    include_once '../class/config.php';
    date_default_timezone_set('Europe/Madrid');

	// getting total number records without any search
	$sql = "SELECT tb1.* FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento ";
	$queryRecords = mysqli_query($conn, $sql) or die("error to fetch employees data");

    
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>NOMBRE</th>';
    echo '<th>APELLIDOS</th>';
    echo '<th>SEXO</th>';
    echo '<th>TELEFONO</th>';
    echo '<th>DIRECCION</th>';
    echo '<th>PROVINCIA</th>';
    echo '<th>CP</th>';
    echo '<th>BAUT.</th>';
    echo '<th>ES.</th>';
    echo '<th>FCH.BAUT.</th>';
    echo '<th>FCH.ES.</th>';
    echo '<th>FCH.NACI.</th>';
    echo '</tr>';

    while( $row = mysqli_fetch_assoc($queryRecords) ) { 
        $BAUTIZADOS    = $row["bautizado"] == "on" ? "Si" : "No";
        $ESPIRITUSANTO = $row["espirituSanto"] == "on" ? "Si" : "No";

        echo '<tr>';
        echo '<td>'.$row["nombre"].'</td>';
        echo '<td>'.$row["apellidos"].'</td>';
        echo '<td>'.$row["sexo"].'</td>';
        echo '<td>'.$row["telefono"].'</td>';
        echo '<td>'.$row["direccion"].'</td>';
        echo '<td>'.$row["provincia"].'</td>';
        echo '<td>'.$row["codigoPostal"].'</td>';
        echo '<td>'.$BAUTIZADOS.'</td>';
        echo '<td>'.$ESPIRITUSANTO.'</td>';
        echo '<td>'.cambiaf_a_espanol($row["fechaBautizado"]).'</td>';
        echo '<td>'.cambiaf_a_espanol($row["fechaEspirituSanto"]).'</td>';
        echo '<td>'.cambiaf_a_espanol($row["nacimiento"]).'</td>';
        echo '</tr>';
    }	  

    echo '</table>';


    ////////////////////////////////////////////////////
    // Convierte fecha de mysql a español
    ////////////////////////////////////////////////////
    function cambiaf_a_espanol($fecha){
        preg_match( '/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $fecha, $mifecha);
        $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
        return $lafecha;
    }