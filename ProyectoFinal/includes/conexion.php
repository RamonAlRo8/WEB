<?php
    $host = 'localhost';
    $dbname = 'habitos';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $dbname);
    if($conn->connect_error){
        die("Conexión fallida: " . $conn->connect_error);
    }

    try{
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    }catch(PDOException $e){
        die('Error de conexion: ' . $e->getMessage());
    }
?>