<?php
    session_start();

    if(!isset($_SESSION['id_usuario'])){
        //Si no hay una sesion iniciada se redirige al login
        header("Location: ../index.php");
        exit();
    }
?>