<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .icon-image {
        width: 60px;
        height: auto;
        transition: transform 0.3s, filter 0.3s;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 15px;
        border: 2px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        transition: background-color 0.3s, box-shadow 0.3s, border-color 0.3s;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        text-decoration: none; /* Evita subrayados en el texto */
        color: inherit; /* Mantén el color del texto por defecto */
    }

    .card:hover {
        background-color: #f0f8ff;
        box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        border-color: #2A6322;
    }

    .card:hover .icon-image {
        transform: scale(1.1);
        filter: brightness(1.2);
    }

    .card-content {
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 100%;
        justify-content: space-between;
    }

    .card-text {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin-left: 20px;
        text-align: left;
    }

    .card-image {
        margin-left: 15px;
    }

    @media (max-width: 768px) {
        .card {
            flex-direction: column;
        }

        .card-content {
            flex-direction: column;
            align-items: center;
        }

        .card-text {
            margin-left: 0;
            margin-bottom: 10px;
            text-align: center;
        }

        .card-image {
            margin-left: 0;
        }
    }

    @media (max-width: 576px) {
        .icon-image {
            width: 50px;
        }

        .card-text {
            font-size: 1.5rem;
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
            <a href="<?= base_url('articulos'); ?>" class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Artículos</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/1.png'); ?>" alt="Artículos" class="icon-image">
                    </div>
                </div>
            </a>
        </div>

        <!-- Categorías -->
        <div class="col-12 col-md-4 mb-4">
            <a href="<?= base_url('categorias'); ?>" class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Categorías</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/2.png'); ?>" alt="Categorías" class="icon-image">
                    </div>
                </div>
            </a>
        </div>

        <!-- Estados -->
        <div class="col-12 col-md-4 mb-4">
            <a href="<?= base_url('estados'); ?>" class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Estados</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/3.png'); ?>" alt="Estados" class="icon-image">
                    </div>
                </div>
            </a>
        </div>

        <!-- Sedes -->
        <div class="col-12 col-md-4 mb-4">
            <a href="<?= base_url('sedes'); ?>" class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Sedes</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/4.png'); ?>" alt="Sedes" class="icon-image">
                    </div>
                </div>
            </a>
        </div>

        <!-- Ubicación -->
        <div class="col-12 col-md-4 mb-4">
            <a href="<?= base_url('ubicaciones'); ?>" class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Ubicación</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/5.png'); ?>" alt="Ubicación" class="icon-image">
                    </div>
                </div>
            </a>
        </div>
        <!-- Procedencias -->
        <div class="col-12 col-md-4 mb-4">
            <a href="<?= base_url('procedencias'); ?>" class="card">
                <div class="card-content">
                    <div class="card-text">
                        <h5 class="mb-0">Procedencias</h5>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('img/gestionextras/6.png'); ?>" alt="Procedencias" class="icon-image">
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
