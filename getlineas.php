<?php
include 'db_connection.php';

$sql = "SELECT * FROM LineasTelefonicas";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Asegurarse de enviar los datos como un objeto con la clave "data"
// dado que DataTables espera este formato por defecto.
echo json_encode(array("data" => $data));

$stmt->close();
$conn->close();
?>
