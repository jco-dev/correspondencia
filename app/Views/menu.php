<div class="app-menu">
    <ul class="accordion-menu">
        <li class="sidebar-title">
            Apps
        </li>
        <li class="active-page">
            <a href="<?= base_url(route_to('inicio')) ?>" class="active">
                <i class="material-icons-two-tone">dashboard</i>
                Inicio
            </a>
        </li>

        <?php if (session()->get('rol') == 'ADMINISTRADOR'): ?>
            <li>
                <a href="<?= base_url(route_to('listado-personas')) ?>">
                    <i class="material-icons-two-tone">person</i>
                    Personas
                </a>
            </li>
            <li>
                <a href="<?= base_url(route_to('listado-oficinas')) ?>">
                    <i class="material-icons-two-tone">home</i>
                    Oficinas
                </a>
            </li>

            <li>
                <a href="<?= base_url(route_to('listado-asignacion')) ?>">
                    <i class="material-icons-two-tone">calendar_today</i>
                    Cargos en Oficinas
                </a>
            </li>
        <?php endif; ?>

        <li class="sidebar-title">
            ARCHIVOS
        </li>
        <li class="open">
            <a href="#"><i class="material-icons-two-tone">cloud_queue</i>Archivos
                <i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
            <ul class="sub-menu">
                <li>
                    <a href="<?= base_url(route_to('listado-documentos')) ?>">Documentos</a>
                </li>
                <li>
                    <a href="<?= base_url(route_to('listado-enviados')) ?>">Enviados</a>
                </li>
                <li>
                    <a href="<?= base_url(route_to('listado-entrantes')) ?>">Entrantes</a>
                </li>
                <li>
                    <a href="<?= base_url(route_to('listado-pendientes')) ?>">Pendientes</a>
                </li>
                <li>
                    <a href="<?= base_url(route_to('listado-archivados')) ?>">Archivados</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
