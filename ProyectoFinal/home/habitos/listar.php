<?php
include '../../includes/conexion.php';
header('Content-Type: application/json');

if(!isset($_GET['id_usuario'])){
    echo json_encode(["error" => "falta el parametro del ID"]);
    exit();
}

$id_usuario = $_GET['id_usuario'];
$stmt = $conn->prepare("SELECT * FROM habitos WHERE usuario_id = ? AND estatus_id = 1");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_all(MYSQLI_ASSOC));
?>