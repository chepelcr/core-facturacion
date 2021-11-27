<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Departamentos</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Perfil -->
        <li class="nav-item">
            <a title="Perfil" href="<?= baseUrl('seguridad/perfil')?>" class="nav-link">
                <i class="fas fa-user-circle nav-icon right"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?=baseUrl('login/salir')?>" role="button">
                <i class="fa fa-sign-out col-2"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->