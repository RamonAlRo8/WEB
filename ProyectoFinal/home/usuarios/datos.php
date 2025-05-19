<?php
include '../../includes/conexion.php';
header('Content-Type: application/json');

$id_usuario = $_GET['id_usuario'];
if(!$id_usuario){
    echo json_encode(["error" => "Falta id del usuario"]);
    exit();
}

//RACHA MAXIMA
$stmt = $conn->prepare("SELECT MAX(racha) FROM seguimiento WHERE habito_id IN (SELECT id FROM habitos WHERE usuario_id = ?)");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$racha = $stmt->get_result()->fetch_assoc()['racha'] ?? 0;

//HABITOS ACTIVOS
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM habitos WHERE usuario_id = ? AND estatus_id = 1");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$activos = $stmt->get_result()->fetch_assoc()['total'];

//HABITOS COMPLETADOS

$stmt = $conn->prepare("SELECT COUNT(DISTINCT habito_id) as total FROM seguimiento WHERE estatus_id = 4 AND habito_id IN (SELECT id FROM habitos WHERE usuario_id = ?)");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$completados = $stmt->get_result()->fetch_assoc()['total'];

//LOGICA PARA ASIGNAR INSIGNIAS
$insignia_id = 4;
if($racha >= 10){
    $insignia_id = 5;
}elseif($completados >= 9){
    $insignia_id = 3;
}

//ACTUALIZAMOS INSIGNIAS SI AUN NO TIENE
$stmt = $conn->prepare("UPDATE usuarios SET insignia_id = ? WHERE id = ?");
$stmt->bind_param("ii", $insignia_id, $id_usuario);
$stmt->execute();

//OBTENEMOS DATOS DE INSIGNIA
$stmt = $conn->prepare("SELECT tipo FROM insignias WHERE id = ?");
$stmt->bind_param("i", $insignia_id);
$stmt->execute();
$insigniaData = $stmt->get_result()->fetch_assoc();
$insignia = $insigniaData['tipo' ?? "Sin insignias"];

echo json_encode([
    "rachaMaxima" => (int)$racha,
    "habitosActivos" => (int)$activos,
    "habitosCompletados" => (int)$completados,
    "insignia" => $insignia
]);
?>