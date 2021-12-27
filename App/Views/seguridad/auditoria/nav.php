<div class="container nav-auditorias" id="nav-auditorias">
    <div class="container-fluid">
        <div class="d-flex justify-content-around">
            <div class="col-10 bg-gradient-gray rounded">
                <div class="row">
                    <div class="col col-lg col-md col-sm p-1">
                        <button class="btn btn-dark btn-modulo w-100 btn_seguridad_auditorias"
                            type="button" onclick="cargar_listado('seguridad', 'auditorias', '<?=baseUrl('seguridad/auditorias/listado')?>')">
                            Auditorias
                        </button>
                    </div>

                    <!-- Errores -->
                    <div class="col col-lg col-md col-sm p-1">
                        <button class="btn btn-dark btn-modulo w-100 btn_seguridad_errores"
                            type="button" onclick="cargar_listado('seguridad', 'errores', '<?=baseUrl('seguridad/errores/listado')?>')">
                            Errores
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>