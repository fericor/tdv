var TDV = {};

TDV.login = function(event){
    // event.preventDefault();

    $("#access").attr("disabled", true);
    $("#message-area").removeClass()
        .addClass('messagebox')
        .html('<img src="images/loader.gif" alt="validando ..." />')
        .fadeIn(20000);	
           
    $.post("server/control/login.php", { 
        tdv_username: $("#txtUsername").val(),
        tdv_password: $('#txtPassword').val(),
        tdv_idMiembro: $('#txtIdMiembro').val()           
    }, function(data) {  
        if (data.auth=='x100') {
            $("#message-area").fadeTo(200, 0.1, function() {			 
                $(this).html('Comprobando usuario ...').addClass('text-info').fadeTo(900, 1, function() { 			  	
                    $('#message-area').removeClass('text-info');
                    $('#message-area').html('Login Succesful !!!').addClass('text-success').fadeTo(900,1);
                    document.location = 'index.php?mod='+data.mod;
                });			  
            });
        } else {
            if(data.auth == 'x101'){
                $("#access").attr("disabled", false); 
                
                $("#message-area").fadeTo(200, 0.1, function() { 			 
                    $(this).html(data.msj).addClass('text-danger').fadeTo(900, 1);
                });	
            }else{
                $("#access").attr("disabled", false); 
            
                $("#message-area").fadeTo(200, 0.1, function() { 			 
                    $(this).html('Login Error !!!').addClass('text-danger').fadeTo(900, 1);
                });
            }
        }		   
    }, "json");

    return false;

}

TDV.logout = function(){
    $.post("server/control/logout.php", function(data) {
        document.location = 'index.php?mod=mod_login';
    }, "json");

    return false;
}

TDV.updateStatus = function(THIS, TABLA, IDs, CAMPO){
    VALOR  = $(THIS).text();
    ACTIVO = "";
    NO = TABLA == "users" ? "DESACTIVO" : "NO";
    SI = TABLA == "users" ? "ACTIVO" : "SI";
    
    if(VALOR == SI){
        $(THIS).html('<label class="badge badge-danger">'+NO+'</label>');
        ACTIVO = "";
    }else{
        $(THIS).html('<label class="badge badge-info">'+SI+'</label>');
        ACTIVO = "on";
    }

    $.post("server/general/updateStatus.php", { 
        txtTabla: TABLA,
        txtValores: ACTIVO,        
        txtCampo: CAMPO,        
        txtCondicion: IDs        
    }, function(data) {
        //alert(data.msj);
        $('.toast').toast('show');
    }, "json");

    return false;
}

TDV.getOneRow = function(THIS, TABLE){
    
    ID = $(THIS).attr("data-id");
    if(TABLE == "roles"){$('input:checkbox[name="ck_modulos[]"]').attr('checked', false);}

    $.post("server/general/getOneRow.php", { 
        tdv_id: ID,
        tdv_table: TABLE         
    }, function(data) {
        objs = jQuery.parseJSON( data );

        if(TABLE == "grupo_vida_casas"){
            TDV.cargarCombo(objs.idDistrito, 'tdv_grupo_vida_zonas', 'idDistrito', 'txt_idZona');
            TDV.cargarCombo(objs.idZona, 'tdv_grupo_vida_barrios', 'idZona', 'txt_idBarrio');

            // $("#txt_idLista").val(objs.idLista).trigger('change');
        }

        if(TABLE == "lista_miembros"){
            TDV.cargarListaMiembrosCkb("ALL");
            setTimeout(function(){ TDV.chekedListaMiembros(objs.idListaGrupo); }, 5000);
        }

        $.each( objs , function(index) {
            var CAMPO = index;
            var VALOR = objs[index];

            if(TABLE == "users"){
                if(CAMPO == "idRol"){
                    $('input:radio[name="rdo_'+CAMPO+'"][value="'+VALOR+'"]').attr('checked', true);
                }else{
                    if(CAMPO == "password"){$("#txt_password").val("");}else{
                        $("#txt_"+CAMPO).val(VALOR);
                        $("#txt_"+CAMPO).trigger('change');
                        $('#mySelect2').trigger('change');
                    }
                }
            }

            if(TABLE == "roles"){
                if(CAMPO == "modulos"){ 
                    ROLS = VALOR.split("|");
                    console.log(ROLS);

                    // ROLS.forEach(item => {
                    ROLS.forEach(function(item) {
                        $('input:checkbox[id="ck_modulos_'+item+'"]').attr('checked', true);
                    });
                }else{
                    $("#txt_"+CAMPO).val(VALOR);
                }
            }

            if(TABLE == "miembros"){
                if(CAMPO == "bautizado"){
                    if(VALOR == "on"){
                        $('input:checkbox[name="ck_'+CAMPO+'"]').attr('checked', true);
                    }else{
                        $('input:checkbox[name="ck_'+CAMPO+'"]').attr('checked', false);
                    }
                }

                if(CAMPO == "espirituSanto"){
                    if(VALOR == "on"){
                        $('input:checkbox[name="ck_'+CAMPO+'"]').attr('checked', true);
                    }else{
                        $('input:checkbox[name="ck_'+CAMPO+'"]').attr('checked', false);
                    }
                }
            }

            if(TABLE == "lista_miembros"){
                // $("#divTablaListaMiembros").hide();
                $("#divBuscarListaMiembros").hide();

                if( (CAMPO == "idDepartamento") || (CAMPO == "idUser") || (CAMPO == "idServicio") ){
                    $("#txt_"+CAMPO).val(VALOR);
                    $("#txt_"+CAMPO).trigger('change');
                }else{
                    $("#txt_"+CAMPO).val(VALOR);
                }
            }

            if(TABLE == "grupo_vida_distritos"){
                $("#picker1").css({'backgroundColor': objs.color, 'color': objs.color});
                if(CAMPO == "idUser"){
                    $("#txt_"+CAMPO).val(VALOR);
                    $("#txt_"+CAMPO).trigger('change');
                }else{
                    $("#txt_"+CAMPO).val(VALOR);
                }
            }

            if(TABLE == "servicios_cultos"){
                if(CAMPO == "dia"){
                    $("#txt_"+CAMPO).val(VALOR);
                    $("#txt_"+CAMPO).trigger('change');
                }else{
                    $("#txt_"+CAMPO).val(VALOR);
                    if(CAMPO == "idServicio"){
                        $('#imgServicioCulto').attr('src', '/images/servicios/'+VALOR+'.png'); }
                }
            }

            if(TABLE == "grupo_vida_zonas"){
                if( (CAMPO == "idUser") || (CAMPO == "idDistrito") ){
                    $("#txt_"+CAMPO).val(VALOR);
                    $("#txt_"+CAMPO).trigger('change');
                }else{
                    $("#txt_"+CAMPO).val(VALOR);
                }
            }

            if(TABLE == "grupo_vida_barrios"){
                if( (CAMPO == "idUser") || (CAMPO == "idDistrito") || (CAMPO == "idZona") ){
                    $("#txt_"+CAMPO).val(VALOR);
                    $("#txt_"+CAMPO).trigger('change');
                }else{
                    $("#txt_"+CAMPO).val(VALOR);
                }
            }

            if(TABLE == "grupo_vida_casas"){
                if( (CAMPO == "idUser") || (CAMPO == "idDistrito") || (CAMPO == "idZona")  || (CAMPO == "idBarrio")  || (CAMPO == "idLista") || (CAMPO == "idDueno") || (CAMPO == "idMaestro") || (CAMPO == "idAyudante") ){
                    // setTimeout(function(){ $("#txt_"+CAMPO).val(VALOR).trigger('change'); }, 10000);
                    $("#txt_"+CAMPO).val(VALOR).trigger('change');
                }else{
                    $("#txt_"+CAMPO).val(VALOR);
                }
            }

            if(CAMPO != "password"){ $("#txt_"+CAMPO).val(VALOR); }

            if(CAMPO == "activo"){
                if(VALOR == "on"){
                    $('input:checkbox[name="ck_'+CAMPO+'"]').attr('checked', true);
                }else{
                    $('input:checkbox[name="ck_'+CAMPO+'"]').attr('checked', false);
                }
            }

            if(TABLE == "servicios_cultos"){
                if(CAMPO == "idServicio"){
                    $('#imgServicioCulto').attr('src', "/images/servicios/"+VALOR+".png");
                    $("#txt_"+CAMPO).val(VALOR);
                }else{
                    $("#txt_"+CAMPO).val(VALOR);
                }
            }
        });
    });

    return false;
}

TDV.getOneRowVisitas = function(THIS, TABLE){
    
    ID = $(THIS).attr("data-id");

    $.post("server/general/getOneRow.php", { 
        tdv_id: ID,
        tdv_table: TABLE         
    }, function(data) {
        objs = jQuery.parseJSON( data );
        
        $("#customCheck1").attr('checked', true);
        //$.each( objs , function(index) {
        //    var CAMPO = index;
        //    var VALOR = objs[index];

            $("#txt_idMiembro").val(objs.idMiembro);
            $("#txtNombre").val(objs.nombre);
            $("#txtApellidos").val(objs.apellidos);
            $("#txtEmail").val(objs.email);
            $("#txtTelefono").val(objs.telefono);
            $("#txtDireccion").val(objs.direccion);
            $('#txt_idDepartamento').val(objs.idDepartamento).trigger('change');
            $('#txt_idTipoMiembro').val(objs.idTipoMiembro).trigger('change');            
        //});

        var canvas = document.getElementById("snapshot");
        var ctx = canvas.getContext("2d");
        var img = new Image();
            img.src = "data:"+objs.imgBase64;

        ctx.drawImage(img, 0, 0);

        img.onload = function(){
            ctx.drawImage(img, 0, 0);
        }

    });

    return false;
}

TDV.getFamiliaOne = function(ID){

    $.post("server/miembros/getOneFamilia.php", { 
        tdv_id: ID       
    }, function(data) {

        var objs = jQuery.parseJSON( data );

        $.each( objs , function(index) {
            var CAMPO = index;
            var VALOR = objs[index];

            $("#txt_"+CAMPO).val(VALOR);
        });

        var tblItemsFamilias = $('#tblItemsFamilia').DataTable({
			"language": {
                "url": "languajes/Spanish.json"
            },
			"bProcessing": true,
			"serverSide": true,
			"ajax":{
				url :"server/miembros/getItemsFamilias.php", // json datasource
                type: "post",  // type of method  ,GET/POST/DELETE
                data: { "idFamilia": ID },
				error: function(){
					$("#tblItemsFamilia_processing").css("display","none");
				}
			},
			columns: [
				{ 
					title: " ",
					render: function (data) {
						return '<img src="data:'+data+'" alt="image" onerror="this.src=\'images/none.png\'" onclick="TDV.cargarImgeAvatar(this);"/>';
					}  
				},
				{ title: "NOMBRE" },
				{ title: "APELLIDOS" },
				{ title: "TELEFONO" },
				{ 
					title: "BAUT",
					render: function (data) {
						return data == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
					}
				},
				{ 
					title: "ES",
					render: function (data) {
						return data == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
					}
				},
				{ title: "PARENTESCO" },
				{ title: " " }
			],
			"columnDefs": [ {
				"targets": -1,
				"data": null,
				"defaultContent": '<button type="button" class="btn btn-inverse-danger btn-icon btnEliminarMiembro" data-toggle="modal" data-target="#modalDelete"> <i class="mdi mdi-minus-box"></i> </button>'
			} ]
        }); 
        $('#tblItemsFamilia tbody').on( 'click', '.btnEliminarMiembro', function () {
			var data = tblItemsFamilias.row( $(this).parents('tr') ).data();
			$('#btnDeleteReg').attr('data-table', 'familias'); 
			$('#btnDeleteReg').attr('data-rel', data[8]);
		});
        
    });

    return false;
}

TDV.addItemFamilia = function(){
    var IDFAMILIA    = $("#txt_idFamilia").val();
    var IDMIEMBRO    = $("#txt_idMiembro").val();
    var IDPARENTESCO = $("#txt_idParentesco").val();

    $.post("server/miembros/addItemFamilia.php", {idFamilia: IDFAMILIA, idMiembro: IDMIEMBRO, idParentesco: IDPARENTESCO}, function(data) {
        // $('#divModalCrearLista').html(data);
    });

    return false;
}

TDV.getMemberOne2 = function(ID, TABLA){
    TDV.cargarCombo('txt_idDistrito', 'tdv_grupo_vida_zonas', 'idDistrito', 'txt_idZona');
    TDV.cargarCombo('txt_idZona', 'tdv_grupo_vida_barrios', 'idZona', 'txt_idBarrio');
    
    var snapshotCanvas = document.getElementById('snapshot');

    $.post("server/miembros/getOneMiembro2.php", { 
        tdv_id: ID       
    }, function(data) {

        var objs = jQuery.parseJSON( data );

        $.each( objs , function(index) {
            var CAMPO = index;
            var VALOR = objs[index];

            
            // TDV.cargarCombo('txt_idZona', 'tdv_grupo_vida_barrios', 'idZona', 'txt_idBarrio');

            var canvas = document.getElementById("snapshot");
            var ctx = canvas.getContext("2d");
            var img = new Image();
                img.src = "data:"+objs.imgBase64;

            ctx.drawImage(img, 0, 0);

            img.onload = function(){
                ctx.drawImage(img, 0, 0);
            }          

            $("#imgMemberView").attr("src", 'data:'+objs.imgBase64);

            if(TABLA == "MIEMBROS"){
                if(objs.espirituSanto == "on"){$("#txt_espirituSantoM").attr("checked", true);}else{$("#txt_espirituSantoM").attr("checked", false);}
                if(objs.bautizado == "on"){$("#txt_bautizadoM").attr("checked", true);}else{$("#txt_bautizadoM").attr("checked", false);}
            }else{
                if(objs.espirituSanto == "on"){$("#txt_espirituSanto").attr("checked", true);}else{$("#txt_espirituSanto").attr("checked", false);}
                if(objs.bautizado == "on"){$("#txt_bautizado").attr("checked", true);}else{$("#txt_bautizado").attr("checked", false);}
            }
                
            if(objs.idCiudad != 0){ $('#txt_idCiudad').val(objs.idCiudad).trigger('change'); }
            if(objs.idDepartamento != 0){ $('#txt_idDepartamento').val(objs.idDepartamento).trigger('change'); }
            if(objs.idNacionalidad != 0){ $('#txt_idNacionalidad').val(objs.idNacionalidad).trigger('change'); }
            if(objs.idTipoMiembro != 0){ $('#txt_idTipoMiembro').val(objs.idTipoMiembro).trigger('change'); }
            if(objs.idDistrito != 0){ $('#txt_idDistrito').val(objs.idDistrito).trigger('change'); }
            if(objs.idZona != 0){ $('#txt_idZona').val(objs.idZona).trigger('change'); }
            if(objs.idBarrio != 0){ $('#txt_idBarrio').val(objs.idBarrio).trigger('change'); }
            if(objs.estadoCivil != 0){ $('#txt_estadoCivil').val(objs.estadoCivil).trigger('change'); }
            $('#txt_status').val("NEW");
            // if(objs.idCasa != 0){ $('#txt_idCasa').val(objs.idCasa).trigger('change'); }
            

            $("#txt_"+CAMPO).val(VALOR);
        });

        if(TABLA == "MIEMBROS2"){ $("#txt_idMiembro").val(0); }
    });

    return false;
}

TDV.getMemberOne22 = function(ID, TABLA){
    TDV.cargarCombo('txt_idDistrito', 'tdv_grupo_vida_zonas', 'idDistrito', 'txt_idZona');
    TDV.cargarCombo('txt_idZona', 'tdv_grupo_vida_barrios', 'idZona', 'txt_idBarrio');
    
    var snapshotCanvas = document.getElementById('snapshot');

    $.post("server/miembros/getOneMiembro.php", { 
        tdv_id: ID       
    }, function(data) {

        var objs = jQuery.parseJSON( data );

        $.each( objs , function(index) {
            var CAMPO = index;
            var VALOR = objs[index];

            
            // TDV.cargarCombo('txt_idZona', 'tdv_grupo_vida_barrios', 'idZona', 'txt_idBarrio');

            var canvas = document.getElementById("snapshot");
            var ctx = canvas.getContext("2d");
            var img = new Image();
                img.src = "data:"+objs.imgBase64;

            ctx.drawImage(img, 0, 0);

            img.onload = function(){
                ctx.drawImage(img, 0, 0);
            }          

            $("#imgMemberView").attr("src", 'data:'+objs.imgBase64);

            if(TABLA == "MIEMBROS"){
                if(objs.espirituSanto == "on"){$("#txt_espirituSantoM").attr("checked", true);}else{$("#txt_espirituSantoM").attr("checked", false);}
                if(objs.bautizado == "on"){$("#txt_bautizadoM").attr("checked", true);}else{$("#txt_bautizadoM").attr("checked", false);}
            }else{
                if(objs.espirituSanto == "on"){$("#txt_espirituSanto").attr("checked", true);}else{$("#txt_espirituSanto").attr("checked", false);}
                if(objs.bautizado == "on"){$("#txt_bautizado").attr("checked", true);}else{$("#txt_bautizado").attr("checked", false);}
            }
                
            if(objs.idCiudad != 0){ $('#txt_idCiudad').val(objs.idCiudad).trigger('change'); }
            if(objs.idDepartamento != 0){ $('#txt_idDepartamento').val(objs.idDepartamento).trigger('change'); }
            if(objs.idNacionalidad != 0){ $('#txt_idNacionalidad').val(objs.idNacionalidad).trigger('change'); }
            if(objs.idTipoMiembro != 0){ $('#txt_idTipoMiembro').val(objs.idTipoMiembro).trigger('change'); }
            if(objs.idDistrito != 0){ $('#txt_idDistrito').val(objs.idDistrito).trigger('change'); }
            if(objs.idZona != 0){ $('#txt_idZona').val(objs.idZona).trigger('change'); }
            if(objs.idBarrio != 0){ $('#txt_idBarrio').val(objs.idBarrio).trigger('change'); }
            if(objs.estadoCivil != 0){ $('#txt_estadoCivil').val(objs.estadoCivil).trigger('change'); }
            $('#txt_status').val("NEW");
            // if(objs.idCasa != 0){ $('#txt_idCasa').val(objs.idCasa).trigger('change'); }
            

            $("#txt_"+CAMPO).val(VALOR);
        });
    });

    return false;
}

TDV.getMemberOne = function(THIS){
    TDV.cargarCombo('txt_idDistrito', 'tdv_grupo_vida_zonas', 'idDistrito', 'txt_idZona');
    TDV.cargarCombo('txt_idZona', 'tdv_grupo_vida_barrios', 'idZona', 'txt_idBarrio');
    
    ID    = $(THIS).attr("data-id");
    TABLA = $(THIS).attr("data-tabla");
    var snapshotCanvas = document.getElementById('snapshot');

    $.post("server/miembros/getOneMiembro.php", { 
        tdv_id: ID       
    }, function(data) {

        var objs = jQuery.parseJSON( data );

        $.each( objs , function(index) {
            var CAMPO = index;
            var VALOR = objs[index];

            
            // TDV.cargarCombo('txt_idZona', 'tdv_grupo_vida_barrios', 'idZona', 'txt_idBarrio');

            var canvas = document.getElementById("snapshot");
            var ctx = canvas.getContext("2d");
            var img = new Image();
                img.src = "data:"+objs.imgBase64;

            ctx.drawImage(img, 0, 0);

            img.onload = function(){
                ctx.drawImage(img, 0, 0);
            }          

            $("#imgMemberView").attr("src", 'data:'+objs.imgBase64);

            if(TABLA == "MIEMBROS"){
                if(objs.espirituSanto == "on"){$("#txt_espirituSantoM").attr("checked", true);}else{$("#txt_espirituSantoM").attr("checked", false);}
                if(objs.bautizado == "on"){$("#txt_bautizadoM").attr("checked", true);}else{$("#txt_bautizadoM").attr("checked", false);}
            }else{
                if(objs.espirituSanto == "on"){$("#txt_espirituSanto").attr("checked", true);}else{$("#txt_espirituSanto").attr("checked", false);}
                if(objs.bautizado == "on"){$("#txt_bautizado").attr("checked", true);}else{$("#txt_bautizado").attr("checked", false);}
            }
                
            if(objs.idCiudad != 0){ $('#txt_idCiudad').val(objs.idCiudad).trigger('change'); }
            if(objs.idDepartamento != 0){ $('#txt_idDepartamento').val(objs.idDepartamento).trigger('change'); }
            if(objs.idNacionalidad != 0){ $('#txt_idNacionalidad').val(objs.idNacionalidad).trigger('change'); }
            if(objs.idTipoMiembro != 0){ $('#txt_idTipoMiembro').val(objs.idTipoMiembro).trigger('change'); }
            if(objs.idDistrito != 0){ $('#txt_idDistrito').val(objs.idDistrito).trigger('change'); }
            if(objs.idZona != 0){ $('#txt_idZona').val(objs.idZona).trigger('change'); }
            if(objs.idBarrio != 0){ $('#txt_idBarrio').val(objs.idBarrio).trigger('change'); }
            if(objs.estadoCivil != 0){ $('#txt_estadoCivil').val(objs.estadoCivil).trigger('change'); }
            $('#txt_status').val("NEW");
            // if(objs.idCasa != 0){ $('#txt_idCasa').val(objs.idCasa).trigger('change'); }
            

            $("#txt_"+CAMPO).val(VALOR);
        });
    });

    return false;
}

TDV.restarForm = function(NAME){
    $('#'+NAME)[0].reset();
    $('input:radio').attr('checked', false);
    $('input:checkbox').attr('checked', false);
    $('#txt_status').val('NEW');

    return false;
}

TDV.submitForm = function(NAME){
    $("#tdv_loader").addClass("is-active");
    $("#divTablaListaMiembros").show();
    $("#divBuscarListaMiembros").show();

    ID    = $("#txt_id").val();
    TABLE = 'users';

    var serializedData = $('form#frm_'+NAME).serialize()
        // serializedData = serializedData.replace(/&?[^=&]+=(&|$)/g,'');

    $.post("server/"+NAME+"/saveForm.php", serializedData, function(data) {
        $.notify({ message: 'Operación realizada con exito. <br>Espere...' },{ type: 'info' });
        $('form#frm_'+NAME).trigger("reset");
        $('.modal').modal('hide');  
        setTimeout(function(){ 
            $("#tdv_loader").removeClass("is-active");
            // location.reload();
        }, 1000);  
    });

    return false;
}

TDV.submitFormImage = function(NAME){
    $("#tdv_loader").addClass("is-active");

    var serializedData = $('form#frm_'+NAME).serialize()
        // serializedData = serializedData.replace(/&?[^=&]+=(&|$)/g,'');


    var formData = new FormData($('form#frm_'+NAME)[0]);            

    var request = $.ajax({
        type: 'POST',
        url: "server/"+NAME+"/saveForm.php",
        mimeType:'application/json',
        dataType:'json',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){                            
            $.notify({ message: 'Operación realizada con exito. <br>Espere...' },{ type: 'info' });
            $('form#frm_'+NAME).trigger("reset");
            $('.modal').modal('hide');  
            setTimeout(function(){ 
                $("#tdv_loader").removeClass("is-active");
                location.reload();
            }, 1000); 
        },
        error: function(msg){
            $.notify({ message: 'Operación realizada con exito. <br>Espere...' },{ type: 'error' });
        }
    }); 

    return false;
}

TDV.deleteRegistro = function(THIS){
    IDs = $(THIS).attr("data-rel");
    TABLE = $(THIS).attr("data-table");
    
    $.post("server/general/deleteReg.php", {txtTable:TABLE, txtId:IDs}, function(data) {
        $("#tdv_loader").removeClass("is-active");
        $('.toast').toast('show');
        location.reload();
    });

    return false;
}

TDV.printdiv = function(printpage, TITLE) {
    var contents = $("#"+printpage).html();
    var mywindow = window.open('', 'App TDV', 'height=700,width=1200');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('<link href="css/style.css" rel="stylesheet" type="text/css" />');
        mywindow.document.write('<link href="vendors/base/vendor.bundle.base.css" rel="stylesheet" type="text/css" />');
        mywindow.document.write('</head><body>');
        mywindow.document.write('<header><img src="images/logo.png"><h1>TDV::'+TITLE+'</h1></header>');
        mywindow.document.write('<div class="main-panel"><div class="content-wrapper"><div class="row mt-4">');
        mywindow.document.write(contents);
        mywindow.document.write('</div></div></div></body></html>');


        setTimeout(function () {
            mywindow.print();
            mywindow.close();
        }, 5000);

    return true;
}

TDV.cargarCombo = function(THIS, TABLE, CAMPO, TO){
    $('#'+TO).html($('<option>', {value: "", text: "Seleccionar"}));

    $.post("server/general/selectBySql.php", { 
        tdv_id: $(THIS).val() != 0 ? $(THIS).val() : "",
        tdv_campo: CAMPO,         
        tdv_table: TABLE   

    }, function(data) {
        var objs = jQuery.parseJSON( data );
        
        $.each( objs , function(i, index) {
            var IDs  = index.idZona;
            if(TABLE == 'tdv_departamentos'){IDs=index.idDepartamento}
            if(TABLE == 'tdv_tipos_miembros'){IDs=index.idTipoMiembro}
            if(TABLE == 'tdv_parentescos'){IDs=index.idParentesco}

            $('#'+TO).append($('<option>', {value: IDs, text : index.titulo}));
        });
        $('#'+TO).select2();

    });

    return false;
}

TDV.cargarLista = function(IDUSER, IDLISTA, IDSERVICIO){
    $('#bodyTrListaAsistencia').html("");
    //$('#txt_idServicio').val(IDSERVICIO).trigger('change');

    $.post("server/general/getListaAsistencia.php", {idLista: IDLISTA, idServicio: IDSERVICIO}, function(data) {
        var i = 0;
        var HTML = '';
        var objs = jQuery.parseJSON( data );
        $.each( objs , function(i, index) {
            var COMENTARIOS = index.comentarios ? index.comentarios : ""; 
            var ASISTENCIA  = index.asistencia == "on" ? "checked" : "";
            var ASISTENCIAHIDDEN  = index.asistencia === undefined ? "off" : "on";

            i = i + 1;
            
            HTML += '<tr>';
            HTML += '<td>';
            HTML += '<input type="hidden" name="txtIdUser[]" value="'+IDUSER+'">';
            HTML += '<input type="hidden" name="txt_idLista[]" value="'+IDLISTA+'">';
            HTML += '<input type="hidden" name="txt_idMiembro[]" value="'+index.idMiembro+'">';
            HTML += '<img src="data:'+index.imgBase64+'" alt="image" onerror="this.src=\'images/none.png\'" onclick="TDV.cargarImgeAvatar(this);"/>';
            HTML += '</td>';
            HTML += '<td>'+index.nombre+'</td>';
            HTML += '<td>'+index.apellidos+'</td>';
            HTML += '<td>';
            HTML += '<label class="toggle-switch">';
            HTML += '<input type="checkbox" name="txtAsistencia[]" '+ASISTENCIA+' onchange="TDV.cambiarValorHidden(this, '+i+');">';
            HTML += '<span class="toggle-slider round"></span>';
            HTML += '</label>';
            HTML += '<input id="txtAsistenciaHidden'+i+'" type="hidden" name="txtAsistenciaHidden[]" value="'+ASISTENCIAHIDDEN+'">';
            HTML += '</td>';
            HTML += '<td><textarea class="form-control" name="txt_comentarios[]" rows="4">'+COMENTARIOS+'</textarea></td>';
            HTML += '</tr>';
        });

        $('#bodyTrListaAsistencia').append(HTML);
    });

    return false;
},

TDV.cambiarValorHidden = function(THIS, I){
    if( $(THIS).is(':checked') ) {
        $('#txtAsistenciaHidden'+I).val('on');
    } else {
        $('#txtAsistenciaHidden'+I).val('off');
    }
},

TDV.resetHiddenAsistencia = function(THIS){
    $("input[name*='txtAsistenciaHidden']").val("off");
    $("input[name*='txtAsistencia']").attr("checked", false);

    var IDUSER     = $("input[name*='txtIdUser']").val();
    var IDLISTA    = $("input[name*='txt_idLista']").val();
    var IDSERVICIO = $(THIS).val();

    TDV.cargarLista(IDUSER, IDLISTA, IDSERVICIO);
    return false;
},

TDV.cargarListaView = function(IDUSER, IDLISTA){
    $('#bodyTrListaAsistenciaView').html("");

    $.post("server/general/getListaAsistencia.php", {idLista: IDLISTA}, function(data) {
        var HTML = '';
        var objs = jQuery.parseJSON( data );
        $.each( objs , function(i, index) {
            HTML += '<tr>';
            HTML += '<td>';
            HTML += '<input type="hidden" name="txtIdUser[]" value="'+IDUSER+'">';
            HTML += '<input type="hidden" name="txt_idLista[]" value="'+IDLISTA+'">';
            HTML += '<input type="hidden" name="txt_idMiembro[]" value="'+index.idMiembro+'">';
            HTML += '<img src="data:'+index.imgBase64+'" alt="image" onerror="this.src=\'images/none.png\'"/>';
            HTML += '</td>';
            HTML += '<td>'+index.nombre+'</td>';
            HTML += '<td>'+index.apellidos+'</td>';
            HTML += '<td> </td>';
            HTML += '</tr>';
        });

        $('#bodyTrListaAsistenciaView').append(HTML);
    });

    return false;
}

TDV.cargarListaServicio = function(SERVICIO){
    $('#bodyTrListaServicioView').html("");

    $.post("server/aforo/getAforoCulto.php", {tituloCulto: SERVICIO}, function(data) {
        var HTML = '';
        var objs = jQuery.parseJSON( data );
        var i = 0;
        $.each( objs , function(i, index) {
            i = i + 1;
            HTML += '<tr>';
            HTML += '<td>'+i+'</td>';
            HTML += '<td> <button type="button" class="btn btn-inverse-warning btn-icon" onclick="TDV.enviarReserva('+index.id+');"> <i class="mdi mdi-send"></i> </button> <button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'registro_cultos\'); $(\'#btnDeleteReg\').attr(\'data-rel\', '+index.id+');"> <i class="mdi mdi-minus-box"></i> </button> </td>';
            HTML += '<td>'+index.nombre+'</td>';
            HTML += '<td>'+index.apellidos+'</td>';
            HTML += '<td>'+index.fecha+'</td>';
            HTML += '<td>'+index.email+'</td>';
            HTML += '<td>'+index.telefono+'</td>';
            HTML += '<td> </td>';
            HTML += '</tr>';
        });

        $('#bodyTrListaServicioView').append(HTML);
    });

    return false;
}

TDV.cargarListaMiembrosCkb = function(GRUPO){
    VALOR = GRUPO == "ALL" ? "ALL" : $(GRUPO).val();
    $('#bodyTrCkbMiembros').html("");

    $.post("server/miembros/listMiembros.php", {idGrupo: VALOR}, function(data) {
        var HTML = '';
        var objs = jQuery.parseJSON( data );
        $.each( objs , function(i, index) {
            HTML += '<tr>';
            HTML += '<td>';
            HTML += '<input class="chkMiembroLista" type="checkbox" name="txt_idMiembro[]" value="'+index.idMiembro+'">';
            HTML += '</td>';
            HTML += '<td>';
            HTML += '<img src="data:'+index.imgBase64+'" alt="image" onerror="this.src=\'images/none.png\'"/>';
            HTML += '</td>';
            HTML += '<td>'+index.nombre+'</td>';
            HTML += '<td>'+index.apellidos+'</td>';
            HTML += '<td>'+index.DEPARTAMENTO+'</td>';
            HTML += '</tr>';
        });

        $('#bodyTrCkbMiembros').append(HTML);


        if ( $.fn.dataTable.isDataTable( '.tdv_tablesCkb' ) ) {
            $('.tdv_tablesCkb').dataTable().fnClearTable();
            $('.tdv_tablesCkb').dataTable().fnDestroy();
        }else {
            $('.tdv_tablesCkb').DataTable({
                "pageLength": 5,
                "language": {
                    "url": "languajes/Spanish.json"
                }
            });
        }
        
        $('#tdv_tablesCkb-select-all').on('click', function(){
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
        
        $('#tdv_tablesCkb tbody').on('change', 'input[type="checkbox"]', function(){
            if(!this.checked){
                var el = $('#tdv_tablesCkb-select-all').get(0);
                if(el && el.checked && ('indeterminate' in el)){
                    el.indeterminate = true;
                }
            }
        });
        
    });

    return false;
}

TDV.cargarListaMiembrosOtros = function(VALOR){
    $('#tblBodyOtrosMiembros').html("");

    $.post("server/miembros/listMiembrosOtros.php", {txtValor: VALOR}, function(data) {
        var HTML = '';
        var objs = jQuery.parseJSON( data );
        $.each( objs , function(i, index) {
            $BAUTIZADO     = index.bautizado == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
            $ESPIRITUSANTO = index.espirituSanto == "on" ? '<label class="badge badge-info tdv_click">SI</label>' : '<label class="badge badge-danger tdv_click">NO</label>';
            
            HTML += '<tr>';
            HTML += '<td class="py-1"> <img src="data:'+index.imgBase64+'" alt="image" onerror="this.src=\'images/none.png\'" onclick="TDV.cargarImgeAvatar(this);"/> </td>';
            HTML += '<td>'+index.nombre+'</td>';
            HTML += '<td>'+index.apellidos+'</td>';
            HTML += '<td>'+index.telefono+'</td>';
            HTML += '<td onclick="TDV.updateStatus(this, \'miembros\', '+index.idMiembro+', \'bautizado\')">'+$BAUTIZADO+'</td>';
            HTML += '<td onclick="TDV.updateStatus(this, \'miembros\', '+index.idMiembro+', \'espirituSanto\')">'+$ESPIRITUSANTO+'</td>';
            HTML += '<td>'+index.DEPARTAMENTO+'</td>';
            HTML += '<td>';
            HTML += '<button type="button" class="btn btn-inverse-success btn-icon" data-id="'+index.idMiembro+'" onclick="TDV.getMemberOne(this);" data-toggle="modal" data-target="#modalMiembrosForm"> <i class="mdi mdi-grease-pencil"></i> </button>';
            HTML += '<button type="button" class="btn btn-inverse-danger btn-icon" data-toggle="modal" data-target="#modalDelete" onclick="$(\'#btnDeleteReg\').attr(\'data-table\', \'miembros\'); $(\'#btnDeleteReg\').attr(\'data-rel\','+index.idMiembro+');"> <i class="mdi mdi-minus-box"></i> </button>';
            HTML += '</td>';
            HTML += '</tr>';
        });

        $('#tblBodyOtrosMiembros').append(HTML);
    });

    return false;
}

TDV.chekedListaMiembros = function(IDLISTA){
    $.post("server/lista_miembros/getListMember.php", {idLista: IDLISTA}, function(data) {
        var HTML = '';
        var objs = jQuery.parseJSON( data );
        $.each( objs , function(i, index) {
            $('.chkMiembroLista[value='+index.idMiembro+']').prop('checked', true);
        });
        
    });

    return false;
}

TDV.cargarImgeAvatar =  function(THIS){
    var SRC = $(THIS).attr('src');
    $('#modalImageAvatar').modal('show');
    $('#imgAvatarTDV').attr('src', SRC);
}

TDV.cargarListaViewHistorial = function(IDUSER, IDLISTA, FECHA){
    $('#bodyTrListaAsistenciaViewHistorial').html("");

    $.post("server/general/getListaAsistenciaHistorial.php", {txtFecha:FECHA, idLista: IDLISTA}, function(data) {
        var HTML = '';
        var objs = jQuery.parseJSON( data );
        $.each( objs , function(i, index) {
            HTML += '<tr>';
            HTML += '<td>';
            HTML += '<input type="hidden" name="txtIdUser[]" value="'+IDUSER+'">';
            HTML += '<input type="hidden" name="txt_idLista[]" value="'+IDLISTA+'">';
            HTML += '<input type="hidden" name="txt_idMiembro[]" value="'+index.idMiembro+'">';
            HTML += '<img src="images/'+index.asistencia+'.png"/>';
            HTML += '</td>';
            HTML += '<td>';
            HTML += '<img src="data:'+index.imgBase64+'" alt="image" onerror="this.src=\'images/none.png\'"/>';
            HTML += '</td>';
            HTML += '<td>'+index.culto+'</td>';
            HTML += '<td>'+index.nombre+'</td>';
            HTML += '<td>'+index.apellidos+'</td>';
            HTML += '<td>'+index.fecha+'</td>';
            HTML += '<td>'+index.comentarios+'</td>';
            HTML += '</tr>';
        });

        $('#bodyTrListaAsistenciaViewHistorial').append(HTML);
    });

    return false;
}

TDV.cargarEstadisticasHistorial = function(IDUSER, IDLISTA, FECHA){

    $.post("server/general/getEstadisticasLista.php", {txtFecha:FECHA, idLista: IDLISTA}, function(data) {
        var objs = jQuery.parseJSON( data );
        
        $(".lblDamasInfo").text(objs.DAMAS);
        $(".lblCaballerosInfo").text(objs.CABALLEROS);
        $(".lblJovenesInfo").text(objs.JOVENES);
        $(".lblEscuelaDominicalInfo").text(objs.ED);

        $(".lblBautizadoInfo").text(objs.BAUTIZADO);
        $(".lblEspirituSantoInfo").text(objs.EESS);
    });

    return false;
}

TDV.crearHidenValues = function(IDLISTA, IDUSER){
    $("#divListaAsistenciaHsitorial").append('<input type="hidden" id="txtIdLista" value="'+IDLISTA+'">');
    $("#divListaAsistenciaHsitorial").append('<input type="hidden" id="txtIdUser" value="'+IDUSER+'">');
}

TDV.crearLista = function(IDUSER, IDLISTA){
    $('#divModalCrearLista').html('<button class="btn btn-primary" type="button" disabled style="width:100%;"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creando lista de miembro... </button>');

    $.post("server/general/crearLista.php", {idLista: IDLISTA, idUser: IDUSER}, function(data) {
        $('#divModalCrearLista').html(data);
    });

    return false;
}

TDV.setCookie = function(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
  
TDV.getCookie = function(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

TDV.enviarFelicitacion =  function(IDUSER){
    $.post("server/miembros/enviarFelicitacion.php", {idUser:IDUSER}, function(data) {
        $.notify({ message: data },{ type: 'info' });
    });
}

TDV.enviarReserva =  function(IDs){
    $.post("server/aforo/enviarReserva.php", {idReserva:IDs}, function(data) {
        $.notify({ message: data },{ type: 'info' });
    });
}

TDV.enviarLinkMembresia =  function(IDUSER){
    $.post("server/miembros/enviarLinkMiembro.php", {idUser:IDUSER}, function(data) {
        $.notify({ message: data },{ type: 'info' });
    });
}