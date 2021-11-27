<!-- Menu de documentos -->
<li class="nav-item" id="menu-art">
    <a href="#" class="nav-link" id="art">
        <i class="nav-icon fas fa-satellite-dish"></i>
        <p>Produccion</p>
        <i class="right fas fa-angle-left"></i>
    </a>

    <ul class="nav nav-treeview">
    <?php
        //Lotes de produccion
        if(isset($submodulos['lotes']))
        {
            echo 
            '<!-- Listado Lotes -->
                <li class="nav-item">
                    <a href="'. baseUrl('produccion/lotes').'" class="nav-link">
                        <p>Lotes de produccion</p>
                        <i class="fas fa-boxes nav-icon right"></i>
                    </a>
                </li>';
        }

        //Ordenes de compra
        if(!isset($submodulos['ordenes']))
        {
            echo 
            '<!-- Listado Ordenes de compra -->
                <li class="nav-item">
                    <a href="'. baseUrl('produccion/ordenes').'" class="nav-link">
                        <p>Ordenes de compra</p>
                        <i class="fas fa-shopping-cart nav-icon right"></i>
                    </a>
                </li>';
        }

        //Productos que se fabrican
        if(isset($submodulos['productos']))
        {
            echo 
            '<!-- Listado Productos -->
                <li class="nav-item">
                    <a href="'. baseUrl('produccion/productos').'" class="nav-link">
                        <p>Productos</p>
                        <i class="fas fa-box-open nav-icon right"></i>
                    </a>
                </li>';
        }
        ?>
    </ul>
</li>