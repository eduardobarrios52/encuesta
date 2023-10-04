<?php
include 'db_connection.php';

$numero = $_POST['Numero_Telefonico'];
$tipo = $_POST['Tipo_Linea'];
$fecha_activacion = $_POST['Fecha_Activacion'];
$fecha_desactivacion = isset($_POST['Fecha_Desactivacion']) && !empty($_POST['Fecha_Desactivacion']) ? $_POST['Fecha_Desactivacion'] : NULL;
$id_usuario = $_POST['ID_Usuario'];
$operador = $_POST['Operador'];
$plan = isset($_POST['Plan_Contratado']) && !empty($_POST['Plan_Contratado']) ? $_POST['Plan_Contratado'] : NULL;
$estado = $_POST['Estado_Linea'];
$comentarios = isset($_POST['Comentarios']) && !empty($_POST['Comentarios']) ? $_POST['Comentarios'] : NULL;

if(isset($_POST['ID_Linea']) && $_POST['ID_Linea']) {
    $id = $_POST['ID_Linea'];
    $stmt = $conn->prepare("UPDATE LineasTelefonicas SET Numero_Telefonico=?, Tipo_Linea=?, Fecha_Activacion=?, Fecha_Desactivacion=?, ID_Usuario=?, Operador=?, Plan_Contratado=?, Estado_Linea=?, Comentarios=? WHERE ID_Linea=?");
    $stmt->bind_param("ssssissssi", $numero, $tipo, $fecha_activacion, $fecha_desactivacion, $id_usuario, $operador, $plan, $estado, $comentarios, $id);
} else {
    $stmt = $conn->prepare("INSERT INTO LineasTelefonicas (Numero_Telefonico, Tipo_Linea, Fecha_Activacion, Fecha_Desactivacion, ID_Usuario, Operador, Plan_Contratado, Estado_Linea, Comentarios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssissss", $numero, $tipo, $fecha_activacion, $fecha_desactivacion, $id_usuario, $operador, $plan, $estado, $comentarios);
}

if ($stmt->execute()) {
    echo "Registro actualizado con éxito.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
