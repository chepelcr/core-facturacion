<!-- Menu de administracion -->
<li class="nav-item" id="menu-art">
    <a href="#" class="nav-link" id="art">
        <i class="fas fa-lightbulb nav-icon"></i>
        <p>Empresa</p>
        <i class="right fas fa-angle-left"></i>
    </a>


    <ul class="nav nav-treeview">
        <!-- Clientes -->
        <li class="nav-item">
            <a href="<?= baseUrl('empresa/clientes')?>" class="nav-link">
                <p>Clientes</p>
                <i class="nav-icon right fas fa-user-tie"></i>
            </a>
        </li>

        <!-- Proveedores -->
        <li class="nav-item">
            <a href="<?= baseUrl('empresa/proveedores')?>" class="nav-link">
                <p>Proveedores</p>
                <i class="nav-icon right fas fa-truck "></i>
            </a>
        </li>

        <?php
        //Ordenes de compra
        if(!isset($submodulos['ordenes']))
        {
            echo 
            '<!-- Listado Ordenes de compra -->
                <li class="nav-item">
                    <a href="'. baseUrl('empresa/ordenes').'" class="nav-link">
                        <p>Ordenes de compra</p>
                        <i class="fas fa-shopping-cart nav-icon right"></i>
                    </a>
                </li>';
        }
        ?>

        <li class="nav-item">
            <a href="<?= baseUrl('empresa')?>" class="nav-link">
                <p>Informacion</p>
                <i class="nav-icon right fas fa-info"></i>
            </a>
        </li>
    </ul>
</li>