<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de Artículos</h1>
<p class="mb-4">Aquí puedes gestionar los artículos del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Artículos</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <!-- Botón de Atrás -->
            <div>
                <a href="<?= base_url('gestion-extras') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
            </div>

            <!-- Grupo de botones alineados a la derecha -->
            <div>
                <!-- Botón para descargar Excel -->
                <a href="<?= base_url('/articulos/articulos-excel') ?>" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Descargar Excel
                </a>
                <!-- Botón de Agregar Artículo -->
                <button type="button" id="openModalButtonArticle" class="btn btn-primary" data-toggle="modal" data-target="#addArticleModal">
                    <i class="fas fa-plus"></i> Agregar Artículo
                </button>
            </div>
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
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($articulos as $articulo): ?>
                    <tr>
                        <td><?= esc($articulo['nombre']) ?></td>
                        <td><?= esc($articulo['marca']) ?></td>
                        <td><?= esc($articulo['descripcion']) ?></td>
                        <td><?= esc($articulo['fecha_adquisicion']) ?></td>
                        <td><?= esc($articulo['valor_unitario'].' $') ?></td>
                        <td><?= esc($articulo['categoria']) ?></td>
                        <td class="text-center">
                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal" data-target="#detailsModal-<?= $articulo['id'] ?>" title="Ver detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" data-target="#editModal-<?= $articulo['id'] ?>" title="Editar artículo">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $articulo['id'] ?>" title="Eliminar artículo">
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

<!-- Modal de Agregar Artículo -->
<!-- Modal HTML -->
<div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="addArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addArticleModalLabel">Agregar Artículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('articulos/addusuarios') ?>" method="post" id="addArticleForm">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Nombre</label>
                            <input type="text" class="form-control <?= session('errors-insert.nombre') ? 'is-invalid errors-insert-article' : '' ?>" id="inputName" name="nombre" placeholder="Nombre" value="<?= old('nombre') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.nombre') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputBrand">Marca</label>
                            <input type="text" class="form-control <?= session('errors-insert.marca') ? 'is-invalid errors-insert-article' : '' ?>" id="inputBrand" name="marca" placeholder="Marca" value="<?= old('marca') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.marca') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputBrand">Modelo</label>
                            <input type="text" class="form-control <?= session('errors-insert.modelo') ? 'is-invalid errors-insert-article' : '' ?>" id="inputBrand" name="modelo" placeholder="modelo" value="<?= old('modelo') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.modelo') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputBrand">Serial</label>
                            <input type="text" class="form-control <?= session('errors-insert.serial') ? 'is-invalid errors-insert-article' : '' ?>" id="inputBrand" name="serial" placeholder="serial" value="<?= old('serial') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.serial') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputDescription">Descripción</label>
                            <textarea class="form-control <?= session('errors-insert.descripcion') ? 'is-invalid errors-insert-article' : '' ?>" id="inputDescription" name="descripcion" rows="3" placeholder="Descripción"><?= old('descripcion') ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors-insert.descripcion') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAcquisitionDate">Fecha de Adquisición</label>
                            <input type="date" class="form-control <?= session('errors-insert.fecha_adquisicion') ? 'is-invalid errors-insert-article' : '' ?>" id="inputAcquisitionDate" name="fecha_adquisicion" value="<?= old('fecha_adquisicion') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.fecha_adquisicion') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputUnitValue">Valor Unitario</label>
                            <input type="number" class="form-control <?= session('errors-insert.valor_unitario') ? 'is-invalid errors-insert-article' : '' ?>" id="inputUnitValue" name="valor_unitario" placeholder="Valor Unitario" value="<?= old('valor_unitario') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.valor_unitario') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="selectCategory">Categoría</label>
                        <select class="form-control <?= session('errors-insert.categoria_id') ? 'is-invalid errors-insert-article' : '' ?>" id="selectCategory" name="categoria_id">
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= esc($categoria['id']) ?>" <?= old('categoria_id') == $categoria['id'] ? 'selected' : '' ?>>
                                    <?= esc($categoria['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-insert.categoria_id') ?>
                        </div>
                    </div>

                    <div style="border: 1px solid #17a2b8; padding: 10px; background-color: #e9f7fc; border-radius: 5px; margin-bottom: 15px;">
                        <strong>Información:</strong> Asegúrate de ingresar todos los datos correctamente antes de guardar el artículo.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="saveArticleButton">Guardar Artículo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Detalles de Artículo -->
<?php foreach ($articulos as $articulo): ?>
    <div class="modal fade" id="detailsModal-<?= $articulo['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $articulo['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel-<?= $articulo['id'] ?>">Detalles del Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="detailsName">Nombre</label>
                                <input type="text" class="form-control" id="detailsName" value="<?= esc($articulo['nombre']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsName">Codigo Institucional</label>
                                <input type="text" class="form-control" id="detailsName" value="<?= esc($articulo['cod_institucional']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsBrand">Marca</label>
                                <input type="text" class="form-control" id="detailsBrand" value="<?= esc($articulo['marca']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsBrand">Serial</label>
                                <input type="text" class="form-control" id="detailsBrand" value="<?= esc($articulo['serial']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsBrand">Cod institucional</label>
                                <input type="text" class="form-control" id="detailsBrand" value="<?= esc($articulo['cod_institucional']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="detailsDescription">Descripción</label>
                                <textarea class="form-control" id="detailsDescription" rows="3" readonly><?= esc($articulo['descripcion']) ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsAcquisitionDate">Fecha de Adquisición</label>
                                <input type="date" class="form-control" id="detailsAcquisitionDate" value="<?= esc($articulo['fecha_adquisicion']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsUnitValue">Valor Unitario</label>
                                <input type="text" class="form-control" id="detailsUnitValue" value="<?= esc($articulo['valor_unitario'].'$') ?> " readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsCategory">Categoría</label>
                                <input type="text" class="form-control" id="detailsCategory" value="<?= esc($articulo['categoria']) ?>" readonly>
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

<!-- Modal de Editar Artículo -->
<?php foreach ($articulos as $articulo): ?>
    <div class="modal fade" id="editModal-<?= $articulo['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $articulo['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $articulo['id'] ?>">Editar Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('articulos/update/'.$articulo['id']) ?>" method="post" id="editArticleForm-<?= $articulo['id'] ?>">
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editName-<?= $articulo['id'] ?>">Nombre</label>
                                <input type="text" class="form-control <?= session('errors-edit.nombre') ? 'is-invalid errors-edit' : '' ?>" 
                                       id="editName-<?= $articulo['id'] ?>" name="nombre" 
                                       placeholder="Nombre" value="<?= esc($articulo['nombre']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.nombre') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editBrand-<?= $articulo['id'] ?>">Marca</label>
                                <input type="text" class="form-control <?= session('errors-edit.marca') ? 'is-invalid errors-edit' : '' ?>" 
                                       id="editBrand-<?= $articulo['id'] ?>" name="marca" 
                                       placeholder="Marca" value="<?= esc($articulo['marca']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.marca') ?>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="editDescription-<?= $articulo['id'] ?>">Descripción</label>
                                <textarea class="form-control <?= session('errors-edit.descripcion') ? 'is-invalid errors-edit' : '' ?>" 
                                          id="editDescription-<?= $articulo['id'] ?>" name="descripcion" 
                                          rows="3" placeholder="Descripción"><?= esc($articulo['descripcion']) ?></textarea>
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.descripcion') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editAcquisitionDate-<?= $articulo['id'] ?>">Fecha de Adquisición</label>
                                <input type="date" class="form-control <?= session('errors-edit.fecha_adquisicion') ? 'is-invalid errors-edit' : '' ?>" 
                                       id="editAcquisitionDate-<?= $articulo['id'] ?>" name="fecha_adquisicion" 
                                       value="<?= esc($articulo['fecha_adquisicion']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.fecha_adquisicion') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editUnitValue-<?= $articulo['id'] ?>">Valor Unitario</label>
                                <input type="number" class="form-control <?= session('errors-edit.valor_unitario') ? 'is-invalid errors-edit' : '' ?>" 
                                       id="editUnitValue-<?= $articulo['id'] ?>" name="valor_unitario" 
                                       placeholder="Valor Unitario" value="<?= esc($articulo['valor_unitario']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.valor_unitario') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editCategory-<?= $articulo['id'] ?>">Categoría</label>
                            <select class="form-control <?= session('errors-edit.categoria_id') ? 'is-invalid errors-edit' : '' ?>" 
                                    id="editCategory-<?= $articulo['id'] ?>" name="categoria_id">
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= esc($categoria['id']) ?>" <?= $articulo['categoria_id'] == $categoria['id'] ? 'selected' : '' ?>>
                                        <?= esc($categoria['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors-edit.categoria_id') ?>
                            </div>
                        </div>
                        <div style="border: 1px solid #17a2b8; padding: 10px; background-color: #e9f7fc; border-radius: 5px; margin-bottom: 15px;">
                            <strong>Información:</strong> Asegúrate de revisar los datos antes de guardar los cambios.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal de Eliminar Artículo -->
<?php foreach ($articulos as $articulo): ?>
    <div class="modal fade" id="deleteModal-<?= $articulo['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $articulo['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $articulo['id'] ?>">Eliminar Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar el artículo <strong><?= esc($articulo['nombre']) ?></strong>? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">

                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="articulos/delete/<?php echo $articulo['id']; ?>" class="btn btn-danger">Eliminar</a>


                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un input con la clase específica dentro del formulario
        let form = document.getElementById('addArticleForm');
        let input = form.querySelector('input.errors-insert-article');
        if (input) {
            // Si existe, hace clic en el botón
            document.getElementById('openModalButtonArticle').click();
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
