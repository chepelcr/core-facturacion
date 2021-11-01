<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ubicacion</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-left">Provincia</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-control inp provincia">
                            <option value="">Seleccionar</option>
                            <?php foreach ($provincias as $key => $provincia): ?>
                            <option value="<?=$provincia->cod_provincia?>">
                                <?=$provincia->provincia?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-left">Cantón</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-control inp canton" disabled>
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-left">Distrito</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-control inp distrito" disabled>
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-left">Barrio</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-control inp barrio" disabled id="id_ubicacion" name="id_ubicacion">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="text-left">Otras señas</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <textarea class="form-control" name="otras_senias" id="otras_senias" cols="30"
                            rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>