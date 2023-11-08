<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de Correspondencia">
    <meta name="keywords" content="correspondencia, seguimiento, trámites">
    <meta name="author" content="developer">

    <title>Iniciar sesión | Sistema de Correspondencia</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
          rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/plugins/perfectscroll/perfect-scrollbar.css')?>" rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/plugins/pace/pace.css')?>" rel="stylesheet">


    <link href="<?= base_url('/neptune/source/assets/css/main.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('/neptune/source/assets/css/custom.css')?>" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('/neptune/source/assets/images/neptune.png')?>"/>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('/neptune/source/assets/images/neptune.png')?>"/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background">

    </div>
    <div class="app-auth-container">
        <div class="logo">
            <a href="/">Neptune</a>
        </div>
        <p class="auth-description">Inicie sesión en su cuenta y continúe hasta el panel.</p>

        <div class="auth-credentials m-b-xxl">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="email" class="form-control m-b-md" id="usuario" name="usuario" aria-describedby="usuario"
                   placeholder="nombre usuario">

            <label for="clave" class="form-label">Clave</label>
            <input type="password" class="form-control" id="clave" name="clave" aria-describedby="clave"
                   placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
        </div>

        <div class="auth-submit">
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </div>

    </div>
</div>

<script src="<?= base_url('/neptune/source/assets/plugins/jquery/jquery-3.5.1.min.js')?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/perfectscroll/perfect-scrollbar.min.js')?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/pace/pace.min.js')?>"></script>
<script src="<?= base_url('/neptune/source/assets/js/main.min.js')?>"></script>
<script src="<?= base_url('/neptune/source/assets/js/custom.js')?>"></script>
</body>
</html>