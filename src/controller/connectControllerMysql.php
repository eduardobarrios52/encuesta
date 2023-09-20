<?php
    namespace Src\Controller;

use mysqli;
$index = explode('/', $_SERVER['PHP_SELF']);
$path = $_SERVER['DOCUMENT_ROOT'].'/'.$index[1];

require_once($path.'/config.php');

    class ConnectControllerMysql{

        private $SERMY, $USRMY, $BASEMY, $PASS;

        public function __construct($BASEMY)
        {

            $this->USRMY = USRMY;
            //$this->BASEMY = BASEMY;
            $this->BASEMY = $BASEMY;
            $this->PASS = PASSMYSQL;
            $this->SERMY = SERMY;

        }

        private function connection()
        {
            $conexion = new mysqli($this->SERMY, $this->USRMY, $this->PASS, $this->BASEMY);

            if (!$conexion) {

                return die('Connection failed: '.$conexion->error());
            } else {

                return $conexion;
            }
        }

        private function closeConnect($conexion)
        {

            return $conexion->close();
        }

        public function executeSQL($query, $type)
        {

            try {

                $connect = $this->connection();

                if ($type === 0) {

                    $result = $connect->query($query);

                    if ($result) {

                        if (mysqli_num_rows($result) > 1) {

                            while ($row = mysqli_fetch_object($result)) {

                                $resultSet[] = $row;
                            }
                        } else if (mysqli_num_rows($result) == 1) {

                            if ($row = mysqli_fetch_object($result)) {

                                $resultSet = $row;
                            }
                        } else {

                            $resultSet = false;
                        }
                    } else {

                        $resultSet = false;
                    }
                } else {

                    $resultSet = $connect->query($query);
                    $resultSet = $connect->insert_id;
                }

                $this->closeConnect($connect);

                return $resultSet;
            } catch (\Exception $e) {

                return $e->getMessage();
            }
        }

        public function __destruct() {
        }
    }

?>