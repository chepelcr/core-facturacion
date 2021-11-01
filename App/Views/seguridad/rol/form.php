<div class="row">
    <input class="form-control form-control-lg inp" id="id_rol" name="id_rol" hidden type="text">

    <!-- Nombre del rol -->
    <div class="col-md-8">
        <div class="form-group">
            <label class="text-left">Nombre del rol</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
                <input class="form-control form-control-lg inp" id="nombre_rol" name="nombre_rol" type="text" required>
            </div>
        </div>
    </div>

    <!-- Nombre del autor -->
    <div class="col-md-4">
        <div class="form-group text-center">
            <label>Activo</label>
            <div class="input-group">

                <input class="form-control form-control-lg inp" id="estado" name="estado" type="checkbox" required>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-ivo">
                <h3 class="card-title text-white">Permisos</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <article class="card">
                            <header class="card-header bg-ivo">
                                <h4 class="text-white">Facturación</h4>
                            </header>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <label for="permiso_facturacion">Activo</label>
                                            <div class="input-group">
                                                <input class="form-control" id="permiso_facturacion"
                                                    name="permiso_facturacion" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-6">
                        <article class="card">
                            <header class="card-header bg-secondary">
                                <h4 class="card-subtitle">Punto de venta</h4>
                            </header>
                        </article>
                    </div>

                    <div class="col-md-6">
                        <article class="card">
                            <header class="card-header bg-secondary">
                                <h4 class="card-subtitle">Administración</h4>
                            </header>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>