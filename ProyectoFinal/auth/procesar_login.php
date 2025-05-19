<?php
session_start();
include '../includes/conexion.php';

$email = $_POST['email'];
$password = $_POST['password'];

//Verificacion de datos
if(empty($email) || empty($password)){
    header("Location: ../index.php?error=campos_vacios");
}

//Procesamiento de login del usuario
$sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

//Verificacion de usuario en el login
if($result->num_rows == 1){
    $usuario = $result->fetch_assoc();

    if(password_verify($password, $usuario['password'])){
        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['email'] = $usuario['email'];
        header("Location: ../home/index.php");
        exit();
    }
}

header("Location: ../index.php?error=credenciales_invalidas");
exit();
?>