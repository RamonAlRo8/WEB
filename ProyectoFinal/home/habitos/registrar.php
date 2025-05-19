<?php
include '../../includes/conexion.php';
header('Content-Type: application/json');

//Leecgtor de JSON recibidos de JS
$data = json_decode(file_get_contents("php://input"));

//Preparacion de la insercion a la tabla en la base de datos
$query = "INSERT INTO habitos (usuario_id, nombre, frecuencia, estatus_id) VALUES (?, ?, ?, 1)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $data->id_usuario, $data->nombre, $data->frecuencia);

echo json_encode(["success" => $stmt->execute()]);
?>