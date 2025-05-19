<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tireless</title>
    <!-- Boostrap CSS y Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap Bundle con Popper.js (NECESARIO para los modales) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a href="../index.php" class="navbar-brand">Tireless</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" bata-ba-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- CONTENIDO  -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <i class="bi bi-house-door"></i><a href="../index.php" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="../home/habitos/index.php" class="nav-link">Hábitos</a>
                    </li>
                    <?php if ($_SESSION['rol'] === 'admin'): ?>
                        <li class="nav-item">
                            <a href="usuarios/index.php" class="nav-link">Usuarios</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <span class="navbar-text me-3">
                    <?php echo $_SESSION['nombre'] ?? 'Invitado'; ?>
                </span>
                <a href="../logout.php" class="btn btn-outline-light btm-sm">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">