<!-- jQuery -->
<script src="<?=getFile('dist/plugins/jquery/jquery.min.js')?>"></script>

<!-- Bootstrap 4 -->
<script src="<?=getFile('dist/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

<!-- AdminLTE App -->
<script src="<?=getFile('dist/js/adminlte.min.js')?>"></script>

<!-- Pace -->
<script src="<?=getFile('dist/plugins/pace-progress/pace.min.js')?>"></script>

<!-- overlayScrollbars -->
<script src="<?=getFile('dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>

<!-- SweetAlert -->
<script src="http:////cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font-Awesome -->
<script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>

<!--DataTables-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

<!-- DataTables || Select -->
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>

<!-- Base | Mensajes -->
<?=getScript('base/mensajes')?>

<!-- Base | Login -->
<?=getScript('base/login')?>

<?php
    if(is_login())
    {
?>

<!-- Base | Nav -->
<?=getScript('base/nav')?>

<!-- Base | Modulos -->
<?=getScript('base/modulos')?>

<!-- Base | Listado -->
<?=getScript('base/listado')?>

<!-- Base | Ubicaciones -->
<?=getScript('base/ubicaciones')?>

<!-- Form | Campos -->
<?=getScript('form/campos')?>

<!-- Form | Operaciones -->
<?=getScript('form/operaciones')?>

<!-- Form || Permisos -->
<?=getScript('form/permisos')?>

<!-- Empresa || Productos -->
<?=getScript('empresa/productos')?>

<!-- Facturacion | Documentos -->
<?=getScript('facturacion/documentos')?>

<!-- Facturacion | Lineas -->
<?=getScript('facturacion/lineas')?>

<!-- Facturacion | Hacienda -->
<?=getScript('facturacion/hacienda')?>

<!-- Facturacion | Clientes -->
<?=getScript('facturacion/clientes')?>

<!-- Facturacion | Productos -->
<?=getScript('facturacion/productos')?>

<!-- Facturacion | Walmart -->
<?=getScript('facturacion/walmart')?>

<!-- Seguridad | Usuarios -->
<?=getScript('seguridad/usuarios')?>

<?php
    }//is_login

    if(isset($script))
        echo $script;
?>