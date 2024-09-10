<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIBI - Dashboard</title>

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- CSS de Select2 (si lo usas) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <style>
        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .sidebar-brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #EFEFE1;
            width: 60px;
            height: 60px;
            margin-right: 0.5rem;
            overflow: hidden;
        }

        .sidebar-brand-icon img {
            width: 51%;
            height: 84%;
            object-fit: cover;
        }

        /* Estilo para el mensaje de alerta */
        .alert {
            position: fixed;
            top: -100px; /* Posición inicial fuera de la pantalla */
            right: 20px; /* A la derecha de la pantalla */
            width: 50%; /* Ancho del mensaje */
            max-width: 300px; /* Tamaño máximo del mensaje */
            z-index: 9999;
            transition: top 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }

        .alert.show {
            top: 95px; /* Ajusta este valor para moverlo más abajo */
        }

        .alert.hide {
            top: -100px; /* Desaparece fuera de la pantalla hacia arriba */
            opacity: 0;
        }

        /* Estilo para la barra de progreso */
        .progress {
            height: 5px;
            background-color: #f1f1f1;
            margin-top: 10px;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            transition: width 5s linear;
        }

        /* Diferentes colores para la barra según el tipo de mensaje */
        .alert-success .progress-bar {
            background-color: #28a745; /* Verde para éxito */
        }

        .alert-danger .progress-bar {
            background-color: #dc3545; /* Rojo para error */
        }
    </style>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('img/logo colegio.png'); ?>" alt="">
            </div>
            <div class="sidebar-brand-text mx-3">SIBI <sup></sup></div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Interfaces
        </div>
        <!-- Nav Item - Sistema -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i> <!-- Icono de sistema -->
                <span>Sistema</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestión del Sistema</h6>
                    <a class="collapse-item" href="<?= base_url('inventario'); ?>">
                        <i class="fas fa-box"></i> <!-- Icono de inventario -->
                        Inventario
                    </a>
                    <a class="collapse-item" href="<?= base_url('mover-articulo'); ?>">
                        <i class="fas fa-arrows-alt"></i> <!-- Icono de mover artículo -->
                        Mover Artículo
                    </a>
                    <a class="collapse-item" href="<?= base_url('gestion-extras'); ?>">
                        <i class="fas fa-plus-circle"></i> <!-- Icono de asignar artículo -->
                        Asignar Artículo
                    </a>
                    <a class="collapse-item" href="<?= base_url('gestion-extras'); ?>">
                        <i class="fas fa-boxes"></i> <!-- Icono de gestión de extras -->
                        Gestión de Extras
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Seguridad -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-shield-alt"></i> <!-- Icono de seguridad -->
                <span>Seguridad</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Configura seguridad:</h6>
                    <a class="collapse-item" href="<?= base_url('gestion-usuarios'); ?>">
                        <i class="fas fa-users-cog"></i> <!-- Icono de gestión de usuarios -->
                        Gestión de Usuarios
                    </a>
                    <a class="collapse-item" href="<?= base_url('cambiar-contrasena'); ?>">
                        <i class="fas fa-key"></i> <!-- Icono de cambiar contraseña -->
                        Cambiar Contraseña
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Historia (nueva sección) -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHistory"
               aria-expanded="true" aria-controls="collapseHistory">
                <i class="fas fa-fw fa-history"></i> <!-- Icono de historia -->
                <span>Historia</span>
            </a>
            <div id="collapseHistory" class="collapse" aria-labelledby="headingHistory" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Historial del Sistema:</h6>
                    <a class="collapse-item" href="<?= base_url('historial-actividades'); ?>">
                        <i class="fas fa-tasks"></i> <!-- Icono de historial de actividades -->
                        Historial de Actividades
                    </a>
                    <a class="collapse-item" href="<?= base_url('registro-eventos'); ?>">
                        <i class="fas fa-calendar-alt"></i> <!-- Icono de registro de eventos -->
                        Registro de Eventos
                    </a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                            <img class="img-profile rounded-circle" src="<?= base_url('img/undraw_profile.svg'); ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('clogin/logout'); ?>" data-toggle="modal"
                               data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Mostrar mensajes de exito -->
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->get('success') ?>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Mostrar mensajes de error -->
                <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->get('error') ?>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Page content here -->
                <?= $this->renderSection('content') ?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('clogin/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<!-- jQuery -->
<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>

<!-- Select2 JavaScript (si lo usas) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!--select inventario-->
<script src="<?= base_url('js/selectInventario.js') ?>"></script>

<!-- Bootstrap core JavaScript -->
<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript -->
<script src="<?= base_url('assets/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages -->
<script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/chart.js/Chart.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('js/demo/chart-area-demo.js') ?>"></script>
<script src="<?= base_url('js/demo/chart-pie-demo.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('js/demo/datatables-demo.js') ?>"></script>

<!-- Custom alerts -->
<script src="<?= base_url('js/demo/alert_custom.js') ?>"></script>

</body>

</html>
