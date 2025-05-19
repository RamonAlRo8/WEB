<?php
include '../../includes/conexion.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$id = $data->id_usuario;
$nombre = trim($data->nombre);
$password = trim($data->password);

//VALIDACIONES BASICAS
if(!$id || !$nombre){
    echo json_encode(["success" => false, "error" => "Datos incompletos"]);
    exit();
}

if($password !== ""){
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nombre, $passwordHash, $id);
}else{
    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ? WHERE id = ?");
    $stmt->bind_param("si", $nombre, $id);
}

//ACTUALIZACION DEL SITIO
if($stmt->execute()){
    session_start();
    $_SESSION['nombre'] = $nombre;
    echo json_encode(["success" => true]);
}else{
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>