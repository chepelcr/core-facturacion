<!-- jQuery -->
<script src="<?=getFile('dist/plugins/jquery/jquery.min.js')?>"></script>

<!-- Bootstrap 4 -->
<script src="<?=getFile('dist/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

<!-- overlayScrollbars -->
<script src="<?=getFile('dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>

<!-- AdminLTE App -->
<script src="<?=getFile('dist/js/adminlte.min.js')?>"></script>

<!-- SweetAlert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font-Awesome -->
<script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>

<!--DataTables-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<!-- Pace -->
<script src="<?=getFile('dist/plugins/pace-progress/pace.min.js')?>"></script>

<!-- Base -->
<?=getScript('base/base')?>"></script>

<!-- Mensajes -->
<?=getScript('base/mensajes')?>

<!-- Form -->
<script src="<?=getFile('dist/js/base/form.js')?>"></script>

<!-- Listado -->
<script src="<?=getFile('dist/js/base/listado.js')?>"></script>

<!-- Ubicaciones -->
<?=getScript('base/ubicaciones')?>

<!-- Inicio -->
<script src="<?=getFile('dist/js/inicio/inicio.js')?>"></script>

<!-- Empresa-->
<script src="<?=getFile('dist/js/inicio/empresa.js')?>"></script>

<!-- Facturas -->
<script src="<?=getFile('dist/js/inicio/facturas.js')?>"></script>

<?php 
    if(isset($script))
        echo $script;
?>