<?php
require_once 'src/controller/modulosController.php';
use Src\Controller\ModulosController;
$modulo = new ModulosController();
?>
<aside id="sidebar-left" class="sidebar-left">
				
    <div class="sidebar-header">
        <div class="sidebar-title">
            Menú
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                <?php 
                $raiz = $modulo->getCarpetasId('0', '');
                if(!is_null($raiz)){
                    foreach($raiz as $seccion){
                        $modulo->subcarpetasMenu($seccion,$fileName);
                    }
                }
                ?>
                </ul>
            </nav>
        </div>
    </div>
</aside>
<script>
    $( document ).ready(function() {
        elemento = $('.nav_active');
        html = '';
        while(elemento.parent().get(0).className !== 'nav nav-main'){
            if(elemento.parent().get(0).className == 'nav-parent'){
                html = '<li><span>'+ $.trim(elemento.parent().get(0).innerText).split('\n')[0] + '</span></li>' + html;
            }
            elemento.parent().addClass('nav-expanded nav_active');
            elemento = elemento.parent();
        }
        $('.breadcrumbs').html('');
        $('.breadcrumbs').html('<li><a href="index.html"><i class="fa fa-home"></i></a></li>'+html +'<li><span>' + $('#here').text() + '</span></li>');
        $('.page-header h2').html('');
        $('.page-header h2').html($('#here').text());
    })
</script>