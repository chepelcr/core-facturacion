<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Datos personales</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <input class="form-control form-control-lg inp" id="id_cliente" name="id_cliente" hidden
                        type="text">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-left">Tipo de identificacion</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <select id="id_tipo_identificacion" name="id_tipo_identificacion"
                                    class="form-control inp identificacion">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($identificaciones as $key => $identificacion): ?>
                                    <option value="<?=$identificacion->id_tipo_identificacion?>">
                                        <?=$identificacion->tipo_identificacion?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Cédula del cliente -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-left">Cédula del cliente</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input class="form-control inp" onblur="verificar()" id="identificacion"
                                    name="identificacion" type="text" required max="100">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <!-- Nombre del cliente -->
                                    <label class="text-left razon">Razon Social</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control inp" id="razon" name="razon" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Apellido del cliente -->
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="text-left nombre_comercial">Nombre Comercial</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <input class="form-control inp" id="nombre_comercial" name="nombre_comercial"
                                            type="text" required max="100">
                                    </div>
                                </div>
                            </div>

                            <!-- Correo -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-left">Correo electrónico</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <input class="form-control inp" id="correo" name="correo" type="text" required
                                            max="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-left">Pais</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <select id="cod_pais" name="cod_pais" class="form-control inp">
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($codigos as $key => $codigo): ?>
                                            <option value="<?=$codigo->cod_pais?>">
                                                <?=$codigo->nombre?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-left">Telefono</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <input class="form-control inp" id="telefono" name="telefono" type="text"
                                            required max="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <?= view('base/provincias', $dataProvincias) ?>
    </div>

</div>