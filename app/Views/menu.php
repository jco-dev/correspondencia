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
        <li>
            <a href="<?= base_url(route_to('listado-personas')) ?>">
                <i class="material-icons-two-tone">person</i>
                Usuarios
            </a>
        </li>
        <li>
            <a href="file-manager.html">
                <i class="material-icons-two-tone">home</i>
                Oficinas
            </a>
        </li>

        <li class="sidebar-title">
            UI Elements
        </li>
        <li>
            <a href="#"><i class="material-icons-two-tone">color_lens</i>Styles<i
                        class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
            <ul class="sub-menu">
                <li>
                    <a href="styles-typography.html">Typography</a>
                </li>
                <li>
                    <a href="styles-code.html">Code</a>
                </li>
                <li>
                    <a href="styles-icons.html">Icons</a>
                </li>
            </ul>
        </li>
    </ul>
</div>