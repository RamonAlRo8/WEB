<?php
include '../../includes/conexion.php';
header('Content-Type: application/json');

//Verificacion de id del usuario
$id_usuario =$_GET['id_usuario'] ?? null;
if(!$id_usuario){
    echo json_encode(["error" => "Falta id del usuario."]);
    exit();
}

//Obtenemos los habitos del usuario por el id
$stmt = $conn->prepare("SELECT id, nombre FROM habitos WHERE usuario_id = ? AND estatus_id = 1");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$habitos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

//Ultimos 7 dias
$fechas = [];
for($i = 6; $i >= 0; $i--){
    $fechas[] = date('Y-m-d', strtotime("-$i  days"));
}

//Progreso
$datos = [];
$totalCompletados = 0;
$rachaMaxima = 0;
$constante = ["nombre" => "", "conteo" => 0];

foreach($habitos as $h){
    $valores = [];
    $conteoHabito = 0;
    foreach($fechas as $fecha){
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM seguimiento WHERE habito_id = ? AND fecha = ? AND estatus_id = 1");
        $stmt->bind_param("is", $h['id'], $fecha);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $cantidad = isset($result['total']) ? (int)$result['total']: 0;
        $valores[] = $cantidad;
        $totalCompletados += $cantidad;
        $conteoHabito += $cantidad;
    }

    //Busca la racha maxima para el habito
    $stmt = $conn->prepare("SELECT MAX(racha) as racha FROM seguimiento WHERE habito_id =?");
    $stmt->bind_param("i", $h['id']);
    $stmt->execute();
    $resultRacha = $stmt->get_result()->fetch_assoc();
    $racha = isset($resultRacha['racha']) ? (int)$resultRacha['racha']: 0;
    if($racha > $rachaMaxima){
        $rachaMaxima = $racha;
    }

    if($conteoHabito > $constante["conteo"]){
        $constante["nombre"] = $h['nombre'];
        $constante["conteo"] = $conteoHabito;
    }

    $datos[] = [
        "nombre" => $h['nombre'],
        "valores" => $valores
    ];
}

echo json_encode([
    "fechas" => $fechas,
    "habitos" => $datos,
    "resumen" => [
        "totalCompletados" => $totalCompletados,
        "rachaMaxima" => $rachaMaxima,
        "habitoConstante" => $constante["nombre"]
    ]
]);