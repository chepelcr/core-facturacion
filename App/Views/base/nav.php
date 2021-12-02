<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <!-- Inicio -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= baseUrl('inicio')?>" class="nav-link nv-inicio">
                <i class="fas fa-home"></i> Inicio</a>
        </li>
        
        <!-- Empresa -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= baseUrl('empresa')?>" class="nav-link nv-empresa">
                <i class="fas fa-building"></i> Empresa</a>
        </li>

        <!-- Materia prima -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= baseUrl('compras')?>" class="nav-link nv-compras">
                <i class="fas fa-dolly"></i> Materia Prima</a>
        </li>

        <!-- Produccion -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= baseUrl('produccion')?>" class="nav-link nv-produccion">
                <i class="fas fa-industry"></i> Producción</a>
        </li>

        <!-- Seguridad -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= baseUrl('seguridad')?>" class="nav-link nv-seguridad">
                <i class="fas fa-shield-alt"></i> Seguridad</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Perfil -->
        <li data-placement="left" data-toggle="tooltip" title="Perfil" class="nav-item">
            <a role="button" href="<?= baseUrl('seguridad/perfil')?>" class="nav-link">
                <i class="fas fa-user-circle nav-icon right"></i>
            </a>
        </li>

        <li data-toggle="tooltip" data-placement="bottom" title="Cerrar sesión" class="nav-item">
            <a class="nav-link" href="<?=baseUrl('login/salir')?>" role="button">
                <i class="fa fa-sign-out col-2"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->