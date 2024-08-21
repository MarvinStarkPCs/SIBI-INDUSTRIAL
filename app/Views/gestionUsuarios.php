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
                            <td><?= esc($usuario['nombre']) ?></td>
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
    <!-- Contenido del modal de agregar usuario -->
</div>

<!-- Modales de Editar y Eliminar -->
<?php foreach ($usuarios as $usuario): ?>
    <!-- Modal de Editar Usuario -->
    <div class="modal fade" id="editModal-<?= $usuario['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <!-- Contenido del modal para editar -->
    </div>

    <!-- Modal de Eliminar Usuario -->
    <div class="modal fade" id="deleteModal-<?= $usuario['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <!-- Contenido del modal para eliminar -->
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>
