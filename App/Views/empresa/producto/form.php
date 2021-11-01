<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Datos generales</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <input hidden disabled class="form-control inp" type="number" id="id_articulo" name="id_articulo">
                    <!-- Nombre del articulo -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nombre" class="text-left">Descripción</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input class="form-control form-control-lg inp" id="descripcion" name="descripcion"
                                    type="text" required max="100">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-left">Imagen</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-folder-plus"></i>
                                    </span>
                                </div>
                                <input accept="image/png,image/jpeg" class="form-control inp" id="imagen" name="imagen"
                                    type="file">
                            </div>
                        </div>
                    </div>

                    <!-- Unidad de medida -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-left">Unidad de
                                        medida</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-shopping-basket"></i>
                                            </span>
                                        </div>
                                        <select class="form-control inp" name="id_unidad" required id="id_unidad">
                                            <option value="">Seleccionar</option>

                                            <?php foreach($unidades as $unidad): ?>
                                            <option value="<?php echo $unidad->id_unidad; ?>">
                                                <?php echo $unidad->descripcion; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-left">Unidades por empaque</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-marker"></i>
                                            </span>
                                        </div>
                                        <input class="form-control inp" id="unidad_empaque" name="unidad_empaque"
                                            required type="number" value="1" min="1">
                                    </div>
                                </div>
                            </div>

                            <!-- Estado -->
                            <div class="col-md-3">
                                <div class="form-group text-center">
                                    <label>Activo</label>
                                    <div class="input-group">
                                        <input class="form-control inp" id="estado" name="estado" type="checkbox">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Códigos</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Item -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="id_articulo" class="text-left">Código de venta</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-cart-arrow-down"></i>
                                    </span>
                                </div>
                                <input onblur="validarCodigo()" class="form-control inp" type="number" id="codigo" name="codigo">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="codigo_cabys" class="text-left">Código
                                CABYS</label>
                            <div class="input-group ">
                                <!-- Codigo Cabys -->
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-keyboard"></i>
                                    </span>
                                </div>
                                <input class="form-control inp" readonly id="codigo_cabys" name="codigo_cabys" required
                                    max="13">

                                <!-- Buscar codigo -->
                                <div class="input-group-append">
                                    <button id="btnCabys" class="btn" type="button" data-toggle="modal"
                                        data-target="#modalCABYS">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Varios</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Categoría -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="id_categoria" class="text-left">Categoria</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-cart-plus"></i>
                                    </span>
                                </div>
                                <select class="form-control inp" name="id_categoria" required id="id_categoria">
                                    <?php foreach($categorias as $categoria): ?>
                                    <option value="<?php echo $categoria->id_categoria; ?>">
                                        <?php echo $categoria->nombre_categoria; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Impuesto -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="impuesto" class="text-left">Impuesto al valor agregado (IVA)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-percent"></i></i></span>
                                </div>
                                <input readonly class="form-control inp" id="impuesto" name="impuesto" type="text"
                                    required max="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>