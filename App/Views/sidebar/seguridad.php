<!-- Menu de seguridad -->
<li class="nav-item" id="menu-art">
    <a href="#" class="nav-link" id="art">
        <i class="fas fa-shield-alt nav-icon"></i>
        <p>Seguridad</p>
        <i class="right fas fa-angle-left"></i>
    </a>

    <ul class="nav nav-treeview">
        <!-- Listado Usuarios -->
        <li class="nav-item">
            <a href="<?= baseUrl('seguridad')?>" class="nav-link">
                <p>Usuarios</p>
                <i class="fas fa-users nav-icon right"></i>
            </a>
        </li>

        <!-- Listado Roles -->
        <li class="nav-item">
            <a href="<?= baseUrl('seguridad/roles')?>" class="nav-link">
                <p>Roles</p>
                <i class="nav-icon fas fa-lock right"></i>
            </a>
        </li>

        <!-- Auditorias -->
        <li class="nav-item">
            <a href="<?= baseUrl('seguridad/auditorias')?>" class="nav-link">
                <p>Auditorias</p>
                <i class="fas fa-exclamation-circle nav-icon right"></i>
            </a>
        </li>

        <!-- Errores -->
        <li class="nav-item">
            <a href="<?= baseUrl('seguridad/errores')?>" class="nav-link">
                <p>Errores</p>
                <i class="fas fa-exclamation-triangle right nav-icon"></i>
            </a>
        </li>

        <!-- Perfil -->
        <li class="nav-item">
            <a href="<?= baseUrl('seguridad/perfil')?>" class="nav-link">
                <p>Perfil</p>
                <i class="fas fa-user-circle nav-icon right"></i>
            </a>
        </li>
    </ul>
</li>