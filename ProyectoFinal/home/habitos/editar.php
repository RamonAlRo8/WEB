<?php
include '../../includes/conexion.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

$stmt = $conn->prepare("UPDATE habitos SET nombre = ?, frecuencia = ?, updated_at = NOW() WHERE id = ?");
$stmt->bind_param("ssi", $data->nombre, $data->frecuencia, $data->id);

$response = [];

if($stmt->execute()){
    $response["success"] = true;
}else{
    $response["success"] = false;
    $response["error"] = $stmt->error;
}

echo json_encode($response);
?>