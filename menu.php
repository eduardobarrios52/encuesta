<?php
    $fileName = substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'], '/',1)+1);
    if(!$general->getAcceso()){

        $rutaInicio = URL.'inicio.php';

        header('Location: '.$rutaInicio);
    }
?>

<div id="modalCambioofi" class="modal-block modal-block-sm mfp-hide">
    <section class="panel">
    
        <div class="panel-body text-center">
            <div class="modal-wrapper">
                <div class="modal-icon center">
                    <i class="fa fa-question-circle"></i>
                </div>
                <div class="modal-text">
                    <h4>¿Seguro de cambiar de oficina?</h4>
                    
                        <select id='ofi_cam' name='ofi_cam'>
                            <?php
                            foreach($_SESSION['oficinas'] as $oficina){
                            ?>
                            <option value="<?php echo $oficina->CVE_OFI?>"><?php echo $oficina->DESCR?></option>
                            <?php
                            }
                            ?>
                        </select>
                    
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary modal-confirm" onclick="cambiarOfi()">Confirmar</button>
                    <button class="btn btn-default modal-dismiss">Cancelar</button>
                </div>
            </div>
        </footer>
    
    </section>
</div>

<div id="modalCambiocia" class="modal-block modal-block-sm mfp-hide">
    <section class="panel">
    
        <div class="panel-body text-center">
            <div class="modal-wrapper">
                <div class="modal-icon center">
                    <i class="fa fa-question-circle"></i>
                </div>
                <div class="modal-text">
                    <h4>¿Seguro de cambiar de compañia?</h4>

                        <select id='cia_cam' name='cia_cam'>
                            <?php
                            foreach($_SESSION['cias'] as $compa){
                            ?>
                            <option value="<?php echo $compa->CVE_CIA?>"><?php echo $compa->NOMBRE?></option>
                            <?php
                            }
                            ?>
                        </select>
                    
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary modal-confirm" onclick="cambiarCia()">Confirmar</button>
                    <button class="btn btn-default modal-dismiss">Cancelar</button>
                </div>
            </div>
        </footer>
    
    </section>
</div>

<header class="header">
    <div class="logo-container">
        <a href="<?php echo URL?>inicio.php" class="logo">
            <img src="<?php echo URL?>assets/images/logo.png" height="35" alt="Porto Admin" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <!--<form action="pages-search-results.html" class="search nav-form">
            <div class="input-group input-search">
                <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>-->
        
        <span class="separator"></span>
        
        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="<?php echo URL?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    <span class="name"><?php echo $_SESSION['nombre'] ?></span>
                    <span class="role"><?php echo $_SESSION['puesto'] ?></span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li>
                        <a role="menuitem" tabindex="-1" href="#modalCambioofi" class="modal-basic"><i class="fa fa-home"></i><?php echo $_SESSION['nom_ofi'] ?> <span style="right: 12px;position: absolute;"><b>Cambiar</b></span></a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="#modalCambiocia" class="modal-basic"><i class="fa fa-home"></i><?php echo $_SESSION['nom_cia'] ?> <span style="right: 12px;position: absolute;"><b>Cambiar</b></span></a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="<?php echo URL?>logout.php"><i class="fa fa-power-off"></i> Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>

<script src="<?php echo URL?>assets/vendor/magnific-popup/magnific-popup.js"></script>

<script>

    function cambiarOfi(){
        $('.loader').show();
        $.ajax({
            url: '<?php echo URL?>cambiaroficina.php',
            type: 'POST',
            data: {
                ofi_cam : $('#ofi_cam').val()
            },
            success: function(respuesta) {
                titulo = '';
                tipo = '';
                if(respuesta.code == '200'){
                    $('.modal-dismiss').click();    
                    location.reload();
                }
            },
            error: function(e){
                console.log(e);
            }
        });
       
    }

    function cambiarCia(){
        $('.loader').show();
        $.ajax({
            url: '<?php echo URL?>cambiarcompania.php',
            type: 'POST',
            data: {
                cia_cam : $('#cia_cam').val()
            },
            success: function(respuesta) {
                titulo = '';
                tipo = '';
                if(respuesta.code == '200'){
                    $('.modal-dismiss').click();    
                    location.reload();
                }
            },
            error: function(e){
                console.log(e);
            }
        });
       
    }

    $( document ).ready(function() {

        $('.loader').hide();

        (function($){
            $('.modal-basic').magnificPopup({
                type: 'inline',
                preloader: false,
                modal: true,
            });
            
            $(document).on('click', '.modal-dismiss', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
            });
        }).apply( this, [ jQuery ]);
    });

</script>