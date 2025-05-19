<?php
include '../../includes/conexion.php';
header('Content-Type: application/json');

//Se recibe el JSON con el 'id' del habito a desactivar
$data = json_decode(file_get_contents("php://input"));

//Se prepara el SQL para desactivar el habito
$stmt = $conn->prepare("UPDATE habitos SET estatus_id = 5 WHERE id = ?");
$stmt->bind_param("i", $data->id_habito);
$response = [];
if($stmt->execute()){
    $response["success"] = true;
}else{
    $response["success"] = false;
    $response["error"] = $stmt->error;
}

echo json_encode($response);
?>