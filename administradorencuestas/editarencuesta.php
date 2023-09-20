<?php

    $index = explode('/', $_SERVER['PHP_SELF']);
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.$index[1].'/';

    require_once $path.'src/controller/encuestasController.php';
    use Src\Controller\EncuestasController;
    $encuestas = new EncuestasController();

    if (isset($_POST['test']) AND isset($_POST['id']) AND is_numeric($_POST['id'])) {

        $response = $encuestas->editarEncuesta($_POST['test'], $_POST['id']);
    } else {

        $response = 400;
    }

    echo json_encode($response);

?>