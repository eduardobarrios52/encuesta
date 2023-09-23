<?php

    $index = explode('/', $_SERVER['PHP_SELF']);
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.$index[1].'/';

    require_once $path.'src/controller/encuestasController.php';
    use Src\Controller\EncuestasController;
    $encuestas = new EncuestasController();

    if (isset($_POST['test']) AND isset($_POST['question']) AND isset($_POST['tipo']) AND is_numeric($_POST['test']) AND is_numeric($_POST['tipo'])) {

        if ($_POST['tipo'] == 3) {

            $response = $encuestas->agregarPregunta($_POST['question'], Array(), $_POST['tipo'], $_POST['test'], 0);
        } else {

            if (isset($_POST['responses']) AND is_array($_POST['responses']) AND isset($_POST['formresp']) AND is_numeric($_POST['formresp']) AND $_POST['formresp'] > 0) {

                $response = $encuestas->agregarPregunta($_POST['question'], $_POST['responses'], $_POST['tipo'], $_POST['test'], $_POST['formresp']);
            } else {

                $response = 400;
            }
        }
    } else {

        $response = 400;
    }

    echo json_encode($response);

?>