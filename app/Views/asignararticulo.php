<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<style>
    /* Estilo para el fondo de las celdas de las tablas */
    .table thead th {
        background-color: #296221; /* Color de fondo para las celdas del encabezado */
        color: white; /* Color del texto para contraste */
    }
    /* Estilo para las pestañas */
    .nav-tabs .nav-link {
        border: none; /* Eliminar borde */
    }
    .nav-tabs .nav-link.active {
        background-color: #296221; /* Color de fondo para pestaña activa */
        color: white; /* Color de texto para pestaña activa */
    }
    /* Ajustar el tamaño de los campos de entrada */
    .form-control {
        font-size: 0.9rem; /* Tamaño de fuente más pequeño */
    }
    /* Ajustar el tamaño del botón de agregar */
    #btnAgregarSerial, #btnAgregarUbicacion {
        font-size: 0.9rem; /* Tamaño de fuente más pequeño */
    }
</style>

<div class="container mt-5">
    <h2>ASIGNAR A UBICACIONES</h2>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="origen">Origen</label>
                <select class="form-control" id="origen">
                    <option value="">Seleccione una opción</option>
                    <!-- Llenar las opciones de origen -->
                    <?php foreach ($ubicaciones as $ubicacion): ?>
                        <option value="<?= $ubicacion->id_ubicacion ?>">
                            <?= $ubicacion->nombre_ubicacion . ' - ' . $ubicacion->nombre_sede ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="destino">Destino</label>
                <select class="form-control" id="destino">
                    <option value="">Seleccione una opción</option>
                    <!-- Llenar las opciones de destino -->
                    <?php foreach ($ubicaciones as $ubicacion): ?>
                        <option value="<?= $ubicacion->id_ubicacion ?>">
                            <?= $ubicacion->nombre_ubicacion . ' - ' . $ubicacion->nombre_sede ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Pestañas -->
    <ul class="nav nav-tabs justify-content-center mb-3">
        <li class="nav-item">
            <a class="nav-link active" id="btnSerial">
                <i class="fas fa-barcode"></i> <!-- Ícono para Serial -->
                Por Serial
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="btnUbicacion">
                <i class="fas fa-map-marker-alt"></i> <!-- Ícono para Ubicación -->
                Por Ubicación
            </a>
        </li>
    </ul>

    <!-- Contenido para "Por Serial" -->
    <div id="serialForm">
        <div class="mb-3">
            <div class="input-group" style="width: 200px;"> <!-- Ajusta el ancho aquí -->
                <input type="text" class="form-control" id="inputSerial" placeholder="Ingrese Serial">
                <div class="input-group-append">
                    <button class="btn btn-secondary" id="btnAgregarSerial" type="button">
                        <i class="fas fa-list"></i> <!-- Ícono sin texto -->
                    </button>
                </div>
            </div>
        </div>

        <table class="table" id="tablaSerial">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="6" class="text-center">Lista vacía</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Contenido para "Por Ubicación" -->
    <div id="ubicacionForm" style="display: none;">
        <div class="row mb-3">
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label for="articulo">Artículo</label>
                    <select class="form-control form-control-sm" id="articulo">
                        <option value="">Seleccione un artículo</option>
                        <!-- Opciones adicionales -->
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="form-group">
                    <label for="estadoUbicacion1">Estado</label>
                    <select class="form-control form-control-sm" id="estadoUbicacion1">
                        <option value="">Seleccione un estado</option>
                        <option value="Nuevo">Nuevo</option>
                        <option value="Usado">Usado</option>
                        <!-- Otras opciones -->
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control form-control-sm" id="cantidad" placeholder="Ingrese cantidad" min="1">
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="form-group">
                    <label for="estadoUbicacion2">Estado</label>
                    <select class="form-control form-control-sm" id="estadoUbicacion2">
                        <option value="">Seleccione un estado</option>
                        <option value="Nuevo">Nuevo</option>
                        <option value="Usado">Usado</option>
                        <!-- Otras opciones -->
                    </select>
                </div>
            </div>
            <div class="col-md-1 col-sm-6">
                <div class="form-group">
                    <label>&nbsp;</label> <!-- Esto agrega un espacio para alinear el botón -->
                    <button class="btn btn-secondary form-control" id="btnAgregarUbicacion">
                        <i class="fas fa-list"></i> <!-- Ícono sin texto -->
                    </button>
                </div>
            </div>
        </div>

        <table class="table" id="tablaUbicacion">
            <thead>
            <tr>
                <th>Código</th>
                <th>Accesorio</th>
                <th>Estado Actual</th>
                <th>Cantidad</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="5" class="text-center">Lista vacía</td>
            </tr>
            </tbody>
        </table>
    </div>

    <button class="btn btn-primary float-right">Cambiar ubicación</button>
</div>


<script>
    // Tu script aquí (el que proporcionaste anteriormente)
</script>

<?= $this->endSection() ?>
