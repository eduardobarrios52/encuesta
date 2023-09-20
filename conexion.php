<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function conectar(){
    $conexion = odbc_connect("julian","SYSDES2","URSUS71",SQL_CUR_USE_IF_NEEDED);
     //$conexion = odbc_pconnect("julian","SYSDES1","GC271208",SQL_CUR_USE_IF_NEEDED);
     //$conexion = odbc_pconnect("julian","","gc271208",SQL_CUR_USE_IF_NEEDED);
     //$conexion = odbc_pconnect("julian", "cteweb", "sinuberase", SQL_CUR_USE_IF_NEEDED)or die("No se pudo conectar con la base de datos");
     return $conexion;
}
function desconectar($conexion){
    odbc_close($conexion);
}

function conectarMysql(){
    $mysqli = new mysqli('172.16.60.44', 'root', 'sysTJO3', 'paginatjo');
    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_error);
        exit();
    }
    return $mysqli;
}

function desconectarMysql($mysqli){
    $mysqli->close();
}