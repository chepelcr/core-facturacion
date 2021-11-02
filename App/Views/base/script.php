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

<!-- Base -->
<script src="<?=getFile('dist/js/base/base.js')?>"></script>

<!-- Pace -->
<script src="<?=getFile('dist/plugins/pace-progress/pace.min.js')?>"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php 
    if(isset($script))
        echo $script;
?>