<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $TIPOMIEMBRO = '';
    $res = $TDV->conn->query("SELECT idTipoMiembro, titulo FROM tdv_tipos_miembros ORDER BY titulo DESC");
    while ($rs = $res->fetch_assoc()) {
        $TIPOMIEMBRO .= '<option value="'.$rs["titulo"].'">'.$rs["titulo"].'</option>';
    }
?>

<style>
    /*custom font*/
    @import url(https://fonts.googleapis.com/css?family=Montserrat);

    body {
        font-family: montserrat, arial, verdana;
    }
    select {display:block!important;}
    /*form styles*/
    #msform {
        margin: 5px auto;
		padding: 20px;
        text-align: center;
        position: relative;
    }
    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 0px;
        box-sizing: border-box;
        /*width: 80%;
        margin: 0 10%;*/
        
        /*stacking fieldsets above each other*/
        position: relative;
    }
    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }
    /*inputs*/
    #msform input, #msform select, #msform textarea {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        font-size: 13px;
    }
    /*buttons*/
    #msform .action-button {
        width: 140px;
        background: #27AE60;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 1px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
        font-size: 15px;
    }
    #msform .action-button:hover, #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
    }
    /*headings*/
    .fs-title {
        font-size: 20px;
        text-transform: uppercase;
        color: #2C3E50;
        margin-bottom: 10px;
    }
    .fs-subtitle {
        font-weight: normal;
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
    }
    /*progressbar*/
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        /*CSS counters to number the steps*/
        counter-reset: step;
    }
    #progressbar li {
        list-style-type: none;
        color: white;
        text-transform: uppercase;
        font-size: 9px;
        width: 33.33%;
        float: left;
        position: relative;
    }
    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 50px;
		height: 50px;
        line-height: 50px;
        display: block;
        font-size: 40px;
        color: #333;
        background: white;
        border-radius: 3px;
        margin: 0 auto 5px auto;
    }
    /*progressbar connectors*/
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: white;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1; /*put it behind the numbers*/
    }
    #progressbar li:first-child:after {
        /*connector not needed before the first step*/
        content: none; 
    }
    /*marking active/completed steps green*/
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before,  #progressbar li.active:after{
        background: #27AE60;
        color: white;
    }
	.carousel-multi-item {
		margin-bottom: 0rem;
	}
    .divLado1{float: left;width: calc(100% - 10px);padding: 0px 0px 0px 10px;}
    .divLado2{float:left;width: calc(50% - 5px);padding: 0px 0px 0px 10px;}
    .carousel-multi-item .controls-top {
	    top: 25%;
	    width: 100%;
	    position: absolute;
	}

    .brand-logo {
        width: 100%;
        padding: 20px;
        background: #fff;
    }
</style>

<?php 
    $PARTS = explode("&", $_SERVER['REQUEST_URI']);

    if(!empty($PARTS[1])){
        $res2 = $TDV->conn->query("SELECT * FROM tdv_registro_cultos WHERE ".base64_decode($PARTS[1]));
        $rs2  = $res2->fetch_assoc();
        $MENSAJE  = '<div class="brand-logo"> <img src="images/logo.png" alt="logo" style="width:100%;"> </div><form id="msform">';
        $MENSAJE .= '<fieldset>';
        $MENSAJE .= '<h3>RESERVA EN TDV</h3>
            <p>Datos de su reserva.</p>
            <b>Nombres: </b> <i>'.$rs2["nombre"]." ".$rs2["apellidos"].'</i> <br>
            <b>Servicio: </b> <i>'.$rs2["culto"].'</i> <hr>';

        // $TDV->enviarEmail("correo-reserva", "Reserva@::Tabernáculo de Vida", $_POST['txtEmail'], $MENSAJE);

        $MENSAJE .= "<b>Tu reserva se ha dado de baja.</b>";
        $MENSAJE .= '</fieldset>';
        $MENSAJE .= '</form>';
        
        echo $MENSAJE;
        $TDV->conn->query("DELETE FROM tdv_registro_cultos WHERE ".base64_decode($PARTS[1]));
    }else{
?>
<!-- multistep form -->
<div class="brand-logo"> <img src="images/logo.png" alt="logo" style="width:100%;"> </div>
<form id="msform" method="post" action="server/aforo/saveAforo.php">
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Servicio o Culto</li>
        <li>Añadir personas</li>
        <li>Finalizar</li>
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Servicio culto</h2>
        <h3 class="fs-subtitle">Selecciona tu culto donde asistiras</h3>

		<!--Carousel Wrapper-->
		<div id="multi-item-example" class="carousel slide carousel-multi-item" data-interval="false" data-ride="carousel">
			<!--Slides-->
			<div class="carousel-inner" role="listbox">
				<!--First slide-->
				<div class="carousel-item active">
					<?php
						$i = 0;
						$HOY = date("Y-m-d");
						
						$NUM = 576 <= trim("<script type='text/javascript'>document.write(window.innerWidth);</script>") ? 3 : 1;
						
						$res = $TDV->conn->query("SELECT * FROM tdv_servicios_cultos WHERE DATE(fecha) >= '".$HOY."' ORDER BY fecha DESC, hora ASC");
						while ($rs = $res->fetch_assoc()) {
							$i++;

							$res0   = $TDV->conn->query("SELECT * FROM tdv_registro_cultos WHERE idCulto = '".$rs["idServicio"]."'");
							$NUM0   = mysqli_num_rows($res0);
							$FALTA = $rs["limite"] - $NUM0;

							$MOSTRAR = $FALTA <= 0 ? 'style="display:none;"' : "";


							// $HTML = '<b>AFORO: </b> <i>'.$rs["limite"].'</i> | <b>REGISTRADOS: </b> <i>'.$NUM0.'</i> | <b>PLAZAS: </b> <i>'.$FALTA.'</i>';
							$HTML = '<b>AFORO: </b> <i>'.$rs["limite"].'</i> | <b>PLAZAS: </b> <i>'.$FALTA.'</i>';

							echo '<div class="col-12 col-sm-12 col-lg-12" style="float:left">
								<div class="card h-100" id="card'.$rs["idServicio"].'">
									<img class="card-img-top" src="images/servicios/'.$rs["idServicio"].'.png?v=1.0" onerror="this.src=\'images/no-image.png\';" alt="'.$rs["titulo"].'">
									<div class="card-body">
										<h4 class="card-title">'.$rs["titulo"].'</h4>
										<p class="card-text">'.$rs["descripcion"].'</p>
										<p class="card-text"><b>Fecha: </b>'.$TDV->cambiarfecha_mysql($rs["fecha"]).' | <b>Hora: </b>'.$rs["hora"].' </p>
										<p class="card-text">'.$HTML.'</p>
									</div>
									<div class="card-footer py-4" '.$MOSTRAR.'>
										<a class="btn btn-primary" onclick="seleccionCulto('.$rs["idServicio"].');">SELECCIONAR</a>
										<input type="radio" id="txtServicioCulto'.$rs["idServicio"].'" name="txtServicioCulto" value="'.$rs["idServicio"].'|'.$rs["titulo"].'" class="txtServicioCulto" required>
									</div>
								</div>
							</div>';

							if($i%$NUM==0){ echo '</div> <div class="carousel-item">'; }
						}
					?>
				</div>
				<!--/.First slide-->   
			</div>
			<!--/.Slides-->

			<!--Controls-->
			<div class="controls-top">
				<a class="btn-floating" href="#multi-item-example" data-slide="prev" style="left: 0px;position: absolute;"><i class="mdi mdi-chevron-left"></i></a>
				<a class="btn-floating" href="#multi-item-example" data-slide="next" style="right: 0px;position: absolute;"><i class="mdi mdi-chevron-right"></i></a>
			</div>
			<!--/.Controls-->
		</div>
		<!--/.Carousel Wrapper-->
		<input type="button" name="next" class="next next1 action-button" value="S I G U I E N T E &raquo;" />
    </fieldset>

    <fieldset>
        <h2 class="fs-title">Datos Contacto</h2>
        <h3 class="fs-subtitle">Información del que asistira</h3>
        <div class="divLado1">
            <select id="txt_idTipoMiembro" name="txt_idTipoMiembro" class="js-basic-single" style="width:100%;">
                <?=$TIPOMIEMBRO?>
            </select>
        </div>
        <div class="divLado1"> <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombre" required/> </div>
        <div class="divLado1"> <input type="text" id="txtApellidos" name="txtApellidos" placeholder="Apellidos" required/> </div>
        <div class="divLado1"> <input type="text" id="txtLocalidad" name="txtLocalidad" placeholder="Localidad/Ciudad" required/> </div>
        <div class="divLado2"> <input type="text" id="txtCP" name="txtCP" placeholder="Codigo postal" required/> </div>
        <div class="divLado2"> <input type="text" id="txtTelefono" name="txtTelefono" placeholder="Telefono" required/> </div>
        <div class="divLado1"> <input type="email" id="txtEmail" name="txtEmail" placeholder="Email" required/> </div>
        
        <input type="button" name="previous" class="previous action-button" value="Atras" />
        <input id="btnPrevioForm" type="button" name="next" class="next next2 action-button" value="Siguiente" />
    </fieldset>

    <fieldset>
        <h2 class="fs-title">Resumen Reserva</h2>
        <h3 class="fs-subtitle">Esta es tu informacion que se enviara</h3>
        <div id="divInfoAforo" class="divLado1">
        </div>
        
        
        <input type="button" name="previous" class="previous action-button" value="Atras" />
        <input type="submit" name="submit" class="submit action-button" value="Enviar" />
    </fieldset>
</form>
<?php } ?>