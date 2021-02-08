<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <?=$ui->tdv_menu_left()?>    
                
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="?mod=<?=$_SESSION["MODULO"]?>"><img src="images/logo.png" alt="logo"/></a>
                    <a class="navbar-brand brand-logo-mini" href="?mod=<?=$_SESSION["MODULO"]?>"><img src="images/logo.png" alt="logo"/></a>
                </div>

                <?=$ui->tdv_menu_right()?>  
                
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </div>
    </nav>
    
    <nav class="bottom-navbar">
        <div class="container">
            <?=$ui->tdv_menu_main()?>
        </div>
    </nav>
</div>