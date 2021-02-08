<?php
	/*
	* Archivo de configuracion para nuestra aplicacion modularizada.
	* Definimos valores por defecto y datos para cada uno de nuestros modulos.
	*/

	define('MODULO_DEFECTO', 'mod_login');
	define('NO_MODULO', 'mod_no_module');
	define('SIN_PERMISO', 'mod_sin_permiso');
	define('LAYOUT_DEFECTO', 'layout_simple.php');
	define('LAYOUT_SEGURITY', 'layout_segurity.php');
	define('LAYOUT_NO_HEADER', 'layout_no_header.php');
	define('LAYOUT_VACIO', 'layout_vacio.php');
	define('MODULO_PATH', realpath('./modulos/'));
	define('LAYOUT_PATH', realpath('./layouts/'));

	define('TITULO_DEFECTO', 'TDV');

	$conf['mod_login']                   = array('archivo' => 'mod_login.php', 'layout' => 'login.php', 'title' => 'Login');
	$conf['mod_no_module']               = array('archivo' => 'mod_no_module.php', 'layout' => LAYOUT_NO_HEADER, 'title' => 'No existe modulo'); 
	$conf['mod_sin_permiso']             = array('archivo' => 'mod_sin_permiso.php', 'layout' => LAYOUT_NO_HEADER, 'title' => 'Sin permiso'); 
	$conf['mod_home']                    = array('archivo' => 'mod_home.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Inicio'); 
	$conf['mod_reports']                 = array('archivo' => 'mod_reports.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Reportes'); 
	$conf['mod_rols']                    = array('archivo' => 'mod_rols.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Roles'); 
	$conf['mod_documentation']           = array('archivo' => 'mod_documentation.php', 'layout' => LAYOUT_NO_HEADER, 'title' => 'Documentación'); 
	$conf['mod_form_grupo_vida']         = array('archivo' => 'mod_form_grupo_vida.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Grupo Vida'); 
	$conf['mod_members']                 = array('archivo' => 'mod_members.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Miembros'); 
	$conf['mod_members2']                = array('archivo' => 'mod_members2.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Miembros Copia'); 
	$conf['mod_departamentos']           = array('archivo' => 'mod_departamentos.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Grupos o Departamentos'); 
	$conf['mod_profile']                 = array('archivo' => 'mod_profile.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Perfil'); 
	$conf['mod_users']                   = array('archivo' => 'mod_users.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Usuarios'); 
	$conf['mod_proteccion_datos']        = array('archivo' => 'mod_proteccion_datos.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Protección Datos');
	$conf['mod_group_damas']             = array('archivo' => 'mod_group_damas.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Damas');
	$conf['mod_group_caballeros']        = array('archivo' => 'mod_group_caballeros.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Caballeros');
	$conf['mod_group_jovenes']           = array('archivo' => 'mod_group_jovenes.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Jovenes');
	$conf['mod_group_escuelaDominical']  = array('archivo' => 'mod_group_escuelaDominical.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Escuela Dominical');
	$conf['mod_tipo_miembro']            = array('archivo' => 'mod_tipo_miembro.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Tipos Miembros');
	$conf['mod_list_members']            = array('archivo' => 'mod_list_members.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Lista Miembros');
	$conf['mod_grupo_vida_list_members'] = array('archivo' => 'mod_grupo_vida_list_members.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Grupo vida Lista Miembros');
	$conf['mod_grupo_vida_distritos']    = array('archivo' => 'mod_grupo_vida_distritos.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Distritos');
	$conf['mod_grupo_vida_zonas']        = array('archivo' => 'mod_grupo_vida_zonas.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Zonas');
	$conf['mod_grupo_vida_barrios']      = array('archivo' => 'mod_grupo_vida_barrios.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Barrios');
	$conf['mod_grupo_vida_casas']        = array('archivo' => 'mod_grupo_vida_casas.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Casas'); 
	$conf['mod_tomar_asistencia']        = array('archivo' => 'mod_tomar_asistencia.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Tomar Asistencia'); 
	$conf['mod_registro_asistencia']     = array('archivo' => 'mod_registro_asistencia.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Registrar Asistencia'); 
	$conf['mod_grupo_vida_registro_asistencia'] = array('archivo' => 'mod_grupo_vida_registro_asistencia.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Grupo Vida Registrar Asistencia'); 
	$conf['mod_comunicados']                    = array('archivo' => 'mod_comunicados.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Comunicados'); 
	$conf['mod_servicios_cultos']               = array('archivo' => 'mod_servicios_cultos.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Servicios Cultos'); 
	$conf['mod_nacionalidades']                 = array('archivo' => 'mod_nacionalidades.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Nacionalidades'); 
	$conf['mod_parentescos']                    = array('archivo' => 'mod_parentescos.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Parentescos'); 
	$conf['mod_reportes']                       = array('archivo' => 'mod_reportes.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Reportes'); 
	$conf['mod_reportes_damas']                 = array('archivo' => 'mod_reportes_damas.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Reportes Damas'); 
	$conf['mod_reportes_caballeros']            = array('archivo' => 'mod_reportes_caballeros.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Reportes Caballeros'); 
	$conf['mod_reportes_jovenes']               = array('archivo' => 'mod_reportes_jovenes.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Reportes Jovenes'); 
	$conf['mod_reportes_esDominical']           = array('archivo' => 'mod_reportes_esDominical.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Reportes Escuela Dominical'); 
	$conf['mod_registro_bautismo_espiritu']     = array('archivo' => 'mod_registro_bautismo_espiritu.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Registro Bautismo Espíritu'); 
	$conf['mod_censo_estadistico']              = array('archivo' => 'mod_censo_estadistico.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Censo Estadistico'); 
	$conf['mod_familias']                       = array('archivo' => 'mod_familias.php', 'layout' => LAYOUT_SEGURITY, 'title' => 'Familias'); 
	$conf['mod_servicio_aforo']                 = array('archivo' => 'mod_servicio_aforo.php', 'layout' => LAYOUT_VACIO, 'title' => 'Servicio Aforo'); 

?>