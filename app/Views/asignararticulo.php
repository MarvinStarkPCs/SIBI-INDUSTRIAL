<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Asignación de Artículos</h1>
<p class="mb-4">Aquí puedes asignar un artículo a un usuario.</p>

<!-- Formulario de Asignación -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Asignar Artículo</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('asignar-articulo/save') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="selectUsuario">Seleccionar Usuario</label>
                    <select class="form-control <?= session('errors.usuario_id') ? 'is-invalid' : '' ?>" id="selectUsuario" name="usuario_id">
                        <option value="">Seleccione un usuario</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= esc($usuario['id']) ?>" <?= old('usuario_id') == $usuario['id'] ? 'selected' : '' ?>>
                                <?= esc($usuario['nombres'] . ' ' . $usuario['apellidos']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.usuario_id') ?>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="selectArticulo">Seleccionar Artículo</label>
                    <select class="form-control <?= session('errors.articulo_id') ? 'is-invalid' : '' ?>" id="selectArticulo" name="articulo_id">
                        <option value="">Seleccione un artículo</option>
                        <?php foreach ($articulos as $articulo): ?>
                            <option value="<?= esc($articulo['id']) ?>" <?= old('articulo_id') == $articulo['id'] ? 'selected' : '' ?>>
                                <?= esc($articulo['nombre']) ?> (<?= esc($articulo['marca']) ?>) <?= esc($articulo['cod_institucional']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.articulo_id') ?>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="selectEstado">Estado del Artículo</label>
                    <select class="form-control <?= session('errors.estado_id') ? 'is-invalid' : '' ?>" id="selectEstado" name="estado_id">
                        <option value="">Seleccione el estado</option>
                        <?php foreach ($estados as $estado): ?>
                            <option value="<?= esc($estado['id']) ?>" <?= old('estado_id') == $estado['id'] ? 'selected' : '' ?>>
                                <?= esc($estado['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.estado_id') ?>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCantidad">Cantidad Otorgada</label>
                    <input type="number" class="form-control <?= session('errors.cantidad_otorgada') ? 'is-invalid' : '' ?>" id="inputCantidad" name="cantidad_otorgada" placeholder="Cantidad" value="<?= old('cantidad_otorgada') ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.cantidad_otorgada') ?>
                    </div>
                </div>
                <!-- Opcional: Ubicación de Préstamo -->
                <div class="form-group col-md-4">
                    <label for="selectUbicacion">Ubicación de Préstamo (Opcional)</label>
                    <select class="form-control <?= session('errors.a_ubicacion_id') ? 'is-invalid' : '' ?>" id="selectUbicacion" name="a_ubicacion_id">
                        <option value="">Seleccione una ubicación (si aplica)</option>
                        <?php foreach ($ubicaciones as $ubicacion): ?>
                            <option value="<?= esc($ubicacion['id']) ?>" <?= old('a_ubicacion_id') == $ubicacion['id'] ? 'selected' : '' ?>>
                                <?= esc($ubicacion['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.a_ubicacion_id') ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Asignación</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
