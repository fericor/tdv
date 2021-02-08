<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TDV::<?=$TITLE_PAGE?></title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.8.1/css/mdb.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel w-100  documentation">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 doc-header">
                                <a class="btn btn-success" href="?mod=<?=$_SESSION["MODULO"]?>"><i class="mdi mdi-home mr-2"></i>Ir a inicio</a>
                                <h1 class="text-primary mt-4"><?=$TITLE_PAGE?></h1>
                            </div>
                        </div>
                        <div class="row doc-content">
                            <div class="col-12 col-md-10 offset-md-1">
                                <?php
                                    if(file_exists( $path_modulo )){
                                        include( $path_modulo );
                                    }else{
                                        die('Error al cargar el modulo <b>'.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- partial:../partials/_footer.html -->
                    <footer class="footer">
                        <div class="footer-wrap">
                            <div class="w-100 clearfix">
                                <span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © <?=date("Y")?> <a href="https://tabernaculodevida.es/" target="_blank">TDV</a>. All rights reserved.</span>
                                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Tabernaculo de vida <i class="mdi mdi-heart-outline"></i></span>
                            </div>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
            </div>
        </div>
    </div>

    <!-- base:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="vendors/summernote/summernote.min.js"></script>

    <!-- funciones:js -->
    <script src="js/tdv_funciones.js"></script>
</body>

</html>