<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de Usuarios</h1>
<p class="mb-4">Aquí puedes gestionar los usuarios del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios</h6>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <div class="d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addUserModal">
                    Agregar Usuario
                </button>
            </div>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= esc($usuario['nombres']) ?></td>
                        <td><?= esc($usuario['identificacion']) ?></td>
                        <td><?= esc($usuario['correo']) ?></td>
                        <td><?= esc($usuario['perfil']) ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-<?= $usuario['id'] ?>">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $usuario['id'] ?>">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Agregar Usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Nombres</label>
                            <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">Apellidos</label>
                            <input type="text" class="form-control" id="inputLastname" placeholder="Apellidos">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">Identidad</label>
                            <input type="number" class="form-control" id="inputIdentity" placeholder="Identidad">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Correo Electrónico</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Correo Electrónico">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Teléfono</label>
                            <input type="tel" class="form-control" id="inputPhone" placeholder="Teléfono">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Dirección</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Dirección">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectRole">Rol</label>

                        <select class="form-control" id="selectRole">
                            <?php foreach ($perfiles as $perfil): ?>
                            <option value="<?=esc($perfil['id'])?>"><?=esc($perfil['nombre']) ?> </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveUserButton">Guardar Usuario</button>
            </div>
        </div>
    </div>
</div>


<!-- Modales de Editar y Eliminar -->
<?php foreach ($usuarios as $usuario): ?>
    <!-- Modal de Editar Usuario -->
    <div class="modal fade" id="editModal-<?= $usuario['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $usuario['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $usuario['id'] ?>">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario para editar usuario -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Eliminar Usuario -->
    <div class="modal fade" id="deleteModal-<?= $usuario['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $usuario['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $usuario['id'] ?>">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar a este usuario?</p>
                    <p><strong><?= esc($usuario['nombres']) ?></strong></p>
                </div>
                <div class="modal-footer">

                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="gestion-usuarios/deleteusuario/<?php echo $usuario['id']; ?>" class="btn btn-danger">Eliminar</a>

                </div>
            </div>
        </div>
    </div>


<?php endforeach; ?>

<?= $this->endSection() ?>
