<?php
include '../includes/verificar_sesion.php';
include '../includes/header.php';
?>

<div class="text-center mb-4">
    <h1 class="fw-bold">¡Bienvenido, <?php echo $_SESSION['nombre']; ?>! 👋</h1>
    <p class="text-muted">Estás un paso más cerca de mejorar tus hábitos.</p>
</div>

<div class="row g-4">
    <!-- PROGRESO -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-bar-chart-line-fill display-4 text-primary"></i>
                <h5 class="card-title mt-3">Progreso</h5>
                <p class="card-text">¡Consulta tu avance semanal!</p>
                <a href="progreso/index.php" class="btn btn-outline-primary">Ver progreso</a>
            </div>
        </div>
    </div>

    <!-- HABITOS -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-check-circle-fill display-4 text-success"></i>
                <h5 class="card-title mt-3">Hábitos</h5>
                <p class="card-text">Agrega, edita o elimina hábitos para manterner tu rutina.</p>
                <a href="habitos/index.php" class="btn btn-outline-success">Gestionar hábitos</a>
            </div>
        </div>
    </div>

    <!-- PERFIL/CONFIGURACION -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class=" bi bi-person-circle display-4 text-warning"></i>
                <h5 class="card-title mt-3">Perfil</h5>
                <p class="card-text">Edita tu perfil y comprueba los logros que has conseguido.</p>
                <a href="usuarios/index.php" class="btn btn-outline-warning">Ver perfil</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>