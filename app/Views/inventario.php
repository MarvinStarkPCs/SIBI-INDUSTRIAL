<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .sedes-container {
    display: flex;
    flex-direction: column;
    }

    .sedes-list {
    margin-top: 10px;
    }

    /* Ajustar el tamaño de los campos select2 */
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px); /* Ajusta la altura para que coincida con los inputs */
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 1.5; /* Ajusta la alineación vertical del texto */
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px); /* Asegura que la flecha tenga el mismo tamaño */
    }


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
                <!-- Botón para abrir inventario -->
                <button type="button" id="openInventoryButton" class="btn btn-primary mr-2" data-toggle="modal" data-target="#openInventoryModal">
                    <i class="fas fa-box-open"></i> Abrir Inventario
                </button>
                <!-- Botón para cerrar inventario -->
                <button type="button" id="closeInventoryButton" class="btn btn-secondary" data-toggle="modal" data-target="#closeInventoryModal">
                    <i class="fas fa-box-closed"></i> Cerrar Inventario
                </button>
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
                    <th>Acciones</th>
                </tr>

                <tbody>
                <?php foreach ($inventarios as $inventario): ?>
                    <tr>
                        <td><?= esc($inventario->articulo_nombre) ?></td>
                        <td><?= esc($inventario->articulo_marca) ?></td>
                        <td><?= esc($inventario->estado_nombre) ?></td>
                        <td><?= esc($inventario->procedencia_nombre) ?></td>
                        <td><?= esc($inventario->sede) ?></td>

                        <td><?= esc($inventario->ubicacion_nombre) ?></td>
                        <td><?= esc($inventario->precio_total) ?></td>
                        <td class="text-center">
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" data-target="#updateModal-<?= $inventario->articulo_id ?>" title="Actualizar cantidad">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $inventario->articulo_id ?>" title="Dar de baja">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal" data-target="#detailsModal-<?= $inventario->articulo_id ?>" title="Ver detalles">
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

<!-- Modal para Abrir Inventario -->
<div class="modal fade" id="openInventoryModal" tabindex="-1" role="dialog" aria-labelledby="openInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openInventoryModalLabel">Abrir Inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('inventario/open') ?>" method="post" id="openInventoryForm">
                    <?= csrf_field() ?>

                    <div class="form-row">
                        <!-- Cantidad -->
                        <div class="form-group col-md-6">
                            <label for="openQuantity">Cantidad</label>
                            <input type="number" class="form-control <?= session('errors-open.quantity') ? 'is-invalid errors-open' : '' ?>" id="openQuantity" name="quantity" placeholder="Cantidad" value="<?= old('quantity') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-open.quantity') ?>
                            </div>
                        </div>
                        <!-- Artículo -->
                        <div class="form-group col-md-6">
                            <label for="openArticulo">Artículo</label>
                            <select class="form-control select2 <?= session('errors-open.articulo_id') ? 'is-invalid errors-open' : '' ?>" id="openArticulo" name="articulo_id">
                                <option value="" selected disabled>Seleccione un artículo</option>
                                <?php foreach ($articulos as $articulo): ?>
                                    <option value="<?= $articulo['id'] ?>" <?= old('articulo_id') == $articulo['id'] ? 'selected' : '' ?>>
                                        <?= $articulo['nombre'].'_'.$articulo['cod_institucional']?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors-open.articulo_id') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Estado -->
                        <div class="form-group col-md-6">
                            <label for="openEstado">Estado</label>
                            <select class="form-control select2 <?= session('errors-open.estado_id') ? 'is-invalid errors-open' : '' ?>" id="openEstado" name="estado_id">
                                <option value="" selected disabled>Seleccione un estado</option>
                                <?php foreach ($estados as $estado): ?>
                                    <option value="<?= $estado['id'] ?>" <?= old('estado_id') == $estado['id'] ? 'selected' : '' ?>>
                                        <?= $estado['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors-open.estado_id') ?>
                            </div>
                        </div>

                        <!-- Procedencia -->
                        <div class="form-group col-md-6">
                            <label for="openProcedencia">Procedencia</label>
                            <select class="form-control select2 <?= session('errors-open.procedencia_id') ? 'is-invalid errors-open' : '' ?>" id="openProcedencia" name="procedencia_id">
                                <option value="" selected disabled>Seleccione una procedencia</option>
                                <?php foreach ($procedencias as $procedencia): ?>
                                    <option value="<?= $procedencia['id'] ?>" <?= old('procedencia_id') == $procedencia['id'] ? 'selected' : '' ?>>
                                        <?= $procedencia['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors-open.procedencia_id') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Ubicación -->
                        <div class="form-group col-md-6">
                            <label for="openUbicacion">Ubicación</label>
                            <select class="form-control select2 <?= session('errors-open.ubicacion_id') ? 'is-invalid errors-open' : '' ?>" id="openUbicacion" name="ubicacion_id">
                                <option value="" selected disabled>Seleccione una ubicación</option>
                                <!-- Opciones dinámicas de ubicaciones se cargarán aquí -->
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors-open.ubicacion_id') ?>
                            </div>
                        </div>

                        <!-- Sedes -->
                        <div class="form-group col-md-6">
                            <label>Sedes:</label>
                            <div class="sedes-container">
                                <div class="sedes-list">
                                    <?php foreach ($sedes as $sede): ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sede-checkbox" type="checkbox" id="sede<?= $sede['id'] ?>" name="sedes[]" value="<?= $sede['id'] ?>">
                                            <label class="form-check-label" for="sede<?= $sede['id'] ?>">
                                                <?= $sede['nombre'] ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensaje de carga -->
                    <div id="loadingMessage" style="display: none;">
                        <p>Cargando ubicaciones, por favor espere...</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Abrir Inventario</button>
                    </div>
                </form>
            </div> <!-- cierre de modal-body -->
        </div> <!-- cierre de modal-content -->
    </div> <!-- cierre de modal-dialog -->
</div> <!-- cierre de modal -->

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
                            <input type="number" class="form-control <?= session('errors-update.cantidad') ? 'is-invalid errors-insert-inventory' : '' ?>" id="updateQuantity-<?= $inventario->articulo_id ?>" name="cantidad" placeholder="Cantidad" value="<?= old('cantidad') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-update.cantidad') ?>
                            </div>
                        </div>
                        <div class="alert alert-info" role="alert">
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

<!-- Modales para Dar de Baja Inventario -->
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
                    <form action="<?= base_url('gestion-inventario/delete/'.$inventario->articulo_id) ?>" method="post" id="deleteInventoryForm-<?= $inventario->articulo_id ?>">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="deleteQuantity-<?= $inventario->articulo_id ?>">Cantidad a Dar de Baja</label>
                            <input type="number" class="form-control <?= session('errors-delete.cantidad') ? 'is-invalid errors-insert-inventory' : '' ?>" id="deleteQuantity-<?= $inventario->articulo_id ?>" name="cantidad" placeholder="Cantidad" value="<?= old('cantidad') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-delete.cantidad') ?>
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
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
    <div class="modal fade" id="detailsModal-<?= $inventario->articulo_id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $inventario->articulo_id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel-<?= $inventario->articulo_id ?>">Detalles del Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="detailsName-<?= $inventario->articulo_id ?>">Nombre</label>
                                <input type="text" class="form-control" id="detailsName-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->articulo_nombre) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsBrand-<?= $inventario->articulo_id ?>">Marca</label>
                                <input type="text" class="form-control" id="detailsBrand-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->articulo_marca) ?>" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="detailsDescription-<?= $inventario->articulo_id ?>">Descripción</label>
                                <textarea class="form-control" id="detailsDescription-<?= $inventario->articulo_id ?>" rows="3" readonly><?= esc($inventario->articulo_descripcion) ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsAcquisitionDate-<?= $inventario->articulo_id ?>">Fecha de Adquisición</label>
                                <input type="text" class="form-control" id="detailsAcquisitionDate-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->articulo_fecha_adquisicion) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsUnitValue-<?= $inventario->articulo_id ?>">Valor Unitario</label>
                                <input type="text" class="form-control" id="detailsUnitValue-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->articulo_valor_unitario) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsState-<?= $inventario->articulo_id ?>">Estado</label>
                                <input type="text" class="form-control" id="detailsState-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->estado_nombre) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsCategory-<?= $inventario->articulo_id ?>">Categoría</label>
                                <input type="text" class="form-control" id="detailsCategory-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->categoria_nombre) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsProcedure-<?= $inventario->articulo_id ?>">Procedencia</label>
                                <input type="text" class="form-control" id="detailsProcedure-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->procedencia_nombre) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsLocation-<?= $inventario->articulo_id ?>">Ubicación</label>
                                <input type="text" class="form-control" id="detailsLocation-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->ubicacion_nombre) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsStockStart-<?= $inventario->articulo_id ?>">Stock Inicial</label>
                                <input type="text" class="form-control" id="detailsStockStart-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->inventario_stock_inicio) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsStockEnd-<?= $inventario->articulo_id ?>">Stock Final</label>
                                <input type="text" class="form-control" id="detailsStockEnd-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->inventario_stock_final) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsInventoryDate-<?= $inventario->articulo_id ?>">Fecha del Inventario</label>
                                <input type="text" class="form-control" id="detailsInventoryDate-<?= $inventario->articulo_id ?>" value="<?= esc($inventario->inventario_fecha) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsTotalPrice-<?= $inventario->articulo_id ?>">Precio Total</label>
                                <input type="text" class="form-control" id="detailsTotalPrice-<?= $inventario->articulo_id ?>" value="<?= esc(number_format($inventario->precio_total, 2)) ?>" readonly>
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

<script>
    const ubicaciones = <?= json_encode($ubicaciones) ?>;
    console.log(ubicaciones)
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un input con la clase específica dentro del formulario
        let form = document.getElementById('openInventoryForm');
        let input = form.querySelector('input.errors-open');
        if (input) {
            // Si existe, hace clic en el botón
            document.getElementById('openInventoryButton').click();
        }
        let formUpdate = document.getElementById('editForm');
        let inputUpdate = formUpdate ? formUpdate.querySelector('input.errors-update') : null;
        if (inputUpdate){
            let target = localStorage.getItem("data_target");
            const elements = document.querySelectorAll(`[data-target="${target}"]`);
            elements.forEach(element => {
                element.click();
            });
        }
        document.querySelectorAll('#editButton').forEach(button => {
            button.addEventListener('click', function () {
                const dataTargetValue = this.getAttribute('data-target');
                localStorage.setItem("data_target", dataTargetValue);
            });
        });


    });

</script>
<?= $this->endSection() ?>
