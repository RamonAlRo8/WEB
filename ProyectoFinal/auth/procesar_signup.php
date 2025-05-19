<?php
include '../includes/conexion.php';

//Validar datos recibidos
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = 'usuario';


if(empty($nombre) || empty($email) || empty($password)){
    header("Location: ../signup.php?error=campos_vacios");
    exit();
}

//Validacion de correo
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../signup.php?error=email_invalido");
    exit();
}

//Validacion de password
if(strlen($password) < 8){
    header("Location: ../signup.php?error=contrasena_corta");
    exit();
}

//Verificacio de correos duplicados
$sql_check = "SELECT id FROM usuarios WHERE email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0){
    header("Location: ../signup.php?error=email_duplicado");
    exit();
}

//Insercion de nuevos usuarios a la base de datos
$sql = "INSERT INTO usuarios (nombre, email, password, rol, insignia_id, estatus_id)
        VALUES (?, ?, ?, ?, 1, 1)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombre, $email, $password, $rol);

if($stmt->execute()){
    header("Location: ../index.php?registro=exitoso");
}else{
    header("Location: ../signup.php?error=fallo_registro");
}
?>