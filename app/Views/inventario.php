<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Inventario</h1>
<p class="mb-4">Esta tabla muestra el inventario con detalles de cada artículo, su estado, procedencia, categoría, ubicación y sede.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Inventario</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <div class="d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#dataModal">
                    Open Form
                </button>
            </div>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Descripción</th>
                        <th>Valor Unitario</th>
                        <th>Estado</th>
                        <th>Procedencia</th>
                        <th>Categoría</th>
                        <th>Ubicación</th>
                        <th>Sede</th>
                        <th>Stock de Inicio</th>
                        <th>Valor Total Stock</th>
                        <th>Detalles</th> <!-- Nueva columna para el botón de detalles -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventarios as $inventario): ?>
                    <tr>
                        <td><?= esc($inventario->articulo_nombre) ?></td>
                        <td><?= esc($inventario->articulo_marca) ?></td>
                        <td><?= esc($inventario->articulo_descripcion) ?></td>
                        <td><?= esc($inventario->valor_unitario) ?></td>
                        <td><?= esc($inventario->estado_nombre) ?></td>
                        <td><?= esc($inventario->procedencia_nombre) ?></td>
                        <td><?= esc($inventario->categoria_nombre) ?></td>
                        <td><?= esc($inventario->ubicacion_nombre) ?></td>
                        <td><?= esc($inventario->sede_nombre) ?></td>
                        <td><?= esc($inventario->stock_inicio) ?></td>
                        <td><?= esc($inventario->valor_total_stock) ?></td>
                        <td>
                            <?php
                            // Formateo de datos para el modal
                            $data = $inventario->procedencia_nombre . "*" . $inventario->categoria_nombre . "*" . $inventario->ubicacion_nombre . "*" . $inventario->sede_nombre;
                            ?>
                            <button type="button" class="btn btn-info btn-view" data-toggle="modal" data-target="#modal-default" data-info="<?php echo $data; ?>">
                                <span class="fa fa-eye"></span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Detalles del Artículo</h4>
            </div>
            <div class="modal-body">
                <!-- La información del artículo se cargará aquí -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-view').on('click', function () {
            var boton = $(this).data('info'); // Obtener la información del botón
            var info = boton.split("*");
            var resp = "<p><strong>Procedencia: </strong>" + info[0] + "</p>";
            resp += "<p><strong>Categoría: </strong>" + info[1] + "</p>";
            resp += "<p><strong>Ubicación: </strong>" + info[2] + "</p>";
            resp += "<p><strong>Sede: </strong>" + info[3] + "</p>";

            $("#modal-default .modal-body").html(resp);
        });
    });
</script>
<?= $this->endSection() ?>
