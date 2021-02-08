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
		0 => 'titulo',
		1 => 'nota',
		2 =>'idFamilia',
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .= " AND ";
		$where .= " titulo LIKE '".$params['search']['value']."%' ";    
		$where .= " OR nota LIKE '".$params['search']['value']."%' ";
	}

	// getting total number records without any search
	$sql  = "SELECT titulo, nota, idFamilia FROM tdv_familias WHERE (idFamiliaIntegrantes = 0 ";
	$sql1 = "SELECT titulo, nota, idFamilia FROM tdv_familias WHERE (idFamiliaIntegrantes = 0)";
	$sqlTot .= $sql1;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {
		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  ") ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
	
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