<?php 
    //echo password_hash('test', PASSWORD_DEFAULT);
    $IDMIEMBRO = isset($_GET["idConstituyente"]) ? $_GET["idConstituyente"] : 0;
?>
<div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo"> <img src="images/logo.png" alt="logo"> </div>

                <form class="pt-3">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg" id="txtUsername" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="txtPassword" placeholder="Contraseña">
                        <input type="hidden" class="form-control form-control-lg" id="txtIdMiembro" value="<?=$IDMIEMBRO?>">
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="access" onclick="TDV.login();" href="#">ENTRAR</a>
                    </div>
                </form>

                <!-- messages area -->
                <div class="row">
                    <div class="col-12">
                        <div class="outer-loader" id="message-area">
                            <span class="inner-loader"></span>     
                        </div>
                        <span class="debug"></span>    
                    </div>
                </div> <!-- end messages area-->   
            
            </div>
        </div>
    </div>
</div>