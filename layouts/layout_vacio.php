<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache"> 

    <title>TDV::<?=$TITLE_PAGE?></title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.8.1/css/mdb.min.css">

    <link href="lib/noty.css" rel="stylesheet">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="row" style="background:#33b5e5;">
        <div class="col-12">
            <?php
                if(file_exists( $path_modulo )){
                    include( $path_modulo );
                }else{
                    die('Error al cargar el modulo <b>'.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
                }
            ?>
        </div>
    </div>
              
    <footer class="footer">
        <div class="footer-wrap">
            <div class="w-100 clearfix">
                <span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © <?=date("Y")?> <a href="https://tabernaculodevida.es/" target="_blank">TDV</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Tabernaculo de vida <i class="mdi mdi-heart-outline"></i></span>
            </div>
        </div>
    </footer>

    <!-- base:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/notify.min.js"></script>
    
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="vendors/summernote/summernote.min.js"></script>

    <!-- funciones:js -->
    <script src="js/tdv_funciones.js?v=1.0"></script>

    <script>

        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next1").click(function(){
            if($(".txtServicioCulto").is(':checked')) {   
                if(animating) return false;
                animating = true;
                
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                
                //activate next step on progressbar using the index of next_fs
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                
                //show the next fieldset
                next_fs.show(); 
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale current_fs down to 80%
                        scale = 1 - (1 - now) * 0.2;
                        //2. bring next_fs from the right(50%)
                        left = (now * 50)+"%";
                        //3. increase opacity of next_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({
                    'transform': 'scale('+scale+')',
                    // 'position': 'absolute'
                });
                        next_fs.css({'left': left, 'opacity': opacity});
                    }, 
                    duration: 800, 
                    complete: function(){
                        current_fs.hide();
                        animating = false;
                    }, 
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                });   
            } else {   
                $.notify("Tienes que seleccionar un servicio o culto", "info");
            }
        });

        $(".next2").click(function(){
            if( ($("#txtNombre").val() == "") || ($("#txtApellidos").val() == "") || ($("#txtLocalidad").val() == "") || ($("#txtCP").val() == "") || ($("#txtTelefono").val() == "") || ($("#txtEmail").val() == "") ){
                $.notify("Todos los campos son obligatorios.", "error");
            }else{ 
                if(animating) return false;
                animating = true;
                
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                
                //activate next step on progressbar using the index of next_fs
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                
                //show the next fieldset
                next_fs.show(); 
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale current_fs down to 80%
                        scale = 1 - (1 - now) * 0.2;
                        //2. bring next_fs from the right(50%)
                        left = (now * 50)+"%";
                        //3. increase opacity of next_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({
                    'transform': 'scale('+scale+')',
                    // 'position': 'absolute'
                });
                        next_fs.css({'left': left, 'opacity': opacity});
                    }, 
                    duration: 800, 
                    complete: function(){
                        current_fs.hide();
                        animating = false;
                    }, 
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                }); 

                var form = $("#msform");
                var url  = 'server/aforo/getInfoReserva.php'; 

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data){
                        $("#divInfoAforo").html(data); // show response from the php script.
                    }
                });    
            }
        });

        $(".previous").click(function(){
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            
            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            
            //show the previous fieldset
            previous_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".submit").click(function(e){
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $("#msform");
            var url = form.attr('action');
            
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data){
                    $(".previous").hide();
                    $(".submit").hide();
                    $.notify("Reserva realizada con exito.", "success");
                    $("#divInfoAforo").html(data); // show response from the php script.
                    setTimeout(function(){ location.reload(); }, 3000);
                }
            });

            return false;
        })

        function seleccionCulto(ID){
            $("#txtServicioCulto"+ID).prop("checked", true);
            $(".card").css('border', '');
            $("#card"+ID).css('border', '5px solid #33b5e5');
        }

    </script>
</body>

</html>