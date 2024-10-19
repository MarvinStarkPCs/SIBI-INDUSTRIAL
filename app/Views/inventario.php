<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>

</style>
<h1 class="h3 mb-2 text-gray-800">Gestión de Inventario</h1>
<p class="mb-4">Aquí puedes gestionar el inventario del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Inventario</h6>

    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <!-- Grupo de botones alineados a la izquierda -->
            <div>
                <!-- Botón para descargar Excel -->
                <a href="<?= base_url('inventario/inventario-excel') ?>" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Descargar Excel
                </a>
            </div>

            <!-- Grupo de botones alineados a la derecha -->
            <div>
                <!-- Botón para Agregar inventario -->
                <button type="button" id="openInventoryButton" class="btn btn-primary mr-2" data-toggle="modal" data-target="#openInventoryModal">
                    <i class="fas fa-box-open"></i> Agregar inventario
                </button>
                <!-- Botón para cerrar inventario -->
<!--                <button type="button" id="closeInventoryButton" class="btn btn-secondary" data-toggle="modal" data-target="#closeInventoryModal">-->
<!--                    <i class="fas fa-box-closed"></i> Cerrar Inventario-->
<!--                </button>-->
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Estado</th>
                    <th>procedencia</th>
                    <th>Sede</th>
                    <th>Ubicación</th>
                    <th>Precio Total</th>
                    <th>Cantidad</th>

                    <th>Acciones</th>
                </tr>

                <tbody>
                <?php foreach ($inventarios as $inventario): ?>
                    <tr>
                        <td><?= esc($inventario->nombre_articulo) ?></td>
                        <td><?= esc($inventario->nombre_marca) ?></td>
                        <td><?= esc($inventario->nombre_estado) ?></td>
                        <td><?= esc($inventario->nombre_procedencia) ?></td>
                        <td><?= esc($inventario->nombre_sede) ?></td>
                        <td><?= esc($inventario->nombre_ubicacion) ?></td>
                        <td><?= esc($inventario->valor_total) ?></td>
                        <td><?= esc($inventario->stock_inicio) ?></td>
                        <td class="text-center">
                            <?php if ($inventario->serial == 'NO APLICA'): ?>
                                <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" data-target="#updateModal-<?= $inventario->id_inventario ?>" title="Actualizar cantidad">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            <?php endif; ?>

                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $inventario->id_inventario ?>" title="Dar de baja">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal" data-target="#detailsModal-<?= $inventario->id_inventario ?>" title="Ver detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal para Agregar inventario -->
<div class="modal fade" id="openInventoryModal" tabindex="-1" role="dialog" aria-labelledby="openInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;"> <!-- Increased custom width -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openInventoryModalLabel">Agregar inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('inventario/open') ?>" method="post" id="openInventoryForm">
                    <?= csrf_field() ?>
                    <div class="d-flex flex-wrap">

                        <!-- Artículo -->
                        <div class="form-group col-md-6">
                            <label for="openArticulo">Artículo</label>
                            <select class="form-control select2 <?= session('errors-open.id_articulo') ? 'is-invalid' : '' ?>" id="openArticulo" name="id_articulo" required>
                                <option value="" selected disabled>Seleccione un artículo</option>
                                <?php foreach ($articulos as $articulo): ?>
                                    <option value="<?= $articulo['id_articulo'] ?>" data-tiene-serial="<?= isset($articulo['tiene_serial']) ? $articulo['tiene_serial'] : '0' ?>" <?= old('id_articulo') == $articulo['id_articulo'] ? 'selected' : '' ?>>
                                        <?= $articulo['nombre'] . '_' . (!empty($articulo['modelo']) ? $articulo['modelo'] : $articulo['nombre_marca']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors-open.id_articulo') ?></div>
                        </div>

                        <!-- Cantidad (Ocultable) -->
                        <div class="form-group col-md-6" id="quantityContainer">
                            <label for="openQuantity">Cantidad</label>
                            <input type="number" class="form-control <?= session('errors-open.quantity') ? 'is-invalid' : '' ?>" id="openQuantity" name="quantity" placeholder="Cantidad" value="<?= old('quantity') ?>" required>
                            <div class="invalid-feedback"><?= session('errors-open.quantity') ?></div>
                        </div>

                        <!-- Estado -->
                        <div class="form-group col-md-6">
                            <label for="openEstado">Estado</label>
                            <select class="form-control select2 <?= session('errors-open.estado_id') ? 'is-invalid' : '' ?>" id="openEstado" name="estado_id" required>
                                <option value="" selected disabled>Seleccione un estado</option>
                                <?php foreach ($estados as $estado): ?>
                                    <option value="<?= $estado['id'] ?>" <?= old('estado_id') == $estado['id'] ? 'selected' : '' ?>>
                                        <?= $estado['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors-open.estado_id') ?></div>
                        </div>

                        <!-- Procedencia -->
                        <div class="form-group col-md-6">
                            <label for="openProcedencia">Procedencia</label>
                            <select class="form-control select2 <?= session('errors-open.procedencia_id') ? 'is-invalid' : '' ?>" id="openProcedencia" name="procedencia_id" required>
                                <option value="" selected disabled>Seleccione una procedencia</option>
                                <?php foreach ($procedencias as $procedencia): ?>
                                    <option value="<?= $procedencia['id'] ?>" <?= old('procedencia_id') == $procedencia['id'] ? 'selected' : '' ?>>
                                        <?= $procedencia['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors-open.procedencia_id') ?></div>
                        </div>

                        <!-- Fecha de Adquisición -->
                        <div class="form-group col-md-6">
                            <label for="openFechaAdquisicion">Fecha de Adquisición</label>
                            <input type="date" class="form-control <?= session('errors-open.fecha_adquisicion') ? 'is-invalid' : '' ?>" id="openFechaAdquisicion" name="fecha_adquisicion" value="<?= old('fecha_adquisicion') ?>" required>
                            <div class="invalid-feedback"><?= session('errors-open.fecha_adquisicion') ?></div>
                        </div>

                    </div>

                    <!-- Contenedor de Seriales -->
                    <div id="serialContainer" style="display: none;">
                        <label for="openSeriales">Seriales</label>
                        <div id="serialList" class="border p-2 mb-3">
                            <!-- Aquí se añadirán los seriales -->
                        </div>
                        <button type="button" class="btn btn-outline-secondary mt-2" id="addSerialButton">
                            <i class="fa fa-plus"></i> Agregar Serial
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar inventario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Cerrar Inventario -->
<div class="modal fade" id="closeInventoryModal" tabindex="-1" role="dialog" aria-labelledby="closeInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="closeInventoryModalLabel">Cerrar Inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('inventario/close') ?>" method="post" id="closeInventoryForm">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="closeQuantity">Cantidad</label>
                        <input type="number" class="form-control <?= session('errors-close.quantity') ? 'is-invalid errors-insert-inventory' : '' ?>" id="closeQuantity" name="quantity" placeholder="Cantidad" value="<?= old('quantity') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors-close.quantity') ?>
                        </div>
                    </div>
                    <div class="alert alert-info" role="alert">
                        <strong>Información:</strong> Ingresa la cantidad correcta para cerrar el inventario.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Cerrar Inventario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modales para Actualizar Inventario -->
<?php foreach ($inventarios as $inventario): ?>
    <div class="modal fade" id="updateModal-<?= $inventario->id_inventario ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel-<?= $inventario->id_inventario ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel-<?= $inventario->id_articulo ?>">Actualizar Cantidad de Inventario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('inventario/actualizar/'.$inventario->id_inventario) ?>" method="post" id="updateInventoryForm-<?= $inventario->id_inventario ?>">
                        <?= csrf_field() ?>
                        <div class="form-group" style="margin-bottom: 1.5rem;"> <!-- Margin for spacing -->
                            <label for="updateQuantity-<?= $inventario->id_inventario ?>" style="font-weight: bold; color: #007bff; font-size: 1.1rem;">Cantidad A Sumar</label>
                            <input type="number" class="form-control <?= session('errors-update.cantidad') ? 'is-invalid errors-insert-inventory' : '' ?>" id="updateQuantity-<?= $inventario->id_inventario ?>" name="cantidad" placeholder="Cantidad" style="margin-top: 5px;"> <!-- Space above input -->
                            <div class="invalid-feedback">
                                <?= session('errors-update.cantidad') ?>
                            </div>
                            <div class="mt-1"> <!-- Margin top for current quantity -->
                                <label for="currentQuantity-<?= $inventario->id_inventario ?>" style="color: #6c757d; font-size: 0.9rem;">Cantidad Actual: <?= $inventario->stock_inicio ?></label>
                            </div>
                        </div>
                        <div style="border: 1px solid #ffc107; padding: 10px; background-color: #fff3cd; border-radius: 5px; margin-bottom: 15px;">
                            <strong>Advertencia:</strong> Esta acción no se puede deshacer. Asegúrate de ingresar la cantidad correcta antes de actualizar el inventario.
                            <strong>Información:</strong> Esta cantidad se sumará a la que ya existe en el inventario.
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

<!-- Modales para Dar de Baja Inventario -->
<?php foreach ($inventarios as $inventario): ?>
    <div class="modal fade" id="deleteModal-<?= $inventario->id_inventario ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $inventario->id_inventario ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $inventario->id_inventario ?>">Dar de Baja Inventario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('inventario/dardebaja/'.$inventario->id_inventario) ?>" method="post" id="deleteInventoryForm-<?= $inventario->id_inventario ?>">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="deleteQuantity-<?= $inventario->id_inventario ?>">Cantidad a Dar de Baja</label>

                            <input type="number" class="form-control <?= session('errors-delete.cantidad') ? 'is-invalid errors-insert-inventory' : '' ?>" id="deleteQuantity-<?= $inventario->id_inventario ?>" name="cantidad" placeholder="Cantidad" value="<?= $inventario->stock_inicio > 1 ? '' : $inventario->stock_inicio ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-delete.cantidad') ?>
                            </div>
                            <div class="mt-1"> <!-- Margin top for current quantity -->
                                <label for="currentQuantity-<?= $inventario->id_inventario ?>" style="color: #6c757d; font-size: 0.9rem;">Cantidad Actual: <?= $inventario->stock_inicio ?></label>
                            </div>
                        </div>
                        <div style="border: 1px solid #ffc107; padding: 10px; background-color: #fff3cd; border-radius: 5px; margin-bottom: 15px;">
                            <strong>Advertencia:</strong> Esta acción no se puede deshacer. Asegúrate de ingresar la cantidad correcta antes de dar de baja el inventario.
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger">Dar de Baja</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Modal de Detalles del Inventario -->
<?php foreach ($inventarios as $inventario): ?>
    <div class="modal fade" id="detailsModal-<?= $inventario->id_inventario ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $inventario->id_inventario ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel-<?= $inventario->id_articulo ?>">Detalles del Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="detailsName-<?= $inventario->id_articulo ?>">Nombre</label>
                                <input type="text" class="form-control" id="detailsName-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->nombre_articulo) ?>" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="detailsBrand-<?= $inventario->id_articulo ?>">Marca</label>
                                <input type="text" class="form-control" id="detailsBrand-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->nombre_marca) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsSerial-<?= $inventario->id_articulo ?>">serial</label>
                                <input type="text" class="form-control" id="detailsSerial-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->serial) ?>" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="detailsDescription-<?= $inventario->id_articulo ?>">Descripción</label>
                                <textarea class="form-control" id="detailsDescription-<?= $inventario->id_articulo ?>" rows="3" readonly><?= esc($inventario->descripcion_articulo) ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsAcquisitionDate-<?= $inventario->id_articulo ?>">Fecha de Adquisición</label>
                                <input type="text" class="form-control" id="detailsAcquisitionDate-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->fecha_adquisicion) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsUnitValue-<?= $inventario->id_articulo ?>">Valor Unitario</label>
                                <input type="text" class="form-control" id="detailsUnitValue-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->valor_unitario) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsState-<?= $inventario->id_articulo ?>">Estado</label>
                                <input type="text" class="form-control" id="detailsState-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->nombre_estado) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsCategory-<?= $inventario->id_articulo ?>">Categoría</label>
                                <input type="text" class="form-control" id="detailsCategory-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->categoria) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsProcedure-<?= $inventario->id_articulo ?>">Procedencia</label>
                                <input type="text" class="form-control" id="detailsProcedure-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->nombre_procedencia) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsLocation-<?= $inventario->id_articulo ?>">Ubicación</label>
                                <input type="text" class="form-control" id="detailsLocation-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->nombre_ubicacion) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsStockStart-<?= $inventario->id_articulo ?>">Stock Inicial</label>
                                <input type="text" class="form-control" id="detailsStockStart-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->stock_inicio) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsStockEnd-<?= $inventario->id_articulo ?>">Stock Final</label>
                                <input type="text" class="form-control" id="detailsStockEnd-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->stock_final) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsInventoryDate-<?= $inventario->id_articulo ?>">Fecha del Inventario</label>
                                <input type="text" class="form-control" id="detailsInventoryDate-<?= $inventario->id_articulo ?>" value="<?= esc($inventario->fecha_ingreso) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsTotalPrice-<?= $inventario->id_articulo ?>">Precio Total</label>
                                <input type="text" class="form-control" id="detailsTotalPrice-<?= $inventario->id_articulo ?>" value="<?= esc(number_format($inventario->valor_total, 2)) ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>
