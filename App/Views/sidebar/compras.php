<!-- Menu de Punto de venta -->
<li class="nav-item" id="menu-art">
    <a href="#" class="nav-link" id="art">
        <i class="fas fa-warehouse nav-icon"></i>
        <p>Materia prima</p>
        <i class="right fas fa-angle-left"></i>
    </a>

    <ul class="nav nav-treeview">
        <?php
            //Clientes
            if(isset($submodulos['clientes']))
            {
                echo 
                '<!-- Listado Clientes -->
                    <li class="nav-item">
                        <a href="'. baseUrl('compra/clientes').'" class="nav-link">
                            <p>Clientes</p>
                            <i class="fas fa-user-tie nav-icon right"></i>
                        </a>
                    </li>';
            }

            //Lotes de compra
            if(isset($submodulos['lotes']))
            {
                echo 
                '<!-- Listado Lotes -->
                    <li class="nav-item">
                        <a href="'. baseUrl('compra/lotes').'" class="nav-link">
                            <p>Lotes</p>
                            <i class="fas fa-boxes nav-icon right"></i>
                        </a>
                    </li>';
            }

            //Proveedores
            if(isset($submodulos['proveedores']))
            {
                echo 
                '<!-- Listado Proveedores -->
                    <li class="nav-item">
                        <a href="'. baseUrl('compra/proveedores').'" class="nav-link">
                            <p>Proveedores</p>
                            <i class="fas fa-truck nav-icon right"></i>
                        </a>
                    </li>';
            }

            //Productos
            if(isset($submodulos['productos']))
            {
                echo 
                '<!-- Listado Productos -->
                    <li class="nav-item">
                        <a href="'. baseUrl('compra/productos').'" class="nav-link">
                            <p>Productos</p>
                            <i class="fas fa-box-open nav-icon right"></i>
                        </a>
                    </li>';
            }
        ?>
    </ul>
</li>