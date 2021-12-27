<div class="card card-form">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-circle"></i> Datos personales
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>

    <div class="card-body">
        <input class="form-control form-control-lg inp" id="id_cliente" name="id_cliente" type="hidden">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- Cédula del cliente -->
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="text-left">Número de cédula</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input class="form-control inp" onblur="obtener_contribuyente()" id="identificacion"
                                    name="identificacion" type="text" value="<?php if(isset($identificacion)) echo $identificacion?>" required max="100">
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de cedula-->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="text-left">Tipo de identificación</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <select id="id_tipo_identificacion" name="id_tipo_identificacion"
                                    class="form-control inp tipo_identificacion">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($identificaciones as $key => $identificacion): ?>
                                    <option value="<?=$identificacion->id_tipo_identificacion?>"
                                        <?php if(isset($id_tipo_identificacion) && $id_tipo_identificacion == $identificacion->id_tipo_identificacion) echo "selected"?>>
                                        <?=$identificacion->tipo_identificacion?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <!-- Nombre del cliente -->
                    <label class="text-left razon">Nombre completo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input class="form-control inp" id="nombre" name="nombre" required
                            value="<?php if(isset($nombre)) echo $nombre?>" type="text" max="100">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="text-left">Pais</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select id="cod_pais" name="cod_pais" class="form-control inp">
                            <option value="">Seleccionar</option>
                            <?php foreach ($codigos as $key => $codigo): ?>
                            <option value="<?=$codigo->cod_pais?>"
                                <?php if(isset($cod_pais) && $cod_pais == $codigo->cod_pais) echo "selected"?>>
                                <?=$codigo->nombre?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>