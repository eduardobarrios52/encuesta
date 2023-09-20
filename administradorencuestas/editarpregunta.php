<?php

    $index = explode('/', $_SERVER['PHP_SELF']);
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.$index[1].'/';

    require_once $path.'src/controller/encuestasController.php';
    use Src\Controller\EncuestasController;
    $encuestas = new EncuestasController();

    if (isset($_POST['id']) AND isset($_POST['question']) AND is_numeric($_POST['id'])) {

        $response = $encuestas->getEditarPregunta($_POST['question'], $_POST['id']);
    } else {

        $response = 400;
    }

    echo json_encode($response);

?>