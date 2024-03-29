<!-- Base -->

<!-- jQuery -->
<?=getScript('plugins/jquery/jquery.min')?>

<!-- Bootstrap 4 -->
<?=getScript('plugins/bootstrap/js/bootstrap.bundle.min')?>

<!-- AdminLTE App -->
<?=getScript('adminlte.min')?>


<!-- Plugins -->

<!-- Plugins | Pace -->
<?=getScript('plugins/pace-progress/pace.min')?>

<!-- Plugins | overlayScrollbars -->
<?=getScript('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min')?>

<!-- Plugins | SweetAlert -->
<?=getScript('https://cdn.jsdelivr.net/npm/sweetalert2@11', true)?>

<!-- Plugins | Font-Awesome -->
<?=getScript('https://kit.fontawesome.com/3e7bda16db.js', true, "anonymous")?>

<!-- Plugins | DataTables-->
<?=getScript('https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js', true, "", "utf8")?>

<!-- DataTables || Select -->
<?=getScript('https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js', true)?>

<!-- Plugins | Modernizr -->
<?=getScript('plugins/modernizr-custom/modernizr-custom')?>



<!-- Scripts -->

<!-- Core | Plugins | Mensajes -->
<?=getScript('core/plugins/mensajes')?>

<!-- Core | Seguridad | Login -->
<?=getScript('core/seguridad/login')?>

<?php
    if(is_login())
    {
?>

<!-- Core | Navegacion | Cargar -->
<?=getScript('core/navegacion/cargar')?>

<!-- Core | Navegacion | Modulos -->
<?=getScript('core/navegacion/modulos')?>

<!-- Core | Navegacion | Navbar -->
<?=getScript('core/navegacion/navbar')?>

<!-- Core | Plugins | Archivos -->
<?=getScript('core/plugins/archivos')?>

<!-- Core | Plugins | Cedula -->
<?=getScript('core/plugins/cedula')?>

<!-- Core | Plugins | Formatos -->
<?=getScript('core/plugins/formatos')?>

<!-- Core | Plugins | Listado -->
<?=getScript('core/plugins/listado')?>

<!-- Core | Plugins | Modal -->
<?=getScript('core/plugins/modal')?>

<!-- Core | Plugins | Ubicaciones -->
<?=getScript('core/plugins/ubicaciones')?>

<!-- Core | Plugins | Usuarios -->
<?=getScript('core/plugins/usuarios')?>

<!-- Form | Campos -->
<?=getScript('core/form/campos')?>

<!-- Form | Operaciones -->
<?=getScript('core/form/operaciones')?>

<!-- Core | Form | Permisos -->
<?=getScript('core/form/permisos')?>

<!-- Core | Productos | Cabys -->
<?=getScript('core/productos/cabys')?>

<!-- Core | Productos | Calculos -->
<?=getScript('core/productos/calculos')?>

<!-- Facturacion | Inicio | Documentos -->
<?=getScript('core/facturacion/inicio/acciones')?>

<!-- Facturacion | Inicio | Hacienda -->
<?=getScript('core/facturacion/inicio/hacienda')?>

<!-- Facturacion | Documento | Acciones -->
<?=getScript('core/facturacion/documento/acciones')?>

<!-- Facturacion | Documento | Clientes -->
<?=getScript('core/facturacion/documento/clientes')?>

<!-- Facturacion | Documento | Lineas -->
<?=getScript('core/facturacion/documento/lineas')?>

<!-- Facturacion | Documento | Otros -->
<?=getScript('core/facturacion/documento/otros')?>

<!-- Facturacion | Documento | Productos -->
<?=getScript('core/facturacion/documento/productos')?>

<!-- Facturacion | Documento | Referencias -->
<?=getScript('core/facturacion/documento/referencias')?>

<!-- Facturacion | Documento | Walmart -->
<?=getScript('core/facturacion/documento/walmart')?>

<!-- Facturacion | Lineas | Descuentos -->
<?=getScript('core/facturacion/lineas/descuentos')?>

<!-- Facturacion | Lineas | Impuestos -->
<?=getScript('core/facturacion/lineas/impuestos')?>

<!-- Core | Seguridad | Contrasenia -->
<?=getScript('core/seguridad/contrasenia')?>

<!-- Core | Seguridad | Perfil -->
<?=getScript('core/seguridad/perfil')?>

<?php
    }//is_login

    if(isset($script))
        echo $script;
?>