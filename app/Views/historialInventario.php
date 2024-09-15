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
<h1 class="h3 mb-2 text-gray-800">Historial de Inventario</h1>
<p class="mb-4">Aquí puedes ver el inventario del sistema de años anteriores.</p>

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
                <a href="<?= base_url('inventarios-anteriores/inventario-excel') ?>" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Descargar Excel
                </a>
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

                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal" data-target="#detailsModal-<?= $inventario->id_inventario_anual ?>" title="Ver detalles">
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

<!-- Modal de Detalles del Inventario -->
<?php foreach ($inventarios as $inventario): ?>
    <div class="modal fade" id="detailsModal-<?= $inventario->id_inventario_anual ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $inventario->id_inventario_anual ?>" aria-hidden="true">
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


<?= $this->endSection() ?>
