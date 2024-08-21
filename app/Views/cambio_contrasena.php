<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form action="<?= base_url('cambiar-contrasena/actualizar'); ?>" method="post">
    <input type="hidden" name="idUsuario" value="<?= $idUsuario; ?>">

    <div class="form-group">
        <label for="nuevaContrasena">Nueva Contraseña</label>
        <input type="password" class="form-control" id="nuevaContrasena" name="nuevaContrasena" required>
    </div>
    
    <div class="form-group">
        <label for="confirmarContrasena">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="confirmarContrasena" name="confirmarContrasena" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
</form>
<?= $this->endSection() ?>

