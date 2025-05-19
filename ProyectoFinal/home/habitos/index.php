<?php
include '../../includes/verificar_sesion.php';
include '../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Mis Hábitos</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalHabitos">
        <i class="bi bi-plus-circle"></i> Agregar Hábito
    </button>
</div>

<!-- LISTADO DE HABITOS  -->
<div id="listadoHabitos" class="row g-3">
    <!-- AQUI SE CARGARAN LOS HABITOS DESDE EL ARCHIVO JS -->
</div>

<!-- MODAL PARA AGREGAR HABITOS -->
<div class="modal fade" id="modalHabitos" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formHabito">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Hábito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre del hábito</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Frecuencia</label>
                        <select name="frecuencia" class="form-select" required>
                            <option value="Diario">Diario</option>
                            <option value="Semanal">Semanal</option>
                        </select>
                    </div>
                    <div class="mb-3" id="campoMeta">

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

<!-- MODAL PARA EDITAR HABITOS -->
<div class="modal fade" id="modalEditarHabito" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditarHabito">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Hábito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label class="form-label">Nombre del hábito</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Frecuencia</label>
                        <select name="frecuencia" id="edit_frecuencia" class="form-select" required>
                            <option value="Diario">Diario</option>
                            <option value="Semanal">Semanal</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-ba-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT JS -->
<script>
    const idUsuario = <?php echo json_encode($_SESSION['id_usuario']); ?>;
</script>
<script src="../../assets/js/habitos.js"></script>

<?php include '../../includes/footer.php'; ?>