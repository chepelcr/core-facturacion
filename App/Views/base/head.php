  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Modas Laura | Sistema de Ordenes</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
      crossorigin="anonymous" />
  <!-- overlayScrollbars -->
  <link rel="stylesheet"
      href="<?=getFile('dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=getFile('dist/css/adminlte.min.css')?>">
  
  <!-- Estilo personalizado -->
  <link rel="stylesheet" href="<?=getFile('dist/css/estilos.css')?>">

  <!-- Logo -->
  <link rel="icon" type="image/png" href="<?=getFile('dist/img/logo.png')?>">

  <!-- Pace Style-->
  <link rel="stylesheet" href="<?=getFile('dist/plugins/pace-progress/themes/center-radar.css')?>">

<?php 
    if(isset($head))
        echo $head;
?>