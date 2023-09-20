<?php 
@session_start();
$_SESSION["nombre"] = NULL;
$_SESSION["puesto"] = NULL;
$_SESSION["id"] = NULL;
$_SESSION['access'] = false;
session_destroy();
@header('Location: index.php');
?>