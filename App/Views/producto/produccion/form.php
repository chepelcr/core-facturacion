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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre" class="text-left">Descripción</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                </div>
                                <input class="form-control inp" id="descripcion" name="descripcion" type="text" required
                                    max="100">
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de producto (compra o produccion) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo" class="text-left">Tipo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-hand-pointer"></i>
                                    </span>
                                </div>
                                <select class="form-control inp" id="tipo" name="tipo" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="C">Compra</option>
                                    <option value="P">Producción</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Unidad de medida -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-left">Unidad de
                                medida</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-ruler-combined"></i>
                                    </span>
                                </div>
                                <select class="form-control inp" name="id_unidad" required id="id_unidad">
                                    <option value="">Seleccionar</option>
                                    <!-- Metros -->
                                    <optgroup label="Metros">
                                        <option value="1">Metro</option>
                                        <option value="2">Centimetro</option>
                                    </optgroup>

                                    <!-- Kilogramos -->
                                    <optgroup label="Kilogramos">
                                        <option value="3">Kilogramo</option>
                                        <option value="4">Gramo</option>
                                    </optgroup>

                                    <!-- Litros -->
                                    <optgroup label="Litros">
                                        <option value="5">Litro</option>
                                        <option value="6">Mililitro</option>
                                    </optgroup>

                                    <!-- Unidades -->
                                    <optgroup label="Unidades">
                                        <option value="7">Unidad</option>
                                    </optgroup>

                                    <!-- Servicios -->
                                    <optgroup label="Servicio">
                                        <option value="8">Servicio</option>
                                    </optgroup>
                                </select>
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
                                <input onblur="validarCodigo()" class="form-control inp" type="number" id="codigo"
                                    name="codigo">
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