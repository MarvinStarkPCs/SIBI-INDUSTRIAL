<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Historial de Asignaciones</h1>
<p class="mb-4">Aquí puedes ver el historial de asignaciones.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Asignaciones</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <a href="<?= base_url('gestion-extras') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
            </div>
            <!-- Puedes agregar más botones aquí si es necesario -->
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Usuario Asignador</th>
                    <th>Usuario Receptor</th>
                    <th>Cantidad Otorgada</th>
                    <th>Fecha de Asignación</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($asignaciones as $asignacion): ?>
                    <tr>
                        <td><?= esc($asignacion->articulo) ?></td>
                        <td><?= esc($asignacion->usuario_asignador) ?></td>
                        <td><?= esc($asignacion->usuario_receptor) ?></td>
                        <td><?= esc($asignacion->cantidad_otorgada) ?></td>
                        <td><?= esc($asignacion->asignado_en) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
