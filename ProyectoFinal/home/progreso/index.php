<?php
include '../../includes/verificar_sesion.php';
include '../../includes/header.php';
?>

<!-- ECABEZADO -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-bar-chart-line-fill text-success"></i>Dashboard de Progreso Semanal</h2>
    <a href="../habitos/index.php" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>Volver al Home
    </a>
</div>

<!-- TARJETAS DE RESUMEN -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <h5 class="mb-3"><i class="bi bi-graph-up text-primary"></i>Resumen de actividad.</h5>
        <div class="row text-center">
            <div class="col-md-4">
                <h6 class="text-muted">Total Completados</h6>
                <h3 id="totalCompletados">--</h3>
            </div>
            <div class="col-md-4">
                <h6 class="text-muted">Hábito más constante</h6>
                <h4 id="habitoConstante">--</h4>
            </div>
            <div class="col-md-4">
                <h6 class="text-muted">Racha más alta</h6>
                <h4 id="rachaMaxima">-- 🔥</h4>
            </div>
        </div>
    </div>
</div>

<!-- GRAFICA DE PROGRESO -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
        <h5 class="mb-3"><i class="bi bi-bar-chart text-success"></i>Progreso por día</h5>
        <div style="height: 400px;">
            <canvas id="graficoHabitos"></canvas>
        </div>
    </div>
</div>

<!-- SCRIPT JS -->
<script>
    const idUsuario = <?php echo json_encode($_SESSION['id_usuario']); ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../assets/js/dashboard.js"></script>

<?php include '../../includes/footer.php'; ?>