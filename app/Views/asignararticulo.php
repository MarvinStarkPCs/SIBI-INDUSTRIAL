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
                                <?= esc($usuario['nombres'] . ' ' . $usuario['apellidos'].' '.'('.$usuario['nombre_perfil']).')' ?>
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
                            <option value="<?= esc($articulo->articulo_id) ?>" <?= old('articulo_id') == $articulo->articulo_id ? 'selected' : '' ?>>
                                <?= esc($articulo->articulo_nombre) ?> (<?= esc($articulo->articulo_marca) ?>) <?= esc($articulo->cod_institucional) ?>
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
                        <option value="">Seleccione un estado</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.estado_id') ?>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCantidadInventario">Cantidad en Inventario</label>
                    <input type="text" class="form-control" id="inputCantidadInventario" name="inputCantidadInventario" placeholder="Cantidad inventario" readonly>
                </div>


                <div class="form-group col-md-4">
                    <label for="inputUbicacion">Ubicación de Préstamo</label>
                    <input type="text" class="form-control" id="inputUbicacion" name="ubicacion" placeholder="Ubicación" readonly>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputCantidad">Cantidad Otorgada</label>
                    <input type="number" class="form-control <?= session('errors.cantidad_otorgada') ? 'is-invalid' : '' ?>" id="inputCantidad" name="cantidad_otorgada" placeholder="Cantidad" value="<?= old('cantidad_otorgada') ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.cantidad_otorgada') ?>
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

<!-- Script para manejar AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#selectArticulo').change(function() {
            var articuloId = $(this).val();

            if (articuloId) {
                $.ajax({
                    url: '<?= base_url('asignar-articulo/obtener-estado-ubicacion') ?>',
                    type: 'POST',
                    data: { articulo_id: articuloId },
                    success: function(response) {
                        console.log(response)
                        // Mostrar el loader
                        toggleLoader(true);

                        // Llenar el select de estados
                        var selectEstado = $('#selectEstado');
                        selectEstado.empty();
                        selectEstado.append('<option value="">Seleccione un estado</option>');
                        $.each(response, function(index, value) {
                            selectEstado.append('<option value="' + value.id_estado + '">' + value.estado + '</option>');
                        });
////////////////
                        $('#selectEstado').change(function() {
                            var estadoId = $(this).val();
                            var articuloId = $('#selectArticulo').val();
                            console.log(articuloId);
                            if (estadoId && articuloId) {
                                // Encuentra el estado y la ubicación correspondiente del JSON
                                let ubicacion = '';
                                let cantidadinventario = '';

                                $.each(response, function(index, estado) {
                                    if (estado.id_estado == estadoId) {
                                        ubicacion = estado.ubicacion+' ('+estado.sede+')'; // Obtén la ubicación asociada
                                        cantidadinventario = estado.stock_inicio;
                                        return false; // Salir del bucle
                                    }
                                });
                                $('#inputCantidadInventario').val(cantidadinventario);

                                // Actualiza el campo de ubicación
                                $('#inputUbicacion').val(ubicacion);
                                console.log(ubicacion)
                                console.log(cantidadinventario)
                            } else {
                                $('#inputUbicacion').val('');
                            }
                        });

                        // Limpiar el campo de ubicación
                        $('#inputUbicacion').val('');

                        // Ocultar el loader
                        setTimeout(() => toggleLoader(false), 1000);
                    },
                    error: function() {
                        alert('Error al obtener los estados.');
                    }
                });
            } else {
                $('#selectEstado').empty().append('<option value="">Seleccione un estado</option>');
                $('#inputUbicacion').val('');
            }
        });

    });


</script>
<?= $this->endSection() ?>
