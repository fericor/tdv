<?php

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    include_once '../class/config.php';

    // initilize all variable
	$params = $columns = $totalRecords = $data = array();

    $params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'idMiembro',
		1 => 'nombre',
		2 => 'apellidos',
		3 => 'telefono',
		4 => 'bautizado',
		5 => 'espirituSanto',
        6 => 'titulo',
		7 =>'imgBase64', 
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .= " WHERE ";
		$where .= " ( tb1.nombre LIKE '".$params['search']['value']."%' ";    
		$where .= " OR tb1.apellidos LIKE '".$params['search']['value']."%' ";
		$where .= " OR tb1.telefono LIKE '".$params['search']['value']."%' ";
		$where .= " OR tb2.titulo LIKE '".$params['search']['value']."%' )";
	}

	// getting total number records without any search
	$sql = "SELECT tb1.imgBase64, tb1.nombre, tb1.apellidos, tb1.telefono, tb1.bautizado, tb1.espirituSanto, tb2.titulo, tb1.idMiembro FROM tdv_miembros AS tb1 LEFT JOIN tdv_departamentos AS tb2 ON tb1.idDepartamento = tb2.idDepartamento ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_row($queryRecords) ) { 
		$data[] = $row;
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format