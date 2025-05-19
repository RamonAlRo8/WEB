<?php
include '../../includes/verificar_sesion.php';
include '../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-person-circle text-success"></i>Mi Perfil</h2>
</div>

<!-- BOTON EDITAR PERFIL -->
    <div class="text-end">
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
            <i class="bi bi-pencil"></i> Editar perfil
        </button>
    </div>

<div class="row">
    <!-- INFO DEL USUARIO -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Información</h5>
                <p><b>Nombre: </b><?php echo $_SESSION['nombre'];?></p>
                <p><b>Email: </b><?php echo $_SESSION['email'];?></p>
                <p><b>Rol: </b><?php echo $_SESSION['rol'];?></p>
            </div>
        </div>
    </div>


    <!-- INSIGNIAS -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="card-title mb-3">🏅 Insignia actual</h5>
                <p><b>Nombre: </b><span id="insigniaNombre">--</span></p>
                <p><b>Descripción: </b>Iniciaste tu primer habito</p>
            </div>
        </div>
    </div>

    <!-- ESTADISTICAS -->
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm rounded-4">
            <div class="card-body text-center">
                <h5 class="card-title mb-3">📊 Estadísticas</h5>
                <div class="row">
                    <div class="col-md-4">
                        <h6 class=text-muted">Racha más alta</h6>
                        <h3 id="rachaMax">-- 🔥</h3>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Hábitos completados</h6>
                        <h3 id="habitosCompletados">-- ✅</h3>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Hábitos activos</h6>
                        <h3 id="habitosActivos">--</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR EL PERFIL -->
    <div class="modal fade" id="modalEditarPerfil" tabindex="-1">
        <div class="modal-dialog">
            <form id="formEditarPerfil" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Perfil</h5>
                    <button class="btn-close" dat-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nuevo Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $_SESSION['nombre']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nuevo Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="No llenar si no deseas cambios.">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT JS -->
<script>
    const idUsuario = <?php echo json_encode($_SESSION['id_usuario']);?>;
</script>
<script src="../../assets/js/usuario.js"></script>

<?php include '../../includes/footer.php'; ?>