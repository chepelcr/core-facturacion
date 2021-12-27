<div class="container">
    <!-- Empresa -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Empresa
                    </h3>
                    <i class="fas fa-building"></i>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Clientes -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">
                                        Clientes
                                    </h3>
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <div class="d-flex justify-content-around">
                                    <!-- Boton para entrar al modulo de clientes -->
                                    <button class="btn btn-dark col-4" onclick="cargar_listado('empresa', 'clientes')">
                                        Entrar
                                    </button>

                                    <!-- Boton para agregar un nuevo cliente -->
                                    <button class="btn btn-dark col-4" onclick="nuevo_cliente()" id="#btn-agregar-cliente">
                                        Nuevo cliente
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Productos -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">
                                        Productos
                                    </h3>
                                    <i class="fas fa-dolly"></i>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <!-- Boton para entrar al modulo de productos -->
                                <button class="btn btn-dark" id="#btn-entrar-productos">
                                    Entrar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Ordenes de compra -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">
                                        Ordenes de compra
                                    </h3>
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <!-- Boton para entrar al modulo de ordenes de compra -->
                                <button class="btn btn-dark" id="#btn-entrar-ordenes-compra">
                                    Entrar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Informacion -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">
                                        Informacion
                                    </h3>
                                    <i class="fas fa-info-circle"></i>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <!-- Boton para entrar al modulo de informacion -->
                                <button class="btn btn-dark" id="#btn-entrar-informacion">
                                    Entrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>