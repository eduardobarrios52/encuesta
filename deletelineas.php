<?php
include 'db_connection.php';

$id = $_POST['ID_Linea'];
$sql = "update LineasTelefonicas set Estado_Linea='Inactivo',Fecha_Desactivacion=now()  WHERE ID_Linea = $id";
if($conn->query($sql)){
    echo "La linea se ha desactivado";
}else{
    echo "No se ha podido desactivar la linea";
}

$conn->close();
?>
