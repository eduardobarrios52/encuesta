<?php
require_once 'src/controller/modulosController.php';
require_once 'src/controller/connectController.php';
use Src\Controller\ConnectControllerOdbc;
use Src\Controller\ModulosController;
$modulo = new ModulosController();
$connect = new ConnectControllerOdbc();

set_time_limit(0);
if (isset($_SESSION['access']) == true) {
    header('Location: inicio.php');
} else {

    $alfnum = "/^[a-z.&A-Z0-9ñÑ_*]{1,25}$/";
    $c = 0;
    if (preg_match($alfnum, isset($_POST["usuario"]))) {
        $usuario = $_POST["usuario"];

        if (isset($_POST["contra"])) {

            $password = utf8_decode($_POST['contra']);

            $contra = '';

            for($i=0;$i<strlen($password);$i++){
                $contra = $contra."".chr(~(ord($password[$i])));
            }

            $consulta = $connect->executeSQL('SELECT u.cve_usr,u.PASSWD,u.nombre,u.usuario as usuario, e.cve_emp, e.cve_dep,e.cve_ofi, o.descr as nom_ofi, p.nombre as puesto, c.nombre as nom_cia FROM usuarios u 
            inner join empleados e on e.cve_emp =u.cve_emp inner join puestos p on p.cve_pto = e.cve_pto inner join oficinas o on o.cve_ofi = e.cve_ofi inner join cias c on c.cve_cia = e.cve_cia
            where  u.USUARIO=\'' . $usuario . '\' AND u.PASSWD=\'' . $contra . '\' and u.status=\'A\' and e.cve_cia=1',0);
            
            if ($consulta) {

                session_start();
                $_SESSION['access'] = true;
                $_SESSION['id'] = $consulta->CVE_USR;
                $_SESSION['usuario'] = $consulta->USUARIO;
                $_SESSION['idofi'] = $consulta->CVE_OFI;
                $_SESSION['iddep'] = trim($consulta->CVE_DEP);
                $_SESSION['puesto'] = trim($consulta->PUESTO);
                $_SESSION['nombre'] = trim($consulta->NOMBRE);
                $_SESSION['nom_ofi'] = trim($consulta->NOM_OFI);
                $_SESSION['idemp'] = $consulta->CVE_EMP;
                $_SESSION['idcia'] = 1;
                $_SESSION['nom_cia'] = trim($consulta->NOM_CIA);
                $_SESSION['oficinas'] = $modulo->getOficinasbyUser($consulta->CVE_USR);
                $_SESSION['cias'] = $modulo->getCias();
                $_SESSION['permisos'] = $modulo->getPermisosModulosUsr($consulta->CVE_USR, $_SESSION['idofi'],$_SESSION['idcia']);
                
                header('Location: inicio.php');
            } else {
                header('Location: index.php');
            }

        } else {
            header('Location: index.php');
        }
    } else {
        header('Location: index.php');
    }
}
?>