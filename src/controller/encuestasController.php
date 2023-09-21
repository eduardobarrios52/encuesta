<?php

    namespace Src\Controller;

    header('Content-type: text/html; charset=utf-8');
    set_time_limit(0);

    $index = explode('/', $_SERVER['PHP_SELF']);
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.$index[1];
    require_once $path.'/src/controller/connectControllerMysql.php';
    use Src\Controller\ConnectControllerMysql;

    require_once($path.'/config.php');

    class EncuestasController{
        private $mysql;

        public function __construct()
        {
            $this->mysql = new ConnectControllerMysql('encuestas');
        }

        public function getEncuestas(){

            if(!isset($_SESSION)) {

                session_start();
            }

            $encuesta = null;

            //$encuesta = $this->mysql->executeSQL("SELECT H.H_CVE_ENC, H.NOMBRE FROM H_ENC H INNER JOIN EMPLEADOS E ON E.CVE_DEP = H.CVE_DEP AND E.STATUS = 'A' AND E.CVE_CIA = '".$_SESSION['idcia']."' INNER JOIN USUARIOS U ON U.CVE_EMP = E.CVE_EMP AND U.STATUS = 'A' AND U.CVE_USR = '".$_SESSION['id']."' WHERE H.STATUS = 'A' AND H.CVE_OFI = '".$_SESSION['idofi']."' AND H.CVE_CIA = '".$_SESSION['idcia']."'", 0);
            $encuesta = $this->mysql->executeSQL("SELECT H.H_CVE_ENC, H.NOMBRE FROM H_ENC H INNER JOIN EMPLEADOS E ON E.CVE_DEP = H.CVE_DEP AND E.STATUS = 'A' AND E.CVE_CIA = '".$_SESSION['idcia']."' INNER JOIN USUARIOS U ON U.CVE_EMP = E.CVE_EMP AND U.STATUS = 'A' AND U.CVE_USR = '".$_SESSION['id']."' WHERE H.STATUS = 'A' AND H.CVE_OFI = '".$_SESSION['idofi']."' AND H.CVE_CIA = '".$_SESSION['idcia']."'", 0);

            if ($encuesta) {

                $encuesta = $this->encodeGetEncuestas($encuesta);
            }

            return $encuesta;
        }

        public function getPreguntas($test){

            $preguntas = null;

            $preguntas = $this->mysql->executeSQL("SELECT H.H_CVE_PREG, H.NOMBRE, VALOR FROM H_PREG H WHERE H.STATUS = 'A' AND H.H_CVE_ENC = '".$test."'", 0);

            if ($preguntas) {

                $preguntas = $this->encodeGetPreguntas($preguntas);
            }

            return $preguntas;
        }

        public function getLink($test){

            if(!isset($_SESSION)) {

                session_start();
            }

            $encuesta = null;

            $encuesta = $this->mysql->executeSQL("SELECT H.H_CVE_ENC FROM H_ENC H 
            INNER JOIN EMPLEADOS E ON E.CVE_DEP = H.CVE_DEP AND E.STATUS = 'A' AND E.CVE_CIA = '".$_SESSION['idcia']."' INNER JOIN USUARIOS U ON U.CVE_EMP = E.CVE_EMP AND U.STATUS = 'A' AND U.CVE_USR = '".$_SESSION['id']."' WHERE H.STATUS = 'A' AND H.CVE_OFI = '".$_SESSION['idofi']."' AND H.CVE_CIA = '".$_SESSION['idcia']."' AND H_CVE_ENC = '".$test."'", 0);

            if ($encuesta) {

                $encuesta = $this->serviceslink($test);
            } else {

                $encuesta['CODE'] = 400;
            }
            return $encuesta;
        }

        public function getEditarPregunta($question, $idq) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $response = null;

            $preguntas = $this->mysql->executeSQL("UPDATE H_PREG SET NOMBRE = '".utf8_decode($question)."', FEC_REG = CURRENT_TIMESTAMP, CVE_USR = 1 WHERE STATUS = 'A' AND H_CVE_PREG = '".$idq."'", 1);

            if ($preguntas) {

                $test = $this->mysql->executeSQL("SELECT H_CVE_ENC FROM H_PREG WHERE STATUS = 'A' AND H_CVE_PREG = '".$idq."'", 0);

                $response['code'] = 200;
                $response['test'] = $test->H_CVE_ENC;
            }

            return $response;
        }

        public function getEliminarPregunta($idq) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $response = null;

            $preguntas = $this->mysql->executeSQL("UPDATE H_PREG SET STATUS = 'B', FEC_REG = CURRENT_TIMESTAMP, CVE_USR = 1 WHERE STATUS = 'A' AND H_CVE_PREG = '".$idq."'", 1);
            $respuestas = $this->mysql->executeSQL("UPDATE D_PREG SET STATUS = 'B', FEC_REG = CURRENT_TIMESTAMP, CVE_USR = 1 WHERE STATUS = 'A' AND H_CVE_PREG = '".$idq."'", 1);

            if ($preguntas) {

                $test = $this->mysql->executeSQL("SELECT H_CVE_ENC FROM H_PREG WHERE STATUS = 'B' AND H_CVE_PREG = '".$idq."'", 0);

                $response['code'] = 200;
                $response['test'] = $test->H_CVE_ENC;
            }

            return $response;
        }

        private function getRespuestasByQuestion($question){

            $respuestas = null;

            $respuestas = $this->mysql->executeSQL("SELECT D.H_D_PREG, D.RESP, D.VALOR FROM D_PREG D WHERE D.STATUS = 'A' AND D.H_CVE_PREG = '".$question."'", 0);

            if ($respuestas) {

                $respuestas = $this->encodeGetRespuestasByQuestion($respuestas);
            }

            return $respuestas;
        }

        public function getTiposRespuestas(){

            $respuesta = null;

            $respuesta = $this->mysql->executeSQL("SELECT (CLAVE - TIPO) CLAVE, DESCR FROM CATCAT WHERE STS_REG = 'A' AND TIPO = 33100", 0);

            return $respuesta;
        }

        public function getTipoRespuesta($response){

            $respuesta = null;

            $respuesta = $this->mysql->executeSQL("SELECT (CLAVE - TIPO) CLAVE FROM CATCAT WHERE STS_REG = 'A' AND TIPO = 33100 AND CLAVE = (TIPO + '".$response."')", 0);

            if ($respuesta) {

                if ($respuesta->CLAVE == 1) {

                    $respuesta = '<div class="table-responsive">'.
                                    '<table class="table table-striped mb-none" id="table-respuestas">'.
                                        '<thead>'.
                                            '<tr>'.
                                                '<th>Respuesta</th>'.
                                                '<th> <button type="button" class="mb-xs mt-xs mr-xs btn btn-success" onclick="agregarRespuesta('.$respuesta->CLAVE.');"><i class="fa fa-plus" style="color: #fff;"></i></button> </th>'.
                                            '</tr>'.
                                        '</thead>'.
                                        '<tbody id="tbody-respuestas" data-id="1">'.
                                        '</tbody>'.
                                    '</table>'.
                                '</div>';
                } else if ($respuesta->CLAVE == 3) {

                    $respuesta = '<div class="table-responsive">'.
                                    '<table class="table table-striped mb-none" id="table-respuestas">'.
                                        '<thead>'.
                                            '<tr>'.
                                                '<th>Respuesta</th>'.
                                                '<th>Valor</th>'.
                                                '<th> <button type="button" class="mb-xs mt-xs mr-xs btn btn-success" onclick="agregarRespuesta('.$respuesta->CLAVE.');"><i class="fa fa-plus" style="color: #fff;"></i></button> </th>'.
                                            '</tr>'.
                                        '</thead>'.
                                        '<tbody id="tbody-respuestas" data-id="1">'.
                                        '</tbody>'.
                                    '</table>'.
                                '</div>';
                } else {

                    $respuesta = '';
                }
            }

            return $respuesta;
        }

        public function getGrafica($idq) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $response = null;

            $preguntas = $this->mysql->executeSQL("SELECT H_CVE_PREG, NOMBRE FROM H_PREG WHERE STATUS = 'A' AND TIPO_REG <> 2 AND H_CVE_PREG = '".$idq."'", 0);

            if ($preguntas) {

                $respuestas = $this->mysql->executeSQL("SELECT H.H_D_PREG, COUNT(H.H_D_PREG) TOTAL, D.RESP FROM H_RESP H INNER JOIN D_PREG D ON H.H_D_PREG = D.H_D_PREG AND D.STATUS = 'A' WHERE H.STATUS = 'A' AND H.H_CVE_PREG = '".$idq."' GROUP BY H.H_D_PREG", 0);

                if ($respuestas) {

                    $response['code'] = 200;
                    $response['response'] = $this->encodeGetRespuestasByGrafica($respuestas);
                    $response['question'] = trim(utf8_encode($preguntas->NOMBRE));
                } else {

                    $response['code'] = 401;
                    $response['response'] = false;
                    $response['question'] = trim(utf8_encode($preguntas->NOMBRE));
                }
            }

            return $response;
        }

        public function agregarEncuesta($descr) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $encuesta = null;

            $encuesta = $this->mysql->executeSQL("INSERT INTO H_ENC ( H_CVE_ENC, CVE_OFI, NOMBRE, CVE_DEP, CVE_USR, FECHA, FEC_REG, STATUS) 
            VALUES ( (SELECT CASE WHEN MAX(H.H_CVE_ENC) IS NULL THEN 1 ELSE MAX(H.H_CVE_ENC) + 1 END FROM H_ENC H), '1', '".utf8_decode($descr)."', 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'A')", 1);

            if ($encuesta) {

                $encuesta = 200;
            }

            return $encuesta;
        }

        public function editarEncuesta($test, $ide) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $encuesta = null;

            $valide = $this->mysql->executeSQL("SELECT H_CVE_ENC FROM H_ENC WHERE STATUS = 'A' AND H_CVE_ENC = '".$ide."'", 0);

            if ($valide) {

                $encuesta = $this->mysql->executeSQL("UPDATE H_ENC SET NOMBRE = '".utf8_decode($test)."', CVE_USR = 1, FEC_REG = CURRENT_TIMESTAMP WHERE STATUS = 'A' AND H_CVE_ENC = '".$ide."'", 1);

                if ($encuesta) {

                    $encuesta = 200;
                }
            } else {

                $encuesta = 400;
            }

            return $encuesta;
        }

        public function eliminarEncuesta($ide) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $encuesta = null;

            $valide = $this->mysql->executeSQL("SELECT H_CVE_ENC FROM H_ENC WHERE STATUS = 'A' AND H_CVE_ENC = '".$ide."'", 0);

            if ($valide) {

                $encuesta = $this->mysql->executeSQL("UPDATE H_ENC SET STATUS = 'B', CVE_USR = 1, FEC_REG = CURRENT_TIMESTAMP WHERE STATUS = 'A' AND H_CVE_ENC = '".$ide."'", 1);

                $preguntas = $this->mysql->executeSQL("SELECT H_CVE_PREG FROM H_PREG WHERE STATUS = 'A' AND H_CVE_ENC = '".$ide."'", 0);

                $pregunta = $this->mysql->executeSQL("UPDATE H_PREG SET STATUS = 'B', CVE_USR = 1, FEC_REG = CURRENT_TIMESTAMP WHERE STATUS = 'A' AND H_CVE_ENC = '".$ide."'", 1);

                if ($preguntas) {

                    if (is_array($preguntas)) {

                        foreach ($preguntas as $item) {

                            $respuestas = $this->mysql->executeSQL("UPDATE D_PREG SET STATUS = 'B', CVE_USR = 1, FEC_REG = CURRENT_TIMESTAMP WHERE STATUS = 'A' AND H_CVE_PREG = '".$item->H_CVE_PREG."'", 1);
                        }
                    } else {

                        $respuestas = $this->mysql->executeSQL("UPDATE D_PREG SET STATUS = 'B', CVE_USR = 1, FEC_REG = CURRENT_TIMESTAMP WHERE STATUS = 'A' AND H_CVE_PREG = '".$preguntas->H_CVE_PREG."'", 1);
                    }
                }

                if ($encuesta) {

                    $encuesta = 200;
                }
            } else {

                $encuesta = 400;
            }

            return $encuesta;
        }

        public function agregarRespuesta($response, $valor, $id) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $resp = null;

            $valide = $this->mysql->executeSQL("SELECT H_CVE_PREG, TIPO_REG FROM H_PREG WHERE STATUS = 'A' AND H_CVE_PREG = '".$id."'", 0);

            if ($valide) {

                if ($valide->TIPO_REG == 3) {

                    $respuesta = $this->mysql->executeSQL("INSERT INTO D_PREG (H_D_PREG, H_CVE_PREG, RESP, CVE_USR, FEC_REG, STATUS, VALOR) 
                    VALUES ((SELECT CASE WHEN MAX(D.H_D_PREG) IS NULL THEN 1 ELSE MAX(D.H_D_PREG) + 1 END FROM D_PREG D), '".$id."', '".utf8_decode($response)."', '1', CURRENT_TIMESTAMP, 'A', '".$valor."')", 1);
                } else {

                    $respuesta = $this->mysql->executeSQL("INSERT INTO D_PREG (H_D_PREG, H_CVE_PREG, RESP, CVE_USR, FEC_REG, STATUS) VALUES 
                    ((SELECT CASE WHEN MAX(D.H_D_PREG) IS NULL THEN 1 ELSE MAX(D.H_D_PREG) + 1 END FROM D_PREG D), '".$id."', '".utf8_decode($response)."', '1', CURRENT_TIMESTAMP, 'A')", 1);
                }

                if ($respuesta) {

                    $test = $this->mysql->executeSQL("SELECT H.H_CVE_ENC FROM H_PREG H WHERE STATUS = 'A' AND H_CVE_PREG = '".$id."'", 0);

                    $resp['code'] = 200;
                    $resp['test'] = $test->H_CVE_ENC;
                }
            } else {

                $resp['code'] = 400;
                $resp['test'] = 0;
            }

            return $resp;
        }

        public function editarRespuesta($response, $valor, $id) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $resp = null;

            $valide = $this->mysql->executeSQL("SELECT H_CVE_PREG FROM D_PREG WHERE STATUS = 'A' AND H_D_PREG = '".$id."'", 0);

            if ($valide) {

                $tipo = $this->mysql->executeSQL("SELECT TIPO_REG FROM H_PREG WHERE STATUS = 'A' AND H_CVE_PREG = '".$valide->H_CVE_PREG."'", 0);

                if ($tipo->TIPO_REG == 3) {

                    $respuestas = $this->mysql->executeSQL("UPDATE D_PREG SET RESP = '".utf8_decode($response)."', VALOR = '".$valor."', CVE_USR = '1', FEC_REG = CURRENT_TIMESTAMP WHERE STATUS = 'A' AND H_D_PREG = '".$id."'", 1);
                } else {

                    $respuestas = $this->mysql->executeSQL("UPDATE D_PREG SET RESP = '".utf8_decode($response)."', CVE_USR = '1', FEC_REG = CURRENT_TIMESTAMP WHERE STATUS = 'A' AND H_D_PREG = '".$id."'", 1);
                }

                if ($respuestas) {

                    $test = $this->mysql->executeSQL("SELECT H.H_CVE_ENC FROM D_PREG D INNER JOIN H_PREG H ON D.H_CVE_PREG = H.H_CVE_PREG AND H.STATUS = 'A' WHERE D.STATUS = 'A' AND D.H_D_PREG = '".$id."'", 0);

                    $resp['code'] = 200;
                    $resp['test'] = $test->H_CVE_ENC;
                }
            } else {

                $resp['code'] = 400;
                $resp['test'] = 0;
            }

            return $resp;
        }

        public function eliminarRespuesta($id) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $resp = null;

            $valide = $this->mysql->executeSQL("SELECT H_CVE_PREG FROM D_PREG WHERE STATUS = 'A' AND H_D_PREG = '".$id."'", 0);

            if ($valide) {

                $respuestas = $this->mysql->executeSQL("UPDATE D_PREG SET STATUS = 'B', CVE_USR = '1', FEC_REG = CURRENT_TIMESTAMP WHERE STATUS = 'A' AND H_D_PREG = '".$id."'", 1);

                if ($respuestas) {

                    $test = $this->mysql->executeSQL("SELECT H.H_CVE_ENC FROM D_PREG D INNER JOIN H_PREG H ON D.H_CVE_PREG = H.H_CVE_PREG AND H.STATUS = 'A' WHERE D.STATUS = 'B' AND D.H_D_PREG = '".$id."'", 0);

                    $resp['code'] = 200;
                    $resp['test'] = $test->H_CVE_ENC;
                }
            } else {

                $resp['code'] = 400;
                $resp['test'] = 0;
            }

            return $resp;
        }

        public function agregarPregunta($question, $reponses, $tipo, $test, $forma) {

            if(!isset($_SESSION)) {

                session_start();
            }

            $pregunta = null;

            $idpreg = $this->mysql->executeSQL("SELECT CASE WHEN MAX(H_CVE_PREG) IS NULL THEN 1 ELSE MAX(H_CVE_PREG) + 1 END MAXIMO FROM H_PREG", 0);

            $pregunta = $this->mysql->executeSQL("INSERT INTO H_PREG (H_CVE_PREG, H_CVE_ENC, NOMBRE, TIPO_REG, CVE_USR, FECHA, FEC_REG, STATUS, VALOR) VALUES ('".$idpreg->MAXIMO."', '".$test."', '".utf8_decode($question)."', '".$tipo."', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'A', '".$forma."')", 1);

            if ($pregunta) {

                if (count($reponses) > 0) {

                    for ($i=0; $i < count($reponses); $i++) {

                        if ($tipo == 3) {

                            $respuesta = $this->mysql->executeSQL("INSERT INTO D_PREG (H_D_PREG, H_CVE_PREG, RESP, CVE_USR, FEC_REG, STATUS, VALOR) 
                            VALUES ((SELECT CASE WHEN MAX(D.H_D_PREG) IS NULL THEN 1 ELSE MAX(D.H_D_PREG) + 1 END FROM D_PREG D), '".$idpreg->MAXIMO."', '".utf8_decode($reponses[$i]['response'])."', '1', CURRENT_TIMESTAMP, 'A', '".$reponses[$i]['value']."')", 1);
                        } else {

                            $respuesta = $this->mysql->executeSQL("INSERT INTO D_PREG (H_D_PREG, H_CVE_PREG, RESP, CVE_USR, FEC_REG, STATUS) 
                            VALUES ((SELECT CASE WHEN MAX(D.H_D_PREG) IS NULL THEN 1 ELSE MAX(D.H_D_PREG) + 1 END FROM D_PREG D), '".$idpreg->MAXIMO."', '".utf8_decode($reponses[$i]['response'])."', '1', CURRENT_TIMESTAMP, 'A')", 1);
                        }

                        if (!$respuesta) {

                            $preguntaremove = $this->mysql->executeSQL("UPDATE H_PREG SET STATUS = 'B' WHERE H_CVE_PREG = '".$idpreg->MAXIMO."'", 1);
                            $respuestaremove = $this->mysql->executeSQL("UPDATE D_PREG SET STATUS = 'B' WHERE H_CVE_PREG = '".$idpreg->MAXIMO."'", 1);

                            return false;
                        }
                    }
                }

                $pregunta = 200;
            }

            return $pregunta;
        }

        private function encodeGetEncuestas($data) {

            if (is_array($data)) {

                $response = Array();

                foreach ($data as $item) {

                    $obj = new \stdClass();

                    $obj->H_CVE_ENC = $item->H_CVE_ENC;
                    $obj->NOMBRE = trim(utf8_encode($item->NOMBRE));

                    $response[\count($response)] = $obj;
                }

                return $response;
            } else {

                $response = new \stdClass();

                $response->H_CVE_ENC = $data->H_CVE_ENC;
                $response->NOMBRE = trim(utf8_encode($data->NOMBRE));

                return Array($response);
            }
        }

        private function encodeGetPreguntas($data) {

            if (is_array($data)) {

                $response = Array();

                foreach ($data as $item) {

                    $obj = new \stdClass();

                    $obj->H_CVE_PREG = $item->H_CVE_PREG;
                    $obj->NOMBRE = trim(utf8_encode($item->NOMBRE));
                    $obj->TIPO = trim($item->TIPO);
                    $obj->FORMA = trim(($item->VALOR == 2) ? 'LISTA' : 'LINEAL');
                    $obj->RESPONSES = $this->getRespuestasByQuestion($item->H_CVE_PREG);

                    $response[\count($response)] = $obj;
                }

                return $response;
            } else {

                $response = new \stdClass();

                $response->H_CVE_PREG = $data->H_CVE_PREG;
                $response->NOMBRE = trim(utf8_encode($data->NOMBRE));
                //$response->TIPO = trim($data->TIPO);
                $response->FORMA = trim(($data->VALOR == 2) ? 'LISTA' : 'LINEAL');
                $response->RESPONSES = $this->getRespuestasByQuestion($data->H_CVE_PREG);

                return Array($response);
            }
        }

        private function encodeGetRespuestasByQuestion($data) {

            if (is_array($data)) {

                $response = Array();

                foreach ($data as $item) {

                    $obj = new \stdClass();

                    $obj->H_D_PREG = $item->H_D_PREG;
                    $obj->RESP = trim(utf8_encode($item->RESP));
                    $obj->VALOR = trim($item->VALOR);

                    $response[\count($response)] = $obj;
                }

                return $response;
            } else {

                $response = new \stdClass();

                $response->H_D_PREG = $data->H_D_PREG;
                $response->RESP = trim(utf8_encode($data->RESP));
                $response->VALOR = trim($data->VALOR);

                return Array($response);
            }
        }

        private function encodeGetRespuestasByGrafica($data) {

            if (is_array($data)) {

                $response = Array();
                $TOTAL = 0;

                foreach ($data as $item) {

                    $TOTAL = intval($TOTAL) + intval($item->TOTAL);
                }

                foreach ($data as $item) {

                    $obj = new \stdClass();

                    $obj->H_D_PREG = $item->H_D_PREG;
                    $obj->RESP = trim($item->RESP);
                    $obj->VALOR = $item->TOTAL;
                    $obj->PORCENTAJE = number_format(floatval(intval($item->TOTAL) * 100) / intval($TOTAL), 2, '.', '');
                    $obj->TOTAL = $TOTAL;

                    $response[\count($response)] = $obj;
                }

                return $response;
            } else {

                $response = new \stdClass();

                $response->H_D_PREG = $data->H_D_PREG;
                $response->RESP = trim($data->RESP);
                $response->VALOR = $data->TOTAL;
                $response->PORCENTAJE = 100.00;
                $response->TOTAL = $data->TOTAL;

                return Array($response);
            }
        }

        private function serviceslink($test) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://bd.juliandeobregon.com.mx/api/test?ZXlKUVFVZEZJam9pZEdWemRDSjkuODJhYTc2ODZlNDRiZDE4YmY5ODFlNWViMTM1Mzk4ZDIwMTY3OGE2NzYxMmUzMGFkMDBiMGI2YzU0NTkwMmJlMg7a17Y7a17Y',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('test' => $test),
            ));

            $response = curl_exec($curl);

            $err = curl_error($curl);

            if ($err) {

                $response = 500;
            }

            curl_close($curl);
            return json_decode($response);
        }
    }
?>