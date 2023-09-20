<?php

    $index = explode('/', $_SERVER['PHP_SELF']);
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.$index[1].'/';

    require_once $path.'src/controller/encuestasController.php';
    use Src\Controller\EncuestasController;
    $encuestas = new EncuestasController();

    if ($_POST['type'] == 3) {

        if (isset($_POST['id']) AND isset($_POST['response']) AND is_numeric($_POST['id']) AND isset($_POST['valor'])) {

            $response = $encuestas->editarRespuesta($_POST['response'], $_POST['valor'], $_POST['id']);
        } else {

            $response = 400;
        }
    } else {

        if (isset($_POST['id']) AND isset($_POST['response']) AND is_numeric($_POST['id'])) {

            $response = $encuestas->editarRespuesta($_POST['response'], '', $_POST['id']);
        } else {

            $response = 400;
        }
    }

    echo json_encode($response);

?>