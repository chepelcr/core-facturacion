<div class="row">
    <!-- Empresa -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Empresa
                    </h3>
                    <i class="fas fa-building"></i>
                </div>
            </div>

            <div class="card-body text-center">
                <div class="d-flex justify-content-between">
                    <!-- Link a la pagina de empresa -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('empresa') ?>">
                        Informacion
                    </a>

                    <!-- Link a la pagina de ordenes de compra -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('empresa/ordenes') ?>">
                        Ordenes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Lotes de compra -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Materia prima
                    </h3>
                    <i class="fas fa-dolly"></i>
                </div>
            </div>

            <div class="card-body text-center">
                <div class="d-flex justify-content-between">
                    <!-- Link a la pagina de productos de compra -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('compra/productos') ?>">
                        Productos
                    </a>

                    <!-- Link a la pagina de lotes de compra -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('compra/lotes') ?>">
                        Lotes de compra
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Lotes de produccion -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Produccion
                    </h3>
                    <i class="fas fa-dolly-flatbed"></i>
                </div>
            </div>

            <div class="card-body text-center">
                <div class="d-flex justify-content-between">
                    <!-- Link a la pagina de productos de produccion -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('produccion/productos') ?>">
                        Productos
                    </a>

                    <!-- Link a la pagina de lotes de produccion -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('produccion/lotes') ?>">
                        Lotes de produccion
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Seguridad -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Seguridad
                    </h3>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="card-body text-center">
                <div class="d-flex justify-content-between">
                    <!-- Link a la pagina de usuarios -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('seguridad') ?>">
                        Usuarios
                    </a>

                    <!-- Link a la pagina de roles -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('seguridad/roles') ?>">
                        Roles
                    </a>

                    <!-- Link a la pagina de auditorias -->
                    <a role="button" class="btn btn-dark" href="<?= baseUrl('seguridad/auditorias') ?>">
                        Auditorias
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>