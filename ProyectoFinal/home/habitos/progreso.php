<?php
include '../../includes/conexion.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$habito_id = $data->id;
$fecha_hoy = date('Y-m-d');
$fecha_ayer = date('Y-m-d', strtotime('-1 day'));

//Verificacion de progreso de hoy
$stmt = $conn->prepare("SELECT id FROM seguimiento WHERE habito_id = ? AND fecha = ?");
$stmt->bind_param("is", $habito_id, $fecha_hoy);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo json_encode(["success" => false, "mensaje" => "Ya marcaste este hábito hoy."]);
    exit();
}

//Consultor de progreso del dia anterior para la racha
$stmt = $conn->prepare("SELECT racha FROM seguimiento WHERE habito_id = ? AND fecha = ?");
$stmt->bind_param("is", $habito_id, $fecha_ayer);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $fila = $result->fetch_assoc();
    $nueva_racha = $fila['racha'] + 1;
}else{
    $nueva_racha = 1;
}

//Insercion del seguimiento
$stmt = $conn->prepare("INSERT INTO seguimiento (habito_id, fecha, racha, estatus_id) VALUES (?, ?, ?, 4)");
$stmt->bind_param("isi", $habito_id, $fecha_hoy, $nueva_racha);
$success = $stmt->execute();

if($success){
    echo json_encode(["success" => true, "racha" => $nueva_racha]);
}else{
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>