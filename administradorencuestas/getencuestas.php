<?php

    $index = explode('/', $_SERVER['PHP_SELF']);
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.$index[1].'/';

    require_once $path.'src/controller/encuestasController.php';
    use Src\Controller\EncuestasController;
    $encuestas = new EncuestasController();

    $response = $encuestas->getEncuestas();

    echo json_encode($response);

?>