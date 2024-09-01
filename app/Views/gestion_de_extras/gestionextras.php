<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .icon-image {
        width: 60px; /* Tamaño de imagen ajustado para pantallas más pequeñas */
        height: auto;
        transition: transform 0.3s, filter 0.3s; /* Transición suave para efectos de hover */
    }

    .card {
        display: flex;
        flex-direction: column; /* Disposición en columna en pantallas pequeñas */
        justify-content: center;
        align-items: center;
        padding: 15px;
        border: 2px solid #ddd; /* Borde por defecto, un poco más grueso para destacar */
        border-radius: 8px; /* Bordes redondeados */
        background-color: #fff; /* Fondo blanco para las tarjetas */
        transition: background-color 0.3s, box-shadow 0.3s, border-color 0.3s; /* Transición suave */
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Sombra suave por defecto */
    }

    .card:hover {
        background-color: #f0f8ff; /* Color de fondo cuando se pasa el cursor */
        box-shadow: 0 6px 12px rgba(0,0,0,0.3); /* Sombra más pronunciada al pasar el cursor */
        border-color: #2A6322; /* Color del borde al pasar el cursor */
    }

    .card:hover .icon-image {
        transform: scale(1.1); /* Aumenta el tamaño de la imagen al pasar el cursor */
        filter: brightness(1.2); /* Aumenta el brillo de la imagen al pasar el cursor */
    }

    .card-content {
        display: flex;
        flex-direction: row; /* Disposición en fila en pantallas grandes */
        align-items: center;
        width: 100%;
        justify-content: space-between; /* Asegura que el texto y la imagen estén separados */
    }

    .card-text {
        font-size: 2rem; /* Tamaño de fuente aumentado para el texto */
        font-weight: bold; /* Texto en negrita para destacar más */
        color: #333; /* Color del texto, ajusta si es necesario */
        margin-left: 20px; /* Desplaza el texto hacia la derecha */
        text-align: left; /* Alinea el texto a la izquierda */
    }

    .card-image {
        margin-left: 15px; /* Espacio entre el texto y la imagen */
    }

    @media (max-width: 768px) {
        .card {
            flex-direction: column; /* Cambia a disposición en columna en pantallas pequeñas */
        }

        .card-content {
            flex-direction: column; /* Cambia la disposición interna a columna */
            align-items: center; /* Centra los elementos dentro de la tarjeta */
        }

        .card-text {
            margin-left: 0; /* Elimina el margen en pantallas pequeñas */
            margin-bottom: 10px; /* Espacio debajo del texto */
            text-align: center; /* Centra el texto en pantallas pequeñas */
        }

        .card-image {
            margin-left: 0; /* Elimina el margen en pantallas pequeñas */
        }
    }

    @media (max-width: 576px) {
        .icon-image {
            width: 50px; /* Tamaño de imagen ajustado aún más para pantallas muy pequeñas */
        }

        .card-text {
            font-size: 1.5rem; /* Tamaño de fuente reducido para pantallas muy pequeñas */
        }
    }
</style>

<div class="container">
    <div class="header mb-4">
        <h1 class="h3 text-gray-800">Gestión de Extras</h1>
    </div>

    <div class="row">
        <!-- Artículos -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Artículos</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/1.png'); ?>" alt="Artículos" class="icon-image">
                    </div>
                </div>
            </div>
        </div>

        <!-- Categorías -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Categorías</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/2.png'); ?>" alt="Categorías" class="icon-image">
                    </div>
                </div>
            </div>
        </div>

        <!-- Estados -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Estados</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/3.png'); ?>" alt="Estados" class="icon-image">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sedes -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Sedes</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/4.png'); ?>" alt="Sedes" class="icon-image">
                    </div>
                </div>
            </div>
        </div>

        <!-- Ubicación -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Ubicación</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/5.png'); ?>" alt="Ubicación" class="icon-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
