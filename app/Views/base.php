<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de Correspondencia">
    <meta name="keywords" content="correspondencia, seguimiento, trámites">
    <meta name="author" content="developer">

    <!-- Title -->
    <title>Sistema de Correspondencia</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
          rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/plugins/perfectscroll/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/plugins/pace/pace.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/plugins/summernote/summernote-lite.min.css') ?>" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="<?= base_url('/neptune/source/assets/css/main.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/css/custom.css') ?>" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32"
          href="<?= base_url('/neptune/source/assets/images/neptune.png') ?>"/>
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?= base_url('/neptune/source/assets/images/neptune.png') ?>"/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php $this->renderSection('css'); ?>
</head>
<body>
<div class="app align-content-stretch d-flex flex-wrap">
    <div class="app-sidebar">
        <div class="logo">
            <a href="/" class="logo-icon"><span class="logo-text">Neptune</span></a>
            <div class="sidebar-user-switcher user-activity-online">
                <a href="#">
                    <div class="avatar avatar-xs">
                        <div class="avatar-title">JC</div>
                    </div>
                    <span class="user-info-text mt-2"> &nbsp; Juan Carlos</span>
                </a>
            </div>
        </div>
        <?= $this->include('menu') ?>
    </div>

    <div class="app-container">
        <div class="app-header">
            <nav class="navbar navbar-light navbar-expand-lg">
                <div class="container-fluid">
                    <div class="navbar-nav" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown"
                                   data-bs-toggle="dropdown">
                                    <div class="avatar avatar-xs">
                                        <div class="avatar-title">JC</div>
                                    </div>
                                    <span class="user-info-text mt-2"> &nbsp; Juan Carlos</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end language-dropdown"
                                    aria-labelledby="languageDropDown">
                                    <li>
                                        <a class="dropdown-item" href="#">Cerrar Sesión</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="app-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <?php $this->renderSection('content'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('/neptune/source/assets/plugins/jquery/jquery-3.5.1.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/perfectscroll/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/js/main.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/pace/pace.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/summernote/summernote-lite.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/sweetalert2/sweetalert2.js') ?>"></script>
<script>
    window.parametrosModal = function (
        idModal,
        titulo,
        tamano,
        onEscape,
        backdrop
    ) {
        $(idModal + "-title").html(titulo);
        $(idModal + "-dialog").removeClass("modal-lg");
        $(idModal + "-dialog").removeClass("modal-xl");
        $(idModal + "-dialog").removeClass("modal-sm");
        $(idModal + "-dialog").addClass(tamano);
        $(idModal).modal({
            backdrop: backdrop,
            keyboard: onEscape
        });

        $(idModal).modal('show');
    };
</script>
<?php $this->renderSection('js'); ?>
</body>
</html>