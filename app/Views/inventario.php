<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de Inventario</h1>
<p class="mb-4">Aquí puedes gestionar el inventario del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Inventario</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" id="openModalButtonInventory" class="btn btn-primary" data-toggle="modal" data-target="#addInventoryModal">
                <i class="fas fa-plus"></i> Agregar Inventario
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Fecha de Adquisición</th>
                    <th>Valor Unitario</th>
                    <th>Estado</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($inventarios as $inventario): ?>
                    <tr>
                        <td><?= esc($inventario->articulo_nombre) ?></td>
                        <td><?= esc($inventario->articulo_marca) ?></td>
                        <td><?= esc($inventario->articulo_descripcion) ?></td>
                        <td><?= esc($inventario->articulo_fecha_adquisicion) ?></td>
                        <td><?= esc($inventario->articulo_valor_unitario) ?></td>
                        <td><?= esc($inventario->estado_nombre) ?></td>
                        <td><?= esc($inventario->categoria_nombre) ?></td>
                        <td class="text-center">
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" data-target="#updateModal-<?= $inventario->articulo_id ?>" title="Actualizar cantidad">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $inventario->articulo_id ?>" title="Dar de baja">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Actualizar Inventario -->
<?php foreach ($inventarios as $inventario): ?>
    <div class="modal fade" id="updateModal-<?= $inventario->articulo_id ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel-<?= $inventario->articulo_id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel-<?= $inventario->articulo_id ?>">Actualizar Cantidad de Inventario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('gestion-inventario/update/'.$inventario->articulo_id) ?>" method="post" id="updateInventoryForm-<?= $inventario->articulo_id ?>">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="updateQuantity-<?= $inventario->articulo_id ?>">Cantidad</label>
                            <input type="number" class="form-control <?= session('errors-update.cantidad') ? 'is-invalid errors-update' : '' ?>" id="updateQuantity-<?= $inventario->articulo_id ?>" name="cantidad" placeholder="Cantidad" value="<?= old('cantidad') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-update.cantidad') ?>
                            </div>
                        </div>
                        <div style="border: 1px solid #17a2b8; padding: 10px; background-color: #e9f7fc; border-radius: 5px; margin-bottom: 15px;">
                            <strong>Información:</strong> Asegúrate de ingresar la cantidad correcta antes de actualizar el inventario.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar Cantidad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal de Dar de Baja Inventario -->
<?php foreach ($inventarios as $inventario): ?>
    <div class="modal fade" id="deleteModal-<?= $inventario->articulo_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $inventario->articulo_id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $inventario->articulo_id ?>">Dar de Baja Inventario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('gestion-inventario/delete/'.$inventario->articulo_id) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="deleteQuantity-<?= $inventario->articulo_id ?>">Cantidad a Dar de Baja</label>
                            <input type="number" class="form-control <?= session('errors-delete.cantidad') ? 'is-invalid errors-delete' : '' ?>" id="deleteQuantity-<?= $inventario->articulo_id ?>" name="cantidad" placeholder="Cantidad" value="<?= old('cantidad') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-delete.cantidad') ?>
                            </div>
                        </div>
                        <div style="border: 1px solid #dc3545; padding: 10px; background-color: #f8d7da; border-radius: 5px; margin-bottom: 15px;">
                            <strong>Advertencia:</strong> Estás a punto de dar de baja el inventario. Esta acción no se puede deshacer.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Dar de Baja</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>
