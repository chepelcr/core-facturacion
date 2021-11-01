<!-- Menu de Punto de venta -->
<li class="nav-item" id="menu-art">
    <a href="#" class="nav-link" id="art">
        <i class="fas fa-warehouse nav-icon"></i>
        <p>Materia prima</p>
        <i class="right fas fa-angle-left"></i>
    </a>

    <ul class="nav nav-treeview">
        <?php
            if(in_array('lotes', $submodulos))
            {
                echo 
                '<!-- Inventario -->
                    <li class="nav-item">
                        <a href="'. baseUrl('compras').'" class="nav-link">
                            <p>Lotes de compra</p>
                            <i class="nav-icon right fas fa-boxes"></i>
                        </a>
                    </li>';
            }

            if(in_array('productos', $submodulos))
            {
                echo 
                '<!-- Listado documentos -->
                    <li class="nav-item">
                        <a href="'. baseUrl('compras/productos').'" class="nav-link">
                            <p>Productos</p>
                            <i class="fas fa-folder nav-icon right"></i>
                        </a>
                    </li>';
            }
        ?>
    </ul>
</li>